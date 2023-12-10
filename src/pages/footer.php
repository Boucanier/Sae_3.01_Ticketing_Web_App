<footer>
    <a href="contact.php">Nous contacter</a>
    <a href="">Changer la langue</a>
    <?php 
        if (isset($_SESSION['font']) && $_SESSION['font'] == "dyslexic"){
            echo '<a href="font_switch.php?font=normal">Passer en police normale</a>';
        }
        else {
            echo '<a href="font_switch.php?font=dyslexic">Passer en police dyslexie</a>';
        }
    ?>
</footer>