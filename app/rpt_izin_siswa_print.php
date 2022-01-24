<?php
session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include("../app/include/sambung.php");
include("../app/include/functions.php");

include 'class/class.select.print.php';

$select_print = new select_print;

?>

<head>
<title>Laporan Penerimaan</title>

</head>

<?php
	$daritgl	= $_REQUEST['daritgl'];
	$ketgl		= $_REQUEST['ketgl'];
	$idtingkat	= $_REQUEST['idtingkat'];
	$idkelas	= $_REQUEST['idkelas'];
	$nama		= $_REQUEST['nama'];
	$all		= $_REQUEST['all'];
	
	$drtgl = date("d-m-Y", strtotime($daritgl));
	$smptgl = date("d-m-Y", strtotime($ketgl));
	
	$string = "";
		
	if($drtgl != "") {
		if($string == "") { 
			$string = " Dari Tanggal : " . $drtgl ; 
		} else {
			$string = $string . " Dari Tanggal : " . $drtgl ;
		}
	}
	
	if($smptgl != "") {
		if($string == "") { 
			$string = " s/d Tanggal : " . $smptgl ; 
		} else {
			$string = $string . " s/d Tanggal : " . $smptgl ;
		}
	}
	
	if($nama != "") {
		if($string == "") { 
			$string = " Nama : " . $nama ; 
		} else {
			$string = $string . " ,Nama : " . $nama ;
		}
	}
	
	if($all == 1) { $string = "";}
	
	
?>


<table width="100%" border="0" cellspacing="0">
	<tr>
		<td colspan="18" align="center" style="font-weight: bold; font-family: sans-serif">LAPORAN IZIN SISWA<?php echo $balai2 ?></td>
	</tr>
	<tr>
		<td colspan="18" align="center">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="8" align="left" style="font-family: sans-serif; font-size: 11px;"><?php echo $string ?></td>
	</tr>
</table>

<table width="100%" border="1" cellspacing="0" style="font-family: sans-serif; font-size: 11px; border: 1px solid #ccc">

	<tr style="font-weight: bold; background-color: #deecf3">
		<th style="font-weight:bold ">Tanggal &nbsp;&nbsp;</th>
		<th style="font-weight:bold ">NIS &nbsp;&nbsp;</th>
		<th style="font-weight:bold ">Nama &nbsp;&nbsp;</th>
		<th style="font-weight:bold ">Kelas &nbsp;&nbsp;</th>
		<th style="font-weight:bold ">Jenis Izin &nbsp;&nbsp;</th>
		<th style="font-weight:bold ">Keterangan &nbsp;&nbsp;</th>
		<th style="font-weight:bold ">Petugas &nbsp;&nbsp;</th>	
	</tr>	
	
	<?php
		$amount = 0;
		$total = 0;
			
		$sql=$select_print->list_rpt_izin_siswa($daritgl, $ketgl, $idtingkat, $idkelas, $nama, $all);
		while ($rpt_izin_siswa_view=$sql->fetch(PDO::FETCH_OBJ)) {
			
			$tanggal = date("d-m-Y H:i", strtotime($rpt_izin_siswa_view->tanggal));	
			$kelas = $rpt_izin_siswa_view->tingkat . '-' . $rpt_izin_siswa_view->kelas;
            
		?>
				<tr style="color: #000">
					<td><?php echo $tanggal ?></td>
                    <td><?php echo $rpt_izin_siswa_view->nis ?></td>
					<td><?php echo $rpt_izin_siswa_view->nama_siswa ?></td>
					<td><?php echo $kelas ?></td>
                    <td><?php echo $rpt_izin_siswa_view->jenis_izin ?></td>
					<td><?php echo $rpt_izin_siswa_view->keterangan ?></td>
					<td><?php echo $rpt_izin_siswa_view->nama_pegawai ?></td>
				</tr>
				
	<?php
			}
	?>
		
</table>

<script language="javascript">
	window.print();
</script>