<?php
require_once "fonction.php";
head('Connexion | YunaHotel');
if (isConnected()) {
    header("location:dashboard.php");
} else {
    ?>
    <body class="background" id="index">
    <div class="container-fluid white_color">
        <?php
        if (isset($_GET['not_found'])) {
            displayError("Mot de passe ou E-mail incorrect . Merci de réessayer");

        } else if (isset($_GET["empty_field"])) {
            displayError("Veuillez remplir tout les champs");
        }
        ?>

        <div class="block_center form_connexion align_center">
            <h1>Yuna Hotel</h1>
            <form method="post" action="login.php">
                <div class="content_input">
                    <label for="mail" class="mail_label">Mail :</label>
                    <input type="email" id="mail" name="mail" placeholder="E-mail" class="ipt">
                </div>
                <div class="content_input">
                    <label for="mdp" class="mdp_img">Mot de passe</label>
                    <input type="password" id="mdp" name="mdp" placeholder="Mot de passe" class="ipt">
                </div>
                <input type="submit" value="Connexion">
                <a href="forgotmdp.php" class="link_white">Mot de passe oublié</a>
            </form>
        </div>
    </div>
    </body>
    <script src="js/jquery.js"></script>
    <script src="js/script.js"></script>

    <?php
}
footer();
?>