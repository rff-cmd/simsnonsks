<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('konseling_siswa_view') ?>&mxKz=xm8r389xemx23xb2378e23&id="+id+" ";
		}
	}
</script>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					
					
					<div class="box">
						<div class="box-head tabs">
							<h3>DAFTAR KONSELING SISWA</h3>	
							
													
						</div>
						
						<div class="box-content box-nomargin">
						
							<?php
								$delete = $_REQUEST['mxKz'];
								if ($delete == "xm8r389xemx23xb2378e23") {
									include 'class/class.delete.php';
									$delete2=new delete;
									$delete2->delete_konseling_siswa($_REQUEST['id']);
							?>
									<div class="alert alert-success">
										<strong>Delete Data successfully</strong>
									</div>
							<?php
								}
							?>


							<div class="tab-content">
									<div class="tab-pane active" id="basic">
										<div style="overflow:auto; ">
										
										<table class="table" class='table table-striped dataTable table-bordered' style="font-size:11px; ">
											<thead>
												<tr>													
													<th style="font-weight:bold ">Unit &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Ref. &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Tanggal &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">NIS &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Nama &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Level-Kelas &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Jenis Konseling &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Download File &nbsp;&nbsp;</th>
													<th style="font-weight:bold "></th>										
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													$sql=$select->list_konseling_siswa();			
													
													while ($konseling_siswa_view=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
														
														$kelas = $konseling_siswa_view->tingkat . "-" . $konseling_siswa_view->kelas;
														$tanggal = date("d-m-Y", strtotime($konseling_siswa_view->tanggal));
														if($konseling_siswa_view->idjenis_konseling == 0) {
															$jenis_konseling = "Kasus";
														}
														if($konseling_siswa_view->idjenis_konseling == 1) {
															$jenis_konseling = "Prestasi";
														}
																												
												?>
													
													<tr>					
														<td><?php echo $konseling_siswa_view->departemen ?></td>
														<td><?php echo $konseling_siswa_view->ref ?></td>								
														<td><?php echo $tanggal ?></td>	
														<td><?php echo $konseling_siswa_view->nis ?></td>
														<td><?php echo $konseling_siswa_view->nama ?></td>
														<td><?php echo $kelas ?></td>
														<td><?php echo $jenis_konseling ?></td>
														<td>
															<?php if($konseling_siswa_view->data_file != "") { ?>
																<a class="label label-success" href="app/konseling_siswa_download.php?ref=<?php echo $konseling_siswa_view->ref ?>" target="_blank" title="Download">Download
																</a>
															<?php } ?>
														</td>
														<td>
															
															<a class="label label-success" href="main.php?menu=app&act=<?php echo obraxabrix('konseling_siswa') ?>&search=<?php echo $konseling_siswa_view->ref ?>" style="background-color: #46e916" >edit</a>
															
															
															<?php if (allowdel('frmkonseling_siswa')==1) { ?>
																&nbsp;&nbsp;
																<a class="label label-success" href="JavaScript:hapus('<?php echo $konseling_siswa_view->ref ?>')" style="background-color: #ff0000">hapus</i> 
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