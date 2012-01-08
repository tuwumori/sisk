<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_subkriteria extends CI_Controller {

	public __construct()
	{
		parent::__construct();
		$this->load->library('flexigrid');	
		$this->load->helper('flexigrid');
		$this->load->model('subkriteria_model');
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
		$colModel['nama_subkriteria'] = array('Nama Subkriteria',150,TRUE,'center',1);
		$colModel['prioritas_subkriteria'] = array('Prioritas',100,TRUE,'center',1);
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
							'title' => 'Master Subkriteria',
							'showTableToggleBtn' => false
							);
							
		//menambah tombol pada flexigrid top toolbar
		$buttons[] = array('Tambah','add','spt_js');
		$buttons[] = array('separator');
		
				
		// mengambil data dari file controler ajax pada method grid_user		
		$url = site_url()."/master_subkriteria/grid_data_subkriteria";
		$grid_js = build_grid_js('user',$url,$colModel,'ID','asc',$gridParams,$buttons);
		$data['js_grid'] = $grid_js;
		$data['added_js'] = 
		"<script type='text/javascript'>
		function spt_js(com,grid){	
			if (com=='Tambah'){
				location.href= '".base_url()."index.php/master_subkriteria/add';    
			}	
		} </script>";
			
		//$data['added_js'] variabel untuk membungkus javascript yang dipakai pada tombol yang ada di toolbar atas
		$data['content'] = $this->load->view('grid',$data,true);
		$this->load->view('main',$data);
	}
	
	function grid_data_subkriteria() 
	{
		$valid_fields = array('SUBKRITERIA_ID','NAMA_SUBKRITERIA');
		$this->flexigrid->validate_post('SUBKRITERIA_ID','asc',$valid_fields);
		$records = $this->subkriteria_model->get_data_flexigrid();
		$this->output->set_header($this->config->item('json_header'));
			
		$no = 0;
		foreach ($records['records']->result() as $row){	
				$no = $no+1;
				$record_items[] = array(
										$row->SUBKRITERIA_ID,
										$no,
										$row->NAMA_SUBKRITERIA,
										$row->PRIORITAS_SUBKRITERIA,
								'<a href='.base_url().'index.php/master_subkriteria/edit/'.$row->SUBKRITERIA_ID.'><img border=\'0\' src=\''.base_url().'images/flexigrid/magnifier.png\'></a>',
								'<a href='.base_url().'index.php/master_subkriteria/delete/'.$row->SUBKRITERIA_ID.'><img border=\'0\' src=\''.base_url().'images/flexigrid/2.png\'></a>'
								);
		}
		
		if(isset($record_items))
			$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
		else
			$this->output->set_output('{"page":"1","total":"0","rows":[]}');
	}
	
	function cek_validasi()
	{	
		$this->form_validation->set_rules('subkriteria', 'Nama Subkriteria', 'required');
		
		$this->form_validation->set_error_delimiters('<div class="error_box">', '</div>');
		$this->form_validation->set_message('required', 'Kolom %s harus diisi !!');
		return $this->form_validation->run();
	}
	
	public function add()
	{
		$data['content'] = $this->load->view('form_add_master_subkriteria',null,true);
		$this->load->view('main',$data);
	}
	
	public function add_process()
	{
		$data = array(
						'nama_subkriteria' => $this->input->post('subkriteria')
					);
		if($this->cek_validasi())
		{
			$this->subkriteria_model->add($data);
			redirect('master_subkriteria');
		}
		else
		{
			$this->add();
			//redirect('jabatan/add');
		}
	}
	
	public function edit()
	{
		$data = array(
					'nama_subkriteria' => $this->input->post('subkriteria')
				);
		if($this->cek_validasi())
		{
			$this->subkriteria_model->update($subkriteria_id, $data);
			redirect('master_subkriteria');
		}
		else
		{
			$data['subkriteria'] = $this->subkriteria_model->get_subkriteria_by_id($subkriteria_id)->row()->NAMA_SUBKRITERIA;
			$data['content'] = $this->load->view('form_edit_master_subkriteria',$data,true);
			$this->load->view('main',$data);
		}
	}
	
	public function delete($subkriteria_id)
	{
		$this->subkriteria_model->delete($subkriteria_id);
		redirect('master_subkriteria');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
