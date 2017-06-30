<?php
require_once "fonction.php";
head('Changement d\'état | YunaHotel');
if (isConnected()) {
    if (isManager() || isAccueil()) {
        if (isset($_GET['etat'])) {
            $etat = $_GET['etat'];
            ?>
            <script src="js/jquery.js"></script>
            <script src="js/jquery-ui.js"></script>
            <script src="js/script.js"></script>
            <body id="dashboard">
            <div class="container-fluid background_mulitc">
                <header>
                    <p>Une question ? Contacter le <a href="contact.php" target="_blank">Support</a></p>                </header>
                <div class="content full_height">
                    <?php include "aside.php" ?>
                    <section id="changestate">
                        <div id="tabs">
                            <ul>

                                <?php if ($etat != 0): ?>
                                    <li><a href="#tabs-1">Libérer</a></li>
                                <?php endif; ?>

                                <?php if ($etat != 1): ?>
                                    <li><a href="#tabs-2">Occuper</a></li>
                                <?php endif; ?>

                                <?php if ($etat != 2): ?>
                                    <li><a href="#tabs-3">En nettoyage</a></li>
                                <?php endif; ?>

                                <?php if ($etat != 3): ?>
                                    <li><a href="#tabs-4">Indisponible</a></li>
                                <?php endif; ?>

                            </ul>


                            <?php if ($etat != 0): ?>
                                <div id="tabs-1">
                                    <h2>Libérer</h2>
                                    <form method="post" action="form_state.php?state=free">
                                        <p>Voulez-vous vraiment libérer cette chambre ?</p>
                                        <div class="content_libre">
                                            <input type="submit" value="OUI" name="true" class="true">
                                            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>
                            <?php if ($etat != 1): ?>

                                <div id="tabs-2">
                                    <h2>Occupé</h2>
                                    <?php
                                    if(isset($_GET['error'])){
                                        echo '<div class="error_form">Les champs doivent etre remplis</div>';
                                    }
                                    ?>
                                    <form method="post" action="form_state.php?state=occuped">
                                        <div class="content_form">
                                            <label for="nom">Nom</label>
                                            <input type="text" name="nom" id="nom">
                                        </div>
                                        <div class="content_form">
                                            <label for="prenom">Prenom</label>
                                            <input type="text" name="prenom" id="prenom">
                                        </div>
                                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                        <input type="submit" value="Valider">
                                    </form>
                                </div>
                            <?php endif; ?>

                            <?php if ($etat != 2): ?>
                                <div id="tabs-3">
                                    <h2>En nettoyage </h2>
                                    <form method="post" action="form_state.php?state=clear">
                                        <p>Voulez-vous vraiment nettoyer cette chambre ?</p>
                                        <div class="content_libre">
                                            <input type="submit" value="OUI" name="true" class="true">
                                        </div>
                                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                    </form>
                                </div>
                            <?php endif; ?>

                            <?php if ($etat != 3): ?>
                                <div id="tabs-4">
                                    <h2>Indisponible</h2>
                                    <form method="post" action="form_state.php?state=disable">
                                        <div class="content_form">
                                            <label for="message">Motif</label>
                                            <textarea id="message" placeholder="Votre motif" name="msg"></textarea>
                                        </div>
                                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                        <input type="submit">
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>


                        <script>
                            $(function () {
                                if($('body').width() > 400) {
                                $("#tabs").tabs().addClass("ui-tabs-vertical ui-helper-clearfix");
                                $("#tabs li").removeClass("ui-corner-top").addClass("ui-corner-left");
                                console.log('test');
                                }
                            });
                        </script>

                    </section>
                </div>
            </body>
            <?php
            footer();
        }
    } else {
        header('location:page_404.php');
        die();
    }
} else {
    header('location:index.php');
    die();
}
?>
