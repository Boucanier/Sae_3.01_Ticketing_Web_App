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

    $infoTop = array('fr' => 'Créer un ticket', 'en' => 'Create a ticket');

    echo '<main>
        <div id="part_top">
            <h2>'.$infoTop[$lang].'</h2>
        </div>';

    if (isset($_GET["error"])){
        $error_fr = array ('Le libellé ne doit pas être vide !', 'La description ne doit pas être vide !', 'Le libellé ne doit pas dépasser 30 caractères !', 'La description ne doit pas dépasser 65535 caractères !');
        $error_en = array ('The title must not be empty !', 'The description must not be empty !', 'The label must not exceed 30 characters !', 'The description must not exceed 65535 characters !');
        $error = array('fr' => $error_fr, 'en' => $error_en);

        switch ($_GET['error']){
            case "e0":
                echo '<div class="error"><p>'.$error[$lang][0].'</p></div>';
                break;
            case "e1":
                echo '<div class="error"><p>'.$error[$lang][1].'</p></div>';
                break;
            case "e2":
                echo '<div class="error"><p>'.$error[$lang][2].'</p></div>';
                break;
            case "e3":
                echo '<div class="error"><p>'.$error[$lang][3].'</p></div>';
                break;
        }
    }

    $formValue_fr = array('Libellé', 'Salle', 'Niveau d\'urgence estimé', 'Description', 'Effacer', 'Valider', 'Autre');
    $formValue_en = array('Title', 'Room', 'Estimated emergency level', 'Description', 'Reset', 'Submit', 'Other');
    $formValue = array('fr' => $formValue_fr, 'en' => $formValue_en);

    echo '<form action="create_ticket.php" method="post" id="ticket_form">
        <div id="ticket_creation">
            <div id="ticket_label">
                <label for="libelle">'.$formValue[$lang][0].'&nbsp;:&nbsp;</label>
                <br>
                <label for="salle">'.$formValue[$lang][1].'&nbsp;:&nbsp;</label>
                <br>
                <label for="niveauUrgence">'.$formValue[$lang][2].'&nbsp;:&nbsp;</label>
                <br>
                <label for="descriptionPrbl">'.$formValue[$lang][3].'&nbsp;:&nbsp;</label>
                <br>
            </div>
            <div id="ticket_input">
                <input type="text" id="libelle" name="libelle"/>
                <br>
                <select id="salle" name="choix">';
                        $salles = array('I21', 'G21', 'G22', 'G23', 'G24', 'G25', 'G26');
                        echo '<option value="other">'.$formValue[$lang][6].'</option>';
                        foreach($salles as $salle){
                            echo '<option value="'.htmlentities($salle).'">'.htmlentities($salle).'</option>';
                        }
                echo '</select>
                <br>
                <input type="number" id="niveauUrgence" name="niveauUrgence" max="4" min="1" value="1"/>
                <br>
                <textarea id="descriptionPrbl" name="descriptionPrbl" rows="5" cols="33"></textarea>
                <br>
            </div>
        </div>
        <div id="ticket_buttons">
            <input type="reset" id="ticket_reset" value='.$formValue[$lang][4].'>
            <input type="submit" id="ticket_sub" value='.$formValue[$lang][5].' name="create_ticket">
        </div>
    </form>
</main>';
    include "footer.php";
?>
</body>
</html>
