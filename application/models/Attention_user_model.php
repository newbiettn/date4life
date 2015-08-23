<?php
class Attention_user_model extends CI_Model{

	public function get_attention_list($user_id) {
		$sql = "SELECT * FROM attention WHERE status = 0 AND sender != ? AND attentionbox_oid IN 
				(SELECT attention_box_oid 
				FROM attentionbox
				WHERE receiver = ? OR sender = ?)";

		$q = $this->db->query($sql, array($user_id, $user_id, $user_id));

		if ($q->num_rows() > 0){
			return $q->result_array();
		}
		return false;
	}

	public function create_attention_box($receiver_id, $sender_id){
		$data = array(
			"receiver" => $receiver_id,
			"sender" => $sender_id,
			"time" => date("Y-m-d H:i:s")
		);
		$q = $this->db->insert('attentionbox', $data);
		return $this->db->insert_id();
	}

	public function is_attention_box_created($receiver_id, $sender_id) {
		//check 1 way first
		$this->db->where('receiver', $receiver_id);
		$this->db->where('sender', $sender_id);
		$q = $this->db->get('attentionbox');
		if ($q -> num_rows() > 0) {
			return true;
		}

		//check reverse way
		$this->db->where('sender', $receiver_id);
		$this->db->where('receiver', $sender_id);
		$q = $this->db->get('attentionbox');
		if ($q -> num_rows() > 0) {
			return true;
		}
		return false;
	}
	
	public function create_attention($sender_id, $attention_box_id, $attentiontype_oid){
		$data = array(
				"sender" => $sender_id,
				"time" => date("Y-m-d H:i:s"),
				"attentionbox_oid" => $attention_box_id,
				"attentiontype_oid" => $attentiontype_oid,
				"status" => '0'
		);
		$q = $this->db->insert('attention', $data);
		return $this->db->insert_id();
	}
	
	public function mark_attention_as_checked($sender_id, $attention_box_id) {
		$data = array(
			'status' =>1	
		);
		$this->db->where('sender', $sender_id);
		$this->db->where('attentionbox_oid', $attention_box_id);
		$this->db->update('attention', $data);
	}
	public function is_attention_duplicated($sender_id, $attention_box_id) {
		$this->db->where('sender', $sender_id);
		$this->db->where('attentionbox_oid', $attention_box_id);
		$this->db->where('status', "0");
		$q = $this->db->get('attention');
		
		if ($q -> num_rows() > 0) {
			return true;
		}
		return false;
	}
	public function get_attention_box($receiver_id, $sender_id){
		//check 1 way first
		$this->db->where('receiver', $receiver_id);
		$this->db->where('sender', $sender_id);
		$q = $this->db->get('attentionbox');
		if ($q -> num_rows() > 0) {
			return $q->result_array();;
		}
		
		//check reverse way
		$this->db->where('sender', $receiver_id);
		$this->db->where('receiver', $sender_id);
		$q = $this->db->get('attentionbox');
		if ($q -> num_rows() > 0) {
			return $q->result_array();;
		}
		return false;
	}
	
	
}