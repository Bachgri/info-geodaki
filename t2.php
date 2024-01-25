<?php
include './db/connection.php';
$db = connect();
// file_put_contents('./js/balman.js', '');
$f = fopen("./js/balman.js", 'w+');
$sqlcirMan =
    "SELECT 
        secteur, \"NOM\", taux
    FROM (
        SELECT  
            public.\"CIRCUIT_DET2\".idcircuit as idcircuit ,nature, \"NOM\",
            secteur
        FROM public.\"CIRCUIT_DET2\" 
            join public.\"CIRCUIT\" on \"IDCIRCUIT\" = idcircuit  
        where lower(nature) like '%ma%'   
        group  by   public.\"CIRCUIT_DET2\".idcircuit,  nature, \"NOM\", secteur
        ) as S 
        join gps.taux_cir on gps.taux_cir.idcircuit = S.idcircuit
        join public.devices on gps.taux_cir.deviceid = public.devices.id
    where   datej = current_timestamp::date and secteur != ''
";
$prepMan = $db->prepare($sqlcirMan);
$ok = $prepMan->execute();
$PLLNMA = array();
$polylineMec = array();
$itc1 = 0;
$ttl = '';
$ttl .=  '
const infoWindow = new google.maps.InfoWindow({
    content: "",
    disableAutoPan: true,
});
var positions;
let markers = [];
map = null;
let C_ARTA3501 = [];
let C_ARTA3502 = [];
let C_ARTA3401 = [];
let C_ARTA3501R = [];
let C_ARTA3502R = [];
let C_ARTA3401R = [];
var polylineMan = [];
var TotaleMoyBalMan = 0;
markerLavMan = null;
markerLavMan0 = null;
function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: {
            lat: 35.746096838328896,
            lng: -5.796524269502934
        },
    });;
    marker = new google.maps.Marker({
        position: {
            lat: 35.746096838328896,
            lng: -5.796524269502934
        },
        map: map
    });


// let polylineMan = [];
// var TotaleMoyBalMan = 0;
// markerLavMan = null;
// markerLavMan0 = null;
// function getCirc(){
';
// $dcim = $prepMan->fetchAll(PDO::FETCH_ASSOC);
// $i = 0;
while ($dcim = $prepMan->fetch(PDO::FETCH_ASSOC)) {
    $ttl .=  "polylineMan.push(['" . $dcim['secteur'] . "', '" . $dcim['NOM'] . "', '" . $dcim['taux'] . "']);";
}
// for ($i = 50; $i < 70; $i++) {
//     // if ($i++ == 60)
//     //     break;
//     $L = $dcim[$i]['pl'];
//     // $LL = substr($L, strlen('POLYGON(('), strlen($L));
//     // $LL = substr($LL, 0, strlen($LL) - 2);
//     $L = str_replace('MULTILINESTRING', '', $L);
//     $L = str_replace('),(', '*', $L);
//     // $L = str_replace(')', '', $L);
//     // $L = str_replace('(', '', $L);
//     $ttl .= "try{ ";
//     $A = explode('*', $L);
//     for ($it = 0; $it < count($A); $it++) {
//         $PLLNMA[$it] = '[';
//         $A[$it] = str_replace('(', '', $A[$it]);
//         $A[$it] = str_replace(')', '', $A[$it]);
//         $AE = explode(',', $A[$it]);
//         for ($j = 0; $j < count($AE); $j++) {
//             // echo $AE[$it] . "<br>";
//             $AA = explode(' ', $AE[$j]);
//             // echo $AA[1] . "<br>";
//             $PLLNMA[$it] =  $PLLNMA[$it] . ' {lat : ' . $AA[1] . ', lng :' . $AA[0] . ' },';
//         }

//         $PLLNMA[$it] =  $PLLNMA[$it] . ']';
//         if ($dcim[$i]['taux'] < 30) {
//             $Color = 'red';
//         }
//         if ($dcim[$i]['taux'] < 70 and $dcim[$i]['taux'] >= 30) {
//             $Color = 'yellow';
//         }
//         if ($dcim[$i]['taux'] >= 70) {
//             $Color = 'green';
//         }
//         $ttl .=  "

