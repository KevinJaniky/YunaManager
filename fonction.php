<?php
session_start();
//connexion a la base de donnee
function connectBdd()
{
    try {
       $bdd = new PDO("mysql:host=localhost;dbname=hotel", "root", "");
       //$bdd = new PDO("mysql:host=localhost;dbname=hotel", "root", "");
    } catch (Exception $e) {
        die("erreur :" . $e->getMessage());
    }
    return $bdd;
}


function selectUser($mail, $mdp)
{
    $bdd = connectBdd();
    $query = $bdd->query("SELECT * FROM user WHERE mail='" . $mail . "' AND mdp='" . $mdp . "'");
    return $query->fetch();
}

function createSession($mail, $mdp)
{
    $mdp = md5($mdp);
    $data = selectUser($mail, $mdp);
    if (!empty($data)) {
        $_SESSION["id"] = $data['id'];
        $_SESSION["nom"] = $data['nom'];
        $_SESSION["droit"] = $data['droit'];
        $_SESSION["email"] = $data['mail'];
        changeStateConnect($data['id']);
        return true;
    } else {
        return false;
    }
}

function isConnected()
{
    // requete , --> idpersonne qui a créer le tournois
    if (!empty($_SESSION["id"]))
        return true;
    else
        return false;
}

function changeStateConnect($id)
{
    $bdd = connectBdd();
    $bdd->query("UPDATE user SET whoisconnected = 1 WHERE id = " . $id);
}

function changeStateDisconnect($id)
{
    $bdd = connectBdd();
    $bdd->query("UPDATE user SET whoisconnected = 0 WHERE id = " . $id);
}

function nav()
{
    echo ' <nav>
                <ul class="element_nav_left">
                    <li><img src="media/burger_menu.png"></li>
                    <li><a href="list_poke.php"><img src="media/mail.png"></a><i id="notif" ></i></li>
                </ul>
                <span class="element_nav_middle" id="horloge"></span>
                <script src="js/jquery.js"></script>
                <script src="js/jquery-ui.js"></script>
                <script src="js/script.js"></script>
                <span class="element_nav_right"><a href="disconnect.php"><img src="media/logout.png"> </a></span>
                <script>getDate("horloge");</script>
            </nav>';
}

function head($title)
{
    echo '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta name="description" content="Gestionnaire YunaHotel">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/class.css">
    <link rel="stylesheet" href="css/app.css">
    <link href="https://fonts.googleapis.com/css?family=Anton|Dosis" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:900" rel="stylesheet">
    <link rel="icon" href="media/logoyunamanager.png">
    <title>' . $title . '</title>
</head>
';
}

function footer()
{
    echo '
<footer>
    
    
</footer>
</html>
';
}


function emailExist($mail)
{
    $bdd = connectBdd();
    $query = $bdd->query("SELECT * FROM user WHERE mail='" . $mail . "'");
    $res = $query->fetch();

    if (empty($res)) {
        return false;
    } else {
        return $res;
    }
}


function randomCle($car)
{
    $string = "";
    $chaine = "abcdefghijklmnpqrstuvwxyABCDEFGHIJKLMNOPQRSTUVWXZ1234567890";
    srand((double)microtime() * 1000000);
    for ($i = 0; $i < $car; $i++) {
        $string .= $chaine[rand() % strlen($chaine)];
    }
    return $string;
}

function forgotMdp($cle, $id)
{
    $bdd = connectBdd();
    $query = $bdd->prepare("INSERT INTO forgotpassword(cle,who)VALUES(:cle,:who)");
    $query->execute([
        'cle' => $cle,
        'who' => $id
    ]);
}

function mailMdp($mail, $cle)
{
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $message = "
    <html>
      <head>
       <title>Récupération de mot de passe</title>
      </head>
      <body>
       <p>Bonjour vous avez récemment perdu votre mot de passe.</p >
       <p>Pour le récuperer , merci de cliquez sur le lien suivant.</p>
       <p><a href='http://www.yuna-creation.fr/Manager/recuperation_mot_de_passe.php?q=" . $cle . "' target='_blank'>Cliquez Ici</a></p>
      </body >
     </html >
    ";
    mail($mail, 'Recuperation mot de passe - Yuna Hotel', $message, $headers);
}

