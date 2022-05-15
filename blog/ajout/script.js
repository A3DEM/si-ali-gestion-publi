
function removeClass() {
    document.querySelectorAll("nav ul li").forEach(element => {
        element.classList.remove("active");
    });
}

function addClass(obj) {
    document.querySelector("."+obj).classList.add("active");
}

function changeType() {
    console.log(document.querySelector("#types option:checked").innerText)
    let origine;
    switch (document.querySelector("#types option:checked").innerText) {
        case "Revue":
            origine = "Revue :";
            break;
    
        case "Conférence":
            origine = "Conférence :";
            break;

        case "Chapitre":
            origine = "Chapitre :";
            break;
        
        case "Livre":
            origine = "Livre :";
            break;
        
        case "Thèse":
            origine = "Thèse :";
            break;

        case "Brevet":
            origine = "Brevet :";
            break;

        case "Document judiciaire":
            origine = "Dossier judiciaire :";
            break;

        case "Autre":
            origine = "Origine :";
            break;
    }
    document.querySelector("#origine").innerHTML = origine;
}

document.querySelector("input[type='submit']").addEventListener("click", function() {
    
});