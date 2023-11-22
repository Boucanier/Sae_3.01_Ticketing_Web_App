<?php
session_start();
$user = "ticket_app";
$passwd = "ticket_s301";
$db = "ticket_app";
$host = "localhost";

if (isset($_GET['create_ticket'])){
    if (isset($_GET['libelle']) && isset($_GET['choix']) && isset($_GET['niveauUrgence']) && isset($_GET['descriptionPrbl'])){
        $libelle = $_GET['libelle'];
        $salle = $_GET['choix'];
        $niveauUrgence = $_GET['niveauUrgence'];
        $descriptionPrbl = $_GET['descriptionPrbl'];
        if ($libelle == ''){
            // erreur qui dit que l'on doit mettre un libelle au problème
            header('Location: ticket.php?error=e0');
        }
        elseif ($descriptionPrbl == ''){
            // erreur qui dit que l'on doit décrire notre problème
            header('Location: ticket.php?error=e1');
        }
        else{
            $mysqli = new mysqli($host, $user, $passwd,$db);

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


