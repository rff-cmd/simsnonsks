<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

//include_once ("include/queryfunctions.php");
include_once ("include/sambung.php");
include_once ("include/functions.php");
//include_once ("include/inword.php");

//include 'class/class.select.php';
include 'class/class.selectview.php';

//$select = new select;
$selectview = new selectview;

include "phpqrcode/qrlib.php"; //<-- LOKASI FILE UTAMA PLUGINNYA

#-------------FILTER
$idsiswa		= !empty($_REQUEST['idsiswa']) ? $_REQUEST['idsiswa'] : '';
$idsemester		= !empty($_REQUEST['semester_id']) ? $_REQUEST['semester_id'] : '';
$idtahunajaran	= !empty($_REQUEST['idtahunajaran']) ? $_REQUEST['idtahunajaran'] : '';
$alumni			= !empty($_REQUEST['alumni']) ? $_REQUEST['alumni'] : '';

$sqlidentitas = $selectview->list_identitas();
$dataidentitas = $sqlidentitas->fetch(PDO::FETCH_OBJ);

$sqlsiswa = $selectview->list_siswa_baru("", $idsiswa);
$datasiswa = $sqlsiswa->fetch(PDO::FETCH_OBJ);
/*------------------------------------------*/

/*---------print header-----------*/
$nama_sekolah	=	$dataidentitas->nama;
//$nama_semester	=	$datasemester->semester;
//$tanggal_ttd	=	$periode_raport->tanggal_ttd; //$datasemester->tanggal_ttd;
$alamat_sekolah	=	$dataidentitas->alamat1;

$nama_siswa		=	$datasiswa->nama;
$nis_siswa		=	$datasiswa->nis;
$nisn_siswa		=	$datasiswa->nisn;
$tmplahir		=	$datasiswa->tmplahir;
$tgllahir		= 	date("d-m-Y", strtotime($datasiswa->tgllahir));
if($tgllahir == '01-01-1970') {
	$tgllahir = "";
}
$kelamin		=	$datasiswa->kelamin;
if($kelamin == "P") {
	$kelamin = "Perempuan";
}
if($kelamin == "L") {
	$kelamin = "Laki-Laki";
}
$asalsekolah	=	$datasiswa->asalsekolah_id;
$dlu2			=	date("d-m-Y", strtotime($datasiswa->dlu2));
if($dlu2 == '01-01-1970') {
	$dlu2 = "";
}

$size = 400;
$data = array();

//create QRCode--------------
$ref	= $idsiswa;
$tempdir = "phpqrcode/qrcode/";
$url2 = "http://sims.sman3bandung.sch.id/sims3"; //$public_url.obraxabrix('press')."/".$ref."/".$machine_id;
$isi_teks = $url2; //get_current_url($_SERVER); //inputan fungsi tadi itu cuma $_SERVER aja
$namafile = $ref;
$quality = 'H';
$ukuran = 10;
$padding = 2;

QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);
//---------------/\----------


require('pdf/fpdf2.php');
	  	
class PDF extends FPDF
{
	
	var $col=0;
	//Ordinate of column start
	var $y0;
	
