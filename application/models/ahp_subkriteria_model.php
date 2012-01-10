<?php
class Ahp_subkriteria_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		//$this->CI = get_instance();
	}
	
	function get_jumlah_subkriteria()
	{
		return $this->db->count_all('subkriteria');
	}
	
	function get_subkriteria()
	{
		return $this->db->get('subkriteria')->result();
	}
}
