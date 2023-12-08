<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Création ticket</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
<?php
    include "header.php";
    if (!isset($_SESSION['login'])){
        header('Location: connection.php');
    }
    else if ($_SESSION['role'] != 'user'){
        header('Location: index.php');
    }
?>
<main>
    <div id="part_top">
        <h2>Créer un ticket</h2>
    </div>
    <?php
    if (isset($_GET["error"])){
        if($_GET['error'] == "e0"){
            echo '<div class="ticketPageError"><p>Le libelle ne doit pas être vide !</p></div>';
        }
        elseif ($_GET['error'] == "e1"){
            echo '<div class="ticketPageError"><p>La description ne doit pas être vide !</p></div>';
        }
    }
    ?>
    <form action="create_ticket.php" method="get" id="ticket_form">
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
                    <?php
                        $salles = array(
                                'I21', 'G21', 'G22', 'G23', 'G24', 'G25', 'G26'
                        );
                        echo '<option value="other">Autre</option>';
                        foreach($salles as $salle){
                            echo '<option value="'.htmlentities($salle).'">'.htmlentities($salle).'</option>';
                        }
                    ?>
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
            <input type="submit" id="ticket_sub" value="Valider" name="create_ticket">
        </div>
    </form>
</main>
<?php
    include "footer.php";
?>
</body>
</html>
