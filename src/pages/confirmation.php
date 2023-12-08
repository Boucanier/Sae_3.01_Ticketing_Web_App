<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>

<body>
<?php
    include "header.php";
    if (!isset($_SESSION['login']) && !isset($_GET['sup_acc'])){
        header('Location: index.php');
    }
?>
<main>

<script>
    jsChoose = confirm("Êtes-vous sûr de vouloir supprimer votre compte ?\n\n(Cette action est irréversible, vos données seront anonymisées)");

    if (jsChoose == true) {
        window.location.replace("account.php?sup_acc=true");
    }
    else {
        window.location.replace("profile.php");
    }
</script>

<?php
    include "footer.php";
?>
</body>
</html>