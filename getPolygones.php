<?php

require './db/connection.php';
$f = fopen('./js/tools0.js', 'w+');
/*****************        GetPourcentage             ******************/
$db = connect();

$sqlT = "select count(*) as c1 , (select count(*)::float as c2
                from bacs bb , decoup2 dd 
                where   ST_Contains( dd.geom , ST_SetSRID(ST_MakePoint(bb.longitude, bb.latitude),4326) ) 
                        and  dd.annexe = d.annexe 
                group by annexe)
                 
            , d.annexe from bacs b , decoup2 d 
            where   ST_Contains( d.geom , ST_SetSRID(ST_MakePoint(b.longitude, b.latitude),4326) ) and lastupdate::date = current_timestamp::date  
            group by annexe order by annexe";
fwrite($f, "
            let pourcentages = [];");
$prepT = $db->prepare($sqlT);
$resT = $prepT->execute();
$Pourcentage = array();
$y = 0;
while ($data1 = $prepT->fetch(PDO::FETCH_ASSOC)) {
    $Pourcentage[$data1['annexe']] = round($data1['c1'] / $data1['c2'] * 100, 2);
    fwrite($f, "pourcentages.push([\"" . $data1['annexe'] . "\", " . round($data1['c1'] / $data1['c2'] * 100, 2) . ", " . $data1['c1'] . ", " . $data1['c2'] . "]);");
}
/*************      getAllPlaces       *************/
$sql = "select annexe, idz, st_astext(geom) as plgn  , st_x(st_centroid(geom)) as lt, st_y(st_centroid(geom)) as ln from public.decoup2  ";
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
    var markerCluster;
    let LavagePolygones = [];
    let pourcentagesLavage = new Map();
    let bacsParZone = new Map();
    let LavageMap = null;
    const Tanger = { lat : 35.754655  , lng : -5.772959  }; //35.754655, -5.772959
    let polygonTanger = null;
    let markerTanger = null;
    let markerTanger0 = null;
    var map = null;
    function initMap() {
        // The location of Uluru 31.627294, 
        // The map, centered at Tanger
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            mapTypeId: 'satellite',
            center: Tanger,
            mapTypeControl: false,
            disableDefaultUI: true,       
        });
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
    //echo $d['idz'] ."<br>"; //.$d['plgn']."<br><br>";
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
    //echo $plgn[$y];
    // const PtsPlgn$y= $plgn[$y];
    if (@$Pourcentage[$d['annexe']] < 30) {
        $colorP = '#F71C10';
    } else if (@$Pourcentage[$d['annexe']] >= 30 and @$Pourcentage[$d['annexe']] < 60) {
        $colorP = '#F0CB46';
    } else {
        $colorP = '#1CEC3F';
    }
    if (@$Pourcentage[$d['annexe']] == null or @$Pourcentage[$d['annexe']] == 100) {
        $ttl = '0%';
        $colorP = '#F71C10';
    } else {
        $ttl = $Pourcentage[$d['annexe']] . ' %';
    }

    @fwrite($f, "  
            polygons[$y] = new google.maps.Polygon({ paths: $plgn[$y], strokeColor: 'black', id : " . $d['idz'] . ", strokeOpacity: 0.5, strokeWeight: 2, fillColor:  '$colorP',fillOpacity: 0.6,title : 'Detail " . $d['annexe'] . "' });
            //LavagePolygones[$y] = new google.maps.Polygon({ paths: $plgn[$y], strokeColor: 'black', id : " . $d['idz'] . ", strokeOpacity: 0.5, strokeWeight: 2, fillColor:  '$colorP',fillOpacity: 0.6,title : 'Detail " . $d['annexe'] . "' });            
            markersT[$y] = new google.maps.Marker({ position: { lat :" . $d['ln'] . " , lng : " . $d['lt'] . "}, map: map,
            label : { text :'$ttl ',  title: 'Detail : " . $d['nom'] . "', fontSize : '120%', fontWeight : 'bold', color : 'black'
            }, labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : 'None' });
            polygons[$y].setMap(map);
        ") or die("");
    $idzs[$y] = $d['idz'];
    $y = $y + 1;
}
/********** Bacs position ************/

