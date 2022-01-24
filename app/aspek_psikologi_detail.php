<script type="text/javascript" src="js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='aspek') {
			alert('Aspek Psikologi tidak boleh kosong!');				
		  }
		  if (document.getElementById(arrf[i]).name=='jenis_aspek_id') {
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

<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost2(URL, destination, button, getId){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;
		
		var str = str + '&button=' + button;
			
		if (window.XMLHttpRequest){
			request = new XMLHttpRequest();
			request.onreadystatechange = processStateChange;
			request.open("POST", URL, true);
			request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
			request.send(str);		
		} else if (window.ActiveXObject) {
			request = new ActiveXObject("Microsoft.XMLHTTP");
			if (request) {
				request.onreadystatechange = processStateChange;
				request.open("POST", URL, true);
				request.send();
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
							<h3>Jenis Aspek Psikologi Detail</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="aspek_psikologi_detail" id="aspek_psikologi_detail" class="form-horizontal" onSubmit="return cekinput('departemen,jenis_aspek_id,aspek');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
																				
										include("app/exec/insert_aspek_psikologi_detail.php"); 
										
										$aktif = "checked";
										if ($ref != "") {
											$sql=$select->list_aspek_psikologi_detail($ref);			
											$aspek_psikologi_detail_data=$sql->fetch(PDO::FETCH_OBJ);
											
											if ($aspek_psikologi_detail_data->aktif == 1) {
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
												<select name="departemen" id="departemen" class='cho' style="min-width: 178px; height:27px; " onchange="loadHTMLPost2('app/aspek_psikologi_detail_ajax.php','departemen_id','cekjenis','departemen')" >
													<option value="">...</option>
													<?php select_departemen($aspek_psikologi_detail_data->departemen); ?>
												</select>
											</td>
																	
										</tr>
										
										<tr>
											<td>Jenis Aspek Psikologi *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td id="departemen_id">
												<select name="jenis_aspek_id" id="jenis_aspek_id" class='cho' style="min-width: 178px; height:27px; " >
													<option value="">...</option>
													<?php select_aspek_psikologi($aspek_psikologi_detail_data->departemen, $aspek_psikologi_detail_data->jenis_aspek_id); ?>
												</select>
											</td>
																	
										</tr>
										
										<tr>
											<td>Aspek Psikologi Detail *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="aspek" id="aspek" style="width:250px;  " value="<?php echo $aspek_psikologi_detail_data->aspek ?>"></td>
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
												<?php if (allowupd('frmaspek_psikologi_detail')==1) { ?>
													<?php if($ref!='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmaspek_psikologi_detail')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowdel('frmaspek_psikologi_detail')==1) { ?>		
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } ?>
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . '/'  . obraxabrix('aspek_psikologi_detail_view') ?>'" />
												
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