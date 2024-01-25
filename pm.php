<?php
include './db/connection.php';
$db = connect();
$sqlGNums = "SELECT latitude, longitude, fixtime
        from positions 
            join devices on deviceid = devices.id
            and fixtime >= current_date + '00:00:00'::time
            and name = ?
        ORDER BY fixtime
";
$prepGnums = $db->prepare($sqlGNums);
$prepGnums->execute([$_GET['mo']]);
echo json_encode($prepGnums->fetchAll());
// while ($dn = $prepGnums->fetch(PDO::FETCH_ASSOC)) {
//     echo  $dn['name'] . ",";
// }

$db = null;
