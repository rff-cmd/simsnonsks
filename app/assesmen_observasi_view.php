<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('assesmen_observasi_view') ?>&mxKz=xm8r389xemx23xb2378e23&id="+id+" ";
		}
	}
</script>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					
					
					<div class="box">
						<div class="box-head tabs">
							<h3>DAFTAR ASSESMEN & OBSERVASI</h3>	
							
													
						</div>
						
						<div class="box-content box-nomargin">
						
							<?php
								$delete = $_REQUEST['mxKz'];
								if ($delete == "xm8r389xemx23xb2378e23") {
									include 'class/class.delete.php';
									$delete2=new delete;
									$delete2->delete_assesmen_observasi($_REQUEST['id']);
							?>
									<div class="alert alert-success">
										<strong>Delete Data successfully</strong>
									</div>
							<?php
								}
							?>


							<div class="tab-content">
									<?php if (allowadd('frmassesmen_observasi')==1) { ?>
										<div style="margin-left: 5px; margin-top: 5px; margin-bottom: 5px">
											<input type="button" name="submit" id="submit" class="btn btn-primary" value="Tambah Data" onclick="self.location='<?php echo $nama_folder . '/'  . obraxabrix('assesmen_observasi') ?>'" />
												
										</div>
									<?php } ?>
									
									<div class="tab-pane active" id="basic">
										<div style="overflow:auto; ">
										
										<table class='table table-striped dataTable table-bordered' style="font-size:11px; ">
											<thead>
												<tr>
													<th style="font-weight:bold ">Unit &nbsp;&nbsp;</th>
                                                    <th style="font-weight:bold ">Ref &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Tanggal &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">NIS &nbsp;&nbsp;</th>
                                                    <th style="font-weight:bold ">Nama &nbsp;&nbsp;</th>
                                                    <th style="font-weight:bold ">Level-Kelas &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Download File &nbsp;&nbsp;</th>
													<!--<th style="font-weight:bold ">Supporting Teacher &nbsp;&nbsp;</th>-->
													<!--<th style="font-weight:bold ">User ID &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Date Last Update &nbsp;&nbsp;</th>-->
													<th style="font-weight:bold "></th>										
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													$sql=$select->list_assesmen_observasi();			
													
													while ($assesmen_observasi_view=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
                                                        
                                                        $kelas      =    $assesmen_observasi_view->tingkat . "-" . $assesmen_observasi_view->kelas;
                                                        $tanggal    =    date("d-m-Y", strtotime($assesmen_observasi_view->tanggal));
														
												?>
													
													<tr>
														<td><?php echo $assesmen_observasi_view->departemen ?></td>
														<td><?php echo $assesmen_observasi_view->ref ?></td>
                                                        <td><?php echo $tanggal ?></td>
                                                        <td><?php echo $assesmen_observasi_view->nis ?></td>
														<td><?php echo $assesmen_observasi_view->nama_siswa ?></td>
                                                        <td><?php echo $kelas ?></td>
														<td>
															<?php if($assesmen_observasi_view->data_file != "") { ?>
																<a class="label label-success" href="app/assesmen_observasi_download.php?ref=<?php echo $assesmen_observasi_view->ref ?>" target="_blank" title="Download">Download
																</a>
															<?php } ?>
														</td>
                                                        <!--<td><?php echo $assesmen_observasi_view->pegawai1 ?></td>-->
														<!--<td><?php echo $assesmen_observasi_view->uid ?></td>
														<td><?php echo $assesmen_observasi_view->dlu ?></td>-->
														<td>
															
															<a class="label label-success" href="main.php?menu=app&act=<?php echo obraxabrix('assesmen_observasi') ?>&search=<?php echo $assesmen_observasi_view->ref ?>" style="background-color: #46e916" >edit</a>
															
															
															<?php if (allowdel('frmassesmen_observasi')==1) { ?>
																&nbsp;&nbsp;
																<a class="label label-success" href="JavaScript:hapus('<?php echo $assesmen_observasi_view->ref ?>')" style="background-color: #ff0000">hapus</i> 
																</a>
															<?php } ?>
														</td>
														
													</tr>
																										
												<?php
												}
												?>
												
												
											</tbody>
											
										</table>									
										
										
										</div>
										
										
										<br>
									</div>
							</div>
						</div>
						
				</div>
			</div>

		</div>
	</div>
</div>