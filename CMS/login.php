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

//DB connect
$conn = new dbconfig();
$conn->connect();


//new instance of loginCheck : check if logged in
$loginCheck = new loginCheck();
$loginCheck->Check();



// if login button is pressed
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // create new instance of loginCheck and login function
    $loginFunc = new loginFunc;
    $loginFunc->login($username, $password);


//close if isset
}else{

    echo "please enter your username and password";
}
?>



<br>
<br>
<br>
<br>
<br>



<form action="login.php" method="post">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" placeholder="Admin Username"><br>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Admin Password"><br><br>
    <input type="submit" value="Login" name="login" id="login">
</form>


<?php
require "footer.php"
?>
