<?php
include './db/connection.php';
$db = connect();
$q = "SELECT nom, numero, nature FROM public.respensables 
        where zone = '0' 
        or secteur like  (
            select zone from public.user_zones where userid = ?
        )
    ";
$p = $db->prepare($q);
$ok = $p->execute([$_GET['userid']]);
while ($d = $p->fetch(PDO::FETCH_ASSOC)) {
    echo $d["nom"] . "," . $d["numero"] . "," . $d["nature"] . ";";
}
$db = null;
