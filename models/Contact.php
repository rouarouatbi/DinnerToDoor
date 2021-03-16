<?php
include_once'./config/connection.php';
class Contact{

	protected $id_contact;
	protected $nom;
	protected $email;
	protected $sujet;
	protected $message;
	protected $internaute;


	public function getId_contact(){
		return $this->id_contact;
	}

	public function setId_contact($id_contact){
		$this->id_contact = $id_contact;
	}

	public function getNom(){
		return $this->nom;
	}

	public function setNom($nom){
		$this->nom = $nom;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getSujet(){
		return $this->sujet;
	}

	public function setSujet($sujet){
		$this->sujet = $sujet;
	}

	public function getMessage(){
		return $this->message;
	}

	public function setMessage($message){
		$this->message = $message;
	}

	public function getInternaute(){
		return $this->internaute;
	}

	public function setInternaute($internaute){
		$this->internaute = $internaute;
	}


	function create() {
		$this->connection = new Connection();
		$conn = $this->connection->openConnection();
		$conn->exec("SET CHARACTER SET utf8");

		$insert = $conn->prepare("INSERT INTO `contact`(`nom`, `email`, `sujet`, `message`, `internaute`) VALUES (:nom,:email,:sujet,:message,:internaute)");

		try {

			$result = $insert->execute(array('nom' => $this->getNom(),'email' => $this->getEmail(),'sujet' => $this->getSujet(),'message' => $this->getMessage(),'internaute' => $this->getInternaute()));
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

		$read = $conn->prepare("SELECT * FROM contact");
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


	function delete($id_contact) {
		$this->connection = new Connection();
		$conn = $this->connection->openConnection();
		try {
			if($conn){
				$deleteUser = $conn->prepare("DELETE from contact where id_contact =:id_contact");
				$deleteUser->execute(
					array('id_contact' => $id_contact));
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

	function selectContactById($id_contact) {
		$this->connection = new Connection();
		$conn = $this->connection->openConnection();
		$conn->exec("SET CHARACTER SET utf8");

		$read = $conn->prepare("SELECT * FROM contact where id_contact=:id_contact");
		$read->execute(array('id_contact' => $id_contact));

		if ($read->rowCount() > 0) {
			return $read->fetch(PDO::FETCH_ASSOC);
		} 
		$this->connection->closeConnection();

	}






































}

?>