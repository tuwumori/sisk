	<script type="text/javascript" src="<?php echo base_url() ?>js/niceforms.js"></script>
	<h2>Edit Calon Pegawai</h2>
	<div>
	<?php echo validation_errors(); ?>
	<?php echo form_open(uri_string(), 'class ="niceform"');?>						
				<a href="<?php echo base_url()?>index.php/calon_pegawai">Kembali ke daftar calon pegawai</a>
                    <dl>
                        <dt><label for="nama_capeg">NAMA CALON PEGAWAI : </label></dt>
                        <?php if(set_value('nama_capeg')!='') $nama_capeg = set_value('nama_capeg')?>
						<dd><?php echo form_input(array('name'=>'nama_capeg', 'id'=>'nama_capeg' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$nama_capeg)); ?></dd>
                    </dl>
                    <dl class="submit">
						<dd><input type="submit" name="submit" id="submit" value="Submit" /></dd>
                    </dl>
		<?php echo form_close();?>
	</div>
