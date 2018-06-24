<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';

require_once WWW_ROOT . 'dao' . DS . 'KinderenDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'WeekDAO.php';

class WeekController extends Controller {

	private $kinderenDAO;
	private $weekDAO;
	private $dag, $week, $jaar;

	function __construct() {
		$this->kinderenDAO = new KinderenDAO();
		$this->weekDAO = new WeekDAO();
	}

	private function removeAanwezigheid($post, $dagtype) {
			$data = array();
			$data["kind_id"] = $post["id"];
			$data["dag"] = $post["dag"];
			$data["week"] = $post["week"];
			$data["jaar"] = $post["jaar"];
			if (isset($dagtype)) {
				$data["dagtype"] = $dagtype;
			}
			$inserted = $this->weekDAO->removeAanwezig($data);
	}

	public function week() {

		$pageNumber = 1;
		if(isset($_GET["pageNumber"])) {
			$pageNumber = $_GET["pageNumber"];
		}

		if (isset($_POST["id"])) {
			if(isset($_POST["dagtype"])) {
				$data = array();
				$data["kind_id"] = $_POST["id"];
				$data["dagtype"] = $_POST["dagtype"];
				$data["dag"] = $_POST["dag"];
				$data["week"] = $_POST["week"];
				$data["jaar"] = $_POST["jaar"];
				$data["registratiedatum"] = date("Y-m-d H:i:s");
				$inserted = $this->weekDAO->insertAanwezig($data);
				if (!$inserted) {
					if ($data["dagtype"] == "VM") {
						$this->removeAanwezigheid($_POST, "NM");
					} else if ($data["dagtype"] == "NM") {
						$this->removeAanwezigheid($_POST, "VM");
					}
				}
			} else {
				$this->removeAanwezigheid($_POST, null);
			}
		}

		if (isset($_POST["week"]) && isset($_POST["dag"]) && isset($_POST["jaar"])) {
			if ($_POST["week"] < 1 || $_POST["week"] > 5) {
				$_SESSION["error"] = "Week ID out of bounds.";
				$this->redirect("index.php");
				exit();
			}
			if ($_POST["dag"] < 1 || $_POST["dag"] > 5) {
				$_SESSION["error"] = "Dag ID out of bounds.";
				$this->redirect("index.php");
				exit();
			}
			$aanwezigheden = $this->weekDAO->getAanwezighedenVanWeek($_POST["dag"], $_POST["week"], $_POST["jaar"], $_POST["filter"], $pageNumber);
			$aantalAanwezigheden = $this->weekDAO->getAantalAanwezighedenVanWeek($_POST["week"], $_POST["jaar"], $pageNumber);


			// $aanwezigheden['halvedagen_aanwezig'] = $aantalAanwezigheden['halvedagen_aanwezig'];
			// $aanwezigheden['volledagen_aanwezig'] = $aantalAanwezigheden['volledagen_aanwezig'];
			//var_dump($aantalAanwezigheden);

			$this->set("aanwezigheden", $aanwezigheden);
			$this->set("aantalAanwezigheden",$aantalAanwezigheden);
		}

	}

	public function weken() {


		// if (isset($_GET["jaar"])) {
		// 	$this->set("overzicht", $this->kinderenDAO->getTotaalOverzicht($_GET["jaar"]));
		// } else { //if(isset($_POST["jaar"])) {
		// 	$this->set("overzicht", $this->kinderenDAO->getTotaalOverzicht($_POST["jaar"]));
		// }
		// // } else {
		// // 	$year = date("Y");
		// // 	$this->set("overzicht", $this->kinderenDAO->getTotaalOverzicht($year);
		// // }


		$overzicht = 0;
		if (isset($_GET["jaar"])) {
			$overzicht =  $this->weekDAO->getTotaalOverzicht($_GET["jaar"]);
		} else if(isset($_POST["jaar"])) {
			$overzicht = $this->weekDAO->getTotaalOverzicht($_POST["jaar"]);
		} else {
			$year = date("Y");
			$overzicht = $this->weekDAO->getTotaalOverzicht($year);
		}

		$bekerendOverzicht = array();
		foreach ($overzicht as $kind) {

			$kind['week_1'] = 0;
			$kind['week_2'] = 0;
			$kind['week_3'] = 0;
			$kind['week_4'] = 0;
			$kind['week_5'] = 0;
			$kind['TOTAAL'] = 0;

			$week_pieces = explode(",", $kind['weken']);
			foreach ($week_pieces as $week ) {
				switch ($week) {
					case 1:
						$kind['week_1'] += 1;
						break;
					case 2:
						$kind['week_2'] += 1;
						break;
					case 3:
						$kind['week_3'] += 1;
						break;
					case 4:
						$kind['week_4'] += 1;
						break;
					case 5:
						$kind['week_5'] += 1;
						break;
					default:
						$kind['TOTAAL'] += 1;
						break;
				}
			}
			$kind['TOTAAL'] = $kind['week_1'] + $kind['week_2'] + $kind['week_3'] + $kind['week_4'] + $kind['week_5'];
			array_push($bekerendOverzicht, $kind);
		}
		//["ID"]=> int(9) ["achternaam"]=> string(12) "Van de Velde" ["voornaam"]=> string(3) "Art" ["weken"]=> string(5) "1,3,3" ["dagen"]=> string(5) "1,1,3" ["dagtypes"]
		$this->set("overzicht", $bekerendOverzicht);

	}

