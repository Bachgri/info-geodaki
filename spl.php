<?php
include './db/connection.php';
$db = connect();
$sql = "SELECT  annexe,
        replace(replace(st_astext(geom), 'MULTIPOLYGON(((', '' ), ')))','' ) as pl,
        st_x(st_centroid(geom)) as lo,
        st_y(st_centroid(geom)) as la
        from decoupage d join public.user_decoup ud  on d.idz = ud.decoupid
        where userid = ?
";
$p = $db->prepare($sql);
$r = $p->execute([$_GET['userid']]);
while ($d = $p->fetch(PDO::FETCH_ASSOC)) {
    echo $d['annexe'] . '*' . $d['pl'] . '*' . $d['la'] . '*' . $d['lo'] . ';';
}
