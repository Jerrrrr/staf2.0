<?php
require_once WWW_ROOT . 'dao' . DS . 'DAO.php';
class UserDAO extends DAO {
	
	public function selectAll() {
		$sql = "SELECT * FROM `wp_staf_users`";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM `wp_staf_users` WHERE `ID` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectByRole($role) {
		$sql = "SELECT * FROM `wp_staf_users` WHERE role = :role";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':role', $role);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectByUser($username) {
		$sql = "SELECT * FROM `wp_staf_users` WHERE `username` = :username";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':username', $username);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectByRegistratiedatum($registratiedatum) {
		$sql = "SELECT * FROM `wp_staf_users` WHERE `registratiedatum` = :registratiedatum";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':registratiedatum', $registratiedatum);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function insert($data) {
		$errors = $this->getValidationErrors($data);
		if(empty($errors)) {
			$sql = "INSERT INTO `wp_staf_users` (`username`, `password`, `role`, `registratiedatum`) VALUES (:username, :password, :role, :registratiedatum)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':username', $data['username']);
			$stmt->bindValue(':password', $data['password']);
			$stmt->bindValue(':role', $data['role']);
			$stmt->bindValue(':registratiedatum', $data['registratiedatum']);
			if($stmt->execute()) {
				$insertedId = $this->pdo->lastInsertId();
				return $this->selectById($insertedId);
			}
		}
		return false;
	}

	public function update($id, $data) {
		$errors = $this->getValidationErrors($data);
		if(empty($errors)) {
			$sql = "UPDATE `wp_staf_users` SET `username` = :username, `password` = :password, `role` = :role WHERE `id` = :id";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':username', $data['username']);
			$stmt->bindValue(':password', $data['password']);
			$stmt->bindValue(':role', $data['role']);
			$stmt->bindValue(':id', $id);
			if($stmt->execute()) {
				return $this->selectById($id);
			}
		}
		return false;
	}

	public function delete($registratiedatum) {
		$sql = "DELETE FROM `wp_staf_users` WHERE `registratiedatum` = :registratiedatum";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':registratiedatum', $registratiedatum);
		return $stmt->execute();
	}

	public function getValidationErrors($data) {
		$errors = array();
		if(empty($data['username'])) {
			$errors['username'] = 'please enter the username';
		}
		if(empty($data['password'])) {
			$errors['password'] = 'please enter the password';
		}
		if(!isset($data['role'])) {
			$errors['role'] = 'please enter admin state';
		}
		return $errors;
	}
}