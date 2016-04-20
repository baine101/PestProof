<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/04/16
 * Time: 14:43
 */


session_start();

require "dbConfig.php";
require "nav.php";
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




    ?>

<br>
    <br>
    <br>

    <!-- Start Login Panel -->
    <div class='form-wrapper row'>
        <h1 class='header-fancy'> Pestproof Admin </h1>
        <!-- Left side column -->
        <div class="col-md-4"></div>
        <!-- Middle Column -->
        <div class="col-md-4">
            <!-- Start of login form -->
            <form action="login.php" method="post" class='login-form'>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class='form-control' name="username" id="username" placeholder="Admin Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class='form-control' name="password" id="password" placeholder="Admin Password">
                </div>
                <input type="submit" class="btn btn-default" value="Login" name="login" id="login"/>
            </form>
            <!-- End of login form -->

        </div>
        <!-- Right side column -->
        <div class="col-md-4"></div>
    </div>
    <!-- End Login Panel -->



    <?php

//close ifelse logged in check
}

require "footer.php"
?>
