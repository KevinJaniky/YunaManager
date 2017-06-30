<?php
require_once 'fonction.php';
head('Récupération mot de passe - YunaHotel');
?>
<body id="recuperation_mdp_page">
<div class="container-fluid full_height">
    <?php
    if (!empty($_GET["q"])) {
        $key = $_GET['q'];
        if (strlen($key) == 32) {
            if (verifKey($key)) {
                ?>
                <div class="recup_mdp bck_content">
                    <h2>Recupération de mot de passe</h2>
                    <form method="post">
                        <div class="content_form">
                            <label class="mail" for="mail">Email</label>
                            <input type="email" name="mail" id="mail" class="form_control_custom" placeholder="E-mail">
                        </div>
                        <div class="content_form">
                            <label class="password" for="mdp">Password</label>
                            <input type="password" name="mdp" id="mdp" class="form_control_custom mdp"
                                   placeholder="Nouveau mot de passe">
                            <span class="info">Mot de passe : plus de 5 caractères</span>
                        </div>
                        <div class="content_form">
                            <label class="password" for="mdp1">Password</label>
                            <input type="password" name="mdp1" id="mdp1" class="form_control_custom"
                                   placeholder="Mot de passe">
                        </div>
                        <input type="submit" value="Changer" class="form_control_submit">
                    </form>
                    <?php if (!empty($_POST['mail']) && !empty($_POST['mdp']) && !empty($_POST['mdp1'])) {
                        $mail = $_POST["mail"];
                        $mdp = $_POST['mdp'];
                        $mdp1 = $_POST['mdp1'];
                        $error = false;

                        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                            $error = true;
                        }
                        if (strlen($mdp) < 5) {
                            $error = true;
                        }
                        if ($mdp != $mdp1) {
                            $error = true;
                        }
                        if ($error) {
                            echo "<span class='error'>Veuillez saisir des données valides.</span>";
                        } else {
                            if ($res = verifBeforeUpdateMdp($key, $mail)) {
                                updateMdp($mdp, $res['id'],$key);
                                header('location:index.php');
                            }
                            else{
                                header('location:page_404.php');
                            }
                        }
                    }
                    ?>
                </div>
                <?php
            } else {
                header('location:page_404.php');
            }
        } else {
            header('location:page_404.php');
        }
    } else {
        header('location:page_404.php');
    }
    ?>

</div>
</body>
<?php
footer();
?>


