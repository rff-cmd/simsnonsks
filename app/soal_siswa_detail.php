<table class="table table-bordered table-condensed table-hover table-striped" style="width: auto;">
	<thead>
		<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
			<td width="5%" align="center"><?php if($lng==1) { echo 'No.'; } else { echo 'No.'; } ?></td> 
			<td align="center">Pertanyaan</td>
		</tr>
	</thead>
	<tbody>
		
		<?php	
			$no = 0;
			$sql=$select->list_soal_ujian("", $idtingkat, $idsemester, $idjurusan, 1);
			while($row_soal_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
				
				$pilihan1	= $row_soal_detail->pilihan1;
				$pilihan2	= $row_soal_detail->pilihan2;
				$pilihan3	= $row_soal_detail->pilihan3;
				$pilihan4	= $row_soal_detail->pilihan4;
				$pilihan5	= $row_soal_detail->pilihan5;					
		?>								
			
				<input type="hidden" id="replid_<?php echo $no ?>" name="replid_<?php echo $no ?>" value="<?php echo $row_soal_detail->replid; ?>" >
				
				<tr style="background-color:ffffff;" > 
					
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
									<input type="radio" id="jawaban_<?php echo $no ?>" name="jawaban_<?php echo $no ?>" class="ace" value="5" /><span class="lbl"></span>
								</td>
							</tr>							
						</table>
					</td>
														
				</tr>
				
		<?php 
				$no++; 
			}			
		?>
				<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $no; ?>" >
						
	</tbody>
</table>