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

#-------------FILTER
$idsiswa	= $_REQUEST["idsiswa"];
$idsemester		= $_REQUEST["semester_id"];
$idtahunajaran	= $_REQUEST["idtahunajaran"];
$alumni			= $_REQUEST["alumni"];

$sqlidentitas = $selectview->list_identitas();
$dataidentitas = $sqlidentitas->fetch(PDO::FETCH_OBJ);

$sqlsiswa = $selectview->list_siswa2("", $idsiswa, '', '', $alumni, '');
$datasiswa = $sqlsiswa->fetch(PDO::FETCH_OBJ);


$sqlsemester = $selectview->list_semester($idsemester);
$datasemester = $sqlsemester->fetch(PDO::FETCH_OBJ);

$sqlperiode_raport = $selectview->list_setup_periode_raport($idtahunajaran, $idsemester, $datasiswa->idtingkat);
$periode_raport = $sqlperiode_raport->fetch(PDO::FETCH_OBJ);
/*------------------------------------------*/

/*---------print header-----------*/
$nama_sekolah	=	$dataidentitas->nama;
$nama_semester	=	$datasemester->semester;
$tanggal_ttd	=	$periode_raport->tanggal_ttd; //$datasemester->tanggal_ttd;
$alamat_sekolah	=	$dataidentitas->alamat1;

$idtingkat		= 	$datasiswa->idtingkat;
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
$agama			=	$datasiswa->agama;
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
$tanggalijazah	=	date("d-m-Y", strtotime($datasiswa->tglijazah));
if($tanggalijazah == '01-01-1970') {
	$tanggalijazah = "";
}
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
}

$tglmasuk		=	date("d-m-Y", strtotime($datasiswa->tglmasuk));
if($tglmasuk == '01-01-1970') {
	$tglmasuk = "";
}

//get kecamatan
$sqlkec = $selectview->list_kecamatan($datasiswa->kecamatan_kode);
$datakec = $sqlkec->fetch(PDO::FETCH_OBJ);

if($datasiswa->kecamatan_kode == '') {
	$kecamatan = $datasiswa->kecamatan;
} else {
	$kecamatan = $datakec->nama;	
}

//get desa
$sqldesa = $selectview->list_desa($datasiswa->desa_kode);
$datadesa = $sqldesa->fetch(PDO::FETCH_OBJ);
if($datasiswa->desa_kode == '') {
	$desa = $datasiswa->desa;
} else {
	$desa = $datadesa->nama;	
}


/*-------------------------------*/

/*-----------footer-------------*/
/*$sql_peg = $selectview->list_pegawai('', '196106231981012002', '', '');
$data_peg = $sql_peg->fetch(PDO::FETCH_OBJ);
$nip_kepsek 	= $data_peg->nip;
$nama_kepsek	= $data_peg->nama;*/

