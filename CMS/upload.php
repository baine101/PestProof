<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18/04/16
 * Time: 09:42
 */
ini_set('display_errors', 'On');
error_reporting(E_ALL);

session_start();

require "nav.php";
require "Login/loginCheck.php";
require "Login/loginFunc.php";
require "Login/logoutFunc.php";
require "PDF/PDF.php";

//new instance of loginCheck : check if logged in
$loginCheck = new loginCheck();
$loginCheck->Check();

?>
<div class="col-lg-12"><p></p></div>


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
                        $catArray =  CatArrayF();

                        //count the 10 array objects
                        for ($a1 = 0; $a1 < 10; $a1++) {
                            //count the vars in inner array
                            for ($row = 1; $row < 2; $row++) {
                                var_dump($catArray[$a1][$row]);

                                echo "<option name='".$catArray[$a1][0]."' value='".$catArray[$a1][0]."'>".$catArray[$a1][1]."</option>";

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
        <!-- form : logout button -->

        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <div class="input-group">
                <input class="form-control" type="submit" name="logout" value="Logout">
            </div>
                </form>

        <!-- close form : logout button -->
    </div>
<br>    
    <?php
require "footer.php";
?>