<?php 
    require './db/connection.php';
    /*****************        GetPourcentage             ******************/
    $db = connect();
    $sqlR = "select count(*), d.nom from bacs b , decoupage d 
        where   ST_Contains( d.geom , ST_SetSRID(ST_MakePoint(b.longitude, b.latitude),4326) ) and lastupdate::date = current_timestamp::date and d.active = true
        group by nom
    ";
    $sqlT = "select count(*), d.nom from bacs b , decoupage d where  ST_Contains( d.geom , ST_SetSRID(ST_MakePoint(b.longitude, b.latitude),4326) )  and d.active=true   
    group by nom ";
    $prepR = $db->prepare($sqlR);
    $prepT = $db->prepare($sqlT);
    $resR = $prepR->execute();
    $resT = $prepT->execute();
    $Pourcentage = array();$y = 0;
    while($data1 = $prepT->fetch(PDO::FETCH_ASSOC) and $data2 = $prepR->fetch(PDO::FETCH_ASSOC)){ 
        $Pourcentage[$data1['nom']] = round($data2['count']/$data1['count']*100, 2);   
    }
    /*************      getAllPlaces       *************/
    $sql = "select nom, idz, st_astext(geom) as plgn  , st_x(st_centroid(geom)) as lt, st_y(st_centroid(geom)) as ln from public.decoupage where active = true";
    $prep = $db->prepare($sql);
    $res = $prep->execute();
    $y=0;
    $plgn = array();
    $idzs = array();
    $Tanger = '[';
    echo "<script>
    color = ['red','green','blue','yellow'];
    cauche =\"ville\";
    let polygons = [];
    let markers  = [];
    cauche =\"ville\";
    let bacs = [];
    const Tanger = { lat : 35.75370794162373  , lng : -5.820173343332406  };
    let polygonTanger = null;
    let markerTanger = null;
    var map = null;
    function initMap() {
        // The location of Uluru 31.627294, 
        // The map, centered at Tanger
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 11,
            mapTypeId: \"hybrid\",
            center: Tanger,
        });
        const icons = {
            rouge: {
              icon: './images/bacmetal_rouge.png',
            },
            vert: {
              icon: './images/bacmetal_rouge.png',
            }, 
        };
    ";
    while($d = $prep->fetch(PDO::FETCH_ASSOC)){
        //echo $d['idz'] ."<br>"; //.$d['plgn']."<br><br>";
        $x1 = substr($d['plgn'],strlen("MULTIPOLYGON((("), strlen($d['plgn'])-3 ) ;
        $x2 = substr($x1,0, strlen($x1)-3 )."";
        
        $Lats_Lngs = explode(',', $x2);
        $plgn[$y] = "[";
        for($i=0;$i<count($Lats_Lngs); $i++){
            $cc = explode(' ', $Lats_Lngs[$i]);
            $x =  "{lat : ".$cc[1] . " , lng : ".$cc[0]."}, ";
            $plgn[$y] = $plgn[$y] . $x;
        }
        $plgn[$y] = $plgn[$y]."]";
        //echo $plgn[$y];
        // const PtsPlgn$y= $plgn[$y];
        echo "  
            polygons[$y] = new google.maps.Polygon({ paths: $plgn[$y], strokeColor: color[$y], id : ". $d['idz'] .", strokeOpacity: 0.5, strokeWeight: 2, fillColor: color[$y],fillOpacity: 0.6,title : '". $d['nom'] ."' });
            markers[$y] = new google.maps.Marker({ position: { lat :".$d['ln']." , lng : ". $d['lt'] ."}, map: map,
            label : { text :'". $Pourcentage[$d['nom']] ." %',  title: '". $d['nom'] ."', fontSize : '25px', fontWeight : 'bold', color : color[".($y+1)%4 ."]
            }, labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : 'None' });
            polygons[$y].setMap(map);
        ";
        $idzs[$y] = $d['idz'];
        $y=$y+1;
    }
    /********** Bacs position ************/

    $sqlGM = "select    b.id, b.latitude as lat, b.longitude as lng, d.nom , b.lastupdate::date as dt
        from bacs b ,decoupage d 
        where ST_Contains( d.geom , ST_SetSRID(ST_MakePoint(b.longitude, b.latitude),4326) ) and b.active = 'true'  
        order by d.nom 
    ";
    $bacsZones = array( );
    $prepGM = $db->prepare($sqlGM);
    $res = $prepGM->execute();
    $c=0;
    while( $data = $prepGM->fetch(PDO::FETCH_ASSOC) ){
        array_push($bacsZones, ["bac".$data['id'] ,"{ lat : ".$data['lat'].", lng : ".$data['lng']  ." } " , $data['nom']]);
        echo "
        bacs.push([ new google.maps.Marker({position: { lat : " . $data['lat'] . ", lng : ".$data['lng'] . "},title : \"bac".$data['id']."\"}) ".
         ", { lat : " . 
            $data['lat'] . ", lng : ".$data['lng'] . "} , \"".$data['nom']."\", ".
            $data['dt'] ."]);  ";
        $c++;
    }
    /*************************      get Tanger maps        **************************/
    $sqlTanger = "select st_astext(st_union(geom)) as unionD, st_Y(st_asText(st_centroid(st_union(geom)))) as YT, st_X(st_astext(st_centroid(st_union(geom)))) as XT from decoupage 
                  where active = true limit 1";
    $prepTng = $db->prepare($sqlTanger);
    $res = $prepTng->execute();
    $xt = "";
    $yt = "";
    $PT ="[";
    if( $dc = $prepTng->fetch(PDO::FETCH_ASSOC) ){
        $x1 = substr(str_replace('),(',' ',$dc['uniond']), strlen("POLYGON(("), strlen($dc['uniond'])-3);
        $x1 = substr($x1, 0, strlen($x1)-2);
        $Lats_Lng_Tanger = explode(',', $x1);
        for($tt=0; $tt<count($Lats_Lng_Tanger);$tt++){
            $ttt = explode(' ', $Lats_Lng_Tanger[$tt]);
            $PT = $PT .  " { lat : ".$ttt[1]." , lng : ".$ttt[0] . " }, "; 
        }
        $PT = $PT." ]";
        $xt = $dc['xt'];
        $yt = $dc['yt'];
    }
    echo "
    polygonTanger  = new google.maps.Polygon({ paths: $PT, strokeColor: '#ef1a5d', id : 0 , strokeOpacity: 0.5, strokeWeight: 2, fillColor: '#2eef22',fillOpacity: 0.6,title : 'Tanger' });
    markerTanger =  new google.maps.Marker({ position: { lat :".$yt." , lng : ". $xt ."}, map: map,
        label : { text :'12 %',  title: '0', fontSize : '25px', fontWeight : 'bold'
        }, labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : 'None' });
    polygonTanger.setMap(map);
    google.maps.event.addListener(polygonTanger, 'click', function (event) { 
        polygonTanger.setVisible(false);
        markerTanger.setVisible(false);
        map.setZoom(12);
        cauche = \"zones\";
        console.log(cauche);
        ";
        //for($plgns=0;$plgns<$y;$plgns++){
            echo "
            for(var plgns = 0;plgns<$y;plgns++){
                polygons[plgns].setVisible(true); markers[plgns].setVisible(true);
            }";

        //}
    echo "});
    ";
    /*************************      Set places event       *************************/
    for($p = 0;$p<$y;$p++){
        echo "
        for(var p=0;p<$y;p++){
            polygons[p].setVisible(false);
            markers[p].setVisible(false);}";
      
    }

        for($vv=0;$vv<$y;$vv++){
        echo "  
        //for(var pl = 0; pl <$y; pl++){
            google.maps.event.addListener(polygons[$vv], 'click', function (event) { 
                cauche = \"bacs\"
                console.log(cauche);
                document.getElementById('zone').innerHTML = polygons[$vv].title;
                map.setZoom(13); map.setCenter(markers[$vv].position);
                polygons[$vv].setOptions({ fillOpacity : 0.2, strokeColor : 'black', strokeWeight : 3 });
                //alert(polygons[$vv].title);
                for(var cc=0;cc<$c;cc++){
                    //console.log(bacs[cc][2]);
                    if(bacs[cc][2] == document.getElementById('zone').innerHTML ){
                        bacs[cc][0].setMap(map); 
                    }else{".
//                            $bacsZones[."cc".][0].".setMap(null);  
                        "bacs[cc][0].setMap(null);  
                    }
                    if(bacs[cc][3] == ". date("Y-m-d") ." ){ ".
                        "bacs[cc][0].setIcon('./images/bacmetal_vert.png');
                    }else{".
                        "bacs[cc][0].setIcon('./images/bacmetal_rouge.png');
                    } 
                }

            });
        //}
            ";
        }
            ///
                /*
                for($in=0;$in<$y;$in ++){
                    if($in==$p){
                        echo "";
                    }else{
                        echo "
                polygon$in.setOptions({ strokeOpacity: 0.5, strokeWeight: 2, fillOpacity: 0.6 });";
                    }
                }*/
    echo " }
    window.initMap = initMap;
    </script>
    "
    ;
?>
