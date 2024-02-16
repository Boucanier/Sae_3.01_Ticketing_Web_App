<?php
    include "functions.php";

    if (isset($_SESSION['lang'])){
        $lang = $_SESSION['lang'];
    }
    else {
        $lang = 'fr';
    }

    echo '<!DOCTYPE html>
    <html lang='.$lang.'>
    <head>
        <meta charset="UTF-8">
        <title>'.$tab[$lang].'</title>
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <link rel="icon" href="resources/logo.png">
        <script src="scripts/languages.js"></script>
        <script src="scripts/account.js"></script>
        <script src="scripts/ticket.js"></script>
    </head>

    <body>
        <header>
        <div id="top">
            <img src="resources/logo.png" alt="logo de la plateforme" id="image1">
            <h1>Ticket App</h1>
            <a href="https://www.uvsq.fr" target="_blank"><img src="resources/logo_UVSQ.png" alt="logo de l\'UVSQ" id="image2"></a>
        </div>';

    if (isset($_SESSION['font']) && $_SESSION['font'] == "dyslexic"){
        echo '<link rel="stylesheet" type="text/css" href="style/dys_style.css">';
    }

    $type = 'visit';

    if (isset($_SESSION['login'])){
        $type = $_SESSION['role'];
    }


    $headerValue_fr = array('Accueil', 'Se connecter', 'Tableau de bord', 'Profil', 'Déconnexion', 'Gestion des techniciens', 'Journaux d\'activités', 'Tickets disponibles', 'Statistiques', 'Sécurité', 'Gestion des utilisateurs');
    $headerValue_en = array('Home', 'Sign in', 'Dashboard', 'Profile', 'Sign out', 'Technicians management', 'Activity logs', 'Available tickets', 'Statistics', 'Security', 'Users management');

    $headerValue = array('fr' => $headerValue_fr, 'en' => $headerValue_en);

    if ($type == 'visit'){
        echo (' <nav>
                    <a href="index.php">'.$headerValue[$lang][0].'</a>
                    <a href="connection.php">'.$headerValue[$lang][1].'</a>
                </nav>
            </header>');
    }

    else if ($type == 'user'){
        echo (' <nav>
                    <a href="index.php">'.$headerValue[$lang][0].'</a>
                    <a href="dashboard.php">'.$headerValue[$lang][2].'</a>
                    <a href="profile.php">'.$headerValue[$lang][3].'</a>
                    <a href="out.php">'.$headerValue[$lang][4].'</a>
                </nav>
            </header>');
    }

    else if ($type == 'tech'){
        echo (' <nav>
                    <a href="index.php">'.$headerValue[$lang][0].'</a>
                    <a href="dashboard.php">'.$headerValue[$lang][2].'</a>
                    <a href="dashboard.php?dispo=true">'.$headerValue[$lang][7].'</a>
                    <a href="profile.php">'.$headerValue[$lang][3].'</a>
                    <a href="out.php">'.$headerValue[$lang][4].'</a>
                </nav>
            </header>');
    }

    else if ($type == 'web_admin'){
        echo (' <nav>
                    <a href="index.php">'.$headerValue[$lang][0].'</a>
                    <a href="dashboard.php">'.$headerValue[$lang][2].'</a>
                    <a href="tech.php">'.$headerValue[$lang][5].'</a>
                    <a href="users.php">'.$headerValue[$lang][10].'</a>
                    <a href="profile.php">'.$headerValue[$lang][3].'</a>
                    <a href="out.php">'.$headerValue[$lang][4].'</a>
                </nav>
            </header>');
    }

    else if ($type == 'sys_admin'){
        echo (' <nav>
                    <a href="index.php">'.$headerValue[$lang][0].'</a>
                    <a href="activity_log.php">'.$headerValue[$lang][6].'</a>
                    <a href="stats.php">'.$headerValue[$lang][8].'</a>
                    <a href="security.php">'.$headerValue[$lang][9].'</a>
                    <a href="profile.php">'.$headerValue[$lang][3].'</a>
                    <a href="out.php">'.$headerValue[$lang][4].'</a>
                </nav>
            </header>');
    }
