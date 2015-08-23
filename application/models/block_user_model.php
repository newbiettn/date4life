<?php

class Block_user_model extends CI_Model{
	public function get_blocked_list($current_user_id) {
		$data = array(
			'user_oid' => $current_user_id
		);
		$q = $this->db->get('blocklist', $data);
		if ($q -> num_rows() > 0) {
			return $q->result_array();
		}
		return false;
	}
	public function block_user ($current_user_id, $blocked_user_id) {
		$data = array(
			'blocked_user_oid' => $blocked_user_id,
			'user_oid' => $current_user_id
		);
		$q = $this->db->insert('blocklist', $data);
	}
	
	public function unblock_user ($current_user_id, $blocked_user_id) {
		$data = array(
				'blocked_user_oid' => $blocked_user_id,
				'user_oid' => $current_user_id
		);
		$q = $this->db->delete('blocklist', $data);
	}
	
	public function isAlreadyBlocked($current_user_id, $blocked_user_id){
		$this->db->where('user_oid', $current_user_id);
		$this->db->where('blocked_user_oid', $blocked_user_id);
		$query = $this->db->get('blocklist');
		if($query->num_rows() == 1){
			return true;
		}
		return false;
	}
}