<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/04/16
 * Time: 14:44
*/
class dbconfig{

    protected $DB_DSN;
    protected $DB_USERNAME;
    protected $DB_PASSWORD;
    protected $DB_NAME;
    public $ADMIN_USER;
    public $ADMIN_PASSWORD;
    public $DB;

    public function connect()
 {
     $DB_DSN = "localhost";
     $DB_USERNAME = "baine101";
     $DB_PASSWORD =  "blink182";
     $DB_NAME = "Pestproof";

     $DB = new PDO("mysql:host=$DB_DSN;dbname=$DB_NAME",$DB_USERNAME,$DB_PASSWORD);
     $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     //admin panel login
     define("ADMIN_USER", "admin");
     define("ADMIN_PASSWORD", "mypass");
     // define("ADMIN_PASSWORD", "a029d0df84eb5549c641e04a9ef389e5");

     return true;

 //close function connect
 }
//close class
}


?>