<?php
include './db/connection.php';
$db = connect();
$q = "SELECT st_astext(st_union(geom)) as uniond, 
        st_Y(st_asText(st_centroid(st_union(geom)))) as yt, 
        st_X(st_astext(st_centroid(st_union(geom)))) as xt 
        from decoup d join public.user_decoup ud on d.idz = ud.decoupid
        where ud.userid = ?
";
$p = $db->prepare($q);
$r = $p->execute([$_GET['userid']]);
$c = 0;
if ($data = $p->fetch(PDO::FETCH_ASSOC)) {
    echo $data['uniond'] . '*' . $data['yt'] . '*' . $data['xt'];
}
 