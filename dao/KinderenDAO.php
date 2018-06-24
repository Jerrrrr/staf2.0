<?php
require_once WWW_ROOT . 'dao' . DS . 'DAO.php';
class KinderenDAO extends DAO {

	public function selectAll() {
		$sql = "SELECT wp_kinderen.ID, wp_kinderen.achternaam, wp_kinderen.voornaam, CASE wp_kinderen.geslacht WHEN 'm' THEN 'jongen' WHEN 'v' THEN 'meisje' END AS geslacht, geboortedatum, alleen_naar_huis, medische, wp_kinderen.actief AS actief, tel1, tel2, wp_ouders.familienaam AS oudernaam , wp_ouders.voornaam as oudervoornaam, email, adres, postcode, stad, notities, kind_id, weken, active, wp_kinderen.registratiedatum, wp_kinderen.updatedatum
		FROM wp_kinderen
		LEFT JOIN wp_ouders ON wp_kinderen.user_id = wp_ouders.user_id
		LEFT JOIN wp_kinderen_in_weken_aanwezig ON wp_kinderen.ID = wp_kinderen_in_weken_aanwezig.kind_id
		ORDER BY wp_kinderen.achternaam ASC, wp_kinderen.voornaam ASC";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectAllCount() {
		$sql = "SELECT COUNT(voornaam) AS COUNT FROM wp_kinderen";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectAllActiveCount() {
		$sql = "SELECT COUNT(voornaam) AS COUNT FROM wp_kinderen WHERE actief = 1";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectAllCountFromDate($datum) {
		$sql = "SELECT COUNT(voornaam) AS COUNT FROM wp_kinderen WHERE registratiedatum like :datum";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':datum', $datum ."%");
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectAllNames() {
		$sql = "SELECT `ID`, `voornaam`, `achternaam` FROM `wp_kinderen` ORDER BY `achternaam`, `voornaam`ASC";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectAllThisYear() {
		$sql = "SELECT wp_kinderen.ID, wp_kinderen.achternaam, wp_kinderen.voornaam, CASE wp_kinderen.geslacht WHEN 'm' THEN 'jongen' WHEN 'v' THEN 'meisje' END AS geslacht, geboortedatum, alleen_naar_huis, CASE wp_kinderen.onPhoto WHEN 0 THEN 'Nee' WHEN '1' THEN 'Ja' END AS onPhoto, medische, wp_kinderen.actief AS actief, tel1, tel2, wp_ouders.familienaam AS oudernaam , wp_ouders.voornaam as oudervoornaam, email, adres, postcode, stad, notities, kind_id, weken, active, wp_kinderen.registratiedatum, wp_kinderen.updatedatum
		FROM wp_kinderen
		LEFT JOIN wp_ouders ON wp_kinderen.user_id = wp_ouders.user_id
		LEFT JOIN wp_kinderen_in_weken_aanwezig ON wp_kinderen.ID = wp_kinderen_in_weken_aanwezig.kind_id
		WHERE actief = 1
		ORDER BY wp_kinderen.achternaam ASC, wp_kinderen.voornaam ASC";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}

	public function selectAllNamesNoPhoto() {
		$sql = "SELECT `ID`, `voornaam`, `achternaam` FROM `wp_kinderen` WHERE `onPhoto` = 0 ORDER BY `achternaam`, `voornaam`ASC";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}
	public function selectById($id) {
		$sql = "SELECT * FROM `wp_kinderen` WHERE `ID` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	/*
		SELECT
	    FirstName, LastName,
	    Salary, DOB,
		    CASE Gender
		        WHEN 'M' THEN 'Male'
		        WHEN 'F' THEN 'Female'
		    END
		FROM Employees
	*/

	public function selectAanwezigheidById($id) {
		$sql = "SELECT * FROM wp_aanwezig WHERE id = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectChildByName($voornaam, $achternaam) {
		$sql = "SELECT * FROM wp_kinderen WHERE voornaam = :voornaam AND achternaam = :achternaam";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':voornaam', $voornaam);
		$stmt->bindValue(':achternaam', $achternaam);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function getTotaalOverzicht($jaar) {
		$sql = "SELECT wp_kinderen.ID, wp_kinderen.achternaam, wp_kinderen.voornaam,
						GROUP_CONCAT(wp_aanwezig.week) as weken,  GROUP_CONCAT(wp_aanwezig.dag) as dagen ,  GROUP_CONCAT(wp_aanwezig.dagtype) as dagtypes
						FROM wp_kinderen
						LEFT JOIN wp_aanwezig ON wp_aanwezig.kind_id = wp_kinderen.ID
						WHERE wp_aanwezig.jaar LIKE :jaar
						GROUP BY wp_kinderen.ID ";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":jaar", "%".$jaar."%");
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getAanwezighedenVanWeek($dag, $week, $jaar, $filter, $pageNumber) {
		$sql = "SELECT wp_kinderen.ID, wp_kinderen.voornaam, wp_kinderen.achternaam, GROUP_CONCAT(wp_aanwezig.dagtype) as dagtypes, COUNT(CASE wp_aanwezig.dagtype WHEN 'VM' THEN 1 WHEN 'NM' THEN 1 END) as halvedagen_aanwezig, COUNT(CASE wp_aanwezig.dagtype WHEN 'VD' THEN 1 END) as volledagen_aanwezig
			FROM wp_kinderen
			LEFT JOIN wp_aanwezig ON wp_kinderen.ID = wp_aanwezig.kind_id
			WHERE (wp_aanwezig.dag = :dag OR wp_aanwezig.dag IS NULL) AND (wp_aanwezig.week = :week OR wp_aanwezig.week IS NULL) AND (wp_aanwezig.jaar = :jaar OR wp_aanwezig.jaar IS NULL) ";
		if ($filter != "") {
			$sql .= "AND wp_kinderen.voornaam LIKE :filter ";
		}
		$sql .= "GROUP BY wp_kinderen.ID
		LIMIT :pageNumber, 30";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":dag", $dag);
		$stmt->bindValue(":week", $week);
		$stmt->bindValue(":jaar", $jaar);
		if ($filter != "") {
			$stmt->bindValue(":filter", "%" . $filter . "%");
		}
		$stmt->bindValue(":pageNumber", ($pageNumber - 1) * 30);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getAantalAanwezighedenVanWeek($week, $jaar, $pageNumber) {
		$sql = "SELECT wp_kinderen.ID, COUNT(CASE wp_aanwezig.dagtype WHEN 'VM' THEN 1 WHEN 'NM' THEN 1 END) as halvedagen_aanwezig, COUNT(CASE wp_aanwezig.dagtype WHEN 'VD' THEN 1 END) as volledagen_aanwezig
			FROM wp_kinderen
			LEFT JOIN wp_aanwezig ON wp_kinderen.ID = wp_aanwezig.kind_id
			WHERE wp_aanwezig.week = :week AND wp_aanwezig.jaar = :jaar
			GROUP BY wp_kinderen.ID";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":week", $week);
		$stmt->bindValue(":jaar", $jaar);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	//update child

	//insert child
	//werkt niet!!! :(
	public function insert($data) {
		$errors = $this->getValidationErrors($data);
		if(empty($errors)) {
			$sql = "INSERT INTO `wp_kinderen` (`user_id`,`ouder_id`,`voornaam`,`achternaam`,`geslacht`,`geboortedatum`,`alleen_naar_huis`,`medische`,`onPhoto`,`notities`,`actief`,`registratiedatum`,`updatedatum`)
						VALUES 			      (:user_id, :ouder_id, :voornaam, :achternaam, :geslacht, :geboortedatum, :alleen_naar_huis, :medische, :onPhoto, :notities, :actief, :registratiedatum, :updatedatum)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':user_id', $data['user_id']);
			$stmt->bindValue(':ouder_id', $data['ouder_id']);
			$stmt->bindValue(':voornaam', $data['voornaam']);
			$stmt->bindValue(':achternaam', $data['achternaam']);
			$stmt->bindValue(':geslacht', $data['geslacht']);
			$stmt->bindValue(':geboortedatum', $data['geboortedatum']);
			$stmt->bindValue(':alleen_naar_huis', $data['alleen_naar_huis']);
			$stmt->bindValue(':medische', $data['medische']);
			$stmt->bindValue(':onPhoto', $data['onPhoto']);
			$stmt->bindValue(':notities', $data['notities']);
			$stmt->bindValue(':actief', $data['actief']);
			$stmt->bindValue(':registratiedatum', $data['registratiedatum']);
			$stmt->bindValue(':updatedatum', $data['registratiedatum']);
			if($stmt->execute()) {
				$insertedId = $this->pdo->lastInsertId();
				return $this->selectById($insertedId);
			}
		}
		var_dump($errors);
		return false;
	}

// UPDATE table_name
// SET column1 = value1, column2 = value2, ...
// WHERE condition;
	public function update($data) {
		$errors = $this->getValidationErrors($data);
		if(empty($errors)) {
			$sql = "UPDATE `wp_kinderen`
							SET	`voornaam` = :voornaam,
									`achternaam` = :achternaam,
									`geslacht` = :geslacht,
									`geboortedatum` = :geboortedatum,
									`alleen_naar_huis` = :alleen_naar_huis,
									`medische` = :medische,
									`notities` = :notities,
									`actief` = :actief,
									`onPhoto` = :onPhoto,
									`updatedatum` = :updatedatum
							WHERE `ID` = :ID" ;
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':ID', $data['ID']);
			$stmt->bindValue(':voornaam', $data['voornaam']);
			$stmt->bindValue(':achternaam', $data['achternaam']);
			$stmt->bindValue(':geslacht', $data['geslacht']);
			$stmt->bindValue(':geboortedatum', $data['geboortedatum']);
			$stmt->bindValue(':alleen_naar_huis', $data['alleen_naar_huis']);
			$stmt->bindValue(':medische', $data['medische']);
			$stmt->bindValue(':notities', $data['notities']);
			$stmt->bindValue(':actief', $data['actief']);
			$stmt->bindValue(':onPhoto', $data['onPhoto']);
			$stmt->bindValue(':updatedatum', $data['updatedatum']);
			if($stmt->execute()) {
				return $this->selectById($data['ID']);
			}
		}
		var_dump($errors);
		return false;
	}

	public function updateActiveToZero() {
		if(empty($errors)) {
			$sql = "UPDATE `wp_kinderen` SET	`actief` = 0 WHERE `actief` = 1 ";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();
			return true;
		}
		var_dump($errors);
		return false;
	}
	public function updateActiveToOneById($id) {
		if(empty($errors)) {
			$sql = "UPDATE `wp_kinderen` SET	`actief` = 1 WHERE `ID` = :id ";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			return true;
		}
		var_dump($errors);
		return false;
	}

	public function getValidationErrors($data) {
		$errors = array();
		//user_id`,`ouder_id`,`voornaam`,`achternaam`,`geboortedatum`,`alleen_naar_huis`,`medische`,`notitie`,`actief`,`registratiedatum
		if(!isset($data['voornaam'])) {
			$errors['voornaam'] = 'U hebt uw kind zijn of haar naam niet ingevuld.';
		}
		if(!isset($data['achternaam'])) {
			$errors['achternaam'] = 'U hebt uw kind zijn of haar familienaam niet ingevuld.';
		}
		if(!isset($data['geslacht'])) {
			$errors['geslacht'] = 'U hebt uw kind zijn of haar geslacht niet ingevuld.';
		}
		if(!isset($data['geboortedatum'])) {
			$errors['geboortedatum'] = 'U hebt uw kind zijn of haar geboortedatum niet ingevuld.';
		}
		if(!isset($data['actief'])) {
			$errors['actief'] = 'U hebt niet ingevuld of uw kind dit jaar komt naar het speelplein.';
		}
		if(!isset($data['medische'])) {
			$errors['medische'] = 'U hebt niet ingevuld of uw kind dit jaar komt naar het speelplein.';
		}
		return $errors;
	}

}
