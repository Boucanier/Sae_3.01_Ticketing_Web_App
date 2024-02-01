<?php
    $tab = array('fr' => 'Ticket', 'en' => 'Ticket');
    
    include "header.php";
    if (!isset($_SESSION['login'])){
        header('Location: connection.php');
    }
    else if (($_SESSION['role'] != 'user') && ($_SESSION['role'] != 'tech')){
        header('Location: dashboard.php');
    }

    echo '<main>';
    
    if (isset($_POST['id']) && !empty($_POST['id'])){
        $ticket_id = $_POST['id'];

        $mysqli = new mysqli(HOST_DB, USER_DB, PASSWD_DB, DB) or die ("Impossible de se connecter à la base de données");

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

    $description_fr = array('Ticket du ', 'Descritpion du problème', 'Salle : ', 'Niveau d\'urgence : ', 'Autre');
    $description_en = array('Ticket from ', 'Probleme description', 'Room : ', 'Emergency level : ', 'Other');
    $description_lang = array('fr' => $description_fr, 'en' => $description_en);

    if ($room == 'other')
        $room = $description_lang[$lang][4];

    echo '<div id="part_top">
        <h2>'.$description_lang[$lang][0].htmlentities($creation_date).'</h2>
    </div>
    <form id="ticket_about" action="action_ticket.php" method="post">
        <div id="ticket_description">
            <h3>'.$description_lang[$lang][1].'</h3>
            <p>'.htmlentities($description).'</p>
        </div>
        <div id="ticket_details">
            <p>'.htmlentities($title).'</p>
            <p>'.$description_lang[$lang][2].htmlentities($room).'</p>
            <p>'.$description_lang[$lang][3].htmlentities($emergency).'</p>';

    $status_fr = array('État : Ouvert', 'État : En cours', 'État : Clos', 'État : Inconnu');
    $status_en = array('Status : Open', 'Status : In progress', 'Status : Closed', 'Status : Unknown');
    $status_lang = array('fr' => $status_fr, 'en' => $status_en);

            switch ($status){
                case 'open':
                    echo '<p>'.$status_lang[$lang][0].'</p>';
                    break;
                case 'in_progress':
                    echo '<p>'.$status_lang[$lang][1].'</p>';
                    break;
                case 'closed':
                    echo '<p>'.$status_lang[$lang][2].'</p>';
                    break;
                default:
                    echo '<p>'.$status_lang[$lang][3].'</p>';
            }

            $button_fr = array('Retour', 'Prendre en charge', 'Clore');
            $button_en = array('Cancel', 'Take ticket', 'Close');
            $button_lang = array('fr' => $button_fr, 'en' => $button_en);

            echo '<br>
            <div class="resetSubmitButtons">
                <input type="button" value="'.$button_lang[$lang][0].'" class="reset_buttons" onclick="history.back();">';

                    if (isset($_POST['function']) && !empty($_POST['function']) && $_SESSION['role'] == 'tech'){
                        if (($_POST['function'] == 'take') && ($status == 'open')){
                            echo '<input type="submit" value="'.$button_lang[$lang][1].'" name="take" class="submit_buttons">';
                        }
                        
                        else if (($_POST['function'] == 'close') && ($status == 'in_progress')){
                            $stmt = $mysqli->prepare("SELECT tech_login FROM Interventions WHERE ticket_id = ?");
                            $stmt->bind_param("i", $ticket_id);
                            $stmt->execute();
                            $stmt->bind_result($user_tech);
                            $stmt->fetch();
                            $stmt->close();

                            if ($user_tech == $_SESSION['login']){
                                echo '<input type="submit" value="'.$button_lang[$lang][2].'" name="close" class="submit_buttons">';
                            }
                            else {
                                echo '<input type="submit" value="'.$button_lang[$lang][2].'" name="close" class="submit_buttons" disabled>';
                            }
                        }
                        echo '<input name="ticket_id" type="hidden" value="'.$ticket_id.'"/>';
                    }
    echo '</div></div></form></main>';
    include "footer.php";
?>
</body>
</html>
