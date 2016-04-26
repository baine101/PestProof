<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);


require_once "Login/loginCheck.php";
require_once "Login/logoutFunc.php";
require_once "PDF/PDF.php";
require_once "PDF/EditClass.php";
require_once "nav.php";
//public $CurrentID, $CurrentTitle, $CurrentInfo, $CurrentCat, $CurrentPath, $CurrentFileType;

//check if logged in
if(Check() == false)
{
    header("location:  login.php");
    exit();
}
elseif(Check() == true) {

    if(isset($_POST['logout'])){
        logout();
    }
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
    <br>
    <br>
 <br>

<div id="wrapper"></div>

    <?php
    echo "<div class='center-block container'> <div class='well'>
            <h2 align='center'>You are editing the ".$str." file record, from the".$CurrentCat ." Category</h2></div></div>";

        if(isset($_POST['Update'])){
        EditFile::Edit();

    }
    ?>
<br>


<div class="row">
    <div class="container">

        <div class="row">
        <!-- form input for edit -->
        <div class="col-lg-6 background-1">

            <form action="PDF/EditClass.php" method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <span class="input-group-addon" id="Title">Title</span>
                    <input class="form-control" type="text" name="Title" value="<?php echo $CurrentTitle; ?>"/>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon" id="Info">Information</span>
                    <input class="form-control" type="text" name="Info" value="<?php echo $CurrentInfo ?>"/>
                </div>

                <br>

                <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-primary btn-file">
                        Upload File&hellip; <input type="file" name="UpFile" placeholder="Select file &hellip;"
                                                   accept="application/pdf, image/jpeg" value="<?php echo $str ?>"/>
                    </span>

                </span>
                </div>


                <br>

                <div class="input-group">
                    <input class="btn-custom btn-primary form-control" type="submit" name="Update" value="Update PDF">
                </div>
            </form>

            <!-- close form input for edit-->




        </div>
            <div class="col-lg-2">
                    <div class="well well-lg"> <div class="btn-group">
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                <input class="btn-custom btn-primary form-control" type="submit" name="logout" value="Logout">
                                <input class="btn-custom btn-primary form-control" type="submit" name="cancel" value="Cancel">
                        </form>
                    </div>
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

