 <table class="table table-bordered table-condensed table-hover table-striped">
	<thead>
		<tr style="color: #168124; font-weight: bold; background-color: #e6ffea"> 
			<th>Tahun Ajaran</th>
			<th>Pembimbing Akademik</th>
			<th>Upload TTD</th>
			<?php if(!empty($ref)) { ?>
				<th>Hapus</th>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
		<?php 
			$no = 0; 
			$sql=$select->list_kelas_detail($ref);
			$jmldata = $sql->rowCount();
			
			while($row_kelas_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
		?>
			
			<input type="hidden" id="old_line_<?php echo $no ?>" name="old_line_<?php echo $no ?>" value="<?php echo $row_kelas_detail->line ?>" >
			
			<tr style="border: 1px solid #cccccc;">
	          	<td style="border-right: 1px solid #cccccc;">
	          		<div style="width: 200px">
		          		<select name="idtahunajaran_<?php echo $no ?>" id="idtahunajaran_<?php echo $no ?>" class="chosen-select form-control" />
							<option value=""></option>
							<?php select_thnajaran($row_kelas_detail->idtahunajaran); ?>
						</select>
					</div>
	          	</td>
	          	
	          	<td style="border-right: 1px solid #cccccc;">
	          		<div style="width: 300px">
		          		<select name="nipwali_<?php echo $no ?>" id="nipwali_<?php echo $no ?>" class="chosen-select form-control" >
							<option value=""></option>
							<?php select_pegawai($row_kelas_detail->nipwali); ?>
						</select>
					</div>
	          	</td>
	          	<td align="center">				
					<!---------------------------->
					<input type="file" id="ttd_file_<?php echo $no ?>" name="ttd_file_<?php echo $no ?>" class="form-control" style="width: auto" value="" >	
					
					<br />
    				<?php if (!empty($row_kelas_detail->ttd_file)) { ?>
    					
    					<a href="<?php echo $__folder ?>app/file_ttd/<?php echo $row_kelas_detail->ttd_file ?>" rel="lightbox" style="text-decoration:none;" title="Photo View">
							<label>
								<img src="../app/file_ttd/<?php echo $row_kelas_detail->ttd_file; ?>" width="50" height="50" />
							</label>
						</a>
						
    				<?php } ?>
                    <input type="hidden" id="ttd_file2_<?php echo $no ?>" name="ttd_file2_<?php echo $no ?>" value="<?php echo $row_kelas_detail->ttd_file; ?>">	
                    
				</td>
	          	<?php if(!empty($ref)) { ?>
        			<td style="border-right: 1px solid #cccccc;">
		          		<input type="checkbox" id="delete_<?php echo $no ?>" name="delete_<?php echo $no ?>" class="ace" value="1" ><span class="lbl"></span>
		          	</td>
        		<?php } ?>
	        </tr>
	    <?php
	    		$no++;
	    	}
	    ?>
		<tr style="border: 1px solid #cccccc;">
          	<td style="border-right: 1px solid #cccccc;">
          		<div style="width: 200px">
	          		<select name="idtahunajaran_det" id="idtahunajaran_det" class="chosen-select form-control" />
						<option value=""></option>
						<?php select_thnajaran(''); ?>
					</select>
				</div>
          	</td>
          	
          	<td style="border-right: 1px solid #cccccc;">
          		<div style="width: 300px">
	          		<select name="nipwali_det" id="nipwali_det" class="chosen-select form-control" >
						<option value=""></option>
						<?php select_pegawai(''); ?>
					</select>
				</div>
          	</td>    
          	
          	<td align="center">				
				<input type="file" id="ttd_file" name="ttd_file" class="form-control" style="width: auto" value="" >
			</td>      	
        </tr>		
        
        <input type="hidden" id="jmldata" name="jmldata" value="<?php echo $no ?>">	
										
	</tbody>
</table>