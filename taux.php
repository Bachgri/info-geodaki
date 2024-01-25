<?php
include('./db/connection.php');
$f = fopen('./js/voirie.js', "w+");
$bd = connect();
$sql =
    "WITH t as ( 
        SELECT tr3.datej,tr3.id_cirdet,tr3.id_circuit,
          tr3.deviceid,tr3.lt as ltr,tr3.meth,tr3.pl,case when SUM(tr3.taux)<=100  then SUM(tr3.taux) else 100 end taux
        FROM
          gps.le_taux_tr3 tr3
        WHERE tr3.dh >= current_date + '05:00:00'::time AND tr3.dh <= current_date + '14:00:00'::time AND tr3.meth =1
        GROUP BY tr3.datej,tr3.id_cirdet,tr3.id_circuit,tr3.deviceid,tr3.lt,tr3.meth,tr3.pl
    ),
    tt as (
        select d.id,t.datej, cr.\"IDCIRCUIT\" as idcircuit, round(sum(t.ltr/(lc.lt*1000)*t.taux)) as taux,
            cr.\"NOM\" as circuit,cr.frq, d.name as vehicule, pl.dd, pl.df
        FROM
            public.\"CIRCUIT\" cr INNER JOIN t ON (cr.\"IDCIRCUIT\" = t.id_circuit) 
            INNER JOIN public.devices d ON (t.deviceid = d.id) and t.pl=1 INNER JOIN public.longueur_circuit lc ON (cr.\"IDCIRCUIT\" = lc.id) 
            INNER JOIN PUBLIC.leplanning3 pl on pl.deviceid = d.id 
        where pl.datej = current_date and dd >= current_date + '05:00:00'::time 
        and dd < current_date + '20:00:00'::time
        group by t.datej,pl.dd, pl.df,cr.\"NOM\",cr.frq,cr.service,cr.\"IDCIRCUIT\", d.name, d.id
        order by cr.\"NOM\"
    )
    select tt.circuit, tt.vehicule, tt.taux , --st_astext(crd.geom) as pl, 
    tt.dd, tt.df
    from tt --join public.\"CIRCUIT_DET2\" crd on crd.idcircuit =  tt.idcircuit

    order by circuit
    ";
$prep = $bd->prepare($sql);
$ok = $prep->execute();

while ($d = $prep->fetch(PDO::FETCH_ASSOC)) {
    echo $d['taux'] . ";" . $d['circuit'] . ";" . $d['vehicule'] . "*";
}
