<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ticket</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <script src="../scripts/ticket.js"></script>
</head>
<body>
<?php
    include "header.php";
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
  
    // préparation de la liste de toutes les informations nécessaire a l'affichage des informations du ticket sélectionné
    $stmt1 = $mysqli->prepare("SELECT description, title, room, user_login, emergency, status FROM Tickets WHERE ticket_id = ?");
    $stmt1->bind_param("i", $ticket_id);
    $stmt1->execute();
    $stmt1->bind_result($description, $title, $room, $user_login, $emergency, $status);
    $stmt1->fetch();
    $data = array($description, $title, $room, $user_login, "", $emergency, $status);
    $stmt1->close();

    //on regarde si le ticket a déja un technicien d'attribué
    $stmt3 = $mysqli->prepare("SELECT tech_login FROM Interventions WHERE ticket_id = ?");
    $stmt3->bind_param("i", $ticket_id);
    $stmt3->execute();
    $stmt3->bind_result($tech_login);
    $stmt3->fetch();
    if (!is_null($tech_login)){
        $data[4] = $tech_login;
    }
    $stmt3->close();

    // liste de tous les techniciens avec leur login, prenom et nom de famille
    $stmt2 = $mysqli->prepare("SELECT login, first_name, last_name FROM Users WHERE role LIKE 'tech' AND login NOT LIKE 'rmv-%'");
    $stmt2->execute();
    $stmt2->bind_result($login, $first_name, $last_name);
    $techniciens = array();
    while ($stmt2->fetch()) {
        $result = array($login, $first_name, $last_name);
        $techniciens[] = $result;
    }
    $stmt2->close();

    echo '
    <div id="form_modification_ticket">
        <div id="texte_explicatif_info_actuel">
            <textarea id="description_prbl_modification_page" name="description_probleme" rows="10" cols="20" readonly>'.$data[0].'</textarea>
            <div id="form_valeur_actuelle_valeur_a_modifier">
                <div id="modification_ticket_valeur_actuelle">
                    <div id="modification_ticket_libelle_salle">
                        <div id="modification_ticket_libelle">
                            <label for="ticket_libelle">Libellé</label>
                            <input type="text" id="ticket_libelle" name="ticket_libelle" value="'.$data[1].'" readonly/>
                        </div>
                        <div id="modification_ticket_salle">
                            <label for="ticket_salle">Salle</label>
                            <input type="text" id="ticket_salle" name="ticket_salle" value="'.$data[2].'" readonly/>
                        </div>
                    </div>
                    <div id="modification_ticket_demandeur_technicien">
                        <div id="modification_ticket_demandeur">
                            <label for="ticket_demandeur">Demandeur</label>
                            <input type="text" id="ticket_demandeur" name="ticket_demandeur" value="'.$data[3].'" readonly/>
                        </div>
                        <div id="modification_ticket_technicien">
                            <label for="ticket_technicien">Technicien</label>';
                            if ($data[4] == ""){
                                echo '<input type="text" id="ticket_technicien" name="ticket_technicien" value="'.$data[4].'" disabled/>';
                            }
                            else 
                                echo '<input type="text" id="ticket_technicien" name="ticket_technicien" value="'.$data[4].'" readonly/>';
                        echo '
                        </div>
                    </div>
                    <div id="modification_ticket_niveauUrgence_etat">
                        <div id="modification_ticket_niveauUrgence">
                            <label for="ticket_niveauUrgence">Niveau d\'urgence</label>
                            <input type="text" class="ticket_case_'.$data[5].'" id="ticket_niveauUrgence" name="ticket_niveauUrgence" value="'.$data[5].'" readonly/>
                        </div>
                        <div id="modification_ticket_etat">
                            <label for="ticket_etat">État</label>
                            <input type="text" id="ticket_etat" name="ticket_etat" value="'.$data[6].'" readonly/>
                        </div>
                    </div>
                </div>
                <form id="modification_ticket_valeur_a_modifier" action="action_ticket.php" method="get">
                    <div class="modif_form_input">
                        <label for="new_libelle">Nouveau libellé&nbsp:</label>
                        <input type="text" id="new_libelle" name="new_libelle"/>
                    </div>
                    <div class="modif_form_input">
                        <label for="new_emergency">Niveau d\'urgence&nbsp:</label>
                        <input type="number" id="new_emergency" max="4" min="1" name="new_emergency"/>
                    </div>
                    <div class="modif_form_input">
                        <label for="new_status">Nouvel état&nbsp:</label>
                        <select id="new_status" name="new_status" onchange="changeTechForStatus()">
                            <option value="Vide"></option>
                            <option value="open">Ouvert</option>
                            <option value="in_progress">En cours</option>
                            <option value="closed">Résolu</option>
                        </select>
                    </div>
                    <div class="modif_form_input">
                        <label for="new_tech">Affecter un technicien&nbsp:</label>
                        <select id="new_tech" name="new_tech">';
                            ?>
                            <?php
                            echo '<option value="Vide" id="tech_vide"></option>';
                            foreach($techniciens as $tech){
                                echo '<option value="'.$tech[0].'">'.$tech[1].' '.$tech[2].'</option>';
                            }
                            echo '
                            <!-- Afficher la liste de tous les techniciens, valeur = login, affichage = prénom + nom -->
                        </select>
                    </div>
                </div>
            </div>
                    <div class="resetSubmitButtons">
                        <input type="reset" value="Effacer" id="reset_modification_ticket" name="reset_modification_ticket" class="reset_buttons" onclick="resetForm()"/>
                        <input type="submit" value="Modifier" id="edit_ticket" name="edit_ticket"  class="submit_buttons"/>
                        <input name="ticket_id" type="hidden" value="'.$ticket_id.'"/>
                        <input name="previous_libelle" type="hidden" value="'.$data[1].'"/>
                        <input name="previous_emergency" type="hidden" value="'.$data[5].'"/>
                        <input name="previous_status" type="hidden" value="'.$data[6].'"/>
                        <input name="previous_tech" type="hidden" value="'.$data[4].'"/>
                    </div>
        </div>
    </form>';
    ?>
</main>
<?php
    include "footer.php";
?>
</body>
</html>
