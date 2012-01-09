<?php
class Subkriteria_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->CI = get_instance();
	}
	
	function add($data)
	{
		$this->db->insert('subkriteria',$data);
	}
	
	function delete($id)
	{
		$this->db->delete('subkriteria', array('subkriteria_id' => $id)); 
	}
	
	function get_data_flexigrid()
	{
		$this->db->select('*')->from('subkriteria');
			
		$this->CI->flexigrid->build_query();		
		$return['records'] = $this->db->get();
		
		$this->db->select('*')->from('subkriteria');
		
		$this->CI->flexigrid->build_query(FALSE);
		$return['record_count'] = $this->db->count_all_results();
		return $return;
	}
	
	function get_pegawai_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->where('ID',$id);
		return $this->db->get();
	}
	
	function update($subkriteria_id, $data)
	{
		$this->db->where('SUBKRITERIA_ID',$subkriteria_id)->update('subkriteria', $data);
	}
	
	function get_pegawai()
	{
		$this->db->select('*');
		$this->db->from('pegawai');
		return $this->db->get();
	}
	
	function get_subkriteria_by_id($subkriteria_id)
	{
		$this->db->select('*');
		$this->db->from('subkriteria');
		$this->db->where('SUBKRITERIA_ID',$subkriteria_id);
		return $this->db->get();
	}
	
	function get_absensi_kehadiran($date_start, $date_end)
	{
		return $this->db->query('SELECT * FROM absensi JOIN pegawai ON pegawai.ID = absensi.ID WHERE KODE_ABSENSI = 1 AND TANGGAL_ABSENSI BETWEEN "'.$date_start.'" AND "'.$date_end.'" ORDER BY TANGGAL_ABSENSI');
	}
	
	function get_absensi_ketidakhadiran($date_start, $date_end)
	{
		return $this->db->query('SELECT * FROM absensi JOIN pegawai ON pegawai.ID = absensi.ID WHERE KODE_ABSENSI > 1 AND TANGGAL_ABSENSI BETWEEN "'.$date_start.'" AND "'.$date_end.'" ORDER BY TANGGAL_ABSENSI');
	}
}
