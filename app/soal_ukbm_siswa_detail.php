<table id="dynamic-table" class="table table-bordered table-condensed table-hover table-striped" style="width: auto;">
	<thead>
		<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
			<td width="5%" align="center"><?php if($lng==1) { echo 'No.'; } else { echo 'No.'; } ?></td> 
			<td align="center">Pertanyaan</td>
		</tr>
	</thead>
	
	<tbody>
		
		<?php
			if($protection->soal_ukbm_siswa_approved($idsiswa, $idukbm) == 1 || $_SESSION["adm"] == 1 || $_SESSION["tipe_user"] != "Siswa") {
			
			$sql=$select->list_soal_ukbm_ujian("", $idtingkat, $idsemester, $idjurusan, 1, "ndf", "1");
			$row_soal_detail=$sql->fetch(PDO::FETCH_OBJ);
			$file_ukbm 	= $row_soal_detail->file_ukbm;
			//$idukbm		= $row_soal_detail->idukbm;
		?>
		<tr style="background-color:ffffff; font-weight: bold;" > 
			<td>Download Soal</td>
			<td>
				<?php if (!empty($file_ukbm)) { ?>
					<a class="label label-success" href="<?php echo $__folder ?>app/ukbm_download.php?ref=<?php echo $idukbm ?>" target="_blank" title="Download"><?php echo $file_ukbm; ?>
						</a>
				<?php } ?>
			</td>
		</tr>
		
		<?php	
			$no = 0;
			$sql=$select->list_soal_ukbm_ujian("", $idtingkat, $idsemester, $idjurusan, 1, "", "", $idukbm);
			while($row_soal_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
				
				$pilihan1	= $row_soal_detail->pilihan1;
				$pilihan2	= $row_soal_detail->pilihan2;
				$pilihan3	= $row_soal_detail->pilihan3;
				$pilihan4	= $row_soal_detail->pilihan4;
				$pilihan5	= $row_soal_detail->pilihan5;					
		?>								
			
				<input type="hidden" id="replid_<?php echo $no ?>" name="replid_<?php echo $no ?>" value="<?php echo $row_soal_detail->replid; ?>" >
				
				<tr style="background-color:ffffff; font-weight: bold;" > 
					
					<td align="center">				
						<?php echo $no + 1; ?>.
					</td>
					
					<td>
						<?php echo $row_soal_detail->pertanyaan; ?>		
					</td>
						
				</tr>
				
				<tr style="background-color:ffffff;" > 
					<td></td>
					<td>
						<table class="table table-bordered table-condensed table-hover table-striped" style="width: auto;">
							<tr>
								<td align="center">				
									A.
								</td>								
								<td>
									<?php echo $pilihan1 ?>		
								</td>
								<td>
									<?php if (!empty($row_soal_detail->pilihan_photo1)) { ?>
			        					<img src="<?php echo $__folder ?>app/soal_ukbm_photo/<?php echo $row_soal_detail->pilihan_photo1; ?>" width="200" height="150" />
			        				<?php } ?>
								</td>
								<td>
									<input type="radio" id="jawaban_<?php echo $no ?>" name="jawaban_<?php echo $no ?>" class="ace" value="1" /><span class="lbl"></span>
								</td>	
							</tr>							
							<tr>
								<td align="center">				
									B.
								</td>								
								<td>
									<?php echo $pilihan2 ?>		
								</td>								
								<td>
									<?php if (!empty($row_soal_detail->pilihan_photo2)) { ?>
			        					<img src="<?php echo $__folder ?>app/soal_ukbm_photo/<?php echo $row_soal_detail->pilihan_photo2; ?>" width="200" height="150" />
			        				<?php } ?>
								</td>
								<td>
									<input type="radio" id="jawaban_<?php echo $no ?>" name="jawaban_<?php echo $no ?>" class="ace" value="2" /><span class="lbl"></span>
								</td>
							</tr>
							<tr>
								<td align="center">				
									C.
								</td>								
								<td>
									<?php echo $pilihan3 ?>		
								</td>								
								<td>
									<?php if (!empty($row_soal_detail->pilihan_photo3)) { ?>
			        					<img src="<?php echo $__folder ?>app/soal_ukbm_photo/<?php echo $row_soal_detail->pilihan_photo3; ?>" width="200" height="150" />
			        				<?php } ?>
								</td>
								<td>
									<input type="radio" id="jawaban_<?php echo $no ?>" name="jawaban_<?php echo $no ?>" class="ace" value="3" /><span class="lbl"></span>
								</td>
							</tr>
							<tr>
								<td align="center">				
									D.
								</td>								
								<td>
									<?php echo $pilihan4 ?>		
								</td>								
								<td>
									<?php if (!empty($row_soal_detail->pilihan_photo4)) { ?>
			        					<img src="<?php echo $__folder ?>app/soal_ukbm_photo/<?php echo $row_soal_detail->pilihan_photo4; ?>" width="200" height="150" />
			        				<?php } ?>
								</td>
								<td>
									<input type="radio" id="jawaban_<?php echo $no ?>" name="jawaban_<?php echo $no ?>" class="ace" value="4" /><span class="lbl"></span>
								</td>
							</tr>
							<tr>
								<td align="center">				
									E.
								</td>								
								<td>
									<?php echo $pilihan5 ?>		
								</td>								
								<td>
									<?php if (!empty($row_soal_detail->pilihan_photo5)) { ?>
			        					<img src="<?php echo $__folder ?>app/soal_ukbm_photo/<?php echo $row_soal_detail->pilihan_photo5; ?>" width="200" height="150" />
			        				<?php } ?>
								</td>
								<td>
									<input type="radio" id="jawaban_<?php echo $no ?>" name="jawaban_<?php echo $no ?>" class="ace" value="5" /><span class="lbl"></span>
								</td>
							</tr>							
						</table>
					</td>
														
				</tr>
				
		<?php 
				$no++; 
			}	
			
		}		
		?>
				<div class="hide">
					<input type="text" id="jmldata" name="jmldata" value="<?php echo $no; ?>" >
				</div>
						
	</tbody>
</table>