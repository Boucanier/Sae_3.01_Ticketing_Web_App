<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ticket</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>
<body>
<header>
    <div id="top">
        <img src="../resources/logo.png" alt="logo de la plateforme" id="image1">
        <h1>Ticket App</h1>
        <img src="../resources/logo_UVSQ.png" alt="logo de l'UVSQ" id="image2">
    </div>
    <nav>
        <div id="nav1">
            <a href="index.php">Accueil</a>
            <a href="dashboard.php">Tableau de bord</a>
        </div>
        <div id="nav2">
            <a href="profile.php">Profil</a>
            <a href="connection.php">Se connecter</a>
            <a href="index.php">Déconnexion</a>
        </div>
    </nav>
</header>
<main>
    <?php
    # TODO: Remplacer ce tableau par une requête SQL
    $data = array(
        "Voici un problème tres particulier pour lequel je n'ai pas de réponse",
        "Probleme avec le projecteur",
        "G23",
        "UnRandom",
        "JJ Le sang",
        4,
        "En cours"
    );

    # TODO: Remplacer ce tableau par une requête SQL
    # liste de tout les techniciens
    $techniciens = array(
        array("tech1", "Jean", "Dujardin"),
        array("tech2", "Matis", "Rod"),
        array("tech3", "Jules", "Chi"),
        array("tech4", "Thomas", "God"),
        array("tech5", "Couscous", "Merguez"),
    );

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
                            <label for="ticket_technicien">Technicien</label>
                            <input type="text" id="ticket_technicien" name="ticket_technicien" value="'.$data[4].'" readonly/>
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
                <form id="modification_ticket_valeur_a_modifier" action="" method="get">
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
                        <select id="new_status" name="new_status">
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
                            echo '<option value="Vide"></option>';
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
                        <input type="reset" value="Effacer" id="reset_modification_ticket" name="reset_modification_ticket" class="reset_buttons"/>
                        <input type="submit" value="Modifier" id="modifier_ticket" name="modifier_ticket"  class="submit_buttons"/>
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
