<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include_once ("include/queryfunctions.php");
include_once ("include/functions.php");
include_once ("include/inword.php");

include_once ("class/class.select.php");
include_once ("class/class.selectview.php");
include_once ("class/class.protection.php");

$select 	= new select;
$selectview = new selectview;
$protection = new protection;

?>

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
		 document.getElementById(field).value = c;		
		 
	}
	
	
	function detailvalue(id, cols, idsiswa){		
		
		var jumlah = 0;
		var jumlah_raport = 0;
		var rata = 0;
		var rata_raport = 0;
		var persen = 0;
		var persen1 = 0;
		var a = 0;
		
		var total_n = 0;
		var nilai_tertinggi = 0;
		var jml_col = 0;
		for(b=1; b<=cols; b++) {
			window['n'+b+idsiswa] = 0;	
			//window['n'+b] = document.getElementById('n'+ parseInt(b) + parseInt(id)).value; 
			window['n'+b+idsiswa] = document.getElementById('n'+ b + id + idsiswa).value;
			window['n'+b+idsiswa] = window['n'+b+idsiswa].replace(/[^\d-.]/g,"");
			
			if( window['n'+b+idsiswa] != "" ) {
				jml_col++;
			}
			
			if(window['n'+b+idsiswa] == "") {window['n'+b+idsiswa] = 0};
			
			total_n = parseFloat(total_n) + parseFloat(window['n'+b+idsiswa]);
			
			if(nilai_tertinggi <  window['n'+b+idsiswa]) {
				nilai_tertinggi = window['n'+b+idsiswa];
			}
						
			
		}
		
		var uts = 0;	
		uts=document.getElementById('uts'+id).value; 
		uts = uts.replace(/[^\d-.]/g,"");
		if(uts == "") {uts = 0};
		
		var uas = 0;	
		uas=document.getElementById('uas'+id).value; 
		uas = uas.replace(/[^\d-.]/g,"");
		//if(uas == "") {uas = 0};
		
		jumlah_raport = parseFloat(total_n);
		
		if( uas == "" ) {
			jumlah = parseFloat(total_n) + parseFloat(uts);
			jumlah2 = number_format(jumlah,1,".",",");
		}
		if(uas != "") {
			jumlah = parseFloat(total_n) + parseFloat(uts);  //+ parseFloat(uas);
			jumlah2 = number_format(jumlah,1,".",",");
		}		
				
		$('#jumlah_'+id).html('<input type="text" id="jumlah'+id+'" name="jumlah'+id+'" value="'+ jumlah2 +'" readonly style="width:50px; height: 30px; background-color: #bbfaab; text-align: center;" >');
		
		//get nilai (sesuai jenis penilaian)
		var iddasarpenilaian = document.getElementById('iddasarpenilaian').value;
		if(iddasarpenilaian == 3) { //Pengetahuan
			
			rata_raport = parseFloat(jumlah_raport) / parseFloat(jml_col);
			
			rata = parseFloat(jumlah) / parseFloat(jml_col); //cols
			
			/*if(uas == "") {
				rata = parseFloat(jumlah) / parseFloat(jml_col); //cols
			}
			if(uas != "") {
				rata = parseFloat(jumlah) / (parseFloat(jml_col) + parseFloat(1)); //cols
			}*/
						
		}
		if(iddasarpenilaian == 4) { //Keterampilan
			rata_raport = parseFloat(jumlah_raport) / parseFloat(jml_col);
			
			rata = parseFloat(jumlah) / parseFloat(jml_col); //cols		
			
			/*rata_raport	= nilai_tertinggi;
			
			if(uas == "") {
				rata = nilai_tertinggi;
			}*/
			if(uas != "") { 
				/*if(nilai_tertinggi <  uas) {
					nilai_tertinggi = uas;
				}
				rata = nilai_tertinggi;*/
				rata_raport = parseFloat(jumlah_raport) / parseFloat(jml_col);
			
				rata = parseFloat(jumlah) / parseFloat(jml_col); //cols
			}
		}
		
		rata2 = number_format(rata,1,".",",");
		$('#rata_'+id).html('<input type="text" id="rata'+id+'" name="rata'+id+'" value="'+ rata2 +'" readonly style="width:50px; height: 30px; background-color: #bbfaab; text-align: center;" >');
		
		persen = parseFloat(rata_raport) * 0.75;
		persen2 = number_format(persen,2,".",",");
		$('#persen_'+id).html('<input type="text" id="persen'+id+'" name="persen'+id+'" value="'+ persen2 +'" readonly style="width:50px; height: 30px; background-color: #bbfaab; text-align: center;" >');
		
		persen1 = parseFloat(uas) * 0.25;
		persen3 = number_format(persen1,2,".",",");
		$('#persen1_'+id).html('<input type="text" id="persen1'+id+'" name="persen1'+id+'" value="'+ persen3 +'" readonly style="width:50px; height: 30px; background-color: #bbfaab; text-align: center;" >');
		
		if(persen1 >= 0) {
			na = parseFloat(persen) + parseFloat(persen1);	
		} else {
			na = parseFloat(rata_raport);
		}
		
		na2 = number_format(na,0,".",",");		
		
		$('#na_'+id).html('<input type="text" id="na'+id+'" name="na'+id+'" value="'+ na2 +'" readonly style="width:50px; height: 30px; background-color: #bbfaab; text-align: center;" >');
		
		//------------hitung A / E		
		idjeniskompetensi = document.getElementById('idjeniskompetensi').value;
		if ( idjeniskompetensi == 1) {
			if (na >= 89.5) {
				a = 4;
			}
			if (na >= 78.5 && na < 89.5) {
				a = 3;
			}
			if (na >= 67.5 && na < 78.5) {
				a = 2;
			}
		} else if ( idjeniskompetensi == 2) {
			if (na >= 3.5) {
				a = 4;
			}
			if (na >= 2.5 && na < 3.5 ) {
				a = 3;
			}
			if (na >= 2 && na < 2.5) {
				a = 2;
			}
		}		
		
		$('#a_'+id).html('<input type="text" id="a'+id+'" name="a'+id+'" value="'+ a +'" readonly style="width:50px; height: 30px; background-color: #bbfaab; text-align: center;" >');
		//--------------------/\
		
				
	}
