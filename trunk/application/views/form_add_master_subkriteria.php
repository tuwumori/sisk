	<script type="text/javascript" src="<?php echo base_url() ?>js/niceforms.js"></script>
	<h2>Tambah Subkriteria</h2>
	<div>
	<?php echo validation_errors(); ?>
	<?php echo form_open('master_subkriteria/add_process', 'class ="niceform"');?>						
				<a href="<?php echo base_url()?>index.php/master_subkriteria/grid/<?php echo $kriteria_id;?>">Kembali ke master subkriteria</a>
                    <dl>
                        <dt><label for="role">Kriteria : </label></dt>
                        <dd>
                        <?php
							$kriteria_dipilih = 0; if(set_value('kriteria')!=0) $kriteria_dipilih = set_value('kriteria');
							echo form_dropdown('kriteria', $kriteria, $kriteria_dipilih, 'size="1"');
						?>
						</dd>
                    </dl>
                    <dl>
                        <dt><label for="jabatan">Nama Subkriteria : </label></dt>
                        <?php $subkriteria = ''; if(set_value('subkriteria')!='') $subkriteria = set_value('subkriteria')?>
						<dd><?php echo form_input(array('name'=>'subkriteria', 'id'=>'subkriteria' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$subkriteria)); ?></dd>
                    </dl>
                    <dl>
                        <dt><label for="jabatan">Bobot (angka) : </label></dt>
                        <?php $bobot = ''; if(set_value('bobot')!='') $bobot = set_value('bobot')?>
						<dd><?php echo form_input(array('name'=>'bobot', 'id'=>'bobot' ,'size'=>'54','type'=>'text', 'maxlength'=>'255', 'value'=>$bobot)); ?></dd>
                    </dl>
                    <dl class="submit">
						<dd><input type="submit" name="submit" id="submit" value="Submit" /></dd>
                    </dl>
		<?php echo form_close();?>
	</div>