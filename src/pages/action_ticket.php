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
        // TODO : update du statut (in_progress -> closed)
        $stmt1 = $mysqli->prepare("UPDATE Tickets SET status = ? WHERE ticket_id = ?");
        $status = "closed";
        $stmt1->bind_param("si", $status, $ticket_id);
        $stmt1->execute();
        $stmt1->close();
    }

    elseif (isset($_GET["edit_ticket"])){
        $newLibelle = $_GET["new_libelle"];
        $newEmergency = $_GET["new_emergency"];
        $newStatus = $_GET["new_status"];
        $newTech = $_GET["new_tech"];

        $previous_libelle = $_GET["previous_libelle"];
        $previous_emergency = $_GET["previous_emergency"];
        $previous_status = $_GET["previous_status"];
        $previous_tech = $_GET["previous_tech"];

        $dataToInsert = array();

        if ($newLibelle == "") $dataToInsert[] = $previous_libelle;
        else $dataToInsert[] = $newLibelle;

        if ($newEmergency == "") $dataToInsert[] = $previous_emergency;
        else $dataToInsert[] = $newEmergency;

        if ($newStatus == "Vide") $dataToInsert[] = $previous_status;
        else $dataToInsert[] = $newStatus;

        // les updates nécessaire pour le ticket en question
        $stmt1 = $mysqli->prepare("UPDATE Tickets SET title = ?, emergency = ?, status = ? WHERE ticket_id = ?");
        $stmt1->bind_param("sisi", $dataToInsert[0], $dataToInsert[1], $dataToInsert[2], $ticket_id);
        $stmt1->execute();
        $stmt1->close();

        if ($newTech != "Vide"){
            // TODO : ajouter le technicien dans les interventions
            $stmt1 = $mysqli->prepare("INSERT INTO Interventions (ticket_id, tech_login) VALUES (?, ?)");
            $stmt1->bind_param("is", $ticket_id, $newTech);
            $stmt1->execute();
            $stmt1->close();
        }
    }

    header("Location: dashboard.php");