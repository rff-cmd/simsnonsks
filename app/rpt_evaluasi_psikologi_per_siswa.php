<?php
session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include("../app/include/sambung.php");
include("../app/include/functions.php");

include 'class/class.select.view.php';

$select_view = new select_view;

$nis			=	$_REQUEST['nis'];

$departemen 	= 	$_REQUEST['departemen'];
$idtingkat	 	= 	$_REQUEST['idtingkat'];
$idkelas	 	= 	$_REQUEST['idkelas'];
$nama		 	= 	$_REQUEST['nama'];
$idsemester		=	$_REQUEST['idsemester'];

?>

<head>
<title>Evaluasi Psikologi per Siswa</title>

</head>

<table class="table" width="100%" border="0" cellspacing="5" style="font-family: sans-serif; font-size: 11px; border: 1px solid #ccc">
		
	<?php
		$i = 1;
		
		$sql=$select_view->list_siswa($nis, '', '', '', '', '', '');
		while ($rpt_lunas_view=$sql->fetch(PDO::FETCH_OBJ)) {
			
			$kelas = $rpt_lunas_view->tingkat . '-' . $rpt_lunas_view->kelas;
			
	?>
	
			<td valign="top" style="border: 1px solid #ccc">
				<table class="table" width="100%" style="font-family: sans-serif; font-size: 11px">
					<tr style="font-weight: bold">
						<td align="left" width="25%">Nama</td>
						<td align="left" width="2%">:</td>		
						<td align="left" width="40%"><?php echo $rpt_lunas_view->nama ?></td>		
					</tr>	
					<tr style="font-weight: bold">
						<td align="left" width="25%">Kelas</td>
						<td align="left" width="2%">:</td>		
						<td align="left" width="40%"><?php echo $kelas ?></td>		
					</tr>
					<tr style="font-weight: bold">
						<td align="left" width="25%">No. Virtual Account</td>
						<td align="left" width="2%">:</td>		
						<td align="left" width="40%"></td>		
					</tr>
					
					<?php
						$total_sisa = 0;
						
						//Ketgori SPP
						$namaterima = "";
						$cicilan = 0;
						$sql3=$select_view->list_rpt_lunas_detail_jtt($rpt_lunas_view->nis, "JTT");
						$jml = $sql3->rowCount();
						
						$x = 0;
						while ($rpt_view2=$sql3->fetch(PDO::FETCH_OBJ)) {
							if($x == 0) {
								$namaterima = $rpt_view2->namaterima;
							}
							if($x == $jml-1) {
								$namaterima = $namaterima . " - " . $rpt_view2->namaterima;
							}
							
							$cicilan = $cicilan + $rpt_view2->cicilan;
							
							$x++;
						}
						
						$total_sisa = $total_sisa + $cicilan;
					?>
					
					
						<tr >
							<td align="left" width="25%"><?php echo $namaterima ?></td>
							<td align="left" width="2%">:</td>		
							<td align="right" width="10%"><?php echo number_format($cicilan,0,".",",") ?>&nbsp;&nbsp;</td>		
						</tr>
					
					
					<?php	
						
						
						$sql2=$select_view->list_rpt_lunas_detail($rpt_lunas_view->nis);
						while ($rpt_view=$sql2->fetch(PDO::FETCH_OBJ)) {
							
							$sisa = $rpt_view->besar - $rpt_view->jumlah;
							$total_sisa = $total_sisa + $sisa;
					?>
					
							<tr >
								<td align="left" width="25%"><?php echo $rpt_view->namaterima ?></td>
								<td align="left" width="2%">:</td>		
								<td align="right" width="10%"><?php echo number_format($rpt_view->cicilan,0,".",",") ?>&nbsp;&nbsp;</td>		
							</tr>
					
					<?php
						}
					?>
					<tr style="font-weight: bold">
						<td align="left" width="15%">Jumlah Tagihan</td>
						<td align="left" width="2%">:</td>		
						<td align="right" width="10%"><?php echo number_format($total_sisa,0,".",",") ?>&nbsp;&nbsp;</td>		
					</tr>
					
					<tr>
						<td>&nbsp;</td>
					</tr>
					
					<tr>
						<td align="left" colspan="3"><i>Bagian Keuangan Tunas Unggul</i></td>
					</tr>
					
				</table>
			</td>
	
	<?php
	
			if($i % 3 == 0){

				echo '<tr align="left">';

			}
			
			$i++;
			
		}
	?>
	
			<!--
	
	<tr style="font-weight: bold; background-color: #deecf3">
		<td colspan="1" align="right">TOTAL :</td>
		<td align="center"><?php echo number_format($alat, 0, ",", ",") ?></td>
		
		<td align="right"><?php echo number_format($total, 0, ",", ",") ?>&nbsp;</td>
	</tr>-->
</table>
