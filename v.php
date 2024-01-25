<?php
include './db/connection.php';
$db = connect();
$s = "select distinct name from devices 
      where devices.disabled = false and fonction like '%LAVEUSE DE VOIRIE%' --LAVEUSE DE VOIRIE";
$p = $db->prepare($s);
$q = $p->execute();
while ($d = $p->fetch(PDO::FETCH_ASSOC)) {
    echo $d['name'] . '*';
}

$db = null;
