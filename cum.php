<?php
include './db/connection.php';
$db = connect();
$p = $db->prepare("SELECT distinct annexe from user_decoup join decoup  on id = decoupid where  userid = ?");
$p->execute(array($_GET['user']));
if ($d = $p->fetch(PDO::FETCH_ASSOC))
    echo $d['commune'];
$db = null;
