<?php
    $tab = array('fr' => 'Ticket', 'en' => 'Ticket');

    include "header.php";
    if (!isset($_SESSION['login'])){
        header('Location: connection.php');
    }
    else if ($_SESSION['role'] != 'web_admin'){
        header('Location: dashboard.php');
    }

    echo '<main>';

    if (isset($_POST['id']) && !empty($_POST['id'])){
        $ticket_id = $_POST['id'];

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
    $stmt1 = $mysqli->prepare("SELECT description, title, room, first_name, last_name, emergency, status FROM Tickets, Users WHERE ticket_id = ? AND Users.login = Tickets.user_login");
    $stmt1->bind_param("i", $ticket_id);
    $stmt1->execute();
    $stmt1->bind_result($description, $title, $room, $first_name, $last_name, $emergency, $status);
    $stmt1->fetch();
    $data = array($description, $title, $room, $first_name, $last_name, "", "", $emergency, $status, "");
    $stmt1->close();

    //on regarde si le ticket a déja un technicien d'attribué
    if ($data[8] == 'in_progress'){
        $stmt3 = $mysqli->prepare("SELECT tech_login, first_name, last_name FROM Interventions, Users WHERE ticket_id = ? AND login = tech_login");
        $stmt3->bind_param("i", $ticket_id);
        $stmt3->execute();
        $stmt3->bind_result($tech_login, $first_name, $last_name);
        $stmt3->fetch();
        if (!is_null($tech_login)){
            $data[5] = $first_name;
            $data[6] = $last_name;
            $data[9] = $tech_login;
        }
        $stmt3->close();
    }

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
    $mysqli->close();

    $formValue_fr = array('Libellé', 'Salle', 'Demandeur', 'Technicien', 'Niveau d\'urgence', 'État', 'Nouveau libellé', 'Niveau d\'urgence', 'Nouvel état', 'Affecter un technicien', 'Effacer', 'Modifier');
    $formValue_en = array('Title', 'Room', 'User', 'Technician', 'Emergency level', 'Status', 'New title', 'Emergency level', 'New status', 'Assign a technician', 'Reset', 'Edit');
    $formValue = array('fr' => $formValue_fr, 'en' => $formValue_en);
    $otherValue = array('fr' => 'Autre', 'en' => 'Other');
    $status_fr = array('Ouvert', 'En&nbsp;cours', 'Fermé');
    $status_en = array('Open', 'In&nbsp;progress', 'Closed');
    $status = array('fr' => $status_fr, 'en' => $status_en);

    echo '
    <div id="form_modification_ticket">
        <div id="texte_explicatif_info_actuel">
            <textarea id="description_prbl_modification_page" name="description_probleme" rows="10" cols="20" readonly>'.$data[0].'</textarea>
            <div id="form_valeur_actuelle_valeur_a_modifier">
                <div id="modification_ticket_valeur_actuelle">
                    <div id="modification_ticket_libelle_salle">
                        <div id="modification_ticket_libelle">
                            <label for="ticket_libelle">'.$formValue[$lang][0].'</label>
                            <input type="text" id="ticket_libelle" name="ticket_libelle" value="'.htmlentities($data[1]).'" readonly/>
                        </div>
                        <div id="modification_ticket_salle">
                            <label for="ticket_salle">'.$formValue[$lang][1].'</label>';
                            if ($data[2] == "other")
                                echo '<input type="text" id="ticket_salle" name="ticket_salle" value='.$otherValue[$lang].' readonly/>';
                            else
                                echo '<input type="text" id="ticket_salle" name="ticket_salle" value="'.htmlentities($data[2]).'" readonly/>';
                        echo '</div>
                    </div>
                    <div id="modification_ticket_demandeur_technicien">
                        <div id="modification_ticket_demandeur">
                            <label for="ticket_demandeur">'.$formValue[$lang][2].'</label>
                            <input type="text" id="ticket_demandeur" name="ticket_demandeur" value="'.htmlentities($data[3]).' '.htmlentities($data[4]).'" readonly/>
                        </div>
                        <div id="modification_ticket_technicien">
                            <label for="ticket_technicien">'.$formValue[$lang][3].'</label>';
                            if ($data[5] == "" && $data[6] == ""){
                                echo '<input type="text" id="ticket_technicien" name="ticket_technicien" value="'.htmlentities($data[5]).'" disabled/>';
                            }
                            else 
                                echo '<input type="text" id="ticket_technicien" name="ticket_technicien" value="'.htmlentities($data[5]).' '.htmlentities($data[6]).'" readonly/>';
                        echo '
                        </div>
                    </div>
                    <div id="modification_ticket_niveauUrgence_etat">
                        <div id="modification_ticket_niveauUrgence">
                            <label for="ticket_niveauUrgence">'.$formValue[$lang][4].'</label>
                            <input type="text" class="ticket_case_'.htmlentities($data[7]).'" id="ticket_niveauUrgence" name="ticket_niveauUrgence" value="'.htmlentities($data[7]).'" readonly/>
                        </div>
                        <div id="modification_ticket_etat">
                            <label for="ticket_etat">'.$formValue[$lang][5].'</label>';
                            switch ($data[8]){
                                case 'open':
                                    echo '<input type="text" class="ticket_case_open" id="ticket_etat" name="ticket_etat" value='.$status[$lang][0].' readonly/>';
                                    break;
                                case 'in_progress':
                                    echo '<input type="text" class="ticket_case_in_progress" id="ticket_etat" name="ticket_etat" value='.$status[$lang][1].' readonly/>';
                                    break;
                                case 'closed':
                                    echo '<input type="text" class="ticket_case_closed" id="ticket_etat" name="ticket_etat" value='.$status[$lang][2].' readonly/>';
                                    break;
                            }
                        echo '</div>
                    </div>
                </div>
                <form id="modification_ticket_valeur_a_modifier" action="action_ticket.php" method="post">
                    <div class="modif_form_input">
                        <label for="new_libelle">'.$formValue[$lang][6].'&nbsp:</label>
                        <input type="text" id="new_libelle" name="new_libelle"/>
                    </div>
                    <div class="modif_form_input">
                        <label for="new_emergency">'.$formValue[$lang][7].'&nbsp:</label>
                        <input type="number" id="new_emergency" max="4" min="1" name="new_emergency"/>
                    </div>
                    <div class="modif_form_input">
                        <label for="new_status">'.$formValue[$lang][8].'&nbsp:</label>
                        <select id="new_status" name="new_status" onchange="changeTechForStatus()">
                            <option value="Vide"></option>
                            <option value="open">Ouvert</option>
                            <option value="in_progress">En cours</option>
                            <option value="closed">Résolu</option>
                        </select>
                    </div>
                    <div class="modif_form_input">
                        <label for="new_tech">'.$formValue[$lang][9].'&nbsp:</label>
                        <select id="new_tech" name="new_tech">';
                            echo '<option value="Vide" id="tech_vide"></option>';
                            foreach($techniciens as $tech){
                                echo '<option value="'.htmlentities($tech[0]).'">'.htmlentities($tech[1]).' '.htmlentities($tech[2]).'</option>';
                            }
                            echo '
                            <!-- Afficher la liste de tous les techniciens, valeur = login, affichage = prénom + nom -->
                        </select>
                    </div>
                </div>
            </div>
            <div class="resetSubmitButtons">
                <input type="reset" value='.$formValue[$lang][10].' id="reset_modification_ticket" name="reset_modification_ticket" class="reset_buttons" onclick="resetForm()"/>
                <input type="submit" value='.$formValue[$lang][11].' id="edit_ticket" name="edit_ticket"  class="submit_buttons"/>
                <input name="ticket_id" type="hidden" value="'.htmlentities($ticket_id).'"/>
                <input name="previous_libelle" type="hidden" value="'.htmlentities($data[1]).'"/>
                <input name="previous_emergency" type="hidden" value="'.htmlentities($data[7]).'"/>
                <input name="previous_status" type="hidden" value="'.htmlentities($data[8]).'"/>
                <input name="previous_tech" type="hidden" value="'.htmlentities($data[9]).'"/>
            </div>
        </div>
    </form>
</main>';
    include "footer.php";
?>
</body>
</html>
