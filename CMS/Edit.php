<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once "nav.php";
require_once "Login/loginCheck.php";
require_once "Login/logoutFunc.php";
require_once "PDF/PDF.php";

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


    echo "<div class='well'>
<h2 align='center'>You are editing the ".$str." file record, from the".$CurrentCat ." Category</h2></div>";

?>

<div class="container">

<!-- form input for edit -->
    <div class="col-lg-6">

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
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
                <input class="form-control" type="submit" name="Update" value="Update PDF">
            </div>
        </form>
        <!-- close form input for edit-->
                <?php

                class EditFile
                {
                    static function Edit()
                    {

                        $CurrentID = $_GET['CurrentID'];
                        $CurrentTitle = $_GET['CurrentTitle'];
                        $CurrentInfo = $_GET['CurrentInfo'];
                        $CurrentCat = $_GET['CurrentCat'];
                        $CurrentPath = $_GET['CurrentPath'];
                        $CurrentFileName = $_GET['CurrentFileName'];
                        $CurrentFileType = $_GET['CurrentFileType'];

                        $ID = $_GET['CurrentID'];


                        //set file path string
                       // $path = $_GET['CurrentPath'];
                       // $fileType = $_GET['CurrentFileType'];

                      //  $fullPath = "PDF/" . "$path" . "." . "$fileType";

                      //  $targetFilePath = str_replace(' ', '', $fullPath);


                        //set variable as array produced from CatArrayF()
                        $catArray = PDF::CatArrayF();
                        global $catArrayCat ,$uploadOk;

                        //count the 10 array objects
                        for ($a1 = 0; $a1 < 10; $a1++) {

                            //count the vars in inner array
                            for ($row = 1; $row < 2; $row++) {
                                echo "<br>";
                                var_dump($catArray[$a1][0]);
                                var_dump($CurrentCat);
                                $CurrentCat = str_replace(" ","",$CurrentCat);


                                $catArrayCat = $catArray[$a1][0];


                                //close for row
                            }

                            if($catArrayCat === $CurrentCat){
                                echo"match";
                                break;
                            }
                            //close for a1
                        }


//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

                        //connect to DB
                        try {
                            $conn = new PDO("mysql:host=localhost;dbname=Pestproof", 'baine101', 'blink182');
                            // set the PDO error mode to exception
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            //set sql query string
                            $SQLQ = $conn->prepare("SELECT * FROM PDF WHERE ID ='$ID'");
                            //run query
                            $SQLQ->execute();

                            while ($result = $SQLQ->fetchAll(PDO::FETCH_ASSOC)) {

                                $sqlFullPath = "PDF/" . $result[0]['Path'] . "." . $result[0]['FileType'];

                                if (file_exists($sqlFullPath)) {

                                    // if theirs a file uploaded use that path
                                    if(!empty($_FILES['UpFile']['name'])) {

                                        $fileName = basename($_FILES["UpFile"]["name"]);

                                        if(unlink($sqlFullPath)) {

                                            //upload file snippet
                                            $fileName = str_replace(" ", "_", $fileName);
                                            $UpPath = "PDF/Category/" . $CurrentCat . "/" . $fileName;
                                            $UpPath = str_replace(" ", "", $UpPath);
                                            $fileNameNoExt = $targetWithoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $fileName);
                                            $fileExt =  pathinfo($fileName,PATHINFO_EXTENSION);

                                            echo $UpPath;

                                            if(file_exists($UpPath)){

                                            echo "<br><div class='alert alert-danger'>
                                        <strong>Error!</strong> The file name " . $fileName . " is allready in use, please change the file name.
                                        </div>";

                                            //close if new file exists (UpPath)
                                            }else{

                                            //uploads the file and cecks if the file uploaded
                                            if (move_uploaded_file($_FILES["UpFile"]["tmp_name"], $UpPath)) {
                                                //prints that the file has been uploaded to dir
                                                echo "<br><div class='alert alert-success'>
                                        <strong>Success!</strong> The file " . $fileName . " has been uploaded to " . $CurrentCat . "
                                        </div>";
                                                $uploadOk = 1;

                                                return true;

                                            } else {
                                                echo "<br><div class='alert alert-danger'>
                                        <strong>Error!</strong> Sorry, there was an error uploading your file.
                                     </div>";
                                                $uploadOk = 0;
                                                return false;

                                                //close if move uploaded file
                                            }
                                         //close else if new file exists
                                        }
                                            //update sql

                                            $title = $_POST['Title'];
                                            $info = $_POST['Info'];
                                            $path = $CurrentCat."/";

                                            try{
                                                //connect to DB
                                                $conn = new PDO("mysql:host=localhost;dbname=Pestproof", 'baine101', 'blink182');
                                                // set the PDO error mode to exception
                                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                //update query
                                                $SQLU = "UPDATE PDF SET Title = '$title', Info = '$info', Cat = '$CurrentCat',Path = '$UpPath', FileName = '$fileNameNoExt', FileType = '$fileExt' ";
                                                $conn->exec($SQLU);
                                                echo "updated SQL";

                                                //close try
                                            } catch(PDOException $e)
                                            {
                                                echo $e->getMessage();
                                                return false;
                                            }




                                        //close if unlink
                                        }else{
                                            echo "error Updataing file";
                                        //close else  if(unlink ...
                                        }



                                    //close if file selected to upload
                                    }elseif(empty($_FILES['UpFile']['name'])) {
                                        //^^^ if theirs no file uploaded just update the sql



                                        $title = $_POST['Title'];
                                        $info = $_POST['Info'];
                                        $path = $CurrentCat."/";
                                        $path = str_replace(" ","",$path);
                                        $uploadPath = "PDF/Category/".$path;
                                        $uploadPath = str_replace(" ","",$uploadPath.$CurrentFileName);


                                        //insert into DB
                                        try {
                                            //DB confing
                                            $conn = new PDO("mysql:host=localhost;dbname=Pestproof", 'baine101', 'blink182');
                                            // set the PDO error mode to exception
                                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                            //set sql query string
                                            $SQLU ="UPDATE PDF SET Title = '$title', Info = '$info' WHERE ID = '$ID'";
                                            //$stmt = $conn->prepare($SQLU);
                                            //$stmt->bindParam(':title',$title, PDO::PARAM_STR);
                                            //$stmt->bindParam(':info',$info, PDO::PARAM_STR);
                                            //$stmt->bindParam(':ID',$ID, PDO::PARAM_STR);
                                            $conn->exec($SQLU);
                                            echo "updated SQL";
                                        } catch (PDOException $e)
                                        {
                                            echo     $e->getMessage();
                                            //close sql update try/catch
                                        }


                                    //close elseif empty($_FILES ...
                                    }


                                //else if file ($sqlFullPath) dosent exist
                                } else {
                                    echo "<br><div class='alert alert-danger'>
                                        <strong>Error!</strong> The File was not found.
                                     </div>";
                                    //close if file exists else
                                }

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

                                //close while $col loop
                            }
                            //close try
                        } catch (PDOException $e) {
                            echo $conn . "<br>fail:" . $e->getMessage();

                        }


                        //close function edit()
                    }
                }
                //**********************************************************************************************************************


                if(isset($_POST['Update'])){
                echo "ello moffo";

                    EditFile::Edit();

                }

                ?>



    </div>


    <div class="col-lg-2">
        <div class="well">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="input-group">
                <input class="form-control" type="submit" name="logout" value="Logout">
            </div>
            </form>
        </div>
    </div>
</div>





<?php


//close if check
}
require_once "footer.php";
?>

