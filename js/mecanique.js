function BalayageMecanique() {
    $('#myChart0').animate({
        'right': '120%'
    });
    $('#export').fadeIn(150);
    $('#switch').attr('hidden', true)
    $('#map').animate({
        right: '0'
    })
    $('#map').css({
        'right': '0'
    });
    $('#tableMan').css({
        'right': '120%'
    });
    $('#vueTabCirc').attr('hidden', true)
    $('#vueTabCoCo').attr('hidden', true)
    $('#vueTabCiCo').attr('hidden', true)
    $('#road').attr('hidden', true)
    $('#switch').attr('hidden', true)
    $('#vueTabCirc').attr('hidden', true)
    $('#act').attr('hidden', 'true');
    $('#act2').attr('hidden', 'true');
    $('#act3').attr('hidden', 'true');
    $('#vueTabVoi').attr('hidden', 'true');
    $('#vueTabMec').removeAttr('hidden');
    showForMec();
    EXP = 'BalMec';
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13.4,
        mapTypeId: 'terrain',
        center: ps,
        mapTypeControl: false,
        disableDefaultUI: true,
    });

    var dd, df, dt = new Date();
    if (dt.getHours() < 5) {
        dd = '' + (dt.getDate() - 1) + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear() + ' 22:00:00'
        df = '' + dt.getDate() + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear() + ' 05:00:00'
    } else if (dt.getHours() > 5 && dt.getHours() < 14) {
        dd = '' + (dt.getDate()) + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear() + ' 05:00:00'
        df = '' + dt.getDate() + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear() + ' 14:00:00'
    } else if (dt.getHours() >= 14 && dt.getHours() <= 20) {
        dd = '' + (dt.getDate()) + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear() + ' 14:00:00'
        df = '' + dt.getDate() + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear() + ' 20:00:00'
    } else {
        dd = '' + (dt.getDate() - 1) + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear() + ' 22:00:00';
        df = '' + dt.getDate() + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear() + ' 20:00:00';
    }
    $("#imgWait").fadeIn(1940);
    // //console.log('====================================');
    // //console.log(dd + '\n' + df + '\n' + dt.getDate() + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear());
    // //console.log('====================================');
    $.ajax({
        url: './bmec.php',
        type: 'GET',
        data: {
            dd: dd,
            df: df,
            iduser: readCookie('iduserST')
            //d: dt.getDate() + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear()
        },
        success: function(d) {
            mecR = []
            if(d.length<10){
                swal({
                    text: "Aucun véhicule palnifié dans ce shift. \n veuillez choisir un autre",
                })
                $("#imgWait").fadeOut(150);
            }else{
                var tx = d.split('*');
                mecR = []; 
                for (let i = 0; i < tx.length - 1; i++) {
                    var ty = tx[i].split(';');
                    var t = ty[0];
                    var t1 = t.replace('MULTILINESTRING(', '');
                    t1 = t1.replace('))', '');
                    t1 = t1.replace('LINESTRING(', '');
                    t1 = t1.replace(')', '');
                    t1 = t1.replace('\n', '');
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
                    mecR.push([ty[2],
                        [ty[3], ty[1], ty[4], ty[5]]
                    ]);
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
                function slidit() {
                    $("#imgWait").slideUp(200);
                }
                
            } 
            $.ajax({
                url: 'planning.php', 
                method: 'GET',
                data: {
                    userid: readCookie('iduserST'),
                    f : 'BALAYAGE MECANIQUE'
                },
                success: (data) => {
                    console.log('================== data ==================');
                    console.log(data);
                    console.log('====================================');
                    plannings = data.split('*');
                    $('#shiftBalMec').children().remove().end();
                    $('#shiftBalMec').append('<option value="0">Circuits en cours d\'exécution</option>');
                    for (let i = 0; i < plannings.length - 1; i++) {
                        var x = plannings[i].split('|');
                        //$('#combo').append('<select id="shiftCiCo"></select>');
                        $('#shiftBalMec').append('<option value="' + x[0] + '|' + x[1] + '">' + x[0] + '|' + x[1] + '</option>');
                    }
                    console.warn(plannings.length);
                    if(plannings.length>1){
                        $('#shiftBalMec').append('<option value="' + plannings[0].split('|')[0] + '|' +  plannings[plannings.length - 2].split('|')[1]   + '">'+ plannings[0].split('|')[0]+ ' ' + plannings[0].split('|')[1] +'</option>');
                    }
                    setTimeout(slidit, 1000)
                }
            })

            //$("#imgWait").fadeOut(1500);
            // //console.log('====================================');
            // //console.log("End");
            // //console.log('====================================');
        },
        error: function(d) {
            // //console.log(d);
        }

    })
    $('#act2').attr('hidden', 'true');
    $('#act3').attr('hidden', 'true');
    closeNav();
    document.querySelector('.mo3ta6').classList.add('active');
    document.querySelector('.mo3ta1').classList.remove('active');
    document.querySelector('.mo3ta2').classList.remove('active');
    document.querySelector('.mo3ta3').classList.remove('active');
    document.querySelector('.mo3ta4').classList.remove('active');
    document.querySelector('.mo3ta5').classList.remove('active');


}