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

//include "phpqrcode/qrlib.php"; //<-- LOKASI FILE UTAMA PLUGINNYA

//$select = new select;
$selectview = new selectview;

#-------------FILTER
$idsiswa		= $_REQUEST["idsiswa"];
$idsemester		= $_REQUEST["semester_id"]; //$_SESSION["semester_id"];
$idtingkat		= $_REQUEST["idtingkat"];
$idkelas		= $_REQUEST["idkelas"];
$idtahunajaran	= $_REQUEST["idtahunajaran"];
$alumni			= $_REQUEST["alumni"];

$sqlidentitas = $selectview->list_identitas();
$dataidentitas = $sqlidentitas->fetch(PDO::FETCH_OBJ);

$sqlthnajaran = $selectview->list_tahunajaran($idtahunajaran);
$datatahunajaran = $sqlthnajaran->fetch(PDO::FETCH_OBJ);
$tahun_ajaran 	= $datatahunajaran->tahunajaran;
$nip_kepsek		= $datatahunajaran->info1;
$nama_kepsek	= $datatahunajaran->nama_kepsek;
$ttd_file_kepsek= $datatahunajaran->ttd_file;

$sqlsiswa = $selectview->list_siswa2("", $idsiswa, '', '', $alumni, '');
$datasiswa = $sqlsiswa->fetch(PDO::FETCH_OBJ);

$peminatan = "";
$minat = "";
if($datasiswa->idminat == 1) {
	$minat = "Matematika dan Ilmu Pengetahuan Alam";
	
	$peminatan = "MIPA";
}
if($datasiswa->idminat == 2) {
	$minat = "Ilmu-ilmu Sosial";
	
	$peminatan = "IPS";
}

$sqlsemester = $selectview->list_semester($idsemester);
$datasemester = $sqlsemester->fetch(PDO::FETCH_OBJ);

$sqldesc_predikat_spirit = $selectview->list_deskripsi_raport("", "", "Spritual", "");
$datadesc_predikat_spirit = $sqldesc_predikat_spirit->fetch(PDO::FETCH_OBJ);

$sqldesc_predikat_sosial = $selectview->list_deskripsi_raport("", "", "Sosial", "");
$datadesc_predikat_sosial = $sqldesc_predikat_sosial->fetch(PDO::FETCH_OBJ);

$sqlperiode_raport = $selectview->list_setup_periode_raport($idtahunajaran, $idsemester, $idtingkat);
$periode_raport = $sqlperiode_raport->fetch(PDO::FETCH_OBJ);
/*------------------------------------------*/

/*---------print header-----------*/
$nama_sekolah	=	$dataidentitas->nama;
$nama_semester	=	$datasemester->semester;
$tanggal_ttd	=	$periode_raport->tanggal_ttd; //$datasemester->tanggal_ttd;
$alamat_sekolah	=	$dataidentitas->alamat1;
$nama_siswa		=	$datasiswa->nama;
$nis_siswa		=	$datasiswa->nis;
$nisn_siswa		=	$datasiswa->nisn;
$idtingkat		= 	$idtingkat; //$datasiswa->idtingkat;
$idkelas_wali	=	$idkelas; //$datasiswa->idkelas;

$numeric_semester = numeric_semester($idtingkat, $idsemester);
/*-------------------------------*/

/*-----------footer-------------*/
/*$sql_peg = $selectview->list_pegawai('', '196106231981012002', '', '');
$data_peg = $sql_peg->fetch(PDO::FETCH_OBJ);
$nip_kepsek 	= $data_peg->nip;
$nama_kepsek	= $data_peg->nama;*/
/*------------------------------*/

/*---------print detail----------*/
$data			=	array();
$data2			=	array();
$data_kelompok	=	array();

$no = 0;
##START GET NILAI

$data_kelompok[]="Kelompok A (Umum)";

