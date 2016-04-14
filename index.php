<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 01/04/16
 * Time: 10:56
 */
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

//require files
require 'controllers/enquiry.php';
require 'nav.php';
?>

<!-- headding image-->

<div  class="row  section-head" id="Head">
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

<!-- heading -->

<!--services section start -->
    <div class="row section background-1 Services">
        <div class="col-lg-12 centered">
            <h2 class="text-center hr-heading">Services</h2>

            <p class="text-center">We offer A range of commercial pest management solutions and environmental services, Tailored to meet the specific requirements of our customers and their sectors .</p>


            <div class="row center-block">

                <!-- ********* services blocks -->
                <div class="col-sm-1"></div>

                <a href="services.php?#pestMan" class="a-section"><div style="background-image: url(../images/jumboxes/services/poison.jpg);" class="col-lg-2 jumbotron-services">
                    <p class="content-box">Pest Management</p>
                </div></a>

                <a href="services.php?#inspection" class="a-section"><div style="background-image: url(../images/jumboxes/services/inspection.jpg);" class="col-lg-2 jumbotron-services">
                    <p class="content-box">Inspection Service</p>
                </div></a>

                <a href="services.php?#birdCon" class="a-section"><div style="background-image: url(../images/jumboxes/services/birdnet.jpg);" class="col-lg-2 jumbotron-services">
                    <p class="content-box">Bird Control & Netting</p>
                </div></a>

                <a href="services.php?#rodentCon" class="a-section"><div style="background-image: url(../images/jumboxes/services/Rat.jpg);" class="col-lg-2 jumbotron-services">
                    <p class="content-box">Rodent Control</p>
                </div></a>

                <a href="services.php?#insectCon" style="background-image: url(../images/jumboxes/services/insect.jpg);" class="a-section col-lg-2 jumbotron-services">
                    <p class="content-box">Insect control</p>
                </a>
                <!-- close row -->
            </div>


            <div class="row center-block">

                <div class="col-sm-1"></div>

                <a href="services.php?#plasticStrip" class="a-section"><div style="background-image: url(../images/jumboxes/services/plasticStrip.jpg);" class="col-lg-2 jumbotron-services">
                    <p class="content-box">Plastic Strip Curtains & Chain Linked Doors</p>
                </div></a>

                <a href="services.php?#flyScreen" class="a-section"><div style="background-image: url(../images/jumboxes/services/flyscreen.jpg);" class="col-lg-2 jumbotron-services">
                    <p class="content-box">Fly Screen & Electric Fly Control Units</p>
                </div></a>

                <a href="services.php?#fumigation" class="a-section"><div style="background-image: url(../images/jumboxes/services/biohazard.png);" class="col-lg-2 jumbotron-services">
                    <p class="content-box">Fumigation</p>
                </div></a>

                <a href="services.php?#pestAware" class="a-section"><div style="background-image: url(../images/jumboxes/services/training.jpg);" class="col-lg-2 jumbotron-services">
                    <p class="content-box">Pest Awareness Training</p>
                </div></a>

            <a href="services.php?#hygine" class="a-section"><div style="background-image: url(../images/jumboxes/services/hygine.jpg);" class="col-lg-2 jumbotron-services">
                    <p class="content-box">Hygiene Services</p>
                </div></a>




                <!-- close row -->
            </div>
            <br>
        </div>
    </div>
    <!--close services section -->




    <!--About section start -->
    <div class="row section background-2" id="about">
        <div class="col-lg-1 center-block">
        </div>
        <div class="col-lg-10 centered">
            <br>
            <br>
            <br>



            <h2 class="text-center hr-heading">About Us</h2>

            <p style="width: 90%" class="text-center">Formed over 18 years ago, Pestproof is a leading supplier of pest control and environmental services located in the North West.

                We offer the complete pest prevention package, tailoring each integrated pest management specification to meet the specific needs of our customers. We are full members of the BPCA and our flagship Elite Pest Management service is fully compliant with BRC audits for major retailers including Tesco and M&S. We are also accredited to the prestigious ISO 9001:2000 quality systems; proof of our commitment to providing an accountable and quality service for our customers.

                Many of our customers are market leaders in their industries and they expect exceptionally high levels of quality and service. They value our responsiveness, our flexibility, the professionalism and knowledge of our team and the high quality delivery of our proactive service.

                Operating at the forefront of our industry, we are committed to ethical practices and processes utilising the latest technologies and innovations. Our Pest Technicians are highly trained and experienced with ongoing Health and Safety training as standard including the newly introduced Safety Passport.

                Our integrated pest management service is complemented by a range of specialist cleaning and washroom hygiene services. </p>

            <div class="col-lg-12">


            </div>
        </div>
        <!--close about section -->
    </div>







<!-- cleaning section start-->
<div class="row section background-1" id="cleaning">
    <div class="col-lg-1 center-block"></div>
    <div class="col-lg-10 center-block">
        <br>
        <br>
        <br>

        <h2 class="text-center hr-heading">Cleaning & Removals</h2>
        <div class="col-lg-12 text-center">
            <img style="border-radius: 25px;width: 60%;height: 45%" src="../images/Before&after.jpg">
        </div>
        <div class="col-lg-12 text-center">
            <br>
            <p style="width: 90%" class="text-center">To complement our pest management and hygiene services, we also offer specialist cleaning and office cleaning services. We are equipped to carry out all types of cleaning including high-level cleaning in factories, silo servicing and silo house deep cleaning as well as a specialist team for void clearances. We are qualified to carry out work requiring specialised access equipment, such as abseiling techniques and Bosun’s chair work. To minimise disruption, our cleaning services can be carried out during shutdowns, weekends or through the night.</p>
            <br>

        </div>

    </div>
</div>


    <!--contact us title-->

    <div class="row text-center background-2" id="contact">
        <h2 class="hr-heading">Contact Us</h2>
    </div>

    <!--close title -->
    <div class="row background-2">
        <div class="col-lg-6 text-center background-2">

            <h3 class="hr-heading">Address & Numbers</h3>


            <b>Address:</b><address>Mitre Street<br>
                Failsworth<br>
                Manchester<br>
                M35 9BY <br></address>
            <b>Telephone:</b> 0161 684 9451<br>
            <b>Fax :</b>0161 947 0485



        </div>

        <!--Enquiry form  -->

        <div class="col-lg-6 text-center background-2">

            <h3 class="hr-heading">Enquiry</h3>


            <form action="controllers/enquiry.php" method="post">
                <div class="input-group">
                <span class="input-group-addon" id="name">Name :</span>
                <input type="text" class="form-control" name="name" placeholder="Name" aria-describedby="name">
                </div>
                <div class="input-group">
                <span class="input-group-addon" id="number">Phone :</span>
                <input type="tel" class="form-control" name="phone" placeholder="PhoneNumber" aria-describedby="number">
                </div>
                <div class="input-group">
                <span class="input-group-addon" id="email">E-mail :</span>
                <input type="email" class="form-control" name="email" placeholder="E-Mail" aria-describedby="email">
                </div>
                <div class="input-group">
                <span class="input-group-addon" id="message">Enquiry :</span>
                <input type="text" class="form-control" name="message" placeholder="Enquiry" aria-describedby="message">
                </div>
                <input class="btn-submit" type="submit" name="submit" value="Submit Enquiry">
            </form>
            <?php


            ?>

        </div>

        <!--close enquiry form -->

    </div>


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