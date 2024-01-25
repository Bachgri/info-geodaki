<?php 

    $bd = null;
    try{
        $bd = new PDO('pgsql:host=51.75.194.176;dbname=datatrac', 'postgres', 'root15963' );
    }catch(Exception $e){
        echo $e->getMessage() ;
    } 
?>