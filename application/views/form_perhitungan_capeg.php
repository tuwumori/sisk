	<script type="text/javascript" src="<?php echo base_url() ?>js/niceforms.js"></script>
	<link rel="stylesheet" href="<?= base_url() ?>css/tab-view.css" type="text/css" media="screen">
	<script type="text/javascript" src="<?= base_url() ?>js/ajax.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/tab-view.js"></script>
	<h2>Edit Calon Pegawai</h2>
	<div>
	<?php echo validation_errors(); ?>
	<?php echo form_open(uri_string(), 'class ="niceform"');?>						
				<a href="<?php echo base_url()?>index.php/calon_pegawai">Kembali ke daftar calon pegawai</a>
                    <dl>
                        <dt><label for="nama_capeg">NAMA CALON PEGAWAI : </label></dt>
						<dd><label for="nama_capeg"><?php if($nama){ echo $nama; } else { echo '-'; } ?></dd>
                    </dl>
					<dl>
                        <dt><label for="nama_capeg">STATUS CALON PEGAWAI : </label></dt>
						<dd><label for="nama_capeg"><?php if($status){ echo $status; } else { echo '-'; } ?></label></dd>
                    </dl>
					
					<div id="dhtmlgoodies_tabView1">	
						<div class="dhtmlgoodies_aTab">
							<dl>
								<dt><label for="nama_capeg">Tes Akademik : </label></dt>
							</dl>
							<dl>
								<?php $no=1; ?>
								<?php foreach($akademik_produksi->result() as $akprod){ ?>								
								<dt><label for="nama_capeg"><?php echo $no.'. '.$akprod->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($akprod->NILAI){ $nilai_akprod = $akprod->NILAI; }else{ $nilai_akprod = ''; } ?>
								<dd><?php echo form_input(array('name'=>$akprod->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_akprod)); ?></dd>
								<?php $no++; } ?>
							</dl>
							<dl>
								<dt><label for="nama_capeg">Tes Psikologi : </label></dt>
							</dl>
							<dl>
								<?php $no=1; ?>
								<?php foreach($psikologi_produksi->result() as $psiprod){ ?>								
								<dt><label for="nama_capeg"><?php echo $no.'. '.$psiprod->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($psiprod->NILAI){ $nilai_psiprod = $psiprod->NILAI; }else{ $nilai_psiprod = ''; } ?>
								<dd><?php echo form_input(array('name'=>$psiprod->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_psiprod)); ?></dd>
								<?php $no++; } ?>
							</dl>
							<dl>
								<dt><label for="nama_capeg">Tes Kepribadian : </label></dt>
							</dl>
							<dl>
								<?php $no=1; ?>
								<?php foreach($kepribadian_produksi->result() as $kepprod){ ?>								
								<dt><label for="nama_capeg"><?php echo $no.'. '.$kepprod->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($kepprod->NILAI){ $nilai_kepprod = $kepprod->NILAI; }else{ $nilai_kepprod = ''; } ?>
								<dd><?php echo form_input(array('name'=>$kepprod->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_kepprod)); ?></dd>
								<?php $no++; } ?>
							</dl>
							<dl>
								<dt><label for="nama_capeg">Tes Wawancara : </label></dt>
							</dl>
							<dl>
								<?php $no=1; ?>
								<?php foreach($wawancara_produksi->result() as $waprod){ ?>								
								<dt><label for="nama_capeg"><?php echo $no.'. '.$waprod->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($waprod->NILAI){ $nilai_waprod = $waprod->NILAI; }else{ $nilai_waprod = ''; } ?>
								<dd><?php echo form_input(array('name'=>$waprod->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_waprod)); ?></dd>
								<?php $no++; } ?>
							</dl>
							<dl>
								<dt><label for="nama_capeg">Tes Pengetahuan : </label></dt>
							</dl>
							<dl>
								<?php $no=1; ?>
								<?php foreach($pengetahuan_produksi->result() as $pengprod){ ?>								
								<dt><label for="nama_capeg"><?php echo $no.'. '.$pengprod->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($pengprod->NILAI){ $nilai_pengprod = $pengprod->NILAI; }else{ $nilai_pengprod = ''; } ?>
								<dd><?php echo form_input(array('name'=>$pengprod->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_pengprod)); ?></dd>
								<?php $no++; } ?>
							</dl>
						</div>
					  
						<div class="dhtmlgoodies_aTab">
							<dl>
								<dt><label for="nama_capeg">Tes Akademik : </label></dt>
							</dl>
							<dl>
								<?php $no=1; ?>
								<?php foreach($akademik_marketing->result() as $akmark){ ?>								
								<dt><label for="nama_capeg"><?php echo $no.'. '.$akmark->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($akmark->NILAI){ $nilai_akmark = $akmark->NILAI; }else{ $nilai_akmark = ''; } ?>
								<dd><?php echo form_input(array('name'=>$akmark->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_akmark)); ?></dd>
								<?php $no++; } ?>
							</dl>
							<dl>
								<dt><label for="nama_capeg">Tes Psikologi : </label></dt>
							</dl>
							<dl>
								<?php $no=1; ?>
								<?php foreach($psikologi_marketing->result() as $psimark){ ?>								
								<dt><label for="nama_capeg"><?php echo $no.'. '.$psimark->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($psimark->NILAI){ $nilai_psimark = $psimark->NILAI; }else{ $nilai_psimark = ''; } ?>
								<dd><?php echo form_input(array('name'=>$psimark->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_psimark)); ?></dd>
								<?php $no++; } ?>
							</dl>
							<dl>
								<dt><label for="nama_capeg">Tes Kepribadian : </label></dt>
							</dl>
							<dl>
								<?php $no=1; ?>
								<?php foreach($kepribadian_marketing->result() as $kepmark){ ?>								
								<dt><label for="nama_capeg"><?php echo $no.'. '.$kepmark->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($kepmark->NILAI){ $nilai_kepmark = $kepmark->NILAI; }else{ $nilai_kepmark = ''; } ?>
								<dd><?php echo form_input(array('name'=>$kepmark->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_kepmark)); ?></dd>
								<?php $no++; } ?>
							</dl>
							<dl>
								<dt><label for="nama_capeg">Tes Wawancara : </label></dt>
							</dl>
							<dl>
								<?php $no=1; ?>
								<?php foreach($wawancara_marketing->result() as $wamark){ ?>								
								<dt><label for="nama_capeg"><?php echo $no.'. '.$wamark->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($wamark->NILAI){ $nilai_wamark = $wamark->NILAI; }else{ $nilai_wamark = ''; } ?>
								<dd><?php echo form_input(array('name'=>$wamark->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_wamark)); ?></dd>
								<?php $no++; } ?>
							</dl>
							<dl>
								<dt><label for="nama_capeg">Tes Pengetahuan : </label></dt>
							</dl>
							<dl>
								<?php $no=1; ?>
								<?php foreach($pengetahuan_marketing->result() as $pengmark){ ?>								
								<dt><label for="nama_capeg"><?php echo $no.'. '.$pengmark->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($pengmark->NILAI){ $nilai_pengmark = $pengmark->NILAI; }else{ $nilai_pengmark = ''; } ?>
								<dd><?php echo form_input(array('name'=>$pengmark->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_pengmark)); ?></dd>
								<?php $no++; } ?>
							</dl>
						</div>
						
						<div class="dhtmlgoodies_aTab">
							<dl>
								<dt><label for="nama_capeg">Tes Akademik : </label></dt>
							</dl>
							<dl>
								<?php $no=1; ?>
								<?php foreach($akademik_customer->result() as $akcust){ ?>								
								<dt><label for="nama_capeg"><?php echo $no.'. '.$akcust->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($akcust->NILAI){ $nilai_akcust = $akcust->NILAI; }else{ $nilai_akcust = ''; } ?>
								<dd><?php echo form_input(array('name'=>$akcust->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_akcust)); ?></dd>
								<?php $no++; } ?>
							</dl>
							<dl>
								<dt><label for="nama_capeg">Tes Psikologi : </label></dt>
							</dl>
							<dl>
								<?php $no=1; ?>
								<?php foreach($psikologi_customer->result() as $psicust){ ?>								
								<dt><label for="nama_capeg"><?php echo $no.'. '.$psicust->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($psicust->NILAI){ $nilai_psicust = $psicust->NILAI; }else{ $nilai_psicust = ''; } ?>
								<dd><?php echo form_input(array('name'=>$psicust->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_psicust)); ?></dd>
								<?php $no++; } ?>
							</dl>
							<dl>
								<dt><label for="nama_capeg">Tes Kepribadian : </label></dt>
							</dl>
							<dl>
								<?php $no=1; ?>
								<?php foreach($kepribadian_customer->result() as $kepcust){ ?>								
								<dt><label for="nama_capeg"><?php echo $no.'. '.$kepcust->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($kepcust->NILAI){ $nilai_kepcust = $kepcust->NILAI; }else{ $nilai_kepcust = ''; } ?>
								<dd><?php echo form_input(array('name'=>$kepcust->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_kepcust)); ?></dd>
								<?php $no++; } ?>
							</dl>
							<dl>
								<dt><label for="nama_capeg">Tes Wawancara : </label></dt>
							</dl>
							<dl>
								<?php $no=1; ?>
								<?php foreach($wawancara_customer->result() as $wacust){ ?>								
								<dt><label for="nama_capeg"><?php echo $no.'. '.$wacust->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($wacust->NILAI){ $nilai_wacust = $wacust->NILAI; }else{ $nilai_wacust = ''; } ?>
								<dd><?php echo form_input(array('name'=>$wacust->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_wacust)); ?></dd>
								<?php $no++; } ?>
							</dl>
							<dl>
								<dt><label for="nama_capeg">Tes Pengetahuan : </label></dt>
							</dl>
							<dl>
								<?php $no=1; ?>
								<?php foreach($pengetahuan_customer->result() as $pengcust){ ?>								
								<dt><label for="nama_capeg"><?php echo $no.'. '.$pengcust->NAMA_PERTANYAAN.' '; ?> : </label></dt>
								<?php if($pengcust->NILAI){ $nilai_pengcust = $pengcust->NILAI; }else{ $nilai_pengcust = ''; } ?>
								<dd><?php echo form_input(array('name'=>$pengcust->NILAI_PEG_PERTANYAAN_ID, 'id'=>'nilai' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nilai_pengcust)); ?></dd>
								<?php $no++; } ?>
							</dl>
							<dl class="submit">
								<dd><input type="submit" name="submit" id="submit" value="Submit" /></dd>
							</dl>
						</div>
		<?php echo form_close();?>
	</div>
<script type="text/javascript">
  initTabs('dhtmlgoodies_tabView1',Array('Bagian Produksi','Bagian Marketing','Bagian Customer'),0,'100%',650,Array(false));
</script>