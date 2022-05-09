async function login() {
    const USERNAME = document.querySelector("#username").value;
    const PASSWORD = document.querySelector("#password").value;
    try {
        const response = await fetch(`./php/login.php?username=${USERNAME}&password=${PASSWORD}`, {
            credentials: 'include'
        });
        if (!response) {
            showMessage("Une erreur est survenue.");
        }
        const data = await response.json()
        console.log(data)
        if (data.response === "error") {
            showMessage(data.message);
        }
        if (data.response === "success") {
            document.location.href = "./blog/index.html"
        }
    }
    catch (e) {
        showMessage("Une erreur est survenue.");
        console.log(e)
    }
}


function showMessage(message) {
    document.querySelector(".message").innerText = message;
    document.querySelector(".message").classList.add("show");
}