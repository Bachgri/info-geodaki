function showForVoirie(){
    const slctlv = document.querySelector("#shiftVo");
    slctlv.addEventListener('change', (event) => {
        var sh = $("#shiftVo").val();
        const icons = [
            ['bsf.png', 'bef.png'],
            ['rsf.png', 'ref.png'],
            ['gsf.png', 'gef.png']
        ]; 
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            mapTypeId: 'terrain',
            center: ps,
            mapTypeControl: false,
            disableDefaultUI: true,
        });
        if (sh != '0') {
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
            //console.log('====================================');
            //console.log(dd);
            //console.log(df);
            //console.log('====================================');
            $("#imgWait").slideDown(200);
            $.ajax({
                url: './lvoirie.php',
                type: 'GET',
                data: {
                    dd: $("#shiftVo").val().split('|')[0], //(new Date().getHours() < 14) ? '06:00:00' : '14:00:00',
                    df: $("#shiftVo").val().split('|')[1], // (new Date().getHours() < 14) ? '14:00:00' : '20:00:00'
                    iduser: readCookie('iduserST')
                    //d: d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear()
                },
                success: function(d) {
                    // //console.log('====================================');
                    // //console.log('d: ' + d.length);
        
                    // //console.log(dd + '\n' + df + '\n' + d);
                    // //console.log('====================================');
                    d = d.replace('LINESTRING(', '');
                    d = d.replace(')', '');
                    // //console.log('====================================');
                    // //console.log(d);
                    // //console.log('====================================');
                    if (d.length < 3) {
                        swal({
                            text: 'Aucun vehicule planifié pour le shift : \n' + dd.split(' ')[1] + ' => ' + df.split(' ')[1]
                        })
                        $('#imgWait').fadeOut();
                    } else {
                        var tx = d.split('*');
                        polylineMap = new Map();
                        for (let i = 0; i < tx.length - 1; i++) {
                            var ty = tx[i].split(';');
                            var t = ty[0];
                            // t1 = t1.replace('\n', '');
                            var t1 = t.replace(' LINESTRING(', '');
                            t1 = t1.replace(')', '');
                            ////console.log('====================================');
                            ////console.log(t1);
                            ////console.log('====================================');
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
                            LVoi.set(ty[2], [ty[3], ty[1], ty[4], ty[5]]);
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
                                $select.value = l
                                //console.log('====================================');
                                //console.log(l);
                                //console.log('====================================');
                            };
                            //changeSelected()
                        }
                        // setInterval(() => {
                        // }, 1500);
                    }
                    // //console.log('====================================');
        
                    function slidit() {
                    }
                    $("#imgWait").slideUp(200);
                }
            })
        }else{
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
            //console.log('====================================');
            //console.log(dd);
            //console.log(df);
            //console.log('====================================');
            $("#imgWait").slideDown(200);
            $.ajax({
                url: './lvoirie.php',
                type: 'GET',
                data: {
                    dd: dd, //(new Date().getHours() < 14) ? '06:00:00' : '14:00:00',
                    df: df, // (new Date().getHours() < 14) ? '14:00:00' : '20:00:00'
                    iduser: readCookie('iduserST')
                    //d: d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear()
                },
                success: function(d) {
                    // //console.log('====================================');
                    // //console.log('d: ' + d.length);
        
                    // //console.log(dd + '\n' + df + '\n' + d);
                    // //console.log('====================================');
                    d = d.replace('LINESTRING(', '');
                    d = d.replace(')', '');
                    // //console.log('====================================');
                    // //console.log(d);
                    // //console.log('====================================');
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
                            // t1 = t1.replace('\n', '');
                            var t1 = t.replace(' LINESTRING(', '');
                            t1 = t1.replace(')', '');
                            ////console.log('====================================');
                            ////console.log(t1);
                            ////console.log('====================================');
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
                            LVoi.set(ty[2], [ty[3], ty[1], ty[4], ty[5]]);
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
                                $select.value = l
                                //console.log('====================================');
                                //console.log(l);
                                //console.log('====================================');
                            };
                            //changeSelected()
                        }
                        // setInterval(() => {
                        // }, 1500);
                    }
                    // //console.log('====================================');
        
                    function slidit() {
                        $("#imgWait").slideUp(200);
                    }
                    $("#imgWait").slideUp(200);
                }
            })
        }
    })
}