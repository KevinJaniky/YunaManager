<?php
require_once "fonction.php";

$res[0] = countStateRoomFree();
$res[1] = countStateRoomOccuped();
$res[2] = countStateRoomClean();
$res[3] = countStateRoomDisable();

echo json_encode($res);
