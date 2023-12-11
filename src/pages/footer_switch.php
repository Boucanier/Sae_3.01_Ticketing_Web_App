<?php
    session_start();
    if (isset($_GET['font']) && $_GET['font'] == "dyslexic"){
        $_SESSION['font'] = "dyslexic";
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }
    else if (isset($_GET['font']) && $_GET['font'] == "normal"){
        $_SESSION['font'] = "normal";
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }
    else {
        header("Location: index.php");
    }

    if (isset($_GET['lang']) && $_GET['lang'] == "switch"){
        if ($_SESSION['lang'] == "fr"){
            $_SESSION['lang'] = "en";
        }
        else {
            $_SESSION['lang'] = "fr";
        }
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }
    else {
        header("Location: index.php");
    }
?>