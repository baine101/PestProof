<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/04/16
 * Time: 15:10
 */



class loginFunc{

    private $db;

    public function __construct()
    {
        //session_start();
        //$this->db = new dbconfig();
        //$this->db = $this->db->connect();

    }

    public function login($username, $password)
    {
        if(!empty($username) && !empty($password)){



                if($username == ADMIN_USER && $password == ADMIN_PASSWORD){

                    $passCrypt = password_hash($password , PASSWORD_BCRYPT);


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

            echo "Please fill out both fields";

            //close else
         return false;
        }

        return true;
    //close function login
    }


//close class
}



