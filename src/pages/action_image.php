<?php
    include 'functions.php';

    if(isset($_FILES["new_image"])){
        $image = $_FILES["new_image"];
        $login = $_GET["login"];
        ajouterImageBD($image, $login);
    }

    if (isset($_POST["delete_pfp"])){
        $login = $_POST["delete_pfp"];
        $mysqli = new mysqli($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_passwd'], $GLOBALS['db_name']) or die ("Impossible de se connecter à la base de données");
        $stmt = $mysqli->prepare("UPDATE Users SET image=NULL WHERE login = ?");
        $stmt->bind_param("s", $_SESSION['login']);
        $stmt->execute();
        header("Location: profile.php");
    }