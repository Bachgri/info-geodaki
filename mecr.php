<?php
include './db/connection.php';
$db = connect();
$q = "SELECT   
        public.\"CIRCUIT\".\"IDCIRCUIT\",
        \"NOM\", 
        pl.datej,  
        round(avg(taux)) as taux, 
        name
    from 
        public.\"CIRCUIT\" 
        join gps.le_taux_tr3 on gps.le_taux_tr3.id_circuit = public.\"CIRCUIT\".\"IDCIRCUIT\"
        join public.devices on gps.le_taux_tr3.deviceid = public.devices.id
        join public.leplanning pl on (pl.deviceid = devices.id and pl.idcircuit = \"CIRCUIT\".\"IDCIRCUIT\")
    where  
        pl.datej = current_date and
        le_taux_tr3.datej = current_date and
        lower(nature) like '%mec%'
    group by   public.\"CIRCUIT\".\"IDCIRCUIT\", \"NOM\",  name, pl.datej 
    order by \"NOM\"
";
$p = $db->prepare($q);
$p->execute();
while ($d = $p->fetch(PDO::FETCH_ASSOC)) {
    echo  $d['NOM'] . "," . $d['name'] . "," . $d['taux'] . ";";
}
