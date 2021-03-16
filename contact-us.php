<?php 
include('header.php');
include('./models/Contact.php');
$contact = new Contact();
$val=isset($_POST['action'])? $_POST['action'] : '';

if($val=='Valider'){
    $contact ->setNom($_SESSION['nomU']);
    $contact ->setEmail($_SESSION['emailU']);
    $contact ->setSujet($_POST['sujet']);
    $contact ->setMessage($_POST['message']);
    $contact->setInternaute($_SESSION['idU']);
    $contact->create();
}
?>
<body>
    <!-- Preloader Starts -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>
    <!-- Preloader End -->

    <!-- Header Area Starts -->
    <header class="header-area header-area2">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo-area">
                        <a href="index.php"><img src="assets/images/logo/logo2.png" alt="logo"></a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="custom-navbar">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>  
                    <div class="main-menu main-menu2">
                        <ul>
                           <li class="active"><a href="blog-home.php">home</a></li>
                           <li><a href="add_meal.php">add meals</a></li>
                           <li><a href="list_meals.php">list meals</a></li>
                           <li><a href="about.php">about</a></li>
                           <li><a href="contact-us.php">contact</a></li>
                           <li><a href="logout.php">Logout</a></li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>
   </header>
   <!-- Header Area End -->

   <!-- Banner Area Starts -->
   <section class="banner-area banner-area2 contact-bg text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1><i>Contact Us</i></h1>
                <p class="pt-2"><i>Beast kind form divide night above let moveth bearing darkness.</i></p>
            </div>
        </div>
    </div>
</section>
<!-- Banner Area End -->

<!-- Map Area Starts -->
<!--     <section class="map-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div id="mapBox" class="mapBox" 
                    data-lat="40.701083" 
                    data-lon="-74.1522848" 
                    data-zoom="13" 
                    data-info="PO Box CT16122 Collins Street West, Victoria 8007, Australia."
                    data-mlat="40.701083"
                    data-mlon="-74.1522848">
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- Map Area End -->
<br>
<br>
<br>

<!-- Contact Form Starts -->
<section class="contact-form section-padding3">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 mb-5 mb-lg-0">
                <div class="d-flex">
                    <div class="into-icon">
                        <i class="fa fa-home"></i>
                    </div>
                    <div class="info-text">
                        <h5>California, United States</h5>
                        <p>Santa monica bullevard</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="into-icon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="info-text">
                        <h5>00 (440) 9865 562</h5>
                        <p>Mon to Fri 9am to 6 pm</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="into-icon">
                        <i class="fa fa-envelope-o"></i>
                    </div>
                    <div class="info-text">
                        <h5>support@colorlib.com</h5>
                        <p>Send us your query anytime!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <form  method="POST" action="contact-us.php">
                    <div class="left">
                        <input type="text" value="<?php echo ($_SESSION['nomU']); ?>" placeholder="Enter your name" name="nom" disabled required>
                        <input type="email" value="<?php echo ($_SESSION['emailU']); ?>"placeholder="Enter email address" name="email" disabled required>
                        <input type="text" placeholder="Enter subject" name="sujet" required>
                    </div>
                    <div class="right">
                        <textarea name="message" cols="20" rows="7"  placeholder="Enter Message" name="message" required></textarea>
                    </div>
                    <button type="submit" class="template-btn" name="action" value="Valider">subscribe now</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Contact Form End -->


<?php include('footer.php');?>
</body>
</html>
