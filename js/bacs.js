function getHoursDiff(startDate, endDate) {
    const msInHour = 1000 * 60 * 60;
    return Math.round(Math.abs(endDate - startDate) / msInHour);
}
function BacsCollecte() {
    $('#switch').attr('hidden', true)
    $('#vueTabMec').attr('hidden', true)
    $('#imgWait').fadeIn(500);
    $("#combo").css('display', 'none');
    $('#road').attr('hidden', true)
    $('#vueTabCirc').attr('hidden', true)
    $('#vueTabCiCo').attr('hidden', true)
    $('#combo').children().remove().end()
    EXP = 'BacsCo';
    $('#vueTabCoCo').removeAttr('hidden')
    $('#act2').attr('hidden', 'true');
    $('#act3').attr('hidden', 'true');
    $('#act').removeAttr('hidden');
    $('#vueTabCirc').attr('hidden', true)
    $('#map').css({
        'right': '0'
    });
    $('#act').fadeOut()
    $('#tableMan').css({
        'right': '120%'
    });
    $('#switch').attr('hidden', true)
    $('#export').fadeIn(150);
    $('#map').animate({
        right: '0'
    })
    $('#act').css({
        'bottom': '28vh'
    })
    $('#vueTabCoCo').css({
        'bottom' : '17vh'
    })
    if(google.maps == null){
        location.reload(true)
    }
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13.4,
        mapTypeId: 'terrain',
        center: ps,
        mapTypeControl: false,
        disableDefaultUI: true,
    });
    $('#act2').attr('hidden', 'true');
 
    document.querySelector('.mo3ta1').classList.add('active');
    document.querySelector('.mo3ta2').classList.remove('active');
    document.querySelector('.mo3ta3').classList.remove('active');
    document.querySelector('.mo3ta4').classList.remove('active');
    document.querySelector('.mo3ta5').classList.remove('active');
    document.querySelector('.mo3ta6').classList.remove('active');
    closeNav();
    document.querySelector('#act').style.right = '5px'

    $.ajax({
        url: './pltng.php',
        type: 'GET',
        data: {
            userid: readCookie('iduserST')
        },
        success: function(d) {
            // console.log(d);
            d = d.replace('MULTIPOLYGON(((', '');
            d = d.replace('POLYGON((', '');
            d = d.replace('POLYGON', '');
            d = d.replace(')))', '');
            d = d.replace('(((', '');
            d = d.replace('))', '');
            d = d.replace(')', '');
            d = d.replace('((', ''); 
            d = d.replace('(', ''); 
            //console.log(d);
            PathP = [];
            var t = d.split('*');
            var tt = t[0].split(',');
            for (let i = 0; i < tt.length-1; i++) {
                PathP.push({
                    lat: Number(tt[i].split(' ')[1]),
                    lng: Number(tt[i].split(' ')[0])
                })
                //console.log(PathP[i]);
            }
            var color = '#ef3352' 
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13.4,
                mapTypeId: 'terrain',
                center: ps,
                mapTypeControl: false,
                disableDefaultUI: true,
            }); 
            polygonTanger = new google.maps.Polygon({
                paths: PathP,
                strokeColor: 'black',
                fillColor: 'black',
                id: 0,
                strokeOpacity: 1,
                strokeWeight: 3, 
                fillOpacity: 0.6,
                title: 'Tanger',
                map: map,
                visible: true
            });
            polygonTanger.addListener('click', () => { 
                showPolygones();
                $('#act').fadeIn()
                EXP = "BacsCo0";
                polygonTanger.setOptions({
                    strokeOpacity : 1,
                    fillOpacity: 0.2,
                    strokeColor : 'black'
                }) 
                markerTanger.setVisible(false); 
                cauche = 'zones';
            })
            
            ps = {
                lat: Number(t[1]),
                lng: Number(t[2])
            }
            map.setCenter(ps)
            markerTanger = new google.maps.Marker({
                position: ps,
                map: map,
                label: {
                    text: '** %',
                    title: '0',
                    fontSize: '24px',
                    fontWeight: 'bold'
                },
                labelAnchor: new google.maps.Point(3, 30),
                labelInBackground: false,
                icon: 'None'
            }); 
            markerTanger.addListener('click', () => { 
                $('#act').fadeIn()
                showPolygones();
                EXP = "BacsCo0";
                polygonTanger.setOptions({
                    strokeOpacity : 1,
                   fillOpacity: 0.2,
                    strokeColor : 'black'
                }) 
                markerTanger.setVisible(false); 
                cauche = 'zones';
            })  
            $.ajax({
                url: 'uprcnt.php',
                method: 'get',
                data: {
                    userid: readCookie('iduserST') 
                },
                success: function(d) {
                    console.log("d : " + d);
                    var p = d.split(';');
                    secteur = p[0].split(',')[0];
                    pourcentages = [];
                    for (let i = 0; i < p.length - 1; i++) {
                        var t1 = p[i].split(',');
                        document.getElementById('zone').innerHTML = t1[0];
                        pourcentages.push([t1[0], t1[1], t1[2], t1[3]]); 
                    }
                    for (let i = 0; i < markersT.length; i++) {
                        markersT[i].setOptions({
                            label: {
                                text: pourcentages[i][1] + '%',
                                fontWeight: 'bold',
                                fontSize: '28px',
                                fontSize: '24px',
                                fontWeight: 'bold'
                            }
                        })
                    }
                    $.ajax({
                        url: 'tt.php',
                        method: "GET",
                        data: {
                            uid: readCookie('iduserST')
                        },
                        success: function(d) { 
                            markerTanger.setOptions({
                                label: {
                                    text: d + '%',
                                    fontWeight: 'bold',
                                    fontSize: '24px',
                                    fontWeight: 'bold'
                                }
                            })
                            if (d > 70) {
                                polygonTanger.setOptions({
                                    strokeColor: 'black',
                                    fillColor: 'green'
                                })
                            } else if (d < 30) {
                                polygonTanger.setOptions({
                                    strokeColor: 'black',
                                    fillColor: 'red'
                                })
                            } else {
                                polygonTanger.setOptions({
                                    strokeColor: 'black',
                                    fillColor: 'yellow'
                                })
                            }
                            
                        }
                    })
                    $.ajax({
                        url: './bcs.php',
                        data: {
                            userid: readCookie('iduserST')
                        },
                        success: function(d) { 
                            var t = d.split('*');
                            bacs = [];
                            for (let i = 0; i < t.length; i++) {
                                var tt = t[i].split(',');

                                bacs.push([
                                    new google.maps.Marker({
                                        position: {
                                            lat: Number(tt[0]),
                                            lng: Number(tt[1])
                                        },
                                        title: tt[2]
                                    }), {
                                        lat: tt[0],
                                        lng: tt[1]
                                    },
                                    tt[3], tt[4], tt[5], tt[2], tt[6]
                                ])
                            }

                            function addListenerToMarker(marker, date, type, numpark) {
                                var infowindow = new google.maps.InfoWindow({
                                    content:"<center><u><h3>Collecte</h3></u></center><br>" +  
					"Type : " + type + "<br>Date : " + date +
                                        "<br>N° park : " + numpark
                                });
                                google.maps.event.addListener(marker, 'click', function() {
                                    infowindow.open(map, marker);
                                });
                            }

                            for (let i = 0; i < bacs.length; i++) {
                                addListenerToMarker(bacs[i][0], bacs[i][6], bacs[i][4], bacs[i][5]);
                            } 
                            $('#imgWait').fadeOut(500);
                        }
                    })
                }
            })
        }
    })
    markerTanger0 = new google.maps.Marker({
        position: Tanger,
        map: map,
        visible: true,
        label: {
            text: 'Taux de Réalisation - collecte',
            title: '0',
            fontSize: '170%',
            fontWeight: 'bold'
        },
        labelAnchor: new google.maps.Point(3, 30),
        labelInBackground: false,
        icon: 'None'
    });
    markerClick = new google.maps.Marker({
        position: {
            lat: 35.721191,
            lng: -5.764618
        },
        map: map,
        visible: true,
        labelAnchor: new google.maps.Point(3, 30),
        labelInBackground: false,
        icon: './images/hand.png',
        visible: true
    });

    markerClick.addListener('click', () => {
        //alert(this.title);
        polygonTanger.setVisible(false);
        showPolygones();
        markerClick.setVisible(false);
        markerTanger.setVisible(false);
        markerTanger0.setVisible(false);
        cauche = 'zones';
    })
    markerTanger0.addListener('click', () => {
        //alert(this.title);
        polygonTanger.setVisible(false);
        showPolygones();
        markerClick.setVisible(false);
        markerTanger.setVisible(false);
        markerTanger0.setVisible(false);
        cauche = 'zones';
    })
    markerTanger.addListener('click', () => {
        //alert(this.title);
        polygonTanger.setVisible(false);
        showPolygones();
        markerClick.setVisible(false);
        markerTanger.setVisible(false);
        markerTanger0.setVisible(false);
        cauche = 'zones';
    })

    polygonTanger.setMap(map);
    polygonTanger.setVisible(true);
    markerTanger.setMap(map);
    markerTanger.setVisible(true);
    markerTanger0.setMap(map);
    markerTanger0.setVisible(true);
    markerClick.setMap(map);
    markerClick.setVisible(true);
    showPolygones()
    polygonTanger.setVisible(false)
    markerTanger.setVisible(false)
}

