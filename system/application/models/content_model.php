<?php
class Content_model extends Model {
	function getContent($key, $lang) {
		$this->db->where('key', $key);
		$query = $this->db->get('lang');
		if ($query->num_rows() < 1) {
			return 'There is no content for this key.';
		}
		$result = $query->row();
		return $result->$lang;
	}
	
	function setContent($key, $lang, $value) {
		if ($lang != 'en' && $lang != 'cn') {
			return 'Illegal language used.';
		}
		
		$data = array($lang => $value);
		$this->db->where('key', $key);
		return $this->db->update('lang', $data);
	}
	
	function getAllContent() {
		$query = $this->db->get('lang');
		$result = $query->result();
		return $result;
	}
}