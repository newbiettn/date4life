<?php

class Basic_user_model extends CI_Model{
	// --------------------------------------------------------------------
	/**
	 * Get password hash by username
	 * Return null if does not exists
	 *
	 */
	function getPwdHashUser(){
		$this->db->where('username', $this->input->post('username'));
		$query = $this->db->get('user');
		if($query->num_rows() == 1){
			return $query->row()->password;
		} 
		return null;
	}
	// --------------------------------------------------------------------
	/**
	 * Verifies that the given hash matches the given password.
	 * Return true if match, otherwise false 
	 *
	 */
	function validatePwd($pwd, $pwdHash) {
		return password_verify($pwd, $pwdHash);
	}
	// --------------------------------------------------------------------
	/**
	* Validate if username exists
	* Return TRUE if exists
	*
	*/
	function validateUsername($username){
		$this->db->where('username', $username);
		$query = $this->db->get('user');
		if($query->num_rows() == 1){
			return true;
		}
	}
	// --------------------------------------------------------------------
	/**
	 * Validate if email exists
	 * Return TRUE if exists
	 *
	 */
	 function validateEmail($email){
	 	$this->db->where('email', $email);
	 	$query = $this->db->get('user');
	 	if($query->num_rows() == 1){
	 		return true;
	 	}
	 }
	// --------------------------------------------------------------------
	 /**
	  * Create new user
	  *
	  */
	function create_member(){
		$data=array(
			'username' => $this->input->post('username'),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'email' => $this->input->post('email'),
			'dob' => $this->input->post('dob'),
			'gender' => $this->input->post('gender'),
			'picture' => $this->input->post('profile_picture_name'),
			'description' => $this->input->post('description'),
			'location' => $this->input->post('location'),
			'looking_for' => $this->input->post('looking_for')
		);
		$q = $this->db->insert('user', $data);
		return $this->db->insert_id();
	}

	// --------------------------------------------------------------------
	 /**
	  * Create new user from input arguments
	  *
	  */
	function create_member_from_array($userdata) {
		$q = $this->db->insert('users', $userdata);
		return $this->db->insert_id();
	}

	// --------------------------------------------------------------------
	 /**
	  * Get user info
	  *
	  */
	function get_user_info($username) {
		$sql = "SELECT user.*, location.location_name FROM user, location
				WHERE username = ?
				AND user.location = location.oid";
		$q = $this->db->query($sql, array($username));
		if ($q -> num_rows() == 1) {
			return $q->row_array();
		} 
		return false;
	}

	function get_user_info_by_id($id) {
		$this->db->where('oid', $id);
		$query = $this->db->get('user');
		if ($query -> num_rows() == 1) {
			return $query->row_array();
		} 
		return false;
	}

	// --------------------------------------------------------------------
	/**
	 * Update user info by username and neccessary data
	 *
	 */
	function update_account($username, $data){
		
		$this->db->where('username', $username);
		$query = $this->db->update('user', $data);
	}

	// --------------------------------------------------------------------
	/**
	 * Generate random password (without special characters)
	 * Used when creating users using facebook information
	 */
	function generate_password($passLength) {
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    	$pass = array(); 
    	$alphabetLength = strlen($alphabet) - 1; 
    	for ($i = 0; $i < $passLength; $i++) {
    	    $n = rand(0, $alphabetLength);
    	    $pass[] = $alphabet[$n];
    	}
    	return implode($pass); //turn the array into a string
	}
}