$total_rata_beban__ = 0;
$total_rata_beban = 0;
$jumlah_sks = 0;
$no_urut_mapel = 0;
$sikap_spirit_abjad = "";
$sql = $selectview->list_daftarnilai_raport("SMA", $idtingkat, $idkelas, $idsemester, $idsiswa, 1, $peminatan, $idtahunajaran, $nis_siswa);
while($row_pelajaran_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
	
	$no_urut_mapel++;
	
	//penilaian sikap
	if($row_pelajaran_detail->sikap == "") { $sikap_angka = 3; }
	if($row_pelajaran_detail->sikap == "A") { $sikap_angka = 3; }
	if($row_pelajaran_detail->sikap == "B") { $sikap_angka = 2; }
	if($row_pelajaran_detail->sikap == "C") { $sikap_angka = 1; }
	
	if($sikap_angka2 < $sikap_angka) { $sikap_angka2 = $sikap_angka; }
	
	if($sikap_spirit_abjad == "") {
		if($sikap_angka2 == 3) {
			$sikap_spirit_a	=	$datadesc_predikat_spirit->sikap_a;
			$sikap_sosial_a	=	$datadesc_predikat_sosial->sikap_a;
			
			$sikap_spirit_abjad = "A";
			$sikap_sosial_abjad = "A";
		}
		if($sikap_angka2 == 2) {
			$sikap_spirit_a	=	$datadesc_predikat_spirit->sikap_b;
			$sikap_sosial_a	=	$datadesc_predikat_sosial->sikap_b;
			
			$sikap_spirit_abjad = "B";
			$sikap_sosial_abjad = "B";
		}
		if($sikap_angka2 == 1) {
			$sikap_spirit_a	=	$datadesc_predikat_spirit->sikap_c;
			$sikap_sosial_a	=	$datadesc_predikat_sosial->sikap_c;
			
			$sikap_spirit_abjad = "C";
			$sikap_sosial_abjad = "C";
		}
	}
	//----------/\------------------------
	
	$idkelas1	=	$row_pelajaran_detail->idkelas;		
	
	//pengetahuan
	$nilai_p = 0;
	$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 3, $nis_siswa);
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
	
	//FORMULA KETERAMPILAN DIRUBAH LAGI SEPERTI PENGETAHUAN (2019-05-27)
	
	//keterampilan
	$nilai_k = 0;
	$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 4, $nis_siswa);
	$data_nilai_k	= $sqlnilai->fetch(PDO::FETCH_OBJ);
	$nilai_k		= $data_nilai_k->uas;
	
	$jumlah_nilai	= $jumlah_nilai + $data_nilai_k->jumlah;
	
	$nilai_tertinggi= 0;
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
	
	//$rata2 	= 	(($nilai_detail_p + $nilai_p) + ($nilai_detail_k + $nilai_k))/2;
	$rata2 	= 	( numberreplace($nilai_raport) + numberreplace($nilai_raport_k))/2;
	$rata2_beban = number_format($rata2 * $row_pelajaran_detail->sks,0,'.',',');
	$rata2	=	number_format($rata2,0,'.',',');
	$total_rata = $total_rata + numberreplace($rata2);
	$total_rata_beban = $total_rata_beban + numberreplace($rata2_beban); //($rata2 * $row_pelajaran_detail->sks);
	
	/*echo '$nilai_detail_p ='. $nilai_detail_p.'>>$nilai_p '.$nilai_p."<br>";
	echo '$nilai_detail_k ='. $nilai_detail_k.'>>$nilai_k '.$nilai_k."<br>";
	echo $rata2."<br>";*/
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
	
	//cek nama alias mapel
	$nama_pelajaran		=	$row_pelajaran_detail->nama_pelajaran;
	$sqlalias = $selectview->list_pelajaran_alias($row_pelajaran_detail->pelajaran_id, $row_pelajaran_detail->idpelajaran_alias); 
	$data_alias = $sqlalias->fetch(PDO::FETCH_OBJ);
	if($data_alias->nama_alias != "") {
		$nama_pelajaran = $data_alias->nama_alias;
		
		//$jumlah_sks = 	$jumlah_sks + $row_pelajaran_detail->sks;
	} else {
		//$jumlah_sks = 	$jumlah_sks + $row_pelajaran_detail->sks;
	}
	$kode_pelajaran		=	"MPW".($datasiswa->idminat + 1); //."0".$no_urut_mapel.$numeric_semester; //$row_pelajaran_detail->kode_pelajaran;
	$nama_pelajaran		=	$nama_pelajaran . " " . $numeric_semester;
	$kkm				=	$row_pelajaran_detail->kkm;
	$kkm_terampil		=	$row_pelajaran_detail->kkm_terampil;
	$sks				=	$row_pelajaran_detail->sks;
	
	$data[]=$kode_pelajaran.';'.$nama_pelajaran.';'.$kkm.';'.$kkm_terampil.';'.$sks.';'.$nilai_raport.';'.$predikat_p.';'.$nilai_raport_k.';'.$predikat_k.';'.$rata2.';'.$rata2_beban;
	
	$data2[]='Kelompok A (Umum)'.'|'.$kode_pelajaran.'|'.$nama_pelajaran.'|'.$kkm.'|'.$kkm_terampil.'|'.$sks.'|'.$nilai_raport.'|'.$predikat_p.'|'.$nilai_raport_k.'|'.$predikat_k.'|'.$rata2.'|'.$rata2_beban.'|'.$jumlah_nilai;
	
		
}


