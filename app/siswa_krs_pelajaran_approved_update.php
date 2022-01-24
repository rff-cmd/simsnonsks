 <table class="table table-bordered table-condensed table-hover table-striped" style="width: auto;">
	<thead>
		<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
			<td width="5%" align="center"><?php if($lng==1) { echo 'No.'; } else { echo 'No.'; } ?></td> 
			<td align="center">Mata Pelajaran</td>
			<td align="center">SKS</td>		
			<td align="center">Approval</td>
			<td align="center">KRS</td>
		</tr>
	</thead>
	<tbody>
		<?php 
			$no = 0;
			$sql1=$select->list_kelompok_krs($idminat);
			while($row_kelompok=$sql1->fetch(PDO::FETCH_OBJ)) {
				
		?>
				<tr style="background-color:ffffff; font-weight: bold;" >
					<td align="left" colspan="4">				
						<?php echo $row_kelompok->dcr; ?>
					</td>
				</tr>
		<?php
				if($semester_id == "") {
					$semester_id = $_SESSION[semester_id];
				}
				if($idtingkat == "") {
					$idtingkat = $_SESSION[idtingkat];
				}
				if($idtahunajaran == "") {
					$idtahunajaran = $_SESSION[idtahunajaran];
				}
				//$sql=$select->list_siswa_krs($ref, $row_kelompok->cde);
				$sql=$select->list_siswa_krs($ref, $row_kelompok->cde, $idtahunajaran, $idminat, $idtingkat, $semester_id);
				while($row_counting_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
					
					$approved = "";
					if($row_counting_detail->approved == 1) {
						$approved = "checked";
					}
					
					//
					$sqlgetkrs = $select->get_kartu_rencana_studi($idminat, $idtingkat, $row_kelompok->cde, $row_counting_detail->pelajaran_id, $row_siswa_krs->semester_id, $idtahunajaran);
					$row_krs=$sqlgetkrs->fetch(PDO::FETCH_OBJ);						
		?>								
			
				<input type="hidden" id="pelajaran_id_<?php echo $no ?>" name="pelajaran_id_<?php echo $no ?>" value="<?php echo $row_counting_detail->pelajaran_id; ?>" >
				<input type="hidden" id="replid_<?php echo $no ?>" name="replid_<?php echo $no ?>" value="<?php echo $row_counting_detail->replid; ?>" >
				
				<tr style="background-color:ffffff;" > 
					
					<td align="center">				
						<?php echo $no + 1; ?>.
					</td>
					
					<td>
						<?php echo $row_counting_detail->nama_pelajaran; ?>		
					</td>
					
					<td align="center">
						<?php echo $row_krs->sks ?>
					</td>
					
					<td align="center">
						<input type="checkbox" id="approved_<?php echo $no; ?>" name="approved_<?php echo $no; ?>" style="text-align: right;" class="ace" value="1" <?php echo $approved ?> ><span class="lbl"></span>
					</td>
					<td align="center">
						<?php 
							if($row_counting_detail->pilih == 1) {
						?>
								<span class="green">
									<i class="ace-icon fa fa-check-square-o bigger-150"></i>
								</span>
						<?php		
							} 
						?>
					</td>
									
				</tr>
		<?php 
				$no++; 
			}			
		} 
		
		?>
				<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $no; ?>" >
						
	</tbody>
</table>