	public function dagen() {

		$overzicht = 0;
		if (!empty($_POST)) {
			if (!empty($_POST['week']) && !empty($_POST['jaar'])) {
				$overzicht = $this->weekDAO->getTotaalOneWeekOverzicht($_POST['week'], $_POST['jaar']);
			}else{
				$overzicht = $this->weekDAO->getTotaalOneWeekOverzicht(1, 2017);
			}
		}else{
			$overzicht = $this->weekDAO->getTotaalOneWeekOverzicht(1, 2017);
		}

		$bekerendOverzicht = array();

		foreach ($overzicht as $kind) {
			//var_dump('new');

			$dagen = array();
			$aanwezig = array();
			$aanwezig['TOTAAL'] = 0;

			$dagen_pieces = explode(",", $kind['dagen']);
			$dagtypes_pieces = explode(",", $kind['dagtypes']);

			foreach ($dagtypes_pieces as  $value) {

				if ($value == 'VD') {
					$aanwezig['TOTAAL'] += 1;
				}
				if ($value == 'VM' || $value == 'NM') {
					$aanwezig['TOTAAL'] += 0.5;
				}
			}

			//var_dump($aanwezig['TOTAAL']);


			$dagenLenth = count($dagen_pieces);
			for ($i=0; $i < $dagenLenth ; $i++) {
				array_push($dagen, $dagen_pieces[$i] ."-". $dagtypes_pieces[$i]);
			}

			foreach ($dagen as $dag ) {

				//var_dump($dag);
				$dag_pieces = explode("-", $dag);
				//var_dump($dag_pieces);
				//var_dump($dag_pieces[0] .'+'.$dag_pieces[1]);
				if ($dag_pieces[1] == 'VM') {
					$dag_pieces[1] = 'Voormiddag';
				}
				if ($dag_pieces[1] == 'VD') {
					$dag_pieces[1] = 'Volle Dag';
				}
				if ($dag_pieces[1] == 'NM') {
					$dag_pieces[1] = 'Namiddag';
				}

				//var_dump($aanwezig);
				switch ($dag_pieces[0]) {
					case 1:
						if (!isset($aanwezig['maandag'])) {
							$aanwezig['maandag'] = $dag_pieces[1];
						}else{
							$aanwezig['maandag'] = $aanwezig['maandag'] ." - ".$dag_pieces[1] ;
						}
						break;
					case 2:
						if (!isset($aanwezig['dinsdag'])) {
							$aanwezig['dinsdag'] = $dag_pieces[1];
						}else{
							$aanwezig['dinsdag'] = $aanwezig['dinsdag'] ." - ".$dag_pieces[1] ;
						}
						break;
					case 3:
						if (!isset($aanwezig['woensdag'])) {
							$aanwezig['woensdag'] = $dag_pieces[1];
						}else{
							$aanwezig['woensdag'] = $aanwezig['woensdag'] ." - ".$dag_pieces[1] ;
						}
						break;
					case 4:
						if (!isset($aanwezig['donderdag'])) {
							$aanwezig['donderdag'] = $dag_pieces[1];
						}else{
							$aanwezig['donderdag'] = $aanwezig['donderdag'] ." - ".$dag_pieces[1] ;
						}
						break;
					case 5:
						if (!isset($aanwezig['vrijdag'])) {
							$aanwezig['vrijdag'] = $dag_pieces[1];
						}else{
							$aanwezig['vrijdag'] = $aanwezig['vrijdag'] ." - ".$dag_pieces[1] ;
						}
						break;
					default:
						$aanwezig['ERROR'] = "ERROR ";
						break;
				}

			}

			array_push($kind, $aanwezig);
			array_push($bekerendOverzicht, $kind);
		}
		//var_dump($bekerendOverzicht);
		$this->set("overzicht", $bekerendOverzicht);
	}

	public function fiscaal() {

		$kinderen = $this->kinderenDAO->selectAllNames();
		$this->set('kinderen', $kinderen);
		$data = null;


		if (!empty($_POST['childs'])) {
			foreach ($kinderen as $kind) {
				//var_dump($kind['voornaam']." ".$kind['achternaam']. " NEXT ". $_POST['parents']);
				if ($_POST['childs'] == $kind['achternaam']." ".$kind['voornaam'] ) {
					$id = $kind['ID'];
					$year = $_POST['jaar'];
					$data = 1;
					$data = $this->weekDAO->selectAanwezigheidByChild($id, $year);

					if (!empty($data)) {
						$kind_gegevens = $this->kinderenDAO->selectById($id);
						$this->set("kind_gegevens", $kind_gegevens);

						$reversedData = array_reverse($data);

						$tableOne['laatsteDag'] = explode(' ', $data[0]['registratiedatum'])[0];
						$tableOne['eersteDag'] = explode(" ", $reversedData[0]['registratiedatum'])[0];
						$tableOne['HD'] = 0;
						$tableOne['VD'] = 0;
						$tableOne['geld'] = 0;
						$tableOne['jaar'] = $year;

						foreach ($data as $key => $value) {
							if ($value['dagtype'] == 'VD' ) { $tableOne['VD']++ ; }
							if ($value['dagtype'] == 'VM' ) { $tableOne['HD']++ ; }
							if ($value['dagtype'] == 'NM' ) { $tableOne['HD']++ ; }
						}

						$tableOne['geld'] = ($tableOne['HD'] * 3) + ($tableOne['VD'] * 7);

						$this->set("tableOne", $tableOne);
					}
					

				}
			}
		}

		$this->set("data", $data);

	}

}
