<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="author" content="https://mmenujs.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <title>mmenu - Demo</title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="./css/demo.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./js/mmenu/mmenu.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/fontawesome-free-6.1.2-web/css/all.min.css">
    <link rel="stylesheet" href="./css/divCall.css">
    <!-- <script src="https://maps.googleapis.com/maps/api/js?libraries=geometry&ext=.js"></script> -->
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js" integrity="sha256-+8RZJua0aEWg+QVVKg4LEzEEm/8RFez5Tb4JBNiV5xA=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0-rc.1/chartjs-plugin-datalabels.min.js" integrity="sha512-+UYTD5L/bU1sgAfWA0ELK5RlQ811q8wZIocqI7+K0Lhh8yVdIoAMEs96wJAIbgFvzynPm36ZCXtkydxu1cs27w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="./css/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        .preview {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .preview img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #ccc;
        }

        .preview>span {
            flex-grow: 1;
        }

        .details {
            padding: 50px 20px;
        }

        .details img {
            display: block;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto 20px;
            background: #ccc;
        }

        .details strong {
            display: block;
            margin-bottom: 20px;
            text-align: center;
            font-size: 18px;
        }

        .details dl {
            display: grid;
            grid-template-columns: auto 1fr;
        }

        .details dt,
        .details dd {
            padding: 15px 0;
            margin: 0;
        }

        .details dt {
            padding-right: 15px;
            color: #999;
        }

        .details dd {
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .details dd~dt,
        .details dd~dd {
            border-top: 1px solid #ccc;
        }

        #map {
            position: absolute !important;
            height: 72vh !important;
            width: 99%;
            border: 1px solid black;
        }
    </style>
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-y: auto;
        }

        .sidepanel {
            width: 0;
            position: fixed;
            z-index: 10010;
            height: 87vh;
            top: 10px;
            left: 0;
            background-color: white;
            overflow-x: hidden;
            transition: 0.25s;
            padding-top: 30px;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .sidepanel button.MainMenu {
            padding: 4px 2px 0px 8px;
            text-decoration: none;
            font-size: 18px;
            color: black;
            display: block;
            transition: 0.3s;
            border-bottom: 2px solid lightgrey;
            width: 80%;
            background: none;
            border: none;
            text-align: left;
        }

        .sidepanel button.SousMenu {
            padding: 3px 3px 3px 35px;
        }

        .sidepanel button.SousMenu.active,
        .sidepanel button.MainMenu.active {
            color: #119912;
        }

        .sidepanel .closebtn,
        .sidepanel .closebtn span {
            position: absolute;
            top: 0;
            right: 15px;
            font-size: 30px;
            text-align: left;
            font-weight: bold;
            height: 3vh !important;
        }

        .openbtn,
        .combo {
            font-size: 25px;
            cursor: pointer;
            background-color: white;
            color: black;
            padding: 5px 15px;
            border: none;
            border-radius: 0 4px 4px 0;
            width: auto;
            position: absolute;
            top: 10px;
            z-index: 10010;
        }


        .openbtn:hover {
            background-color: #444;
        }

        #map {
            width: 100%;
            height: 92vh;
        }

        .callResp,
        .export,
        .rje3 {
            position: absolute;
            z-index: 1001;
            bottom: 10vh;
            right: 5px;
            height: 8vh;
            width: 8vh;
            border-radius: 150px;
            border: none;
            outline: none !important;
        }

        .export {
            bottom: 1vh;
            z-index: 1002;
        }

        .rje3 {
            bottom: 19vh;
        }

        #call,
        #myChart0 {
            width: 100%;
            height: 92vh;
            background-color: white;
            position: absolute;
            right: 100%;
            text-align: center;
        }

        #call {
            z-index: 10011;
        }

        #imgWait {
            width: 100%;
            height: 92vh;
            border-radius: 4px;
            position: absolute;
            padding: auto;
            top: 0vh;
            z-index: 100001;
            padding: 30vh 10%;
            background-color: #11080b;
            text-align: center;
            opacity: 0.7;
        }

        #imgWait img {
            /* width: 50%;
            height: 50%; */
            opacity: 1;
            background-color: #11080b;
        }

        #imgWait p {
            font-family: 'Courier New', Courier, monospace;
            font-size: larger;
            font-weight: bold;
            color: wheat;
            background-color: #11080b;
            opacity: 1;
        }

        #imgLogo {
            border-radius: 0 0 7px 0;
        }

        div.C {
            height: auto;
            width: calc(100%);
            border-radius: 5px;
            background-color: yellow;
            text-align: center;
        }

        fieldset {
            border: 2px solid black;
        }

        #myChart0 {
            height: 82vh;
            top: 10vh;
        }

        #myChart {
            width: 100% !important;
            /* height: 50vh !important; */
            position: absolute;
            top: calc((85vh - 50vh)/2);
        }

        #bt {
            width: 80%;
            height: 40vh;
            position: absolute;
            left: calc((100% - 80%)/2);
            top: calc((80vh - 40vh - 10vh)/2);
            border-radius: 50%;
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;
            font-size: 32px;
            letter-spacing: 3px;
            border: none;
            background-color: #119912;
        }

        #mns {
            display: none;
            position: absolute;
            right: 5px;
            bottom: 18vh;
            border: 2px solid #f1f1f1;
            padding: 2vh 2vh;
            border-radius: 200px;
            height: 8vh;
            width: 8vh;
        }

        #main {
            position: absolute;
            z-index: 10009;
            width: 100%;
            height: 92vh;
            background-color: #119912;
        }

        marquee {
            font-weight: bold;
            font-size: 21pt;
        }

        #combo {
            position: absolute;
            background-color: #119912;
            z-index: 1000;
            right: 10px;
            top: 10px;
            width: 40%;
            display: none;
        }

        #combo select {
            width: 100%;
        }

        #toHideNB {
            width: 100%;
            height: 100vh;
            background-color: lightgray;
            position: absolute;
            z-index: 10010;
            display: none;
            opacity: 0.6;
        }
    </style>
</head>

