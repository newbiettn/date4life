<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Profile extends MY_Controller {
	/**
	 * 
	 */
	public function show_edit_personal_profile(){
		$username = $this->session->userdata ( 'username' );
		$this->load->model ( 'basic_user_model' );
		$userdata = $this->basic_user_model->get_user_info ( $username );
		$this->load->view ("edit_personal_info", $userdata);
		
	}
	public function edit_personal_profile(){
		$this->load->model ( 'basic_user_model' );
		
		$marital_status = $this->input->post('marital_status');
		$amount_of_children = $this->input->post('amount_of_children');
		$eye_color = $this->input->post('eye_color');
		$hair_color = $this->input->post('hair-color');
		$clothing_style = $this->input->post('clothing-style');
		$nationality = $this->input->post('nationality');
		$languages = $this->input->post('languages');
		$occupation = $this->input->post('occupation');
		$degree = $this->input->post('degree');
		$favorite = $this->input->post('favorite');
		$username = $this->session->userdata ( 'username' );
		
		$data = array(
			"marital_status" => $marital_status,
			"amount_of_children" => $amount_of_children,
			"eye_color" => $eye_color,
			"hair_color" => $hair_color,
			"clothing_style" => $clothing_style,
			"nationality" => $nationality,
			"languages" => $languages,
			"occupation" => $occupation,
			"degree" => $degree,
			"favorite" => $favorite
		);
		
		$this->basic_user_model->update_account($username, $data);
		
		$userdata = $this->basic_user_model->get_user_info ( $username );
		$userdata["new_update"] = true;
		$this->load->view ("edit_personal_info", $userdata);
	}
	/**
	 * 
	 * @param string $username
	 */
	public function view_profile($username = null) {
		$this->load->model ( 'block_user_model' );
		$this->load->model ( 'basic_user_model' );
		$this->load->model ( 'like_user_model' );
		$this->load->model ( 'attention_user_model' );
		
		if (is_null($username) || ($username == $this->session->userdata ( 'username' ))) {
			//current user
			$username = $this->session->userdata ( 'username' );
			$userdata = $this->basic_user_model->get_user_info ( $username );
			$this->load->view ("personal_profile", $userdata);
		} else {
			//other user
			$userdata = $this->basic_user_model->get_user_info ( $username );
			$current_user_id = $this->session->userdata ( 'oid' );
			$other_user_id = $userdata["oid"];
			$isAlreadyLiked = $this->like_user_model->isAlreadyLiked ( $current_user_id,  $other_user_id);
			$is_already_blocked = $this->block_user_model->isAlreadyBlocked($current_user_id, $other_user_id);

			//attention
			$is_allowed_to_send_attention = false;
			$is_attention_box_created = $this->attention_user_model->is_attention_box_created($other_user_id, $current_user_id);

			if (!$is_attention_box_created) {
				$is_allowed_to_send_attention = true;
			} else {
				$attention_box = $this->attention_user_model->get_attention_box($other_user_id, $current_user_id);
				$attention_box_id = $attention_box[0]["attention_box_oid"];
				$is_attention_duplicated = $this->attention_user_model->is_attention_duplicated($current_user_id, $attention_box_id);
				if (!$is_attention_duplicated) {
					$is_allowed_to_send_attention = true;
				} else {
					$is_allowed_to_send_attention = false;
				}
			}
			
			if ($is_already_blocked) {
				show_404();
			} else {
				$userdata["isAlreadyLiked"] = $isAlreadyLiked;
				$userdata["is_allowed_to_send_attention"] = $is_allowed_to_send_attention;
				$this->load->view ("friend_profile", $userdata);
			}
			
		}
	}
}