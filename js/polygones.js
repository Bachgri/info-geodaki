function showPolygones() {
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
            bacs[cc][0].setVisible(true)
        } else {
            bacs[cc][0].setMap(null);
        }

        var d = new Date();
        if (getHoursDiff(new Date(bacs[cc][6]), new Date()) < 24) {
            if (bacs[cc][4] == "COLONNE") {
                bacs[cc][0].setIcon('./images/bac_vert.png');
            } else if (bacs[cc][4] == "Bac Galvalisé") {
                bacs[cc][0].setIcon('./images/bacmetal_vert.png');
            } else {
                bacs[cc][0].setIcon('./images/bacroulantgrand_vert.png');
            }
        } else {
            if (bacs[cc][4] == "COLONNE") {
                bacs[cc][0].setIcon('./images/bac_rouge.png');
            } else if (bacs[cc][4] == "Bac Galvalisé") {
                bacs[cc][0].setIcon('./images/bacmetal_rouge.png');
            } else {
                bacs[cc][0].setIcon('./images/bacroulantgrand_rouge.png');
            }
        }
    }
}
function showPolygonesLavage() {
    LavagePolygones = [];
    markersL = [];

    /*$.ajax({
        url: './spl.php',
        method: 'GET',
        data: {
            userid: readCookie('iduserST')
        },
        success: function(d) {

            // console.log('=============== POLYGONS LAVAGE ================');
            // console.log(d);
            // console.log('====================================');
            d = d.replace('MULTIPOLYGON', '')
            var ds = d.split(';');
            markersL = [];

            for (let i = 0; i < ds.length - 1; i++) {
                var lt = ds[i].split('*');
                var ann = lt[0];
                // console.log(ann);
                // console.log('====================================');
                var polygonesT = lt[1].split(',');
                pathP = [];
                var j;
                for (j = 1; j < polygonesT.length; j++) {
                    pathP.push({
                        lat: Number(polygonesT[j].split(' ')[1]),
                        lng: Number(polygonesT[j].split(' ')[0])
                    })
                }*/
                // var pourcentageMap = new Map();
                // for (let i = 0; i < pourcentages.length; i++) {
                //     pourcentageMap.set(pourcentages[i][0], [pourcentages[i][1], pourcentages[i][2], pourcentages[i][3]])
                // }
                // var color;
                // if (pourcentageMap.get(ann)[0] < 30) color = 'red';
                // else if (pourcentageMap.get(ann)[0] > 70) color = 'green';
                // else color = 'yellow';
                //p = []
                // LavagePolygones = [];
                var ttl = pourcentagesLavage.get(document.getElementById('zone').innerHTML) / bacsParZone.get(document.getElementById('zone').innerHTML) * 100;
                if (ttl < 30) color = 'red';
                else if (ttl > 70) color = 'green';
                else color = 'yellow';
                let ms = [];
                // LavagePolygones.push(new google.maps.Polygon({
                //     paths: pathP,
                //     strokeColor: 'black',
                //     fillColor: color,
                //     id: i,
                //     strokeOpacity: 1,
                //     strokeWeight: 2,
                //     fillOpacity: 1,
                //     title: ann,
                //     map: map,
                //     visible: true
                // }));
                LavagePolygones.push(LavageMap);
                markersL.push(markerLavage)
                // markersL.push(
                //     new google.maps.Marker({
                //         position: {
                //             lat: Number(lt[2]),
                //             lng: Number(lt[3])
                //         },
                //         map: map,
                //         visible: true,
                //         label: {
                //             text: (ttl).toFixed(2) + ' %',
                //             title: '0'
                //         },
                //         labelAnchor: new google.maps.Point(3, 30),
                //         labelInBackground: false,
                //         icon: 'None'
                //     })
                // )
                /*p[i].addListener('click', (event) => {
                    // console.log(event.get_resources());
                })*/
            // }    
            for (let l = 0; l < LavagePolygones.length; l++) {
                LavagePolygones[l].addListener('click', function(event) {
                    lav1(l);
                })
            }
            for (let k = 0; k < markersL.length; k++) {
                markersL[k].addListener('click', function(event) {
                    lav1(k);
                })
            }
            lav1(0);
            
        /*}
    })*/
    // polygones[1].addListener('click', () => {
    //     // console.lo g(p[1].title);
    // })
}
function isLaver(np){
    var tmp = 0;
    for (let i = 0; i < bacsLaver.length; i++) {
        if(bacsLaver[i][3] === np ){
            tmp++
        }
    }
    return tmp != 0;
}
function getDataForBacs(np){
    for (let i = 0; i < bacsLaver.length; i++) {
        if(bacsLaver[i][3] == np){
            return [bacsLaver[i][3],bacsLaver[i][3],bacsLaver[i][4],bacsLaver[i][5]]
        }
    }
}

