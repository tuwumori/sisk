<?php
class Ahp_kriteria_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		//$this->CI = get_instance();
	}
	
	function get_jumlah_kriteria()
	{
		return $this->db->count_all('kriteria');
	}
	
	function get_kriteria()
	{
		return $this->db->get('kriteria')->result();
	}
}
