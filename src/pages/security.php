<?php
    $tab = array('fr' => 'Sécurité', 'en' => 'Security');
    include 'header.php';

    $infoTop = array('fr' => 'Mise à jour la clé de chiffrement', 'en' => 'Cypher key update');

    $formValue_fr = array('Clé actuelle', 'Nouvelle clé', 'Confirmer la nouvelle clé', 'Effacer', 'Mettre&nbsp;à&nbsp;jour');
    $formValue_en = array('Current key', 'New key', 'Confirm new key', 'Reset', 'Update');
    $formValue = array('fr' => $formValue_fr, 'en' => $formValue_en);

    echo '<main><div id="part_top"><h2>'.$infoTop[$lang].'</h2></div>';

    echo '<form action="key.php" method="post" id="key_form">
        <div id="key_change">
            <div id="key_label">
                <label for="libelle">'.$formValue[$lang][0].'&nbsp;:&nbsp;</label>
                <br>
                <label for="salle">'.$formValue[$lang][1].'&nbsp;:&nbsp;</label>
                <br>
                <label for="conf_key">'.$formValue[$lang][2].'&nbsp;:&nbsp;</label>
                <br>
            </div>
            <div id="key_input">
                <input type="text" id="libelle" name="libelle"/>
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