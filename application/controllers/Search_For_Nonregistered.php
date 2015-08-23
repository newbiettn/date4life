<?php
class Search_For_Nonregistered extends CI_Controller {
	public function index(){
		$this->load->view('search_for_nonregistered');
	}
	public function search_for_non_registered(){
		$this->load->model('search_model');
		$gender = $this->input->post('gender');
		$min_age = $this->input->post('min_age');
		$max_age = $this->input->post('max_age');
		$location = $this->input->post('location');

		$res = $this->search_model->search_for_non_registered($min_age, $max_age, $location);
		$view_data = array();
		$view_data["search_result"] = $res;
		$this->load->view('search_for_nonregistered', $view_data);
	}
}