<?php 
include ('./models/Restaurant.php');

// Add Rating by calling the function updateRatingCount
if(!empty($_POST["rating"]) && !empty($_POST["id"])) {
  $resto= new Restaurant();
  $resto->updateRatingCount($_POST["rating"], $_POST["id"]);
}



 ?>