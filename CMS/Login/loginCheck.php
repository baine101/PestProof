<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/04/16
 * Time: 23:36
 */





     function Check()
    {

        if(isset($_SESSION['username']) && isset($_SESSION['password']) )
        {
            return true;
        }else{
            return false;
        }

   //close func Check
    }

