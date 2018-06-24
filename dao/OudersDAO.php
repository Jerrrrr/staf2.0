<?php
require_once WWW_ROOT . 'dao' . DS . 'DAO.php';
class OudersDAO extends DAO {

	public function selectAll() {
		$sql = "SELECT * FROM `wp_ouders`";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectAllEmails() {
		$sql = "SELECT `ID`, `email`, `voornaam`, `familienaam` FROM `wp_ouders`";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectAllAddresses() {
		$sql = "SELECT `voornaam`, `familienaam`, `adres`, `postcode`, `stad` FROM `wp_ouders`";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM `wp_ouders` WHERE `user_id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectByIUserId($id) {
		$sql = "SELECT * FROM `wp_users` WHERE `ID` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectByParentId($id) {
		$sql = "SELECT * FROM `wp_ouders` WHERE `ID` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectAllNames() {
		$sql = "SELECT `ID`, `user_id`, `voornaam`, `familienaam`, `email` FROM `wp_ouders` ORDER BY `familienaam`, `voornaam`ASC";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


	//insert wp_users
	//`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`SELECT * FROM 	 WHERE 1
	public function insertUser($data) {

		$errors = $this->getValidationErrorsUser($data);
		if(empty($errors)) {

			$sql = "INSERT INTO `wp_users` 	(`user_login`,`user_pass`,`user_nicename`,`user_email`,`user_registered`,`user_status`,`display_name`)
						VALUES 			    (:user_login, :user_pass, :user_nicename, :user_email, :user_registered, :user_status, :display_name)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':user_login', $data['user_login']);
			$stmt->bindValue(':user_pass', $data['user_pass']);
			$stmt->bindValue(':user_nicename', $data['user_nicename']);
			$stmt->bindValue(':user_email', $data['user_email']);
			$stmt->bindValue(':user_registered', $data['user_registered']);
			$stmt->bindValue(':user_status', $data['user_status']);
			$stmt->bindValue(':display_name', $data['display_name']);
			if($stmt->execute()) {
				$insertedId = $this->pdo->lastInsertId();
				return $this->selectByIUserId($insertedId);

			}else{
				var_dump("niet geslaagt");
			}
		}else{
			var_dump("niet geslaagt in errors");
			var_dump($errors);
		}

		return false;
	}

	//insert wp_ouders
	//`ID`, `user_id`, `voornaam`, `familienaam`, `functie`, `geslacht`, `tel1`, `tel2`, `email`, `adres`, `postcode`, `stad`, `registratiedatum`, `updatedatum`SELECT * FROM 	 WHERE 1
	public function insert_ouder($data) {
		$errors = $this->getValidationErrorsParent($data);
		if(empty($errors)) {
			$sql = "INSERT INTO `wp_ouders` (`user_id`,`voornaam`,`familienaam`,`functie`,`geslacht`,`tel1`,`tel2`,`email`,`adres`,`postcode`,`stad`,`registratiedatum`)
						VALUES 			    (:user_id, :voornaam, :familienaam, :functie, :geslacht, :tel1, :tel2, :email, :adres, :postcode, :stad, :registratiedatum)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':user_id', $data['user_id']);
			$stmt->bindValue(':voornaam', $data['voornaam']);
			$stmt->bindValue(':familienaam', $data['familienaam']);
			$stmt->bindValue(':functie', $data['functie']);
			$stmt->bindValue(':geslacht', $data['geslacht']);
			$stmt->bindValue(':tel1', $data['tel1']);
			$stmt->bindValue(':tel2', $data['tel2']);
			$stmt->bindValue(':email', $data['email']);
			$stmt->bindValue(':adres', $data['adres']);
			$stmt->bindValue(':postcode', $data['postcode']);
			$stmt->bindValue(':stad', $data['stad']);
			$stmt->bindValue(':registratiedatum', $data['registratiedatum']);
			if($stmt->execute()) {
				$insertedId = $this->pdo->lastInsertId();
				return $this->selectByParentId($insertedId);
			}
		}
		return false;
	}



	public function UpdateUser($data) {
		$errors = $this->getValidationErrorsUser($data);
		if(empty($errors)) {
			$sql = "UPDATE `wp_users`
							SET	`user_login` = :user_login,
									`user_nicename` = :user_nicename,
									`user_email` = :user_email,
									`display_name` = :display_name
							WHERE `ID` = :ID" ;
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':ID', $data['ID']);
			$stmt->bindValue(':user_login', $data['user_login']);
			$stmt->bindValue(':user_nicename', $data['user_nicename']);
			$stmt->bindValue(':user_email', $data['user_email']);
			$stmt->bindValue(':display_name', $data['display_name']);
			if($stmt->execute()) {
				return $this->selectById($data['ID']);
			}
		}
		var_dump($errors);
		return false;
	}
	public function Updated_ouder($data) {
		$errors = $this->getValidationErrorsParent($data);
		if(empty($errors)) {
			$sql = "UPDATE `wp_ouders`
							SET	`voornaam` = :voornaam,
									`familienaam` = :familienaam,
									`functie` = :functie,
									`geslacht` = :geslacht,
									`tel1` = :tel1,
									`tel2` = :tel2,
									`email` = :email,
									`adres` = :adres,
									`postcode` = :postcode,
									`stad` = :stad,
									`updatedatum` = :updatedatum
							WHERE `ID` = :ID" ;
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':ID', $data['ID']);
			$stmt->bindValue(':voornaam', $data['voornaam']);
			$stmt->bindValue(':familienaam', $data['familienaam']);
			$stmt->bindValue(':functie', $data['functie']);
			$stmt->bindValue(':geslacht', $data['geslacht']);
			$stmt->bindValue(':tel1', $data['tel1']);
			$stmt->bindValue(':tel2', $data['tel2']);
			$stmt->bindValue(':email', $data['email']);
			$stmt->bindValue(':adres', $data['adres']);
			$stmt->bindValue(':postcode', $data['postcode']);
			$stmt->bindValue(':stad', $data['stad']);
			$stmt->bindValue(':updatedatum', $data['updatedatum']);
			if($stmt->execute()) {
				return $this->selectById($data['ID']);
			}
		}
		var_dump($errors);
		return false;
	}




	public function getValidationErrorsUser($data) {
		$errors = array();
		if(!isset($data['user_login'])) {
			$errors['user_login'] = 'user_login is missing';
		}
		if(!isset($data['user_nicename'])) {
			$errors['user_nicename'] = 'user_nicename is missing';
		}
		if(!isset($data['user_email'])) {
			$errors['user_email'] = 'user_email is missing';
		}
		if(!isset($data['display_name'])) {
			$errors['display_name'] = 'display_name is missing';
		}

		return $errors;
	}

	public function getValidationErrorsParent($data) {
		$errors = array();
		if(!isset($data['voornaam'])) {
			$errors['voornaam'] = 'voornaam is missing';
		}
		if(!isset($data['familienaam'])) {
			$errors['familienaam'] = 'familienaam is missing';
		}
		if(!isset($data['functie'])) {
			$errors['functie'] = 'functie is missing';
		}
		if(!isset($data['geslacht'])) {
			$errors['geslacht'] = 'geslacht is missing';
		}
		if(!isset($data['tel1'])) {
			$errors['tel1'] = 'tel1 is missing';
		}
		if(!isset($data['tel2'])) {
			$errors['tel2'] = 'tel2 is missing';
		}
		if(!isset($data['email'])) {
			$errors['email'] = 'email is missing';
		}
		if(!isset($data['adres'])) {
			$errors['adres'] = 'adres is missing';
		}
		if(!isset($data['postcode'])) {
			$errors['postcode'] = 'postcode is missing';
		}
		if(!isset($data['stad'])) {
			$errors['stad'] = 'stad is missing';
		}

		return $errors;
	}
}
