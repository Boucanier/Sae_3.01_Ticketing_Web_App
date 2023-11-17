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
    <form id="form_modification_ticket" action="" method="get">
        <div id="texte_explicatif_info_actuel">
            <textarea id="description_prbl_modification_page" name="description du probleme" rows="10" cols="20" readonly>Voici un problème tres particulier pour lequel je n'ai pas de réponse</textarea>
            <div id="form_valeur_actuelle_valeur_a_modifier">
                <div id="modification_ticket_valeur_actuelle">
                    <div id="modification_ticket_libelle_salle">
                        <div id="modification_ticket_libelle">
                            <label for="ticket_libelle">Libellé</label>
                            <input type="text" id="ticket_libelle" name="ticket_libelle" value="un libellé" readonly/>
                        </div>
                        <div id="modification_ticket_salle">
                            <label for="ticket_salle">Salle</label>
                            <input type="text" id="ticket_salle" name="ticket_salle" value="G23" readonly/>
                        </div>
                    </div>
                    <div id="modification_ticket_demandeur_technicien">
                        <div id="modification_ticket_demandeur">
                            <label for="ticket_demandeur">Demandeur</label>
                            <input type="text" id="ticket_demandeur" name="ticket_demandeur" value="Thomasse" readonly/>
                        </div>
                        <div id="modification_ticket_technicien">
                            <label for="ticket_technicien">Technicien</label>
                            <input type="text" id="ticket_technicien" name="ticket_technicien" value="JJ le sang" readonly/>
                        </div>
                    </div>
                    <div id="modification_ticket_niveauUrgence_etat">
                        <div id="modification_ticket_niveauUrgence">
                            <label for="ticket_niveauUrgence">Niveau d'urgence</label>
                            <input type="text" id="ticket_niveauUrgence" name="ticket_niveauUrgence" value="3" readonly/>
                        </div>
                        <div id="modification_ticket_etat">
                            <label for="ticket_etat">État</label>
                            <input type="text" id="ticket_etat" name="ticket_etat" value="En cours" readonly/>
                        </div>
                    </div>
                </div>
                <div id="modification_ticket_valeur_a_modifier">
                    <div>
                        <label for="new_libelle">Nouveau libellé&nbsp:</label>
                        <input type="text" id="new_libelle" name="new_libelle"/>
                    </div>
                    <div>
                        <label for="new_emergency">Niveau d'urgence&nbsp:</label>
                        <input type="text" id="new_emergency" name="new_emergency"/>
                    </div>
                    <div>
                        <label for="new_etat">Nouvel état&nbsp:</label>
                        <input type="text" id="new_etat" name="new_etat"/>
                    </div>
                    <div>
                        <label for="new_technicien">Affecter un technicien&nbsp:</label>
                        <input type="text" id="new_technicien" name="new_technicien"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="resetSubmitButtons">
            <input type="reset" id="reset_modification_ticket" name="reset_modification_ticket" class="reset_buttons"/>
            <input type="submit" id="modifier_ticket" name="modifier_ticket"  class="submit_buttons"/>
        </div>
    </form>
</main>
<?php
    include "footer.php";
?>
</body>
</html>
