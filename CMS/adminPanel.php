    <?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/04/16
 * Time: 22:39
 */

   // ini_set('display_errors', 'On');
   // error_reporting(E_ALL);

    session_start();


require "nav.php";
require "Login/loginCheck.php";
require "Login/loginFunc.php";
require "Login/logoutFunc.php";
require "PDF/PDF.php";

    //new instance of loginCheck : check if logged in
    $loginCheck = new loginCheck();
    $loginCheck->Check();

    //new loginFunc instance
    $logFunc = new loginFunc();

    //if the login is pressed
    if(isset($_POST['logout'])) {

       logout();

        exit;
    }
?>

<br>
<br>
<br>
<br>
<br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <br>
    <br>
    <br>
    <br>
    <br>

    <br>
    <br>
    <br>
    <br>
    <br>





    <div class="col-lg-12">
    <a href="upload.php">Upload PDF</a>







    </div>


    <!-- form : logout button -->

        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <div class="input-group">
                <input class="form-control" type="submit" name="logout" value="Logout">
            </div>
        </form>

    <!-- close form : logout button -->


<?php
include "footer.php";
?>