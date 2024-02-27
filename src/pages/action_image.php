<?php
    include 'functions.php';
    session_start();

    if(isset($_FILES["new_image"])){
        $image = $_FILES["new_image"];
        $login = $_GET["login"];
        ajouterImageBD($image, $login);
    }