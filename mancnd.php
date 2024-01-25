
<?php
include('./db/connection.php');
$f = fopen('./js/voirie.js', "w+");
$bd = connect();
$sql =
    "SELECT tt.circuit, tt.vehicule, tt.taux, tt.fonction , st_astext(geom) AS pl 
    from public.\"CIRCUIT_DET2\" 
        join (  
            select 
                t.id_circuit as idcircuit,t.deviceid,t.circuit,t.conc,t.latcentre,t.loncentre,t.frq,
                t.service,t.metcalctaux,t.vehicule,t.fonction,round(avg(t.taux)) as taux
            from (
                SELECT tr.id_circuit,tr.deviceid,tr.id_cirdet,c.\"NOM\" AS circuit,(c.\"NOM\" ||' '||d.name) as conc,
                    cc.latcentre,cc.loncentre,c.frq,c.service,c.metcalctaux,d.name AS vehicule,d.fonction,
                    case when  sum(tr.taux) <=100   then sum(tr.taux) 
                    else 100 
                    end AS taux
                FROM
                    gps.le_taux_tr3 tr
                    INNER JOIN public.\"CIRCUIT\" c ON (tr.id_circuit = c.\"IDCIRCUIT\")
                    INNER JOIN public.centre_circuit cc ON (c.\"IDCIRCUIT\" = cc.idcircuit)
                    INNER JOIN public.devices d ON (tr.deviceid = d.id) 
                    JOIN public.leplanning3 pl on (pl.idcircuit = cc.idcircuit)
                WHERE
                    pl.datej = current_date and
                    (pl.dd>= current_date + ?::time and 
                        pl.dd< current_date + ?::time) and 
                    tr.dh::date  = current_date AND   
                    tr.meth = 2 
                    and lower(fonction) like '%bac%'
                GROUP BY
                    tr.id_circuit,tr.deviceid,tr.id_cirdet,c.\"NOM\",conc,cc.latcentre,cc.loncentre,c.frq,c.service,
                    c.metcalctaux,d.name,d.fonction
                ) t
            group BY 
                t.id_circuit,t.deviceid,t.circuit,t.conc,t.latcentre,
                t.loncentre,t.frq,t.service,t.metcalctaux,t.vehicule,
                t.fonction
         ) tt on tt.idcircuit = public.\"CIRCUIT_DET2\".idcircuit
    ";
$prep = $bd->prepare($sql);
$ok = $prep->execute(array($_POST['dd'], $_POST['df']));

while ($d = $prep->fetch(PDO::FETCH_ASSOC)) {
    echo $d['pl'] . ";" . $d['taux'] . ";" . $d['circuit'] . ";" . $d['vehicule'] . "*";
}

// function distance($lat1, $lng1, $lat2, $lng2, $miles = false)
// {
//     $pi80 = M_PI / 180;
//     $lat1 *= $pi80;
//     $lng1 *= $pi80;
//     $lat2 *= $pi80;
//     $lng2 *= $pi80;

//     $r = 6372.797; // rayon moyen de la Terre en km
//     $dlat = $lat2 - $lat1;
//     $dlng = $lng2 - $lng1;
//     $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
//     $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
//     $km = $r * $c;

//     return ($miles ? ($km * 0.621371192) : $km);
// }


?>