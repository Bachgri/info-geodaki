<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/w3.css">
    <link rel="stylesheet" href="./css/fontawesome-free-6.1.2-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-dn4yi8nZ8f8lMfQZNZ8AmEEVT07DEcE&region=MA&signed_in=true&libraries=drawing&callback=initMap" defer></script>
    <style>
        #map {
            height: 70vh;
            width: 100%;
        }

        #contacts {
            width: 100%;
            z-index: 10001;
            background-color: white;
        }

        .ContactContainer {
            width: 80%;
            margin-left: 10%;
            height: 100vh;
            overflow-y: auto;
        }

        #contacts ul li .contact .linear div {
            display: inline;
        }

        .signName {
            padding: 0.3rem 0.5rem;
            background-color: red;
            color: white;
            border-radius: 14px;
            font-size: 13pt;
            font-weight: bold;
        }

        #contacts ul li .contact .linear .info div {
            display: inline;
        }

        #mode {
            height: 1cm;
            width: 1cm;

        }

        #ville {
            height: 1cm;
            width: auto;
            border-radius: 1cm;
        }

        #all {
            position: absolute;
            top: 0;
            width: auto;
        }

        .hideMode {
            display: none;
        }

        table.scroll {
            width: 100%;
            /* Optional */
            /* border-collapse: collapse; */
            border-spacing: 0;
            border: 2px solid black;
        }

        table.scroll tbody,
        table.scroll thead {
            display: block;
        }

        thead tr th {
            height: 30px;
            width: 50%;
            line-height: 30px;
            /*text-align: left;*/
        }

        table.scroll tbody {
            height: 40VH;
            overflow-y: auto;
            overflow-x: hidden;
        }

        tbody {
            border-top: 2px solid black;
        }

        tbody td,
        thead th {
            width: 50%;
            /* Optional */
            border-right: 1px solid black;
        }

        tbody td:last-child,
        thead th:last-child {
            border-right: none;
        }

        #call,
        #myChart0 {
            width: 100%;
            height: 92vh;
            background-color: white;
            position: absolute;
            text-align: center;
        }

        #call {
            z-index: 10011;
            overflow-x: auto;
            overflow-y: auto;
        }

        #annulerCall {
            position: fixed;
            bottom: 0;
        }
    </style>
</head>

