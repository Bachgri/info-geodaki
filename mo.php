<?php
include './db/connection.php';
$db = connect();
$sqlGNums = "SELECT name , userid
            from devices 
                join user_device on deviceid = id
            where vehicule like '%MOTO%'
            and  disabled = false 
            and userid = ? 
            ORDER BY name
            ";
$prepGnums = $db->prepare($sqlGNums);
$prepGnums->execute([$_GET['uid']]);
while ($dn = $prepGnums->fetch(PDO::FETCH_ASSOC)) {
    echo  $dn['name'] . ";";
}

$db = null;
