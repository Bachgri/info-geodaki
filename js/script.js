    var elem = document.getElementById("export");
    let types = new Map();
    let typesL = new Map();
    let secteur = '';
    let typesCollecter = new Map();
    function getHoursDiff(startDate, endDate) {
        const msInHour = 1000 * 60 * 60;
        return Math.round(Math.abs(endDate - startDate) / msInHour);
    }
    elem.addEventListener('click', function() {
        var nameFile = 'rapport';
        console.log(EXP);
        var t = 0, n=1;
        var d = new Date();
        var xf = 40;
        var yf = 250;
        if(EXP == "BacsCo"){
            console.log(EXP);
            $.ajax({
                url: 'cum.php',
                method: 'GET',
                data:{
                    user : readCookie('iduserST')
                },
                success: (dd)=>{
                    console.log('====================================');
                    console.log(dd);
                    console.log('====================================');
                    t = markerTanger.label.text;
                    nameFile = "Rapport_Collecte_bacs"
                    pourcentageMap.set(dd, [0])
                    pourcentageMap.set(pourcentages[0][0], [pourcentages[0][1], pourcentages[0][1], pourcentages[0][1]])
                    var h1 = '<br><br><br><h1>  Le '+ ((d.getDate()+'').length<2?"0"+d.getDate(): d.getDate()) + '/' + (((d.getMonth()+1)+'').length<2?"0"+(d.getMonth()+1): (d.getMonth()+1)) + '/' + (d.getYear()+1900) + '  ' +((d.getHours()+'').length<2 ? "0"+d.getHours() : d.getHours() )+'h'+((d.getMinutes()+'').length<2 ? "0"+d.getMinutes() : d.getMinutes())+  '</h1><br><br><br><br>';
                    var h2 = '<h2> Taux de réalisation de la collecte par RFID </h2>';
                    var h3 = '<h2>Secteur : ' + secteur + '</h2>'
                    document.getElementById('hs').innerHTML = h1 + h2 + h3;
                    var table = $('<table id=\"table\"></table>') ;
                    var ths1= document.createElement('tr');
                    tds10 = document.createElement('th'); tds10.innerHTML = '';
                    tds11 = document.createElement('th'); tds11.innerHTML = '';
                    tds12 = document.createElement('th'); tds12.innerHTML = '';
                    tds13 = document.createElement('th'); tds13.innerHTML = '';
                    tds14 = document.createElement('th'); tds14.innerHTML = '';
                    ths1.append(tds10, tds11, tds12, tds13, tds14);
                    bacsParZone = new Map();
                    var collecte = new Map();
                    for(var [k, v] of pourcentageMap){
                        bacsParZone.set(k, 0);
                        collecte.set(k, 0);
                    }
                    for (let i = 0; i < pourcentages.length; i++) {
                        collecte.set(pourcentages[i][0], pourcentages[i][2])
                    }
                    for (let i = 0; i < bacs.length; i++) {
                        bacsParZone.set(bacs[i][2], bacsParZone.get(bacs[i][2])+1);
                    }
                    table.append(ths1) ;
                    pourcentageMap.delete('')
                    var tablev = '<table id=\"table\" hidden>';   
                    tablev += '<thead><tr><th>Zones</th><th>Annexe</th><th>Nombre de bacs</th><th>Nombre de bacs Collectés</th><th>Taux de réalisation</th></tr></thead><tbody>'     
                    for(var [k, v] of pourcentageMap){
                        tri = '<tr><td>'+ dd +'</td>'+ '<td>'+k +'</td>' +'<td>'+bacsParZone.get(k) +'</td>'+ '<td>'+collecte.get(k)+ '</td><td>'+ (collecte.get(k)/bacsParZone.get(k)*100).toFixed(2) +'%</td></tr>' ;
                        tablev += tri;
                        console.log('====================================');
                        console.log(tri);
                        console.log('====================================');
                    }
                    tablev += '</tbody></table>';
                    var br = document.createElement('br'); 
                    document.getElementById('tbl').innerHTML = '<br>'+ '<br>'+   '<br>'+ '<br>'+ tablev;
                    var doc = new jsPDF();
                    $('#hs').removeAttr('hidden');
                    doc.fromHTML(document.getElementById('hs'), 15, 20);
                    $('#hs').attr('hidden', 'true');
                    doc.autoTable({
                        html: '#table',
                        startY: 80,
                        bodyStyles: {
                            minCellHeight: 10,
                            textAlign: 'center'
                        }
                    });
                    doc.text(20,  doc.autoTable.previous.finalY + 25, 'Taux de réalisation moyen : ' + t );
                    doc.save(nameFile + "_"+d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getYear() + 1900) + ' ' + d.getHours() + ':' + d.getMinutes() + ":" + d.getSeconds() + ".pdf");
                
                }
            })
        }else if(EXP == "BacsCo0"){
            $.ajax({
                url: 'cum.php',
                method: 'GET',
                data:{
                    user : readCookie('iduserST')
                },
                success: (dd)=>{
                    $.ajax({
                        url : 'type.php',
                        method: 'post',
                        success: (data)=>{
                            var ts = data.split('*');
                            console.log(data);
                            types = new Map();
                            typesCollecter = new Map();
                            for (let i = 0; i < ts.length-1; i++) {
                                types.set(ts[i], 0);
                                typesCollecter.set(ts[i], 0);
                                console.log(ts[i]);
                            }
                            for(var c=0;c<bacs.length;c++){
                                types.set(bacs[c][4], Number(types.get(bacs[c][4]))+1)
                                if(getHoursDiff(new Date(bacs[c][6]), new Date())<=24){
                                    typesCollecter.set(bacs[c][4], Number(typesCollecter.get(bacs[c][4]))+1)
                                }
                            }
                            t = markerTanger.label.text;
                            nameFile = "Rapport_Collecte_bacs"
                            var h1 = '<br><br><br><h1>  Le '+ ((d.getDate()+'').length<2?"0"+d.getDate(): d.getDate()) + '/' + (((d.getMonth()+1)+'').length<2?"0"+(d.getMonth()+1): (d.getMonth()+1)) + '/' + (d.getYear()+1900) + '  ' +((d.getHours()+'').length<2 ? "0"+d.getHours() : d.getHours() )+'h'+((d.getMinutes()+'').length<2 ? "0"+d.getMinutes() : d.getMinutes())+  '</h1><br><br><br><br>';
                            var h2 = '<h2> Taux de réalisation de la collecte par types RFID </h2>';0
                            var h3 = '<h2>Secteur : ' + secteur + '</h2>'
                            document.getElementById('hs').innerHTML = h1 + h2 + h3;
                            var table = $('<table id=\"table\"></table>') ;
                            // table.append(ths1) ;
                            var tablev = '<table id=\"table\" hidden>';   
                            tablev += '<thead><tr><th>Type</th><th>Nombre Totale</th><th>Nombre collecté</th><th>Taux(%)</th></tr></thead><tbody>'     
                            var ths1= document.createElement('tr');
                            tds10 = document.createElement('th'); tds10.innerHTML = '';
                            tds11 = document.createElement('th'); tds11.innerHTML = '';
                            tds12 = document.createElement('th'); tds12.innerHTML = '';
                            tds13 = document.createElement('th'); tds13.innerHTML = '';
                            tds14 = document.createElement('th'); tds14.innerHTML = '';
                            ths1.append(tds10, tds11, tds12, tds13, tds14);
                            types.delete();
                            for (const [k, v] of types) {
                                console.log(k + ' : '  + v);
                                if(typesCollecter.get(k) == 0) continue;
                                tri = '<tr><td>'+ k +'</td><td>'+v +'</td><td>'+ typesCollecter.get(k) + '</td><td>' + (typesCollecter.get(k)/v*100).toFixed(2) +'</tr>' ;
                                tablev += tri;
                                console.log('====================================');
                                console.log(tri);
                                console.log('====================================');
                            }
                            tablev += '</tbody></table>';
                            var br = document.createElement('br'); 
                            document.getElementById('tbl').innerHTML = '<br>'+ '<br>'+   '<br>'+ '<br>'+ tablev;
                            var doc = new jsPDF();
                            $('#hs').removeAttr('hidden');
                            doc.fromHTML(document.getElementById('hs'), 15, 20);
                            $('#hs').attr('hidden', 'true');
                            doc.autoTable({
                                html: '#table',
                                startY: 80,
                                bodyStyles: {
                                    minCellHeight: 10,
                                    textAlign: 'center'
                                }
                            });
                            doc.text(20,  doc.autoTable.previous.finalY + 25, 'Taux de réalisation moyen : ' + t );
                            doc.save(nameFile + "_"+d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getYear() + 1900) + ' ' + d.getHours() + ':' + d.getMinutes() + ":" + d.getSeconds() + ".pdf");
                        }
                    })
                //     console.log('====================================');
                //     console.log(dd);
                //     console.log('====================================');
                //     bacsParZone = new Map();
                //     var collecte = new Map();
                //     for(var [k, v] of pourcentageMap){
                //         bacsParZone.set(k, 0);
                //         collecte.set(k, 0);
                //     }
                //     for (let i = 0; i < pourcentages.length; i++) {
                //         collecte.set(pourcentages[i][0], pourcentages[i][2])
                //     }
                //     for (let i = 0; i < bacs.length; i++) {
                //         bacsParZone.set(bacs[i][2], bacsParZone.get(bacs[i][2])+1);
                //     }
                
                }
            })
            
        }else if(EXP == "CircuitCo"){
            nameFile = "Rapport_circuit_collecte"
            var h1 = '<br><br><br><h1>  Le '+ ((d.getDate()+'').length<2?"0"+d.getDate(): d.getDate()) + '/' + (((d.getMonth()+1)+'').length<2?"0"+(d.getMonth()+1): (d.getMonth()+1)) + '/' + (d.getYear()+1900) + '  ' +((d.getHours()+'').length<2 ? "0"+d.getHours() : d.getHours() )+'h'+((d.getMinutes()+'').length<2 ? "0"+d.getMinutes() : d.getMinutes())+  '</h1><br><br><br><br>';
            var h2 = '<h2> Taux de réalisation de la collecte par circuit </h2>';
            var h3 = '<h2>Secteur : ' + secteur + '</h2>'
            document.getElementById('hs').innerHTML = h1 + h2 + h3;
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
            t=0;
            tablev += '<thead><tr><th>N°</th><th>Circuit</th><th>Véhicule</th><th>Date début</th><th>Date fin</th><th>Taux</th></tr></thead><tbody>'     
            // for(var nb =0; nb<polylineMap.size;nb++){
                let nb=0;
            for (let [k, v] of polylineMap) {
                
                tri = '<tr><td>' + (++nb)  +'</td><td>'+k +'</td>'+ '<td>'+v[0] +'</td>'+ '<td>'+v[2] +'</td>'+ '<td>'+v[3] +'</td>' +'<td>'+v[1] +'%</td></tr>' ;
                tablev += tri;
                t+= Number(v[1]);
            }
            // }
            tablev += '</tbody></table>';
            var br = document.createElement('br'); 
            document.getElementById('tbl').innerHTML = '<br>'+ '<br>'+   '<br>'+ '<br>'+ tablev;
            console.log(t);
            t = t/polylineMap.size;
            console.log(t);
            t = (t).toFixed(2) + '%';
            console.log(t);
            var doc = new jsPDF();
            $('#hs').removeAttr('hidden');
            doc.fromHTML(document.getElementById('hs'), 15, 20);
            $('#hs').attr('hidden', 'true');
            doc.autoTable({
                html: '#table',
                startY: 80,
                bodyStyles: {
                    minCellHeight: 10,
                    textAlign: 'center'
                }
            });
            doc.text(20,  doc.autoTable.previous.finalY + 25, 'Taux de réalisation moyen : ' + t );
            doc.save(nameFile + "_"+d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getYear() + 1900) + ' ' + d.getHours() + ':' + d.getMinutes() + ":" + d.getSeconds() + ".pdf");
                
        }else if(EXP == "BacsLav"){
            nameFile = "Rapport_lavage_bacs"
            var Result = new Map();
            /*for (let k = 0; k < AnnCom.length; k++) {
                Result.set(AnnCom[k][1], 0);
            }*/
            let zs = [];
            bacsParZone = new Map();
            for (let t = 0; t < pourcentages.length; t++) {
                const element = pourcentages[t];
                bacsParZone.set(element[0], 0);
                Result.set(element[0], 0)
            }
            for (var i = 0; i < bacsLaver.length; i++) {
                //for (var j = 0; j < AnnCom.length; j++) {
                    //if(bacsLaver[i][1]==AnnCom[j][1])
                        Result.set(bacsLaver[i][1], Result.get(bacsLaver[i][1])+1)
                //}
            }
            for (let z = 0; z < bacs.length; z++) {
                bacsParZone.set(bacs[z][2], bacsParZone.get(bacs[z][2])+1 )
            }
            Result.delete('')
            console.log(Result);
            var h1 = '<br><br><br><h1>  Le '+ ((d.getDate()+'').length<2?"0"+d.getDate(): d.getDate()) + '/' + (((d.getMonth()+1)+'').length<2?"0"+(d.getMonth()+1): (d.getMonth()+1)) + '/' + (d.getYear()+1900) + '  ' +((d.getHours()+'').length<2 ? "0"+d.getHours() : d.getHours() )+'h'+((d.getMinutes()+'').length<2 ? "0"+d.getMinutes() : d.getMinutes())+  '</h1><br><br><br><br>';
            var h2 = '<h2> Taux de réalisation du lavage des bacs </h2>';
            var h3 = '<h2>Secteur : ' + secteur + '</h2>'
            document.getElementById('hs').innerHTML = h1 + h2 + h3;  
            var tablev = '<table id=\"table\" hidden>';   
            tablev += '<thead><tr><th>Zones</th><th>Nbr Bacs Lavés</th><th>Nbr Bacs </th><th>Taux</th></tr></thead><tbody>'     
            // for(var nb =0; nb<pourcentages.length;nb++){
            
            for (let [key, value] of Result) { 
                tri = '<tr><td>' + key + '</td>'+ 
                    '<td>'+value +'</td>' +
                    '<td>'+bacsParZone.get(key) +'</td>'+
                    '<td>'+ (value/bacsParZone.get(key)*100).toFixed(2) +'%</td>'+
                    +'</tr>' ;
                    tablev += tri;
            }
            console.log(tri);
            // }
            tablev += '</tbody></table>';
            var br = document.createElement('br'); 
            document.getElementById('tbl').innerHTML =  tablev;
            t = (bacsLaver.length/bacs.length*100).toFixed(2) + '%';
            console.log(t);
            var doc = new jsPDF();
            $('#hs').removeAttr('hidden');
            doc.fromHTML(document.getElementById('hs'), 15, 20);
            $('#hs').attr('hidden', 'true');
            doc.autoTable({
                html: '#table',
                startY: 80,
                bodyStyles: {
                    minCellHeight: 10,
                    textAlign: 'center'
                }
            });
            doc.text(20,  doc.autoTable.previous.finalY + 25, 'Taux de réalisation moyen : ' + t );
            doc.save(nameFile + "_"+d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getYear() + 1900) + ' ' + d.getHours() + ':' + d.getMinutes() + ":" + d.getSeconds() + ".pdf");
 

        }else if(EXP == "BalMec"){
            nameFile = "Rapport_balayage_mécanique";
            var h1 = '<br><br><br><h1>  Le '+ ((d.getDate()+'').length<2?"0"+d.getDate(): d.getDate()) + '/' + (((d.getMonth()+1)+'').length<2?"0"+(d.getMonth()+1): (d.getMonth()+1)) + '/' + (d.getYear()+1900) + '  ' +((d.getHours()+'').length<2 ? "0"+d.getHours() : d.getHours() )+'h'+((d.getMinutes()+'').length<2 ? "0"+d.getMinutes() : d.getMinutes())+  '</h1><br><br><br><br>';
            var h2 = '<h2> Taux de réalisation du balayage mécanique </h2>';
            var h3 = '<h2>Secteur : ' + secteur + '</h2>'
            document.getElementById('hs').innerHTML = h1 + h2 + h3;
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
            t=0;
            tablev += '<thead><tr><th>Circuit</th><th>Véhicule</th><th>Date début</th><th>Date fin</th><th>Taux</th></tr></thead><tbody>';
            var mapMec = new Map(mecR);
            for(var [k, v] of mapMec){
                tri = '<tr><td>'+ k +'</td>'+ '<td>'+ v[0] +'</td>'+'<td>'+ v[2] +'</td>'+'<td>'+ v[3] +'</td>' +'<td>'+ v[1] +'%</td></tr>' ;
                tablev += tri;
                t+= Number(v[1]);
            }
            tablev += '</tbody></table>';
            t = t/mapMec.size;
            t = (t).toFixed(2) + '%';
            document.getElementById('tbl').innerHTML = '<br>'+ '<br>'+   '<br>'+ '<br>'+ tablev;
            var doc = new jsPDF();
            $('#hs').removeAttr('hidden');
            doc.fromHTML(document.getElementById('hs'), 15, 20);
            $('#hs').attr('hidden', 'true');
            doc.autoTable({
                html: '#table',
                startY: 80,
                bodyStyles: {
                    minCellHeight: 10,
                    textAlign: 'center'
                }
            });
            doc.text(20,  doc.autoTable.previous.finalY + 25, 'Taux de réalisation moyen : ' + t );
            doc.save(nameFile + "_"+d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getYear() + 1900) + ' ' + d.getHours() + ':' + d.getMinutes() + ":" + d.getSeconds() + ".pdf");
                
        }else if(EXP == "MAN"){
            console.log("i'm here");
            nameFile = "Rapport_balayage_manuel";
            var h1 = '<br><br><br><h1> Le '+ d.getDate() + '/' + (d.getMonth()+1) + '/' + (d.getYear()+1900) + '  ' +d.getHours()+'h'+d.getMinutes()+  '</h1><br><br><br><br>';
            var h2 = '<h2> Taux de réalisation du Balayage manuel </h2>';
            var h3 = '<h2>Secteur : ' + secteur + '</h2>'
            document.getElementById('hs').innerHTML = h1 + h2 + h3;
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
            t=0; n=1;
            tablev += '<thead><tr><th>N°</th><th>Circuit</th><th>Véhicule</th><th>Date début</th><th>Date fin</th><th>Taux</th></tr></thead><tbody>';
            var x = PolylineMAN.entries()
            for(let [k, v] of PolylineMAN){  
                tri = '<tr><td>' + n++ + '</td><td>'+ k +'</td>'+ '<td>'+v[1] +'</td>' + '<td>'+v[2] +'</td>'+'<td>'+v[3] +'</td>' +'<td>'+v[0] +'%</td></tr>' ;
                tablev += tri;          
                t+= Number(v[0] );
            }
            tablev += '</tbody></table>';
            t = t/PolylineMAN.size;
            t = (t).toFixed(2) + '%';
            document.getElementById('tbl').innerHTML = '<br>'+ '<br>'+   '<br>'+ '<br>'+ tablev;
            yf = 150;
            var doc = new jsPDF();
            $('#hs').removeAttr('hidden');
            doc.fromHTML(document.getElementById('hs'), 15, 20);
            $('#hs').attr('hidden', 'true');
            doc.autoTable({
                html: '#table',
                startY: 80,
                bodyStyles: {
                    minCellHeight: 10,
                    textAlign: 'center'
                }
            });
            doc.text(20,  doc.autoTable.previous.finalY + 25, 'Taux de réalisation moyen : ' + t );
            doc.save(nameFile + "_"+d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getYear() + 1900) + ' ' + d.getHours() + ':' + d.getMinutes() + ":" + d.getSeconds() + ".pdf");
                
        }else if(EXP == "Voirie"){
            nameFile = "Rapport_Lavage_des_voiries"
            var h1 = '<br><br><br><h1>  Le '+ ((d.getDate()+'').length<2?"0"+d.getDate(): d.getDate()) + '/' + (((d.getMonth()+1)+'').length<2?"0"+(d.getMonth()+1): (d.getMonth()+1)) + '/' + (d.getYear()+1900) + '  ' +((d.getHours()+'').length<2 ? "0"+d.getHours() : d.getHours() )+'h'+((d.getMinutes()+'').length<2 ? "0"+d.getMinutes() : d.getMinutes())+  '</h1><br><br><br><br>';
            var h2 = '<h2> Taux de réalisation du lavage par circuit </h2>';
            var h3 = '<h2>Secteur : ' + secteur + '</h2>'
            document.getElementById('hs').innerHTML = h1 + h2 + h3;
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
            t=0;
            tablev += '<thead><tr><th>N°</th><th>Circuit</th><th>Véhicule</th><th>Date début</th><th>Date fin</th><th>Taux</th></tr></thead><tbody>'     
            // for(var nb =0; nb<polylineMap.size;nb++){
            let nb=0;           
            
            for (let [k, v] of LVoi) {
                tri = '<tr><td>' + (++nb)  +'</td><td>'+k +'</td><td>'+v[0] +'</td><td>'+v[2] +'</td><td>'+v[3] +'</td><td>'+v[1] +'%</td></tr>' ;
                tablev += tri;      
                t+= Number(v[1]);   
            }   

            
            // }
            tablev += '</tbody></table>';
            var br = document.createElement('br'); 
            document.getElementById('tbl').innerHTML = '<br>'+ '<br>'+   '<br>'+ '<br>'+ tablev;
            console.log(t);
            t = t/LVoi.size;
            console.log(t);
            t = (t).toFixed(2) + '%';
            console.log(t);
            var doc = new jsPDF();
            $('#hs').removeAttr('hidden');
            doc.fromHTML(document.getElementById('hs'), 15, 20);
            $('#hs').attr('hidden', 'true');
            doc.autoTable({
                html: '#table',
                startY: 80,
                bodyStyles: {
                    minCellHeight: 10,
                    textAlign: 'center'
                }
            });
            doc.text(20,  doc.autoTable.previous.finalY + 25, 'Taux de réalisation moyen : ' + t );
            doc.save(nameFile + "_"+d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getYear() + 1900) + ' ' + d.getHours() + ':' + d.getMinutes() + ":" + d.getSeconds() + ".pdf");
                
        }else if(EXP == "BacsLav0"){
            // $.ajax({
            //     url: 'cum.php',
            //     method: 'GET',
            //     data:{
            //         user : readCookie('iduserST')
            //     },
            //     success: (dd)=>{
                    $.ajax({
                        url : 'type.php',
                        method: 'post',
                        success: (data)=>{
                            var ts = data.split('*');
                            console.log(data);
                            typesL = new Map();
                            typesLaver= new Map();
                            for (let i = 0; i < ts.length-1; i++) {
                                typesL.set(ts[i], 0);
                                typesLaver.set(ts[i], 0);
                                console.log(ts[i]);
                            }
                            for(var x=0;x<bacs.length;x++){
                                typesL.set(bacs[x][4], Number(typesL.get(bacs[x][4]))+1)
                            }
                            for(var c=0;c<bacsLaver.length;c++){
                                //if(getHoursDiff(new Date(bacsLaver[c][6]), new Date())<=24){
                                typesLaver.set(bacsLaver[c][2], Number(typesLaver.get(bacsLaver[c][2]))+1)
                                //}
                            }
                            t = markerTanger.label.text;
                            nameFile = "Rapport_Lavage_bacs"
                            var h1 = '<br><br><br><h1>  Le '+ ((d.getDate()+'').length<2?"0"+d.getDate(): d.getDate()) + '/' + (((d.getMonth()+1)+'').length<2?"0"+(d.getMonth()+1): (d.getMonth()+1)) + '/' + (d.getYear()+1900) + '  ' +((d.getHours()+'').length<2 ? "0"+d.getHours() : d.getHours() )+'h'+((d.getMinutes()+'').length<2 ? "0"+d.getMinutes() : d.getMinutes())+  '</h1><br><br><br><br>';
                            var h2 = '<h2> Taux de réalisation du lavage par types RFID </h2>';0
                            var h3 = '<h2>Secteur : ' + secteur + '</h2>'
                            document.getElementById('hs').innerHTML = h1 + h2 + h3;
                            var table = $('<table id=\"table\"></table>') ;
                            // table.append(ths1) ;
                            var tablev = '<table id=\"table\" hidden>';   
                            tablev += '<thead><tr><th>Type</th><th>Nombre Totale</th><th>Nombre Lavé</th><th>Taux(%)</th></tr></thead><tbody>'     
                            var ths1= document.createElement('tr');
                            tds10 = document.createElement('th'); tds10.innerHTML = '';
                            tds11 = document.createElement('th'); tds11.innerHTML = '';
                            tds12 = document.createElement('th'); tds12.innerHTML = '';
                            tds13 = document.createElement('th'); tds13.innerHTML = '';
                            tds14 = document.createElement('th'); tds14.innerHTML = '';
                            ths1.append(tds10, tds11, tds12, tds13, tds14);
                            typesL.delete();
                            for (const [k, v] of typesL) {
                                console.log(k + ' : '  + v);
                                tri = '<tr><td>'+ k +'</td><td>'+v +'</td><td>'+ typesLaver.get(k) + '</td><td>' + (typesLaver.get(k)/typesL.get(k)*100).toFixed(2) +'</tr>' ;
                                tablev += tri;
                                console.log('====================================');
                                console.log(tri);
                                console.log('====================================');
                            }
                            tablev += '</tbody></table>';
                            var br = document.createElement('br'); 
                            document.getElementById('tbl').innerHTML = '<br>'+ '<br>'+   '<br>'+ '<br>'+ tablev;
                            var doc = new jsPDF();
                            $('#hs').removeAttr('hidden');
                            doc.fromHTML(document.getElementById('hs'), 15, 20);
                            $('#hs').attr('hidden', 'true');
                            doc.autoTable({
                                html: '#table',
                                startY: 80,
                                bodyStyles: {
                                    minCellHeight: 10,
                                    textAlign: 'center'
                                }
                            });
                            t= (bacsLaver.length / bacs.length *100).toFixed(2);
                            doc.text(20,  doc.autoTable.previous.finalY + 25, 'Taux de réalisation moyen : ' + t );
                            doc.save(nameFile + "_"+d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getYear() + 1900) + ' ' + d.getHours() + ':' + d.getMinutes() + ":" + d.getSeconds() + ".pdf");
                        }
                    })
                //     console.log('====================================');
                //     console.log(dd);
                //     console.log('====================================');
                //     bacsParZone = new Map();
                //     var collecte = new Map();
                //     for(var [k, v] of pourcentageMap){
                //         bacsParZone.set(k, 0);
                //         collecte.set(k, 0);
                //     }
                //     for (let i = 0; i < pourcentages.length; i++) {
                //         collecte.set(pourcentages[i][0], pourcentages[i][2])
                //     }
                //     for (let i = 0; i < bacs.length; i++) {
                //         bacsParZone.set(bacs[i][2], bacsParZone.get(bacs[i][2])+1);
                //     }
                
            //     }
            // })
            
        }


    });
