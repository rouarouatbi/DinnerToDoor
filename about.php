<?php include('header.php');
include('./models/Restaurant.php');
$resto = new Restaurant();
$tab=$resto->selectRestauranteById($_SESSION['idU']);

$val=isset($_POST['action'])? $_POST['action'] : '';

if($val=='Valider'){
    $resto->setId_restaurant($_SESSION['idU']);
    $resto ->setNom_restaurant($_POST['nom']);
    $resto ->setEmail_restaurant($_POST['email']);
    $resto ->setAdresse_restaurant($_POST['adresse']);
    $resto ->setTel_restaurant($_POST['tel']);
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
    $resto->setLogo($image);





    $resto->update();
}
?>
<!DOCTYPE html>
<html lang="en">
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
    <section class="banner-area banner-area2 text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1><i>Your Account</i></h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area End -->
    <br>
    <br>
    <br>
    <section class="contact-form section-padding3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form action="about.php"  method="POST" enctype="multipart/form-data">
                        <div class="left">
                            <div class="switch-wrap d-flex justify-content-between">
                                <h3 class="mb-30 title_color">Edit Profile</h3>
                            </div>
                            <input type="text" id="nom" name="nom" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" required=""
                            value="<?php echo $tab["nom"]; ?>">
                            <input type="email" id="email" name="email" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" required=""
                            value="<?php echo $tab["email"]; ?>">
                            <input type="text" id="adresse" name="adresse" placeholder="Enter Adress" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Adress'" required=""
                            value="<?php echo $tab["adresse"]; ?>">
                            <input type="text" id="tel" name="tel" placeholder="Enter Phone Number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Phone Number'" required=""
                            value="<?php echo $tab["telephone"]; ?>">
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="inputGroupFile04">Change your Logo</label>
                            </div>
                        </div>  
                    </div>
                    <div class="right">
                      <img src="logos/<?php echo $tab['logo']; ?>" class="img-fluid" alt="logo resto">

                  </div>
                  <button type="submit" class="template-btn" name="action" value="Valider" style="float: left; margin-top: -160px">Confirm Changes</button>
              </form>
          </div>
      </div>
  </div>
</section>

<?php include('footer.php');?>
</body>
</html>
