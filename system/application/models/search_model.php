<?php
class Search_model extends Model {

	function Search_model()
	{
		// Call the Model constructor
		parent::Model();
	}
	
	function search($post) {
		// $this->db->where('approved =', 1);
		
		if (!empty($post['age_from'])) {
			$age_from = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d"), date("Y") - $post['age_from']));
			$this->db->where('birthday <=', $age_from);
		}
		if (!empty($post['age_to'])) {
			$age_to = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d"), date("Y") - $post['age_to']));
			$this->db->where('birthday >=', $age_to);
		}
 		
		if (!empty($post['height_from'])) {
			$this->db->where('height >=', $post['height_from']); 
		}
		if (!empty($post['height_to'])) {
			$this->db->where('height <=', $post['height_to']);
		}
		
		if (!empty($post['weight_from'])) {
			$this->db->where('weight >=', $post['weight_from']);
		}
		if (!empty($post['weight_to'])) {
			$this->db->where('weight <=', $post['weight_to']);
		}
		
		if (!empty($post['bra_size'])) {
			$this->db->where('bra_size =', $post['bra_size']);
		}
		if (!empty($post['waist'])) {
			$this->db->where('waist =', $post['waist']);
		}
		if (!empty($post['hips'])) {
			$this->db->where('hips =', $post['hips']);
		}
		
		if (!empty($post['shoe_size_from'])) {
			$this->db->where('shoe_size >=', $post['shoe_size_from']);
		}
		if (!empty($post['shoe_size_to'])) {
			$this->db->where('shoe_size <=', $post['shoe_size_to']);
		}
		
		if (!empty($post['city'])) {
			$this->db->where('city =', $post['city']);
		}
		
		if (!empty($post['gender'])) {
			$values = array();
			foreach ($post['gender'] as $x) {
				array_push($values, $x);
			}
			$this->db->where_in('gender', $values);
		}
		
		if (!empty($post['ethnicity'])) {
			$values = array();
			foreach ($post['ethnicity'] as $x) {
				array_push($values, $x);
			}
			$this->db->where_in('ethnicity', $values);
		}
		
		if (!empty($post['hair_color'])) {
			$values = array();
			foreach ($post['hair_color'] as $x) {
				array_push($values, $x);
			}
			$this->db->where_in('hair_color', $values);
		}
		
		if (!empty($post['hair_length'])) {
			$values = array();
			foreach ($post['hair_length'] as $x) {
				array_push($values, $x);
			}
			$this->db->where_in('hair_length', $values);
		}
		
		$query = $this->db->get('profiles');
		return $query->result();
	}
}