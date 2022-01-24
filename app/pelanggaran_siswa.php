<script type="text/javascript" src="js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='tanggal') {
			alert('Tanggal tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='idtingkat') {
			alert('Tingkat tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='idkelas') {
			alert('Kelas tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='idsiswa') {
			alert('Siswa tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='idjenis_pelanggaran') {
			alert('Jenis Pelanggaran tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='kejadian') {
			alert('Kejadian tidak boleh kosong!');				
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
							<h3>Pelanggaran Siswa</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="pelanggaran_siswa2" id="pelanggaran_siswa2" class="form-horizontal" enctype="multipart/form-data" onSubmit="return cekinput('tanggal,idtingkat,idkelas,idsiswa,idjenis_pelanggaran,kejadian');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
										
										$ref2 = notran(date('y-m-d'), 'frmpelanggaran_siswa', '', '', ''); //---get no ref										
										include("app/exec/insert_pelanggaran_siswa.php"); 
										
										$tanggal	= date("d-m-Y");
										if ($ref != "") {
											$sql=$select->list_pelanggaran_siswa($ref);			
											$pelanggaran_siswa_data=$sql->fetch(PDO::FETCH_OBJ);
											
											$ref2		=	$pelanggaran_siswa_data->ref;
											$tanggal	=	date("d-m-Y", strtotime($pelanggaran_siswa_data->tanggal));
											
										}	
										
									?>
									<table class="table" border="0">
										<input type="hidden" id="ref" name="ref" value="<?php echo $ref2 ?>" >
										
										<tr>
											<td>Ref. *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="ref" id="ref" style="min-width: 178px;" readonly value="<?php echo $ref2; ?>" ></td>
										</tr>
										
										<tr>
											<td>Tanggal *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="tanggal" class='datepick' id="tanggal" style="" value="<?php echo $tanggal ?>"></td>
										</tr>
										
										<tr>
											<td>Tingkat *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="idtingkat" id="idtingkat" style="min-width: 178px;  font-size:12px; padding:0px; " onClick="loadHTMLPost2('app/pelanggaran_siswa_ajax.php','idkelas','getkelas','idtingkat')" />
													<option value=""></option>
													<?php select_tingkat($pelanggaran_siswa_data->idtingkat); ?>
												</select>
											</td>	
										</tr>	
										
										<tr>
											<td>Kelas *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="idkelas" id="idkelas" style="min-width: 178px;  font-size:12px; padding:0px; " onClick="loadHTMLPost2('app/pelanggaran_siswa_ajax.php','idsiswa','getsiswa','idkelas')" />
													<option value=""></option>
													<?php select_kelas($pelanggaran_siswa_data->idtingkat, $pelanggaran_siswa_data->idkelas); ?>
												</select>
											</td>
										</tr>									
										<tr>
											<td>NIS *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="idsiswa" id="idsiswa" style="min-width: 178px; height:27px; " />
													<option value=""></option>
													<?php select_siswa($pelanggaran_siswa_data->idkelas, $pelanggaran_siswa_data->idsiswa); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Pelanggaran *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="idjenis_pelanggaran" id="idjenis_pelanggaran" style="min-width: 178px; height:27px; " />
													<option value=""></option>
													<?php select_jenis_pelanggaran($pelanggaran_siswa_data->idjenis_pelanggaran); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Kejadian *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><textarea name="kejadian" id="kejadian" class='span12 input-square' rows="3"><?php echo $pelanggaran_siswa_data->kejadian ?></textarea></td>
										</tr>
										
										<tr>
											<td>Hukuman</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><textarea name="hukuman" id="hukuman" class='span12 input-square' rows="3"><?php echo $pelanggaran_siswa_data->hukuman ?></textarea></td>
										</tr>
										
										<tr>
											<td>Photo Pelanggaran</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<input type="file" id="photo" name="photo" >
												
												<?php if ($pelanggaran_siswa_data->photo != "") { ?>
													<img src="app/file_foto_pelanggaran/<?php echo $pelanggaran_siswa_data->photo ?>" width="200" height="200" />
												<?php } ?>
												<input type="hidden" id="photo2" name="photo2" value="<?php echo $pelanggaran_siswa_data->photo; ?>" >
											</td>
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
												<?php if (allowupd('frmpelanggaran_siswa')==1) { ?>
													<?php if($ref!='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmpelanggaran_siswa')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowdel('frmpelanggaran_siswa')==1) { ?>		
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } ?>
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . '/'  . obraxabrix('pelanggaran_siswa_view') ?>'" />
												
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