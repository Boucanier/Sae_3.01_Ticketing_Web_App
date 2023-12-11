<?php
    $tab = array('fr' => 'Contact', 'en' => 'Contact');
    
    include "header.php";
    $mail = array('fr' => 'Si vous souhaitez nous contacter, cliquez sur ce <a href="mailto:?to=contact.golemcorp@gmail.com" target="_blank" class="link_on_page">lien</a>.',
        'en' => 'If you want to contact us, please click on this <a href="mailto:?to=contact.golemcorp@gmail.com" target="_blank" class="link_on_page">link</a>.');

    $project = array('fr' => 'Voici notre <a href="https://github.com/Boucanier/Sae_3.01_Ticketing_Web_App" target="_blank" class="link_on_page">lien GitHub</a> pour ce projet.',
        'en' => 'Here is our <a href="https://github.com/Boucanier/Sae_3.01_Ticketing_Web_App" target="_blank" class="link_on_page">Github link</a> for this project');
?>
<main>
    <div id="contact_containers">
        <div class="contact_text">
            <?php
                echo $mail[$lang];
            ?>
        </div>
        <br>
        <div class="contact_text">
            <?php
                echo $project[$lang];
            ?>
        </div>
    </div>
</main>
<?php
    include "footer.php";
?>
</body>
</html>
