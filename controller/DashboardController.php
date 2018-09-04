<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';

require_once WWW_ROOT . 'dao' . DS . 'UserDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'WeekDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'KinderenDAO.php';

require_once WWW_ROOT . 'phpass' . DS . 'Phpass.php';


class DashboardController extends Controller {


	private $userDAO;
	private $weekDAO;
	private $kinderenDAO;

	function __construct() {

		$this->userDAO = new UserDAO();
		$this->weekDAO = new WeekDAO();
		$this->kinderenDAO = new KinderenDAO();
	}


	public function index(){

		// login pagina redarect naar login

		//$cookie_name = "user";
		//$cookie_value = "admin";
		//setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
		//unset($_COOKIE['user']);


		//$this->set('kinderen', $this->sponsorsDAO->selectAll());
		//var_dump($_COOKIE);

	}

	public function dashboard(){

		//dashboard pagina
		$data = array();

		$totaal = $this->kinderenDAO->selectAllCount();
		$NoPhotoNames = $this->kinderenDAO->selectAllNamesNoPhoto();
		$data['kinderen_totaal'] = $totaal['COUNT'];

		$totaal = $this->kinderenDAO->selectAllActiveCount();
		$data['kinderen_totaal_active'] = $totaal['COUNT'];

		//2016-07-25
		$datum = date("Y-m-d");
		$datum_yesterday = date("Y-m-d", time() - 60 * 60 * 24);

		$register_vandaag = $this->kinderenDAO->selectAllCountFromDate($datum);
		$register_yesterday = $this->kinderenDAO->selectAllCountFromDate($datum_yesterday);
		$data['register_vandaag'] = $register_vandaag['COUNT'];
		$data['register_yesterday'] = $register_yesterday['COUNT'];

		$present_vandaag = $this->weekDAO->selectAanwezigheidCountFromDate($datum);
		$present_yesterday = $this->weekDAO->selectAanwezigheidCountFromDate($datum_yesterday);

		$data['present_vandaag']['vm'] = $present_vandaag['VM'];
		$data['present_vandaag']['nm'] = $present_vandaag['NM'];
		$data['present_vandaag']['vd'] = $present_vandaag['VD'];
		$data['present_vandaag']['tot'] = $present_vandaag['TOT'];

		$data['present_yesterday']['vm'] = $present_yesterday['VM'];
		$data['present_yesterday']['nm'] = $present_yesterday['NM'];
		$data['present_yesterday']['vd'] = $present_yesterday['VD'];
		$data['present_yesterday']['tot'] = $present_yesterday['TOT'];

		$year = date('Y');
		if (isset($_POST["jaar"])) {
			$year = $_POST["jaar"];
		}

		$grafic = [];
		$grafic_full = $this->weekDAO->selectAanwezigheidCountFromDays($year);
		foreach ($grafic_full as $key => $value) {
			array_push($grafic, $value);
		}
		$grafic = json_encode($grafic);

		$grafic__HD = [];
		$grafic_HD = $this->weekDAO->selectAanwezigheidCountFromDaysHalfDay($year);
		foreach ($grafic_HD as $key => $value) {
			array_push($grafic__HD, $value);
		}
		$grafic__HD = json_encode($grafic__HD);

		$grafic__VD = [];
		$grafic_VD = $this->weekDAO->selectAanwezigheidCountFromDaysFullDay($year);
		foreach ($grafic_VD as $key => $value) {
			array_push($grafic__VD, $value);
		}
		$grafic__VD = json_encode($grafic__VD);

		if (isset($_POST['resetten'])) {
			if (isset($_POST['reset_check'])) {
				if ($this->kinderenDAO->updateActiveToZero()) {
					$_SESSION['info'] = "Het resetten van de kinderen is gelukt!";
				}else {
					$_SESSION['errors'] = 'Er is iets fout gelopen bij het resetten van de kinderen!';
					$this->set('errors', $errors);
				}
			}else {
				$errors['reset_check'] = 'De checkbox moet aangevinkt worden!';
				$this->set('errors', $errors);
			}
		}

		$this->set('data', $data);
		$this->set('NoPhotoNames', $NoPhotoNames);
		$this->set('grafic', $grafic);
		$this->set('grafic_HD', $grafic__HD);
		$this->set('grafic_VD', $grafic__VD);

	}

