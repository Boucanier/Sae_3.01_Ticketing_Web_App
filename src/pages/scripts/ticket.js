function changeTechForStatus(){
    new_status = document.getElementById("new_status");
    value = new_status.options[new_status.selectedIndex].value;
    tech = document.getElementById("new_tech");

    if (value == "in_progress"){
        tech.options[1].selected = true;
    }

    else {
        tech.options[0].selected = true;
    }
}


function changeStatusForTech(){
    new_tech = document.getElementById("new_tech");
    value = new_tech.options[new_tech.selectedIndex].value;
    status_val = document.getElementById("new_status");

    if (value == "Vide"){
        status_val.options[0].selected = true;
    }

    else {
        status_val.options[2].selected = true;
    }
}


function resetForm(){
    tech = document.getElementById("new_tech");
    for (var i = 0; i < tech.options.length; i++) {
        tech.options[i].removeAttribute("disabled");
    }
}