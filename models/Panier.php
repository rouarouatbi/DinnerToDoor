<?php
include_once'./config/connection.php';
class Panier{

	protected $id_internaute;
	protected $id_nourriture;  
	protected $quantite;
	protected $date;

	// functions

	public function getId_internaute(){
		return $this->id_internaute;
	}

	public function setId_internaute($id_internaute){
		$this->id_internaute = $id_internaute;
	}

	public function getId_nourriture(){
		return $this->id_nourriture;
	}

	public function setId_nourriture($id_nourriture){
		$this->id_nourriture = $id_nourriture;
	}

	public function getQuantite(){
		return $this->quantite;
	}

	public function setQuantite($quantite){
		$this->quantite = $quantite;
	}

	public function getDate(){
		return $this->date;
	}

	public function setDate($date){
		$this->date = $date;
	}

	function create() {
		$this->connection = new Connection();
		$conn = $this->connection->openConnection();
		$conn->exec("SET CHARACTER SET utf8");

		$insert = $conn->prepare("INSERT INTO `panier`(`id_internaute`, `id_nourriture`, `quantite`) VALUES (:id_internaute,:id_nourriture,:quantite)");

		try {

			$result = $insert->execute(array('id_internaute' => $this->getId_internaute(),'id_nourriture' => $this->getId_nourriture(),'quantite' => $this->getQuantite()));
		} catch (PDOExecption $e) {
			print "Error!: " . $e->getMessage() . "</br>";
		}

		$this->connection->closeConnection();

	}

	function read() {

		$this->connection = new Connection();
		$conn = $this->connection->openConnection();
		$conn->exec("SET CHARACTER SET utf8");

		$read = $conn->prepare(" SELECT * FROM `panier` p, `nourriture` n, `restaurant` r WHERE p.id_nourriture=n.id_nourriture AND p.id_internaute=:id_internaute AND r.`id_restaurant`=n.id_restaurant  AND p.recu=0 AND p.etat=1");
		$read->execute(array('id_internaute' => $this->getId_internaute()));

		if ($read->rowCount() > 0) {
			return $read->fetchAll(PDO::FETCH_ASSOC);
		}

		$this->connection->closeConnection();
	}

	function readByDay() {

		$this->connection = new Connection();
		$conn = $this->connection->openConnection();
		$conn->exec("SET CHARACTER SET utf8");

		$read = $conn->prepare(" SELECT * FROM `panier` p, `nourriture` n WHERE p.id_nourriture=n.id_nourriture AND p.id_internaute=:id_internaute AND DATE_FORMAT(`datep`, '%Y-%m-%d') = DATE_FORMAT(SYSDATE(), '%Y-%m-%d')AND proceed=0" );
		$read->execute(array('id_internaute' => $this->getId_internaute()));

		if ($read->rowCount() > 0) {
			return $read->fetchAll(PDO::FETCH_ASSOC);
		}

		$this->connection->closeConnection();
	}


