<?php
session_start();

require_once "../Login/loginCheck.php";
require_once "PDF.php";
if(Check() == false)
{
    header("location:  ../login.php");
}
elseif(Check() == true) {

    PDF::PassData();

}
?>

