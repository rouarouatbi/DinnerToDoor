<?php
include('./models/Internaute.php');
include('./models/Restaurant.php');
$internaute = new internaute();
$restaurant=new Restaurant();
$val=isset($_POST['action'])? $_POST['action'] : '';
if($val=='ValiderInternaute'){
    $internaute->setNom($_POST['last_name']);
    $internaute->setPrenom($_POST['first_name']);
    $internaute->setEmail($_POST['email']);
    $pwd=password_hash($_POST['mdp'],PASSWORD_DEFAULT);
    $internaute->setMot_de_passe($pwd);  
    $internaute->setAdresse($_POST['adresse']);
    $internaute->setNumero_tel($_POST['tel']);

    $res=$internaute->create();
    if(!$res){
        header('Location:login.php?msg=1'); 
    }
}

if($val=='ValiderRestaurant'){
    $restaurant->setNom_restaurant($_POST['resto_name']);
    $restaurant->setEmail_restaurant($_POST['email']);
    $pwd=password_hash($_POST['mdp'],PASSWORD_DEFAULT);
    $restaurant->setMdp($pwd);  
    $restaurant->setAdresse_restaurant($_POST['adresse']);
    $restaurant->setRating_restaurant(0);
    $restaurant->setTel_restaurant($_POST['tel']);

     // Get image name
    $image = isset($_FILES['image']['name'])?$_FILES['image']['name']:'';
    
  // image file directory
    $target = "logos/".basename($image);
    $msg="";
    $tmp=isset($_FILES['image']['tmp_name'])?$_FILES['image']['tmp_name']:'';
    if (move_uploaded_file($tmp,$target)) {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }

    $restaurant->setLogo($image);
    $res=$restaurant->create();
    if(!$res){
        header('Location:login.php?msg=1'); 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>Sign up</title>

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
                        <a href="index.php"><img src="assets/images/logo/logo7.png" alt="logo" style="width: 70%;margin-left: -130px; "></a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="custom-navbar">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>  
                    <div class="main-menu"style="margin-right: 105px;margin-top: 40px;" >
                        <ul >
                            <li class="active"><a href="index.php" style="font-size: 20px;">home</a></li>
                            <li><a href="about.php" style="font-size: 20px;">about</a></li>
                            <li><a href="menu.php" style="font-size: 20px;">menu</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Welcome Area Starts -->
    <section class="welcome-area section-padding2">
        <div class="container-fluid contact-form">
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <div class="welcome-img" style="margin-bottom: 90px; margin-top: 70px;">
                        <img src="assets/images/delivery.jpg" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-6 align-self-center" style="margin-top: 50px;">
                    <?php if ($_GET['role']=="internaute") { ?>
                        <form  method="post" action="Sign_up.php" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12 align-self-center">
                                    <div class="left" style="margin-left: 110px;">
                                        <input type="text" pattern="[a-zA-Z-èàé\s]+" placeholder="Enter your first name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your first name'" name="first_name" required>
                                        <input type="text" pattern="[a-zA-Z-èàé\s]+" placeholder="Enter your last name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your last name'" name="last_name" required>
                                        <input type="email" placeholder="Enter your email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your email'" 
                                        name="email"required>
                                        <input type="text" placeholder="Enter your adresse" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your adresse'" 
                                        name="adresse"required>
                                        <input type="text" pattern="[0-9]+" maxlength="8" minlength="8" placeholder="Enter your tel" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your tel'" 
                                        name="tel"required>
                                        <input type="password" placeholder="Enter your password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your password'" 
                                        name="mdp"required>
                                    </div>
                                </div>
                                <div class="col-md-8 align-self-center">
                                    <center><button type="submit" name="action" value="ValiderInternaute" class="template-btn">Register</button></center> 
                                </div>

                            </div>


                        </form>
                    <?php }?>
                    <?php if ($_GET['role']=="restaurant") { ?>
                        <form  method="post" action="Sign_up.php" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12 align-self-center">
                                    <div class="left" style="margin-left: 110px;">
                                        <input type="text" pattern="[a-zA-Z-èàé\s]+" placeholder="Enter your restaurant name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your restaurant name'" name="resto_name" required>
                                        <input type="email" placeholder="Enter your email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your email'" 
                                        name="email"required>
                                        <input type="text" placeholder="Enter your address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your address'" 
                                        name="adresse"required>
                                        <input type="text" pattern="[0-9]+" maxlength="8" minlength="8" placeholder="Enter your phone number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your phone number'" 
                                        name="tel"required>
                                        <input type="password" placeholder="Enter your password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your password'" 
                                        name="mdp"required>

                                        <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="inputGroupFile04">Put your Logo</label>
                            </div>
                        </div>  
                                    </div>
                                </div>
                                <div class="col-md-8 align-self-center">
                                    <center><button type="submit" name="action" value="ValiderRestaurant" class="template-btn" style="margin-top: 40px;
    margin-right: 30px;">Register</button></center> 
                                </div>

                            </div>


                        </form>
                    <?php }?>
                </div>
            </div>
        </div>
    </section>
    <!-- Welcome Area End -->
    <?php include('footer.php');?>

</body>
</html>
