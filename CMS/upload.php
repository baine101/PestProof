<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18/04/16
 * Time: 09:42
 */
ini_set('display_errors', 'On');
error_reporting(E_ALL);


require_once "Login/loginCheck.php";
require_once "Login/loginFunc.php";
require_once "Login/logoutFunc.php";
require_once "PDF/PDF.php";


if(Check() == false)
{
    header("location:  login.php");
    exit();
}
elseif(Check() == true) {

    if(isset($_POST['logout'])){
        $logoutC = new LogoutC();
        //  EditFile::Edit();
        $logoutC->logout();
    }
    if(isset($_POST['cancel'])){
        header("location: adminPanel.php");
    }

    //if the login is pressed
    if (isset($_POST['logout'])) {

        $logoutC = new LogoutC();

        $logoutC->logout();

        exit;
    }
        require_once "nav.php";
    ?>

    <nav class="floating-menu">
        <h3 class="text-center">Admin Panel</h3>
        <form action="adminPanel.php" method="post">
            <input class="btn-submit btn-primary form-control" type="submit" value="Cancel" name="cancel" id="cancel">
        </form>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="center-block">
                <input class="btn-submit btn-primary form-control" type="submit" name="logout" value="Logout">
            </div>
        </form>

    </nav>
    <main>
    <br>

    <div class="box2 container">
    <div class='well col-lg-12'>
        <h2 align='center'>Upload a File</h2>
    </div>
    <br>

    <div class="container">
    <?php  if(isset($_POST['upload'])){

        //  EditFile::Edit();
        PDF::insert();
    }
    ?>
    </div>


<div class="row">
    <!-- input form for upload-->
    <div class="container">
    <div class="col-lg-10 center-block text-center">

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <div class="col-lg-offset-5 input-group">
                <span class="input-group-addon" id="Title">Title</span>
                <input class="form-control" type="text" name="Title" placeholder="Title"/>
            </div>
            <br>
            <div class="col-lg-offset-5 input-group">
                <span class="input-group-addon" id="Info">Information</span>
                <textarea class="form-control" type="text" name="Info" placeholder="Info"/></textarea>
            </div>
            <br>


            <div class="col-lg-offset-5 input-group">
                <span class="input-group-addon" id="Cat">Category</span>
                <select class="form-control" name="Cat">

                    <?php
                    //set variable as array produced from CatArrayF()
                    $catArray = PDF::CatArrayF();

                    //count the 10 array objects
                    for ($a1 = 0; $a1 < 10; $a1++) {
                        //count the vars in inner array
                        for ($row = 1; $row < 2; $row++) {
                            var_dump($catArray[$a1][$row]);

                            echo "<option name='" . $catArray[$a1][0] . "' value='" . $catArray[$a1][0] . "'>" . $catArray[$a1][1] . "</option>";

                            //close for row
                        }
                        //close for a1
                    }
                    ?>
                </select>
            </div>

            <br>

            <div class="col-lg-offset-2 input-group">
                <span class="input-group-btn">
                    <span class="btn btn-default">
                        Upload PDF&hellip; <input type="file" name="UpPDF" placeholder="Select PDF &hellip;" accept="application/pdf, image/jpeg"/>
                    </span>

                </span>
            </div>


            <br>

            <div class="col-lg-offset-5 input-group">

                        <input class="btn-submit form-control" type="submit" name="upload" value="Upload PDF">
                <!-- close form : upload button -->
            </div>
        </form>
    </div>

    </div>
    <!--close input form for upload-->
</div>


</div>
</main>

    <?php
    require "footer.php";
}
?>