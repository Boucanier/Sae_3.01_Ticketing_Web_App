<?php
    session_start();
    
    if (isset($_GET['font']) && in_array($_GET['font'], array('normal', 'dyslexic'))){
        $_SESSION['font'] = $_GET['font'];
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    else if (isset($_GET['lang']) && in_array($_GET['lang'], array('fr', 'en'))){
        $_SESSION['lang'] = $_GET['lang'];
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    else {
        header("Location: index.php");
    }
?>