<?php

require './db/connection.php';
$f = fopen('./js/tools0.js', 'w+');
// file_put_contents('./js/balman.js', '');
// file_put_contents('./js/tools.js', '');

/*****************        GetPourcentage             ******************/
$db = connect();

$sqlT = "SELECT count(*) as c1 , 
            (select count(*)::float as c2
            from bacs bb , decoup2 dd 
            where   ST_Contains( dd.geom , ST_SetSRID(ST_MakePoint(bb.longitude, bb.latitude),4326) ) 
                    and  dd.annexe = d.annexe and bb.active = true
            group by annexe
            ), 
            d.annexe from bacs b , decoup2 d 
        where   ST_Contains( d.geom , ST_SetSRID(ST_MakePoint(b.longitude, b.latitude),4326) ) 
            and lastupdate::date = current_date
            and b.active = true
        group by annexe order by annexe";
fwrite($f, " let pourcentages = [];");
$prepT = $db->prepare($sqlT);
$resT = $prepT->execute();
$Pourcentage = array();
$y = 0;
while ($data1 = $prepT->fetch(PDO::FETCH_ASSOC)) {
    $Pourcentage[$data1['annexe']] = round($data1['c1'] / $data1['c2'] * 100, 2);
    fwrite($f, "pourcentages.push([\"" . $data1['annexe'] . "\", " . round($data1['c1'] / $data1['c2'] * 100, 2) . ", " . $data1['c1'] . ", " . $data1['c2'] . "]);");
}
/*************      getAllPlaces       *************/
$sql = "SELECT annexe, idz, st_astext(geom) as plgn  , st_x(st_centroid(geom)) as lt, st_y(st_centroid(geom)) as ln from public.decoup2 order by annexe  ";
$prep = $db->prepare($sql);
$res = $prep->execute();
$y = 0;
$plgn = array();
$idzs = array();
$Tanger = '[';
fwrite($f, " 
    $('#charh').slideUp(120);
    var hhh = 0;
    var tauxLavageBacs = 0;
    var EXP = 'BacsCo';
    var NbrbacsNonLaver = 0;
    var NbrbacsLaver = 0;
    color = ['red','green','blue','yellow'];
    cauche = \"ville\";
    caucheL= 'ville'
    let polygons = [];
    let markersT  = [];
    let markers  = [];
    let markerCir = [];
    let markersL  = [];
    cauche =\"ville\";
    let bacs = [];
    let bacsLaver = [];
    let mecR = [];
    let dirNums = [];
    let CENums = [];
    let AnnCom = [];
    let NAC = [];
    let polyline = [];
    let polylineMec = [];
    let polylineMan = [];
    let markerMec = [];
    let markerMan = [];
    let LavageBacs = [];
    let PolylineMAN = new Map();
    var markerCluster;
    let LavagePolygones = [];
    let mecaniqueEMap = new Map();
    let pourcentagesLavage = new Map();
    let polylineMap = new Map();
    let C_ARTA3501 = [];
    let C_ARTA3502 = [];
    let C_ARTA3401 = [];
    let C_ARTA3501R = [];
    let C_ARTA3502R = [];
    let C_ARTA3401R = [];    
    let l_ARTA3501 = null ;
    let l_ARTA3502 = null ;
    let l_ARTA3401 = null ;
    let bacsParZone = new Map();
    let LavageMap = null;
    const Tanger = { lat : 35.754655  , lng : -5.772959  }; //35.754655, -5.772959
    let polygonTanger = null;
    let polygonLavMan = null;
    let markerLavMan1 = null;
    let markerTanger = null;
    let markerTanger0 = null;
    let TotaleMoyBalMan = 0;
    var map = null;
    function initMap() {
        // The location of Uluru 31.627294, 
        // The map, centered at Tanger
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            mapTypeId: 'terrain',
            center: Tanger,
            mapTypeControl: false,
            disableDefaultUI: true,       
        });
        google.maps.event.addListener(map, 'click', function(){ closeNav(); });
        const icons = {
            rouge: {
              icon: './bacmetal_rouge.png',
            },
            vert: {
              icon: './bacmetal_rouge.png',
            }, 
        };
    ");