function verifKey($key)
{
    $bdd = connectBdd();
    $query = $bdd->query("SELECT * FROM forgotpassword WHERE cle='" . $key . "' AND etat = '0'");
    $res = $query->fetch();

    if (!empty($res))
        return $res;
    return false;
}

function updateMdp($mdp, $id, $key)
{
    $bdd = connectBdd();
    $query = $bdd->prepare("UPDATE user SET mdp = :mdp WHERE id = :id");
    $query->execute([
        "mdp" => md5($mdp),
        "id" => $id
    ]);
    updateStateMdp($key);
}

function verifBeforeUpdateMdp($key, $mail)
{
    $bdd = connectBdd();
    $query = $bdd->query("SELECT * FROM user WHERE mail = '" . $mail . "' AND  id = (SELECT who FROM forgotpassword WHERE cle = '" . $key . "')");
    $res = $query->fetch();
    if (!empty($res)) {
        return $res;
    } else {
        return false;
    }
}

function updateStateMdp($key)
{
    $bdd = connectBdd();
    $bdd->query("UPDATE forgotpassword SET etat = 1 WHERE cle = '" . $key . "'");
}

function countStateRoomFree()
{
    $bdd = connectBdd();
    $query = $bdd->query("SELECT COUNT(*) as nb FROM chambre WHERE etat= 0");
    $res = $query->fetch();
    return $res['nb'];
}

function countStateRoomOccuped()
{
    $bdd = connectBdd();
    $query = $bdd->query("SELECT COUNT(*) as nb FROM chambre WHERE etat= 1");
    $res = $query->fetch();
    return $res['nb'];
}

function countStateRoomClean()
{
    $bdd = connectBdd();
    $query = $bdd->query("SELECT COUNT(*) as nb FROM chambre WHERE etat= 2");
    $res = $query->fetch();
    return $res['nb'];
}

function countStateRoomDisable()
{
    $bdd = connectBdd();
    $query = $bdd->query("SELECT COUNT(*) as nb FROM chambre WHERE etat= 3");
    $res = $query->fetch();
    return $res['nb'];
}

function countRoom()
{
    $bdd = connectBdd();
    $query = $bdd->query("SELECT COUNT(*) as nb FROM chambre");
    $res = $query->fetch();
    return $res['nb'];
}

function Room()
{
    $bdd = connectBdd();
    $query = $bdd->query("SELECT * FROM chambre");
    return $query->fetchAll();
}

function StateRoomFree()
{
    $bdd = connectBdd();
    $query = $bdd->query("SELECT * FROM chambre WHERE etat= 0");
    return $query->fetchAll();
}

function StateRoomOccuped()
{
    $bdd = connectBdd();
    $query = $bdd->query("SELECT * FROM chambre WHERE etat= 1");
    return $query->fetchAll();
}

function StateRoomClean()
{
    $bdd = connectBdd();
    $query = $bdd->query("SELECT * FROM chambre WHERE etat= 2 ORDER BY numero");
    return $query->fetchAll();
}

function StateRoomDisable()
{
    $bdd = connectBdd();
    $query = $bdd->query("SELECT * FROM chambre WHERE etat= 3");
    return $query->fetchAll();
}


function isManager()
{
    if (!empty($_SESSION['droit']) && $_SESSION['droit'] == 1) {
        return true;
    }
    return false;
}

function isAccueil()
{
    if (!empty($_SESSION['droit']) && $_SESSION['droit'] == 2) {
        return true;
    }
    return false;
}

function isMaid()
{
    if (!empty($_SESSION['droit']) && $_SESSION['droit'] == 3) {
        return true;
    }
    return false;
}

