<?php
session_start();
require './db/connection.php';
$bd = connect();
if (!$bd)
    die("TryAgain");

$l = "l";
$p = "p";

if (isset($_POST['login'])  and  isset($_POST['password'])) {
    $l = htmlspecialchars($_POST['login'], ENT_QUOTES, 'utf-8');
    $p = htmlspecialchars($_POST['password'], ENT_QUOTES, 'utf-8');
    $sql = "SELECT id_user, count(*)
            FROM PUBLIC.utilisateur 
            WHERE login = ? and pass = ?
            group by id_user
    ";
    $prep = $bd->prepare($sql);
    $res = $prep->execute(array($l, $p));
    $nbr = 0;
    $iduser;
    while ($data = $prep->fetch(PDO::FETCH_ASSOC)) {
        $nbr = $nbr + $data['count'];
        $iduser = $data['id_user'];
    }
    if ($nbr == 0) {
        echo "No";
    } else {
        echo "OK|" . $iduser;
        $_COOKIE["CKC_User_Ins_AR_T"] = md5(md5($l) . "@#$");
        $_COOKIE["CKC_Pass_Ins_Ar_T"] = md5(md5($p) . "@#$");
        setcookie("CKC_User_Ins_AR_T", md5(md5($l) . "@#$"), time() + 20 * 60);
        setcookie("CKC_Pass_Ins_Ar_T", md5(md5($p) . "@#$"), time() + 20 * 60);
        $_SESSION['SSN' . $l . $p] = md5(md5($l) . "@#$");
        $_SESSION['SSN' . $p . $l] = md5(md5($p) . "@#$");
    }
} else {
    echo "Pas de variable";
}
