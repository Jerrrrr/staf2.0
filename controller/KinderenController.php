<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';

require_once WWW_ROOT . 'dao' . DS . 'KinderenDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'OudersDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'WPDAO.php';


class KinderenController extends Controller {


	private $kinderenDAO;
	private $oudersDAO;
	private $wpDAO;

	//private $selectedParent;

	function __construct() {

		$this->kinderenDAO = new KinderenDAO();
		$this->oudersDAO = new OudersDAO();
		$this->wpDAO = new WPDAO();
	}

	public function ouders(){


	}

	public function downloadOuders(){
		
		header("Content-type: application/vnd.ms-excel");
		header("Content-type: application/force-download");
		header("Content-Disposition: attachment; filename=ouderAdressenLijst.xls");
		header("Pragma: no-cache");

		$ouders = $this->oudersDAO->selectAllAddresses();
		$output = '  
		<table border="1">
			<tr>
				<th>NAAM OUDER</th>
				<th>VOORNAAM OUDER</th>
				<th>ADRES</th>
				<th>POSTCODE</th>
				<th>GEMEENTE</th>
			<tr>
		';  
   		foreach ($ouders as $row):  
			$output .= '  
				<tr>  
					<td>' . $row["familienaam"] . '</td>  
					<td>' . $row["voornaam"] . '</td>  
					<td>' . $row["adres"] . '</td>  
					<td>' . $row['postcode'] . '</td>
					<td>' . $row['stad'] . '</td>
				</tr>  
			';  
		endforeach;
		$output .= '</table>';  	
		
		echo $output; 

		$this->redirect('index.php');
	}

	public function gegevens(){

		// Alle kinderen ocherzicht pagina

		$kinderen = $this->kinderenDAO->selectAllThisYear();

		if (!empty($_POST["years"]) && isset($_POST["allYear"])):
			if($_POST["allYear"] == 'on'):
				$kinderen = $this->kinderenDAO->selectAll();
			endif;
		endif;

		foreach ($kinderen as $kind):

			//fixen!...
			//var_dump($kind);
			if($kind['geslacht'] == "m"):
				$kind['geslacht'] = "jongen";
			else:
				$kind['geslacht'] = "meisje";
			endif;

			// if medisch != "geen" => color red

			// if !empty notitie => color red || orange
		endforeach;

		$this->set('kinderen', $kinderen);

	}

	public function zetActief(){
		if (!empty($_GET['kind'])) {
			//var_dump($_GET['kind']);
			$UpdatedChild = $this->kinderenDAO->updateActiveToOneById($_GET['kind']);
			if ($UpdatedChild) {
				$_SESSION['info'] = 'Actief zetten gelukt!';
				$this->redirect('index.php?page=kinderen');
			}else{
				$_SESSION['info'] = 'Er is iets misgelopen met het actief zetten van het kind';
				$this->redirect('index.php?page=kinderen');
			}
		}
	}

	// public function verwijder(){
	// 	if (!empty($_GET['kind'])) {
	// 		//var_dump($_GET['kind']);
	// 		$UpdatedChild = $this->kinderenDAO->updateDELETED($_GET['kind']);
	// 		if ($UpdatedChild) {
	// 			$_SESSION['info'] = 'Actief zetten gelukt!';
	// 			$this->redirect('index.php?page=kinderen');
	// 		}else{
	// 			$_SESSION['info'] = 'Er is iets misgelopen met het actief zetten van het kind';
	// 			$this->redirect('index.php?page=kinderen');
	// 		}
	// 	}
	// }