function dddd(ba, np){
    var r = getDataForBacs(np);
    var infowindow = new google.maps.InfoWindow({
        content: "N° park : " + r[1] + "<br>Type : " + r[0] +
            "<br>Véhicule : " + r[2] + "<br>Date : " + r[3]
    });
    google.maps.event.addListener(ba, 'click', function() {
        infowindow.open(map, ba);
    });
}

function lav1(i) {
    caucheL = "bacs";

    document.getElementById('zone').innerHTML = LavagePolygones[i].title;
    LavagePolygones[i].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < LavagePolygones.length; r++) {
        if (r != i) {
            LavagePolygones[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3,

            });
        }
    }
    let Bacs2 = bacs;
    for (let i = 0; i < Bacs2.length; i++) {
        if(isLaver(Bacs2[i][5])){
            dddd(Bacs2[i][0], Bacs2[i][2]);
             switch (Bacs2[i][4]) {
                case "COLONNE":
                    Bacs2[i][0].setIcon('./bac_bleu.png')
                    break;
                case "Bac Galvalisé":
                    Bacs2[i][0].setIcon('./bacmetal_bleu.png')
                    break;
                
                case 'Bac Plastique 660 L':
                    Bacs2[i][0].setIcon('./bacp_bleu.png')
                    break;
                default : 
                    Bacs2[i][0].setIcon('./images/bacroulant_bleu.png')
                    break;

            }
        }else{
             if (Bacs2[i][4] == "COLONNE") {
                    Bacs2[i][0].setIcon('./images/bac_gris.png');
                } else if (Bacs2[i][4] == "Bac Galvalisé") {
                    Bacs2[i][0].setIcon('./images/bacmetal_gris.png');
                } else if(bacs[i][4] == 'Bac Plastique 660 L'){
                    Bacs2[i][0].setIcon('./images/bacroulantgrand_gris.png');
                }else{
                    Bacs2[i][0].setIcon('./images/bacroulant_gris.png');
                }
        }
        Bacs2[i][0].setMap(map);
        Bacs2[i][0].setVisible(true)
        console.log("hello");
    } 
    /*for (let i = 0; i < bacsLaver.length; i++) {
        switch (bacsLaver[i][2]) {
            case "COLONNE":
                bacsLaver[i][0].setIcon('./bac_bleu.png')
                break;
            case "Bac Galvalisé":
                bacsLaver[i][0].setIcon('./bacmetal_bleu.png')
                break;
            default:
                bacsLaver[i][0].setIcon('./bacp_bleu.png')
                break;
        }
        if (bacsLaver[i][1] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacsLaver[i][0].setVisible(true);
            bacsLaver[i][0].setMap(map);
            bacs[i][0].setMap(map);
            bacs[i][0].setVisible(false)
        } else {
            bacsLaver[i][0].setVisible(false);
            bacsLaver[i][0].setMap(map);
        }
    }*/
    // for (var cc = 0; cc < bacsLaver.length; cc++) {
    //     if (bacsLaver[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
    //         bacsLaver[cc][0].setMap(map);
    //     } else {
    //         bacsLaver[cc][0].setMap(null);
    //     }
    //     var d = new Date();
    //     //if (bacsLaver[cc][3] == d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate()) {
    //     if (bacsLaver[cc][4] == "COLONNE") {
    //         bacsLaver[cc][0].setIcon('./images/bac_vert.png');
    //     } else if (bacsLaver[cc][4] == "Bac Galvalisé") {
    //         bacsLaver[cc][0].setIcon('./images/bacmetal_vert.png');
    //     } else {
    //         bacsLaver[cc][0].setIcon('./images/bacroulantgrand_vert.png');
    //     }
    //     /*} else {
    //         if (bacsLaver[cc][4] == "COLONNE") {
    //             bacsLaver[cc][0].setIcon('./images/bac_rouge.png');
    //         } else if (bacsLaver[cc][4] == "Bac Galvalisé") {
    //             bacsLaver[cc][0].setIcon('./images/bacmetal_rouge.png');
    //         } else {
    //             bacsLaver[cc][0].setIcon('./images/bacroulantgrand_rouge.png');
    //         }
    //     }*/
    // }
}
function getHoursDiff(startDate, endDate) {
    const msInHour = 1000 * 60 * 60;
    return Math.round(Math.abs(endDate - startDate) / msInHour);
}
function all(i) {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[i].title;
    polygons[i].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != i) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

        var d = new Date();
        if(getHoursDiff(new Date(bacs[cc][6]), new Date())<24){
        //if (bacs[cc][3] == d.getFullYear() + '-' + ((d.getMonth() + 1)<10 ? '0'+(d.getMonth() + 1) : (d.getMonth() + 1)) + '-' + ((d.getDate())<10 ? '0'+d.getDate() : d.getDate())) {
            if (bacs[cc][4] == "COLONNE") {
                bacs[cc][0].setIcon('./images/bac_vert.png');
            } else if (bacs[cc][4] == "Bac Galvalisé") {
                bacs[cc][0].setIcon('./images/bacmetal_vert.png');
            } else {
                bacs[cc][0].setIcon('./images/bacroulantgrand_vert.png');
            }
        } else {
            if (bacs[cc][4] == "COLONNE") {
                bacs[cc][0].setIcon('./images/bac_rouge.png');
            } else if (bacs[cc][4] == "Bac Galvalisé") {
                bacs[cc][0].setIcon('./images/bacmetal_rouge.png');
            } else {
                bacs[cc][0].setIcon('./images/bacroulantgrand_rouge.png');
            }
        }
    }
}

