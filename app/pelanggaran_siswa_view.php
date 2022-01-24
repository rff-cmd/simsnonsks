<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('pelanggaran_siswa_view') ?>&mxKz=xm8r389xemx23xb2378e23&id="+id+" ";
		}
	}
</script>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					
					
					<div class="box">
						<div class="box-head tabs">
							<h3>DAFTAR PELANGGARAN SISWA</h3>	
							
													
						</div>
						
						<div class="box-content box-nomargin">
						
							<?php
								$delete = $_REQUEST['mxKz'];
								if ($delete == "xm8r389xemx23xb2378e23") {
									include 'class/class.delete.php';
									$delete2=new delete;
									$delete2->delete_pelanggaran_siswa($_REQUEST['id']);
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
													<th style="font-weight:bold ">NIS &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Nama &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Kelas &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Kejadian &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Hukuman &nbsp;&nbsp;</th>
													<th style="font-weight:bold "></th>										
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													$sql=$select->list_pelanggaran_siswa();			
													
													while ($pelanggaran_siswa_view=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
														
														$kelas = $pelanggaran_siswa_view->tingkat . "-" . $pelanggaran_siswa_view->kelas;
																												
												?>
													
													<tr>														
														<td><?php echo $pelanggaran_siswa_view->nis ?></td>
														<td><?php echo $pelanggaran_siswa_view->nama ?></td>
														<td><?php echo $kelas ?></td>
														<td><?php echo $pelanggaran_siswa_view->kejadian ?></td>
														<td><?php echo $pelanggaran_siswa_view->hukuman ?></td>
														<td>
															
															<a class="label label-success" href="main.php?menu=app&act=<?php echo obraxabrix('pelanggaran_siswa') ?>&search=<?php echo $pelanggaran_siswa_view->ref ?>" style="background-color: #46e916" >edit</a>
															
															
															<?php if (allowdel('frmpelanggaran_siswa')==1) { ?>
																&nbsp;&nbsp;
																<a class="label label-success" href="JavaScript:hapus('<?php echo $pelanggaran_siswa_view->ref ?>')" style="background-color: #ff0000">hapus</i> 
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