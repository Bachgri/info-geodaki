function all1(){
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[0].title;
    polygons[0].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 0) {
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
function all2() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[1].title;
    polygons[1].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 1) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function all3() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[2].title;
    polygons[2].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 2) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function all4() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[3].title;
    polygons[3].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 3) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function all5() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[4].title;
    polygons[4].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 4) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function all6() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[5].title;
    polygons[5].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 5) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function all7() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[6].title;
    polygons[6].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 6) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function all8() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[7].title;
    polygons[7].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 7) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function all9() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[8].title;
    polygons[8].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 8) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function all10() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[9].title;
    polygons[9].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 9) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function all11() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[10].title;
    polygons[10].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 10) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function all12() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[11].title;
    polygons[11].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 11) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function all13() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[12].title;
    polygons[12].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 12) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function all14() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[13].title;
    polygons[13].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 13) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function all15() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[14].title;
    polygons[14].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 14) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function lav1(i){
    cauche = "bacs";
    document.getElementById('zone').innerHTML = LavagePolygones[i].title;
    polygons[i].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 0) {
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
}/*
function lav2() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[1].title;
    polygons[1].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 1) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function lav3() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[2].title;
    polygons[2].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 2) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function lav4() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[3].title;
    polygons[3].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 3) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function lav5() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[4].title;
    polygons[4].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 4) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function lav6() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[5].title;
    polygons[5].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 5) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function lav7() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[6].title;
    polygons[6].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 6) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function lav8() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[7].title;
    polygons[7].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 7) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function lav9() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[8].title;
    polygons[8].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 8) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function lav10() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[9].title;
    polygons[9].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 9) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function lav11() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[10].title;
    polygons[10].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 10) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function lav12() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[11].title;
    polygons[11].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 11) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function lav13() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[12].title;
    polygons[12].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 12) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function lav14() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[13].title;
    polygons[13].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 13) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
function lav15() {
    cauche = "bacs";
    document.getElementById('zone').innerHTML = polygons[14].title;
    polygons[14].setOptions({
        fillOpacity: 0.2,
        strokeColor: 'black',
        strokeWeight: 3
    });
    for (var r = 0; r < polygons.length; r++) {
        if (r != 14) {
            polygons[r].setOptions({
                fillOpacity: 0.8,
                strokeColor: 'black',
                strokeWeight: 3
            });
        }
    }
    var d = new Date();
    for (var cc = 0; cc < bacs.length; cc++) {
        if (bacs[cc][2] == document.getElementById('zone').innerHTML.replace('Detail ', '')) {
            bacs[cc][0].setMap(map);
        } else {
            bacs[cc][0].setMap(null);
        }

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
*/