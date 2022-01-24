<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='aspek') {
			alert('Jenis Aspek Psikologi tidak boleh kosong!');				
		  }
		  if (document.getElementById(arrf[i]).name=='departemen') {
			alert('Unit tidak boleh kosong!');				
		  }
		  
		  return false
		} 
										
	  }		 
	}	
	
</script>

<?php

$ref = $segmen3;
if (isset($_GET['search'])) {
	$ref = $_GET['search'];
}
?>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Jenis Aspek Psikologi</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="aspek_psikologi" id="aspek_psikologi" class="form-horizontal" onSubmit="return cekinput('departemen,aspek');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
																				
										include("app/exec/insert_aspek_psikologi.php"); 
										
										$aktif = "checked";
										if ($ref != "") {
											$sql=$select->list_aspek_psikologi($ref);			
											$aspek_psikologi_data=$sql->fetch(PDO::FETCH_OBJ);
											
											if ($aspek_psikologi_data->aktif == 1) {
												$aktif = "checked";
											} else {
												$aktif = "";
											}
											
										}	
										
									?>
									<table class="table">
										<input type="hidden" id="replid" name="replid" value="<?php echo $ref ?>" >
										
										<tr>
											<td>Unit *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="departemen" id="departemen" class='cho' style="min-width: 178px; height:27px; " >
													<option value="">...</option>
													<?php select_departemen($aspek_psikologi_data->departemen); ?>
												</select>
											</td>
																	
										</tr>
										
										<tr>
											<td>Aspek Psikologi *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="aspek" id="aspek" style="width:250px;  " value="<?php echo $aspek_psikologi_data->aspek ?>"></td>
										</tr>
																				
										<tr>
											<td>Aktif</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="checkbox" name="aktif" id="aktif" style="min-width: 178px;  " value="1" <?php echo $aktif ?> ></td>	
										</tr>
										
										<tr>
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>									
										</tr>
										
									</table>
									
									
									<table>
										<tr>
											<td colspan="3">&nbsp;&nbsp;</td>								
										</tr>
										
										<tr>											
											<td colspan="3">
												<?php if (allowupd('frmaspek_psikologi')==1) { ?>
													<?php if($ref!='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmaspek_psikologi')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowdel('frmaspek_psikologi')==1) { ?>		
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } ?>
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . '/'  . obraxabrix('aspek_psikologi_view') ?>'" />
												
											</td>
													
										</tr>
									</table>
									
								</div>								
							
						</div>	
						
								
										
						
						
						</form>
						
						<!--------------end Detail------------------ -->
					</div>
					
			</div>

		</div>
	</div>
</div>