<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

$namafile = "DaftarNilaiTingkat.xls";

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
$departemen	= $_REQUEST['departemen'];
$idtingkat	= $_REQUEST['idtingkat'];
//$idkelas	= $_REQUEST['idkelas'];
$semester_id= $_REQUEST['semester_id'];
$idpelajaran= $_REQUEST['idpelajaran'];
$idjeniskompetensi		= $_REQUEST['idjeniskompetensi'];
$iddasarpenilaian		= $_REQUEST['iddasarpenilaian'];

$filter = "";

$sqlukbm 	= $selectview->list_ukbm_pertemuan($idtingkat, $idpelajaran, $semester_id);
$dataukbm 	= $sqlukbm->fetch(PDO::FETCH_OBJ); 
$jumlah_ukbm= $dataukbm->jumlah_ukbm;

$sqlmapel = $select->list_pelajaran($idpelajaran);
$datamapel = $sqlmapel->fetch(PDO::FETCH_OBJ);
$nama_mapel = $datamapel->nama;
						
$judul = "DAFTAR NILAI SISWA";
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
   
   for($t=1; $t<=($jumlah_ukbm*2); $t++) {
   		echo '<Column ss:Index="'.(3+$t).'" ss:Width="40"/>';
   }
   
   echo '
   <Row>
    <Cell ss:StyleID="judul"><Data ss:Type="String">' . $judul . '</Data></Cell>
    <Cell ss:StyleID="judul"><Data ss:Type="String">'.$nama_mapel.'</Data></Cell>';
    
    for($t=1; $t<=299; $t++) {
   		echo '<Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>';
    }
   
   echo ' 
   <Cell ss:StyleID="judul"><Data ss:Type="String">'.$idpelajaran.'</Data></Cell>
   </Row>';
	
	echo '<Row>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No.</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NIS</Data></Cell>';	
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama Lengkap</Data></Cell>';
	
	for($n=1; $n<=$jumlah_ukbm; $n++) {	
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">N-'.$n.'(P)</Data></Cell>';
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">N-'.$n.'(K)</Data></Cell>';
	}
	
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">PAS-P</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">PAS-K</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Sakit</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Izin</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Alpa</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Dispensasi</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Sikap</Data></Cell>';	
	echo '</Row>';
	
	$i = 0;
	$sql = "";
	$sql=$selectview->list_siswa_tingkat('', '', $idtingkat, $idkelas, $nama, $all, 'SMA');
	$rowsiswa=$sql->rowCount();
	while($siswa_view=$sql->fetch(PDO::FETCH_OBJ)){
		
		$i++;
		
		$idkelas = $siswa_view->idkelas;
		$sqlnilai 	= $select->list_daftarnilai($siswa_view->replid, $idtingkat, $idkelas, "", $semester_id, $idpelajaran, "");
		$siswa_get  = "";
		$siswa_get	= $sqlnilai->fetch(PDO::FETCH_OBJ);
							
		echo "<Row>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$i."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->nis."</Data></Cell>";		
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".petikreplace($siswa_view->nama)."</Data></Cell>";
		
		$uas_p = "";
		$uas_k = "";
		
		//get UAS
		$sqlnilai_uas 	= $select->list_daftarnilai($siswa_view->replid, $idtingkat, $idkelas, "", $semester_id, $idpelajaran, 3);
		$data_get_uas	= $sqlnilai_uas->fetch(PDO::FETCH_OBJ);
		$uas_p 			= $data_get_uas->uas;
		
		$sqlnilai_uas 	= $select->list_daftarnilai($siswa_view->replid, $idtingkat, $idkelas, "", $semester_id, $idpelajaran, 4);
		$data_get_uas	= $sqlnilai_uas->fetch(PDO::FETCH_OBJ);
		$uas_k 			= $data_get_uas->uas;
		//----/\----------
		
		if($siswa_get->rata == 0 || $siswa_get->rata == "") {
			for($b=1; $b<=$jumlah_ukbm; $b++) {		
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".""."</Data></Cell>";
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".""."</Data></Cell>";
			}
		} else {
			$sqlndetail = $select->list_daftarnilai_detail($siswa_get->replid); //$siswa_view
			$jumlah_ukbm_upd = $sqlndetail->rowCount();
			while($datanilai_detail=$sqlndetail->fetch(PDO::FETCH_OBJ)) {
				
				$sqldetnilai = $select->list_daftarnilai_detail_dasarpenilaian($siswa_get->departemen, $siswa_get->idtingkat, $siswa_get->idkelas, $siswa_get->idtahunajaran, $siswa_get->idsemester, $siswa_get->nis, $siswa_get->idkompetensi, $siswa_get->idjeniskompetensi, 3, $siswa_get->idpelajaran, $datanilai_detail->line);
				$datadetnilai = $sqldetnilai->fetch(PDO::FETCH_OBJ);
				//$uas_p = $datadetnilai->uas;
				
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$datadetnilai->nilai."</Data></Cell>";
				
				$sqldetnilai1 = $select->list_daftarnilai_detail_dasarpenilaian($siswa_get->departemen, $siswa_get->idtingkat, $siswa_get->idkelas, $siswa_get->idtahunajaran, $siswa_get->idsemester, $siswa_get->nis, $siswa_get->idkompetensi, $siswa_get->idjeniskompetensi, 4, $siswa_get->idpelajaran, $datanilai_detail->line);
				$datadetnilai1 = $sqldetnilai1->fetch(PDO::FETCH_OBJ);
				//$uas_k = $datadetnilai1->uas;
				
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$datadetnilai1->nilai."</Data></Cell>";
			}
			
			for($b=$jumlah_ukbm_upd+1; $b<=$jumlah_ukbm; $b++) {	
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".""."</Data></Cell>";
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".""."</Data></Cell>";
			}
		}
		
		if(allowlvl("frmdaftarnilai") == 2) { //jika level 2 boleh edit dan lihat PAS
			echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$uas_p."</Data></Cell>";
			echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$uas_k."</Data></Cell>";
		} else {
			echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".""."</Data></Cell>";
			echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".""."</Data></Cell>";			
		}
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_get->sakit."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_get->izin."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_get->alpa."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_get->dispensasi."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_get->sikap."</Data></Cell>";
		
		if(allowlvl("frmdaftarnilai") != 2) {
			//PAS Pengetahuan & //PAS Ketrampilan (TIDAK LEVEL 2)
			for($t=1; $t<=290-($jumlah_ukbm*2); $t++) {
		   		echo '<Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>';
		    }		   
		    echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$uas_p."</Data></Cell>";
		    echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$uas_k."</Data></Cell>";
		}
		
		echo "</Row>\n";
			
		
	}
	
echo '
  </Table>

 </Worksheet>';
 
 
echo '	
</Workbook>';
?>

