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
        <table id="tickets_logs">
    ';

    echo '
        </table>
    ';


    echo '
            <table id="fail_connections_logs">
        ';

    echo '
            </table>
        ';


    echo '
            <table id="closed_tickets_logs">
        ';

    echo '
            </table>
        ';

    include "footer.php";
?>