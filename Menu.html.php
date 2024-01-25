<?php
// file_put_contents('./js/tools0.js', '');
// require './getPolygones2.php';
// require './exportData.php';
// require './LavVoi.php';
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js" integrity="sha256-+8RZJua0aEWg+QVVKg4LEzEEm/8RFez5Tb4JBNiV5xA=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0-rc.1/chartjs-plugin-datalabels.min.js" integrity="sha512-+UYTD5L/bU1sgAfWA0ELK5RlQ811q8wZIocqI7+K0Lhh8yVdIoAMEs96wJAIbgFvzynPm36ZCXtkydxu1cs27w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="./css/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
        var Balaye = 0;
        var totale = 0;
        let tt = new Map();
        var niv = '1';
    </script>
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

        #map,
        #tableMan {
            width: 100%;
            height: 92vh;
        }

        #tableMan {
            position: absolute;
            top: 0;
            right: 120%;
            padding-top: 10vh;

        }

        .callResp,
        .export,
        .rje3,
        .switch,
        .switch2,
        .switch3,
        .switch5,
        .switch4,
        .switch6,
        .switch7 {
            position: absolute;
            z-index: 1011;
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

        .rje3,
        .switch4 {
            bottom: 19vh;
        }

        #road {
            bottom: 19vh;
            color: #f1f1f1;
            background-color: blue;
        }

        .switch,
        .switch4 {
            bottom: 16vh;
        }

        #vueTabCoCo,
        #vueTabCiCo {
            bottom: 25vh;
        }

        #vueTabCirc {
            bottom: 17vh;
        }

        #vueTabVoi {
            bottom: 25vh;
        }

        #call,
        #myChart0 {
            width: 100%;
            height: 85vh;
            background-color: white;
            position: absolute;
            right: 100%;
            text-align: center;
        }

        #call {
            z-index: 10011;
            overflow-x: auto;
            overflow-y: auto;
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
    <style>
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
            /* vertical-align: middle; */
        }

        thead tr th {
            height: 30px;
            line-height: 30px;
            /*text-align: left;*/
        }

        table.scroll tbody {
            height: 70VH;
            width: 100%;
            overflow-y: auto;
            overflow-x: auto;
        }

        tbody {
            border-top: 2px solid black;
        }

        tbody td,
        thead th {
            width: 20%;
            /* Optional */
            border-right: 1px solid black;
        }

        tbody td:last-child,
        thead th:last-child {
            border-right: none;
        }

        #annulerCall {
            font-family: inherit;
            border-width: 1px;
            border-style: solid;
            padding-bottom: 2vh;
            padding-top: 2vh;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px !important;
            font-size: 0.875rem;
            transition: background-color 80ms ease-in-out 0s,
                border-color 80ms ease-in-out 0s,
                box-shadow 60ms ease-in-out 0s;
            background-color: var(--bg-color, #f3213d);
            border-color: var(--border-color, #ff000d77);
            color: var(--text-color, #FFFFFF);
            box-shadow: transparent 0px 0px 0px 2px;
            position: absolute !important;
            bottom: 0 !important;
            width: 97% !important;
            left: 1.5%;
            position: fixed !important;
            bottom: 0;
            display: none;
        }
    </style>
</head>

<body>
    <div id="toHideNB"></div>
    <div class="call" id="call">
        <div style="width: 100%;text-align: center;font-weight: bold;">Appelez un respensable</div>
        <div class="rowc" id="uls" style="width: 100%;overflow-y: auto;z-index: 101200;position: absolute !important;">
        <ul class="list-group list-group-horizontal" id="uls_ul"></ul>
            <!-- <div class="ContactContainer">
                <ul class="w3-ul w3-card-4" id="contacts">
                    <li class="w3-padding-hor-16"><span class="w3-closebtn w3-padding w3-margin-right w3-small"><a href="tel:+212622115470"><i class="fa fa-phone" style="font-size: 20pt;padding-top: 9pt;"></i></a></span><img src="./images/a.png" class="w3-left w3-margin-right" style="width:40px;height: 40px;"><span class="">Mike</span><br><span>Web Designer</span></li>
                </ul>
            </div> -->
        </div>
        <button id="annulerCall" class="myBtns0" onclick="
            $('#call').animate({
                'right': '120%'
            });$('#act').css({
                'z_index': 10001
            })
            $('#annulerCall').css({
                'display': 'none'
            });
            // $('#annulerCall').css({
            //     'right':'100%'
            // })
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
        ">annuler</button>
    </div>
    <!-- <div id="myChart0">
        <marquee>
            Taux de réalisation - balayage manuel
        </marquee>
        <button id="mns">
            <span class="fa fa-arrow-left"></span>
        </button>
        <button id="bt">
            <span id="txtbtn"></span><br>
            <img src="./images/hand.png" alt="" height="40" width="40">
        </button>
        <canvas id="myChart" style="display: none;"></canvas>
        <select name="sec" id="sect" class="form-select" onchange="changeChart()" style="display: none;position: relative;">
            <option value="NON">Secteur</option>
            <option value="BENI MAKADA">BENI MAKADA</option>
            <option value="MGHOGHA">MGHOGHA</option>
        </select>
        <canvas id="myChart1" style="display: none;"></canvas>
    </div> -->
    <div class="menu" id="menu">
        <div id="mySidepanel" class="sidepanel">
            <span class="closebtn" onclick="closeNav()">x</span>
            <button class="MainMenu active mo3ta1" onclick="BacsCollecte(); ">
                <!-- <img src="./bac_rouge.png" height="20" alt=""> -->
                Collecte par conteneurs
            </button>
            <button class="MainMenu mo3ta2" onclick="CircuitsCollecte(); ">Collecte par circuits</button>
            <button class="MainMenu mo3ta3" onclick="BacsLavage();">
                <!-- <img src="./bac_rouge.png" height="20" alt=""> -->
                Lavage par conteneurs
            </button>
            <button class="MainMenu mo3ta4" onclick="CircuitsLavage();">Lavage des voiries</button>
            <button class="MainMenu mo3ta5" id="bm">Balayage manuel</button>
            <button class="MainMenu mo3ta6" onclick="BalayageMecanique(); ">Balayage mécanique</button>
            <!-- <button class="MainMenu mo3ta6" onclick="motos();">Les motos d'interventien</button> -->

            <hr>
            <button id="showLegende" class="btn btn-success form-control">
                Afficher la légende <span class="fa fa-eye"></span>
            </button>
            <br>
            <button class="btn btn-danger form-control" id="logout" style="margin-top: 12pt;">
                Déconnexion <span class="fa fa-sign-out"></span>
            </button>
            <hr>
            <div class="logo" style="width: 100%;padding: 0;margin: 0;position: absolute;bottom: 0;">
                <a href="https://insightsolutions.ma/" target="_blanck" style="padding: 0;margin: 0;width: 100%;">
                    <img src="./testLogo.png" alt="LOGO_INSIGHTSOLUTIONS" id="imgLogo" style="width: 100%;">
                </a>
            </div><br>
        </div>
        <div id="combo" class="comp">
            <select name="shift" id="shift">
                <option value="ALL">Toute la journée</option>
                <option value="MAT">de 05h à 14h</option>
                <option value="SOI">de 14h à 20h</option>
            </select>
        </div>
        <button class="openbtn" id="openbtn" onclick="openNav()"> ☰ </button>
        <div class="ContainerMap">
            <div id="map"></div>
            <div id="tableMan">
                <input type="text" name="" id="search" class="form-control search">
            </div>
        </div>
        <button class="callResp btn-primary" id="callRes" onclick="call()">
            <i class="fa fa-phone"></i>
        </button>
        <button class="export btn-secondary" id="export" style="z-index: 1;">
            <i class="fa-solid fa-download"></i>
        </button>
        <button hidden class="switch table" id="switch" onclick="switchMode()" style="font-weight: bold;font-size: 20pt;">
            <i class="fa fa-table" id="modeI"></i>
        </button>
        <button class="switch2 table" id="vueTabCoCo" onclick="switchBacsCollecte()" style="font-weight: bold;font-size: 20pt;">
            <i class="fa fa-table" id="modeCB"></i>
        </button>
        <button hidden class="switch3 table" id="vueTabCiCo" onclick="switchCircuitCollecte()" style="font-weight: bold;font-size: 20pt;">
            <i class="fa fa-table" id="modeCC"></i>
        </button>
        <button hidden class="switch4 table" id="vueTabMec" onclick="switchMecanique()" style="font-weight: bold;font-size: 20pt;">
            <i class="fa fa-table" id="modeMe"></i>
        </button>
        <button hidden class="switch7 table" id="vueTabCirc" onclick="switchCirs()" style="font-weight: bold;font-size: 20pt;">
            <i class="fa fa-table" id="modeCi"></i>
        </button>
        <button hidden class="switch6 table" id="vueTabVoi" onclick="switchVoi()" style="font-weight: bold;font-size: 20pt;">
            <i class="fa fa-table" id="modeCV"></i>
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
        <button hidden class="rje3" id="road" style="font-weight: bold;">
            <i class="fa fa-map-marker"></i>
        </button>

        <div id="imgWait">
            <!-- <img src="https://i.gifer.com/ZZ5H.gif" alt=""> -->
            <img src="./images/Settings.gif" alt="" srcset="">
            <p id="txtWait">
                Calculs en cours, veuillez patienter ...
            </p>
            <!-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin:auto;background:#fff;display:block;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">…</svg> -->
        </div>
        <div id="exportContent">
            <div id="hs" hidden></div>
            <div id="tbl" hidden></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/mecanique.js"></script>
    <script src="./js/manual.js"></script>
    <script src="./js/circuitCollecte.js"></script>
    <script src="./js/bacs.js"></script>
    <script src="./js/lavageVoirie.js"></script>
    <script src="./js/polygones.js"></script>

    <script>
        function createCookie(name, value, days) {
            var expires;

            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toGMTString();
            } else {
                expires = "";
            }
            document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
        }
        function eraseCookie(name) {
            createCookie(name, "", -1);
        }
        document.querySelector('#logout').addEventListener('click', (e) => {
            // eraseCookie('iduserST');
            // eraseCookie('CKC_User_Ins_AR_T');
            // eraseCookie('CKC_Pass_Ins_Ar_T');
            // console.warn(readCookie('CKC_User_Ins_AR_T'), ' ', readCookie('iduserST'));
            
            document.location.assign('logout.php');
        })
        document.querySelector('#toHideNB').addEventListener('click', function() {
            closeNav()
        })
        document.querySelector('#showLegende').addEventListener('click', function() {
            Swal.fire({
                html: '<div class="legend" style="text-align: left">' +
                    '<fieldset><legend>Les coleurs des circuits</legend><table><tr style="width:30%; background:red; font-weight:bold; color: black;text-align:center"><td>&lt;30</td><td style="width:40%; background: yellow; font-weight:bold; color: black;text-align:center">&ge;30 & &lt;70</td><td style="width:30%; background: green; font-weight:bold; color: black;text-align:center">&ge;70</td></tr></table></fieldset>' +
                    '<fieldset>' +
                    '<legend>Etat de Lavage/collecte</legend>' +
                    '<div><img src="./bacmetal_vert.png" alt="" srcset=""> : <span>Bac collecté (24h) </span></div>' +
                    '<div><img src="./bacmetal_rouge.png" alt="" srcset=""> : <span>Bac non collecté (24h) </span></div>' +
                    '<div><img src="./bac_vert.png" alt="" srcset=""> : <span>Collone collectée (24h) </span></div>' +
                    '<div><img src="./bac_rouge.png" alt="" srcset=""> : <span>Collone non collectée (24h) </span></div>' +
                    '<div><img src="./bac_bleu.png" alt="" srcset=""> : <span>Collone Lavée (7J) </span></div>' +
                    '<div><img src="./bacmetal_bleu.png" alt="" srcset=""> : <span>Bac Lavé (7J) </span></div>' +
                    '</fieldset>' +
                    '</div>',
            })
            closeNav();
        })
        var l30 = 0;
        var b30and70 = 0;
        var g70 = 0;

        function changeChart() {
            var sec = document.getElementById('sect').value;
            if (sec == 'NON') {
                document.querySelector('#myChart').style.display = 'block';
                document.querySelector('#myChart1').style.display = 'none';
            } else {
                $('#imgWait').fadeIn(200);
                $.ajax({
                    url: 'getCirc.php',
                    type: 'POST',
                    data: {
                        sec: sec
                    },
                    success: function(d) {
                        var t = d.split(';');
                        l30 = 0;
                        b30and70 = 0;
                        g70 = 0;
                        for (let i = 0; i < t.length - 1; i++) {
                            var t1 = t[i].split(',');
                            if (t1[1] < 30)
                                l30++;
                            else if (t1[1] >= 30 && t1[1] < 70)
                                b30and70++;
                            else
                                g70++;
                        }
                        // console.log("traitement termine");
                        setTimeout(function() {
                            myChart0.data.datasets[0].data = [l30, b30and70, g70];
                            myChart0.update()
                            document.querySelector('#myChart1').style.display = 'block';
                            document.querySelector('#myChart').style.display = 'none';
                            $('#imgWait').fadeOut(120)
                        }, 1000);
                    }
                })
            }

        }
        document.querySelector('#bt').addEventListener('click', function() {
            // document.querySelector('#bt').style.display = 'none';
            $('#imgWait').fadeIn(300);
            $.ajax({
                url: 'getavg.php',
                method: 'POST',
                success: function(d) {
                    // console.log(d);
                    var t = d.split(';');
                    // myChart.destroy();
                    if (myChart != null) {
                        myChart.destroy();
                    }
                    for (let i = 0; i < t.length - 1; i++) {
                        var t1 = t[i].split(',');
                        tt.set(t1[0], t1[1])

                        myChart0.data.datasets[0].data[i] = t1[1];
                        myChart0.update()
                    }
                    // console.log(t[0]);
                    setTimeout(function() {
                        $('#bt').slideUp(500);
                        $('#mns').slideDown(500);
                        $('#sect').slideDown(500);
                        document.querySelector('#myChart').style.display = 'block';
                        hi();
                        $('#imgWait').fadeOut(300);
                    }, 500);
                }
            })
        })
        document.querySelector('#mns').addEventListener('click', function() {
            // if (niv == '1') {
            document.querySelector('#myChart1').style.display = 'none';
            document.querySelector('#myChart').style.display = 'none';
            document.querySelector('#sect').style.display = 'none';
            document.querySelector('#mns').style.display = 'none';
            document.querySelector('#myChart').innerHTML = '';
            document.querySelector('#bt').style.display = 'block';
            //     niv = '0';
            // } else if (niv == '2') {
            // document.querySelector('#myChart1').style.display = 'none';
            // document.querySelector('#myChart').style.display = 'block';

            //     niv='1';
            // }
        });
    </script>
    <script>
        function switchMode() {
            var cl = document.querySelector('#switch').classList[1]
            console.log(cl);
            if (cl == 'map') {
                document.querySelector('#switch').classList.remove('map');
                document.querySelector('#switch').classList.add('table');
                document.querySelector('#modeI').classList = ""
                document.querySelector('#modeI').classList.add('fa')
                document.querySelector('#modeI').classList.add('fa-table')
                console.log('====================================');
                console.log("daba ghanmchiw l map");
                console.log('====================================');
                $('#map').css({
                    'right': '0'
                });
                $('#tableMan').css({
                    'right': '120%'
                });
                document.querySelector('.switch').style.bottom = '16vh'
            } else if (cl == 'table') {
                document.querySelector('.switch').style.bottom = '19vh'
                document.querySelector('#switch').classList.remove('table');
                document.querySelector('#switch').classList.add('map');
                document.querySelector('#modeI').classList = ""
                document.querySelector('#modeI').classList.add('fa')
                document.querySelector('#modeI').classList.add('fa-map')
                console.log('====================================');
                console.log("daba ghanmchiw l table");
                console.log('====================================');
                $('#map').css({
                    'right': '120%'
                });
                $('#tableMan').css({
                    'right': '0'
                });
                $('#tableMan').children().remove().end();
                var inp = $('<input type="text" name="" id="search" class="form-control search" placeholder="Recherche par circuit" onkeyup="searchCirc()">')
                $('#tableMan').append(inp);
                var t = $('<table class=\"scroll table\" id="tblman"></table>')
                var th = $('<thead><tr><th>N°</th><th>Circuit</th><th>Vehicule</th><th>Taux (%)</th></tr></thead>');
                var tb = $('<tbody></tbody>');
                t.append(th);
                var l = 1;
                for (let [k, v] of PolylineMAN) {

                    var tr = $('<tr></tr>')
                    // for (let j = 0; j < ligne.length - 1; j++) {
                    var td1 = $('<td>' + l++ + '</td>');
                    var td2 = $('<td>' + k + '</td>');
                    var td3 = $('<td>' + v[1] + '</td>');
                    var td4 = $('<td>' + v[0] + '</td>');
                    tr.append(td1);
                    tr.append(td2);
                    tr.append(td3);
                    tr.append(td4);
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
        }

        function switchBacsCollecte() {
            var cl = document.querySelector('#vueTabCoCo').classList[1]
            console.log(cl);
            if (cl == 'map') {
                document.querySelector('#vueTabCoCo').classList.remove('map');
                document.querySelector('#vueTabCoCo').classList.add('table');
                document.querySelector('#modeCB').classList = ""
                document.querySelector('#modeCB').classList.add('fa')
                document.querySelector('#modeCB').classList.add('fa-table')
                console.log('====================================');
                console.log("daba ghanmchiw l map");
                console.log('====================================');
                $('#map').css({
                    'right': '0'
                });
                $('#tableMan').css({
                    'right': '120%'
                });
                document.querySelector('.switch2').style.bottom = '17vh'
            } else if (cl == 'table') {
                document.querySelector('.switch2').style.bottom = '19vh'
                document.querySelector('#vueTabCoCo').classList.remove('table');
                document.querySelector('#vueTabCoCo').classList.add('map');
                document.querySelector('#modeCB').classList = ""
                document.querySelector('#modeCB').classList.add('fa')
                document.querySelector('#modeCB').classList.add('fa-map')
                console.log('====================================');
                console.log("daba ghanmchiw l table");
                console.log('====================================');
                $('#map').css({
                    'right': '120%'
                });
                $('#tableMan').css({
                    'right': '0'
                });
                $('#tableMan').children().remove().end();
                var inp = $('<input type="text" name="" id="searchBC" class="form-control search" placeholder="Recherche par N° park" onkeyup="searchBacsCo()">')
                $('#tableMan').append(inp);
                var t = $('<table class=\"scroll table\" id="tblCB"></table>')
                var th = $('<thead><tr><th>N° park</th><th>Type</th><th>Date</th></thead>');
                var tb = $('<tbody></tbody>');


                t.append(th);
                var l = 1;
                for (let b = 0; b < bacs.length; b++) {

                    var tr = $('<tr></tr>')
                    // for (let j = 0; j < ligne.length - 1; j++) {
                    var td1 = $('<td>' + bacs[b][5] + '</td>');
                    var td2 = $('<td>' + bacs[b][4] + '</td>');
                    var td3 = $('<td>' + bacs[b][6] + '</td>');
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
        }

        function switchCircuitCollecte() {
            var cl = document.querySelector('#vueTabCiCo').classList[1]
            console.log(cl);
            if (cl == 'map') {
                document.querySelector('#vueTabCiCo').classList.remove('map');
                document.querySelector('#vueTabCiCo').classList.add('table');
                document.querySelector('#modeCC').classList = ""
                document.querySelector('#modeCC').classList.add('fa')
                document.querySelector('#modeCC').classList.add('fa-table')
                console.log('====================================');
                console.log("daba ghanmchiw l map");
                console.log('====================================');
                $('#map').css({
                    'right': '0'
                });
                $('#tableMan').css({
                    'right': '120%'
                });
                document.querySelector('.switch3').style.bottom = '17vh'
            } else if (cl == 'table') {
                document.querySelector('.switch3').style.bottom = '19vh'
                document.querySelector('#vueTabCiCo').classList.remove('table');
                document.querySelector('#vueTabCiCo').classList.add('map');
                document.querySelector('#modeCC').classList = ""
                document.querySelector('#modeCC').classList.add('fa')
                document.querySelector('#modeCC').classList.add('fa-map')
                console.log('====================================');
                console.log("daba ghanmchiw l table");
                console.log('====================================');
                $('#map').css({
                    'right': '120%'
                });
                $('#tableMan').css({
                    'right': '0'
                });
                $('#tableMan').children().remove().end();
                var inp = $('<input type="text" name="" id="searchCC" class="form-control search" placeholder="Recherche par N° park" onkeyup="searchCircCo()">')
                $('#tableMan').append(inp);
                var t = $('<table class=\"scroll table\" id="tblCC"></table>')
                var th = $('<thead><tr><th>N° park</th><th>Type</th><th>Vehicule</th><th>Date</th></thead>');
                var tb = $('<tbody></tbody>');
                t.append(th);
                var l = 1;
                for (let b = 0; b < bacsLaver.length; b++) {
                    var tr = $('<tr></tr>')
                    // for (let j = 0; j < ligne.length - 1; j++) {
                    var td1 = $('<td style="width:25%">' + bacsLaver[b][3] + '</td>');
                    var td2 = $('<td style="width:25%">' + bacsLaver[b][2] + '</td>');
                    var td3 = $('<td style="width:25%">' + bacsLaver[b][4] + '</td>');
                    var td4 = $('<td style="width:25%">' + bacsLaver[b][5] + '</td>');
                    tr.append(td1);
                    tr.append(td2);
                    tr.append(td3);
                    tr.append(td4);
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
        }

        function switchMecanique() {
            var cl = document.querySelector('#vueTabMec').classList[1]
            console.log(cl);
            if (cl == 'map') {
                document.querySelector('#vueTabMec').classList.remove('map');
                document.querySelector('#vueTabMec').classList.add('table');
                document.querySelector('#modeMe').classList = ""
                document.querySelector('#modeMe').classList.add('fa')
                document.querySelector('#modeMe').classList.add('fa-table')
                console.log('====================================');
                console.log("daba ghanmchiw l map");
                console.log('====================================');
                $('#map').css({
                    'right': '0'
                });
                $('#tableMan').css({
                    'right': '120%'
                });
                document.querySelector('.switch4').style.bottom = '16vh'
            } else if (cl == 'table') {
                document.querySelector('.switch4').style.bottom = '18vh'
                document.querySelector('#vueTabMec').classList.remove('table');
                document.querySelector('#vueTabMec').classList.add('map');
                document.querySelector('#modeMe').classList = ""
                document.querySelector('#modeMe').classList.add('fa')
                document.querySelector('#modeMe').classList.add('fa-map')
                console.log('====================================');
                console.log("daba ghanmchiw l table");
                console.log('====================================');
                $('#map').css({
                    'right': '120%'
                });
                $('#tableMan').css({
                    'right': '0'
                });
                $('#tableMan').children().remove().end();
                var inp = $('<input type="text" name="" id="searchCC" class="form-control search" placeholder="Recherche par N° Circuit" onkeyup="searchCircCo()">')
                $('#tableMan').append(inp);
                var t = $('<table class=\"scroll table\" id="tblCC"></table>')
                var th = $('<thead><tr><th>N°</th><th>Circuit</th><th>Vehicule</th><th>Taux</th></thead>');
                var tb = $('<tbody></tbody>');
                t.append(th);
                var l = 1;
                mecMap = new Map(mecR)
                for (let [k, v] of mecMap) {
                    var tr = $('<tr></tr>')
                    // for (let j = 0; j < ligne.length - 1; j++) {
                    var td1 = $('<td style="width:25%">' + (l++) + '</td>');
                    var td2 = $('<td style="width:25%">' + k + '</td>');
                    var td3 = $('<td style="width:25%">' + v[0] + '</td>');
                    var td4 = $('<td style="width:25%">' + v[1] + '</td>');
                    tr.append(td1);
                    tr.append(td2);
                    tr.append(td3);
                    tr.append(td4);
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
        }

        function switchCirs() {
            var cl = document.querySelector('#vueTabCirc').classList[1]
            console.log(cl);
            if (cl == 'map') {
                document.querySelector('#vueTabCirc').classList.remove('map');
                document.querySelector('#vueTabCirc').classList.add('table');
                document.querySelector('#modeCi').classList = ""
                document.querySelector('#modeCi').classList.add('fa')
                document.querySelector('#modeCi').classList.add('fa-table')
                console.log('====================================');
                console.log("daba ghanmchiw l map");
                console.log('====================================');
                $('#map').css({
                    'right': '0'
                });
                $('#tableMan').css({
                    'right': '120%'
                });
                document.querySelector('.switch7').style.bottom = '16vh'
            } else if (cl == 'table') {
                document.querySelector('.switch7').style.bottom = '18vh'
                document.querySelector('#vueTabCirc').classList.remove('table');
                document.querySelector('#vueTabCirc').classList.add('map');
                document.querySelector('#modeCi').classList = ""
                document.querySelector('#modeCi').classList.add('fa')
                document.querySelector('#modeCi').classList.add('fa-map')
                console.log('====================================');
                console.log("daba ghanmchiw l table");
                console.log('====================================');
                $('#map').css({
                    'right': '120%'
                });
                $('#tableMan').css({
                    'right': '0'
                });
                $('#tableMan').children().remove().end();
                var inp = $('<input type="text" name="" id="searchCi" class="form-control search" placeholder="Recherche par N° Circuit" onkeyup="searchCirs()">')
                $('#tableMan').append(inp);
                var t = $('<table class=\"scroll table\" id="tblCi"></table>')
                var th = $('<thead><tr><th>N°</th><th>Circuit</th><th>Vehicule</th><th>Taux</th></thead>');
                var tb = $('<tbody></tbody>');
                t.append(th);
                var l = 1;
                for (let [k, v] of polylineMap) {
                    var tr = $('<tr></tr>')
                    // for (let j = 0; j < ligne.length - 1; j++) {
                    var td1 = $('<td style="width:25%">' + (l++) + '</td>');
                    var td2 = $('<td style="width:25%">' + k + '</td>');
                    var td3 = $('<td style="width:25%">' + v[0] + '</td>');
                    var td4 = $('<td style="width:25%">' + v[1] + '</td>');
                    tr.append(td1);
                    tr.append(td2);
                    tr.append(td3);
                    tr.append(td4);
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
        }

        function switchVoi() {
            var cl = document.querySelector('#vueTabVoi').classList[1]
            console.log(cl);
            if (cl == 'map') {
                document.querySelector('#vueTabVoi').classList.remove('map');
                document.querySelector('#vueTabVoi').classList.add('table');
                document.querySelector('#modeCV').classList = ""
                document.querySelector('#modeCV').classList.add('fa')
                document.querySelector('#modeCV').classList.add('fa-table')
                console.log('====================================');
                console.log("daba ghanmchiw l map");
                console.log('====================================');
                $('#map').css({
                    'right': '0'
                });
                $('#tableMan').css({
                    'right': '120%'
                })
                document.querySelector('.switch6 ').style.bottom = '26vh'
            } else if (cl == 'table') {
                document.querySelector('.switch6 ').style.bottom = '28vh'
                document.querySelector('#vueTabVoi').classList.remove('table');
                document.querySelector('#vueTabVoi').classList.add('map');
                document.querySelector('#modeCV').classList = ""
                document.querySelector('#modeCV').classList.add('fa')
                document.querySelector('#modeCV').classList.add('fa-map')
                console.log('====================================');
                console.log("daba ghanmchiw l table");
                console.log('====================================');
                $('#map').css({
                    'right': '120%'
                });
                $('#tableMan').css({
                    'right': '0'
                });
                $('#tableMan').children().remove().end();
                var inp = $('<input type="text" name="" id="searchCi" class="form-control search" placeholder="Recherche par N° Circuit" onkeyup="searchCirs()">')
                $('#tableMan').append(inp);
                var t = $('<table class=\"scroll table\" id="tblCi"></table>')
                var th = $('<thead><tr><th>N°</th><th>Circuit</th><th>Vehicule</th><th>Taux</th></thead>');
                var tb = $('<tbody></tbody>');
                t.append(th);
                var l = 1;
                for (let [k, v] of LVoi) {
                    var tr = $('<tr></tr>')
                    // for (let j = 0; j < ligne.length - 1; j++) {
                    var td1 = $('<td style="width:25%">' + (l++) + '</td>');
                    var td2 = $('<td style="width:25%">' + k + '</td>');
                    var td3 = $('<td style="width:25%">' + v[0] + '</td>');
                    var td4 = $('<td style="width:25%">' + v[1] + '</td>');
                    tr.append(td1);
                    tr.append(td2);
                    tr.append(td3);
                    tr.append(td4);
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
        }

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

        function searchBacsCo() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchBC");
            filter = input.value.toUpperCase();
            table = document.getElementById("tblCB");
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

        function searchCircCo() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchCC");
            filter = input.value.toUpperCase();
            table = document.getElementById("tblCC");
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

        function searchCirc() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("tblman");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
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

        function searchCirs() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchCi");
            filter = input.value.toUpperCase();
            table = document.getElementById("tblCi");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
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

        function call() {
            $('#call').animate({
                'right': '0%'
            });
            $('#annulerCall').css({
                'display': 'block'
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
    <script src="./js/voiries0.js"></script>
    <script src="./js/listVoi.js"></script>
    <!-- <script src="./js/fs.js"></script> -->
    <script type="text/javascript">
        $.ajax({
            url: './nums.php',
            method: 'get',
            data: {
                uid: readCookie('iduserST')
            },
            success: function(d) {
                console.log(d);
                var lignes = d.split('*');
                for (let i = 0; i < lignes.length - 1; i++) {
                    const resp = lignes[i].split(',');
                    console.log('resp : ' + resp)
                    if (resp[4] == '0') {
                        dirNums.push(resp);
                    } else {
                        CENums.push(resp);
                    }
                }
                addDirNums()
                addCENumber();
            },
            error: (err) => {
                console.log('====================================');
                console.log(err);
                console.log('====================================');
            }
        })
        // addEventListener('beforeunload',
        //     onbeforeunload
        // );
        onbeforeunload = (event) => {
            return confirm('ok')
        };
        removeEventListener('beforeunload', onbeforeunload)
        document.querySelector('*').addEventListener('click', () => {
            if (readCookie('iduserST') == null) {
                window.onbeforeunload = function() {
                    console.log("do something");
                }
                location.reload(true)
            } else {

            }
        })
    </script>
    <script>
        let PathP = [];
        var ps = null;
        $(document).ready(function() {
            $('#imgWait').show();
            //BacsCollecte();

            // $.ajax({
            //     url: './pltng.php',
            //     type: 'GET',
            //     data: {
            //         userid: readCookie('iduserST')
            //     },
            //     success: function(d) {
            //         d = d.replace('POLYGON((', '');
            //         d = d.replace('))', '');
            //         // console.log('====================================');
            //         // console.log(d);
            //         // console.log('====================================');
            //         PathP = [];
            //         var t = d.split('*');
            //         var tt = t[0].split(',');
            //         for (let i = 0; i < tt.length - 1; i++) {
            //             PathP.push({
            //                 lat: Number(tt[i].split(' ')[1]),
            //                 lng: Number(tt[i].split(' ')[0])
            //             })
            //             // console.log('====================================');
            //             // console.log(PathP[i]);
            //             // console.log('====================================');
            //         }
            //         var color = '#ef3352'
            //         let c = {
            //             lat: Number(t[2]),
            //             lng: Number(t[1])
            //         }
            //         ps = {
            //             lat: Number(t[1]),
            //             lng: Number(t[2])
            //         }
            //         //// console.log(c);
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
            //             center: new google.maps.LatLng(Number(t[1]), Number(t[2])),
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
            //             //alert(this.title);
            //             polygonTanger.setVisible(false);
            //             showPolygones();
            //             polygonTanger.setVisible(false);
            //             markerClick.setVisible(false);
            //             markerTanger.setVisible(false);
            //             markerTanger0.setVisible(false);
            //             cauche = 'zones';
            //         })
            //         // polygonTanger.addEventListener('click', function(event) {
            //         //     alert("get Polygones")
            //         // });
            //         // // console.log('==================  ==================');

            //         markerTanger = new google.maps.Marker({
            //             position: ps,
            //             map: map,
            //             label: {
            //                 text: '****',
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
            //                 userid: readCookie('iduserST')
            //             },
            //             success: function(d) {
            //                 var p = d.split(';');
            //                 pourcentages = [];
            //                 for (let i = 0; i < p.length - 1; i++) {
            //                     var t1 = p[i].split(',');
            //                     pourcentages.push([t1[0], Number((t1[2] / t1[3] * 100).toFixed(2)), t1[2], t1[3]]);
            //                     markersT.push(new google.maps.Marker({
            //                         position: {
            //                             lat: t1[4].split(' ')[0],
            //                             lng: t1[4].split(' ')[1]
            //                         },
            //                         map: map,
            //                         label: {
            //                             text: '' + pourcentages[i][1] + " %",
            //                             title: '0',
            //                             fontSize: '24px',
            //                             fontWeight: 'bold'
            //                         },
            //                         labelAnchor: new google.maps.Point(3, 30),
            //                         labelInBackground: false,
            //                         icon: 'None'
            //                     }))
            //                 }
            //                 for (let i = 0; i < markersT.length; i++) {
            //                     console.log('====================================');
            //                     //console.log("p : " + pourcentages[i][1]);
            //                     console.log('====================================');
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
            //                     method: 'GET',
            //                     data: {
            //                         uid: readCookie('iduserST')
            //                     },
            //                     success: function(d) {
            //                         console.log("total : " + d);
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
            //                     }
            //                 })
            //                 $.ajax({
            //                     url: './bcs.php',
            //                     data: {
            //                         userid: readCookie('iduserST')
            //                     },
            //                     success: function(d) {
            //                         // // console.log('=============== BACS =====================');
            //                         // // console.log(d);
            //                         // // console.log('====================================');
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
            //                         // console.log('====================================');
            //                         // console.log(bacs.length);
            //                         // console.log('====================================');
            //                         $('#imgWait').fadeOut(500);
            //                     }
            //                 })
            //             }
            //         })
            //         $.ajax({
            //             url: 'w.php',
            //             method: 'GET',
            //             data: {
            //                 user: readCookie('iduserST')
            //             },
            //             success: (d) => {
            //                 var annexes = d.split('*');
            //                 console.log('====================================');
            //                 console.log(d);
            //                 console.log('====================================');
            //                 for (var i = 0; i < annexes.length - 1; i++) {
            //                     pourcentageMap.set(annexes[i], [0, 0, 0, 0]);
            //                     // console.log('====================================');
            //                     // console.log(annexe);
            //                     // console.log('====================================');
            //                 }
            //             }
            //         })
            //     }
            // })

            BacsCollecte();

            $.ajax({
                url: './nums.php',
                method: 'get',
                data: {
                    uid: readCookie('iduserST')
                },
                success: function(d) {
                    console.log(d);
                    var lignes = d.split('*');
                    for (let i = 0; i < lignes.length - 1; i++) {
                        const resp = lignes[i].split(',');
                        console.log('resp : ' + resp)
                        if (resp[4] == '0') {
                            dirNums.push(resp);
                        } else {
                            CENums.push(resp);
                        }
                    }
                    addDirNums()
                    addCENumber();
                },
                error: (err) => {
                    console.log('====================================');
                    console.log(err);
                    console.log('====================================');
                }
            })
            // function addListenerToMarker(marker, date, type, numpark) {
            //     var infowindow = new google.maps.InfoWindow({
            //         content: "Type : " + type + "<br>Date : " + date +
            //             "<br>N° park : " + numpark
            //     });
            //     google.maps.event.addListener(marker, 'click', function() {
            //         infowindow.open(map, marker);
            //     });
            // }

            for (let i = 0; i < bacs.length; i++) {
                addListenerToMarker(bacs[i][0], bacs[i][6], bacs[i][4], bacs[i][5]);
            }
            $.ajax({
                url: './nums.php',
                method: 'get',
                data: {
                    uid: readCookie('iduserST')
                },
                success: function(d) {
                    console.log(d);
                    var lignes = d.split('*');
                    for (let i = 0; i < lignes.length - 1; i++) {
                        const resp = lignes[i].split(',');
                        console.log(resp)
                        if (resp[4] == '0') {
                            dirNums.push(resp);
                        } else {
                            CENums.push(resp);
                        }
                    }
                    addDirNums()
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

            // markerClick.addListener('click', () => {
            //     //alert(this.title);
            //     polygonTanger.setVisible(false);
            //     showPolygones();
            //     markerClick.setVisible(false);
            //     markerTanger.setVisible(false);
            //     markerTanger0.setVisible(false);
            //     cauche = 'zones';
            // })
            // markerTanger0.addListener('click', () => {
            //     //alert(this.title);
            //     polygonTanger.setVisible(false);
            //     showPolygones();
            //     markerClick.setVisible(false);
            //     markerTanger.setVisible(false);
            //     markerTanger0.setVisible(false);
            //     cauche = 'zones';
            // })
            // markerTanger.addListener('click', () => {
            //     //alert(this.title);
            //     polygonTanger.setVisible(false);
            //     showPolygones();
            //     markerClick.setVisible(false);
            //     markerTanger.setVisible(false);
            //     markerTanger0.setVisible(false);
            //     cauche = 'zones';
            // })

        })
        var pourcentageMap = new Map();
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!------------------------------------------------- do not remove this part ---------------------------------------------------------------->
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