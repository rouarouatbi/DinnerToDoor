<?php
include_once'./config/connection.php';
class Nourriture{

	protected $id_nourriture;
	protected $nom_nourriture;
	protected $description;
	protected $prix;
	protected $type;
	protected $restaurant;
	protected $photo;
	

	public function getId_nourriture(){
		return $this->id_nourriture;
	}

	public function setId_nourriture($id_nourriture){
		$this->id_nourriture = $id_nourriture;
	}
	public function getNom_nourriture(){
		return $this->nom_nourriture;
	}

	public function setNom_nourriture($nom_nourriture){
		$this->nom_nourriture = $nom_nourriture;
	}

	public function getDescription(){
		return $this->description;
	}

	public function setDescription($description){
		$this->description = $description;
	}

	public function getPrix(){
		return $this->prix;
	}

	public function setPrix($prix){
		$this->prix = $prix;
	}

	public function getType(){
		return $this->type;
	}

	public function setType($type){
		$this->type = $type;
	}

	public function getRestaurant(){
		return $this->restaurant;
	}

	public function setRestaurant($restaurant){
		$this->restaurant = $restaurant;
	}

	public function getPhoto(){
		return $this->photo;
	}

	public function setPhoto($photo){
		$this->photo = $photo;
	}
// la méthode create permet la création de nourriture 
	function create() {
		$this->connection = new Connection();
		$conn = $this->connection->openConnection();
		$conn->exec("SET CHARACTER SET utf8");

		$insert = $conn->prepare("INSERT INTO `nourriture`(`nom_nourriture`,`description`, `prix`, `type`, `id_restaurant`, `image`) VALUES (:nom_nourriture,:description,:prix,:type,:restaurant,:image)");

		try {

			$result = $insert->execute(array('nom_nourriture' => $this->getNom_nourriture(),'description' => $this->getDescription(),'prix' => $this->getPrix(),'type' => $this->getType(),'restaurant' => $this->getRestaurant(),'image' => $this->getPhoto()));
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
	function read() {

		$this->connection = new Connection();
		$conn = $this->connection->openConnection();
		$conn->exec("SET CHARACTER SET utf8");

		$read = $conn->prepare("SELECT * FROM nourriture n,`restaurant` r WHERE n.`id_restaurant`=r.`id_restaurant`");
		$read->execute();

		if ($read->rowCount() > 0) {
			return $read->fetchAll(PDO::FETCH_ASSOC);

		} else {
			echo "<i style='color:red'>No Record Found<i>";
			return (false);
		}

		$this->connection->closeConnection();
	}

	function readAll() {

		$this->connection = new Connection();
		$conn = $this->connection->openConnection();

		$read = $conn->prepare("SELECT * FROM nourriture WHERE id_restaurant=:restaurant");
		$read->execute(array('restaurant' => $this->getRestaurant()));

		if ($read->rowCount() > 0) {
			return $read->fetchAll(PDO::FETCH_ASSOC);

		} else {
			echo "<i style='color:red'>No Record Found<i>";
			return (false);
		}

		$this->connection->closeConnection();
	}

	function update($nourriture) {

		$this->connection = new Connection();
		$conn = $this->connection->openConnection();

		$insert = $conn->prepare("UPDATE `nourriture` SET `description`=:description,`prix`=:prix,`type`=:type WHERE id_nourriture=:id_nourriture");
		try {
			$result = $insert->execute(array('description' => $this->getDescription(),'prix' => $this->getPrix(),'type' => $this->getType(),'id_nourriture' => $nourriture));
			if ($result) {
				header('Location:list_meals.php?done=1');
			} else {
				header('Location:list_meals.php?errr=');
			}
			
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
				$deleteUser = $conn->prepare("DELETE from nourriture where id_nourriture =:id_nourriture");
				$deleteUser->execute(
					array('id_nourriture' => $id_internaute));
			}
		} catch (PDOExecption $e) {
			/*$conn->rollback();*/
			print "Error!: " . $e->getMessage() . "</br>";
		}

		$this->connection->closeConnection();
	}

	function selectNourritureById($id_nourriture) {
		$this->connection = new Connection();
		$conn = $this->connection->openConnection();
		$conn->exec("SET CHARACTER SET utf8");

		$read = $conn->prepare("SELECT * FROM `nourriture` where id_nourriture=:id_nourriture");
		$read->execute(array('id_nourriture' => $id_nourriture));

		if ($read->rowCount() > 0) {
			return $read->fetch(PDO::FETCH_ASSOC);
		} 
		$this->connection->closeConnection();

	}


}

?>