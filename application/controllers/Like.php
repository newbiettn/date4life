<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Like extends MY_Controller {
	public function view_liked_list() {
		$this->load->model ( 'like_user_model' );
		$this->load->model ( 'basic_user_model' );
		$current_user_id = $this->input->post ( 'current_user_id' );
		$list = $this->like_user_model->get_liked_list($current_user_id);
		$data = array();
		if ($list) {
			foreach ($list as $person) {
				$info = $this->basic_user_model->get_user_info_by_id($person["favorite_user_oid"]);
				array_push($data, $info);
			}
		}
		$display["list"] = $data;
		$this->load->view('liked_list', $display);
	}
	public function like_user() {
		$this->load->model ( 'like_user_model' );
		$current_user_id = $this->input->post ( 'current_user_id' );
		$favorite_user_id = $this->input->post ( 'favorite_user_id' );
		$is_already_liked = $this->like_user_model->isAlreadyLiked($current_user_id, $favorite_user_id);
		$status = "";
		if (!$is_already_liked) {
			$this->like_user_model->like_user($current_user_id, $favorite_user_id);
			$status = "success";
		} else {
			$status = "error";
		}
		
		echo json_encode ( array (
				'status' => $status,
		) );
		
	}
	
	public function unlike_user() {
		$this->load->model ( 'like_user_model' );
		$current_user_id = $this->input->post ( 'current_user_id' );
		$favorite_user_id = $this->input->post ( 'favorite_user_id' );
		$is_already_liked = $this->like_user_model->isAlreadyLiked($current_user_id, $favorite_user_id);
		$status = "";
		if ($is_already_liked) {
			$this->like_user_model->unlike_user($current_user_id, $favorite_user_id);
			$status = "success";
		} else {
			$status = "error";
		}
	
		echo json_encode ( array (
				'status' => $status,
		) );
	
	}
}