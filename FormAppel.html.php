<?php
require './db/connection.php';
$db = connect();
$sqlNAC = "SELECT COUNT(annexe), commune FROM decoup2 group by commune";
$prepNAC = $db->prepare($sqlNAC);
$prepNAC->execute();

echo "
    var d = new Date();
        var h1 = '<br><br><br><h1>          Le '+ d.getDate() + '/' + (d.getMonth()+1) + '/' + (d.getYear()+1900) + '  ' +d.getHours()+'h'+d.getMinutes()+  '</h1><br><br><br><br>';
        var h2 = '<h2> Resultat de Réalisation : Ville Tanger </h2>';
        document.getElementById('hs').innerHTML = h1 + h2;
        var table = $('<table id=\"table\"></table>') ;
        var ths1= document.createElement('tr');
        tds10 = document.createElement('th'); tds10.innerHTML = '';
        tds11 = document.createElement('th'); tds11.innerHTML = '';
        tds12 = document.createElement('th'); tds12.innerHTML = '';
        tds13 = document.createElement('th'); tds13.innerHTML = '';
        tds14 = document.createElement('th'); tds14.innerHTML = '';
        ths1.append(tds10, tds11, tds12, tds13, tds14);
        table.append(ths1) ;
        var tablev = '<table id=\"table\" hidden>';   
        tablev += '<thead><tr><th>Zones</th><th>Annexe</th><th>Nombre de bacs</th><th>Nombre de bacs Collecté</th><th>Taux de réalisation</th></tr></thead><tbody>'     
        for(var nb =0; nb<AnnCom.length;nb++){
            tri = '<tr><td>'+AnnCom[nb][2] +'</td>'+ '<td>'+AnnCom[nb][1] +'</td>' +'<td>'+pourcentages[nb][3] +'</td>'+ '<td>'+pourcentages[nb][2] + '</td><td>'+ pourcentages[nb][1] +'%</td></tr>' ;
            tablev += tri;
        }
        tablev += '</tbody></table>';
        var br = document.createElement('br'); 
        document.getElementById('tbl').innerHTML = '<br>'+ '<br>'+   '<br>'+ '<br>'+ tablev;


    ";
