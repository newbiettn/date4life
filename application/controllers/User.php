<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function view_profile() {
		$this->load->view('personal_profile');
	}
}
