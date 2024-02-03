<?php
    $tab = array('fr' => 'Accueil', 'en' => 'Home');
    include "header.php";

    $success = array('fr' => 'Votre compte a bien été supprimé', 'en' => 'Your account has been successfully deleted');

    if (isset($_GET['success']) && $_GET['success'] == 1){
        echo '<div class="success"><p>'.$success[$lang].'</p></div>';
    }

    $pres_fr = 'Cette application est un site de ticketing avec sa base de données.
    C\'est-à-dire que les utilisateurs créent des tickets dans lesquels ils énoncent le problème rencontré.
    Ces tickets contiennent un titre descriptif du problème, la description de celui-ci, un niveau d\'urgence, la salle du problème, la date de création d\'un ticket.
    Une fois créé, le ticket sera pris en charge par un technicien pour être clos.
    Pour pouvoir créer un ticket, il vous faut vous connecter à votre compte ou en créer un si vous n\'en possédez pas.
    Il faut pour cela cliquer sur le bouton à droite sur la barre de navigation et remplir le formulaire correspondant.
    Ensuite vous accédez à votre tableau de bord (accessible depuis la barre de navigation).
    De là, vous pourrez voir les différents tickets que vous avez créés. Il y a un bouton pour pouvoir créer un ticket.';

    $pres_en = 'This application is a ticketing site with its own database.
    This means that users create tickets in which they state the problem encountered.
    These tickets contain a descriptive title, a description of the problem, an urgency level, the problem room, and the date the ticket was created.
    Once a ticket has been created, it will be passed on to a technician for resolution.
    To create a ticket, you need to log in to your account, or create one if you don\'t have one.
    To do this, click on the button on the right of the navigation bar and fill in the corresponding form.
    You\'ll then be taken to your dashboard (accessible from the navigation bar).
    From here, you can view the various tickets you\'ve created. There\'s a button to create a ticket.';

    $pres = array('fr' => $pres_fr, 'en' => $pres_en);

    $text = array('fr' => 'Présentation', 'en' => 'Presentation');

    $welcome = array('fr' => 'Bienvenue sur notre application de ticketing, voici une brève présentation de celle-ci.', 'en' => 'Welcome to our ticketing application, here\'s a brief presentation of it.');
    $videoText = array('fr' => 'Vous avez à droite une vidéo de présentation du site', 'en' => 'You have a presentation video of the site on the right');
    $video = array('fr' => 'Vidéo de présentation', 'en' => 'Presentation video');
    $ticketText = array('fr' => 'Dix derniers tickets créés', 'en' => 'Last ten tickets created');

echo '<main id="main_page">
    <div id="presentation">
        <div id="texte_explicatif">
            <h2>'.$text[$lang].'</h2>
            <p>
                '.$welcome[$lang].'
            </p>
            <p>
                '.$pres[$lang].'
            </p>
            <p>
                '.$videoText[$lang].'
            </p>
        </div>
        <div id="video_explicative">
            <h2>'.$video[$lang].'</h2>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/xc1-O-0Q6Vs?si=qdxRL89HsM77pPEt" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
    </div>
    <HR id="hr_index">
    <div id="titre_tab">
        <table id="derniers_tickets">';
        echo "<h2>$ticketText[$lang]</h2>";

        $header_en = array('Level', 'Room', 'Title', 'User', 'Date', 'Status');
        $header_fr = array('Niveau', 'Salle', 'Problème', 'Demandeur', 'Date', 'État');
        $header = array('fr' => $header_fr, 'en' => $header_en);

        echo '<tr>';
        foreach ($header[$lang] as $value){
            echo '<th>'.$value.'</th>';
        }
        echo '</tr>';
        $mysqli = new mysqli(HOST_DB, USER_DB, PASSWD_DB, DB) or die ("Impossible de se connecter à la base de données");
        $stmt = $mysqli->prepare("SELECT emergency, room, title, first_name, last_name, DATE_FORMAT(creation_date,'%Y/%m/%d'), status FROM Tickets, Users
                                    WHERE Users.login = Tickets.user_login
                                    AND Users.login NOT LIKE 'rmv-%'
                                    ORDER BY creation_date DESC, ticket_id DESC");
        $stmt->execute();
        $data = $stmt->get_result();
        $long = mysqli_num_rows($data);

        if ($long > 10){
            $long = 10;
        }
        for ($i=0; $i < $long; $i++){
            $row = mysqli_fetch_array($data);
            echo '<tr class="fond_hover">';

            $status_fr = array('open' => 'Ouvert', 'in_progress' => 'En cours', 'closed' => 'Clos');
            $status_en = array('open' => 'Open', 'in_progress' => 'In progress', 'closed' => 'Closed');
            $status = array('fr' => $status_fr, 'en' => $status_en);

            for ($j=0; $j < 7; $j++){
                if ($j == 0){
                    echo '<td class="ticket_case_'.htmlentities($row[$j]).'">'.htmlentities($row[$j]).'</td>';
                }
                else if ($j == 1 && $row[$j] == 'other'){
                    switch ($lang) {
                        case 'fr':
                            echo '<td>Autre</td>';
                            break;
                        case 'en':
                            echo '<td>Other</td>';
                            break;
                    }
                }
                else if ($j == 3){
                    echo '<td>'.htmlentities($row[$j]).' '.htmlentities($row[$j+1]).'</td>';
                    $j++;
                }
                elseif ($j == 5){
                    echo '<td>' .htmlentities(afficherDifferenceDate($row[$j])). '</td>';
                }
                else if ($j == 6){
                    echo '<td>'.$status[$lang][$row[$j]].'</td>';
                }
                else
                    echo '<td>'.htmlentities($row[$j]).'</td>';
            }
            echo '</tr>';
        }

        $stmt->close();
        $mysqli->close();
        ?>
        </table>
</div>

</main>
</body>
<?php
    include "footer.php";
?>
</html>