$sqlGM = "select    b.id, b.latitude as lat, b.longitude as lng, d.annexe , b.lastupdate::date as dt, typeb, b.numpark
        from bacs b ,decoup2 d
        where ST_Contains( d.geom , ST_SetSRID(ST_MakePoint(b.longitude, b.latitude),4326) ) and b.active = 'true'  
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
    LavageMap  = new google.maps.Polygon({ paths: $PT, map : map });LavageMap.setVisible(false);
    markerTanger =  new google.maps.Marker({ position: { lat :" . $yt . " , lng : " . $xt . "}, map: map,
        label : { text :'$tauxT %',  title: '0', fontSize : '20px', fontWeight : 'bold'
        }, labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : 'None' });
    
    markerTanger0 =  new google.maps.Marker({ position: Tanger, map: map,
    label : { text :'Taux de Réalisation de la collecte',  title: '0', fontSize : '170%', fontWeight : 'bold'
    }, labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : 'None' });
    markerClick =  new google.maps.Marker({ position: {lat: 35.721191, lng: -5.764618 }, map: map,
    labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : './images/hand.png' });
    markerClick0 =  new google.maps.Marker({ position: {lat: 35.721191, lng: -5.764618 }, map: map,
    labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : './images/hand.png' });

    markerLavage =  new google.maps.Marker({ position: { lat :" . $yt . " , lng : " . $xt . "}, map: map,
    label : { text :tauxLavageBacs+'%',  title: '0', fontSize : '20px', fontWeight : 'bold'
    }, labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : 'None' });
    markerLavage0 =  new google.maps.Marker({ position:  Tanger, map: map,
    label : { text :'Taux de réalisation de Lavage',  title: '0', fontSize : '20px', fontWeight : 'bold'
    }, labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : 'None' });
    markerLavage.setVisible(false);
    markerLavage0.setVisible(false);
    //35.742360, -5.810002
    polygonTanger.setMap(map);
    google.maps.event.addListener(polygonTanger, 'click', function (event) { polygonTanger.setVisible(false);markerTanger.setVisible(false);markerTanger0.setVisible(false);markerClick.setVisible(false);markerClick0.setVisible(false); document.getElementById('zone').innerHTML = \"Par Zones\"; ;cauche = \"zones\";addCENumber();for(var plgns = 0;plgns<$y;plgns++){polygons[plgns].setVisible(true); markersT[plgns].setVisible(true);}  });
    google.maps.event.addListener(LavageMap, 'click', function (event) { 
        caucheL = 'par zones';
        LavageMap.setVisible(false);
        markerLavage.setVisible(false);
        markerLavage0.setVisible(false);
        markerClick0.setVisible(false);
        for(var cpl=0;cpl<markersL.length;cpl++){
            markersL[cpl].setVisible(true);
        }
        document.getElementById('zone').innerHTML = \"Par Zones\";
        caucheL = \"zones\";
        // console.log(cauche);
        addCENumber();
        for(var plgns = 0;plgns<LavagePolygones.length;plgns++){
            LavagePolygones[plgns].setVisible(true); 
            LavagePolygones[plgns].setMap(map); 
            //markersT[plgns].setVisible(true);
        }  
    });

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
            polygons[plgns].setVisible(true); markersT[plgns].setVisible(true);
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
            polygons[plgns].setVisible(true); markersT[plgns].setVisible(true);
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
            polygons[plgns].setVisible(true); markersT[plgns].setVisible(true);
        }
    });
    google.maps.event.addListener(markerLavage, 'click', function (event) { 
        caucheL ='bacs';
        LavageMap.setVisible(false);
        markerLavage.setVisible(false);
        markerLavage0.setVisible(false);
        markerClick0.setVisible(false);
        for(var cpl=0;cpl<markersL.length;cpl++){
            markersL[cpl].setVisible(true);
        }
        document.getElementById('zone').innerHTML = \"Par Zones\";
        caucheL = \"zones\";
        // console.log(cauche);
        addCENumber();
        for(var plgns = 0;plgns<LavagePolygones.length;plgns++){
            LavagePolygones[plgns].setVisible(true); 
            LavagePolygones[plgns].setMap(map); 
            //markersT[plgns].setVisible(true);
        }  
    });
    google.maps.event.addListener(markerLavage0, 'click', function (event) { 
        caucheL ='bacs';
        LavageMap.setVisible(false);
        markerLavage.setVisible(false);
        markerLavage0.setVisible(false);
        markerClick0.setVisible(false);
        for(var cpl=0;cpl<markersL.length;cpl++){
            markersL[cpl].setVisible(true);
        }
        document.getElementById('zone').innerHTML = \"Par Zones\";
        caucheL = \"zones\";
        // console.log(cauche);
        addCENumber();
        for(var plgns = 0;plgns<LavagePolygones.length;plgns++){
            LavagePolygones[plgns].setVisible(true); 
            LavagePolygones[plgns].setMap(map); 
            //markersT[plgns].setVisible(true);
        }  
    });
    google.maps.event.addListener(markerClick0, 'click', function (event) { 
        caucheL ='bacs';
        LavageMap.setVisible(false);
        markerLavage.setVisible(false);
        markerLavage0.setVisible(false);
        markerClick0.setVisible(false);
        for(var cpl=0;cpl<markersL.length;cpl++){
            markersL[cpl].setVisible(true);
        }
        document.getElementById('zone').innerHTML = \"Par Zones\";
        caucheL = \"zones\";
        // console.log(cauche);
        addCENumber();
        for(var plgns = 0;plgns<LavagePolygones.length;plgns++){
            LavagePolygones[plgns].setVisible(true); 
            LavagePolygones[plgns].setMap(map); 
            //markersT[plgns].setVisible(true);
        }  
    });
