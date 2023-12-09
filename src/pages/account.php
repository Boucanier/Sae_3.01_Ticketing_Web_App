<?php
    include 'functions.php';

    if (isset($_POST['create_acc'], $_POST['role']) && (($_POST['role'] == 'user' && !isset($_SESSION['role'])) || ($_POST['role'] == 'tech' && isset($_SESSION['role']) && $_SESSION['role'] == "web_admin"))){
        
        if (isset($_POST['login'], $_POST['name'], $_POST['f_name'], $_POST['pwd'], $_POST['conf_pwd'], $_POST['role'])){
            $login = $_POST['login'];
            $l_name = $_POST['name'];
            $f_name = $_POST['f_name'];
            $pwd = $_POST['pwd'];
            $conf_pwd = $_POST['conf_pwd'];
            $role = $_POST['role'];

            if ($role == 'tech'){
                $captcha = 0;
                $reponse_attendue = 0;
            }
            else {
                $reponse_attendue = $_POST['reponse_attendue'];
                $reponse_utilisateur = $_POST['captcha'];
            }

            create_acc($login, $l_name, $f_name, $pwd, $conf_pwd, $reponse_attendue, $reponse_utilisateur, $role);
        }

        else header('Location: connection.php');
    }

    else if (isset($_POST['log_acc'], $_POST['login_connect'], $_POST['pwd_connect'])){
        log_acc($_POST['login_connect'], $_POST['pwd_connect']);
    }

    else if (isset($_POST['update_acc'])){
        if (isset($_SESSION['login'], $_POST['actual_pwd'], $_POST['new_pwd'], $_POST['conf_pwd'])){
            update_acc($_SESSION['login'], $_POST['actual_pwd'], $_POST['new_pwd'], $_POST['conf_pwd']);
        }
    }

    else if (isset($_GET['sup_acc']) && $_GET['sup_acc'] == true){
        if (isset($_SESSION['login'])){
            del_acc($_SESSION['login']);
        }
    }

    else header('Location: index.php');
    # Paramètres manquants
?>