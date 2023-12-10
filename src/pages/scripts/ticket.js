function changeTechForStatus(){
    new_status = document.getElementById("new_status");
    value = new_status.options[new_status.selectedIndex].value;
    tech = document.getElementById("new_tech");
    tech_vide = document.getElementById("tech_vide");

    if (value == "in_progress"){
        for (var i = 0; i < tech.options.length; i++) {
            tech.options[i].removeAttribute("disabled");
        }
        tech_vide.setAttribute("disabled", "disabled");
        tech.options[1].selected = true;
    }

    else if (value == 'Vide'){
        for (var i = 0; i < tech.options.length; i++) {
            tech.options[i].removeAttribute("disabled");
        }
        tech.options[0].selected = true;
    }

    else {
        tech_vide.removeAttribute("disabled");
        tech.options[0].selected = true;
        for (var i = 1; i < tech.options.length; i++) {
            tech.options[i].setAttribute("disabled", "disabled");
        }
    }
}

function resetForm(){
    tech = document.getElementById("new_tech");
    for (var i = 0; i < tech.options.length; i++) {
        tech.options[i].removeAttribute("disabled");
    }
}