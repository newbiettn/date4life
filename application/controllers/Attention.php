<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Attention extends MY_Controller {
	public function view_attention_list() {
		$this->load->model ( 'attention_user_model' );
		$this->load->model ( 'basic_user_model' );
		$current_user_id = $this->session->userdata('oid');
		$list = $this->attention_user_model->get_attention_list($current_user_id);

		$data = array();
		if ($list) {
			foreach ($list as $attention) {
				$info = $this->basic_user_model->get_user_info_by_id($attention["sender"]);
				array_push($data, $info);
			}
		}

		$display["list"] = $data;
		$this->load->view('attention_list', $display);
	}
	public function send_attention_back() {
		
	}
	public function send_attention(){
		$this->load->model ( 'attention_user_model' );
		$this->load->model ( 'basic_user_model' );
		
		$current_user_id = $this->input->post ( 'current_user_id' );
		$received_user_id = $this->input->post ( 'received_user_id' );
		$attentiontype_oid = $this->input->post ( 'attention_type' );
		
		$is_attention_box_created = $this->attention_user_model->is_attention_box_created($received_user_id, $current_user_id);
		$status = "";
		if (!$is_attention_box_created) {
			$attention_box_id = $this->attention_user_model->create_attention_box($received_user_id, $current_user_id);
			$attention_id = $this->attention_user_model->create_attention($current_user_id, $attention_box_id, $attentiontype_oid);
			$status = "success";
			//notification
			$this->handle_notification_for_attention($current_user_id, $received_user_id, $attention_box_id);
		} else {
			$attention_box = $this->attention_user_model->get_attention_box($received_user_id, $current_user_id);
			$attention_box_id = $attention_box[0]["attention_box_oid"];
			$is_attention_duplicated = $this->attention_user_model->is_attention_duplicated($current_user_id, $attention_box_id);

			if (!$is_attention_duplicated) {
				$attention_id = $this->attention_user_model->create_attention($current_user_id, $attention_box_id, $attentiontype_oid);
				$this->attention_user_model->mark_attention_as_checked($received_user_id, $attention_box_id);
				$status = "success";
				
				//notification
				$this->handle_notification_for_attention($current_user_id, $received_user_id, $attention_box_id);
			} else {
				$status = "error";
			}
		}
		
		echo json_encode ( array (
				'status' => $status,
		) );
	}
	
	public function handle_notification_for_attention($current_user_id, $received_user_id, $attention_box_id){
		$this->notification->notify_new_attention($attention_box_id, $current_user_id, $received_user_id);
	}
}