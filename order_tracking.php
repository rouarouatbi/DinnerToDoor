<?php include('header.php');
include('./models/Panier.php');
$panier = new Panier();
$panier->setId_internaute($_SESSION['idU']);
$tab=$panier->read();

$val=isset($_GET['action'])?$_GET['action']:'';
if($val=="received"){
  $idi = $_GET['idi'];
  $idn = $_GET['idn'];
  $date = $_GET['datep'];
  $panier->setId_internaute($idi);
  $panier->setId_nourriture($idn);
  $panier->setDate($date);
  $res= $panier->confirmReception();
  $res1=$panier->TheEnd();
  if(!$res) {
    header('Location:order_tracking.php?msg=1');
  }
}
?>

<!-- Script de rating Starrrrrrssssssss -->
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>

<script>function highlightStar(obj,id) {
  removeHighlight(id);    
  $('.section-top-border #restaurant-'+id+' li').each(function(index) {
    $(this).addClass('highlight');
    if(index == $('.section-top-border #restaurant-'+id+' li').index(obj)) {
      return false; 
    }
  });
}

function removeHighlight(id) {
  $('.section-top-border #restaurant-'+id+' li').removeClass('selected');
  $('.section-top-border #restaurant-'+id+' li').removeClass('highlight');
}

function addRating(obj,id) {
  $('.section-top-border #restaurant-'+id+' li').each(function(index) {
    $(this).addClass('selected');
    $('#restaurant-'+id+' #rating').val((index+1));
    if(index == $('.section-top-border #restaurant-'+id+' li').index(obj)) {
      return false; 
    }
  });
  $.ajax({
    url: "add_rating.php",
    data:'id='+id+'&rating='+$('#restaurant-'+id+' #rating').val(),
    type: "POST"
  });
}

function resetRating(id) {
  if($('#restaurant-'+id+' #rating').val() != 0) {
    $('.section-top-border #restaurant-'+id+' li').each(function(index) {
      $(this).addClass('selected');
      if((index+1) == $('#restaurant-'+id+' #rating').val()) {
        return false; 
      }
    });
  }
} 
</script>
<!-- ENDDDDD Rating SCRIPPPPPTTTTTTTT -->
<style>
  .highlight, 
  .rating .selected {
    color: #F4B30A;
    text-shadow: 0 0 1px #F48F0A;}
  </style>

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
              Enjoy your meal
            <?php  }
            else { ?>
              Confirm The reception
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


              <!-- Start Code rating starrrrrrssssss -->
              <div class="rating">
                <div id="restaurant-<?php echo $t["id_restaurant"]; ?>" style="">
                  <input type="hidden" name="rating" id="rating" value="<?php echo $t["rating"]; ?>" />
                  <ul style=" display: block; list-style-type: disc; margin-block-start: 1em; margin-block-end: 1em;
                  margin-inline-start: 0px; margin-inline-end: 0px;padding-inline-start: 40px; margin:0;padding:0;" 
                  onMouseOut="resetRating(<?php echo $t["id_restaurant"]; ?>);">
                  <?php
                  for($i=1;$i<=5;$i++) {
                    $selected = "";
                    if(!empty($t["rating"]) && $i<=$t["rating"]) {
                      $selected = "selected";
                    }
                    ?>
                    <li class='<?php echo $selected; ?>'
                      style="display: inline-block"
                      onmouseover="highlightStar(this,<?php echo $t["id_restaurant"]; ?>);" 
                      onmouseout="removeHighlight(<?php echo $t["id_restaurant"]; ?>);" 
                      onClick="addRating(this,<?php echo $t["id_restaurant"]; ?>);">&#9733;
                    </li>  
                  <?php }  ?>
                </ul>
              </div>
            </div>      
            <!-- End of Code rating starrrrrrssssss -->
            <a class="primary-border genric-btn  circle button-group-area mt-10" id="getit"
            var idinternaute=<?php echo $t['id_internaute'];?>
            var idnourriture=<?php echo $t['id_nourriture'];?>
            var dateC="<?php echo $t['datep'];?>"
            data-toggle="modal" data-target=".bs-example-modal-sm" value="<?php echo $t['etat'] ?>" style="display:<?php echo $t['etat']==1  ?'inline-block':'none'?>;">I Get it</a>        
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
        <h5 class="modal-title" id="exampleModalCenterTitle">Confirm Reception of Your Meal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Did you received Your Meal ? 
      </div>
      <div class="modal-footer">
        <a type="submit" id="submit-link" class="btn btn-primary">Yes</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>    
<!-- ENDDDDDDDDDD MODALLLLLLLLLLLLLLLLLLL DELETE -->

</div>
</div>
<?php include('footer.php');?>
<script>
 $(".primary-border").click(function(){  
   $("#submit-link").attr('href','order_tracking.php?idi='+$(this).attr('idinternaute')+'&idn='+$(this).attr('idnourriture')+'&datep='+$(this).attr('dateC')+'&action=received');   
 });
</script>


</body>
</html>