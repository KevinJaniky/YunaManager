<?php
require_once "fonction.php";
if (isConnected()) {
    if (isManager()) {
        if (isset($_GET['action'])) {
            $ac = $_GET['action'];
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                if ($ac == 'modify') {
                    $bdd = connectBdd();

                    $query = $bdd->query("SELECT * FROM stock WHERE id=" . $id);
                    $data = $query->fetch();
                    $titre = $data["nom"] . ' | YunaHotel';
                    head($titre);

                    ?>
                    <script src="js/jquery.js"></script>
                    <script src="js/jquery-ui.js"></script>
                    <script src="js/script.js"></script>
                    <body id="dashboard">
                    <div class="container-fluid background_mulitc">
                        <header>
                            <p>Une question ? Contacter le <a href="contact.php" target="_blank">Support</a></p>                        </header>
                        <div class="content full_height">
                            <?php include "aside.php" ?>
                            <section>
                                <div class="bck_content overflow_h">
                                    <form method="post">
                                        <div class="content_form">
                                            <label for="nom">Nom</label>
                                            <input type="text" name="nom" id="nom" value="<?php echo $data['nom'] ?>">
                                        </div>
                                        <input type="hidden" value="<?php echo $id ?>" name="id">
                                        <div class="content_form">
                                            <label for="stock">Quantité</label>
                                            <input type="text" id="stock" name="stock"
                                                   value="<?php echo $data['stock'] ?>">
                                        </div>
                                        <div class="content_form">
                                            <label for="cat">Catégorie</label>
                                            <select id="cat" name="cat">
                                                <?php
                                                $cat = ['Plateau de bienvenue', 'Chambres', 'Entretien', 'Distributeur', 'Divers'];
                                                for ($j = 0; $j < 5; $j++) {
                                                    if ($data['cat'] == $cat[$j]) {
                                                        echo '<option value="' . $cat[$j] . '" selected="selected" >' . $cat[$j] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $cat[$j] . '" >' . $cat[$j] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <input type="submit" value="Modifier">

                                        <?php
                                        if (!empty($_POST['nom']) && !empty($_POST['stock']) && !empty($_POST['cat'])) {
                                            $nom = htmlspecialchars(trim($_POST['nom']));
                                            $stock = $_POST['stock'];
                                            $cate = $_POST['cat'];
                                            $error = false;
                                            $msg_error = "";


                                            if (strlen($nom) < 2) {
                                                $error = true;
                                                $msg_error .= '<li>Le nom doit contenir 2 caractères minimum.</li>';
                                            }
                                            if (!is_numeric($stock)) {
                                                $error = true;
                                                $msg_error .= '<li>Le stock doit etre un nombre entier.</li>';
                                            }
                                            if ($cat[0] != $cate && $cat[1] != $cate && $cat[2] != $cate && $cat[3] != $cate && $cat[4] != $cate) {
                                                $error = true;
                                                $msg_error .= '<li>Catégorie non existante</li>';
                                            }

                                            if ($error) {
                                                displayError($msg_error);
                                            } else {
                                                updateDbStock($nom, $stock, $cate, $id);
                                                header('location:stock.php');
                                                die();
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
                } else if ($ac == 'delete') {
                    deleteStock($id);
                    header('location:stock.php?success_delete');
                    die();
                } else if( $ac == 'moinsun') {
                    $bdd = connectBdd();
                    $query = $bdd->query("SELECT * FROM stock WHERE id=" . $id);
                    $data = $query->fetch();
                    $new = $data['stock']-1;
                    $res = $bdd->prepare("UPDATE stock SET stock = :nb WHERE id = :id");
                    $res->execute([
                        'nb'=>$new,
                        'id'=>$id
                    ]);
                    header('location:stock.php');
                    die();
                } else {
                    header('location:page_404.php');
                    die();
                }
            } else {
                header('location:page_404.php');
                die();
            }
        } else {
            header('location:page_404.php');
            die();
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


