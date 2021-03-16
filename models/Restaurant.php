<?php
include_once'./config/connection.php';
class Restaurant{

	protected $id_restaurant;
	protected $nom_restaurant;
	protected $email_restaurant;
	protected $mdp;
	protected $adresse_restaurant;
	protected $rating_restaurant;
	protected $tel_restaurant;
	protected $logo;

	public function getId_restaurant(){
		return $this->id_restaurant;
	}

	public function setId_restaurant($id_restaurant){
		$this->id_restaurant = $id_restaurant;
	}

	public function getNom_restaurant(){
		return $this->nom_restaurant;
	}

	public function setNom_restaurant($nom_restaurant){
		$this->nom_restaurant = $nom_restaurant;
	}

	public function getEmail_restaurant(){
		return $this->email_restaurant;
	}

	public function setEmail_restaurant($email_restaurant){
		$this->email_restaurant = $email_restaurant;
	}

	public function getMdp(){
		return $this->mdp;
	}

	public function setMdp($mdp){
		$this->mdp = $mdp;
	}

	public function getAdresse_restaurant(){
		return $this->adresse_restaurant;
	}

	public function setAdresse_restaurant($adresse_restaurant){
		$this->adresse_restaurant = $adresse_restaurant;
	}

	public function getRating_restaurant(){
		return $this->rating_restaurant;
	}

	public function setRating_restaurant($rating_restaurant){
		$this->rating_restaurant = $rating_restaurant;
	}

	public function getTel_restaurant(){
		return $this->tel_restaurant;
	}

	public function setTel_restaurant($tel_restaurant){
		$this->tel_restaurant = $tel_restaurant;
	}

	public function getLogo(){
		return $this->logo;
	}

	public function setLogo($logo){
		$this->logo = $logo;
	}

	function create() {
		$this->connection = new Connection();
		$conn = $this->connection->openConnection();
		$conn->exec("SET CHARACTER SET utf8");

		$insert = $conn->prepare("INSERT INTO `restaurant`(`nom`, `email`, `mot_de_passe`, `adresse`, `rating`, `telephone`, `logo`) VALUES (:nom,:email,:mdp,:adresse,:rating,:tel,:logo)");

		try {

			$result = $insert->execute(array('nom' => $this->getNom_restaurant(),'email' => $this->getEmail_restaurant(),'mdp' => $this->getMdp(),
				'adresse' => $this->getAdresse_restaurant(),'rating' => $this->getRating_restaurant(),'tel' => $this->getTel_restaurant(),'logo' => $this->getLogo()));
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

	function GetPWD() {

		$this->connection = new Connection();
		$conn = $this->connection->openConnection();
		$conn->exec("SET CHARACTER SET utf8");
		$read = $conn->prepare("SELECT  `mot_de_passe` FROM `restaurant` WHERE email=:email");
		$read->execute(array('email' =>$this->getEmail_restaurant()));
		if ($read->rowCount() > 0) {
			return $read->fetch(PDO::FETCH_ASSOC);
		} 
		$this->connection->closeConnection();
	}
	function login($email,$mdp) {

		$this->connection = new Connection();
		$conn = $this->connection->openConnection();

		$read = $conn->prepare("SELECT * FROM restaurant WHERE email=:email AND mot_de_passe=:mdp");
		$read->execute(array('email' => $email,'mdp'=>$mdp));
		if ($read->rowCount() > 0) {
			return $read->fetch(PDO::FETCH_ASSOC);
		} 
		
		$this->connection->closeConnection();
	}
	function read() {

		$this->connection = new Connection();
		$conn = $this->connection->openConnection();
		$conn->exec("SET CHARACTER SET utf8");

		$read = $conn->prepare("SELECT * FROM restaurant");
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

		$insert = $conn->prepare("UPDATE `restaurant` SET `nom`=:nom,`email`=:email,`adresse`=:adresse,`telephone`=:tel,`logo`=:logo WHERE id_restaurant=:restaurant_id");

		try {
			$result = $insert->execute(array('restaurant_id' => $this->getId_restaurant(),'nom' => $this->getNom_restaurant(),'email' => $this->getEmail_restaurant(),'adresse' => $this->getAdresse_restaurant(),'tel' => $this->getTel_restaurant(),'logo'=>$this->getLogo()));

		} catch (PDOExecption $e) {
			print "Error!: " . $e->getMessage() . "</br>";
		}

		$this->connection->closeConnection();

	}


	function delete($id_restaurant) {
		$this->connection = new Connection();
		$conn = $this->connection->openConnection();
		try {
			if($conn){
				$deleteUser = $conn->prepare("DELETE FROM `restaurant` WHERE id_restaurant =:id_restaurant");
				$deleteUser->execute(
					array('id_restaurant' => $id_restaurant));
			}
		} catch (PDOExecption $e) {
			print "Error!: " . $e->getMessage() . "</br>";
		}

		$this->connection->closeConnection();
	}

	function selectRestauranteById($id_restaurant) {
		$this->connection = new Connection();
		$conn = $this->connection->openConnection();
		$conn->exec("SET CHARACTER SET utf8");

		$read = $conn->prepare("SELECT * FROM restaurant where id_restaurant =:id_restaurant");
		$read->execute(array('id_restaurant' => $id_restaurant));

		if ($read->rowCount() > 0) {
			return $read->fetch(PDO::FETCH_ASSOC);
		} 
		$this->connection->closeConnection();

	}

	//This function allow to show the list of food before confirmation 
	function readByResto() {

		$this->connection = new Connection();
		$conn = $this->connection->openConnection();
		$conn->exec("SET CHARACTER SET utf8");

		$read = $conn->prepare(" SELECT * FROM `nourriture`,`panier`,`restaurant` WHERE`panier`.`id_nourriture`=`nourriture`.`id_nourriture` AND `nourriture`.`id_restaurant`=`restaurant`.`id_restaurant` AND`restaurant`.`id_restaurant`=:id_resto AND DATE_FORMAT(`panier`.`datep`, '%Y-%m-%d') = DATE_FORMAT(SYSDATE(), '%Y-%m-%d')AND `panier`.`etat`=0 AND `panier`.`proceed`=1 ");
		$read->execute(array('id_resto' => $this->getId_restaurant()));

		if ($read->rowCount() > 0) {
			return $read->fetchAll(PDO::FETCH_ASSOC);
		}

		$this->connection->closeConnection();
	}
	
	
//This function will updateThe Rating 
	function updateRatingCount($rating, $id_restaurant)
	{

		$this->connection = new Connection();
		$conn = $this->connection->openConnection();

		$insert = $conn->prepare("UPDATE `restaurant` SET `rating`=:rating WHERE id_restaurant=:restaurant_id");

		try {
			$result = $insert->execute(array('restaurant_id' => $this->getId_restaurant(),'rating' => $this->getRating_restaurant()));

		} catch (PDOExecption $e) {
			print "Error!: " . $e->getMessage() . "</br>";
		}

		$this->connection->closeConnection();

	}

}

?>