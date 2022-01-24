<?php
	$sqlidentitas = $select->list_identitas();
	$dataidentitas = $sqlidentitas->fetch(PDO::FETCH_OBJ);
	
	$sqlsiswa = $select->list_siswa("", $idsiswa);
	$datasiswa = $sqlsiswa->fetch(PDO::FETCH_OBJ);
	
	$peminatan = "";
	$minat = "";
	if($datasiswa->idminat == 1) {
		$minat = "Matematika dan Ilmu Pengetahuan Alam";
		
		$peminatan = "MIPA";
	}
	if($datasiswa->idminat == 2) {
		$minat = "Ilmu-ilmu Sosial";
		
		$peminatan = "IPS";
	}
	
	$sqlsemester = $select->list_semester($idsemester);
	$datasemester = $sqlsemester->fetch(PDO::FETCH_OBJ);
	
	$sqldesc_predikat_spirit = $select->list_deskripsi_raport("", "", "Spritual", "");
	$datadesc_predikat_spirit = $sqldesc_predikat_spirit->fetch(PDO::FETCH_OBJ);
	
	$sqldesc_predikat_sosial = $select->list_deskripsi_raport("", "", "Sosial", "");
	$datadesc_predikat_sosial = $sqldesc_predikat_sosial->fetch(PDO::FETCH_OBJ);
?>
<div class="row">
	<div class="col-xs-14">
		<!-- PAGE CONTENT BEGINS -->
		<div class="space-6"></div>

		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="widget-box transparent">
					<div class="widget-header widget-header-large">
						<h3 class="widget-title grey lighter">
							<i class="ace-icon fa fa-leaf green"></i>
							Raport
						</h3>

						<div class="widget-toolbar no-border invoice-info">
							<span class="invoice-info-label">Raport Siswa:</span>
							<span class="red"><?php echo $datasiswa->nis ?></span>

							<br />
							<span class="invoice-info-label">Tanggal:</span>
							<span class="blue"><?php echo date("d-m-Y") ?></span>
						</div>

						<div class="widget-toolbar hidden-480">
							<!--<a href="#"  onClick="JavaScript:export_raport()">
            					<i class="ace-icon fa fa-print"></i>
            				</a>-->
            				
            				<a href="JavaScript:print_raport()" class="tooltip-error" data-rel="tooltip" title="Print Raport">
            					Cetak Raport
	                        	<span class="green">
									<i class="ace-icon glyphicon glyphicon-print bigger-120"></i>
								</span>
							</a><br>
							
							<a href="JavaScript:print_raport_absensi()" class="tooltip-error" data-rel="tooltip" title="Print Raport">
            					Cetak Rekap Kehadiran
	                        	<span class="green">
									<i class="ace-icon glyphicon glyphicon-print bigger-120"></i>
								</span>
							</a><br>
							
							<a href="JavaScript:print_raport_aspek()" class="tooltip-error" data-rel="tooltip" title="Print Raport">
            					Cetak Aspek Peng. & Keterampilan
	                        	<span class="green">
									<i class="ace-icon glyphicon glyphicon-print bigger-120"></i>
								</span>
							</a>
							
						</div>
					</div>

					<div class="widget-body">
						<div class="widget-main padding-24">
							<div class="row">
								<div class="col-sm-6">
									<div class="row">
										<div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right">
											<b><?php echo $dataidentitas->nama ?></b>
										</div>
									</div>
									
									<input type="hidden" id="idtingkat" name="idtingkat" value="<?php echo $datasiswa->idtingkat ?>"/>
									<input type="hidden" id="idkelas" name="idkelas" value="<?php echo $datasiswa->idkelas ?>"/>
									<input type="hidden" id="idtahunajaran" name="idtahunajaran" value="<?php echo $datasiswa->idangkatan ?>"/>
									

									<div>
										<ul class="list-unstyled spaced">
											<li>
												<i class="ace-icon fa fa-caret-right blue"></i><?php echo $dataidentitas->alamat1 ?>
											</li>

											<li>
												<i class="ace-icon fa fa-caret-right blue"></i><?php echo $dataidentitas->info1 ?>
											</li>

											<li>
												<i class="ace-icon fa fa-caret-right blue"></i><?php echo $dataidentitas->alamat3 ?>, <?php echo $dataidentitas->alamat4 ?>
											</li>

											<li>
												<i class="ace-icon fa fa-caret-right blue"></i>
