<?php include('header.php');
include('./models/Nourriture.php');
$nourriture = new Nourriture();
$id_nourriture=$_GET['id'];
$tab=$nourriture->selectNourritureById($id_nourriture);
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
                            <li><a href="#">blog</a>
                                <ul class="sub-menu">
                                    <li><a href="blog-home.html">Blog Home</a></li>
                                    <li><a href="blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="contact-us.html">contact</a></li>
                            <li><a href="elements.html">Elements</a></li>
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
                    <h1><i>Details</i></h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area End -->
    
    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 posts-list">
                    <div class="single-post row">
                        <div class="col-lg-12">
                            <div class="feature-img">
                                <center>
                                  <img class="img-fluid" src="files/<?php echo $tab['image']; ?>" alt="">       
                              </center>                                 
                          </div>									
                      </div>
                      <div class="col-lg-3  col-md-3">
                        <div class="blog_info text-right">
                            <ul class="blog_meta list">
                                <li><a href="#"><?php echo $tab['type'];?><i class="fa fa-thumb-tack"></i></a></li>
                                <li><a href="#"><?php echo $tab['prix'];?><i class="fa fa-heart-o"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 blog_details">
                        <h5><?php echo $tab['nom_nourriture']; ?></h5>
                        <p class="excert">
                            <?php echo $tab['description']; ?>
                        </p>
                        <p class="excert">
                            <?php echo $tab['type'];?>/<?php echo $tab['prix'];?>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
    <?php include('footer.php');?>
    
</body>
</html>