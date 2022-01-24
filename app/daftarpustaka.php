<script type="text/javascript" src="js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  //departemen,pustaka,kodepustaka
		  if (document.getElementById(arrf[i]).name=='departemen') {
			alert('Unit tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='pustaka') {
			alert('Pustaka tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='kodepustaka') {
			alert('Kode Pustaka tidak boleh kosong!');				
		  }
		  
		  return false
		} 
										
	  }		 
	}	
</script>

<script>
	function formatangka(field) {
		 //a = rci.amt.value;	 
		 a = document.getElementById(field).value;
		 //alert(a);
		 b = a.replace(/[^\d-.]/g,""); //b = a.replace(/[^\d]/g,"");
		 c = "";
		 panjang = b.length;
		 j = 0;
		 for (i = panjang; i > 0; i--)
		 {
			 j = j + 1;
			 if (((j % 3) == 1) && (j != 1))
			 {
			 	c = b.substr(i-1,1) + "," + c;
			 } else {
			 	c = b.substr(i-1,1) + c;
			 }
		 }
		 //rci.amt.value = c;
		 c = c.replace(",.",".");
		 c = c.replace(".,",".");
		 document.getElementById(field).value = c;		
		 
	}
</script>

<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost2(URL, destination, button, getId){
		
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;		
		//str ='pchordnbr2='+ document.getElementById('pchordnbr2').value;
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
	
	
	function loadHTMLPost3(URL, destination, button, getId, getId2){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;
		str2 = getId2 + '=' + document.getElementById(getId2).value;
		
		var str = str + '&button=' + button;
		/*var str2 = str2 + '&button=' + button;
		var str3 = str3 + '&button=' + button;
		var str4 = str4 + '&button=' + button;*/
		var str = str + '&' + str2;
			
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

?>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Daftar Pustaka</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="daftarpustaka2" id="daftarpustaka2" class="form-horizontal" enctype="multipart/form-data" onSubmit="return cekinput('departemen,pustaka,kodepustaka');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
																				
										include("app/exec/insert_daftarpustaka.php"); 
										
										$departemen = $_SESSION["unit"];
										$jumlah = 1;
										
										$ts = date("d-m-Y H:i:s");
										
										if ($ref != "") {
											$sql=$select->list_daftarpustaka($ref);			
											$daftarpustaka_data=$sql->fetch(PDO::FETCH_OBJ);
											
											$ref2 = $daftarpustaka_data->replid;
											$departemen = $daftarpustaka_data->departemen;
											$ts = date("d-m-Y H:i:s", strtotime($daftarpustaka_data->ts));
											
										}	
										
									?>
									<table border="0" cellpadding="5">
										<input type="hidden" id="id" name="id" value="<?php echo $ref2 ?>" >
										
										<tr>
											<td>Unit *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="departemen" id="departemen" class='cho' style="width:min-width:10px; height:27px; " onchange="loadHTMLPost2('app/daftarpustaka_ajax.php','pustaka_id','getpustaka','departemen')" >
													<option value="">...</option>
													<?php select_departemen($departemen); ?>
												</select>
											</td>
																	
										</tr>
										
										<tr>
											<td>Pustaka *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td id="pustaka_id">
												<select name="pustaka" id="pustaka" class='cho' style="width:min-width:10px; height:27px; " >
													<option value="">...</option>
													<?php select_pustaka($departemen, $daftarpustaka_data->pustaka); ?>
												</select>
											</td>
																	
										</tr>
										
										<tr>
											<td>Kode Pustaka *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td id="kodepustaka_id"><input type="text" name="kodepustaka" id="kodepustaka" style="width:250px; height:16px; " onblur="loadHTMLPost3('app/daftarpustaka_ajax.php','kodepustaka_id','cekkodepustaka','id','kodepustaka')" value="<?php echo $daftarpustaka_data->kodepustaka ?>"></td>
											
										</tr>
										
										<tr>
											<td>Status</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="status" id="status" class='cho' style="width:auto; height:27px; min-width:100px ">
													<?php select_status_daftarpustaka($daftarpustaka_data->status); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Diupdate Tanggal</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="ts" id="ts" readonly="" style="width:250px; height:16px; " value="<?php echo $ts ?>"></td>
										</tr>
																					
										<tr>											
											<td colspan="5">
												&nbsp;
											</td>
													
										</tr>
										
										
									</table>
									
									
									<table>
										<tr>
											<td colspan="3">&nbsp;&nbsp;</td>								
										</tr>
										
										<tr>											
											<td colspan="3">
												<?php if (allowupd('frmdaftarpustaka')==1) { ?>
													<?php if($ref!='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmdaftarpustaka')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowdel('frmdaftarpustaka')==1) { ?>		
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } ?>
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder .'/'. obraxabrix('daftarpustaka_view') ?>'" />
												
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