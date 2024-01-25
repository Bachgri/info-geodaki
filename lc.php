<?php
include './db/connection.php';
$db = connect();
$sqlClct =
    "SELECT distinct t1.id,  t1.newla, t1.newlo, t1.type, d.annexe, name, numparc, max(devicetime) as dt from (
        SELECT 
            max(vrfid.devicetime) AS devicetime,
            bacs.numpark AS numparc,
            devices.name  ,
            min(vrfid.lat) AS latitude,
            min(vrfid.lon) AS longitude,
            min(vrfid.tag1)::varchar(24) AS identifiant,
            date(vrfid.devicetime) AS datej,
            bacs.typeb AS type,
            devices.fonction,
            bacs.id,
            bacs.newla,
            bacs.newlo   
        FROM
            vrfid
            INNER JOIN tags ON (vrfid.tag1::text = tags.ntag::text)
            INNER JOIN bacs ON (tags.idbac = bacs.id)
            LEFT OUTER JOIN devices ON (vrfid.deviceid = devices.id) 
            --decoup2 d --join public.user_decoup on d.id = decoupid
        WHERE  --userid = '97'and
            bacs.active = true  
            AND public.vrfid.devicetime >= current_date - 7 + '00:00:00'::time
            and lower(devices.fonction) like '%lavage%'  
        GROUP BY 
            bacs.numpark, 
            devices.name, 
            datej, 
            bacs.typeb, 
            devices.fonction, 
            bacs.id 
    ) t1, decoup d  join public.user_decoup on d.idz = decoupid
    where userid = ?
            and ST_Contains( d.geom , ST_SetSRID(ST_MakePoint(t1.newlo, t1.newla),4326) ) 
    group by t1.id,  t1.newla, t1.newlo, t1.type, d.annexe, name, numparc
    ";
$prepClct = $db->prepare($sqlClct);
$ok = $prepClct->execute([$_GET['userid']]);
$bcs = 0;
while ($dataClct = $prepClct->fetch(PDO::FETCH_ASSOC)) {
    echo $dataClct['id'] . "," . $dataClct['newla'] . "," . $dataClct['newlo'] . "," . $dataClct['type'] . "," . $dataClct['annexe'] . "," . $dataClct['numparc'] . "," .
        $dataClct['name'] .  "," . $dataClct['dt'] . ";";
    $bcs++;
}
