<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/04/16
 * Time: 15:10
 */


class loginFunc{


    public function login($username, $password)
    {
        if(!empty($username) && !empty($password)){

                //if the user and password matches the hardcoded values
                if($username === ADMIN_USER && $password === ADMIN_PASSWORD){
                    session_start();
                    //hash the password to store in session
                    $passCrypt = password_hash($password , PASSWORD_BCRYPT);


                    //set session variables
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $passCrypt;


                    header("location: adminPanel.php");
                    exit;

                }else{
                    echo"Your username or password is incorrect";
                    return false;
                }

            //validation for form
        }elseif(!empty($username) or !empty($password))
        {
            echo "<br><br><br>";
            echo "Please fill out both fields";

            //close else
         return false;
        }

        return true;
    //close function login
    }


//close class
}



