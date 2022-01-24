<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

$namafile = "DaftarSiswaBaru.xls";

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
$idgugus	= $_REQUEST['idgugus'];
$idtingkat2	= $_REQUEST['idtingkat2'];
$idkelas2	= $_REQUEST['idkelas2'];
$kelamin	= $_REQUEST['kelamin'];
$nama2		= $_REQUEST['nama2'];
$nis		= $_REQUEST['nis'];
$nik		= $_REQUEST['nik'];
$all		= $_REQUEST['all'];

$idangkatan		= $_REQUEST['idangkatan'];
$idangkatan1	= $_REQUEST['idangkatan1'];
$idtingkat2		= $_REQUEST['idtingkat2'];
$idkelas2		= $_REQUEST['idkelas2'];

$filter = "";
						
$judul = "DAFTAR SISWA BARU";
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
  
  <Style ss:ID="detailmapel">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#ffffff"
    ss:Bold="1"/>
   <Interior ss:Color="#a80000" ss:Pattern="Solid"/>
  </Style>
  
  <Style ss:ID="mapelnilai">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="0"/>
   <Interior ss:Color="#ffffff" ss:Pattern="Solid"/>
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
    echo '<Cell ss:StyleID="judul"><Data ss:Type="String">DAFTAR SISWA BARU</Data></Cell>';
    echo '</Row>';
   	
	echo '<Row>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No.</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No ID.</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">HP Ortu.</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NISN</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NIK</Data></Cell>';	
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Jenis Kelamin</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Agama</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Gugus</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Peminatan</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Status Daftar Ulang</Data></Cell>';
	echo '</Row>';
	
	$sql=$selectview->excel_siswa_baru($nis, '', $idtingkat2, $idkelas2, $nama2, $all, 'SMA', $nik, $kelamin, $idgugus, $idangkatan, $idangkatan1);	
	while($siswa_view=$sql->fetch(PDO::FETCH_OBJ)){
	
		$i++;
		if($siswa_view->kelamin == "P") {
			$kelamin = "Perempuan";
		} else {
			$kelamin = "Laki-laki";
		}
		
		$idminat = "";
		if($siswa_view->idminat == 1) {
			$idminat = "MIPA";
		}
		if($siswa_view->idminat == 2) {
			$idminat = "IPS";
		}
		
		
		$daftar_ulang = "";
		if($siswa_view->uid2 != '') {
			$daftar_ulang = "Sudah Daftar Ulang";
		}
		
		echo "<Row>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$i."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->replid."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->hportu."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->nisn."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->nik."</Data></Cell>";		
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->nama."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$kelamin."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->agama."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->gugus."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$idminat."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$daftar_ulang."</Data></Cell>";
		echo "</Row>\n";
			
		echo "<Row>";
			echo "<Cell ss:StyleID=\"detailmapel\"><Data ss:Type=\"String\"></Data></Cell>";	
			echo "<Cell ss:StyleID=\"detailmapel\"><Data ss:Type=\"String\">Semester</Data></Cell>";	
			echo "<Cell ss:StyleID=\"detailmapel\"><Data ss:Type=\"String\">1</Data></Cell>";	
			echo "<Cell ss:StyleID=\"detailmapel\"><Data ss:Type=\"String\">2</Data></Cell>";
			echo "<Cell ss:StyleID=\"detailmapel\"><Data ss:Type=\"String\">3</Data></Cell>";
			echo "<Cell ss:StyleID=\"detailmapel\"><Data ss:Type=\"String\">4</Data></Cell>";
			echo "<Cell ss:StyleID=\"detailmapel\"><Data ss:Type=\"String\">5</Data></Cell>";
			echo "<Cell ss:StyleID=\"detailmapel\"><Data ss:Type=\"String\">RATA-RATA</Data></Cell>";	
		echo "</Row>\n";
		
		##get nilai rapor
		$mapelminat = $select->list_pelajaran_raport_minat();
		while($dataminat = $mapelminat->fetch(PDO::FETCH_OBJ)) {
			$total = 0;
			
			echo "<Row>";
				echo "<Cell ss:StyleID=\"mapelnilai\"><Data ss:Type=\"String\"></Data></Cell>";	
				echo "<Cell ss:StyleID=\"mapelnilai\"><Data ss:Type=\"String\">".$dataminat->nama."</Data></Cell>";
				
				##semester-1
				$sqlraport = $select->list_siswa_raprt('', 1, $siswa_view->replid, $dataminat->replid);
				$datanilai = $sqlraport->fetch(PDO::FETCH_OBJ);
				$total = $total + $datanilai->nilai;
				echo "<Cell ss:StyleID=\"mapelnilai\"><Data ss:Type=\"Number\">".$datanilai->nilai."</Data></Cell>";
				
				##semester-2
				$sqlraport = $select->list_siswa_raprt('', 2, $siswa_view->replid, $dataminat->replid);
				$datanilai = $sqlraport->fetch(PDO::FETCH_OBJ);
				$total = $total + $datanilai->nilai;
				echo "<Cell ss:StyleID=\"mapelnilai\"><Data ss:Type=\"Number\">".$datanilai->nilai."</Data></Cell>";
				
				##semester-13
				$sqlraport = $select->list_siswa_raprt('', 3, $siswa_view->replid, $dataminat->replid);
				$datanilai = $sqlraport->fetch(PDO::FETCH_OBJ);
				$total = $total + $datanilai->nilai;
				echo "<Cell ss:StyleID=\"mapelnilai\"><Data ss:Type=\"Number\">".$datanilai->nilai."</Data></Cell>";
				
				##semester-4
				$sqlraport = $select->list_siswa_raprt('', 4, $siswa_view->replid, $dataminat->replid);
				$datanilai = $sqlraport->fetch(PDO::FETCH_OBJ);
				$total = $total + $datanilai->nilai;
				echo "<Cell ss:StyleID=\"mapelnilai\"><Data ss:Type=\"Number\">".$datanilai->nilai."</Data></Cell>";
				
				##semester-5
				$sqlraport = $select->list_siswa_raprt('', 5, $siswa_view->replid, $dataminat->replid);
				$datanilai = $sqlraport->fetch(PDO::FETCH_OBJ);
				$total = $total + $datanilai->nilai;
				echo "<Cell ss:StyleID=\"mapelnilai\"><Data ss:Type=\"Number\">".$datanilai->nilai."</Data></Cell>";
				
				$rata_rata = 0;
				if($total > 0) {
					$rata_rata = $total/5;
				}
				
				echo "<Cell ss:StyleID=\"mapelnilai\"><Data ss:Type=\"Number\">".$rata_rata."</Data></Cell>";
				
			echo "</Row>\n";
		}
		
	}
	
echo '
  </Table>

 </Worksheet>';
 
 
echo '	
</Workbook>';
?>

