<?php

class Like_user_model extends CI_Model{
	public function get_liked_list($current_user_id) {
		$data = array(
			'user_oid' => $current_user_id
		);
		$q = $this->db->get('favoritelist');
		if ($q -> num_rows() > 0) {
			return $q->result_array();
		}
		return false;
	}
	public function like_user ($current_user_id, $favorite_user_id) {
		$data = array(
			'favorite_user_oid' => $favorite_user_id,
			'user_oid' => $current_user_id
		);
		$q = $this->db->insert('favoritelist', $data);
	}
	
	public function unlike_user ($current_user_id, $favorite_user_id) {
		$data = array(
				'favorite_user_oid' => $favorite_user_id,
				'user_oid' => $current_user_id
		);
		$q = $this->db->delete('favoritelist', $data);
	}
	
	public function isAlreadyLiked($current_user_id, $favorite_user_id){
		$this->db->where('user_oid', $current_user_id);
		$this->db->where('favorite_user_oid', $favorite_user_id);
		$query = $this->db->get('favoritelist');
		if($query->num_rows() == 1){
			return true;
		}
		return false;
	}
}