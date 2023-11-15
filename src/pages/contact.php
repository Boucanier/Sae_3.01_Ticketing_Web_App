<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>
<body>
<header>
    <div id="top">
        <img src="../resources/logo.png" alt="logo de la plateforme" id="image1">
        <h1>Ticket App</h1>
        <img src="../resources/logo_UVSQ.png" alt="logo de l'UVSQ" id="image2">
    </div>
    <nav>
        <div id="nav1">
            <a href="index.php">Accueil</a>
            <a href="dashboard.php">Tableau de bord</a>
        </div>
        <div id="nav2">
            <a href="profile.php">Profil</a>
            <a href="connection.php">Se connecter</a>
            <a href="index.php">Déconnexion</a>
        </div>
    </nav>
</header>
<main>
    <div id="contact_containers">
        <div class="contact_text">
            Si vous souhaitez nous contacter, cliquez sur ce <a href="mailto:?to=contact.golemcorp@gmail.com" target="_blank" class="link_on_page">lien</a>.
        </div>
        <br>
        <div class="contact_text">
            Voici notre <a href="https://github.com/Boucanier/Sae_3.01_Ticketing_Web_App" target="_blank" class="link_on_page">lien GitHub</a> pour ce projet.
        </div>
    </div>
</main>
<?php
    include "footer.php";
?>
</body>
</html>
