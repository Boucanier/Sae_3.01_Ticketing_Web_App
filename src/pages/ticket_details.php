<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ticket</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>
<body>
<?php
    include "header.php";
?>
<main>
    <?php
    
    if (isset($_GET['id']) && !empty($_GET['id'])){
        $ticket_id = $_GET['id'];
    }
    else {
        header('Location: dashboard.php');
    }

    $user = "ticket_app";
    $passwd = "ticket_s301";
    $db = "ticket_app";
    $host = "localhost";

    $mysqli = new mysqli($host, $user, $passwd, $db);

    $stmt = $mysqli->prepare("SELECT creation_date, description, title, room, emergency, status FROM Tickets WHERE ticket_id = ?");
    $stmt->bind_param("i", $ticket_id);
    $stmt->execute();
    $stmt->bind_result($creation_date, $description, $title, $room, $emergency, $status);
    $stmt->fetch();

    echo '<div id="part_top">
        <h2>Ticket du '.$creation_date.'</h2>
    </div>
    <form id="ticket_about" action="action_ticket.php" method="GET">
        <div id="ticket_description">
            <h3>Description du problème</h3>
            <p>'.$description.'</p>
        </div>
        <div id="ticket_details">
            <p>'.$title.'</p>
            <p>Salle : '.$room.'</p>
            <p>Niveau d\'urgence : '.$emergency.'</p>';

            switch ($status){
                case 'open':
                    echo '<p>État : Ouvert</p>';
                    break;
                case 'in_progress':
                    echo '<p>État : En cours</p>';
                    break;
                case 'closed':
                    echo '<p>État : Fermé</p>';
                    break;
                default:
                    echo '<p>État : Inconnu</p>';
            }

            echo '<br>
            <div class="resetSubmitButtons">
                <input type="button" value="Annuler" class="reset_buttons" onclick="history.back();">';

                    # TODO: Faire une requête pour vérifier l'état du ticket afin de vérifier que la fonction est la bonne
                    if (isset($_GET['function']) && !empty($_GET['function'])){
                        if ($_GET['function'] == 'take'){
                            echo '<input type="submit" value="Prendre en charge" name="take" class="submit_buttons">';
                        }
                        
                        else if ($_GET['function'] == 'close'){
                            echo '<input type="submit" value="Clore" name="close" class="submit_buttons">';
                        }
                        echo '<input name="ticket_id" type="hidden" value="'.$ticket_id.'"/>';
                    }
                ?>
            </div>
        </div>
    </form>
    <?php
        $stmt->close();
    ?>
</main>
<?php
    include "footer.php";
?>
</body>
</html>