function sendPoke($msg, $exp, $dest)
{
    $bdd = connectBdd();
    $query = $bdd->prepare("INSERT INTO message(message,expediteur,destination) VALUES (:msg,:exp,:dest)");
    $query->execute([
        'msg' => $msg,
        'exp' => $exp,
        'dest' => $dest
    ]);
}

function listPoke($id)
{
    $bdd = connectBdd();
    $query = $bdd->query('SELECT * FROM message WHERE destination= "' . $id . '" AND etat=1 OR etat=2');
    return $query->fetchAll();
}

function countListPoke($id)
{
    $bdd = connectBdd();
    $query = $bdd->query('SELECT COUNT(*) as nb FROM message WHERE destination= "' . $id . '" AND etat=1 OR etat=2');
    $res = $query->fetch();
    return $res['nb'];
}

function whoSendPoke($id)
{
    $bdd = connectBdd();
    $query = $bdd->query('SELECT nom,prenom FROM user WHERE id = ' . $id);
    return $query->fetch();
}

function archivePoke($id)
{
    $bdd = connectBdd();
    $query = $bdd->prepare('UPDATE message SET etat = 2 WHERE id = :id');
    $query->execute(['id' => $id]);
}

function deletePoke($id)
{
    connectBdd()->query("DELETE FROM message WHERE id = " . $id);
}

function user_select()
{
    $bdd = connectBdd();
    $query = $bdd->query('SELECT * FROM user');
    return $query->fetchAll();
}

function user_count()
{
    $bdd = connectBdd();
    $query = $bdd->query('SELECT COUNT(*) as nb FROM user');
    $res = $query->fetch();
    return $res['nb'];
}


function generate_Menu()
{
    $nom = ['Dashboard', 'Chambres', 'Mailbox', 'Stock', 'Utilisateurs', 'Deconnexion'];
    $link = ['dashboard.php', 'room.php', 'mailbox.php', 'stock.php', 'user.php', 'disconnect.php'];
    $droit = [
        [1, 0, 1],
        [1, 1, 0],
        [1, 1, 1],
        [1, 0, 0],
        [1, 0, 0],
        [1, 1, 1]
    ];

    $tmp1 = count($nom);
    $tmp2 = count($link);
    $page_actuel = explode('/', $_SERVER['REQUEST_URI']);

    if (isManager()) {
        $who = 0;
    } else if (isAccueil()) {
        $who = 1;
    } else {
        $who = 2;
    }

    if ($tmp1 != $tmp2)
        return false;

    for ($i = 0; $i < $tmp1; $i++) {
        if ($droit[$i][$who] == 1) {

            if ($page_actuel[1] == $link[$i])
                echo "<li><a href='" . $link[$i] . "' class='active'>" . $nom[$i] . "</a></li>";
            else
                echo "<li><a href='" . $link[$i] . "'>" . $nom[$i] . "</a></li>";
        }
    }
    return true;
}

function updateDataUser($id, $nom, $prenom, $role, $mail)
{
    $bdd = connectBdd();
    $query = $bdd->prepare('UPDATE user SET nom = :nom , prenom = :prenom, droit = :droit, mail = :mail  WHERE id = :id');
    $query->execute([
        "nom" => $nom,
        "prenom" => $prenom,
        "droit" => $role,
        "mail" => $mail,
        "id" => $id
    ]);
}

function insertDataUser($nom, $prenom, $role, $mail, $mdp)
{
    $bdd = connectBdd();
    $query = $bdd->prepare('INSERT INTO user(nom,prenom,mdp,droit,mail) VALUES (:nom,:prenom,:mdp,:droit,:mail)');
    $query->execute([
        "nom" => $nom,
        "prenom" => $prenom,
        "mdp" => md5($mdp),
        "droit" => $role,
        "mail" => $mail
    ]);
}

function deleteUser($id)
{
    $bdd = connectBdd();
    $bdd->query("DELETE FROM user WHERE id = " . $id);
}

