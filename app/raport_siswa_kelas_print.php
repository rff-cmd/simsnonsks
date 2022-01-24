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
//$idsiswa	= $_REQUEST["idsiswa"];
$idsemester		= $_REQUEST["semester_id"]; //$_SESSION["semester_id"];
$idkelas		= $_REQUEST["idkelas"];
$idtingkat1		= $_REQUEST["idtingkat"];
$idtahunajaran	= $_REQUEST["idtahunajaran"];

$idkelas_new	= $_REQUEST["idkelas_new"];
$idtingkat_new	= $_REQUEST["idtingkat_new"];

$sqlidentitas = $selectview->list_identitas();
$dataidentitas = $sqlidentitas->fetch(PDO::FETCH_OBJ);

$sqlthnajaran = $selectview->list_tahunajaran($idtahunajaran);
$datatahunajaran = $sqlthnajaran->fetch(PDO::FETCH_OBJ);
$tahun_ajaran 	= $datatahunajaran->tahunajaran;
$nip_kepsek		= $datatahunajaran->info1;
$nama_kepsek	= $datatahunajaran->nama_kepsek;

$sqldesc_predikat_spirit = $selectview->list_deskripsi_raport("", "", "Spritual", "");
$datadesc_predikat_spirit = $sqldesc_predikat_spirit->fetch(PDO::FETCH_OBJ);

$sqldesc_predikat_sosial = $selectview->list_deskripsi_raport("", "", "Sosial", "");
$datadesc_predikat_sosial = $sqldesc_predikat_sosial->fetch(PDO::FETCH_OBJ);

//penilaian sikap
$sikap_spirit_a		=	array();
$sikap_sosial_a		=	array();
$sikap_spirit_abjad	=	array();
$sikap_sosial_abjad	=	array();
	
//var array
//$peminatan 			= 	array();
$minat 				= 	array();
//$idsiswa			=	array();

$nama_sekolah		=	array();
$nama_semester		=	array();
$tanggal_ttd		=	array();
$alamat_sekolah		=	array();
$nama_siswa			=	array();
$nis_siswa			=	array();
$nisn_siswa			=	array();
$sikap_spirit_a		=	array();
$sikap_sosial_a		=	array();
$numeric_semester 	= 	array();
$idkelas1			=	array();

$jumlah_nilai		=	array();
$jumlah_sks			=	array();
$total_p			=	array();
$total_rata			=	array();
$total_rata_beban	=	array();

$data				=	array();
$data2				=	array();
$data3				=	array();

$data_kelompok		=	array();

$nip_wali			= 	array();
$nama_wali			= 	array();
	

$data_kelompok[]	=	"Kelompok A (Umum)";
$data_kelompok[]	=	"Kelompok B (Umum)";
$data_kelompok[]	=	"Kelompok C (Peminatan)";
$data_kelompok[]	=	"Kelompok C (Pilihan Lintas Peminatan)";
		
