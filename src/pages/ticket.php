<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Création ticket</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>
<body>
<header>
    <div id="top">
        <img src="../resources/logo.png" alt="logo de la plateforme" id="image1">
        <h1>Création ticket</h1>
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
        <h2>Créer un ticket</h2>
    </div>
    <form action="dashboard.php" method="get" id="ticket_form">
        <div id="ticket_creation">
            <div id="ticket_label">
                <label for="libelle">Libellé&nbsp;:&nbsp;</label>
                <br>
                <label for="salle">Salle&nbsp;:&nbsp;</label>
                <br>
                <label for="niveauUrgence">Niveau&nbsp;d'urgence&nbsp;estimé&nbsp;:&nbsp;</label>
                <br>
                <label for="descriptionPrbl">Description&nbsp;:&nbsp;</label>
                <br>
            </div>
            <div id="ticket_input">
                <input type="text" id="libelle" name="libelle"/>
                <br>
                <select id="salle" name="choix">
                    <option value="I21">I21</option>
                    <option value="G21">G21</option>
                    <option value="G22">G22</option>
                    <option value="G23">G23</option>
                    <option value="G24">G24</option>
                    <option value="G25">G25</option>
                    <option value="G26">G26</option>
                </select>
                <br>
                <input type="number" id="niveauUrgence" name="niveauUrgence" max="4" min="1" value="1"/>
                <br>
                <textarea id="descriptionPrbl" name="descriptionPrbl" rows="5" cols="33"></textarea>
                <br>
            </div>
        </div>
        <div id="ticket_buttons">
            <input type="reset" id="ticket_reset" value="Effacer">
            <input type="submit" id="ticket_sub" value="Valider">
        </div>
    </form>
    
</main>
<?php
    include "footer.php";
?>
</body>
</html>
