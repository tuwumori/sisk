<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengelolaan_capeg extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('flexigrid');	
		$this->load->helper('flexigrid');
		$this->load->model('capeg_model');
		$this->load->model('pertanyaan_model');
		//$this->cek_session();
	}
	
	function cek_session()
	{	
		$kode_role = $this->session->userdata('kode_role');
		if($kode_role == '' || $kode_role != 1)
		{
			redirect('login/login_ulang');
		}
	}
	
	public function index()
	{
		$this->grid();
	}
	
	public function grid()
	{
		//$kode_role = $this->session->userdata('kode_role');
		$colModel['no'] = array('No',20,TRUE,'center',0);
		$colModel['NAMA_CAPEG'] = array('Nama Calon Pegawai',200,TRUE,'center',1);
		$colModel['STATUS_PEGAWAI'] = array('Status Pegawai',190,TRUE,'center',1);
		$colModel['perhitungan nilai'] = array('Perhitungan Nilai',80,FALSE,'center',0);
		$colModel['ubah'] = array('Ubah',30,FALSE,'center',0);
		$colModel['hapus'] = array('Hapus',30,FALSE,'center',0);
			
		//setting konfigurasi pada bottom tool bar flexigrid
		$gridParams = array(
							'width' => 'auto',
							'height' => 330,
							'rp' => 15,
							'rpOptions' => '[15,30,50,100]',
							'pagestat' => 'Menampilkan : {from} ke {to} dari {total} data.',
							'blockOpacity' => 0,
							'title' => 'Pengelolaan Calon Pegawai',
							'showTableToggleBtn' => false
							);
							
		//menambah tombol pada flexigrid top toolbar
		$buttons[] = array('Tambah','add','spt_js');
		$buttons[] = array('separator');
		
				
		// mengambil data dari file controler ajax pada method grid_user		
		$url = site_url()."/pengelolaan_capeg/grid_data_bagian";
		$grid_js = build_grid_js('user',$url,$colModel,'ID','asc',$gridParams,$buttons);
		$data['js_grid'] = $grid_js;
		$data['added_js'] = 
		"<script type='text/javascript'>
		function spt_js(com,grid){	
			if (com=='Tambah'){
				location.href= '".base_url()."index.php/pengelolaan_capeg/add';    
			}	
		} </script>";
			
		//$data['added_js'] variabel untuk membungkus javascript yang dipakai pada tombol yang ada di toolbar atas
		$data['content'] = $this->load->view('grid',$data,true);
		$this->load->view('main',$data);
	}
	
	function grid_data_bagian() 
	{
		$valid_fields = array('CAPEG_ID','NAMA_CAPEG');
		$this->flexigrid->validate_post('CAPEG_ID','asc',$valid_fields);
		$records = $this->capeg_model->get_data_flexigrid();
		$this->output->set_header($this->config->item('json_header'));
			
		$no = 0;
		foreach ($records['records']->result() as $row){	
				$no = $no+1;
				$record_items[] = array(
										$row->CAPEG_ID,
										$no,
										$row->NAMA_CAPEG,
										$row->STATUS_PEGAWAI,
										'<a href='.base_url().'index.php/pengelolaan_capeg/perhitungan/'.$row->CAPEG_ID.'><img border=\'0\' src=\''.base_url().'images/icon/cal.gif\'></a>',
										'<a href='.base_url().'index.php/pengelolaan_capeg/edit/'.$row->CAPEG_ID.'><img border=\'0\' src=\''.base_url().'images/flexigrid/magnifier.png\'></a>',
										'<a href='.base_url().'index.php/pengelolaan_capeg/delete/'.$row->CAPEG_ID.' onclick="return confirm(\'Are you sure you want to delete?\')"><img border=\'0\' src=\''.base_url().'images/flexigrid/2.png\'></a>'
								);
		}
		
		if(isset($record_items))
			$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
		else
			$this->output->set_output('{"page":"1","total":"0","rows":[]}');
	}
	
	function cek_validasi()
	{	
		$this->form_validation->set_rules('nama_capeg', 'Nama Capeg', 'required');
		
		$this->form_validation->set_error_delimiters('<div class="error_box">', '</div>');
		$this->form_validation->set_message('required', 'Kolom %s harus diisi !!');
		return $this->form_validation->run();
	}
	
	function cek_validasi_pertanyaan($id)
	{	
		$this->form_validation->set_rules($id, 'Nilai Pertanyaan', 'required');
		
		$this->form_validation->set_error_delimiters('<div class="error_box">', '</div>');
		$this->form_validation->set_message('required', 'Kolom %s harus diisi !!');
		return $this->form_validation->run();
	}
	
	public function add()
	{
		$data['content'] = $this->load->view('form_add_calon_pegawai',null,true);
		$this->load->view('main',$data);
	}
	
	public function add_process()
	{
		$data = array(
						'nama_capeg' => $this->input->post('nama_capeg')
					);
		if($this->cek_validasi())
		{
			$capeg = $this->capeg_model->add($data);
			$capeg_id = $capeg->CAPEG_ID;
			$pertanyaan = $this->pertanyaan_model->get_pertanyaan();
			foreach($pertanyaan->result() as $row){
					$data_pertanyaan = array(
						'PERTANYAAN_ID' => $row->PERTANYAAN_ID,
						'CAPEG_ID' => $capeg_id
					);
					
					$this->capeg_model->add_pertanyaan_perpeg($data_pertanyaan);
					
				}
			redirect('pengelolaan_capeg');
		}
		else
		{
			$this->add();
			//redirect('jabatan/add');
		}
	}
	
	public function edit($capeg_id)
	{
		$data = array(
					'nama_capeg' => $this->input->post('nama_capeg')
				);
		if($this->cek_validasi())
		{
			$this->capeg_model->update($capeg_id, $data);
			redirect('pengelolaan_capeg');
		}
		else
		{
			$data['nama_capeg'] = $this->capeg_model->get_capeg_by_id($capeg_id)->row()->NAMA_CAPEG;
			$data['content'] = $this->load->view('form_edit_calon_pegawai',$data,true);
			$this->load->view('main',$data);
		}
	}
	
	public function delete($capeg_id)
	{
		$this->capeg_model->delete($capeg_id);
		redirect('pengelolaan_capeg');
	}
	
	public function perhitungan($capeg_id){
		$statushit = $this->input->post('hitung');
		if($statushit == 'yes')
		{
			$pertanyaan_perpeg = $this->capeg_model->get_pertanyaan_perpeg($capeg_id);
			$lakukan_hitung = 'yes';
			foreach($pertanyaan_perpeg->result() as $row){
				if($this->cek_validasi_pertanyaan($row->NILAI_PEG_PERTANYAAN_ID) && $lakukan_hitung == 'yes'){
					$lakukan_hitung = 'yes';
				} else{
					$lakukan_hitung = 'no';
				}
			}
			
			foreach($pertanyaan_perpeg->result() as $row){
				if($lakukan_hitung == 'yes'){
					
					$data_update = array(
						'nilai' => $this->input->post($row->NILAI_PEG_PERTANYAAN_ID)
					);
					
					$this->capeg_model->update_perpertanyaan($row->NILAI_PEG_PERTANYAAN_ID, $data_update);
					
					$akademik_produksi = $this->capeg_model->get_sum_nilai_pertanyaan($capeg_id, 'Bagian Produksi', 'tes akademik')->row()->NILAI/$this->capeg_model->get_jumlah_pertanyaan($capeg_id, 'Bagian Produksi', 'tes akademik');
					$psikologi_produksi = $this->capeg_model->get_sum_nilai_pertanyaan($capeg_id, 'Bagian Produksi', 'tes psikologi')->row()->NILAI/$this->capeg_model->get_jumlah_pertanyaan($capeg_id, 'Bagian Produksi', 'tes psikologi');
					$kepribadian_produksi = $this->capeg_model->get_sum_nilai_pertanyaan($capeg_id, 'Bagian Produksi', 'tes kepribadian')->row()->NILAI/$this->capeg_model->get_jumlah_pertanyaan($capeg_id, 'Bagian Produksi', 'tes kepribadian');
					$wawancara_produksi = $this->capeg_model->get_sum_nilai_pertanyaan($capeg_id, 'Bagian Produksi', 'tes wawancara')->row()->NILAI/$this->capeg_model->get_jumlah_pertanyaan($capeg_id, 'Bagian Produksi', 'tes wawancara');
					$pengetahuan_produksi = $this->capeg_model->get_sum_nilai_pertanyaan($capeg_id, 'Bagian Produksi', 'tes pengetahuan')->row()->NILAI/$this->capeg_model->get_jumlah_pertanyaan($capeg_id, 'Bagian Produksi', 'tes pengetahuan');
				
					$akademik_marketing = $this->capeg_model->get_sum_nilai_pertanyaan($capeg_id, 'Bagian Marketing', 'tes akademik')->row()->NILAI/$this->capeg_model->get_jumlah_pertanyaan($capeg_id, 'Bagian Marketing', 'tes akademik');
					$psikologi_marketing = $this->capeg_model->get_sum_nilai_pertanyaan($capeg_id, 'Bagian Marketing', 'tes psikologi')->row()->NILAI/$this->capeg_model->get_jumlah_pertanyaan($capeg_id, 'Bagian Marketing', 'tes akademik');
					$kepribadian_marketing = $this->capeg_model->get_sum_nilai_pertanyaan($capeg_id, 'Bagian Marketing', 'tes kepribadian')->row()->NILAI/$this->capeg_model->get_jumlah_pertanyaan($capeg_id, 'Bagian Marketing', 'tes akademik');
					$wawancara_marketing = $this->capeg_model->get_sum_nilai_pertanyaan($capeg_id, 'Bagian Marketing', 'tes wawancara')->row()->NILAI/$this->capeg_model->get_jumlah_pertanyaan($capeg_id, 'Bagian Marketing', 'tes akademik');
					$pengetahuan_marketing = $this->capeg_model->get_sum_nilai_pertanyaan($capeg_id, 'Bagian Marketing', 'tes pengetahuan')->row()->NILAI/$this->capeg_model->get_jumlah_pertanyaan($capeg_id, 'Bagian Marketing', 'tes akademik');
					
					$akademik_customer = $this->capeg_model->get_sum_nilai_pertanyaan($capeg_id, 'Bagian Customer', 'tes akademik')->row()->NILAI/$this->capeg_model->get_jumlah_pertanyaan($capeg_id, 'Bagian Customer', 'tes akademik');
					$psikologi_customer = $this->capeg_model->get_sum_nilai_pertanyaan($capeg_id, 'Bagian Customer', 'tes psikologi')->row()->NILAI/$this->capeg_model->get_jumlah_pertanyaan($capeg_id, 'Bagian Customer', 'tes akademik');
					$kepribadian_customer = $this->capeg_model->get_sum_nilai_pertanyaan($capeg_id, 'Bagian Customer', 'tes kepribadian')->row()->NILAI/$this->capeg_model->get_jumlah_pertanyaan($capeg_id, 'Bagian Customer', 'tes akademik');
					$wawancara_customer = $this->capeg_model->get_sum_nilai_pertanyaan($capeg_id, 'Bagian Customer', 'tes wawancara')->row()->NILAI/$this->capeg_model->get_jumlah_pertanyaan($capeg_id, 'Bagian Customer', 'tes akademik');
					$pengetahuan_customer = $this->capeg_model->get_sum_nilai_pertanyaan($capeg_id, 'Bagian Customer', 'tes pengetahuan')->row()->NILAI/$this->capeg_model->get_jumlah_pertanyaan($capeg_id, 'Bagian Customer', 'tes akademik');
					
					//akademik Produksi
					if($akademik_produksi < 40){
						$akademik_produksi = 'sangat kurang';
						$nilai_akademik_produksi = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'sangat kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes akademik')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'sangat kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'sangat kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
										
					} else if($akademik_produksi > 89){
						$akademik_produksi = 'sangat bagus';
						$nilai_akademik_produksi = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'sangat bagus')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes akademik')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'sangat bagus')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'sangat bagus')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($akademik_produksi > 39 && $akademik_produksi < 60){
						$akademik_produksi = 'kurang';
						$nilai_akademik_produksi = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes akademik')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($akademik_produksi > 59 && $akademik_produksi < 80){
						$akademik_produksi = 'cukup';
						$nilai_akademik_produksi = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'cukup')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes akademik')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'cukup')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'cukup')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($akademik_produksi > 79 && $akademik_produksi < 90){
						$akademik_produksi = 'baik';
						$nilai_akademik_produksi = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'baik')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes akademik')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'baik')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'baik')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					}
					
					//psikologi produksi
					if($psikologi_produksi < 40){
						$psikologi_produksi = 'sangat kurang';
						$nilai_psikologi_produksi = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'sangat kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes psikologi')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'sangat kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'sangat kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
										
					} else if($psikologi_produksi > 89){
						$psikologi_produksi = 'sangat bagus';
						$nilai_psikologi_produksi = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'sangat bagus')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes psikologi')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'sangat bagus')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'sangat bagus')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($psikologi_produksi > 39 && $psikologi_produksi < 60){
						$psikologi_produksi = 'kurang';
						$nilai_psikologi_produksi = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes psikologi')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($psikologi_produksi > 59 && $psikologi_produksi < 80){
						$psikologi_produksi = 'cukup';
						$nilai_psikologi_produksi = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'cukup')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes psikologi')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'cukup')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'cukup')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($psikologi_produksi > 79 && $psikologi_produksi < 90){
						$psikologi_produksi = 'baik';
						$nilai_psikologi_produksi = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'baik')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes psikologi')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'baik')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'baik')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					}
					
					//tes kepribadian Produksi
					if($kepribadian_produksi < 40){
						$kepribadian_produksi = 'sangat kurang';
						$nilai_kepribadian_produksi = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'sangat kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes kepribadian')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'sangat kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'sangat kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
										
					} else if($kepribadian_produksi > 89){
						$kepribadian_produksi = 'sangat bagus';
						$nilai_kepribadian_produksi = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'sangat bagus')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes kepribadian')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'sangat bagus')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'sangat bagus')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($kepribadian_produksi > 39 && $psikologi_produksi < 60){
						$kepribadian_produksi = 'kurang';
						$nilai_kepribadian_produksi = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes kepribadian')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($kepribadian_produksi > 59 && $psikologi_produksi < 80){
						$kepribadian_produksi = 'cukup';
						$nilai_kepribadian_produksi = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'cukup')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes kepribadian')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'cukup')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'cukup')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($kepribadian_produksi > 79 && $psikologi_produksi < 90){
						$kepribadian_produksi = 'baik';
						$nilai_kepribadian_produksi = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'baik')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes kepribadian')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'baik')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'baik')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					}
					
					//wawancara Produksi
					if($wawancara_produksi < 40){
						$wawancara_produksi = 'sangat kurang';
						$nilai_wawancara_produksi = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'sangat kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes wawancara')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'sangat kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'sangat kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
										
					} else if($wawancara_produksi > 89){
						$wawancara_produksi = 'sangat bagus';
						$nilai_wawancara_produksi = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'sangat bagus')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes wawancara')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'sangat bagus')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'sangat bagus')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($wawancara_produksi > 39 && $psikologi_produksi < 60){
						$wawancara_produksi = 'kurang';
						$nilai_wawancara_produksi = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes wawancara')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($wawancara_produksi > 59 && $psikologi_produksi < 80){
						$wawancara_produksi = 'cukup';
						$nilai_wawancara_produksi = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'cukup')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes wawancara')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'cukup')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'cukup')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($wawancara_produksi > 79 && $psikologi_produksi < 90){
						$wawancara_produksi = 'baik';
						$nilai_wawancara_produksi = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'baik')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes wawancara')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'baik')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'baik')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					}
					
					//tes pengetahuan Produksi
					if($pengetahuan_produksi < 40){
						$pengetahuan_produksi = 'sangat kurang';
						$nilai_pengetahuan_produksi = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'sangat kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes pengetahuan')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'sangat kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'sangat kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
										
					} else if($pengetahuan_produksi > 89){
						$pengetahuan_produksi = 'sangat bagus';
						$nilai_pengetahuan_produksi = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'sangat bagus')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes pengetahuan')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'sangat bagus')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'sangat bagus')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($pengetahuan_produksi > 39 && $psikologi_produksi < 60){
						$pengetahuan_produksi = 'kurang';
						$nilai_pengetahuan_produksi = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes pengetahuan')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($pengetahuan_produksi > 59 && $psikologi_produksi < 80){
						$pengetahuan_produksi = 'cukup';
						$nilai_pengetahuan_produksi = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'cukup')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes pengetahuan')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'cukup')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'cukup')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($pengetahuan_produksi > 79 && $psikologi_produksi < 90){
						$pengetahuan_produksi = 'baik';
						$nilai_pengetahuan_produksi = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'baik')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes pengetahuan')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'baik')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'baik')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_produksi
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					}
					
					
					//akademik Marketing
					if($akademik_marketing < 40){
						$akademik_marketing = 'sangat kurang';
						$nilai_akademik_marketing = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'sangat kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes akademik')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'sangat kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'sangat kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
										
					} else if($akademik_marketing > 89){
						$akademik_marketing = 'sangat bagus';
						$nilai_akademik_marketing = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'sangat bagus')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes akademik')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'sangat bagus')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'sangat bagus')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($akademik_marketing > 39 && $akademik_marketing < 60){
						$akademik_marketing = 'kurang';
						$nilai_akademik_marketing = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes akademik')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($akademik_marketing > 59 && $akademik_marketing < 80){
						$akademik_marketing = 'cukup';
						$nilai_akademik_marketing = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'cukup')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes akademik')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'cukup')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'cukup')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($akademik_marketing > 79 && $akademik_marketing < 90){
						$akademik_marketing = 'baik';
						$nilai_akademik_marketing = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'baik')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes akademik')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'baik')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'baik')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					}
					
					//psikologi marketing
					if($psikologi_marketing < 40){
						$psikologi_marketing = 'sangat kurang';
						$nilai_psikologi_marketing = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'sangat kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes psikologi')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'sangat kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'sangat kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
										
					} else if($psikologi_marketing > 89){
						$psikologi_marketing = 'sangat bagus';
						$nilai_psikologi_marketing = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'sangat bagus')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes psikologi')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'sangat bagus')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'sangat bagus')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($psikologi_marketing > 39 && $psikologi_marketing < 60){
						$psikologi_marketing = 'kurang';
						$nilai_psikologi_marketing = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes psikologi')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($psikologi_marketing > 59 && $psikologi_marketing < 80){
						$psikologi_marketing = 'cukup';
						$nilai_psikologi_marketing = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'cukup')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes psikologi')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'cukup')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'cukup')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($psikologi_marketing > 79 && $psikologi_marketing < 90){
						$psikologi_marketing = 'baik';
						$nilai_psikologi_marketing = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'baik')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes psikologi')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'baik')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'baik')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					}
					
					//tes kepribadian Marketing
					if($kepribadian_marketing < 40){
						$kepribadian_marketing = 'sangat kurang';
						$nilai_kepribadian_marketing = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'sangat kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes kepribadian')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'sangat kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'sangat kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
										
					} else if($kepribadian_marketing > 89){
						$kepribadian_marketing = 'sangat bagus';
						$nilai_kepribadian_marketing = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'sangat bagus')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes kepribadian')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'sangat bagus')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'sangat bagus')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($kepribadian_marketing > 39 && $psikologi_marketing < 60){
						$kepribadian_marketing = 'kurang';
						$nilai_kepribadian_marketing = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes kepribadian')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($kepribadian_marketing > 59 && $psikologi_marketing < 80){
						$kepribadian_marketing = 'cukup';
						$nilai_kepribadian_marketing = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'cukup')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes kepribadian')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'cukup')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'cukup')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($kepribadian_marketing > 79 && $psikologi_marketing < 90){
						$kepribadian_marketing = 'baik';
						$nilai_kepribadian_marketing = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'baik')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes kepribadian')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'baik')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'baik')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					}
					
					//wawancara Marketing
					if($wawancara_marketing < 40){
						$wawancara_marketing = 'sangat kurang';
						$nilai_wawancara_marketing = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'sangat kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes wawancara')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'sangat kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'sangat kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
										
					} else if($wawancara_marketing > 89){
						$wawancara_marketing = 'sangat bagus';
						$nilai_wawancara_marketing = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'sangat bagus')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes wawancara')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'sangat bagus')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'sangat bagus')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($wawancara_marketing > 39 && $psikologi_marketing < 60){
						$wawancara_marketing = 'kurang';
						$nilai_wawancara_marketing = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes wawancara')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($wawancara_marketing > 59 && $psikologi_marketing < 80){
						$wawancara_marketing = 'cukup';
						$nilai_wawancara_marketing = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'cukup')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes wawancara')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'cukup')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'cukup')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($wawancara_marketing > 79 && $psikologi_marketing < 90){
						$wawancara_marketing = 'baik';
						$nilai_wawancara_marketing = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'baik')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes wawancara')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'baik')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'baik')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					}
					
					//tes pengetahuan Marketing
					if($pengetahuan_marketing < 40){
						$pengetahuan_marketing = 'sangat kurang';
						$nilai_pengetahuan_marketing = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'sangat kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes pengetahuan')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'sangat kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'sangat kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
										
					} else if($pengetahuan_marketing > 89){
						$pengetahuan_marketing = 'sangat bagus';
						$nilai_pengetahuan_marketing = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'sangat bagus')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes pengetahuan')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'sangat bagus')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'sangat bagus')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($pengetahuan_marketing > 39 && $psikologi_marketing < 60){
						$pengetahuan_marketing = 'kurang';
						$nilai_pengetahuan_marketing = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes pengetahuan')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($pengetahuan_marketing > 59 && $psikologi_marketing < 80){
						$pengetahuan_marketing = 'cukup';
						$nilai_pengetahuan_marketing = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'cukup')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes pengetahuan')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'cukup')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'cukup')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($pengetahuan_marketing > 79 && $psikologi_marketing < 90){
						$pengetahuan_marketing = 'baik';
						$nilai_pengetahuan_marketing = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'baik')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes pengetahuan')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'baik')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'baik')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_marketing
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					}
					
					
					//akademik Customer
					if($akademik_customer < 40){
						$akademik_customer = 'sangat kurang';
						$nilai_akademik_customer = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'sangat kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes akademik')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'sangat kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'sangat kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
										
					} else if($akademik_customer > 89){
						$akademik_customer = 'sangat bagus';
						$nilai_akademik_customer = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'sangat bagus')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes akademik')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'sangat bagus')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'sangat bagus')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($akademik_customer > 39 && $akademik_customer < 60){
						$akademik_customer = 'kurang';
						$nilai_akademik_customer = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes akademik')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($akademik_customer > 59 && $akademik_customer < 80){
						$akademik_customer = 'cukup';
						$nilai_akademik_customer = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'cukup')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes akademik')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'cukup')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'cukup')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($akademik_customer > 79 && $akademik_customer < 90){
						$akademik_customer = 'baik';
						$nilai_akademik_customer = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'baik')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes akademik')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'baik')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes akademik', 'baik')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					}
					
					//psikologi customer
					if($psikologi_customer < 40){
						$psikologi_customer = 'sangat kurang';
						$nilai_psikologi_customer = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'sangat kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes psikologi')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'sangat kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'sangat kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
										
					} else if($psikologi_customer > 89){
						$psikologi_customer = 'sangat bagus';
						$nilai_psikologi_customer = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'sangat bagus')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes psikologi')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'sangat bagus')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'sangat bagus')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($psikologi_customer > 39 && $psikologi_customer < 60){
						$psikologi_customer = 'kurang';
						$nilai_psikologi_customer = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes psikologi')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($psikologi_customer > 59 && $psikologi_customer < 80){
						$psikologi_customer = 'cukup';
						$nilai_psikologi_customer = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'cukup')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes psikologi')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'cukup')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'cukup')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($psikologi_customer > 79 && $psikologi_customer < 90){
						$psikologi_customer = 'baik';
						$nilai_psikologi_customer = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'baik')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes psikologi')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'baik')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes psikologi', 'baik')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					}
					
					//tes kepribadian Customer
					if($kepribadian_customer < 40){
						$kepribadian_customer = 'sangat kurang';
						$nilai_kepribadian_customer = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'sangat kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes kepribadian')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'sangat kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'sangat kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
										
					} else if($kepribadian_customer > 89){
						$kepribadian_customer = 'sangat bagus';
						$nilai_kepribadian_customer = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'sangat bagus')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes kepribadian')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'sangat bagus')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'sangat bagus')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($kepribadian_customer > 39 && $psikologi_customer < 60){
						$kepribadian_customer = 'kurang';
						$nilai_kepribadian_customer = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes kepribadian')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($kepribadian_customer > 59 && $psikologi_customer < 80){
						$kepribadian_customer = 'cukup';
						$nilai_kepribadian_customer = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'cukup')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes kepribadian')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'cukup')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'cukup')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($kepribadian_customer > 79 && $psikologi_customer < 90){
						$kepribadian_customer = 'baik';
						$nilai_kepribadian_customer = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'baik')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes kepribadian')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'baik')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes kepribadian', 'baik')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					}
					
					//wawancara Customer
					if($wawancara_customer < 40){
						$wawancara_customer = 'sangat kurang';
						$nilai_wawancara_customer = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'sangat kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes wawancara')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'sangat kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'sangat kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
										
					} else if($wawancara_customer > 89){
						$wawancara_customer = 'sangat bagus';
						$nilai_wawancara_customer = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'sangat bagus')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes wawancara')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'sangat bagus')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'sangat bagus')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($wawancara_customer > 39 && $psikologi_customer < 60){
						$wawancara_customer = 'kurang';
						$nilai_wawancara_customer = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes wawancara')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($wawancara_customer > 59 && $psikologi_customer < 80){
						$wawancara_customer = 'cukup';
						$nilai_wawancara_customer = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'cukup')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes wawancara')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'cukup')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'cukup')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($wawancara_customer > 79 && $psikologi_customer < 90){
						$wawancara_customer = 'baik';
						$nilai_wawancara_customer = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'baik')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes wawancara')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'baik')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes wawancara', 'baik')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					}
					
					//tes pengetahuan Customer
					if($pengetahuan_customer < 40){
						$pengetahuan_customer = 'sangat kurang';
						$nilai_pengetahuan_customer = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'sangat kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes pengetahuan')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'sangat kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'sangat kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
										
					} else if($pengetahuan_customer > 89){
						$pengetahuan_customer = 'sangat bagus';
						$nilai_pengetahuan_customer = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'sangat bagus')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes pengetahuan')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'sangat bagus')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'sangat bagus')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($pengetahuan_customer > 39 && $psikologi_customer < 60){
						$pengetahuan_customer = 'kurang';
						$nilai_pengetahuan_customer = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'kurang')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes pengetahuan')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'kurang')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'kurang')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($pengetahuan_customer > 59 && $psikologi_customer < 80){
						$pengetahuan_customer = 'cukup';
						$nilai_pengetahuan_customer = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'cukup')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes pengetahuan')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'cukup')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'cukup')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					} else if($pengetahuan_customer > 79 && $psikologi_customer < 90){
						$pengetahuan_customer = 'baik';
						$nilai_pengetahuan_customer = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'baik')->row()->PRIORITAS_SUBKRITERIA/$this->capeg_model->get_prioritas_kriteria('tes pengetahuan')->row()->PRIORITAS_KRITERIA;
						$id_sub = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'baik')->row()->SUBKRITERIA_ID;
						$id_kriteria = $this->capeg_model->get_prioritas_subkriteria('tes pengetahuan', 'baik')->row()->KRITERIA_ID;
						$id_bagian = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->BAGIAN_ID;
						
						$data_insert = array(
											'KRITERIA_ID' => $id_kriteria,
											'SUBKRITERIA_ID' => $id_sub,
											'BAGIAN_ID' => $id_bagian,
											'CAPEG_ID' => $capeg_id,
											'TOTAL_NILAI' => $nilai_akademik_customer
										);
										
						$this->capeg_model->add_penilain($data_insert);
						
					}
					
					$nilai_bagian_produksi = $this->capeg_model->get_sum_perbagian($capeg_id, 'Bagian Produksi');
					$nilai_bagian_marketing = $this->capeg_model->get_sum_perbagian($capeg_id, 'Bagian Marketing');
					$nilai_bagian_customer = $this->capeg_model->get_sum_perbagian($capeg_id, 'Bagian Customer');
					
					$min_bagian_produksi = $this->capeg_model->get_bagian_id('Bagian Produksi')->row()->NILAI_MINIMUM;
					$min_bagian_marketing = $this->capeg_model->get_bagian_id('Bagian Marketing')->row()->NILAI_MINIMUM;
					$min_bagian_customer = $this->capeg_model->get_bagian_id('Bagian Customer')->row()->NILAI_MINIMUM;
					
					if($nilai_bagian_produksi < $min_bagian_produksi || $nilai_bagian_marketing < $min_bagian_marketing || $nilai_bagian_customer < $min_bagian_customer){
						$status_peg = 'Gagal';
					} else if($nilai_bagian_produksi > $nilai_bagian_marketing && $nilai_bagian_produksi > $nilai_bagian_customer){
						if($nilai_bagian_produksi < $min_bagian_produksi){
							$status_peg = 'Gagal';
						} else {
							$status_peg = 'Diterima di Bagian Produksi';
							}
					} else if($nilai_bagian_marketing > $nilai_bagian_produksi && $nilai_bagian_marketing > $nilai_bagian_customer){
						if($nilai_bagian_marketing < $min_bagian_marketing){
							$status_peg = 'Gagal';
						} else {
							$status_peg = 'Diterima di Bagian Marketing';
							}
					} else if($nilai_bagian_customer > $nilai_bagian_produksi && $nilai_bagian_customer > $nilai_bagian_marketing){
						if($nilai_bagian_customer < $min_bagian_customer){
							$status_peg = 'Gagal';
						} else {
							$status_peg = 'Diterima di Bagian Marketing';
							}
					}
					
					$data_status = array(
										'STATUS_PEGAWAI' => $status_peg
									);
					
					$this->capeg_model->update($capeg_id, $data_status);
					
					$data['akademik_produksi'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Produksi', 'tes akademik');
					$data['psikologi_produksi'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Produksi', 'tes psikologi');
					$data['kepribadian_produksi'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Produksi', 'tes kepribadian');
					$data['wawancara_produksi'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Produksi', 'tes wawancara');
					$data['pengetahuan_produksi'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Produksi', 'tes pengetahuan');
					
					$data['akademik_marketing'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Marketing', 'tes akademik');
					$data['psikologi_marketing'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Marketing', 'tes psikologi');
					$data['kepribadian_marketing'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Marketing', 'tes kepribadian');
					$data['wawancara_marketing'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Marketing', 'tes wawancara');
					$data['pengetahuan_marketing'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Marketing', 'tes pengetahuan');
					
					$data['akademik_customer'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Customer', 'tes akademik');
					$data['psikologi_customer'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Customer', 'tes psikologi');
					$data['kepribadian_customer'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Customer', 'tes kepribadian');
					$data['wawancara_customer'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Customer', 'tes wawancara');
					$data['pengetahuan_customer'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Customer', 'tes pengetahuan');
					
					$data['nama'] = $this->capeg_model->get_capeg_by_id($capeg_id)->row()->NAMA_CAPEG;
					
					$data['status'] = $this->capeg_model->get_capeg_by_id($capeg_id)->row()->STATUS_PEGAWAI;
					
					$data['hitung'] = 'yes';
					
					$data['content'] = $this->load->view('form_perhitungan_capeg',$data,true);
					$this->load->view('main',$data);
					
					
				}else{
					$data['akademik_produksi'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Produksi', 'tes akademik');
					$data['psikologi_produksi'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Produksi', 'tes psikologi');
					$data['kepribadian_produksi'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Produksi', 'tes kepribadian');
					$data['wawancara_produksi'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Produksi', 'tes wawancara');
					$data['pengetahuan_produksi'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Produksi', 'tes pengetahuan');
					
					$data['akademik_marketing'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Marketing', 'tes akademik');
					$data['psikologi_marketing'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Marketing', 'tes psikologi');
					$data['kepribadian_marketing'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Marketing', 'tes kepribadian');
					$data['wawancara_marketing'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Marketing', 'tes wawancara');
					$data['pengetahuan_marketing'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Marketing', 'tes pengetahuan');
					
					$data['akademik_customer'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Customer', 'tes akademik');
					$data['psikologi_customer'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Customer', 'tes psikologi');
					$data['kepribadian_customer'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Customer', 'tes kepribadian');
					$data['wawancara_customer'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Customer', 'tes wawancara');
					$data['pengetahuan_customer'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Customer', 'tes pengetahuan');
					
					$data['nama'] = $this->capeg_model->get_capeg_by_id($capeg_id)->row()->NAMA_CAPEG;
					
					$data['status'] = $this->capeg_model->get_capeg_by_id($capeg_id)->row()->STATUS_PEGAWAI;
					
					$data['hitung'] = 'yes';
					
					$data['content'] = $this->load->view('form_perhitungan_capeg',$data,true);
					$this->load->view('main',$data);
				}
			}		
			
		}
		else
		{
			$data['akademik_produksi'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Produksi', 'tes akademik');
			$data['psikologi_produksi'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Produksi', 'tes psikologi');
			$data['kepribadian_produksi'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Produksi', 'tes kepribadian');
			$data['wawancara_produksi'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Produksi', 'tes wawancara');
			$data['pengetahuan_produksi'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Produksi', 'tes pengetahuan');
			
			$data['akademik_marketing'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Marketing', 'tes akademik');
			$data['psikologi_marketing'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Marketing', 'tes psikologi');
			$data['kepribadian_marketing'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Marketing', 'tes kepribadian');
			$data['wawancara_marketing'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Marketing', 'tes wawancara');
			$data['pengetahuan_marketing'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Marketing', 'tes pengetahuan');
			
			$data['akademik_customer'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Customer', 'tes akademik');
			$data['psikologi_customer'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Customer', 'tes psikologi');
			$data['kepribadian_customer'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Customer', 'tes kepribadian');
			$data['wawancara_customer'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Customer', 'tes wawancara');
			$data['pengetahuan_customer'] = $this->capeg_model->get_pertanyaan($capeg_id, 'Bagian Customer', 'tes pengetahuan');
			
			$data['nama'] = $this->capeg_model->get_capeg_by_id($capeg_id)->row()->NAMA_CAPEG;
			
			$data['status'] = $this->capeg_model->get_capeg_by_id($capeg_id)->row()->STATUS_PEGAWAI;
			
			$data['hitung'] = 'yes';
			
			$data['content'] = $this->load->view('form_perhitungan_capeg',$data,true);
			$this->load->view('main',$data);
		}
	} 
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
