<?php
    $tab = array('fr' => 'Gestion utilisateurs', 'en' => 'Users management');

    include "header.php";
    if (!isset($_SESSION['login'])){
        header('Location: connection.php');
    }
    else if ($_SESSION['role'] != 'web_admin'){
        header('Location: index.php');
    }

    $success_fr = array('Mot de passe modifié', 'Le compte a bien été supprimé');
    $success_en = array('Password successfully changed', 'Account successfully deleted');
    $success = array('fr' => $success_fr, 'en' => $success_en);

    if (isset($_GET['success'])){
        switch ($_GET['success']){
            case 1 : echo '<div class="success"><p>'.$success[$lang][0].'</p></div>';
                break;
            case 2 : echo '<div class="success"><p>'.$success[$lang][1].'</p></div>';
                break;
        }
    }

    $infoTop = array('fr' => 'Liste des utilisateurs', 'en' => 'Users list');

    echo '<main>
        <div id="part_top">
            <h2>'.$infoTop[$lang].'</h2>
        </div>';

    $header_fr = array('Rôle', 'Login', 'Nom', 'Prénom', 'Nouveau mot de passe');
    $header_en = array('Role', 'Login', 'Last name', 'First name', 'New password');
    $header = array('fr' => $header_fr, 'en' => $header_en);

    $roles_fr = array('web_admin' => 'Admin web', 'user' => 'Utilisateur', 'tech' => 'Technicien', 'sys_admin' => 'Admin système');
    $roles_en = array('web_admin' => 'Web admin', 'user' => 'User', 'tech' => 'Technician', 'sys_admin' => 'System admin');
    $roles = array('fr' => $roles_fr, 'en' => $roles_en);

    $mysqli = new mysqli($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_passwd'], $GLOBALS['db_name']) or die('Impossible de se connecter à la base de données');

    $stmt = $mysqli->prepare('SELECT role, login, last_name, first_name FROM Users WHERE login NOT LIKE "rmv-%" AND role NOT LIKE "%_admin"');
    $stmt->execute();
    
    $data = $stmt->get_result();
    $data = mysqli_fetch_all($data);
    
    $stmt->close();
    $mysqli->close();

    $form_fr = array('Supprimer&nbsp;le&nbsp;compte', 'Modifier&nbsp;le&nbsp;mot&nbsp;de&nbsp;passe', '32&nbsp;caractères&nbsp;max', 'Nouveau&nbsp;mot&nbsp;de&nbsp;passe');
    $form_en = array('Delete&nbsp;account', 'Change&nbsp;password', 'Max&nbsp;32&nbsp;characters', 'New&nbsp;password');
    $form = array('fr' => $form_fr, 'en' => $form_en);

    echo '<div id="ticket_table">
        <table>';

        echo '<tr>';
        foreach ($header[$lang] as $value){
            if ($value == 'Rôle' || $value == 'Role')
                echo '<th class=short_cell>'.$value.'</th>';
            else if ($value == 'Nouveau mot de passe' || $value == 'New password'){
                echo '<td></td><th>'.$value.'</th>';
            }
            else
                echo '<th>'.$value.'</th>';
        }
        echo '</tr>';

        foreach ($data as $row) {
            echo '<tr class="fond_hover" id='.$row[1].'>';
            for ($i = 0; $i < count($row); $i++){
                if ($i == 0)
                    echo '<td>'.$roles[$lang][$row[$i]].'</td>';

                else
                    echo '<td>'.$row[$i].'</td>';
            }
            echo '<form action="account.php" method="post" id=form_'.$row[1].' type="hidden">
                    <input type="hidden" name="sup_acc" value="true">
                    <input type="hidden" name="login" value="'.$row[1].'">
                </form>
                <td><button class="nice_button" id='.$row[1].' onclick="supAccount(this.id)">'.$form[$lang][0].'</button></td>';
            echo '<td>
                <form method="post" action="account.php" class="change_passwd_form">
                    <input type="hidden" name="login" value="'.$row[1].'">
                    <label class="hidden_label" for="input'.$row[1].'">'.$form[$lang][3].'</label>
                    <input type="password" name="new_pwd" id="input'.$row[1].'" placeholder='.$form[$lang][2].'>
                    <input class="submit_buttons" type="submit" name="update_acc" value='.$form[$lang][1].'>
                </form>
            </td>';
            echo '</tr>';
        }

        echo '</table>
        </div>';

    echo '</main>';
        include "footer.php";
?>
</body>
</html>