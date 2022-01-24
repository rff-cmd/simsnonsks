 <table class="table table-bordered table-condensed table-hover table-striped" style="width: auto;">
	<thead>
		<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
			<td width="5%" align="center"><?php if($lng==1) { echo 'No.'; } else { echo 'No.'; } ?></td> 
			<td align="center">Guru</td>
			<td align="center">Pertanyaan</td>		
			<td align="center">Pilih</td>
		</tr>
	</thead>
	<tbody>
		
		<?php	
			$no = 0;
			$sql=$select->list_soal("", $idtingkat, $idsemester, $idjurusan);
			while($row_soal_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
				
				$aktif = "";
				if($row_soal_detail->aktif == 1) {
					$aktif = "checked";
				} else {
					$aktif = "";
				}						
		?>								
			
				<input type="hidden" id="idtingkat_<?php echo $no ?>" name="idtingkat_<?php echo $no ?>" value="<?php echo $row_soal_detail->idtingkat; ?>" >
				<input type="hidden" id="idsemester_<?php echo $no ?>" name="idsemester_<?php echo $no ?>" value="<?php echo $row_soal_detail->idsemester; ?>" >
				<input type="hidden" id="idjurusan_<?php echo $no ?>" name="idjurusan_<?php echo $no ?>" value="<?php echo $row_soal_detail->idjurusan; ?>" >
				<input type="hidden" id="replid_<?php echo $no ?>" name="replid_<?php echo $no ?>" value="<?php echo $row_soal_detail->replid; ?>" >
				
				<tr style="background-color:ffffff;" > 
					
					<td align="center">				
						<?php echo $no + 1; ?>.
					</td>
					
					<td>
						<?php echo $row_soal_detail->guru; ?>		
					</td>
					
					<td>
						<?php echo $row_soal_detail->pertanyaan; ?>		
					</td>
					
					<td align="center">
						<input type="checkbox" id="pilih_<?php echo $no; ?>" name="pilih_<?php echo $no; ?>" style="text-align: right;" class="ace" value="1" <?php echo $aktif ?> ><span class="lbl"></span>
					</td>
									
				</tr>
		<?php 
				$no++; 
			}			
		?>
				<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $no; ?>" >
						
	</tbody>
</table>