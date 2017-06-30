<?php
require_once "fonction.php";
if (isConnected()) {
    if (isManager()) {
        head('Nouvel élément | YunaHotel');
        ?>
        <script src="js/jquery.js"></script>
        <script src="js/jquery-ui.js"></script>
        <script src="js/script.js"></script>
        <body id="dashboard">
        <div class="container-fluid background_mulitc">
            <header>
                <p>Une question ? Contacter le <a href="contact.php" target="_blank">Support</a></p>            </header>
            <div class="content full_height">
                <?php include "aside.php" ?>
                <section>
                    <div class="bck_content overflow_h">
                        <h2>Nouvel élément</h2>
                        <form method="post">
                            <div class="content_form">
                                <label for="nom">Nom</label>
                                <input type="text" name="nom" id="nom">
                            </div>
                            <div class="content_form">
                                <label for="stock">Quantité</label>
                                <input type="number" id="stock" name="stock">
                            </div>
                            <div class="content_form">
                                <label for="cat_modify">Catégorie</label>
                                <select name="cat" id="cat_modify">
                                    <?php
                                    $cat = ['Plateau de bienvenue', 'Chambres', 'Entretien', 'Distributeur', 'Divers'];
                                    for ($i = 0; $i < 5; $i++) {
                                        echo '<option value="' . $cat[$i] . '" >' . $cat[$i] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <input type="submit" value="Ajouter">
                            <?php
                            if (!empty($_POST['nom']) && !empty($_POST['stock']) && isset($_POST['cat'])) {
                                $nom = htmlspecialchars(trim($_POST['nom']));
                                $cate = $_POST['cat'];
                                $stock = $_POST['stock'];
                                $error = false;
                                $msg_error = "";
                                $cat = ['Plateau de bienvenue', 'Chambres', 'Entretien', 'Distributeur', 'Divers'];


                                if (strlen($nom) < 2) {
                                    $error = true;
                                    $msg_error .= "<li>Le nom doit contenir 2 caractères minimum</li>";
                                }
                                if ($cat[0] != $cate && $cat[1] != $cate && $cat[2] != $cate && $cat[3] != $cate && $cat[4] != $cate) {
                                    $error = true;
                                    $msg_error .= "<li>Categorie non existante</li>";
                                }
                                if (!is_numeric($stock)) {
                                    $error = true;
                                    $msg_error .= "<li>Valeur non numerique pour la quantité</li>";
                                }
                                if ($stock < 0) {
                                    $error = true;
                                    $msg_error .= "<li>Valeur de quantité  doit être positive </li>";
                                }


                                if ($error) {
                                    echo "<div class='error'><ul>" . $msg_error . "</ul></div>";
                                } else {
                                    addStockElement($nom, $stock, $cate);
                                    header('location:stock.php?stock_element_created');
                                }
                            }
                            ?>

                        </form>
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

