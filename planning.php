<?php
include './db/connection.php';
$db = connect();
$s = "SELECT distinct dd as dd,  df AS df
    from public.leplanning3 pl
        join devices d on d.id = pl.deviceid
    where datej >= current_date-1 and datej<= current_date and d.id in (select deviceid id from user_device where userid = ?)
         and fonction like ?
    --group by dd
    -- order by dd asc
";
$p = $db->prepare($s);
$p->execute(array($_GET['userid'], $_GET['f']));
while ($d = $p->fetch(PDO::FETCH_ASSOC)) {
    echo $d['dd'] . '|' . $d['df'] . '*';
}
$db = null;
