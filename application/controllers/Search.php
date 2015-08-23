<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends MY_Controller {
	public function index() {
		$this->load->view('search');
	}
	
	public function user_suggestion() {
		$this->load->model('search_model');
		$query = $this->input->get('query');
		$res = $this->search_model->suggest_user($query);
		
		$jsonArr = array();
		$jsonArr['query'] = 'Unit';
		$jsonArr['suggestions'] = array();
		if (isset($res)) {
			foreach($res as $i) {
				$temp = array(
					'value' => $i['username'],
					'data' => $i['oid']
				);
				array_push($jsonArr['suggestions'], $temp);
			}
		}
		echo(json_encode($jsonArr));
	}

	public function do_search(){
		$this->load->model('search_model');
		$query = $this->input->post('query');
		$res = $this->search_model->search_full($query);

		$view_data = array();
		$view_data["search_result"] = $res;
		$this->load->view('search', $view_data);
	}
	
	public function view_request_random_friend(){
		$this->load->view("request_random_friend");
	}
	
	public function request_random_friend() {
		$this->load->model('search_model');
		$age = $this->input->post('age');
		$gender = $this->input->post('gender');
		$number_of_res = $this->input->post('number_of_res');
		
		$res = $this->search_model->search_random_friend($age, $gender, $number_of_res);
		if ($res != null) {
			$view_data = array();
			$view_data["search_result"] = $res;
			$this->load->view('request_random_friend', $view_data);
		} else {
			$this->load->view('request_random_friend');
		}
	}
}
