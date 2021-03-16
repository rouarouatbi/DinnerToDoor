<?php
$val=isset($_GET['msg'])?$_GET['msg']:'';
$val_error=isset($_GET['error'])?$_GET['error']:'';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>Login</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/x-icon">

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/animate-3.7.0.css">
    <link rel="stylesheet" href="assets/css/font-awesome-4.7.0.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-4.1.3.min.css">
    <link rel="stylesheet" href="assets/css/owl-carousel.min.css">
    <link rel="stylesheet" href="assets/css/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Preloader Starts -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>
    <!-- Preloader End -->

    <!-- Header Area Starts -->
    <header class="header-area" style="margin-bottom: 50px;">
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
                    <div class="main-menu"style="margin-left: 50px;margin-top: 40px;" >
                        <ul >
                            <li class="active"><a href="index.php" style="font-size: 20px;">home</a></li>
                            <li><a href="aboutus.php" style="font-size: 20px;">about</a></li>
                            <li><a href="menu.php" style="font-size: 20px;">menu</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Welcome Area Starts -->
    <section class="welcome-area section-padding2" >
        <div class="container-fluid contact-form">
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <div class="welcome-img" style="margin-bottom: 90px; margin-top: 70px;">
                        <img src="assets/images/delivery.jpg" class="img-fluid" alt="">
                    </div>
                </div>   


                <div class="col-lg-6 align-self-center" style="padding-left: 220px;">
                 <div id="message">
                     <?php if($val_error=='1'){ ?>
                        <h01 class="mb-30 title_color">
                        verify your credentials or sign up  </h01>
                    <?php } ?>
                    <?php if($val=='1'){ ?>
                        <h01 class="mb-30 title_color" style="padding-left: 110px;">
                        your account has been created successfully  </h01>

                    <?php } ?>                         
                </div>
                <div>
                    <h2 style="color: #131230; margin-left: -27px; margin-bottom: 20px">Welcome to the space of</h2>
                    <h3 id="user"></h3>
                </div>
                <div class="button-group-area mt-40">
                    <a href="#" class="genric-btn primary e-large" id="buttonLoginR">Login restaurant</a>
                    <a href="#" class="genric-btn fash e-large" id="buttonLoginI" style="margin-left: 50px;">Login internaute</a>
                    <style type="text/css">
                        .genric-btn.fash{color:white;background-color:#131230;border:1px solid transparent}.genric-btn.fash:hover{color:#131230;border:1px solid #131230;background:#fff}.genric-btn.fash-border{color:#131230;border:1px solid #131230;background:#fff}.genric-btn.fash-border:hover{color:#fff;background:#131230;border:1px solid transparent}
                    </style>
                </div>
                <br>
                <br>
                <form  method="post" action="verifUser.php" name="login" id="formLogin" style="display:none">
                    <div class="row">
                        <div class="col-md-12 align-self-center">

                            <div class="left" >
                                <input type="hidden" name="user" id="iduser">
                                <input type="email" placeholder="Enter your email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your email'" name="email" required>
                                <input type="password" placeholder="Enter your password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your password'" 
                                name="mdp"required>
                            </div>
                        </div>
                        <div class="col-md-8">
                           <a href='Sign_up.php' class="genric-btn default" id="signup" style="margin-top: 25px; border: 1px solid #131230; ">Sign up</a> 
                           <button type="submit" class="genric-btn primary" style="margin-top: 29px;margin-right: 105px;">Login</button> 
                       </div>

                   </div>


               </form>

           </div>
       </div>
   </div>
</section>
<!-- Welcome Area End -->
<?php include('footer.php');?>
<script>    
 $("#buttonLoginR").click(function(){
    $("#formLogin").toggle();
    $("#buttonLoginR").hide();
    $("#buttonLoginI").hide();
    $("#message").hide();
    $("#iduser").prop('value','restaurant');
    $("#signup").attr("href",'Sign_up.php?role=restaurant');
    $("#user").html("restaurant");

});

 $("#buttonLoginI").click(function(){
    $("#formLogin").toggle();
    $("#buttonLoginR").hide();
    $("#buttonLoginI").hide();
    $("#message").hide();
    $("#iduser").prop('value','internaute');
    $("#signup").attr("href",'Sign_up.php?role=internaute');
    $("#user").html("internaute");
});
</script>
</body>
</html>
