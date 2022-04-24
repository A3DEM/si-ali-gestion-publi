async function disconnect() {
    try {
        const response = await fetch(`../php/disconnect.php`, {
            credentials: 'include'
        });
        const data = await response.json()
        if (data.response === "error") {
            console.log(data.message);
        }
        if (data.response === "success") {
            document.location.href = "../index.html"
        }
    }
    catch (e) {
        console.log(e)
    }
}

async function getData() {
    try {
        let response = await fetch(`../php/dashboard.php`, {
            credentials: 'include'
        });
        let data = await response.json()
        if (data.response === "error") {
            console.log(data.message);
            if (data.message === "Aucun compte connecte") {
                document.location.href = "../index.html"
            }
        }
        let isAdmin = false;
        if (data.response === "success") {
            if (data.data.role !== "ROLE_ADMIN") {
                document.querySelector("#administration").remove();
                document.querySelector("#management").remove();
            } else {
                isAdmin = true;
                document.querySelector("#prix_pay").value = data.data.montant_min;
            }
        }

        const memberElement = document.querySelector(".members");
        const year = new Date().getFullYear();
        data.data.members.forEach((member) => {
            if (isAdmin) {
                document.querySelector("#membre").innerHTML += `<option value=${member.id}>${member.prenom}</option>`;
                document.querySelector("#membre_pay").innerHTML += `<option value=${member.id}>${member.prenom}</option>`;
                document.querySelector("#membre_buy").innerHTML += `<option value=${member.id}>${member.prenom}</option>`;
            }

            let temp = `<tr>
            <td>${member.prenom + " " + member.nom}</td>
            `
            for (let i = 1; i <= 12; i++) {
                let isPaid = false
                member.transactions.forEach((data) => {
                    if ((data.date.substring(0, 4) == year && data.date.substring(5, 7) == i) && data.type === "COTISATION") {
                        isPaid = true;
                    }
                });
                temp += `<td ${isPaid ? 'class="checked"' : ''}></td>`
            }
            temp += `</tr>`
            memberElement.innerHTML += temp;
        });
        document.querySelector("#solde").innerText = data.data.solde
        response = await fetch(`../php/getmonth.php`, {
            credentials: 'include'
        });
        data = await response.json()
        if (data.response === "error") {
            console.log(data.message);
        }
        let temp = `<tr class="spending">
                <td>Achats</td>
                `
        for (let i = 1; i <= 12; i++) {
            let value = 0;
            data.forEach((data) => {
                if ((data.date.substring(0, 4) == year && data.date.substring(5, 7) == i)) {
                    value = data.montant
                }
            })
            temp += `<td>${value}</td>`
        }
        temp += `</tr>`
        memberElement.innerHTML += temp;
    }
    catch (e) {
        console.log(e)
    }
}

async function addUser() {
    const nom = document.querySelector("#nom").value;
    const prenom = document.querySelector("#prenom").value;
    const pseudo = document.querySelector("#pseudo").value;
    const password = document.querySelector("#password").value;
    try {
        const response = await fetch(`../php/addmember.php?nom=${nom}&password=${password}&prenom=${prenom}&username=${pseudo}`, {
            credentials: 'include'
        });
        if (!response) {
            console.log("erreur")
        }
        const data = await response.json()
        if (data.response === "error") {
            console.log(data.message)
        }
    }
    catch (e) {
        console.log(e)
    }
}

async function addAchat() {
    const prix = document.querySelector("#prix_buy").value;
    const date = document.querySelector("#date_buy").value;
    const id_membre = document.querySelector("#membre_buy option:checked").value;
    try {
        const response = await fetch(`../php/ajoutachat.php?id=${id_membre}&prix=${prix}&date=${date}`, {
            credentials: 'include'
        });
        if (!response) {
            console.log("erreur")
        }
        const data = await response.json()
        if (data.response === "error") {
            console.log(data.message)
        }
    }
    catch (e) {
        console.log(e);
    }
}


async function addCotisation() {
    const prix = document.querySelector("#prix_pay").value;
    const date = document.querySelector("#date_pay").value;
    const id_membre = document.querySelector("#membre_pay option:checked").value;
    try {
        const response = await fetch(`../php/ajoutcotisation.php?id=${id_membre}&prix=${prix}&date=${date}`, {
            credentials: 'include'
        });
        if (!response) {
            console.log("erreur")
        }
        const data = await response.json()
        if (data.response === "error") {
            console.log(data.message)
        }
    }
    catch (e) {
        console.log(e);
    }
}


getData();
