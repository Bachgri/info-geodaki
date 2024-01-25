<?php
include './db/connection.php';
$db = connect();

$s =
    "SELECT round((count(*) / 
        (select count(*)::float
        from bacs bb , decoup dd join public.user_decoup udd on dd.idz = decoupid
        where   ST_Contains( dd.geom , ST_SetSRID(ST_MakePoint(bb.newlo, bb.newla),4326) ) 
                and  dd.annexe = d.annexe and bb.active = true  and userid = ?
        group by annexe
        ) *100)::decimal, 2) as tt 
    from bacs b , decoup d join  public.user_decoup ud on d.idz = ud.decoupid
    where   ST_Contains( d.geom , ST_SetSRID(ST_MakePoint(b.newlo, b.newla),4326) ) 
            and lastupdate >= current_timestamp - '23:59:59'::time
            and b.active = true and  userid=?
    group by annexe order by annexe
    ";
$TTLT = $db->prepare($s);
$TTLT->execute(array($_GET['uid'], $_GET['uid']));
$tauxT = 0;
if ($ttlt = $TTLT->fetch(PDO::FETCH_ASSOC)) {
    echo $ttlt['tt'];
}