</script>

<!-- bootstrap & fontawesome -->
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/font-awesome/4.2.0/css/font-awesome.min.css" />

<!-- page specific plugin styles -->
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/jquery-ui.custom.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/chosen.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/datepicker.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/bootstrap-timepicker.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/daterangepicker.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/colorpicker.min.css" />


<!-- text fonts -->
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/fonts/fonts.googleapis.com.css" />

<!-- ace styles -->
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

<!--[if lte IE 9]>
	<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
<![endif]-->

<!--[if lte IE 9]>
  <link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/ace-ie.min.css" />
<![endif]-->

<!-- inline styles related to this page -->

<!-- ace settings handler -->
<script src="../<?php echo $__folder ?>assets/js/ace-extra.min.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='client_code') {
			alert('Customer belum diisi!');				
		  }
		  
		  
		  return false
		} 
										
	  }		
	  
	  
	  var amount = 0;
	  amount = document.getElementById('amount').value;
	  amount = amount.replace(/[^\d-.]/g,"");
	  amount = amount.replace(",","");
	  
	  if(amount <= 0) {
	  	alert('Jumlah tidak boleh nol !!!');
	  	return false
	  }
	   
	}
		
</script>

<script>
    function submitForm(tipe)
    {
		if(tipe == 'excel') {
			$("#daftarnilai_input").attr('action', '../app/daftarnilai_xls.php')
			   .attr('target', '_BLANK');
			$("#daftarnilai_input").submit();
		}
		
		if(tipe == 'upload') {
			$("#daftarnilai_input").attr('action', '../app/daftarnilai_upload.php')
			   .attr('target', '_BLANK');
			$("#daftarnilai_input").submit();
		}
		
		if(tipe == 'upload_k') {
			$("#daftarnilai_input").attr('action', '../app/daftarnilai_upload_keterampilan.php')
			   .attr('target', '_BLANK');
			$("#daftarnilai_input").submit();
		}
		
  		return false;	 
    }
		
</script>

<script>
	function hapus_bank(id, line) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "client_bank.php?client_code="+id+"&mxKz=xm8r389xemx23xb2378e23&id="+id+"&line="+line+" ";
		}
	}
</script>

<?php
	$idtahunajaran		= $_REQUEST['idtahunajaran'];
	$semester_id 		= $_REQUEST['semester_id'];
	$idtingkat	 		= $_REQUEST['idtingkat'];
	$idkelas	 		= $_REQUEST['idkelas'];
	$idpelajaran 		= $_REQUEST['idpelajaran'];
	$iddasarpenilaian 	= $_REQUEST['iddasarpenilaian'];
	$disabled			= $_REQUEST['disabled'];
	$old				= $_REQUEST['old'];
	$alumni				= $_REQUEST["alumni"];
	
	//proteksi input nilai
	$date = date("d-m-Y");	
	
	$input_nilai = 0;
	if($idtahunajaran == $_SESSION["idtahunajaran"] && $semester_id == $_SESSION["semester_id"] && allowlvl("frmdaftarnilai") != 2) {
		$input_nilai = 1;
	}
	
	if(allowlvl("frmdaftarnilai") == 2 || $_SESSION["adm"] == 1 ) {
		$input_nilai = 1;
	}
	
?>


