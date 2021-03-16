<?php
include_once'./config/connection.php';
class internaute{

	protected $id_internaute;
	protected $email;
	protected $mot_de_passe;
	protected $nom;
	protected $prenom;
	protected $adresse;
	protected $numero_tel;

	function getId_internaute() {
		return $this->id_internaute;
	}

	function getEmail() {
		return $this->email;
	}

	function getMot_de_passe() {
		return $this->mot_de_passe;
	} 

	function getNom() {
		return $this->nom;
	}   
	function getPrenom() {
		return $this->prenom;
	}   
	function getAdresse() {
		return $this->adresse;
	}   
	function getNumero_tel() {
		return $this->numero_tel;
	}       

	function setId_internaute($id_internaute) {
		$this->id_internaute = $id_internaute;
	}

	function setEmail($email) {
		$this->email = $email;
	}

	function setMot_de_passe($mot_de_passe) {
		$this->mot_de_passe = $mot_de_passe;
	}

	function setNom($nom) {
		$this->nom = $nom;
	}

	function setPrenom($prenom) {
		$this->prenom = $prenom;
	}

	function setAdresse($adresse) {
		$this->adresse = $adresse;
	}

	function setNumero_tel($numero_tel) {
		$this->numero_tel = $numero_tel;
	}


	function create() {
		$this->connection = new Connection();
		$conn = $this->connection->openConnection();
		$conn->exec("SET CHARACTER SET utf8");

		$insert = $conn->prepare("INSERT INTO `internaute` ( `email`, `mot_de_passe`, `nom`, `prenom`, `adresse`, `numero_tel`) VALUES ( :email,:mot_de_passe,:nom,:prenom,:adresse,:numero_tel)");

		try {

			$result = $insert->execute(array('email' => $this->getEmail(),'mot_de_passe' => $this->getMot_de_passe(),'nom' => $this->getNom(),
				'prenom' => $this->getPrenom(),'adresse' => $this->getAdresse(),'numero_tel' => $this->getNumero_tel()));
			/*if ($result) {
				header('Location:listChapitres.php?msg=1');
			} else {
				echo "<i style='color:red'>There are some problem while saving the Data...! <i>";
			}*/
		} catch (PDOExecption $e) {
			print "Error!: " . $e->getMessage() . "</br>";
		}

		$this->connection->closeConnection();

	}

	function GetPWD($email) {

		$this->connection = new Connection();
		$conn = $this->connection->openConnection();

		$read = $conn->prepare("SELECT mot_de_passe FROM internaute WHERE email=:email");
		$read->execute(array('email' => $email));
		if ($read->rowCount() > 0) {
			return $read->fetch(PDO::FETCH_ASSOC);
		} 
		$this->connection->closeConnection();
	}


	function login($email,$mdp) {

		$this->connection = new Connection();
		$conn = $this->connection->openConnection();

		$read = $conn->prepare("SELECT * FROM internaute WHERE email=:email");
		$read->execute(array('email' => $email));
		if ($read->rowCount() > 0) {
			return $read->fetch(PDO::FETCH_ASSOC);
		} 
		$this->connection->closeConnection();
	}

	// function login($email,$mdp) {

	// 	$this->connection = new Connection();
	// 	$conn = $this->connection->openConnection();

	// 	$read = $conn->prepare("SELECT * FROM internaute WHERE email=:email AND mot_de_passe=:mdp");
	// 	$read->execute(array('email' => $email,'mdp'=>$mdp));
	// 	if ($read->rowCount() > 0) {
	// 		return $read->fetch(PDO::FETCH_ASSOC);
	// 	} 
	// 	$this->connection->closeConnection();
	// }

	function read() {

		$this->connection = new Connection();
		$conn = $this->connection->openConnection();
		$conn->exec("SET CHARACTER SET utf8");

		$read = $conn->prepare("SELECT * FROM internaute");
		$read->execute();

		if ($read->rowCount() > 0) {
			return $read->fetchAll(PDO::FETCH_ASSOC);

		} else {
			echo "<i style='color:red'>No Record Found<i>";
			return (false);
		}

		$this->connection->closeConnection();
	}

