<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

$namafile = "Daftar_User.xls";

@header("Content-Type: application/xls");
@header("Content-Disposition: attachment;filename=".$namafile." ");

include("include/sambung.php");
include("include/functions.php");
//include("include/function_excel.php");

//include_once ("include/queryfunctions.php");
include 'class/class.select.php';
//include 'class/class.selectview.php';

$select = new select;
//$selectview = new selectview;

#-------------FILTER
$tipe_user	= $_REQUEST['tipe_user'];
$idtingkat	= $_REQUEST['idtingkat'];
$usrid		= $_REQUEST['usrid'];
$all		= $_REQUEST['all'];

$filter = "";
						
$judul = "DAFTAR USER";
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
    echo '<Cell ss:StyleID="judul"><Data ss:Type="String">DAFTAR USER</Data></Cell>';
    echo '</Row>';
   	
	echo '<Row>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No.</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NIS</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tingkat</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Kelas</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">User ID</Data></Cell>';	
	if($_SESSION['adm'] == 1) {
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Password</Data></Cell>';
	}
	echo '</Row>';
	
	$sql=$select->list_usr("", $tipe_user, $usrid, $all, $idtingkat);
	while($siswa_view=$sql->fetch(PDO::FETCH_OBJ)){
	
		$i++;
		
		$sqldata = $select->list_pegawai_siswa($siswa_view->idpegawai, $usr_view->tipe_user);
		$data_pegsis = $sqldata->fetch(PDO::FETCH_OBJ);
		$pegawai_siswa = $data_pegsis->nama;
				
		echo "<Row>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$i."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data_pegsis->nip."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$pegawai_siswa."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data_pegsis->tingkat."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data_pegsis->kelas."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->usrid."</Data></Cell>";
		if($_SESSION['adm'] == 1) {
			echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->pwdori."</Data></Cell>";
		}
		echo "</Row>\n";
			
		
	}
	
echo '
  </Table>

 </Worksheet>';
 
 
echo '	
</Workbook>';
?>