	function delete() {
		$this->connection = new Connection();
		$conn = $this->connection->openConnection();
		try {
			if($conn){
				$deleteUser = $conn->prepare("DELETE from panier where id_nourriture =:id_nourriture AND id_internaute=:id_internaute AND datep=:datep");
				$deleteUser->execute(
					array('id_nourriture' => $this->getId_nourriture(),'id_internaute' => $this->getId_internaute(),'datep' => $this->getDate()));
			}
		} catch (PDOExecption $e) {
			print "Error!: " . $e->getMessage() . "</br>";
		}

		$this->connection->closeConnection();
	}
	//delete when not confirmed 
	function deleteNotConfirmed() {
		$this->connection = new Connection();
		$conn = $this->connection->openConnection();
		try {
			if($conn){
				$deleteUser = $conn->prepare("DELETE `panier`.* FROM `panier` INNER JOIN `nourriture` ON `panier`.`id_nourriture`=`nourriture`.`id_nourriture` INNER JOIN `restaurant`ON `nourriture`.`id_restaurant`=`restaurant`.`id_restaurant`WHERE `panier`.`id_internaute`=:id_internaute AND `panier`.id_nourriture=:id_nourriture AND `panier`.`datep`=:datep AND `panier`.`etat`=0 " );
				$deleteUser->execute(
					array('id_nourriture' => $this->getId_nourriture(),'id_internaute' => $this->getId_internaute(),'datep' => $this->getDate()));
			}
		} catch (PDOExecption $e) {
			print "Error!: " . $e->getMessage() . "</br>";
		}

		$this->connection->closeConnection();
	}
	//This function will update the quantity
	function update() {

		$this->connection = new Connection();
		$conn = $this->connection->openConnection();

		$insert = $conn->prepare("UPDATE `panier` SET `quantite`=:quantite WHERE id_internaute=:id_internaute AND id_nourriture=:id_nourriture AND datep=:datep");
		try {
			$result = $insert->execute(array('quantite' => $this->getQuantite(),'id_internaute' => $this->getId_internaute(),'id_nourriture' => $this->getId_nourriture(),'datep' => $this->getDate()));
			
		} catch (PDOExecption $e) {
			print "Error!: " . $e->getMessage() . "</br>";
		}
		$this->connection->closeConnection();
	}

//this function will be used when the commandd is confirmed
	function updateEtat() {

		$this->connection = new Connection();
		$conn = $this->connection->openConnection();

		$insert = $conn->prepare("UPDATE `panier` SET `etat`=1 WHERE `id_internaute`=:id_internaute AND `id_nourriture`=:id_nourriture AND `datep`=:datep");
		try {
			$result = $insert->execute(array('id_internaute' => $this->getId_internaute(),'id_nourriture' => $this->getId_nourriture(),'datep' => $this->getDate()));
		} catch (PDOExecption $e) {
			print "Error!: " . $e->getMessage() . "</br>";
		}
		$this->connection->closeConnection();
	}


//this function will be used when the commandd is confirmed
	function confirmReception() {

		$this->connection = new Connection();
		$conn = $this->connection->openConnection();

		$insert = $conn->prepare("UPDATE `panier` SET `recu`=1 WHERE `id_internaute`=:id_internaute AND `id_nourriture`=:id_nourriture AND `datep`=:datep");
		try {
			$result = $insert->execute(array('id_internaute' => $this->getId_internaute(),'id_nourriture' => $this->getId_nourriture(),'datep' => $this->getDate()));
		} catch (PDOExecption $e) {
			print "Error!: " . $e->getMessage() . "</br>";
		}
		$this->connection->closeConnection();
	}


	// ths function will be used when the internaute click on Proceed to confirm the book of command
	function Proceed() {

		$this->connection = new Connection();
		$conn = $this->connection->openConnection();

		$insert = $conn->prepare("UPDATE `panier` SET `proceed`=1 WHERE id_internaute=:id_internaute AND  DATE_FORMAT(`datep`, '%Y-%m-%d') = DATE_FORMAT(SYSDATE(), '%Y-%m-%d')");
		try {
			$result = $insert->execute(array('id_internaute' => $this->getId_internaute()));
			
		} catch (PDOExecption $e) {
			print "Error!: " . $e->getMessage() . "</br>";
		}
		$this->connection->closeConnection();
	}

//when the processis finished the command will be deleted from database
	function TheEnd() {

		$this->connection = new Connection();
		$conn = $this->connection->openConnection();
		try {
			if($conn){
				$deleteUser = $conn->prepare("DELETE from panier where proceed=1 AND etat=1 AND recu=1");
				$deleteUser->execute();
			}
		} catch (PDOExecption $e) {
			print "Error!: " . $e->getMessage() . "</br>";
		}

		$this->connection->closeConnection();
	}
}	 



?>