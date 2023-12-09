function supAccount(){
    jsChoose = confirm("Êtes-vous sûr de vouloir supprimer votre compte ?\n\n(Cette action est irréversible, vos données seront anonymisées)");

    if (jsChoose == true) {
        form = document.getElementById("formSupAccount");
        form.submit();
    }
    else {
        window.location.replace("profile.php");
    }
}