$sqlsiswa = $selectview->list_siswa2("", "", $idtingkat, $idkelas, "0", 1);
while($datasiswa = $sqlsiswa->fetch(PDO::FETCH_OBJ)) {
	
	$idsiswa = $datasiswa->replid;
	$idkelas = $idkelas_new; //$datasiswa->idkelas;
	
	$idminat = $datasiswa->idminat;
	if($idminat == "") {
		if( substr($datasiswa->kelas,0,3)=="MIP" ) {
			$idminat = 1;
		}
		if( substr($datasiswa->kelas,0,3)=="IPS" ) {
			$idminat = 2;
		}
	}
	
	if($idminat == 1) {
		$minat[] = "Matematika dan Ilmu Pengetahuan Alam";
		
		$peminatan = "MIPA";
	}
	if($idminat == 2) {
		$minat[] = "Ilmu-ilmu Sosial";
		
		$peminatan = "IPS";
	}

	$sqlsemester = $selectview->list_semester($idsemester);
	$datasemester = $sqlsemester->fetch(PDO::FETCH_OBJ);
	
	//$sqlperiode_raport = $selectview->list_setup_periode_raport($idtahunajaran, $idsemester, $datasiswa->idtingkat);
	$sqlperiode_raport = $selectview->list_setup_periode_raport($idtahunajaran, $idsemester, $idtingkat_new);
	$periode_raport = $sqlperiode_raport->fetch(PDO::FETCH_OBJ);
	/*------------------------------------------*/

	/*---------print header-----------*/
	$nama_sekolah[]		=	$dataidentitas->nama;
	$nama_semester[]	=	$datasemester->semester;
	$tanggal_ttd[]		=	$periode_raport->tanggal_ttd; //$datasemester->tanggal_ttd;
	$alamat_sekolah[]	=	$dataidentitas->alamat1;
	$nama_siswa[]		=	$datasiswa->nama;
	$nis_siswa[]		=	$datasiswa->nis;
	$nisn_siswa[]		=	$datasiswa->nisn;
	/*$sikap_spirit_a[]	=	$datadesc_predikat_spirit->sikap_a;
	$sikap_sosial_a[]	=	$datadesc_predikat_sosial->sikap_a;*/
	$idtingkat			= 	$idtingkat_new; //$datasiswa->idtingkat;
	
	$numeric_semester1 	= 	numeric_semester($idtingkat, $idsemester);
	$numeric_semester[] = 	$numeric_semester1;
	
	$sikap_angkax		=	0;
	$sikap_angka2x		=	0;
	/*-------------------------------*/

	/*---------print detail----------*/
	$total_p1			=	0;
	$total_k1			=	0;
	$total_rata1		=	0;
	$total_rata_beban1	=	0;
	$jumlah_sks1		=	0;
		
	$no = 0;
	##START GET NILAI
	
	//"Kelompok A (Umum)";
	$sikap_spirit_abjad__ = "";
	$no_urut_mapel = 0;
	$sql = $selectview->list_daftarnilai_raport("SMA", $idtingkat, $idkelas, $idsemester, $idsiswa, 1, $peminatan, $idtahunajaran);
	while($row_pelajaran_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
		
		$no_urut_mapel++;
		
		//penilaian sikap
		if($row_pelajaran_detail->sikap == "") { $sikap_angkax = 3; }
		if($row_pelajaran_detail->sikap == "A") { $sikap_angkax = 3; }
		if($row_pelajaran_detail->sikap == "B") { $sikap_angkax = 2; }
		if($row_pelajaran_detail->sikap == "C") { $sikap_angkax = 1; }
		
		if($sikap_angka2x < $sikap_angkax) { $sikap_angka2x = $sikap_angkax; }
		
		if($sikap_spirit_abjad__ == "") {
			if($sikap_angka2x == 3) {
				$sikap_spirit_a[]	=	$datadesc_predikat_spirit->sikap_a."|".$datasiswa->nis;
				$sikap_sosial_a[]	=	$datadesc_predikat_sosial->sikap_a."|".$datasiswa->nis;
				
				$sikap_spirit_abjad[] = "A"."|".$datasiswa->nis;
				$sikap_sosial_abjad[] = "A"."|".$datasiswa->nis;
				
				$sikap_spirit_abjad__ = "A";
			}
			if($sikap_angka2x == 2) {
				$sikap_spirit_a[]	=	$datadesc_predikat_spirit->sikap_b."|".$datasiswa->nis;
				$sikap_sosial_a[]	=	$datadesc_predikat_sosial->sikap_b."|".$datasiswa->nis;
				
				$sikap_spirit_abjad[] = "B"."|".$datasiswa->nis;
				$sikap_sosial_abjad[] = "B"."|".$datasiswa->nis;
				
				$sikap_spirit_abjad__ = "B";
			}
			if($sikap_angka2x == 1) {
				$sikap_spirit_a[]	=	$datadesc_predikat_spirit->sikap_c."|".$datasiswa->nis;
				$sikap_sosial_a[]	=	$datadesc_predikat_sosial->sikap_c."|".$datasiswa->nis;
				
				$sikap_spirit_abjad[] = "C"."|".$datasiswa->nis;
				$sikap_sosial_abjad[] = "C"."|".$datasiswa->nis;
				
				$sikap_spirit_abjad__ = "C";
			}
		}
		//----------/\------------------------
		
		
		$idkelas1[]	=	$row_pelajaran_detail->idkelas;			
		$jumlah_sks1 	= $jumlah_sks1 + $row_pelajaran_detail->sks;
		//$jumlah_sks[]	= $jumlah_sks1;
		
		//pengetahuan
		$nilai_p = 0;
		$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 3);
		$data_nilai_p	= $sqlnilai->fetch(PDO::FETCH_OBJ);
		$nilai_p		= $data_nilai_p->uas;
		
		$jumlah_nilai1 = 0;
		$jumlah_nilai1	= $jumlah_nilai1 + $data_nilai_p->jumlah;
		
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
			$total_p1		= $total_p1 + numberreplace($nilai_raport);
		} else {
			$nilai_p		= 0;
			$nilai_raport	= number_format($nilai_detail_non_uas_p,0,'.',',');				
			$total_p1		= $total_p1 + $nilai_raport;
		}
		
		
		//-------/\--------
		
		//FORMULA KETERAMPILAN DIRUBAH LAGI SEPERTI PENGETAHUAN (2019-05-27)
		
		//keterampilan
		$nilai_k = 0;
		$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 4);
		$data_nilai_k	= $sqlnilai->fetch(PDO::FETCH_OBJ);
		$nilai_k		= $data_nilai_k->uas;
		
		$jumlah_nilai1	= $jumlah_nilai1 + $data_nilai_k->jumlah;
		$jumlah_nilai[]	= $jumlah_nilai1;
		
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
			
			/*if($nilai_tertinggi <  $datanilai_detail->nilai) {
				$nilai_tertinggi = $datanilai_detail->nilai;
			}*/
		}
		
		if($jumlah_ukbm_upd > 0) {
			/*if($nilai_k == "") {
				$nilai_detail_k = ( ($nilai_detail_k/$jumlah_ukbm_upd)*75)/100;	 //$nilai_tertinggi; //
				$nilai_detail_non_uas_k = $nilai_detail_non_uas_k/$jumlah_ukbm_upd; //$nilai_tertinggi; //
			} else {*/
				$nilai_detail_k = ( ($nilai_detail_k/$jumlah_ukbm_upd)*75)/100;	
				$nilai_detail_non_uas_k = $nilai_detail_non_uas_k/$jumlah_ukbm_upd;
			//}
		} else {
			$nilai_detail_k = 0;
			$nilai_detail_non_uas_k = 0;
		}
		
		if($nilai_k != "") {
			$nilai_k		= ($nilai_k*25)/100;
			$nilai_raport_k	= number_format($nilai_detail_k + $nilai_k,0,'.',',');
			$total_k1		= $total_k1 + numberreplace($nilai_raport_k);
		} else {
			$nilai_k		= 0;
			$nilai_raport_k	= number_format($nilai_detail_non_uas_k,0,'.',',');				
			$total_k1		= $total_k1 + $nilai_raport_k;
		}
		
		//$rata2 	= 	(($nilai_detail_p + $nilai_p) + ($nilai_detail_k + $nilai_k))/2;
		$rata2 	= 	( numberreplace($nilai_raport) + numberreplace($nilai_raport_k))/2;
		$rata2_beban = number_format($rata2 * $row_pelajaran_detail->sks,0,'.',',');
		$rata2	=	number_format($rata2,0,'.',',');
		$total_rata1 = $total_rata1 + numberreplace($rata2);
		//$total_rata[] = $total_rata1;		
		$total_rata_beban1 = $total_rata_beban1 + numberreplace($rata2_beban);
		//$total_rata_beban[] = $total_rata_beban1;
		
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
		}
		
		$kode_pelajaran		=	"MPW".($idminat + 1); //."0".$no_urut_mapel.$numeric_semester1; //$row_pelajaran_detail->kode_pelajaran;
		$nama_pelajaran		=	$nama_pelajaran . " " . $numeric_semester1;
		$kkm				=	$row_pelajaran_detail->kkm;
		$kkm_terampil		=	$row_pelajaran_detail->kkm_terampil;
		$sks				=	$row_pelajaran_detail->sks;
		
		$data[]=$kode_pelajaran.';'.$nama_pelajaran.';'.$kkm.';'.$kkm_terampil.';'.$sks.';'.$nilai_raport.';'.$predikat_p.';'.$nilai_raport_k.';'.$predikat_k.';'.$rata2.';'.$rata2_beban;
		
		$data2[]='Kelompok A (Umum)'.'|'.$kode_pelajaran.'|'.$nama_pelajaran.'|'.$kkm.'|'.$kkm_terampil.'|'.$sks.'|'.$nilai_raport.'|'.$predikat_p.'|'.$nilai_raport_k.'|'.$predikat_k.'|'.$rata2.'|'.$rata2_beban.'|'.$jumlah_nilai1.'|'.$datasiswa->nis;
		
	}
	
	
	//"Kelompok B (Umum)";
	$no_urut_mapel = 0;
	$sql = $selectview->list_daftarnilai_raport("SMA", $idtingkat, $idkelas, $idsemester, $idsiswa, 2, $peminatan, $idtahunajaran);
	while($row_pelajaran_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
		
		$no_urut_mapel++;
		
		$idkelas1[]	=	$row_pelajaran_detail->idkelas;
			
		$jumlah_sks1 	= $jumlah_sks1 + $row_pelajaran_detail->sks;
		//$jumlah_sks[]	= $jumlah_sks1;
		
		//pengetahuan
		$nilai_p = 0;
		$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 3);
		$data_nilai_p	= $sqlnilai->fetch(PDO::FETCH_OBJ);
		$nilai_p		= $data_nilai_p->uas;
		
		$jumlah_nilai1 = 0;
		$jumlah_nilai1	= $jumlah_nilai1 + $data_nilai_p->jumlah;
		
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
			$total_p1		= $total_p1 + numberreplace($nilai_raport);
		} else {
			$nilai_p		= 0;
			$nilai_raport	= number_format($nilai_detail_non_uas_p,0,'.',',');				
			$total_p1		= $total_p1 + $nilai_raport;
		}
		//$total_p[] = $total_p1;
		
		//-------/\--------
		
		//keterampilan
		$nilai_k = 0;
		$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 4);
		$data_nilai_k	= $sqlnilai->fetch(PDO::FETCH_OBJ);
		$nilai_k		= $data_nilai_k->uas;
		
		$jumlah_nilai1	= $jumlah_nilai1 + $data_nilai_k->jumlah;
		$jumlah_nilai[]	= $jumlah_nilai1;
		
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
			
			/*if($nilai_tertinggi <  $datanilai_detail->nilai) {
				$nilai_tertinggi = $datanilai_detail->nilai;
			}*/
			
		}
		
		if($jumlah_ukbm_upd > 0) {
			/*if($nilai_k == "") {
				$nilai_detail_k = $nilai_tertinggi; //( ($nilai_detail_k/$jumlah_ukbm_upd)*75)/100;	
				$nilai_detail_non_uas_k = $nilai_tertinggi; //$nilai_detail_non_uas_k/$jumlah_ukbm_upd;
			} else {*/
				$nilai_detail_k = ( ($nilai_detail_k/$jumlah_ukbm_upd)*75)/100;	
				$nilai_detail_non_uas_k = $nilai_detail_non_uas_k/$jumlah_ukbm_upd;
			//}
		} else {
			$nilai_detail_k = 0;
			$nilai_detail_non_uas_k = 0;
		}
		
		if($nilai_k != "") {
			$nilai_k		= ($nilai_k*25)/100;
			$nilai_raport_k	= number_format($nilai_detail_k + $nilai_k,0,'.',',');
			$total_k1		= $total_k1 + numberreplace($nilai_raport_k);
		} else {
			$nilai_k		= 0;
			$nilai_raport_k	= number_format($nilai_detail_non_uas_k,0,'.',',');				
			$total_k1		= $total_k1 + $nilai_raport_k;
		}
		//$total_k[] = $total_k1;
		
		//$rata2 	= 	(($nilai_detail_p + $nilai_p) + ($nilai_detail_k + $nilai_k))/2;
		$rata2 	= 	( numberreplace($nilai_raport) + numberreplace($nilai_raport_k))/2;
		$rata2_beban = number_format($rata2 * $row_pelajaran_detail->sks,0,'.',',');
		$rata2	=	number_format($rata2,0,'.',',');
		$total_rata1 = $total_rata1 + numberreplace($rata2);
		//$total_rata[] = $total_rata1;
		
		$total_rata_beban1 = $total_rata_beban1 + numberreplace($rata2_beban);
		//$total_rata_beban[] = $total_rata_beban1;
		
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
		}
		
		$kode_pelajaran		=	"MPW".($idminat + 1); //."0".$no_urut_mapel.$numeric_semester1; //$row_pelajaran_detail->kode_pelajaran;
		$nama_pelajaran		=	$nama_pelajaran . " " . $numeric_semester1;
		$kkm				=	$row_pelajaran_detail->kkm;
		$kkm_terampil		=	$row_pelajaran_detail->kkm_terampil;
		$sks				=	$row_pelajaran_detail->sks;
		
		$data[]=$kode_pelajaran.';'.$nama_pelajaran.';'.$kkm.';'.$kkm_terampil.';'.$sks.';'.$nilai_raport.';'.$predikat_p.';'.$nilai_raport_k.';'.$predikat_k.';'.$rata2.';'.$rata2_beban;
		
		$data2[]='Kelompok B (Umum)'.'|'.$kode_pelajaran.'|'.$nama_pelajaran.'|'.$kkm.'|'.$kkm_terampil.'|'.$sks.'|'.$nilai_raport.'|'.$predikat_p.'|'.$nilai_raport_k.'|'.$predikat_k.'|'.$rata2.'|'.$rata2_beban.'|'.$jumlah_nilai1.'|'.$datasiswa->nis;
		
	}
	
	
	//"Kelompok C (Peminatan)";
	$idpelajaran_check = "";
	$no_urut_mapel = 0;
	$sql = $selectview->list_daftarnilai_raport("SMA", $idtingkat, $idkelas, $idsemester, $idsiswa, 3, $peminatan, $idtahunajaran);
	while($row_pelajaran_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
		
		if (preg_match("/64/",$idpelajaran_check) == 0) {
			
			$idpelajaran_check = $idpelajaran_check . "," . $row_pelajaran_detail->pelajaran_id;
			
			$no_urut_mapel++;
			
			$idkelas1[]	=	$row_pelajaran_detail->idkelas;
				
			$jumlah_sks1 	= $jumlah_sks1 + $row_pelajaran_detail->sks;
			//$jumlah_sks[]	= $jumlah_sks1;
			
			//pengetahuan
			$nilai_p = 0;
			$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 3);
			$data_nilai_p	= $sqlnilai->fetch(PDO::FETCH_OBJ);
			$nilai_p		= $data_nilai_p->uas;
			
			$jumlah_nilai1 = 0;
			$jumlah_nilai1	= $jumlah_nilai1 + $data_nilai_p->jumlah;
			
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
				$total_p1		= $total_p1 + numberreplace($nilai_raport);
			} else {
				$nilai_p		= 0;
				$nilai_raport	= number_format($nilai_detail_non_uas_p,0,'.',',');				
				$total_p1		= $total_p1 + $nilai_raport;
			}
			//$total_p[] = $total_p1;
			
			//-------/\--------
			
			//keterampilan
			$nilai_k = 0;
			$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 4);
			$data_nilai_k	= $sqlnilai->fetch(PDO::FETCH_OBJ);
			$nilai_k		= $data_nilai_k->uas;
			
			$jumlah_nilai1	= $jumlah_nilai1 + $data_nilai_k->jumlah;
			$jumlah_nilai[]	= $jumlah_nilai1;
			
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
				
				/*if($nilai_tertinggi <  $datanilai_detail->nilai) {
					$nilai_tertinggi = $datanilai_detail->nilai;
				}*/
				
			}
			
			if($jumlah_ukbm_upd > 0) {
				/*if($nilai_k == "") {
					$nilai_detail_k = $nilai_tertinggi; //( ($nilai_detail_k/$jumlah_ukbm_upd)*75)/100;	
					$nilai_detail_non_uas_k = $nilai_tertinggi; //$nilai_detail_non_uas_k/$jumlah_ukbm_upd;
				} else {*/
					$nilai_detail_k = ( ($nilai_detail_k/$jumlah_ukbm_upd)*75)/100;	
					$nilai_detail_non_uas_k = $nilai_detail_non_uas_k/$jumlah_ukbm_upd;
				//}
			} else {
				$nilai_detail_k = 0;
				$nilai_detail_non_uas_k = 0;
			}
			
			if($nilai_k != "") {
				$nilai_k		= ($nilai_k*25)/100;
				$nilai_raport_k	= number_format($nilai_detail_k + $nilai_k,0,'.',',');
				$total_k1		= $total_k1 + numberreplace($nilai_raport_k);
			} else {
				$nilai_k		= 0;
				$nilai_raport_k	= number_format($nilai_detail_non_uas_k,0,'.',',');				
				$total_k1		= $total_k1 + $nilai_raport_k;
			}
			//$total_k[] = $total_k1;
			
			//$rata2 	= 	(($nilai_detail_p + $nilai_p) + ($nilai_detail_k + $nilai_k))/2;
			$rata2 	= 	( numberreplace($nilai_raport) + numberreplace($nilai_raport_k))/2;
			$rata2_beban = number_format($rata2 * $row_pelajaran_detail->sks,0,'.',',');
			$rata2	=	number_format($rata2,0,'.',',');
			$total_rata1 = $total_rata1 + numberreplace($rata2);
			//$total_rata[] = $total_rata1;
			
			$total_rata_beban1 = $total_rata_beban1 + numberreplace($rata2_beban);
			//$total_rata_beban[] = $total_rata_beban1;
			
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
			}
			
			$kode_pelajaran		=	"MPM".($idminat + 1); //."0".$no_urut_mapel.$numeric_semester1; //$row_pelajaran_detail->kode_pelajaran;
			$nama_pelajaran		=	$nama_pelajaran . " " . $numeric_semester1;
			$kkm				=	$row_pelajaran_detail->kkm;
			$kkm_terampil		=	$row_pelajaran_detail->kkm_terampil;
			$sks				=	$row_pelajaran_detail->sks;
			
			$data[]=$kode_pelajaran.';'.$nama_pelajaran.';'.$kkm.';'.$kkm_terampil.';'.$sks.';'.$nilai_raport.';'.$predikat_p.';'.$nilai_raport_k.';'.$predikat_k.';'.$rata2.';'.$rata2_beban;
			
			$data2[]='Kelompok C (Peminatan)'.'|'.$kode_pelajaran.'|'.$nama_pelajaran.'|'.$kkm.'|'.$kkm_terampil.'|'.$sks.'|'.$nilai_raport.'|'.$predikat_p.'|'.$nilai_raport_k.'|'.$predikat_k.'|'.$rata2.'|'.$rata2_beban.'|'.$jumlah_nilai1.'|'.$datasiswa->nis;
			
		}
					
	}
	
	
	//"Kelompok C (Pilihan Lintas Peminatan)";
	$no_urut_mapel = 0;
	$sql = $selectview->list_daftarnilai_raport_lintas_minat("SMA", $idtingkat, $idkelas, $idsemester, $idsiswa, 4, $peminatan, $idtahunajaran);
	while($row_pelajaran_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
		
		$no_urut_mapel++;
		
		$idkelas1[]	=	$row_pelajaran_detail->idkelas;
			
		$jumlah_sks1 	= $jumlah_sks1 + $row_pelajaran_detail->sks;
		//$jumlah_sks[]	= $jumlah_sks1;
		
		//pengetahuan
		$nilai_p = 0;
		$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 3);
		$data_nilai_p	= $sqlnilai->fetch(PDO::FETCH_OBJ);
		$nilai_p		= $data_nilai_p->uas;
		
		$jumlah_nilai1 = 0;
		$jumlah_nilai1	= $jumlah_nilai1 + $data_nilai_p->jumlah;
		
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
			$total_p1		= $total_p1 + numberreplace($nilai_raport);
		} else {
			$nilai_p		= 0;
			$nilai_raport	= number_format($nilai_detail_non_uas_p,0,'.',',');				
			$total_p1		= $total_p1 + $nilai_raport;
		}
		//$total_p[] = $total_p1;
		
		//-------/\--------
		
		//keterampilan
		$nilai_k = 0;
		$sqlnilai 	= $selectview->list_daftarnilai2($row_pelajaran_detail->idsiswa, $row_pelajaran_detail->idtingkat, $row_pelajaran_detail->idkelas, "", $row_pelajaran_detail->semester_id, $row_pelajaran_detail->pelajaran_id, 4);
		$data_nilai_k	= $sqlnilai->fetch(PDO::FETCH_OBJ);
		$nilai_k		= $data_nilai_k->uas;
		
		$jumlah_nilai1	= $jumlah_nilai1 + $data_nilai_k->jumlah;
		$jumlah_nilai[]	= $jumlah_nilai1;
		
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
			
			/*if($nilai_tertinggi <  $datanilai_detail->nilai) {
				$nilai_tertinggi = $datanilai_detail->nilai;
			}*/
			
		}
		
		if($jumlah_ukbm_upd > 0) {
			/*if($nilai_k == "") {
				$nilai_detail_k = $nilai_tertinggi; //( ($nilai_detail_k/$jumlah_ukbm_upd)*75)/100;	
				$nilai_detail_non_uas_k = $nilai_tertinggi; //$nilai_detail_non_uas_k/$jumlah_ukbm_upd;
			} else {*/
				$nilai_detail_k = ( ($nilai_detail_k/$jumlah_ukbm_upd)*75)/100;	
				$nilai_detail_non_uas_k = $nilai_detail_non_uas_k/$jumlah_ukbm_upd;
			//}
		} else {
			$nilai_detail_k = 0;
			$nilai_detail_non_uas_k = 0;
		}
		
		if($nilai_k != "") {
			$nilai_k		= ($nilai_k*25)/100;
			$nilai_raport_k	= number_format($nilai_detail_k + $nilai_k,0,'.',',');
			$total_k1		= $total_k1 + numberreplace($nilai_raport_k);
		} else {
			$nilai_k		= 0;
			$nilai_raport_k	= number_format($nilai_detail_non_uas_k,0,'.',',');				
			$total_k1		= $total_k1 + $nilai_raport_k;
		}
		//$total_k[] = $total_k1;
		
		//$rata2 	= 	(($nilai_detail_p + $nilai_p) + ($nilai_detail_k + $nilai_k))/2;
		$rata2 	= 	( numberreplace($nilai_raport) + numberreplace($nilai_raport_k))/2;
		$rata2_beban = number_format($rata2 * $row_pelajaran_detail->sks,0,'.',',');
		$rata2	=	number_format($rata2,0,'.',',');
		$total_rata1 = $total_rata1 + numberreplace($rata2);
		//$total_rata[] = $total_rata1;
		
		$total_rata_beban1 = $total_rata_beban1 + numberreplace($rata2_beban);
		//$total_rata_beban[] = $total_rata_beban1;
		
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
		}
		
		$kode_pelajaran		=	"MPP".($idminat + 1); //."0".$no_urut_mapel.$numeric_semester1; //$row_pelajaran_detail->kode_pelajaran;
		$nama_pelajaran		=	$nama_pelajaran . " " . $numeric_semester1;
		$kkm				=	$row_pelajaran_detail->kkm;
		$kkm_terampil		=	$row_pelajaran_detail->kkm_terampil;
		$sks				=	$row_pelajaran_detail->sks;
		
		$data[]=$kode_pelajaran.';'.$nama_pelajaran.';'.$kkm.';'.$kkm_terampil.';'.$sks.';'.$nilai_raport.';'.$predikat_p.';'.$nilai_raport_k.';'.$predikat_k.';'.$rata2.';'.$rata2_beban;
		
		$data2[]='Kelompok C (Pilihan Lintas Peminatan)'.'|'.$kode_pelajaran.'|'.$nama_pelajaran.'|'.$kkm.'|'.$kkm_terampil.'|'.$sks.'|'.$nilai_raport.'|'.$predikat_p.'|'.$nilai_raport_k.'|'.$predikat_k.'|'.$rata2.'|'.$rata2_beban.'|'.$jumlah_nilai1.'|'.$datasiswa->nis;
					
	}
	
	$total_p[] 			= $total_p1;
	$total_k[] 			= $total_k1;
	$total_rata[] 		= $total_rata1;
	$total_rata_beban[] = $total_rata_beban1;
	$jumlah_sks[]		= $jumlah_sks1;
	
	if($jumlah_sks1 == 0) {
		$ip_semester = number_format(0,0,'.',',');
	} else {
		$ip_semester = number_format($total_rata_beban1/$jumlah_sks1,0,'.',',');
	}
											
	//$sql_wali 	= $selectview->list_kelas($idkelas, "");
	$sql_wali 	= $selectview->list_kelas_detail($idkelas, $idtahunajaran); //$idkelas1
	$data_wali	= $sql_wali->fetch(PDO::FETCH_OBJ);
	$nip_wali[]	= $data_wali->nip_wali;
	$nama_wali[]= $data_wali->walikelas;
	/*-------------------------------------------*/
	
	$no++;
}				

