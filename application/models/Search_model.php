<?php

class Search_model extends CI_Model{
	public function search_for_non_registered($min_age, $max_age, $location) {
		$target_max_year = date("Y") - $min_age;
		$target_min_year = date("Y") - $max_age;
		$sql = "SELECT user.*, location.name AS city FROM user, location 
				WHERE YEAR(dob) > ? and YEAR(dob) < ? 
				AND location = ?
				AND user.location = location.oid";
		$q = $this->db->query($sql, array($target_min_year, $target_max_year, $location));
		
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
		$this->db->distinct("*")
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
		return $q->result_array();
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