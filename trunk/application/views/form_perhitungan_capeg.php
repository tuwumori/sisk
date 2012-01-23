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
							<td><h4><?php if($nama){ echo $nama; } else { echo '-'; } ?></h4></td>
						</tr>
						<tr>
							<td><h4>STATUS CALON PEGAWAI &nbsp;: </h4></td>
							<td><h4><?php if($status){ echo $status; } else { echo '-'; } ?></h4></td>
						</tr>
                    </table>
                    
					<div id="dhtmlgoodies_tabView1">
							
						<div class="dhtmlgoodies_aTab">
							
							<dl>
								<dt><label for="nama_capeg">Tes Akademik : </label></dt>
							</dl>
							
								<?php $no=1; ?>
								<?php foreach($akademik_produksi->result() as $akprod){ ?>	
								<dl>							
								<dt><label for="nama_capeg"><?php echo $no.'. '.$akprod->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($akprod->NILAI){ $nilai_akprod = $akprod->NILAI; }else{ $nilai_akprod = ''; } ?>
								<dd><?php echo form_input(array('name'=>$akprod->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_akprod)); ?></dd>
								</dl>
								<?php $no++; } ?>
							
							<dl>
								<dt><label for="nama_capeg">Tes Psikologi : </label></dt>
							</dl>
							
								<?php $no=1; ?>
								<?php foreach($psikologi_produksi->result() as $psiprod){ ?>
								<dl>								
								<dt><label for="nama_capeg"><?php echo $no.'. '.$psiprod->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($psiprod->NILAI){ $nilai_psiprod = $psiprod->NILAI; }else{ $nilai_psiprod = ''; } ?>
								<dd><?php echo form_input(array('name'=>$psiprod->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_psiprod)); ?></dd>
								</dl>
								<?php $no++; } ?>
							
							<dl>
								<dt><label for="nama_capeg">Tes Kepribadian : </label></dt>
							</dl>
							
								<?php $no=1; ?>
								<?php foreach($kepribadian_produksi->result() as $kepprod){ ?>		
								<dl>						
								<dt><label for="nama_capeg"><?php echo $no.'. '.$kepprod->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($kepprod->NILAI){ $nilai_kepprod = $kepprod->NILAI; }else{ $nilai_kepprod = ''; } ?>
								<dd><?php echo form_input(array('name'=>$kepprod->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_kepprod)); ?></dd>
								</dl>
								<?php $no++; } ?>
							
							<dl>
								<dt><label for="nama_capeg">Tes Wawancara : </label></dt>
							</dl>
							
								<?php $no=1; ?>
								<?php foreach($wawancara_produksi->result() as $waprod){ ?>	
								<dl>							
								<dt><label for="nama_capeg"><?php echo $no.'. '.$waprod->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($waprod->NILAI){ $nilai_waprod = $waprod->NILAI; }else{ $nilai_waprod = ''; } ?>
								<dd><?php echo form_input(array('name'=>$waprod->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_waprod)); ?></dd>
								</dl>
								<?php $no++; } ?>
							
							<dl>
								<dt><label for="nama_capeg">Tes Pengetahuan : </label></dt>
							</dl>
							
								<?php $no=1; ?>
								<?php foreach($pengetahuan_produksi->result() as $pengprod){ ?>
								<dl>								
								<dt><label for="nama_capeg"><?php echo $no.'. '.$pengprod->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($pengprod->NILAI){ $nilai_pengprod = $pengprod->NILAI; }else{ $nilai_pengprod = ''; } ?>
								<dd><?php echo form_input(array('name'=>$pengprod->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_pengprod)); ?></dd>
								</dl>
								<?php $no++; } ?>
							
						</div>
					  
						<div class="dhtmlgoodies_aTab">
							<dl>
								<dt><label for="nama_capeg">Tes Akademik : </label></dt>
							</dl>
							
								<?php $no=1; ?>
								<?php foreach($akademik_marketing->result() as $akmark){ ?>	
								<dl>							
								<dt><label for="nama_capeg"><?php echo $no.'. '.$akmark->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($akmark->NILAI){ $nilai_akmark = $akmark->NILAI; }else{ $nilai_akmark = ''; } ?>
								<dd><?php echo form_input(array('name'=>$akmark->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_akmark)); ?></dd>
								</dl>
								<?php $no++; } ?>
							
							<dl>
								<dt><label for="nama_capeg">Tes Psikologi : </label></dt>
							</dl>
							
								<?php $no=1; ?>
								<?php foreach($psikologi_marketing->result() as $psimark){ ?>								
								<dl>
								<dt><label for="nama_capeg"><?php echo $no.'. '.$psimark->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($psimark->NILAI){ $nilai_psimark = $psimark->NILAI; }else{ $nilai_psimark = ''; } ?>
								<dd><?php echo form_input(array('name'=>$psimark->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_psimark)); ?></dd>
								</dl>
								<?php $no++; } ?>
							
							<dl>
								<dt><label for="nama_capeg">Tes Kepribadian : </label></dt>
							</dl>
							
								<?php $no=1; ?>
								<?php foreach($kepribadian_marketing->result() as $kepmark){ ?>								
								<dl>
								<dt><label for="nama_capeg"><?php echo $no.'. '.$kepmark->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($kepmark->NILAI){ $nilai_kepmark = $kepmark->NILAI; }else{ $nilai_kepmark = ''; } ?>
								<dd><?php echo form_input(array('name'=>$kepmark->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_kepmark)); ?></dd>
								</dl>
								<?php $no++; } ?>
							
							<dl>
								<dt><label for="nama_capeg">Tes Wawancara : </label></dt>
							</dl>
							
								<?php $no=1; ?>
								<?php foreach($wawancara_marketing->result() as $wamark){ ?>								
								<dl>
								<dt><label for="nama_capeg"><?php echo $no.'. '.$wamark->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($wamark->NILAI){ $nilai_wamark = $wamark->NILAI; }else{ $nilai_wamark = ''; } ?>
								<dd><?php echo form_input(array('name'=>$wamark->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_wamark)); ?></dd>
								</dl>
								<?php $no++; } ?>
							
							<dl>
								<dt><label for="nama_capeg">Tes Pengetahuan : </label></dt>
							</dl>
							
								<?php $no=1; ?>
								<?php foreach($pengetahuan_marketing->result() as $pengmark){ ?>								
								<dl>
								<dt><label for="nama_capeg"><?php echo $no.'. '.$pengmark->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($pengmark->NILAI){ $nilai_pengmark = $pengmark->NILAI; }else{ $nilai_pengmark = ''; } ?>
								<dd><?php echo form_input(array('name'=>$pengmark->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_pengmark)); ?></dd>
								</dl>
								<?php $no++; } ?>
							
						</div>
						
						<div class="dhtmlgoodies_aTab">
							<dl>
								<dt><label for="nama_capeg">Tes Akademik : </label></dt>
							</dl>
							
								<?php $no=1; ?>
								<?php foreach($akademik_customer->result() as $akcust){ ?>								
								<dl>
								<dt><label for="nama_capeg"><?php echo $no.'. '.$akcust->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($akcust->NILAI){ $nilai_akcust = $akcust->NILAI; }else{ $nilai_akcust = ''; } ?>
								<dd><?php echo form_input(array('name'=>$akcust->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_akcust)); ?></dd>
								</dl>
								<?php $no++; } ?>
							
							<dl>
								<dt><label for="nama_capeg">Tes Psikologi : </label></dt>
							</dl>
							
								<?php $no=1; ?>
								<?php foreach($psikologi_customer->result() as $psicust){ ?>
								<dl>								
								<dt><label for="nama_capeg"><?php echo $no.'. '.$psicust->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($psicust->NILAI){ $nilai_psicust = $psicust->NILAI; }else{ $nilai_psicust = ''; } ?>
								<dd><?php echo form_input(array('name'=>$psicust->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_psicust)); ?></dd>
								</dl>
								<?php $no++; } ?>
							
							<dl>
								<dt><label for="nama_capeg">Tes Kepribadian : </label></dt>
							</dl>
							
								<?php $no=1; ?>
								<?php foreach($kepribadian_customer->result() as $kepcust){ ?>
								<dl>
								<dt><label for="nama_capeg"><?php echo $no.'. '.$kepcust->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($kepcust->NILAI){ $nilai_kepcust = $kepcust->NILAI; }else{ $nilai_kepcust = ''; } ?>
								<dd><?php echo form_input(array('name'=>$kepcust->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_kepcust)); ?></dd>
								</dl>
								<?php $no++; } ?>
							
							<dl>
								<dt><label for="nama_capeg">Tes Wawancara : </label></dt>
							</dl>
							
								<?php $no=1; ?>
								<?php foreach($wawancara_customer->result() as $wacust){ ?>	
								<dl>							
								<dt><label for="nama_capeg"><?php echo $no.'. '.$wacust->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($wacust->NILAI){ $nilai_wacust = $wacust->NILAI; }else{ $nilai_wacust = ''; } ?>
								<dd><?php echo form_input(array('name'=>$wacust->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_wacust)); ?></dd>
								</dl>
								<?php $no++; } ?>
							
							<dl>
								<dt><label for="nama_capeg">Tes Pengetahuan : </label></dt>
							</dl>
							
								<?php $no=1; ?>
								<?php foreach($pengetahuan_customer->result() as $pengcust){ ?>		
								<dl>						
								<dt><label for="nama_capeg"><?php echo $no.'. '.$pengcust->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($pengcust->NILAI){ $nilai_pengcust = $pengcust->NILAI; }else{ $nilai_pengcust = ''; } ?>
								<dd><?php echo form_input(array('name'=>$pengcust->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_pengcust)); ?></dd>
								</dl>
								<?php $no++; } ?>
							
							<dl class="submit">
								<dd><input type="submit" name="submit" id="submit" value="Submit" /></dd>
							</dl>
							
						</div>
		<?php echo form_close();?>
	</div>
<script type="text/javascript">
  initTabs('dhtmlgoodies_tabView1',Array('Bagian Produksi','Bagian Marketing','Bagian Customer'),0,'100%','1350',Array(false));
</script>
