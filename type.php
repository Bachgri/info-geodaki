<?php
include './db/connection.php';
$db = connect();
$s = "select distinct typeb from bacs where active = 'true'";
$p = $db->prepare($s);
$q = $p->execute();
while ($d = $p->fetch(PDO::FETCH_ASSOC)) {
    echo $d['typeb'] . '*';
}

$db = null;
