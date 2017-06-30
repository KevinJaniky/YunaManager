<?php
require_once "fonction.php";
head('Chambres | YunaHotel');
if(isConnected()) {
    if (isManager() || isAccueil()) {


        ?>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-ui.js"></script>
        <script src="js/script.js"></script>
        <body id="dashboard">
        <div class="container-fluid background_mulitc">
            <header>
                <p>Une question ? Contacter le <a href="contact.php" target="_blank">Support</a></p>            </header>
            <div class="content full_height">
                <?php include "aside.php" ?>
                <section id="room">
                    <div class="bck_content overflow_a">
                        <?php
                        $cmp = countRoom();
                        $data = Room();
                        $etat = ['Libre', 'Occupé', 'En nettoyage', 'En travaux'];
                        for ($i = 0; $i < $cmp; $i++) {
                            if ($i % 4 == 0) {
                                echo '<div class="row_room">';
                            }

                            echo '<a href="roomstate.php?id=' . $data[$i]['id'] . '&etat=' . $data[$i]['etat'] . '" class="element_room state_' . $data[$i]["etat"] . '">
                                <span>' . $data[$i]["nom"] . '</span>
                                <span>' . $etat[$data[$i]['etat']] . '</span>
                                <span>' . $data[$i]['type'] . '</span>
                               </a>';


                            if ($i % 4 == 3) {
                                echo '</div>';
                            }
                        }
                        ?>

                    </div>
                </section>
            </div>
        </body>
        <?php
        footer();
    } else {
        header('location:page_404.php');
        die();
    }
} else {
    header('location:index.php');
    die();
}