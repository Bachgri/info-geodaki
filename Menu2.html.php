<?php
require './getPolygones2.php';
require './exportData.php';
require './LavVoi.php';
file_put_contents('./js/balman.js', '');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Tanger</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/fontawesome-free-6.1.2-web/css/all.min.css">
    <link rel="stylesheet" href="./css/divCall.css">
    <!-- <script src="https://maps.googleapis.com/maps/api/js?libraries=geometry&ext=.js"></script> -->
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>

    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-y: auto;
        }

        .sidepanel {
            width: 0;
            position: fixed;
            z-index: 1;
            height: 87vh;
            top: 10px;
            left: 0;
            background-color: white;
            overflow-x: hidden;
            transition: 0.25s;
            padding-top: 20px;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .sidepanel a {
            padding: 4px 2px 0px 10px;
            text-decoration: none;
            font-size: 20px;
            color: black;
            display: block;
            transition: 0.3s;
            border-bottom: 2px solid lightgrey;
        }

        .sidepanel a.SousMenu {
            padding: 3px 3px 3px 35px;
        }

        .sidepanel a.SousMenu.active,
        .sidepanel a.MainMenu.active {
            color: #119912;
        }

        .sidepanel .closebtn {
            position: absolute;
            top: 0;
            right: 15px;
            font-size: 30px;
            text-align: left;
            font-weight: bold;
            height: 3vh !important;
            background-color: #119912;
        }

        .openbtn {
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
            z-index: 1;
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

        #call {
            width: 100%;
            height: 92vh;
            background-color: white;
            position: absolute;
            z-index: 1001;
            right: 100%;
            text-align: center;
        }

        #imgWait {
            width: 40%;
            height: 20vh;
            border-radius: 40px;
            position: absolute;
            padding: auto;
            top: 30vh;
            left: 30%;
            z-index: 100001;
        }

        #imgLogo {
            border-radius: 7px;
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
    </style>
</head>

