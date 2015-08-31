<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class User extends CI_Controller {

	public function index() {
		if (! $this->session->userdata ( 'username' )) {
			$this->show_login ();
		}
	}
	public function pusher_authentication() {
		if ($this->session->userdata('username') && $this->session->userdata('id')) {
			$this->load->library('Pusher/pusher');
			$app_id 	= '135278';
			$app_key 	= '612cb18b054eb8cc1309';
			$app_secret = '31ef7a6a622b91251139';
				
			$pusher = new Pusher($app_key, $app_secret, $app_id);
			$presencedata = array(
					'id' => $this->session->userdata('id')
			);
			echo $pusher->presence_auth($_POST['channel_name'],
					$this->session->userdata('uuid'),
					$presencedata);
		}
	}
	// --------------------------------------------------------------------
	public function show_login() {
		if (! $this->session->userdata ( 'username' )) {
			$data ['username_cookie'] = $this->input->cookie ( 'ihf_usr_ck' );
			$this->load->view ( 'login', $data );
		} else {
			redirect ( 'profile/view_profile' );
		}
	}
	// --------------------------------------------------------------------
	public function show_register() {
		if (! $this->session->userdata ( 'username' )) {
			$this->load->view ( 'register' );
		} else {
			redirect ( 'profile/view_profile' );
		}
	}
	
	// --------------------------------------------------------------------
	public function do_login() {		
		$this->form_validation->set_rules ( 'username', 'User Name', 'required|trim|max_length[50]|callback_validateUsernameEx' );
		$this->form_validation->set_rules ( 'password', 'Password', 'required|trim|max_length[200]|callback_validatePwd' );
		
		if ($this->form_validation->run () == TRUE) {
			$this->load->model ( 'basic_user_model' );
			// get variables
			$username = $this->input->post ( 'username' );
			$password = $this->input->post ( 'password' );
			
			// get everything about users
			$userdata = $this->basic_user_model->get_user_info ( $username );
			
			// and store in session
			$this->session->set_userdata ( $userdata );
			
			// get subscribing channels
			$userid = $this->session->userdata('oid');
			$channelArr = array($userid . "");
						
			//and update session
			$this->session->set_userdata('channels', $channelArr);

			redirect ( 'profile/view_profile' );
		}
		$this->show_login ();
	}
	// --------------------------------------------------------------------
	/**
	 * Used to create new member
	 */
	public function create_member() {
		$this->form_validation->set_rules ( 'username', 'Nickname', 'trim|required|min_length[4]|callback_validateUsernameSp|callback_validateUsernameNotEx' );
		$this->form_validation->set_rules ( 'password', 'Password', 'trim|required|min_length[4]|callback_validatePwdStr' );
		$this->form_validation->set_rules ( 'email', 'Email Address', 'trim|required|valid_email|callback_validateEmail' );
		$this->form_validation->set_rules ( 'dob', 'Date of Birth', 'trim|required' );
		$this->form_validation->set_rules ( 'dob', 'Date of Birth', 'trim|required' );
		$this->form_validation->set_rules ( 'description', 'Description', 'trim|required' );
		
		if ($this->form_validation->run () == FALSE) {
			$this->load->view ( 'register' );
		} else {
			$this->load->model ( 'basic_user_model' );
			if ($user_id = $this->basic_user_model->create_member ()) {
				$this->show_congratulation ();
			} else {
				$this->load->view ( 'register' );
			}
		}
	}
	
	public function show_congratulation(){
		$this->load->view('congratulation_login');
	}
	// --------------------------------------------------------------------
	public function do_logout() {
		$this->session->sess_destroy ();
		redirect ( 'welcome' );
	}
	// --------------------------------------------------------------------
	/**
	 * The callback to validate if username exists.
	 *
	 * Error if does not exist.
	 * Used for login
	 */
	public function validateUsernameEx() {
		$this->load->model ( 'basic_user_model' );
		$username = $this->input->post ( 'username' );
		$q = $this->basic_user_model->validateUsername ( $username );
		if (! $q) {
			$this->form_validation->set_message ( 'validateUsernameEx', 'Invalid username!' );
			return FALSE;
		}
	}
	// --------------------------------------------------------------------
	/**
	 * The callback to validate if username is not duplicated
	 * Error if exists.
	 *
	 * Used for register.
	 */
	public function validateUsernameNotEx() {
		$this->load->model ( 'basic_user_model' );
		$username = $this->input->post ( 'username' );
		$q = $this->basic_user_model->validateUsername ( $username );
		if ($q) {
			$this->form_validation->set_message ( 'validateUsernameNotEx', 'Username ' . $username . ' already exists!' );
			return FALSE;
		}
	}
	// --------------------------------------------------------------------
	/**
	 * Validate if password is correct when compared to DB
	 * Error if does not match
	 * Used for login
	 */
	public function validatePwd() {
		$this->load->model ( 'basic_user_model' );
		$pwdHash = $this->basic_user_model->getPwdHashUser ();
		$password = $this->input->post ( 'password' );
		
		if (isset ( $pwdHash )) {
			if (! $this->basic_user_model->validatePwd ( $password, $pwdHash )) {
				$this->form_validation->set_message ( 'validatePwd', 'The password you entered is incorrect. Lost your password?' );
				return FALSE;
			}
		}
	}
	// --------------------------------------------------------------------
	/**
	 * Validate if username contains no special characters
	 * Error if contains
	 * Used for register
	 */
	public function validateUsernameSp() {
		$username = $this->input->post ( 'username' );
		if (! ctype_alnum ( $username )) {
			$this->form_validation->set_message ( 'validateUsernameSp', 'No special characters in username!' );
			return FALSE;
		}
	}
	// --------------------------------------------------------------------
	/**
	 * Validate if password is strong enough
	 * Error if weak
	 * Used for register
	 */
	public function validatePwdStr() {
		$password = $this->input->post ( 'password' );
		if (strlen ( $password ) < 8) {
			$this->form_validation->set_message ( 'validatePwdStr', 'Password too short!' );
			return FALSE;
		}
		
		if (! preg_match ( "#[0-9]+#", $password )) {
			$this->form_validation->set_message ( 'validatePwdStr', 'Password must include at least one number!' );
			return FALSE;
		}
		
		if (! preg_match ( "#[a-zA-Z]+#", $password )) {
			$this->form_validation->set_message ( 'validatePwdStr', 'Password must include at least one letter!' );
			return FALSE;
		}
	}
	// --------------------------------------------------------------------
	/**
	 * Validate if email is duplicated
	 * Error if duplicated
	 * Used for register
	 */
	public function validateEmail() {
		$this->load->model ( 'basic_user_model' );
		$email = $this->input->post ( 'email' );
		$query = $this->basic_user_model->validateEmail ( $email );
		
		if ($query) {
			$this->form_validation->set_message ( 'validateEmail', 'Your email is registered for another account' );
			return FALSE;
		}
	}
	// --------------------------------------------------------------------
	/**
	 * Upload
	 */
	public function upload_file() {
		$status = "";
		$msg = "";
		$file_element_name = 'profile_picture';
		$this->load->model ( 'basic_user_model' );
		if ($status != "error") {
			$config ['upload_path'] = 'static/upload/';
			$config ['allowed_types'] = 'gif|jpg|png';
			$config ['max_size'] = 1024 * 8;
			$config ['encrypt_name'] = TRUE;
			
			$this->load->library ( 'upload', $config );
			
			if (! $this->upload->do_upload ( $file_element_name )) {
				$status = 'error1';
				$msg = $this->upload->display_errors ( '', '' );
			} else {
				$data = $this->upload->data ();
				$status = 'success';
				$msg = $data ['file_name'];
			}
			@unlink ( $_FILES [$file_element_name] );
		}
		echo json_encode ( array (
				'status' => $status,
				'msg' => $msg 
		) );
	}
}
