document.querySelector("nav ul li:first-child").classList.add("active");

function removeClass() {
    document.querySelectorAll("nav ul li").forEach(element => {
        element.classList.remove("active");
    });
}

function addClass(obj) {
    document.querySelector("."+obj).classList.add("active");
}

document.querySelectorAll("nav ul li").forEach(element => {

    let origine = "";

    element.addEventListener("click", function() {

        switch (this.className) {
            case "revue":
                origine = "Revue :";
                break;
        
            case "conference":
                origine = "Conférence :";
                break;

            case "chapitre":
                origine = "Chapitre :";
                break;
            
            case "livre":
                origine = "Livre :";
                break;
            
            case "these":
                origine = "Thèse :";
                break;

            case "brevet":
                origine = "Brevet :";
                break;

            case "judiciaire":
                origine = "Dossier judiciaire :";
                break;

            case "autre":
                origine = "Origine :";
                break;
        }

        removeClass(),
        addClass(this.className);

        document.querySelector("label[for='origine']").innerHTML = origine;
    });
});

document.querySelector("input[type='submit']").addEventListener("click", function() {
    
});