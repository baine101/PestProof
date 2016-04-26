<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 06/04/16
 * Time: 23:02
 */

class Contact{


    public function enquire(){


            //concatenate message body with all params
            $body = "\r\nName :" . $_POST['name'] ."\r\nPhone : ". $_POST['phone'] ."\r\nEmail : ". $_POST['email'] ."\r\nMessage : ". $_POST['message'];
            //word wrap if more than 70 characters
            $msg = wordwrap($body, 70);

            //send mail
            mail('info@pestproof.co.uk', $_POST['name'], $msg, "FROM : " . $_POST['name']);
            mail($_POST['email'],'Enquiry Recived' , 'Your enquiry has been recived and we will reply as soon as possible.' );

            echo "<div class='btn-submit'>Your enquiry has been sent , We will be in touch shortly</div>";
            header('location: ../index.php?#contact');
            exit;

        //close function contact
    }


    //close class
}

if(isset($_POST['submit'])){

    $Contact = new Contact();
    $Contact->enquire();

}
?>