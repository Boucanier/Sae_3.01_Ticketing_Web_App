<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
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

    <?php
    echo '<table id="derniers_tickets">
            <tr>
                <th>Niveau</th>
                <th>Salle</th>
                <th>Problème</th>
                <th>Demandeur</th>
                <th>Date</th>
            </tr>';

    # TODO: Remplacer ce tableau par une requête SQL
    $data = array(array(4,'G26', 'Fuite d\'eau sur les machines', 'J. Cabessa', '05/10/2023'),
                    array(1,'315','Câble projecteur HS', 'F. Hoguin', '04/10/2023'),
                    array(2, 'I21', 'Multiprise cassée', 'D. Auger', '26/09/2023'));
    
    foreach ($data as $row) {
        echo '<tr>';
        for ($i = 0; $i < count($row); $i++) {
            if ($i == 0) {
                echo '<td class="ticket_case_'.$row[0].'">'.$row[0].'</td>';
            }
            else {
                echo '<td>'.$row[$i].'</td>';
            }
        }
        echo '</tr>';
    }

    echo '</table>';
    ?>
    </table>
</main>
</body>
<?php
    include "footer.php";
?>
</html>