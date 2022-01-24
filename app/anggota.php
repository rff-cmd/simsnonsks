<!--<script src="js/pindah.js"></script>-->

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='noregistrasi') {
			alert('No. Anggota tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='nama') {
			alert('Nama tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='alamat') {
			alert('Alamat tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='HP') {
			alert('No. HP tidak boleh kosong!');				
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

<?php

$ref = $segmen3;

?>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Anggota</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="anggota2" id="anggota2" class="form-horizontal" enctype="multipart/form-data" onSubmit="return cekinput('noregistrasi,nama,alamat,HP');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
																				
										$ref2 = notran(date('y-m-d'), 'frmanggota', '', '', ''); //---get no ref
										
										include("app/exec/insert_anggota.php"); 
										
										$departemen = $_SESSION["unit"];
										$tgldaftar	= date("d-m-Y");
										$aktif = "checked";
										
										if ($ref != "") {
											$sql=$select->list_anggota($ref);			
											$anggota_data=$sql->fetch(PDO::FETCH_OBJ);
											
											$ref2 = $anggota_data->noregistrasi;
											$tgldaftar = date("d-m-Y", strtotime($anggota_data->tgldaftar));
											
											//$departemen = $anggota_data->departemen;
											$aktif = $anggota_data->aktif;
											if($aktif == 1) {
												$aktif = "checked";
											} else {
												$aktif = "";
											}
											
										}	
										
									?>
									<table border="0">
										<input type="hidden" id="replid" name="replid" value="<?php echo $ref ?>" >
										
										<tr>
											<td>No Anggota *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="noregistrasi" id="noregistrasi" readonly="" style="width:110px; height:16px; " value="<?php echo $ref2 ?>"></td>
										</tr>
										
										<tr>
											<td>Nama *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="nama" id="nama" style="width:180px; height:16px; " value="<?php echo $anggota_data->nama ?>"></td>
										</tr>
										
										<tr>
											<td>Alamat *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><textarea name="alamat" id="alamat" class='span12 input-square' rows="3"><?php echo $anggota_data->alamat ?></textarea></td>
										</tr>
										
										<tr>
											<td>Kode Pos</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="kodepos" id="kodepos" style="width:80px; height:16px; " value="<?php echo $anggota_data->kodepos ?>"></td>
										</tr>
										
										<tr>
											<td>E-mail</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="email" id="email" style="width:180px; height:16px; " value="<?php echo $anggota_data->email ?>"></td>
										</tr>
										
										<tr>
											<td>Telepon</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="telpon" id="telpon" style="width:180px; height:16px; " value="<?php echo $anggota_data->telpon ?>"></td>
										</tr>
										
										<tr>
											<td>HP *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="HP" id="HP" style="width:180px; height:16px; " value="<?php echo $anggota_data->HP ?>"></td>
										</tr>
										
										<tr>
											<td>Pekerjaan</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="pekerjaan" id="pekerjaan" style="width:180px; height:16px; " value="<?php echo $anggota_data->pekerjaan ?>"></td>
										</tr>
										
										<tr>
											<td>Institusi</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="institusi" id="institusi" style="width:180px; height:16px; " value="<?php echo $anggota_data->institusi ?>"></td>
										</tr>
										
										<tr>
											<td>Keterangan</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><textarea name="keterangan" id="keterangan" class='span12 input-square' rows="3"><?php echo $anggota_data->keterangan ?></textarea></td>
										</tr>
										
										<tr>
											<td>Tanggal Daftar</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="tgldaftar" id="tgldaftar" class='datepick' style="width:180px; height:16px; " value="<?php echo $tgldaftar ?>"></td>
										</tr>
										
										<tr>
											<td>Photo</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<input type="file" id="foto" name="foto" >
												
												<?php if ($anggota_data->foto != "") { ?>
													<img src="app/file_foto_anggota/<?php echo $anggota_data->foto ?>" width="200" height="200" />
												<?php } ?>
												<input type="hidden" id="foto2" name="foto2" value="<?php echo $anggota_data->foto; ?>" >
											</td>
										</tr>
										
										<tr>
											<td>Aktif</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="checkbox" name="aktif" id="aktif" style="width:70px; height:16px; " value="1" <?php echo $aktif ?> ></td>	
										</tr>
										
										<tr>											
											<td colspan="4">
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
												<?php if (allowupd('frmanggota')==1) { ?>
													<?php if($ref!='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmanggota')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowdel('frmanggota')==1) { ?>		
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } ?>
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder .'/'. obraxabrix('anggota_view') ?>'" />
												
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