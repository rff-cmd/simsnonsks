<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

$namafile = "raport_siswa.xls";

@header("Content-Type: application/xls");
@header("Content-Disposition: attachment;filename=".$namafile." ");

include("include/sambung.php");
include("include/functions.php");
//include("include/function_excel.php");

include 'class/class.select.php';
include 'class/class.selectview.php';

$select = new select;
$selectview = new selectview;

#-------------FILTER
$idsiswa	= $_REQUEST["idsiswa"];
$idsemester	= $_SESSION["semester_id"];

$sqlidentitas = $select->list_identitas();
$dataidentitas = $sqlidentitas->fetch(PDO::FETCH_OBJ);

$sqlsiswa = $select->list_siswa("", $idsiswa);
$datasiswa = $sqlsiswa->fetch(PDO::FETCH_OBJ);

$minat = "";
if($datasiswa->idminat == 1) {
	$minat = "Matematika dan Ilmu Pengetahuan Alam";
}
if($datasiswa->idminat == 2) {
	$minat = "Ilmu-ilmu Sosial";
}

$sqlsemester = $select->list_semester($idsemester);
$datasemester = $sqlsemester->fetch(PDO::FETCH_OBJ);

$sqldesc_predikat_spirit = $select->list_deskripsi_raport("", "", "Spritual", "");
$datadesc_predikat_spirit = $sqldesc_predikat_spirit->fetch(PDO::FETCH_OBJ);