	function update() {

		$this->connection = new Connection();
		$conn = $this->connection->openConnection();

		$insert = $conn->prepare("UPDATE `internaute` SET `nom` =:nom, `email`=:email, `mot_de_passe` =:mot_de_passe,`prenom` =:prenom,
			`numero_tel` =:numero_tel,`adresse` =:adresse WHERE id_internaute=:id_internaute");
		
		try {

			$result = $insert->execute(array('email' => $this->getEmail(),'mot_de_passe' => $this->getMot_de_passe(),'nom' => $this->getNom(),
				'prenom' => $this->getPrenom(),'adresse' => $this->getAdresse(),'numero_tel' => $this->getNumero_tel()));
			/*if ($result) {
				header('Location:listChapitres.php?msg=1');
			} else {
				echo "<i style='color:red'>There are some problem while saving the Data...! <i>";
			}*/
		} catch (PDOExecption $e) {
			print "Error!: " . $e->getMessage() . "</br>";
		}

		$this->connection->closeConnection();

	}


	function delete($id_internaute) {
		$this->connection = new Connection();
		$conn = $this->connection->openConnection();
		try {
			if($conn){
				$deleteUser = $conn->prepare("DELETE from internaute where id_internaute =:id_internaute");
				$deleteUser->execute(
					array('id_internaute' => $id_internaute));
				/*header('Location:listChapitres.php');*/
				/*echo "<i style='color:green'>User Record deleted Successfully..! <i>";
				*/
			// 	if($deleteUser) {
			// 		header('Location:listChapitres.php?msg=3');
			// 	}
			// } else {

			// 	echo "une erreur c'est produite...!";
			// }
			}
		} catch (PDOExecption $e) {
			/*$conn->rollback();*/
			print "Error!: " . $e->getMessage() . "</br>";
		}

		$this->connection->closeConnection();
	}

	function selectInternauteById($id_internaute) {
		$this->connection = new Connection();
		$conn = $this->connection->openConnection();
		$conn->exec("SET CHARACTER SET utf8");

		$read = $conn->prepare("SELECT * FROM internaute where id_internaute=:id_internaute");
		$read->execute(array('id_internaute' => $id_internaute));

		if ($read->rowCount() > 0) {
			return $read->fetch(PDO::FETCH_ASSOC);
		} 
		$this->connection->closeConnection();

	}

	//this function will be used when the commandd is confirmed
	function updateStreet() {

		$this->connection = new Connection();
		$conn = $this->connection->openConnection();

		$insert = $conn->prepare("UPDATE `internaute` SET`adresse`=:adresse WHERE `id_internaute`=:internaute");
		try {
			$result = $insert->execute(array('internaute' => $this->getId_internaute(),'adresse' => $this->getAdresse()));
		} catch (PDOExecption $e) {
			print "Error!: " . $e->getMessage() . "</br>";
		}
		$this->connection->closeConnection();
	}
















































	// functions
// 	function getAllChapitres(){
// 		$cnx = new PDO('mysql:host=localhost;dbname=fmt', 'root', '');
// 		$cnx->exec("SET CHARACTER SET utf8");
// 		$req = $cnx->query("select * from chapitre, matiere 
// 				where matiere.id_mat = chapitre.matiere");
// 		$res = $req->fetchALL(); 
// 		return $res ; 
// 	}
	
// 	function getChapitreById($id){
// 		$cnx = new PDO('mysql:host=localhost;dbname=fmt', 'root', '');
// 		$cnx->exec("SET CHARACTER SET utf8");
// 		$req = $cnx->query("select * from chapitre where id_internaute = '".$id."' ");
// 		$res = $req->fetch(); 
// 		return $res ; 
// 	}

// 	function getChapitreByNom($nom){
// 		$cnx = new PDO('mysql:host=localhost;dbname=fmt', 'root', '');
// 		$cnx->exec("SET CHARACTER SET utf8");
// 		$req = $cnx->query("select * from chapitre where libelle_chap = '".$nom."' ");
// 		$res = $req->fetch(); 
// 		return $res ; 
// 	}
	
// 	function addChapitre($c){
// 		$cnx = new PDO('mysql:host=localhost;dbname=fmt', 'root', '');
// 		$cnx->exec("SET CHARACTER SET utf8");
// 		$res = $cnx->exec(" INSERT INTO `chapitre` (`libelle_chap`, `description_chap`, `matiere`) 
// 					VALUES ('".$c->getLibelle_Chap()."', '".$c->getDescription_Chap()."', '".$c->getMatiere()."') "); 
// 		return $res ; 
// 	}
	
// function editChapitre($c){
// 		$cnx = new PDO('mysql:host=localhost;dbname=fmt', 'root', '');
// 		$res = $cnx->exec("  UPDATE `chapitre` SET 
// 						`libelle_chap` = '".$c->getLibelle_Chap()."', 
// 						`matiere` = '".$c->getMatiere()."' ,
// 						`description_chap` = '".$c->getDescription_Chap()."' 
// 						WHERE `chapitre`.`id_internaute` = '".$c->getid_internaute()."' "); 
// 		return $res ; 
// 	}
	
// 	function deleteChapitre($id){
// 		$cnx = new PDO('mysql:host=localhost;dbname=fmt', 'root', '');
// 		$res = $cnx->exec("delete from chapitre where id_internaute = '".$id."' "); 
// 		return $res ; 
// 	}
}

?>