<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);


require_once "Login/loginCheck.php";
require_once "Login/logoutFunc.php";
require_once "PDF/PDF.php";
require_once "PDF/EditClass.php";

//public $CurrentID, $CurrentTitle, $CurrentInfo, $CurrentCat, $CurrentPath, $CurrentFileType;

//check if logged in
if(Check() == false)
{
    header("location:  login.php");
    exit();
}
elseif(Check() == true) {

    //if the login is pressed
    if (isset($_POST['logout'])) {

        $logoutC = new LogoutC();

        $logoutC->logout();

        exit;
    }

    if(isset($_POST['cancel'])){
        header("location: adminPanel.php");
    }
    require_once "nav.php";
    $CurrentID = $_GET['CurrentID'];
    $CurrentTitle = $_GET['CurrentTitle'];
    $CurrentInfo = $_GET['CurrentInfo'];
    $CurrentCat = $_GET['CurrentCat'];
    $CurrentPath = $_GET['CurrentPath'];
    $CurrentFileName =$_GET['CurrentFileName'];
    $CurrentFileType = $_GET['CurrentFileType'];

    $str = $CurrentTitle .".". $CurrentFileType;
    $str = str_replace(" ","" ,$str);

    ?>

 <br>
    <nav class="floating-menu">
        <h3 class="text-center">Admin Panel</h3>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <input class="btn-submit btn-primary form-control" type="submit" value="Cancel" name="cancel" id="cancel">
        </form>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="center-block">
                <input class="btn-submit btn-primary form-control" type="submit" name="logout" value="Logout">
            </div>
        </form>

    </nav>

<div id="wrapper">
<div class="container box2">
    <?php
    echo "<div class='center-block well'>
            <h2 align='center'>You are editing the ".$str." file record, from the".$CurrentCat ." Category</h2></div>";

        if(isset($_POST['Update'])){
        EditFile::Edit();
        }
    ?>
<br>


<div class="row">
    <div class="container">

        <div class="row">
        <!-- form input for edit -->
        <div class="col-lg-10 center-block">

            <form action="PDF/EditClass.php" method="POST" enctype="multipart/form-data">
                <div class="col-lg-offset-5 input-group">
                    <span class="input-group-addon" id="Title">Title</span>
                    <input class="form-control" type="text" name="Title" value="<?php echo $CurrentTitle; ?>"/>
                </div>
                <br>
                <div class="col-lg-offset-5 input-group">
                    <span class="input-group-addon" id="Info">Information</span>
                    <input class="form-control" type="text" name="Info" value="<?php echo $CurrentInfo ?>"/>
                </div>

                <br>

                <div class="col-lg-offset-5 input-group">
                <span class="input-group-btn">
                    <span class="btn btn-default">
                        Upload File&hellip; <input type="file" class="btn-file" name="UpFile" placeholder="Select file &hellip;" accept="application/pdf, image/jpeg" value="<?php echo $str ?>">
                    </span>

                </span>
                </div>


                <br>

                <div class="col-lg-offset-5 input-group">
                    <input class="btn-submit form-control" type="submit" name="Update" value="Update PDF">
                </div>
            </form>

        </div>
            <!-- close form input for edit-->




        </div>

    </div>
    </div>
    </div>
    </div>
<br>


    <?php


//close if check
}
require_once "footer.php";
?>

