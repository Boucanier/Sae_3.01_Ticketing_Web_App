<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
<?php
    include "header.php";

    if (isset($_GET['success']) && $_GET['success'] == 1){
        echo '<div class="success"><p>Votre compte a bien été supprimé</p></div>';
    }
?>
<main id="main_page">
    <div id="presentation">
        <div id="texte_explicatif">
            <h2>Texte explicatif</h2>
            <p>
                Bonjour et bienvenue sur notre application de ticketing, nous allons ici vous la présenter.
            </p>
            <p>
                Cette application est un site de ticketing avec sa base de données.
                C'est-à-dire que les utilisateurs créent des tickets dans lesquels ils énoncent le problème rencontré.
                Ces tickets contiennent un titre descriptif du problème, la description de celui-ci, un niveau d'urgence, la salle du problème, la date de création d'un ticket.
                Une fois créé, le ticket sera pris en charge par un technicien pour être résolu.
                Pour pouvoir créer un ticket, il vous faut vous connecter à votre compte ou en créer un si vous n'en possédez pas.
                Il faut pour cela cliquer sur le bouton à droite sur la barre de navigation et remplir le formulaire correspondant.
                Ensuite vous accédez à votre tableau de bord (accessible depuis la barre de navigation).
                De là, vous pourrez voir les différents tickets que vous avez créés. Il y a un bouton pour pouvoir créer un ticket.
            </p>
            <p>
            Vous avez à droite une vidéo de présentation du site.
            </p>
            <p>
                Vous avez ci-dessous les dix derniers tickets créés.
            </p>
        </div>
        <div id="video_explicative">
            <h2>Vidéo explicative</h2>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ?si=QOroqZ7wXyNrZZh8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
    </div>

    <table id="derniers_tickets">
        <tr>
            <th>Niveau</th>
            <th>Salle</th>
            <th>Problème</th>
            <th>Demandeur</th>
            <th>Date</th>
            <th>État</th>
        </tr>

<?php
    $mysqli = new mysqli($host, $user, $passwd, $db);
    $stmt = $mysqli->prepare("SELECT emergency, room, title, first_name, last_name, DATE_FORMAT(creation_date,'%d/%m/%Y'), status FROM Tickets, Users
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
        echo '<tr>';
        for ($j=0; $j < 7; $j++){
            if ($j == 0){
                echo '<td class="ticket_case_'.htmlentities($row[$j]).'">'.htmlentities($row[$j]).'</td>';
            }
            else if ($j == 1 && $row[$j] == 'other'){
                echo '<td>Autre</td>';
            }
            else if ($j == 3){
                echo '<td>'.htmlentities($row[$j]).' '.htmlentities($row[$j+1]).'</td>';
                $j++;
            }
            else if ($j == 6){
                switch ($row[$j]){
                    case 'open':
                        echo '<td>Ouvert</td>';
                        break;
                    case 'in_progress':
                        echo '<td>En cours</td>';
                        break;
                    case 'closed':
                        echo '<td>Fermé</td>';
                        break;
                    default:
                        echo '<td>Inconnu</td>';
                }
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

</main>
</body>
<?php
    include "footer.php";
?>
</html>
