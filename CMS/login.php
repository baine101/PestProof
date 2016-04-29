<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/04/16
 * Time: 14:43
 */


session_start();

require "dbConfig.php";
require "Login/loginFunc.php";
require  "Login/loginCheck.php";

if(Check() == true)
{
    header("location:  adminPanel.php");
}
elseif(Check() == false) {
     // header("location: login.php");

    // if login button is pressed
    if (isset($_POST['login'])) {

        //if their is values in the username and password
        if (!empty($_POST['username']) && !empty($_POST['password'])) {


            $username = $_POST['username'];
            $password = $_POST['password'];

            // create new instance of loginCheck and login function
            $loginFunc = new loginFunc;
            $loginFunc->login($username, $password);

        } else {

            echo "<br><br><br>";
            echo "please enter your username and password";

            //close if login btn is pressed
        }
//close if isset POST login  button
    }

require "nav.php";
    ?>


        <!-- Start Login Panel -->
    <div class="container">
    <div class='box2 row'>
        <h1 class='text-center header-fancy'> Pestproof Admin </h1>
        <!-- Left side column -->
        <div class="col-md-4"></div>
        <!-- Middle Column -->
        <div class="col-md-4">
            <!-- Start of login form -->
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class='login-form'>
                <div class="form-group">
                    <span class="input-group-addon" id="usename">Username :
                    <input type="text" class='form-control' name="username" id="username" placeholder="Admin Username">
                    </span>
                </div>
                <div class="form-group">
                    <span class="input-group-addon" id="password">Password :
                    <input type="password" class='form-control' name="password" id="password" placeholder="Admin Password">
                    </span>
                </div>
                <input type="submit" class="form-control btn-submit" value="Login" name="login" id="login"/>
            </form>
            <!-- End of login form -->

        </div>
        <!-- Right side column -->
        <div class="col-md-4"></div>
    </div>
    </div>
    <br>
    <!-- End Login Panel -->



    <?php

//close ifelse logged in check
}
require "footer.php"
?>
