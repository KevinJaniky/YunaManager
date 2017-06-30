<?php
require_once "fonction.php";
head('Maid List | YunaHotel');
if (isConnected()) {
    if (isMaid()) {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $bdd = connectBdd();
            $query = $bdd->query('SELECT * FROM chambre WHERE id =' . $id);
            $data = $query->fetch();
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
                    <section id="maid_list">
                        <div class="bck_content">
                            <h2 class="next">Prise en charge de <?php echo $data['nom'] ?></h2>
                            <ul class="frise_maid">
                                <li class="selected">Entretien</li>
                                <li>Alimentation</li>
                                <li>Divers</li>
                                <li>Valider</li>
                            </ul>
                            <div class="content_list">
                                <form method="post" action="traitement_maid.php">
                                    <input type="hidden" value="<?php echo $_GET['id'] ?>" name="id">
                                    <div class="state1 elem">
                                        <?php
                                        $bdd = connectBdd();
                                        $query = $bdd->query('SELECT * FROM stock WHERE cat = "Entretien" AND stock > 0');
                                        while ($data = $query->fetch()) {
                                            echo '
                                             <div class="maid_form">
                                                <label for="nom">' . $data['nom'] . '</label>
                                                <input type="checkbox" value="' . $data['id'] . '" name="element[]">
                                            </div>
                                            ';
                                        }

                                        ?>
                                        <p class="next">Suivant</p>
                                    </div>
                                    <div class="state2 elem">
                                        <div class="maid_form">
                                            <label>Plateau de Bienvenue</label>
                                            <input type="checkbox" name="element[]" value="bienvenue">
                                        </div>
                                        <p class="next">Suivant</p>
                                    </div>
                                    <div class="state3 elem">
                                        <?php
                                        $bdd = connectBdd();
                                        $query = $bdd->query('SELECT * FROM stock WHERE cat = "Chambres" OR cat="Divers" AND stock > 0');
                                        while ($data = $query->fetch()) {
                                            echo '
                                             <div class="maid_form">
                                                <label for="nom">' . $data['nom'] . '</label>
                                                <input type="checkbox" value="' . $data['id'] . '" name="element[]">
                                            </div>
                                            ';
                                        }

                                        ?>
                                        <p class="next">Suivant</p>
                                    </div>
                                    <div class="state4 elem">
                                        <div class="maid_form">
                                            <input type="submit" value="Rendre cette chambre disponible" name="dispo">
                                        </div>
                                    </div>
                                </form>
                            </div>
                    </section>
                </div>
                <script>
                    $('.frise_maid').ready(function () {
                        var i = 1;

                        $('.next').click(function () {
                            $('.frise_maid li.selected:last').next().addClass('selected');
                            i++;

                            $('.elem').each(function () {
                                var classes = '.state' + i;
                                if ($(this).is(':visible')) {
                                    $(this).css('display', 'none');
                                    $(classes).css('display', 'block');
                                }
                            });
                        });
                    });
                </script>
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

/*
 *
 * */




