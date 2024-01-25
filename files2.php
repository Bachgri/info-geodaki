<?php
include './db/connection.php';
$db = connect();
$s = "SELECT  
    round(avg(t.taux)) as taux 
    from (
        SELECT tr.id_circuit,tr.deviceid,tr.id_cirdet,c.\"NOM\" AS circuit,(c.\"NOM\" ||' '||d.name) as conc,
        cc.latcentre,cc.loncentre,c.frq,c.service,c.metcalctaux,d.name AS vehicule,d.fonction,g.name AS groupe,
        secteur,
        case when  sum(tr.taux) <=100   then sum(tr.taux) 
        else 100 
        end AS taux
    FROM
        gps.le_taux_tr3 tr
        INNER JOIN public.\"CIRCUIT\" c ON (tr.id_circuit = c.\"IDCIRCUIT\")
        INNER JOIN public.centre_circuit cc ON (c.\"IDCIRCUIT\" = cc.idcircuit)
        INNER JOIN public.devices d ON (tr.deviceid = d.id)
        INNER JOIN public.groups g ON (d.groupid = g.id)
    WHERE
        tr.dh   >= current_date + '00:00:00'::time AND   
        tr.meth =1  AND secteur != ''
    GROUP BY
        secteur, tr.id_circuit,tr.deviceid,tr.id_cirdet,c.\"NOM\",conc,cc.latcentre,cc.loncentre,c.frq,c.service,
        c.metcalctaux,d.name,d.fonction,g.name
    ) t
";
$p = $db->prepare($s);
$p->execute();
if ($d = $p->fetch(PDO::FETCH_ASSOC)) {
    echo $d['taux'];
}
