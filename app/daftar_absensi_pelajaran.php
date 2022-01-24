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
						<th style="font-weight:bold ">Kelompok &nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Keterangan &nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Tampilkan &nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Download &nbsp;&nbsp;</th>
						
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
						$sql=$select->get_kartu_rencana_studi_absensi('', '', $idtingkat, $semester_id, $peminatan, $idtahunajaran, $idminat);
			            while($pelajaran_view=$sql->fetch(PDO::FETCH_OBJ)){
						
							$sifat = $pelajaran_view->kelompok_pelajaran;
							
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
									<td><?php echo $pelajaran_view->keterangan ?></td>
									<td align="center">
										<a href="javascript:void(0);" name="Find" title="Tampilkan Absensi" onClick="daftar_absensi('<?php echo $pelajaran_view->pelajaran_id ?>')"><img src="assets/img/plus.png" /></a>
									</td>
									<td align="center">
										<a href="JavaScript:export_excel('<?php echo $siswa_krs_view->nis ?>')">
											<img src="assets/img/excel.jpg" height="16" width="16" />
										</a>
									</td>
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