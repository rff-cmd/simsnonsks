<?php
session_start();
if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include_once ("include/queryfunctions.php");
include_once ("include/functions.php");
?>

<script>
	
	function TimedRefresh( t ) {

		setTimeout("location.reload(true);", t);
		
		for(i=1; i<=10000; i++) {
			t = t - 1;			
		}
		if(t == 0) {
			document.getElementById('tnis').value = "";	
		}
			
	}
	
	function refreshlod() {
		document.getElementById('tnis').value = "";	
	}
	
	function getpenerimaan() {
		var tnis = document.getElementById('tnis').value;
		var jenis_absen = document.getElementById('jenis_absen').value;
		
		if(jenis_absen == "") {
			alert("Jenis Absen belum diisi");
			
			return true;
		}
		
		if(tnis != "") {
			document.location.href = "presensi_absen_siswa.php?nis="+tnis;
		} else {
			document.location.href = "presensi_absen_siswa.php";
		}
		
	}
		 
</script>


<?php

require_once('finance/include/common.php');
require_once('finance/include/rupiah.php');
//require_once('finance/include/config.php');
//require_once('finance/include/db_functions.php');
require_once('finance/include/theme.php');
//require_once('finance/include/sessioninfo.php');
require_once('finance/library/jurnal.php');


$nis 		 = $_REQUEST['nis'];
$jenis_absen = $_REQUEST['jenis_absen'];

$dbpdo = DB::create();

$sqlstr = "SELECT a.idkelas, a.nama, a.alamatsiswa, b.tingkat, c.kelas, b.departemen FROM siswa a left join kelas c on a.idkelas=c.replid left join tingkat b on c.idtingkat = b.replid WHERE a.nis = '$nis'";
$sql=$dbpdo->prepare($sqlstr);
$sql->execute();
$data=$sql->fetch(PDO::FETCH_OBJ);
$nama 		= $data->nama;
$talamat 	= $data->alamatsiswa;
$idkelas	= $data->idkelas;
$kelas 		= $data->tingkat . "-" . $data->kelas;
$departemen	= $data->departemen;
$tanggal 	= date('Y-m-d');
$dlu		= date('Y-m-d H:s');

