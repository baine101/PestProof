<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/04/16
 * Time: 16:07
 */


ini_set('display_errors', 'On');
error_reporting(E_ALL);
session_start();

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



global $currentID;
global $currentTitle;
global $currentInfo;
global $currentCat;
global $currentPath;
global $currentFileType;

    class PDF
    {


        public $Category;
        protected $targetDir;
        protected $targetFile;
        protected $uploadOk;
        protected $fileType;
        protected $targetNoSpace;
        protected $fileExists;


//***********************************************************************************************************************
//validates and stores files
    public static function upload()
    {

        global $category, $targetDir, $targetFile , $uploadOk ,$fileType ,$targetNoSpace;

        //declare catArray as CatArray function
        $catArray = CatArrayF();

        //count category values : ID & Values
          for ($i = 0; $i < 10; $i++) {

               //if the array matches the selected category stop the loop
               if($catArray[$i][0] == $_POST['Cat']) {

                   //get array value (ie:"SSOF") from index number
                   $category = $catArray[$i][0];


                   $uploadOk = 1;
                   break;
               }
            //close for categorgy count loop
            }
        //set variables used for file upload
        $targetDir = "Category/".$category ."/";
        $targetFile ="";
        $targetFile = $targetDir . basename($_FILES["UpPDF"]["name"]);
        $targetNoSpace = str_replace(' ', '_', $targetFile);

        $fileType = pathinfo($targetFile,PATHINFO_EXTENSION);

//************************************/
            //check file extension
            if($uploadOk == 1)
            {

                // Allow certain file formats
                if($fileType != "jpg" && $fileType != "jpeg" && $fileType != "PDF" && $fileType != "pdf") {
                    echo "Sorry, only JPG, JPEG and PDF files are allowed to";

                    $uploadOk = 0;
                   // return false;
                }
                //close if uploadOk = 1
            }

//************************************


        if ($uploadOk == 1) {

            if (file_exists($targetNoSpace)) {

                echo "File allready exists<br>";

                $uploadOk = 0;
                return false;
                //closes if file exists
            }


                //uploads the file and cecks if the file uploaded
                if (move_uploaded_file($_FILES["UpPDF"]["tmp_name"], $targetNoSpace)) {
                    //prints that the file has been uploaded to dir
                    echo "The file " . basename($_FILES["UpPDF"]["name"]) . " has been uploaded to " . $_POST['Cat'] . "<br>";
                    $uploadOk = 1;

                    return true;

                } else {
                    echo "Sorry, there was an error uploading your file.";
                    $uploadOk = 0;
                    return false;

                    //close if move uploaded file
                }// if everything is ok run upload func
                }else
            {
                echo "Sorry, your file was not uploaded.";
                return false;

            }


        //close UPload Func
        }



//***********************************************************************************************************************
        public static function insert()
        {
            global $catSear ,$category ,$targetDir, $targetFile , $fileName;


            //new instance of CatarrayF function
            $catArray = CatArrayF();

            $catSelect = $_POST['Cat'];
            echo"<br>";
            echo"<br>";


                    //count category values : ID & Values
                    for ($i = 0; $i < 10; $i++)
                    {

                        //set file path to place file
                        $targetDir = "Category/".$catSelect ."/";
                        $fileName = basename($_FILES["UpPDF"]["name"]);
                        $targetFile = $targetDir . $fileName;
                        //regex : remove extension and replace spaces with underscore
                        $targetWithoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $targetFile);
                        $targetWithoutExt = str_replace(' ', '_', $targetWithoutExt);


                        if($catSear >= 0){


                            //set post values for DB
                    $title = $_POST['Title'];
                    $info = $_POST['Info'];

                   /*888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888*/

                    //get file extension
                    $FE = new SplFileInfo($_FILES["UpPDF"]["name"]);
                    $fileExt= $FE->getExtension();





                    $sql= "";


                    try {
                        //connect to DB
                        $conn = new PDO("mysql:host=localhost;dbname=Pestproof", 'baine101', 'blink182');
                        // set the PDO error mode to exception
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $sql = "INSERT INTO PDF (Title, Info, Cat, Path, FileName, Filetype) VALUES ( '$title', '$info', '$catSelect', '$targetWithoutExt','$fileName' , '$fileExt')";
                        //PDF::upload($uploadOk) == 0 or
                        $PDFUploadF = PDF::upload();


                        // if the file uploaded sucsessfully
                        if($PDFUploadF == true) {

                               // use exec() because no results are returned
                               $conn->exec($sql);
                                 echo "New record created successfully";
                               echo "<br>";
                               //var_dump($category);


                               return true;
                           //close if PDF::upload = true
                           }else{

                               echo "The file has not uploaded properly please rety ";
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


            return true;
        //close Upload Func
        }

//***********************************************************************************************************************
        public static function Edit()
        {
            //DELME
            var_dump($_POST['ID']);
            echo"<br>";
            var_dump($_POST['Title']);
            echo"<br>";
            var_dump($_POST['Info']);
            echo"<br>";
            var_dump($_POST['Cat']);
            echo"<br>";
            var_dump($_POST['Path']);
            echo"<br>";
            var_dump($_POST['FileType']);
            // /DELME




            //delete old pdf
            //upload new pdf
            //change title,info


            //close Edit func
        }
//***********************************************************************************************************************
        public static function Delete()
        {

            global $ID , $Title , $Info , $Cat , $Path , $FileType;

            //DELME
            var_dump($_POST['ID']);
            echo"<br>";
            var_dump($_POST['Title']);
            echo"<br>";
            var_dump($_POST['Info']);
            echo"<br>";
            var_dump($_POST['Cat']);
            echo"<br>";
            var_dump($_POST['Path']);
            echo"<br>";
            var_dump($_POST['FileType']);
            // /DELME

            $ID = $_POST['ID'];

            //connect to DB
            $conn = new PDO("mysql:host=localhost;dbname=Pestproof", 'baine101', 'blink182');
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM PDF WHERE ID = '$ID'";

            foreach($conn->query($sql) as $row){

                $ID = $row['ID'];
                $PID = $_POST['ID'];
                $Title = $row['Title'];
                $Info = $row['Info'];
                $Cat = $row['Cat'];
                $Path = $row['Path'];
                $FileType =$row['FileType'];

                $fullPath = "PDF/" . $Path . "." . $FileType;
                echo "<br>$fullPath";
                echo "<br>$PID";
                echo "<br>$ID";

                //delete if file exists
                if(file_exists($fullPath) == true)  {
                    // set query
                    $sqlDel = "DELETE FROM PDF WHERE ID ='$PID'";
                   //delete row from DB
                    $conn->exec($sqlDel);
                    if(unlink($fullPath)){
                        echo "File deleted";
                    }




                //close if file exists
                }
            //close foreach sql
            }



            //close Delete func
        }
    //***********************************************************************************************************************

  //check if logged in function
    static function Check()
    {

        if(isset($_SESSION['username']) && isset($_SESSION['password']) )
        {
            return true;
        }else{
            return false;
        }

        //close func Check
    }

    //***********************************************************************************************************************


        public static function PDFList()
        {
            //require_once "../Login/loginCheck.php";

            $catArray = CatArrayF();
            //a1 = cycle through outer array
            for ($a1 = 0; $a1 < 10; $a1++)
            {
                //echo each category title HTML
                echo" <div class='panel-custom'></div> <div class='panel-heading'><h3 class='panel-title'>".$catArray[$a1][1]."</h3></div></div>";

                 //count the vars in inner array
                for ($row = 1; $row < 2; $row++)
            {
                $conn="";

                try {
                    $conn = new PDO("mysql:host=localhost;dbname=Pestproof", 'baine101', 'blink182');
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $ID = $catArray[$a1][0];



                    //count all the files in the category/directory
                    $sqlCount= "SELECT COUNT(*) FROM PDF WHERE Cat = '$ID'";
                    $sqlRowCount =  $conn->query($sqlCount);

                    //if their is a row in the DB then :
                    if ($sqlRowCount->rowCount() > 0) {

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
                                if(!empty($row[$count]["ID"]) && !empty($row[$count]["Title"]) )
                                {
                                    $catTitle = implode($row[$count]);
//display files HTML@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@


                                    //set variables as string
                                    $ID = $row[$count]['ID'];
                                    $Title = $row[$count]['Title'];
                                    $Info = $row[$count]['Info'];
                                    $Cat = $row[$count]['Cat'];
                                    $Path = $row[$count]['Path'];
                                    $FileType = $row[$count]['FileType'];


                                    //  data-target='#". $catTitle."'    data-toggle='collapse'
               echo "
					  <div class='panel-body'>
			            <form method='post'><input class='btn btn-custom form-control' type='submit' aria-expanded='false' name='file' id='file' value='" . $row[$count]["Title"] . "'>
					    <input type='hidden' name='ID' value=' ".$ID ." '>
                        <input type='hidden' name='Title' value=' ". $Title." '>
                        <input type='hidden' name='Info' value=' ".$Info ." '>
                        <input type='hidden' name='Cat' value=' ". $Cat." '>
                        <input type='hidden' name='Path' value=' ".$Path ." '>
                        <input type='hidden' name='FileType' value=' ".$FileType ." '>
					    </form>
					   <div class='well text-center'><h2>Information</h2>
					" . $row[$count]["Info"] . " <br>";

                                    //if admin logged in display delete buttons
                                    if(PDF::Check() == true){
                                        //set curent page and check page
                                        $adminpanel = "/CMS/adminPanel.php";
                                        $currentPage = $_SERVER['REQUEST_URI'];;

                                        //if on admin panel page
                                        if($currentPage == $adminpanel) {

                                            echo "<br>";

                                            //set variables as string
                                            $ID = $row[$count]['ID'];
                                            $Title = $row[$count]['Title'];
                                            $Info = $row[$count]['Info'];
                                            $Cat = $row[$count]['Cat'];
                                            $Path = $row[$count]['Path'];
                                            $FileType = $row[$count]['FileType'];


                                            //EDIT BUTTON - set hidden inputs for each collum name
                                          //  echo "<div class='col-lg-6'>";
                                            echo "<form method='post'>";
                                            echo "<input type='hidden' name='ID' value=' ".$ID ." '> ";
                                            echo "<input type='hidden' name='Title' value=' ". $Title." '> ";
                                            echo "<input type='hidden' name='Info' value=' ".$Info ." '> ";
                                            echo "<input type='hidden' name='Cat' value=' ". $Cat." '> ";
                                            echo "<input type='hidden' name='Path' value=' ".$Path ." '> ";
                                            echo "<input type='hidden' name='FileType' value=' ".$FileType ." '> ";

                                            //EDIT BUTTON
                                            echo "<input class='btn btn-custom form-control' type='submit' value='Edit' name='edit' id='edit'></form>";
                                           // echo "</div>";


                                            //DELETE BUTTON - set hidden inputs for each collum name
                                           // echo "<div class='col-lg-6'>";
                                            echo "<form method='post'>";
                                            echo "<input type='hidden' name='ID' value=' ".$ID ." '> ";
                                            echo "<input type='hidden' name='Title' value=' ". $Title." '> ";
                                            echo "<input type='hidden' name='Info' value=' ".$Info ." '> ";
                                            echo "<input type='hidden' name='Cat' value=' ". $Cat." '> ";
                                            echo "<input type='hidden' name='Path' value=' ".$Path ." '> ";
                                            echo "<input type='hidden' name='FileType' value=' ".$FileType ." '> ";

                                            //DELETE BUTTON
                                            echo "<input class='btn btn-custom form-control' type='submit' onclick='PDFdeleteJS()'  value='Delete' name='delete' id='delete'></form>";
                                           // echo"</div>";





                                            //close if currentpage = adminpanel.php
                                        }
                                        //close PDF::Check()
                                    }
			echo "		  </div>
				</div>
			  </div>
		  </div>
	</div>
</div>";


                                        echo "<br>";
                                        echo "<br>";


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

    //***********************************************************************************************************************#
    public static function View(){


        //DELME
        var_dump($_POST['ID']);
        echo"<br>";
        var_dump($_POST['Title']);
        echo"<br>";
        var_dump($_POST['Info']);
        echo"<br>";
        var_dump($_POST['Cat']);
        echo"<br>";
        var_dump($_POST['Path']);
        echo"<br>";
        var_dump($_POST['FileType']);
        // /DELME

        $FileType = $_POST['FileType'];
        $FullPath = "PDF/".$_POST['Path'] ."." . $_POST['FileType'];

        echo "<br>$FullPath";

        if($FileType == "PDF"){
            echo "its a PDF ";

        }else
        {
            echo "<br>not a PDF";

            if(file_exists($FullPath))
                echo "file does exist";
        //close if filetype is PDF
        }

    //close View function
    }



//close class PDF
    }

CatArrayF();

//new instance of PDf class
$PDF = new PDF;

if(isset($_POST['Upload'])){

    PDF::insert();

}
if(isset($_POST['delete'])){

    PDF::Delete();

}
if(isset($_POST['edit'])){

    PDF::Edit();

}
if(isset($_POST['file'])){

    echo "howdy partner";
     PDF::View();

}












