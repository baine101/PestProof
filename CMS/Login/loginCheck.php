<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/04/16
 * Time: 23:36
 */

ob_start();

class loginCheck
{

    public function Check()
    {

        if(!isset($_SESSION['username']) && !isset($_SESSION['password']) )
        {
            header("location: ../login.php");
            return false;
        }

    return false;
   //close func Check
    }

// close class
}