<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ticket</title>
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
        <h2>Ticket du jj/mm/aaa</h2>
    </div>
    <div id="ticket_about">
        <div id="ticket_description">
            <h3>Description du problème</h3>
            <p>Bacon ipsum dolor amet shoulder short ribs burgdoggen, picanha pancetta chicken pastrami t-bone cow beef buffalo landjaeger. Meatball boudin tenderloin pork belly, chuck pork bacon. Ham hock t-bone bacon turkey. Chislic picanha buffalo, bresaola prosciutto venison tail pig porchetta spare ribs kielbasa short loin beef ribs capicola. Shoulder tail pastrami ground round brisket tri-tip burgdoggen kevin short loin jowl alcatra.
                Flank tail meatball sausage drumstick. Swine pig bacon, venison cupim tenderloin short ribs shank meatball jowl spare ribs ground round. Landjaeger chicken corned beef capicola. Doner pork belly buffalo, kevin porchetta pancetta filet mignon meatloaf. Hamburger andouille landjaeger jerky, buffalo fatback pork belly frankfurter beef drumstick bacon brisket. Salami shoulder ham hock pork loin short loin.</p>
        </div>
        <div id="ticket_details">
            <p>Libellé</p>
            <p>Salle : G24</p>
            <p>Niveau d'urgence : 3</p>
            <p>État : Fermé</p>
        </div>
    </div>
</main>
<?php
    include "footer.php";
?>
</body>
</html>