$sqlthnajaran = $selectview->list_tahunajaran($idtahunajaran);
$datatahunajaran = $sqlthnajaran->fetch(PDO::FETCH_OBJ);
$tahun_ajaran 	= $datatahunajaran->tahunajaran;
$nip_kepsek		= $datatahunajaran->info1;
$nama_kepsek	= $datatahunajaran->nama_kepsek;
/*------------------------------*/

								
$sql_wali 	= $selectview->list_kelas($idkelas1, "");
$data_wali	= $sql_wali->fetch(PDO::FETCH_OBJ);
$nip_wali	= $data_wali->nip_wali;
$nama_wali	= $data_wali->walikelas;
/*-------------------------------------------*/
				

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
		global $nama_semester;
		global $alamat_sekolah;
		global $minat;
		global $nama_siswa;
		global $nis_siswa;
		global $nisn_siswa;
		global $numeric_semester;
		
		global $tmplahir;
		global $tgllahir;
		global $kelamin;
		global $agama;
		global $anakke;
		global $alamatsiswa;
		global $rt_siswa;
		global $rw_siswa;
		global $telponsiswa;
		global $kelas;
		global $tingkat;
		global $numeric_semester;
		global $asalsekolah;
		global $kotaasalsekolah;
		global $noijazah;
		global $tanggalijazah;
		global $tahunijazah;
		global $skhun;
		global $tahunskhun;
		global $namaayah;
		global $namaibu;
		global $alamatortu;
		global $alamatibu;
		global $pekerjaanayah;
		global $pekerjaanibu;
		global $wali;
		global $alamatwali;
		global $teleponwali;
		global $pekerjaanwali;
		global $tglmasuk;
		global $kecamatan;
		global $desa;
		
		$nomor = 0;
						
		$this->SetFont('Arial','',11);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		
		$this->Ln(2);
		
		$this->SetFont('Arial','B',11);
		$this->Cell(200,3,'IDENTITAS PESERTA DIDIK',0,1,'C',true);
		$this->Ln(10);
		
		$this->SetFont('Arial','',10);
		
		$nomor++;
		$this->Cell(8,3,$nomor.".",0,0,'L',false);
		$this->Cell(48,3,'Nama Peserta Didik',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$nama_siswa,0,1,'L',false);
		$this->Ln(4);
		
		$nomor++;
		$this->Cell(8,3,$nomor.".",0,0,'L',false);
		$this->Cell(48,3,'NIS / NISN',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$nis_siswa." / ".$nisn_siswa,0,1,'L',false);
		$this->Ln(4);
		
		$nomor++;
		$this->Cell(8,3,$nomor.".",0,0,'L',false);
		$this->Cell(48,3,'Tempat dan Tanggal Lahir',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$tmplahir.", ".$tgllahir,0,1,'L',false);
		$this->Ln(4);
		
		$nomor++;
		$this->Cell(8,3,$nomor.".",0,0,'L',false);
		$this->Cell(48,3,'Jenis Kelamin',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$kelamin,0,1,'L',false);
		$this->Ln(4);
		
		$nomor++;
		$this->Cell(8,3,$nomor.".",0,0,'L',false);
		$this->Cell(48,3,'Agama',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$agama,0,1,'L',false);
		$this->Ln(4);
		
		$nomor++;
		$this->Cell(8,3,$nomor.".",0,0,'L',false);
		$this->Cell(48,3,'Anak ke',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$anakke,0,1,'L',false);
		$this->Ln(4);
		
		$nomor++;
		$this->Cell(8,3,$nomor.".",0,0,'L',false);
		$this->Cell(48,3,'Alamat Peserta Didik',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->MultiCell(120,4,$alamatsiswa,0,1,'L',false);
		$this->Ln(4);
		
		$nomor++;
		$this->Cell(8,3,$nomor.".",0,0,'L',false);
		$this->Cell(48,3,'Kecamatan / Kelurahan',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->MultiCell(120,4,$kecamatan.' / '.$desa,0,1,'L',false);
		$this->Ln(4);
		
		$this->Cell(8,3,"",0,0,'L',false);
		$this->Cell(48,3,'Telepon / HP',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$telponsiswa,0,1,'L',false);
		$this->Ln(4);
		
		$nomor++;
		$this->Cell(8,3,$nomor.".",0,0,'L',false);
		$this->Cell(48,3,'Diterima di sekolah ini',0,1,'L',true);
		$this->Ln(4);
		
		$this->Cell(8,3,"",0,0,'L',false);
		$this->Cell(8,3,"a.",0,0,'L',false);
		$this->Cell(40,3,'Di Kelas',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,"X" . " ". $kelas,0,1,'L',false); //$tingkat
		$this->Ln(4);
		
		$this->Cell(8,3,"",0,0,'L',false);
		$this->Cell(8,3,"b.",0,0,'L',false);
		$this->Cell(40,3,'Pada Tanggal',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$tglmasuk,0,1,'L',false);
		$this->Ln(4);
		
		$this->Cell(8,3,"",0,0,'L',false);
		$this->Cell(8,3,"c.",0,0,'L',false);
		$this->Cell(40,3,'Semester',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,"1",0,1,'L',false); //$numeric_semester
		$this->Ln(4);
		
		$nomor++;
		$this->Cell(8,3,$nomor.".",0,0,'L',false);
		$this->Cell(48,3,'Sekolah Asal',0,1,'L',true);
		$this->Ln(4);
		
		$this->Cell(8,3,"",0,0,'L',false);
		$this->Cell(8,3,"a.",0,0,'L',false);
		$this->Cell(40,3,'Nama',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$asalsekolah,0,1,'L',false);
		$this->Ln(4);
		
		$this->Cell(8,3,"",0,0,'L',false);
		$this->Cell(8,3,"b.",0,0,'L',false);
		$this->Cell(40,3,'Kota',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$kotaasalsekolah,0,1,'L',false);
		$this->Ln(4);
		
		$nomor++;
		$this->Cell(8,3,$nomor.".",0,0,'L',false);
		$this->Cell(48,3,'Ijazah SMP/MTs/Paket B',0,1,'L',true);
		$this->Ln(4);
		
		$this->Cell(8,3,"",0,0,'L',false);
		$this->Cell(8,3,"a.",0,0,'L',false);
		$this->Cell(40,3,'Tanggal',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$tanggalijazah,0,1,'L',false);
		$this->Ln(4);
		
		$this->Cell(8,3,"",0,0,'L',false);
		$this->Cell(8,3,"b.",0,0,'L',false);
		$this->Cell(40,3,'Nomor',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$noijazah,0,1,'L',false);
		$this->Ln(4);
		
		$nomor++;
		$this->Cell(8,3,$nomor.".",0,0,'L',false);
		$this->Cell(48,3,'Surat Keterangan Hasil Ujian Nasional (SKHUN) SMP/MTs/Paket B',0,1,'L',true);
		$this->Ln(4);
		
		$this->Cell(8,3,"",0,0,'L',false);
		$this->Cell(8,3,"a.",0,0,'L',false);
		$this->Cell(40,3,'Tahun',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$tahunskhun,0,1,'L',false);
		$this->Ln(4);
		
		$this->Cell(8,3,"",0,0,'L',false);
		$this->Cell(8,3,"b.",0,0,'L',false);
		$this->Cell(40,3,'Nomor',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$skhun,0,1,'L',false);
		$this->Ln(4);
		
		$nomor++;
		$this->Cell(8,3,$nomor.".",0,0,'L',false);
		$this->Cell(48,3,'Orang Tua',0,1,'L',true);
		$this->Ln(4);
		
		$this->Cell(8,3,"",0,0,'L',false);
		$this->Cell(8,3,"a.",0,0,'L',false);
		$this->Cell(40,3,'Ayah',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$namaayah,0,1,'L',false);
		$this->Ln(4);
		
		$this->Cell(8,3,"",0,0,'L',false);
		$this->Cell(8,3,"b.",0,0,'L',false);
		$this->Cell(40,3,'Ibu',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$namaibu,0,1,'L',false);
		$this->Ln(4);
		
		$nomor++;
		$this->Cell(8,3,$nomor.".",0,0,'L',false);
		$this->Cell(48,3,'Alamat Orang Tua',0,1,'L',true);
		$this->Ln(4);
		
		$this->Cell(8,3,"",0,0,'L',false);
		$this->Cell(8,3,"a.",0,0,'L',false);
		$this->Cell(40,3,'Ayah',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->MultiCell(120,4,$alamatortu,0,1,'L',false);
		$this->Ln(4);
		
		$this->Cell(8,3,"",0,0,'L',false);
		$this->Cell(8,3,"b.",0,0,'L',false);
		$this->Cell(40,3,'Ibu',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->MultiCell(120,4,$alamatibu,0,1,'L',false);
		$this->Ln(4);
		
		$nomor++;
		$this->Cell(8,3,$nomor.".",0,0,'L',false);
		$this->Cell(48,3,'Pekerjaan Orang Tua',0,1,'L',true);
		$this->Ln(4);
		
		$this->Cell(8,3,"",0,0,'L',false);
		$this->Cell(8,3,"a.",0,0,'L',false);
		$this->Cell(40,3,'Ayah',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$pekerjaanayah,0,1,'L',false);
		$this->Ln(4);
		
		$this->Cell(8,3,"",0,0,'L',false);
		$this->Cell(8,3,"b.",0,0,'L',false);
		$this->Cell(40,3,'Ibu',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$pekerjaanibu,0,1,'L',false);
		$this->Ln(4);
		
		$nomor++;
		$this->Cell(8,3,$nomor.".",0,0,'L',false);
		$this->Cell(48,3,'Nama Wali',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$wali,0,1,'L',false);
		$this->Ln(4);
		
		$nomor++;
		$this->Cell(8,3,$nomor.".",0,0,'L',false);
		$this->Cell(48,3,'Alamat Wali',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->MultiCell(120,4,$alamatwali,0,1,'L',false);
		$this->Ln(4);
		
		$this->Cell(8,3,"",0,0,'L',false);
		$this->Cell(48,3,'Telepon',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$teleponwali,0,1,'L',false);
		$this->Ln(4);
		
		$nomor++;
		$this->Cell(8,3,$nomor.".",0,0,'L',false);
		$this->Cell(48,3,'Pekerjaan Wali',0,0,'L',true);
		$this->Cell(4,3,':',0,0,'L',false);
		$this->Cell(80,3,$pekerjaanwali,0,1,'L',false);
		$this->Ln(4);
		
		//Save ordinate
		$this->y0=$this->GetY();
	}
	
	

	var $B;
	var $I;
	var $U;
	var $HREF;
	
	
	function PDF($orientation='P',$unit='mm', $format='legal') 
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
		$cekdata = $file[1];
		if( !empty($cekdata) )  {
			foreach($lines as $line) {
				$data[]=explode(';',$line);
			}
		} else {			
			$data[]=explode(';',$file[0]);
			
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
		
		
		global $nip_kepsek;
		global $nama_kepsek;
		global $nip_wali;
		global $nama_wali;
		
		global $jumlah_sks;
		global $total_p;
		global $total_k;
		global $total_rata;
		global $total_rata_beban;
		global $ip_semester;
		global $tanggal_ttd;
		
		$this->Ln(2);
		
		$size = $size + $sizeadd;
		
		//---------
		$this->SetFont('Arial','',9);
		
		$this->Ln(5);
		
		$this->SetFont('Arial','',10);
		
		//global $tglmasuk;
		//;
		$tgl 	= date("Y-m-d", strtotime($tanggal_ttd));
		$tnggal	= tglindonesia($tgl, $hasil);
		
		$this->Cell(58,5,'',0,0,'C',true);
		$this->Cell(128,5,'Bandung, '.$tnggal,0,1,'R',true);
		$this->Cell(60,5,'',0,0,'C',true);
		
		$this->Cell(70,5,'',0,0,'C',true);
		
		$this->Cell(70,5,'Kepala Sekolah SMA Negeri 3 Bandung',0,1,'C',true);	
		$this->Ln(25);
		
		$size = $size + $sizeadd;
		
		$this->Cell(60,5,'',0,0,'C',true);	
		$this->Cell(70,5,'',0,0,'C',true);	
		$this->Cell(70,5,$nama_kepsek,0,1,'C',true);
		
		$this->Cell(60,5,'',0,0,'C',true);	
		$this->Cell(70,5,'',0,0,'C',true);	
		$this->Cell(70,5,"NIP ".$nip_kepsek,0,1,'C',true);		
		$this->Ln(2);
		
		$this->Image('../assets/img/pas_photo.jpg', 90, 280, 40, 45, 'jpg', '');		
	} 
	
	
		
}
//===========================				
$pdf=new PDF();

$title='RAPORT SISWA';
$pdf->SetTitle($title);	
$pdf->SetTitle($nis);	
$pdf->SetTitle($nama);


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