function rje32() {
    EXP = "BacsLav"
    if(caucheL == 'ville'){
        console.log('====================================');
        console.log('ville');
        console.log('====================================');
    }else if(caucheL == 'zones'){
        for (var ct = 0; ct < bacs.length; ct++) {
            bacs[ct][0].setVisible(false);
            bacs[ct][0].setMap(null);
            // switch (bacsLaver[ct][2]) {
            //     case "Bac Plastique 660 L":
            //         bacsLaver[ct][0].setIcon('bacp_bleu.png')
            //         break;
            //     case "Bac Galvalisé":
            //         bacsLaver[ct][0].setIcon('bacmetal_bleu.png');
            //         break;
            //     case "COLONNE":
            //         bacsLaver[ct][0].setIcon('bac_bleu.png');
            //         break;
            // }
        }
        for (let i = 0; i < bacsLaver.length; i++) {
            bacsLaver[i][0].setMap(map);
            bacsLaver[i][0].setVisible(false);
        }
        LavageMap.setOptions({
            strokeOpacity: 1,
            fillOpacity:0.8,
            strokeColor: 'black'
        })
    }
}
function rje3(){
    EXP = "BacsCo";
    if(cauche == 'ville'){
        $('#act').fadeOut()
        console.log("exit");
    }else if(cauche == 'zones'){
        $('#act').fadeOut()
        polygonTanger.setOptions({
            strokeOpacity : 1,
            fillOpacity: 0.8
        }) 
        for (var cc = 0; cc < bacs.length; cc++) {
            if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
                bacs[cc][0].setMap(null);
                bacs[cc][0].setVisible(false)
            } else {
                bacs[cc][0].setMap(null);
            }
        }
        markerTanger.setVisible(true)
    }
}