<?php
require_once "fonction.php";
head('Utilisateurs | YunaHotel');
if(isConnected()) {
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
                    <div class="link_add_user">
                        <a class="right-align" href="add_user.php">Ajouter un nouvel utilisateur</a>
                    </div>
                    <div class="overflow_a content_table_user">
                        <table class="table table-responsive table_user">
                            <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Rôles</th>
                                <th>Email</th>
                                <th>Modifier</th>
                                <th>Supprimer</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $data = user_select();
                            for ($i = 0; $i < user_count(); $i++) {
                                $role = "Manager";
                                if ($data[$i]['droit'] == 2) {
                                    $role = "Agent d'accueil";
                                } else if ($data[$i]['droit'] == 3) {
                                    $role = "Agent de nettoyage";
                                }

                                echo "<tr>";
                                echo "<td>" . $data[$i]['nom'] . "</td>";
                                echo "<td>" . $data[$i]['prenom'] . "</td>";
                                echo "<td>" . $role . "</td>";
                                echo "<td>" . $data[$i]['mail'] . "</td>";
                                echo "<td><a href='modify_user.php?action=modify&id=" . $data[$i]['id'] . "' class='btn btn-xs btn-warning'>Modifier</a></td>";
                                echo "<td><a href='modify_user.php?action=delete&id=" . $data[$i]['id'] . "'  class='btn btn-xs btn-danger'>Supprimer</a></td>";

                                echo "</tr>";
                            }

                            ?>

                            </tbody>
                        </table>
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