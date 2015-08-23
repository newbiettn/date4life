<?php

class Message_user_model extends CI_Model{
	public function create_chat_conversation($receiver_id, $sender_id){
		$data = array(
			"receiver" => $receiver_id,
			"sender" => $sender_id,
			"time" => date("Y-m-d H:i:s")
		);
		$q = $this->db->insert('chatconversation', $data);
		return $this->db->insert_id();
	}
	
	public function is_chat_conversation_created($receiver_id, $sender_id) {
		$this->db->select("*")
			->from("chatconversation")
			->where("sender", $sender_id)
			->where("receiver", $receiver_id);
		$q = $this->db->get();
		if ($q -> num_rows() > 0) {
			return true;
		}
		return false;
	}
	
	public function create_chat_message($sender_id, $chat_conversation_id, $message){
		$data = array(
				"sender" => $sender_id,
				"time" => date("Y-m-d H:i:s"),
				"chatconversation_cc_oid" => $chat_conversation_id,
				"message" => $message
		);
		$q = $this->db->insert('chatmessage', $data);
		return $this->db->insert_id();
	}
	
	public function get_chat_conversation($receiver_id, $sender_id){
		$data = array(
				"receiver" => $receiver_id,
				"sender" => $sender_id
		);
		$q = $this->db->get('chatconversation', $data);
		return $q->result_array();
	}
	
	public function get_all_chat_message($chat_conversation_id) {
		$this->db->select("*")
				->from("chatmessage")
				->where("chatconversation_cc_oid", $chat_conversation_id)
				->order_by("time", "asc"); 
				
		$q = $this->db->get();
		return $q->result_array();
	}
	
	public function get_all_chat_conversation($user_id) {
		$this->db->select("*")
				->from("chatconversation")
				->where("sender", $user_id)
				->or_where("receiver", $user_id);
		$q = $this->db->get();
		return $q->result_array();
	}
	
}