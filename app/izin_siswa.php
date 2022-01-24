<script type="text/javascript" src="js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='idsiswa') {
			alert('Siswa tidak boleh kosong!');				
		  }
          if (document.getElementById(arrf[i]).name=='tanggal') {
			alert('Tanggal tidak boleh kosong!');				
		  }
          if (document.getElementById(arrf[i]).name=='jam') {
			alert('Jam tidak boleh kosong!');				
		  }
          if (document.getElementById(arrf[i]).name=='menit') {
			alert('Menit tidak boleh kosong!');				
		  }
		  if (document.getElementById(arrf[i]).name=='idjenis_izin') {
			alert('Jenis Izin tidak boleh kosong!');				
		  }
          if (document.getElementById(arrf[i]).name=='status') {
			alert('Status tidak boleh kosong!');				
		  }
          if (document.getElementById(arrf[i]).name=='idpegawai') {
			alert('Petugas tidak boleh kosong!');				
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
							<h3>Izin Siswa</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="izin_siswa" id="izin_siswa" class="form-horizontal" onSubmit="return cekinput('idsiswa,tanggal,jam,menit,idjenis_izin,status,idpegawai');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
																				
										include("app/exec/insert_izin_siswa.php"); 
										
										$tanggal = date("d-m-Y");
                                        $jam = date("H");
                                        $menit = date("i");
										if ($ref != "") {
											$sql=$select->list_izin_siswa($ref);			
											$izin_siswa_data=$sql->fetch(PDO::FETCH_OBJ);
											
											$tanggal = date("d-m-Y", strtotime($izin_siswa_data->tanggal));
                                            $jam     = date("H", strtotime($izin_siswa_data->tanggal));
											$menit     = date("i", strtotime($izin_siswa_data->tanggal));
                                            
                                          
										}	
										
									?>
									<table class="table" border="0">
										<input type="hidden" id="replid" name="replid" value="<?php echo $ref ?>" >
										
										<tr>
											<td>Tingkat *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="idtingkat" id="idtingkat" style="min-width: 178px;  font-size:12px; padding:0px; " onClick="loadHTMLPost2('app/izin_siswa_ajax.php','idkelas','getkelas','idtingkat')" />
													<option value=""></option>
													<?php select_tingkat($izin_siswa_data->idtingkat); ?>
												</select>
											</td>	
										</tr>	
										
										<tr>
											<td>Kelas *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="idkelas" id="idkelas" style="min-width: 178px;  font-size:12px; padding:0px; " onClick="loadHTMLPost2('app/izin_siswa_ajax.php','idsiswa','getsiswa','idkelas')" />
													<option value=""></option>
													<?php select_kelas($izin_siswa_data->idtingkat, $izin_siswa_data->idkelas); ?>
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
													<?php select_siswa($izin_siswa_data->idkelas, $izin_siswa_data->idsiswa); ?>
												</select>
											</td>
										</tr>
										
                                        <tr>
											<td>Tanggal *)</td>
											<td>&nbsp;&nbsp;</td>
                                            <td>:</td>
											<td><input type="text" name="tanggal" class='datepick' id="tanggal" style="" value="<?php echo $tanggal ?>"></td>
											
										</tr>
                                        
                                        <tr>
											<td>Jam (HH:mm) *)</td>
											<td>&nbsp;&nbsp;</td>
                                            <td>:</td>
											<td>
                                                <!--<input type="text" name="jam" id="jam" class='timepicker' style="min-width: 178px;" value="<?php echo $jam ?>" >-->
                                                <select name="jam" id="jam" style="min-width: 178px; height:27px; " />   
                                                    <?php select_jam($jam); ?>   
                                                </select> 
                                                :
                                                <select name="menit" id="menit" style="min-width: 178px; height:27px; " />   
                                                    <?php select_menit($menit); ?>   
                                                </select>                                              
                                            </td>
											
										</tr>
                                        
                                        <tr>
											<td>Jenis Izin *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
                                                <select name="idjenis_izin" id="idjenis_izin" style="min-width: 178px; height:27px; " />
                                                    <option value=""></option>
													<?php select_jenis_izin($izin_siswa_data->idjenis_izin); ?>
												</select>
                                            </td>	
										</tr>
                                        
										<tr>
											<td>Format Surat</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td id="format_surat_id">
                                                <div class="box">
                                                    <div class="box-content box-nomargin">
                            							<textarea name="format_surat" id="format_surat" readonly="true" class='span12 cleditor'><?php echo $izin_siswa_data->format_surat ?></textarea>
                            						</div>
                                                </div>
                                            </td>
										</tr>
                                        
                                        <tr>
											<td>Keterangan</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><textarea name="keterangan" id="keterangan" class='span12 input-square' rows="3"><?php echo $izin_siswa_data->keterangan ?></textarea></td>
										</tr>
                                                                                
										<tr>
											<td>Status *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
                                                <select name="status" id="status" style="min-width: 178px; height:27px;position:relative !important;">
													<?php select_status_izin($izin_siswa_data->status); ?>
												</select>
                                            </td>	
										</tr>
										
                                        <tr>
											<td>Petugas *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
                                                <select name="idpegawai" id="idpegawai" style="min-width: 178px; height:27px; " />
                                                    <option value=""></option>
													<?php select_petugas($izin_siswa_data->idpegawai); ?>
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
												<?php if (allowupd('frmizin_siswa')==1) { ?>
													<?php if($ref!='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmizin_siswa')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowdel('frmizin_siswa')==1) { ?>		
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } ?>
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . '/'  . obraxabrix('izin_siswa_view') ?>'" />
												
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