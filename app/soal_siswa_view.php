<?php
	$idsiswa = $segmen3; //$_POST["idsiswa"];	
	
	if($_SESSION["adm"] == 0 && $_SESSION["tipe_user"] == "Siswa") {
		$idsiswa = $_SESSION["idsiswa"];
	}
?>

<div class="page-content">
      
	<div class="row">
		<div class="col-xs-12">
			
			<form class="form-horizontal" role="form" action="" method="post" name="soal_siswa" id="soal_siswa" class="form-horizontal" enctype="multipart/form-data">
			
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Siswa *)</label>
					<div class="col-sm-4">
						<select name="idsiswa" id="idsiswa" disabled="" class="chosen-select form-control" >
							<option value=""></option>
							<?php select_siswa_id($idsiswa); ?>
						</select>
					</div>
				</div>
					
				<table class="table table-bordered table-condensed table-hover table-striped" style="width: auto;">
					<thead>
						<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
							<td width="5%" align="center"><?php if($lng==1) { echo 'No.'; } else { echo 'No.'; } ?></td> 
							<td align="center">Pertanyaan</td>
						</tr>
					</thead>
					<tbody>
						
						<?php	
							$nilai = 0;							
							$no = 0;
							$sql=$select->list_soal_siswa($idsiswa);
							while($row_soal_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
								
								$jawaban		= $row_soal_detail->jawaban;
								$kunci_jawab	= $row_soal_detail->kunci_jawab;
								$poin		= $row_soal_detail->poin;
								
								if($kunci_jawab == $jawaban) {
									$kunci_jawab_img = '<img src="'.$__folder .'assets/img/check.png" />';
									$nilai		= $nilai + $row_soal_detail->poin;
								} else {
									$kunci_jawab_img = '<img src="'.$__folder .'assets/img/delete.png" />';
								}
								
								if($jawaban == 1) {
									$jawaban = "A";
								}
								if($jawaban == 2) {
									$jawaban = "B";
								}	
								if($jawaban == 3) {
									$jawaban = "C";
								}
								if($jawaban == 4) {
									$jawaban = "D";
								}
								if($jawaban == 5) {
									$jawaban = "E";
								}
								
						?>								
							
								<input type="hidden" id="replid_<?php echo $no ?>" name="replid_<?php echo $no ?>" value="<?php echo $row_soal_detail->replid; ?>" >
								
								<tr style="background-color:ffffff;" > 
									
									<td align="center">				
										<?php echo $no + 1; ?>.
									</td>
									
									<td style="font-weight: bold">
										<?php echo $row_soal_detail->pertanyaan; ?>		
									</td>
										
								</tr>
								
								<tr style="background-color:ffffff;" > 
									<td></td>
									<td>
										<table class="table table-bordered table-condensed table-hover table-striped" style="width: auto;">
											<tr>
												<td align="center">				
													Hasil Jawaban
												</td>
												
												<td style="font-weight: bold">
													<?php echo $jawaban ?>		
												</td>
												
												<td align="center">				
													<?php echo $kunci_jawab_img ?>
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
					
					<thead>
						<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
							<td width="5%" align="center">NILAI</td> 
							<td align="center"><?php echo $nilai ?></td>
						</tr>
					</thead>
				</table>
			
			</form>
		</div>
	</div>
</div>