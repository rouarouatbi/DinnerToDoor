
<?php
include('header.php');
include('./models/Nourriture.php');
$nourriture = new Nourriture();
$nourriture->setRestaurant($_SESSION['idU']);
$tab=$nourriture->readAll();

$val=isset($_GET['action'])?$_GET['action']:'';
if($val=="delete"){

  $id = $_GET['ide'];
  $res= $nourriture->delete($id);
  if(!$res) {
    header('Location:list_meals.php');
  }
}
if(isset($_POST['action']) && $_POST['action']=="Modifier"){

  $prix=isset($_POST['prix'])?$_POST['prix']:'';
  $type=isset($_POST['typen'])?$_POST['typen']:'';
  $id=isset($_POST['idnourriture'])?$_POST['idnourriture']:'';
  $description=isset($_POST['description'])?$_POST['description']:'';

  $nourriture->setDescription($description);
  $nourriture->setPrix($prix);
  $nourriture->setType($type);

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
  $nourriture->update($id);
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
 <section class="banner-area banner-area2 blog-page text-center">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h1><i>

          <?php 
          $done=isset($_GET['done'])?$_GET['done']:'';

          if($done=='1'){ ?>

            Meal updated successfully
          <?php  }
          else { ?>
           List Meals
         <?php } ?>
       </i></h1>

     </div>
   </div>
 </div>
</section>
<!-- Banner Area End -->

<!--================Blog Categorie Area =================-->
<section class="blog_categorie_area">
 <div class="container">
  <div class="row">
    <?php 
    if($tab!= null){
     foreach($tab as $t){ ?>
       <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
        <div class="categories_post">
          <input type="hidden" name="des" id="desc" value="<?php  echo $t['description']; ?>">
          <img src="files/<?php  echo $t['image']; ?>"/>
          <div class="categories_details">
            <div class="categories_text">
             <h5><?php  echo $t['nom_nourriture']; ?></h5>
             <div class="border_line"></div>
             <p><?php  echo $t['description']; ?>/<?php  echo $t['prix']; ?></p>
           </div>
         </div>
       </div>
       <center>
        <a class=" genric-btn danger-border circle button-group-area mt-10" type="button"
        var idnourriture=<?php echo $t['id_nourriture'] ; ?>   class="btn btn-danger" 
        data-toggle="modal" data-target=".bs-example-modal-sm">DELETE</a>

        <a class=" genric-btn primary-border circle button-group-area mt-10" 
        var idnourriture=<?php echo $t['id_nourriture'];?> 
        var typen="<?php echo $t['type'];?>" 
        var prixnourriture="<?php echo $t['prix'] ; ?>" 
        var descriptionnourriture="<?php  echo $t['description']; ?>"
        data-toggle="modal" data-target=".bs-example-modal-sm1" >UPDATE</a>
      </center> 
      <!--   <br> -->
    </div>
  <?php } 
} else{?> 
  <center>
    <h3 class="mb-30 title_color">You still don't have any meals.</h3>
  </center>
  
<?php }?> 
<!-- MODALLLLLLLLLLLLLLLLLLL DELETE -->
<div class="modal fade bs-example-modal-sm" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Delete Meal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this meal from your list ? 
      </div>
      <div class="modal-footer">
        <a type="submit"  id="submit-link" class="btn btn-danger">Delete</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>    
<!-- ENDDDDDDDDDD MODALLLLLLLLLLLLLLLLLLL DELETE -->

<!-- MODALLLLLLLLLLLLLLLLLLL UPDATE-->
<div class="modal fade bs-example-modal-sm1" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">UPDATE Meal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">         
        <section class="contact-form section-padding3" style="padding-bottom: 0px;">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <form method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <input class="form-control"  id="idnourriture" name="idnourriture" type="hidden" style="margin-bottom: 20px;">              
                    <input class="form-control" name="typen" type="text"  id="typen" placeholder="Enter your type" required style="margin-bottom: 20px;">
                    <input class="form-control" name="prix" type="text"  id="prix" placeholder="Enter price" required style="margin-bottom: 20px;">

                    <textarea class="form-control" name="description" cols="20" rows="3" id="description" placeholder="Enter your description" required style="margin-bottom: 20px;"></textarea>

                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="inputGroupFile04">Choose your image</label>
                      </div>
                    </div>  

                    <!-- <input type="file" class="form-control-file" id="image" name="image"> -->
                  </div>
                  <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal" style="margin-right: 30px;">Cancel</button>
                   <button  class="btn btn-primary" type="submit" name="action" value="Modifier" style="background-color: #131230; border-color: #131230;     margin-right: -15px;">update</button>
                 </div>
               </form>
             </div>
           </div>
         </div>
       </section>
     </div>

   </div>
 </div>
</div>    
<!-- END MODALLLLLLLLLLLLLLLLLLL UPDATE-->

</div>
</div>
</section>

<?php include('footer.php');?>

<script>
 $(".danger-border").click(function(){  
   $("#submit-link").attr('href','list_meals.php?ide='+$(this).attr('idnourriture')+'&action=delete');   
 });
</script>
<script >

  $(".primary-border").click(function(){ 
   $("#idnourriture").prop('value',$(this).attr('idnourriture'));  
   $("#typen").prop('value',$(this).attr('typen')); 
   $("#prix").prop('value',$(this).attr('prixnourriture'));
   $('#description').val($(this).attr('descriptionnourriture'));
 }); 
</script>
</body>
</html>
