<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/04/16
 * Time: 16:07
 */
//use dbconnect\dbconnect;

ini_set('display_errors', 'On');
error_reporting(E_ALL);


//***********************************************************************************************************************
    function CatArrayF()
    {


        $CatArray = array(
            ["SSOF", "Safe Systems of Work"],
            ["COSHH", "COSHH Information"],
            ["MSDS", "Manufactures Safety Data Sheets"],
            ["Insurance", "Insurance Documents"],
            ["HSEP", "Health & Safety and Environment Policy"],
            ["TrainDocs", "Training Documents"],
            ["Certs", "Certificates"],
            ["Stationary", "Stationary"],
            ["PestSum", "Pesticide Summary"],
            ["PestFact", "Pesticide Facts Sheets"]
        );


        return $CatArray;
        //close CatArrayF function
    }

//set variables used for file upload
$targetDir = "";
$targetFile ="";
$targetFile = $targetDir . basename($_FILES["UpPDF"]["name"]);

$uploadOk = 1;
$fileType = pathinfo($targetFile,PATHINFO_EXTENSION);

    class PDF
    {


        public $Category;
        protected $targetDir;
        protected $targetFile;
        protected $uploadOk;
        protected $fileType;
        protected $targetNospace;


//***********************************************************************************************************************
//validates and stores files
    public static function upload()
    {

        global $targetDir, $targetFile , $uploadOk ,$fileType ,$targetNospace;

        $targetNospace = str_replace(' ', '_', $targetFile);

        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;

            return false;
            //close if file_exists
        }else{

//************************************
            //check file extension
            if($uploadOk = 1)
            {

                // Allow certain file formats
                if($fileType != "jpg" && $fileType != "jpeg" && $fileType != "PDF") {
                    echo "Sorry, only JPG, JPEG and PDF files are allowed.";
                    echo "<br>";
                    var_dump($targetNospace);
                    $uploadOk = 0;

                    return false;
                }
                //close if uploadOk = 1
            }

//************************************
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
               return false;
                // if everything is ok run upload func
            } else
            {

                if (move_uploaded_file($_FILES["UpPDF"]["tmp_name"], $targetNospace)) {
                    echo "The file ". basename( $_FILES["UpPDF"]["name"]). " has been uploaded.";
                    return true;
                } else
                {
                    echo "Sorry, there was an error uploading your file.";
                    return false;

                    //close if move uploaded file
                }
            }

            //close if file exists
        }

//close UPValidate Func
    }

//***********************************************************************************************************************
        public static function insert()
        {
            global $targetDir, $targetFile , $fileName;

            //new instance of CatarrayF function
            $catArray = CatArrayF();

          //  $UploadFileName = $_FILES['UpPDF']['name'];
            $catSelect = $_POST['Cat'];
            echo"<br>";
            echo"<br>";

            //count
            for ($i = 0; $i < 10; $i++) {

                $catSear = array_search($catSelect, $catArray[$i]);

                var_dump($catSear);

                echo "<br>";
                if($catSear >= 0){
                    echo "ello";


                    //get array value (ie:"SSOF") from index number
                   $category = $catArray[$i][0];
                    //set file path to place file
                    $targetDir = "Category/".$category ."/";
                    $targetFile = $targetDir . basename($_FILES["UpPDF"]["name"]);
                    $fileName = basename($_FILES["UpPDF"]["name"]);
                    //set post values for DB
                    $title = $_POST['Title'];
                    $info = $_POST['Info'];

                    //get file extension
                    $FE = new SplFileInfo($_FILES["UpPDF"]["name"]);
                    $fileExt= $FE->getExtension();

                    //regex : remove extension and replace spaces with underscores
                    $targetWithoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $targetFile);
                    $targetWithoutExt = str_replace(' ', '_', $targetWithoutExt);




                    $sql= "";


                    try {
                        //connect to DB
                        $conn = new PDO("mysql:host=localhost;dbname=Pestproof", 'baine101', 'blink182');
                        // set the PDO error mode to exception
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "INSERT INTO PDF (Title, Info, Cat, Path, FileName, Filetype) VALUES ( '$title', '$info', '$category', '$targetWithoutExt','$fileName' , '$fileExt')";

                        if(PDF::upload() == true) {

                            // use exec() because no results are returned
                            $conn->exec($sql);
                            echo "New record created successfully";
                        //close if PDF::upload = true
                        }
                    //close try
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
//***********************************************************************************************************************
        public static function Edit()
        {
            //delete old pdf
            //upload new pdf
            //change title,info


            //close Edit func
        }
//***********************************************************************************************************************
        public static function Delete()
        {
            //get PDF path location
            //delete table row for  $ID
            //

            //close Delete func
        }
    //***********************************************************************************************************************
        public static function PDFList()
        {
            //include "../dbConfig.php";

            $catArray = CatArrayF();
            //a1 = cycle through outer array
            for ($a1 = 0; $a1 < 10; $a1++)
            {
                //echo each category HTML
                echo"<h2>".$catArray[$a1][1]."</h2>";

                 //count the vars in inner array
                for ($row = 1; $row < 2; $row++)
            {
                $conn="";

                try {
                    $conn = new PDO("mysql:host=localhost;dbname=Pestproof", 'baine101', 'blink182');
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $ID = $catArray[$a1][0];
                    $value = $catArray[$a1][1];


                    //count all the files in the category/directory
                    $sqlCount= "SELECT COUNT(*) FROM PDF WHERE Cat = '$ID'";
                    $sqlRowCount =  $conn->query($sqlCount);

                    //if their is a row in the DB then :
                    if ($sqlRowCount->rowCount() > 0) {
                        var_dump($sqlRowCount->rowCount());

                        //real sql query that return all values in DB as array
                        $sql= "SELECT * FROM PDF WHERE Cat = '$ID'";
                        $result =  $conn->query($sql);

                        // output data of each row

                        while($row = $result->fetchAll(PDO:: FETCH_ASSOC))
                        {
                            global $str;
                            //loop through the files found
                            for($count = 0; $count <15 ; $count++)
                            {

                                if(isset($row[$count]['FileName'])) {
                                    //set directory path to check if file exists
                                    $dir = "PDF/Category/" . $ID . "/";
                                    $targetFile = str_replace(' ', '_', $row[$count]['FileName']);
                                    $str = $dir . $targetFile;
                                }


                                //if the ID and Title colums are not empty
                                if(!empty($row[$count]["ID"]) && !empty($row[$count]["Title"]) && file_exists($str) )
                                {

                                        //display files HTML
                                        echo "id : " . $row[$count]["ID"] . "<br> Name : " . $row[$count]["Title"] . "<br> Info : " . $row[$count]["Info"] . "<br> Category : " . $row[$count]['Cat'] . "<br> path : " . $row[$count]['Path'] . "<br> ext: " . $row[$count]['FileType'] . "<br> end";
                                        echo "<br>";
                                        echo "<br>";


                                 //!!!!!!!!!!!code stops here when its not suposed to :@ !!!!!!!!!!!!


                                //close if isset $row[$count]["ID"]
                                }
                            //close for count
                            }

                        //close while $row
                        }
                    } else {
                        echo "0 results";
                    }

                }catch(PDOException $e)
                    {
                    echo $conn . "<br>fail:" . $e->getMessage();
                    }

            // close for row
            }
            //close for a1
            }

        //close function PDFList
        }

//close class PDF
    }

CatArrayF();

//new instance of PDf class
$PDF = new PDF;

if(isset($_POST['Upload'])){

    PDF::insert();
    //PDF::PDFList();
}