//=================B UMUM
$no_urut_mapel = 0;
$data_kelompok[]="Kelompok B (Umum)";
$sql = $selectview->list_daftarnilai_raport("SMA", $idtingkat, $idkelas, $idsemester, $idsiswa, 2, $peminatan, $idtahunajaran, $nis_siswa);
while($row_pelajaran_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
	
	$no_urut_mapel++;
	
	/*$jumlah_sks = $jumlah_sks + $row_pelajaran_detail->sks;
	echo $row_pelajaran_detail->nama_pelajaran.'>>'.$row_pelajaran_detail->sks.'<br>';*/
	
	//pengetahuan
	$nilai_p = 0;
	$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 3,$nis_siswa);
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
	$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 4, $nis_siswa);
	$data_nilai_k	= $sqlnilai->fetch(PDO::FETCH_OBJ);
	$nilai_k		= $data_nilai_k->uas;
	
	$jumlah_nilai	= $jumlah_nilai + $data_nilai_k->jumlah;
		
	$nilai_tertinggi= 0;
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
	
	//$rata2 	= 	(($nilai_detail_p + $nilai_p) + ($nilai_detail_k + $nilai_k))/2;
	$rata2 	= 	(($nilai_raport) + ($nilai_raport_k))/2;
	$rata2_beban = number_format($rata2 * $row_pelajaran_detail->sks,0,'.',',');
	$rata2	=	number_format($rata2,0,'.',',');
	$total_rata = $total_rata + numberreplace($rata2);
	$total_rata_beban = $total_rata_beban + numberreplace($rata2_beban); //($rata2 * $row_pelajaran_detail->sks); //numberreplace($rata2_beban);
	
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
	
	//cek nama alias mapel
	$nama_pelajaran		=	$row_pelajaran_detail->nama_pelajaran;
	$sqlalias = $selectview->list_pelajaran_alias($row_pelajaran_detail->pelajaran_id, $row_pelajaran_detail->idpelajaran_alias); 
	$data_alias = $sqlalias->fetch(PDO::FETCH_OBJ);
	if($data_alias->nama_alias != "") {
		$nama_pelajaran = $data_alias->nama_alias;
		//$jumlah_sks = 	$jumlah_sks + $row_pelajaran_detail->sks;
	} else {
		//$jumlah_sks = 	$jumlah_sks + $row_pelajaran_detail->sks;
	}
	
	$kode_pelajaran		=	"MPW".($datasiswa->idminat + 1); //."0".$no_urut_mapel.$numeric_semester; //$row_pelajaran_detail->kode_pelajaran;
	$nama_pelajaran		=	$nama_pelajaran . " " . $numeric_semester;
	$kkm				=	$row_pelajaran_detail->kkm;
	$kkm_terampil		=	$row_pelajaran_detail->kkm_terampil;
	$sks				=	$row_pelajaran_detail->sks;
	
	$data[]=$kode_pelajaran.';'.$nama_pelajaran.';'.$kkm.';'.$kkm_terampil.';'.$sks.';'.$nilai_raport.';'.$predikat_p.';'.$nilai_raport_k.';'.$predikat_k.';'.$rata2.';'.$rata2_beban;
	
	$data2[]='Kelompok B (Umum)'.'|'.$kode_pelajaran.'|'.$nama_pelajaran.'|'.$kkm.'|'.$kkm_terampil.'|'.$sks.'|'.$nilai_raport.'|'.$predikat_p.'|'.$nilai_raport_k.'|'.$predikat_k.'|'.$rata2.'|'.$rata2_beban.'|'.$jumlah_nilai;
	
		
}


