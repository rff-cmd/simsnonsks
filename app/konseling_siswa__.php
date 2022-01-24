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
		  
		  if (document.getElementById(arrf[i]).name=='idjenis_konseling') {
			alert('Jenis Konseling tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='konseling') {
			alert('Konseling tidak boleh kosong!');				
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
							<h3>Konseling Siswa</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="konseling_siswa2" id="konseling_siswa2" class="form-horizontal" enctype="multipart/form-data" onSubmit="return cekinput('tanggal,idtingkat,idkelas,idsiswa,idjenis_konseling,konseling');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
										
										$ref2 = notran(date('y-m-d'), 'frmkonseling_siswa', '', '', ''); //---get no ref										
										include("app/exec/insert_konseling_siswa.php"); 
										
										$tanggal	= date("d-m-Y");
										if ($ref != "") {
											$sql=$select->list_konseling_siswa($ref);			
											$konseling_siswa_data=$sql->fetch(PDO::FETCH_OBJ);
											
											$ref2		=	$konseling_siswa_data->ref;
											$tanggal	=	date("d-m-Y", strtotime($konseling_siswa_data->tanggal));
											
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
												<select name="idtingkat" id="idtingkat" style="min-width: 178px;  font-size:12px; padding:0px; " onClick="loadHTMLPost2('app/konseling_siswa_ajax.php','idkelas','getkelas','idtingkat')" />
													<option value=""></option>
													<?php select_tingkat($konseling_siswa_data->idtingkat); ?>
												</select>
											</td>	
										</tr>	
										
										<tr>
											<td>Kelas *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="idkelas" id="idkelas" style="min-width: 178px;  font-size:12px; padding:0px; " onClick="loadHTMLPost2('app/konseling_siswa_ajax.php','idsiswa','getsiswa','idkelas')" />
													<option value=""></option>
													<?php select_kelas($konseling_siswa_data->idtingkat, $konseling_siswa_data->idkelas); ?>
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
													<?php select_siswa($konseling_siswa_data->idkelas, $konseling_siswa_data->idsiswa); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Jenis Konseling *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="idjenis_konseling" id="idjenis_konseling" style="min-width: 178px; height:27px; " />
													<option value=""></option>
													<?php select_jenis_konseling($konseling_siswa_data->idjenis_konseling); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Konseling *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><textarea name="konseling" id="konseling" class='span12 input-square' rows="3"><?php echo $konseling_siswa_data->konseling ?></textarea></td>
										</tr>
										
										<tr>
											<td>Solusi</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><textarea name="solusi" id="solusi" class='span12 input-square' rows="3"><?php echo $konseling_siswa_data->solusi ?></textarea></td>
										</tr>
										
										<tr>
											<td>Petugas BK</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="nip" id="nip" style="min-width: 178px; height:27px; " />
													<option value=""></option>
													<?php select_pegawai($konseling_siswa_data->nip); ?>
												</select>
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
												<?php if (allowupd('frmkonseling_siswa')==1) { ?>
													<?php if($ref!='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmkonseling_siswa')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowdel('frmkonseling_siswa')==1) { ?>		
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } ?>
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . '/'  . obraxabrix('konseling_siswa_view') ?>'" />
												
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