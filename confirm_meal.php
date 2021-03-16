<?php 
include('header.php');
include('./models/Restaurant.php');
include('./models/Panier.php');
$resto = new Restaurant();
$panier=new Panier();
$resto->setId_restaurant($_SESSION['idU']);
$tab=$resto->readByResto();

$val=isset($_GET['action'])?$_GET['action']:'';
if($val=="delete"){
  $idi = $_GET['idi'];
  $idn = $_GET['idn'];
  $date = $_GET['datep'];
  $panier->setId_internaute($idi);
  $panier->setId_nourriture($idn);
  $panier->setDate($date);
  $res= $panier->deleteNotConfirmed();
  if(!$res) {
    header('Location:confirm_meal.php?msg=1');
  }
}
if($val=="confirm"){
 $idi = $_GET['idi'];
 $idn = $_GET['idn'];
 $date = $_GET['datep'];

 $panier->setId_internaute($idi);
 $panier->setId_nourriture($idn);
 $panier->setDate($date);

 $res= $panier->updateEtat();
 if(!$res) {
  header('Location:confirm_meal.php?msg=2');
}
}

?>
<body>
  <!-- Header Area Starts -->
  <header class="header-area header-area2">
    <div class="container">
      <div class="row">
        <div class="col-lg-2">
          <div class="logo-area" >
            <a href="index.php"><img src="assets/images/logo/logo2.png" style="width: 100px;height: 100px;"alt="logo"></a>
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
 <section class="banner-area banner-area2 menu-bg text-center">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
       <h1><i>

        <?php 
        $done=isset($_GET['msg'])?$_GET['msg']:'';

        if($done=='1'){ ?>
          The command was canceled successfully
        <?php  }
        elseif($done=='2'){
          ?>
          The command was confirmed successfully
          <?php 
        }
        else { ?>
         Confirm Commands
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
            <p><i class="fa fa-calendar-o mr-2"></i> Date: <?php  echo $t['datep'] ?></p>

            <a class=" genric-btn danger-border circle button-group-area mt-10" type="button"
            class="btn btn-danger" 
            var idinternaute=<?php echo $t['id_internaute'];?> 
            var idnourriture=<?php echo $t['id_nourriture'];?> 
            var dateC="<?php echo $t['datep'];?>" 
            data-toggle="modal" data-target=".bs-example-modal-sm">Cancel</a>

            <a class="primary-border genric-btn  circle button-group-area mt-10" 
            var idinternaute=<?php echo $t['id_internaute'];?>
            var idnourriture=<?php echo $t['id_nourriture'];?>
            var dateC="<?php echo $t['datep'];?>" 
            data-toggle="modal" data-target=".bs-example-modal-sm1" >Confirm</a>
          </div>
        </div>
      </div>
    <?php }
  }else{?> 
    <center>
     <h3 class="mb-30 title_color">You still don't have any commands.</h3>
   </center>
   
 <?php }?>


 <!-- MODALLLLLLLLLLLLLLLLLLL DELETE -->
 <div class="modal fade bs-example-modal-sm" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Cancel this Command</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to cancel this command ? 
      </div>
      <div class="modal-footer">
        <a type="submit" id="submit-link" class="btn btn-danger">Yes</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>    
<!-- ENDDDDDDDDDD MODALLLLLLLLLLLLLLLLLLL DELETE -->

<!-- MODALLLLLLLLLLLLLLLLLLL Confirm COmmaNdddddddddddddd -->
<div class="modal fade bs-example-modal-sm1" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Confirm this Command</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you will provied this command ? 
      </div>
      <div class="modal-footer">
        <a type="submit" id="confirm_command" class="btn btn-primary">Yes</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>    
<!-- ENDDDDDDDDDD MODALLLLLLLLLLLLLLLLLLL  Confirm COmmaNdddddddddddddd -->
</div>
</div>
<?php include('footer.php');?>
<script>
 $(".danger-border").click(function(){  
   $("#submit-link").attr('href','confirm_meal.php?idi='+$(this).attr('idinternaute')+'&idn='+$(this).attr('idnourriture')+'&datep='+$(this).attr('dateC')+'&action=delete');   
 });
</script>

<script>
 $(".primary-border").click(function(){  
   $("#confirm_command").attr('href','confirm_meal.php?idi='+$(this).attr('idinternaute')+'&idn='+$(this).attr('idnourriture')+'&datep='+$(this).attr('dateC')+'&action=confirm');   
 });
</script>

</body>
</html>