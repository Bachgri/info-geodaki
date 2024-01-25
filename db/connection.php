<?php 
function connect(){
    $bd = null;
    try{
        $bd = new PDO('pgsql:host=rabat.geodaki.com;dbname=datatrac', 'postgres', 'root15963' );
    }catch(Exception $e){
        echo $e->getMessage() ;
    } 
    return $bd;
}
?>