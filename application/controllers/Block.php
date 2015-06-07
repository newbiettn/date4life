<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Block extends MY_Controller {
	public function view_blocked_list() {
		$this->load->model ( 'block_user_model' );
		$this->load->model ( 'basic_user_model' );
		$current_user_id = $this->session->userdata ( 'oid' );
		$list = $this->block_user_model->get_blocked_list($current_user_id);
		$data = array();
		if ($list) {
			foreach ($list as $person) {
				$info = $this->basic_user_model->get_user_info_by_id($person["blocked_user_oid"]);
				array_push($data, $info);
			}
		}
		$display["list"] = $data;
		$this->load->view('blocked_list', $display);
	}
	
	public function block_user() {
		$this->load->model ( 'block_user_model' );
		$this->load->model ( 'like_user_model' );
		$current_user_id = $this->input->post ( 'current_user_id' );
		$blocked_user_id = $this->input->post ( 'blocked_user_id' );
		$is_already_blocked = $this->block_user_model->isAlreadyBlocked($current_user_id, 
				$blocked_user_id);
		$status = "";
		if (!$is_already_blocked) {
			$this->block_user_model->block_user($current_user_id, $blocked_user_id);
			$this->like_user_model->unlike_user($current_user_id, $blocked_user_id);
			$status = "success";
		} else {
			$status = "error";
		}
		redirect("profile/view_profile");
	}
	
	public function unblock_user() {
		$this->load->model ( 'block_user_model' );
		$current_user_id = $this->input->post ( 'current_user_id' );
		$blocked_user_id = $this->input->post ( 'blocked_user_id' );
		$is_already_blocked = $this->block_user_model->isAlreadyBlocked($current_user_id, $blocked_user_id);
		$status = "";
		if ($is_already_blocked) {
			$this->block_user_model->unblock_user($current_user_id, $blocked_user_id);
			$status = "success";
		} else {
			$status = "error";
		}
	
		echo json_encode ( array (
				'status' => $status,
		) );
	
	}
}