<?php
require_once "fonction.php";
head('Mot de passe oublié | YunaHotel');
?>
<body id="forgotmdp_page" class="full_height">
<div class="container-fluid">
    <?php if(isset($_GET['empty_field'])): ?>
        <div class="error">
            <p>Veuillez saisir une adresse mail valide.</p>
        </div>
    <?php endif; ?>
    <?php if(isset($_GET['not_found'])): ?>
        <div class="error">
            <p>E-mail incorrect . Merci de réessayer.</p>
        </div>
    <?php endif; ?>
    <div class="forgotmdp bck_content">
        <h2>Vous avez perdu votre mot de passe ? </h2>
        <div class="white_content">
            <p>
                Entrez votre <span>E-mail</span> de connexion pour recevoir les instructions pour
                le changement de mot de passe.
                <br>
                Un mail va être envoyé sur l'adresse mail saisit.
            </p>
            <form method="post" action="forgotmdp_traitement.php">
                <div class="content_form">
                    <label for="mail">Email</label>
                    <input type="email" id="mail" name="mail" placeholder="E-Mail">
                </div>
                <input type="submit" value="Envoyer">
            </form>
            <p>
                INFO : Vérifier que ce mail n'est pas pris pour Spam par votre mailer.
            </p>
        </div>

    </div>
</div>
</body>
<?php
footer();
?>


