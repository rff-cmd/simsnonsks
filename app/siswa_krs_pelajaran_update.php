 <table class="table table-bordered table-condensed table-hover table-striped" style="width: auto;">
	<thead>
		<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
			<td width="5%" align="center"><?php if($lng==1) { echo 'No.'; } else { echo 'No.'; } ?></td> 
			<td align="center">Kode</td>
			<td align="center">Mata Pelajaran</td>
			<td align="center">SKS</td>		
			<td align="center">Pilih</td>
			<td align="center">Disetujui</td>
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
				$sql=$select->list_siswa_krs($ref, $row_kelompok->cde, $_SESSION['idtahunajaran'], $idminat, $_SESSION['idtingkat'], $semester_id);
				while($row_counting_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
				
					$pilih = "";
					if($row_counting_detail->pilih == 1) {
						$pilih = "checked";
					} else {
						$pilih = "";
					}
					
					//
					$sqlgetkrs = $select->get_kartu_rencana_studi($idminat, $datasiswa->idtingkat, $row_kelompok->cde, $row_counting_detail->pelajaran_id, $semester_id, $_SESSION['idtahunajaran']);
					$row_krs=$sqlgetkrs->fetch(PDO::FETCH_OBJ);					
		?>								
				<input type="hidden" id="replid_<?php echo $no ?>" name="replid_<?php echo $no ?>" value="<?php echo $row_counting_detail->replid; ?>" >
				<input type="hidden" id="kelompok_pelajaran_id_<?php echo $no ?>" name="kelompok_pelajaran_id_<?php echo $no ?>" value="<?php echo $row_counting_detail->kelompok_pelajaran_id; ?>" >
				<input type="hidden" id="pelajaran_id_<?php echo $no ?>" name="pelajaran_id_<?php echo $no ?>" value="<?php echo $row_counting_detail->pelajaran_id; ?>" >
				<input type="hidden" id="sks_id_<?php echo $no ?>" name="sks_id_<?php echo $no ?>" value="<?php echo $row_counting_detail->sks; ?>" >
				
				<tr style="background-color:ffffff;" > 
					
					<td align="center">				
						<?php echo $no + 1; ?>.
					</td>

					<td>
						<?php echo $row_counting_detail->kode1; ?>		
					</td>
					
					<td>
						<?php echo $row_counting_detail->nama_pelajaran; ?>		
					</td>
					
					<td align="center">
						<?php echo $row_krs->sks ?>
					</td>
					
					<td align="center">
						<?php if($row_counting_detail->approved != 1) { ?>
							<input type="checkbox" id="pilih_<?php echo $no; ?>" name="pilih_<?php echo $no; ?>" style="text-align: right;" class="ace" value="1" <?php echo $pilih ?> ><span class="lbl"></span>
						<?php } ?>
					</td>
					
					<td align="center">
						<?php 
							if($row_counting_detail->approved == 1) {
						?>
								<span class="green">
									<i class="ace-icon fa fa-check-square-o bigger-150"></i>
								</span>
								<input type="hidden" id="pilih_<?php echo $no; ?>" name="pilih_<?php echo $no; ?>" style="text-align: right;" value="1" >
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