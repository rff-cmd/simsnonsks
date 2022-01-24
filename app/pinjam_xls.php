<?php
session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

$namafile = "PinjamBuku.xls";

header("Content-Type: application/xls");
header("Content-Disposition: attachment;filename=".$namafile." ");

include("include/sambung.php");
include("include/functions.php");
//include("include/function_excel.php");

include 'class/class.select.php';

$select = new select;

#-------------FILTER
$idanggota	= $_REQUEST['idanggota'];
$tglpinjam	= $_REQUEST['tglpinjam'];
$tglpinjam	= $_REQUEST['tglpinjam'];
$all		= $_REQUEST['all'];

$tglpinjam2	= date("d-m-Y", strtotime($tglpinjam));	
$tglpinjam2	= date("d-m-Y", strtotime($tglpinjam));

if($tglpinjam == '01-01-1970') {
	$tglpinjam = "";
}

if($tglpinjam == '01-01-1970') {
	$tglpinjam = "";
}

$string = "";
	
if($tglpinjam2 != "") {
	if($string == "") { 
		$string = " Tanggal Pinjam : " . $tglpinjam2 ; 
	} else {
		$string = $string . " Tanggal Pinjam : " . $tglpinjam2 ;
	}
}

if($tglpinjam2 != "") {
	if($string == "") { 
		$string = " Tanggal Kembali : " . $tglpinjam2 ; 
	} else {
		$string = $string . ", Tanggal Kembali : " . $tglpinjam2 ;
	}
}

if($idanggota != "") {
	if($string == "") { 
		$string = " Anggota : " . $idanggota ; 
	} else {
		$string = $string . ", Anggota : " . $idanggota ;
	}
}

if($all == 1) { $string = "";}

$judul = 'LAPORAN PEMINJAMAN BUKU';

echo '
<?xml version="1.0" encoding="iso-8859-1"?>
<?mso-application progid="Excel.Sheet"?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:html="http://www.w3.org/TR/REC-html40">
 

 <Styles>
  <Style ss:ID="judul">
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
	<Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
  </Style>
  <Style ss:ID="filter">
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
	<Alignment ss:Horizontal="Left" ss:Vertical="Bottom"/>
  </Style>
  <Style ss:ID="kanan">
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
	<Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
  </Style>
  <Style ss:ID="kepala">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
   <Interior ss:Color="#CFF4D2" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="badan">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>  
  
  <Style ss:ID="detailkanan">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>    
   </Borders>
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
  </Style>
  
  <Style ss:ID="badancenter">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>    
   </Borders>
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
  </Style>
  
 </Styles>
 <Worksheet ss:Name="Data">

  <Table>
   <Column ss:Index="1" ss:Width="100"/>
   <Column ss:Index="2" ss:Width="150"/>
   <Column ss:Index="3" ss:Width="250"/>
   <Column ss:Index="4" ss:Width="200"/>
   
   <Row>
    <Cell ss:MergeAcross="7" ss:StyleID="judul"><Data ss:Type="String">' . $judul . '</Data></Cell>
    <Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
   </Row>
   <Row>
    <Cell ss:MergeAcross="7" ss:StyleID="filter"><Data ss:Type="String">' . $string . '</Data></Cell>
    <Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
   </Row>';
						
	echo '<Row>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Kode Anggota</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama Anggota</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Kode Pustaka</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Judul</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tanggal Pinjam</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tanggal Kembali</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Keterangan</Data></Cell>';				
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Terlambat (hari)</Data></Cell>';
	echo '</Row>';
	
	$alat = 0;
	$total = 0;
		
	$amount = 0;
	$total = 0;
		
	$sql=$select->list_pinjam($replid, $idanggota, $tglpinjam, $tglpinjam, $all);
	while ($pinjam_view=$sql->fetch(PDO::FETCH_OBJ)) {
		
		$tglpinjam = date("d-m-Y", strtotime($pinjam_view->tglpinjam));
		$tglkembali = date("d-m-Y", strtotime($pinjam_view->tglkembali));	
		$now	= date("d-m-Y");
		$terlambat = "";
		$background = "";
		if($tglkembali < $now) {
			$terlambat	= $pinjam_view->terlambat;
		} 
		
		echo "<Row>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$pinjam_view->idanggota."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$pinjam_view->nama."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$pinjam_view->kodepustaka."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$pinjam_view->judul."</Data></Cell>";				
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$tglpinjam."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$tglpinjam."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$pinjam_view->keterangan."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$terlambat."</Data></Cell>";
		echo "</Row>\n";
		
	}
	
	
echo '
  </Table>

 </Worksheet>
</Workbook>';
?>

