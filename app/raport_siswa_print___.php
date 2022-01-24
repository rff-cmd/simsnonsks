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
$idsemester	= $_SESSION["semester_id"];
$idkelas	= $_REQUEST["idkelas"];

$sqlidentitas = $selectview->list_identitas();
$dataidentitas = $sqlidentitas->fetch(PDO::FETCH_OBJ);

$sqlsiswa = $selectview->list_siswa2("", $idsiswa);
$datasiswa = $sqlsiswa->fetch(PDO::FETCH_OBJ);

$minat = "";
if($datasiswa->idminat == 1) {
	$minat = "Matematika dan Ilmu Pengetahuan Alam";
}
if($datasiswa->idminat == 2) {
	$minat = "Ilmu-ilmu Sosial";
}

$sqlsemester = $selectview->list_semester($idsemester);
$datasemester = $sqlsemester->fetch(PDO::FETCH_OBJ);

$sqldesc_predikat_spirit = $selectview->list_deskripsi_raport("", "", "Spritual", "");
$datadesc_predikat_spirit = $sqldesc_predikat_spirit->fetch(PDO::FETCH_OBJ);

$sqldesc_predikat_sosial = $selectview->list_deskripsi_raport("", "", "Sosial", "");
$datadesc_predikat_sosial = $sqldesc_predikat_sosial->fetch(PDO::FETCH_OBJ);
/*------------------------------------------*/

/*---------print header-----------*/
$nama_sekolah	=	$dataidentitas->nama;
$nama_semester	=	$datasemester->semester;
$alamat_sekolah	=	$dataidentitas->alamat1;
$nama_siswa		=	$datasiswa->nama;
$nis_siswa		=	$datasiswa->nis;
$sikap_spirit_a	=	$datadesc_predikat_spirit->sikap_a;
$sikap_sosial_a	=	$datadesc_predikat_sosial->sikap_a;
/*-------------------------------*/

/*-----------footer-------------*/
$sql_peg = $selectview->list_pegawai('', '196106231981012002', '', '');
$data_peg = $sql_peg->fetch(PDO::FETCH_OBJ);
$nip_kepsek 	= $data_peg->nip;
$nama_kepsek	= $data_peg->nama;
/*------------------------------*/

/*---------print detail----------*/
$data			=	array();
$data2			=	array();
$data_kelompok	=	array();

$no = 0;
##START GET NILAI


$data_kelompok[]="Kelompok A (Umum)";

$sql = $selectview->list_daftarnilai_raport("SMA", $idtingkat, $idkelas, $idsemester, $idsiswa, 1);
while($row_pelajaran_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
	
	$idkelas1	=	$row_pelajaran_detail->idkelas;
		
	$jumlah_sks = $jumlah_sks + $row_pelajaran_detail->sks;
	
	//pengetahuan
	$nilai_p = 0;
	$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 3);
	$data_nilai_p	= $sqlnilai->fetch(PDO::FETCH_OBJ);
	$nilai_p		= $data_nilai_p->uas;
	
	$jumlah_nilai = 0;
	$jumlah_nilai	= $jumlah_nilai + $data_nilai_p->jumlah;
	
	$jumlah_ukbm_upd = 0;
	$nilai_detail_p = 0;
	$nilai_detail_non_uas_p=0;
	$sqlndetail = $selectview->list_daftarnilai_detail($data_nilai_p->replid);
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
	$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 4);
	$data_nilai_k	= $sqlnilai->fetch(PDO::FETCH_OBJ);
	$nilai_k		= $data_nilai_k->uas;
	
	$jumlah_nilai	= $jumlah_nilai + $data_nilai_k->jumlah;
	
	$jumlah_ukbm_upd = 0;
	$nilai_detail_k = 0;
	$nilai_detail_non_uas_k = 0;
	$sqlndetail = $selectview->list_daftarnilai_detail($data_nilai_k->replid);
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
	
	
	$kode_pelajaran		=	$row_pelajaran_detail->kode_pelajaran;
	$nama_pelajaran		=	$row_pelajaran_detail->nama_pelajaran;
	$kkm				=	$row_pelajaran_detail->kkm;
	$kkm_terampil		=	$row_pelajaran_detail->kkm_terampil;
	$sks				=	$row_pelajaran_detail->sks;
	
	$data[]=$kode_pelajaran.';'.$nama_pelajaran.';'.$kkm.';'.$kkm_terampil.';'.$sks.';'.$nilai_raport.';'.$predikat_p.';'.$nilai_raport_k.';'.$predikat_k.';'.$rata2.';'.$rata2_beban;
	
	$data2[]='Kelompok A (Umum)'.'|'.$kode_pelajaran.'|'.$nama_pelajaran.'|'.$kkm.'|'.$kkm_terampil.'|'.$sks.'|'.$nilai_raport.'|'.$predikat_p.'|'.$nilai_raport_k.'|'.$predikat_k.'|'.$rata2.'|'.$rata2_beban.'|'.$jumlah_nilai;
	
		
}


