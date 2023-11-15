<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>
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
    <div id="part_top">
    <h2>Mes tickets</h2>    
        <button type="button" onclick="location.href='ticket.php'">Créer un ticket</button>
    </div>
    <div id="ticket_table">
    <table>
        <tr>
            <th>Niveau</th>
            <th>Salle</th>
            <th>Problème</th>
            <th>Date</th>
            <th>État</th>
        </tr>
        <tr>
            <td class="ticket_case_1">1</td>
            <td>315</td>
            <td>Câble projecteur HS</td>
            <td>04/10/2023</td>
            <td>En cours</td>
        </tr>
        <tr>
            <td class="ticket_case_4">4</td>
            <td>G23</td>
            <td>Écran cassé</td>
            <td>14/09/2023</td>
            <td>Fermé</td>
        </tr>
    </table>
    <div id="details_button">
        <button type="button" onclick="location.href='ticket_details.php'">Détails</button>
        <button type="button" onclick="location.href='ticket_details.php'">Détails</button>
    </div>
    </div>
</main>
<?php
    include "footer.php";
?>
</body>
</html>