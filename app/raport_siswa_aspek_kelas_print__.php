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
$idsemester	= $_SESSION["semester_id"];
$idkelas	= $_REQUEST["idkelas"];
$idtingkat1	= $_REQUEST["idtingkat"];

$sqlidentitas = $selectview->list_identitas();
$dataidentitas = $sqlidentitas->fetch(PDO::FETCH_OBJ);

$minat 				= 	array();

$nama_sekolah		=	array();
$nama_semester		=	array();
$tanggal_ttd		=	array();
$alamat_sekolah		=	array();
$nama_siswa			=	array();
$nis_siswa			=	array();
$nisn_siswa			=	array();
$sikap_spirit_a		=	array();
$sikap_sosial_a		=	array();

$numeric_semester	=	array();

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

$sqlsiswa = $selectview->list_siswa2("", "", $idtingkat1, $idkelas);
while($datasiswa = $sqlsiswa->fetch(PDO::FETCH_OBJ)) {
	
	$idsiswa = $datasiswa->replid;
	$idkelas = $datasiswa->idkelas;
	
	$peminatan = "";
	if($datasiswa->idminat == 1) {
		$minat[] = "Matematika dan Ilmu Pengetahuan Alam";
		
		$peminatan = "MIPA";
	}
	if($datasiswa->idminat == 2) {
		$minat[] = "Ilmu-ilmu Sosial";
		
		$peminatan = "IPS";
	}

	$sqlsemester = $selectview->list_semester($idsemester);
	$datasemester = $sqlsemester->fetch(PDO::FETCH_OBJ);

	$sqldesc_predikat_spirit = $selectview->list_deskripsi_raport("", "", "Spritual", "");
	$datadesc_predikat_spirit = $sqldesc_predikat_spirit->fetch(PDO::FETCH_OBJ);

	$sqldesc_predikat_sosial = $selectview->list_deskripsi_raport("", "", "Sosial", "");
	$datadesc_predikat_sosial = $sqldesc_predikat_sosial->fetch(PDO::FETCH_OBJ);
	/*------------------------------------------*/

	/*---------print header-----------*/
	$nama_sekolah[]		=	$dataidentitas->nama;
	$nama_semester[]	=	$datasemester->semester;
	$tanggal_ttd[]		=	$datasemester->tanggal_ttd;
	$alamat_sekolah[]	=	$dataidentitas->alamat1;
	$nama_siswa[]		=	$datasiswa->nama;
	$nis_siswa[]		=	$datasiswa->nis;
	$nisn_siswa[]		=	$datasiswa->nisn;
	$sikap_spirit_a[]	=	$datadesc_predikat_spirit->sikap_a;
	$sikap_sosial_a[]	=	$datadesc_predikat_sosial->sikap_a;
	$idtingkat			= 	$datasiswa->idtingkat;

	$numeric_semester1 	= 	numeric_semester($idtingkat);
	$numeric_semester[]	= 	$numeric_semester1;
	/*-------------------------------*/

	/*-----------footer-------------*/
	$sql_peg = $selectview->list_pegawai('', '196106231981012002', '', '');
	$data_peg = $sql_peg->fetch(PDO::FETCH_OBJ);
	$nip_kepsek 	= $data_peg->nip;
	$nama_kepsek	= $data_peg->nama;
	/*------------------------------*/

	/*---------print detail----------*/
	
	$no = 0;
	##START GET NILAI
	$no_urut_mapel = 0;
	//$data_kelompok[]="Kelompok A (Umum)";
	$sql = $selectview->list_daftarnilai_raport("SMA", $idtingkat, $idkelas, $idsemester, $idsiswa, 1, $peminatan);
	while($row_pelajaran_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
		
		$no_urut_mapel++;
		
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
		$deskripsi_p = "";
		$predikat_p = "";
		if($nilai_raport < $nilai_angka_d) {
			$predikat_p = "D";
			
			$deskripsi_p 	= $data_predikat->deskripsi_p_d;
		}
		if($nilai_raport >= $nilai_angka_c && $nilai_raport <= $nilai_angka_c1) {
			$predikat_p = "C";
			
			$deskripsi_p = $data_predikat->deskripsi_p_c;
		}
		if($nilai_raport >= $nilai_angka_b && $nilai_raport <= $nilai_angka_b1 ) {
			$predikat_p = "B";
			
			$deskripsi_p = $data_predikat->deskripsi_p_b;
		}
		if($nilai_raport >= $nilai_angka_a && $nilai_raport <= $nilai_angka_a1 ) {
			$predikat_p = "A";
			
			$deskripsi_p = $data_predikat->deskripsi_p_a;
		}
		
		//predikat keterampilan
		$predikat_k = "";
		$deskripsi_k = "";
		if($nilai_raport_k < $nilai_angka_d) {
			$predikat_k = "D";
			
			$deskripsi_k = $data_predikat->deskripsi_k_d;
		}
		if($nilai_raport_k >= $nilai_angka_c && $nilai_raport_k <= $nilai_angka_c1) {
			$predikat_k = "C";
			
			$deskripsi_k = $data_predikat->deskripsi_k_c;
		}
		if($nilai_raport_k >= $nilai_angka_b && $nilai_raport_k <= $nilai_angka_b1 ) {
			$predikat_k = "B";
			
			$deskripsi_k = $data_predikat->deskripsi_k_b;
		}
		if($nilai_raport_k >= $nilai_angka_a && $nilai_raport_k <= $nilai_angka_a1 ) {
			$predikat_k = "A";
			
			$deskripsi_k = $data_predikat->deskripsi_k_a;
		}
		
		//cek nama alias mapel
		$nama_pelajaran		=	$row_pelajaran_detail->nama_pelajaran;
		$sqlalias = $selectview->list_pelajaran_alias($row_pelajaran_detail->pelajaran_id, $row_pelajaran_detail->idpelajaran_alias); 
		$data_alias = $sqlalias->fetch(PDO::FETCH_OBJ);
		if($data_alias->nama_alias != "") {
			$nama_pelajaran = $data_alias->nama_alias;
		}
		
		$kode_pelajaran		=	"MPW".($datasiswa->idminat + 1); //."0".$no_urut_mapel.$numeric_semester1; //$row_pelajaran_detail->kode_pelajaran;
		$nama_pelajaran		=	$nama_pelajaran . " " . $numeric_semester1;
		$kkm				=	$row_pelajaran_detail->kkm;
		$kkm_terampil		=	$row_pelajaran_detail->kkm_terampil;
		$sks				=	$row_pelajaran_detail->sks;
		
		$data[]=$kode_pelajaran.';'.$nama_pelajaran.';'.$kkm.';'.$kkm_terampil.';'.$sks.';'.$nilai_raport.';'.$predikat_p.';'.$nilai_raport_k.';'.$predikat_k.';'.$rata2;
		
		$data2[]='Kelompok A (Umum)'.'|'.'Pengetahuan'.'|'.$kode_pelajaran.'|'.$nama_pelajaran.'|'.$deskripsi_p.'|'.$jumlah_nilai.'|'.$datasiswa->nis;
		$data3[]='Kelompok A (Umum)'.'|'.'Keterampilan'.'|'.$kode_pelajaran.'|'.$nama_pelajaran.'|'.$deskripsi_k.'|'.$jumlah_nilai.'|'.$datasiswa->nis;
		
			
	}


	//=================B UMUM
	$no_urut_mapel = 0;
	//$data_kelompok[]="Kelompok B (Umum)";
	$sql = $selectview->list_daftarnilai_raport("SMA", $idtingkat, $idkelas, $idsemester, $idsiswa, 2, $peminatan);
	while($row_pelajaran_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
		
		$no_urut_mapel++;
		
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
		
		//predikat pengetahuan
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
		$deskripsi_p = "";
		$predikat_p = "";
		if($nilai_raport < $nilai_angka_d) {
			$predikat_p = "D";
			
			$deskripsi_p 	= $data_predikat->deskripsi_p_d;
		}
		if($nilai_raport >= $nilai_angka_c && $nilai_raport <= $nilai_angka_c1) {
			$predikat_p = "C";
			
			$deskripsi_p = $data_predikat->deskripsi_p_c;
		}
		if($nilai_raport >= $nilai_angka_b && $nilai_raport <= $nilai_angka_b1 ) {
			$predikat_p = "B";
			
			$deskripsi_p = $data_predikat->deskripsi_p_b;
		}
		if($nilai_raport >= $nilai_angka_a && $nilai_raport <= $nilai_angka_a1 ) {
			$predikat_p = "A";
			
			$deskripsi_p = $data_predikat->deskripsi_p_a;
		}
		
		//predikat keterampilan
		$predikat_k = "";
		$deskripsi_k = "";
		if($nilai_raport_k < $nilai_angka_d) {
			$predikat_k = "D";
			
			$deskripsi_k = $data_predikat->deskripsi_k_d;
		}
		if($nilai_raport_k >= $nilai_angka_c && $nilai_raport_k <= $nilai_angka_c1) {
			$predikat_k = "C";
			
			$deskripsi_k = $data_predikat->deskripsi_k_c;
		}
		if($nilai_raport_k >= $nilai_angka_b && $nilai_raport_k <= $nilai_angka_b1 ) {
			$predikat_k = "B";
			
			$deskripsi_k = $data_predikat->deskripsi_k_b;
		}
		if($nilai_raport_k >= $nilai_angka_a && $nilai_raport_k <= $nilai_angka_a1 ) {
			$predikat_k = "A";
			
			$deskripsi_k = $data_predikat->deskripsi_k_a;
		}
		
		//cek nama alias mapel
		$nama_pelajaran		=	$row_pelajaran_detail->nama_pelajaran;
		$sqlalias = $selectview->list_pelajaran_alias($row_pelajaran_detail->pelajaran_id, $row_pelajaran_detail->idpelajaran_alias); 
		$data_alias = $sqlalias->fetch(PDO::FETCH_OBJ);
		if($data_alias->nama_alias != "") {
			$nama_pelajaran = $data_alias->nama_alias;
		}
		
		$kode_pelajaran		=	"MPW".($datasiswa->idminat + 1); //."0".$no_urut_mapel.$numeric_semester1; //$row_pelajaran_detail->kode_pelajaran;
		$nama_pelajaran		=	$nama_pelajaran . " " . $numeric_semester1;
		$kkm				=	$row_pelajaran_detail->kkm;
		$kkm_terampil		=	$row_pelajaran_detail->kkm_terampil;
		$sks				=	$row_pelajaran_detail->sks;
		
		$data[]=$kode_pelajaran.';'.$nama_pelajaran.';'.$kkm.';'.$kkm_terampil.';'.$sks.';'.$nilai_raport.';'.$predikat_p.';'.$nilai_raport_k.';'.$predikat_k.';'.$rata2;
		
		$data2[]='Kelompok B (Umum)'.'|'.'Pengetahuan'.'|'.$kode_pelajaran.'|'.$nama_pelajaran.'|'.$deskripsi_p.'|'.$jumlah_nilai.'|'.$datasiswa->nis;
		$data3[]='Kelompok B (Umum)'.'|'.'Keterampilan'.'|'.$kode_pelajaran.'|'.$nama_pelajaran.'|'.$deskripsi_k.'|'.$jumlah_nilai.'|'.$datasiswa->nis;
		
			
	}


	//=================Kelompok C (Peminatan)
	$no_urut_mapel = 0;
	//$data_kelompok[]="Kelompok C (Peminatan)";
	$sql = $selectview->list_daftarnilai_raport("SMA", $idtingkat, $idkelas, $idsemester, $idsiswa, 3, $peminatan);
	while($row_pelajaran_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
		
		$no_urut_mapel++;
		
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
		
		//predikat pengetahuan
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
		$deskripsi_p = "";
		$predikat_p = "";
		if($nilai_raport < $nilai_angka_d) {
			$predikat_p = "D";
			
			$deskripsi_p 	= $data_predikat->deskripsi_p_d;
		}
		if($nilai_raport >= $nilai_angka_c && $nilai_raport <= $nilai_angka_c1) {
			$predikat_p = "C";
			
			$deskripsi_p = $data_predikat->deskripsi_p_c;
		}
		if($nilai_raport >= $nilai_angka_b && $nilai_raport <= $nilai_angka_b1 ) {
			$predikat_p = "B";
			
			$deskripsi_p = $data_predikat->deskripsi_p_b;
		}
		if($nilai_raport >= $nilai_angka_a && $nilai_raport <= $nilai_angka_a1 ) {
			$predikat_p = "A";
			
			$deskripsi_p = $data_predikat->deskripsi_p_a;
		}
		
		//predikat keterampilan
		$predikat_k = "";
		$deskripsi_k = "";
		if($nilai_raport_k < $nilai_angka_d) {
			$predikat_k = "D";
			
			$deskripsi_k = $data_predikat->deskripsi_k_d;
		}
		if($nilai_raport_k >= $nilai_angka_c && $nilai_raport_k <= $nilai_angka_c1) {
			$predikat_k = "C";
			
			$deskripsi_k = $data_predikat->deskripsi_k_c;
		}
		if($nilai_raport_k >= $nilai_angka_b && $nilai_raport_k <= $nilai_angka_b1 ) {
			$predikat_k = "B";
			
			$deskripsi_k = $data_predikat->deskripsi_k_b;
		}
		if($nilai_raport_k >= $nilai_angka_a && $nilai_raport_k <= $nilai_angka_a1 ) {
			$predikat_k = "A";
			
			$deskripsi_k = $data_predikat->deskripsi_k_a;
		}
		
		//cek nama alias mapel
		$nama_pelajaran		=	$row_pelajaran_detail->nama_pelajaran;
		$sqlalias = $selectview->list_pelajaran_alias($row_pelajaran_detail->pelajaran_id, $row_pelajaran_detail->idpelajaran_alias); 
		$data_alias = $sqlalias->fetch(PDO::FETCH_OBJ);
		if($data_alias->nama_alias != "") {
			$nama_pelajaran = $data_alias->nama_alias;
		}
		
		$kode_pelajaran		=	"MPM".($datasiswa->idminat + 1); //."0".$no_urut_mapel.$numeric_semester1; //$row_pelajaran_detail->kode_pelajaran;
		$nama_pelajaran		=	$nama_pelajaran . " " . $numeric_semester1;
		$kkm				=	$row_pelajaran_detail->kkm;
		$kkm_terampil		=	$row_pelajaran_detail->kkm_terampil;
		$sks				=	$row_pelajaran_detail->sks;
		
		$data[]=$kode_pelajaran.';'.$nama_pelajaran.';'.$kkm.';'.$kkm_terampil.';'.$sks.';'.$nilai_raport.';'.$predikat_p.';'.$nilai_raport_k.';'.$predikat_k.';'.$rata2;
		
		$data2[]='Kelompok C (Peminatan)'.'|'.'Pengetahuan'.'|'.$kode_pelajaran.'|'.$nama_pelajaran.'|'.$deskripsi_p.'|'.$jumlah_nilai.'|'.$datasiswa->nis;
		$data3[]='Kelompok C (Peminatan)'.'|'.'Keterampilan'.'|'.$kode_pelajaran.'|'.$nama_pelajaran.'|'.$deskripsi_k.'|'.$jumlah_nilai.'|'.$datasiswa->nis;
		
			
	}


	//=================Kelompok C (Pilihan Lintas Peminatan)
	$no_urut_mapel = 0;
	//$data_kelompok[]="Kelompok C (Pilihan Lintas Peminatan)";
	$sql = $selectview->list_daftarnilai_raport_lintas_minat("SMA", $idtingkat, $idkelas, $idsemester, $idsiswa, 4, $peminatan);
	while($row_pelajaran_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
		
		$no_urut_mapel++;
		
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
		
		//predikat pengetahuan
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
		$deskripsi_p = "";
		$predikat_p = "";
		if($nilai_raport < $nilai_angka_d) {
			$predikat_p = "D";
			
			$deskripsi_p 	= $data_predikat->deskripsi_p_d;
		}
		if($nilai_raport >= $nilai_angka_c && $nilai_raport <= $nilai_angka_c1) {
			$predikat_p = "C";
			
			$deskripsi_p = $data_predikat->deskripsi_p_c;
		}
		if($nilai_raport >= $nilai_angka_b && $nilai_raport <= $nilai_angka_b1 ) {
			$predikat_p = "B";
			
			$deskripsi_p = $data_predikat->deskripsi_p_b;
		}
		if($nilai_raport >= $nilai_angka_a && $nilai_raport <= $nilai_angka_a1 ) {
			$predikat_p = "A";
			
			$deskripsi_p = $data_predikat->deskripsi_p_a;
		}
		
		//predikat keterampilan
		$predikat_k = "";
		$deskripsi_k = "";
		if($nilai_raport_k < $nilai_angka_d) {
			$predikat_k = "D";
			
			$deskripsi_k = $data_predikat->deskripsi_k_d;
		}
		if($nilai_raport_k >= $nilai_angka_c && $nilai_raport_k <= $nilai_angka_c1) {
			$predikat_k = "C";
			
			$deskripsi_k = $data_predikat->deskripsi_k_c;
		}
		if($nilai_raport_k >= $nilai_angka_b && $nilai_raport_k <= $nilai_angka_b1 ) {
			$predikat_k = "B";
			
			$deskripsi_k = $data_predikat->deskripsi_k_b;
		}
		if($nilai_raport_k >= $nilai_angka_a && $nilai_raport_k <= $nilai_angka_a1 ) {
			$predikat_k = "A";
			
			$deskripsi_k = $data_predikat->deskripsi_k_a;
		}
		
		//cek nama alias mapel
		$nama_pelajaran		=	$row_pelajaran_detail->nama_pelajaran;
		$sqlalias = $selectview->list_pelajaran_alias($row_pelajaran_detail->pelajaran_id, $row_pelajaran_detail->idpelajaran_alias); 
		$data_alias = $sqlalias->fetch(PDO::FETCH_OBJ);
		if($data_alias->nama_alias != "") {
			$nama_pelajaran = $data_alias->nama_alias;
		}
		
		$kode_pelajaran		=	"MPP".($datasiswa->idminat + 1); //."0".$no_urut_mapel.$numeric_semester1; //$row_pelajaran_detail->kode_pelajaran;
		$nama_pelajaran		=	$nama_pelajaran . " " . $numeric_semester1;
		$kkm				=	$row_pelajaran_detail->kkm;
		$kkm_terampil		=	$row_pelajaran_detail->kkm_terampil;
		$sks				=	$row_pelajaran_detail->sks;
		
		$data[]=$kode_pelajaran.';'.$nama_pelajaran.';'.$kkm.';'.$kkm_terampil.';'.$sks.';'.$nilai_raport.';'.$predikat_p.';'.$nilai_raport_k.';'.$predikat_k.';'.$rata2;
		
		$data2[]='Kelompok C (Pilihan Lintas Peminatan)'.'|'.'Pengetahuan'.'|'.$kode_pelajaran.'|'.$nama_pelajaran.'|'.$deskripsi_p.'|'.$jumlah_nilai.'|'.$datasiswa->nis;
		$data3[]='Kelompok C (Pilihan Lintas Peminatan)'.'|'.'Keterampilan'.'|'.$kode_pelajaran.'|'.$nama_pelajaran.'|'.$deskripsi_k.'|'.$jumlah_nilai.'|'.$datasiswa->nis;
		
			
	}

									
	$sql_wali 	= $selectview->list_kelas($idkelas, "");
	$data_wali	= $sql_wali->fetch(PDO::FETCH_OBJ);
	$nip_wali[]	= $data_wali->nip_wali;
	$nama_wali[]= $data_wali->walikelas;
	/*-------------------------------------------*/
}
				

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
				
		for($i=0; $i<count($nis_siswa); $i++) {	
			
			$total_rows = 300; //250
							
			$this->SetFont('Arial','',11);
			$this->SetFillColor(255,255,255);
			$this->SetTextColor(0,0,0);
			
			$this->Ln(2);
					
			$this->SetFont('Arial','',10);
			$this->Cell(35,3,'Nama Sekolah',0,0,'L',true);
			$this->Cell(2,3,':',0,0,'L',false);
			$this->Cell(70,3,$nama_sekolah[$i],0,0,'L',false);
			
			$this->SetFont('Arial','',10);
			$this->Cell(25,3,'Semester',0,0,'L',true);
			$this->Cell(2,3,':',0,0,'L',false);
			$this->Cell(80,3,$numeric_semester[$i] . "-" .$_SESSION["tahunajaran"],0,1,'L',false);
			$this->Ln(2);
			
			$this->SetFont('Arial','',10);
			$this->Cell(35,3,'Alamat',0,0,'L',true);
			$this->Cell(2,3,':',0,0,'L',false);
			$this->Cell(70,3,$alamat_sekolah[$i],0,0,'L',false);
			
			$this->SetFont('Arial','',10);
			$this->Cell(25,3,'Peminatan',0,0,'L',true);
			$this->Cell(2,3,':',0,0,'L',false);
			$this->Cell(70,3,$minat[$i],0,1,'L',false);
			$this->Ln(2);
			
			$this->SetFont('Arial','',10);
			$this->Cell(35,3,'Nama Peserta Didik',0,0,'L',true);
			$this->Cell(2,3,':',0,0,'L',false);
			$this->Cell(80,3,$nama_siswa[$i],0,1,'L',false);
			$this->Ln(2);
			
			$this->SetFont('Arial','',10);
			$this->Cell(35,3,'Nomor Induk / NISN',0,0,'L',true);
			$this->Cell(2,3,':',0,0,'L',false);
			$this->Cell(80,3,$nis_siswa[$i]." / ".$nisn_siswa[$i],0,1,'L',false);
			$this->Ln(2);
			
			//Save ordinate
			$this->y0=$this->GetY();
			
			//------------------DETAIL
			global $sikap_spirit_a;
			global $sikap_sosial_a;
			
			$this->SetFont('Arial','B',9);
			$this->SetFillColor(255,255,255);
			$this->SetTextColor(0,0,0);
			
			$this->Ln(5);
			
			$this->Cell(15,7,"Deskripsi Pengetahuan dan Keterampilan",0,1,"L");
					
			$this->Ln(2);
			
			//Caption Detail
			$this->Cell(15,7,"Kode",1,0,"C");
			$this->Cell(71,7,"Mata Pelajaran",1,0,"C");
			$this->Cell(25,7,"Aspek",1,0,"C");
			$this->Cell(91,7,"Deskripsi",1,0,"C");
			$this->Ln();
			
			
			//Data	
			global $data_kelompok;
			global $data_deposit;
			global $data2;
			global $data3;
			global $g_total;
			global $inv_amount;
			global $deposit_d;
			global $total_qty_po;
			global $sub_total_invoice;
			global $total_qty;
			global $sx_total;
			
			$total_qty = 0;
			for($z=0; $z<count($data_kelompok); $z++) {
				
				$this->SetFont('Arial','B',8);
				$this->Cell(202,7,$data_kelompok[$z],1,1,"L");
				
				$this->SetFont('Arial','',8);
				
				$s_total = 0;
				$k = 0;
				for($s=0; $s<count($data2); $s++) {
					$exdata = explode('|', $data2[$s]);
					$exdata3 = explode('|', $data3[$s]);
					
					if( ($exdata[0] == $data_kelompok[$z]) && ($exdata[6] == $nis_siswa[$i]) ) {	
						if($exdata[5] > 0) {
							$k++;
							$this->Cell(15,20,$exdata[2]."0".$k.$numeric_semester[$i],1,0,"C"); //kode
							$this->Cell(71,20,$exdata[3],1,0,"L"); //nama pelajaran
							$this->Cell(25,10,$exdata[1],1,0,"L"); //aspek
							$this->MultiCell(91,5,$exdata[4],1,1,"L"); //deskripsi		
							
							
							$this->Cell(15,10,"",0,0,"C"); //kode
							$this->Cell(71,10,"",0,0,"L"); //nama pelajaran					
							$this->Cell(25,10,$exdata3[1],1,0,"L"); //aspek					
							$this->MultiCell(91,5,$exdata3[4],1,1,"L"); //deskripsi
						}
					}
				}
				
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
			global $tanggal_ttd;
			
			$this->Ln(2);
			
			$size = $size + $sizeadd;
			
			//---------
			$this->SetFont('Arial','',9);
			
			$this->Ln(7);
			
			/*$this->SetFont('Arial','',10);
			
			$tgl 	= date("Y-m-d", strtotime($tanggal_ttd[$i]));
			$tnggal	= tglindonesia($tgl, $hasil);
			
			$this->Cell(58,5,'Mengetahui,',0,0,'C',true);
			$this->Cell(128,5,'Bandung, '.$tnggal,0,1,'R',true);
			$this->Cell(60,5,'Orang Tua/Wali',0,0,'C',true);
			
			$this->Cell(70,5,'Pembimbing Akademik',0,0,'C',true);
			
			$this->Cell(70,5,'Kepala Sekolah',0,1,'C',true);	
			$this->Ln(15);
			
			$size = $size + $sizeadd;
			
			$this->Cell(60,5,'',0,0,'C',true);	
			$this->Cell(70,5,$nama_wali[$i],0,0,'C',true);	
			$this->Cell(70,5,$nama_kepsek,0,1,'C',true);
			
			$this->Cell(60,5,'..................................',0,0,'C',true);	
			$this->Cell(70,5,"NIP ".$nip_wali[$i],0,0,'C',true);	
			$this->Cell(70,5,"NIP ".$nip_kepsek,0,1,'C',true);	*/	
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