//=================B UMUM
$data_kelompok[]="Kelompok B (Umum)";
$sql = $selectview->list_daftarnilai_raport("SMA", $idtingkat, $idkelas, $idsemester, $idsiswa, 2);
while($row_pelajaran_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
	
	$jumlah_sks = $jumlah_sks + $row_pelajaran_detail->sks;
	
	//pengetahuan
	$nilai_p = 0;
	$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 3);
	$data_nilai_p	= $sqlnilai->fetch(PDO::FETCH_OBJ);
	$nilai_p		= $data_nilai_p->uas;
	
	$jumlah_nilai = 0;
	$jumlah_nilai	= $jumlah_nilai + $data_nilai_p->jumlah;
	
	$jumlah_ukbm_upd = 0;
	$nilai_detail_p = 0;
	$nilai_detail_non_uas_p=0;
	$sqlndetail = $selectview->list_daftarnilai_detail($data_nilai_p->replid);
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
	$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 4);
	$data_nilai_k	= $sqlnilai->fetch(PDO::FETCH_OBJ);
	$nilai_k		= $data_nilai_k->uas;
	
	$jumlah_nilai	= $jumlah_nilai + $data_nilai_k->jumlah;
	
	$jumlah_ukbm_upd = 0;
	$nilai_detail_k = 0;
	$nilai_detail_non_uas_k = 0;
	$sqlndetail = $selectview->list_daftarnilai_detail($data_nilai_k->replid);
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
	
	
	$kode_pelajaran		=	$row_pelajaran_detail->kode_pelajaran;
	$nama_pelajaran		=	$row_pelajaran_detail->nama_pelajaran;
	$kkm				=	$row_pelajaran_detail->kkm;
	$kkm_terampil		=	$row_pelajaran_detail->kkm_terampil;
	$sks				=	$row_pelajaran_detail->sks;
	
	$data[]=$kode_pelajaran.';'.$nama_pelajaran.';'.$kkm.';'.$kkm_terampil.';'.$sks.';'.$nilai_raport.';'.$predikat_p.';'.$nilai_raport_k.';'.$predikat_k.';'.$rata2.';'.$rata2_beban;
	
	$data2[]='Kelompok B (Umum)'.'|'.$kode_pelajaran.'|'.$nama_pelajaran.'|'.$kkm.'|'.$kkm_terampil.'|'.$sks.'|'.$nilai_raport.'|'.$predikat_p.'|'.$nilai_raport_k.'|'.$predikat_k.'|'.$rata2.'|'.$rata2_beban.'|'.$jumlah_nilai;
	
		
}