//                 const lineMa" . $dcim[$i]['idcircuit'] . "$itc1" . 'de' . "$it= " . $PLLNMA[$it];
//         $ttl .=  "
//                 const polylineMa" . $dcim[$i]['idcircuit'] . "$itc1" . 'de' . "$it = new google.maps.Polyline({path : lineMa" . $dcim[$i]['idcircuit'] . "$itc1" . 'de' . "$it,   strokeColor : '$Color',visible: true, strokeOpacity : 1, strokeWeight : 4, map:map});var infoWindow$it = new google.maps.InfoWindow({content: '<h3>" . $dcim[$i]['taux'] . "</h3>'}); 
//                 google.maps.event.addListener(polylineMa" . $dcim[$i]['idcircuit'] . "$itc1" . 'de' . "$it, 'click', function(){swal({text :'taux Circuit : " . $dcim[$i]['taux'] .  "\\nCircuit : " . $dcim[$i]['NOM'] . "\\nVéhicule : " . $dcim[$i]['name'] . "',buttons: {ok: \"Ok\",},});});
//                 //polylineMan.push(polylineMa" . $dcim[$i]['idcircuit'] . "$itc1" . 'de' . "$it);
//                 TotaleMoyBalMan+=" . $dcim[$i]['taux'] . ";
//                 // console.log($it);
//                 ";
//     }
//     $ttl .= "}catch( e  ){console.error(e);}

//         console.log(" . $dcim[$i]['idcircuit'] . ")
//         ";
//     $itc1++;
// }
// for ($i = 70; $i < 90; $i++) {
//     // if ($i++ == 60)
//     //     break;
//     $L = $dcim[$i]['pl'];
//     // $LL = substr($L, strlen('POLYGON(('), strlen($L));
//     // $LL = substr($LL, 0, strlen($LL) - 2);
//     $L = str_replace('MULTILINESTRING', '', $L);
//     $L = str_replace('),(', '*', $L);
//     // $L = str_replace(')', '', $L);
//     // $L = str_replace('(', '', $L);
//     $ttl .= "try{ ";
//     $A = explode('*', $L);
//     for ($it = 0; $it < count($A); $it++) {
//         $PLLNMA[$it] = '[';
//         $A[$it] = str_replace('(', '', $A[$it]);
//         $A[$it] = str_replace(')', '', $A[$it]);
//         $AE = explode(',', $A[$it]);
//         for ($j = 0; $j < count($AE); $j++) {
//             // echo $AE[$it] . "<br>";
//             $AA = explode(' ', $AE[$j]);
//             // echo $AA[1] . "<br>";
//             $PLLNMA[$it] =  $PLLNMA[$it] . ' {lat : ' . $AA[1] . ', lng :' . $AA[0] . ' },';
//         }

//         $PLLNMA[$it] =  $PLLNMA[$it] . ']';
//         if ($dcim[$i]['taux'] < 30) {
//             $Color = 'red';
//         }
//         if ($dcim[$i]['taux'] < 70 and $dcim[$i]['taux'] >= 30) {
//             $Color = 'yellow';
//         }
//         if ($dcim[$i]['taux'] >= 70) {
//             $Color = 'green';
//         }
//         $ttl .=  "

//                 const lineMa" . $dcim[$i]['idcircuit'] . "$itc1" . 'de' . "$it= " . $PLLNMA[$it];
//         $ttl .=  "
//                 const polylineMa" . $dcim[$i]['idcircuit'] . "$itc1" . 'de' . "$it = new google.maps.Polyline({path : lineMa" . $dcim[$i]['idcircuit'] . "$itc1" . 'de' . "$it,   strokeColor : '$Color',visible: true, strokeOpacity : 1, strokeWeight : 4, map:map});var infoWindow$it = new google.maps.InfoWindow({content: '<h3>" . $dcim[$i]['taux'] . "</h3>'}); 
//                 google.maps.event.addListener(polylineMa" . $dcim[$i]['idcircuit'] . "$itc1" . 'de' . "$it, 'click', function(){swal({text :'taux Circuit : " . $dcim[$i]['taux'] .  "\\nCircuit : " . $dcim[$i]['NOM'] . "\\nVéhicule : " . $dcim[$i]['name'] . "',buttons: {ok: \"Ok\",},});});
//                 //polylineMan.push(polylineMa" . $dcim[$i]['idcircuit'] . "$itc1" . 'de' . "$it);
//                 TotaleMoyBalMan+=" . $dcim[$i]['taux'] . ";
//                 // console.log($it);
//                 ";
//     }
//     $ttl .= "}catch( e  ){console.error(e);}

