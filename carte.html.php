<?php
require './getPolygones.php';
require './exportData.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanger board table</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="./css/maps.css" />
    <link rel="stylesheet" type="text/css" href="./css/call-btn.css" />
    <link rel="stylesheet" type="text/css" href="./css/divCall.css" />
    <link rel="stylesheet" type="text/css" href="./css/btns.css" />
    <link rel="stylesheet" type="text/css" href="./css/header.css" />
    <script src="./js/functions.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
    <link rel="SHORTCUT ICON" href="./favicon.ico">
    <link rel="stylesheet" href="./css/fontawesome-free-6.1.2-web/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- /******************************/ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.2.3/jspdf.plugin.autotable.min.js"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="./css/style.css">
    <style>
        .sidepanel {
            width: 0;
            position: fixed;
            z-index: 1021245412154;
            height: 100vh;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidepanel a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidepanel a:hover {
            color: #f1f1f1;
        }

        .sidepanel .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 70px;
            text-align: left;
        }

        .openbtn {
            font-size: 29px;
            cursor: pointer;
            background-color: #111;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            width: auto;
            position: absolute;
            z-index: 1234567898562;
        }

        .openbtn:hover {
            background-color: #444;
        }
    </style>
</head>

<body>
    <div id="mySidepanel" class="sidepanel">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <br><br>
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Clients</a>
        <a href="#">Contact</a>
    </div>

    <button class="openbtn" onclick="openNav()">☰ </button>
    <div class="parentDC callHide" id="parentDC">
        <div class="containerc" id="cd0">
            <div class="wrapperc">
                <div class="titlec"><span>Call </span></div>
                <form id="FormLogin">
                    <div class="rowc" id="uls" style="width: 100%;"></div>
            </div>
            </form>
            <br>
        </div>
        <div style="text-align: center;">
            <button class="btn btn-danger form-control" style=" outline: none;padding: 10px;  " id="CloseCall">
                Annuler
            </button>
        </div>
    </div>
    <div class="container">
        <div class="wrapper">


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
            <div id="charh" hidden style="position: relative;top:82px; z-index: 12101120;">
                <div class="container">
                    <div class="row">
                        <div class="col n1">
                            0% &lt; TAUX &lt; 30%
                        </div>
                        <div class="col n2">
                            30% &le; Taux &lt; 70%
                        </div>
                        <div class="col n3">
                            Taux &ge; 70%
                        </div>
                    </div>
                </div>
            </div>
            <div id="statitstics" hidden style="position: absolute;z-index: 12101122;top:25vh; background: white;width:100% !important;border-top: 1px solid lightslategrey;text-align: center;">
                <!-- <canvas id="myChart" class="circleCanvas"></canvas> -->
                <div id="chartes" style="width: 100%;">
                    <div id="chartes1" class="chartes1" style="width: 100%;">
                        <div id="ContTable" style="width: 100%;">
                            <table id="sts" style="width: 100%;">
                                <tr>
                                    <td rowpan="2" colspan="2" style="text-align: center;">Bacs</td>
                                    <td rowpan="2" colspan="2" style="text-align: center;">Colonne</td>
                                    <td>Taux</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d" id="spn4">0</div>
                                    </td>
                                    <td>
                                        <div class="d" id="spn2">0</div>
                                    </td>
                                    <td>
                                        <div class="d" id="spn7">0</div>
                                    </td>
                                    <td>
                                        <div class="d" id="spn6">0</div>
                                    </td>
                                    <td>
                                        <div class="d" id="spn5">0</div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 
                <div class="container">
        <div class="wrapper">
            <div id="btns" style="position: absolute;z-index : 1001; width: 100%">
                <table style="width: 100% !important; background: white;">
                    <tr style="width: 100% !important">
                        <td style="width: 33% !important; text-align: left; padding: 17px;font-size: 19pt;">
                            <button class="btn" id="act">
                                <i class="fa fa-arrow-left" aria-hidden="true" style="font-size:30pt;height: 100%;width:100%;color : black;"></i>
                            </button>
                        </td>
                        <td style="width: 33% !important; text-align: center; padding: 17px;font-size: 19pt;">
                            <button class="btn" id="reload">
                                <i class="fa fa-refresh" aria-hidden="true" style="font-size:30pt;height: 100%;width:100%;color : black; "></i>
                            </button>
                        </td>
                        <td style="width: 33% !important; text-align: right; padding: 17px;font-size: 19pt;">
                            <button class="btn" id="out">
                                <i class="fa fa-sign-out" aria-hidden="true" style="font-size:30pt;height: 100%;width:100%;color : black; "></i>
                            </button>
                        </td>

                    </tr>
                </table>
            </div>

             -->
            <div id="main" style="height:100vh !important ;">
                <div id="map"></div>
                <div id="right_panel" style="position: absolute;bottom: 0;">
                    <div class="resizable">
                        <span id="dragSign" style=" height: 1vh;width: 01.075cm;background-color: black;
                                                    border-radius: 12px; padding: 1px 2pc; position: absolute;
                                                    margin-top: -2vh;left: 42%;z-index: 9999999999999;">
                            &nbsp;&nbsp;
                        </span>
                        <div id="titleDrag" style="width: 100%; display: inline;">
                            <span>
                                <button id="seeMore">
                                    <i class="fa-solid fa-angle-up"></i>
                                </button>
                                <button id="seeLess" hidden>
                                    <i class="fa-solid fa-angle-down"></i>
                                </button>
                            </span>
                            <span id="dtsm" style="text-align: center;position: absolute ;right: 40%;">
                                Drag to see more
                            </span>
                        </div>


                        <div class="btn-group" style="width: 100% !important;">
                            <div class="btn-group" role="group" aria-label="Basic example" style="width: 100%;">
                                <button class="btn btn-primary" id="showCall">
                                    <i class="fa fa-phone"></i>
                                    <span>
                                        Appelez le respensable
                                    </span>
                                </button>
                                <button class="btn btn-success" id="export">
                                    <span>
                                        Exportez le resultat
                                    </span>
                                    <i class="fa fa-file-export"></i>
                                </button>
                            </div>
                            <br>
                        </div>
                        <br>
                        <div class="btn-group" style="width: 100% !important;margin-top: 3vh;">
                            <div class="btn-group" role="group" aria-label="Basic example" style="width: 100%;">
                                <button type="button" id="circuit" class="btn btn-primary">Voir les Circuits</button>
                                <button type="button" id="Hcircuit" class="btn btn-primary" hidden>Voir les Circuits</button>
                                <button type="button" class="btn btn-secondary">Middle</button>
                                <button type="button" class="btn btn-warning">Right</button>
                            </div>
                        </div>
                        <div class="btn-group" style="width: 100% !important;margin-top: 3vh;">
                            <div class="btn-group" role="group" aria-label="Basic example" style="width: 100%;">
                                <button class="btn" id="act" onclick="rje3()">
                                    <i class="fa fa-arrow-left" aria-hidden="true" style="font-size:30pt;height: 100%;width:100%;color : black;"></i>
                                </button> <button type="button" id="Hcircuit" class="btn btn-primary" hidden>Voir les Circuits</button>
                                <button class="btn" id="reload" onclick="location.reload(true)">
                                    <i class="fa fa-refresh" aria-hidden="true" style="font-size:30pt;height: 100%;width:100%;color : black; "></i>
                                </button>
                                <button class="btn" id="out" onclick="bra()">
                                    <i class="fa fa-sign-out" aria-hidden="true" style="font-size:30pt;height: 100%;width:100%;color : black; "></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div><br>
    <div id="exportContent">
        <div id="hs" hidden></div>
        <div id="tbl" hidden></div>
    </div>

    <script src="./js/tools.js"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-dn4yi8nZ8f8lMfQZNZ8AmEEVT07DEcE&region=MA&signed_in=true&libraries=drawing&callback=initMap" defer></script>
    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./node_modules/jquery/dist/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://parall.ax/parallax/js/jspdf.js"></script>
    <script src="./js/jquery-3.6.0.js"></script>
    <script src="./js/login.js"></script>
    <script src="./js/animationCarte.js"></script>
    <script src="./js/OutAct.js"></script>
    <script src="./js/load.js"></script>
    <script src="./js/export.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.2.3/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/interactjs@1.10.17/dist/interact.min.js"></script>
    <script src="./js/script.js"></script>

    <script>
        function bra() {
            console.log("Login out");
            $.ajax({
                method: 'POST',
                url: 'logout.php',
                success: function(param) {
                    if (param == "OK") {
                        location.reload(true);
                    } else {
                        alert("Reload and try again");
                    }
                },
            });
        }
    </script>

</body>

</html>