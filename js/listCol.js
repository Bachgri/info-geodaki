//const { default: swal } = require("sweetalert");

const valuescc = new Map([
    ["SOI", ['22:00:00', '06:00:00']],
    ["MAT", ['05:00:00', '14:00:00']]
])

function showForColCi(){
    $("#combo").css('display', 'block');
    $('#combo').children().remove().end()
    $('#combo').append('<select id="shiftCiCo"></select>');
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
        $select.value = l+'' 
    };
    //changeSelected()
    const slctcc = document.querySelector("#shiftCiCo");
    slctcc.addEventListener('change', (event)=>{
        var sh = $("#shiftCiCo").val();
        if(sh != '0'){
            // alert(values.get($("#shift").val())[0])
            //console.log('====================================');
            //console.log("l");
            //console.log('====================================');
            // if (sh == '1') {
            //     var day, mon, year = d.getFullYear();
            //     if((d.getMonth()+1) == 1){
            //         if(d.getDate()==1){
            //             mon = 12; day = 31; year = d.getFullYear()-1
            //         }  
            //     }
            //     if(d.getDate() == 1){
            //         if((d.getMonth()+1)%2 == 0 ){
            //             day = 30;
            //         }else if((d.getMonth()+1)%2 != 0 ) {
            //             day = 31; 
            //         }
            //         mon = d.getMonth()
            //     }else{
            //         day = d.getDate()
            //     }
            //     dd = '' + day + '-' + mon + '-' + year+ ' 22:00:00'
            //     df = '' + d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 05:30:00'
            // } else if (sh == '2') {
            //     dd = '' + (d.getDate()) + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 05:00:00'
            //     df = '' + d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 14:00:00'
            // } else if (sh == '3') {
            //     dd = '' + (d.getDate()) + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 14:00:00'
            //     df = '' + d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 20:00:00'
            // } else {
            //     var day, mon, year = d.getFullYear();
            //     if((d.getMonth()+1) == 1){
            //         if(d.getDate()==1){
            //             mon = 12; day = 31; year = d.getFullYear()-1
            //         }  
            //     }
            //     if(d.getDate() == 1){
            //         if((d.getMonth()+1)%2 == 0 ){
            //             day = 30;
            //         }else if((d.getMonth()+1)%2 != 0 ) {
            //             day = 31; 
            //         }
            //         mon = d.getMonth()
            //     }else{
            //         day = d.getDate()
            //     }
            //     dd = '' + day + '-' + mon + '-' + year+ ' 22:00:00'
            //     df = '' + d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' 20:000:00';
            // }
            //console.log(sh + ' ' + dd + ' ' + (df));
            // //console.log('====================================');
            // //console.log("beging");
            // //console.log('====================================');
            var date = new Date();
            var dt = new Date();
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                mapTypeId: 'terrain',
                center: ps,
                mapTypeControl: false,
                disableDefaultUI: true,
            });
            $("#imgWait").fadeIn(500);
            var d = new Date(); 
            $.ajax({
                url: './clctCir.php',
                type: 'GET',
                data: {
                    dd:  $("#shiftCiCo").val().split('|')[0], //(new Date().getHours() < 14) ? '06:00:00' : '14:00:00',
                    df:  $("#shiftCiCo").val().split('|')[1], // (new Date().getHours() < 14) ? '14:00:00' : '20:00:00'
                    iduser: readCookie('iduserST')
                    //d : d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear()
                },
                success: function(d) {
                    // //console.log("d:" + d);
                    console.log("d : "+d);
                    if(d.length<10){
                        swal({
                            text: "Aucun véhicule palnifié dans ce shift. \n veuillez choisir un autre",
                        })
                        $('#imgWait').fadeOut()
                    }else{       
                        d = d.replace('LINESTRING(', '');
                        d = d.replace(')', '');
                        //console.log('====================================');
                        //console.log(d);
                        //console.log('====================================');
                        polylineMap = new Map();
                        var tx = d.split('*');
                        for (let i = 0; i < tx.length - 1; i++) {
                            var ty = tx[i].split(';');
                     
                            var t = ty[0];
                            var t1 = t.replace('MULTILINESTRING((', '');
                            t1 = t1.replace('))', '');
                            t1 = t1.replace(' ', '');
                            // t1 = t1.replace('\n', '');
                            path = [];
                            t1 = t1.split(',');
                            for (let j = 0; j < t1.length; j++) {
                                var ttt = t1[j].split(' ');
                                var p = {
                                    lat: Number(ttt[1]),
                                    lng: Number(ttt[0])
                                };
                            // // //console.log(p);
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
                            // alert('ok'   )
                            polylineMap.set(ty[2], [ty[3], ty[1], ty[4], ty[5]])
                            // //console.log('===========     Polyline      ==============');
                            // //console.log(polylineMap.get(ty[2]));
                            // //console.log('====================================');
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
                    }
                    
                    $("#imgWait").fadeOut(2500);
                    // //console.log('====================================');
                    // //console.log("End");
                    // //console.log('====================================');
                },
                error: function(d) {
                    //console.log(d);
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
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                mapTypeId: 'terrain',
                center: ps,
                mapTypeControl: false,
                disableDefaultUI: true,
            });
            $("#imgWait").fadeIn(2500);
            var d = new Date(); 
            $.ajax({
                url: './clctCir.php',
                type: 'GET',
                data: {
                    dd: dd, //(new Date().getHours() < 14) ? '06:00:00' : '14:00:00',
                    df: dd, // (new Date().getHours() < 14) ? '14:00:00' : '20:00:00'
                    iduser: readCookie('iduserST')
                    //d : d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear()
                },
                success: function(d) {
                    // //console.log("d:" + d);
                    if(d.length<10){
                        swal({
                            text: "Aucun véhicule palnifié dans ce shift. \n veuillez choisir un autre",
                        })
                        $("#imgWait").fadeOut(20);
                    }else{       
                        d = d.replace('LINESTRING(', '');
                        d = d.replace(')', '');
                        //console.log('====================================');
                        //console.log(d);
                        //console.log('====================================');
                        polylineMap = new Map();
                        var tx = d.split('*');
                        for (let i = 0; i < tx.length - 1; i++) {
                            var ty = tx[i].split(';');
                     
                            var t = ty[0];
                            var t1 = t.replace(' LINESTRING(', '');
                            t1 = t1.replace(')', '');
                            // t1 = t1.replace('\n', '');
                            path = [];
                            t1 = t1.split(',');
                            for (let j = 0; j < t1.length; j++) {
                                var ttt = t1[j].split(' ');
                                var p = {
                                    lat: Number(ttt[1]),
                                    lng: Number(ttt[0])
                                };
                            // // //console.log(p);
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
                            // alert('ok'   )
                            polylineMap.set(ty[2], [ty[3], ty[1], ty[4], ty[5]])
                            // //console.log('===========     Polyline      ==============');
                            // //console.log(polylineMap.get(ty[2]));
                            // //console.log('====================================');
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
                    }
                    
                    $("#imgWait").fadeOut(200);
                    // //console.log('====================================');
                    // //console.log("End");
                    // //console.log('====================================');
                },
                error: function(d) {
                    //console.log(d);
                }
    
            })
        }
    })
}