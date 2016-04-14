<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/04/16
 * Time: 14:44
*/
class dbconfig{

    public $ADMIN_PASSWORD;

 public function connect()
 {
     define("DB_DSN", "mysql:host=localhost;dbname=Pestproof");
     define("DB_USERNAME", "root");
     define("DB_PASSWORD", "blink182");
     define("ADMIN_USER", "admin");
     define("ADMIN_PASSWORD", "mypass");
     // define("ADMIN_PASSWORD", "a029d0df84eb5549c641e04a9ef389e5");


     return new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);

 //close function connect
 }
//close class
}
?>