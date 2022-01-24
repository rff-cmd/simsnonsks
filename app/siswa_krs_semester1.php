<?php if($idtingkat == 27 && $_SESSION["semester_id"]==24) { ?>
	<div id="semester1" class="tab-pane in active">
<?php } else { ?>
	<div id="semester1" class="tab-pane">
<?php } ?>
	<p>
		<table class="table table-bordered table-condensed table-hover table-striped" style="width: auto;">
			<thead>
				<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
					<td width="5%" align="center"><?php if($lng==1) { echo 'No.'; } else { echo 'No.'; } ?></td> 
					<td align="center">Kode</td>
					<td align="center">Mata Pelajaran</td>
					<td align="center">sks</td>		
					<td align="center">Pilih</td>
				</tr>
			</thead>
			<tbody>
				<?php 
					$idtahunajaran1	= $_POST['idtahunajaran1'];
					if($idtahunajaran1 == "") {
						$idtahunajaran1 = $_SESSION['idtahunajaran'];
					}					
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
						$sql=$select->list_kartu_rencana_studi('', $row_kelompok->cde, $idtingkat, $_SESSION["semester_id"], $nama_minat, $idtahunajaran1, $idminat);
						while($row_counting_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
													
				?>								
					
						<input type="hidden" id="pelajaran_id_<?php echo $no ?>" name="pelajaran_id_<?php echo $no ?>" value="<?php echo $row_counting_detail->pelajaran_id; ?>" >
						<input type="hidden" id="kelompok_pelajaran_id_<?php echo $no ?>" name="kelompok_pelajaran_id_<?php echo $no ?>" value="<?php echo $row_counting_detail->kelompok_pelajaran_id; ?>" >
						<input type="hidden" id="sks_id_<?php echo $no ?>" name="sks_id_<?php echo $no ?>" value="<?php echo $row_counting_detail->kelompok_pelajaran_id; ?>" >
						
						
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
								<?php echo $row_counting_detail->sks; ?>		
							</td>
							
							<td align="center">
								<?php if($idtingkat == 27 && $_SESSION["semester_id"]==24) { ?>
									<input type="checkbox" id="pilih_<?php echo $no; ?>" name="pilih_<?php echo $no; ?>" style="text-align: right;" class="ace" value="1" ><span class="lbl"></span>
								<?php } else { 
										if( numeric_semester($idtingkat) > 1) {
											echo 'Tuntas';
										}
									} ?>
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
	</p>
</div>