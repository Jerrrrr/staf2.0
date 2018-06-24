<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';

require_once WWW_ROOT . 'dao' . DS . 'UserDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'SponsorsDAO.php';

require_once WWW_ROOT . 'phpass' . DS . 'Phpass.php';


class StafController extends Controller {


	private $userDAO;
	private $sponsorsDAO;

	function __construct() {
		$this->userDAO = new UserDAO();
		$this->sponsorsDAO = new SponsorsDAO();
	}


	public function index(){

		
		$this->set('kinderen', $this->sponsorsDAO->selectAll());

	}



	public function staf() {
		//if(!empty($_FILES['image'])) {
		//	$this->_handleAdd($_POST);
		//}
		//$this->set('images', $this->sponsorsDAO->selectAll());
	}

	public function logout() {
		if (!empty($_SESSION['user'])) {
			unset($_SESSION['user']);
			$_SESSION['info'] = "logout is met succes gelukt!";
			$this->redirect('index.php');
		}
	}

	public function login() {
		
		if (!empty($_POST)) {
			if (!empty($_POST['username']) && !empty($_POST['password'])) {
				$existing_user = $this->userDAO->selectByUser($_POST['username']);
				if(!empty($existing_user)){
					$hasher = new \Phpass\Hash;
					$userchek = $hasher->checkPassword(
						$_POST['password'],
						$existing_user['password']
					);
					if ($userchek) {
						$_SESSION['user'] = $existing_user;
					}
				} else{
					$_SESSION['error']='username / password is niet juist!';
				}
			}else{
				$_SESSION['error']='username / password is niet juist!';
			}
		}
		$this->redirect('index.php?page=staf');
		
	}



	/*private function _handleAdd($data){
		if(empty($_SESSION['user'])) {
			$_SESSION['error'] = 'You need to be logged in to add pictures';
			$this->redirect('index.php?page=staf');
		}
		$errors = array();
		$size = array();
		if(!empty($_FILES['image'])) {
			if(!empty($_FILES['image']['error'])) {
				$errors['image'] = 'The image could not be uploaded';
			}
			if(empty($errors['image'])) {
				$size = getimagesize($_FILES['image']['tmp_name']); //chek of de afbeeling een size heeft zo niet = geen afbeelding
				if(empty($size)) {
					$errors['image'] = 'The uploaded file is not an image';
				}
			}
			if(empty($errors['image'])) {
				if($size[0] < 300 || $size[1] < 300) {
					$errors['image'] = 'The image needs to be at least 300x300';
				}
			}

			// upload de gecropte versie
			if(empty($errors['image'])) {
					$ext = explode('.', $_FILES['image']['name']);
					$ext = $ext[sizeof($ext) - 1];

					// data opslaan voorsturen naar dao
					$data = $_POST;
					$data['image'] = uniqid() . '.' . $ext;
					$data['size'] = '1';
					$data['created'] = date('Y-m-d H:i:s');

					//crop functie naar 612 x 612 en insert naar DAO waardes: "naam van de file","plaats"," xhoogte"," yhoogte"
					$this->_resizeAndCrop($_FILES['image']['tmp_name'], WWW_ROOT . 'images/sponsors' . DS . $data['image'], 400, 400);
					$this->sponsorsDAO->insert($data);

					$_SESSION['info'] = 'The image was uploaded!';
					$this->redirect('index.php?page=staf');
				}
		}
		if(!empty($errors)) {
			$_SESSION['error'] = 'The image could not be uploaded!';
		}
		$this->set('errors', $errors);
	}*/



	// een crop functie die de afbeelding mooi afsijt tot een vierkant

	//http://stackoverflow.com/questions/1855996/crop-image-in-php
	/*private function _resizeAndCrop($src, $dst, $thumb_width, $thumb_height) {
		$image = imagecreatefromjpeg($src);
		$filename = $dst;

		$width = imagesx($image);
		$height = imagesy($image);

		$original_aspect = $width / $height;
		$thumb_aspect = $thumb_width / $thumb_height;

		if ( $original_aspect >= $thumb_aspect ) {
		   // If image is wider than thumbnail (in aspect ratio sense)
		   $new_height = $thumb_height;
		   $new_width = $width / ($height / $thumb_height);
		} else {
		   // If the thumbnail is wider than the image
		   $new_width = $thumb_width;
		   $new_height = $height / ($width / $thumb_width);
		}

		$thumb = imagecreatetruecolor( $thumb_width, $thumb_height );

		// Resize and crop
		imagecopyresampled($thumb,
		                   $image,
		                   0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
		                   0 - ($new_height - $thumb_height) / 2, // Center the image vertically
		                   0, 0,
		                   $new_width, $new_height,
		                   $width, $height);
		imagejpeg($thumb, $filename, 80);
	}*/

}