$sqldesc_predikat_sosial = $select->list_deskripsi_raport("", "", "Sosial", "");
$datadesc_predikat_sosial = $sqldesc_predikat_sosial->fetch(PDO::FETCH_OBJ);

						
$judul = "RAPORT SISWA";
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
   
   echo '
   <Row>
    <Cell ss:StyleID="kepala"><Data ss:Type="String">Nama Sekolah</Data></Cell>
    <Cell ss:StyleID="kepala"><Data ss:Type="String">:</Data></Cell>
    <Cell ss:StyleID="kepala"><Data ss:Type="String">'.$dataidentitas->nama.'</Data></Cell>
    
    <Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>
    <Cell ss:StyleID="kepala"><Data ss:Type="String">Semester</Data></Cell>
    <Cell ss:StyleID="kepala"><Data ss:Type="String">:</Data></Cell>
    <Cell ss:StyleID="kepala"><Data ss:Type="String">'.$datasemester->semester.'</Data></Cell>
   </Row>';
   
   echo '
   <Row>
    <Cell ss:StyleID="kepala"><Data ss:Type="String">Alamat</Data></Cell>
    <Cell ss:StyleID="kepala"><Data ss:Type="String">:</Data></Cell>
    <Cell ss:StyleID="kepala"><Data ss:Type="String">'.$dataidentitas->alamat1.'</Data></Cell>
    
    <Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>
    <Cell ss:StyleID="kepala"><Data ss:Type="String">Peminatan</Data></Cell>
    <Cell ss:StyleID="kepala"><Data ss:Type="String">:</Data></Cell>
    <Cell ss:StyleID="kepala"><Data ss:Type="String">'.$minat.'</Data></Cell>
   </Row>';
   
   echo '
   <Row>
    <Cell ss:StyleID="kepala"><Data ss:Type="String">Nama Peserta Didik</Data></Cell>
    <Cell ss:StyleID="kepala"><Data ss:Type="String">:</Data></Cell>
    <Cell ss:StyleID="kepala"><Data ss:Type="String">'.$datasiswa->nama.'</Data></Cell>
   </Row>';
   
   echo '
   <Row>
    <Cell ss:StyleID="kepala"><Data ss:Type="String">Nomor Induk/NISN</Data></Cell>
    <Cell ss:StyleID="kepala"><Data ss:Type="String">:</Data></Cell>
    <Cell ss:StyleID="kepala"><Data ss:Type="String">'.$datasiswa->nis.'</Data></Cell>
   </Row>';
   
   echo '
   <Row>
   <Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>
   </Row>';
   
   echo '
   <Row>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">A. Sikap</Data></Cell>
   </Row>';
   
   echo '
   <Row>
   <Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">1. Sikap Spiritual</Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">Predikat</Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">Deskripsi</Data></Cell>
   </Row>';
   
   echo '
   <Row>
   <Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">A</Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">'.$datadesc_predikat_spirit->sikap_a.'</Data></Cell>
   </Row>';
   
   echo '
   <Row>
   <Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">2. Sikap Sosial</Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">Predikat</Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">Deskripsi</Data></Cell>
   </Row>';
   
   echo '
   <Row>
   <Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">A</Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">'.$datadesc_predikat_sosial->sikap_a.'</Data></Cell>
   </Row>';
	
   echo '
   <Row>
   <Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>
   </Row>';
   	
   echo '
   <Row>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">B. Pengetahuan dan Keterampilan</Data></Cell>
   </Row>';
   
   echo '
   <Row>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">Kode</Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">Mata Pelajaran</Data></Cell>
   <Cell ss:MergeAcross="1" ss:StyleID="kepala"><Data ss:Type="String">KKM</Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">Beban/JP</Data></Cell>
   <Cell ss:MergeAcross="1" ss:StyleID="kepala"><Data ss:Type="String">Pengetahuan(P)</Data></Cell>
   <Cell ss:MergeAcross="1" ss:StyleID="kepala"><Data ss:Type="String">Keterampilan(K)</Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">Rata2</Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">Rata2 x Beban</Data></Cell>
   </Row>';
   
   echo '
   <Row>
   <Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">P</Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">K</Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">Angka</Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">Predikat</Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">Angka</Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">Predikat</Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>
   <Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>
   </Row>';
   
   echo '
   <Row>
   <Cell ss:StyleID="kepala"><Data ss:Type="String">Kelompok A (Umum)</Data></Cell>
   </Row>';
   
   ##START GET NILAI
	$no = 0;
	
	//$sql=$selectview->list_siswa_krs($datasiswa->nis, 1);
	$sql = $selectview->list_daftarnilai_raport("SMA", $idtingkat, $idkelas, $idsemester, $idsiswa, 1);
	while($row_pelajaran_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
		
		$jumlah_sks = $jumlah_sks + $row_pelajaran_detail->sks;
		
		//pengetahuan
		$nilai_p = 0;
		$sqlnilai 	= $select->list_daftarnilai($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 3);
		$data_nilai_p	= $sqlnilai->fetch(PDO::FETCH_OBJ);
		$nilai_p		= $data_nilai_p->uas;
		
		$jumlah_ukbm_upd = 0;
		$nilai_detail_p = 0;
		$nilai_detail_non_uas_p=0;
		$sqlndetail = $select->list_daftarnilai_detail($data_nilai_p->replid);
		//$jumlah_ukbm_upd = $sqlndetail->rowCount();
		while($datanilai_detail=$sqlndetail->fetch(PDO::FETCH_OBJ)) {
			if($datanilai_detail->nilai != "") {
				$jumlah_ukbm_upd++;
			}
			$nilai_detail_p = $nilai_detail_p + $datanilai_detail->nilai;
			$nilai_detail_non_uas_p = $nilai_detail_non_uas_p + $datanilai_detail->nilai;
		}
		
		if($jumlah_ukbm_upd > 0) {
			$nilai_detail_p = ( ($nilai_detail_p/$jumlah_ukbm_upd)*75)/100;	
			$nilai_detail_non_uas_p = $nilai_detail_non_uas_p/$jumlah_ukbm_upd;
		} else {
			$nilai_detail_p = 0;
			$nilai_detail_non_uas_p = 0;
		}
		
		if($nilai_p != "") {
			$nilai_p		= ($nilai_p*25)/100;
			$nilai_raport	= number_format($nilai_detail_p + $nilai_p,0,'.',',');
			$total_p		= $total_p + numberreplace($nilai_raport);
		} else {
			$nilai_p		= 0;
			$nilai_raport	= number_format($nilai_detail_non_uas_p,0,'.',',');				
			$total_p		= $total_p + $nilai_raport;
		}
		
		
		//-------/\--------
		
		//keterampilan
		$nilai_k = 0;
		$sqlnilai 	= $select->list_daftarnilai($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 4);
		$data_nilai_k	= $sqlnilai->fetch(PDO::FETCH_OBJ);
		$nilai_k		= $data_nilai_k->uas;
		
		$jumlah_ukbm_upd = 0;
		$nilai_detail_k = 0;
		$nilai_detail_non_uas_k = 0;
		$sqlndetail = $select->list_daftarnilai_detail($data_nilai_k->replid);
		//$jumlah_ukbm_upd = $sqlndetail->rowCount();
		while($datanilai_detail=$sqlndetail->fetch(PDO::FETCH_OBJ)) {
			if($datanilai_detail->nilai != "") {
				$jumlah_ukbm_upd++;
			}
			$nilai_detail_k = $nilai_detail_k + $datanilai_detail->nilai;
			$nilai_detail_non_uas_k = $nilai_detail_non_uas_k + $datanilai_detail->nilai;
			
		}
		
		if($jumlah_ukbm_upd > 0) {
			$nilai_detail_k = ( ($nilai_detail_k/$jumlah_ukbm_upd)*75)/100;	
			$nilai_detail_non_uas_k = $nilai_detail_non_uas_k/$jumlah_ukbm_upd;
		} else {
			$nilai_detail_k = 0;
			$nilai_detail_non_uas_k = 0;
		}
		
		if($nilai_k != "") {
			$nilai_k		= ($nilai_k*25)/100;
			$nilai_raport_k	= number_format($nilai_detail_k + $nilai_k,0,'.',',');
			$total_k		= $total_k + numberreplace($nilai_raport_k);
		} else {
			$nilai_k		= 0;
			$nilai_raport_k	= number_format($nilai_detail_non_uas_k,0,'.',',');				
			$total_k		= $total_k + $nilai_raport_k;
		}
		
		$rata2 	= 	(($nilai_detail_p + $nilai_p) + ($nilai_detail_k + $nilai_k))/2;
		$rata2_beban = number_format($rata2 * $row_pelajaran_detail->sks,0,'.',',');
		$rata2	=	number_format($rata2,0,'.',',');
		$total_rata = $total_rata + numberreplace($rata2);
		$total_rata_beban = $total_rata_beban + numberreplace($rata2_beban);
		
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
		
		//predikat pengetahuan
		$predikat_p = "";
		if($nilai_raport < $nilai_angka_d) {
			$predikat_p = "D";
		}
		if($nilai_raport >= $nilai_angka_c && $nilai_raport <= $nilai_angka_c1) {
			$predikat_p = "C";
		}
		if($nilai_raport >= $nilai_angka_b && $nilai_raport <= $nilai_angka_b1 ) {
			$predikat_p = "B";
		}
		if($nilai_raport >= $nilai_angka_a && $nilai_raport <= $nilai_angka_a1 ) {
			$predikat_p = "A";
		}
		
		//predikat keterampilan
		$predikat_k = "";
		if($nilai_raport_k < $nilai_angka_d) {
			$predikat_k = "D";
		}
		if($nilai_raport_k >= $nilai_angka_c && $nilai_raport_k <= $nilai_angka_c1) {
			$predikat_k = "C";
		}
		if($nilai_raport_k >= $nilai_angka_b && $nilai_raport_k <= $nilai_angka_b1 ) {
			$predikat_k = "B";
		}
		if($nilai_raport_k >= $nilai_angka_a && $nilai_raport_k <= $nilai_angka_a1 ) {
			$predikat_k = "A";
		}
	
	echo "<Row>";
	echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_pelajaran_detail->kode_pelajaran."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_pelajaran_detail->nama_pelajaran."</Data></Cell>";		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_pelajaran_detail->kkm."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_pelajaran_detail->kkm_terampil."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_pelajaran_detail->sks."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$nilai_raport."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$predikat_p."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$nilai_raport_k."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$predikat_k."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$rata2."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$rata2_beban."</Data></Cell>";
	echo "</Row>";
	
		$no++;
	}
	
	
	include("raport_siswa_b_xls.php");
	include("raport_siswa_c_xls.php");
	include("raport_siswa_d_xls.php");
	
echo '
  </Table>

 </Worksheet>';
 
 
echo '	
</Workbook>';
?>

