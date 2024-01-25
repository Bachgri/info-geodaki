<?php
include './db/connection.php';
$db = connect();
$sqlGNums = "select * from respensables where active = true and idzone in (select decoupid from user_decoup where userid = ?) ";
$prepGnums = $db->prepare($sqlGNums);
$prepGnums->execute([$_GET['uid']]);
while ($dn = $prepGnums->fetch(PDO::FETCH_ASSOC)) {
    echo  $dn['id'] . "," . $dn['nom'] . "," . $dn['numero'] . ',' . $dn['nature'] . "," . $dn['idzone'] . ',' . $dn['zone'] . "*";
}

$db = null;
