<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion techniciens</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>

<body>
<?php
    include "header.php";
    if (!isset($_SESSION['login'])){
        header('Location: connection.php');
    }
    else if ($_SESSION['role'] != 'web_admin'){
        header('Location: dashboard.php');
    }
?>

<main>
    <div class="form_containers">
        <div class="tech_view">
            <h2>Liste des techniciens</h2>
            <div id="scroll_table">
                <table id="tech_table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th class="short_cell">Tickets en cours</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $mysqli = new mysqli($host, $user, $passwd, $db);
                            $stmt = $mysqli->prepare("SELECT last_name, first_name, login FROM Users WHERE role = 'tech' AND login NOT LIKE 'rmv-%'");
                            $stmt->execute();
                            $data = $stmt->get_result();
                            $data = mysqli_fetch_all($data);
                            
                            foreach ($data as $row) {
                                $stmt = $mysqli->prepare("SELECT COUNT(*) FROM Interventions, Tickets
                                                            WHERE tech_login = ?
                                                            AND Tickets.ticket_id = Interventions.ticket_id
                                                            AND status = 'in_progress'");
                                                            
                                $stmt->bind_param("s", $row[2]);
                                $stmt->execute();
                                $row[2] = $stmt->get_result()->fetch_row()[0];
                                $stmt->close();

                                echo '<tr>';
                                for ($i = 0; $i < count($row); $i++) {
                                    echo '<td>' . htmlentities($row[$i]) . '</td>';
                                }
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="sign_up">
            <h2>Ajouter un technicien</h2>
            <?php
                if (isset($_GET['error'])){
                    switch ($_GET['error']){
                        case 11:
                            echo '<div class="error"><p>Login invalide</p></div>';
                            break;
                        case 12:
                            echo '<div class="error"><p>Les mots de passe ne correspondent pas</p></div>';
                            break;
                        case 13:
                            echo '<div class="error"><p>Formulaire incomplet</p></div>';
                            break;
                    }
                }
            ?>
            <form action="account.php" method="get">
                <div class="user_info">
                    <div class="form_group">
                        <label for="login">Login&nbsp;:</label>
                        <input type="text" id="login" name="login"/>
                    </div>
                    <br>
                    <div class="form_group">
                        <label for="name">Nom&nbsp;:</label>
                        <input type="text" id="name" name="name"/>
                    </div>
                    <br>
                    <div class="form_group">
                        <label for="f_name">Prénom&nbsp;:</label>
                        <input type="text" id="f_name" name="f_name"/>
                    </div>
                    <br>
                    <div class="form_group">
                        <label for="pwd">Mot de passe&nbsp;:</label>
                        <input type="password" id="pwd" name="pwd"/>
                    </div>
                    <input type="hidden" name="role" value="tech"/>
                    <br>
                    <div class="form_group">
                        <label for="conf_pwd">Confirmer le mot de passe&nbsp;:</label>
                        <input type="password" id="conf_pwd" name="conf_pwd"/>
                    </div>
                    <br>
                </div>
                <br>
                <div class="resetSubmitButtons">
                    <input type="reset" value="Effacer" class="reset_buttons">
                    <input type="submit" value="Créer" class="submit_buttons" name="create_acc">
                </div>
            </form>
        </div>
    </div>
</main>
<?php
    include "footer.php";
?>
</body>
</html>
