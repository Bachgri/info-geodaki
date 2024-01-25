<?php
setcookie("CKC_User_Ins_AR_T");
setcookie("CKC_Pass_Ins_Ar_T");
session_start();
session_unset();
session_destroy();
//echo "OK";

header('location:./');
