document.querySelector('#road').addEventListener('click', function(){
    console.warn($("#shiftVo").val());
    if($("#shiftVo").val() != '//'){
        $('#switch').attr('hidden', true)
        $('#act').attr('hidden', 'true');
        $('#act2').attr('hidden', 'true');
        $('#act3').attr('hidden', 'true');
        
        $('#imgWait').slideDown(800);
        let mapVeh = new Map();
        let veh = [];
        function addListenerP(pl, k, t) {
            var infowindow = new google.maps.InfoWindow({
                content: "<b>Véhicule : " + k + "</b><br>Date : " + t
            });
            google.maps.event.addListener(pl, 'click', function(event) {
                infowindow.setPosition(event.latLng);
                infowindow.open(map);
            });
        }
        function addListenerM(pl, k, s) {
            var infowindow = new google.maps.InfoWindow({
                content: "<b>" + s + " de circuit du " + k + "</b><br>"
            });
            google.maps.event.addListener(pl, 'click', function(event) {
                infowindow.setPosition(event.latLng);
                infowindow.open(map);
            });
        }
        const icons = [
            ['bsf.png', 'bef.png'],
            ['rsf.png', 'ref.png'],
            ['gsf.png', 'gef.png']
        ]; 
        $.ajax({
            url: 'v.php',
            method: 'GET',
            success: (d) => {
                console.log(d);
                veh = [];
                var f = d.split('*');
                for (let u = 0; u < f.length - 1; u++) {
                    mapVeh.set(f[u], []);
                    veh.push(f[u]);
                }
    
                var l = 0;
                for (let i = 0; i < veh.length; i++) {
                    var c = veh[i];
                    var ic = icons[i][0];
                    var ic1 = icons[i][1];
                    let dd = df = null;
                    if($("#shiftVo").val() !='0'){
                        dd= $("#shiftVo").val().split('|')[0], //(new Date().getHours() < 14) ? '06:00:00' : '14:00:00',
                        df= $("#shiftVo").val().split('|')[1] // (new Date().getHours() < 14) ? '14:00:00' : '20:00:00'
                    }else{
                        dd=(new Date().getHours() < 14) ? ` ${new Date().getFullYear()}/${new Date().getMonth()+1}/${new Date().getDate()} 06:00:00` : ` ${new Date().getFullYear()}/${new Date().getMonth() +1 }/${new Date().getDate()} 14:00:00`,
                        df= (new Date().getHours() > 14) ? ` ${new Date().getFullYear()}/${new Date().getMonth()+1}/${new Date().getDate()} 14:00:00` : ` ${new Date().getFullYear()}/${new Date().getMonth() +1 }/${new Date().getDate()} 20:00:00`
                    }
                    console.log(dd, df, c);
                    $.ajax({
                        url: 'LavVoi.php',
                        method: 'GET',
                        data: {
                            veh: c,
                            dd: dd,//$("#shiftVo").val().split('|')[0], //(new Date().getHours() < 14) ? '06:00:00' : '14:00:00',
                            df: df //$("#shiftVo").val().split('|')[1] // (new Date().getHours() < 14) ? '14:00:00' : '20:00:00'
                        },
                        success: (d) => {
                            var result = d.split('*');
                            //console.log('====================================');
                            //console.log(d);
                            //console.log('====================================');
                            var x = {
                                lat: Number(result[0].split(',')[0]),
                                lng: Number(result[0].split(',')[1])
                            };
                            var m0 = new google.maps.Marker({
                                position: x,
                                map: map,
                                visible: true,
                                icon: icons[l][0]
                            });
                            addListenerM(m0, result[0].split(',')[2], 'Début');
                            let t = 1;
                            for (; t < result.length - 1; t++) {
                                cols = result[t].split(',');
                                var pp = [x, {
                                    lat: Number(cols[0]),
                                    lng: Number(cols[1])
                                }];
                                color = ['blue', 'green'];
                                const pl0 = new google.maps.Polyline({
                                    path: pp,
                                    map: map,
                                    fillColor: color[Number(cols[4])],
                                    strokeColor: color[Number(cols[4])],
                                    strokeWeight: 5
                                });
                                addListenerP(pl0, cols[2], cols[3]);
                                x = {
                                    lat: Number(cols[0]),
                                    lng: Number(cols[1])
                                };
                            }
                            var m1 = new google.maps.Marker({
                                position: x,
                                map: map,
                                visible: true,
                                icon: icons[l++][1]
                            });
                            addListenerM(m1, result[t-1].split(',')[2], "Fin");
                            $("#imgWait").slideUp();
                            /*console.log('====================================');
                            console.log(l);
                            console.log('====================================');*/
                        }
                    });
                };
            }
        }); 
    
    }    
   
})