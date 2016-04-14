<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 06/04/16
 * Time: 23:02
 */
namespace controllers\enquiry;

class Contact{


    public function enquire(){


        if(!isset($_POST['submit'])) {


                header('location: ../index.php?#contact');
            exit;

            //close if isset
        }else{
            //concatenate message body with all params
            $body = "Name : " . $_POST['name'] ."Phone : ". $_POST['phone'] ."Email : ". $_POST['email'] ."Message : ". $_POST['message'];
            //word wrap if more than 70 characters
            $msg = wordwrap($body, 70);

            //send mail
            mail('awaine93@hotmail.co.uk', $_POST['name'], $msg, "FROM : " . $_POST['name']);

            echo "<div class='btn-submit'>Your enquiry has been sent , We will be in touch shortly</div>";
            header('location: ../index.php?#contact');
            exit;
        }


        //close function contact
    }


    //close class
}

if(isset($_POST['submit'])){

    $Contact = new Contact();
    $Contact->enquire();

}
?>