/*-----------footer-------------*/
/*$sql_peg = $selectview->list_pegawai('', '196106231981012002', '', '');
$data_peg = $sql_peg->fetch(PDO::FETCH_OBJ);
$nip_kepsek 	= $data_peg->nip;
$nama_kepsek	= $data_peg->nama;*/
/*------------------------------*/

require('pdf/fpdf2.php');
	  	
class PDF extends FPDF
{
	
	var $col=0;
	//Ordinate of column start
	var $y0;
	
	function Header()
	{
		
		
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
		
		for($i=0; $i<count($nis_siswa); $i++) {		
			
			$total_rows = 250;
			
			$this->SetFont('Arial','',11);
			$this->SetFillColor(255,255,255);
			$this->SetTextColor(0,0,0);
			
			$this->Ln(2);
			
			$this->SetFont('Arial','',10);
			$this->Cell(35,3,'Nama Sekolah',0,0,'L',true);
			$this->Cell(2,3,':',0,0,'L',false);
			$this->Cell(70,3,$nama_sekolah[$i],0,0,'L',false);
			$total_rows = $total_rows - 1; //for seting rows
			
			$this->SetFont('Arial','',10);
			$this->Cell(25,3,'Semester',0,0,'L',true);
			$this->Cell(2,3,':',0,0,'L',false);
			$this->Cell(80,3,$numeric_semester[$i] . "-" .$tahun_ajaran,0,1,'L',false); //$_SESSION["tahunajaran"]
			$this->Ln(2);
			$total_rows = $total_rows - 1; //for seting rows
			
			$this->SetFont('Arial','',10);
			$this->Cell(35,3,'Alamat',0,0,'L',true);
			$this->Cell(2,3,':',0,0,'L',false);
			$this->Cell(70,3,$alamat_sekolah[$i],0,0,'L',false);
			$total_rows = $total_rows - 1; //for seting rows
			
			$this->SetFont('Arial','',10);
			$this->Cell(25,3,'Peminatan',0,0,'L',true);
			$this->Cell(2,3,':',0,0,'L',false);
			$this->Cell(70,3,$minat[$i],0,1,'L',false);
			$this->Ln(2);
			$total_rows = $total_rows - 1; //for seting rows
			
			$this->SetFont('Arial','',10);
			$this->Cell(35,3,'Nama Peserta Didik',0,0,'L',true);
			$this->Cell(2,3,':',0,0,'L',false);
			$this->Cell(80,3,$nama_siswa[$i],0,1,'L',false);
			$this->Ln(2);
			$total_rows = $total_rows - 1; //for seting rows
			
			$this->SetFont('Arial','',10);
			$this->Cell(35,3,'Nomor Induk / NISN',0,0,'L',true);
			$this->Cell(2,3,':',0,0,'L',false);
			$this->Cell(80,3,$nis_siswa[$i]." / ". $nisn_siswa[$i] ,0,1,'L',false);
			$this->Ln(2);
			$total_rows = $total_rows - 1; //for seting rows
			
			//Save ordinate
			$this->y0=$this->GetY();
			
			
			//-----------DETAIL-1--------------
			global $sikap_spirit_a;
			global $sikap_sosial_a;
			global $sikap_spirit_abjad;
			global $sikap_sosial_abjad;
			
			$exdata_spirit_desc	= "";
			$exdata_sosial_desc	= "";
			$sikap_spirit 	= "";
			$sikap_sosial	= "";
			for($t=0; $t<count($sikap_spirit_abjad); $t++) {
				$exdata_sikap = explode('|', $sikap_spirit_abjad[$t]);
				$exdata_sikap_desc = explode('|', $sikap_spirit_a[$t]);
					
				if( $exdata_sikap[1] == $nis_siswa[$i] ) {
					$sikap_spirit = $exdata_sikap[0];
					$exdata_spirit_desc = $exdata_sikap_desc[0];
				}
			}
			
			for($t=0; $t<count($sikap_sosial_abjad); $t++) {
				$exdata_sikap = explode('|', $sikap_sosial_abjad[$t]);
				$exdata_sikap_desc = explode('|', $sikap_sosial_a[$t]);
					
				if( $exdata_sikap[1] == $nis_siswa[$i] ) {
					$sikap_sosial = $exdata_sikap[0];
					$exdata_sosial_desc = $exdata_sikap_desc[0];
				}
			}
			//--------------/\--------------
			
			$this->SetFont('Arial','B',9);
			$this->SetFillColor(255,255,255);
			$this->SetTextColor(0,0,0);
			
			$this->Ln(2);		
					
			$this->Cell(15,7,"A. Sikap",0,1,"C");
			$total_rows = $total_rows - 1; //for seting rows
			
			$this->Cell(15,7,"",0,0,"C");
			$this->Cell(35,7,"1. Sikap Spiritual",0,0,"C");
			$this->Cell(15,7,"Predikat",1,0,"C");
			$this->Cell(137,7,"Deskripsi",1,1,"C");
			$total_rows = $total_rows - 1; //for seting rows
			 
			$this->Cell(15,7,"",0,0,"C");
			$this->Cell(35,7,"",0,0,"C");
			$this->Cell(15,10,$sikap_spirit,1,0,"C");
			$this->MultiCell(137,5,$exdata_spirit_desc,1,1,"L");
			$total_rows = $total_rows - 1; //for seting rows
			
			$this->Cell(15,7,"",0,1,"C");
			$total_rows = $total_rows - 1; //for seting rows
			
			$this->Cell(15,7,"",0,0,"C");
			$this->Cell(35,7,"2. Sikap Sosial",0,0,"C");
			$this->Cell(15,7,"Predikat",1,0,"C");
			$this->Cell(137,7,"Deskripsi",1,1,"C");
			$total_rows = $total_rows - 1; //for seting rows
			
			$this->Cell(15,7,"",0,0,"C");
			$this->Cell(35,7,"",0,0,"C");
			$this->Cell(15,15,$sikap_sosial,1,0,"C");
			$this->MultiCell(137,5,$exdata_sosial_desc,1,1,"L");
			$this->Ln(2);
			$total_rows = $total_rows - 1; //for seting rows
			
			$this->Cell(15,7,"B. Pengetahuan dan Keterampilan",0,1,"L");		
			$this->Ln(2);
			$total_rows = $total_rows - 1; //for seting rows
			
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
			$total_rows = $total_rows - 1; //for seting rows
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
			$total_rows = $total_rows - 1; //for seting rows
			
			//-----------DETAIL NILAI---------
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
			$this->Cell(22,7,"",0,0,"C");
			$this->Ln();
			$total_rows = $total_rows - 1; //for seting rows
			
			//Data	
			global $data_kelompok;
			global $data_deposit;
			global $data2;
			global $data3;
			global $total_dp;
			global $g_total;
			global $inv_amount;
			global $deposit_d;
			global $total_qty_po;
			global $sub_total_invoice;
			global $total_qty;
			global $sx_total;
			global $jumlah_nilai;
			
			$total_p = 0;
			$total_k = 0;
			$total_rata = 0;
			$total_rata_beban = 0;
			$jumlah_sks = 0;
			
			/*$total_p = 0;
			$total_k = 0;*/
			for($z=0; $z<count($data_kelompok); $z++) {
				
				$this->SetFont('Arial','B',8);
				$this->Cell(202,7,$data_kelompok[$z],1,1,"L");
				
				$this->SetFont('Arial','',8);
				
				$s_total = 0;
				$k = 0;
				for($s=0; $s<count($data2); $s++) {
					$exdata = explode('|', $data2[$s]);
					
					if( ($exdata[0] == $data_kelompok[$z]) && ($exdata[13] == $nis_siswa[$i]) ) {
						
						if($exdata[12] > 0) {
							$k++;
							
							$rata2_beban= 0;
							$rata2_beban = $exdata[5] * $exdata[10];
						
							$this->Cell(15,7,$exdata[1]."0".$k.$numeric_semester[$i],1,0,"C"); //kode
							$this->Cell(65,7,$exdata[2],1,0,"L"); //nama
							$this->Cell(10,7,$exdata[3],1,0,"C"); //P
							$this->Cell(10,7,$exdata[4],1,0,"C"); //K
							$this->Cell(15,7,$exdata[5],1,0,"C"); //sks
							//$this->Cell(13,7,$exdata[6],1,0,"C"); //angka(P)
							if($exdata[6] < $exdata[3]) {
								$this->SetTextColor(255,0,0);
								$this->Cell(13,7,$exdata[6],1,0,"C"); //angka(P)
								$this->SetTextColor(0,0,0);
							} else {
								$this->Cell(13,7,$exdata[6],1,0,"C"); //angka(P)
							}
							$this->Cell(13,7,$exdata[7],1,0,"C"); //predikat(P)
							//$this->Cell(13,7,$exdata[8],1,0,"C"); //angka(K)
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
							
							$total_rows = $total_rows - 1; //for seting rows
							$jumlah_sks = $jumlah_sks + $exdata[5];
						}
					}
				}				
			} //end detail
			
			
			//----------FOOTER
			$size = $size + $sizeadd;
			
			global $nip_kepsek;
			global $nama_kepsek;
			global $nip_wali;
			global $nama_wali;
			
			//global $total_p;
			//global $total_k;
			//global $total_rata;
			//global $total_rata_beban;
			$ip_semester = 0;
			global $tanggal_ttd;
			
			$this->Ln(2);
			$total_rows = $total_rows - 1; //for seting rows
			
			$size = $size + $sizeadd;
			
			//---------
			$this->SetFont('Arial','',9);
			
			//$total_rata = 0;
			//$total_rata = number_format(($total_p + $total_k)/2,3,'.',',');
			$this->Cell(100,7,'Jumlah',1,0,'C',true);
			$this->Cell(15,7,$jumlah_sks,1,0,'C',true);
			$this->Cell(13,7,$total_p,1,0,'C',true);
			$this->Cell(13,7,'',1,0,'C',true);
			$this->Cell(13,7,$total_k,1,0,'C',true);
			$this->Cell(13,7,'',1,0,'C',true);
			$this->Cell(13,7,$total_rata,1,0,'C',true);
			$this->Cell(22,7,$total_rata_beban,1,0,'C',true); //[$i]
			$this->Ln(10);
			$total_rows = $total_rows - 10; //for seting rows
			
			if($jumlah_sks == 0) {
				$ip_semester = number_format(0,0,'.',',');
			} else {
				$ip_semester = number_format($total_rata_beban/$jumlah_sks,0,'.',','); //[$i]
			}
			
			$this->Cell(80,7,'IP Semester ((Rata2 Nilai x Beban)/Jml. Beban)',1,0,'C',true);
			$this->Cell(10,7,$ip_semester,1,0,'C',true);
			$this->Cell(10,7,'',0,0,'C',true);
			$this->Cell(13,7,'KKM',1,0,'C',true);
			$this->Cell(88,7,'Range Predikat',1,1,'C',true);
			$total_rows = $total_rows - 1; //for seting rows
			
			$this->Cell(100,7,'',0,0,'C',true);
			$this->Cell(13,11,'',1,0,'C',true);
			$this->Cell(22,7,'D=Kurang',1,0,'C',true);
			$this->Cell(22,7,'C=Cukup',1,0,'C',true);
			$this->Cell(22,7,'B=Baik',1,0,'C',true);
			$this->Cell(22,7,'A=Sangat Baik',1,1,'C',true);
			$total_rows = $total_rows - 1; //for seting rows
			
			$this->Cell(90,7,'',0,0,'L',true);
			$this->Cell(10,7,'',0,0,'L',true);
			$this->Cell(13,7,'75',1,0,'C',true);//75
			$this->Cell(22,7,'< 75',1,0,'C',true);
			$this->Cell(22,7,'75 s.d 82',1,0,'C',true);
			$this->Cell(22,7,'83 s.d 90',1,0,'C',true);
			$this->Cell(22,7,'91 s.d 100',1,1,'C',true);
			$this->Ln(7);
			$total_rows = $total_rows - 7; //for seting rows
			
			$this->SetFont('Arial','',10);
			
			$tgl 	= date("d-m-Y", strtotime($tanggal_ttd[$i])); //date("Y-m-d"); //14-12-2018";
			$tnggal	= tglindonesia($tgl, $hasil);
			
			$this->Cell(59,5,'Mengetahui,',0,0,'C',true);
			$this->Cell(128,5,'Bandung, '.$tnggal,0,1,'R',true);
			$this->Cell(60,5,'Orang Tua/Wali',0,0,'C',true);
			
			$this->Cell(70,5,'Pembimbing Akademik',0,0,'C',true);
			
			$this->Cell(70,5,'Kepala Sekolah',0,1,'C',true);	
			$this->Ln(15);
			$total_rows = $total_rows - 15; //for seting rows
			
			$size = $size + $sizeadd;
			
			$this->Cell(60,5,'',0,0,'C',true);	
			$this->Cell(70,5,$nama_wali[$i],0,0,'C',true);	
			$this->Cell(70,5,$nama_kepsek,0,1,'C',true);
			
			$this->Cell(60,5,'..................................',0,0,'C',true);	
			$this->Cell(70,5,"NIP ".$nip_wali[$i],0,0,'C',true);	
			$this->Cell(70,5,"NIP ".$nip_kepsek,0,1,'C',true);		
			//$this->Ln(90);
			$this->Ln($total_rows);
		}
				
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