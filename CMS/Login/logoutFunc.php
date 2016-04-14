<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/04/16
 * Time: 11:10
 */



    function logout()
        {
            //close session
            session_destroy();
            session_unset();

            //redirect to login page
            header("location: login.php");
            //close func logout
        }


