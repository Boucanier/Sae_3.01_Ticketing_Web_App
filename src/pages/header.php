<?php
    session_start();

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
    </head>

    <body>
        <header>
        <div id="top">
            <img src="resources/logo.png" alt="logo de la plateforme" id="image1">
            <h1>Ticket App</h1>
            <img src="resources/logo_UVSQ.png" alt="logo de l\'UVSQ" id="image2">
        </div>';

    if (isset($_SESSION['font']) && $_SESSION['font'] == "dyslexic"){
        echo '<link rel="stylesheet" type="text/css" href="style/dys_style.css">';
    }

    $type = 'visit';

    $user = "ticket_app";
    $passwd = "ticket_s301";
    $db = "ticket_app";
    $host = "localhost";

    if (isset($_SESSION['login'])){
        $type = $_SESSION['role'];
    }

    $headerValue_fr = array('Accueil', 'Se connecter', 'Tableau de bord', 'Profil', 'Déconnexion', 'Gestion des techniciens', 'Journaux d\'activités', 'Tickets disponibles');
    $headerValue_en = array('Home', 'Sign in', 'Dashboard', 'Profile', 'Sign out', 'Technicians management', 'Activity logs', 'Available tickets');
    $headerValue = array('fr' => $headerValue_fr, 'en' => $headerValue_en);

    if ($type == 'visit'){
    echo (' <nav>
                <div id="nav1">
                    <a href="index.php">'.$headerValue[$lang][0].'</a>
                </div>
                <div id="nav2">
                    <a href="connection.php">'.$headerValue[$lang][1].'</a>
                </div>
            </nav>
        </header>');
    }

    else if ($type == 'user'){
        echo (' <nav>
                    <div id="nav1">
                        <a href="index.php">'.$headerValue[$lang][0].'</a>
                        <a href="dashboard.php">'.$headerValue[$lang][2].'</a>
                    </div>
                    <div id="nav2">
                        <a href="profile.php">'.$headerValue[$lang][3].'</a>
                        <a href="out.php">'.$headerValue[$lang][4].'</a>
                    </div>
                </nav>
            </header>');
    }

    else if ($type == 'tech'){
        echo (' <nav>
                    <div id="nav1">
                        <a href="index.php">'.$headerValue[$lang][0].'</a>
                        <a href="dashboard.php">'.$headerValue[$lang][2].'</a>
                        <a href="dashboard.php?dispo=true">'.$headerValue[$lang][7].'</a>
                    </div>
                    <div id="nav2">
                        <a href="profile.php">'.$headerValue[$lang][3].'</a>
                        <a href="out.php">'.$headerValue[$lang][4].'</a>
                    </div>
                </nav>
            </header>');
    }

    else if ($type == 'web_admin'){
        echo (' <nav>
                    <div id="nav1">
                        <a href="index.php">'.$headerValue[$lang][0].'</a>
                        <a href="dashboard.php">'.$headerValue[$lang][2].'</a>
                        <a href="tech.php">'.$headerValue[$lang][5].'</a>
                    </div>
                    <div id="nav2">
                        <a href="profile.php">'.$headerValue[$lang][3].'</a>
                        <a href="out.php">'.$headerValue[$lang][4].'</a>
                    </div>
                </nav>
            </header>');
    }

    else if ($type == 'sys_admin'){
        echo (' <nav>
                    <div id="nav1">
                        <a href="index.php">'.$headerValue[$lang][0].'</a>
                        <a href="activity_log.php">'.$headerValue[$lang][6].'</a>
                    </div>
                    <div id="nav2">
                        <a href="profile.php">'.$headerValue[$lang][3].'</a>
                        <a href="out.php">'.$headerValue[$lang][4].'</a>
                    </div>
                </nav>
            </header>');
    }
?>