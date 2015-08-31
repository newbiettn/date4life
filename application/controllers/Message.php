<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Message extends MY_Controller {
	public function index($received_user_id=null) {
		$this->load->model ( 'message_user_model' );
		$this->load->model ( 'basic_user_model' );
		$current_user_id = $this->session->userdata ( 'oid' );
		
		$conversation_list = $this->prepare_all_chat_conversation($current_user_id);
		if ($received_user_id != null) {
			$is_chat_conversation_created_first_way = $this->message_user_model->is_chat_conversation_created ( $received_user_id, $current_user_id );
			$is_chat_conversation_created_second_way = $this->message_user_model->is_chat_conversation_created ( $current_user_id, $received_user_id );
			$chat_conversation_id = null;
			$chat_all_messages = "";
			if (! $is_chat_conversation_created_first_way && !$is_chat_conversation_created_second_way) {
				$chat_conversation_id = $this->message_user_model->create_chat_conversation ( $received_user_id, $current_user_id );
			} else {
				$chat_conversation = $this->message_user_model->get_chat_conversation ( $received_user_id, $current_user_id );
				$chat_conversation_id = $chat_conversation[0]["chatconversation_oid"];
			}
			
			$conversation_list = $this->prepare_all_chat_conversation($current_user_id);
			
			$view_data = array();
			$view_data["conversation_list"] = $conversation_list;
			$view_data["chat_conversation_id"] = $chat_conversation_id;
			$view_data["friend_id"] = $received_user_id;
			$view_data["friend_data"] = $this->basic_user_model->get_user_info_by_id($received_user_id);
			$this->load->view('message', $view_data);

		} else if ($conversation_list && $received_user_id == null) {
			
			$conversation_list = $this->prepare_all_chat_conversation($current_user_id);
			$view_data = array();
			$view_data["conversation_list"] = $conversation_list;
			$chat_conversation = $this->message_user_model->get_chat_conversation ( $conversation_list[0]["friend_id"], $current_user_id );
// 			var_dump($chat_conversation); break;
			$view_data["chat_conversation_id"] = $chat_conversation[0]["chatconversation_oid"];
			$view_data["friend_id"] = $conversation_list[0]["friend_id"];
			$view_data["friend_data"] = $this->basic_user_model->get_user_info_by_id($conversation_list[0]["friend_id"]);
			$this->load->view('message', $view_data);
		} else {
			$this->load->view('new_message');
		}
	}
	
	public function create_very_first_message() {
		$this->load->model ( 'message_user_model' );
		
		$received_user_id = $this->input->post('message_to_id');
		$message_detail = $this->input->post('message_detail');
		$current_user_id = $this->session->userdata ( 'oid' );
		$conversation_list = $this->prepare_all_chat_conversation($current_user_id);
		if ($conversation_list == null) {
			$chat_conversation_id = $this->message_user_model->create_chat_conversation ( $received_user_id, $current_user_id );
			$msg_id = $this->message_user_model
				->create_chat_message($current_user_id, $chat_conversation_id, $message_detail);
		}
		redirect('message/index/' . $received_user_id);
	}
	public function prepare_all_chat_conversation($user_id) {
		$this->load->model ( 'basic_user_model' );
		
		$conversation_list = array();
		//get all chat conversation
		$all_chat_conversation = $this->message_user_model->get_all_chat_conversation($user_id);
		
		foreach($all_chat_conversation as $conversation) {
			$conversation_info = array();
			$friend_id = null;
			$friend_picture_name = null;
			$friend_username = null;
			
			if ($conversation["sender"] != $user_id) {
				$friend_id = $conversation["sender"]; 
			} else {
				$friend_id = $conversation["receiver"];
			}
			
			$info = $this->basic_user_model->get_user_info_by_id($friend_id);
			$friend_picture_name = $info["picture"];
			$friend_username = $info["username"];
						
			$conversation_info["friend_id"] = $friend_id;
			$conversation_info["picture"] = $friend_picture_name;
			$conversation_info["username"] = $friend_username;
			$conversation_info["conversation_id"] = $conversation["chatconversation_oid"];
			 
			array_push($conversation_list, $conversation_info);
		}
		return $conversation_list;
	}
	
	public function get_all_messages_for_a_conversation() {
		$this->load->model ( 'message_user_model' );
		$conversation_id = $this->input->post("conversation_id");
		$chat_all_messages = $this->message_user_model->get_all_chat_message($conversation_id);
		echo json_encode($chat_all_messages);
	}
	
	public function send_message(){
		$this->load->model ( 'message_user_model' );
		$sender_id = $this->input->post("sender_id");
		$chat_conversation_id = $this->input->post("chat_conversation_id");
		$message = $this->input->post("message");

		$msg_id = $this->message_user_model
			->create_chat_message($sender_id, $chat_conversation_id, $message);
		$status = "";
		if ($msg_id) {
			$status = "success";
		} else {
			$status = "error";
		}
		echo json_encode(array("status" => $status));
	}
}