<div class="page-content">
      
	<div class="row">
		<div class="col-xs-12">
            
            <?php
				$delete = $_REQUEST['mxKz'];
                $segmen4 = $_REQUEST['id'];
				if ($delete == "xm8r389xemx23xb2378e23") {
					include 'class/class.delete.php';
					$delete2=new delete;
					$delete2->delete_client_bank($segmen4, $line);
			?>
					<div class="alert alert-success">
						<strong>Delete Data successfully</strong>
					</div>
                    
                    <meta http-equiv="Refresh" content="0;url=client_bank.php?client_code=<?php echo $client_code ?>" />
			<?php
                    
                    
				}
			?>
			
            <?php 
          		$ref = $_GET['search'];
          		
				//jika saat add data, maka data setelah save kosong
				if ($_POST['submit'] == 'Save') { $ref = ''; }
				//-----------------------------------------------/\
					
				//$ref2 = notran(date('y-m-d'), 'frmclientcheque', '', '', ''); 
					
				include($__folder."exec/insert_daftar_nilai.php"); 
				
				
				/*$date = date("d-m-Y");
				$sqlclient = $select->list_client($client_code);
				$row_client = $sqlclient->fetch_object();
				$client_name = $row_client->name;
                                        				
				if ($ref != "") {
					$sql=$select->list_client_bank($ref, $line);
					$row_client_bank=$sql->fetch_object();	
					
					$client_code = $row_client_bank->client_code;
					$client_name = $row_client_bank->client_name;
					
				}*/	
				
			?>
            
			<!-- PAGE CONTENT BEGINS -->
			<form class="form-horizontal" role="form" action="" method="post" name="daftarnilai_input" id="daftarnilai_input" enctype="multipart/form-data" >
            	
            	<input type="hidden" id="departemen" name="departemen" value="SMA" >
            	<input type="hidden" id="idtingkat" name="idtingkat" value="<?php echo $idtingkat; ?>" >
            	<input type="hidden" id="idkelas" name="idkelas" value="<?php echo $idkelas; ?>" >
            	<input type="hidden" id="semester_id" name="semester_id" value="<?php echo $semester_id; ?>" >
            	<input type="hidden" id="idpelajaran" name="idpelajaran" value="<?php echo $idpelajaran; ?>" >
            	<input type="hidden" name="idjeniskompetensi" id="idjeniskompetensi" value="1" />
            	<input type="hidden" id="iddasarpenilaian" name="iddasarpenilaian" value="<?php echo $iddasarpenilaian; ?>" >
            	<input type="hidden" id="idtahunajaran" name="idtahunajaran" value="<?php echo $idtahunajaran; ?>" >
            	<input type="hidden" id="old" name="old" value="<?php echo $old; ?>" >
            	<input type="hidden" id="alumni" name="alumni" value="<?php echo $alumni; ?>" >
            	
            	<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tingkat *)</label>
					<div class="col-sm-3">
						<select name="idtingkat1" id="idtingkat1" disabled="" class="chosen-select form-control" >
							<option value=""></option>
							<?php select_tingkat_unit("SMA", $idtingkat); ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kelas *)</label>
					<div class="col-sm-3">
						<select name="idkelas1" id="idkelas1" disabled="" class="chosen-select form-control" >
							<option value=""></option>
							<?php select_kelas($idtingkat, $idkelas); ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Pelajaran *)</label>
					<div class="col-sm-3">
						<select name="idpelajaran1" id="idpelajaran1" disabled="" class="chosen-select form-control" >
							<option value=""></option>
							<?php select_pelajaran("SMA", $idpelajaran); ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Aspek Penilaian *)</label>
					<div class="col-sm-3">
						<select name="iddasarpenilaian1" id="iddasarpenilaian1" disabled="" class="chosen-select form-control" >
							<option value=""></option>
							<?php select_aspekpenilaian($iddasarpenilaian); ?>
						</select>
					</div>
				</div>
				
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
					<div class="col-sm-3">
						<input type="submit" name="submit" class='btn btn-primary' value="Download" onclick="submitForm('excel')" >
					</div>
				</div>
				
				<?php //if($_SESSION['adm'] == 1) { //sementara ditutup (2020-12-14) ?>
				
				<?php if( ($protection->setup_periode("RAPORT", $date) == 1 || allowlvl("frmdaftarnilai") == 2) && $input_nilai == 1) { ?>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Upload File Pengetahuan</label>
						<div class="col-sm-5">
							<input type="file" name="file" id="file" accept=".csv">
							<br>
							<input type="submit" name="submit" class='btn btn-primary' value="Upload" onclick="submitForm('upload')" >
							<?php
								$message = '<font color="#ff0000">' . "Pastikan sebelum upload, file harus hasil download !";
								$message = $message . "</font>";
								echo $message;
							?>
						</div>
					</div>
				<?php } else { 
					
					$message = '<font color="#ff0000">' . "Periode Input Nilai sudah habis !";
					$message = $message . "</font>";
					echo $message."<br><br>";
				
				} ?>
				
				
				<?php if( ($protection->setup_periode("RAPORT", $date) == 1 || allowlvl("frmdaftarnilai") == 2) && $input_nilai == 1) { ?>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Upload File Keterampilan</label>
						<div class="col-sm-5">
							<input type="file" name="file_k" id="file_k" accept=".csv">
							<br>
							<input type="submit" name="submit" class='btn btn-primary' value="Upload Keterampilan" onclick="submitForm('upload_k')" >
							<?php
								$message = '<font color="#ff0000">' . "Pastikan sebelum upload, file harus hasil download !";
								$message = $message . "</font>";
								echo $message;
							?>
						</div>
					</div>
				<?php } else { 
					
					$message = '<font color="#ff0000">' . "Periode Input Nilai sudah habis !";
					$message = $message . "</font>";
					echo $message."<br><br>";
				
				} ?>
				
				<?php //} ?>
					
				<table id="simple-table" class="table table-striped table-bordered table-hover">
					<thead>
						<?php
									
							$sqlukbm 	= $selectview->list_ukbm_pertemuan($idtingkat, $idpelajaran, $semester_id);
							$dataukbm 	= $sqlukbm->fetch(PDO::FETCH_OBJ); 
							$jumlah_ukbm= $dataukbm->jumlah_ukbm;
							
							//cek KKM
							$sqlkkm = $select->list_pelajaran($idpelajaran);
							$datakkm = $sqlkkm->fetch(PDO::FETCH_OBJ);
							$kkm_pengetahuan = $datakkm->info2;
							$kkm_keterampilan = $datakkm->token;
							
						?>
						<tr style="font-size: 12px;">
                            <th>No.</th>
                            <th>NIS</th>
                            <th>Nama Lengkap</th>
                            <?php
								for($n=1; $n<=$jumlah_ukbm; $n++) {									
							?>
									<td align="center">N-<?php echo $n ?></td>
							<?php
								}
							?>
                            <td align="center">PAS</td>
							<td align="center">Jumlah</td>
							<td align="center">Rata2 Harian</td>
							<?php /*if($iddasarpenilaian == 3) { ?>
								<td align="center">Rata2 Harian</td>
							<?php } ?>
							<?php if($iddasarpenilaian == 4) { ?>
								<td align="center">Tertinggi Harian</td>
							<?php }*/ ?>
							<!--<td align="center">x 75%</td>-->
							
							<!--<td align="center">x 25%</td>-->
							<!--<td align="center">NA</td>
							<td align="center">&nbsp;</td>
							<td align="center">A</td>-->
							<td align="center">Nilai Raport</td>
							<td align="center">Sakit</td>
							<td align="center">Izin</td>
							<td align="center">Alpa</td>
							<td align="center">Dispensasi</td>
							<td align="center">Sikap</td>
							<td align="center"></td>
						</tr>
					</thead>

					<tbody>
                        <?php			
                        	//cek penugasan guru
                        	if(allow_guru_kelas('', $_SESSION['idguru'], $idtingkat, $idkelas) != "" || $_SESSION['adm'] == 1) {
                        
                        		if($alumni == 1) {
									$sql=$selectview->list_siswa_riwayat('', '', $idtingkat, $idkelas, $nama, $all, 'SMA', '', '', '1', '1');
									
								} else {
	                        		if($old == 0) {
										$sql=$selectview->list_siswa('', '', $idtingkat, $idkelas, $nama, $all, 'SMA', '', '', '1');
									} else {
										$sql=$selectview->list_siswa_riwayat('', '', $idtingkat, $idkelas, $nama, $all, 'SMA', '', '', '1');
									}
								}
								
								
								$rowsiswa=$sql->rowCount();
								while($siswa_view=$sql->fetch(PDO::FETCH_OBJ)){
								
								$idsiwa = $siswa_view->replid;
								
								$i++;
								
									if($idtahunajaran == "") {
										$idtahunajaran = $_SESSION['idtahunajaran'];
									}
									
									$sqlnilai 	= $select->list_daftarnilai($siswa_view->replid, $idtingkat, $idkelas, $idtahunajaran, $semester_id, $idpelajaran, $iddasarpenilaian, $siswa_view->nis);
									$siswa_get	= $sqlnilai->fetch(PDO::FETCH_OBJ);
									
									//proteksi PAS
									$input_pas = $protection->input_pas_mapel($_SESSION['idpegawai'], $idpelajaran);
							?>
	                                
	                                <input type="hidden" id="jmldata" name="jmldata" value="<?php echo $rowsiswa ?>" >
	                                <input type="hidden" id="jumlah_ukbm" name="jumlah_ukbm" value="<?php echo $jumlah_ukbm ?>">
	                                <input type="hidden" id="nis<?php echo $i ?>" name="nis<?php echo $i ?>" value="<?php echo $siswa_view->replid ?>" >
	                                <input type="hidden" id="line<?php echo $i ?>" name="line<?php echo $i ?>" value="<?php echo $i ?>" >
	                                    
	                                <tr style="font-size: 11px">
	                                    <td align="center"><?php echo $i ?></td>
	                                    <td><?php echo $siswa_view->nis ?></td>
										<td><?php echo $siswa_view->nama ?></td>
										
										<?php 
											if($siswa_get->rata == 0 || $siswa_get->rata == "") {
												for($b=1; $b<=$jumlah_ukbm; $b++) {
												
										?>		
												<td><input type="text" style="width:50px; height: 30px; text-align: center;" name="n<?php echo $b.$i.$idsiwa ?>" id="n<?php echo $b.$i.$idsiwa ?>" onkeyup="formatangka('n<?php echo $b.$i.$idsiwa ?>'),detailvalue('<?php echo $i ?>', '<?php echo $jumlah_ukbm ?>','<?php echo $idsiwa ?>')" value="<?php echo $siswa_get->n1 ?>"/>
												</td>
												
												<input type="hidden" name="line_det<?php echo $b.$i.$idsiwa ?>" id="line_det<?php echo $b.$i.$idsiwa ?>" value="<?php echo $b ?>"/>
										<?php
												}
											} else {
												$b = 1;
												$sqlndetail = $select->list_daftarnilai_detail($siswa_get->replid);
												$jumlah_ukbm_upd = $sqlndetail->rowCount();
												while($datanilai_detail=$sqlndetail->fetch(PDO::FETCH_OBJ)) {
													
										?>
												
												<td><input type="text" style="width:50px; height: 30px; text-align: center;" name="n<?php echo $b.$i.$idsiwa ?>" id="n<?php echo $b.$i.$idsiwa ?>" onkeyup="formatangka('n<?php echo $b.$i.$idsiwa ?>'),detailvalue('<?php echo $i ?>', '<?php echo $jumlah_ukbm ?>','<?php echo $idsiwa ?>')" value="<?php echo $datanilai_detail->nilai ?>"/>
												<input type="hidden" name="line_det<?php echo $b.$i.$idsiwa ?>" id="line_det<?php echo $b.$i.$idsiwa ?>" value="<?php echo $datanilai_detail->line ?>"/>
												</td>
												
										<?php
													$b++;
												}
												
												for($b=$jumlah_ukbm_upd+1; $b<=$jumlah_ukbm; $b++) {
										?>			
													<td><input type="text" style="width:50px; height: 30px; text-align: center;" name="n<?php echo $b.$i.$idsiwa ?>" id="n<?php echo $b.$i.$idsiwa ?>" onkeyup="formatangka('n<?php echo $b.$i.$idsiwa ?>'),detailvalue('<?php echo $i ?>', '<?php echo $jumlah_ukbm ?>','<?php echo $idsiwa ?>')" value="<?php echo $siswa_get->n1 ?>"/>
													</td>
												
													<input type="hidden" name="line_det<?php echo $b.$i.$idsiwa ?>" id="line_det<?php echo $b.$i.$idsiwa ?>" value="<?php echo $b ?>"/>
										
										<?php
												}		
											}
										?>
										
										<!--<td><input type="text" style="width:50px; height: 30px; text-align: center;" name="n1<?php echo $i ?>" id="n1<?php echo $i ?>" onkeyup="formatangka('n1<?php echo $i ?>'),detailvalue('<?php echo $i ?>')" value="<?php echo $siswa_get->n1 ?>"/></td>
						
										<td><input type="text" style="width:50px; height: 30px; text-align: center;" name="n2<?php echo $i ?>" id="n2<?php echo $i ?>" onkeyup="formatangka('n2<?php echo $i ?>'),detailvalue('<?php echo $i ?>')" value="<?php echo $siswa_get->n2 ?>"/></td>
										
										<td><input type="text" style="width:50px; height: 30px; text-align: center;"  name="n3<?php echo $i ?>" id="n3<?php echo $i ?>" onkeyup="formatangka('n3<?php echo $i ?>'),detailvalue('<?php echo $i ?>')" value="<?php echo $siswa_get->n3 ?>"/></td>
										
										<td><input type="text" style="width:50px; height: 30px; text-align: center;"  name="n4<?php echo $i ?>" id="n4<?php echo $i ?>" onkeyup="formatangka('n4<?php echo $i ?>'),detailvalue('<?php echo $i ?>')" value="<?php echo $siswa_get->n4 ?>"/></td>-->
										
										<input type="hidden" style="width:50px; height: 30px; text-align: center;"  name="uts<?php echo $i ?>" id="uts<?php echo $i ?>" onkeyup="formatangka('uts<?php echo $i ?>'),detailvalue('<?php echo $i ?>', '<?php echo $jumlah_ukbm ?>','<?php echo $idsiwa ?>')" value="<?php echo $siswa_get->uts ?>"/>
										
										<!--<td><input type="text" style="width:50px; height: 30px; text-align: center;"  name="uts<?php echo $i ?>" id="uts<?php echo $i ?>" onkeyup="formatangka('uts<?php echo $i ?>'),detailvalue('<?php echo $i ?>', '<?php echo $jumlah_ukbm ?>')" value="<?php echo $siswa_get->uts ?>"/></td>-->
										
										<?php if(allowlvl("frmdaftarnilai") == 2 || $input_pas == 1) { ?>
											<td><input type="text" style="width:50px; height: 30px; text-align: center;"  name="uas<?php echo $i ?>" id="uas<?php echo $i ?>" onkeyup="formatangka('uas<?php echo $i ?>'),detailvalue('<?php echo $i ?>', '<?php echo $jumlah_ukbm ?>','<?php echo $idsiwa ?>')" value="<?php echo $siswa_get->uas ?>"/></td>
										<?php } else { ?>
											<td><input type="text" style="width:50px; height: 30px; text-align: center;"  name="uas<?php echo $i ?>" id="uas<?php echo $i ?>" readonly="" value="<?php echo $siswa_get->uas ?>"/></td>
										<?php } ?>
										
										
										<td id="jumlah_<?php echo $i ?>" ><input type="text" style="width:50px; height: 30px; background-color: #bbfaab; text-align: center;"  name="jumlah<?php echo $i ?>" id="jumlah<?php echo $i ?>" readonly value="<?php echo $siswa_get->jumlah ?>" /></td>
										
										<td id="rata_<?php echo $i ?>" ><input type="text" style="width:50px; height: 30px; background-color: #bbfaab; text-align: center;"  name="rata<?php echo $i ?>" id="rata<?php echo $i ?>" readonly value="<?php echo number_format($siswa_get->rata,1,'.',',') ?>"/></td>
										
										<input type="hidden" style="width:50px; height: 30px; background-color: #bbfaab; text-align: center;"  name="persen<?php echo $i ?>" id="persen<?php echo $i ?>" readonly value="<?php echo $siswa_get->persen ?>"/>
										<!--<td id="persen_<?php echo $i ?>" ><input type="text" style="width:50px; height: 30px; background-color: #bbfaab; text-align: center;"  name="persen<?php echo $i ?>" id="persen<?php echo $i ?>" readonly value="<?php echo $siswa_get->persen ?>"/></td>-->
										
										<input type="hidden" style="width:50px; height: 30px; background-color: #bbfaab; text-align: center;"  name="persen1<?php echo $i ?>" id="persen1<?php echo $i ?>" readonly value="<?php echo $siswa_get->persen1 ?>"/>
										<!--<td id="persen1_<?php echo $i ?>" ><input type="text" style="width:50px; height: 30px; background-color: #bbfaab; text-align: center;"  name="persen1<?php echo $i ?>" id="persen1<?php echo $i ?>" readonly value="<?php echo $siswa_get->persen1 ?>"/></td>-->
										
										<input type="hidden" style="width:50px; height: 30px; background-color: #bbfaab; text-align: center;"  name="na<?php echo $i ?>" id="na<?php echo $i ?>" readonly value="<?php echo $siswa_get->na ?>"/>
										
										<?php
											$kkm_color = "";
											if($siswa_get->na < $kkm_pengetahuan) {
												$kkm_color = "color:#ff0000";
											} 
										?>
										
										<td id="na_<?php echo $i ?>" ><input type="text" style="width:50px; height: 30px; background-color: #bbfaab; text-align: center; <?php echo $kkm_color ?> "  name="na<?php echo $i ?>" id="na<?php echo $i ?>" readonly value="<?php echo number_format($siswa_get->na,0,'.',',') ?>"/></td>
										
										<!--<td>&nbsp;</td>-->
										
										<input type="hidden" style="width:50px; height: 30px; background-color: #bbfaab; text-align: center;"  name="a<?php echo $i ?>" id="a<?php echo $i ?>" readonly value="<?php echo $siswa_get->a ?>"/>
										<!--<td id="a_<?php echo $i ?>" ><input type="text" style="width:50px; height: 30px; background-color: #bbfaab; text-align: center;"  name="a<?php echo $i ?>" id="a<?php echo $i ?>" readonly value="<?php echo $siswa_get->a ?>"/></td>-->
										<td id="sakit_<?php echo $i ?>" ><input type="text" style="width:50px; height: 30px; background-color: #bbfaab; text-align: center;"  name="sakit<?php echo $i ?>" id="sakit<?php echo $i ?>" onkeyup="formatangka('sakit<?php echo $i ?>')" value="<?php echo $siswa_get->sakit ?>"/></td>
										<td id="izin_<?php echo $i ?>" ><input type="text" style="width:50px; height: 30px; background-color: #bbfaab; text-align: center;"  name="izin<?php echo $i ?>" id="izin<?php echo $i ?>" onkeyup="formatangka('izin<?php echo $i ?>')" value="<?php echo $siswa_get->izin ?>"/></td>
										<td id="alpa_<?php echo $i ?>" ><input type="text" style="width:50px; height: 30px; background-color: #bbfaab; text-align: center;"  name="alpa<?php echo $i ?>" id="alpa<?php echo $i ?>" onkeyup="formatangka('alpa<?php echo $i ?>')" value="<?php echo $siswa_get->alpa ?>"/></td>
										<td id="dispensasi_<?php echo $i ?>" ><input type="text" style="width:50px; height: 30px; background-color: #bbfaab; text-align: center;"  name="dispensasi<?php echo $i ?>" id="dispensasi<?php echo $i ?>" onkeyup="formatangka('dispensasi<?php echo $i ?>')" value="<?php echo $siswa_get->dispensasi ?>"/></td>
										<td id="sikap_<?php echo $i ?>" ><input type="text" style="width:50px; height: 30px; background-color: #bbfaab; text-align: center;"  name="sikap<?php echo $i ?>" id="sikap<?php echo $i ?>" value="<?php echo $siswa_get->sikap ?>"/></td>
										
										<td>
											<!--<a href="#" class="label label-success" onClick="JavaScript:viewnilai('<?php echo $idpelajaran ?>','<?php echo $departemen ?>','<?php echo $idtingkat ?>','<?php echo $idkelas ?>','<?php echo $nama ?>','<?php echo $idkompetensi ?>','<?php echo $idjeniskompetensi ?>','<?php echo $iddasarpenilaian ?>','<?php echo $idsemester ?>','<?php echo $siswa_view->nis ?>')" ><span class="hidden-tablet"> tampilkan nilai</span></a>-->
											
										</td>
	                                    
									</tr>
                            
                            <?php
                                	}
								} else {
									$message = '<font color="#ff0000">' . "Ma'af Guru tersebut tidak mengajar di kelas ini";
									$message = $message . "</font>";
									echo $message."<br><br>";
								}
                            ?>
                            
					</tbody>
				</table>
				
				<?php if( ($protection->setup_periode("RAPORT", $date) == 1 || allowlvl("frmdaftarnilai") == 2) && $input_nilai == 1 ) { ?>					
					<div class="clearfix form-actions">
						<div class="col-md-offset-3 col-md-9">
	                        
	                       
		                    <?php if($ref!='') { ?>
								<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
							<?php } ?>
		                    
							                        
		                    
							<?php if($ref=='') { ?>
								<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" onClick="return confirm('Apakah yakin data sudah benar?')" />
							<?php } ?>
	                        
	                        <?php if (allowdel('frmclient_cheque')==1) { ?>
	                            &nbsp;
	    						<input type="submit" name="submit" class="btn btn-danger" value="Delete" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
	                        <?php } ?>
	                        
	                        
	                        
							<!--&nbsp;
							<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . obraxabrix(client_cheque_view) ?>'" />-->
							
							            
	                                 
						</div>
					</div>
				<?php } ?>
				
			</form>
            
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->



