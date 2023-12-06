<?php
    include 'functions.php';

    $ticket_id = $_GET['ticket_id'];

    if (isset($_GET["take"])){
        take_ticket($ticket_id);
    }

    elseif (isset($_GET["close"])){
        close_ticket($ticket_id);
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

        edit_ticket(
            $ticket_id,
            $newLibelle, $newEmergency, $newStatus, $newTech,
            $previous_libelle, $previous_emergency, $previous_status, $previous_tech
        );
    }

    header("Location: dashboard.php");