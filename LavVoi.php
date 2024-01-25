
<?php
include('./db/connection.php');
$f = fopen('./js/voirie.js', "w+");
$bd = connect();
$sql =
    "SELECT 
    fixtime,
    latitude,
    longitude,
    name,
    substr(capt, 11, 1) as bln
    from 
        positions 
        join devices on devices.id = deviceid
        --Join public.leplanning3 pl on pl.deviceid = devices.id 
    where-- name in ('ARTA3502','ARTA3501', 'ARTA3401')and
        fixtime between ?::timestamp and ?::timestamp
       -- and pl.datej = current_date 
        and lower(fonction) like '%lav%vo%' and name = ?
    order by name, fixtime DESC                         
    ";

$prep = $bd->prepare($sql);
$ok = $prep->execute([$_GET['dd'], $_GET['df'], $_GET['veh']]);


while ($d = $prep->fetch(PDO::FETCH_ASSOC)) {
    echo $d['latitude'] . ',' . $d['longitude'] . ',' . $d['name'] . ',' . $d['fixtime'] . ',' . $d['bln'] . " * ";
}

?>