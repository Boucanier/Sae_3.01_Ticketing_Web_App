<?php
    include 'functions.php';

    if (isset($_GET['create_acc'], $_GET['role']) && (($_GET['role'] == 'user' && !isset($_SESSION['role'])) || ($_GET['role'] == 'tech' && isset($_SESSION['role']) && $_SESSION['role'] == "web_admin"))){
        
        if (isset($_GET['login'], $_GET['name'], $_GET['f_name'], $_GET['pwd'], $_GET['conf_pwd'], $_GET['role'])){
            $login = $_GET['login'];
            $l_name = $_GET['name'];
            $f_name = $_GET['f_name'];
            $pwd = $_GET['pwd'];
            $conf_pwd = $_GET['conf_pwd'];
            $role = $_GET['role'];

            if ($role == 'tech'){
                $captcha = 0;
                $reponse_attendue = 0;
            }
            else {
                $reponse_attendue = $_GET['reponse_attendue'];
                $reponse_utilisateur = $_GET['captcha'];
            }

            create_acc($login, $l_name, $f_name, $pwd, $conf_pwd, $reponse_attendue, $reponse_utilisateur, $role);
        }

        else header('Location: connection.php');
    }

    else if (isset($_GET['log_acc'], $_GET['login_connect'], $_GET['pwd_connect'])){
        log_acc($_GET['login_connect'], $_GET['pwd_connect']);
    }

    else if (isset($_GET['update_acc'])){
        if (isset($_SESSION['login'], $_GET['actual_pwd'], $_GET['new_pwd'], $_GET['conf_pwd'])){
            update_acc($_SESSION['login'], $_GET['actual_pwd'], $_GET['new_pwd'], $_GET['conf_pwd']);
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