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