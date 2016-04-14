<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/04/16
 * Time: 16:07
 */



ini_set('display_errors', 'On');
error_reporting(E_ALL);



$target_dir = "Cat1/";
$target_file ="";
$target_file = $target_dir . basename($_FILES["UpPDF"]["name"]);
$uploadOk = 1;
$FileType = pathinfo($target_file,PATHINFO_EXTENSION);






//validates and stores files
function UPValiate()
{

    global $target_dir, $target_file , $uploadOk ,$FileType;


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
// if everything is ok, try to upload file
        } else
        {
            if (move_uploaded_file($_FILES["UpPDF"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["UpPDF"]["name"]). " has been uploaded.";
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
                         ["Stationary" , "Statonary"],
                         ["PestSum" , "Pesticide Summary"],
                         ["PestFact" , "Pesticide Facts Sheets"]
                         );


            return $CatArray;

    }


    class PDF
    {

        public $Category;
        public $CS;

        public static function Upload()
        {
            //new instance of CatarrayF function
            $CatArray = CatArrayF();

            //run UPValidate - validates and stores file
            UPValiate();


            echo"<br>";

            //count
            for ($i = 0; $i < 1; $i++) {
                for($v =0; $v <10; $v++){

                        $CatArrayV = $CatArray[$v];

                    var_dump($CatArrayV);
                    echo "<br>";
                        //get array id from value
                        //$arrayKey=array_search('', array_column($CatArray, ''));



                //close for $v
                }
                //close for $a1
               }







            return true;
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

    PDF::Upload();
}









