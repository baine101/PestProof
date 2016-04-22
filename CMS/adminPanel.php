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


require "nav.php";
require "Login/loginFunc.php";
require "Login/logoutFunc.php";
require "PDF/PDF.php";
require "Login/loginCheck.php";

    //check if logged in
    if(Check() == false)
    {
        header("location:  login.php");
        exit();
    }
    elseif(Check() == true) {

echo "<br><br><br><br>";

        PDF::PDFList();

        //if the login is pressed
        if (isset($_POST['logout'])) {

            logout();

            exit;
        }

        ?>

        <div class="col-lg-6 right">
            <div class="input-group">
                <form action="upload.php">
                    <input class="form-control" type="submit" value="Upload" name="upload" id="uplaod">
                </form>


            </div>
        </div>

        <!-- form : logout button -->

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="input-group">
                <input class="form-control" type="submit" name="logout" value="Logout">
            </div>
        </form>

        <!-- close form : logout button -->

        <?php

    //close if logged in check
    }
include "footer.php";
?>

