<?php
require_once "nav.php";

if(isset ($_POST['home'])){
    header("location: index.php");
}

?>


<br>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-lg-12 well">

            <div class="row">
                <div class="col-lg-12">
            <h2 class="E404 p-404 text-center">Error : 404 , Page not found</h2>

                </div>
            <div class="col-lg-12 text-center">

                <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                <input type="submit" class="btn-custom btn-lg" name="home" id="home" value="Home">
                </form>

            </div>
            </div>


        </div>
    </div>
</div>
<?php
require_once ("footer.php");
?>




