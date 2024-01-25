<?php
include './db/connection.php';
$db = connect();
$q = "  SELECT userid, annexe from user_decoup join decoup on idz = decoupid where  userid = ? ";
$p = $db->prepare($q);
$p->execute(array($_GET['user']));
while ($d = $p->fetch(PDO::FETCH_ASSOC)) {
    echo $d['annexe'] . "*";
}
$db = null;
