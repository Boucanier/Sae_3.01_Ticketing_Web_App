<footer>
    <?php
        $contact = array('fr' => 'Nous contacter', 'en' => 'Contact us');

        echo '<a href="contact.php">'.$contact[$lang].'</a>';

        $language = array('fr' => 'Switch to english', 'en' => 'Passer en français');

        echo '<a href="footer_switch.php?lang=switch">'.$language[$lang].'</a>';

        if (isset($_SESSION['font']) && $_SESSION['font'] == "dyslexic"){
            $dys_on = array('fr' => 'Passer en police normale', 'en' => 'Change to normal font');
            echo '<a href="footer_switch.php?font=normal">'.$dys_on[$lang].'</a>';
        }
        else {
            $dys_off = array('fr' => 'Passer en police dyslexie', 'en' => 'Change to dyslexic font');
            echo '<a href="footer_switch.php?font=dyslexic">'.$dys_off[$lang].'</a>';
        }
    ?>
</footer>