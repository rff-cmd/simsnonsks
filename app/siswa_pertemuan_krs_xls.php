<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

$namafile = "DaftarAbsensiSiswa.xls";

@header("Content-Type: application/xls");
@header("Content-Disposition: attachment;filename=".$namafile." ");

include("include/sambung.php");
include("include/functions.php");
//include("include/function_excel.php");

//include_once ("include/queryfunctions.php");
include 'class/class.select.php';
include 'class/class.selectview.php';

$select = new select;
$selectview = new selectview;

#-------------FILTER
$idtahunajaran	=	$_GET["idtahunajaran"];
$idtingkat2		=	$_GET["idtingkat2"];
$idkelas2		=	$_GET["idkelas2"];
$semester_id	=	$_GET["semester_id"];
$peminatan		=	$_GET["peminatan"];
$kelompok_pelajaran_id = $_GET["kelompok_pelajaran_id"];
$pelajaran_id	=	$_GET["pelajaran_id"];
$approved		=	$_GET["approved"];

$sqlmapel = $select->list_pelajaran($pelajaran_id);
$datamapel = $sqlmapel->fetch(PDO::FETCH_OBJ);
$nama_mapel = $datamapel->nama;

$sqlmapel = $select->list_tingkat($idtingkat2);
$datamapel = $sqlmapel->fetch(PDO::FETCH_OBJ);
$nama_tingkat = $datamapel->tingkat;

$sqlmapel = $select->list_kelas($idkelas2);
$datamapel = $sqlmapel->fetch(PDO::FETCH_OBJ);
$nama_kelas = $datamapel->kelas;

//get PA (Pembimbing Akademik)
$sqlpa=$select->list_kelas($idkelas2);
$datapa=$sqlpa->fetch(PDO::FETCH_OBJ);
$walikelas = $datapa->walikelas;

$filter = "";
						
$judul = "DAFTAR ABSENSI SISWA";
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
  
  <Style ss:ID="badankanan">
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
  
  <Style ss:ID="kepalasubdetail">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
   <Interior ss:Color="#b7e207" ss:Pattern="Solid"/>
  </Style>
  
  <Style ss:ID="subdetail">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="0"/>
   <Interior ss:Color="#f8ef56" ss:Pattern="Solid"/>
  </Style>
  
  <Style ss:ID="subdetailcenter">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>    
   </Borders>
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Interior ss:Color="#f8ef56" ss:Pattern="Solid"/>
  </Style>
  
 </Styles>
 <Worksheet ss:Name="Data">

  <Table>
   <Column ss:Index="1" ss:Width="100"/>
   <Column ss:Index="2" ss:Width="150"/>
   <Column ss:Index="3" ss:Width="200"/>
   <Column ss:Index="4" ss:Width="100"/>
   <Column ss:Index="5" ss:Width="100"/>
   <Column ss:Index="6" ss:Width="100"/>';
   	
    echo '<Row>';
    echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Mata Pelajaran</Data></Cell>';
    echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$nama_mapel."</Data></Cell>";
    echo '</Row>';
    
    echo '<Row>';
    echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Tingkat/Kelas</Data></Cell>';
    echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$nama_tingkat.'/'.$nama_kelas."</Data></Cell>";
    echo '</Row>';
    
    echo '<Row>';
    echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Pembimbing Akademik</Data></Cell>';
    echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$walikelas."</Data></Cell>";
    echo '</Row>';
    
    echo '<Row>';
    echo '<Cell ss:StyleID="badan"><Data ss:Type="String"></Data></Cell>';
    echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\"></Data></Cell>";
    echo '</Row>';
   									
	echo '<Row>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No.</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NIS</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Jenis Kelamin</Data></Cell>';	
	echo '</Row>';
	
	$sql=$select->list_absensi_siswa_krs("", $idtingkat2, $idkelas2, $semester_id, $pelajaran_id, $idtahunajaran, $approved);
	while($siswa_krs_view=$sql->fetch(PDO::FETCH_OBJ)){
		
		$kelamin = "";
		if($siswa_krs_view->kelamin == "L") {
			$kelamin = "Laki-Laki";
		}
		if($siswa_krs_view->kelamin == "P") {
			$kelamin = "Perempuan";
		}
											
		$i++;
		echo "<Row>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$i."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_krs_view->nis."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_krs_view->nama_siswa."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$kelamin."</Data></Cell>";
		echo "</Row>\n";
			
		
	}
	
echo '
  </Table>

 </Worksheet>';
 
 
echo '	
</Workbook>';
?>

