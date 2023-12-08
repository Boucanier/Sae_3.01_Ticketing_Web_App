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
    if (!isset($_SESSION['login'])){
        header('Location: connection.php');
    }
    else if (($_SESSION['role'] != 'user') && ($_SESSION['role'] != 'tech')){
        header('Location: dashboard.php');
    }
?>
<main>
    <?php
    
    if (isset($_GET['id']) && !empty($_GET['id'])){
        $ticket_id = $_GET['id'];

        $mysqli = new mysqli($host, $user, $passwd, $db);

        $stmt = $mysqli->prepare("SELECT ticket_id = ? FROM Tickets WHERE ticket_id = ?");
        $stmt->bind_param("ii", $ticket_id, $ticket_id);
        $stmt->execute();
        $stmt->bind_result($ticket_exist);
        $stmt->fetch();
        $stmt->close();

        if (!$ticket_exist){
            header('Location: dashboard.php');
        }
    }
    
    else {
        header('Location: dashboard.php');
    }

    $stmt = $mysqli->prepare("SELECT DATE_FORMAT(creation_date,'%d/%m/%Y'), description, title, room, emergency, status FROM Tickets WHERE ticket_id = ?");
    $stmt->bind_param("i", $ticket_id);
    $stmt->execute();
    $stmt->bind_result($creation_date, $description, $title, $room, $emergency, $status);
    $stmt->fetch();
    $stmt->close();

    echo '<div id="part_top">
        <h2>Ticket du '.htmlentities($creation_date).'</h2>
    </div>
    <form id="ticket_about" action="action_ticket.php" method="GET">
        <div id="ticket_description">
            <h3>Description du problème</h3>
            <p>'.htmlentities($description).'</p>
        </div>
        <div id="ticket_details">
            <p>'.htmlentities($title).'</p>
            <p>Salle : '.htmlentities($room).'</p>
            <p>Niveau d\'urgence : '.htmlentities($emergency).'</p>';

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

                    if (isset($_GET['function']) && !empty($_GET['function']) && $_SESSION['role'] == 'tech'){
                        if (($_GET['function'] == 'take') && ($status == 'open')){
                            echo '<input type="submit" value="Prendre en charge" name="take" class="submit_buttons">';
                        }
                        
                        else if (($_GET['function'] == 'close') && ($status == 'in_progress')){
                            $stmt = $mysqli->prepare("SELECT tech_login FROM Interventions WHERE ticket_id = ?");
                            $stmt->bind_param("i", $ticket_id);
                            $stmt->execute();
                            $stmt->bind_result($user_tech);
                            $stmt->fetch();
                            $stmt->close();

                            if ($user_tech == $_SESSION['login']){
                                echo '<input type="submit" value="Clore" name="close" class="submit_buttons">';
                            }
                            else {
                                echo '<input type="submit" value="Clore" name="close" class="submit_buttons" disabled>';
                            }
                        }
                        echo '<input name="ticket_id" type="hidden" value="'.$ticket_id.'"/>';
                    }
                ?>
            </div>
        </div>
    </form>
</main>
<?php
    include "footer.php";
?>
</body>
</html>