//=================Kelompok C (Peminatan)
$idpelajaran_check = "";
$no_urut_mapel = 0;
$data_kelompok[]="Kelompok C (Peminatan)";
$sql = $selectview->list_daftarnilai_raport("SMA", $idtingkat, $idkelas, $idsemester, $idsiswa, 3, $peminatan, $idtahunajaran, $nis_siswa);
while($row_pelajaran_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
	
	/*$jumlah_sks = $jumlah_sks + $row_pelajaran_detail->sks;
	echo $row_pelajaran_detail->nama_pelajaran.'>>'.$row_pelajaran_detail->sks.'<br>';*/
	
	//if (preg_match("/64/",$idpelajaran_check) == 0) {
		
		$no_urut_mapel++;
		
		$idpelajaran_check = $idpelajaran_check . "," . $row_pelajaran_detail->pelajaran_id;
		
		//pengetahuan
		$nilai_p = 0;
		$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, $idtahunajaran, $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 3, $nis_siswa);
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
		$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, $idtahunajaran, $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 4, $nis_siswa);
		$data_nilai_k	= $sqlnilai->fetch(PDO::FETCH_OBJ);
		$nilai_k		= $data_nilai_k->uas;
		
		$jumlah_nilai	= $jumlah_nilai + $data_nilai_k->jumlah;
		
		$nilai_tertinggi= 0;
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
		
		//$rata2 	= 	(($nilai_detail_p + $nilai_p) + ($nilai_detail_k + $nilai_k))/2;
		$rata2 	= 	(($nilai_raport) + ($nilai_raport_k))/2;
		$rata2_beban = number_format($rata2 * $row_pelajaran_detail->sks,0,'.',',');
		$rata2	=	number_format($rata2,0,'.',',');
		$total_rata = $total_rata + numberreplace($rata2);
		$total_rata_beban = $total_rata_beban + numberreplace($rata2_beban); //($rata2 * $row_pelajaran_detail->sks); //numberreplace($rata2_beban);
		
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
		
		//cek nama alias mapel
		$nama_pelajaran		=	$row_pelajaran_detail->nama_pelajaran;
		$sqlalias = $selectview->list_pelajaran_alias($row_pelajaran_detail->pelajaran_id, $row_pelajaran_detail->idpelajaran_alias); 
		$data_alias = $sqlalias->fetch(PDO::FETCH_OBJ);
		if($data_alias->nama_alias != "") {
			$nama_pelajaran = $data_alias->nama_alias;
			//$jumlah_sks = 	$jumlah_sks + $row_pelajaran_detail->sks;
		} else {
			//$jumlah_sks = 	$jumlah_sks + $row_pelajaran_detail->sks;
		}
		
		$kode_pelajaran		=	"MPM".($datasiswa->idminat + 1); //."0".$no_urut_mapel.$numeric_semester; //$row_pelajaran_detail->kode_pelajaran;
		$nama_pelajaran		=	$nama_pelajaran . " " . $numeric_semester;
		$kkm				=	$row_pelajaran_detail->kkm;
		$kkm_terampil		=	$row_pelajaran_detail->kkm_terampil;
		$sks				=	$row_pelajaran_detail->sks;
		
		$data[]=$kode_pelajaran.';'.$nama_pelajaran.';'.$kkm.';'.$kkm_terampil.';'.$sks.';'.$nilai_raport.';'.$predikat_p.';'.$nilai_raport_k.';'.$predikat_k.';'.$rata2.';'.$rata2_beban;
		
		$data2[]='Kelompok C (Peminatan)'.'|'.$kode_pelajaran.'|'.$nama_pelajaran.'|'.$kkm.'|'.$kkm_terampil.'|'.$sks.'|'.$nilai_raport.'|'.$predikat_p.'|'.$nilai_raport_k.'|'.$predikat_k.'|'.$rata2.'|'.$rata2_beban.'|'.$jumlah_nilai;
		
	//}
	
}