Phone:
												<b class="red"><?php echo $dataidentitas->telp1 ?></b>
											</li>

											<li class="divider"></li>

										</ul>
									</div>
								</div><!-- /.col -->

								<div class="col-sm-6">
									<div class="row">
										<div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
											<b>Siswa</b>
										</div>
									</div>

									<div>
										<ul class="list-unstyled  spaced">
											<li>
												<i class="ace-icon fa fa-caret-right green"></i>Nama Peserta Didik : <?php echo $datasiswa->nama ?>
											</li>

											<li>
												<i class="ace-icon fa fa-caret-right green"></i>Nomor Induk/NISN : <?php echo $datasiswa->nis ?>
											</li>

											<li>
												<i class="ace-icon fa fa-caret-right green"></i>Semester : <?php echo $datasemester->semester ?>
											</li>

											<li class="divider"></li>

											<li>
												<i class="ace-icon fa fa-caret-right green"></i>
												Peminatan : <?php echo $minat ?>
											</li>
										</ul>
									</div>
								</div><!-- /.col -->
							</div><!-- /.row -->

							<div class="space"></div>
							
							<div>
								<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th colspan="3">A. SIKAP</th>
										</tr>
									</thead>
									
									<tbody>
										<tr>
											<td class="center">1. Sikap Spiritual</td>

											<td>
												Predikat
											</td>
											<td class="hidden-xs">
												Deskripsi
											</td>
										</tr>
										
										<tr>
											<td class="center">&nbsp;</td>
											<td align="center">
												<input type="text" name="sikap_spiritual" id="sikap_spiritual" class="form-control" value="A">
											</td>
											<td width="80%">
												<textarea id="sikap_spiritual_deskripsi" name="sikap_spiritual_deskripsi" class="autosize-transition form-control"><?php echo $datadesc_predikat_spirit->sikap_a ?></textarea>
											</td>
										</tr>
									</tbody>
									
									<tbody>
										<tr>
											<td class="center">2. Sikap Sosial</td>

											<td>
												Predikat
											</td>
											<td class="hidden-xs">
												Deskripsi
											</td>
										</tr>
										
										<tr>
											<td class="center">&nbsp;</td>
											<td align="center">
												<input type="text" name="sikap_sosial" id="sikap_sosial" class="form-control" value="A">
											</td>
											<td>
												<textarea id="sikap_sosial_deskripsi" name="sikap_sosial_deskripsi" class="autosize-transition form-control"><?php echo $datadesc_predikat_sosial->sikap_a ?></textarea>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							
							<div class="space"></div>							
							<div>
								<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>B. Pengetahuan dan Keterampilan</th>
										</tr>
									</thead>
								</table>
							</div>
							
							<?php
								$jumlah_sks = 0;
							?>
							<div>
								<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th class="center" rowspan="2">Kode</th>
											<th class="center" rowspan="2">Mata Pelajaran</th>
											<th class="center" colspan="2">KKM</th>
											<th class="center" rowspan="2">Beban/JP</th>
											<th class="center" colspan="2">Pengetahuan (P)</th>
											<th class="center" colspan="2">Keterampilan (K)</th>
											<th class="center" rowspan="2">Rata2</th>
											<th class="center" rowspan="2">Rata2 x Beban</th>
										</tr>
										
										<tr>
											<th class="center">P</th>
											<th class="center">K</th>
											<th class="center">Angka</th>
											<th class="center">Predikat</th>
											<th class="center">Angka</th>
											<th class="center">Predikat</th>
										</tr>
										
									</thead>

									<?php 
										$total_p 	= 0;
										$total_k 	= 0;
										$total_rata = 0;
										$total_rata_beban = 0;
										
										include("raport_siswa_a.php");
										
										include("raport_siswa_b.php");
										
										include("raport_siswa_c.php");
										
										include("raport_siswa_d.php");
										
										if($jumlah_sks == 0) {
											$ip_semester = number_format(0,0,'.',',');
										} else {
											$ip_semester = number_format($total_rata_beban/$jumlah_sks,0,'.',',');
										}
										
									?>
									
									<tbody>
										<tr>
											<td colspan="4">Jumlah</td>
											<td class="center"><?php echo $jumlah_sks ?></td>
											<td class="center"><?php echo $total_p ?></td>
											<td class="center"></td>
											<td class="center"><?php echo $total_k ?></td>
											<td class="center"></td>
											<td class="center"><?php echo $total_rata ?></td>
											<td class="center"><?php echo $total_rata_beban ?></td>
										</tr>
									</tbody>
									
									<tbody>
										<tr>
											<td colspan="11">&nbsp;</td>
										</tr>
									</tbody>
									
									<tbody>
										<tr>
											<td colspan="2">IP Semester (&Sigma;(Rata2 Nilai x Beban)/Jml. Beban</td>
											<td class="center"><?php echo $ip_semester ?></td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="hr hr8 hr-double hr-dotted"></div>

							<!--<div class="row">
								<div class="col-sm-5 pull-right">
									<h4 class="pull-right">
										Total amount :
										<span class="red">$395</span>
									</h4>
								</div>
								<div class="col-sm-7 pull-left"> Extra Information </div>
							</div>-->

							<div class="space-6"></div>
							<!--<div class="well">
								Thank you for choosing Ace Company products.
We believe you will be satisfied by our services.
							</div>-->
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
</div><!-- /.row -->

<?php /*
<table id="simple-table" class="table table-bordered table-condensed table-hover table-striped" style="width: auto;">
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
*/ ?>