");


/*************************      Set places event       *************************/
//for($p = 0;$p<$y;$p++){
fwrite($f, "
        for(var p=0;p<$y;p++){
            polygons[p].setVisible(false);
            markersT[p].setVisible(false);}");

// }

fwrite($f, "
// var mapH = document.getElementById('map').offsetHeight;
");
for ($vv = 0; $vv < $y; $vv++) {
    fwrite($f, "  
    //for(var pl = 0; pl <$y; pl++){
        google.maps.event.addListener(polygons[$vv], 'click', function (event) { 
                markers = [];
                if(markerCluster != null)
                    markerCluster.setMap(null);
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
                        markers.push(bacs[cc][0]) ;
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

for ($vv = 0; $vv < $y; $vv++) {
    fwrite($f, "  
        //for(var pl = 0; pl <$y; pl++){
            google.maps.event.addListener(markersT[$vv], 'click', function (event) { 
                markers = [];
                if(markerCluster != null)
                    markerCluster.setMap(null);
                cauche = \"bacs\";
                //$('#statitstics').removeAttr('hidden');
                document.getElementById('zone').innerHTML = polygons[$vv].title;
                polygons[$vv].setOptions({ fillOpacity : 0.2, strokeColor : 'black', strokeWeight : 3 });
                for(var r=0;r<polygons.length;r++){
                    if(r!= $vv){
                        polygons[r].setOptions({ fillOpacity : 0.8, strokeColor : 'black', strokeWeight : 3 });
                    }
                }
                //alert(polygons[$vv].title);
                for(var cc=0;cc<$c;cc++){
                    if(bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ','') ){
                        bacs[cc][0].setMap(map); 
                        markers.push(bacs[cc][0]) ;
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
                markerCluster = new markerClusterer.MarkerClusterer({
                    map,
                    markers
                });      
            });
        //} 
            ");
}
/********************************************************/
$sqlCirc = "select st_astext(buf) as pl, taux,\"CENTLAT\" as la, \"CENTLONG\" as lo
            from public.\"CIRCUIT\" join gps.taux_cir on public.\"CIRCUIT\".\"IDCIRCUIT\" = gps.taux_cir.idcircuit 
            where buf != 'null' and nature='COLLECTE BACS' and datej = ?";
$prepCirc = $db->prepare($sqlCirc);
$ok = $prepCirc->execute([date('Y-m-d')]);
$PLLN = array();
$polyline = array();
$itc = 0;
while ($dci = $prepCirc->fetch(PDO::FETCH_ASSOC)) {
    $L = $dci['pl'];
    $PLLN[$itc] = '[';
    $LL = substr($L, strlen('POLYGON(('), strlen($L));
    $LL = substr($LL, 0, strlen($LL) - 2);
    // $LL = str_replace('POLYGON((', '', $L);
    // $LL = str_replace('))', '', $L);
    $A = explode(',', $LL);
    for ($it = 1; $it < count($A); $it++) {
        $AA = explode(' ', $A[$it]);
        $PLLN[$itc] =  $PLLN[$itc] . ' {lat : ' . $AA[1] . ', lng :' . $AA[0] . ' },';
    }
    $PLLN[$itc] =  $PLLN[$itc] . ']';
    if ($dci['taux'] < 30) {
        $Color = 'red';
    }
    if ($dci['taux'] < 70 and $dci['taux'] >= 30) {
        $Color = 'yellow';
    }
    if ($dci['taux'] >= 70) {
        $Color = 'green';
    }
    fwrite($f, "
        const line$itc = " . $PLLN[$itc]);
    fwrite($f, "
        const polyline$itc = new google.maps.Polyline({path : line$itc,   strokeColor : '$Color', strokeOpacity : 1, strokeWeight : 2});
        polyline$itc.setMap(map); polyline$itc.setVisible(false);
        polyline.push(polyline$itc);
        markerCir.push(new google.maps.Marker({ position: { lat :" . $dci['la'] . " , lng : " . $dci['lo'] . "}, map: map,
        label : { text :" . $dci['taux'] . " + '%',  title: ' " . $dci['taux'] . "', fontSize : '120%', fontWeight : 'bold', color : 'black'
        }, labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : './circle.png' }));
        
        ");
    $itc++;
}
fwrite($f, "
    for(var i=0;i<markerCir.length;i++){
        // markerCir.setMap(null);
        markerCir[i].setVisible(false);
    }
");
/*****************************************************************/
$sqlClct = " SELECT 
            max(vrfid.devicetime)::date AS devicetime,
            bacs.numpark AS numparc,
            devices.name AS véhicule,
            min(vrfid.lat) AS latitude,
            min(vrfid.lon) AS longitude,
            min(vrfid.tag1)::varchar(24) AS identifiant,
            date(vrfid.devicetime) AS datej,
            bacs.typeb AS type,
            devices.fonction,
            d.annexe,
            bacs.id,
            bacs.newla,
            bacs.newlo
        FROM
            vrfid
            INNER JOIN tags ON (vrfid.tag1::text = tags.ntag::text)
            INNER JOIN bacs ON (tags.idbac = bacs.id)
            LEFT OUTER JOIN devices ON (vrfid.deviceid = devices.id),
            decoup2 d 
        WHERE 
            bacs.active = true  
            AND lower(bacs.typeb) like '%bac%'
            AND public.vrfid.devicetime::date >= current_timestamp::date - 7
            and lower(devices.fonction) like '%lavage%' 
            and ST_Contains( d.geom , ST_SetSRID(ST_MakePoint(bacs.newlo, bacs.newla),4326) ) 
        GROUP BY 
            bacs.numpark, 
            devices.name, 
            datej, 
            bacs.typeb, 
            devices.fonction, 
            bacs.id,
            d.annexe

        ORDER BY
            devicetime DESC
        ";
$prepClct = $db->prepare($sqlClct);
$ok = $prepClct->execute();
$bcs = 0;
while ($dataClct = $prepClct->fetch(PDO::FETCH_ASSOC)) {
    fwrite($f, "bacsLaver.push([new google.maps.Marker({position: {lat: " . $dataClct['newla'] . ", lng: " . $dataClct['newlo'] . "},map: map, title: '" . $dataClct['id'] . "'}),'" . $dataClct['annexe'] . "','" . $dataClct['devicetime'] . "']);");
    $bcs++;
}
/***************************010101**************************************/
$sqlMec =
    "SELECT distinct  st_astext(buf) as pl, taux,\"CENTLAT\" as la, \"CENTLONG\" as lo, \"NOM\", name
        from public.\"CIRCUIT\" join gps.taux_cir on public.\"CIRCUIT\".\"IDCIRCUIT\" = gps.taux_cir.idcircuit 
        join devices on devices.id = deviceid
        where buf != '' and lower(nature) like '%mecan%' and datej = current_timestamp::date ";
$prepMec = $db->prepare($sqlMec);
$ok = $prepMec->execute();
$PLLNMC = array();
$polylineMec = array();
$itc0 = 0;
while ($dcim = $prepMec->fetch(PDO::FETCH_ASSOC)) {
    $L = $dcim['pl'];
    $PLLNMC[$itc0] = '[';
    $LL = substr($L, strlen('POLYGON(('), strlen($L));
    $LL = substr($LL, 0, strlen($LL) - 2);
    // $LL = str_replace('POLYGON((', '', $L);
    // $LL = str_replace('))', '', $L);
    $A = explode(',', $LL);
    for ($it = 0; $it < count($A); $it++) {
        $AA = explode(' ', $A[$it]);
        $PLLNMC[$itc0] =  $PLLNMC[$itc0] . ' {lat : ' . $AA[1] . ', lng :' . $AA[0] . ' },';
    }
    $PLLNMC[$itc0] =  $PLLNMC[$itc0] . ']';
    if ($dcim['taux'] < 30) {
        $Color = 'red';
    }
    if ($dcim['taux'] < 70 and $dcim['taux'] >= 30) {
        $Color = 'yellow';
    }
    if ($dcim['taux'] >= 70) {
        $Color = 'green';
    }
    fwrite($f, "
        const lineM$itc0 = " . $PLLNMC[$itc0]);
    fwrite($f, "
        const polylineM$itc0 = new google.maps.Polyline({path : lineM$itc0,   strokeColor : '$Color', strokeOpacity : 1, strokeWeight : 2});
        polylineM$itc0.setMap(map); //polyline$itc0.setVisible(false);
        polylineMec.push(polylineM$itc0);
        markerMec.push(new google.maps.Marker({ position: { lat :" . $dcim['la'] . " , lng : " . $dcim['lo'] . "}, map: map,
        label : { text :" . $dcim['taux'] . " + '%',  title: ' " . $dcim['taux'] . "', fontSize : '120%', fontWeight : 'bold', color : 'black'
        }, labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : './circle.png' }));
        google.maps.event.addListener(markerMec[$itc0], 'click', function(){
            swal(
                'Nom de circuit: " . $dcim['NOM'] . "',
                'Nom de véhicule : " . $dcim['name'] . " ',
                ''
            )
        })
        ");
    $itc0++;
}
fwrite($f, "
    for(var tcp=0;tcp<polylineMec.length; tcp++){
        polylineMec[tcp].setVisible(false);
        markerMec[tcp].setVisible(false);
    }
");
/*****************************************************************/
$sqlcirMan = "
    SELECT  
        taux, 
        nature, 
        st_astext(buf) as pl,
        split_part(trim(st_astext(ST_Centroid(buf)), 'POINT()'), ' ', 2)::float AS la, 
        split_part(trim(st_astext(ST_Centroid(buf)), 'POINT()'), ' ', 1)::float AS lo,
        *
    from 
        public.\"CIRCUIT\" 
        join gps.taux_cir on public.\"CIRCUIT\".\"IDCIRCUIT\" = gps.taux_cir.idcircuit 
    where 
        lower(nature) like '%man%'
        and datej = ?    
        and buf != ''
";
$prepMan = $db->prepare($sqlcirMan);
$ok = $prepMan->execute([date('Y-m-d')]);
$PLLNMA = array();
$polylineMec = array();
$itc1 = 0;
fwrite($f, '
const infoWindow = new google.maps.InfoWindow({
    content: "",
    disableAutoPan: true,
});
');
while ($dcim = $prepMan->fetch(PDO::FETCH_ASSOC)) {
    $L = $dcim['pl'];
    $PLLNMA[$itc1] = '[';
    $LL = substr($L, strlen('POLYGON(('), strlen($L));
    $LL = substr($LL, 0, strlen($LL) - 2);
    // $LL = str_replace('POLYGON((', '', $L);
    // $LL = str_replace('))', '', $L);
    $A = explode(',', $LL);
    for ($it = 0; $it < count($A); $it++) {
        $AA = explode(' ', $A[$it]);
        // echo $A[$it] . "<br>";
        $PLLNMA[$itc1] =  $PLLNMA[$itc1] . ' {lat : ' . $AA[1] . ', lng :' . $AA[0] . ' },';
    }
    $PLLNMA[$itc1] =  $PLLNMA[$itc1] . ']';
    if ($dcim['taux'] < 30) {
        $Color = 'red';
    }
    if ($dcim['taux'] < 70 and $dcim['taux'] >= 30) {
        $Color = 'yellow';
    }
    if ($dcim['taux'] >= 70) {
        $Color = 'green';
    }
    fwrite($f, "
        const lineMa$itc1 = " . $PLLNMA[$itc1]);
    fwrite($f, "
        const polylineMa$itc1 = new google.maps.Polyline({path : lineMa$itc1,   strokeColor : '$Color',visible: false, strokeOpacity : 1, strokeWeight : 2});
        polylineMa$itc1.setMap(map); //polyline$itc0.setVisible(false);
        // google.maps.event.addListener(polylineMa$itc1, 'click', function(){
        //     swal(
        //         '" . $dcim['taux'] . "','',''
        //     );
        // });
        polylineMan.push(polylineMa$itc1);
        markerMan.push(new google.maps.Marker({ position: { lat :" . $dcim['la'] . " , lng : " . $dcim['lo'] . "}, map: map,visible : false,
        label : { text :" . $dcim['taux'] . " + '%',  title: ' " . $dcim['taux'] . "', fontSize : '120%', fontWeight : 'bold', color : 'black', background: 'green'
        }, labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : './circle2.png' }));
        
        ");
    $itc1++;
}
fwrite($f, "
    for(var tcp=0;tcp<polylineMan.length; tcp++){
        // polylineMan[tcp].setVisible(false);    
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
        bacsLaver[ct][0].setIcon('bacmetal_bleu.png');
        /*
        if(bacsLaver[ct][2]== '" . date('Y-m-d') . "'){
            bacsLaver[ct][0].setIcon('bacmetal_vert.png');
            NbrbacsLaver++;
        }else{
            bacsLaver[ct][0].setIcon('bacmetal_rouge.png');
            NbrbacsNonLaver++;
        }*/
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
            cauche = \"bacs\";
            
            document.getElementById('zone').innerHTML = LavagePolygones[$vv].title;
            LavagePolygones[$vv].setOptions({ fillOpacity : 0.2, strokeColor : 'black', strokeWeight : 3 });
            for(var r=0;r<LavagePolygones.length;r++){
                if(r!= $vv){
                    LavagePolygones[r].setOptions({ fillOpacity : 0.8, strokeColor : 'black', strokeWeight : 3 });
                }
            } 
            for(var cc=0;cc<bacsLaver.length;cc++){
                if(bacsLaver[cc][1] == LavagePolygones[$vv].title.replace('Detail ', '')){
                    bacsLaver[cc][0].setVisible(true);
                }else{
                    bacsLaver[cc][0].setVisible(false);
                }
            }
        });
        
        //} 
            ");
}
fwrite($f, " tauxLavageBacs = bacsLaver.length/bacs.length*100;
        // console.log(tauxLavageBacs);
    markerLavage =  new google.maps.Marker({ position: { lat :" . $yt . " , lng : " . $xt . "}, map: map,
    label : { text :tauxLavageBacs.toFixed(2) +'%',  title: '0', fontSize : '20px', fontWeight : 'bold'
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
            bacsLaver[cc][0].setMap(map);
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
            markerCluster.setMap(null);
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
                LavagePolygones[pls].setOptions({ fillOpacity : 0.7, strokeColor : 'black', strokeWeight : 3 })
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
    function CircuitsCollecte(){
        // cauch = 'circuit';
        stx=1;
        $('#act2').attr('hidden', 'true');
        LavageMap.setVisible(false);
        markerLavage.setVisible(false);
        markerLavage0.setVisible(false);
        markerClick0.setVisible(false);
        for(var i=0;i<markerCir.length;i++){
            // markerCir.setMap(null);
            markerCir[i].setVisible(true);
        }
        for(var plgns = 0;plgns<LavagePolygones.length;plgns++){
            LavagePolygones[plgns].setVisible(false); 
            LavagePolygones[plgns].setMap(map); 
            //markersT[plgns].setVisible(true);
        } 
        for(var cf=0; cf<bacsLaver.length;cf++){
            bacsLaver[cf][0].setVisible(false);
        }
        for(var cpl=0;cpl<markersL.length;cpl++){
            markersL[cpl].setVisible(false);
        }
        for (var tcp = 0; tcp < polylineMan.length; tcp++) {
            polylineMan[tcp].setVisible(false);
        }
        $('#act').animate({'right':'200%'}); 
        document.querySelector('.mo3ta2').classList.add('active');
        document.querySelector('.mo3ta1').classList.remove('active');
        document.querySelector('.mo3ta3').classList.remove('active');
        document.querySelector('.mo3ta4').classList.remove('active');
        document.querySelector('.mo3ta5').classList.remove('active');
        document.querySelector('.mo3ta6').classList.remove('active');
        for (var tcp = 0; tcp < polylineMec.length; tcp++) {
            polylineMec[tcp].setVisible(false);
            markerMec[tcp].setVisible(false);
        }
        for(var rm = 0; rm<bacs.length;rm++){
            bacs[rm][0].setVisible(false);
        }
        for(var rp=0;rp<polygons.length;rp++){
            polygons[rp].setVisible(false);
            markersT[rp].setVisible(false);
        }
        polygonTanger.setVisible(false);
        markerTanger.setVisible(false);
        markerTanger0.setVisible(false);
        markerClick.setVisible(false);
        for(var sp=0;sp<polyline.length;sp++){
            polyline[sp].setVisible(true);
        }
        $('#statitstics').hide(400);
        $('#charh').slideDown(700);
        closeNav();
    };

    function BacsCollecte(){
        $('#act2').attr('hidden', 'true');
        $('#act').animate({'right':'5px'}); 
        LavageMap.setVisible(false);
        markerLavage.setVisible(false);
        markerLavage0.setVisible(false);
        markerClick0.setVisible(false);
        for(var i=0;i<markerCir.length;i++){
            // markerCir.setMap(null);
            markerCir[i].setVisible(false);
        }
        for(var plgns = 0;plgns<LavagePolygones.length;plgns++){
            LavagePolygones[plgns].setVisible(false); 
            LavagePolygones[plgns].setMap(map); 
            //markersT[plgns].setVisible(true);
        } 
        for (var tcp = 0; tcp < polylineMec.length; tcp++) {
            polylineMec[tcp].setVisible(false);
            markerMec[tcp].setVisible(false);
        }
        for(var cpl=0;cpl<markersL.length;cpl++){
            markersL[cpl].setVisible(false);
        }
        for(var cf=0; cf<bacsLaver.length;cf++){
            bacsLaver[cf][0].setVisible(false);
        }
        for (var tcp = 0; tcp < polylineMan.length; tcp++) {
            polylineMan[tcp].setVisible(false);
        }
        document.querySelector('.mo3ta1').classList.add('active');
        document.querySelector('.mo3ta2').classList.remove('active');
        document.querySelector('.mo3ta3').classList.remove('active');
        document.querySelector('.mo3ta4').classList.remove('active');
        document.querySelector('.mo3ta5').classList.remove('active');
        document.querySelector('.mo3ta6').classList.remove('active');
        for(var rm = 0; rm<bacs.length;rm++){
            bacs[rm][0].setVisible(true);
            bacs[rm][0].setMap(null);
        }
        for(var rp=0;rp<polygons.length;rp++){
            polygons[rp].setVisible(false);
            markersT[rp].setVisible(false);
            polygons[rp].setOptions({ fillOpacity : 0.8, strokeColor : 'black', strokeWeight : 3 });
        }
        closeNav();
        polygonTanger.setVisible(true);
        markerTanger.setVisible(true);
        markerTanger0.setVisible(true);
        markerClick.setVisible(true);
        for(var sp=0;sp<polyline.length;sp++){
            polyline[sp].setVisible(false);
        }
    }
    function BacsLavage(){
        caucheL = 'ville';
        if(tauxLavageBacs<50){
            LavageMap.setOptions({ fillOpacity : 0.7, fillColor : 'red', strokeWeight : 3, title : tauxLavageBacs, 
                label : {
                    text : tauxLavageBacs, title: tauxLavageBacs
                } 
            });
            // console.log('red bg');
        }else{
            LavageMap.setOptions({ fillOpacity : 0.7, fillColor : 'green', strokeWeight : 3 });
            // console.log('green BG');
        }
        
        CircuitsCollecte();
        for (var tcp = 0; tcp < polylineMec.length; tcp++) {
            polylineMec[tcp].setVisible(false);
            markerMec[tcp].setVisible(false);
        }
        for(var i=0;i<markerCir.length;i++){
            // markerCir.setMap(null);
            markerCir[i].setVisible(false);
        }
        for(var sp=0;sp<polyline.length;sp++){
            polyline[sp].setVisible(false);
        }
        $('#act').animate({'right':'200%'}); 
        $('#act2').removeAttr('hidden');
        polygonTanger.setVisible(false);
        markerTanger.setVisible(false);
        markerTanger0.setVisible(false);
        markerLavage.setVisible(true);
        markerClick.setVisible(false);
        markerClick0.setVisible(true);
        markerLavage0.setVisible(true);
        for (var tcp = 0; tcp < polylineMan.length; tcp++) {
            polylineMan[tcp].setVisible(false);
        }
        LavageMap.setVisible(true);
        document.querySelector('.mo3ta3').classList.add('active');
        document.querySelector('.mo3ta2').classList.remove('active');
        document.querySelector('.mo3ta1').classList.remove('active');
        document.querySelector('.mo3ta4').classList.remove('active');
        document.querySelector('.mo3ta5').classList.remove('active');
        document.querySelector('.mo3ta6').classList.remove('active');
        closeNav();
    }
    
");

$sqlGNums = "select id, nom, numero,zone, nature, secteur from public.respensables    order by id";
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
/*
    $sqlED = "select annexe, commune from decoup2";
    $prepED = $db->prepare($sqlED);
    $ok = $prepED->execute();
    $cnt=0;
    while($dED = $prepED->fetch(PDO::FETCH_ASSOC)){
        fwrite($f, 
        "AnnCom.push([ $cnt ,\"". $dED['annexe'] ."\", \"". $dED['commune'] ."\" ]); 
        ");
        $cnt++;
    }*/
fclose($f);