//=================Kelompok C (Peminatan)
$data_kelompok[]="Kelompok C (Peminatan)";
$sql = $selectview->list_daftarnilai_raport("SMA", $idtingkat, $idkelas, $idsemester, $idsiswa, 3);
while($row_pelajaran_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
	
	$jumlah_sks = $jumlah_sks + $row_pelajaran_detail->sks;
	
	//pengetahuan
	$nilai_p = 0;
	$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 3);
	$data_nilai_p	= $sqlnilai->fetch(PDO::FETCH_OBJ);
	$nilai_p		= $data_nilai_p->uas;
	
	$jumlah_nilai = 0;
	$jumlah_nilai	= $jumlah_nilai + $data_nilai_p->jumlah;
	
	$jumlah_ukbm_upd = 0;
	$nilai_detail_p = 0;
	$nilai_detail_non_uas_p=0;
	$sqlndetail = $selectview->list_daftarnilai_detail($data_nilai_p->replid);
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
	$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 4);
	$data_nilai_k	= $sqlnilai->fetch(PDO::FETCH_OBJ);
	$nilai_k		= $data_nilai_k->uas;
	
	$jumlah_nilai	= $jumlah_nilai + $data_nilai_k->jumlah;
	
	$jumlah_ukbm_upd = 0;
	$nilai_detail_k = 0;
	$nilai_detail_non_uas_k = 0;
	$sqlndetail = $selectview->list_daftarnilai_detail($data_nilai_k->replid);
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
	
	
	$kode_pelajaran		=	$row_pelajaran_detail->kode_pelajaran;
	$nama_pelajaran		=	$row_pelajaran_detail->nama_pelajaran;
	$kkm				=	$row_pelajaran_detail->kkm;
	$kkm_terampil		=	$row_pelajaran_detail->kkm_terampil;
	$sks				=	$row_pelajaran_detail->sks;
	
	$data[]=$kode_pelajaran.';'.$nama_pelajaran.';'.$kkm.';'.$kkm_terampil.';'.$sks.';'.$nilai_raport.';'.$predikat_p.';'.$nilai_raport_k.';'.$predikat_k.';'.$rata2.';'.$rata2_beban;
	
	$data2[]='Kelompok C (Peminatan)'.'|'.$kode_pelajaran.'|'.$nama_pelajaran.'|'.$kkm.'|'.$kkm_terampil.'|'.$sks.'|'.$nilai_raport.'|'.$predikat_p.'|'.$nilai_raport_k.'|'.$predikat_k.'|'.$rata2.'|'.$rata2_beban.'|'.$jumlah_nilai;
	
		
}


//=================Kelompok C (Pilihan Lintas Peminatan)
$data_kelompok[]="Kelompok C (Pilihan Lintas Peminatan)";
$sql = $selectview->list_daftarnilai_raport("SMA", $idtingkat, $idkelas, $idsemester, $idsiswa, 4);
while($row_pelajaran_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
	
	$jumlah_sks = $jumlah_sks + $row_pelajaran_detail->sks;
	
	//pengetahuan
	$nilai_p = 0;
	$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 3);
	$data_nilai_p	= $sqlnilai->fetch(PDO::FETCH_OBJ);
	$nilai_p		= $data_nilai_p->uas;
	
	$jumlah_nilai = 0;
	$jumlah_nilai	= $jumlah_nilai + $data_nilai_p->jumlah;
	
	$jumlah_ukbm_upd = 0;
	$nilai_detail_p = 0;
	$nilai_detail_non_uas_p=0;
	$sqlndetail = $selectview->list_daftarnilai_detail($data_nilai_p->replid);
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
	$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 4);
	$data_nilai_k	= $sqlnilai->fetch(PDO::FETCH_OBJ);
	$nilai_k		= $data_nilai_k->uas;
	
	$jumlah_nilai	= $jumlah_nilai + $data_nilai_k->jumlah;
	
	$jumlah_ukbm_upd = 0;
	$nilai_detail_k = 0;
	$nilai_detail_non_uas_k = 0;
	$sqlndetail = $selectview->list_daftarnilai_detail($data_nilai_k->replid);
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
	
	
	$kode_pelajaran		=	$row_pelajaran_detail->kode_pelajaran;
	$nama_pelajaran		=	$row_pelajaran_detail->nama_pelajaran;
	$kkm				=	$row_pelajaran_detail->kkm;
	$kkm_terampil		=	$row_pelajaran_detail->kkm_terampil;
	$sks				=	$row_pelajaran_detail->sks;
	
	$data[]=$kode_pelajaran.';'.$nama_pelajaran.';'.$kkm.';'.$kkm_terampil.';'.$sks.';'.$nilai_raport.';'.$predikat_p.';'.$nilai_raport_k.';'.$predikat_k.';'.$rata2.';'.$rata2_beban;
	
	$data2[]='Kelompok C (Pilihan Lintas Peminatan)'.'|'.$kode_pelajaran.'|'.$nama_pelajaran.'|'.$kkm.'|'.$kkm_terampil.'|'.$sks.'|'.$nilai_raport.'|'.$predikat_p.'|'.$nilai_raport_k.'|'.$predikat_k.'|'.$rata2.'|'.$rata2_beban.'|'.$jumlah_nilai;
	
		
}

