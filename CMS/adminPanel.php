    <?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/04/16
 * Time: 22:39
 */

   // ini_set('display_errors', 'On');
   // error_reporting(E_ALL);

  //  session_start();



require_once "Login/loginFunc.php";
require_once "Login/logoutFunc.php";
require_once "PDF/PDF.php";
require_once "Login/loginCheck.php";



    //check if logged in
    if(Check() == false)
    {
        header("location:  login.php");
        exit();
    }
    elseif(Check() == true) {

        //if the login is pressed
        if (isset($_POST['logout'])) {

            $logoutC = new LogoutC();

            $logoutC->logout();

            exit;
        }
        require_once "nav.php";


        PDF::PDFList();



        ?>
        <div class="row">
            <div class="col-sm-6">

            <div class="input-group center-block">
                 <form action="upload.php">
                    <input class="form-control" type="submit" value="Upload" name="upload" id="uplaod">
                </form>
            </div>
        </div>
            <div class="col-sm-6 ">
        <!-- form : logout button -->

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="input-group center-block">
                <input class="form-control" type="submit" name="logout" value="Logout">
            </div>
        </form>
        </div>
        </div>
        <!-- close form : logout button -->

        <?php

    //close if logged in check
    }
include "footer.php";
?>

