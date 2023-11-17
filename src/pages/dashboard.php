<?php
    include "header.php";

    if(!isset($_POST['login'])){  # if(!isset($_SESSION['login'])){
        # header("Location: index.php?erreur=1");
    }

    $login = "ticket_app"; # $user = $_SESSION['login']
    $host = "localhost";
    $mdp = "ticket_s301";
    $nom_db = "ticket_app";

    /*
    $db = mysqli_connect($host, $login, $mdp) or die("Can't connect to database");

    mysqli_select_db($db, $nom_db) or die("Can't open the database");
    */

    echo '
        <div id="part_top">
        <h2>Mes tickets</h2>    
            <button type="button" onclick="location.href=\'ticket.php\'">Créer un ticket</button>
        </div>
    ';


    echo '
        <div id="ticket_table">
        <table>
        <tr>
    ';

    /*
    ### Partie pour ajouter les colonnes au tableau ###

    $requete_colonnes = 'SHOW COLUMNS
                         FROM tickets;';

    $colonnes = mysqli_query($db, $requete_colonnes);

    $colonnes_voulues = array('emergency', 'room', 'title', 'creation_date', 'status');

    for (mysqli_fetch_array($colonnes) as $colonne){
        if ($colonne in $colonnes_voulues)
            echo '<th>$colonne</th>';
    '
    }

    echo '</tr>';

    ### Partie pour ajouter les tickets au tableau ###

    $requete_tickets = 'SELECT emergency, room, title, creation_date, status
                        FROM tickets
                        WHERE user_login = $login;';

    # ATTENTION $login ci-dessus devra être remplacé par les cookies de session

    $tickets = mysqli_query($db, $requete_tickets);

    foreach (mysqli_fetch_array($tickets) as $elem){
        echo '
        <tr>
            <td>$elem[0]</td>
            <td>$elem[1]</td>
            <td>$elem[2]</td>
            <td>$elem[3]</td>
            <td>$elem[4]</td>
        </tr>
        ';
    }
    */

    echo '
        </table>
        <div id="details_button">
    ';

    /*
    $requete_nb_tickets = 'SELECT COUNT(ticket_id)
                           FROM tickets
                           WHERE user_login = $login;';

    $nb_tickets = mysqli_query($db, $requete_nb_tickets);

    for (int i=0; i<$nb_tickets; i++){
            echo '<button type="button" onclick="location.href=\'ticket_details.php\'">Détails</button>';
    }
    */
    echo'
        </div>
        </div>
    ';

    include "footer.php";
?>
