 <table class="table table-bordered table-condensed table-hover table-striped" style="width: auto;">
	<thead>
		<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
			<td width="5%" align="center"><?php if($lng==1) { echo 'No.'; } else { echo 'No.'; } ?></td> 
			<td align="center">NIS</td>
			<td align="center">Nama Siswa</td>
			<td align="center">Hadir</td>
		</tr>
	</thead>
	<tbody>
		<?php 
			$no = 0;
			//$sql1=$select->list_kelompok_krs();
			//while($row_kelompok=$sql1->fetch(PDO::FETCH_OBJ)) {
				
		?>
				<tr style="background-color:ffffff; font-weight: bold;" >
					<td align="left" colspan="4">				
						<?php echo $row_kelompok->dcr; ?>
					</td>
				</tr>
		<?php
				$sql=$selectview->list_siswa('', '', '27', '', '', '', 'SMA');
				while($row_counting_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
											
		?>								
			
				<input type="hidden" id="siswa_id_<?php echo $no ?>" name="siswa_id_<?php echo $no ?>" value="<?php echo $row_counting_detail->pelajaran_id; ?>" >
				
				
				<tr style="background-color:ffffff;" > 
					
					<td align="center">				
						<?php echo $no + 1; ?>.
					</td>
					
					<td>
						<?php echo $row_counting_detail->nis; ?>		
					</td>
					
					<td>
						<?php echo $row_counting_detail->nama; ?>		
					</td>
					
					<td align="center">
						<input type="checkbox" id="hadir_<?php echo $no; ?>" name="hadir_<?php echo $no; ?>" style="text-align: right;" class="ace" value="1" checked ><span class="lbl"></span>
						</select>
					</td>
									
				</tr>
		<?php 
				$no++; 
			//}			
		} 
		
		?>
				<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $no; ?>" >
						
	</tbody>
</table>