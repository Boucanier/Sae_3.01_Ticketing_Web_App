<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Accueil</title>
<link rel="stylesheet" type="text/css" href="../style/style.css">
</head>
<body>
    <header>
        <div id="top">
            <img src="../resources/logo.png" alt="logo de la plateforme" id="image1">
            <h1>Ticket App</h1>
            <img src="../resources/logo_UVSQ.png" alt="logo de l\'UVSQ" id="image2">
        </div>

<?php
    $type = 'user';

    if ($type == 'visit'){
    echo (' <nav>
                <div id="nav1">
                    <a href="index.php">Accueil</a>
                </div>
                <div id="nav2">
                    <a href="connection.php">Se connecter</a>
                </div>
            </nav>
        </header>');
    }

    else if ($type == 'user'){
        echo (' <nav>
                    <div id="nav1">
                        <a href="index.php">Accueil</a>
                        <a href="dashboard.php">Tableau de bord</a>
                    </div>
                    <div id="nav2">
                        <a href="profile.php">Profil</a>
                        <a href="index.php">Déconnexion</a>
                    </div>
                </nav>
            </header>');
    }

    else if ($type == 'tech'){
        echo (' <nav>
                    <div id="nav1">
                        <a href="index.php">Accueil</a>
                        <a href="dashboard.php">Tableau de bord</a>
                        <a href="">Tickets disponibles</a>
                    </div>
                    <div id="nav2">
                        <a href="profile.php">Profil</a>
                        <a href="index.php">Déconnexion</a>
                    </div>
                </nav>
            </header>');
    }

    else if ($type == 'web_admin'){
        echo (' <nav>
                    <div id="nav1">
                        <a href="index.php">Accueil</a>
                        <a href="dashboard.php">Tableau de bord</a>
                        <a href="">Gérer les techniciens</a>
                    </div>
                    <div id="nav2">
                        <a href="profile.php">Profil</a>
                        <a href="index.php">Déconnexion</a>
                    </div>
                </nav>
            </header>');
    }

    else if ($type == 'sys_admin'){
        echo (' <nav>
                    <div id="nav1">
                        <a href="index.php">Accueil</a>
                        <a href="dashboard.php">Journaux d\'activités</a>
                    </div>
                    <div id="nav2">
                        <a href="profile.php">Profil</a>
                        <a href="index.php">Déconnexion</a>
                    </div>
                </nav>
            </header>');
    }
?>