//===========save start
$sukses_absen = "";
if ( $nis != "") 
{
	$sqlsmt 	= "select replid from semester where departemen='$departemen' and aktif=1 limit 1 ";
	$sql1=$dbpdo->prepare($sqlsmt);
	$sql1->execute();
	$datasmt=$sql1->fetch(PDO::FETCH_OBJ);
	$idsemester	= $datasmt->replid;
	
	$sqlcek 	= "select replid from presensiharian where tanggal1 = '$tanggal' and tanggal2 = '$tanggal' and idkelas = '$idkelas' and idsemester='$idsemester' ";	
	$sql2=$dbpdo->prepare($sqlcek);
	$sql2->execute();
	$rowsph = $sql2->rowCount();
	$dataph=$sql2->fetch(PDO::FETCH_OBJ);
	$idpresensi	= $dataph->replid;
	
	if($rowsph == 0) {
		$sqlsiswa = "select nis from siswa where nis='$nis'";
		$sql3=$dbpdo->prepare($sqlsiswa);
		$sql3->execute();
		$numrowssiswa = $sql3->rowCount();
		
		if($numrowssiswa > 0) {			
			$sqlins	= "insert into presensiharian (idkelas, idsemester, tanggal1, tanggal2, hariaktif, ts, token, issync) values ('$idkelas', '$idsemester', '$tanggal', '$tanggal', 1, '$dlu', 0, 0)";
			$sql3=$dbpdo->prepare($sqlins);
			$sql3->execute();			
		}
		
		$sqlid		= "select last_insert_id() id";
		$sql4=$dbpdo->prepare($sqlid);
		$sql4->execute();
		$dataid=$sql4->fetch(PDO::FETCH_OBJ);
		$idpresensi = $dataid->id;	
			
	} 
	
	//-----------cek presensi harian per siswa
	$sqlcekphs	= "select replid from phsiswa where nis='$nis' and idpresensi='$idpresensi' ";
	$sql5=$dbpdo->prepare($sqlcekphs);
	$sql5->execute();
	$rowsphs=$sql5->rowCount();
			
	if($rowsphs == 0) {
		$sqlsiswa = "select nis from siswa where nis='$nis'";
		$sql6=$dbpdo->prepare($sqlsiswa);
		$sql6->execute();
		$numrowssiswa=$sql6->rowCount();
	
		if($numrowssiswa > 0) {
			if($jenis_absen == "ijin") {
				$sqlphs		= "insert into phsiswa (idpresensi, nis, ijin, keterangan, ts, token, issync) values ('$idpresensi', '$nis', 1, 'Ijin', '$dlu', 0, 0)";
				$sql7=$dbpdo->prepare($sqlphs);
				$sql7->execute();
				$sukses_absen = "ABSEN ANDA BERHASIL";
			}
			
			if($jenis_absen == "sakit") {
				$sqlphs		= "insert into phsiswa (idpresensi, nis, sakit, keterangan, ts, token, issync) values ('$idpresensi', '$nis', 1, 'Sakit', '$dlu', 0, 0)";
				$sql7=$dbpdo->prepare($sqlphs);
				$sql7->execute();
				$sukses_absen = "ABSEN ANDA BERHASIL";
			}
			
			if($jenis_absen == "cuti") {
				$sqlphs		= "insert into phsiswa (idpresensi, nis, cuti, keterangan, ts, token, issync) values ('$idpresensi', '$nis', 1, 'Cuti', '$dlu', 0, 0)";
				$sql7=$dbpdo->prepare($sqlphs);
				$sql7->execute();
				$sukses_absen = "ABSEN ANDA BERHASIL";
			}
			
			if($jenis_absen == "alpa") {
				$sqlphs		= "insert into phsiswa (idpresensi, nis, alpa, keterangan, ts, token, issync) values ('$idpresensi', '$nis', 1, 'Alpa', '$dlu', 0, 0)";
				$sql7=$dbpdo->prepare($sqlphs);
				$sql7->execute();				
				$sukses_absen = "ABSEN ANDA BERHASIL";
			}
		
		} else {
			$sukses_absen = "NIS TIDAK TERDAFTAR";
		}
				
	} else {
		$sukses_absen = "ANDA SUDAH PERNAH ABSEN";
	}	
	//-----------
	
	
?>

	<?php //if($sukses != "") { ?>
	<script>
		//alert('ppppp');
		//document.location.href = "presensi_absen_siswa.php";
		//document.getElementById('tnis').value = "";
	</script>
	<?php //} ?>
<?php
		
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="../../keuangan/style/style.css">
<link rel="stylesheet" type="text/css" href="../../keuangan/style/calendar-green.css">
<link rel="stylesheet" type="text/css" href="../../keuangan/style/tooltips.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Absensi</title>
<script src="../../keuangan/script/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../keuangan/script/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="../../keuangan/script/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="../../keuangan/script/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="../../keuangan/script/tooltips.js" language="javascript"></script>
<script language="javascript" src="../../keuangan/script/tables.js"></script>
<script language="javascript" src="../../keuangan/script/tools.js"></script>
<script language="javascript" src="../../keuangan/script/rupiah.js"></script>
<script language="javascript" src="../../keuangan/script/validasi.js"></script>
<script type="text/javascript" src="../../keuangan/script/calendar.js"></script>
<script type="text/javascript" src="../../keuangan/script/lang/calendar-en.js"></script>
<script type="text/javascript" src="../../keuangan/script/calendar-setup.js"></script>

<!--<script type="text/javascript" src="../keuangan/jsdynamic/jquery.min.js"></script>-->
<!--<script type="text/javascript" src="../../js/buttonajax.js"></script>-->

<script language="javascript">

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

<!----script multi penerimaan--------------->

</head>

<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" style='background-color:#dfdec9' background="" onLoad="document.getElementById('tnis').focus(); JavaScript:refreshlod();">

<!-- JavaScript:TimedRefresh(10000);-->

<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr height="58">
	<td width="28" background="../<?php echo GetThemeDir() ?>bgpop_01.jpg">&nbsp;</td>
    <td width="*" background="../<?php echo GetThemeDir() ?>bgpop_02a.jpg">
	<div align="center" style="color:#FFFFFF; font-size:16px; font-weight:bold">
    .: Presensi Absen Siswa :.
    </div>
	</td>
    <td width="28" background="../<?php echo GetThemeDir() ?>bgpop_03.jpg">&nbsp;</td>
</tr>
<tr height="150">
	<td width="28" background="../<?php echo GetThemeDir() ?>bgpop_04a.jpg">&nbsp;</td>
    <td width="0" style="background-color:#FFFFFF">
    
    <form name="main" method="post" action="" >
    <input type="hidden" name="issubmit" id="issubmit" value="0" />
    <input type="hidden" name="idkategori" id="idkategori" value="<?php echo $idkategori ?>" />
	<input type="hidden" name="idpenerimaan" id="idpenerimaan" value="<?php echo $idpenerimaan ?>" />
	<input type="hidden" name="nis" id="nis" value="<?php echo $nis ?>" />
	<input type="hidden" name="idtahunbuku" id="idtahunbuku" value="<?php echo $idtahunbuku ?>" />
    
    
    <!----multi penerimaan----------->
	<table border="0" align="center" cellspacing="0" cellpadding="5">
		
		<input type="hidden" name="ref" id="ref" size="25" value="<?php echo $ref ?>" >
		
		<tr>
			<td colspan="3" align="center"><strong>Masukkan NIS Anda</strong></td>
	        	        	
		</tr>
		
		<tr>
			<td colspan="2" align="center">
	        <input type="text" name="tnis" id="tnis" size="25" value="<?php echo $nis ?>" onKeyPress="return focusNext('tnama',event), getpenerimaan()" onfocus="tnis" style="font-weight: bold; height: 50px; font-size: 20px;" ></td>
	        	
		</tr>
		
		<tr>
			<td colspan="2" align="center">&nbsp;</td>
	        	        	
		</tr>
		
		<tr>
			<td><strong>Jenis Absen</strong></td>
			<td colspan="2" align="left">
	        	<select name="jenis_absen" id="jenis_absen" style="width:auto; height:27px; " >
	        		<option value=""></option>
					<?php select_jenis_absen("") ?>
				</select>
	        </td>
		</tr>
		
		<tr>
			<td colspan="2" align="center"><strong><?php echo $sukses_absen; ?></strong></td>
	        	        	
		</tr>
		
		<tr>
	        <td><strong>Tanggal</strong></td>
	        <td colspan="2">
	        <input type="text" name="tabsen" id="tabsen" readonly size="15" value="<?php echo $tanggal ?>"  onClick="Calendar.setup()" style="background-color:#99ff00; font-weight:bold; font-size: 14px">
	        <!--<img src="../../keuangan/images/calendar.jpg" name="tabel" border="0" id="btntanggal" onMouseOver="showhint('Buka kalendar!', this, event, '100px')" />-->
		    </td>        
	    </tr>
	    
		<tr>
			<td><strong>NIS</strong></td>
	        <td>
	        <input type="text" name="nis" id="nis" size="50" readonly value="<?php echo $nis ?>" style="background-color: #99ff00; font-weight: bold; font-size: 14px" ></td>
	        	
		</tr>
		
		<tr>
			<td><strong>Nama</strong></td>
	        <td>
	        <input type="text" name="tnama" id="tnama" size="50" readonly value="<?php echo $nama ?>" style="background-color: #99ff00; font-weight: bold; font-size: 14px" ></td>
	        	
		</tr>
		<tr>
			<td><strong>Kelas</strong></td>
			<td style="font-size: 14px">
	        	<strong><?php echo $kelas ?></strong>
	        </td>
		</tr>
		<tr>
			<td><strong>Alamat</strong></td>
	        <td>
	        <input type="text" name="talamat" id="talamat" size="50" readonly value="<?php echo $talamat ?>" style="background-color: #99ff00; font-weight: bold; font-size: 14px" ></td>
	        	
		</tr>
		
	    	
	</table>
	<!----end multi penerimaan----------->

    
<!-- END OF CONTENT //--->
    </td>
    <td width="28" background="../<?php echo GetThemeDir() ?>bgpop_06a.jpg">&nbsp;</td>
</tr>
<tr height="28">
	<td width="28" background="../<?php echo GetThemeDir() ?>bgpop_07.jpg">&nbsp;</td>
    <td width="*" background="../<?php echo GetThemeDir() ?>bgpop_08a.jpg">&nbsp;</td>
    <td width="28" background="../<?php echo GetThemeDir() ?>bgpop_09.jpg">&nbsp;</td>
</tr>
</table>


<?php if (strlen($errmsg) > 0) { ?>
<script language="javascript">
	//alert('<?php echo $errmsg?>');		
</script>
<?php } ?>


</body>
</html>
<script language="javascript">
 Calendar.setup(
    {
      //inputField  : "tanggalshow","tanggal"
	  inputField  : "tabsen",         // ID of the input field
      ifFormat    : "%d-%m-%Y",    // the date format
      button      : "btntanggal"       // ID of the button
    }
   );

Calendar.setup(
    {
      inputField  : "tabsen",        // ID of the input field
      ifFormat    : "%d-%m-%Y",    // the date format	  
	  button      : "tabsen"       // ID of the button
    }
	
  );
 
</script>