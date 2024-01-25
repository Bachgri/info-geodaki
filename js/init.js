let pourcentages = [];pourcentages.push(["AA12/1", 28, 21, 75]);pourcentages.push(["AA12/2", 29.31, 51, 174]);pourcentages.push(["AA12/3", 24.59, 15, 61]);pourcentages.push(["AA16", 55.92, 118, 211]);pourcentages.push(["AA19/1", 37.86, 92, 243]);pourcentages.push(["AA19/2", 45.13, 51, 113]);pourcentages.push(["AA19/3", 4.48, 3, 67]);pourcentages.push(["AA21/1", 63.31, 88, 139]);pourcentages.push(["AA21/2", 60.94, 39, 64]);pourcentages.push(["AA23", 61.18, 93, 152]);pourcentages.push(["AA9/1", 82.27, 167, 203]);pourcentages.push(["AA9/2", 40.23, 35, 87]);pourcentages.push(["AA9/3", 64.57, 82, 127]);pourcentages.push(["AA9/4", 62.5, 65, 104]);pourcentages.push(["AMAE", 35, 21, 60]); 
$('#charh').slideUp(120);
var hhh = 0;
var tauxLavageBacs = 0;
var EXP = 'BacsCo';
var NbrbacsNonLaver = 0;
var NbrbacsLaver = 0;
color = ['red','green','blue','yellow'];
cauche = "ville";
caucheL= 'ville'
let polygons = [];
let markersT  = [];
let markers  = [];
let markerCir = [];
let markersL  = [];
cauche ="ville";
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
}
window.initMap = initMap;

// var mapH = document.getElementById('map').offsetHeight;
// var ttlH = document.getElementById('title').offsetHeight;
var stx = 0;
// function rje3( ) { 
//     $('#charh').slideUp(120);
//     /*if(stx==1){
//         for(var rm = 0; rm<bacs.length;rm++){
//             bacs[rm][0].setVisible(true);
//         }
//         for(var rp=0;rp<polygons.length;rp++){
//             polygons[rp].setVisible(true);
//             markersT[rp].setVisible(true);
//         }
//         polygonTanger.setVisible(true);
//         markerTanger.setVisible(false);
//         for(var sp=0;sp<polyline.length;sp++){
//             polyline[sp].setVisible(false);
//         }
//         stx=0;
//         cauche = "zones"
//     }*/
//     // document.querySelector('#map').classList.remove('map2'); 
//     // console.log('EMpty');
//     if(cauche == 'ville'){
//         // console.log('Ville');
//     // }else if(cauche == ''){

//     //     $('#uls').empty();
//     //     addDirNums();
//     //     polygonTanger.setVisible(true);
//     //     polygonTanger.Center = markerTanger.position;
//     //     map.Cenetr = markerTanger.position;
//     //     markerTanger.setVisible(true);
//     //     markerTanger0.setVisible(true);
//     //     markerClick.setVisible(true);
//     //     cauche = 'ville'; 
//     //     for(var p=0;p<polygons.length;p++){
//     //         polygons[p].setVisible(false); 
//     //         markersT[p].setVisible(false);  
//     //     }
//     //     $('#zone').text('ville');
//     }else if(cauche == 'zones'){
//         // markerClustersetMap(null);
//         // var cdcd = document.getElementById('map').offsetHeight;
//         hhh=0;
//         $('#statitstics').attr('hidden', true); 
//         for(var bcs = 0; bcs<bacs.length; bcs++){
//             bacs[bcs][0].setVisible(false) 
//         }
//         for(var pls = 0; pls < polygons.length; pls++){
//             polygons[pls].setOptions({ fillOpacity : 0.7, strokeColor : 'black', strokeWeight : 3 })
//         }
//         polygonTanger.setOptions({ fillOpacity : 0.7, strokeColor : 'black', strokeWeight : 3 })
//         for(var rm = 0; rm<bacs.length;rm++){
//             bacs[rm][0].setVisible(true);
//             bacs[rm][0].setMap(null);
//         }
//         polygonTanger.setVisible(true);
//         polygonTanger.setMap(map);
//         $('#zone').text('Par Zones'); 
//         cauche = 'zones';
//         // // console.log(cauche);
//     }
    
// }

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
// $('#imgWait').fadeOut(10);