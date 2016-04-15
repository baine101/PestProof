<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/04/16
 * Time: 16:07
 */


ini_set('display_errors', 'On');
error_reporting(E_ALL);
include "../dbConfig.php";

//set variables used for file upload
$target_dir = "";
$target_file ="";
$target_file = $target_dir . basename($_FILES["UpPDF"]["name"]);
$uploadOk = 1;
$FileType = pathinfo($target_file,PATHINFO_EXTENSION);

$targetWithoutExt = str_replace(' ', '_', $target_file);

//validates and stores files
function upload()
{

    global $target_dir, $target_file , $uploadOk ,$FileType ,$targetWithoutExt;


    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
        //close if file_exists
    }else{

//************************************
        //check file extension
        if($uploadOk =1)
        {

            // Allow certain file formats
            if($FileType != "jpg" && $FileType != "jpeg" && $FileType != "PDF") {
                echo "Sorry, only JPG, JPEG and PDF files are allowed.";
                $uploadOk = 0;
            }
            //close if uploadOk = 1
        }

//************************************
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok run upload func
        } else
        {

            if (move_uploaded_file($_FILES["UpPDF"]["tmp_name"], $targetWithoutExt)) {
                echo "The file ". basename( $_FILES["UpPDF"]["name"]). " has been uploaded.";
                PDF::insert();
            } else
            {
                echo "Sorry, there was an error uploading your file.";
                //close if move uploaded file
            }
        }

        //close if file exists
    }

//close UPValidate Func
}

    function CatArrayF()
    {


        $CatArray= array(
                         ["SSOF" , "Safe Systems of Work"],
                         ["COSHH" ,"COSHH Information"],
                         ["MSDS" , "Manufactures Safety Data Sheets"],
                         ["Insurance" , "Insurance Documents"],
                         ["HSEP" , "Health & Safety and Environment Policy"],
                         ["TrainDocs" , "Training Documents"],
                         ["Certs" , "Certificates"],
                         ["Stationary" , "Stationary"],
                         ["PestSum" , "Pesticide Summary"],
                         ["PestFact" , "Pesticide Facts Sheets"]
                        );


            return $CatArray;
    //close CatArrayF function
    }


    class PDF
    {

        public $Category;
        

        public static function insert()
        {
            global $target_dir, $target_file , $uploadOk ,$FileType;

            //new instance of CatarrayF function
            $catArray = CatArrayF();

            $UploadFileName = $_FILES['UpPDF']['name'];
            $catSelect = $_POST['Cat'];
            echo"<br>";
            echo"<br>";

            //count
            for ($i = 0; $i < 10; $i++) {

                $CatSear = array_search($catSelect, $catArray[$i]);

                if($CatSear == true){

                    //get array value (ie:"SSOF") from index number
                    $category = $catArray[$i][0];
                    //set file path to place file
                    $target_dir = "Category/".$category ."/";
                    $target_file = $target_dir . basename($_FILES["UpPDF"]["name"]);
                    //set post values for DB
                    $title = $_POST['Title'];
                    $info = $_POST['Info'];

                    $FE = new SplFileInfo($_FILES["UpPDF"]["name"]);
                    $fileExt= $FE->getExtension();

                    $targetWithoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $target_file);
                    $targetWithoutExt = str_replace(' ', '_', $targetWithoutExt);


                    //code here **********************************


                    //connect to DB
                    $conn = new dbconfig();
                    $conn = $conn->connect();

                    $sql= "";


                    try {
                        $conn = new PDO("mysql:host=localhost;dbname=Pestproof", 'baine101', 'blink182');
                        // set the PDO error mode to exception
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "INSERT INTO PDF (Title, Info, Cat, Path, Filetype) VALUES ( '$title', '$info', '$category', '$targetWithoutExt', '$fileExt')";
                        //$sql->bindParam(':title', $title);
                        //$sql->bindParam(':info', $info);
                        //$sql->bindParam(':category', $category);
                        //$sql->bindParam(':targetWithoutExt', $targetWithoutExt);
                        //$sql->bindParam(':fileExt', $fileExt);


                        // use exec() because no results are returned
                        $conn->exec($sql);

                        echo "New record created successfully";
                    }
                    catch(PDOException $e)
                    {
                        echo $sql . "<br>fail:" . $e->getMessage();
                    }







                    break;
                //close if $key = true
                }
               //close for $a1
               }

            //return true;
        //close Upload Func
        }

        public static function Edit()
        {
            //delete old pdf
            //upload new pdf
            //change title,info


            //close Edit func
        }

        public static function Delete()
        {
            //get PDF path location
            //delete table row for  $ID
            //

            //close Delete func
        }
//close class PDF
    }

CatArrayF();

//new instance of PDf class
$PDF = new PDF;

if(isset($_POST['Upload'])){

    PDF::insert();
}









