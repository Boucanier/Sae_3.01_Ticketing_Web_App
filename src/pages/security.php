<?php
    $tab = array('fr' => 'Sécurité', 'en' => 'Security');
    include 'header.php';

    $infoTop = array('fr' => 'Mise à jour de  la clé de chiffrement', 'en' => 'Cypher key update');

    $formValue_fr = array('Clé actuelle', 'Nouvelle clé', 'Confirmer la nouvelle clé', 'Effacer', 'Mettre&nbsp;à&nbsp;jour');
    $formValue_en = array('Current key', 'New key', 'Confirm new key', 'Reset', 'Update');
    $formValue = array('fr' => $formValue_fr, 'en' => $formValue_en);

    $success = array('fr' => 'La clé de chiffrement a bien été changé', 'en' => 'Cypher key has been updated');
    $error_fr = array('Les deux clés ne correspondent pas', 'Clé incorrecte', 'Clé invalide');
    $error_en = array('Keys do not match', 'Incorrect key', 'Invalid key');
    $error = array('fr' => $error_fr, 'en' => $error_en);

    echo '<main><div id="part_top"><h2>'.$infoTop[$lang].'</h2></div>';

    if (isset($_GET['success']) && $_GET['success'] == 1){
        echo '<div class="success"><p>'.$success[$lang].'</p></div>';
    }

    else if (isset($_GET['error'])){
        switch ($_GET['error']){
            case 1:
                echo '<div class="error"><p>'.$error[$lang][0].'</p></div>';
                break;
            case 2:
                echo '<div class="error"><p>'.$error[$lang][1].'</p></div>';
                break;
            case 3:
                echo '<div class="error"><p>'.$error[$lang][2].'</p></div>';
                break;
        }
    }

    echo '<form action="key.php" method="post" id="key_form">
        <div id="key_change">
            <div id="key_label">
                <label for="old_key">'.$formValue[$lang][0].'&nbsp;:&nbsp;</label>
                <br>
                <label for="new_key">'.$formValue[$lang][1].'&nbsp;:&nbsp;</label>
                <br>
                <label for="conf_key">'.$formValue[$lang][2].'&nbsp;:&nbsp;</label>
                <br>
            </div>
            <div id="key_input">
                <input type="text" id="old_key" name="old_key"/>
                <br>
                <input type="text" name="new_key" id="new_key"/>
                <br>
                <input type="text" id="conf_key" name="conf_key"/>
                <br>
            </div>
        </div>
        <div id="key_buttons">
            <input type="reset" id="key_reset" value='.$formValue[$lang][3].' class="reset_buttons">
            <input type="submit" id="key_sub" value='.$formValue[$lang][4].' name="change_key" class="submit_buttons">
        </div>
    </form>';

    echo '</div></div>';
    include 'footer.php';
?>
</body>
</html>