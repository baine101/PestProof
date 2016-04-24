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


        //set variable as array produced from CatArrayF()
        $catArray = PDF::CatArrayF();
        global $catArrayCat, $uploadOk;

        //count the 10 array objects
        for ($a1 = 0; $a1 < 10; $a1++) {

            //count the vars in inner array
            for ($row = 1; $row < 2; $row++) {
                echo "<br>";
                $CurrentCat = str_replace(" ", "", $CurrentCat);


                $catArrayCat = $catArray[$a1][0];


                //close for row
            }

            if ($catArrayCat === $CurrentCat) {
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

                //path to file to delete
                $sqlFullPath = "PDF/" . $result[0]['Path'] . "." . $result[0]['FileType'];


                // if theirs a file uploaded use that path
                if (!empty($_FILES['UpFile']['name'])) {

                    $fileName = basename($_FILES["UpFile"]["name"]);

                    global $check;
                    $check = false;

                    //upload file snippet
                    $fileName = str_replace(" ", "_", $fileName);
                    $fileExistsPath = "PDF/Category/" . $CurrentCat . "/" . $fileName;
                    $fileExistsPath = str_replace(" ", "", $fileExistsPath);
                    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

                    //check if file exists - set $check variable to true or false
                    if (file_exists($fileExistsPath)) {

                        echo "<div class='alert alert-danger'>
                                        <strong>Error!</strong> The file name " . $fileName . " is allready in use, please change the file name.
                                        </div>";

                        $check = false;
                        //close if file exists
                    } else {
                        $check = true;
                        //close else if file exists
                    }

                    //build delete path for old file
                    $delPath = "PDF/" . $result[0]['Path'] . "." . $result[0]['FileType'];


                    //if $check == ture  then update sql, delete the old file and upload the new one
                    if ($check == true) {

                        if (unlink($delPath)) {
                            echo "<div class='alert alert-success'>
                                        <strong>Success!</strong> The previous file has been deleted.
                                     </div>";
                        } else {
                            echo "<div class='alert alert-danger'>
                                        <strong>Error!</strong> Sorry, there was an error Deleting the previous file.
                                     </div>";

                        }


                        //uploads the file and cecks if the file uploaded
                        if (move_uploaded_file($_FILES["UpFile"]["tmp_name"], $fileExistsPath)) {
                            //prints that the file has been uploaded to dir
                            echo "<div class='alert alert-success'>
                                        <strong>Success!</strong> The file " . $fileName . " has been uploaded to " . $CurrentCat . "
                                        </div>";
                        } else {
                            echo "<div class='alert alert-danger'>
                                        <strong>Error!</strong> Sorry, there was an error uploading your file.
                                     </div>";
                            //close if move uploaded file
                        }

                        //update sql

                        $title = $_POST['Title'];
                        $info = $_POST['Info'];
                        $path = $CurrentCat . "/";


                        //upload file path
                        $fileName = str_replace(" ", "_", $fileName);
                        $UpPath = "Category/" . $CurrentCat . "/" . $fileName;
                        $UpPath = str_replace(" ", "", $UpPath);
                        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
                        $UpPathNoExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $UpPath);


                        try {
                            //update query
                            $SQLU = "UPDATE PDF SET Title = '$title', Info = '$info', Cat = '$CurrentCat',Path = '$UpPathNoExt', FileName = '$fileName', FileType = '$fileExt' WHERE ID ='$ID' ";
                            $conn->exec($SQLU);
                            echo "updated SQL";

                            //close try
                        } catch (PDOException $e) {
                            echo $e->getMessage();

                        }


                        //close $check == true
                    } else {
                        echo "<div class='alert alert-danger'>
                                        <strong>Error!</strong> Sorry, there was an error updating your file.
                                     </div>";
                    }


                    //close if file selected to upload
                } elseif (empty($_FILES['UpFile']['name'])) {
                    //^^^ if theirs no file uploaded just update the sql


                    $title = $_POST['Title'];
                    $info = $_POST['Info'];
                    $path = $CurrentCat . "/";
                    $path = str_replace(" ", "", $path);
                    $uploadPath = "PDF/Category/" . $path;
                    $uploadPath = str_replace(" ", "", $uploadPath . $CurrentFileName);


                    //insert into DB
                    try {

                        //set sql query string
                        $SQLU = "UPDATE PDF SET Title = '$title', Info = '$info' WHERE ID = '$ID'";
                        $conn->exec($SQLU);
                        echo "updated SQL";
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                        //close sql update try/catch
                    }

                    //close elseif empty($_FILES ...
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
//close EditFile class
}


?>