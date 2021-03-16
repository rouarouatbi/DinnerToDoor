<?php 
include('./models/Panier.php');
include('./models/Internaute.php');
$panier = new Panier();
$internaute= new internaute();
include('header.php');
$panier->setId_internaute($_SESSION['idU']);
$tab=$panier->readByDay();

$val=isset($_GET['action'])?$_GET['action']:'';
if($val=="delete"){
  $idi = isset($_GET['idi'])?$_GET['idi']:'';
  $idn = isset($_GET['idn'])?$_GET['idn']:'';
  $date = isset($_GET['datep'])?$_GET['datep']:'';
  $panier->setId_internaute($idi);
  $panier->setId_nourriture($idn);
  $panier->setDate($date);
  $res= $panier->delete();
  if(!$res) {
    header('Location:commande.php?msg=1');
  }
}
if(isset($_POST['action']) && $_POST['action']=="Modifier"){
 $idi = isset($_POST['idinternaute'])?$_POST['idinternaute']:'';
 $idn = isset($_POST['idnourriture'])?$_POST['idnourriture']:'';
 $date = isset($_POST['datecommande'])?$_POST['datecommande']:'';
 $quantity=isset($_POST['quantity'])?$_POST['quantity']:'';


 $panier->setId_internaute($idi);
 $panier->setId_nourriture($idn);
 $panier->setDate($date);
 $panier->setQuantite($quantity);
 
 $res= $panier->update();
 if(!$res) {
  header('Location:commande.php?msg=2');
}
}


if(isset($_POST['action']) && $_POST['action']=="Proceed"){

  $adresse = isset($_POST['address'])?$_POST['address']:'';

  $internaute->setId_internaute($_SESSION['idU']);
  $internaute->setAdresse($adresse);
  $internaute->updateStreet();

  $panier->setId_internaute($_SESSION['idU']);
  $res= $panier->Proceed();
  if(!$res) {
    header('Location:commande.php?msg=3');
  }
}

?>
<body>
  <!-- Header Area Starts -->
  <header class="header-area header-area2">
    <div class="container">
      <div class="row">
        <div class="col-lg-2">
          <div class="logo-area">
            <a href="index.php"><img src="assets/images/logo/logo2.png" style="width: 100px;height: 100px;" alt="logo"></a>
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
              <li><a href="menu.php">menu</a></li>
              <li><a href="commande.php">Order</a></li>
              <li><a href="order_tracking.php">track meal</a></li>
              <li><a href="logout.php">logout</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Header Area End -->

  <!-- Banner Area Starts -->
  <section class="banner-area banner-area2 menu-bg text-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
         <h1><i>

          <?php 
          $done=isset($_GET['msg'])?$_GET['msg']:'';

          if($done=='1'){ ?>
           deleted successfully
         <?php  }
         elseif($done=='2'){
          ?>
          updated successfully
          <?php 
        }
        elseif($done=='3'){ ?>
          your command has been procceded

          <?php 
        }
        else { ?>
         your orders
       <?php } ?>
     </i></h1>
     <p class="pt-2"><i>Beast kind form divide night above let moveth bearing darkness.</i></p>
   </div>
 </div>
</div>
</section>
<!-- Banner Area End -->

