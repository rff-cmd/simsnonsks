<?php
@session_start();
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
				
				<td align="center" rowspan="2">Jumlah</td>
			</tr>
			
			<tr style="font-weight: bold; text-align: left;">
				<td align="center">Nama</td>
								
				<?php
					$aspek_psikologi = array();
					$psikologi_detail = array();
					
					$sql = $select->list_aspek_psikologi("", $departemen);
					$jmldata_jenis_aspek = $sql->rowCount();
					$b = 0;
					while($data_aspek=$sql->fetch(PDO::FETCH_OBJ)) {
						
						$aspek_psikologi[] = $data_aspek->replid;
						
						$sql2 = $select->list_aspek_psikologi_detail("", $data_aspek->replid);
						$jml_aspek_detail = $sql2->rowCount();
						
						$t = 0;
						while($data_aspek_detail=$sql2->fetch(PDO::FETCH_OBJ)) {
							
							$psikologi_detail[$b][] = $data_aspek_detail->replid;
				?>
				
						
							<td><?php echo $data_aspek_detail->aspek ?></td>
						
				<?php
							$t++;
						}
						
						$b++;
					}
				?>
				
				
			</tr>
			
			<?php
				$totalnilai_col = array();
				$totalnilai_row2 = array();
				
				$no = 0;
				$sqlsiswa = $select_view->list_siswa("", "", $idtingkat, $idkelas, $nama, "");
				//$rowssiswa = $sqlsiswa->rowCount();
				while($data_siswa=$sqlsiswa->fetch(PDO::FETCH_OBJ)) {
					
					$rowssiswa[] = $no;
					
					$no++;
					
					$sqliq = $select->list_evaluasi_psikologi_iq("", $departemen, $idtingkat, $idkelas, $data_siswa->nis, $idsemester);
					$dataiq = $sqliq->fetch(PDO::FETCH_OBJ);
			?>
						
					<tr style="text-align: left;">
						<td align="center"><?php echo $no ?>.</td>
						<td><?php echo $data_siswa->nama ?></td>
						<td><?php echo $dataiq->iq ?></td>
						
						<?php
							
							$totalnilai_row = array();
							$totnilai = 0;
							for($s=0; $s<count($aspek_psikologi); $s++) {
								
								
								for($u=0; $u<count($psikologi_detail[$s]); $u++) {
									
									$jenis_aspek = $aspek_psikologi[$s];
									$aspek_detail = $psikologi_detail[$s][$u];
									
									$sqlnilai = $select->list_evaluasi_psikologi_nilai($ref, $jenis_aspek, $aspek_detail, $departemen, $idtingkat, $idkelas, $data_siswa->nis, $idsemester);
									$datanilai = $sqlnilai->fetch(PDO::FETCH_OBJ);
									
									##set nilai
									$nilai = $datanilai->nilai;
									$totnilai = $totnilai + $nilai;
									$nilaix = $datanilai->nilai;									
																		
			        				if($datanilai->nilai == 0) {
										$nilai = "&nbsp;";
										$nilaix = 0;
									}
									
									$totalnilai_row[] = $nilaix;
						?>
									<td align="center"><?php echo $nilai ?></td>
						<?php
								}								
							}
						?>
							
						<td align="center" style="font-weight: bold"><?php echo $totnilai ?></td>
												
					</tr>
			
			<?php
					
					$totalnilai_row2[] = $totalnilai_row;
					
				}
				
				
			?>
			
			
			<tr style="font-weight: bold; text-align: left;">
				<td align="center" colspan="3">
					Jumlah
				</td>
				<?php
					
					$total_low = 0;					
					for($s=0; $s<count($aspek_psikologi); $s++) {
						
						for($u=0; $u<count($psikologi_detail[$s]); $u++) {
							
							$jenis_aspek = $aspek_psikologi[$s];
							$aspek_detail = $psikologi_detail[$s][$u];
							
							$sqlnilai = $select->list_evaluasi_psikologi_totalnilai($jenis_aspek, $aspek_detail, $departemen, $idtingkat, $idkelas, $idsemester);
							$datanilai = $sqlnilai->fetch(PDO::FETCH_OBJ);
							
							
				?>
							<td align="center" style="<?php echo $color_low ?>"><?php echo $datanilai->totalnilai; ?></td>
				<?php
						}
					}
				?>
				<td>&nbsp;</td>
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