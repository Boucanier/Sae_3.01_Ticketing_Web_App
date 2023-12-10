<?php
    include 'functions.php';

    $ticket_id = $_POST['ticket_id'];

    if (isset($_POST["take"]) && ($_SESSION['role'] == 'tech')){
        take_ticket($ticket_id);
    }

    elseif (isset($_POST["close"]) && ($_SESSION['role'] == 'tech')){
        close_ticket($ticket_id);
    }

    elseif (isset($_POST["edit_ticket"]) && ($_SESSION['role'] == 'web_admin')){
        $newLibelle = $_POST["new_libelle"];
        $newEmergency = $_POST["new_emergency"];
        $newStatus = $_POST["new_status"];
        $newTech = $_POST["new_tech"];

        $previous_libelle = $_POST["previous_libelle"];
        $previous_emergency = $_POST["previous_emergency"];
        $previous_status = $_POST["previous_status"];
        $previous_tech = $_POST["previous_tech"];

        edit_ticket(
            $ticket_id,
            $newLibelle, $newEmergency, $newStatus, $newTech,
            $previous_libelle, $previous_emergency, $previous_status, $previous_tech
        );
    }

?>