/*****************************************/
while ($d = $prep->fetch(PDO::FETCH_ASSOC)) {
    $x1 = substr($d['plgn'], strlen("MULTIPOLYGON((("), strlen($d['plgn']) - 3);
    $x2 = substr($x1, 0, strlen($x1) - 3) . "";


    $Lats_Lngs = explode(',', $x2);
    $plgn[$y] = "[";
    for ($i = 1; $i < count($Lats_Lngs); $i++) {
        $cc = explode(' ', $Lats_Lngs[$i]);
        $x =  "{lat : " . $cc[1] . " , lng : " . $cc[0] . "}, ";
        $plgn[$y] = $plgn[$y] . $x;
    }
    $plgn[$y] = str_replace('))', ' ', $plgn[$y]);
    $plgn[$y] = str_replace('((', ' ', $plgn[$y]);
    $plgn[$y] = str_replace('GON(((', ' ', $plgn[$y]);

    $plgn[$y] = $plgn[$y] . "]";
    if (@$Pourcentage[$d['annexe']] < 30) {
        $colorP = '#F71C10';
    } else if (@$Pourcentage[$d['annexe']] >= 30 and @$Pourcentage[$d['annexe']] < 60) {
        $colorP = '#F0CB46';
    } else {
        $colorP = '#1CEC3F';
    }
    if (@$Pourcentage[$d['annexe']] == null or @$Pourcentage[$d['annexe']] >= 100) {
        $ttl = '0%';
        $colorP = '#F71C10';
    } else {
        $ttl = $Pourcentage[$d['annexe']] . ' %';
    }

    @fwrite($f, "  
            polygons[$y] = new google.maps.Polygon({ paths: $plgn[$y], strokeColor: 'black', id : " . $d['idz'] . ", strokeOpacity: 0.5, strokeWeight: 2, fillColor:  '$colorP',fillOpacity: 0.6,title : 'Detail " . $d['annexe'] . "' });
            //LavagePolygones[$y] = new google.maps.Polygon({ paths: $plgn[$y], strokeColor: 'black', id : " . $d['idz'] . ", strokeOpacity: 0.5, strokeWeight: 2, fillColor:  '$colorP',fillOpacity: 0.6,title : 'Detail " . $d['annexe'] . "' });            
            markersT[$y] = new google.maps.Marker({ position: { lat :" . $d['ln'] . " , lng : " . $d['lt'] . "}, map: null,
            label : { text :'$ttl ',  title: 'Detail : " . $d['nom'] . "', fontSize : '120%', fontWeight : 'bold', color : 'black'
            }, labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : 'None' });
            polygons[$y].setMap(null);
        ") or die("");
    $idzs[$y] = $d['idz'];
    $y = $y + 1;
}
/********** Bacs position ************/

$sqlGM = "SELECT    b.id, b.latitude as lat, b.longitude as lng, d.annexe , b.lastupdate::date as dt, typeb, b.numpark
        from bacs b ,decoup2 d
        where ST_Contains( d.geom , ST_SetSRID(ST_MakePoint(b.longitude, b.latitude),4326) ) and b.active = true  
        order by d.annexe 
    ";
$bacsZones = array();
$prepGM = $db->prepare($sqlGM);
$res = $prepGM->execute();
$c = 0;
while ($data = $prepGM->fetch(PDO::FETCH_ASSOC)) {
    array_push($bacsZones, ["bac" . $data['id'], "{ lat : " . $data['lat'] . ", lng : " . $data['lng']  . " } ", $data['annexe']]);
    fwrite($f, "bacs.push([ new google.maps.Marker({position: { lat : " . $data['lat'] . ", lng : " . $data['lng'] . "},title : '" . $data['numpark'] . "'}) " . ", { lat : " . $data['lat'] . ", lng : " . $data['lng'] . "} , \"" . $data['annexe'] . "\", '" . $data['dt'] . "', '" . $data['typeb'] . "']); ");
    $c++;
}
// $yt = 0;
// $xt = 0;
/*************************      get Tanger maps        **************************/
$sqlTanger = "select st_astext(st_union(geom)) as unionD, st_Y(st_asText(st_centroid(st_union(geom)))) as YT, st_X(st_astext(st_centroid(st_union(geom)))) as XT 
                    from decoup2  ";
$prepTng = $db->prepare($sqlTanger);
$res = $prepTng->execute();
$xt = "";
$yt = "";
$PT = "[";
if ($dc = $prepTng->fetch(PDO::FETCH_ASSOC)) {
    $x1 = substr(str_replace('),(', ' ', $dc['uniond']), strlen("MULTIPOLYGON((("), strlen($dc['uniond']) - 3);
    $x1 = substr($x1, 0, strlen($x1) - 3);
    $Lats_Lng_Tanger = explode(',', $x1);
    for ($tt = 1; $tt < count($Lats_Lng_Tanger); $tt++) {
        $ttt = explode(' ', $Lats_Lng_Tanger[$tt]);
        $PT = $PT .  " { lat : " . $ttt[1] . " , lng : " . $ttt[0] . " }, ";
    }
    $PT = str_replace(')', ' ', $PT);
    $PT = $PT . " ]";
    $xt = $dc['xt'];
    $yt = $dc['yt'];
}
$sqlTTLT = "select (count(*) / (select count(*)::float from bacs bb   where  bb.active=true )*100)::decimal(10,2) as tt   from bacs b  
                where lastupdate::date = current_timestamp::date and b.active = true ";
$TTLT = $db->prepare($sqlTTLT);
$TTLT->execute();
$tauxT = 0;
if ($ttlt = $TTLT->fetch(PDO::FETCH_ASSOC)) {
    $tauxT = $ttlt['tt'];
}
if ($tauxT < 30) {
    $colorT = '#F71C10';
} else if ($tauxT >= 30 and $tauxT < 60) {
    $colorT = '#F0CB46';
} else {
    $colorT = '#1CEC3F';
}
fwrite($f, "
    polygonTanger  = new google.maps.Polygon({ paths: $PT, strokeColor: '#ef1a5d', id : 0 , strokeOpacity: 0.5, strokeWeight: 2, fillColor: '$colorT',fillOpacity: 0.6,title : 'Tanger', map : map });
    polygonLavMan  = new google.maps.Polygon({ paths: $PT, strokeColor: '#ef1a5d',  map : map });
    polygonLavMan.setVisible(false);
    LavageMap  = new google.maps.Polygon({ paths: $PT, map : map });LavageMap.setVisible(false);
    markerTanger =  new google.maps.Marker({ position: { lat :" . $yt . " , lng : " . $xt . "}, map: map,
        label : { text :'$tauxT %',  title: '0', fontSize : '20px', fontWeight : 'bold'
        }, labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : 'None' });

    markerTanger0 =  new google.maps.Marker({ position: Tanger, map: map,
        label : { text :'Taux de Réalisation - collecte',  title: '0', fontSize : '170%', fontWeight : 'bold'}
        , labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : 'None' 
    });
    markerClick =  new google.maps.Marker({ position: {lat: 35.721191, lng: -5.764618 }, map: map,
        labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : './images/hand.png' 
    });
    markerClick0 =  new google.maps.Marker({ position: {lat: 35.721191, lng: -5.764618 }, map: map,visible: false,
    labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : './images/hand.png' });

    markerClick1 =  new google.maps.Marker({ position: {lat: 35.721191, lng: -5.764618 }, map: null, visible: false,
    labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : './images/hand.png' });

    markerLavage =  new google.maps.Marker({ position: { lat :" . $yt . " , lng : " . $xt . "}, map: map,
        label : { text :tauxLavageBacs+'%',  title: '0', fontSize : '20px', fontWeight : 'bold'}, 
        labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : 'None' 
    });

    markerLavage0 =  new google.maps.Marker({ position:  Tanger, map: map,
    label : { text :'Taux de réalisation - Lavage bacs',  title: '0', fontSize : '20px', fontWeight : 'bold'
    }, labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : 'None' });


    markerLavage.setVisible(false);
    markerLavage0.setVisible(false);
    //35.742360, -5.810002
    polygonTanger.setMap(map);
    function showBalManCir(){
        for (var tcp = 0; tcp < polylineMan.length; tcp++) {
            polylineMan[tcp].setVisible(true);
            polylineMan[tcp].setMap(map);
            // markerMan[tcp].setVisible(false);
            // markers.push(markerMan[tcp]);
        }
        CauLavMan = 'C';
        polygonLavMan.setVisible(false);
        markerLavMan.setVisible(false);
        markerLavMan0.setVisible(false);
        markerLavMan1.setVisible(false);
        markerClick1.setVisible(false);
    }

    google.maps.event.addListener(polygonLavMan, 'click', function(event){ showBalManCir(); this.setVisible(false); });
    google.maps.event.addListener(polygonTanger, 'click', function (event) { 
        polygonTanger.setVisible(false);
        markerTanger.setVisible(false);
        markerTanger0.setVisible(false);
        markerClick.setVisible(false);
        document.getElementById('zone').innerHTML = \"Par Zones\"
        cauche = \"zones\";
        // console.log(cauche);
        addCENumber();
        for(var plgns = 0;plgns<$y;plgns++){
            polygons[plgns].setVisible(true); 
            markersT[plgns].setVisible(true);
            polygons[plgns].setMap(map); 
            markersT[plgns].setMap(map);
            polygons[plgns].setOptions({ fillOpacity : 0.7, strokeColor : 'black', strokeWeight : 3 })

        }  
    });
    google.maps.event.addListener(LavageMap, 'click', function (event) { 
        LavageMap.setVisible(false);
        markerLavage.setVisible(false);
        markerLavage0.setVisible(false);
        markerClick0.setVisible(false);
        for(var cpl=0;cpl<markersL.length;cpl++){
            markersL[cpl].setVisible(true);
            markersL[cpl].setMap(map);
        }
        document.getElementById('zone').innerHTML = \"Par Zones\";
        caucheL = \"zones\";
        // console.log(cauche);
        addCENumber();
        for(var plgns = 0;plgns<LavagePolygones.length;plgns++){
            LavagePolygones[plgns].setVisible(true); 
            LavagePolygones[plgns].setMap(map); 
            LavagePolygones[plgns].setOptions({ fillOpacity : 0.7, strokeColor : 'black', strokeWeight : 3 })
            //markersT[plgns].setVisible(true);
        }  
    });
    /****************************************************************/
    google.maps.event.addListener(markerTanger, 'click', function (event) { 
        polygonTanger.setVisible(false);
        markerTanger.setVisible(false);
        markerTanger0.setVisible(false);
        markerClick.setVisible(false);
        document.getElementById('zone').innerHTML = \"Par Zones\"
        cauche = \"zones\";
        // console.log(cauche);
        addCENumber();
        for(var plgns = 0;plgns<$y;plgns++){
            polygons[plgns].setVisible(true); 
            markersT[plgns].setVisible(true);
            polygons[plgns].setMap(map); 
            markersT[plgns].setMap(map);
            polygons[plgns].setOptions({ fillOpacity : 0.7, strokeColor : 'black', strokeWeight : 3 })

        }    
    });        
    google.maps.event.addListener(markerTanger0, 'click', function (event) { 
        polygonTanger.setVisible(false);
        markerTanger.setVisible(false);
        markerTanger0.setVisible(false);
        markerClick.setVisible(false);
        document.getElementById('zone').innerHTML = \"Par Zones\"
        cauche = \"zones\";
        // console.log(cauche);
        addCENumber();
        for(var plgns = 0;plgns<$y;plgns++){
            polygons[plgns].setVisible(true); 
            markersT[plgns].setVisible(true);
            polygons[plgns].setMap(map); 
            markersT[plgns].setMap(map);
            polygons[plgns].setOptions({ fillOpacity : 0.7, strokeColor : 'black', strokeWeight : 3 })

        }  
    });
    google.maps.event.addListener(markerClick, 'click', function (event) { 
        polygonTanger.setVisible(false);
        markerTanger.setVisible(false);
        markerTanger0.setVisible(false);
        markerClick.setVisible(false);
        document.getElementById('zone').innerHTML = \"Par Zones\"
        cauche = \"zones\";
        // console.log(cauche);
        addCENumber();
        for(var plgns = 0;plgns<$y;plgns++){
            polygons[plgns].setVisible(true); 
            markersT[plgns].setVisible(true);
            polygons[plgns].setMap(map); 
            markersT[plgns].setMap(map);
            polygons[plgns].setOptions({ fillOpacity : 0.7, strokeColor : 'black', strokeWeight : 3 })

        }  
    });
    /**************************************************************/
    google.maps.event.addListener(markerLavage, 'click', function (event) { 
        LavageMap.setVisible(false);
        markerLavage.setVisible(false);
        markerLavage0.setVisible(false);
        markerClick0.setVisible(false);
        for(var cpl=0;cpl<markersL.length;cpl++){
            markersL[cpl].setVisible(true);
            markersL[cpl].setMap(map);
        }
        document.getElementById('zone').innerHTML = \"Par Zones\";
        caucheL = \"zones\";
        // console.log(cauche);
        addCENumber();
        for(var plgns = 0;plgns<LavagePolygones.length;plgns++){
            LavagePolygones[plgns].setVisible(true); 
            LavagePolygones[plgns].setMap(map); 
            LavagePolygones[plgns].setOptions({ fillOpacity : 0.7, strokeColor : 'black', strokeWeight : 3 })
            //markersT[plgns].setVisible(true);
        }   
    });
    google.maps.event.addListener(markerLavage0, 'click', function (event) { 
        LavageMap.setVisible(false);
        markerLavage.setVisible(false);
        markerLavage0.setVisible(false);
        markerClick0.setVisible(false);
        for(var cpl=0;cpl<markersL.length;cpl++){
            markersL[cpl].setVisible(true);
            markersL[cpl].setMap(map);
        }
        document.getElementById('zone').innerHTML = \"Par Zones\";
        caucheL = \"zones\";
        // console.log(cauche);
        addCENumber();
        for(var plgns = 0;plgns<LavagePolygones.length;plgns++){
            LavagePolygones[plgns].setVisible(true); 
            LavagePolygones[plgns].setMap(map); 
            LavagePolygones[plgns].setOptions({ fillOpacity : 0.7, strokeColor : 'black', strokeWeight : 3 })
            //markersT[plgns].setVisible(true);
        }      
    });
    google.maps.event.addListener(markerClick0, 'click', function (event) { 
        LavageMap.setVisible(false);
        markerLavage.setVisible(false);
        markerLavage0.setVisible(false);
        markerClick0.setVisible(false);
        for(var cpl=0;cpl<markersL.length;cpl++){
            markersL[cpl].setVisible(true);
            markersL[cpl].setMap(map);
        }
        document.getElementById('zone').innerHTML = \"Par Zones\";
        caucheL = \"zones\";
        // console.log(cauche);
        addCENumber();
        for(var plgns = 0;plgns<LavagePolygones.length;plgns++){
            LavagePolygones[plgns].setVisible(true); 
            LavagePolygones[plgns].setMap(map); 
            LavagePolygones[plgns].setOptions({ fillOpacity : 0.7, strokeColor : 'black', strokeWeight : 3 })
            //markersT[plgns].setVisible(true);
        }  
    });
");


// /*************************      Set places event       *************************/
// //for($p = 0;$p<$y;$p++){
// fwrite($f, "
// for(var t=0;t<polygons.length;t++){
//     polygons[t].setMap(null);
//     markersT[t].setMap(null);
// }
// ");
for ($vv = 0; $vv < $y; $vv++) {
    fwrite($f, "   
        google.maps.event.addListener(polygons[$vv], 'click', function (event) { 
            cauche = \"bacs\";
            document.getElementById('zone').innerHTML = polygons[$vv].title;
            polygons[$vv].setOptions({ fillOpacity : 0.2, strokeColor : 'black', strokeWeight : 3 });
            for(var r=0;r<polygons.length;r++){
                if(r!= $vv){
                    polygons[r].setOptions({ fillOpacity : 0.8, strokeColor : 'black', strokeWeight : 3 });
                }
            }
            for(var cc=0;cc<$c;cc++){
                if(bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ','') ){
                    bacs[cc][0].setMap(map);
                }else{
                    bacs[cc][0].setMap(null);  
                }
                /**************************************/
                if(bacs[cc][3] == \"" . date("Y-m-d") . "\" ){ 
                    if(bacs[cc][4]  == \"COLONNE\"){
                        bacs[cc][0].setIcon('./images/bac_vert.png');
                    }else if(bacs[cc][4]  == \"Bac Galvalisé\"){
                        bacs[cc][0].setIcon('./images/bacmetal_vert.png');
                    }else{
                        bacs[cc][0].setIcon('./images/bacroulantgrand_vert.png');
                    }
                }else{
                    if(bacs[cc][4]  == \"COLONNE\"){
                        bacs[cc][0].setIcon('./images/bac_rouge.png');
                    }else if(bacs[cc][4]  == \"Bac Galvalisé\"){
                        bacs[cc][0].setIcon('./images/bacmetal_rouge.png');
                    }else{
                        bacs[cc][0].setIcon('./images/bacroulantgrand_rouge.png');
                    }
                } 
            }
        });");
}

for ($vv = 0; $vv < $y; $vv++) {
    fwrite($f, "  
        //for(var pl = 0; pl <$y; pl++){
        google.maps.event.addListener(markersT[$vv], 'click', function (event) { 
            cauche = \"bacs\";
            document.getElementById('zone').innerHTML = polygons[$vv].title;
            polygons[$vv].setOptions({ fillOpacity : 0.2, strokeColor : 'black', strokeWeight : 3 });
            for(var r=0;r<polygons.length;r++){
                if(r!= $vv){
                    polygons[r].setOptions({ fillOpacity : 0.8, strokeColor : 'black', strokeWeight : 3 });
                }
            }
            for(var cc=0;cc<$c;cc++){
                if(bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ','') ){
                    bacs[cc][0].setMap(map);
                }else{
                    bacs[cc][0].setMap(null);  
                }
                /**************************************/
                if(bacs[cc][3] == \"" . date("Y-m-d") . "\" ){ 
                    if(bacs[cc][4]  == \"COLONNE\"){
                        bacs[cc][0].setIcon('./images/bac_vert.png');
                    }else{
                        bacs[cc][0].setIcon('./images/bacmetal_vert.png');
                    }
                }else{
                    if(bacs[cc][4]  == \"COLONNE\"){
                        bacs[cc][0].setIcon('./images/bac_rouge.png');
                    }else{
                        bacs[cc][0].setIcon('./images/bacmetal_rouge.png');
                    }
                } 
            }      
        });
        //} 
            ");
}
/********************************************************/
// $sqlCirc =
//     "SELECT tt.*, st_astext(geom) AS pl 
//     from public.\"CIRCUIT_DET2\" 
//         join (  select 
//                 t.id_circuit as idcircuit,t.deviceid,t.circuit,t.conc,t.latcentre,t.loncentre,t.frq,
//                 t.service,t.metcalctaux,t.vehicule,t.fonction,t.groupe,round(avg(t.taux)) as taux
//             from (
//                 SELECT tr.id_circuit,tr.deviceid,tr.id_cirdet,c.\"NOM\" AS circuit,(c.\"NOM\" ||' '||d.name) as conc,
//                     cc.latcentre,cc.loncentre,c.frq,c.service,c.metcalctaux,d.name AS vehicule,d.fonction,g.name AS groupe,
//                     case when  sum(tr.taux) <=100   then sum(tr.taux) 
//                     else 100 
//                     end AS taux
//                 FROM
//                     gps.le_taux_tr3 tr
//                     INNER JOIN public.\"CIRCUIT\" c ON (tr.id_circuit = c.\"IDCIRCUIT\")
//                     INNER JOIN public.centre_circuit cc ON (c.\"IDCIRCUIT\" = cc.idcircuit)
//                     INNER JOIN public.devices d ON (tr.deviceid = d.id)
//                     INNER JOIN public.groups g ON (d.groupid = g.id)
//                 WHERE
//                     tr.dh::date  = current_date AND   
//                     tr.meth =2 
//                     and lower(fonction) like '%bacs%'
//                 GROUP BY
//                     tr.id_circuit,tr.deviceid,tr.id_cirdet,c.\"NOM\",conc,cc.latcentre,cc.loncentre,c.frq,c.service,
//                     c.metcalctaux,d.name,d.fonction,g.name
//                 ) t
//             group BY 
//                 t.id_circuit,t.deviceid,t.circuit,t.conc,t.latcentre,t.loncentre,t.frq,t.service,t.metcalctaux,t.vehicule,
//                 t.fonction,t.groupe
//          ) tt on tt.idcircuit = public.\"CIRCUIT_DET2\".idcircuit
//     ";

// $prepCirc = $db->prepare($sqlCirc);
// $ok = $prepCirc->execute();
// $PLLN = array();
// $polyline = array();
// $itc = 0;
// while ($dci = $prepCirc->fetch(PDO::FETCH_ASSOC)) {
//     $L = $dci['pl'];
//     $PLLN[$itc] = '[';
//     $LL = str_replace('LINESTRING', '', $L);
//     $LL = str_replace(')', '', $LL);
//     $LL = str_replace('(', '', $LL);
//     $A = explode(',', $LL);
//     for ($it = 0; $it < count($A); $it++) {
//         $AA = explode(' ', $A[$it]);
//         $PLLN[$itc] =  $PLLN[$itc] . ' {lat : ' . $AA[1] . ', lng :' . $AA[0] . ' },';
//     }
//     $PLLN[$itc] =  $PLLN[$itc] . ']';
//     $taux = $dci['taux'];
//     $vn = $dci['vehicule'];
//     $cn = $dci['circuit'];
//     $Color = 'black';
//     if ($taux < 30) {
//         $Color = 'red';
//     } else if ($taux < 70 && $taux >= 30) {
//         $Color = 'yellow';
//     } else {
//         $Color = 'green';
//     }
//     fwrite($f, "
//         const line$itc = " . $PLLN[$itc]);
//     fwrite($f, "
//         const polyline$itc = new google.maps.Polyline({path : line$itc,   strokeColor : '$Color', strokeOpacity : 1, strokeWeight : 2});
//         polyline$itc.setMap(map); polyline$itc.setVisible(false);
//         google.maps.event.addListener(polyline$itc, 'click', function(event){swal({text : \"taux Circuit : " . $dci['taux'] . "%\\nCircuit : " . $dci['circuit'] . "\\nVéhicule : " . $dci['vehicule'] . "\",buttons: {ok: \"Ok\",},});})
//         polyline.push(polyline$itc);
//         ");

//     $itc++;
// }

/*****************************************************************/
// $sqlClct =
// "SELECT distinct t1.id, t1.newla, t1.newlo, t1.type, t1.annexe from (
// SELECT 
//     max(vrfid.devicetime) AS devicetime,
//     bacs.numpark AS numparc,
//     devices.name AS véhicule,
//     min(vrfid.lat) AS latitude,
//     min(vrfid.lon) AS longitude,
//     min(vrfid.tag1)::varchar(24) AS identifiant,
//     date(vrfid.devicetime) AS datej,
//     bacs.typeb AS type,
//     devices.fonction,
//     d.annexe,
//     bacs.id,
//     bacs.newla,
//     bacs.newlo
// FROM
//     vrfid
//     INNER JOIN tags ON (vrfid.tag1::text = tags.ntag::text)
//     INNER JOIN bacs ON (tags.idbac = bacs.id)
//     LEFT OUTER JOIN devices ON (vrfid.deviceid = devices.id),
//     decoup2 d 
// WHERE 
//     bacs.active = true   
//     AND devicetime >= current_date - 7
//     and lower(devices.fonction) like '%lavage%' 
//     and ST_Contains( d.geom , ST_SetSRID(ST_MakePoint(bacs.newlo, bacs.newla),4326) ) 
// GROUP BY 
//     bacs.numpark, 
//     devices.name, 
//     datej, 
//     bacs.typeb, 
//     devices.fonction, 
//     bacs.id,
//     d.annexe
//     ) t1
// --     where t1.annexe like '%AA3%'
//     ";
// $prepClct = $db->prepare($sqlClct);
// $ok = $prepClct->execute();
// $bcs = 0;
// while ($dataClct = $prepClct->fetch(PDO::FETCH_ASSOC)) {
//     fwrite($f, "bacsLaver.push([new google.maps.Marker({position: {lat: " . $dataClct['newla'] .
//         ", lng: " . $dataClct['newlo'] . "},map: map, title: '" . $dataClct['id'] . "'}),'" .
//         $dataClct['annexe'] . "', '" . $dataClct['type'] . "']);");
//     $bcs++;
// }
/***************************010101**************************************/
// $sqlMec =
//     "SELECT tt.*, st_astext(geom) AS pl from public.\"CIRCUIT_DET2\" 
//     join (  select 
//                 t.id_circuit as idcircuit,t.deviceid,t.circuit,t.conc,t.latcentre,t.loncentre,t.frq,
//                 t.service,t.metcalctaux,t.vehicule,t.fonction,t.groupe,round(avg(t.taux)) as taux
//             from (
//                 SELECT tr.id_circuit,tr.deviceid,tr.id_cirdet,c.\"NOM\" AS circuit,(c.\"NOM\" ||' '||d.name) as conc,
//                     cc.latcentre,cc.loncentre,c.frq,c.service,c.metcalctaux,d.name AS vehicule,d.fonction,g.name AS groupe,
//                     case when  sum(tr.taux) <=100   then sum(tr.taux) 
//                     else 100 
//                     end AS taux
//                 FROM
//                     gps.le_taux_tr3 tr
//                     INNER JOIN public.\"CIRCUIT\" c ON (tr.id_circuit = c.\"IDCIRCUIT\")
//                     INNER JOIN public.centre_circuit cc ON (c.\"IDCIRCUIT\" = cc.idcircuit)
//                     INNER JOIN public.devices d ON (tr.deviceid = d.id)
//                     INNER JOIN public.groups g ON (d.groupid = g.id)
//                 WHERE
//                     tr.dh  >= current_date + '00:00:00'::time AND   
//                     tr.meth =2 
//                     and lower(fonction) like '%mec%'
//                 GROUP BY
//                     tr.id_circuit,tr.deviceid,tr.id_cirdet,c.\"NOM\",conc,cc.latcentre,cc.loncentre,c.frq,c.service,
//                     c.metcalctaux,d.name,d.fonction,g.name
//                 ) t
//             group BY 
//                 t.id_circuit,t.deviceid,t.circuit,t.conc,t.latcentre,t.loncentre,t.frq,t.service,t.metcalctaux,t.vehicule,
//                 t.fonction,t.groupe
//          ) tt on tt.idcircuit = public.\"CIRCUIT_DET2\".idcircuit
//         ";
// $prepMec = $db->prepare($sqlMec);
// $ok = $prepMec->execute();
// $PLLNMC = array();
// $polylineMec = array();
// $itc0 = 0;
// while ($dcim = $prepMec->fetch(PDO::FETCH_ASSOC)) {
//     $L = $dcim['pl'];
//     $PLLNMC[$itc0] = '[';
//     $LL = str_replace('LINESTRING', '', $L);
//     $LL = str_replace('MULTI', '', $LL);
//     $LL = str_replace(')', '', $LL);
//     $LL = str_replace('(', '', $LL);
//     $A = explode(',', $LL);
//     for ($it = 0; $it < count($A); $it++) {
//         $AA = explode(' ', $A[$it]);
//         $PLLNMC[$itc0] =  $PLLNMC[$itc0] . ' {lat : ' . $AA[1] . ', lng :' . $AA[0] . ' },';
//     }
//     $PLLNMC[$itc0] =  $PLLNMC[$itc0] . ']';
//     if ($dcim['taux'] < 30) {
//         $Color = 'red';
//     }
//     if ($dcim['taux'] < 70 and $dcim['taux'] >= 30) {
//         $Color = 'yellow';
//     }
//     if ($dcim['taux'] >= 70) {
//         $Color = 'green';
//     }
//     fwrite($f, "
//         const lineM$itc0 = " . $PLLNMC[$itc0]);
//     fwrite($f, "
//         const polylineM$itc0 = new google.maps.Polyline({path : lineM$itc0,   strokeColor : '$Color', strokeOpacity : 1, strokeWeight : 2});
//         polylineM$itc0.setMap(map); polylineM$itc0.setVisible(false);
//         polylineMec.push(polylineM$itc0);
//         markerMec.push(new google.maps.Marker({ position: { lat :" . 0 . " , lng : " . 0 . "}, map: map,
//         label : { text :" . $dcim['taux'] . " + '%',  title: ' " . $dcim['taux'] . "', fontSize : '120%', fontWeight : 'bold', color : 'black'
//         }, labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : './circle.png' }));
//         google.maps.event.addListener(polylineM$itc0, 'click', function(){
//             swal({
//                 // text: \"Taux : 12%\\nVéhicule : ATRA***\\nCircui: BGMB41\",
//                 text : 'Taux : " . $dcim['taux'] . "%\\nNom de circuit: " . $dcim['circuit'] . "\\nNom de véhicule : " . $dcim['vehicule'] . "\\n',
//                 buttons: {
//                     ok: \"Ok\",
//                 },
//             })
//         })
//         ");
//     $itc0++;
// }
fwrite($f, "
    for(var t=0;t<polygons.length;t++){
        polygons[t].setMap(null);
        markersT[t].setMap(null);
    }
");

/*****************************************************************/
fwrite($f, " 
    for(var pr = 0;pr<pourcentages.length;pr++){
        pourcentagesLavage.set(pourcentages[pr][0], 0);
        bacsParZone.set(pourcentages[pr][0], pourcentages[pr][3]);    
    }
    var nbrBAcAA19_1 = 0;
    for(var ct=0;ct<bacsLaver.length;ct++){
        bacsLaver[ct][0].setVisible(false); 
        if(bacsLaver[ct][2] == 'COLONNE'){
            bacsLaver[ct][0].setIcon('bac_bleu.png');
        }else{
            bacsLaver[ct][0].setIcon('bacmetal_bleu.png');
        }
         
        pourcentagesLavage.set(bacsLaver[ct][1],pourcentagesLavage.get(bacsLaver[ct][1])+1 );    
    }

    // console.log(nbrBAcAA19_1);
    // console.log(tauxLavageBacs);
    


    ");
$sqlPL = "select annexe, idz, st_astext(geom) as plgn  , st_x(st_centroid(geom)) as lt, st_y(st_centroid(geom)) as ln from public.decoup2  ";
$prepPL = $db->prepare($sqlPL);
$res = $prepPL->execute();
$y = 0;
$plgn = array();
$idzs = array();
$TangerPL = '[';
while ($d = $prepPL->fetch(PDO::FETCH_ASSOC)) {
    //echo $d['idz'] ."<br>"; //.$d['plgn']."<br><br>";
    $x01 = substr($d['plgn'], strlen("MULTIPOLYGON((("), strlen($d['plgn']) - 3);
    $x02 = substr($x01, 0, strlen($x01) - 3) . "";


    $Lats_Lngs = explode(',', $x02);
    $plgn[$y] = "[";
    for ($i = 1; $i < count($Lats_Lngs); $i++) {
        $cc = explode(' ', $Lats_Lngs[$i]);
        $x0 =  "{lat : " . $cc[1] . " , lng : " . $cc[0] . "}, ";
        $plgn[$y] = $plgn[$y] . $x0;
    }
    $plgn[$y] = str_replace('))', ' ', $plgn[$y]);
    $plgn[$y] = str_replace('((', ' ', $plgn[$y]);
    $plgn[$y] = str_replace('GON(((', ' ', $plgn[$y]);

    $plgn[$y] = $plgn[$y] . "]";
    //echo $plgn[$y];
    // const PtsPlgn$y= $plgn[$y];


    @fwrite($f, "
        var colorPL = '';  
        if(pourcentagesLavage.get('" . $d['annexe'] . "')/bacsParZone.get('" . $d['annexe'] . "')*100<30){
            colorPL = 'red';
        }else if(pourcentagesLavage.get('" . $d['annexe'] . "')/bacsParZone.get('" . $d['annexe'] . "')*100>=30 && pourcentagesLavage.get('" . $d['annexe'] . "')/bacsParZone.get('" . $d['annexe'] . "')*100<70){
            colorPL = 'yellow';
        }else{
            colorPL = 'green'
        }
        
        // console.log(colorPL, '" . $d['annexe'] . "');
        var txtlbl = (pourcentagesLavage.get('" . $d['annexe'] . "')/bacsParZone.get('" . $d['annexe'] . "')*100);
        if(txtlbl > 100) txtlbl = 100;
        LavagePolygones[$y] = new google.maps.Polygon({ paths: $plgn[$y], strokeColor: 'black', id : " . $d['idz'] . ", strokeOpacity: 0.5, strokeWeight: 2, fillColor:  colorPL,fillOpacity: 0.6,title : 'Detail " . $d['annexe'] . "' });            
        markersL[$y] = new google.maps.Marker({ position: { lat :" . $d['ln'] . " , lng : " . $d['lt'] . "}, map: map,
        label : { text :txtlbl.toFixed(2) + '%',  title: 'Detail : " . $d['nom'] . "', fontSize : '120%', fontWeight : 'bold', color : 'black'
        }, labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : 'None' });
        markersL[$y].setVisible(false);
    ") or die("");
    $idzs[$y] = $d['idz'];
    $y = $y + 1;
}
for ($vv = 0; $vv < $y; $vv++) {
    fwrite($f, "  
        //for(var pl = 0; pl <$y; pl++){
        google.maps.event.addListener(LavagePolygones[$vv], 'click', function (event) { 
            caucheL = \"bacs\";
            document.getElementById('zone').innerHTML = LavagePolygones[$vv].title;
            LavagePolygones[$vv].setOptions({ fillOpacity : 0.2, strokeColor : 'black', strokeWeight : 3 });
            for(var r=0;r<LavagePolygones.length;r++){
                if(r!= $vv){
                    LavagePolygones[r].setOptions({ fillOpacity : 0.8, strokeColor : 'black', strokeWeight : 3 });
                }
            }
            for(var cc=0;cc<bacsLaver.length;cc++){
                if(bacsLaver[cc][1] == document.getElementById('zone').innerHTML.replace('Detail ', '')){
                    bacsLaver[cc][0].setVisible(true);
                    bacsLaver[cc][0].setMap(map);
                }else{
                    bacsLaver[cc][0].setVisible(false);
                }
            }
        });  
    ");
}
for ($vv = 0; $vv < $y; $vv++) {
    fwrite($f, "  
        //for(var pl = 0; pl <$y; pl++){
        google.maps.event.addListener(markersL[$vv], 'click', function (event) { 
            caucheL = \"bacs\";
            document.getElementById('zone').innerHTML = LavagePolygones[$vv].title;
            LavagePolygones[$vv].setOptions({ fillOpacity : 0.2, strokeColor : 'black', strokeWeight : 3 });
            for(var r=0;r<LavagePolygones.length;r++){
                if(r!= $vv){
                    LavagePolygones[r].setOptions({ fillOpacity : 0.8, strokeColor : 'black', strokeWeight : 3 });
                }
            }
            for(var cc=0;cc<bacsLaver.length;cc++){
                if(bacsLaver[cc][1] == document.getElementById('zone').innerHTML.replace('Detail ', '')){
                    bacsLaver[cc][0].setVisible(true);
                    bacsLaver[cc][0].setMap(map);
                }else{
                    bacsLaver[cc][0].setVisible(false);
                }
            }        
        });
        
        //} 
            ");
}
fwrite($f, " //tauxLavageBacs = bacsLaver.length/bacs.length*100;
        for(let i=0;i<markersL.length;i++){
            tauxLavageBacs += Number(markersL[i].label.text.replace('%',''));
        }
        console.log(tauxLavageBacs/15);
    markerLavage =  new google.maps.Marker({ position: { lat :" . $yt . " , lng : " . $xt . "}, map: map,
    label : { text :(tauxLavageBacs/15).toFixed(2) +'%',  title: '0', fontSize : '20px', fontWeight : 'bold'
    }, labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : 'None' });
    markerLavage.setVisible(false);
    google.maps.event.addListener(markerLavage, 'click', function (event) { 
        caucheL ='bacs'
        LavageMap.setVisible(false);
        markerLavage.setVisible(false);
        markerLavage0.setVisible(false);
        markerClick0.setVisible(false);
        for(var cpl=0;cpl<markersL.length;cpl++){
            markersL[cpl].setVisible(true); 
            // bacsLaver[][0].setMap(map);
        }  
        document.getElementById('zone').innerHTML = \"Par Zones\";
        caucheL = \"zones\";
        console.log(caucheL);
        addCENumber();
        for(var plgns = 0;plgns<LavagePolygones.length;plgns++){
            LavagePolygones[plgns].setMap(map); 
            LavagePolygones[plgns].setVisible(true); 
            //markersT[plgns].setVisible(true);
        }  
    });
} //fin initMap
");

fwrite($f, "
    window.initMap = initMap;

    // var mapH = document.getElementById('map').offsetHeight;
    // var ttlH = document.getElementById('title').offsetHeight;
    var stx = 0;
    function rje3( ) { 
        $('#charh').slideUp(120);
        /*if(stx==1){
            for(var rm = 0; rm<bacs.length;rm++){
                bacs[rm][0].setVisible(true);
            }
            for(var rp=0;rp<polygons.length;rp++){
                polygons[rp].setVisible(true);
                markersT[rp].setVisible(true);
            }
            polygonTanger.setVisible(true);
            markerTanger.setVisible(false);
            for(var sp=0;sp<polyline.length;sp++){
                polyline[sp].setVisible(false);
            }
            stx=0;
            cauche = \"zones\"
        }*/
        // document.querySelector('#map').classList.remove('map2'); 
        // console.log('EMpty');
        if(cauche == 'ville'){
            // console.log('Ville');
        }else if(cauche == 'zones'){

            $('#uls').empty();
            addDirNums();
            polygonTanger.setVisible(true);
            polygonTanger.Center = markerTanger.position;
            map.Cenetr = markerTanger.position;
            markerTanger.setVisible(true);
            markerTanger0.setVisible(true);
            markerClick.setVisible(true);
	        cauche = 'ville'; 
            for(var p=0;p<polygons.length;p++){
                polygons[p].setVisible(false); 
                markersT[p].setVisible(false);  
            }
            $('#zone').text('ville');
        }else if(cauche == 'bacs'){
            // markerClustersetMap(null);
            // var cdcd = document.getElementById('map').offsetHeight;
            hhh=0;
            $('#statitstics').attr('hidden', true); 
            for(var bcs = 0; bcs<bacs.length; bcs++){
                bacs[bcs][0].setMap(null); 
            }
            for(var pls = 0; pls < polygons.length; pls++){
                polygons[pls].setOptions({ fillOpacity : 0.7, strokeColor : 'black', strokeWeight : 3 })
            }
            for(var rm = 0; rm<bacs.length;rm++){
                bacs[rm][0].setVisible(true);
                bacs[rm][0].setMap(null);
            }
            $('#zone').text('Par Zones'); 
            cauche = 'zones';
            // // console.log(cauche);
        }
        for(var sp=0;sp<polyline.length;sp++){
            polyline[sp].setVisible(false);
        }
    }
    function rje32( ) { 

        if(caucheL == 'ville'){
            // console.log('Ville');
        }else if(caucheL == 'zones'){
            $('#uls').empty();
            addDirNums();
            LavageMap.setVisible(true); 
            markerLavage.setVisible(true);
            markerLavage0.setVisible(true);
            markerClick0.setVisible(true);
            LavageMap.setMap(map); 
            markerLavage.setMap(map);
            markerLavage0.setMap(map);
            markerClick0.setMap(map);
	        caucheL = 'ville'; 
            for(var p=0;p<LavagePolygones.length;p++){ 
                LavagePolygones[p].setVisible(false);  
                markersL[p].setVisible(false); 
            }
            $('#zone').text('ville');
        }else if(caucheL == 'bacs'){
            // var cdcd = document.getElementById('map').offsetHeight;
            hhh=0;
            $('#statitstics').attr('hidden', true); 
            for(var bcs = 0; bcs<bacsLaver.length; bcs++){
                bacsLaver[bcs][0].setMap(null); 
            }
            for(var pls = 0; pls < LavagePolygones.length; pls++){
                LavagePolygones[pls].setOptions({ fillOpacity : 0.7, strokeColor : 'black', strokeWeight : 3 });
                markersL[pls].setVisible(true);
                markersL[pls].setMap(map);
            }
            for(var rm = 0; rm<bacsLaver.length;rm++){
                bacsLaver[rm][0].setVisible(true);
                bacsLaver[rm][0].setMap(null);
            }
            $('#zone').text('Par Zones'); 
            caucheL = 'zones';
            // // console.log(cauche);
        }
        for(var sp=0;sp<polyline.length;sp++){
            polyline[sp].setVisible(false);
        }
    }
    function rje33(){
        if(CauLavMan =='C'){
            for (var tcp = 0; tcp < polylineMan.length; tcp++) {
                polylineMan[tcp].setVisible(false);
            }
            CauLavMan = 'C';
            polygonLavMan.setVisible(true);
            markerLavMan.setVisible(true);
            markerLavMan0.setVisible(true);
            markerLavMan1.setVisible(true);
            // markerClick1.setVisible(true);
            CauLavMan = 'P'
        }else{
            for (var tcp = 0; tcp < polylineMan.length; tcp++) {
                polylineMan[tcp].setVisible(true);
            }
            CauLavMan = 'C';
            polygonLavMan.setVisible(false);
            markerLavMan.setVisible(false);
            markerLavMan0.setVisible(false);
            markerClick1.setVisible(false);
            CauLavMan = 'P'
        }
    }
    $('#imgWait').fadeOut(10);
    console.log('end of file');
");

$sqlGNums = "select * from whatsapp where zone='0' order by id";
$prepGnums = $db->prepare($sqlGNums);
$prepGnums->execute();
while ($dn = $prepGnums->fetch(PDO::FETCH_ASSOC)) {
    fwrite($f, "dirNums.push([" . $dn['id'] . ", \"" . $dn['nom'] . "\", \"" . $dn['numero'] . "\", \"" . $dn['nature'] . "\"]); ");
}
$sqlGNums = "select * from whatsapp where zone != '0' and secteur = '0' order by id";
$prepGnums = $db->prepare($sqlGNums);
$prepGnums->execute();
while ($dn = $prepGnums->fetch(PDO::FETCH_ASSOC)) {
    fwrite($f, "CENums.push([" . $dn['id'] . ", \"" . $dn['nom'] . "\", \"" . $dn['numero'] . "\", \"" . $dn['nature'] . "\"]);");
}
fclose($f);