	public function toevoegen(){

		// een kind en ouder toevoegen aan de db

		//Kies welke button ouder of kind toevoegen
		if (isset($_GET['button'])) {
			$button = $_GET['button'];
			if ($button == 'nieuw') {

				$this->set('nieuw', $button);
				unset($_SESSION['ouder']);
			}else if($button == 'bestaand'){

				$ouders = $this->oudersDAO->selectAllNames();
				$this->set('ouders', $ouders);
			}
		}


		#region nieuwe ouder toevoegen
		//var_dump($_POST);
		if (isset($_POST['action_insert_parent']) && !empty($_POST['action_insert_parent']) && $_POST['action_insert_parent'] !== 0) {

			$bestaandEmail = $this->oudersDAO->selectAllEmails();
			if ($this->in_multiarray($_POST['email'], $bestaandEmail, 'email')){
				$errors['email'] = ' Email bestaat al!';
			}
			if(empty($_POST['email'])) {
				$errors['email'] = ' Email is niet ingevuld.';
			}
			if(empty($_POST['voornaam'])) {
				$errors['voornaam'] = ' Voornaam is niet ingevuld.';
			}
			if(empty($_POST['familienaam'])) {
				$errors['familienaam'] = ' Familienaam is niet ingevuld.';
			}
			if(empty($_POST['functie'])) {
				$errors['functie'] = ' Functie is niet ingevuld.';
			}
			if(empty($_POST['adres'])) {
				$errors['adres'] = ' Adres is niet ingevuld.';
			}
			if(empty($_POST['postcode'])) {
				$errors['postcode'] = ' Postcode is niet ingevuld.';
			}
			if(empty($_POST['stad'])) {
				$errors['stad'] = ' Stad is niet ingevuld.';
			}
			if(empty($_POST['tel1'])) {
				$errors['tel1'] = ' Telefoon nummer is niet ingevuld.';
			}
			if(empty($_POST['tel2'])) {
				$_POST['tel2'] = $_POST['tel1'];
			}
			if(!isset($_POST['ontvanginfo'])) {
				$errors['ontvanginfo'] = ' Het is wettelijk verplicht specifiek aan te geven of de ouder al dan niet toestemming geeft om zijn/haar e-mail adres te mogen gebruiken. Vergeet dit veld niet in te vullen. Dit bericht vernietigd zichzelf na de eerst volgende verzending van dit formulier. Grietjes, Vicky.';
			}
			var_dump($_POST);

			if (empty($errors)) {
				//print_r(" geslaagd");
				$this->_handleParent($_POST);
			}else{
				//print_r("niet geslaagd");
				//var_dump($errors);
				$this->set('errors', $errors);
			}
		}

		#endregion

		#region selected ouder
		// als bestaande ouder is gekozen haal de juiste ouder uit het id
		//var_dump($_POST);
		// 	var_dump($_GET);
			// if (!empty($_POST['parent']) && !isset($_SESSION['ouder'])) { $_POST['parent'] = $_SESSION['ouder']; }
			if ( (isset($_GET['parent']) && !empty($_GET['parent'])) || (isset($_POST['ID']) && !empty($_POST['ID'])) || (isset($_POST['parent']) && !empty($_POST['parent']) && $_POST['parent'] !== 0) ) {

				//var_dump($_POST['parent']);
				if (isset($_POST['ID'])) {
					$newlySelectedParent = $this->oudersDAO->selectByParentId($_POST['ID']);
				}
				if (isset($_POST['parent'])) {
					$newlySelectedParent = $this->oudersDAO->selectByParentId($_POST['parent']);
				}
				if (isset($_GET['parent'])) {
					$newlySelectedParent = $this->oudersDAO->selectByParentId($_GET['parent']);
				}


				$this->set('selectedParent', $newlySelectedParent);

				// kind toevoegen via form
				if(!empty($_POST['action']) || !empty($_POST['add'])) {
					if(empty($_POST['naam'])) {
						$errors['naam'] = 'U hebt het kind zijn of haar naam niet ingevuld.';
					}
					if(empty($_POST['lastname'])) {
						$errors['lastname'] = 'U hebt het kind zijn of haar familienaam niet ingevuld.';
					}
					if(empty($_POST['geslacht'])) {
						$errors['geslacht'] = 'U hebt het kind zijn of haar geslacht niet ingevuld.';
					}
					if(empty($_POST['geboortedatum'])) {
						$errors['geboortedatum'] = 'U hebt het kind zijn of haar geboortedatum niet ingevuld.';
					}
					if(!isset($_POST['actief'])) {
						$errors['actief'] = 'U hebt niet ingevuld of het kind dit jaar komt naar het speelplein.';
					}
					if(empty($_POST['medische'])) {
						$errors['medische'] = 'U hebt niet ingevuld of het kind dit jaar komt naar het speelplein.';
					}
					//var_dump('test');
						if (empty($errors)) {
							$this->_handleChild($_POST, $newlySelectedParent);
						}else{
							$_SESSION['info'] = 'niet geslaagd';
							$this->set('errors', $errors);
						}

				}

			}


		#endregion

		#region selected volledig toevoegen


		#endregion

	}

