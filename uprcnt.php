<?php
include './db/connection.php';
$db = connect();
$sql =
    "SELECT count(*) as c1 , 
    (select count(*)::float as c2
        from bacs bb , decoup dd join public.user_decoup udd on dd.idz = decoupid
        where   ST_Contains( dd.geom , ST_SetSRID(ST_MakePoint(bb.newlo, bb.newla),4326) ) 
                and  dd.annexe = d.annexe and bb.active = true  and userid = ?
        group by annexe
        ), 
        d.annexe, replace(replace(st_astext(st_centroid(st_union(d.geom))), 'POINT(', ''), ')', '') as cen
    from bacs b , decoup d join  public.user_decoup ud on d.idz = ud.decoupid
    where   ST_Contains( d.geom , ST_SetSRID(ST_MakePoint(b.newlo, b.newla),4326) ) 
        and lastupdate >= current_timestamp - '23:59:59'::time
        and b.active = true and  userid=?
    group by annexe order by annexe, st_centroid(st_union(d.geom))

";
$prepT = $db->prepare($sql);
$resT = $prepT->execute(array($_GET['userid'], $_GET['userid']));
while ($data1 = $prepT->fetch(PDO::FETCH_ASSOC)) {
    echo ("" . $data1['annexe'] . "," . round($data1['c1'] / $data1['c2'] * 100, 2) . "," . $data1['c1'] . ", " . $data1['c2'] . "," . $data1['cen'] . ";");
}
