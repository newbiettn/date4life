<?php

class Search_model extends CI_Model{
	public function search_for_non_registered($min_age, $max_age, $location, $gender) {
		$target_max_year = date("Y") - $min_age;
		$target_min_year = date("Y") - $max_age;
		$sql = "SELECT user.*, location.location_name AS city FROM user, location 
				WHERE YEAR(dob) > ? and YEAR(dob) < ?
				AND gender = ? 
				AND location = ?
				AND user.location = location.oid"
		;
		$q = $this->db->query($sql, array($target_min_year, $target_max_year, $gender, $location));

		return $q->result_array();
		
		
	}
	public function suggest_user($query){
		$this->db->select("username, oid")
			->from("user")
			->like("username", $query, 'after');
		$q = $this->db->get();
		return $q->result_array();
	}
	
	public function search_full($search_query){
		$current_username = $this->session->userdata('username');
		$sql = "SELECT user.username FROM user WHERE user.oid IN 
			(SELECT blocked_user_oid FROM blocklist WHERE user_oid = ?)";
		
		$blocked_list_query = $this->db->query($sql, array($this->session->userdata('oid')));
		
		$except_list = array($current_username);
		if ($blocked_list_query -> num_rows() > 0) {
			foreach($blocked_list_query->result_array() as $username) {
				array_push($except_list, $username["username"]);
			}
		}
		
		$this->db->distinct("user.*")
			->from("user")
			->join("location", "location.oid = user.location")
			->like("username", $search_query, 'both')
			->or_like("email", $search_query, 'both')
			->or_like("dob", $search_query, 'both')
			->or_like("description", $search_query, 'both')
			->or_like("location.location_name", $search_query, 'both')
			->or_like("looking_for", $search_query, 'both')
			->or_like("marital_status", $search_query, 'both')
			->or_like("amount_of_children", $search_query, 'both')
			->or_like("eye_color", $search_query, 'both')
			->or_like("hair_color", $search_query, 'both')
			->or_like("clothing_style", $search_query, 'both')
			->or_like("nationality", $search_query, 'both')
			->or_like("languages", $search_query, 'both')
			->or_like("occupation", $search_query, 'both')
			->or_like("favorite", $search_query, 'both');
		
		$q = $this->db->get();
		$result = false;
		if ($q -> num_rows() > 0) {
			$result = $q->result_array();
			$count = 0;
			foreach($result as $person) {
				foreach($except_list as $except_id) {
					
					if ($person["username"] == $except_id) {
						unset($result[$count]);
					}
				}
				$count = $count + 1;
			}
		}
		
		return $result;
	}
	
	public function search_random_friend($age, $gender, $number_of_res) {
		$target_year = date("Y") - $age;
		$sql = "SELECT * FROM user WHERE YEAR(dob) = ? AND gender = ? AND oid NOT IN ( ? )";
		$q = $this->db->query($sql, array($target_year, $gender,  $this->session->userdata ( 'oid' )));
		
		$array = $q->result_array();
			if (count($array) > 0) {
			
			$size = 0;
			if ($number_of_res > count($array)) {
				$size = count($array);
			} else {
				$size = $number_of_res;
			}
	
			$rand_keys = array_rand($array, $size);
			$result = array();
			
			if ($size == 1) {
				$result[0] = $array[$rand_keys];
			} else {
				for ($i = 0; $i < $size; $i++) {
					$result[$i] = $array[$rand_keys[$i]];
				}
			}
			return $result;
		} else {
			return null;
		}
		
	}
}