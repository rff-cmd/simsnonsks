<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('izin_siswa_view') ?>&mxKz=xm8r389xemx23xb2378e23&id="+id+" ";
		}
	}
</script>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					
					
					<div class="box">
						<div class="box-head tabs">
							<h3>DAFTAR IZIN SISWA</h3>	
							
													
						</div>
						
						<div class="box-content box-nomargin">
						
							<?php
								$delete = $_REQUEST['mxKz'];
								if ($delete == "xm8r389xemx23xb2378e23") {
									include 'class/class.delete.php';
									$delete2=new delete;
									$delete2->delete_izin_siswa($_REQUEST['id']);
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
                                                    <th style="font-weight:bold ">Tanggal &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">NIS &nbsp;&nbsp;</th>
                                                    <th style="font-weight:bold ">Nama &nbsp;&nbsp;</th>
                                                    <th style="font-weight:bold ">Kelas &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Keterangan &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Status &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Petugas &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Date Last Update &nbsp;&nbsp;</th>
													<th style="font-weight:bold "></th>										
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													$sql=$select->list_izin_siswa();			
													
													while ($izin_siswa_view=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
                                                        
                                                        $kelas      =    $izin_siswa_view->tingkat . "-" . $izin_siswa_view->kelas;
                                                        $tanggal    =    date("d-m-Y H:i", strtotime($izin_siswa_view->tanggal));
														
												?>
													
													<tr>
                                                        <td><?php echo $tanggal ?></td>
                                                        <td><?php echo $izin_siswa_view->nis ?></td>
														<td><?php echo $izin_siswa_view->nama_siswa ?></td>
                                                        <td><?php echo $kelas ?></td>
														<td><?php echo $izin_siswa_view->keterangan ?></td>
                                                        <td><?php echo $izin_siswa_view->status ?></td>
														<td><?php echo $izin_siswa_view->nama_pegawai ?></td>
														<td><?php echo $izin_siswa_view->dlu ?></td>
														<td>
															
															<a class="label label-success" href="main.php?menu=app&act=<?php echo obraxabrix('izin_siswa') ?>&search=<?php echo $izin_siswa_view->replid ?>" style="background-color: #46e916" >edit</a>
															
															
															<?php if (allowdel('frmizin_siswa')==1) { ?>
																&nbsp;&nbsp;
																<a class="label label-success" href="JavaScript:hapus('<?php echo $izin_siswa_view->replid ?>')" style="background-color: #ff0000">hapus</i> 
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