//=================Kelompok C (Pilihan Lintas Peminatan)
$no_urut_mapel = 0;
$data_kelompok[]="Kelompok C (Pilihan Lintas Peminatan)";
$sql = $selectview->list_daftarnilai_raport_lintas_minat("SMA", $idtingkat, $idkelas, $idsemester, $idsiswa, 4, $peminatan, $idtahunajaran, $nis_siswa);
while($row_pelajaran_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
	
	$no_urut_mapel++;
	
	/*$jumlah_sks = $jumlah_sks + $row_pelajaran_detail->sks;
	echo $row_pelajaran_detail->nama_pelajaran.'>>'.$row_pelajaran_detail->sks.'<br>';*/
	
	//pengetahuan
	$nilai_p = 0;
	$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 3, $nis_siswa);
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
	$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 4, $nis_siswa);
	$data_nilai_k	= $sqlnilai->fetch(PDO::FETCH_OBJ);
	$nilai_k		= $data_nilai_k->uas;
	
	$jumlah_nilai	= $jumlah_nilai + $data_nilai_k->jumlah;
	
	$nilai_tertinggi= 0;
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
	
	//$rata2 	= 	(($nilai_detail_p + $nilai_p) + ($nilai_detail_k + $nilai_k))/2;
	$rata2 	= 	(($nilai_raport) + ($nilai_raport_k))/2;
	$rata2_beban = number_format($rata2 * $row_pelajaran_detail->sks,0,'.',',');
	$rata2	=	number_format($rata2,0,'.',',');
	$total_rata = $total_rata + numberreplace($rata2);
	$total_rata_beban = $total_rata_beban + numberreplace($rata2_beban); //($rata2 * $row_pelajaran_detail->sks); //numberreplace($rata2_beban);
	
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
	
	//cek nama alias mapel
	$nama_pelajaran		=	$row_pelajaran_detail->nama_pelajaran;
	$sqlalias = $selectview->list_pelajaran_alias($row_pelajaran_detail->pelajaran_id, $row_pelajaran_detail->idpelajaran_alias); 
	$data_alias = $sqlalias->fetch(PDO::FETCH_OBJ);
	if($data_alias->nama_alias != "") {
		$nama_pelajaran = $data_alias->nama_alias;
		//$jumlah_sks = 	$jumlah_sks + $row_pelajaran_detail->sks;
	} else {
		//$jumlah_sks = 	$jumlah_sks + $row_pelajaran_detail->sks;
	}
	
	$kode_pelajaran		=	"MPP".($datasiswa->idminat + 1); //."0".$no_urut_mapel.$numeric_semester; //$row_pelajaran_detail->kode_pelajaran;
	$nama_pelajaran		=	$nama_pelajaran . " " . $numeric_semester;
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
										
