<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

$namafile = "DaftarSiswa.xls";

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
$idtingkat2	= $_REQUEST['idtingkat2'];
$idkelas2	= $_REQUEST['idkelas2'];
$kelamin	= $_REQUEST['kelamin'];
$nama2		= $_REQUEST['nama2'];
$nis		= $_REQUEST['nis'];
$nik		= $_REQUEST['nik'];
$all		= $_REQUEST['all'];

$filter = "";
						
$judul = "DAFTAR SISWA";
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
    echo '<Cell ss:StyleID="judul"><Data ss:Type="String">DAFTAR SISWA</Data></Cell>';
    echo '</Row>';
   	
   	echo '<Row>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No.</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NIS</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NISN</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NIK</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama Lengkap</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Jenis Kelamin</Data></Cell>';	
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tingkat</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Kelas</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Agama</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Minat</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tgl Masuk</Data></Cell>';
	
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Anak Ke</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Alamat Siswa</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">RT/RW Siswa</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Telp/HP Siswa</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Asal Sekolah</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No Ijazah</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tgl Ijazah</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tahun Ijazah</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">SKUN</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tahun SKUN</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama Ayah</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama Ibu</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Alamat Ayah</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Alamat Ibu</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Pekerjaan Ayah</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Pekerjaan Ibu</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama Wali</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Alamat Wali</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">HP Wali</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Pekerjaan Wali</Data></Cell>';
	echo '</Row>';

	
	$sql=$selectview->list_siswa($nis, '', $idtingkat2, $idkelas2, $nama2, $all, 'SMA', $nik, $kelamin);
	while($siswa_view=$sql->fetch(PDO::FETCH_OBJ)){
	
		$i++;
		if($siswa_view->kelamin == "P") {
			$kelamin = "Perempuan";
		} else {
			$kelamin = "Laki-laki";
		}
		
		if($siswa_view->idminat == "1") {
			$idminat = "MIPA";
		}
		if($siswa_view->idminat == "2") {
			$idminat = "IPS";
		}
		if($siswa_view->idminat == "3") {
			$idminat = "BAHASA";
		}
		
		$tglmasuk		=	date("d-m-Y", strtotime($siswa_view->tglmasuk));
		if($tglmasuk == '01-01-1970') {
			$tglmasuk = "";
		}
		
		$tanggalijazah	=	date("d-m-Y", strtotime($siswa_view->tglijazah));
		if($tanggalijazah == '01-01-1970') {
			$tanggalijazah = "";
		}
		
		echo "<Row>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$i."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->nis."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->nisn."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->nik."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->nama."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$kelamin."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->tingkat."</Data></Cell>";		
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->kelas."</Data></Cell>";
		
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->agama."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$idminat."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$tglmasuk."</Data></Cell>";
		
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->anakke."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->alamatsiswa."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->rt_siswa.'/'.$siswa_view->rw_siswa."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->telponsiswa.'/'.$siswa_view->hpsiswa."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->asalsekolah_id.' - '.$siswa_view->kota_asalsekolah."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->noijazah."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$tanggalijazah."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->tahunijazah."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->skhun."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->tahunskhun."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->namaayah."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->namaibu."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->alamatortu."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->alamatibu."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->pekerjaan_ayah."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->pekerjaan_ibu."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->wali."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->alamatwali."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->hpwali."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$siswa_view->pekerjaan_wali."</Data></Cell>";
		echo "</Row>\n";
		
		/*$agama			=	$datasiswa->agama;
$anakke			=	$datasiswa->anakke;
$alamatsiswa	=	$datasiswa->alamatsiswa;
$rt_siswa		=	$datasiswa->rt_siswa;
$rw_siswa		=	$datasiswa->rw_siswa;
$telponsiswa	=	$datasiswa->telponsiswa." / ".$datasiswa->hpsiswa;
$kelas			=	$datasiswa->kelas;
$tingkat		=	$datasiswa->tingkat;
$numeric_semester = numeric_semester($idtingkat);
$asalsekolah	=	$datasiswa->asalsekolah_id;
$kotaasalsekolah=	$datasiswa->kota_asalsekolah;
$noijazah		=	$datasiswa->noijazah;

$tahunijazah	=	$datasiswa->tahunijazah;
$skhun			=	$datasiswa->skhun;
$tahunskhun		=	$datasiswa->tahunskhun;
$namaayah		=	$datasiswa->namaayah;
$namaibu		=	$datasiswa->namaibu;
$alamatortu		=	$datasiswa->alamatortu; //alamat ayah
$alamatibu		=	$datasiswa->alamatibu;
$pekerjaanayah	=	$datasiswa->pekerjaan_ayah;
if($pekerjaanayah == "" || $pekerjaanayah == "0") {
	$pekerjaanayah = $datasiswa->pekerjaanayah_lain;
}
$pekerjaanibu	=	$datasiswa->pekerjaan_ibu;
if($pekerjaanibu == "" || $pekerjaanibu == "0") {
	$pekerjaanibu = $datasiswa->pekerjaanibu_lain;
}

$wali			=	$datasiswa->wali;
$alamatwali		=	$datasiswa->alamatwali;
$teleponwali	=	$datasiswa->hpwali;
$pekerjaanwali	=	$datasiswa->pekerjaan_wali;
if($pekerjaanwali == "" || $pekerjaanwali == "0") {
	$pekerjaanwali = $datasiswa->pekerjaanwali_lain;
}*/


			
		
	}
	
echo '
  </Table>

 </Worksheet>';
 
 
echo '	
</Workbook>';
?>

