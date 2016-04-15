<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/04/16
 * Time: 00:14
 */
require "nav.php";
require "PDF/PDF.php";
?>

<!-- headding image-->

<div  class="row section-head" id="Head">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="../images/home-banner-01.jpg" class="img-rounded" alt="Pestproof" width=100% height= 100%>
            </div>

            <div class="item">
                <img src="../images/home-banner-02.jpg" class="img-rounded" alt="Pestproof" width=100% height= 100%>
            </div>

        </div>
    </div>
</div>


<!-- heading -->
<?php PDF::PDFList()?>




<br>
<br>
<br>
<br>
<br>
<br>
<br>





<?php
require "footer.php";
?>
