<?php
require_once 'fonction.php';
if (isConnected()) {
    if (isManager()) {
        if (isset($_GET['action'])) {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $action = $_GET['action'];

                if ($action == "modify") {
                    $bdd = connectBdd();
                    $query = $bdd->prepare('SELECT * FROM user WHERE id =:id');
                    $res = $query->execute([
                        'id' => $id,
                    ]);
                    $data = $query->fetch();

                    $titre = $data['nom'] . ' ' . $data['prenom'] . ' | YunaHotel';
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
                            <section id="modify_user">
                                <div class="bck_content">
                                    <h2>Modification <?php echo $data['prenom'] . ' ' . $data['nom'] ?></h2>
                                    <form method="post">
                                        <div class="content_form">
                                            <label for="nom">Nom</label>
                                            <input type="text" name="nom" id="nom" value="<?php echo $data['nom'] ?>">
                                        </div>
                                        <input type="hidden" value="<?php echo $_GET['id'] ?>" name="id">
                                        <div class="content_form">
                                            <label for="prenom">Prenom</label>
                                            <input type="text" id="prenom" name="prenom"
                                                   value="<?php echo $data['prenom'] ?>">

                                        </div>
                                        <div class="content_form">
                                            <label for="role_modify">Roles</label>
                                            <select name="role" id="roles_modify">
                                                <?php
                                                $role = ["Manager", "Agent d'accueil", "Agent de nettoyage"];
                                                for ($i = 1; $i < 4; $i++) {
                                                    if ($data['droit'] == $i) {
                                                        echo '<option value="' . $i . '" selected="selected" >' . $role[$i - 1] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $i . '" >' . $role[$i - 1] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="content_form">
                                            <label for="mail">E-mail</label>
                                            <input type="email" id="mail" name="mail"
                                                   value="<?php echo $data['mail'] ?>">
                                        </div>
                                        <input type="submit" value="Modifier">
                                    </form>
                                    <?php
                                    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['role']) && !empty($_POST['mail']) && !empty($_POST['id'])) {
                                        $nom = trim($_POST['nom']);
                                        $prenom = trim($_POST['prenom']);
                                        $role = $_POST['role'];
                                        $mail = $_POST['mail'];
                                        $id = $_POST['id'];
                                        $error = false;
                                        $msgerror = "";

                                        if (strlen($nom) < 2) {
                                            $error = true;
                                            $msgerror .= "<li>Le nom doit contenir au moins 2 caracteres .</li>";
                                        }
                                        if (strlen($prenom) < 2) {
                                            $error = true;
                                            $msgerror .= "<li>Le prenom doit contenir au moins 2 caracteres .</li>";
                                        }
                                        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                                            $error = true;
                                            $msgerror .= "<li>E-mail non conforme</li>";
                                        }
                                        if ($role < 1 && $role > 4) {
                                            $error = true;
                                            $msgerror .= "<li>Role non existant</li>";
                                        }
                                        if(MailUpdateUser($mail,$_SESSION['email']) == false) {
                                            $error = true;
                                            $msgerror .= "<li>Mail existant</li>";
                                        }
                                        if ($error) {
                                            displayError("<ul>" . $msgerror . "</ul>");
                                        } else {
                                            $_SESSION['email'] = $mail;
                                            updateDataUser($id, $nom, $prenom, $role, $mail);
                                            header('location:user.php?update_sucess');
                                            die();
                                        };


                                    }

                                    ?>
                                </div>
                            </section>
                        </div>
                    </body>

                    <?php
                    footer();
                } else if ($action == "delete") {
                    deleteUser($id);
                    header('location:user.php?delete_success');
                    die();
                } else {
                    header('location:page_404.php');
                    die();
                }
            }
        }
    } else {
        header('location:page_404.php');
        die();
    }
} else {
    header('location:index.php');
    die();
}
