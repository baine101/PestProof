    <?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/04/16
 * Time: 22:39
 */

    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

    session_start();


require "nav.php";
//require "dbConfig.php";
require "Login/loginFunc.php";
require "Login/logoutFunc.php";
require "PDF/PDF.php";


//new loginFunc instance
$logFunc = new loginFunc();

    //if the login is pressed
    if(isset($_POST['logout'])) {

       logout();

        exit;
    }
?>

<br>
<br>
<br>
<br>
<br>


        <div class="col-lg-6">
            <form action="PDF/PDF.php" method ="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <span class="input-group-addon" id="Title">Title</span>
                    <input class="form-control" type="text" name="Title" placeholder="Title"/>
                </div>
            <br>
                <div class="input-group">
                    <span class="input-group-addon" id="Info">Information</span>
                    <input class="form-control" type="text" name="Info" placeholder="Info"/>
                </div>
            <br>



                <div class="input-group">
                    <span class="input-group-addon" id="Cat">Category</span>
                    <select class="form-control" name="Cat">

                        <?php
                        //set variable as array produced from CatArrayF()
                        $CatArray = CatArrayF();

                        //count the 10 array objects
                        for ($a1 = 0; $a1 < 10; $a1++) {
                            //count the vars in inner array
                            for ($row = 1; $row < 2; $row++) {
                                var_dump($CatArray[$a1][$row]);

                                echo "<option name='".$CatArray[$a1][$row]."' value='".$CatArray[$a1][$row]."'>".$CatArray[$a1][$row]."</option>";

                                //close for row
                            }
                            //close for a1
                        }
                        ?>
                    </select>
                </div>

                <br>

                <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-primary btn-file">
                        Upload PDF&hellip; <input type="file" name="UpPDF" placeholder="Select PDF &hellip;" accept="application/pdf, image/jpeg"/>
                    </span>
                </span>
                </div>



            <br>

                    <div class="input-group">
                        <input class="form-control" type="submit" name="Upload" value="Upload PDF">
                    </div>

            </form>
    </div>

    <div class="col-lg-6">




    </div>


    <!-- form : logout button -->

        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <div class="input-group">
                <input class="form-control" type="submit" name="logout" value="Logout">
            </div>
        </form>

    <!-- close form : logout button -->

<?php
include "footer.php";
?>