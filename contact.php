<?php
require_once "fonction.php";
head('Contact | YunaHotel');
?>
<script src="js/jquery.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/script.js"></script>
<body id="dashboard">
<div class="container-fluid background_mulitc">
    <header>
        <p>Une question ? Contacter le <a href="contact.php" target="_blank">Support</a></p>
    </header>
    <div class="content full_height">
        <?php include "aside.php" ?>
        <section>
            <div class="bck_content overflow_h">
                <h2>Me contacter</h2>

                <form method="post">
                    <div class="content_form">
                        <label for="objet">Objet</label>
                        <input type="text" id="objet" class="" placeholder="Objet" name="obj">
                    </div>
                    <div class="content_form">
                        <label for="message">Message</label>
                        <textarea id="message editor" placeholder="Message" name="msg"
                                  class="contact_form_text"></textarea>
                    </div>
                    <input type="submit" value="Envoyer">
                </form>
                <?php
                if (!empty($_POST['obj']) && !empty($_POST['msg'])) {
                    $obj = htmlspecialchars(trim($_POST['obj']));
                    $msg = htmlspecialchars(trim($_POST['msg']));
                    $id = $_SESSION['id'];
                    $error = false;
                    $msg_error = "";
                    $bdd = connectBdd();
                    $query = $bdd->query('SELECT * FROM user WHERE id =' . $id);
                    $data = $query->fetch();
                    $mail = $data['mail'];

                    if (strlen($obj) < 5) {
                        $error = true;
                        $msg_error .= "<li>Objet Trop court";
                    }
                    if (strlen($msg) < 5) {
                        $error = true;
                        $msg_error .= "<li>Message Trop court";
                    }

                    if ($error) {
                        displayError('<ul>' . $msg_error . '</ul>');
                    } else {

                        ContactUs($mail,$obj,$msg);


                    }
                }

                // OBJ / MSG / DEST / RECU
                ?>


            </div>
        </section>
    </div>
</body>
<?php
footer();
?>


