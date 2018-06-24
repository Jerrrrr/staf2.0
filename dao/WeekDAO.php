<?php
require_once WWW_ROOT . 'dao' . DS . 'DAO.php';
class WeekDAO extends DAO {

	public function selectAanwezigheidById($id) {
		$sql = "SELECT * FROM wp_aanwezig WHERE id = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	public function selectAanwezigheidByChild($kind_id, $year) {
		$sql = "SELECT * FROM wp_aanwezig WHERE kind_id = :kind_id AND jaar = :year ORDER BY jaar DESC, week DESC, dag DESC";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':kind_id', $kind_id);
		$stmt->bindValue(':year', $year);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectAanwezigheidCountFromDate($datum) {
		$sql = "SELECT COUNT(case dagtype when 'VM' then 1 else null end) AS 'VM',
									 COUNT(case dagtype when 'NM' then 1 else null end) AS 'NM',
									 COUNT(case dagtype when 'VD' then 1 else null end) AS 'VD',
									 COUNT(dagtype) AS 'TOT'
						FROM wp_aanwezig WHERE registratiedatum like :datum";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':datum', $datum ."%");
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	// public function selectAanwezigheidCountFromID($id) {
	// 	$sql = "SELECT COUNT(case dagtype when 'VM' then 1 else null end) AS 'VM',
	// 								 COUNT(case dagtype when 'NM' then 1 else null end) AS 'NM',
	// 								 COUNT(case dagtype when 'VD' then 1 else null end) AS 'VD',
	// 								 COUNT(dagtype) AS 'TOT'
	// 					FROM wp_aanwezig WHERE $id = :$id";
	// 	$stmt = $this->pdo->prepare($sql);
	// 	$stmt->bindValue(':id', $id);
	// 	$stmt->execute();
	// 	return $stmt->fetch(PDO::FETCH_ASSOC);
	// }

	public function selectAanwezigheidCountFromDays($year) {
		$sql = "SELECT ";
			for ($i=1; $i <=5 ; $i++) {
				for ($j=1; $j <=5 ; $j++) {
					$sql .= "COUNT(CASE WHEN week = '".$i."' AND dag = '".$j."' THEN 1 END) AS 'w".$i."_d".$j."', ";
				}
			}
		$sql .= "COUNT(jaar) AS 'years'
						FROM wp_aanwezig WHERE jaar = :year";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':year', $year);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectAanwezigheidCountFromDaysHalfDay($year) {
		$sql = "SELECT ";
			for ($i=1; $i <=5 ; $i++) {
				for ($j=1; $j <=5 ; $j++) {
					$sql .= "COUNT(CASE WHEN week = '".$i."' AND dag = '".$j."' AND (dagtype = 'VM' OR dagtype = 'NM') THEN 1 END) AS 'w".$i."_d".$j."', ";
				}
			}
		$sql .= "COUNT(jaar) AS 'years'
						FROM wp_aanwezig WHERE jaar = :year";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':year', $year);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectAanwezigheidCountFromDaysFullDay($year) {
		$sql = "SELECT ";
			for ($i=1; $i <=5 ; $i++) {
				for ($j=1; $j <=5 ; $j++) {
					$sql .= "COUNT(CASE WHEN week = '".$i."' AND dag = '".$j."' AND dagtype = 'VD' THEN 1 END) AS 'w".$i."_d".$j."', ";
				}
			}
		$sql .= "COUNT(jaar) AS 'years'
						FROM wp_aanwezig WHERE jaar = :year";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':year', $year);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function getTotaalOneWeekOverzicht($week, $jaar) {
		$sql = "SELECT wp_kinderen.ID, wp_kinderen.achternaam, wp_kinderen.voornaam,
						GROUP_CONCAT(wp_aanwezig.dag) as dagen ,  GROUP_CONCAT(wp_aanwezig.dagtype) as dagtypes
						FROM wp_kinderen
						LEFT JOIN wp_aanwezig ON wp_aanwezig.kind_id = wp_kinderen.ID
						WHERE wp_aanwezig.jaar LIKE :jaar
						AND wp_aanwezig.week LIKE :week
						GROUP BY wp_kinderen.ID ";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":jaar", "%".$jaar."%");
		$stmt->bindValue(":week", $week);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
		$sql = "SELECT
					wk.ID,
					wk.geboortedatum,
				    wk.voornaam,
				    wk.achternaam,
					wk.actief,
					CASE wk.onPhoto WHEN 0 THEN 'Nee' WHEN 1 THEN 'Ja' END AS onPhoto,
				    (SELECT GROUP_CONCAT(dagtype)
				     	FROM wp_aanwezig
				     	WHERE kind_id = wk.ID AND dag = :dag AND week = :week1 AND jaar = :jaar1
				     	GROUP BY kind_ID) AS dagtypes,
				    COUNT(
				        CASE
				        WHEN dagtype = 'VM' AND week = :week2 AND jaar = :jaar2 THEN 1
				        WHEN dagtype = 'NM' AND week = :week3 AND jaar = :jaar3 THEN 1
				        END) as halvedagen_aanwezig,
				    COUNT(
				        CASE
				        WHEN dagtype = 'VD' AND week = :week4 AND jaar = :jaar4 THEN 1
				        END) as volledagen_aanwezig
				FROM wp_kinderen AS wk
				LEFT JOIN wp_aanwezig ON wk.ID = wp_aanwezig.kind_id ";
		if ($filter != "") {
			$sql .= "WHERE (wk.voornaam LIKE :voornaam OR wk.achternaam LIKE :achternaam) AND wk.actief = 1";
		}else{
			$sql .= "WHERE wk.actief = 1";
		}
		$sql .= " GROUP BY wk.ID
		LIMIT :pageNumber, 30";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":dag", $dag);
		for ($i = 1; $i < 5; $i++) {
			$stmt->bindValue(":week" . $i, $week);
			$stmt->bindValue(":jaar" . $i, $jaar);
		}
		if ($filter != "") {
			$stmt->bindValue(":voornaam", "%" . $filter . "%");
			$stmt->bindValue(":achternaam", "%" . $filter . "%");
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


	private function selectAanwezigByData($data) {
		$sql = "SELECT `ID` FROM `wp_aanwezig` WHERE `kind_id` = :kind_id AND `dag` = :dag AND `week` = :week AND `jaar` = :jaar AND `dagtype` = :dagtype";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':kind_id', $data['kind_id']);
		$stmt->bindValue(':dag', $data['dag']);
		$stmt->bindValue(':week', $data['week']);
		$stmt->bindValue(':jaar', $data['jaar']);
		$stmt->bindValue(':dagtype', $data['dagtype']);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function insertAanwezig($data) {
		if (empty($this->selectAanwezigByData($data))) {
			$sql = "INSERT INTO `wp_aanwezig` (`kind_id`,`dagtype`,`dag`,`week`,`jaar`,`registratiedatum`)
						VALUES 			      (:kind_id, :dagtype, :dag, :week, :jaar, :registratiedatum)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':kind_id', $data['kind_id']);
			$stmt->bindValue(':dagtype', $data['dagtype']);
			$stmt->bindValue(':dag', $data['dag']);
			$stmt->bindValue(':week', $data['week']);
			$stmt->bindValue(':jaar', $data['jaar']);
			$stmt->bindValue(':registratiedatum', $data['registratiedatum']);
			if($stmt->execute()) {
				$insertedId = $this->pdo->lastInsertId();
				return $this->selectAanwezigheidById($insertedId);
			}
		}
		return false;
	}

	public function removeAanwezig($data) {
		$sql = "DELETE
			FROM `wp_aanwezig`
			WHERE `kind_id` = :kind_id AND `dag` = :dag AND `week` = :week AND `jaar` = :jaar ";
		if (isset($data["dagtype"])) {
			$sql .= "AND `dagtype` = :dagtype";
		}
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':kind_id', $data['kind_id']);
		$stmt->bindValue(':dag', $data['dag']);
		$stmt->bindValue(':week', $data['week']);
		$stmt->bindValue(':jaar', $data['jaar']);
		if (isset($data["dagtype"])) {
			$stmt->bindValue(':dagtype', $data['dagtype']);
		}
		return $stmt->execute();
	}

}
