
        document.querySelector('#bm').addEventListener('click', function() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13.4,
                mapTypeId: 'terrain',
                center: ps,
                mapTypeControl: false,
                disableDefaultUI: true,
            });
            $('#vueTabCoCo').attr('hidden', true)
            $('#vueTabCiCo').attr('hidden', true)
            $('#vueTabMec').attr('hidden', true)
            $('#road').attr('hidden', true)
            $('#map').css({
                'right': '0'
            });
            $('#vueTabCirc').attr('hidden', true)
            $('#tableMan').css({
                'right': '120%'
            });
            showForBalMan();
            EXP = "MAN"
            $('#imgWait').fadeIn(450)
			$('#export').fadeIn(150);
            $('#act').attr('hidden', 'true');
            $('#act2').attr('hidden', 'true');
            $('#act3').attr('hidden', 'true');
            $('#vueTabVoi').attr('hidden', 'true');
            $("#combo").css('display', 'block');
            $('#switch').removeAttr('hidden')
            $('#switch').css({'right':'5px'})
            var dd, df, dt = new Date();
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
                method: 'GET',
                data: {
                    dd: dd,
                    df: df,
                    userid: readCookie('iduserST')
                    //d: (dt.getDate()) + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear()
                },
                success: function(d) {
                    /*//console.log('====================================');
                    //console.log(d);
                    //console.log('====================================');*/
                    if(d.length>10){
                        PolylineMAN = new Map();
                        var tx = d.split('*');
                        for (let i = 0; i < tx.length - 1; i++) {
                            var ty = tx[i].split(';');
                            var t = ty[0];
                            t1 = t.replace('MULTILINESTRING((', '');
                            t1 = t1.replace('))', '');
                            t1 = t1.replace(')', '');
                            t1 = t1.replace('LINESTRING(', '');
                            t1 = t1.replace('\n', '');
                            path = [];
                            t1 = t1.split(',');
                            console.log(t1);
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
                    }else{

                    }
                    function slidit() {
                        $("#imgWait").slideUp(200);
                    }
                    $.ajax({
                        url: 'planningbm.php',
                        method: 'GET',
                        data: { 
                            userid: readCookie('iduserST'),
                            f : 'BALAYAGE MANUEL'
                        },
                        success: (data) => {
                            console.log('================== data ==================');
                            console.log(data);
                            console.log('====================================');
                            if(data.length>10){
                                plannings = data.split('*');
                                $('#shiftMan').children().remove().end()
                                $('#shiftMan').append('<option value="0">Circuits en cours d\'exécution</option>');
                                for (let i = 0; i < plannings.length - 1; i++) {
                                    var x = plannings[i].split('|');
                                    //$('#combo').append('<select id="shiftCiCo"></select>');
                                    $('#shiftMan').append('<option value="' + x[0] + '|' + x[1] + '">' + x[0] + '|' + x[1]+ '</option>');
                                }
                                $('#shiftMan').append('<option value="' + plannings[0].split('|')[0] + '|'+ plannings[0].split('|')[0].split(' ')[0] + ' 20:00:00">' + plannings[0].split('|')[0]+ ' ' + plannings[plannings.length - 2].split('|')[1] + '</option>');

                            }
                            // setTimeout(slidit, 1000)
                            $("#imgWait").slideUp(200);
                        }
                        // $('#imgWait').fadeOut(150)
                    })
                }
            })
            

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