<body>
    <div class="call" id="call">
        <div style="width: 100%;text-align: center;font-weight: bold;">Appelez un respensable</div>
        <div class="rowc" id="uls" style="width: 100%;"></div>
        <button id="annulerCall" class="myBtns" onclick="
            $('#call').animate({
                'right': '120%'
            });
            $('#act').fadeIn(700);
            $('#act2').fadeIn(700);
            $('#act3').fadeIn(700);
            $('#callRes').fadeIn(700);
            $('#export').fadeIn(700);
        ">annuler</button>
    </div>
    <div class="menu">
        <div id="mySidepanel" class="sidepanel">
            <span class="closebtn" onclick="closeNav()">×</span>

            <a href="javascript:void(0)" class="MainMenu active mo3ta1" onclick="BacsCollecte(); $('#imgWait').fadeOut(10);">
                <img src="./bac_rouge.png" height="20" alt="">
                Collecte par bacs
            </a>
            <a href="javascript:void(0)" class="MainMenu mo3ta2" onclick="CircuitsCollecte(); $('#imgWait').fadeOut(10);">Collecte par circuits</a>
            <a href="javascript:void(0)" class="MainMenu mo3ta3" onclick="BacsLavage(); $('#imgWait').fadeOut(10);">
                <img src="./bac_rouge.png" height="20" alt="">
                Lavage des bacs
            </a>
            <a href="javascript:void(0)" class="MainMenu mo3ta4" onclick="CircuitsLavage(); $('#imgWait').fadeOut(10);">Lavage des voiries</a>
            <a href="./balyagaman/" class="MainMenu mo3ta5" onclick="BalayageManuel(); $('#imgWait').fadeOut(10);">Balayage Manuel</a>
            <a href="javascript:void(0)" class="MainMenu mo3ta6" onclick="BalayageMecanique(); $('#imgWait').fadeOut(10);">Balayage mécanique</a>
            <fieldset>
                <legend>legend : </legend>
                <table style="width: 98%;margin-left: 5px;">
                    <tr>
                        <td>
                            <div class="C" style="background-color: red;">
                                <p>T&lt;30%</p>
                            </div>
                        </td>
                        <td>
                            <div class="C" style="background-color: yellow;">
                                <p>30%&le;T&lt;70%</p>
                            </div>
                        </td>
                        <td>
                            <div class="C" style="background-color: green;">
                                <p>T&ge;100%</p>
                            </div>
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>
                            <img src="./bacmetal_vert.png" alt="">
                        </td>
                        <td>
                            Bac Collecté (24h)
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="./bacmetal_rouge.png" alt="">
                        </td>
                        <td>
                            Bac non Collecté (24h)
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="./bac_vert.png" alt="">
                        </td>
                        <td>
                            Collone Collecté (24h)
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="./bac_rouge.png" alt="">
                        </td>
                        <td>
                            Collone non Collecté (24h)
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <img src="./bacmetal_bleu.png" alt="">
                        </td>
                        <td>
                            Bacs/Collone Laver (7j)
                        </td>
                    </tr>
                </table>
            </fieldset>
            <div class="logo" style="width: 100%;height:17vh;padding: 0;margin: 0;">
                <a href="https://insightsolutions.ma/" target="_blanck" style="padding: 0;margin: 0;width: 100%;">
                    <img src="./testLogo.png" alt="LOGO_INSIGHTSOLUTIONS" id="imgLogo" style="width: 100%;">
                </a>
            </div><br>

        </div>
        <button class="openbtn" id="openbtn" onclick="openNav()"> ☰ </button>
        <div class="ContainerMap">
            <div id="map"></div>
        </div>

        <button class="callResp btn-primary" id="callRes" onclick="call()">
            <i class="fa fa-phone"></i>
        </button>

        <button class="export btn-secondary" id="export">
            <i class="fa-solid fa-download"></i>
        </button>

        <button class="rje3" id="act" onclick="rje3()">
            <i class="fa fa-arrow-left"></i>
        </button>

        <button hidden class="rje3" id="act2" onclick="rje32()" style="font-weight: bold;">
            <i class="fa fa-arrow-left"></i>
        </button>
        <button hidden class="rje3" id="act3" onclick="rje33()" style="font-weight: bold;">
            <i class="fa fa-arrow-left"></i>
        </button>
        <img id="imgWait" src="https://media.giphy.com/media/xTk9ZvMnbIiIew7IpW/giphy.gif" alt="">
        <div id="exportContent">
            <div id="hs" hidden></div>
            <div id="tbl" hidden></div>
        </div>

        <script>
            function openNav() {
                document.getElementById("mySidepanel").style.width = "70%";
                document.getElementById("openbtn").style.display = "none";
            }

            function closeNav() {
                document.getElementById("mySidepanel").style.width = "0";
                document.getElementById("openbtn").style.display = "block";
            }

            function CircuitsLavage() { //lavage des voiries
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 12,
                    mapTypeId: 'terrain',
                    center: Tanger,
                    mapTypeControl: false,
                    disableDefaultUI: true,
                });
                // alert(C_ARTA3501.length);
                // alert(C_ARTA3502.length);
                // alert(C_ARTA3401.length);
                for (var tar = 0; tar < C_ARTA3501.length; tar++) {
                    C_ARTA3501[tar].setVisible(true);
                    C_ARTA3501[tar].setMap(map);
                }
                for (var tar = 20; tar < C_ARTA3502.length; tar++) {
                    C_ARTA3502[tar].setVisible(true);
                    C_ARTA3502[tar].setMap(map);
                }
                for (var tar = 0; tar < C_ARTA3401.length; tar++) {
                    C_ARTA3401[tar].setVisible(true);
                    C_ARTA3401[tar].setMap(map);
                }
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
                EXP = 'BalMec';
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 12,
                    mapTypeId: 'terrain',
                    center: Tanger,
                    mapTypeControl: false,
                    disableDefaultUI: true,
                });
                $('#act').animate({
                    'right': '200%'
                });

                $('#act2').attr('hidden', 'true');
                $('#act3').attr('hidden', 'true');
                closeNav();
                document.querySelector('.mo3ta6').classList.add('active');
                document.querySelector('.mo3ta1').classList.remove('active');
                document.querySelector('.mo3ta2').classList.remove('active');
                document.querySelector('.mo3ta3').classList.remove('active');
                document.querySelector('.mo3ta4').classList.remove('active');
                document.querySelector('.mo3ta5').classList.remove('active');
                // polygonLavMan.setVisible(false);
                // markerLavMan.setVisible(false);
                // markerLavMan0.setVisible(false);
                // markerClick1.setVisible(false);
                // /* Affich les circuit */
                // for (var tcp = 0; tcp < polylineMan.length; tcp++) {
                //     polylineMan[tcp].setVisible(false);
                //     // markerMan[tcp].setVisible(false);
                //     markers.push(markerMan[tcp]);

                // }
                /* Affiche  */
                for (var tcp = 0; tcp < polylineMec.length; tcp++) {
                    polylineMec[tcp].setVisible(true);
                    markerMec[tcp].setVisible(true);
                    polylineMec[tcp].setMap(map);
                    markerMec[tcp].setMap(map);

                }
            }

            function BalayageManuel() {
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 12,
                    mapTypeId: 'terrain',
                    center: Tanger,
                    mapTypeControl: false,
                    disableDefaultUI: true,
                });
                $('#imgWait').removeAttr('hidden');
                console.log('====================================');
                console.log("Debute");
                console.log('====================================');
                $.ajax({
                    url: 't2.php',
                    method: 'POST',
                    success: function(d) {
                        console.log('end');
                        d = d + "";
                        d.replace("\"", "");
                        document.body.innerHTML += '<script>' + d + ' <//script>';
                        $('#imgWait').attr('hidden', 'true');
                    }
                })
                color = '';
                // alert(TotaleMoyBalMan / polylineMan.length)
                if (TotaleMoyBalMan / polylineMan.length < 30) {
                    color = 'red';
                } else if (TotaleMoyBalMan / polylineMan.length >= 30 && TotaleMoyBalMan / polylineMan.length < 70) {
                    color = 'yellow';
                } else {
                    color = 'green';
                }
                polygonLavMan.setOptions({
                    fillOpacity: 0.8,
                    strokeColor: color,
                    fillColor: color,
                    strokeWeight: 3
                })
                // polygonLavMan.setVisible(true);
                // markerLavMan.setVisible(true);
                // markerLavMan0.setVisible(true);
                // markerLavMan1.setVisible(true);
                // polygonLavMan.setMap(map);
                // markerLavMan.setMap(map);
                // markerLavMan0.setMap(map);
                // markerLavMan1.setMap(map);
                // markerClick1.setVisible(true);
                // markerClick1.setMap(map);
                $('#act').animate({
                    'right': '200%'
                });
                $('#act3').removeAttr('hidden');

                $('#act3').animate({
                    'right': '5px'
                });

                $('#act2').attr('hidden', 'true');
                // $('#act3').attr('hidden', 'true');
                closeNav();
                document.querySelector('.mo3ta5').classList.add('active');
                document.querySelector('.mo3ta1').classList.remove('active');
                document.querySelector('.mo3ta2').classList.remove('active');
                document.querySelector('.mo3ta3').classList.remove('active');
                document.querySelector('.mo3ta4').classList.remove('active');
                document.querySelector('.mo3ta6').classList.remove('active');
            }

            function CircuitsCollecte() {
                // cauch = 'circuit';
                EXP = 'CircuitCo';
                $('#act2').attr('hidden', 'true');
                $('#act3').attr('hidden', 'true');
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 12,
                    mapTypeId: 'terrain',
                    center: Tanger,
                    mapTypeControl: false,
                    disableDefaultUI: true,
                });
                $("#imgWait").show();
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
                /*for (var sp = 0; sp < polyline.length; sp++) {
                    polyline[sp].setMap(map);
                    polyline[sp].setVisible(true);
                }
                $('#statitstics').hide(400);
                $('#charh').slideDown(700);
                closeNav();*/
            };

            function BacsCollecte() {
                EXP = 'BacsCo';
                $('#act2').attr('hidden', 'true');
                $('#act3').attr('hidden', 'true');
                $('#act').animate({
                    'right': '5px'
                });
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 12,
                    mapTypeId: 'terrain',
                    center: Tanger,
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
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 12,
                    mapTypeId: 'terrain',
                    center: Tanger,
                    mapTypeControl: false,
                    disableDefaultUI: true,
                });
                caucheL = 'ville';
                if (tauxLavageBacs < 50) {
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
                    // console.log('red bg');
                } else {
                    LavageMap.setOptions({
                        fillOpacity: 0.7,
                        fillColor: 'green',
                        strokeWeight: 3,
                        map: map
                    });
                    // console.log('green BG');
                }

                $('#act').animate({
                    'right': '200%'
                });
                $('#act2').removeAttr('hidden');
                markerLavage.setMap(map);
                markerLavage.setVisible(true);
                // markerClick.setVisible(false);
                markerClick0.setMap(map);
                markerClick0.setVisible(true);
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
                $("#act").fadeOut(700);
                $("#act2").fadeOut(700);
                $("#act3").fadeOut(700);
                $("#callRes").fadeOut(700);
                $('#export').fadeOut(700);
            }
            console.log('end file');
        </script>
        <div id="scripts"></div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="./js/tools0.js"></script>
        <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
        <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-dn4yi8nZ8f8lMfQZNZ8AmEEVT07DEcE&region=MA&signed_in=true&libraries=drawing&callback=initMap" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.2.3/jspdf.plugin.autotable.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/interactjs@1.10.17/dist/interact.min.js"></script>
        <script src="./js/voirie.js"></script>
        <script src="./js/balman.js"></script>
        <script src="./js/jquery-3.6.0.js"></script>
        <script src="./js/login.js"></script>
        <script src="./js/animationCarte.js"></script>
        <script src="./js/OutAct.js"></script>
        <script src="./js/load.js"></script>
        <script src="./js/export.js"></script>
        <script src="./js/functions.js"></script>
        <script src="./js/script.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!----------------------------------------------------------------------------------------------------------------->
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