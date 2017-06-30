<?php
require_once "fonction.php";
head('Nouvel utilisateur | YunaHotel');
if (isConnected()) {
    if (isManager()) {
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
                        <h2>Nouvel utilisateur</h2>
                        <form method="post">
                            <div class="content_form">
                                <label for="nom">Nom</label>
                                <input type="text" name="nom" id="nom">
                            </div>
                            <div class="content_form">
                                <label for="prenom">Prenom</label>
                                <input type="text" id="prenom" name="prenom">

                            </div>fm87x1j0
                            <div class="content_form">
                                <label for="role_modify">Roles</label>
                                <select name="role" id="roles_modify">
                                    <?php
                                    $role = ["Manager", "Agent d'accueil", "Agent de nettoyage"];
                                    for ($i = 1; $i < 4; $i++) {
                                        echo '<option value="' . $i . '" >' . $role[$i - 1] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="content_form">
                                <label for="mail">E-mail</label>
                                <input type="email" id="mail" name="mail">
                            </div>
                            <div class="content_form">
                                <label for="mdp">Mot de passe</label>
                                <input type="password" id="mdp" name="mdp">
                            </div>
                            <input type="submit" value="Ajouter">
                            <?php
                            if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['role']) && !empty($_POST['mail']) && !empty($_POST['mdp'])) {
                                $nom = htmlspecialchars(trim($_POST['nom']));
                                $prenom = htmlspecialchars(trim($_POST['prenom']));
                                $role = ($_POST['role']);
                                $email = htmlspecialchars(trim($_POST['mail']));
                                $mdp = htmlspecialchars(trim($_POST['mdp']));
                                $error = false;
                                $msg_error = "";

                                if (strlen($nom) < 2) {
                                    $error = true;
                                    $msg_error .= "<li>Le nom doit contenir 2 caractères minimum</li>";
                                }
                                if (strlen($prenom) < 2) {
                                    $error = true;
                                    $msg_error .= "<li>Le prenom doit contenir 2 caractères minimum</li>";
                                }
                                if ($role <= 1  && $role > 4) {
                                    $error = true;
                                    $msg_error .= "<li>Role non existant</li>";
                                }
                                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    $error = true;
                                    $msg_error .= "<li>L'email n'est pas valide</li>";
                                }
                                if (strlen($mdp) < 5) {
                                    $error = true;
                                    $msg_error .= "<li>Le mot de passe doit contenir 5 caractères minimum</li>";
                                }
                                if(emailExist($email)){
                                    $error = true;
                                    $msg_error .= "<li>Cet email est déja utilisé</li>";
                                }

                                if ($error) {
                                    displayError("<ul>" . $msg_error . "</ul>");
                                } else {
                                    insertDataUser($nom, $prenom, $role, $email, $mdp);
                                    header('location:user.php?account_created');
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
?>

