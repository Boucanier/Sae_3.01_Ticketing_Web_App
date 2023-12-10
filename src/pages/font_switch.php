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
?>