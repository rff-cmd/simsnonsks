<?php
session_start();
if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include_once ("include/queryfunctions.php");
include_once ("include/functions.php");

include '../app/class/class.select.php';
include '../app/class/class.select.view.php';

$select=new select;
$select_view=new select_view;

?>

<script type="text/javascript" src="js/buttonajax.js"></script>

<script>
	
		 
	function cari_siswa(nama) {
		nama = "";
		newWindow('finance/carisiswa_terima.php', 'CariRekening','550','438','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
	
	function accept_siswa(nis, nama) {
		document.getElementById('tnis').value = nis;
		document.getElementById('tnama').value = nama;
		
		getpenerimaan_get(nis);
	}
</script>

<?php

require_once('finance/include/theme.php');

$nis			=	$_REQUEST['nis'];

$departemen 	= 	$_REQUEST['departemen'];
$idtingkat	 	= 	$_REQUEST['idtingkat'];
$idkelas	 	= 	$_REQUEST['idkelas'];
$nama		 	= 	$_REQUEST['nama'];
$idsemester		=	$_REQUEST['idsemester'];

$dbpdo = DB::create();

$sql=$select->list_tingkat($idtingkat);
$sql->execute();
$data=$sql->fetch(PDO::FETCH_OBJ);
$tingkat=$data->tingkat; 

$sql=$select->list_kelas($idkelas);
$sql->execute();
$data=$sql->fetch(PDO::FETCH_OBJ);
$kelas=$data->kelas; 

	
?>		
		
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html>
<head>

<link rel="stylesheet" type="text/css" href="finance/style/style.css">
<link rel="stylesheet" type="text/css" href="finance/style/calendar-green.css">
<link rel="stylesheet" type="text/css" href="finance/style/tooltips.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIAS - Laporan Evaluasi Psikotes per Level</title>

<script language="javascript">
function ValidateSubmit() 
{
	
	document.getElementById('issubmit').value = 1;
	document.main.submit();	
	
}

function ValidateSubmit1() 
{
	
	document.getElementById('issubmit').value = 2;
	document.main.submit();
}

function val2()
{
	if (confirm('Data sudah benar?'))
		return true;
	else 
		return false;
}

function validasiAngka() 
{
	angka = document.getElementById('angkacicilan').value;
	if(isNaN(angka)) 
	{
		alert ('Besarnya cicilan harus berupa bilangan!');
		document.getElementById('jcicilan').focus();
		return false;
	}
	else if(angka <= 0)
	{
		alert ('Besarnya cicilan harus positif!');
		document.getElementById('jcicilan').focus();
		return false;
	}
	return true;
}

function salinangka()
{	
	var angka = document.getElementById("jcicilan").value;
	document.getElementById("angkacicilan").value = angka;
}

function focusNext(elemName, evt) 
{
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode :
        ((evt.which) ? evt.which : evt.keyCode);
    if (charCode == 13) 
	 {
		document.getElementById(elemName).focus();
      return false;
    }
    return true;
}

</script>


</head>

<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" >

<table class="table" border="0" cellpadding="0" cellspacing="0" width="150%">
<tr height="58">
	<td>&nbsp;</td>
    <td width="*">
	<div align="center" style="color:#000; font-size:16px; font-weight:bold">
    .: Laporan Evaluasi Psikologi per Level :.
    </div>
	</td>
    <td>&nbsp;</td>
</tr>


<tr height="*">
	<td>&nbsp;</td>
    <td style="background-color:#FFFFFF">
    
    	
	    <table class="table" border="1" width="150%" align="left" cellspacing="0" style="border: 1px dot #ccc" >
	    
	    	<tr style="font-weight: bold; text-align: left;">
				<td align="center" rowspan="2">No</td>
				<td align="center">Level-<?php echo $tingkat ?></td>
				<td align="center" rowspan="2">IQ</td>
								
				<?php
					$sql = $select->list_aspek_psikologi("", $departemen);
					$jmldata_jenis_aspek = $sql->rowCount();
					while($data_aspek=$sql->fetch(PDO::FETCH_OBJ)) {
						
						$sql2 = $select->list_aspek_psikologi_detail("", $data_aspek->replid);
						$jml_aspek_detail = $sql2->rowCount();
						$totalcol = $totalcol + $jml_aspek_detail;
				?>
				
						<td align="center" colspan="<?php echo $jml_aspek_detail ?>"><?php echo $data_aspek->aspek ?></td>
						
				<?php
					}
				?>
			</tr>
			
			<tr style="font-weight: bold; text-align: left;">
				<td align="center">Nama</td>
								
				<?php
					$sql = $select->list_aspek_psikologi("", $departemen);
					$jmldata_jenis_aspek = $sql->rowCount();
					while($data_aspek=$sql->fetch(PDO::FETCH_OBJ)) {
						
						$sql2 = $select->list_aspek_psikologi_detail("", $data_aspek->replid);
						$jml_aspek_detail = $sql2->rowCount();
						while($data_aspek_detail=$sql2->fetch(PDO::FETCH_OBJ)) {
				?>
				
						
							<td><?php echo $data_aspek_detail->aspek ?></td>
						
				<?php
						}
					}
				?>
			</tr>
			
			<?php
				$totalnilai = array();
				$no = 0;
				$sqlsiswa = $select_view->list_siswa("", "", $idtingkat, $idkelas, $nama, "");
				while($data_siswa=$sqlsiswa->fetch(PDO::FETCH_OBJ)) {
					
					$no++;
					
					$sqliq = $select->list_evaluasi_psikologi_iq("", $departemen, $idtingkat, $idkelas, $data_siswa->nis, $idsemester);
					$dataiq = $sqliq->fetch(PDO::FETCH_OBJ);
			?>
						
					<tr style="text-align: left;">
						<td align="center"><?php echo $no ?>.</td>
						<td><?php echo $data_siswa->nama ?></td>
						<td><?php echo $dataiq->iq ?></td>
						
						<?php
							$sqlnilai = $select->list_evaluasi_psikologi_nilai($ref, $dataiq->jenis_aspek_id, $dataiq->aspek_psikologi_id, $departemen, $idtingkat, $idkelas, $data_siswa->nis, $idsemester);
							$rowscnt = $sqlnilai->rowCount();
							
							if($rowscnt > 0) {
								
		        				while($datanilai = $sqlnilai->fetch(PDO::FETCH_OBJ)) {
									$nilai = $datanilai->nilai;
									
			        				if($datanilai->nilai == 0) {
										$nilai = "&nbsp;";
									}
						?>
								
									<td align="center"><?php echo $nilai ?></td>
						<?php
								}
							} else {
								$sql2 = $select->list_aspek_psikologi_detail("", $dataiq->jenis_aspek_id);
								$jml_aspek_detail = $sql2->rowCount();
								
								//$totalcol = $totalcol + $jml_aspek_detail;
								for($x=0; $x<$jml_aspek_detail; $x++) {
						?>
									<td>&nbsp;</td>
						<?php	
								}	
							}
	        				
						?>
						
					</tr>
			
			<?php
				}
			?>
			
			<tr style="font-weight: bold; text-align: left;">
				<td align="center" colspan="3">
					Jumlah
				</td>
				<?php
					for($x=0; $x<$totalcol; $x++) {
				?>
						<td><?php echo $totalnilai[$x]; ?></td>
				<?php
					}
				?>
			</tr>
			
		</table>
		<!----end ----------->

<!-- END OF CONTENT //--->
    </td>
    
    <td>&nbsp;</td>
</tr>

</table>


</body>
</html>