function updateDbStock($nom, $quantite, $cat, $id)
{
    $bdd = connectBdd();
    $query = $bdd->prepare('UPDATE stock SET nom = :nom, cat = :cat, stock = :stock WHERE id = :id');
    $query->execute([
        'nom' => $nom,
        'cat' => $cat,
        'stock' => $quantite,
        'id' => $id
    ]);
}

function deleteStock($id)
{
    $bdd = connectBdd();
    $bdd->query("DELETE FROM stock WHERE id = " . $id);
}

function addStockElement($nom, $stock, $cat)
{
    $bdd = connectBdd();
    $query = $bdd->prepare('INSERT INTO stock(nom,cat,stock) VALUES (:nom,:cat,:stock)');
    $query->execute([
        'nom' => $nom,
        'cat' => $cat,
        'stock' => $stock
    ]);
}


function changestatefree($id)
{
    $bdd = connectBdd();
    $query = $bdd->prepare('UPDATE chambre SET etat = :etat WHERE id = :id');
    $query->execute([
        'etat' => 0,
        'id' => $id
    ]);
}


function changestateoccuped($id, $nom, $prenom)
{
    $bdd = connectBdd();

    $query = $bdd->prepare('UPDATE chambre SET etat = :etat WHERE id = :id');
    $query->execute([
        'etat' => 1,
        'id' => $id
    ]);

    $exe = $bdd->prepare('INSERT INTO reservation(nom,prenom,chambre) VALUES (:nom,:prenom,:chambre)');
    $exe->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'chambre' => $id
    ]);
}

function changestateclear($id)
{
    $bdd = connectBdd();
    $query = $bdd->prepare('UPDATE chambre SET etat = :etat WHERE id = :id');
    $query->execute([
        'etat' => 2,
        'id' => $id
    ]);
}

function changestatedisable($id, $msg)
{
    $bdd = connectBdd();
    $query = $bdd->prepare('UPDATE chambre SET etat = :etat , msg = :msg WHERE id = :id');
    $query->execute([
        'etat' => 3,
        'msg' => $msg,
        'id' => $id
    ]);
}

function displayError($msg)
{
    echo ' 
            <div class="error">      
               <span class="glyphicon glyphicon-remove"></span>
                <p>' . $msg . '</p>
            </div>';
}


function MailUpdateUser($mail, $session)
{
    $data = emailExist($mail);

    if ($data == false)
        return true;
    if ($data['mail'] == $session)
        return true;
    return false;

}
function plateauBienvenu() {
    $bdd = connectBdd();
    $exec = $bdd->query('SELECT * FROM stock WHERE cat = "Plateau de bienvenue"');
    $nb = $exec->fetchAll();
    $cmp = $bdd->query('SELECT COUNT(*) as nb FROM stock WHERE cat = "Plateau de bienvenue"');
    $tmp = $cmp->fetch();
    $tmp = $tmp['nb'];

    for($i = 0 ; $i < $tmp ; $i++){
        $stock = $nb[$i]['stock']-1;

        $data = $bdd->prepare("UPDATE stock SET stock = :stock WHERE id = :id");
        $data->execute([
            'stock'=>$stock,
            'id'=>$nb[$i]['id']
        ]);
    }
}

function elemMoinsSotck($id){
    $bdd = connectBdd();
    $exec = $bdd->query('SELECT * FROM stock WHERE id ='.$id);
    $nb = $exec->fetch();

    $new = $nb['stock']-1;

    $data = $bdd->prepare("UPDATE stock SET stock = :stock WHERE id = :id");
    $data->execute([
        'stock'=>$new,
        'id'=>$id
    ]);
}

function ContactUs($to,$subject,$value) {

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $dest = 'kevin.janiky@gmail.com';

    $message =
        '<html>
<head>

</head>
<body>
<table>
    <tr>
        <td>Objet :</td>
        <td>'.$subject.'</td>
        <td></td>
    </tr>
    <tr>
        <td>Mail :</td>
        <td>'.$to.'</td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>'.$value.'</td>
        <td></td>
    </tr>
</table>

</body>
</html>';

    mail($dest, $subject, $message, $headers);
}