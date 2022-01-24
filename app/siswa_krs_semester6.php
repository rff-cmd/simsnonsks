<?php if($idtingkat == 46 && $_SESSION["semester_id"]==20) { ?>
	<div id="semester6" class="tab-pane in active">
<?php } else { ?>
	<div id="semester6" class="tab-pane">
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


					##check nilai (jika dibawah KKM tidak bisa KRS)
					$a_pelajaran_id = array();

					$sql = $selectview->get_tahunajaran_sebelumnya($idtahunajaran1);
					$row_tahunajaran=$sql->fetch(PDO::FETCH_OBJ);

					$sql = $selectview->get_kelas_sebelumnya($nis);
					$row_kelas=$sql->fetch(PDO::FETCH_OBJ);

					//--------Kelompok Utama 
					$sql = $selectview->get_daftarnilai_raport("SMA", $idtingkat, $row_kelas->idkelas, '20', $_SESSION["idsiswa"], '', $nama_minat, $row_tahunajaran->replid, $nis);
					while($row_pelajaran_detail=$sql->fetch(PDO::FETCH_OBJ)) { 

						//pengetahuan
						$nilai_p = 0;
						$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, $idtahunajaran, $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 3, $nis_siswa);
						$data_nilai_p	= $sqlnilai->fetch(PDO::FETCH_OBJ);
						$nilai_p		= $data_nilai_p->uas;
						
						$jumlah_nilai = 0;
						$jumlah_nilai	= $jumlah_nilai + $data_nilai_p->jumlah;
						
						$jumlah_ukbm_upd = 0;
						$nilai_detail_p = 0;
						$nilai_detail_non_uas_p=0;
						$sqlndetail = $selectview->list_daftarnilai_detail($data_nilai_p->replid);
						//$jumlah_ukbm_upd = $sqlndetail->rowCount();
						while($datanilai_detail=$sqlndetail->fetch(PDO::FETCH_OBJ)) {
							if($datanilai_detail->nilai != "") {
								$jumlah_ukbm_upd++;
							}
							$nilai_detail_p = $nilai_detail_p + $datanilai_detail->nilai;
							$nilai_detail_non_uas_p = $nilai_detail_non_uas_p + $datanilai_detail->nilai;
						}
						
						if($jumlah_ukbm_upd > 0) {
							$nilai_detail_p = ( ($nilai_detail_p/$jumlah_ukbm_upd)*75)/100;	
							$nilai_detail_non_uas_p = $nilai_detail_non_uas_p/$jumlah_ukbm_upd;
						} else {
							$nilai_detail_p = 0;
							$nilai_detail_non_uas_p = 0;
						}
						
						if($nilai_p != "") {
							$nilai_p		= ($nilai_p*25)/100;
							$nilai_raport	= number_format($nilai_detail_p + $nilai_p,0,'.',',');
							$total_p		= $total_p + numberreplace($nilai_raport);
						} else {
							$nilai_p		= 0;
							$nilai_raport	= number_format($nilai_detail_non_uas_p,0,'.',',');				
							$total_p		= $total_p + $nilai_raport;
						}

						if($nilai_raport < 75) {
							$a_pelajaran_id[] = $row_pelajaran_detail->pelajaran_id;
						}
					}
					//---------------------/\-------------

					
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
								<?php echo $row_counting_detail->kode2; ?>		
							</td>
							
							<td>
								<?php echo $row_counting_detail->nama_pelajaran; ?>		
							</td>
							
							<td align="center">
								<?php echo $row_counting_detail->sks; ?>		
							</td>
							
							<td align="center">
								<?php
									$key = (string)array_search($row_counting_detail->pelajaran_id, $a_pelajaran_id);
									if( $key == "" ) {
								?>
										<?php if($idtingkat == 46 && $_SESSION["semester_id"]==20) { ?>
											<input type="checkbox" id="pilih_<?php echo $no; ?>" name="pilih_<?php echo $no; ?>" style="text-align: right;" class="ace" value="1" ><span class="lbl"></span>
										<?php } else if($idtingkat >= 46) { 
											if( numeric_semester($idtingkat) > 6) {
												echo 'Tuntas';
											}
										} ?>
								<?php
									} else {
								?>
										<div style="color: red">Belum Tuntas</div>
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

				<tr style="background-color:ffffff; font-weight: bold; color: red" >
					<td align="left" colspan="4">				
						Mata Pelajaran belum tuntas
					</td>
				</tr>
				<?php
					$sql = $selectview->get_tahunajaran_sebelumnya($idtahunajaran1);
					$row_tahunajaran=$sql->fetch(PDO::FETCH_OBJ);

					$sql = $selectview->get_kelas_sebelumnya($nis);
					$row_kelas=$sql->fetch(PDO::FETCH_OBJ);

					for($i=0; $i < count($a_pelajaran_id); $i++) {
						$sql = $selectview->get_krs('', $row_kelas->idtingkat, '20', $nama_minat, $row_tahunajaran->replid, $idminat, $a_pelajaran_id[$i]);
						$row_pelajaran_detail=$sql->fetch(PDO::FETCH_OBJ); 
						
				?>
						<tr style="background-color:ffffff;" > 
							
							<td align="center">				
								<?php echo $i + 1; ?>.
							</td>
							
							<td>
								<?php echo $row_pelajaran_detail->kode1; ?>		
							</td>

							<td>
								<?php echo $row_pelajaran_detail->nama_pelajaran; ?>		
							</td>
							
							<td align="center">
								<?php echo $row_pelajaran_detail->sks; ?>		
							</td>
							
							<td align="center">
											
							</td>
											
						</tr>
				<?php
					}
				?>

								
			</tbody>
		</table>
	</p>
</div>