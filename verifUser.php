<?php
session_start();
include('./models/Internaute.php');
include('./models/Restaurant.php');
$int = new Internaute();
$restaurant=new restaurant();
// recuperation de contenue des champs email et password 
$email = $_POST['email']; 
$mdp = $_POST['mdp']; 
$user=$_POST['user'];
if ($user=='restaurant') {
	echo $mdp;	
	echo $email;
	$restaurant->setEmail_restaurant($email);
	$DB_PWD=$restaurant->GetPWD()['mot_de_passe'];
	echo var_dump($DB_PWD);
	$verify=password_verify($mdp, $DB_PWD);
	if(password_verify($mdp, $DB_PWD)){
		$resResto=$restaurant->login($email,$DB_PWD);
		
	}	
}
elseif ($user=='internaute') {
	$DB_PWD=$int->GetPWD($email)['mot_de_passe'];

	$verify=password_verify($mdp, $DB_PWD);
	if(password_verify($mdp, $DB_PWD)){
		$resI = $int->login($email,$DB_PWD); 		
	}		
}
if($resResto){
	$_SESSION['idU']= $resResto['id_restaurant'];
	$_SESSION['nomU']= $resResto['nom'];
	$_SESSION['emailU']= $resResto['email'];
	$_SESSION['roleU']= "RESTO";
	header('Location:add_meal.php'); 
}
elseif($resI){
	$_SESSION['idU']= $resI['id_internaute'];
	$_SESSION['emailU']= $resI['email'];
	$_SESSION['nomU']= $resI['nom'].' '.$resI['prenom'];
	$_SESSION['adressU']= $resI['adresse'];
	$_SESSION['roleU']= "INTERNAUTE";
	header('Location:menu.php'); 
}

else { 
	header('Location:login.php?error=1'); 	
}
?>