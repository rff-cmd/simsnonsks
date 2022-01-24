<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

$namafile = "DaftarKRSApproved.xls";

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
$nis			= $_REQUEST['nis'];
$semester_id	= $_REQUEST['semester_id'];

$filter = "";
						
$judul = "DAFTAR KRS SISWA";
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
   <Column ss:Index="1" ss:Width="200"/>
   <Column ss:Index="2" ss:Width="150"/>
   <Column ss:Index="3" ss:Width="150"/>
   <Column ss:Index="4" ss:Width="200"/>
   <Column ss:Index="5" ss:Width="150"/>
   <Column ss:Index="6" ss:Width="150"/>';
   
   	$sqlheader=$selectview->list_siswa($nis);
	$siswa_krs=$sqlheader->fetch(PDO::FETCH_OBJ);
	$idminat = $siswa_krs->idminat;
		
   echo '
   <Row>';
    echo '<Cell ss:StyleID="judul"><Data ss:Type="String">KARTU RENCANA STUDI SISWA</Data></Cell>';
    echo '</Row>';
    
    echo '<Row>';
    echo '<Cell ss:StyleID="badan"><Data ss:Type="String">NIS</Data></Cell>';
    echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_krs->nis."</Data></Cell>";
    echo '</Row>';
    
    echo '<Row>';
    echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Nama</Data></Cell>';
    echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_krs->nama."</Data></Cell>";
    echo '</Row>';
    
    echo '<Row>';
    echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Tingkat/Kelas</Data></Cell>';
    echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_krs->tingkat.'/'.$siswa_krs->kelas."</Data></Cell>";
    echo '</Row>';
    
    echo '<Row>';
    echo '<Cell ss:StyleID="badan"><Data ss:Type="String"></Data></Cell>';
    echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\"></Data></Cell>";
    echo '</Row>';
   	
	echo '<Row>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No.</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Mata Pelajaran</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">SKS</Data></Cell>';	
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Aproval</Data></Cell>';
	echo '</Row>';
	
	$sql=$selectview->list_siswa_krs_approved_view($nis, $semester_id);
	while($siswa_view=$sql->fetch(PDO::FETCH_OBJ)){
		
		$sqlgetkrs = $selectview->get_kartu_rencana_studi($idminat, $siswa_krs->idtingkat, "", $siswa_view->pelajaran_id, $semester_id, "");
		$row_krs=$sqlgetkrs->fetch(PDO::FETCH_OBJ);	
		
		$apr = "";
		if($siswa_view->approved == 1) {
			$apr = "Ya";
		} else {
			$apr = "Belum";
		}
					
		$i++;
		echo "<Row>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$i."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->mapel."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_krs->sks."</Data></Cell>";		
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$apr."</Data></Cell>";
		echo "</Row>\n";
			
		
	}
	
echo '
  </Table>

 </Worksheet>';
 
 
echo '	
</Workbook>';
?>