	function Header()
	{
		//Page header
		global $nama_sekolah;
		global $alamat_sekolah;
		global $nama_siswa;
		global $nis_siswa;
		global $nisn_siswa;
		
		global $asalsekolah;
		global $tgllahir;
		global $kelamin;
		global $dlu2;
		global $ref;
						
		$this->SetFont('Arial','',11);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		
		$this->Ln(2);
		
		$this->Cell(26,3,'',0,0,'L',false);
		$this->Image('../assets/img/logo.jpg', 50, 5, 20, 22, 'jpg', '');
		$this->Ln(20);
		
		$this->SetFont('Arial','B',11);
		$this->Cell(1,3,'',0,0,'L',false);
		$this->Cell(100,3,'BUKTI TELAH MELAKUKAN DAFTAR ULANG DARING',0,1,'C',false);
		$this->Ln(2);
		
		$this->Cell(1,3,'',0,0,'L',false);
		$this->Cell(100,3,$nama_sekolah,0,1,'C',false);
		$this->Ln(2);
		
		$tahun = date('Y');
		$this->Cell(1,3,'',0,0,'L',false);
		$this->Cell(100,3,'PPDB TAHUN '.$tahun,0,1,'C',false);
		$this->Ln(2);
		
		$this->SetFont('Arial','',9);
		$this->Cell(35,3,'NISN',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$nisn_siswa,0,1,'L',false);
		$this->Ln(2);
		
		$this->Cell(35,3,'Nama Calon Siswa Baru',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$nama_siswa,0,1,'L',false);
		$this->Ln(2);
		
		$this->Cell(35,3,'Tanggal Lahir',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$tgllahir,0,1,'L',false);
		$this->Ln(2);
		
		$this->Cell(35,3,'Jenis Kelamin',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$kelamin,0,1,'L',false);
		$this->Ln(2);
		
		$this->Cell(35,3,'Asal Sekolah',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$asalsekolah,0,1,'L',false);
		$this->Ln(2);
		
		$this->Cell(35,3,'Tanggal Daftar Ulang',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$dlu2,0,1,'L',false);
		$this->Ln(5);
		
		$this->SetFont('Arial','B',11);
		$this->Cell(100,3,'PERHATIAN !',0,1,'L',false);
		$this->Ln(2);
		
		$this->SetFont('Arial','',9);
		$this->MultiCell('100',3,'Calon Siswa Baru yang sudah berhasil melakukan daftar ulang melalui link http://sims.sman3bandung.sch.id/sims3, tetap harus datang ke SMA Negeri 3 Bandung untuk melakukan verifikasi data sesuai dengan jadwal yang ditetapkan dan membawa seluruh berkas sesuai informasi yang diberikan.');
			
		$size_qr = 100; //$size_qr + 36;
		/*$this->Ln($size_qr-112);
		$this->Cell(100,3,$machin_name,0,1,'C',false);*/
		$this->Cell(2,3,'',0,1,'L',false);
		$this->Image('phpqrcode/qrcode/'.$ref, 55, $size_qr, 20, 20, 'png', '');
		$this->Ln(120);
		
		$size = $size + $sizeadd;
		
		//hapus file qrcode
		unlink('phpqrcode/qrcode/' . $ref);
		
		
		//Save ordinate
		$this->y0=$this->GetY();
	}
	
	

	var $B;
	var $I;
	var $U;
	var $HREF;
	
	
	function PDF($orientation='P',$unit='mm', $format='tmsize') 
	{
		//Call parent constructor
		//$size = 300;
		global $size;
		global $sizeadd;
		
		$this->FPDF2($orientation,$unit,$format,$size); //$size = tinggi
		//Initialization
		$this->B=0;
		$this->I=0;
		$this->U=0;
		$this->HREF='';
		
	}

	//Load data
		
	function LoadData($file)
	{		
		//Read file lines
		//$lines=file($file);
		$lines=($file);
		$cekdata = isset ($file[1]) ? $file[1]:''; //$file[1];
		if( !empty($cekdata) )  {
			foreach($lines as $line) {
				$data[]=explode(';',$line);
			}
		} else {			
			$file_0 = isset ($file[0]) ? $file[0]:'';
			$data[]=explode(';',$file_0);
			
		}
			
		//foreach($lines as $data)
			//$data[]=explode(';',chop($line));
		return $data;
	} 
	
	function BasicTable($header,$data)
	{
		global $sikap_spirit_a;
		global $sikap_sosial_a;
		
		$this->SetFont('Arial','B',9);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		
		$this->Ln(5);
		
		$size = $size + $sizeadd;
		
			
	} 
	
	
		
}
//===========================				
$pdf=new PDF();

$title='RAPORT SISWA';
$pdf->SetTitle($title);	
//$pdf->SetTitle($nis);	
//$pdf->SetTitle($nama);


//$terbilang = "(" . KalimatUang($total) . ")";
//$pdf->SetTitle($terbilang);

//$total = number_format($total,"0",".",",");
//$total2 = number_format($total2,"0",".",",");
//$pdf->SetTitle($total);
$pdf->SetTitle($size);

/*$G_LOKASI = "Bandung";
$uid = $petugas; //$_SESSION["loginname"];
$tanggalcetak = $G_LOKASI . ", " . $tglcetak;
$getuser = "(". $uid . ")";
*/

$header=array('No.','dua','tiga','1','5','6','7','8','9','10','12');
//$header2=array('No.','Jenis Biaya','Besarnya');
//Data loading
//$data=$pdf->LoadData('poa.txt');

$data=$pdf->LoadData($data);
//$data2=$pdf->LoadData($data2);
$pdf->SetFont('Arial','',11);
$pdf->AddPage();


//if($jmldata > 0) {
	$pdf->BasicTable($header,$data);
//} 

/*
if($jmldata1 > 0) {
	$pdf->BasicTable2($header2,$data2);
} */

/*$pdf->AddPage();
$pdf->ImprovedTable($header,$data);
$pdf->AddPage();
$pdf->FancyTable($header,$data);*/

$pdf->Output();

?>