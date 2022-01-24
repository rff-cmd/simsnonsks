<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('aspek_psikologi_detail_view') ?>&mxKz=xm8r389xemx23xb2378e23&id="+id+" ";
		}
	}
</script>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					
					
					<div class="box">
						<div class="box-head tabs">
							<h3>DAFTAR ASPEK PSIKOLOGI DETAIL</h3>	
							
													
						</div>
						
						<div class="box-content box-nomargin">
						
							<?php
								$delete = $_REQUEST['mxKz'];
								if ($delete == "xm8r389xemx23xb2378e23") {
									include 'class/class.delete.php';
									$delete2=new delete;
									$delete2->delete_aspek_psikologi_detail($_REQUEST['id']);
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
										
										<table class='table table-striped dataTable table-bordered' style="font-size:11px; ">
											<thead>
												<tr>
													<th style="font-weight:bold ">Unit &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Jenis Aspek Psikologi &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Aspek Psikologi &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Aktif &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">User ID &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Date Last Update &nbsp;&nbsp;</th>
													<th style="font-weight:bold "></th>										
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													$sql=$select->list_aspek_psikologi_detail();			
													
													while ($aspek_psikologi_detail_view=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
														
												?>
													
													<tr>
														<td><?php echo $aspek_psikologi_detail_view->departemen ?></td>
														<td><?php echo $aspek_psikologi_detail_view->jenis_aspek ?></td>
														<td><?php echo $aspek_psikologi_detail_view->aspek ?></td>
														<td style="text-align: center">
															<?php if ($aspek_psikologi_detail_view->aktif == 1) { ?>
																<img src="<?php echo $__folder ?>assets/img/check.png" />
															<?php } else { ?>
																<img src="<?php echo $__folder ?>assets/img/icons/essen/16/busy.png" />
															<?php } ?>
														</td>
														<td><?php echo $aspek_psikologi_detail_view->uid ?></td>
														<td><?php echo $aspek_psikologi_detail_view->dlu ?></td>
														<td>
															
															<a class="label label-success" href="main.php?menu=app&act=<?php echo obraxabrix('aspek_psikologi_detail') ?>&search=<?php echo $aspek_psikologi_detail_view->replid ?>" style="background-color: #46e916" >edit</a>
															
															
															<?php if (allowdel('frmaspek_psikologi_detail')==1) { ?>
																&nbsp;&nbsp;
																<a class="label label-success" href="JavaScript:hapus('<?php echo $aspek_psikologi_detail_view->replid ?>')" style="background-color: #ff0000">hapus</i> 
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