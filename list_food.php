<?php
include('./models/Nourriture.php');
$nourriture = new Nourriture();
$nourriture->readAll();
?>
<!DOCTYPE html>
<html lang="en">
<?php include('header.php');?>
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
                        <a href="index.html"><img src="assets/images/logo/logo2.png" alt="logo" style="width: 100px;height: 100px;"></a>
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
                            <li class="active"><a href="index.html">home</a></li>
                            <li><a href="about.html">about</a></li>
                            <li><a href="menu.html">menu</a></li>
                            <li><a href="contact-us.html">contact</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Area End -->

    <!-- Banner Area Starts -->
    <section class="banner-area banner-area2 blog-page text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1><i>Meals Added</i></h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area End -->

    <!--================Blog Categorie Area =================-->
    <section class="blog_categorie_area">
        <div class="container">
            <div class="row">
             <?php foreach($tab as $t){ ?>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="categories_post">
                        <img src="assets/images/blog/cat-post/cat-post-3.jpg" alt="post">
                        <div class="categories_details">
                            <div class="categories_text">
                             <h5><?php  echo $t['description']; ?></h5>
                             <div class="border_line"></div>
                             <p><?php  echo $t['type']; ?>/<?php  echo $t['prix']; ?></p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <br>
         <br>
     <?php } ?>
 </div>
</section>
<!--================Blog Categorie Area =================-->


<?php include('footer.php');?>
</body>
</html>
