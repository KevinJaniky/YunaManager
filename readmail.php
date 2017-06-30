<?php
require_once "fonction.php";
if (isConnected()) {
    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $bdd = connectBdd();
        $prepare = $bdd->query("SELECT * FROM mail WHERE id=" . $id ." AND dest =".$_SESSION['id']);
        $query = $prepare->fetch();

        if (empty($query)) {
            header('location:page_404.php');
        }

        $nom_jour_fr = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
        $mois_fr = Array("", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août",
            "Septembre", "Octobre", "Novembre", "Décembre");

        $people = $bdd->query('SELECT prenom,nom FROM user WHERE id =' . $query['exp']);
        $people = $people->fetch();


        list($nom_jour, $jour, $mois, $annee) = explode('/', date("w/d/n/Y", strtotime($query['date'])));
        $title = $query['obj'] . " | YunaHotel";
        head($title);
        ?>
        <script src="js/jquery.js"></script>
        <script src="js/jquery-ui.js"></script>
        <script src="ckeditor/ckeditor.js"></script>
        <script src="js/script.js"></script>
        <body id="dashboard">
        <div class="container-fluid background_mulitc">
            <header>
                <p>Une question ? Contacter le <a href="contact.php" target="_blank">Support</a></p>            </header>
            <div class="content full_height">
                <?php include "aside.php" ?>
                <section id="mail_recep">
                    <div class="resume_mail bck_content">
                        <div class="info">
                            <p>Expéditeur : <?php echo $people['nom'] . ' ' . $people['prenom']; ?></p>
                            <p>Objet : <?php echo $query['obj']; ?></p>
                            <p>Date
                                : <?php echo $nom_jour_fr[$nom_jour] . ' ' . $jour . ' ' . $mois_fr[$mois] . ' ' . $annee;
                                echo date(' - H:i', strtotime($query['date'])); ?></p>
                        </div>
                        <p><?php echo $query['message']; ?></p>
                        <button id="repondre">Repondre</button>
                        <div class="answer" id="block_repondre">
                            <form method="post" action="sendmail.php">
                                <input type="hidden" name="dest" value="<?php echo $query['exp']; ?>">
                                <div class="content_form">
                                    <label for="object">Objet </label>
                                    <input type="text" name="obj" id="object" value="<?php echo $query['obj']; ?>">
                                </div>
                                <input type="hidden" name="exp" value="<?php echo $_SESSION['id']; ?>">
                                <div class="content_form">
                                    <label for="message">Message </label>
                                    <textarea name="msg"  class="ckeditor" id="editor message"></textarea>
                                </div>
                                <input type="submit" value="Repondre">
                            </form>
                        </div>
                    </div>
                    <script>
                        $('#repondre').click(function () {
                            $('#block_repondre').css('display','block');
                            $('#repondre').css('display','none');
                        });
                    </script>
                </section>
            </div>
        </body>
        <?php
        footer();
    } else {
        header('location:page_404.php');
    }
} else {
    header('location:index.php');
}
?>


