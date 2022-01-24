<script type="text/javascript" src="js/buttonajax.js"></script>

<script type="text/javascript">
	
	function rpt_siswa_view(nis) {
		departemen = document.getElementById('departemen').value;
		idtingkat = document.getElementById('idtingkat').value;
		idkelas = document.getElementById('idkelas').value;
		idsemester = document.getElementById('idsemester').value;
		nama = document.getElementById('nama').value;
		
		window.open('app/rpt_evaluasi_psikologi_level_siswa_view.php?&departemen='+departemen+'&idtingkat='+idtingkat+'&idkelas='+idkelas+'&nis='+nis, 'Evaluasi Psikologi','825','450','resizable=1,scrollbars=1,status=0,toolbar=0');
		
	}
</script>

<script>
    function submitForm(tipe)
    {
    	
		if(tipe == 'find') {
			$("#rpt_evaluasi_psikologi_level").attr('action', '')
				.attr('target', '_self');
			$("#rpt_evaluasi_psikologi_level").submit();
		}
		
		if(tipe == 'print') {
			$("#rpt_evaluasi_psikologi_level").attr('action', 'app/rpt_evaluasi_psikologi_level_view.php')
				.attr('target', '_BLANK');
			$("#rpt_evaluasi_psikologi_level").submit();
		}
		
		if(tipe == 'excel') {
			$("#rpt_evaluasi_psikologi_level").attr('action', 'app/rpt_penerimaan_xls.php')
			   .attr('target', '_BLANK');
			$("#rpt_evaluasi_psikologi_level").submit();
		}
		
  		return false;	 
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

<script type="text/javascript">
	function getnissemester() {
		departemen = document.getElementById('departemen').value;
		idtingkat = document.getElementById('idtingkat').value;
		idkelas = document.getElementById('idkelas').value;
		
		document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('rpt_evaluasi_psikologi_level') ?>&departemen="+departemen+"&idtingkat="+idtingkat+"&idkelas="+idkelas+" ";
	}
</script>

<?php

$find  		= $_POST['submit'];

$departemen = $_REQUEST["departemen"];
$idtingkat  = $_REQUEST["idtingkat"];
$idkelas    = $_REQUEST["idkelas"];
		
?>


<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Filter</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="rpt_evaluasi_psikologi_level" id="rpt_evaluasi_psikologi_level" class="form-horizontal">
								<div>
									
									<table class="table" border="0">
										<tr>
											<td>Unit</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="departemen" id="departemen" class="cho" style="min-width: 250px; height:27px; " onchange="getnissemester()" > <!--onchange="loadHTMLPost2('app/rpt_penerimaan_ajax.php','idtingkat_id','getlevel','departemen')"/>-->
													<option value="">...</option>
													<?php select_departemen($departemen); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Level</td>
											<td>&nbsp;&nbsp;</td>
											<td id="idtingkat_id">
												<select name="idtingkat" id="idtingkat" class="cho" style="min-width: 250px;  height:27px; font-size:12px; padding:0px; " onchange="getnissemester()" >
													<option value="">...</option>
													<?php select_tingkat_unit($departemen, $idtingkat); ?>
												</select>
											</td>											
										</tr>
										
										<tr>
											<td>Kelas</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idkelas" id="idkelas" class="cho" style="min-width: 250px; height:27px; font-size:12px; padding:0px; " onchange="getnissemester()" >
													<option value="">...</option>
													<?php select_kelas($idtingkat, $idkelas); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Semester</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idsemester" id="idsemester" class="cho" style="min-width: 250px; height:27px; font-size:12px; padding:0px; " >
													<option value="">...</option>
													<?php select_semester($departemen, $idsemester); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Nama</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="nama" id="nama" style="width:250px;  font-size:12px " value="<?php echo $nama ?>">
											</td>											
										</tr>
										
										<tr>
											<td colspan="4">&nbsp;</td>
										</tr>
										
										<tr>
											<td>
												<input type="submit" name="submit" class='btn btn-primary' value="Preview" onclick="submitForm('find')" >
											</td>
											<td>
												<input type="submit" name="submit" class='btn btn-primary' value="Cetak" onclick="submitForm('print')" >
											</td>
											<td></td>
											<td>
												<input type="submit" name="submit" class='btn btn-primary' value="Ekspor Excel" onclick="submitForm('excel')" >
											</td>											
										</tr>
										
									</table>
									
								</div>								
							</form>
						</div>	
					</div>
					
					
					<div class="box">
						<div class="box-head tabs">
							<h3>DAFTAR SISWA</h3>	
							
													
						</div>
						
						<div class="box-content box-nomargin">
							
							<?php
								$delete = $_REQUEST['mxKz'];
								if ($delete == "xm8r389xemx23xb2378e23") {
									include 'class/class.delete.php';
									$delete2=new delete;
									$delete2->delete_siswa($_REQUEST['id']);
							?>
									<div class="alert alert-success">
										<strong>Delete Data successfully</strong>
									</div>
							<?php
								}
							?>

							<div class="tab-content">
									<div class="tab-pane active" id="basic">
										<div style="overflow:auto; ">
										<!--<table class="table" class='table table-striped dataTable table-bordered' style="font-size:11px; width:4000px ">-->
										
										<table class="table" class='table table-striped dataTable table-bordered' style="font-size:11px; ">
											<thead>
												<tr>
													<th style="font-weight:bold ">NIS &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">NISN &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Nama Lengkap &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Jenis Kelamin &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Level &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Kelas &nbsp;&nbsp;</th>
													<!--<th style="font-weight:bold "></th>-->										
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													$sql=$selectview->list_siswa('', '', $idtingkat, $idkelas, $nama, $all, $departemen);			
													
													while ($siswa_view=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
														
														$tanggal = date("d-m-Y", strtotime($siswa_view->tanggal));	
														
														if($siswa_view->kelamin == "P") {
															$kelamin = "Perempuan";
														} else {
															$kelamin = "Laki-laki";
														}	
												?>
													
													<tr>
														<td><?php echo $siswa_view->nis ?></td>
														<td><?php echo $siswa_view->nisn ?></td>
														<td><?php echo $siswa_view->nama ?></td>
														<td><?php echo $kelamin ?></td>
														<td><?php echo $siswa_view->tingkat ?></td>
														<td><?php echo $siswa_view->kelas ?></td>
														
														<!--<td>
															
															<a class="label label-success" onclick="rpt_siswa_view('<?php echo $siswa_view->nis ?>')" target="_blank" style="background-color: #46e916" >view report</a>
															
														</td>-->
														
													</tr>
																										
												<?php
												}
												?>
												
												
											</tbody>
											
										</table>									
										
										
										</div>
										
										
										<br>
									</div>
							</div>
						</div>
						
				</div>
					
					
			</div>

		</div>
	</div>
</div>