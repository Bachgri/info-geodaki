<?php
include './db/connection.php';
$db = connect();
$sqlGM = "SELECT    b.id, b.newla as lat, 
b.newlo as lng, d.annexe , 
b.lastupdate::date as dt, typeb, b.numpark, lastupdate
from bacs b ,decoup d join public.user_decoup ud on decoupid = d.idz 
where  ud.userid = ?  and
    ST_Contains( d.geom , ST_SetSRID(ST_MakePoint(b.newlo, b.newla),4326) ) 
and b.active = true  
order by d.annexe 
    ";
$bacsZones = array();
$prepGM = $db->prepare($sqlGM);
$res = $prepGM->execute([$_GET['userid']]);
$c = 0;
while ($data = $prepGM->fetch(PDO::FETCH_ASSOC)) {
    echo $data['lat'] . ',' . $data['lng'] . ',' . $data['numpark'] . ',' .  $data['annexe'] . ',' .  $data['dt'] . "," . $data['typeb'] . ',' . $data['lastupdate'] . "*";
}
