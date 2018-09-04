<?php

require_once WWW_ROOT . 'dao' . DS . 'DAO.php';

class WPDAO extends DAO {

	public function update_user_meta($user_id, $meta_key, $meta_value) {
		$sql = "UPDATE wp_usermeta SET `meta_value` = :meta_value WHERE `user_id` = :user_id AND `meta_key` = :meta_key";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':meta_value', $meta_value);
		$stmt->bindValue(':user_id', $user_id);
		$stmt->bindValue(':meta_key', $meta_key);
		return $stmt->execute();
	}
}