	public function weizigen(){

		// een kind of ouder weizigen in de db of actief zetten!


		if (empty($_GET)):

			$_SESSION['error'] = "Er is geen kind gevonden";
			$this->redirect('index.php?page=kinderen');
		elseif(empty($_GET['kind'])):

			$_SESSION['error'] = "Er is geen geldig kind gevonden";
			$this->redirect('index.php?page=kinderen');
		endif;

		$pieces = explode("-", $_GET['kind']);
		$voornaam = $pieces[0];
		$achternaam = $pieces[1];

		//selectChildByName(voornaam, achternaam);
		$kind = $this->kinderenDAO->selectChildByName($voornaam, $achternaam);
		$ouder = $this->oudersDAO->selectById($kind['user_id']);

		$this->set('ouder', $ouder);
		$this->set('kind', $kind);

		if (!empty($_POST)):
			//var_dump($_POST);
			if ( isset($_POST["action_update_child"]) && $_POST["action_update_child"] == "Kind Opslaan" ):

				if(empty($_POST['naam'])) {
					$errors['naam'] = 'U hebt het kind zijn of haar naam niet ingevuld.';
				}
				if(empty($_POST['achternaam'])) {
					$errors['achternaam'] = 'U hebt het kind zijn of haar familienaam niet ingevuld.';
				}
				if(empty($_POST['geslacht'])) {
					$errors['geslacht'] = 'U hebt het kind zijn of haar geslacht niet ingevuld.';
				}
				if(empty($_POST['geboortedatum'])) {
					$errors['geboortedatum'] = 'U hebt het kind zijn of haar geboortedatum niet ingevuld.';
				}
				if(!isset($_POST['actief'])) {
					$errors['actief'] = 'U hebt niet ingevuld of het kind dit jaar komt naar het speelplein.';
				}
				if(empty($_POST['medische'])) {
					$errors['medische'] = 'U hebt niet ingevuld of het kind dit jaar komt naar het speelplein.';
				}
				if (empty($errors)) {

					$this->_handleUpdateChild($_POST);
				}else{
					//var_dump($errors);
					//var_dump($_POST);

					$this->set('errors', $errors);
				}




			endif;
			if ( isset($_POST["action_update_parent"]) && $_POST["action_update_parent"] == "Ouder Opslaan" ):



				$bestaandEmail = $this->oudersDAO->selectAllEmails();
				if ($this->in_multiarray($_POST['email'], $bestaandEmail, 'email') && $_POST['email'] !== $ouder['email']){
					$errors['email'] = ' Email bestaat al!';
				}
				if(empty($_POST['email'])) {
					$errors['email'] = ' Email is niet ingevuld.';
				}
				if(empty($_POST['voornaam'])) {
					$errors['voornaam'] = ' Voornaam is niet ingevuld.';
				}
				if(empty($_POST['familienaam'])) {
					$errors['familienaam'] = ' Familienaam is niet ingevuld.';
				}
				if(empty($_POST['functie'])) {
					$errors['functie'] = ' Functie is niet ingevuld.';
				}
				if(empty($_POST['adres'])) {
					$errors['adres'] = ' Adres is niet ingevuld.';
				}
				if(empty($_POST['postcode'])) {
					$errors['postcode'] = ' Postcode is niet ingevuld.';
				}
				if(empty($_POST['stad'])) {
					$errors['stad'] = ' Stad is niet ingevuld.';
				}
				if(empty($_POST['tel1'])) {
					$errors['tel1'] = ' Telefoon nummer is niet ingevuld.';
				}
				if(empty($_POST['tel2'])) {
					$_POST['tel2'] = $_POST['tel1'];
				}

				if (empty($errors)) {
					// print_r(" geslaagd");
					$this->_handleUpdateParent($_POST);
				}else{
					print_r("niet geslaagd");
					var_dump($errors);
					$this->set('errors', $errors);
				}




			endif;

		endif;

	}

	private function in_multiarray($elem, $array,$field){

		$top = sizeof($array) - 1;
		$bottom = 0;
		while($bottom <= $top)
		{
				if($array[$bottom][$field] == $elem)
						return true;
				else
						if(is_array($array[$bottom][$field]))
								if(in_multiarray($elem, ($array[$bottom][$field])))
										return true;

				$bottom++;
		}
		return false;
	}