//         console.log(" . $dcim[$i]['idcircuit'] . ")
//         ";
//     $itc1++;
// }
// for ($i = 90; $i < 99; $i++) {
//     // if ($i++ == 60)
//     //     break;
//     $L = $dcim[$i]['pl'];
//     // $LL = substr($L, strlen('POLYGON(('), strlen($L));
//     // $LL = substr($LL, 0, strlen($LL) - 2);
//     $L = str_replace('MULTILINESTRING', '', $L);
//     $L = str_replace('),(', '*', $L);
//     // $L = str_replace(')', '', $L);
//     // $L = str_replace('(', '', $L);
//     $ttl .= "try{ ";
//     $A = explode('*', $L);
//     for ($it = 0; $it < count($A); $it++) {
//         $PLLNMA[$it] = '[';
//         $A[$it] = str_replace('(', '', $A[$it]);
//         $A[$it] = str_replace(')', '', $A[$it]);
//         $AE = explode(',', $A[$it]);
//         for ($j = 0; $j < count($AE); $j++) {
//             // echo $AE[$it] . "<br>";
//             $AA = explode(' ', $AE[$j]);
//             // echo $AA[1] . "<br>";
//             $PLLNMA[$it] =  $PLLNMA[$it] . ' {lat : ' . $AA[1] . ', lng :' . $AA[0] . ' },';
//         }

//         $PLLNMA[$it] =  $PLLNMA[$it] . ']';
//         if ($dcim[$i]['taux'] < 30) {
//             $Color = 'red';
//         }
//         if ($dcim[$i]['taux'] < 70 and $dcim[$i]['taux'] >= 30) {
//             $Color = 'yellow';
//         }
//         if ($dcim[$i]['taux'] >= 70) {
//             $Color = 'green';
//         }
//         $ttl .=  "

//                 const lineMa" . $dcim[$i]['idcircuit'] . "$itc1" . 'de' . "$it= " . $PLLNMA[$it];
//         $ttl .=  "
//                 const polylineMa" . $dcim[$i]['idcircuit'] . "$itc1" . 'de' . "$it = new google.maps.Polyline({path : lineMa" . $dcim[$i]['idcircuit'] . "$itc1" . 'de' . "$it,   strokeColor : '$Color',visible: true, strokeOpacity : 1, strokeWeight : 4, map:map});var infoWindow$it = new google.maps.InfoWindow({content: '<h3>" . $dcim[$i]['taux'] . "</h3>'}); 
//                 google.maps.event.addListener(polylineMa" . $dcim[$i]['idcircuit'] . "$itc1" . 'de' . "$it, 'click', function(){swal({text :'taux Circuit : " . $dcim[$i]['taux'] .  "\\nCircuit : " . $dcim[$i]['NOM'] . "\\nVéhicule : " . $dcim[$i]['name'] . "',buttons: {ok: \"Ok\",},});});
//                 //polylineMan.push(polylineMa" . $dcim[$i]['idcircuit'] . "$itc1" . 'de' . "$it);
//                 TotaleMoyBalMan+=" . $dcim[$i]['taux'] . ";
//                 // console.log($it);
//                 ";
//     }
//     $ttl .= "}catch( e  ){console.error(e);}

//         console.log(" . $dcim[$i]['idcircuit'] . ")
//         ";
//     $itc1++;
// }
// ob_flush();
// flush();
// time_sleep_until(time() + 10);
// $i = 0;
// while ($dcim = $prepMan->fetch(PDO::FETCH_ASSOC)) {
//     if ($i++ == 60)
//         break;
//     $L = $dcim['pl'];
//     // $LL = substr($L, strlen('POLYGON(('), strlen($L));
//     // $LL = substr($LL, 0, strlen($LL) - 2);
//     $L = str_replace('MULTILINESTRING', '', $L);
//     $L = str_replace('),(', '*', $L);
//     // $L = str_replace(')', '', $L);
//     // $L = str_replace('(', '', $L);
//     $ttl .= "try{ ";
//     $A = explode('*', $L);
//     for ($it = 0; $it < count($A); $it++) {
//         $PLLNMA[$it] = '[';
//         $A[$it] = str_replace('(', '', $A[$it]);
//         $A[$it] = str_replace(')', '', $A[$it]);
//         $AE = explode(',', $A[$it]);
//         for ($j = 0; $j < count($AE); $j++) {
//             // echo $AE[$it] . "<br>";
//             $AA = explode(' ', $AE[$j]);
//             // echo $AA[1] . "<br>";
//             $PLLNMA[$it] =  $PLLNMA[$it] . ' {lat : ' . $AA[1] . ', lng :' . $AA[0] . ' },';
//         }

