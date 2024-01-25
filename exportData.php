<?php
$f0 = fopen('./js/export.js', 'w');
$sqlNAC = "SELECT COUNT(annexe), commune FROM decoup2 group by commune";
$prepNAC = $db->prepare($sqlNAC);
$prepNAC->execute();
while ($dNAC = $prepNAC->fetch(PDO::FETCH_ASSOC)) {
    fwrite(
        $f0,
        "NAC.push([ \"" .  $dNAC['commune'] . "\", \"" . $dNAC['count'] . "\" ]);
        "
    );
}
$sqlED = "select annexe, commune from decoup2 order by annexe ";
$prepED = $db->prepare($sqlED);
$prepED->execute();
$cnt = 0;
while ($dED = $prepED->fetch(PDO::FETCH_ASSOC)) {
    fwrite(
        $f0,
        "AnnCom.push([ $cnt ,\"" . $dED['annexe'] . "\", \"" . $dED['commune'] . "\" ]);
        "
    );
    $cnt++;
}
$sqlGC =
    "SELECT 
    t.id_circuit as idcircuit,t.deviceid,t.circuit as circuit,t.conc,t.latcentre,t.loncentre,t.frq,
    t.service,t.metcalctaux,t.vehicule as vehicule,t.fonction,t.groupe,round(avg(t.taux)) as taux
    from (
        SELECT tr.id_circuit,tr.deviceid,tr.id_cirdet,c.\"NOM\" AS circuit,(c.\"NOM\" ||' '||d.name) as conc,
            cc.latcentre,cc.loncentre,c.frq,c.service,c.metcalctaux,d.name AS vehicule,d.fonction,g.name AS groupe,
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
            tr.dh::date  = current_date AND   
            tr.meth =2 
            and lower(fonction) like '%bac%'
        GROUP BY
            tr.id_circuit,tr.deviceid,tr.id_cirdet,c.\"NOM\",conc,cc.latcentre,cc.loncentre,c.frq,c.service,
            c.metcalctaux,d.name,d.fonction,g.name
    ) t
group BY 
    t.id_circuit,t.deviceid,t.circuit,t.conc,t.latcentre,t.loncentre,t.frq,t.service,t.metcalctaux,t.vehicule,
    t.fonction,t.groupe
";
$pgc = $db->prepare($sqlGC);
$pgc->execute();
$i = 0;
while ($d = $pgc->fetch(PDO::FETCH_ASSOC)) {
    fwrite($f0, "
    polylineMap.set($i, ['" . $d['circuit'] . "', '" . $d['vehicule'] . "', '" . $d['taux'] . "']);
    ");
    $i++;
}
// /****************************************************************************************/


$q = "SELECT   
public.\"CIRCUIT\".\"IDCIRCUIT\",
\"NOM\" as circuit, 
pl.datej,  
round(avg(taux)) as taux, 
name as vehicule
from 
public.\"CIRCUIT\" 
join gps.le_taux_tr3 on gps.le_taux_tr3.id_circuit = public.\"CIRCUIT\".\"IDCIRCUIT\"
join public.devices on gps.le_taux_tr3.deviceid = public.devices.id
join public.leplanning pl on (pl.deviceid = devices.id and pl.idcircuit = \"CIRCUIT\".\"IDCIRCUIT\")
where  
pl.datej = current_date and
le_taux_tr3.datej = current_date and
lower(nature) like '%mec%'
and pl.datej = current_timestamp::date
group by   public.\"CIRCUIT\".\"IDCIRCUIT\", \"NOM\",  name, pl.datej 
order by \"NOM\"
";
$p = $db->prepare($q);
$p->execute();
while ($d = $p->fetch(PDO::FETCH_ASSOC)) {
    fwrite($f0, "
        mecR.push(['" . $d['circuit'] . "', '" . $d['vehicule'] . "', '" . $d['taux'] . "']); 
    ");
}

/*********************************************************************************************/
fclose($f0);
