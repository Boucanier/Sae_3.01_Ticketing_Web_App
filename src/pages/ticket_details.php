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
    
    if (isset($_GET['id']) && !empty($_GET['id'])){
        $ticket_id = $_GET['id'];
    }

    else {
        header('Location: dashboard.php');
    }

    # TODO: Remplacer ce tableau par une requête SQL
    # TODO: Vérifier que l'utilisateur actuel est bien le demandeur du ticket si c'est un user
    $data = array('jj/mm/aaaa',
            'Bacon ipsum dolor amet shoulder short ribs burgdoggen, picanha pancetta chicken pastrami t-bone cow beef buffalo landjaeger. Meatball boudin tenderloin pork belly, chuck pork bacon. Ham hock t-bone bacon turkey. Chislic picanha buffalo, bresaola prosciutto venison tail pig porchetta spare ribs kielbasa short loin beef ribs capicola. Shoulder tail pastrami ground round brisket tri-tip burgdoggen kevin short loin jowl alcatra.',
            'Libellé',
            'G24',
            '3',
            'in_progress');

    echo '<div id="part_top">
        <h2>Ticket du '.$data[0].'</h2>
    </div>
    <form id="ticket_about">
        <div id="ticket_description">
            <h3>Description du problème</h3>
            <p>'.$data[1].'</p>
        </div>
        <div id="ticket_details">
            <p>'.$data[2].'</p>
            <p>Salle : '.$data[3].'</p>
            <p>Niveau d\'urgence : '.$data[4].'</p>';

            switch ($data[5]){
                case 'open':
                    echo '<p>État : Ouvert</p>';
                    break;
                case 'in_progress':
                    echo '<p>État : En cours</p>';
                    break;
                case 'closed':
                    echo '<p>État : Fermé</p>';
                    break;
                default:
                    echo '<p>État : Inconnu</p>';
            }

            echo '<br>
            <div class="resetSubmitButtons">
                <input type="button" value="Annuler" class="reset_buttons" onclick="history.back();">';

                    # TODO: Faire une requête pour vérifier l'état du ticket afin de vérifier que la fonction est la bonne
                    if ($_GET['function'] == 'take'){
                        echo '<input type="submit" value="Prendre en charge" name="take" class="submit_buttons">';
                    }
                    
                    else if ($_GET['function'] == 'close'){
                        echo '<input type="submit" value="Clore" name="close" class="submit_buttons">';
                    }
                ?>
            </div>
        </div>
    </form>
</main>
<?php
    include "footer.php";
?>
</body>
</html>