//         $PLLNMA[$it] =  $PLLNMA[$it] . ']';
//         if ($dcim['taux'] < 30) {
//             $Color = 'red';
//         }
//         if ($dcim['taux'] < 70 and $dcim['taux'] >= 30) {
//             $Color = 'yellow';
//         }
//         if ($dcim['taux'] >= 70) {
//             $Color = 'green';
//         }
//         $ttl .=  "

//                 const lineMa" . $dcim['idcircuit'] . "$itc1" . 'de' . "$it= " . $PLLNMA[$it];
//         $ttl .=  "
//                 const polylineMa" . $dcim['idcircuit'] . "$itc1" . 'de' . "$it = new google.maps.Polyline({path : lineMa" . $dcim['idcircuit'] . "$itc1" . 'de' . "$it,   strokeColor : '$Color',visible: true, strokeOpacity : 1, strokeWeight : 4, map:map});var infoWindow$it = new google.maps.InfoWindow({content: '<h3>" . $dcim['taux'] . "</h3>'}); 
//                 google.maps.event.addListener(polylineMa" . $dcim['idcircuit'] . "$itc1" . 'de' . "$it, 'click', function(){swal({text :'taux Circuit : " . $dcim['taux'] .  "\\nCircuit : " . $dcim['NOM'] . "\\nVéhicule : " . $dcim['name'] . "',buttons: {ok: \"Ok\",},});});
//                 //polylineMan.push(polylineMa" . $dcim['idcircuit'] . "$itc1" . 'de' . "$it);
//                 TotaleMoyBalMan+=" . $dcim['taux'] . ";
//                 // console.log($it);
//                 ";
//     }
//     $ttl .= "}catch( e  ){console.error(e);}

//         console.log(" . $dcim['idcircuit'] . ")
//         ";
//     $itc1++;
// }
// ob_end_flush();
$ttl .=  "
    // markerLavMan =  new google.maps.Marker({ position: Tanger, map: null,
    //     label : { text : 'Taux de réalisation de',  title: '0', fontSize : '20px', fontWeight : 'bold'}, 
    //     labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : 'None' 
    // });  

    // markerLavMan1 =  new google.maps.Marker({ position: { lat :" . 0 . " , lng : " . 0 . "}, map: map,
    //     label : { text :'Balayage manuel',  title: '0', fontSize : '20px', fontWeight : 'bold'}, 
    //     labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : 'None' 
    // });

    // markerLavMan0 =  new google.maps.Marker({ position: { lat : 35.736935 , lng : -5.801410 }, map: null,
    //     label : { text :Number(TotaleMoyBalMan/polylineMan.length).toFixed(2)+'%',  title: '0', fontSize : '20px', fontWeight : 'bold'}, 
    //     labelAnchor: new google.maps.Point(3, 30), labelInBackground: false,  icon : 'None' 
    // });
    // markerLavMan.setVisible(false);
    // markerLavMan0.setVisible(false);
    // markerLavMan1.setVisible(false);
    // markerClick1.setVisible(false);
    // google.maps.event.addListener(markerLavMan, 'click', function(){showBalManCir(), this.setVisible(false)});
    // google.maps.event.addListener(markerLavMan0, 'click', function(){showBalManCir(), this.setVisible(false)});
    // google.maps.event.addListener(markerLavMan1, 'click', function(){showBalManCir(), this.setVisible(false)});
    // google.maps.event.addListener(markerClick1, 'click', function(){showBalManCir(), this.setVisible(false)});
    // for(var tcp=0;tcp<polylineMan.length; tcp++){
    //     polylineMan[tcp].setVisible(true);    
    // }
";
$ttl .=  "
    console.log(TotaleMoyBalMan); 
    
}
window.initMap = initMap;1
// }
";
fwrite($f, $ttl);
// fclose($f);
$db = null;
// echo $ttl;
