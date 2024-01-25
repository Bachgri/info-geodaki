<?php 
if(isset($_COOKIE["CKC_User_Ins_AR_T"]) and isset($_COOKIE["CKC_Pass_Ins_Ar_T"])){
    include './Menu.html.php';
}else{
    include './login.html.php';
}
 