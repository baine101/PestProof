<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 01/04/16
 * Time: 10:56
 */
require 'nav.php';
?>

<!-- headding image-->

<div  class="row section-head" id="Head">
    <div class="col-lg-12 centered">

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="images/home-banner-01.jpg" class="img-rounded" alt="Pestproof" width=100% height= 100%>
                </div>

                <div class="item">
                    <img src="images/home-banner-02.jpg" class="img-rounded" alt="Pestproof" width=100% height= 100%>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- heading -->

<!--scroll to top button-->
<footer class="navbar-fixed-bottom">
    <div class="container">
        <a href="#Head" class="scrolltotop"><i class="fa fa-chevron-circle-up fa-2x scrollToTop"></i></a>
    </div>
</footer>
<!-- close scroll to top button-->


<?php

require "footer.php";
?>


