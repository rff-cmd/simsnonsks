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
		  if (document.getElementById(arrf[i]).name=='idtingkat') {
			alert('Level tidak boleh kosong!');				
		  }    
		  if (document.getElementById(arrf[i]).name=='idkelas') {
			alert('Kelas tidak boleh kosong!');				
		  }
          if (document.getElementById(arrf[i]).name=='departemen') {
			alert('Unit tidak boleh kosong!');				
		  }
		  if (document.getElementById(arrf[i]).name=='idsemester') {
			alert('Semester tidak boleh kosong!');				
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

<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost3(URL, destination, button, getId, getId1, getId2){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;		
		str1 = getId1 + '=' + document.getElementById(getId1).value;
		str2 = getId2 + '=' + document.getElementById(getId2).value;
		
		var str = str + '&button=' + button;
		var str1 = str1 + '&button=' + button;
		var str2 = str2 + '&button=' + button;
		
		str = str + '&'+str1 + '&'+str2;
		
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

<script>
	function number_format(number, decimals, dec_point, thousands_sep) {
		number = (number + '')
		.replace(/[^0-9+\-Ee.]/g, '');
	  
	  var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function(n, prec) {
		  var k = Math.pow(10, prec);
		  return '' + (Math.round(n * k) / k)
			.toFixed(prec);
		};
	  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
	  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
		.split('.');
	  if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	  }
	  if ((s[1] || '')
		.length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1)
		  .join('0');
	  }
	  return s.join(dec);
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
		 
		 c = c.replace(",","");
		 
		 document.getElementById(field).value = c;	
		 
	}

</script>	

<script type="text/javascript">
	function getnissemester() {
		tanggal = document.getElementById('tanggal').value;
		departemen = document.getElementById('departemen').value;
		idtingkat = document.getElementById('idtingkat').value;
		idkelas = document.getElementById('idkelas').value;
		
		document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('evaluasi_psikologi') ?>&tanggal="+tanggal+"&departemen="+departemen+"&idtingkat="+idtingkat+"&idkelas="+idkelas+" ";
	}
</script>
	
<?php

$ref = $segmen3;

$tanggal = $_GET["tanggal"];
$tanggal = date("d-m-Y", strtotime($tanggal));
$departemen = $_GET["departemen"];
$idtingkat = $_GET["idtingkat"];
$idkelas = $_GET["idkelas"];

?>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Evaluasi Psikologi</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="evaluasi_psikologi" id="evaluasi_psikologi" class="form-horizontal" onSubmit="return cekinput('tanggal,departemen,idtingkat,idkelas,nis,idsemester');" enctype="multipart/form-data" />
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
										
										$ref2 = notran(date('y-m-d'), 'frmevaluasi_psikologi', '', '', ''); //---get no ref										
										include("app/exec/insert_evaluasi_psikologi.php"); 
										
										if($tanggal == "01-01-1970") {
											$tanggal = date("d-m-Y");
										}
										
                                        
										if ($ref != "") {
											$sql=$select->list_evaluasi_psikologi($ref);			
											$evaluasi_psikologi_data=$sql->fetch(PDO::FETCH_OBJ);
											
											$ref2 	= $evaluasi_psikologi_data->ref;
											$departemen = $evaluasi_psikologi_data->departemen;
											$tanggal = date("d-m-Y", strtotime($evaluasi_psikologi_data->tanggal));
											$idtingkat = $evaluasi_psikologi_data->idtingkat;
											$idkelas = $evaluasi_psikologi_data->idkelas;
                                          
										}	
										
									?>
									
									
									<table class="table">
										<input type="hidden" id="ref" name="ref" value="<?php echo $ref ?>" >
										
										<tr>
											<td width="20%">Ref *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<input type="text" name="ref2" id="ref2" style="width:130px;  " readonly="" value="<?php echo $ref2 ?>">
											</td>
											
										</tr>
										
										<tr>
											<td>Tanggal *)</td>
											<td>&nbsp;&nbsp;</td>
                                            <td>:</td>
											<td><input type="text" name="tanggal" class='datepick' id="tanggal" style="min-width: 178px;  " value="<?php echo $tanggal ?>"></td>
											
										</tr>
										
										<tr>
											<td>Unit *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="departemen" id="departemen" class="cho" style="min-width: 178px; height:27px; " onchange="getnissemester()" >
												<!--onchange="loadHTMLPost2('app/evaluasi_psikologi_ajax.php','nissemester_id','getsiswa','departemen')" />-->
													<option value="">...</option>
													<?php select_departemen($departemen); ?>
												</select>
											</td>												
										</tr>
									
										<tr>
											<td>Level *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="idtingkat" id="idtingkat" class="cho" style="min-width: 178px; height:27px; " onchange="getnissemester()" >
													<option value="">...</option>
													<?php select_tingkat_unit($departemen, $idtingkat); ?>
												</select>
											</td>												
										</tr>
										
										<tr>
											<td>Kelas *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="idkelas" id="idkelas" class="cho" style="min-width: 178px; height:27px; " onchange="getnissemester()" >
													<option value="">...</option>
													<?php select_kelas($idtingkat, $idkelas); ?>
												</select>
											</td>												
										</tr>
									
										<tr>
											<td>NIS *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="nis" id="nis" class="cho" style="width:350px; height:27px; " onchange="loadHTMLPost3('app/evaluasi_psikologi_detail_ajax.php','aspek_psikologi_id','get_jenisaspek_psikologi','departemen','nis','idsemester')" >
													<option value="">...</option>
													<?php select_siswa_departemen($departemen, $idtingkat, $idkelas, $evaluasi_psikologi_data->nis); ?>
												</select>
											</td>
											
										</tr>
										
										<tr>
											<td>Semester *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="idsemester" id="idsemester" class="cho" style="min-width: 178px;height:27px; " onchange="loadHTMLPost3('app/evaluasi_psikologi_detail_ajax.php','aspek_psikologi_id','get_jenisaspek_psikologi','departemen','nis','idsemester')" >
													<option value="">...</option>
													<?php select_semester_psikologi($departemen, $evaluasi_psikologi_data->idsemester); ?>
												</select>
											</td>
											
										</tr>
									
									
										<tr>
											<td colspan="4">
												<?php 
													if($ref == "") {
												?>
													<div id="aspek_psikologi_id">
														
													</div>
																												
												<?php
													} else {
														include("evaluasi_psikologi_detail.php");
													}
												?>
											</td>
										</tr>
										                                        
										<tr>
											<td colspan="4">&nbsp;&nbsp;</td>								
										</tr>
										
									</table>
								
									
									
									<table>
										<tr>
											<td colspan="4">&nbsp;&nbsp;</td>								
										</tr>
										
										<tr>											
											<td colspan="3">
												<?php if (allowupd('frmevaluasi_psikologi')==1) { ?>
													<?php if($ref!='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmevaluasi_psikologi')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowdel('frmevaluasi_psikologi')==1) { ?>		
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } ?>
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . '/' . obraxabrix('evaluasi_psikologi_view') ?>'" />
												
												
												<?php if (allowadd('frmevaluasi_psikologi')==1) { ?>																	&nbsp;
													<input type="button" name="submit" id="submit" class="btn btn-primary" value="Tambah Data" onclick="self.location='<?php echo $nama_folder . '/'  . obraxabrix('evaluasi_psikologi') ?>'" />
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