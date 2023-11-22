<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>
<body>
<?php
    include "header.php";
?>
<main id="main_page">
    <div id="presentation">
        <div id="texte_explicatif">
            <h2>Texte explicatif</h2>
            <p>
                Sed (saepe enim redeo ad Scipionem, cuius omnis sermo erat de amicitia) querebatur, quod omnibus in rebus homines diligentiores essent; capras et oves quot quisque haberet, dicere posse, amicos quot haberet, non posse dicere et in illis quidem parandis adhibere curam, in amicis eligendis neglegentis esse nec habere quasi signa quaedam et notas, quibus eos qui ad amicitias essent idonei, iudicarent. Sunt igitur firmi et stabiles et constantes eligendi; cuius generis est magna penuria. Et iudicare difficile est sane nisi expertum; experiendum autem est in ipsa amicitia. Ita praecurrit amicitia iudicium tollitque experiendi potestatem.
                Sed (saepe enim redeo ad Scipionem, cuius omnis sermo erat de amicitia) querebatur, quod omnibus in rebus homines diligentiores essent; capras et oves quot quisque haberet, dicere posse, amicos quot haberet, non posse dicere et in illis quidem parandis adhibere curam, in amicis eligendis neglegentis esse nec habere quasi signa quaedam et notas, quibus eos qui ad amicitias essent idonei, iudicarent. Sunt igitur firmi et stabiles et constantes eligendi; cuius generis est magna penuria. Et iudicare difficile est sane nisi expertum; experiendum autem est in ipsa amicitia. Ita praecurrit amicitia iudicium tollitque experiendi potestatem.
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
        </tr>

<?php
    $mysqli = new mysqli($host, $user, $passwd, $db);
    $stmt = $mysqli->prepare("SELECT emergency, room, title, first_name, last_name, creation_date FROM Tickets, Users
                                WHERE Users.login = Tickets.user_login
                                AND status = 'open'
                                ORDER BY creation_date DESC");
    $stmt->execute();
    $data = $stmt->get_result();
    $long = mysqli_num_rows($data);

    if ($long > 10){
        $long = 10;
    }

    for ($i=0; $i < $long; $i++){
        $row = mysqli_fetch_array($data);
        echo '<tr>';
        for ($j=0; $j < 6; $j++){
            if ($j == 0)
                echo '<td class="ticket_case_'.$row[$j].'">'.$row[$j].'</td>';
            else if ($j == 3){
                echo '<td>'.$row[$j].' '.$row[$j+1].'</td>';
                $j++;
            }
            else
                echo '<td>'.$row[$j].'</td>';
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