<!--[if !IE]> -->
<script type="text/javascript">
	window.jQuery || document.write("<script src='../<?php echo $__folder ?>assets/js/jquery.min.js'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='../<?php echo $__folder ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="../<?php echo $__folder ?>assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
  <script src="../<?php echo $__folder ?>assets/js/excanvas.min.js"></script>
<![endif]-->
<script src="../<?php echo $__folder ?>assets/js/jquery-ui.custom.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/chosen.jquery.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/fuelux.spinner.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/bootstrap-timepicker.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/moment.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/daterangepicker.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/bootstrap-colorpicker.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/jquery.knob.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/jquery.autosize.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/jquery.maskedinput.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/bootstrap-tag.min.js"></script>

<script src="../<?php echo $__folder ?>assets/js/jquery.dataTables.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/dataTables.tableTools.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/dataTables.colVis.min.js"></script>

<!-- ace scripts -->
<script src="../<?php echo $__folder ?>assets/js/ace-elements.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
	jQuery(function($) {
		$('#id-disable-check').on('click', function() {
			var inp = $('#form-input-readonly').get(0);
			if(inp.hasAttribute('disabled')) {
				inp.setAttribute('readonly' , 'true');
				inp.removeAttribute('disabled');
				inp.value="This text field is readonly!";
			}
			else {
				inp.setAttribute('disabled' , 'disabled');
				inp.removeAttribute('readonly');
				inp.value="This text field is disabled!";
			}
		});
	
	
		if(!ace.vars['touch']) {
			$('.chosen-select').chosen({allow_single_deselect:true}); 
			//resize the chosen on window resize
	
			$(window)
			.off('resize.chosen')
			.on('resize.chosen', function() {
				$('.chosen-select').each(function() {
					 var $this = $(this);
					 $this.next().css({'width': $this.parent().width()});
				})
			}).trigger('resize.chosen');
			//resize chosen on sidebar collapse/expand
			$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
				if(event_name != 'sidebar_collapsed') return;
				$('.chosen-select').each(function() {
					 var $this = $(this);
					 $this.next().css({'width': $this.parent().width()});
				})
			});
	
	
			$('#chosen-multiple-style .btn').on('click', function(e){
				var target = $(this).find('input[type=radio]');
				var which = parseInt(target.val());
				if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
				 else $('#form-field-select-4').removeClass('tag-input-style');
			});
		}
	
	
		$('[data-rel=tooltip]').tooltip({container:'body'});
		$('[data-rel=popover]').popover({container:'body'});
		
		$('textarea[class*=autosize]').autosize({append: "\n"});
		$('textarea.limited').inputlimiter({
			remText: '%n character%s remaining...',
			limitText: 'max allowed : %n.'
		});
	
		$.mask.definitions['~']='[+-]';
		$('.input-mask-date').mask('99/99/9999');
		$('.input-mask-phone').mask('(999) 999-9999');
		$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
		$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
	
	
	
		$( "#input-size-slider" ).css('width','200px').slider({
			value:1,
			range: "min",
			min: 1,
			max: 8,
			step: 1,
			slide: function( event, ui ) {
				var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
				var val = parseInt(ui.value);
				$('#form-field-4').attr('class', sizing[val]).val('.'+sizing[val]);
			}
		});
	
		$( "#input-span-slider" ).slider({
			value:1,
			range: "min",
			min: 1,
			max: 12,
			step: 1,
			slide: function( event, ui ) {
				var val = parseInt(ui.value);
				$('#form-field-5').attr('class', 'col-xs-'+val).val('.col-xs-'+val);
			}
		});
	
	
		
		//"jQuery UI Slider"
		//range slider tooltip example
		$( "#slider-range" ).css('height','200px').slider({
			orientation: "vertical",
			range: true,
			min: 0,
			max: 100,
			values: [ 17, 67 ],
			slide: function( event, ui ) {
				var val = ui.values[$(ui.handle).index()-1] + "";
	
				if( !ui.handle.firstChild ) {
					$("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
					.prependTo(ui.handle);
				}
				$(ui.handle.firstChild).show().children().eq(1).text(val);
			}
		}).find('span.ui-slider-handle').on('blur', function(){
			$(this.firstChild).hide();
		});
		
		
		$( "#slider-range-max" ).slider({
			range: "max",
			min: 1,
			max: 10,
			value: 2
		});
		
		$( "#slider-eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
			// read initial values from markup and remove that
			var value = parseInt( $( this ).text(), 10 );
			$( this ).empty().slider({
				value: value,
				range: "min",
				animate: true
				
			});
		});
		
		$("#slider-eq > span.ui-slider-purple").slider('disable');//disable third item
	
		
		$('#photo , #photo_1, #photo_2, #photo_3, #photo_4').ace_file_input({
			no_file:'No File ...',
			btn_choose:'Choose',
			btn_change:'Change',
			droppable:false,
			onchange:null,
			thumbnail:false //| true | large
			//whitelist:'gif|png|jpg|jpeg'
			//blacklist:'exe|php'
			//onchange:''
			//
		});
		//pre-show a file name, for example a previously selected file
		//$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])
	
	
		$('#id-input-file-3').ace_file_input({
			style:'well',
			btn_choose:'Drop files here or click to choose',
			btn_change:null,
			no_icon:'ace-icon fa fa-cloud-upload',
			droppable:true,
			thumbnail:'small'//large | fit
			//,icon_remove:null//set null, to hide remove/reset button
			/**,before_change:function(files, dropped) {
				//Check an example below
				//or examples/file-upload.html
				return true;
			}*/
			/**,before_remove : function() {
				return true;
			}*/
			,
			preview_error : function(filename, error_code) {
				//name of the file that failed
				//error_code values
				//1 = 'FILE_LOAD_FAILED',
				//2 = 'IMAGE_LOAD_FAILED',
				//3 = 'THUMBNAIL_FAILED'
				//alert(error_code);
			}
	
		}).on('change', function(){
			//console.log($(this).data('ace_input_files'));
			//console.log($(this).data('ace_input_method'));
		});
		
		
		//$('#id-input-file-3')
		//.ace_file_input('show_file_list', [
			//{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
			//{type: 'file', name: 'hello.txt'}
		//]);
	
		
		
	
		//dynamically change allowed formats by changing allowExt && allowMime function
		$('#id-file-format').removeAttr('checked').on('change', function() {
			var whitelist_ext, whitelist_mime;
			var btn_choose
			var no_icon
			if(this.checked) {
				btn_choose = "Drop images here or click to choose";
				no_icon = "ace-icon fa fa-picture-o";
	
				whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
				whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
			}
			else {
				btn_choose = "Drop files here or click to choose";
				no_icon = "ace-icon fa fa-cloud-upload";
				
				whitelist_ext = null;//all extensions are acceptable
				whitelist_mime = null;//all mimes are acceptable
			}
			var file_input = $('#id-input-file-3');
			file_input
			.ace_file_input('update_settings',
			{
				'btn_choose': btn_choose,
				'no_icon': no_icon,
				'allowExt': whitelist_ext,
				'allowMime': whitelist_mime
			})
			file_input.ace_file_input('reset_input');
			
			file_input
			.off('file.error.ace')
			.on('file.error.ace', function(e, info) {
				//console.log(info.file_count);//number of selected files
				//console.log(info.invalid_count);//number of invalid files
				//console.log(info.error_list);//a list of errors in the following format
				
				//info.error_count['ext']
				//info.error_count['mime']
				//info.error_count['size']
				
				//info.error_list['ext']  = [list of file names with invalid extension]
				//info.error_list['mime'] = [list of file names with invalid mimetype]
				//info.error_list['size'] = [list of file names with invalid size]
				
				
				/**
				if( !info.dropped ) {
					//perhapse reset file field if files have been selected, and there are invalid files among them
					//when files are dropped, only valid files will be added to our file array
					e.preventDefault();//it will rest input
				}
				*/
				
				
				//if files have been selected (not dropped), you can choose to reset input
				//because browser keeps all selected files anyway and this cannot be changed
				//we can only reset file field to become empty again
				//on any case you still should check files with your server side script
				//because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
			});
		
		});
	
		$('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
		.closest('.ace-spinner')
		.on('changed.fu.spinbox', function(){
			//alert($('#spinner1').val())
		}); 
		$('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
		$('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
		$('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});
	
		//$('#spinner1').ace_spinner('disable').ace_spinner('value', 11);
		//or
		//$('#spinner1').closest('.ace-spinner').spinner('disable').spinner('enable').spinner('value', 11);//disable, enable or change value
		//$('#spinner1').closest('.ace-spinner').spinner('value', 0);//reset to 0
	
	
		//datepicker plugin
		//link
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		})
		//show datepicker when clicking on the icon
		.next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
	
		//or change it into a date range picker
		$('.input-daterange').datepicker({autoclose:true});
	
	
		//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
		$('input[name=date-range-picker]').daterangepicker({
			'applyClass' : 'btn-sm btn-success',
			'cancelClass' : 'btn-sm btn-default',
			locale: {
				applyLabel: 'Apply',
				cancelLabel: 'Cancel',
			}
		})
		.prev().on(ace.click_event, function(){
			$(this).next().focus();
		});
	
	
		$('#timepicker1').timepicker({
			minuteStep: 1,
			showSeconds: true,
			showMeridian: false
		}).next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
		
		$('#date-timepicker1').datetimepicker().next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
		
	
		$('#colorpicker1').colorpicker();
	
		$('#simple-colorpicker-1').ace_colorpicker();
		//$('#simple-colorpicker-1').ace_colorpicker('pick', 2);//select 2nd color
		//$('#simple-colorpicker-1').ace_colorpicker('pick', '#fbe983');//select #fbe983 color
		//var picker = $('#simple-colorpicker-1').data('ace_colorpicker')
		//picker.pick('red', true);//insert the color if it doesn't exist
	
	
		$(".knob").knob();
		
		
		var tag_input = $('#form-field-tags');
		try{
			tag_input.tag(
			  {
				placeholder:tag_input.attr('placeholder'),
				//enable typeahead by specifying the source array
				source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
				/**
				//or fetch data from database, fetch those that match "query"
				source: function(query, process) {
				  $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
				  .done(function(result_items){
					process(result_items);
				  });
				}
				*/
			  }
			)
	
			//programmatically add a new
			var $tag_obj = $('#form-field-tags').data('tag');
			$tag_obj.add('Programmatically Added');
		}
		catch(e) {
			//display a textarea for old IE, because it doesn't support this plugin or another one I tried!
			tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
			//$('#form-field-tags').autosize({append: "\n"});
		}
		
		
		/////////
		$('#modal-form input[type=file]').ace_file_input({
			style:'well',
			btn_choose:'Drop files here or click to choose',
			btn_change:null,
			no_icon:'ace-icon fa fa-cloud-upload',
			droppable:true,
			thumbnail:'large'
		})
		
		//chosen plugin inside a modal will have a zero width because the select element is originally hidden
		//and its width cannot be determined.
		//so we set the width after modal is show
		$('#modal-form').on('shown.bs.modal', function () {
			if(!ace.vars['touch']) {
				$(this).find('.chosen-container').each(function(){
					$(this).find('a:first-child').css('width' , '210px');
					$(this).find('.chosen-drop').css('width' , '210px');
					$(this).find('.chosen-search input').css('width' , '200px');
				});
			}
		})
		/**
		//or you can activate the chosen plugin after modal is shown
		//this way select element becomes visible with dimensions and chosen works as expected
		$('#modal-form').on('shown', function () {
			$(this).find('.modal-chosen').chosen();
		})
		*/
	
		
		
		$(document).one('ajaxloadstart.page', function(e) {
			$('textarea[class*=autosize]').trigger('autosize.destroy');
			$('.limiterBox,.autosizejs').remove();
			$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
		});
	
	});
</script>
