<?php
    $user = "ticket_app";
    $passwd = "ticket_s301";
    $db = "ticket_app";
    $host = "localhost";
    $mysqli = new mysqli($host, $user, $passwd,$db);

    session_start();
    $actual_user = $_SESSION['login'];
    $ticket_id = $_GET['ticket_id'];

    if (isset($_GET["take"])){
        // TODO : ajouter le technicien (SESSION) dans les interventions avec le ticket en question
        $stmt1 = $mysqli->prepare("INSERT INTO Interventions (ticket_id, tech_login) VALUES (?, ?)");
        $stmt1->bind_param("is", $ticket_id, $actual_user);
        $stmt1->execute();
        $stmt1->close();
    }

    elseif (isset($_GET["close"])){
        // TODO : update du statut (closed)
        $stmt1 = $mysqli->prepare("UPDATE Tickets SET status = ? WHERE ticket_id = ?");
        $status = "closed";
        $stmt1->bind_param("si", $status, $ticket_id);
        $stmt1->execute();
        $stmt1->close();
    }
    header("Location: dashboard.php");