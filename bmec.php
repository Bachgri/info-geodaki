<?php
include './db/connection.php';
$db = connect();

$sql =
  "WITH t as (
    SELECT tr3.id_cirdet,tr3.id_circuit,
      tr3.deviceid,tr3.lt as ltr,tr3.meth,tr3.pl,case when SUM(tr3.taux)<=100  then SUM(tr3.taux) else 100 end taux
    FROM
      gps.le_taux_tr3 tr3
    WHERE tr3.dh >= ?::timestamp AND tr3.dh <= ?::timestamp AND tr3.meth in (1, 2)
    GROUP BY tr3.id_cirdet,tr3.id_circuit,tr3.deviceid,tr3.lt,tr3.meth,tr3.pl
),
tt as (
    select d.id, d.fonction, cr.\"IDCIRCUIT\" as idcircuit, round(sum(t.ltr/(lc.lt*1000)*t.taux)) as taux,
        cr.\"NOM\" as circuit,cr.frq, d.name as vehicule, pl.dd, pl.df
    FROM
        public.\"CIRCUIT\" cr INNER JOIN t ON (cr.\"IDCIRCUIT\" = t.id_circuit) 
        INNER JOIN public.devices d ON (t.deviceid = d.id) and t.pl=1 INNER JOIN public.longueur_circuit lc ON (cr.\"IDCIRCUIT\" = lc.id) 
        INNER JOIN PUBLIC.leplanning3 pl on pl.deviceid = d.id 
    where pl.datej >= current_date-1  AND pl.datej <= current_date  --and fonction = 'BALAYAGE MECANIQUE'
        --and dd >= ?::timestamp 
        --and dd < ?::timestamp
    group by  d.fonction,pl.dd, pl.df,cr.\"NOM\",cr.frq,cr.service,cr.\"IDCIRCUIT\", d.name, d.id
    order by cr.\"NOM\"
)
-- select tt.circuit, tt.vehicule, tt.taux , st_astext(crd.geom) as pl, 
--         tt.dd, tt.df, tt.fonction
-- from tt join public.\"CIRCUIT_DET2\" crd on crd.idcircuit =  tt.idcircuit
-- where  --tt.fonction like '%MECANIQUE' and
--      tt.id in(select deviceid from user_device where userid = ?) 
-- order by circuit
  select 
		tt.circuit, tt.vehicule, tt.taux , st_astext(routes.geom) as pl, tt.dd, tt.df
  from 
		tt 
		join public.\"CIRCUIT_DET2\" crd on crd.idcircuit =  tt.idcircuit
		join public.routes on crd.idroutes = routes.ogc_fid
  where tt.id in(select deviceid from user_device where userid = ?)
  order by circuit
";
$prep = $db->prepare($sql);
$ok = $prep->execute([$_GET['dd'], $_GET['df'], $_GET['iduser']]);

while ($d = $prep->fetch(PDO::FETCH_ASSOC)) {
  if ($d['fonction'] == 'BALAYAGE MECANIQUE') {
    echo $d['pl'] . ";" . $d['taux'] . ";" . $d['circuit'] . ";" . $d['vehicule'] . ";" . $d['dd'] . ";" . $d['df'] . "*";
  }
}
