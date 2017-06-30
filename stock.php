<?php
require_once "fonction.php";
if (isConnected()) {
    if (isManager()) {
        head('Stock | YunaHotel');
        $bdd = connectBdd();

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
                <section id="stock">
                    <div>
                        <div class="">
                            <a class="add_object" href="add_stock.php">Ajouter un nouvel élément</a>
                            <div class="dropdown">
                                <button onclick="dropdownstock()" class="dropbtnstock dropbtn" id="dropbtnstock">Tout
                                </button>
                                <div id="myDropdown" class="dropdown-content">
                                    <?php
                                    $query = $bdd->query('SELECT DISTINCT (cat) as cat FROM stock');
                                    while ($res = $query->fetch()) {
                                        echo '<span class="drop_item_stock" data-value="' . $res["cat"] . '">' . $res["cat"] . '</span>';
                                    }
                                    ?>
                                    <span class="drop_item_stock" data-value="all">Tout</span>
                                </div>
                            </div>
                        </div>
                        <div class="content_table overflow_a">
                            <table class="table table-responsive bck_content stock_table">
                                <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Quantité</th>
                                    <th>Catégorie</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>

                                </tr>
                                </thead>
                                <tbody id="stock_table_content">
                                <?php
                                $req = $bdd->query('SELECT * FROM stock');

                                while ($res = $req->fetch()) {
                                    echo '<tr>
                                <td>' . $res['nom'] . '</td>
                                <td>' . $res['stock'] . '</td>
                                <td>' . $res['cat'] . '</td>
                                <td><a href="modify_stock.php?action=moinsun&id=' . $res['id'] . '" class="btn btn-xs btn-info">- 1 </a></td>
                                <td><a href="modify_stock.php?action=modify&id=' . $res['id'] . '" class="btn btn-xs btn-warning">Modifier</a></td>
                                <td><a href="modify_stock.php?action=delete&id=' . $res['id'] . '" class="btn btn-xs btn-danger">Supprimer</a></td>
                              </tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </section>
            </div>
        </body>
        <?php
        footer();
        ?>
        <script>
            $('.drop_item_stock').click(function () {
                var btn = $('.dropbtnstock');
                btn.text($(this).text());
                btn.removeClass('arrow');
                $.ajax({
                    url: 'stockdash.php', // La ressource ciblée
                    type: 'GET', // Le type de la requête HTTP.
                    data: 'stock=' + this.dataset.value,
                    dataType: 'json',
                    success: function (data) {
                        var stock = '';
                        var page = '';

                        for (var cmp = 0; cmp < data.length; cmp++) {

                            stock += '<tr><td>' + data[cmp]["nom"] + '</td><td>' + data[cmp]["stock"] + '</td><td>' + data[cmp]["cat"] + '</td><td><a href="modify_stock.php?action=moinsun&id=' + data[cmp]['id'] + '" class="btn btn-xs btn-info">- 1 </a></td><td><a href="modify_stock.php?action=modify&id=' + data[cmp]['id'] + '" class="btn btn-xs btn-warning">Modifier</a></td><td><a href="modify_stock.php?action=delete&id=' + data[cmp]['id'] + '" class="btn btn-xs btn-danger">Supprimer</a></td></tr>';
                        }

                        $('#stock_table_content').html(stock);
                    },
                    error: function () {
                    }
                });
            });


            function dropdownstock() {
                document.getElementById("myDropdown").classList.toggle("show");
                document.getElementById("dropbtnstock").classList.toggle("arrow");
            }

            // Close the dropdown menu if the user clicks outside of it
            window.onclick = function (event) {
                if (!event.target.matches('.dropbtnstock')) {

                    var dropdowns = document.getElementsByClassName("dropdown-content");
                    var i;
                    for (i = 0; i < dropdowns.length; i++) {
                        var openDropdown = dropdowns[i];
                        if (openDropdown.classList.contains('show')) {
                            openDropdown.classList.remove('show');
                        }
                    }
                }
            };

        </script>


        <?php

    } else {
        header('location:page_404.php');
        die();
    }
} else {
    header('location:index.php');
    die();
}

?>

