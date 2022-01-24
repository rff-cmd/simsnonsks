<div class="row">
	<div class="col-xs-12">
		<div class="clearfix">
			<div class="pull-right tableTools-container"></div>
		</div>
		<!-- div.dataTables_borderWrap -->
		<div>
			<table id="dynamic-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
                        <th class="center" style="font-weight:bold ">No.</th>
                        <!--<th style="font-weight:bold ">Unit &nbsp;&nbsp;</th>-->
						<th style="font-weight:bold ">Kode &nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Mata Pelajaran &nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Sifat/Tipe &nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Tipe Ekstrakurikuler &nbsp;&nbsp;</th>
						<!--<th style="font-weight:bold ">Keterangan &nbsp;&nbsp;</th>-->
						<th style="font-weight:bold ">Input/Edit PTS &nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Input/Edit Nilai &nbsp;&nbsp;</th>
						
						<?php if( allowlvl("frmdaftarnilai") == 2) { ?>
							<th style="font-weight:bold">
								Nilai per Tingkat &nbsp;&nbsp;
							</th>
						<?php } else { ?>
							<th style="font-weight:bold" class="hide">
								
							</th>
						<?php } ?>
						<!--<th style="font-weight:bold ">Sudah Input &nbsp;&nbsp;</th>-->
					</tr>
				</thead>

				<tbody>
                    <?php			
                    	$sqlkelas = $select->list_kelas($idkelas);
                    	$datakelas = $sqlkelas->fetch(PDO::FETCH_OBJ);
                    	$namakelas = $datakelas->kelas;
                    	
                    	if (preg_match("/MIPA/",$namakelas) == 1) {
                    		$peminatan = "MIPA";	
                    		$idminat = 1;
						}
						if (preg_match("/IPS/",$namakelas) == 1 ) {
                    		$peminatan = "IPS";	
                    		$idminat = 2;
						}
						if (preg_match("/MAT/",$namakelas) == 1) {
                    		$peminatan = "MATEMATIKA";	
                    		$idminat = 3;
						} 
						
						//$idtahunajaran = $idtahunajaran; //$_SESSION["idtahunajaran"];
						
						$i = 0;
						//$sql=$select->list_pelajaran("", $sifat, $all);
						$sql=$select->list_kartu_rencana_studi('', '', $idtingkat, $semester_id, $peminatan, $idtahunajaran, $idminat);
			            while($pelajaran_view=$sql->fetch(PDO::FETCH_OBJ)){
						
							$sifat = $pelajaran_view->kelompok_pelajaran;
							/*if($pelajaran_view->sifat == 1) {
								$sifat	=	"Wajib-A";
							}
							if($pelajaran_view->sifat == 0) {
								$sifat	=	"Ekstra Kurikuler";
							}
							if($pelajaran_view->sifat == 2) {
								$sifat	=	"Wajib-B";
							}
							if($pelajaran_view->sifat == 3) {
								$sifat	=	"Peminatan";
							}
							if($pelajaran_view->sifat == 4) {
								$sifat	=	"Lintas Minat";
							}
							
							$ekstra_sifat = "";
							if($pelajaran_view->ekstra_sifat == 1) {
								$ekstra_sifat	=	"Ekstrakurikuler Wajib";
							}*/
							$i++;
														
							/*$sqlnilai 	= $selectview->cek_daftarnilai("SMA", $idtingkat, $idkelas, "", $semester_id, "", "", "", "", $pelajaran_view->pelajaran_id);
							$datanilai	= $sqlnilai->fetch(PDO::FETCH_OBJ);
							$countnilai = $sqlnilai->rowCount();*/
							
							//cek guru mengajar
							$access = 0;
							if($_SESSION["adm"] == 1) {
								$access = 1;
							} else {
								$sqlguru = $select->list_guru($pelajaran_view->pelajaran_id, $_SESSION["idpegawai"], "", "");
								$rowsguru = $sqlguru->rowCount();
								
								//-----
								$sqlstr="select a.replid, a.kode, b.nip, b.nama, c.nama nama_pelajaran from guru a left join pegawai b on a.nip=b.replid left join pelajaran c on a.idpelajaran=c.replid inner join guru_penugasan d on a.replid=d.idguru where c.replid='$pelajaran_view->pelajaran_id' and d.idtingkat='$idtingkat' and d.idkelas='$idkelas' and b.replid='$_SESSION[idpegawai]' order by a.replid";
								$sqlx=$dbpdo->prepare($sqlstr);
								$sqlx->execute();
								$rowsx = $sqlx->rowCount();
								if($rowsguru > 0 && $rowsx > 0) {
									$access = 1;
									
								}
								
							}
							
							
							if($access == 1) {
					?>
                                
	                            <tr>
	                                <td><?php echo $i ?></td>
	                                <!--<td><?php echo $pelajaran_view->departemen ?></td>-->
									<td><?php echo $pelajaran_view->pelajaran_kode ?></td>
									<td><?php echo $pelajaran_view->nama_pelajaran ?></td>
									<td><?php echo $sifat ?></td>
									<td><?php echo $ekstra_sifat ?></td>
									<td align="center">
										<a href="javascript:void(0);" name="Find" title="Input Nilai PTS" onClick="daftarnilai_input_pts('<?php echo $pelajaran_view->pelajaran_id ?>','<?php echo $idtingkat ?>','<?php echo $idkelas ?>','<?php echo $semester_id ?>','<?php echo $iddasarpenilaian ?>','<?php echo $idtahunajaran ?>')">
											<span class="green">
												<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
											</span>
										</a>
									</td>
									<td align="center">
										<a href="javascript:void(0);" name="Find" title="Input Nilai" onClick="daftarnilai_input('<?php echo $pelajaran_view->pelajaran_id ?>','<?php echo $idtingkat ?>','<?php echo $idkelas ?>','<?php echo $semester_id ?>','<?php echo $iddasarpenilaian ?>','<?php echo $idtahunajaran ?>')"><img src="assets/img/plus.png" /></a>
									</td>
									<?php if( allowlvl("frmdaftarnilai") == 2) { ?>
										<td align="center">
											<a href="javascript:void(0);" name="Find" title="Input Nilai" onClick="daftarnilai_input_tingkat('<?php echo $pelajaran_view->pelajaran_id ?>','<?php echo $idtingkat ?>','<?php echo $idkelas ?>','<?php echo $semester_id ?>','<?php echo $iddasarpenilaian ?>','<?php echo $idtahunajaran ?>')"><img src="assets/img/plus.png" /></a>
										</td>
									<?php } else { ?>
										<td align="center" class="hide">
											
										</td>
									<?php } ?>
									
									<?php /*
	                                <td align="center">
	                                	<?php
	                                		if($countnilai > 0) {
	                                	?>
												<span class="green">
													<i class="ace-icon fa fa-check-square-o bigger-150"></i>
												</span>
										<?php
											} else {
										?>
												<span class="red">
													<i class="ace-icon fa fa-square-o bigger-150"></i>
												</span>
										<?php		
											}
	                                		
	                                	?>
	                                	<!--<a href="javascript:void(0);" name="Find" title="Detail Nilai" onClick="jadwal_input('<?php echo $hari ?>','<?php echo $idtingkat ?>','<?php echo $row_kelas_detail->replid ?>','<?php echo $idguru ?>','<?php echo $data_hari->replid ?>')"><img src="assets/img/plus.png" /></a>-->
	                                </td> */ ?>
	                                
								</tr>                        
                        <?php
								}
                            }
                        ?>
                        
				</tbody>
			</table>
		</div>
	</div>
</div>