	public function login(){

		if(!empty($_POST)){
			if(!empty($_POST['username']) && !empty($_POST['password'])){

				$user = $this->userDAO->selectByUser($_POST['username']);

				if(!empty($user)){
				$hasher = new \Phpass\Hash;
				$authenticated = $hasher->checkPassword(
					$_POST['password'],
					$user['password']
					);

					if($authenticated){

								$cookie_name = "user_tHg4*t?Vrs@3K6#5J4";
								$cookie_value = $_POST['username'];
								setcookie($cookie_name, $cookie_value, strtotime('+1 day 00:59'), "/"); // 86400 = 1 day
					}else{
						$_SESSION['error'] = "unknown username / password";
					}

				}else{
					$_SESSION['error'] = "unknown username / password";
				}
		}else{
				$_SESSION['error'] = "unknown username / password";
			}
		}
		$this->redirect('index.php?page=dashboard');
	}

	public function logout(){

		if( isset($_COOKIE['user_tHg4*t?Vrs@3K6#5J4']) && !empty($_COOKIE['user_tHg4*t?Vrs@3K6#5J4'])){

			//unset($_COOKIE['user']);
			unset($_COOKIE['user_tHg4*t?Vrs@3K6#5J4']);
    		setcookie('user_tHg4*t?Vrs@3K6#5J4', '', time() - 3600, '/'); // empty value and old timestamp
		}

		$_SESSION['info'] = "user is logged out";
		$this->redirect('index.php');
	}

	public function register(){

		// registreer pagina

		if(!empty($_POST)){

			$errors = array();
			if(empty($_POST['username'])){
				$errors['username'] = "please fill in an username";
			}
			if(empty($_POST['password'])){
				$errors['password'] = "please fill in a password";
			} else if (strlen($_POST["password"]) < 12) {
				$errors['password'] = "Wachtwoord moet minstens 12 karakters lang zijn. Gebruik desnoods een \"passphrase\".";
			}
			if($_POST['password'] != $_POST['confirm_password']){
				$errors['confirm_password'] = "please fill in a matching pass";
			}

			if(empty($errors)){


				$hasher = new \Phpass\Hash;

				$inserted_user = array(
					"username" => $_POST['username'],
					"password" => $hasher->hashPassword($_POST['password']),
					"role" => 0,
					"registratiedatum" => date("Y-m-d H:i:s")
					);

				if(!empty($inserted_user)){

					$this->userDAO->insert($inserted_user);
					$_SESSION['info'] = "registration succesful!";
					$this->redirect('index.php?page=dashboard');
				}

			}else{
				$_SESSION['error'] = "Gebruiker registreren is niet gelukt";
				$this->set('errors', $errors);

			}
		}

	}

	public function delete(){

		$role = 0;
		$users = $this->userDAO->selectByRole($role);
		$this->set('users', $users);

		if (!empty($_GET['id'])) {

			$date = $_GET['id'];
			$user = $this->userDAO->selectByRegistratiedatum($date);

			if (!empty($user)) {

				$this->userDAO->delete($date);
				$_SESSION['info'] = "Delete user succesful!";
				$this->redirect('index.php?page=dashboard');
			}


		}
	}

	public function update() {
		$logged_in_user = $this->userDAO->selectByUser($_COOKIE["user_tHg4*t?Vrs@3K6#5J4"]);
		if ($logged_in_user["role"] == 1) {
			// GOTO Super User Edit Page
			$this->redirect("index.php?page=update_super");
		} else {
			$this->redirect("index.php?page=update_normal");
		}
	}

	public function update_normal() {
		$logged_in_user = $this->userDAO->selectByUser($_COOKIE["user_tHg4*t?Vrs@3K6#5J4"]);
		var_dump($logged_in_user);
		if (!empty($_POST)) {
			$errors = array();
			if (empty($_POST["password"]) || !isset($_POST["password"])) {
				$errors["password"] = "Wachtwoord mag niet leeg zijn.";
			}
			if (strlen($_POST["password"]) < 12) {
				$errors['password'] = "Wachtwoord moet minstens 12 karakters lang zijn. Gebruik desnoods een \"passphrase\".";
			}

			if (!empty($errors)) {
				$_SESSION['error'] = "Wachtwoord kon niet gewijzigd worden.";
				$this->set('errors', $errors);
			} else {
				$hasher = new \Phpass\Hash;

				$logged_in_user = $this->userDAO->selectByUser($_COOKIE["user_tHg4*t?Vrs@3K6#5J4"]);
				$logged_in_user['password'] = $hasher->hashPassword($_POST['password']);

				$this->userDAO->update($logged_in_user["ID"], $logged_in_user);
				$_SESSION['info'] = "Wachtwoord gewijzigd.";
				$this->redirect('index.php?page=dashboard');
			}
		}
	}


}
