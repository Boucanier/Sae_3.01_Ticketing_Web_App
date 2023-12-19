<?php
    $tab = array('fr' => 'Gestion techniciens', 'en' => 'Technicians management');
    
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
            <?php
                $infoTop = array('fr' => 'Liste des techniciens', 'en' => 'Technicians list');
                echo'<h2>'.$infoTop[$lang].'</h2>
                <div id="scroll_table">
                    <table id="tech_table">
                        <thead>';
                            $header_fr = array('Nom', 'Prénom', 'Tickets en cours');
                            $header_en = array('Last name', 'First name', 'Tickets in progress');
                            $header = array('fr' => $header_fr, 'en' => $header_en);

                            echo '<tr>';
                            echo '<th>' . $header[$lang][0] . '</th>';
                            echo '<th>' . $header[$lang][1] . '</th>';
                            echo '<th class="short_cell">' . $header[$lang][2] . '</th>';
                            echo '</tr>';
                            echo '</thead>
                                <tbody>';

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

                                echo '<tr id="fond_hover">';
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
            <?php
                $infoTop = array('fr' => 'Ajouter un technicien', 'en' => 'Add a technician');
                echo '<h2>'.$infoTop[$lang].'</h2>';

                $error_fr = array('Login invalide', 'Les mots de passe ne correspondent pas', 'Formulaire incomplet');
                $error_en = array('Invalid login', 'Passwords do not match', 'Incomplete form');
                $error = array('fr' => $error_fr, 'en' => $error_en);
                if (isset($_GET['error'])){
                    switch ($_GET['error']){
                        case 11:
                            echo '<div class="error"><p>'.$error[$lang][0].'</p></div>';
                            break;
                        case 12:
                            echo '<div class="error"><p>'.$error[$lang][1].'</p></div>';
                            break;
                        case 13:
                            echo '<div class="error"><p>'.$error[$lang][2].'</p></div>';
                            break;
                    }
                }

                $formValue_fr = array('Login', 'Nom', 'Prénom', 'Mot de passe', 'Confirmer le mot de passe', 'Effacer', 'Créer');
                $formValue_en = array('Login', 'Last name', 'First name', 'Password', 'Confirm password', 'Reset', 'Create');
                $formValue = array('fr' => $formValue_fr, 'en' => $formValue_en);
                echo '<form action="account.php" method="post">
                <div class="user_info">
                    <div class="form_group">
                        <label for="login">'.$formValue[$lang][0].'&nbsp;:</label>
                        <input type="text" id="login" name="login"/>
                    </div>
                    <br>
                    <div class="form_group">
                        <label for="name">'.$formValue[$lang][1].'&nbsp;:</label>
                        <input type="text" id="name" name="name"/>
                    </div>
                    <br>
                    <div class="form_group">
                        <label for="f_name">'.$formValue[$lang][2].'&nbsp;:</label>
                        <input type="text" id="f_name" name="f_name"/>
                    </div>
                    <br>
                    <div class="form_group">
                        <label for="pwd">'.$formValue[$lang][3].'&nbsp;:</label>
                        <input type="password" id="pwd" name="pwd"/>
                    </div>
                    <input type="hidden" name="role" value="tech"/>
                    <br>
                    <div class="form_group">
                        <label for="conf_pwd">'.$formValue[$lang][4].'&nbsp;:</label>
                        <input type="password" id="conf_pwd" name="conf_pwd"/>
                    </div>
                    <br>
                </div>
                <br>
                <div class="resetSubmitButtons">
                    <input type="reset" value='.$formValue[$lang][5].' class="reset_buttons">
                    <input type="submit" value='.$formValue[$lang][6].' class="submit_buttons" name="create_acc">
                </div>
            </form>
        </div>
    </div>
</main>';
    include "footer.php";
?>
</body>
</html>