<body>

    <div id="toHideNB"></div>
    <div id="page">
        <button class="openbtn" id="openbtn" onclick="openNav()"> ☰ </button>
        <div id="header">
            <a href="#page" class="fa fa-close"></a>
            <div id="combo" class="comp">
                <select name="shift" id="shift">
                    <option value="ALL">Toute la journée</option>
                    <option value="MAT">de 05h à 14h</option>
                    <option value="SOI">de 14h à 20h</option>
                </select>
            </div>
            <a href="#menu2" class="fa fa-bars" style="margin-left: 92%;"></a>

        </div>

        <div id="mySidepanel" class="sidepanel">
            <span class="closebtn" onclick="closeNav()">x</span>

            <button class="MainMenu active mo3ta1" onclick="BacsCollecte(); $('#imgWait').fadeOut(10);">
                <!-- <img src="./bac_rouge.png" height="20" alt=""> -->
                Collecte par conteneurs
            </button>
            <button class="MainMenu mo3ta2" onclick="CircuitsCollecte(); ">Collecte par circuits</button>
            <button class="MainMenu mo3ta3" onclick="BacsLavage();">
                <!-- <img src="./bac_rouge.png" height="20" alt=""> -->
                Lavage par conteneurs
            </button>
            <button class="MainMenu mo3ta4" onclick="CircuitsLavage(); $('#imgWait').fadeOut(10);">Lavage des voiries</button>
            <button class="MainMenu mo3ta5" id="bm">Balayage manuel</button>
            <button class="MainMenu mo3ta6" onclick="BalayageMecanique(); $('#imgWait').fadeOut(10);">Balayage mécanique</button>
            <hr>
            <button id="showLegende" class="btn btn-success">
                Afficher la légende <span class="fa fa-eye"></span>
            </button>
            <hr>
            <div class="logo" style="width: 100%;padding: 0;margin: 0;position: absolute;bottom: 0;">
                <a href="https://insightsolutions.ma/" target="_blanck" style="padding: 0;margin: 0;width: 100%;">
                    <img src="./testLogo.png" alt="LOGO_INSIGHTSOLUTIONS" id="imgLogo" style="width: 100%;">
                </a>
            </div><br>

        </div>
        <div class="ContainerMap">
            <div id="map"></div>
        </div>
    </div>
    <div id="menu2">
        <ul id="contacts">
            <li>
                <span>
                    <span class="preview">
                        <img src="img/profile-1-b.png" />
                        <span>oualid<br>
                            <small><Label>Lachgar</Label></small>
                        </span>
                    </span>
                </span>

                <div data-mm-title="Alan Thompson">
                    <div class="details">
                        <img src="img/profile-1-b.png" />
                        <strong>Oualid</strong>
                        <dl>
                            <dt>Nom : </dt>
                            <dd>Oualid lachgar</dd>

                            <dt>Télé : </dt>
                            <dd>0622115470</dd>

                            <dt>Email</dt>
                            <dd>Pas</dd>
                        </dl>
                    </div>
                </div>
            </li>
            <li>
                <span>
                    <span class="preview">
                        <img src="img/profile-1-b.png" />
                        <span>Moaad<br>
                            <small><Label>EL ABOUDI</Label></small>
                        </span>
                    </span>
                </span>

                <div data-mm-title="Alan Thompson">
                    <div class="details">
                        <img src="img/profile-1-b.png" />
                        <strong>Oualid</strong>
                        <dl>
                            <dt>Nom : </dt>
                            <dd>Moaad EL ABOUDI</dd>

                            <dt>Télé : </dt>
                            <dd>0622115470</dd>

                            <dt>Email</dt>
                            <dd>Pas</dd>
                        </dl>
                    </div>
                </div>
            </li>
            <li>
                <span>
                    <span class="preview">
                        <img src="img/profile-1-b.png" />
                        <span>Rachid<br>
                            <small><Label>EL BAYADE</Label></small>
                        </span>
                    </span>
                </span>

                <div data-mm-title="Alan Thompson">
                    <div class="details">
                        <img src="img/profile-1-b.png" />
                        <strong>Oualid</strong>
                        <dl>
                            <dt>Nom : </dt>
                            <dd>Rachid EL BAYADE</dd>

                            <dt>Télé : </dt>
                            <dd>0622115470</dd>

                            <dt>Email</dt>
                            <dd>Pas</dd>
                        </dl>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <script src="./js/mmenu/mmenu.js"></script>

    <script>
        let PathP = [];
        var ps = null;
        $(document).ready(function() {
            $('#imgWait').show();

            $.ajax({
                url: './pltng.php',
                type: 'GET',
                data: {
                    userid: readCookie('iduserST')
                },
                success: function(d) {
                    d = d.replace('POLYGON((', '');
                    d = d.replace('))', '');
                    PathP = [];
                    var t = d.split('*');
                    var tt = t[0].split(',');
                    for (let i = 0; i < tt.length; i++) {
                        PathP.push({
                            lat: Number(tt[i].split(' ')[1]),
                            lng: Number(tt[i].split(' ')[0])
                        })
                    }
                    var color = '#ef3352'
                    let c = {
                        lat: Number(t[2]),
                        lng: Number(t[1])
                    }
                    ps = {
                        lat: Number(t[1]),
                        lng: Number(t[2])
                    }
                    //// console.log(c);
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
                        center: new google.maps.LatLng(Number(t[1]), Number(t[2])),
                        fillColor: 'black',
                        id: 0,
                        strokeOpacity: 1,
                        strokeWeight: 3,
                        // fillColor: color,
                        fillOpacity: 0.6,
                        title: 'Tanger',
                        map: map,
                        visible: true
                    });
                    polygonTanger.addListener('click', () => {
                        //alert(this.title);
                        polygonTanger.setVisible(false);
                        showPolygones();
                        polygonTanger.setVisible(false);
                        markerClick.setVisible(false);
                        markerTanger.setVisible(false);
                        markerTanger0.setVisible(false);
                        cauche = 'zones';
                    })
                    // polygonTanger.addEventListener('click', function(event) {
                    //     alert("get Polygones")
                    // });
                    // // console.log('==================  ==================');

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
                    $.ajax({
                        url: 'uprcnt.php',
                        method: 'get',
                        data: {
                            userid: readCookie('iduserST')
                        },
                        success: function(d) {
                            // // console.log("d : " + d);
                            var p = d.split(';');
                            pourcentages = [];
                            for (let i = 0; i < p.length; i++) {
                                var t1 = p[i].split(',');
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
                                success: function(d) {
                                    // // console.log("d : " + d);
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
                                    // // console.log('=============== BACS =====================');
                                    // // console.log(d);
                                    // // console.log('====================================');
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
                                            content: "Type : " + type + "<br>Date : " + date +
                                                "<br>N° park : " + numpark
                                        });
                                        google.maps.event.addListener(marker, 'click', function() {
                                            infowindow.open(map, marker);
                                        });
                                    }

                                    for (let i = 0; i < bacs.length; i++) {
                                        addListenerToMarker(bacs[i][0], bacs[i][6], bacs[i][4], bacs[i][5]);
                                    }
                                    // console.log('====================================');
                                    // console.log(bacs.length);
                                    // console.log('====================================');
                                    $('#imgWait').fadeOut(500);
                                }
                            })
                        }
                    })
                }
            })

            function addListenerToMarker(marker, date, type, numpark) {
                var infowindow = new google.maps.InfoWindow({
                    content: "Type : " + type + "<br>Date : " + date +
                        "<br>N° park : " + numpark
                });
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map, marker);
                });
            }

            for (let i = 0; i < bacs.length; i++) {
                addListenerToMarker(bacs[i][0], bacs[i][6], bacs[i][4], bacs[i][5]);
            }
            $.ajax({
                url: './nums.php',
                method: 'post',
                success: function(d) {
                    var lignes = d.split('*');
                    for (let i = 0; i < lignes.length - 1; i++) {
                        const resp = lignes[i].split(',');
                        // console.log(resp)
                        if (resp[4] == 0) {
                            dirNums.push(resp);
                        } else {
                            CENums.push(resp);
                        }

                    }
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

        })

        function showPolygones() {
            polygons = [];
            $.ajax({
                url: './spl.php',
                type: 'GET',
                data: {
                    userid: readCookie('iduserST')
                },
                success: function(d) {
                    d = d.replace('MULTIPOLYGON', ' ')
                    var ds = d.split(';');
                    markersT = [];
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
                        }
                        var pourcentageMap = new Map();
                        for (let i = 0; i < pourcentages.length; i++) {
                            pourcentageMap.set(pourcentages[i][0], [pourcentages[i][1], pourcentages[i][2], pourcentages[i][3]])
                        }
                        var color;
                        if (pourcentageMap.get(ann)[0] < 30) color = 'red';
                        else if (pourcentageMap.get(ann)[0] > 70) color = 'green';
                        else color = 'yellow';
                        //p = []
                        polygons.push(new google.maps.Polygon({
                            paths: pathP,
                            strokeColor: 'black',
                            fillColor: color,
                            id: i,
                            strokeOpacity: 5,
                            strokeWeight: 2,
                            fillOpacity: 6,
                            title: ann,
                            map: map,
                            visible: true
                        }));
                        let ms = [];
                        markersT.push(
                            new google.maps.Marker({
                                position: {
                                    lat: Number(lt[2]),
                                    lng: Number(lt[3])
                                },
                                map: map,
                                visible: true,
                                label: {
                                    text: pourcentageMap.get(ann)[0] + ' %',
                                    title: '0'
                                },
                                labelAnchor: new google.maps.Point(3, 30),
                                labelInBackground: false,
                                icon: 'None'
                            })
                        )
                        /*p[i].addListener('click', (event) => {
                            // console.log(event.get_resources());
                        })*/
                    }

                    for (let x = 0; x < polygons.length; x++) {
                        //const element = polygons[x];
                        polygons[x].addListener('click', function(e) {
                            all(x);
                        });
                    }
                    for (let x = 0; x < markersT.length; x++) {
                        //const element = polygons[x];
                        markersT[x].addListener('click', function(e) {
                            all(x);
                        });
                    }
                }
            })
            // polygones[1].addListener('click', () => {
            //     // console.lo g(p[1].title);
            // })
        }

        function showPolygonesLavage() {
            LavagePolygones = [];
            markersL = [];
            $.ajax({
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
                        }
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
                        var ttl = pourcentagesLavage.get(ann) / bacsParZone.get(ann) * 100;
                        if (ttl < 30) color = 'red';
                        else if (ttl > 70) color = 'green';
                        else color = 'yellow';
                        let ms = [];
                        LavagePolygones.push(new google.maps.Polygon({
                            paths: pathP,
                            strokeColor: 'black',
                            fillColor: color,
                            id: i,
                            strokeOpacity: 1,
                            strokeWeight: 2,
                            fillOpacity: 1,
                            title: ann,
                            map: map,
                            visible: true
                        }));
                        markersL.push(
                            new google.maps.Marker({
                                position: {
                                    lat: Number(lt[2]),
                                    lng: Number(lt[3])
                                },
                                map: map,
                                visible: true,
                                label: {
                                    text: (ttl).toFixed(2) + ' %',
                                    title: '0'
                                },
                                labelAnchor: new google.maps.Point(3, 30),
                                labelInBackground: false,
                                icon: 'None'
                            })
                        )
                        /*p[i].addListener('click', (event) => {
                            // console.log(event.get_resources());
                        })*/
                    }
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

                }
            })
            // polygones[1].addListener('click', () => {
            //     // console.lo g(p[1].title);
            // })
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
            for (let i = 0; i < bacsLaver.length; i++) {
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
                } else {
                    bacsLaver[i][0].setVisible(false);
                    bacsLaver[i][0].setMap(map);
                }
            }
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

                if (bacs[cc][3] == d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate()) {
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

            if (caucheL == 'ville') {
                // // console.log('Ville');
            } else if (caucheL == 'zones') {
                $('#uls').empty();
                addDirNums();
                LavageMap.setVisible(true);
                markerLavage.setVisible(true);
                markerLavage0.setVisible(true);
                markerClick1.setVisible(true);
                LavageMap.setMap(map);
                markerLavage.setMap(map);
                markerLavage0.setMap(map);
                markerClick1.setMap(map);
                caucheL = 'ville';
                for (var p = 0; p < LavagePolygones.length; p++) {
                    LavagePolygones[p].setVisible(false);
                    markersL[p].setVisible(false);
                }
                $('#zone').text('ville');
            } else if (caucheL == 'bacs') {
                // var cdcd = document.getElementById('map').offsetHeight;
                hhh = 0;
                $('#statitstics').attr('hidden', true);
                for (var bcs = 0; bcs < bacsLaver.length; bcs++) {
                    bacsLaver[bcs][0].setMap(null);
                }
                for (var pls = 0; pls < LavagePolygones.length; pls++) {
                    LavagePolygones[pls].setOptions({
                        fillOpacity: 0.7,
                        strokeColor: 'black',
                        strokeWeight: 3
                    });
                    markersL[pls].setVisible(true);
                    markersL[pls].setMap(map);
                }
                for (var rm = 0; rm < bacsLaver.length; rm++) {
                    bacsLaver[rm][0].setVisible(true);
                    bacsLaver[rm][0].setMap(null);
                }
                $('#zone').text('Par Zones');
                caucheL = 'zones';
                // // // console.log(cauche);
            }
            for (var sp = 0; sp < polyline.length; sp++) {
                polyline[sp].setVisible(false);
            }
        }
    </script>
    <script>
        function openNav() {
            document.getElementById("mySidepanel").style.width = "77%";
            document.getElementById("toHideNB").style.display = "block";
            document.getElementById("openbtn").style.display = "none";
        }

        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
            document.getElementById("openbtn").style.display = "block";
            document.getElementById("toHideNB").style.display = "none";
        }
        $.ajax({
            url: './nums.php',
            method: 'post',
            success: function(d) {
                var lignes = d.split('*');
                var l = '';
                for (let i = 0; i < lignes.length - 1; i++) {
                    const resp = lignes[i].split(',');
                    console.log(resp)
                    var li = $("<li></li>");
                    // var spn =
                    l +=
                        '<li>' +
                        '<span>' +
                        '<span class="preview">' +
                        '<img src="img/profile-1-b.png" />' +
                        '<span>' + resp[1] + '<br>' +
                        '<small><Label>' + resp[1] + '</Label></small>' +
                        '</span>' +
                        '</span>' +
                        '</span>' +

                        '<div data-mm-title="Alan Thompson">' +
                        '<div class="details">' +
                        ' <img src="img/profile-1-b.png" />' +
                        '<strong>Oualid</strong>' +
                        '<dl>' +
                        '<dt>Nom : </dt>' +
                        '<dd>' + resp[1] + '</dd>' +

                        '<dt>Télé : </dt>' +
                        '<dd>' + resp[2] + '</dd>' +

                        '<dt>nature: </dt>' +
                        '<dd>' + resp[3] + '</dd>' +
                        // '<dt> secteur : </dt>' +
                        // '<dd>' + resp[5] + '</dd>' +
                        ' </dl>' +
                        '</div>' +
                        '</div>' +
                        '</li><br>'

                }
                // document.getElementById("contacts").innerHTML = l;
            }
        })

        function CircuitsLavage() { //lavage des voiries
            $('#myChart0').animate({
                'right': '120%'
            });
            $("#combo").css('display', 'block');
            $('#combo').children().remove().end();
            $('#export').fadeOut(150);
            $('#map').animate({
                right: '0'
            })
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13.4,
                mapTypeId: 'terrain',
                center: ps,
                mapTypeControl: false,
                disableDefaultUI: true,
            });
            $('#imgWait').slideDown(800);
            $.ajax({
                url: './lavVoi.php',
                success: function(d) {
                    t0 = d.split(';');
                    color = 'green';
                    C_ARTA3401 = [];
                    C_ARTA3501 = [];
                    C_ARTA3502 = [];
                    for (let i = 0; i < t0.length; i++) {
                        // // console.log(t0[i]);
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
                        setTimeout(function() {
                            $('#imgWait').fadeOut(700);
                        }, 2000)
                    }
                }
            })
            /*Changer a color*/
            $('#act').animate({
                'right': '200%'
            });
            $('#act2').attr('hidden', 'true');
            $('#act3').attr('hidden', 'true');
            closeNav();
            document.querySelector('.mo3ta4').classList.add('active');
            document.querySelector('.mo3ta1').classList.remove('active');
            document.querySelector('.mo3ta3').classList.remove('active');
            document.querySelector('.mo3ta2').classList.remove('active');
            document.querySelector('.mo3ta5').classList.remove('active');
            document.querySelector('.mo3ta6').classList.remove('active');
        }

        function BalayageMecanique() {
            $('#myChart0').animate({
                'right': '120%'
            });
            $('#export').fadeIn(150);
            $('#map').animate({
                right: '0'
            })

            showForMec();
            EXP = 'BalMec';
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13.4,
                mapTypeId: 'terrain',
                center: ps,
                mapTypeControl: false,
                disableDefaultUI: true,
            });

            var dd, df;
            var dt = new Date();
            if (dt.getHours() < 05) {
                dd = '' + (dt.getDate() - 1) + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear() + ' 22:00:00'
                df = '' + dt.getDate() + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear() + ' 05:00:00'
            } else if (dt.getHours() > 05 && dt.getHours() < 14) {
                dd = '' + (dt.getDate()) + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear() + ' 05:00:00'
                df = '' + dt.getDate() + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear() + ' 14:00:00'
            } else if (dt.getHours() >= 14 && dt.getHours() <= 20) {
                dd = '' + (dt.getDate()) + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear() + ' 14:00:00'
                df = '' + dt.getDate() + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear() + ' 20:00:00'
            } else {
                dd = '' + (dt.getDate() - 1) + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear() + ' 22:00:00';
                df = '' + dt.getDate() + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear() + ' 20:00:00';
            }
            $("#imgWait").fadeIn(1940);
            // console.log('====================================');
            // console.log(dd + '\n' + df + '\n' + dt.getDate() + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear());
            // console.log('====================================');
            $.ajax({
                url: './bmec.php',
                type: 'GET',
                data: {
                    dd: dd,
                    df: df,
                    iduser: readCookie('iduserST')
                    //d: dt.getDate() + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear()
                },
                success: function(d) {
                    // console.log("d:" + d + '\n') // +  d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 21:00:00');
                    var tx = d.split('*');
                    for (let i = 0; i < tx.length - 1; i++) {
                        var ty = tx[i].split(';');
                        var t = ty[0];
                        var t1 = t.replace('LINESTRING(', '');
                        t1 = t1.replace(')', '');
                        t1 = t1.replace('\n', '');
                        path = [];
                        t1 = t1.split(',');
                        for (let j = 0; j < t1.length; j++) {
                            var ttt = t1[j].split(' ');
                            var p = {
                                lat: Number(ttt[1]),
                                lng: Number(ttt[0])
                            };
                            // // console.log(p);
                            path.push(p);
                        }
                        if (Number(ty[1]) < 30)
                            color = 'red';
                        else if (Number(ty[1]) >= 30 && Number(ty[1]) < 70)
                            color = 'yellow'
                        else
                            color = 'green'
                        const pl = new google.maps.Polyline({
                            path: path,
                            map: map,
                            fillColor: color,
                            strokeColor: color,
                            title: ty[1] + "," + ty[2] + "," + ty[3]
                        })
                        google.maps.event.addListener(pl, 'click', function() {
                            swal({
                                text: "Circuit : " + this.title.split(',')[1] +
                                    "\nVéhicule : " + this.title.split(',')[2] +
                                    "\nTaux : " + this.title.split(',')[0] + "%",
                                button: 'ok'
                            })
                        })
                    }
                    //$("#imgWait").fadeOut(1500);
                    // console.log('====================================');
                    // console.log("End");
                    // console.log('====================================');
                },
                error: function(d) {
                    // console.log(d);
                }

            })

            // $.ajax({
            //     url: './bmec.php',
            //     success: function(d) {
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
            //                 swal({
            //                     // text: \"Taux : 12%\\nVéhicule : ATRA***\\nCircui: BGMB41\",
            //                     text: "Circuit : " + this.title.split(',')[1] +
            //                         "\nVéhicule : " + this.title.split(',')[2] +
            //                         "\nTaux : " + this.title.split(',')[0] + "%",
            //                     buttons: {
            //                         ok: "Ok",
            //                     },
            //                 })
            //             })
            //         }

            //     }
            // })

            $('#act2').attr('hidden', 'true');
            $('#act3').attr('hidden', 'true');
            closeNav();
            document.querySelector('.mo3ta6').classList.add('active');
            document.querySelector('.mo3ta1').classList.remove('active');
            document.querySelector('.mo3ta2').classList.remove('active');
            document.querySelector('.mo3ta3').classList.remove('active');
            document.querySelector('.mo3ta4').classList.remove('active');
            document.querySelector('.mo3ta5').classList.remove('active');


        }
        document.querySelector('#bm').addEventListener('click', function() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13.4,
                mapTypeId: 'terrain',
                center: ps,
                mapTypeControl: false,
                disableDefaultUI: true,
            });
            showForBalMan();
            EXP = "MAN"
            $('#imgWait').fadeIn(450)
            $("#combo").css('display', 'block');
            // const changeSelected = (e) => {
            //     var d = new Date();
            //     var l;
            //     if (d.getHours() <= 05) {
            //         l = 1
            //     } else if (d.getHours() > 5 && d.getHours() < 14) {
            //         l = 2
            //     } else if (d.getHours() >= 14 && d.getHours() < 20) {
            //         l = 3
            //     } else {
            //         l = 0
            //     }
            //     const $select = document.querySelector('#shift');
            //     $select.value = l
            // };
            // changeSelected()
            var dd, df;
            var dt = new Date();
            if (dt.getHours() < 14) {
                dd = '' + (dt.getDate()) + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear() + ' 00:00:00'
                df = '' + dt.getDate() + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear() + ' 14:00:00'
            } else {
                dd = '' + (dt.getDate()) + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear() + ' 14:00:00';
                df = '' + dt.getDate() + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear() + ' 23:59:00';
            }
            $('#imgWait').fadeIn(150);
            $.ajax({
                url: './apahman.php',
                method: 'POST',
                data: {
                    dd: dd,
                    df: df,
                    userid: readCookie('iduserST')
                    //d: (dt.getDate()) + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear()
                },
                success: function(d) {
                    // console.log('====================================');
                    // console.log(d);
                    // console.log('====================================');
                    var tx = d.split('*');
                    for (let i = 0; i < tx.length - 1; i++) {
                        var ty = tx[i].split(';');
                        var t = ty[0];
                        var t1 = t.replace('LINESTRING(', '');
                        t1 = t1.replace(')', '');
                        t1 = t1.replace('\n', '');
                        path = [];
                        t1 = t1.split(',');
                        for (let j = 0; j < t1.length; j++) {
                            var ttt = t1[j].split(' ');
                            var p = {
                                lat: Number(ttt[1]),
                                lng: Number(ttt[0])
                            };
                            path.push(p);
                        }

                        if (Number(ty[1]) < 30)
                            color = 'red';
                        else if (Number(ty[1]) >= 30 && Number(ty[1]) < 70)
                            color = 'yellow'
                        else
                            color = 'green'

                        const pl = new google.maps.Polyline({
                            path: path,
                            map: map,
                            fillColor: color,
                            strokeColor: color,
                            title: ty[1] + "," + ty[2] + "," + ty[3]
                        })
                        PolylineMAN.set(ty[2], [ty[1], ty[3]]);
                        google.maps.event.addListener(pl, 'click', function() {
                            swal({
                                text: "Circuit : " + this.title.split(',')[1] +
                                    "\nVéhicule : " + this.title.split(',')[2] +
                                    "\nTaux : " + this.title.split(',')[0] + "%"
                            })
                        })
                    }
                    $('#imgWait').fadeOut(150)
                }
            })
            // EXP = 'BalMan'
            // $('#myChart0').animate({
            //     'right': '0%'
            // });
            // $('#export').fadeOut(150);
            // $('#map').animate({
            //     right: '100%'
            // })
            // // console.log("bal man ");
            // // traité
            // $('#imgWait').fadeIn(150);
            // $.ajax({
            //     url: 'files2.php',
            //     method: 'POST',
            //     success: function(d) {
            //         totale = d;
            //         document.querySelector('#txtbtn').innerHTML = d + "%";
            //         $('#imgWait').fadeOut(450)
            //     }
            // })
            // $('#act').animate({
            //     'right': '200%'
            // });
            // $('#act3').removeAttr('hidden');

            // $('#act3').animate({
            //     'right': '5px'
            // });

            $('#act2').attr('hidden', 'true');
            $('#act3').attr('hidden', 'true');
            closeNav();
            document.querySelector('.mo3ta5').classList.add('active');
            document.querySelector('.mo3ta1').classList.remove('active');
            document.querySelector('.mo3ta2').classList.remove('active');
            document.querySelector('.mo3ta3').classList.remove('active');
            document.querySelector('.mo3ta4').classList.remove('active');
            document.querySelector('.mo3ta6').classList.remove('active');
        }, {
            passive: true
        })

        function CircuitsCollecte() {
            // cauch = 'circuit';

            showForColCi();
            $('#myChart0').animate({
                'right': '120%'
            });
            $('#export').fadeIn(150);
            $('#map').animate({
                right: '0'
            })
            EXP = 'CircuitCo';
            $('#act2').attr('hidden', 'true');
            $('#act3').attr('hidden', 'true');

            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13.4,
                mapTypeId: 'terrain',
                center: ps,
                mapTypeControl: false,
                disableDefaultUI: true,
            });
            $("#imgWait").slideDown(200);
            var date = new Date();
            var d = new Date();
            var dd, df;
            if (d.getHours() < 05) {
                dd = '' + (d.getDate() - 1) + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 22:00:00'
                df = '' + d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 05:00:00'
            } else if (d.getHours() > 05 && d.getHours() < 14) {
                dd = '' + (d.getDate()) + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 05:00:00'
                df = '' + d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 14:00:00'
            } else if (d.getHours() >= 14 && d.getHours() <= 20) {
                dd = '' + (d.getDate()) + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 14:00:00'
                df = '' + d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 20:00:00'
            } else {
                dd = '' + (d.getDate() - 1) + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 22:00:00';
                df = '' + d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 20:00:00';
            }
            $("#imgWait").slideDown(200);
            $.ajax({
                url: './clctCir.php',
                type: 'GET',
                data: {
                    dd: dd, //(new Date().getHours() < 13) ? date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear() + ' 06:00:00' : date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear() + ' 14:00:00',
                    df: df, //(new Date().getHours() < 13) ? date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear() + ' 14:00:00' : date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear() + ' 20:00:00'
                    iduser: readCookie('iduserST')
                    //d: d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear()
                },
                success: function(d) {
                    // console.log('====================================');
                    // console.log('d: ' + d.length);

                    // console.log(dd + '\n' + df + '\n' + d);
                    // console.log('====================================');
                    if (d.length < 3) {
                        swal({
                            text: 'Aucun vehicule planifié pour le shift : \n' + dd.split(' ')[1] + ' => ' + df.split(' ')[1]
                        })
                    } else {
                        var tx = d.split('*');
                        polylineMap = new Map();
                        for (let i = 0; i < tx.length - 1; i++) {
                            var ty = tx[i].split(';');
                            var t = ty[0];
                            var t1 = t.replace('LINESTRING(', '');
                            t1 = t1.replace(')', '');
                            t1 = t1.replace('\n', '');
                            path = [];
                            t1 = t1.split(',');
                            for (let j = 0; j < t1.length; j++) {
                                var ttt = t1[j].split(' ');
                                var p = {
                                    lat: Number(ttt[1]),
                                    lng: Number(ttt[0])
                                };
                                path.push(p);
                            }

                            if (Number(ty[1]) < 30)
                                color = 'red';
                            else if (Number(ty[1]) >= 30 && Number(ty[1]) < 70)
                                color = 'yellow'
                            else
                                color = 'green'
                            const pl = new google.maps.Polyline({
                                path: path,
                                map: map,
                                fillColor: color,
                                strokeColor: color,
                                title: ty[1] + "," + ty[2] + "," + ty[3]
                            })
                            polylineMap.set(ty[2], [ty[3], ty[1]])
                            // console.log('===========     Polyline      ==============');
                            // console.log(polylineMap.get(ty[2]));
                            // console.log('====================================');
                            google.maps.event.addListener(pl, 'click', function() {
                                swal({
                                    // text: \"Taux : 12%\\nVéhicule : ATRA***\\nCircui: BGMB41\",
                                    text: "Circuit : " + this.title.split(',')[1] +
                                        "\nVéhicule : " + this.title.split(',')[2] +
                                        "\nTaux : " + this.title.split(',')[0] + "%",
                                    buttons: {
                                        ok: "Ok",
                                    },
                                })
                            })
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
                                const $select = document.querySelector('#shift');
                                $select.value = l
                            };
                            console.log('====================================');
                            console.log(l);
                            console.log('====================================');
                            changeSelected()
                        }
                        // setInterval(() => {
                        // }, 1500);
                    }
                    // console.log('====================================');

                    function slidit() {
                        $("#imgWait").slideUp(200);
                    }

                    setTimeout(slidit, 1000)
                    // console.log("Ended on circuit collecte");
                    // console.log('====================================');
                }
            })
            $('#act').animate({
                'right': '200%'
            });
            $('#act3').animate({
                'right': '200%'
            });
            document.querySelector('.mo3ta2').classList.add('active');
            document.querySelector('.mo3ta1').classList.remove('active');
            document.querySelector('.mo3ta3').classList.remove('active');
            document.querySelector('.mo3ta4').classList.remove('active');
            document.querySelector('.mo3ta5').classList.remove('active');
            document.querySelector('.mo3ta6').classList.remove('active');
            /*
            for (var sp = 0; sp < polyline.length; sp++) {
                polyline[sp].setMap(map);
                polyline[sp].setVisible(true);
            }
            $('#statitstics').hide(400);
            $('#charh').slideDown(700);*/
            closeNav();
        };

        function readCookie(name) {
            var nameEQ = encodeURIComponent(name) + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) === ' ')
                    c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) === 0)
                    return decodeURIComponent(c.substring(nameEQ.length, c.length));
            }
            return null;
        }

        function BacsCollecte() {

            $('#imgWait').fadeIn(500);
            $("#combo").css('display', 'none');
            $('#combo').children().remove().end()
            EXP = 'BacsCo';
            $('#act2').attr('hidden', 'true');
            $('#act3').attr('hidden', 'true');
            $('#act').animate({
                'right': '5px'
            });
            $('#myChart0').animate({
                'right': '120%'
            });
            $('#export').fadeIn(150);
            $('#map').animate({
                right: '0'
            })
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13.4,
                mapTypeId: 'terrain',
                center: ps,
                mapTypeControl: false,
                disableDefaultUI: true,
                gestureHandling: 'greedy'
            });
            $('#act2').attr('hidden', 'true');

            document.querySelector('.mo3ta1').classList.add('active');
            document.querySelector('.mo3ta2').classList.remove('active');
            document.querySelector('.mo3ta3').classList.remove('active');
            document.querySelector('.mo3ta4').classList.remove('active');
            document.querySelector('.mo3ta5').classList.remove('active');
            document.querySelector('.mo3ta6').classList.remove('active');
            closeNav();
            $.ajax({
                url: './pltng.php',
                type: 'GET',
                data: {
                    userid: readCookie('iduserST')
                },
                success: function(d) {
                    d = d.replace('POLYGON((', '');
                    d = d.replace('))', '');
                    PathP = [];
                    var t = d.split('*');
                    var tt = t[0].split(',');
                    for (let i = 0; i < tt.length; i++) {
                        PathP.push({
                            lat: Number(tt[i].split(' ')[1]),
                            lng: Number(tt[i].split(' ')[0])
                        })
                    }
                    var color = '#ef3352'
                    // console.log(PathP);
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
                        // fillColor: color,
                        fillOpacity: 0.6,
                        title: 'Tanger',
                        map: map,
                        visible: true
                    });
                    polygonTanger.addListener('click', () => {
                        //alert(this.title);
                        polygonTanger.setVisible(false);
                        showPolygones();
                        polygonTanger.setVisible(false);
                        markerClick.setVisible(false);
                        markerTanger.setVisible(false);
                        markerTanger0.setVisible(false);
                        cauche = 'zones';
                    })
                    // polygonTanger.addEventListener('click', function(event) {
                    //     alert("get Polygones")
                    // });
                    // console.log('==================  ==================');
                    ps = {
                        lat: Number(t[1]),
                        lng: Number(t[2])
                    }
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
                    $.ajax({
                        url: 'uprcnt.php',
                        method: 'get',
                        data: {
                            userid: readCookie('iduserST')
                        },
                        success: function(d) {
                            // console.log("d : " + d);
                            var p = d.split(';');
                            pourcentages = [];
                            for (let i = 0; i < p.length; i++) {
                                var t1 = p[i].split(',');
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
                                success: function(d) {
                                    // console.log("d : " + d);
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
                                    // console.log('=============== BACS =====================');
                                    // console.log(d);
                                    // console.log('====================================');
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
                                            content: "Type : " + type + "<br>Date : " + date +
                                                "<br>N° park : " + numpark
                                        });
                                        google.maps.event.addListener(marker, 'click', function() {
                                            infowindow.open(map, marker);
                                        });
                                    }

                                    for (let i = 0; i < bacs.length; i++) {
                                        addListenerToMarker(bacs[i][0], bacs[i][6], bacs[i][4], bacs[i][5]);
                                    }
                                    // console.log('====================================');
                                    // console.log(bacs.length);
                                    // console.log('====================================');
                                    $('#imgWait').fadeOut(500);
                                }
                            })
                        }
                    })
                }
            })
            // $.ajax({
            //     url: './nums.php',
            //     method: 'post',
            //     success: function(d) {
            //         var lignes = d.split('*');
            //         for (let i = 0; i < lignes.length - 1; i++) {
            //             const resp = lignes[i].split(',');
            //             // console.log(resp)
            //             if (resp[4] == 0) {
            //                 dirNums.push(resp);
            //             } else {
            //                 CENums.push(resp);
            //             }

            //         }
            //     }
            // })
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
            // $.ajax({
            //     url: 'uprcnt.php',
            //     success: function(d) {
            //         // console.log("d : " + d);
            //         var p = d.split(';');
            //         pourcentages = [];
            //         for (let i = 0; i < p.length; i++) {
            //             var t1 = p[i].split(',');
            //             pourcentages.push([t1[0], t1[1], t1[2], t1[3]]);
            //         }
            //         for (let i = 0; i < markersT.length; i++) {
            //             markersT[i].setOptions({
            //                 label: {
            //                     text: pourcentages[i][1] + '%',
            //                     fontWeight: 'bold',
            //                 }
            //             })
            //         }
            //         $.ajax({
            //             url: 'tt.php',
            //             success: function(d) {
            //                 // console.log("d : " + d);
            //                 markerTanger.setOptions({
            //                     label: {
            //                         text: d + '%',
            //                         fontWeight: 'bold'
            //                     }
            //                 })
            //             }
            //         })
            //         $.ajax({
            //             url: './bcs.php',
            //             method: 'get',
            //             data: {
            //                 userid: readCookie('iduserST')
            //             },
            //             success: function(d) {
            //                 // console.log('=================  bcs  ===================');
            //                 // console.log(d);
            //                 // console.log('====================================');
            //                 var t = d.split('*');
            //                 bacs = [];
            //                 for (let i = 0; i < t.length; i++) {
            //                     var tt = t[i].split(',');

            //                     bacs.push([
            //                         new google.maps.Marker({
            //                             position: {
            //                                 lat: Number(tt[0]),
            //                                 lng: Number(tt[1])
            //                             },
            //                             title: tt[2]
            //                         }), {
            //                             lat: tt[0],
            //                             lng: tt[1]
            //                         },
            //                         tt[3], tt[4], tt[5]
            //                     ])
            //                 }
            //                 // console.log('====================================');
            //                 // console.log(bacs.length);
            //                 // console.log('====================================');
            //                 $('#imgWait').fadeOut(500);
            //             }
            //         })
            //     }
            // })
            polygonTanger.setMap(map);
            polygonTanger.setVisible(true);
            markerTanger.setMap(map);
            markerTanger.setVisible(true);
            markerTanger0.setMap(map);
            markerTanger0.setVisible(true);
            markerClick.setMap(map);
            markerClick.setVisible(true);
            // for(var sp=0;sp<polyline.length;sp++){
            //     polyline[sp].setVisible(false);
            // }
        }

        function BacsLavage() {
            EXP = 'BacsLav';
            $("#combo").css('display', 'none');
            $('#combo').children().remove().end()
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13.4,
                mapTypeId: 'terrain',
                center: ps,
                mapTypeControl: false,
                disableDefaultUI: true,
            });
            // showPolygonesLavage()
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
                // fillColor: color,
                fillOpacity: 0.6,
                title: 'Tanger',
                map: map,
                visible: true
            });
            $.ajax({
                url: 'lc.php',
                method: 'GET',
                data: {
                    userid: readCookie('iduserST')
                },
                success: function(d) {
                    // console.log('================  Lavage  Bacs   ====================');
                    // console.log(d);
                    // console.log('====================================');
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
                            }),
                            t1[4],
                            t1[3],
                            t1[5], t1[6], t1[7]
                        ])
                    }
                    for (var pr = 0; pr < pourcentages.length; pr++) {
                        pourcentagesLavage.set(pourcentages[pr][0], 0);
                        bacsParZone.set(pourcentages[pr][0], pourcentages[pr][3]);
                    }
                    var nbrBAcAA19_1 = 0;
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


                        /*
                        if(bacsLaver[ct][2]== '" . date('Y-m-d') . "'){
                            bacsLaver[ct][0].setIcon('bacmetal_vert.png');
                            NbrbacsLaver++;
                        }else{
                            bacsLaver[ct][0].setIcon('bacmetal_rouge.png');
                            NbrbacsNonLaver++;
                        }*/
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
                            content: "N° park : " + numparc + "<br>Type : " + type +
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
            LavageMap.addListener('click', function(event) {
                showPolygonesLavage()
                LavageMap.setVisible(false);
                markerLavage.setVisible(false);
                markerLavage0.setVisible(false);
                markerClick1.setVisible(false);
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 13.4,
                    mapTypeId: 'terrain',
                    center: ps,
                    mapTypeControl: false,
                    disableDefaultUI: true,
                });
                for (var cpl = 0; cpl < markersL.length; cpl++) {
                    markersL[cpl].setVisible(true);
                    markersL[cpl].setMap(map);
                }
                document.getElementById('zone').innerHTML = "Par Zones";
                caucheL = "zones";
                // // console.log(cauche);
                addCENumber();
                for (var plgns = 0; plgns < LavagePolygones.length; plgns++) {
                    LavagePolygones[plgns].setVisible(true);
                    LavagePolygones[plgns].setMap(map);
                    LavagePolygones[plgns].setOptions({
                        fillOpacity: 0.7,
                        strokeColor: 'black',
                        strokeWeight: 3
                    })
                    //markersT[plgns].setVisible(true);
                }
            });
            markerLavage0.addListener('click', function(event) {
                showPolygonesLavage()
                LavageMap.setVisible(false);
                markerLavage.setVisible(false);
                markerLavage0.setVisible(false);
                markerClick1.setVisible(false);
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 13.4,
                    mapTypeId: 'terrain',
                    center: ps,
                    mapTypeControl: false,
                    disableDefaultUI: true,
                });
                for (var cpl = 0; cpl < markersL.length; cpl++) {
                    markersL[cpl].setVisible(true);
                    markersL[cpl].setMap(map);
                }
                document.getElementById('zone').innerHTML = "Par Zones";
                caucheL = "zones";
                // // console.log(cauche);
                addCENumber();
                for (var plgns = 0; plgns < LavagePolygones.length; plgns++) {
                    LavagePolygones[plgns].setVisible(true);
                    LavagePolygones[plgns].setMap(map);
                    LavagePolygones[plgns].setOptions({
                        fillOpacity: 0.7,
                        strokeColor: 'black',
                        strokeWeight: 3
                    })
                    //markersT[plgns].setVisible(true);
                }
            })
            markerLavage.addListener('click', function(event) {
                showPolygonesLavage()
                LavageMap.setVisible(false);
                markerLavage.setVisible(false);
                markerLavage0.setVisible(false);
                markerClick1.setVisible(false);
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 13.4,
                    mapTypeId: 'terrain',
                    center: ps,
                    mapTypeControl: false,
                    disableDefaultUI: true,
                });
                for (var cpl = 0; cpl < markersL.length; cpl++) {
                    markersL[cpl].setVisible(true);
                    markersL[cpl].setMap(map);
                }
                document.getElementById('zone').innerHTML = "Par Zones";
                caucheL = "zones";
                // // console.log(cauche);
                addCENumber();
                for (var plgns = 0; plgns < LavagePolygones.length; plgns++) {
                    LavagePolygones[plgns].setVisible(true);
                    LavagePolygones[plgns].setMap(map);
                    LavagePolygones[plgns].setOptions({
                        fillOpacity: 0.7,
                        strokeColor: 'black',
                        strokeWeight: 3
                    })
                    //markersT[plgns].setVisible(true);
                }
            })
            markerClick1.addListener('click', function(event) {
                showPolygonesLavage()
                LavageMap.setVisible(false);
                markerLavage.setVisible(false);
                markerLavage0.setVisible(false);
                markerClick1.setVisible(false);
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 13.4,
                    mapTypeId: 'terrain',
                    center: ps,
                    mapTypeControl: false,
                    disableDefaultUI: true,
                });
                for (var cpl = 0; cpl < markersL.length; cpl++) {
                    markersL[cpl].setVisible(true);
                    markersL[cpl].setMap(map);
                }
                document.getElementById('zone').innerHTML = "Par Zones";
                caucheL = "zones";
                // // console.log(cauche);
                addCENumber();
                for (var plgns = 0; plgns < LavagePolygones.length; plgns++) {
                    LavagePolygones[plgns].setVisible(true);
                    LavagePolygones[plgns].setMap(map);
                    LavagePolygones[plgns].setOptions({
                        fillOpacity: 0.7,
                        strokeColor: 'black',
                        strokeWeight: 3
                    })
                    //markersT[plgns].setVisible(true);
                }
            })
            tauxLavageBacs = bacsLaver.length / bacs.length * 100;

            $('#act').animate({
                'right': '200%'
            });
            $('#act2').removeAttr('hidden');
            markerLavage.setMap(map);
            markerLavage.setVisible(true);
            // markerClick.setVisible(false);
            markerClick1.setMap(map);
            markerClick1.setVisible(true);
            markerLavage0.setMap(map);
            markerLavage0.setVisible(true);
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

        function call() {
            $('#call').animate({
                'right': '0%'
            });
            $('#myChart').animate({
                width: '0',
                display: 'none',
                zIndex: '0'
            });
            $("#act").css({
                'z_index': 10001
            })
            $("#act2").css({
                'z_index': 10001
            })
            $("#act3").css({
                'z_index': 10001
            })
            $("#callRes").css({
                'z_index': 10001
            })
            $('#export').css({
                'z_index': 10001
            })
        }
    </script>

    <script>
        document.addEventListener("click", (evnt) => {
            if (evnt.target?.closest?.('a[href^="#/"]')) {
                evnt.preventDefault();
                alert("Thank you for clicking, but that's a demo link.");
            }
        });

        document.addEventListener('DOMContentLoaded', () => {

            new Mmenu("#menu2", {
                navbar: {
                    title: "My contacts"
                },
                searchfield: {
                    add: true,
                    addTo: "#contacts"
                },
                offCanvas: {
                    position: "right-front"
                }
            }, {});

        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="./js/init.js"></script>
    <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-dn4yi8nZ8f8lMfQZNZ8AmEEVT07DEcE&region=MA&signed_in=true&libraries=drawing&callback=initMap" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.2.3/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/interactjs@1.10.17/dist/interact.min.js"></script>
    <script src="./js/jquery-3.6.0.js"></script>
    <script src="./js/script.js"></script>
    <script src="./js/login.js"></script>
    <script src="./js/voirie.js"></script>
    <script src="./js/animationCarte.js"></script>
    <script src="./js/OutAct.js"></script>
    <script src="./js/load.js"></script>
    <script src="./js/export.js"></script>
    <script src="./js/functions.js"></script>
    <script src="./js/listMan.js"></script>
    <script src="./js/listCol.js"></script>
    <script src="./js/listMec.js"></script>
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