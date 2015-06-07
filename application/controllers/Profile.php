<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Profile extends MY_Controller {
	public function view_profile($username = null) {
		$this->load->model ( 'block_user_model' );
		$this->load->model ( 'basic_user_model' );
		$this->load->model ( 'like_user_model' );
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
			if ($is_already_blocked) {
				show_404();
			} else {
				$userdata["isAlreadyLiked"] = $isAlreadyLiked;
				$this->load->view ("friend_profile", $userdata);
			}
			
		}
	}
}