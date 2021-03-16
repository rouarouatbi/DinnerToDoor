<?php include('header.php');
include('./models/Nourriture.php');
include('./models/Panier.php');
$nourriture = new Nourriture();
$tab=$nourriture->read();

$val=isset($_POST['action'])? $_POST['action'] : '';

$comm= new Panier();
$comm->setId_internaute($_SESSION['idU']);
$list_commande=$comm->readByDay();

if($val=='Book'){
  $comm->setId_internaute($_SESSION['idU']);
  $comm->setId_nourriture($_POST['idnourriture']);
  $comm->setQuantite($_POST['quantity']);
  $comm->create();
}
?>
<link rel="stylesheet" type="text/css" href="./assets/css/rating.css">
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
            <a href="index.php"><img src="assets/images/logo/logo2.png" alt="logo"  style="width: 100px;height: 100px;"></a>
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
          <h1><i>Our Menu</i></h1>
          <p class="pt-2"><i>Beast kind form divide night above let moveth bearing darkness.</i></p>
        </div>
      </div>
    </div>
  </section>
  <!-- Banner Area End -->

  <!-- Food Area starts -->
  <section class="food-area section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <div class="section-top">
            <h3><span class="style-change">we serve</span> <br>delicious food</h3>
            <p class="pt-3">They're fill divide i their yielding our after have him fish on there for greater man moveth, moved Won't together isn't for fly divide mids fish firmament on net.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <?php foreach($tab as $t){ ?>
          <div class="col-md-4 col-sm-6">
            <div class="single-food">
             <input type="hidden" name="des" id="desc" value="<?php  echo $t['description']; ?>">
             <div class="food-img">
              <img src="files/<?php  echo $t['image']; ?>" class="img-fluid" alt="">
            </div>
            <div class="food-content">
              <div class="d-flex justify-content-between">
                <h5><?php  echo $t['nom_nourriture']; ?></h5>
                <span class="style-change"><?php  echo $t['prix']; ?></span>
              </div>

              <?php $val=$t['description'];
              if (strlen($val)>60){ ?>

                <div><?php echo (substr($val,0,60)) ?>...</div>
              <?php } 
              else {?>           
                <p class="pt-3" id="descr"><?php  echo $t['description']; ?></p>
              <?php } ?>
              <div class="row">
                  <a href="Resto.php?id=<?php echo $t['id_restaurant'];?>" style="float: left;"><h5 style=" margin-top: 20px;margin-left: 18px;"><?php echo $t['nom'];?></h5><img src="logos/<?php echo $t['logo']; ?>" class="img-fluid" alt="logo resto" style="width: 11%; margin-top: -38px; margin-right: 190px; float: right;"></a>      
              </div>
              <div class="row"> 
                <div class="col-md-6">
                  <a href="#" class="template-btn3 mt-3" data-toggle="modal" data-target=".bs-example-modal-sm1" 
                  var idnourriture=<?php echo $t['id_nourriture'];?> 
                  var typen=<?php echo $t['type'];?> 
                  var prixnourriture=<?php echo $t['prix'] ; ?> 
                  var descriptionnourriture="<?php echo $t['description'];?>" 
                  var  facture="<?php  echo $t['nom_nourriture']; ?><?php  echo $t['prix'];?>">book this food <span><i class="fa fa-long-arrow-right"></i></span></a>  

                </div>
                <div class="col-md-6">
                  <a href="#" class="template-btn3 mt-3" data-toggle="modal" data-target=".bs-example-modal-sm"var descriptionnourriture="<?php echo $t['description'];?>">read more</a>

                </div>
              </div>
            </div>

          </div>
        </div>  
                    <!-- <br>
                      <br> -->

                      <!-- MODALLLLLLLLLLLLLLLLLLL BOOK Meal-->
                      <div class="modal fade bs-example-modal-sm1" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalCenterTitle">Book Meal</h5>
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
                                        
                                          <input class="form-control"  id="idnourriture" name="idnourriture" type="hidden">              
                                          <!-- <input name="typen" type="text"  id="typen" placeholder="Enter your type" required disabled=""> -->
                                          <input name="prix" type="text"  id="prix" value="<?php echo $t['prix'];?>" placeholder="Enter price" required disabled="" class="form-control" style="margin-bottom: 20px;">
                                          
                                        
                                          <textarea class="form-control"name="description" cols="20" rows="3" id="description" placeholder="Enter your description" required disabled="" style="margin-bottom: 20px;"><?php echo $t['description'];?></textarea>
                                          <input name="quantity" class="form-control" type="number"  id="quantity" placeholder="Enter Quantity" min="1" style="margin-bottom: 20px;" required >
                                          <!-- <input type="file" class="form-control-file" id="image" name="image"> -->
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="margin-right: 30px;">Cancel</button>
                                          <button  class="btn btn-primary"  style="background-color: #131230; border-color: #131230;     margin-right: -15px;"type="submit" name="action" id="book" value="Book" var  facture="<?php  echo $t['nom_nourriture']; ?><?php  echo $t['prix'];?>" onclick="window.location.reload();">Book</button>
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


                      <!-- MODALLLLLLLLLLLLLLLLLLL read more-->
                      <div class="modal fade bs-example-modal-sm" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalCenterTitle">Description</h5>
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
                                        <p><?php echo $t['description'];?></p>
                                     
                                        <div class="modal-footer">
                                         <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
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
                     <!-- END MODALLLLLLLLLLLLLLLLLLL read more-->    
                   <?php } ?>    
                 </div>
               </div>
             </section>


             <button class="open-button" onclick="openForm()">commands</button>

             <div class="chat-popup" id="myForm">
              <form action="/action_page.php" class="form-container" style="max-height: 450px;overflow: scroll;">
                <h3>commands</h3>

                <label for="msg"><b>commands</b></label>
                <!--  <textarea placeholder="Type message.." name="msg" required></textarea> -->
                <?php 
                if($list_commande!= null){
                  foreach($list_commande as $c){ ?>

                    <div class="row">
                      <div class="col-md-9 mt-sm-20 left-align-p">
                        <!-- <p id="facture"> </p> -->
                        <p id="facture">  <?php  echo $c['nom_nourriture']; ?> x <?php  echo $c['quantite']; ?> | <?php  echo $c['quantite']*$c['prix']; ?> Dinars </p>
                        <hr>
                      </div>
                    </div>
                  <?php }
                }
                else{
                  ?> 
                  <p>You still don't have any command</p>
                <?php }
                ?> 
              </form>
              <button type="button" class="genric-btn fash" onclick="closeForm()">Close</button>
              <a href="commande.php" type="button"style="margin-left: 39px;" class="genric-btn primary-border">Send</a>
              
              
            </div>
            <!-- Food Area End -->
            <?php include('footer.php');?>



            <script>
              function openForm() {
                document.getElementById("myForm").style.display = "block";
              }

              function closeForm() {
                document.getElementById("myForm").style.display = "none";
              }
            </script>
            <script type="text/javascript">
              var text =document.getElementById("desc").value ;
              var char_limit = 5;
              if(text.length < char_limit){
                document.getElementById("descr").value='hello';
              }

            </script>

            <script type="text/javascript">
              var text =document.getElementById("desc").value ;
              var char_limit = 5;
              if(text.length < char_limit){
                document.getElementById("descr").value='hello';
              }

            </script>

            <script >

              $(".template-btn3").click(function(){ 
              // var facture=$(this).attr('facture');
              // alert($(this).attr('facture'));
              $("#idnourriture").prop('value',$(this).attr('idnourriture'));  
              $("#typen").prop('value',$(this).attr('typen')); 
              $("#prix").prop('value',$(this).attr('prixnourriture'));

              $('#description').val($(this).attr('descriptionnourriture'));
              
            }); 
          </script>

          <script >
            reload(){
              location.reload();
            }
            
            // alert(facture);
            // $('#facture').text(facture);
            
          </script> 
   <!--      <script type="text/javascript">
          $.post('menu.php', { field1: "hello", field2 : "hello2"}, 
          function(returnedData){
           console.log(returnedData);
         });
       </script> -->

     </body>
     </html>