<body>
    <!-- <div class="all" id="all">
        <label for="mapMode">
        </label>
        <input type="radio" name="mode" id="mapMode" checked value="map">
        <input type="radio" name="mode" id="tblMode" value="tbl">
        <label for="tblMode">Tableau</label>

    </div>
    <BR><br>
    <button id="mode" class="map">
        <i class="fa fa-table" id="modeI"></i>
    </button>-->
    <select name="shift" id="shiftVo">
        <option value="1">22h->05h</option>
        <option value="2">06h->14h</option>
        <option value="3">14h->20h</option>
        <option value="0">toute la journé</option>
    </select>
    <button id="t">ok</button>
    <button id="v">okk</button>
    <!--<button id="sh">Show</button>
    <select name="ville" id="ville">
        <option value="0"></option>
        <option value="tanger">Map</option>
        <option value="marrakech">Table</option>
        <option value="arma">Arma</option>
    </select> -->
    <!-- <div class="call" id="call">
        <div style="width: 100%;text-align: center;font-weight: bold;">Appelez un respensable</div>
        <div class="rowc" id="uls" style="width: 100%;overflow-y: auto;z-index: 101200;position: absolute !important;">
            <div class="ContactContainer">
                <ul class="w3-ul w3-card-4" id="contacts">
                    <li class="w3-padding-hor-16"><span class="w3-closebtn w3-padding w3-margin-right w3-small"><a href="tel:+212622115470"><i class="fa fa-phone" style="font-size: 20pt;padding-top: 9pt;"></i></a></span><img src="./images/a.png" class="w3-left w3-margin-right" style="width:40px;height: 40px;"><span class="">Mike</span><br><span>Web Designer</span></li>
                </ul>
            </div> 
            <ul>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
                <li>1</li>
            </ul>
        </div>
        <button id="annulerCall" class="myBtns" onclick="
            $('#call').animate({
                'right': '120%'
            });$('#act').css({
                'z_index': 10001
            })
            $('#act2').css({
                'z_index': 10001
            })
            $('#act3').css({
                'z_index': 10001
            })
            $('#callRes').css({
                'z_index': 10001
            })
            $('#export').css({
                'z_index': 10001
            })
        ">annuler</button> -->
    <!-- </div> -->
    <div id="map"></div>
    <!-- <div class="legend">
        <fieldset>
            <legend>Les coleurs des circuits</legend>
            <table>
                <tr>
                    <td>&lt;30</td>
                    <td>&ge;30 & &lt;70</td>
                    <td>&ge;70</td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend>Etat de Lavage/collecte</legend>
            <div>
                <img src="./bacmetal_vert.png" alt="" srcset=""> &rarr; <span>Bac collecté (24h) </span>
            </div>
            <div>
                <img src="./bacmetal_rouge.png" alt="" srcset=""> &rarr; <span>Bac non collecté (24h) </span>
            </div>
            <div>
                <img src="./bac_vert.png" alt="" srcset=""> &rarr; <span>Collone collectée (24h) </span>
            </div>
            <div>
                <img src="./bac_rouge.png" alt="" srcset=""> &rarr; <span>Collone non collectée (24h) </span>
            </div>
            <div>
                <img src="./bac_bleu.png" alt="" srcset=""> &rarr; <span>Collone Lavée (7J) </span>
            </div>
            <div>
                <img src="./bacmetal_bleu.png" alt="" srcset=""> &rarr; <span>Bac Lavé (24h) </span>
            </div>
        </fieldset>
    </div> -->
    <div id="tableMan">
        <table class="scroll">
            <thead style="width: 100%;">
                <tr style="width: 100%;">
                    <th style="width: 50%;padding-right: 2cm;">N° parck </th>
                    <th style="width: 50%;">Trace</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- <div class="ContactContainer">
        
        <ul class="w3-ul w3-card-4" id="contacts">
             <li class="w3-padding-hor-16"><span class="w3-closebtn w3-padding w3-margin-right w3-small"><a href="tel:+212622115470"><i class="fa fa-phone" style="font-size: 20pt;padding-top: 9pt;"></i></a></span><img src="./images/a.png" class="w3-left w3-margin-right" style="width:40px;height: 40px;"><span class="">Mike</span><br><span>Web Designer</span></li> 
        </ul>
        </div> -->

    <script src="./js/init.js"></script>
    <script>
        var result;
        document.querySelector('#t').addEventListener('click', () => {
            $('#map').css('right', '120%');
            $('#tableMan').css('right', '0');
        })
        var ps = {
            lat: 35.54854,
            lng: -5.15845
        }
        let mm = []
        let MotoInterventient = [];

        function tracer(veh) {
            $.ajax({
                url: 'pm.php',
                method: 'get',
                data: {
                    mo: veh
                },
                success: (d) => {
                    // console.log('====================================');
                    // console.log(d);
                    // console.log('====================================');
                    result = JSON.parse(d);
                    if (result.length > 0) {
                        var l = 0;
                        var x = {
                            lat: Number(result[0]['latitude']),
                            lng: Number(result[0]['longitude'])
                        };
                        var m0 = new google.maps.Marker({
                            position: x,
                            map: map,
                            visible: true,
                            icon: icons[l][0]
                        });
                        //addListenerM(m0, result[0].split(',')[2], 'Début');
                        let t = 1;
                        for (; t < result.length - 1; t++) {
                            //cols = result[t].split(',');
                            var pp = [x, {
                                lat: Number(result[t]['latitude']),
                                lng: Number(result[t]['longitude'])
                            }];
                            color = ['blue', 'green'];
                            const pl0 = new google.maps.Polyline({
                                path: pp,
                                map: map,
                                fillColor: color[0],
                                strokeColor: color[0],
                                strokeWeight: 5
                            });
                            //addListenerP(pl0, cols[2], cols[3]);
                            x = {
                                lat: Number(result[t]['latitude']),
                                lng: Number(result[t]['longitude'])
                            };
                        }
                        var m1 = new google.maps.Marker({
                            position: x,
                            map: map,
                            visible: true,
                            icon: icons[l++][1]
                        });
                        //addListenerM(m1, result[t - 1].split(',')[2], "Fin");
                    } else {
                        console.log('====================================');
                        console.log("no data");
                        console.log('====================================');
                    }
                },
                error: (err) => {
                    console.log('====================================');
                    console.log(err);
                    console.log('====================================');
                }
            })
        }

        function tracerLast(veh) {
            $.ajax({
                url: 'pm.php',
                method: 'get',
                data: {
                    mo: veh
                },
                success: (d) => {
                    // console.log('====================================');
                    // console.log(d);
                    // console.log('====================================');
                    result = JSON.parse(d);
                    if (result.length > 0) {
                        var l = 0;
                        var x = {
                            lat: Number(result[0]['latitude']),
                            lng: Number(result[0]['longitude'])
                        };

                        let t = 1;
                        x = {
                            lat: Number(result[result.length - 1]['latitude']),
                            lng: Number(result[result.length - 1]['longitude'])
                        };

                        var m1 = new google.maps.Marker({
                            position: x,
                            map: map,
                            visible: true,
                            icon: './images/moto.png'
                        });
                        mm.push(m1);
                        //addListenerM(m1, result[t - 1].split(',')[2], "Fin");
                    } else {
                        console.log('====================================');
                        console.log("no data");
                        console.log('====================================');
                    }
                },
                error: (err) => {
                    console.log('====================================');
                    console.log(err);
                    console.log('====================================');
                }
            })
        }

        function initialiseMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                mapTypeId: 'terrain',
                center: Tanger,
                mapTypeControl: false,
                disableDefaultUI: true,
            });
        }

        function searchMoto() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchMo");
            filter = input.value.toUpperCase();
            table = document.getElementById("tblMo");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function showTableForMoto(motos) {
            $('#tableMan').children().remove().end();
            var inp = $('<input type="text" name="" id="searchMo" class="form-control search" placeholder="Recherche par N° Circuit" onkeyup="searchMoto()">')
            $('#tableMan').append(inp);
            var t = $('<table class=\"scroll table\" id="tblMo"></table>')
            var th = $('<thead><tr style="width: 50%"><th>N° parck</th><th>  0  </th><th>0</th></thead>');
            var tb = $('<tbody></tbody>');
            t.append(th);
            var l = 1;
            for (let i = 0; i < motos.length; i++) {
                var tr = $('<tr></tr>')
                // for (let j = 0; j < ligne.length - 1; j++) {
                var td1 = $('<td style="width:25%; cursor: pointer;">' + motos[i] + '</td>');
                var td2 = $('<td style="width:25%; text-align: center;"><i class="fa fa-user"  onclick="initialiseMap(); tracer(\'' + motos[i] + '\')"></i></td>');
                var td3 = $('<td style="width:25%; text-align: center;"><input type="checkbox" class="check" value="' + motos[i] + '"/></td>');

                tr.append(td1);
                tr.append(td2);
                tr.append(td3);
                tb.append(tr)
            }
            t.append(tb);
            $('#tableMan').append(t);
            var $table = $('table.scroll'),
                $bodyCells = $table.find('tbody tr:first').children(),
                colWidth;

            $(window).resize(function() {

                colWidth = $bodyCells.map(function() {
                    return $(this).width();
                }).get();


                $table.find('thead tr').children().each(function(i, v) {
                    $(v).width(colWidth[i]);
                });
            }).resize();


        }
        $.ajax({
            url: 'mo.php',
            method: 'get',
            data: {
                uid: 104
            },
            success: (d) => {
                // console.log('====================================');
                // console.log(d);
                // console.log('====================================');
                MotoInterventient = [];
                var motos = d.split(';');
                for (let i = 0; i < motos.length - 1; i++) {
                    const element = motos[i];
                    MotoInterventient.push(element);
                    tracerLast(element);
                    console.log(i + '/' + motos.length);
                }
                showTableForMoto(MotoInterventient);

            },
            error: (err) => {
                console.log('====================================');
                console.log(err);
                console.log('====================================');
            }
        })

        // $.ajax({
        //     url: './pltng.php',
        //     type: 'GET',
        //     data: {
        //         userid: 97
        //     },
        //     success: function(d) {
        //         d = d.replace('MULTIPOLYGON(((', '');
        //         d = d.replace('POLYGON', '');
        //         d = d.replace(')))', '');
        //         d = d.replace('(((', '');
        //         d = d.replace('))', '');
        //         d = d.replace('((', ''); 
        //         PathP = [];
        //         var t = d.split('*');
        //         var tt = t[0].split(',');
        //         for (let i = 0; i < tt.length; i++) {
        //             PathP.push({
        //                 lat: Number(tt[i].split(' ')[1]),
        //                 lng: Number(tt[i].split(' ')[0])
        //             })
        //         }
        //         var color = '#ef3352' 
        //         map = new google.maps.Map(document.getElementById('map'), {
        //             zoom: 13.4,
        //             mapTypeId: 'terrain',
        //             center: ps,
        //             mapTypeControl: false,
        //             disableDefaultUI: true,
        //         });
        //         polygonTanger = new google.maps.Polygon({
        //             paths: PathP,
        //             strokeColor: 'black',
        //             fillColor: 'black',
        //             id: 0,
        //             strokeOpacity: 1,
        //             strokeWeight: 3,
        //             // fillColor: color,
        //             fillOpacity: 0.6,
        //             title: 'Tanger',
        //             map: map,
        //             visible: true
        //         });
        //         polygonTanger.addListener('click', () => { 
        //             polygonTanger.setVisible(false);
        //             showPolygones();
        //             polygonTanger.setVisible(false); 
        //             markerTanger.setVisible(false); 
        //             cauche = 'zones';
        //         }) 
        //         ps = {
        //             lat: Number(t[1]),
        //             lng: Number(t[2])
        //         }
        //         map.setCenter(ps)
        //         markerTanger = new google.maps.Marker({
        //             position: ps,
        //             map: map,
        //             label: {
        //                 text: '** %',
        //                 title: '0',
        //                 fontSize: '24px',
        //                 fontWeight: 'bold'
        //             },
        //             labelAnchor: new google.maps.Point(3, 30),
        //             labelInBackground: false,
        //             icon: 'None'
        //         });
        //         $.ajax({
        //             url: 'uprcnt.php',
        //             method: 'get',
        //             data: {
        //                 userid: 97
        //             },
        //             success: function(d) {
        //                 console.log("d : " + d);
        //                 var p = d.split(';');
        //                 pourcentages = [];
        //                 for (let i = 0; i < p.length - 1; i++) {
        //                     var t1 = p[i].split(',');
        //                     document.getElementById('zone').innerHTML = t1[0];
        //                     pourcentages.push([t1[0], t1[1], t1[2], t1[3]]); 
        //                 }
        //                 for (let i = 0; i < markersT.length; i++) {
        //                     markersT[i].setOptions({
        //                         label: {
        //                             text: pourcentages[i][1] + '%',
        //                             fontWeight: 'bold',
        //                             fontSize: '28px',
        //                             fontSize: '24px',
        //                             fontWeight: 'bold'
        //                         }
        //                     })
        //                 }
        //                 $.ajax({
        //                     url: 'tt.php',
        //                     method: "GET",
        //                     data: {
        //                         uid: 97
        //                     },
        //                     success: function(d) { 
        //                         markerTanger.setOptions({
        //                             label: {
        //                                 text: d + '%',
        //                                 fontWeight: 'bold',
        //                                 fontSize: '24px',
        //                                 fontWeight: 'bold'
        //                             }
        //                         })
        //                         if (d > 70) {
        //                             polygonTanger.setOptions({
        //                                 strokeColor: 'black',
        //                                 fillColor: 'green'
        //                             })
        //                         } else if (d < 30) {
        //                             polygonTanger.setOptions({
        //                                 strokeColor: 'black',
        //                                 fillColor: 'red'
        //                             })
        //                         } else {
        //                             polygonTanger.setOptions({
        //                                 strokeColor: 'black',
        //                                 fillColor: 'yellow'
        //                             })
        //                         }
        //                         polygonTanger.addEventListener('click', (e) => {
        //                             showPolygones();
        //                         })
        //                     }
        //                 })
        //                 $.ajax({
        //                     url: './bcs.php',
        //                     data: {
        //                         userid: 97
        //                     },
        //                     success: function(d) { 
        //                         var t = d.split('*');
        //                         bacs = [];
        //                         for (let i = 0; i < t.length; i++) {
        //                             var tt = t[i].split(',');

        //                             bacs.push([
        //                                 new google.maps.Marker({
        //                                     position: {
        //                                         lat: Number(tt[0]),
        //                                         lng: Number(tt[1])
        //                                     },
        //                                     title: tt[2]
        //                                 }), {
        //                                     lat: tt[0],
        //                                     lng: tt[1]
        //                                 },
        //                                 tt[3], tt[4], tt[5], tt[2], tt[6]
        //                             ])
        //                         }

        //                         function addListenerToMarker(marker, date, type, numpark) {
        //                             var infowindow = new google.maps.InfoWindow({
        //                                 content: "Type : " + type + "<br>Date : " + date +
        //                                     "<br>N° park : " + numpark
        //                             });
        //                             google.maps.event.addListener(marker, 'click', function() {
        //                                 infowindow.open(map, marker);
        //                             });
        //                         }

        //                         for (let i = 0; i < bacs.length; i++) {
        //                             addListenerToMarker(bacs[i][0], bacs[i][6], bacs[i][4], bacs[i][5]);
        //                         } 
        //                         $('#imgWait').fadeOut(500);
        //                     }
        //                 })
        //             }
        //         })
        //     }
        // })
        // document.querySelector('#mode').addEventListener('click', () => {
        //     var cl = document.querySelector('#mode').classList[0]
        //     console.log(cl);
        //     if (cl == 'map') {
        //         document.querySelector('#mode').classList.remove('map');
        //         document.querySelector('#mode').classList.add('table');
        //         document.querySelector('#modeI').classList = ""
        //         document.querySelector('#modeI').classList.add('fa')
        //         document.querySelector('#modeI').classList.add('fa-table')
        //     } else if (cl == 'table') {
        //         document.querySelector('#mode').classList.remove('table');
        //         document.querySelector('#mode').classList.add('map');
        //         document.querySelector('#modeI').classList = ""
        //         document.querySelector('#modeI').classList.add('fa')
        //         document.querySelector('#modeI').classList.add('fa-map')

        //     }
        // })
        let xs = [];
        // $.ajax({
        //     url: 'taux.php',
        //     success: (data) => {
        //         console.log('====================================');
        //         console.log(data);
        //         console.log('==========1==========================');
        //         d = data.split('*');
        //         var t = $('<table class=\"scroll table\"></table>')
        //         var th = $('<thead><tr><th>N°</th><th>Circuit</th><th>Vehicule</th><th>Taux (%)</th></tr></thead>');
        //         var tb = $('<tbody></tbody>');
        //         t.append(th);
        //         for (let i = 0; i < d.length - 1; i++) {
        //             var ligne = d[i].split(';');
        //             var tr = $('<tr></tr>')
        //             // for (let j = 0; j < ligne.length - 1; j++) {
        //             var td1 = $('<td>' + i + '</td>');
        //             var td2 = $('<td>' + ligne[1] + '</td>');
        //             var td3 = $('<td>' + ligne[2] + '</td>');
        //             var td4 = $('<td>' + ligne[0] + '</td>');
        //             tr.append(td1);
        //             tr.append(td2);
        //             tr.append(td3);
        //             tr.append(td4);

        //             // }
        //             tb.append(tr)
        //         }
        //         console.log('====================================');
        //         console.log("end");
        //         console.log('====================================');
        //         t.append(tb);
        //         $('#tableMan').append(t);
        //         // Change the selector if needed
        //         var $table = $('table.scroll'),
        //             $bodyCells = $table.find('tbody tr:first').children(),
        //             colWidth;

        //         // Adjust the width of thead cells when window resizes
        //         $(window).resize(function() {
        //             // Get the tbody columns width array
        //             colWidth = $bodyCells.map(function() {
        //                 return $(this).width();
        //             }).get();

        //             // Set the width of thead columns
        //             $table.find('thead tr').children().each(function(i, v) {
        //                 $(v).width(colWidth[i]);
        //             });
        //         }).resize(); // Trigger resize handler
        //     }
        // })

        let pathP = [];
        let p = [];
        var d = new Date();
        let users = [];
        const v = document.querySelector("#ville");
        // v.addEventListener('change', (e) => {
        //     var vi = document.querySelector('#ville').value;
        //     $.ajax({
        //         url: 'dd.php',
        //         method: 'GET',
        //         data: {
        //             ville: vi
        //         },
        //         success: (d) => {
        //             console.log('====================================');
        //             console.log(d);
        //             console.log('====================================');
        //         }
        //     })
        // })
        // $.ajax({
        //     url: 'planning.php',
        //     method: 'GET',
        //     data: {
        //         userid: 97,
        //         f: '%CO%'
        //     },
        //     success: (data) => {
        //         console.log('====================================');
        //         console.log(data);
        //         console.log('====================================');
        //         plannings = data.split('*');
        //         $('#shift').children().remove().end()
        //         for (let i = 0; i < plannings.length - 1; i++) {
        //             var x = plannings[i].split('|');
        //             //$('#combo').append('<select id="shiftCiCo"></select>');
        //             $('#shift').append('<option value="' + plannings[i] + '">' + x[0].split(' ')[1] + '|' + x[1].split(' ')[1] + '</option>');
        //         }
        //         $('#shift').append('<option value="' + plannings[0].split('|')[0] + '|' + plannings[plannings.length - 2].split('|')[1] + '">Toute la journée</option>');

        //     }
        // })

        function addListenerP(pl, k, t) {
            var infowindow = new google.maps.InfoWindow({
                content: "<b>Véhicule : " + k + "</b><br>Date : " + t
            });
            google.maps.event.addListener(pl, 'click', function(event) {
                infowindow.setPosition(event.latLng);
                infowindow.open(map);
            });
        }

        function getHoursDiff(startDate, endDate) {
            const msInHour = 1000 * 60 * 60;
            return Math.round(Math.abs(endDate - startDate) / msInHour);
        }

        function showPolygones() {
            for (var cc = 0; cc < bacs.length; cc++) {
                if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
                    bacs[cc][0].setMap(map);
                } else {
                    bacs[cc][0].setMap(null);
                }

                var d = new Date();
                if (getHoursDiff(new Date(bacs[cc][6]), new Date()) < 24) {
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
        let path = [];
        var path1 = [];
        // $(document).ready(function() {
        let mapVeh = new Map();
        const icons = [
            ['bsf.png', 'bef.png'],
            ['rsf.png', 'ref.png'],
            ['gsf.png', 'gef.png']
        ];
        let veh = [];

        function showForLaVvoi() {
            $("#combo").css('display', 'block');
            /*$('#shiftCiCo').append('<option value="1">22h->05h</option>');
            $('#shiftCiCo').append('<option value="2">06h->14h</option>');
            $('#shiftCiCo').append('<option value="3">14h->20h</option>');
            $('#shiftCiCo').append(' <option value="0">toute la journée</option>');*/
            const changeSelected = (e) => {
                var d = new Date();
                var l;
                if (d.getHours() <= 05) {
                    l = 1
                } else if (d.getHours() > 5 && d.getHours() < 14) {
                    l = 2
                } else if (d.getHours() >= 14 && d.getHours() < 20) {
                    l = 3
                } else {
                    l = 0
                }
                const $select = document.querySelector('#shiftCiCo');
                $select.value = l + ''
            };
            //changeSelected()

        }
        // $.ajax({
        //     url: 'v.php',
        //     method: 'GET',
        //     success: (d) => {
        //         veh = [];
        //         var f = d.split('*');
        //         for (let u = 0; u < f.length - 1; u++) {
        //             mapVeh.set(f[u], []);
        //             veh.push(f[u]);
        //         }

        //         console.log('====================================');
        //         console.log(veh);
        //         var l = 0;
        //         console.log('====================================');
        //         for (let i = 0; i < veh.length; i++) {
        //             var c = veh[i];
        //             var ic = icons[i][0]
        //             var ic1 = icons[i][1]
        //             $.ajax({
        //                 url: 'lavVoi.php',
        //                 method: 'GET',
        //                 data: {
        //                     veh: c
        //                 },
        //                 success: (d) => {
        //                     console.log('====================================');
        //                     console.log('Vehicule : ' + c);
        //                     console.log('====================================');
        //                     console.log('====================================');
        //                     console.log('d : ' + d);
        //                     console.log('====================================');
        //                     var result = d.split('*');
        //                     var x = {
        //                         lat: Number(result[0].split(',')[0]),
        //                         lng: Number(result[0].split(',')[1])
        //                     }
        //                     var m0 = new google.maps.Marker({
        //                         position: x,
        //                         map: map,
        //                         visible: true,
        //                         icon: icons[l][0]
        //                     })
        //                     for (let t = 1; t < result.length - 1; t++) {
        //                         cols = result[t].split(',');
        //                         var pp = [x, {
        //                             lat: Number(cols[0]),
        //                             lng: Number(cols[1])
        //                         }]
        //                         color = ['blue', 'green']
        //                         // console.log('====================================');
        //                         // console.log(color[Number(cols[4])]);
        //                         // console.log('====================================');
        //                         const pl0 = new google.maps.Polyline({
        //                             path: pp,
        //                             map: map,
        //                             fillColor: color[Number(cols[4])],
        //                             strokeColor: color[Number(cols[4])],
        //                             strokeWeight: 5
        //                         })
        //                         addListenerP(pl0, cols[2], cols[3]);
        //                         x = {
        //                             lat: Number(cols[0]),
        //                             lng: Number(cols[1])
        //                         }
        //                         // mapVeh.get(cols[2]).push({
        //                         //     lat: Number(cols[0]),
        //                         //     lng: Number(cols[1])
        //                         // }); 
        //                     }
        //                     var m1 = new google.maps.Marker({
        //                         position: x,
        //                         map: map,
        //                         visible: true,
        //                         icon: icons[l++][1]
        //                     })

        //                     color = ['green', 'red', 'blue'];
        //                     var i = 0;
        //                     for (const [k, v] of mapVeh) {
        //                         const pl0 = new google.maps.Polyline({
        //                             path: mapVeh.get(k),
        //                             map: map,
        //                             fillColor: color[i],
        //                             strokeColor: color[i++],
        //                             strokeWeight: 5
        //                         })
        //                         addListenerP(pl0, k);
        //                     }
        //                     console.log('====================================');
        //                     console.log(path1);
        //                     console.log('====================================');
        //                 }
        //             })
        //         }
        //     }
        // })

        // $.ajax({
        //     url: './pltng.php',
        //     type: 'GET',
        //     data: {
        //         userid: 97
        //     },
        //     success: function(d) {
        //         d = d.replace('POLYGON((', '');
        //         d = d.replace('))', '');
        //         path = [];
        //         var t = d.split('*');
        //         var tt = t[0].split(',');
        //         for (let i = 0; i < tt.length; i++) {
        //             path.push({
        //                 lat: Number(tt[i].split(' ')[1]),
        //                 lng: Number(tt[i].split(' ')[0])
        //             })
        //         }
        //         var color = '#ef3352'
        //         console.log(path);
        //         polygonTanger = new google.maps.Polygon({
        //             paths: path,
        //             strokeColor: '#ef1a5d',
        //             id: 0,
        //             strokeOpacity: 0.5,
        //             strokeWeight: 2,
        //             // fillColor: color,
        //             fillOpacity: 0.6,
        //             title: 'Tanger',
        //             map: map,
        //             visible: true
        //         });
        //         polygonTanger.addListener('click', () => {
        //             alert(this.title);
        //             polygonTanger.setVisible(false);
        //             showPolygones();
        //         })
        //         // polygonTanger.addEventListener('click', function(event) {
        //         //     alert("get Polygones")
        //         // });
        //         console.log('==================  ==================');
        //         markerTanger = new google.maps.Marker({
        //             position: {
        //                 lat: Number(t[1]),
        //                 lng: Number(t[2])
        //             },
        //             map: map,
        //             label: {
        //                 text: '** %',
        //                 title: '0',
        //                 fontSize: '24px',
        //                 fontWeight: 'bold'
        //             },
        //             labelAnchor: new google.maps.Point(3, 30),
        //             labelInBackground: false,
        //             icon: 'None'
        //         });
        //         $.ajax({
        //             url: 'uprcnt.php',
        //             success: function(d) {
        //                 console.log("d : " + d);
        //                 var p = d.split(';');
        //                 pourcentages = [];
        //                 for (let i = 0; i < p.length; i++) {
        //                     var t1 = p[i].split(',');
        //                     pourcentages.push([t1[0], t1[1], t1[2], t1[3]]);
        //                 }
        //                 for (let i = 0; i < markersT.length; i++) {
        //                     markersT[i].setOptions({
        //                         label: {
        //                             text: pourcentages[i][1] + '%',
        //                             fontWeight: 'bold',
        //                             fontSize: '28px',

        //                             fontSize: '24px',
        //                             fontWeight: 'bold'
        //                         }
        //                     })
        //                 }
        //                 $.ajax({
        //                     url: 'tt.php',
        //                     success: function(d) {
        //                         console.log("d : " + d);
        //                         markerTanger.setOptions({
        //                             label: {
        //                                 text: d + '%',
        //                                 fontWeight: 'bold',
        //                                 fontSize: '24px',
        //                                 fontWeight: 'bold'
        //                             }
        //                         })
        //                         if (d > 70) {
        //                             polygonTanger.setOptions({
        //                                 strokeColor: 'green',
        //                                 fillColor: 'green'
        //                             })
        //                         } else if (d < 30) {
        //                             polygonTanger.setOptions({
        //                                 strokeColor: 'red',
        //                                 fillColor: 'red'
        //                             })
        //                         } else {
        //                             polygonTanger.setOptions({
        //                                 strokeColor: 'yellow',
        //                                 fillColor: 'yellow'
        //                             })
        //                         }
        //                     }
        //                 })
        //                 $.ajax({
        //                     url: './bcs.php',
        //                     success: function(d) {
        //                         var t = d.split('*');
        //                         bacs = [];
        //                         for (let i = 0; i < t.length; i++) {
        //                             var tt = t[i].split(',');

        //                             bacs.push([
        //                                 new google.maps.Marker({
        //                                     position: {
        //                                         lat: Number(tt[0]),
        //                                         lng: Number(tt[1])
        //                                     },
        //                                     title: tt[2]
        //                                 }), {
        //                                     lat: tt[0],
        //                                     lng: tt[1]
        //                                 },
        //                                 tt[3], tt[4], tt[5]
        //                             ])
        //                         }
        //                         console.log('====================================');
        //                         console.log(bacs.length);
        //                         console.log('====================================');
        //                         $('#imgWait').fadeOut(500);
        //                     }
        //                 })
        //             }
        //         })
        //     }
        // })
        // google.maps.event.addListener(polygonTanger, 'click', function() {
        //     alert("get Polygones")
        // });$
        $.ajax({
            url: 'contact.php',
            method: 'GET',
            data: {
                userid: 97
            },
            success: function(d) {
                var t = d.split(';');
                users = [];
                for (let c = 0; c < t.length - 1; c++) {
                    user = t[c].split(',');
                    users.push(user);
                }
                // for (let user of users) {
                //     let li = $('<li class="w3-padding-hor-16"><span class="w3-closebtn w3-padding w3-margin-right w3-medium"><a href="tel:' + user[2] + '"><i class="fa fa-phone" style="font-size: 20pt;padding-top: 9pt;"></i></a></span><img src="./images/' + user[0].substr(0, 1).toLowerCase() + '.png" class="w3-left w3-margin-right" style="width:40px;height:40px"><span class="">' + user[0] + '</span><br><span>' + user[1] + '</span>');
                //     $('#contacts').append(li)
                // }
            }
        })

        // })
        //});
        window.initMap = initMap;
        // let C_ARTA3401 = [];
        // let C_ARTA3501 = [];
        // let C_ARTA3502 = [];
        // var d = new Date();
        // if (d.getHours() < 05) {
        //     dd = '' + (d.getDate() - 1) + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 22:00:00'
        //     df = '' + d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 05:00:00'
        // } else if (d.getHours() > 05 && d.getHours() < 14) {
        //     dd = '' + (d.getDate()) + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 05:00:00'
        //     df = '' + d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 14:00:00'
        // } else if (d.getHours() >= 14 && d.getHours() <= 20) {
        //     dd = '' + (d.getDate()) + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 14:00:00'
        //     df = '' + d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 20:00:00'
        // } else {
        //     dd = '' + (d.getDate() - 1) + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 22:00:00';
        //     df = '' + d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 20:000:00';
        // }
        // // alert(sh + ' ' + (df));
        // console.log('====================================');
        // console.log("beging");
        // console.log('====================================');
        // $.ajax({
        //     url: './clctCir.php',
        //     type: 'POST',
        //     data: {
        //         dd: dd, //(new Date().getHours() < 14) ? '06:00:00' : '14:00:00',
        //         df: df // (new Date().getHours() < 14) ? '14:00:00' : '20:00:00'
        //     },
        //     success: function(d) {
        //         console.log("d:" + d);
        //         var tx = d.split('*');
        //         for (let i = 0; i < tx.length - 1; i++) {
        //             var ty = tx[i].split(';');
        //             var t = ty[0];
        //             var t1 = t.replace('LINESTRING(', '');
        //             t1 = t1.replace(')', '');
        //             t1 = t1.replace('\n', '');
        //             path = [];
        //             t1 = t1.split(',');
        //             for (let j = 0; j < t1.length; j++) {
        //                 var ttt = t1[j].split(' ');
        //                 var p = {
        //                     lat: Number(ttt[1]),
        //                     lng: Number(ttt[0])
        //                 };
        //                 console.log(p);
        //                 path.push(p);
        //             }
        //             if (Number(ty[1]) < 30)
        //                 color = 'red';
        //             else if (Number(ty[1]) >= 30 && Number(ty[1]) < 70)
        //                 color = 'yellow'
        //             else
        //                 color = 'green'
        //             const pl = new google.maps.Polyline({
        //                 path: path,
        //                 map: map,
        //                 fillColor: color,
        //                 strokeColor: color,
        //                 title: ty[1] + "," + ty[2] + "," + ty[3]
        //             })
        //             google.maps.event.addListener(pl, 'click', function() {
        //                 alert("Circuit : " + this.title.split(',')[1] +
        //                     "\nVéhicule : " + this.title.split(',')[2] +
        //                     "\nTaux : " + this.title.split(',')[0] + "%",

        //                 )
        //             })
        //         }
        //         $("#imgWait").fadeOut(150);
        //         console.log('====================================');
        //         console.log("End");
        //         console.log('====================================');
        //     },
        //     error: function(d) {
        //         log(d);
        //     }

        // })
        // document.querySelector('button').addEventListener('click', function() {
        //     var sh = $("#shift").val();
        //     // alert(sh);
        //     map = new google.maps.Map(document.getElementById("map"), {
        //         center: {
        //             lat: 35.762103,
        //             lng: -5.809260
        //         },
        //         zoom: 8,
        //     });
        //     var d = new Date();
        //     if (sh == '1') {
        //         dd = '' + (d.getDate() - 1) + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 22:00:00'
        //         df = '' + d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 05:00:00'
        //     } else if (sh == '2') {
        //         dd = '' + (d.getDate()) + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 05:00:00'
        //         df = '' + d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 14:00:00'
        //     } else if (sh == '3') {
        //         dd = '' + (d.getDate()) + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 14:00:00'
        //         df = '' + d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 20:00:00'
        //     } else {
        //         dd = '' + (d.getDate() - 1) + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 22:00:00';
        //         df = '' + d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 20:000:00';
        //     }
        //     // alert(sh + ' ' + (df));
        //     console.log('====================================');
        //     console.log("beging");
        //     console.log('====================================');
        //     $.ajax({
        //         url: './clctCir.php',
        //         type: 'POST',
        //         data: {
        //             dd: dd, //(new Date().getHours() < 14) ? '06:00:00' : '14:00:00',
        //             df: df // (new Date().getHours() < 14) ? '14:00:00' : '20:00:00'
        //         },
        //         success: function(d) {
        //             console.log("d:" + d);
        //             var tx = d.split('*');
        //             for (let i = 0; i < tx.length - 1; i++) {
        //                 var ty = tx[i].split(';');
        //                 var t = ty[0];
        //                 var t1 = t.replace('LINESTRING(', '');
        //                 t1 = t1.replace(')', '');
        //                 t1 = t1.replace('\n', '');
        //                 path = [];
        //                 t1 = t1.split(',');
        //                 for (let j = 0; j < t1.length; j++) {
        //                     var ttt = t1[j].split(' ');
        //                     var p = {
        //                         lat: Number(ttt[1]),
        //                         lng: Number(ttt[0])
        //                     };
        //                     console.log(p);
        //                     path.push(p);
        //                 }
        //                 if (Number(ty[1]) < 30)
        //                     color = 'red';
        //                 else if (Number(ty[1]) >= 30 && Number(ty[1]) < 70)
        //                     color = 'yellow'
        //                 else
        //                     color = 'green'
        //                 const pl = new google.maps.Polyline({
        //                     path: path,
        //                     map: map,
        //                     fillColor: color,
        //                     strokeColor: color,
        //                     title: ty[1] + "," + ty[2] + "," + ty[3]
        //                 })
        //                 google.maps.event.addListener(pl, 'click', function() {
        //                     alert("Circuit : " + this.title.split(',')[1] +
        //                         "\nVéhicule : " + this.title.split(',')[2] +
        //                         "\nTaux : " + this.title.split(',')[0] + "%",

        //                     )
        //                 })
        //             }
        //             $("#imgWait").fadeOut(150);
        //             console.log('====================================');
        //             console.log("End");
        //             console.log('====================================');
        //         },
        //         error: function(d) {
        //             log(d);
        //         }

        //     })
        // })
    </script>
    <script src="./js/fs.js"></script>
    <div class="title" id="title" hidden>
        <table style="width: 100%;text-align:center;padding:10px; height: 100%;">
            <tr style="padding: 10pt;">
                <td style="width: 10%;">
                    <button class="btnTitle act" id="act">
                        <i class="fa fa-arrow-left" aria-hidden="true" style="font-size:30pt;height: 100%;width:100%;"></i>
                    </button>
                </td>
                <td>
                    <span style="width: 35% ;text-align: right;"> Taux de réalisation:</span> <span style="width : 35%;text-align: left;" id="zone">ville Tanger</span>
                </td>
                <td>
                    <button class="btnTitle out" id="out">
                        <i class="fa fa-sign-out" aria-hidden="true" style="font-size:30pt;height: 100%;width:100%; "></i>
                    </button>
                </td>
            </tr>
            <tr style="padding: 10pt;">
                <td>
                </td>
                <td>
                    <span style="width: 35% ;text-align: right;"> Dernière mise à jour: </span>
                    <span style="width : 35%;text-align: left;" id="lu">
                        <?php date_default_timezone_set("africa/Casablanca");
                        echo date("d/m/Y G\hi\m\i\\n") ?></span>
                </td>
                <td>
                    <button class="btnTitle out" id="reload">
                        <i class="fa fa-refresh" aria-hidden="true" style="font-size:30pt;height: 100%;width:100%; "></i>
                    </button>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
<!-- for (let i = 0; i < t0.length; i++) {
                        console.log(t0[i]);
                        var t1 = t0[i].split(',');
                        if (t1[4] == 'green')
                            color = 'green';
                        else
                            color = 'blue'
                        if (t1[5] == "ARTA3401") {
                            C_ARTA3401.push(new google.maps.Polyline({
                                path: [{
                                    lat: Number(t1[0]),
                                    lng: Number(t1[1])
                                }, {
                                    lat: Number(t1[2]),
                                    lng: Number(t1[3])
                                }],
                                map: map,
                                strokeColor: color
                            }))
                        } else if (t1[5] == "ARTA3501") {
                            C_ARTA3501.push(new google.maps.Polyline({
                                path: [{
                                    lat: Number(t1[0]),
                                    lng: Number(t1[1])
                                }, {
                                    lat: Number(t1[2]),
                                    lng: Number(t1[3])
                                }],
                                map: map,
                                strokeColor: color
                            }))
                        } else if (t1[5] == "ARTA3502") {
                            C_ARTA3502.push(new google.maps.Polyline({
                                path: [{
                                    lat: Number(t1[0]),
                                    lng: Number(t1[1])
                                }, {
                                    lat: Number(t1[2]),
                                    lng: Number(t1[3])
                                }],
                                map: map,
                                strokeColor: color
                            }))
                        }
                    } 
                    var myChart0 = null;

        function hi2(a, b, c) {
            const ctx1 = document.getElementById('myChart1');

            myChart0 = new Chart(ctx1, {
                type: 'pie',
                data: {
                    labels: ['0%->30%', '30%->70%', '70%->100%'],
                    datasets: [{
                        label: '# of Votes',
                        data: [a, b, c],
                        backgroundColor: [
                            'red',
                            'yellow',
                            'green'
                        ],
                        borderColor: [
                            'red',
                            'yellow',
                            'green'
                        ],
                        borderWidth: 1,
                        datalabels: {
                            font: {
                                size: '33px',
                                weight: 'bold'
                            },
                            color: 'white',
                        }
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    legend: {
                        display: false
                    },
                },
                plugins: [ChartDataLabels],
                options: {

                }
            });
        }
        hi2(0, 0, 0);
        var myChart = null;

        function hi() {
            var z1 = 0;
            var z2 = 0;
            const ctx = document.getElementById('myChart');
            if (myChart != null) {
                myChart.destroy();
            }
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['BENI MAKADA', 'MGHOGHA'],
                    datasets: [{
                        label: 'TAUX',
                        legend: false,
                        data: [Number(tt.get('BENI MAKADA')), Number(tt.get('MGHOGHA'))],
                        backgroundColor: [
                            'rgba(25, 99, 132, 0.2)',
                            'rgba(54, 162, 205, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                        ],
                        borderWidth: 1,
                        datalabels: {
                            font: {
                                size: '28 px',
                                weight: 'bold'
                            },
                            color: 'black',
                        }
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        },
                    },
                    indexAxis: 'y',
                    plugins: {
                        tooltip: {
                            enable: false,
                        },
                        datalabels: {
                            formatter: (value, context) => {
                                return value + " %"
                            }
                        },
                        legend: {
                            display: false
                        }
                    }
                },
                plugins: [ChartDataLabels],

            });

        }

        function dr() {
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Contry', 'Mhl'],
                    ['balayé', balaye],
                    ['non balayé', totale - balaye],
                ]);

                var options = {
                    title: 'Balayage manuel',
                    is3D: true
                };

                var chart = new google.visualization.PieChart(document.getElementById('myChart'));
                chart.draw(data, options);
            }
        }