//$sql_wali 	= $selectview->list_kelas($idkelas_wali, ""); //$idkelas1
$sql_wali 	= $selectview->list_kelas_detail($idkelas_wali, $idtahunajaran); //$idkelas1
$data_wali	= $sql_wali->fetch(PDO::FETCH_OBJ);
$nip_wali	= $data_wali->nip_wali;
$nama_wali	= $data_wali->walikelas;
$ttd_file_wali	= $data_wali->ttd_file;
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
		global $tahun_ajaran;
						
		$this->SetFont('Arial','',11);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		
		$this->Ln(2);
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
		$this->Cell(80,3,$numeric_semester . "-" .$tahun_ajaran,0,1,'L',false); //$_SESSION["tahunajaran"]
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
		$this->Cell(80,3,$nis_siswa." / ". $nisn_siswa ,0,1,'L',false);
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
		global $sikap_spirit_abjad;
		global $sikap_sosial_abjad;
		
		$this->SetFont('Arial','B',9);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		
		$this->Ln(2);		
				
		$this->Cell(15,7,"A. Sikap",0,1,"C");
		$this->Cell(15,7,"",0,0,"C");
		$this->Cell(35,7,"1. Sikap Spiritual",0,0,"C");
		$this->Cell(15,7,"Predikat",1,0,"C");
		$this->Cell(137,7,"Deskripsi",1,1,"C");
		
		$this->Cell(15,7,"",0,0,"C");
		$this->Cell(35,7,"",0,0,"C");
		$this->Cell(15,10,$sikap_spirit_abjad,1,0,"C");
		$this->MultiCell(137,5,$sikap_spirit_a,1,1,"L");
		
		$this->Cell(15,7,"",0,1,"C");
		$this->Cell(15,7,"",0,0,"C");
		$this->Cell(35,7,"2. Sikap Sosial",0,0,"C");
		$this->Cell(15,7,"Predikat",1,0,"C");
		$this->Cell(137,7,"Deskripsi",1,1,"C");
		
		$this->Cell(15,7,"",0,0,"C");
		$this->Cell(35,7,"",0,0,"C");
		$this->Cell(15,15,$sikap_sosial_abjad,1,0,"C");
		$this->MultiCell(137,5,$sikap_sosial_a,1,1,"L");
		
		$this->Ln(2);
		
		$this->Cell(15,7,"B. Pengetahuan dan Keterampilan",0,1,"L");		
		$this->Ln(2);
		
		//$this->Cell(0.01,14,"",1,0,"C");
		$this->Cell(15,14,"Kode",1,0,"C");
		//$this->Cell(0.01,14,"",1,0,"C");
		$this->Cell(65,14,"Mata Pelajaran",1,0,"C");
		//$this->Cell(0.01,14,"",1,0,"C");
		$this->Cell(20,7,"KKM",1,0,"C");
		//$this->Cell(10,7,"KKM",1,0,"C");
		$this->Cell(15,14,"Beban",1,0,"C");
		$this->Cell(26,7,"Pengetahuan(P)",1,0,"C");
		//$this->Cell(13,7,"Peng",1,0,"C");
		$this->Cell(26,7,"Keterampilan(K)",1,0,"C");
		//$this->Cell(13,7,"Ketr",1,0,"C");
		$this->Cell(13,14,"Rata2",1,0,"C");
		//$this->Cell(0.01,7,"",1,0,"C");
		$this->Cell(22,14,"Rata2 x",1,0,"C");
		$this->Cell(0.01,7,"",1,1,"C");	
		//Header
		
		$this->Cell(15,7,"",0,0,"C");
		$this->Cell(65,7,"",0,0,"C");
		$this->Cell(10,7,"P",1,0,"C");
		$this->Cell(10,7,"K",1,0,"C");
		$this->Cell(15,7,"/JP",0,0,"C"); //sks
		$this->Cell(13,7,"Angka",1,0,"C");
		$this->Cell(13,7,"Predikat",1,0,"C");
		$this->Cell(13,7,"Angka",1,0,"C");
		$this->Cell(13,7,"Predikat",1,0,"C");
		$this->Cell(13,7,"",0,0,"C"); //rata2
		$this->Cell(22,7,"Beban",0,0,"C");
		$this->Cell(0.01,7,"",1,0,"C");
			
		$i=0;				
		/*foreach($header as $col) {
			if ($i==0) { $this->Cell(15,7,"",0,0,"C"); }
			if ($i==1) { $this->Cell(65,7,"",0,0,"C"); }
			if ($i==2) { $this->Cell(10,7,"P",1,0,"C"); }
			if ($i==2) { $this->Cell(10,7,"K",1,0,"C"); }
			if ($i==3) { $this->Cell(15,7,"/JP",0,0,"C"); } //sks
			if ($i==4) { $this->Cell(13,7,"Angka",1,0,"C"); }
			if ($i==5) { $this->Cell(13,7,"Predikat",1,0,"C"); }
			if ($i==6) { $this->Cell(13,7,"Angka",1,0,"C"); }
			if ($i==7) { $this->Cell(13,7,"Predikat",1,0,"C"); }
			if ($i==8) { $this->Cell(13,7,"",0,0,"C"); } //rata2
			if ($i==10) { $this->Cell(22,7,"",0,0,"C"); }
			//$this->Cell(0.01,7,"",1,0,"C");
			$i++;
		}*/
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
		global $numeric_semester;
		global $jumlah_sks;
		
		$total_p = 0;
		$total_k = 0;
		$total_rata = 0;
		$total_rata_beban = 0;
		
		$total_qty = 0;
		for($z=0; $z<count($data_kelompok); $z++) {
			
			$this->SetFont('Arial','B',8);
			$this->Cell(202,7,$data_kelompok[$z],1,1,"L");
			
			$this->SetFont('Arial','',8);
			
			
			$s_total = 0;
			$k = 0;
			for($s=0; $s<count($data2); $s++) {
				$exdata = explode('|', $data2[$s]);
				
				if($exdata[0] == $data_kelompok[$z]) {
					if($exdata[12] > 0) {
						$k++;
						
						$rata2_beban= 0;
						$rata2_beban = $exdata[5] * $exdata[10];
						$this->Cell(15,7,$exdata[1]."0".$k.$numeric_semester,1,0,"C"); //kode
						$this->Cell(65,7,$exdata[2],1,0,"L"); //nama
						$this->Cell(10,7,$exdata[3],1,0,"C"); //P
						$this->Cell(10,7,$exdata[4],1,0,"C"); //K
						$this->Cell(15,7,$exdata[5],1,0,"C"); //sks
						if($exdata[6] < $exdata[3]) {
							$this->SetTextColor(255,0,0);
							$this->Cell(13,7,$exdata[6],1,0,"C"); //angka(P)
							$this->SetTextColor(0,0,0);
						} else {
							$this->Cell(13,7,$exdata[6],1,0,"C"); //angka(P)
						} 
						$this->Cell(13,7,$exdata[7],1,0,"C"); //predikat(P)
						
						if($exdata[8] < $exdata[4]) {
							$this->SetTextColor(255,0,0);
							$this->Cell(13,7,$exdata[8],1,0,"C"); //angka(K)
							$this->SetTextColor(0,0,0);
						} else {
							$this->Cell(13,7,$exdata[8],1,0,"C"); //angka(K)
						} 
						$this->Cell(13,7,$exdata[9],1,0,"C"); //predikat(K)
						$this->Cell(13,7,$exdata[10],1,0,"C"); //rata2
						$this->Cell(22,7,$rata2_beban,1,1,"C"); //rata2 * beban //$exdata[11]
						
						$total_p = $total_p + $exdata[6];
						$total_k = $total_k + $exdata[8];
						$total_rata = $total_rata + $exdata[10];
						$total_rata_beban = $total_rata_beban + $rata2_beban;
						
						$jumlah_sks = $jumlah_sks + $exdata[5];
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
		global $ttd_file_wali;
		global $ttd_file_kepsek;
		
		//global $total_p;
		//global $total_k;
		//global $total_rata;
		
		global $ip_semester;
		global $tanggal_ttd;
		
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
		
		if($jumlah_sks == 0) {
			$ip_semester = number_format(0,0,'.',',');
		} else {
			$ip_semester = number_format($total_rata_beban/$jumlah_sks,0,'.',',');
		}

		$this->Cell(80,7,'IP Semester ((Rata2 Nilai x Beban)/Jml. Beban)',1,0,'C',true);
		$this->Cell(10,7,$ip_semester,1,0,'C',true);
		$this->Cell(10,7,'',0,0,'C',true);
		$this->Cell(13,7,'KKM',1,0,'C',true);
		$this->Cell(88,7,'Range Predikat',1,1,'C',true);
		
		$this->Cell(100,7,'',0,0,'C',true);
		$this->Cell(13,11,'',1,0,'C',true);
		$this->Cell(22,7,'D=Kurang',1,0,'C',true);
		$this->Cell(22,7,'C=Cukup',1,0,'C',true);
		$this->Cell(22,7,'B=Baik',1,0,'C',true);
		$this->Cell(22,7,'A=Sangat Baik',1,1,'C',true);
		
		$this->Cell(90,7,'',0,0,'L',true);
		$this->Cell(10,7,'',0,0,'L',true);
		$this->Cell(13,7,'75',1,0,'C',true);//75
		$this->Cell(22,7,'< 75',1,0,'C',true);
		$this->Cell(22,7,'75 s.d 82',1,0,'C',true);
		$this->Cell(22,7,'83 s.d 90',1,0,'C',true);
		$this->Cell(22,7,'91 s.d 100',1,1,'C',true);
		$this->Ln(7);
		
		$this->SetFont('Arial','',10);
		
		$tgl 	= date("d-m-Y", strtotime($tanggal_ttd)); //date("Y-m-d"); //14-12-2018";
		$tnggal	= tglindonesia($tgl, $hasil);
		
		$this->Cell(59,5,'Mengetahui,',0,0,'C',true);
		$this->Cell(128,5,'Bandung, '.$tnggal,0,1,'R',true);
		$this->Cell(60,5,'Orang Tua/Wali',0,0,'C',true);
		
		$this->Cell(70,5,'Pembimbing Akademik',0,0,'C',true);
		
		$this->Cell(70,5,'Kepala Sekolah',0,1,'C',true);	
		
		##---------start ttd
		$top_ttd_size = 295;
		if(count($data2) == 17) {
			$top_ttd_size = 295;	
		}
		if(count($data2) == 16) {
			$top_ttd_size = 288;	
		}
		//echo $size;
		##-------ttd wali kelas
		//create QRCode--------------
		/*$ref	= $nip_wali;
		$tempdir = "phpqrcode/qrcode/";
		$url2 = $nama_wali; //$public_url.obraxabrix('press')."/".$ref."/".$machine_id;
		$isi_teks = $url2 . ' ' . "NIP ".$nip_wali; //get_current_url($_SERVER); //inputan fungsi tadi itu cuma $_SERVER aja
		$namafile = $ref;
		$quality = 'H';
		$ukuran = 10;
		$padding = 2;

		QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);
		
		$this->Image('phpqrcode/qrcode/'.$ref, 96, $top_ttd_size, 15, 15, 'png', '');	
		
		//hapus file qrcode
		unlink('phpqrcode/qrcode/' . $ref);*/
		/*$this->Cell(0,3,'',0,0,'L',false);
		$file_type = substr($ttd_file_wali, strlen($ttd_file_wali)-3, 3);
		if($file_type == 'jpg' || $file_type == 'peg') {
			$this->Image('../app/file_ttd/'.$ttd_file_wali, 96, $top_ttd_size, 17, 17, 'jpg', '');	
		}
		if($file_type == 'png') {
			$this->Image('../app/file_ttd/'.$ttd_file_wali, 96, $top_ttd_size, 17, 17, 'png', '');	
		}*/		
		##-----------------/\-------
		
		##-------ttd kepala sekolah		
		//create QRCode--------------
		/*$ref	= $nip_kepsek;
		$tempdir = "phpqrcode/qrcode/";
		$url2 = $nama_kepsek; //$public_url.obraxabrix('press')."/".$ref."/".$machine_id;
		$isi_teks = $url2 . ' ' . "NIP ".$nip_kepsek; //get_current_url($_SERVER); //inputan fungsi tadi itu cuma $_SERVER aja
		$namafile = $ref;
		$quality = 'H';
		$ukuran = 10;
		$padding = 2;

		QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);
		
		$this->Image('phpqrcode/qrcode/'.$ref, 170, $top_ttd_size, 15, 15, 'png', '');	
		//hapus file qrcode
		unlink('phpqrcode/qrcode/' . $ref);*/
		//---------------/\----------

		/*$file_type = "";
		$this->Cell(0,3,'',0,0,'L',false);
		$file_type = substr($ttd_file_kepsek, strlen($ttd_file_kepsek)-3, 3);
		if($file_type == 'jpg' || $file_type == 'peg') {
			$this->Image('../app/file_ttd/'.$ttd_file_kepsek, 170, $top_ttd_size, 17, 17, 'jpg', '');	
		}
		if($file_type == 'png') {
			$this->Image('../app/file_ttd/'.$ttd_file_kepsek, 170, $top_ttd_size, 17, 17, 'png', '');	
		}*/		
		##-----------------/\-------
		$this->Ln(2);
		
		$this->Ln(12);
		
		$size = $size + $sizeadd;
		
		$this->Cell(60,5,'',0,0,'C',true);	
		$this->Cell(70,5,$nama_wali,0,0,'C',true);	
		$this->Cell(70,5,$nama_kepsek,0,1,'C',true);
		
		$this->Cell(60,5,'..................................',0,0,'C',true);	
		$this->Cell(70,5,"NIP ".$nip_wali,0,0,'C',true);	
		$this->Cell(70,5,"NIP ".$nip_kepsek,0,1,'C',true);		
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