<?php
		$sql=$select->list_siswa_nilai_un($nis, $row_siswa->replid);
		$jmldata = $sql->rowCount();
 ?>
 
 <table class="table table-bordered table-condensed table-hover table-striped" style="width: auto;">
	<thead>
		<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
			<th width="5%"><?php if($lng==1) { echo 'No.'; } else { echo 'No.'; } ?></th> 
			<th>Mata Pelajaran</th>
			<th>Nilai UN</th>		
		</tr>
	</thead>
	<tbody>
		<?php 
			
			$no = 0;
			while($row_counting_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
				
				$nilai3 = "";
				$nilai3 = $row_counting_detail->nilai;							
		?>								
			
			<input type="hidden" id="jmldata_un" name="jmldata_un" value="<?php echo $jmldata; ?>" >
			
			<input type="hidden" id="replid_un3u_<?php echo $no ?>" name="replid_un3u_<?php echo $no ?>" value="<?php echo $row_counting_detail->replid; ?>" >
			<input type="hidden" id="nama_un3u_<?php echo $no ?>" name="nama_un3u_<?php echo $no ?>" value="<?php echo $row_counting_detail->nama; ?>" >
			
			<tr style="background-color:ffffff;" > 
				
				<td>				
					<input type="text" id="no3u_<?php echo $no ?>" name="no3u_<?php echo $no ?>" class="form-control" readonly="" value="<?php echo $no + 1; ?>" >			
					
				</td>
				
				<td>
					<?php echo $row_counting_detail->nama; ?>		
				</td>
				
				<td align="center">
					<input type="text" id="nilai3u_<?php echo $no; ?>" name="nilai3u_<?php echo $no; ?>" style="text-align: right;" class="form-control" onkeyup="formatangka('nilai3u_<?php echo $no; ?>')" autocomplete="off" value="<?php echo $nilai3 ?>" >
				</td>
								
			</tr>
			<?php 
									
				$no++; 
			} 
			
			?>
						
	</tbody>
</table>