function BacsLavage() {
    EXP = 'BacsLav';
    $('#map').css({
        'right': '0'
    });
    $('#tableMan').css({
        'right': '120%'
    });
    $('#vueTabCirc').attr('hidden', true)
    $('#vueTabCoCo').attr('hidden', true)
    $('#vueTabMec').attr('hidden', true)
    $('#road').attr('hidden', true)
    $('#vueTabCirc').attr('hidden', true)
    $('#switch').attr('hidden', true)
    $("#combo").css('display', 'none');
    $('#combo').children().remove().end()
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13.4,
        mapTypeId: 'terrain',
        center: ps,
        mapTypeControl: false,
        disableDefaultUI: true,
    });
    $('#act').attr('hidden', 'true');
    $('#act2').removeAttr('hidden');
    $('#vueTabCiCo').removeAttr('hidden');
    $('#act3').attr('hidden', 'true'); 
    $('#myChart0').animate({
        'right': '120%'
    });
    $('#export').fadeIn(150);
    $('#map').animate({
        right: '0'
    });
    $('#imgWait').fadeIn(120);
    tauxLavageBacs = 0;
    bacsLaver = [];
    $('#vueTabCiCo').css({
        'bottom' : '17vh'
    })
    $('#act2').css({
        'bottom' : '28vh'
    })
    markerClick1 = new google.maps.Marker({
        position: {
            lat: 35.721191,
            lng: -5.764618
        },
        map: null,
        visible: false,
        labelAnchor: new google.maps.Point(3, 30),
        labelInBackground: false,
        icon: './images/hand.png'
    });
    markerLavage = new google.maps.Marker({
        position: ps,
        map: map,
        visible: false,
        label: {
            text: tauxLavageBacs + '%',
            title: '0',
            fontSize: '20px',
            fontWeight: 'bold'
        },
        labelAnchor: new google.maps.Point(3, 30),
        labelInBackground: false,
        icon: 'None'
    });
    markerLavage0 = new google.maps.Marker({
        position: Tanger,
        map: map,
        visible: false,
        label: {
            text: 'Taux de réalisation - Lavage bacs',
            title: '0',
            fontSize: '20px',
            fontWeight: 'bold'
        },
        labelAnchor: new google.maps.Point(3, 30),
        labelInBackground: false,
        icon: 'None'
    });
    LavageMap = new google.maps.Polygon({
        paths: PathP,
        strokeColor: '#ef1a5d',
        id: 0,
        strokeOpacity: 0.5,
        strokeWeight: 2, 
        fillOpacity: 0.6,
        title: 'Tanger',
        map: map,
        visible: true
    });
    $.ajax({
        url: 'w.php',
        method: 'GET',
        data: {
            user: readCookie('iduserST')
        },
        success: (d) => { 
            var annexes = d.split('*');
            document.getElementById('zone').innerHTML = annexes[0];
            bacsParZone = new Map();
            for (let index = 0; index < annexes.length - 1; index++) {
                pourcentagesLavage.set(annexes[index], 0);
                bacsParZone.set(annexes[index], 0);
            }
            for (let b = 0; b < bacs.length; b++) {
                bacsParZone.set(bacs[b][2], bacsParZone.get(bacs[b][2]) + 1);
            }
            $.ajax({
                url: 'lc.php',
                method: 'GET',
                data: {
                    userid: readCookie('iduserST')
                },
                success: function(d) { 
                    var t = d.split(';');
                    for (let i = 0; i < t.length - 1; i++) {
                        var t1 = t[i].split(',');
                        bacsLaver.push([
                            new google.maps.Marker({
                                position: {
                                    lat: Number(t1[1]),
                                    lng: Number(t1[2])
                                },
                                map: map,
                                visible: true,
                                title: t1[0],
                                icon: 'bacmetal_blue.png'
                            }), t1[4], t1[3], t1[5], t1[6], t1[7]
                        ])
                    }
                    for (var pr = 0; pr < pourcentages.length; pr++) {
                        //pourcentagesLavage.set(pourcentages[pr][0], 0);
                        //bacsParZone.set(pourcentages[pr][0], pourcentages[pr][3]);
                    }
                    
                    for (var ct = 0; ct < bacsLaver.length; ct++) {
                        bacsLaver[ct][0].setVisible(false);
                        bacsLaver[ct][0].setMap(map);
                        switch (bacsLaver[ct][2]) {
                            case "Bac Plastique 660 L":
                                bacsLaver[ct][0].setIcon('bacp_bleu.png')
                                break;
                            case "Bac Galvalisé":
                                bacsLaver[ct][0].setIcon('bacmetal_bleu.png');
                                break;
                            case "COLONNE":
                                bacsLaver[ct][0].setIcon('bac_bleu.png');
                                break;
                        }
                        pourcentagesLavage.set(bacsLaver[ct][1], pourcentagesLavage.get(bacsLaver[ct][1]) + 1);

                    }

                    for (let i = 0; i < LavagePolygones.length; i++) {
                        var ttt = pourcentagesLavage.get(pourcentages[i][0]) / bacsParZone.get(pourcentages[i][0]) * 100;
                        if (ttt > 100)
                            ttt = 100;
                        if (pourcentagesLavage.get(pourcentages[i][0]) / bacsParZone.get(pourcentages[i][0]) * 100 < 30) {
                            LavagePolygones[i].setOptions({
                                fillOpacity: 0.7,
                                fillColor: 'red',
                                strokeWeight: 3,
                                map: map,
                                visible: false
                            })
                        } else
                        if (pourcentagesLavage.get(pourcentages[i][0]) / bacsParZone.get(pourcentages[i][0]) * 100 > 70) {
                            LavagePolygones[i].setOptions({
                                fillOpacity: 0.7,
                                fillColor: 'green',
                                strokeWeight: 3,
                                map: map,
                                visible: false
                            })
                        } else {
                            LavagePolygones[i].setOptions({
                                fillOpacity: 0.7,
                                fillColor: 'yellow',
                                strokeWeight: 3,
                                map: map,
                                visible: false
                            })
                        }
                    }
                    for (let u = 0; u < markersL.length; u++) {
                        var ttt = pourcentagesLavage.get(pourcentages[u][0]) / bacsParZone.get(pourcentages[u][0]) * 100;
                        markersL[u].setOptions({
                            label: {
                                text: ttt.toFixed(2) + " %",
                                fontSize: '13px',
                                fontWeight: 'bold',
                            }
                        })
                    }

                    function addListenerToMarkerL(marker, numparc, type, vehicule, date) {
                        var infowindow = new google.maps.InfoWindow({
                            content: "<center><u><h4>Lavage</h4></u></center>" + 
				"N° park : " + numparc + "<br>Type : " + type +
                                "<br>Véhicule : " + vehicule + "<br>Date : " + date
                        });
                        google.maps.event.addListener(marker, 'click', function() {
                            infowindow.open(map, marker);
                        });
                    }

                    for (let i = 0; i < bacsLaver.length; i++) {
                        addListenerToMarkerL(bacsLaver[i][0], bacsLaver[i][3], bacsLaver[i][2], bacsLaver[i][4], bacsLaver[i][5]);
                    }
                    tauxLavageBacs = bacsLaver.length / bacs.length * 100
                    caucheL = 'ville';
                    markerLavage.setLabel({
                        text: tauxLavageBacs.toFixed(2) + '%',
                        fontSize: '20px',
                        fontWeight: 'bold'
                    })
                    if (tauxLavageBacs < 30) {
                        LavageMap.setOptions({
                            fillOpacity: 0.7,
                            fillColor: 'red',
                            strokeWeight: 3,
                            map: map,
                            title: tauxLavageBacs,
                            label: {
                                text: tauxLavageBacs,
                                title: tauxLavageBacs
                            }
                        });
                        // // console.log('red bg');
                    } else if (tauxLavageBacs > 30 && tauxLavageBacs < 70) {
                        LavageMap.setOptions({
                            fillOpacity: 0.7,
                            fillColor: 'yellow',
                            strokeWeight: 3,
                            map: map,
                            title: tauxLavageBacs,
                            label: {
                                text: tauxLavageBacs,
                                title: tauxLavageBacs
                            }
                        });
                        // // console.log('red bg');
                    } else {
                        LavageMap.setOptions({
                            fillOpacity: 0.7,
                            fillColor: 'green',
                            strokeWeight: 3,
                            map: map,
                            title: tauxLavageBacs,
                            label: {
                                text: tauxLavageBacs,
                                title: tauxLavageBacs
                            }
                        });
                        // // console.log('green BG');
                    }
                    $('#imgWait').fadeOut(120);
                }
            });
        }
    })
    function getDataForBacs(np){
        for (let i = 0; i < bacsLaver.length; i++) {
            if(bacsLaver[i][3] == np){
                return [bacsLaver[i][3],bacsLaver[i][3],bacsLaver[i][4],bacsLaver[i][5]]
            }
        }
    }
    
    function dddd(ba, np){
        var r = getDataForBacs(np);
        if(r!=null){
            var infowindow = new google.maps.InfoWindow({
                content: "N° park : " + r[1] + "<br>Type : " + r[0] +
                    "<br>Véhicule : " + r[2] + "<br>Date : " + r[3]
            });
            google.maps.event.addListener(ba, 'click', function() {
                infowindow.open(map, ba);
            });
        }
    }
    LavageMap.addListener('click', function(event) {
        
        caucheL = "zones"; 
        EXP = "BacsLav0";
        let Bacs2 = bacs;
        for (let i = 0; i < bacs.length; i++) {
            if(isLaver(Bacs2[i][5])){
                dddd(Bacs2[i][0], Bacs2[i][3]);
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
        } 
        for (var ct = 0; ct < bacsLaver.length; ct++) {
            bacsLaver[ct][0].setVisible(true);
            bacsLaver[ct][0].setMap(map);
            switch (bacsLaver[ct][2]) {
                case "Bac Plastique 660 L":
                    bacsLaver[ct][0].setIcon('bacp_bleu.png')
                    break;
                case "Bac Galvalisé":
                    bacsLaver[ct][0].setIcon('bacmetal_bleu.png');
                    break;
                case "COLONNE":
                    bacsLaver[ct][0].setIcon('bac_bleu.png');
                    break;
            }
            LavageMap.setOptions({
                strokeOpacity: 1,
                fillOpacity:0.2,
                strokeColor: 'black'
            })
        }
        
    });
    // markerLavage0.addListener('click', function(event) {
    //     caucheL = "zones"; 
    //     EXP = "BacsLav0"
    //     for (var ct = 0; ct < bacsLaver.length; ct++) {
    //         bacsLaver[ct][0].setVisible(true);
    //         bacsLaver[ct][0].setMap(map);
    //         switch (bacsLaver[ct][2]) {
    //             case "Bac Plastique 660 L":
    //                 bacsLaver[ct][0].setIcon('bacp_bleu.png')
    //                 break;
    //             case "Bac Galvalisé":
    //                 bacsLaver[ct][0].setIcon('bacmetal_bleu.png');
    //                 break;
    //             case "COLONNE":
    //                 bacsLaver[ct][0].setIcon('bac_bleu.png');
    //                 break;
    //         }
    //         LavageMap.setOptions({
    //             strokeOpacity: 1,
    //             fillOpacity:0.2,
    //             strokeColor: 'black'
    //         })
    //     }
    //     for (let i = 0; i < bacs.length; i++) {
    //         if(isLaver(Bacs2[i][5])){
    //             dddd(Bacs2[i][0], Bacs2[i][3]);
    //             switch (Bacs2[i][4]) {
    //                 case "COLONNE":
    //                     Bacs2[i][0].setIcon('./bac_bleu.png')
    //                     break;
    //                 case "Bac Galvalisé":
    //                     Bacs2[i][0].setIcon('./bacmetal_bleu.png')
    //                     break;
                    
    //                 case 'Bac Plastique 660 L':
    //                     Bacs2[i][0].setIcon('./bacp_bleu.png')
    //                     break;
    //                 default : 
    //                     Bacs2[i][0].setIcon('./images/bacroulant_bleu.png')
    //                     break;
    
    //             }
    //         }else{
    //              if (Bacs2[i][4] == "COLONNE") {
    //                     Bacs2[i][0].setIcon('./images/bac_gris.png');
    //                 } else if (Bacs2[i][4] == "Bac Galvalisé") {
    //                     Bacs2[i][0].setIcon('./images/bacmetal_gris.png');
    //                 } else if(bacs[i][4] == 'Bac Plastique 660 L'){
    //                     Bacs2[i][0].setIcon('./images/bacroulantgrand_gris.png');
    //                 }else{
    //                     Bacs2[i][0].setIcon('./images/bacroulant_gris.png');
    //                 }
    //         }
    //         Bacs2[i][0].setMap(map);
    //         Bacs2[i][0].setVisible(true)
    //     } 
        
    // })
    
    markerLavage.addListener('click', function(event) {
        caucheL = "zones"; 
        EXP = "BacsLav0"
        for (var ct = 0; ct < bacsLaver.length; ct++) {
            bacsLaver[ct][0].setVisible(true);
            bacsLaver[ct][0].setMap(map);
            switch (bacsLaver[ct][2]) {
                case "Bac Plastique 660 L":
                    bacsLaver[ct][0].setIcon('bacp_bleu.png')
                    break;
                case "Bac Galvalisé":
                    bacsLaver[ct][0].setIcon('bacmetal_bleu.png');
                    break;
                case "COLONNE":
                    bacsLaver[ct][0].setIcon('bac_bleu.png');
                    break;
            }
            LavageMap.setOptions({
                strokeOpacity: 1,
                fillOpacity:0.2,
                strokeColor: 'black'
            })
        }   
        let Bacs2 = bacs;
        for (let i = 0; i < Bacs2.length; i++) {
            if(isLaver(Bacs2[i][5])){
                dddd(Bacs2[i][0], Bacs2[i][3]);
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
        } 
    })
    markerClick1.addListener('click', function(event) {
        caucheL = "zones"; 
        EXP = "BacsLav0";
        for (var ct = 0; ct < bacsLaver.length; ct++) {
            bacsLaver[ct][0].setVisible(true);
            bacsLaver[ct][0].setMap(map);
            switch (bacsLaver[ct][2]) {
                case "Bac Plastique 660 L":
                    bacsLaver[ct][0].setIcon('bacp_bleu.png')
                    break;
                case "Bac Galvalisé":
                    bacsLaver[ct][0].setIcon('bacmetal_bleu.png');
                    break;
                case "COLONNE":
                    bacsLaver[ct][0].setIcon('bac_bleu.png');
                    break;
            }
            LavageMap.setOptions({
                strokeOpacity: 1,
                fillOpacity:0.2,
                strokeColor: 'black'
            })
        } 
    })
    tauxLavageBacs = bacsLaver.length / bacs.length * 100;

    $('#act').attr('hidden')

    $('#act2').removeAttr('hidden');
    markerLavage.setMap(map);
    markerLavage.setVisible(true);
    // markerClick.setVisible(false);
    markerClick1.setMap(map);
    markerClick1.setVisible(true);
    markerLavage0.setMap(map);
    markerLavage0.setVisible(false);
    LavageMap.setMap(map);
    LavageMap.setVisible(true);
    document.querySelector('.mo3ta3').classList.add('active');
    document.querySelector('.mo3ta2').classList.remove('active');
    document.querySelector('.mo3ta1').classList.remove('active');
    document.querySelector('.mo3ta4').classList.remove('active');
    document.querySelector('.mo3ta5').classList.remove('active');
    document.querySelector('.mo3ta6').classList.remove('active');
    closeNav();
}
