<script type="text/javascript" src="js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='tanggal') {
			alert('Tanggal tidak boleh kosong!');
		  }
		  if (document.getElementById(arrf[i]).name=='nis') {
			alert('Nama Siswa tidak boleh kosong!');				
		  }          
          if (document.getElementById(arrf[i]).name=='departemen') {
			alert('Unit tidak boleh kosong!');				
		  }
          if (document.getElementById(arrf[i]).name=='idtingkat') {
			alert('Level tidak boleh kosong!');				
		  }
		  if (document.getElementById(arrf[i]).name=='idkelas') {
			alert('Kelas tidak boleh kosong!');				
		  }
          if (document.getElementById(arrf[i]).name=='idpegawai') {
			alert('Orthopaedagog tidak boleh kosong!');				
		  }
          if (document.getElementById(arrf[i]).name=='idpegawai1') {
			alert('Supporting Teacher tidak boleh kosong!');				
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
							<h3>Hasil Assesmen dan Observasi</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="assesmen_observasi" id="assesmen_observasi" class="form-horizontal" onSubmit="return cekinput('tanggal,departemen,idtingkat,idkelas,nis,idpegawai,idpegawai1');" enctype="multipart/form-data" >
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
										
										$ref2 = notran(date('y-m-d'), 'frmassesmen_observasi', '', '', ''); //---get no ref										
										include("app/exec/insert_assesmen_observasi.php"); 
										
										$tanggal = date("d-m-Y");
                                        $jam = date("H");
                                        $menit = date("i");
										if ($ref != "") {
											$sql=$select->list_assesmen_observasi($ref);			
											$assesmen_observasi_data=$sql->fetch(PDO::FETCH_OBJ);
											
											$ref2 	= $assesmen_observasi_data->ref;
											$tanggal = date("d-m-Y", strtotime($assesmen_observasi_data->tanggal));
                                          
										}	
										
									?>
									<table class="table">
										<input type="hidden" id="ref" name="ref" value="<?php echo $ref ?>" >
										
										<tr>
											<td width="20%">Ref *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td width="30%">
												<input type="text" name="ref2" id="ref2" style="width:130px;  " readonly="" value="<?php echo $ref2 ?>">
											</td>
											
											<td>&nbsp;&nbsp;</td>
											
											<td width="20%">Tanggal *)</td>
											<td>&nbsp;&nbsp;</td>
                                            <td>:</td>
											<td width="30%"><input type="text" name="tanggal" class='datepick' id="tanggal" style="min-width: 178px;  " value="<?php echo $tanggal ?>"></td>
											
										</tr>
										
										<tr>
											<td>Unit *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="departemen" id="departemen" class="cho" style="width:100px;   font-size:12px; padding:0px; " onchange="loadHTMLPost2('app/assesmen_observasi_ajax.php','idtingkat','gettingkat','departemen')" />
													<option value="">...</option>
													<?php select_departemen($assesmen_observasi_data->departemen); ?>
												</select>
											</td>	
											
											<td>&nbsp;&nbsp;</td>
											
											<td>Level *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="idtingkat" id="idtingkat" style="width:100px;  height:27px; font-size:12px; padding:0px; " onchange="loadHTMLPost2('app/assesmen_observasi_ajax.php','idkelas','getkelas','idtingkat')" />
													<option value="">...</option>
													<?php select_tingkat_unit($assesmen_observasi_data->departemen, $assesmen_observasi_data->idtingkat); ?>
												</select>
											</td>
										</tr>
																				
										<tr>
											<td>Kelas *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="idkelas" id="idkelas" style="width:auto; height:27px; font-size:12px; padding:0px; " onClick="loadHTMLPost2('app/assesmen_observasi_ajax.php','idsiswa','getsiswa','idkelas')" />
													<option value="">...</option>
													<?php select_kelas($assesmen_observasi_data->idtingkat, $assesmen_observasi_data->idkelas); ?>
												</select>
											</td>
											
											<td colspan="5">&nbsp;&nbsp;</td>
											
										</tr>	
										
										<tr>
											<td>NIS *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td colspan="5">
												<select name="idsiswa" id="idsiswa" style="width:auto; height:27px; " onchange="loadHTMLPost2('app/assesmen_observasi_ajax.php','siswa_id','getdatasiswa','idsiswa')" />
													<option value="">...</option>
													<?php select_siswa($assesmen_observasi_data->idkelas, $assesmen_observasi_data->idsiswa); ?>
												</select>
											</td>
											
										</tr>
										
										<tr id="siswa_id">
											<td colspan="9">
												<table class="table">
													<tr>
														<td width="20%">Nama Panggilan</td>
														<td>&nbsp;&nbsp;</td>
														<td>:</td>
														<td width="30%"><?php echo $assesmen_observasi_data->panggilan ?></td>
														
														<td>&nbsp;&nbsp;</td>
														
														<td width="20%">Tempat, Tanggal Lahir</td>
														<td>&nbsp;&nbsp;</td>
														<td>:</td>
														<td width="30%">
															<?php echo $assesmen_observasi_data->tmplahir ?>, <?php echo $assesmen_observasi_data->tgllahir ?>
														</td>											
													</tr>
														
													<tr>
														<td>Alamat</td>
														<td>&nbsp;&nbsp;</td>
														<td>:</td>
														<td><?php echo $assesmen_observasi_data->alamatsiswa ?></td>
														
														<td>&nbsp;&nbsp;</td>
														
														<td>Anak ke-</td>
														<td>&nbsp;&nbsp;</td>
														<td>:</td>
														<td><?php echo $assesmen_observasi_data->anakke ?></td>											
													</tr>
													
													<tr>
														<td>Nama Ayah</td>
														<td>&nbsp;&nbsp;</td>
														<td>:</td>
														<td><?php echo $assesmen_observasi_data->namaayah ?></td>
														
														<td>&nbsp;&nbsp;</td>
														
														<td>Pekerjaan Ayah</td>
														<td>&nbsp;&nbsp;</td>
														<td>:</td>
														<td><?php echo $assesmen_observasi_data->pekerjaan_ayah ?></td>											
													</tr>
													
													<tr>
														<td>Nama Ibu</td>
														<td>&nbsp;&nbsp;</td>
														<td>:</td>
														<td><?php echo $assesmen_observasi_data->namaibu ?></td>
														
														<td>&nbsp;&nbsp;</td>
														
														<td>Pekerjaan Ibu</td>
														<td>&nbsp;&nbsp;</td>
														<td>:</td>
														<td><?php echo $assesmen_observasi_data->pekerjaan_ibu ?></td>											
													</tr>
												</table>
											</td>
										</tr>
										
										<tr>
											<td>Upload File</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<input type="file" id="data_file" name="data_file" >
												<input type="hidden" id="data_file2" name="data_file2" value="<?php echo $assesmen_observasi_data->data_file; ?>" >
											</td>
											
											<td colspan="4">&nbsp;&nbsp;</td>
																			
										</tr>
										
										<tr>
											<td>Download File</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<?php if($assesmen_observasi_data->data_file != "") { ?>
													<a class="label label-success" href="app/assesmen_observasi_download.php?ref=<?php echo $assesmen_observasi_data->ref ?>" target="_blank" title="Download"><?php echo $assesmen_observasi_data->data_file; ?>
													</a>
												<?php } ?>
											</td>
											
											<td colspan="4">&nbsp;&nbsp;</td>
																			
										</tr>
										
										<!--<tr>
											
											<?php
												if($ref == "") {
													include("assesmen_observasi_detail.php");
												} else {
													include("assesmen_observasi_detail_update.php");
												}
											?>	
											
										</tr>-->
										
                                       
                                        <tr>
											<td>Orthopaedagog *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
                                                <select name="idpegawai" id="idpegawai" class="cho" style="width:auto; height:27px; " />
                                                    <option value="">...</option>
													<?php select_petugas($assesmen_observasi_data->idpegawai); ?>
												</select>
                                            </td>	
										</tr>
										
										<tr>
											<td>Supporting Teacher *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
                                                <select name="idpegawai1" id="idpegawai1" class="cho" style="width:auto; height:27px; " />
                                                    <option value="">...</option>
													<?php select_petugas($assesmen_observasi_data->idpegawai1); ?>
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
												<?php if (allowupd('frmassesmen_observasi')==1) { ?>
													<?php if($ref!='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmassesmen_observasi')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowdel('frmassesmen_observasi')==1) { ?>		
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } ?>
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . '/'  . obraxabrix('assesmen_observasi_view') ?>'" />
												
												
												<?php if (allowadd('frmassesmen_observasi')==1) { ?>																	&nbsp;
													<input type="button" name="submit" id="submit" class="btn btn-primary" value="Tambah Data" onclick="self.location='<?php echo $nama_folder . '/'  . obraxabrix('assesmen_observasi') ?>'" />
											<?php } ?>
												
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