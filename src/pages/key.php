<?php
    session_start();

    if (!isset($_SESSION['login'])){
        header('Location: connection.php');
    }

    else if ($_SESSION['role'] != 'sys_admin'){
        header('Location: index.php');
    }

    include 'functions.php';

    if (isset($_POST['change_key'], $_POST['old_key'], $_POST['conf_key'], $_POST['new_key'])){
        $get_key = get_key();
        $old_key = $_POST['old_key'];
        $conf_key = $_POST['conf_key'];
        $new_key = $_POST['new_key'];

        if ($conf_key != $new_key){
            header('Location: security.php?error=1');
        }

        else if ($old_key != $get_key){
            header('Location: security.php?error=2');
        }

        else if (str_contains($new_key, ' ')){
            header('Location: security.php?error=3');
        }

        else {
            change_key($old_key, $new_key);
            header('Location: security.php?success=1');
        }
    }
?>