	private function _handleParent($post) {

		$nickname = str_replace(".", "-", $post['email']);
		$nickname = str_replace("@", "", $nickname); // teken removen
		$pass = '$P$BHQ.M7rugyAsMgjutSRCfa1iOgkZmJ0'; #k4%YeK6w9%WTLa^^U?Dy

		$user = array(
			'user_login' => $post['email'],
			'user_pass' => $pass,
			'user_nicename' => $post['email'],
			'user_email' => $post['email'],
			'user_registered' => date("Y-m-d H:i:s"),
			'user_status' => 0,
			'display_name' => $post['voornaam']." ".$post['familienaam']
		);

		$inserted_user = $this->oudersDAO->insertUser($user);
		//var_dump($inserted_user);
		if(!empty($inserted_user)) {

			if ($post["ontvanginfo"] == "n") {
				$this->wpDAO->update_user_meta($inserted_user["ID"], "wp_capabilities", "a:1:{s:11:\"oudernomail\";b:1;}");
			}

			if ($post["functie"] == "p") {
			$post['geslacht'] = "m";
			}else{
				$post['geslacht'] = "v";
			}

			$ouder = array(
				'user_id' => $inserted_user['ID'],
				'voornaam' => $post['voornaam'],
				'familienaam' => $post['familienaam'],
				'functie' => $post['functie'],
				'geslacht' => $post['geslacht'],
				'tel1' => $post['tel1'],
				'tel2' => $post['tel2'],
				'email' => $post['email'],
				'adres' => $post['adres'],
				'postcode' => $post['postcode'],
				'stad' => $post['stad'],
				'registratiedatum' => date("Y-m-d H:i:s")
			);


			$insert_ouder = $this->oudersDAO->insert_ouder($ouder);

			if(!empty($insert_ouder)) {


				$_SESSION['info'] = 'Toevoegen van '. $post['voornaam']. " ". $post['familienaam'].' is gelukt!';
				$_SESSION['ouder'] = $insert_ouder['user_id'];

				//email sturen
				$this->_sendmail($ouder['email'],$ouder);

				$this->redirect('index.php?page=voegtoe&button=bestaand&parent='.$insert_ouder['ID']);
			} else {
				$errors = $this->oudersDAO->getValidationErrorsParent($ouder);
				$this->set('errors', $errors);
			}


		} else {
			$errors = $this->oudersDAO->getValidationErrorsUser($user);
			$this->set('errors', $errors);
		}

	}

	private function _sendmail($email, $data){

		$to      = $email;
		$subject = 'speelplein \'t Speelakkertje heeft u geregistreerd';
		$headers = 'From: speelplein@speelakkertje.be' . "\r\n" .
				'Reply-To: speelplein@speelakkertje.be' . "\r\n" .
				'Content-Type: text/html; charset=ISO-8859-1' . "\r\n".
				'X-Mailer: PHP/' . phpversion();
		$message =
			'Dag beste '.$data['familienaam']." ".$data['voornaam'] ."\r\n" .
			"\r\n" .
			'<p>Een plein verantwoordelijke van speelplein \'t Speelakkertje heeft u email adres geregistreerd.'. "\r\n" .
			'Dit voor uw kinderen te kunnen koppelen aan uw gegevens, zodat u ook uw kinderen kan wijzigen en voor uw kinderen volgend jaar weer op actief te zetten.'. "\r\n" .
			'Voor veiligheidsredenen geven we u geen wachtwoord mee in de mail, maar kan u op de website speelakkertje.be een uw wachtwoord resetten. <a href="http://speelakkertje.be/wp-login.php?action=lostpassword">Dit kan u doen op deze link te klikken</a></p>'. "\r\n" .
			'<p>Mocht de link niet werken kopieer dan de volgende URL: http://speelakkertje.be/wp-login.php?action=lostpassword</p>'. "\r\n" .
			"\r\n" .
			'Vriendelijke groeten' . "\r\n" .
			'Speelplein \'t Speelakketje';

		mail($to, $subject, $message, $headers);

	}

