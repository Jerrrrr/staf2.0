<?php
require_once WWW_ROOT . 'dao' . DS . 'DAO.php';
class SponsorsDAO extends DAO {
	
	public function selectAll() {
		$sql = "SELECT * FROM `wp_kinderen`";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectById($id) {
		//$sql = "SELECT * FROM `sponsors` WHERE `id` = :id";
		//$stmt = $this->pdo->prepare($sql);
		//$stmt->bindValue(':id', $id);
		//$stmt->execute();
		//return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function insert($data) {
		//$errors = $this->getValidationErrors($data);
		//if(empty($errors)) {
		//	$sql = "INSERT INTO `sponsors` 	(`image`,`size`,`created`) 
		//				VALUES 			    (:image, :size, :created)";
		//	$stmt = $this->pdo->prepare($sql);
		//	$stmt->bindValue(':image', $data['image']);
		//	$stmt->bindValue(':size', $data['size']);
		//	$stmt->bindValue(':created', $data['created']);
		//	if($stmt->execute()) {
		//		$insertedId = $this->pdo->lastInsertId();
		//		return $this->selectById($insertedId);
		//	}
		//}
		//return false;
	}

	public function getValidationErrors($data) {
		//$errors = array();
		//if(!isset($data['image'])) {
		//	$errors['image'] = 'image is missing';
		//}
		//if(!isset($data['size'])) {
		//	$errors['size'] = 'size is missing';
		//}
		//if(!isset($data['created'])) {
		//	$errors['created'] = 'created is missing';
		//}
		//return $errors;
	}
}