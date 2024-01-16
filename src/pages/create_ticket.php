<?php
session_start();
$user = "ticket_app";
$passwd = "ticket_s301";
$db = "ticket_app";
$host = "localhost";

if (isset($_POST['create_ticket'])){
    if (isset($_POST['libelle']) && isset($_POST['choix']) && isset($_POST['niveauUrgence']) && isset($_POST['descriptionPrbl'])){
        $libelle = $_POST['libelle'];
        $salle = $_POST['choix'];
        $niveauUrgence = $_POST['niveauUrgence'];
        $descriptionPrbl = $_POST['descriptionPrbl'];

        $mysqli = new mysqli($host, $user, $passwd,$db);

        $stmt = $mysqli->prepare("SELECT DISTINCT room FROM Rooms");
        $stmt->execute();
        $stmt->bind_result($room);

        $rooms = array();
        while ($stmt->fetch()) {
            $rooms[] = $room;
        }

        $stmt->close();

        if ($libelle == ''){
            // erreur qui dit que l'on doit mettre un libelle au problème
            header('Location: ticket.php?error=e0');
        }
        else if ($descriptionPrbl == ''){
            // erreur qui dit que l'on doit décrire notre problème
            header('Location: ticket.php?error=e1');
        }
        else if (strlen($libelle) > 30){
            header('Location: ticket.php?error=e2');
        }
        else if (strlen($descriptionPrbl) > 65535){
            header('Location: ticket.php?error=e3');
        }
        else if (!in_array($niveauUrgence, array(1,2,3,4))){
            header('Location: ticket.php?error=e4');
        }
        else {
            if (!in_array($salle, $rooms)){
                $salle = 'other';
            }
            
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $status = 'open';
            $date = date('Y-m-d H:i:s');
            $user_login = $_SESSION['login'];


            $stmt = $mysqli->prepare("INSERT INTO Tickets(title, description, room, status, emergency, creation_date, user_login, ip_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssisss", $libelle, $descriptionPrbl, $salle, $status, $niveauUrgence, $date, $user_login, $ip_address);
            $stmt->execute();
            $mysqli->close();
            header('Location: dashboard.php');
        }
    }
}

else {
    header('Location: dashboard.php');
}

?>