	private function _handleUpdateParent($post) {

		$user = array(
			'ID' => $post['user_id'],
			'user_login' => $post['email'],
			'user_nicename' => $post['email'],
			'user_email' => $post['email'],
			'display_name' => $post['voornaam']." ".$post['familienaam']
		);

			if ($post["functie"] == "p") {
			$post['geslacht'] = "m";
			}else{
				$post['geslacht'] = "v";
			}

			$ouder = array(
				'ID' => $post['PARENT_ID'],
				'voornaam' => $post['voornaam'],
				'familienaam' => $post['familienaam'],
				'functie' => $post['functie'],
				'geslacht' => $post['geslacht'],
				'tel1' => $post['tel1'],
				'tel2' => $post['tel2'],
				'email' => $post['email'],
				'adres' => $post['adres'],
				'postcode' => $post['postcode'],
				'stad' => $post['stad'],
				'updatedatum' => date("Y-m-d H:i:s")
			);

			// var_dump("gelukt");
			// var_dump($post);

			// USER ID ???? HOE WAAR HUH ??? NOG DOEN!!!!

			 $inserted_user = $this->oudersDAO->UpdateUser($user);
			 $insert_ouder = $this->oudersDAO->Updated_ouder($ouder);
			//var_dump($insert_ouder);
			if(!empty($insert_ouder && !empty($insert_ouder))) {

				$_SESSION['info'] = 'Toevoegen van '. $post['voornaam']. " ". $post['familienaam'].' is gelukt!';
				$_SESSION['ouder'] = $insert_ouder['user_id'];
				//var_dump($insert_ouder);
				$this->redirect('index.php?page=kinderen');
			} else {
				$errors = $this->oudersDAO->getValidationErrorsParent($ouder);
				$this->set('errors', $errors);
			}

	}

	private function _handleChild($post, $ouder) {

				//user_id`,`ouder_id`,`voornaam`,`achternaam`,geslacht,`geboortedatum`,`alleen_naar_huis`,`medische`,`notitie`,`actief`,`registratiedatum
		$bday = str_replace("/","-", $post['geboortedatum']);
		$kind = array(
			'user_id' => $ouder['user_id'],
			'ouder_id' => $ouder['ID'],
			'voornaam' => $post['naam'],
			'achternaam' => $post['lastname'],
			'geslacht' => $post['geslacht'],
			'geboortedatum' => $bday,
			'alleen_naar_huis' => 0,
			'medische' => $post['medische'],
			'notities' => $post['notities'],
			'actief' => $post['actief'],
			'registratiedatum' => date("Y-m-d H:i:s")
		);

		$insert = $this->kinderenDAO->insert($kind);
		//var_dump($post);
		if(!empty($insert)) {

			$_SESSION['info'] = 'Toevoegen van '.$post['naam']. " ".$post['lastname'].' bij '. $ouder['voornaam']. " ". $ouder['familienaam'].' is gelukt!';
			if (isset($_POST['action']) && $_POST['action'] == "Opslaan") {

				//["action"]=> string(7) "Opslaan"
				// toevoegen en alles legen ook ouder
				unset($_SESSION['ouder']);
				$this->redirect('index.php?page=voegtoe');
			}else if(isset($_POST['add'])){

				//["add"]
				//toevoegen en niet ouder legen
				$this->redirect('index.php?page=voegtoe&button=bestaand&parent='.$ouder['ID']);
			} else{

				unset($_SESSION['ouder']);
				$this->redirect('index.php?page=voegtoe');
			}
		} else {
			$errors = $this->kinderenDAO->getValidationErrors($kind);
			$this->set('errors', $errors);
		}
	}
	private function _handleUpdateChild($post) {

				//user_id`,`ouder_id`,`voornaam`,`achternaam`,geslacht,`geboortedatum`,`alleen_naar_huis`,`medische`,`notitie`,`actief`,`registratiedatum
		$bday = str_replace("/","-", $post['geboortedatum']);
		$kind = array(
			'ID' => $post['ID'],
			'voornaam' => $post['naam'],
			'achternaam' => $post['achternaam'],
			'geslacht' => $post['geslacht'],
			'geboortedatum' => $bday,
			'alleen_naar_huis' => 0,
			'medische' => $post['medische'],
			'notities' => $post['notities'],
			'actief' => $post['actief'],
			'updatedatum' => date("Y-m-d H:i:s")
		);

		$insert = $this->kinderenDAO->update($kind);
		//var_dump($post);
		if(!empty($insert)) {

			$_SESSION['info'] = 'Bijwerken van '. $post['naam']. " ". $post['achternaam'].' gelukt!';
			$this->redirect('index.php?page=kinderen');

		} else {
			$errors = $this->kinderenDAO->getValidationErrors($kind);
			$this->set('errors', $errors);
		}
	}

}
