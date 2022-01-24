<?php
	$departemen1 = $_POST["departemen1"];
?>
<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('daftarpustaka_view') ?>&mxKz=xm8r389xemx23xb2378e23&id="+id+" ";
		}
	}
</script>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					
					<div class="box">
						<div class="box-head">
							<h3>Filter</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="daftarpustaka_view" id="daftarpustaka_view" class="form-horizontal">
								<div>
									
									<table border="0">
										<tr>
											<td>Unit</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="departemen1" id="departemen1" class='cho' style="width:min-width:10px; height:27px; " >
													<option value="">...</option>
													<?php select_departemen($departemen1); ?>
												</select>
											</td>									
										</tr>
										
										<tr>
											<td colspan="3">
												<input type="submit" name="submit" class='btn btn-primary' value="Preview" >
											</td>											
										</tr>
										
									</table>
									
								</div>								
							</form>
						</div>	
					</div>
					
					
					<div class="box">
						<div class="box-head tabs">
							<h3>DAFTAR PUSTAKA</h3>	
							
													
						</div>
						
						<div class="box-content box-nomargin">
						
							<?php
								$delete = $_REQUEST['mxKz'];
								if ($delete == "xm8r389xemx23xb2378e23") {
									include 'class/class.delete.php';
									$delete2=new delete;
									$delete2->delete_daftarpustaka($_REQUEST['id']);
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
													<th style="font-weight:bold ">Kode Pustaka &nbsp;&nbsp;</th>	
													<th style="font-weight:bold ">Judul Pustaka &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Penulis &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Penerbit &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Status &nbsp;&nbsp;</th>
													<th style="font-weight:bold "></th>										
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													$sql=$select->list_daftarpustaka("", $departemen1);			
													
													while ($daftarpustaka_view=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
														
														$status = $daftarpustaka_view->status;
														if($status == 0) {
															$status = "Dipinjam";
															$background = 'background-color: #ff0000; color:#fff; text-align: center';
														}
														if($status == 1) {
															$status = "Tersedia";
															$background = 'background-color: #240ef1; color:#fff; text-align: center';
														}
																												
												?>
													
													<tr>														
														<td><?php echo $daftarpustaka_view->departemen ?></td>
														<td><?php echo $daftarpustaka_view->kodepustaka ?></td>
														<td><?php echo $daftarpustaka_view->judul ?></td>
														<td><?php echo $daftarpustaka_view->namapenulis ?></td>
														<td><?php echo $daftarpustaka_view->namapenerbit ?></td>
														<td style="<?php echo $background ?>" ><?php echo $status ?>&nbsp;</td>
														<td>
															
															<a class="label label-success" href="<?php echo obraxabrix('daftarpustaka') ?>/<?php echo $daftarpustaka_view->replid ?>" style="background-color: #46e916" >edit</a>
															
															
															<?php if (allowdel('frmdaftarpustaka')==1) { ?>
																&nbsp;&nbsp;
																<a class="label label-success" href="JavaScript:hapus('<?php echo $daftarpustaka_view->replid ?>')" style="background-color: #ff0000">hapus</i> 
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