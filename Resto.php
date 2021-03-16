<?php include('header.php');
include('./models/Restaurant.php');
$id_resto=$_GET['id'];
$resto = new Restaurant();
$tab=$resto->selectRestauranteById($id_resto);
?>
<!-- Script de rating Starrrrrrssssssss -->
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>

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
  <!-- ENDDDDD Rating SCRIPPPPPTTTTTTTT -->
  <link rel="stylesheet" type="text/css" href="./assets/css/rating.css">
  <body>
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
    <section class="banner-area banner-area2 text-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h1><i>The best Restaurants there is</i></h1>
          </div>
        </div>
      </div>
    </section>
    <!-- Banner Area End -->

    <div class="whole-wrap">
      <div class="container">
       <?php 
       if($tab!= null){ ?>
        <div class="section-top-border">   
          <div class="row">
            <!-- pour voir structure d'un tableau <p><?php  echo var_dump($tab); ?></p>-->
            <div class="col-md-3">
              <img src="logos/<?php  echo $tab['logo']; ?>" style="max-width: 250px;  "/>
            </div>
            <div class="col-md-9 mt-sm-20 left-align-p">
              <h2 style="color: #131230;margin-top: 25px;"> Name: <?php  echo $tab['nom']; ?></h2>
              <!-- Start Code rating starrrrrrssssss -->
              <div class="rating">
                <div id="restaurant-<?php echo $tab["id_restaurant"]; ?>" style="margin-bottom: 40px">
                  <input type="hidden" name="rating" id="rating" value="<?php echo $tab["rating"]; ?>" />
                  <ul style=" display: block; list-style-type: disc; margin-block-start: 1em; margin-block-end: 1em;
                  margin-inline-start: 0px; margin-inline-end: 0px;padding-inline-start: 40px; margin:0;padding:0;" 
                  onMouseOut="resetRating(<?php echo $tab["id_restaurant"]; ?>);">
                  <?php
                  for($i=1;$i<=5;$i++) {
                    $selected = "";
                    if(!empty($t["rating"]) && $i<=$t["rating"]) {
                      $selected = "selected";
                    }
                    ?>
                    <li class='<?php echo $selected; ?>'
                      style="display: inline-block"
                      onmouseover="highlightStar(this,<?php echo $tab["id_restaurant"]; ?>);" 
                      onmouseout="removeHighlight(<?php echo $tab["id_restaurant"]; ?>);" 
                      onClick="addRating(this,<?php echo $tab["id_restaurant"]; ?>);">&#9733;
                    </li>  
                  <?php }  ?>
                </ul>
              </div>
            </div>      
            <!-- End of Code rating starrrrrrssssss -->
              <p style="font-size: 17px;"> Email: <?php  echo $tab['email']; ?></p>
              <p style="margin-bottom: 40px;font-size: 17px;"> Phone: <?php  echo $tab['telephone']; ?></p>

              <p style="font-size: 17px;"> Adresse: <?php  echo $tab['adresse']; ?></p>
              

          </div>
        </div>
      </div>
    <?php }?> 

    <!-- <button type="submit" name="action" value="Valider" class="template-btn" style="float: right; margin-bottom: 30px;">Proceed</button> -->
  </div>
</div>
<?php include('footer.php');?>
</body>
</html>