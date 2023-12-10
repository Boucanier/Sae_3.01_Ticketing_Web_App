<?php
    session_start();
    if (isset($_SESSION['login'])){
        session_destroy();
        if (isset($_GET['sup_acc']) && $_GET['sup_acc'] == true){
            header('Location: index.php?success=1');
        }
        else {
            header('Location: index.php');
        }
    }

    else {
        header('Location: index.php');
    }
?>