<?php 
include('./models/Nourriture.php');
$nourriture = new Nourriture();
$tab=$nourriture->read();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>Dinner To Door</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/x-icon">

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/animate-3.7.0.css">
    <link rel="stylesheet" href="assets/css/font-awesome-4.7.0.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-4.1.3.min.css">
    <link rel="stylesheet" href="assets/css/owl-carousel.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Preloader Starts -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>
    <!-- Preloader End -->

    <!-- Header Area Starts -->
    <header class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo-area">
                        <a href="index.php"><img src="assets/images/logo/logo7.png" alt="logo" style="width: 70% ;margin-left:-50px;"></a>
                    </div>
                </div>
                <div class="col-lg-10" style="margin-top: 30px; font-size: 60%">
                    <div class="main-menu" style="">
                        <ul>
                            <li class="active"><a href="index.php" style="font-size: large;">home</a></li>
                            <li><a href="aboutus.php" style="font-size: large;">about</a></li>
                            <li><a href="menu.php" style="font-size: large;">menu</a></li>
                            <li><a href="login.php" style="font-size: large;">Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Area End -->


        <!-- Welcome Area Starts -->
        <section class="banner-area text-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h6>the most interesting food in the world</h6>
                        <h1>Discover the <span class="prime-color">flavors</span><br>  
                            <span class="style-change">of <span class="prime-color">Dinner To </span>Door</span></h1>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Banner Area End -->

            <!-- Welcome Area Starts -->
            <section class="welcome-area section-padding2">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 align-self-center">
                            <div class="welcome-img">
                                <img src="assets/images/welcome-bg.png" class="img-fluid" alt="">
                            </div>
                        </div>
                        <div class="col-md-6 align-self-center">
                            <div class="welcome-text mt-5 mt-md-0">
                                <h3><span class="style-change">welcome</span> <br>to Dinner To Door</h3>
                                <p class="pt-3">If you have an exquisite taste and can't be bothered to pick up your meals this is the place for you. Dinner To Door offers you an amazing selection of restaurants with the option of making a delivery straight to your door.</p>
                                
                                <a href="login.php" class="template-btn mt-3">order your meal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Welcome Area End -->

            <!-- Food Area starts -->
            <section class="food-area section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="section-top">
                                <h3><span class="style-change">we serve</span> <br>delicious food</h3>
                                <p class="pt-3">This is a list of a couple of the meals that we offer. Check them out!!! </p> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach($tab as $t){ ?>
                            <div class="col-md-4 col-sm-6">
                                <div class="single-food">
                                    <div class="food-img">
                                        <img src="files/<?php  echo $t['image']; ?>" class="img-fluid" alt="">
                                    </div>
                                    <div class="food-content">
                                        <div class="d-flex justify-content-between">
                                            <h5><?php  echo $t['nom_nourriture']; ?></h5>
                                            <span class="style-change"><?php  echo $t['prix']; ?></span>
                                        </div>
                                        <p class="pt-3"><?php  echo $t['description']; ?></p>
                                    </div>

                                </div>
                            </div>  
                        <?php } ?>   
                    </div>
                </div>
            </section>
            <!-- Food Area End -->

            <!-- Reservation Area Starts -->
            <div class="reservation-area section-padding text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>Natural ingredients and tasty food</h2>
                            <h4 class="mt-4">some trendy and popular courses offered</h4>
                            <a href="login.php" class="template-btn template-btn2 mt-4">Order</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Reservation Area End -->

            <!-- Deshes Area Starts -->
            <div class="deshes-area section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-top2 text-center">
                                <h3>Our <span>special</span> dishes</h3>
                                <p><i>Best dishes around. Become part of our members and order your meal now.</i></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-md-6 align-self-center">
                            <h1>01.</h1>
                            <div class="deshes-text">
                                <h3><span>Fruity</span><br> Delight</h3>
                                <p class="pt-3">Three rolled pancakes topped with delicious cooled fruits compote on the inside and on top. Finished with powdered sugar.</p>
                                <span class="style-change">16 Dinar</span>
                                <a href="login.php" class="template-btn3 mt-3">order it <span><i class="fa fa-long-arrow-right"></i></span></a>
                            </div>
                        </div>
                        <div class="col-lg-5 offset-lg-2 col-md-6 align-self-center mt-4 mt-md-0">
                            <img src="assets/images/food3.jpg" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-5 col-md-6 align-self-center order-2 order-md-1 mt-4 mt-md-0">
                            <img src="assets/images/food2.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="col-lg-5 offset-lg-2 col-md-6 align-self-center order-1 order-md-2">
                            <h1>02.</h1>
                            <div class="deshes-text">
                                <h3><span>Chili</span><br> Cheese Burger</h3>
                                <p class="pt-3">Angus beef, house-made chili, queso, onions, pickles</p>
                                <span class="style-change">22 Dinar</span>
                                <a href="login.php" class="template-btn3 mt-3">order it <span><i class="fa fa-long-arrow-right"></i></span></a>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>
            <!-- Deshes Area End -->
            <?php include('footer.php');?>
        </body>
        </html>
