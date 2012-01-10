<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ahp_subkriteria extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('flexigrid');	
		$this->load->helper('flexigrid');
		$this->load->model('subkriteria_model');
		$this->load->model('ahp_subkriteria_model');
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
		$data['jumlah_subkriteria'] = $this->ahp_subkriteria_model->get_jumlah_subkriteria();
		$data['result_subkriteria'] = $this->ahp_subkriteria_model->get_subkriteria();
		$data['bobot'] = array(
							0 => 'bobot',
							1 => '1',
							2 => '2',
							3 => '3',
							4 => '4',
							5 => '5'
							);
		$data['content'] = $this->load->view('tabel_perbandingan_subkriteria',$data,true);
		$this->load->view('main',$data);
	}
	
	function cek_validasi()
	{
		for($i=0;$i<$this->input->post('max_bobot')-1;$i++)
		{
			$this->form_validation->set_rules('bobot'.$i, 'Bobot '.$i, 'callback_cek_dropdown');
		}
		
		$this->form_validation->set_error_delimiters('<div class="error_box">', '</div>');
		$this->form_validation->set_message('required', 'Kolom %s harus diisi !!');
		return $this->form_validation->run();
	}
	
	function cek_dropdown($value){
		if($value === '0'){
			$this->form_validation->set_message('cek_dropdown', 'Kolom %s harus dipilih!!');
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	
	function process1()
	{
		if($this->cek_validasi())
		{
			//mendapatkan jumlah kriteria pada tabel kriteria
			$jumlah_kriteria = $this->ahp_kriteria_model->get_jumlah_kriteria();
			$arrray1 = array();
			$k = 0;
			$l = 0;
			//membuat matriks perbandingan berpasangan 
			for($i=0;$i<$jumlah_kriteria;$i++)
			{
				for($j=$k;$j<$jumlah_kriteria;$j++)
				{
					if($i==$j)
					{
						$array1[$i][$j] = 1;
					}
					else
					{
						$array1[$i][$j] = $this->input->post('bobot'.$l);
						$array1[$j][$i] = 1/$array1[$i][$j];
						$l++;				
					}
				}
				$k++;
			}
			//menampilkan semua elemen array
			for($p=0;$p<$jumlah_kriteria;$p++)
			{
				for($q=0;$q<$jumlah_kriteria;$q++)
				{
					echo '['.$p.']['.$q.'] = '.$array1[$p][$q];
					echo '<br />';
				}
			}
			//mencari jumlah setiap baris matriks perbandingan berpasangan
			$jumlah_per_baris = array();
			$jumlah_per_cell = 0;
			for($y=0;$y<$jumlah_kriteria;$y++)
			{
				for($z=0;$z<$jumlah_kriteria;$z++)
				{
					$jumlah_per_cell = $jumlah_per_cell + $array1[$y][$z];
				}
				$jumlah_per_baris[$y] = $jumlah_per_cell;
				$jumlah_per_cell = 0;
				echo 'jumlah baris ['.$y.'] = '.$jumlah_per_baris[$y];
				echo '<br />';
			}
			//matriks nilai kriteria
			$array2 = array();
			for($m=0;$m<$jumlah_kriteria;$m++)
			{
				for($n=0;$n<$jumlah_kriteria;$n++)
				{				
					$array2[$m][$n] = $array1[$m][$n]/$jumlah_per_baris[$m];
					echo '['.$m.']['.$n.'] = '.$array2[$m][$n];
					echo '<br />';
				}
			}
			//print jumlah per baris matriks nilai kriteria
			$jumlah_per_baris2 = array();
			$jumlah_per_cell2 = 0;
			$prioritas = array();
			for($o=0;$o<$jumlah_kriteria;$o++)
			{
				for($p=0;$p<$jumlah_kriteria;$p++)
				{				
					$jumlah_per_cell2 = $jumlah_per_cell2 + $array2[$p][$o];
				}
				$jumlah_per_baris2[$o] = $jumlah_per_cell2;
				$prioritas[$o] = $jumlah_per_cell2/$jumlah_kriteria;
				//menyimpan nilai prioritas ke database tabel kriteria
				$data = array('PRIORITAS_KRITERIA' => $prioritas[$o]);
				$this->kriteria_model->update($this->input->post($o), $data);
				
				$jumlah_per_cell2 = 0;
				echo 'jumlah baris 2 ['.$o.'] = '.$jumlah_per_baris2[$o];
				echo '<br />';
				echo 'prioritas ['.$o.'] = '.$prioritas[$o];
				echo '<br />';
			}
			//matriks penjumlahan setiap baris
			$array3 = array();
			for($r=0;$r<$jumlah_kriteria;$r++)
			{
				for($s=0;$s<$jumlah_kriteria;$s++)
				{				
					$array3[$s][$r] = $array1[$s][$r]*$prioritas[$r];
					//echo '['.$r.']['.$s.'] = '.$array3[$r][$s];
					//echo '<br />';
				}
			}
			//print matriks penjumlahan setiap baris
			$jumlah_per_baris3 = array();
			$hasil = array();
			$jumlah_per_cell3 = 0;
			$jumlah = 0;
			for($t=0;$t<$jumlah_kriteria;$t++)
			{
				for($u=0;$u<$jumlah_kriteria;$u++)
				{	
					$jumlah_per_cell3 = $jumlah_per_cell3 + $array3[$u][$t];			
					echo '['.$t.']['.$u.'] = '.$array3[$t][$u];
					echo '<br />';
				}
				$jumlah_per_baris3[$t] = $jumlah_per_cell3;
				$hasil[$t] = $jumlah_per_baris3[$t] + $prioritas[$t];
				$jumlah = $jumlah + $hasil[$t];
				$jumlah_per_cell3 = 0;
				echo 'jumlah baris 3 ['.$t.'] = '.$jumlah_per_baris3[$t];
				echo '<br />';
				echo 'hasil ['.$t.'] => '.$jumlah_per_baris3[$t].'+'.$prioritas[$t].' = '.$hasil[$t];
				echo '<br />';
			}
			$alpha_max = $jumlah/$jumlah_kriteria;
			$consistency_index = ($alpha_max - $jumlah_kriteria)/$jumlah_kriteria;
			$consistency_ratio = $consistency_index/1.12;
			echo 'CR = '.$consistency_ratio;
			redirect('master_subkriteria');
		}
		else
		{
			$this->index();
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
