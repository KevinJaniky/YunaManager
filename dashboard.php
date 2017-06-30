<?php
require_once "fonction.php";
head('Dashboard | YunaHotel');
if (isConnected()) { ?>
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/script.js"></script>
    <body id="dashboard">
    <div class="container-fluid background_mulitc">
        <header>
            <p>Une question ? Contacter le <a href="contact.php" target="_blank">Support</a></p>        </header>
        <div class="content full_height">
            <?php include "aside.php" ?>
            <?php if(isManager()) {?>
            <section>
                <div class="block_room_resume bck_content">
                    <h2>Chambres</h2>
                    <div class="content_graph_barre">
                        <div class="free_barre">
                        </div>
                        <div class="occuped_barre">
                        </div>
                        <div class="clear_barre">
                        </div>
                        <div class="disable_barre">
                        </div>
                    </div>
                    <div class="legende">
                        <div class="free">
                            <span></span>
                            <span>Libre</span>
                        </div>
                        <div class="occupe">
                            <span></span>
                            <span>Occupé</span>
                        </div>
                        <div class="clear">
                            <span></span>
                            <span>Nettoyage</span>
                        </div>
                        <div class="disable">
                            <span></span>
                            <span>Indisponible</span>
                        </div>
                    </div>
                </div>
                <div class="bck_content_bot">
                    <div class="bck_content">
                        <h2>Stock</h2>
                        <div class="bck_form">
                            <div class="dropdown">
                                <button onclick="dropdown()" class="dropbtn" id="dropbtn">Tout</button>
                                <div id="myDropdownn" class="dropdown-content">
                                    <?php
                                    $bdd = connectBdd();
                                    $query = $bdd->query('SELECT DISTINCT (cat) as cat FROM stock');
                                    while ($res = $query->fetch()) {
                                        echo '<span class="drop_item" data-value="' . $res["cat"] . '">' . $res["cat"] . '</span>';
                                    }
                                    ?>
                                    <span class="drop_item" data-value="all">Tout</span>
                                </div>
                            </div>
                        </div>
                        <div id="stock_content">
                            <?php
                            $bdd = connectBdd();
                            $query = $bdd->query('SELECT * FROM stock ');
                            while ($res = $query->fetch()) {
                                echo '<div><span>' . $res["nom"] . '</span><span>' . $res["stock"] . '</span></div>';
                            }

                            ?>

                        </div>
                    </div>
                    <div class="bck_content">
                        <h2>Utilisateurs</h2>
                        <div class="user_content">
                            <?php
                            $bdd = connectBdd();
                            $query = $bdd->query('SELECT * FROM user');
                            while ($res = $query->fetch()) {
                                if($res['whoisconnected'] == 1){
                                    $connect = "<span class='pastille connected'></span>";
                                }else {
                                    $connect = "<span class='pastille'></span>";
                                }
                                echo '<div class="user" ><span>' . $res["nom"] . '</span> <span>' . $res["prenom"] . '</span>'.$connect.'</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php
             }
             else if(isAccueil()) {
                header('location:room.php');
                die();
             } else if(isMaid()) {
                $bdd = connectBdd();


                 ?>
                 <section>
                     <div class="block_room_resume bck_content">
                         <h2>Chambres</h2>
                         <table class="table table-responsive table_maid">
                             <thead>
                             <tr>
                                 <th>Chambres</th>
                                 <th></th>
                             </tr>
                             </thead>
                             <tbody id="stock_table_content">

                             <?php
                             $req = $bdd->query('SELECT * FROM chambre WHERE etat = 2 ');


                             while ($res = $req->fetch()) {
                                 echo '<tr>
                                <td>' . $res['nom'] . '</td>
                                <td><a href="maid_page.php?id=' . $res['id'] . '" class="btn btn-xs btn-success">Prendre en charge</a></td>
                              </tr>';
                             }
                             ?>
                             </tbody>
                         </table>

                     </div>
                 </section>
                 <?php



             }
            ?>
        </div>

    </div>
    </body>
    <?php
    footer();
} else {
    header("location:index.php");
    die();
}
?>


