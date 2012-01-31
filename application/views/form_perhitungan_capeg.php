	<script type="text/javascript" src="<?php echo base_url() ?>js/niceforms.js"></script>
	<link rel="stylesheet" href="<?= base_url() ?>css/tab-view.css" type="text/css" media="screen">
	<script type="text/javascript" src="<?= base_url() ?>js/ajax.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/tab-view.js"></script>
	<h2>Penghitungan Calon Pegawai</h2>
	<div>
	<?php echo validation_errors(); ?>
	<?php echo form_open(uri_string(), 'class ="niceform"');?>	
		<?php echo form_hidden('hitung',$hitung); ?>
				<a href="<?php echo base_url()?>index.php/pengelolaan_capeg">Kembali ke daftar calon pegawai</a>
                    
                    <table>
						<tr>
							<td><h4>NAMA CALON PEGAWAI &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </h4></td>
							<td><?php if($nama){ echo $nama; } else { echo '-'; } ?></td>
						</tr>
						<tr>
							<td><strong>STATUS CALON PEGAWAI &nbsp;: </strong></td>
							<td><?php if($status){ echo $status; } else { echo '-'; } ?></td>
						</tr>
						<tr>
							<td>&nbsp; </td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><strong>Nilai di Bagian Produksi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </strong></td>
							<td><?php if($nilai_bagian_produksi){ echo $nilai_bagian_produksi; } else { echo '-'; } if($min_bagian_produksi){ echo ' (nilai minimal '.$min_bagian_produksi.')'; } else { echo ''; } ?></td>
						</tr>
						<tr>
							<td><strong>Nilai di Bagian Marketing &nbsp;&nbsp;&nbsp;: </strong></td>
							<td><?php if($nilai_bagian_marketing){ echo $nilai_bagian_marketing; } else { echo '-'; } if($min_bagian_marketing){ echo ' (nilai minimal '.$min_bagian_marketing.')'; } else { echo ''; } ?></td>
						</tr>
						<tr>
							<td><strong>Nilai di Bagian Customer &nbsp;&nbsp;&nbsp;: </strong></td>
							<td><?php if($nilai_bagian_customer){ echo $nilai_bagian_customer; } else { echo '-'; } if($min_bagian_customer){ echo ' (nilai minimal '.$min_bagian_customer.')'; } else { echo ''; } ?></td>
						</tr>
						<tr>
							<td>&nbsp; </td>
							<td>&nbsp;</td>
						</tr>
                    </table>
                    
					<div id="dhtmlgoodies_tabView1">
							
						<div class="dhtmlgoodies_aTab">						
							<table>
								<tr>
									<td><strong>Tes Akademik : </strong></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<?php $no=1; ?>
								<?php foreach($akademik_produksi->result() as $akprod){ ?>	
								<tr>
									<td><?php echo $no.'. '.$akprod->NAMA_PERTANYAAN.' '; ?> </td>
									<td>&nbsp;&nbsp;:&nbsp;</td>
									<td><?php echo form_input(array('name'=>$akprod->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$akprod->NILAI)); ?></td>
								</tr>
								<?php $no++; } ?>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								
								<tr>
									<td><strong>Tes Psikologi : </strong></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<?php $no=1; ?>
								<?php foreach($psikologi_produksi->result() as $psiprod){ ?>
								<tr>
									<td><?php echo $no.'. '.$psiprod->NAMA_PERTANYAAN.' '; ?> </td>
									<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
									<td><?php echo form_input(array('name'=>$psiprod->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$psiprod->NILAI)); ?></td>
								</tr>
								<?php $no++; } ?>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								
								<tr>
									<td><strong>Tes Kepribadian : </strong></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<?php $no=1; ?>
								<?php foreach($kepribadian_produksi->result() as $kepprod){ ?>
								<tr>
									<td><?php echo $no.'. '.$kepprod->NAMA_PERTANYAAN.' '; ?> </td>
									<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
									<td><?php echo form_input(array('name'=>$kepprod->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$kepprod->NILAI)); ?></td>
								</tr>
								<?php $no++; } ?>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								
								<tr>
									<td><strong>Tes Wawancara : </strong></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<?php $no=1; ?>
								<?php foreach($wawancara_produksi->result() as $waprod){ ?>
								<tr>
									<td><?php echo $no.'. '.$waprod->NAMA_PERTANYAAN.' '; ?> </td>
									<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
									<td><?php echo form_input(array('name'=>$waprod->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$waprod->NILAI)); ?></td>
								</tr>
								<?php $no++; } ?>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								
								<tr>
									<td><strong>Tes Pengetahuan : </strong></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<?php $no=1; ?>
								<?php foreach($pengetahuan_produksi->result() as $pengprod){ ?>
								<tr>
									<td><?php echo $no.'. '.$pengprod->NAMA_PERTANYAAN.' '; ?> </td>
									<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
									<td><?php echo form_input(array('name'=>$pengprod->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$pengprod->NILAI)); ?></td>
								</tr>
								<?php $no++; } ?>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
														
							</table>	
						</div>
					  
						<div class="dhtmlgoodies_aTab">
						
							<table>
								<tr>
									<td><strong>Tes Akademik : </strong></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<?php $no=1; ?>
								<?php foreach($akademik_marketing->result() as $akmark){ ?>	
								<tr>
									<td><?php echo $no.'. '.$akmark->NAMA_PERTANYAAN.' '; ?> </td>
									<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
									<td><?php echo form_input(array('name'=>$akmark->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$akmark->NILAI)); ?></td>
								</tr>
								<?php $no++; } ?>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								
								<tr>
									<td><strong>Tes Psikologi : </strong></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<?php $no=1; ?>
								<?php foreach($psikologi_marketing->result() as $psimark){ ?>
								<tr>
									<td><?php echo $no.'. '.$psimark->NAMA_PERTANYAAN.' '; ?> </td>
									<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
									<td><?php echo form_input(array('name'=>$psimark->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$psimark->NILAI)); ?></td>
								</tr>
								<?php $no++; } ?>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								
								<tr>
									<td><strong>Tes Kepribadian : </strong></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<?php $no=1; ?>
								<?php foreach($kepribadian_marketing->result() as $kepmark){ ?>	
								<tr>
									<td><?php echo $no.'. '.$kepmark->NAMA_PERTANYAAN.' '; ?> </td>
									<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
									<td><?php echo form_input(array('name'=>$kepmark->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$kepmark->NILAI)); ?></td>
								</tr>
								<?php $no++; } ?>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								
								<tr>
									<td><strong>Tes Wawancara : </strong></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<?php $no=1; ?>
								<?php foreach($wawancara_marketing->result() as $wamark){ ?>
								<tr>
									<td><?php echo $no.'. '.$wamark->NAMA_PERTANYAAN.' '; ?> </td>
									<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
									<td><?php echo form_input(array('name'=>$wamark->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$wamark->NILAI)); ?></td>
								</tr>
								<?php $no++; } ?>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								
								<tr>
									<td><strong>Tes Pengetahuan : </strong></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<?php $no=1; ?>
								<?php foreach($pengetahuan_marketing->result() as $pengmark){ ?>
								<tr>
									<td><?php echo $no.'. '.$pengmark->NAMA_PERTANYAAN.' '; ?></td>
									<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
									<td><?php echo form_input(array('name'=>$pengmark->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$pengmark->NILAI)); ?></td>
								</tr>
								<?php $no++; } ?>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
														
							</table>
						</div>
						
						<div class="dhtmlgoodies_aTab">
						
							<table>
								<tr>
									<td><strong>Tes Akademik : </strong></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<?php $no=1; ?>
								<?php foreach($akademik_customer->result() as $akcust){ ?>	
								<tr>
									<td><?php echo $no.'. '.$akcust->NAMA_PERTANYAAN.' '; ?> </td>
									<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
									<td><?php echo form_input(array('name'=>$akcust->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$akcust->NILAI)); ?></td>
								</tr>
								<?php $no++; } ?>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								
								<tr>
									<td><strong>Tes Psikologi : </strong></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<?php $no=1; ?>
								<?php foreach($psikologi_customer->result() as $psicust){ ?>
								<tr>
									<td><?php echo $no.'. '.$psicust->NAMA_PERTANYAAN.' '; ?> </td>
									<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
									<td><?php echo form_input(array('name'=>$psicust->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$psicust->NILAI)); ?></td>
								</tr>
								<?php $no++; } ?>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								
								<tr>
									<td><strong>Tes Kepribadian : </strong></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<?php $no=1; ?>
								<?php foreach($kepribadian_customer->result() as $kepcust){ ?>
								<tr>
									<td><?php echo $no.'. '.$kepcust->NAMA_PERTANYAAN.' '; ?> </td>
									<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
									<td><?php echo form_input(array('name'=>$kepcust->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$kepcust->NILAI)); ?></td>
								</tr>
								<?php $no++; } ?>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								
								<tr>
									<td><strong>Tes Wawancara : </strong></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<?php $no=1; ?>
								<?php foreach($wawancara_customer->result() as $wacust){ ?>
								<tr>
									<td><?php echo $no.'. '.$wacust->NAMA_PERTANYAAN.' '; ?> </td>
									<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
									<td><?php echo form_input(array('name'=>$wacust->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$wacust->NILAI)); ?></td>
								</tr>
								<?php $no++; } ?>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								
								<tr>
									<td><strong>Tes Pengetahuan : </strong></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<?php $no=1; ?>
								<?php foreach($pengetahuan_customer->result() as $pengcust){ ?>
								<tr>
									<td><?php echo $no.'. '.$pengcust->NAMA_PERTANYAAN.' '; ?></td>
									<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
									<td><?php echo form_input(array('name'=>$pengcust->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$pengcust->NILAI)); ?></td>
								</tr>
								<?php $no++; } ?>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td><input type="submit" name="submit" id="submit" value="Submit" /></td>
								</tr>														
							</table>
						</div>
		<?php echo form_close();?>
	</div>
<script type="text/javascript">
  initTabs('dhtmlgoodies_tabView1',Array('Bagian Produksi','Bagian Marketing','Bagian Customer'),0,'100%','100%',Array(false));
</script>
