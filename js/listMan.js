const MAT = '' 
const values = new Map([
    ["SOI", ['14:00:00', '20:00:00']],
    ["MAT", ['05:00:00', '14:00:00']],
    ["ALL", ['05:00:00', '20:00:00']]
])
function showForBalMan(){
    $('#combo').children().remove().end()
    $('#combo').append('<select id="shiftMan"></select>');
    /*$('#shiftMan').append('<option value="2">06h->14h</option>');
    $('#shiftMan').append('<option value="3">14h->20h</option>');
    $('#shiftMan').append('<option value="0">toute la journée</option>');*/
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        mapTypeId: 'terrain',
        center: ps,
        mapTypeControl: false,
        disableDefaultUI: true,
    });
    
    const slct = document.querySelector("#shiftMan");
    slct.addEventListener('change', (event)=>{
        
        var sh = $("#shiftMan").val();
        var dd, df, d = new Date();
        if (sh == '1') {
            dd = '' + (d.getDate() - 1) + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 22:00:00'
            df = '' +  d.getDate() +      '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 04:00:00'
        } else if (sh == '2') {
            dd = '' + (d.getDate()) +     '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 05:00:00'
            df = '' +  d.getDate() +      '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 14:00:00'
        } else if (sh == '3') {
            dd = '' + (d.getDate()) +     '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 14:00:00'
            df = '' +  d.getDate() +      '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 20:00:00'
        } else {
            dd = '' + (d.getDate() ) +    '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 00:00:00';
            df = '' +  d.getDate() +      '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 23:59:59';
        }
        // //console.log('====================================');
        // //console.log(dd + ('\n')+df + '\n' +  d.getDate() +      '-' + (d.getMonth() + 1) + '-' + d.getFullYear());
        // //console.log('====================================');
        // alert(values.get($("#shift").val())[0])
        if(sh != '0'){
            $("#imgWait").fadeIn(450);
            $.ajax({
                url: './apahman.php', 
                type : 'GET',
                data : {
                    dd : $('#shiftMan').val().split('|')[0],  //values.get($("#shiftMan").val())[0],
                    df : $('#shiftMan').val().split('|')[1], //values.get($("#shiftMan").val())[1]
                    userid : readCookie('iduserST')
                    //d  :  d.getDate() +      '-' + (d.getMonth() + 1) + '-' + d.getFullYear()
                },
                success: function(d) { 
                    
                    if(d.length<10){
                        swal({
                            text: "Aucun véhicule palnifié dans ce shift. \n veuillez choisir un autre",
                        })
                        $('#imgWait').fadeOut();
                    }else{  
                        map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 12,
                            mapTypeId: 'terrain',
                            center: ps,
                            mapTypeControl: false,
                            disableDefaultUI: true,
                        });
                        PolylineMAN = new Map();
                        console.log('====================================');
                        console.log("succes : "+ d);
                        console.log('====================================');
                        //// //console.log('d : ' + d);
                        var tx = d.split('*');
                        for (let i = 0; i < tx.length - 1; i++) {
                            var ty = tx[i].split(';');
                            var t = ty[0];
                            t1 = t.replace('MULTILINESTRING((', '');
                            t1 = t1.replace('))', '');
                            t1 = t1.replace(')', '');
                            var t1 = t1.replace('LINESTRING(', '');

                            t1 = t1.replace('\n', '');
                            console.log(t1);
                            path = [];
                            t1 = t1.split(',');
                            for (let j = 0; j < t1.length; j++) {
                                var ttt = t1[j].split(' ');
                                var p = {
                                    lat: Number(ttt[1]),
                                    lng: Number(ttt[0])
                                }
                                path.push(p);
                            }
                            //console.log('====================================');
                            //console.log(path);
                            //console.log('====================================');
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
                            PolylineMAN.set(ty[2], [ty[1], ty[3], ty[4], ty[5]]);
                            google.maps.event.addListener(pl, 'click', function() {
                                swal({
                                    text :"Circuit : " + this.title.split(',')[1] +
                                    "\nVéhicule : " + this.title.split(',')[2] +
                                    "\nTaux : " + this.title.split(',')[0] + "%" + 
                                    "\nDate début : " + ty[4] + "\nDate fin : " +ty[5]
                                    ,
                                    button : 'ok'
                                })
                            })
                        }
                        $('#imgWait').fadeOut(150)
                    }
                },
                error: function(err){
                    // //console.log('====================================');
                    // //console.log(err);
                    // //console.log('====================================');
                }
            })
        }else{
            var dd, df, dt = new Date();
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
            $("#imgWait").fadeIn(450);
            $.ajax({
                url: './apahman.php',
                type : 'GET',
                data : {
                    dd : dd,  //values.get($("#shiftMan").val())[0],
                    df : df, //values.get($("#shiftMan").val())[1]
                    userid : readCookie('iduserST')
                    //d  :  d.getDate() +      '-' + (d.getMonth() + 1) + '-' + d.getFullYear()
                },
                success: function(d) { 
                    if(d.length<10){
                        swal({
                            text: "Aucun véhicule palnifié dans ce shift. \n veuillez choisir un autre",
                        })
                        $("#imgWait").fadeOut(150);
                    }else{  
                        map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 12,
                            mapTypeId: 'terrain',
                            center: ps,
                            mapTypeControl: false,
                            disableDefaultUI: true,
                        });
                        PolylineMAN = new Map();
                        //console.log('====================================');
                        ////console.log("succes : "+ d);
                        //console.log('====================================');
                        //// //console.log('d : ' + d);
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
                                }
                                path.push(p);
                            }
                            //console.log('====================================');
                            //console.log(path);
                            //console.log('====================================');
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
                            PolylineMAN.set(ty[2], [ty[1], ty[3], ty[4], ty[5]]);
                            google.maps.event.addListener(pl, 'click', function() {
                                swal({
                                    text :"Circuit : " + this.title.split(',')[1] +
                                    "\nVéhicule : " + this.title.split(',')[2] +
                                    "\nTaux : " + this.title.split(',')[0] + "%" + 
                                    "\nDate début : " + ty[4] + "\nDate fin : " +ty[5]
                                    ,
                                    button : 'ok'
                                })
                            })
                        }
                        $('#imgWait').fadeOut(150)
                    }
                },
                error: function(err){
                    // //console.log('====================================');
                    // //console.log(err);
                    // //console.log('====================================');
                }
            })
        }
    
    });

}