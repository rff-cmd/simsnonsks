<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

$namafile = "DaftarSiswaEkskul.xls";

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
$idtingkat2	= $_REQUEST['idtingkat'];
$idkelas2	= $_REQUEST['idkelas'];
$idpelajaran= $_REQUEST['idpelajaran'];
$semester_id= $_REQUEST['semester_id'];
$idtahunajaran = $_REQUEST['idtahunajaran_f'];
$nama2		= $_REQUEST['nama2'];
$all		= $_REQUEST['all'];

$filter = "";
						
$judul = "DAFTAR SISWA EKSTRAKURIKULER";
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
   <Column ss:Index="1" ss:Width="50"/>
   <Column ss:Index="2" ss:Width="100"/>
   <Column ss:Index="3" ss:Width="100"/>
   <Column ss:Index="4" ss:Width="200"/>
   <Column ss:Index="5" ss:Width="100"/>
   <Column ss:Index="6" ss:Width="100"/>';
   
   echo '
   <Row>';
    echo '<Cell ss:StyleID="judul"><Data ss:Type="String">DAFTAR SISWA EKSTRAKURIKULER</Data></Cell>';
    echo '</Row>';
   	
	echo '<Row>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No.</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NIS</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NISN</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama Lengkap</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Jenis Kelamin</Data></Cell>';	
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tingkat</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Kelas</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Ekskul</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Pembina</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nilai</Data></Cell>';
	echo '</Row>';
		
	$sql=$selectview->list_siswa_ekstrakurikuler('SMA', '', $idtingkat2, $idkelas2, $nama2, $all, $idpelajaran, $semester_id, $idtahunajaran);
	while($siswa_view=$sql->fetch(PDO::FETCH_OBJ)){
	
		$i++;
		if($siswa_view->kelamin == "P") {
			$kelamin = "Perempuan";
		} else {
			$kelamin = "Laki-laki";
		}
		
		$sqlpel = $selectview->list_siswa_ekstrakurikuler_guru($siswa_view->idpelajaran);
		$pembina_view=$sqlpel->fetch(PDO::FETCH_OBJ);
		
		echo "<Row>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$i."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->nis."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->nisn."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->nama."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$kelamin."</Data></Cell>";		
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->tingkat."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->kelas."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->nama_pelajaran."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$pembina_view->nama_guru."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->nilai."</Data></Cell>";
		echo "</Row>\n";
			
	}
	
echo '
  </Table>

 </Worksheet>';
 
 
echo '	
</Workbook>';
?>