<div class="whole-wrap">
  <div class="container">
   <?php 
   if($tab!= null){
     foreach($tab as $t){ ?>
      <div class="section-top-border">   
        <div class="row">
          <!-- pour voir structure d'un tableau <p><?php  echo var_dump($tab); ?></p>-->
          <div class="col-md-3">
            <img src="files/<?php  echo $t['image']; ?>" style="max-width: 250px;  "/>
          </div>
          <div class="col-md-9 mt-sm-20 left-align-p">
            <p> Name: <?php  echo $t['nom_nourriture']; ?></p>
            <p> Quantity: <?php  echo $t['quantite']; ?></p>
            <p> Price: <?php  echo $t['quantite']*$t['prix']; ?></p>
            <p><i class="fa fa-calendar-o mr-2"></i> Date: <?php  echo $t['datep'] ?></p>

            <a class=" genric-btn danger-border circle button-group-area mt-10" type="button"
            class="btn btn-danger" 
            var idinternaute=<?php echo $t['id_internaute'];?> 
            var idnourriture=<?php echo $t['id_nourriture'];?> 
            var dateC="<?php echo $t['datep'];?>" 
            data-toggle="modal" data-target=".bs-example-modal-sm">DELETE</a>

            <a class="primary-border genric-btn  circle button-group-area mt-10" 
            var idinternaute=<?php echo $t['id_internaute'];?>
            var idnourriture=<?php echo $t['id_nourriture'];?>
            var nomnourriture="<?php echo $t['nom_nourriture'];?>"
            var datecommande="<?php echo $t['datep'];?>"
            var quantite="<?php echo $t['quantite'];?>"
            data-toggle="modal" data-target=".bs-example-modal-sm1" >UPDATE</a>
          </div>
        </div>
      </div>
    <?php }
  }
  else{
    ?> 
    <p class="pt-2"><i>Your order passed .</i></p>
  <?php }?>

  <!-- MODALLLLLLLLLLLLLLLLLLL DELETE -->
  <div class="modal fade bs-example-modal-sm" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Delete Meal from Command</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this meal from your command ? 
        </div>
        <div class="modal-footer" >
          <a type="submit" id="submit-link" class="btn btn-danger">Delete</a>
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
                   <!--  <div class="left">  -->
                    <div class="modal-body">

                      <input class="form-control"  id="idnourriture" name="idnourriture" type="hidden"> 
                      <input class="form-control"  id="idinternaute" name="idinternaute" type="hidden">
                      <input class="form-control"  id="datecommande" name="datecommande" type="hidden">             
                      <!-- <input name="nourriture" type="text"  id="nourriture" required> -->
                      <input name="nourriture" type="hidden"  id="nourriture" required>

                      <p>Update your meal quantity!</p>
                      <div class="left">
                        <input name="quantity" type="number"  id="quantity" placeholder="Enter your quantity"  min="1" required>
                      </div>
                    </div>

                    <div class="modal-footer" style="border-top: 0;">
                     <button  class="btn btn-primary" type="submit" name="action" value="Modifier" style="background-color: #131230; border-color: #131230;    ">update</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal" style="margin-right: 15px">Cancel</button>
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

 <!-- PROCEEEEEDDDD BUTTONNNNNN -->

 <button type="submit" name="action" value="Valider" 
 class="template-btn" 
 style="float: right; margin-top: -50px;" 
 data-toggle="modal" 
 data-target=".bs-example-modal-sm2"
 var idinternaute=<?php echo $_SESSION['idU'];?> 
 >Proceed</button>
 <!-- END PROCEEEEEDDDD BUTTONNNNNN -->

 <!-- MODALLLLLLLLLLLLLLLLLLL UPDATE-->
 <div class="modal fade bs-example-modal-sm2" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle"> confirm Meal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">         
        <section class="contact-form section-padding3" style="padding-bottom: 0px;">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <form method="post" action="commande.php">
                 <!--  <div class="left">  -->
                  <div class="modal-body">      
                    <!--       <input type="text" name="address" placeholder="Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Address'" required="" class="single-input">     -->       
                    <p>Address</p>
                    <div class="left">
                      <input name="address" type="text" value="<?php echo $_SESSION['adressU']; ?>"
                      id="adress" placeholder="Enter your address"   required disabled>
                    </div> 
                    <div class="switch-wrap d-flex justify-content-between" style="width: 125px;">
                      <p>Change Address</p>
                      <div class="primary-switch">
                        <input type="checkbox" id="primary-checkbox">
                        <label for="primary-checkbox"></label>
                      </div>
                    </div>
                  </div>
                  

                  <div class="modal-footer" style="border-top: 0;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="margin-right: 15px" >Cancel</button>
                    <button  class="btn btn-primary" type="submit" name="action" value="Proceed" style="background-color: #131230; border-color: #131230;     margin-right: -15px;">Proceed</button>
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
<?php include('footer.php');?>
<script>
 $(".danger-border").click(function(){  
   $("#submit-link").attr('href','commande.php?idi='+$(this).attr('idinternaute')+'&idn='+$(this).attr('idnourriture')+'&datep='+$(this).attr('dateC')+'&action=delete');   
 });
</script>
<script>
 $(".primary-border").click(function(){ 
   $("#idnourriture").prop('value',$(this).attr('idnourriture'));  
   $("#idinternaute").prop('value',$(this).attr('idinternaute'));  
   $("#nourriture").prop('value',$(this).attr('nomnourriture'));  
   $("#datecommande").prop('value',$(this).attr('datecommande'));  
   $("#quantity").prop('value',$(this).attr('quantite'));  
 }); 
</script>

<script type="text/javascript">
  $("input:checkbox").click(function() {
    $("input:text").attr("disabled", !this.checked); 
  });
</script>
</body>
</html>