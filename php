 <?php 
        require './db/connection.php';
        $db = connect();
        $sql = "select nom, idz, st_astext(geom) as plgn  , st_x(st_centroid(geom)) as lt, st_y(st_centroid(geom)) as ln from public.decoupage";
        $prep = $db->prepare($sql);
        $res = $prep->execute();
        $y=0;
        $plgn = array();
        echo "<script>
        color = ['red','green','blue','yellow','white']
        function initMap() {
            // The location of Uluru 31.627294, 
            const Tanger = { lat : 35.75370794162373  , lng : -5.820173343332406  };
            // The map, centered at Tanger
            const map = new google.maps.Map(document.getElementById('map'), {
            zoom: 11,
            mapTypeId: \"hybrid\",
            center: Tanger,
            });
        ";
        while($d = $prep->fetch(PDO::FETCH_ASSOC)){
                    //echo $d['idz'] ."<br>"; //.$d['plgn']."<br><br>";
                    $x1 = substr($d['plgn'],strlen("MULTIPOLYGON((("), strlen($d['plgn'])-3 ) ;
                    $x2 = substr($x1,0, strlen($x1)-3 )."";
                    
                    $Lats_Lngs = explode(',', $x2);
                    $plgn[$y] = "[";
                    for($i=0;$i<count($Lats_Lngs); $i++){
                        $cc = explode(' ', $Lats_Lngs[$i]);
                        $x =  "{lat : ".$cc[1] . " , lng : ".$cc[0]."},
                        
                        ";
                        $plgn[$y] = $plgn[$y] . $x;
                    }
                    $plgn[$y] = $plgn[$y]."]";
                    //echo $plgn[$y];
                    // const PtsPlgn$y= $plgn[$y];
                    echo "
                    const polygon$y  = new google.maps.Polygon({
                        paths: $plgn[$y],
                        strokeColor: color[$y],
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: color[$y],
                        fillOpacity: 0.75,
                        title : '". $d['nom'] ."',
                         
                    });
                    var marker$y =  new google.maps.Marker({
                        position: Tanger,
                        map: map,
                        label : {
                            text :'123',
                            title: '123',
                            fontSize : '20px'
                        },
                        labelAnchor: new google.maps.Point(3, 30),
                        //labelClass: Sclass, // the CSS class for the label
                        labelInBackground: false,
                        icon : 'None'
                    });
                    polygon$y.setMap(map);
                    ";
                    $y=$y+1;
                    
                }
                echo " 
                }
                window.initMap = initMap;
                </script>
                "
                ;

    ?>