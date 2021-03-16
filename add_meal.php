<?php
include('header.php');
include('./models/Nourriture.php');
$nourriture = new Nourriture();
$val=isset($_POST['action'])? $_POST['action'] : '';
if($val=='Valider'){
    $nourriture->setNom_nourriture($_POST['nom']);
    $nourriture->setType($_POST['type']);
    $nourriture->setPrix($_POST['prix']);
    $nourriture->setDescription($_POST['description']);
    $nourriture->setRestaurant($_SESSION['idU']);
    // Get image name
    $image = isset($_FILES['image']['name'])?$_FILES['image']['name']:'';
    
  // image file directory
    $target = "files/".basename($image);
    $msg="";
    $tmp=isset($_FILES['image']['tmp_name'])?$_FILES['image']['tmp_name']:'';
    if (move_uploaded_file($tmp,$target)) {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }

    $nourriture->setPhoto($image);

    $res=$nourriture->create();
    if(!$res){
        header('Location:list_meals.php'); 
    }
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
                        <a href="index.php"><img src="assets/images/logo/logo2.png" alt="logo" style="width: 100px;height: 100px;"></a>
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
                            <li><a href="add_meal.php">add meals</a></li>
                            <li><a href="list_meals.php">list meals</a></li>
                            <li><a href="confirm_meal.php">Confirm meals</a></li>
                            <li><a href="about.php">about</a></li>
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
                    <h1><i>Add your meal here</i></h1>
                    <p class="pt-2"><i>all fields are mendatory</i></p>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area End -->
    <br>
    <br>
    <br>

    <!-- Contact Form Starts -->
    <section class="contact-form section-padding3">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <form method="post" action="add_meal.php" enctype="multipart/form-data">
                        <div class="left"> 
                            <input name="nom" type="text" placeholder="Enter your meal name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your meal name'" required class="form-control">              
                            <div class="single-element-widget">
                                <div class="default-select" id="default-select">
                                    <select name="type" id="type">
                                        <option value="savory">savory</option>
                                        <option value="sweet">sweet</option>
                                    </select>
                                </div>
                            </div>
                            <input name="prix" type="text" placeholder="Enter price" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter subject'" required>
                        </div>
                        <div class="right">
                            <textarea name="description" cols="20" rows="3"  placeholder="Enter your description" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your description'" required class="form-control" style="margin-bottom: 35px"></textarea>

                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="inputGroupFile04">Choose your image</label>
                            </div>
                        </div>  

                            <!-- <input type="file" class="form-control-file" id="image" name="image"> -->
                        </div>
                        <button type="submit" name="action" value="Valider" class="template-btn" style="    margin-top: 45px;">Add meal</button>
                    </form>
                </div>
                <div class="col-lg-3 mb-5 mb-lg-0">
                    <div>
                        <img src="assets/images/cooking.svg" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Form End -->


    <?php include('footer.php');?>
</body>
</html>
