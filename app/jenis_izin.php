<!--<script src="js/pindah.js"></script>-->

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='nama') {
			alert('Jenis Izin Siswa tidak boleh kosong!');				
		  }
		  
		  
		  return false
		} 
										
	  }		 
	}	
	
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
							<h3>Jenis Izin Siswa</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="jenis_izin2" id="jenis_izin2" class="form-horizontal" onSubmit="return cekinput('nama');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
																				
										include("app/exec/insert_jenis_izin.php"); 
										
										$act = "checked";
										if ($ref != "") {
											$sql=$select->list_jenis_izin($ref);			
											$jenis_izin_data=$sql->fetch(PDO::FETCH_OBJ);
											
											if ($jenis_izin_data->aktif == 1) {
												$act = "checked";
											} else {
												$act = "";
											}
											
										}	
										
									?>
									<table class="table" border="0">
										<input type="hidden" id="replid" name="replid" value="<?php echo $ref ?>" >
										
										<tr>
											<td>Jenis Izin Siswa *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="nama" id="nama" style="width:250px; " value="<?php echo $jenis_izin_data->nama ?>"></td>
										</tr>
										
										<tr>
											<td>Keterangan</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><textarea name="keterangan" id="keterangan" class='span12 input-square' rows="3"><?php echo $jenis_izin_data->keterangan ?></textarea></td>
										</tr>
										
                                        <tr>
											<td>Format Surat *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
                                                <div class="box">
                                                    <div class="box-content box-nomargin">
                            							<textarea name="format_surat" id="format_surat" class='span12 cleditor'><?php echo $jenis_izin_data->format_surat ?></textarea>
                            						</div>
                                                </div>
                                            </td>
										</tr>
                                        
                                        
                                        
										<tr>
											<td>Aktif</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="checkbox" name="aktif" id="aktif" style="" value="1" <?php echo $act ?> ></td>	
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
												<?php if (allowupd('frmjenis_izin')==1) { ?>
													<?php if($ref!='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmjenis_izin')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowdel('frmjenis_izin')==1) { ?>		
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } ?>
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . '/'  . obraxabrix('jenis_izin_view') ?>'" />
												
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