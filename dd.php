<?php
function myCrypte($string, $cipher, $key, $options, $iv)
{
    return openssl_encrypt($string, $cipher, $key, $options, $iv);
}
function myDecrypte($string, $cipher, $key, $options, $iv)
{
    return openssl_decrypt($string, $cipher, $key, $options, $iv);
}
$ciphering = "AES-128-CTR";
$options = 0;
$encryption_iv = '2019202020212022';
$encryption_key = "Insightsolutions";

$v = $_GET['ville'];
$v =  myDecrypte($v, $ciphering, $encryption_key, $options, $encryption_iv);
file_put_contents("./db/connection.php", "");
$f = fopen('./db/connection.php', 'w');
if ($v == "tanger") {
    $host = '141.94.71.45';
} else if ($v == 'marrakech') {
    $host = '51.75.194.176';
} else if ($v == 'arma') {
    $host = '141.94.222.76';
} else if ($v == 'rabat') {
    $host = 'rabat.geodaki.com';
}else {
    exit(5);
}

fwrite($f, "<?php 
function connect(){
    \$bd = null;
    try{
        \$bd = new PDO('pgsql:host=$host;dbname=datatrac', 'postgres', 'root15963' );
    }catch(Exception \$e){
        echo \$e->getMessage() ;
    } 
    return \$bd;
}
?>");