if($jumlah_sks == 0) {
	$ip_semester = number_format(0,0,'.',',');
} else {
	$ip_semester = number_format($total_rata_beban/$jumlah_sks,0,'.',',');
}
										
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
		
						
		$this->SetFont('Arial','',11);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		
		$this->Ln(5);
		//$this->Cell(200,3,'',0,0,'C',false);
		//$this->Cell(90,3,$company_name,0,1,'C',false);
		//$this->Image('../assets/img/logo.jpg', 88, 10, 45, 13, 'jpg', '');
		//$this->Ln(1);
		
		/*$this->Cell(46,3,'',0,0,'L',false);
		$this->Cell(20,3,$bussines_type,0,1,'L',false);
		$this->Ln(1);*/
		
		/*$this->Cell(46,3,'',0,0,'C',false);
		//$this->Cell(50,3,'Alamat Kantor :' . $address . ' Telp: ' . $phone,0,1,'L',false);
		$this->Cell(115,3,$address,0,1,'C',false);
		$this->Ln(2);
		
		$this->Cell(26,3,'',0,0,'L',false);
		$this->Cell(20,3,'',0,1,'L',false); //$email
		$this->Ln(2);
		
		$this->SetFont('Arial','',14);
		$this->Cell(200,5,'xxxxxxx',0,1,'C',true);
		//$this->Cell(50,5,'No : ' . $ref,0,1,'R',false);
		$this->Ln(2);*/
		
		$this->SetFont('Arial','',10);
		$this->Cell(35,3,'Nama Sekolah',0,0,'L',true);
		$this->Cell(2,3,':',0,0,'L',false);
		$this->Cell(70,3,$nama_sekolah,0,0,'L',false);
		
		$this->SetFont('Arial','',10);
		$this->Cell(25,3,'Semester',0,0,'L',true);
		$this->Cell(2,3,':',0,0,'L',false);
		$this->Cell(80,3,$nama_semester,0,1,'L',false);
		$this->Ln(2);
		
		$this->SetFont('Arial','',10);
		$this->Cell(35,3,'Alamat',0,0,'L',true);
		$this->Cell(2,3,':',0,0,'L',false);
		$this->Cell(70,3,$alamat_sekolah,0,0,'L',false);
		
		$this->SetFont('Arial','',10);
		$this->Cell(25,3,'Peminatan',0,0,'L',true);
		$this->Cell(2,3,':',0,0,'L',false);
		$this->Cell(70,3,$minat,0,1,'L',false);
		$this->Ln(2);
		
		$this->SetFont('Arial','',10);
		$this->Cell(35,3,'Nama Peserta Didik',0,0,'L',true);
		$this->Cell(2,3,':',0,0,'L',false);
		$this->Cell(80,3,$nama_siswa,0,1,'L',false);
		$this->Ln(2);
		
		$this->SetFont('Arial','',10);
		$this->Cell(35,3,'Nomor Induk / NISN',0,0,'L',true);
		$this->Cell(2,3,':',0,0,'L',false);
		$this->Cell(80,3,$nis_siswa,0,1,'L',false);
		$this->Ln(2);
		
		/*$this->Cell(34,2,'Alamat',0,0,'L',true);
		$this->Cell(2,2,':',0,0,'L',false);
		$this->Cell(50,2,$address_client,0,1,'L',true);
		$this->Ln(2);
		
		$this->Cell(34,2,'No. Telepon',0,0,'L',true);
		$this->Cell(2,2,':',0,0,'L',false);
		$this->Cell(50,2,$phone_vdr,0,1,'L',true);
		$this->Ln(2);*/
		
		
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
				
		$this->Cell(15,7,"A. Sikap",0,1,"C");
		$this->Cell(15,7,"",0,0,"C");
		$this->Cell(35,7,"1. Sikap Spiritual",0,0,"C");
		$this->Cell(15,7,"Predikat",1,0,"C");
		$this->Cell(137,7,"Deskripsi",1,1,"C");
		
		$this->Cell(15,7,"",0,0,"C");
		$this->Cell(35,7,"",0,0,"C");
		$this->Cell(15,14,"A",1,0,"C");
		$this->MultiCell(137,7,$sikap_spirit_a,1,1,"L");
		
		$this->Cell(15,7,"",0,1,"C");
		$this->Cell(15,7,"",0,0,"C");
		$this->Cell(35,7,"2. Sikap Sosial",0,0,"C");
		$this->Cell(15,7,"Predikat",1,0,"C");
		$this->Cell(137,7,"Deskripsi",1,1,"C");
		
		$this->Cell(15,7,"",0,0,"C");
		$this->Cell(35,7,"",0,0,"C");
		$this->Cell(15,21,"A",1,0,"C");
		$this->MultiCell(137,7,$sikap_sosial_a,1,1,"L");
		
		$this->Ln(2);
		
		$this->Cell(15,7,"B. Pengetahuan dan Keterampilan",0,1,"L");		
		$this->Ln(2);
		
		$this->Cell(15,7,"",1,0,"C");
		$this->Cell(65,7,"",1,0,"C");
		$this->Cell(20,7,"KKM",1,0,"C");
		//$this->Cell(10,7,"KKM",1,0,"C");
		$this->Cell(15,7,"",1,0,"C");
		$this->Cell(26,7,"Pengetahuan",1,0,"C");
		//$this->Cell(13,7,"Peng",1,0,"C");
		$this->Cell(26,7,"Keterampilan",1,0,"C");
		//$this->Cell(13,7,"Ketr",1,0,"C");
		$this->Cell(35,7,"",1,1,"C");
		//$this->Cell(22,7,"",1,1,"C");
			
		//Header
		$i=0;				
		foreach($header as $col) {
			if ($i==0) { $this->Cell(15,7,"Kode",1,0,"C"); }
			if ($i==1) { $this->Cell(65,7,"Mata Pelajaran",1,0,"C"); }
			if ($i==2) { $this->Cell(10,7,"P",1,0,"C"); }
			if ($i==2) { $this->Cell(10,7,"K",1,0,"C"); }
			if ($i==3) { $this->Cell(15,7,"Beban/JP",1,0,"C"); }
			if ($i==4) { $this->Cell(13,7,"Angka",1,0,"C"); }
			if ($i==5) { $this->Cell(13,7,"Predikat",1,0,"C"); }
			if ($i==6) { $this->Cell(13,7,"Angka",1,0,"C"); }
			if ($i==7) { $this->Cell(13,7,"Predikat",1,0,"C"); }
			if ($i==8) { $this->Cell(13,7,"Rata2",1,0,"C"); }
			if ($i==10) { $this->Cell(22,7,"Rata2 x Beban",1,0,"C"); }
			$i++;
		}
		$this->Ln();
		
		//Data	
		global $data_kelompok;
		global $data_deposit;
		global $data2;
		global $total_dp;
		global $g_total;
		global $inv_amount;
		global $deposit_d;
		global $total_qty_po;
		global $sub_total_invoice;
		global $total_qty;
		global $sx_total;
		global $jumlah_nilai;
		
		$total_qty = 0;
		for($z=0; $z<count($data_kelompok); $z++) {
			
			$this->SetFont('Arial','B',9);
			$this->Cell(202,7,$data_kelompok[$z],1,1,"L");
			
			$this->SetFont('Arial','',9);
			
			$s_total = 0;
			$k = 0;
			for($s=0; $s<count($data2); $s++) {
				$exdata = explode('|', $data2[$s]);
				
				if($exdata[0] == $data_kelompok[$z]) {
					$k++;
					
					if($exdata[12] > 0) {
						$this->Cell(15,7,$exdata[1],1,0,"C"); //kode
						$this->Cell(65,7,$exdata[2],1,0,"L"); //nama
						$this->Cell(10,7,$exdata[3],1,0,"C"); //P
						$this->Cell(10,7,$exdata[4],1,0,"C"); //K
						$this->Cell(15,7,$exdata[5],1,0,"C"); //sks
						$this->Cell(13,7,$exdata[6],1,0,"C"); //angka(P)
						$this->Cell(13,7,$exdata[7],1,0,"C"); //predikat(P)
						$this->Cell(13,7,$exdata[8],1,0,"C"); //angka(K)
						$this->Cell(13,7,$exdata[9],1,0,"C"); //predikat(K)
						$this->Cell(13,7,$exdata[10],1,0,"C"); //rata2
						$this->Cell(22,7,$exdata[11],1,1,"C"); //rata2 * beban
					}
				}
			}
			
			
			/*$this->Cell(155,5,'Sub Total :',0,0,'R');
			$this->Cell(14,5,'',0,0,'C');
			$this->Cell(19,5,number_format($sx_total,0,'.',','),0,1,'R'); //$sub_total_invoice[$z] //$sx_total $totald
			
			$sub_deposit = number_format($deposit_d,0,".",",");
			$this->Cell(155,5,'Uang Muka :',0,0,'R');
			$this->Cell(14,5,'',0,0,'C');
			$this->Cell(19,5,$sub_deposit,0,1,'R');
			$this->Ln();*/
			
			/*foreach($data as $row)
			{	
				$i=0;
				
				foreach($row as $col) {
					if ($i==0) { $this->Cell(13,7,$col,1,0,"C"); }
					if ($i==1) { $this->Cell(90,7,$col,1,0,"L"); }
					if ($i==2) { $this->Cell(25,7,$col,1,0,"R"); }
					if ($i==3) { $this->Cell(30,7,$col,1,0,"R"); }
					if ($i==4) { $this->Cell(30,7,$col,1,0,"R"); }
					$i++;
				}
				$this->Ln();
				
			}*/	
		}
		
		
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
		
		$this->Ln(2);
		
		$size = $size + $sizeadd;
		
		//---------
		$this->SetFont('Arial','',9);
		
		$this->Cell(100,7,'Jumlah',1,0,'C',true);
		$this->Cell(15,7,$jumlah_sks,1,0,'C',true);
		$this->Cell(13,7,$total_p,1,0,'C',true);
		$this->Cell(13,7,'',1,0,'C',true);
		$this->Cell(13,7,$total_k,1,0,'C',true);
		$this->Cell(13,7,'',1,0,'C',true);
		$this->Cell(13,7,$total_rata,1,0,'C',true);
		$this->Cell(22,7,$total_rata_beban,1,0,'C',true);
		$this->Ln(10);
		
		$this->Cell(80,7,'IP Semester ((Rata2 Nilai x Beban)/Jml. Beban',1,0,'C',true);
		$this->Cell(10,7,$ip_semester,1,0,'C',true);
		$this->Cell(10,7,'',0,0,'C',true);
		$this->Cell(13,7,'KKM',1,0,'C',true);
		$this->Cell(88,7,'Predikat',1,1,'C',true);
		
		$this->Cell(100,7,'',0,0,'C',true);
		$this->Cell(13,7,'',1,0,'C',true);
		$this->Cell(22,7,'D=Kurang',1,0,'C',true);
		$this->Cell(22,7,'C=Cukup',1,0,'C',true);
		$this->Cell(22,7,'B=Baik',1,0,'C',true);
		$this->Cell(22,7,'A=Sangat Baik',1,1,'C',true);
		
		$this->Cell(100,7,'',0,0,'C',true);
		$this->Cell(13,7,'75',1,0,'C',true);
		$this->Cell(22,7,'< 75',1,0,'C',true);
		$this->Cell(22,7,'75 s.d 82',1,0,'C',true);
		$this->Cell(22,7,'83 s.d 90',1,0,'C',true);
		$this->Cell(22,7,'91 s.d 100',1,1,'C',true);
		$this->Ln(15);
		
		$this->SetFont('Arial','',10);
		
		$tgl 	= "14-12-2018";
		$tnggal	= tglindonesia($tgl, $hasil);
		
		$this->Cell(75,5,'Mengetahui,',0,0,'C',true);
		$this->Cell(115,5,'Bandung, '.$tnggal,0,1,'R',true);
		$this->Cell(60,5,'Orang Tua/Wali',0,0,'C',true);
		
		$this->Cell(70,5,'Pembimbing Akademik',0,0,'C',true);
		
		$this->Cell(70,5,'Kepala Sekolah',0,1,'C',true);	
		$this->Ln(15);
		
		$size = $size + $sizeadd;
		
		$this->Cell(60,5,'',0,0,'C',true);	
		$this->Cell(70,5,$nama_wali,0,0,'C',true);	
		$this->Cell(70,5,$nama_kepsek,0,1,'C',true);
		
		$this->Cell(60,5,'..................................',0,0,'C',true);	
		$this->Cell(70,5,$nip_wali,0,0,'C',true);	
		$this->Cell(70,5,$nip_kepsek,0,1,'C',true);		
		$this->Ln(2);
		
				
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