<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

$namafile = "RaportSiswaLedger.xls";

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
$semester_id= $_REQUEST['semester_id'];
$idtingkat	= $_REQUEST['idtingkat'];
$idkelas	= $_REQUEST['idkelas'];
$kelamin	= $_REQUEST['kelamin'];
$nama		= $_REQUEST['nama'];
$nis		= $_REQUEST['nis'];
$nik		= $_REQUEST['nik'];
$all		= $_REQUEST['all'];

$filter = "";

/*$sqlukbm 	= $selectview->list_ukbm_pertemuan($idtingkat, $idpelajaran, $semester_id);
$dataukbm 	= $sqlukbm->fetch(PDO::FETCH_OBJ); 
$jumlah_ukbm= $dataukbm->jumlah_ukbm;

$sqlmapel = $select->list_pelajaran($idpelajaran);
$datamapel = $sqlmapel->fetch(PDO::FETCH_OBJ);
$nama_mapel = $datamapel->nama;*/
						
$judul = "RAPORT SISWA LEDGER";
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
   <Column ss:Index="2" ss:Width="150"/>
   <Column ss:Index="3" ss:Width="100"/>';
   
   	$pelajaran_id = array();
							
	$sql2=$selectview->list_kartu_rencana_studi('', '', $idtingkat, $semester_id, '', '', 1); 							$rowsmp = $sql2->rowCount();
							
   /*for($t=1; $t<=$rowsmp; $t++) {
   		echo '<Column ss:Index="'.($t).'" ss:Width="40"/>';
   }*/
   
   echo '
   <Row>';
    echo '<Cell ss:StyleID="judul"><Data ss:Type="String">RAPORT SISWA LEDGER</Data></Cell>';
    echo '</Row>';
   	
	echo '<Row>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No.</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NIS</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NISN</Data></Cell>';	
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Mata Pelajaran</Data></Cell>';
	echo '</Row>';
	
	echo '<Row>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>';	
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>';
	
	while($row_mapel=$sql2->fetch(PDO::FETCH_OBJ)) {
		$pelajaran_id[] = $row_mapel->pelajaran_id;	
		echo '<Cell ss:MergeAcross="3" ss:StyleID="kepala"><Data ss:Type="String">'.$row_mapel->nama_pelajaran.'</Data></Cell>';
	}
	echo '</Row>';
	
	echo '<Row>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>';	
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>';
	for($r=0; $r<$rowsmp; $r++) {
		echo '<Cell ss:MergeAcross="1" ss:StyleID="kepala"><Data ss:Type="String">P</Data></Cell>';
		echo '<Cell ss:MergeAcross="1" ss:StyleID="kepala"><Data ss:Type="String">K</Data></Cell>';
	}
	echo '</Row>';
	
	echo '<Row>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>';	
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>';
	for($r=0; $r<$rowsmp*2; $r++) {
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nilai</Data></Cell>';
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Predikat</Data></Cell>';	
	}
	echo '</Row>';
	
	//get Predikat
	$sqlpredikat = $selectview->list_predikat_raport_1($_SESSION["idangkatan"]);
	$data_predikat = $sqlpredikat->fetch(PDO::FETCH_OBJ);
	$kkm			=	$data_predikat->kkm;
	$nilai_angka_a	=	$data_predikat->nilai_angka_a;
	$nilai_angka_a1	=	$data_predikat->nilai_angka_a1;
	$nilai_angka_b	=	$data_predikat->nilai_angka_b;
	$nilai_angka_b1	=	$data_predikat->nilai_angka_b1;
	$nilai_angka_c	=	$data_predikat->nilai_angka_c;
	$nilai_angka_c1	=	$data_predikat->nilai_angka_c1;
	$nilai_angka_d	=	$data_predikat->nilai_angka_d;
	$nilai_angka_d1	=	$data_predikat->nilai_angka_d1;
	
	$sql=$selectview->list_siswa($nis, '', $idtingkat, $idkelas, $nama, $all, 'SMA', $nik, $kelamin);
	while($siswa_view=$sql->fetch(PDO::FETCH_OBJ)){
	
		$i++;
		if($siswa_view->kelamin == "P") {
			$kelamin = "Perempuan";
		} else {
			$kelamin = "Laki-laki";
		}
		
		$total_nilai_p = 0;
							
		echo "<Row>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$i."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->nis."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->nisn."</Data></Cell>";		
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->nama."</Data></Cell>";
		
		for($r=0; $r<count($pelajaran_id); $r++) {
			$nilai_p = 0;
			$sqlnilai 	= $selectview->list_daftarnilai2($siswa_view->replid, $idtingkat, $idkelas, "", $semester_id, $pelajaran_id[$r], 3);
			$data_nilai_p	= $sqlnilai->fetch(PDO::FETCH_OBJ);
			$nilai_p		= $data_nilai_p->na;
			
			
	
			if($nilai_p >0 ) {
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"Number\">".$nilai_p."</Data></Cell>";
				$total_nilai_p = $total_nilai_p + $nilai_p;
			} else {
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".""."</Data></Cell>";
			}
		
		
			if($nilai_p >0 ) {
				$predikat_p = "";
				if($nilai_p < $nilai_angka_d) {
					$predikat_p = "D";
				}
				if($nilai_p >= $nilai_angka_c && $nilai_p <= $nilai_angka_c1) {
					$predikat_p = "C";
				}
				if($nilai_p >= $nilai_angka_b && $nilai_p <= $nilai_angka_b1 ) {
					$predikat_p = "B";
				}
				if($nilai_p >= $nilai_angka_a && $nilai_p <= $nilai_angka_a1 ) {
					$predikat_p = "A";
				}
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$predikat_p."</Data></Cell>";
			} else {
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".""."</Data></Cell>";
			}
							
			$nilai_k = 0;
			$sqlnilai 	= $selectview->list_daftarnilai2($siswa_view->replid, $idtingkat, $idkelas, "", $semester_id, $pelajaran_id[$r], 4);
			$data_nilai_k	= $sqlnilai->fetch(PDO::FETCH_OBJ);
			$nilai_k		= $data_nilai_k->na;
			if($nilai_k >0 ) {
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"Number\">".$nilai_k."</Data></Cell>"; 
			} else {
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".""."</Data></Cell>";
			}
			
			if($nilai_k >0 ) {
				$predikat_k = "";
				if($nilai_k < $nilai_angka_d) {
					$predikat_k = "D";
				}
				if($nilai_k >= $nilai_angka_c && $nilai_k <= $nilai_angka_c1) {
					$predikat_k = "C";
				}
				if($nilai_k >= $nilai_angka_b && $nilai_k <= $nilai_angka_b1 ) {
					$predikat_k = "B";
				}
				if($nilai_k >= $nilai_angka_a && $nilai_k <= $nilai_angka_a1 ) {
					$predikat_k = "A";
				}
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$predikat_k."</Data></Cell>"; 
			} else {
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".""."</Data></Cell>";
			}
		}
		
		echo "</Row>\n";
			
		
	}
	
echo '
  </Table>

 </Worksheet>';
 
 
echo '	
</Workbook>';
?>

