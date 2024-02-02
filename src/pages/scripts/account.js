function supMyAccount(){
    jsChoose = confirm("Êtes-vous sûr de vouloir supprimer votre compte ?\n\n(Cette action est irréversible, vos données seront anonymisées)");

    if (jsChoose == true) {
        form = document.getElementById("formSupAccount");
        form.submit();
    }
}

function supAccount(login){
    jsChoose = confirm("Êtes-vous sûr de vouloir supprimer le compte ?");

    if (jsChoose == true) {
        console.log("form_" + login);
        form = document.getElementById("form_" + login);
        form.submit();
    }
}