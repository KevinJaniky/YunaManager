<?php
require_once "fonction.php";
head('Mailbox | YunaHotel');
if (isConnected()) { ?>
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
    <script src="js/script.js"></script>

    <script>
        $(function () {
            $("#tabs").tabs();
        });
    </script>

    <body id="dashboard">
    <div class="container-fluid background_mulitc">
        <header>
            <p>Une question ? Contacter le <a href="contact.php" target="_blank">Support</a></p>        </header>

        <div class="content full_height">
            <?php include "aside.php" ?>
            <section>
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-2">Reception</a></li>
                        <li><a href="#tabs-1">Nouveau</a></li>
                    </ul>
                    <div id="tabs-2" class="bck_content">
                        <table class="table_mail">
                            <form method="post" action="deletemail.php">
                                <input type="submit" value="supprimer">
                                <?php
                                $bdd = connectBdd();
                                $query = $bdd->query("SELECT * FROM mail where dest = '" . $_SESSION['id'] . "'");
                                $nom = $bdd->query('SELECT nom,prenom FROM mail,user WHERE user.id = mail.exp');
                                while ($res = $query->fetch()) {
                                    $resnom = $nom->fetch();

                                    if ($res['etat'] == 1) {
                                        $state = "class='non-lu'";
                                    } else {
                                        $state = '';
                                    }

                                    echo "<tr " . $state . "><td><a class='state' data-id='" . $res['id'] . "' href='readmail.php?id=" . $res['id'] . "'>";
                                    echo $resnom['nom'] . " " . $resnom['prenom'];
                                    echo "</a></td><td><a class='state' data-id='" . $res['id'] . "'  href='readmail.php?id=" . $res['id'] . "'>";
                                    echo substr($res['obj'], 0, 50) . '...';
                                    echo "</a></td><td><a class='state' data-id='" . $res['id'] . "'  href='readmail.php?id=" . $res['id'] . "'>";
                                    echo substr($res['message'], 0, 255);
                                    echo "</a></td><td>";
                                    echo "<input type='checkbox' name='delete[]' value='" . $res['id'] . "' >";
                                    echo "</td></tr>";
                                }
                                ?>
                            </form>
                            <?php
                                if(isset($_GET['empty_field'])){
                                    displayError('Tout les champs doivent etre remplit');
                                }
                                if(isset($_GET['send_error'])){
                                    displayError('Les champs doivent contenir un minuumum de 5 caractères');
                                }
                            ?>
                        </table>
                    </div>
                    <div id="tabs-1" class="bck_content">
                        <form method="post" action="sendmail.php">
                            <div class="content_form">
                                <label for="dest">A</label>
                                <select name="dest" id="dest">

                                    <?php
                                    $bdd = connectBdd();
                                    $query = $bdd->query("SELECT * FROM user ");
                                    while ($res = $query->fetch()) {
                                        echo "<option value='" . $res['id'] . "'>" . $res['nom'] . " " . $res['prenom'] . "</option>";
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="content_form">
                                <label for="objet">Objet</label>
                                <input type="text" id="objet" class="" placeholder="Objet" name="obj">
                            </div>
                            <div class="content_form">
                                <label for="message">Message</label>
                                <textarea id="message editor" placeholder="Message" name="msg"  class="ckeditor"></textarea>
                            </div>
                            <input type="submit" value="Envoyer">
                        </form>
                    </div>
                </div>
                <script>
                    $('.state').click(function () {
                        $.ajax({
                            url: 'statechange.php', // La ressource ciblée
                            type: 'GET', // Le type de la requête HTTP.
                            data: 'id=' + this.dataset.id,
                            success: function () {
                            },
                            error: function () {
                            }
                        });
                    });
                </script>
            </section>
        </div>
    </div>
    </body>

    <?php
} else {
    header("location:index.php");
}
?>
