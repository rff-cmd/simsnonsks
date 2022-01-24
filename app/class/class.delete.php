<?php

class delete{
	
	//----hapus user
	function delete_usr($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("select usrid from usr where id=$ref");
		$data=$sql->fetch(PDO::FETCH_OBJ);
		
		$sql=$dbpdo->prepare("delete from usr_dtl where usrid='$data->usrid' ");
		$sql->execute();
		
		$sql=$dbpdo->prepare("delete from usr where id='$ref' ");
		$sql->execute();
	
		//----delete user backup
		$sql=$dbpdo->prepare("delete from usr_bup where usrid='$data->usrid' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus registrasi
	function delete_registrasi($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("select replid, foto_file, file_darah from calonsiswa where replid='$ref' ");
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$idcalonsiswa = $data->replid;
		$foto_file = $data->foto_file;
		$file_darah = $data->file_darah;
		
		if($foto_file != '') {
			$uploaddir 		= 'app/file_foto/';
			unlink($uploaddir . $foto_file); //remove file 
		}
		
		if($file_darah != '') {
			$uploaddir 		= 'app/file_darah/';
			unlink($uploaddir . $file_darah_calon); //remove file 
		}
		
		$sql=$dbpdo->prepare("delete from calonsiswa_beasiswa where idcalonsiswa='$idcalonsiswa' ");
		$sql->execute();
	
		//----delete calon siswa
		$sql=$dbpdo->prepare("delete from calonsiswa_prestasi where idcalonsiswa='$idcalonsiswa' ");
		$sql->execute();
		
		$sql=$dbpdo->prepare("delete from calonsiswa where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus siswa
	function delete_siswa($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("select nis, file_darah, foto_file from siswa where replid='$ref' ");
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$file_darah = $data->file_darah;
		$nis = $data->nis;
		
		if($file_darah != '') {
			$uploaddir 		= 'app/file_darah/';
			unlink($uploaddir . $file_darah); //remove file 
		}
		
		$foto_file = $data->foto_file;
		
		if($foto_file != '') {
			$uploaddir 		= 'app/file_foto_siswa/';
			unlink($uploaddir . $foto_file); //remove file 
		}
		
		//----delete siswa beasiswa
		$sql=$dbpdo->prepare("delete from siswa_beasiswa where idsiswa='$ref' ");
		$sql->execute();
	
		//----delete siswa prestasi
		$sql=$dbpdo->prepare("delete from siswa_prestasi where idsiswa='$ref' ");
		$sql->execute();
		
		//----delete siswa Nilai UN
		$sql=$dbpdo->prepare("delete from siswa_nilai_un where nis='$nis' ");
		$sql->execute();
		
		//----delete siswa Nilai Raport
		$sql=$dbpdo->prepare("delete from siswa_nilai_raport where nis='$nis' ");
		$sql->execute();		
		
		//----delete siswa
		$sql=$dbpdo->prepare("delete from siswa where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus proses penerimaan siswa
	function delete_prosespenerimaansiswa($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from prosespenerimaansiswa where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus proses kelompok calon siswa
	function delete_kelompokcalonsiswa($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from kelompokcalonsiswa where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus departemen
	function delete_departemen($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from departemen where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus tingkat
	function delete_tingkat($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from tingkat where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus kelas
	function delete_kelas($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("select ttd_file from kelas_detail where replid='$ref' ");
		while($data=$sql->fetch(PDO::FETCH_OBJ)) {
			$foto_file = $data->ttd_file;
			
			if($foto_file != '') {
				$uploaddir 		= 'app/file_ttd/';
				if (file_exists($uploaddir)) {
					unlink($uploaddir . $foto_file); //remove file 
				} //remove file
			}
		}
		
		
		$foto_file = "";
		$sql=$dbpdo->query("select ttd_file_hd from kelas where replid='$ref' ");
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$foto_file = $data->ttd_file_hd;
		if($foto_file != '') {
			$uploaddir 		= 'app/file_ttd/';
			if (file_exists($uploaddir)) {
				unlink($uploaddir . $foto_file); //remove file 
			} //remove file
		}
		
		$sqlstr = "delete from kelas_detail where replid='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		$sql=$dbpdo->prepare("delete from kelas where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus gugus
	function delete_gugus($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from gugus where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus tahun ajaran
	function delete_tahunajaran($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("select info3 ttd_file from tahunajaran where replid='$ref' ");
		while($data=$sql->fetch(PDO::FETCH_OBJ)) {
			$foto_file = $data->ttd_file;
			
			if($foto_file != '') {
				$uploaddir 		= 'app/file_ttd/';
				if (file_exists($uploaddir)) {
					unlink($uploaddir . $foto_file); //remove file 
				} //remove file
			}
		}
		
		$sql=$dbpdo->prepare("delete from tahunajaran where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus agama
	function delete_agama($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from agama where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus tahun buku
	function delete_tahunbuku($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from tahunbuku where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus rekakun
	function delete_rekakun($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from rekakun where kode='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus datapenerimaan
	function delete_datapenerimaan($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from datapenerimaan where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus datapengeluaran
	function delete_datapengeluaran($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from datapengeluaran where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus besarjtt
	function delete_besarjtt($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from besarjtt where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus perpustakaan
	function delete_perpustakaan($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from perpustakaan where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus format
	function delete_format($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from format where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus rak
	function delete_rak($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from rak where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus katalog
	function delete_katalog($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from katalog where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus penerbit
	function delete_penerbit($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from penerbit where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus penulis
	function delete_penulis($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from penulis where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus delete penerimaan
	function delete_rpt_penerimaan($ref){
		
		$dbpdo = DB::create();
		
		$sql = "select idbesarjtt, idjurnal, jumlah from penerimaanjtt where replid = '$ref'";
		$result = $dbpdo->query($sql);
		$data = $result->fetch(PDO::FETCH_OBJ);
		$idbesarjtt = $data->idbesarjtt;
		$jumlah = $data->jumlah;
		
		//---get data
		$sqlx = "select idpenerimaan, nis, info2 from besarjtt where  replid = '$idbesarjtt'";
		$resultx = $dbpdo->query($sqlx);
		$datax = $resultx->fetch(PDO::FETCH_OBJ);
		$idpenerimaan = $datax->idpenerimaan;
		$nis = $datax->nis;
		$idtahunbuku = $datax->info2;
		//---------end get data
		
		//---update keterangan lunas
		$sql = $dbpdo->prepare("update besarjtt set info3='', lunas=0 where replid = '$idbesarjtt'");
		$sql->execute();
		//---------end keterangan lunas
		
		//---delete jurnal
		$sql = $dbpdo->prepare("DELETE FROM jurnaldetail WHERE idjurnal = '$data->idjurnal'");
		$sql->execute();
		
		$sql = $dbpdo->prepare("DELETE FROM jurnal WHERE replid = '$data->idjurnal'");
		$sql->execute();
		//-------end jurnal
		
		$sql = $dbpdo->prepare("DELETE FROM penerimaanjtt WHERE replid = '$ref'");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus pustaka
	function delete_pustaka($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("select katalog, photo from pustaka where replid='$ref' ");
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$foto_file = $data->photo;
		$katalog = $data->katalog;
		
		if($foto_file != '') {
			$uploaddir 		= 'app/file_foto_pustaka/';
			unlink($uploaddir . $foto_file); //remove file 
		}
		
		$sqlstr = "select count(replid) mcount from daftarpustaka where pustaka='$ref'";
		$sqlcek = $dbpdo->prepare($sqlstr);
		$sqlcek->execute();
		$rowdata = $sqlcek->fetch(PDO::FETCH_OBJ);
		$jum = $rowdata->mcount;
				
		$sqlstr 	= 	"select counter from katalog where replid='$katalog'";
		$sqlcek		=	$dbpdo->query($sqlstr);
		$data		=	$sqlcek->fetch(PDO::FETCH_OBJ);
		$counter 	= 	$data->counter;
		
		$newcounter = (int)$counter - (int)$jum;
		
		$sqlstr = "update katalog set counter=$newcounter where replid='$katalog'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		//--------start delete
		$sqlstr = "delete from daftarpustaka where pustaka='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		$sql=$dbpdo->prepare("delete from pustaka_suppler where pustaka_id='$ref' ");
		$sql->execute();
			
		$sql=$dbpdo->prepare("delete from pustaka where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus daftarpustaka
	function delete_daftarpustaka($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("select pustaka from daftarpustaka where replid='$ref' ");
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$foto_file = $data->photo;
		$pustaka = $data->pustaka;
		
		$sql=$dbpdo->query("select katalog, photo from pustaka where replid='$pustaka' ");
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$foto_file = $data->photo;
		$katalog = $data->katalog;
				
		$sqlstr = "select count(replid) mcount from daftarpustaka where pustaka='$ref'";
		$sqlcek = $dbpdo->prepare($sqlstr);
		$sqlcek->execute();
		$rowdata = $sqlcek->fetch(PDO::FETCH_OBJ);
		$jum = $rowdata->mcount;
				
		$sqlstr 	= 	"select counter from katalog where replid='$katalog'";
		$sqlcek		=	$dbpdo->query($sqlstr);
		$data		=	$sqlcek->fetch(PDO::FETCH_OBJ);
		$counter 	= 	$data->counter;
		
		$newcounter = (int)$counter - (int)$jum;
		
		$sqlstr = "update katalog set counter=$newcounter where replid='$katalog'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		//--------start delete
		$sqlstr = "delete from daftarpustaka where pustaka='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//----hapus pinjam detal pra save
	function delete_pinjam_detail($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from pinjam where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus konfigurasi
	function delete_konfigurasi($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from konfigurasi where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus pegawai
	function delete_pegawai($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("select foto_file from pegawai where replid='$ref' ");
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$foto_file = $data->foto_file;
		
		if($foto_file != '') {
			$uploaddir 		= 'app/file_foto_pegawai/';
			unlink($uploaddir . $foto_file); //remove file 
		}
		
		$sql=$dbpdo->prepare("delete from pegawai where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus status guru
	function delete_statusguru($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from statusguru where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus jabatan
	function delete_jabatan($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from jabatan where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus jenis_pelanggaran
	function delete_jenis_pelanggaran($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from jenis_pelanggaran where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus jenis_prestasi
	function delete_jenis_prestasi($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from jenis_prestasi where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus pelanggaran_siswa
	function delete_pelanggaran_siswa($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("select photo from pelanggaran_siswa where ref='$ref' ");
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$foto_file = $data->photo;
		
		if($foto_file != '') {
			$uploaddir 		= 'app/file_foto_pelanggaran/';
			unlink($uploaddir . $foto_file); //remove file 
		}
		
		$sql=$dbpdo->prepare("delete from pelanggaran_siswa where ref='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus konseling_siswa
	function delete_konseling_siswa($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from konseling_siswa where ref='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus pegawai jabatan
	function delete_pegawai_jabatan($ref='', $idpegawai=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from pegawai_jabatan where replid='$ref' and idpegawai='$idpegawai' ");
		$sql->execute();
		
		return $sql;
	}
    
    //----hapus jenis izin
	function delete_jenis_izin($ref=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from jenis_izin where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
    
    //----hapus izin_siswa
	function delete_izin_siswa($ref=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from izin_siswa where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus jenis_sertifikasi
	function delete_jenis_sertifikasi($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from jenis_sertifikasi where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus pegawai pangkat
	function delete_pegawai_pangkat($ref='', $idpegawai=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from pegawai_pangkat where replid='$ref' and idpegawai='$idpegawai' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus pegawai kenaikan gaji berkala (KGB)
	function delete_kenaikan_gaji($ref='', $idpegawai=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from kenaikan_gaji where replid='$ref' and idpegawai='$idpegawai' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus pegawai pendidikan
	function delete_pegawai_pendidikan($ref='', $idpegawai=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from pegawai_pendidikan where replid='$ref' and idpegawai='$idpegawai' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus pegawai keluarga
	function delete_pegawai_keluarga($ref='', $idpegawai=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from pegawai_keluarga where replid='$ref' and idpegawai='$idpegawai' ");
		$sql->execute();
		
		return $sql;
	}
		
	//----hapus supplier
	function delete_supplier($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from supplier where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus pegawai prestasi
	function delete_pegawai_prestasi($ref='', $idpegawai=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from pegawai_prestasi where replid='$ref' and idpegawai='$idpegawai' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus pegawai penghargaan
	function delete_pegawai_penghargaan($ref='', $idpegawai=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from pegawai_penghargaan where replid='$ref' and idpegawai='$idpegawai' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus pegawai skmengajar
	function delete_pegawai_skmengajar($ref='', $idpegawai=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from pegawai_skmengajar where replid='$ref' and idpegawai='$idpegawai' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus pelajaran
	function delete_pelajaran($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from pelajaran where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus siswa ekskul
	function delete_siswa_ekstrakurikuler($ref='', $idsiswa=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from siswa_ekstrakurikuler where replid='$ref' and idsiswa='$idsiswa' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus semester
	function delete_semester($ref=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from semester where replid='$ref'");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus angkatan
	function delete_angkatan($ref=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from angkatan where replid='$ref'");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus rpp
	function delete_rpp($ref=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from rpp where replid='$ref'");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus dasarpenilaian
	function delete_dasarpenilaian($ref=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from dasarpenilaian where replid='$ref'");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus kompetensi
	function delete_kompetensi($ref=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from kompetensi where replid='$ref'");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus jeniskompetensi
	function delete_jeniskompetensi($ref=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from jeniskompetensi where replid='$ref'");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus aspek_perkembangan
	function delete_aspek_perkembangan($ref=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from aspek_perkembangan where replid='$ref'");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus aspek_psikologi
	function delete_aspek_psikologi($ref=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from aspek_psikologi where replid='$ref'");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus aspek_psikologi_detail
	function delete_aspek_psikologi_detail($ref=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from aspek_psikologi_detail where replid='$ref'");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus assesmen_observasi
	function delete_assesmen_observasi($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from assesmen_observasi_detail where ref='$ref' ");
		$sql->execute();
		
		$sql=$dbpdo->prepare("delete from assesmen_observasi where ref='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus anggota
	function delete_anggota($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("select foto from anggota where replid='$ref' ");
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$file_foto = $data->foto;
		
		if($file_foto != '') {
			$uploaddir 		= 'app/file_foto_anggota/';
			unlink($uploaddir . $file_foto); //remove file 
		}
		
		
		//----delete anggota
		$sql=$dbpdo->prepare("delete from anggota where replid='$ref' ");
		$sql->execute();
			
		return $sql;
	}
	
	
	//----hapus evaluasi_psikologi
	function delete_evaluasi_psikologi($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from evaluasi_psikologi_detail where ref='$ref' ");
		$sql->execute();
		
		$sql=$dbpdo->prepare("delete from evaluasi_psikologi where ref='$ref' ");
		$sql->execute();
		
		return $sql;
	}
		
	//----hapus pelajaran_un_minat
	function delete_pelajaran_un_minat($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from pelajaran_un_minat where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus KRS
	function delete_kartu_rencana_studi($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from kartu_rencana_studi where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus Siswa KRS
	function delete_siswa_krs($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from siswa_krs where nis='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus pelajaran_raport_minat
	function delete_pelajaran_raport_minat($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from pelajaran_raport_minat where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus penempatan_siswa_prioritas
	function delete_penempatan_siswa_prioritas($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from penempatan_siswa_prioritas where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus pangkat
	function delete_pangkat($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from pangkat where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus status_pegawai
	function delete_status_pegawai($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from status_pegawai where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus guru
	function delete_guru($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from guru where idpelajaran='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus guru ekskul
	function delete_guru_ekskul($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from guru where idpelajaran='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//---hapus asset type
	function delete_asset_type($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from asset_type where id='$ref' ");
		$sql->execute();
	
		return $sql;
	}
    
    
    //---hapus asset
	function delete_asset($ref){
        
        $dbpdo = DB::create();
        
        $sql=$dbpdo->query("select photo from asset where ref='$ref' ");
        $data=$sql->fetch(PDO::FETCH_OBJ);
		$foto_file = $data->photo;
		
		if($foto_file != '') {
			$uploaddir 		= 'app/photo_asset/';
			unlink($uploaddir . $foto_file); //remove file 
		}
        
		$sql=$dbpdo->prepare("delete from asset where ref='$ref' ");
		$sql->execute();
	
		return $sql;
	}
    
    //---hapus asset trans
	function delete_asset_trans($ref){
       	
       	$dbpdo = DB::create();
       	
		$sql=$dbpdo->prepare("delete from asset_trans where ref='$ref' ");
		$sql->execute();
	
		return $sql;
	}
	
	//---hapus soal
	function delete_soal($ref){
       	
       	$dbpdo = DB::create();
       	
		$sql=$dbpdo->prepare("delete from soal where replid='$ref' ");
		$sql->execute();
	
		return $sql;
	}
	
	
	//---hapus pemetaan_kd
	function delete_pemetaan_kd($ref){
       	
       	$dbpdo = DB::create();
       	
		$sql=$dbpdo->prepare("delete from pemetaan_kd where replid='$ref' ");
		$sql->execute();
	
		return $sql;
	}
	
	
	//---hapus pemetaan_kd_siswa
	function delete_pemetaan_kd_siswa($ref){
       	
       	$dbpdo = DB::create();
       	
		$sql=$dbpdo->prepare("delete from pemetaan_kd_siswa where replid='$ref' ");
		$sql->execute();
	
		return $sql;
	}
	
	
	//----hapus ukbm
	function delete_ukbm($ref=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from ukbm where replid='$ref'");
		$sql->execute();
		
		return $sql;
	}
	
	
	//---hapus soal ukbm
	function delete_soal_ukbm($ref){
       	
       	$dbpdo = DB::create();
       	
		$sql=$dbpdo->prepare("delete from soal_ukbm where replid='$ref' ");
		$sql->execute();
	
		return $sql;
	}
	
	//---hapus setu periode
	function delete_setup_periode($ref){
       	
       	$dbpdo = DB::create();
       	
		$sql=$dbpdo->prepare("delete from setup_periode where replid='$ref' ");
		$sql->execute();
	
		return $sql;
	}
	
	//---hapus presensi ukbm
	function delete_presensi_ukbm($ref){
       	
       	$dbpdo = DB::create();
       	
		$sql=$dbpdo->prepare("delete from presensi_ukbm where ref='$ref' ");
		$sql->execute();
	
		return $sql;
	}
	
	//---hapus predikat raport
	function delete_predikat_raport($ref){
       	
       	$dbpdo = DB::create();
       	
		$sql=$dbpdo->prepare("delete from predikat_raport where replid='$ref' ");
		$sql->execute();
	
		return $sql;
	}
	
	
	//---hapus deskripsi raport
	function delete_deskripsi_raport($ref){
       	
       	$dbpdo = DB::create();
       	
		$sql=$dbpdo->prepare("delete from deskripsi_raport where replid='$ref' ");
		$sql->execute();
	
		return $sql;
	}
	
	//---hapus kelompok surat
	function delete_kelompok_surat($ref){
       	
       	$dbpdo = DB::create();
       	
		$sql=$dbpdo->prepare("delete from kelompok_surat where replid='$ref' ");
		$sql->execute();
	
		return $sql;
	}
	
	
	//---hapus surat keluar
	function delete_surat_keluar($ref){
       	
       	$dbpdo = DB::create();
       	
       	$sql=$dbpdo->query("select ref, file_dokumen from surat_keluar where ref='$ref' ");
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$idcalonsiswa = $data->replid;
		$file_dokumen = $data->file_dokumen;
		
		if($file_dokumen != '') {
			$uploaddir 		= 'app/surat_keluar/';
			unlink($uploaddir . $file_dokumen); //remove file 
		}
				
		$sql=$dbpdo->prepare("delete from surat_keluar where ref='$ref' ");
		$sql->execute();
	
		return $sql;
	}
	
	
	//---hapus surat masuk
	function delete_surat_masuk($ref){
       	
       	$dbpdo = DB::create();
       	
       	$sql=$dbpdo->query("select ref, file_dokumen from surat_masuk where ref='$ref' ");
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$idcalonsiswa = $data->replid;
		$file_dokumen = $data->file_dokumen;
		
		if($file_dokumen != '') {
			$uploaddir 		= 'app/surat_masuk/';
			unlink($uploaddir . $file_dokumen); //remove file 
		}
				
		$sql=$dbpdo->prepare("delete from surat_masuk where ref='$ref' ");
		$sql->execute();
	
		return $sql;
	}
	
	
	//---hapus buku kunjungan
	function delete_buku_kunjungan($ref){
       	
       	$dbpdo = DB::create();
       	
       	$sql=$dbpdo->prepare("delete from buku_kunjungan where ref='$ref' ");
		$sql->execute();
	
		return $sql;
	}
	
	
	//---hapus setup siswa khusus
	function delete_setup_siswa_khusus($ref){
       	
       	$dbpdo = DB::create();
       	
		$sql=$dbpdo->prepare("delete from setup_siswa_khusus where replid='$ref' ");
		$sql->execute();
	
		return $sql;
	}
	
	//---hapus material
	function delete_material($ref){
		$dbpdo = DB::create();
				
		$sql=$dbpdo->query("delete from set_item_price where item_code='$ref' ");
		
		$sql=$dbpdo->query("delete from item where syscode='$ref' ");
	
		return $sql;
	}
	
	//---hapus item group
	function delete_item_group($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from item_group where id='$ref' ");
		
		$sql=$dbpdo->query("delete from item_group_detail where id_header='$ref' ");
		
		return $sql;
	}
	
	//---hapus brand
	function delete_brand($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from brand where id='$ref' ");
		
		return $sql;
	}
	
	//---hapus build
	function delete_build($ref){
        $dbpdo = DB::create();
        
        $sqlstr="select photo from asset where ref='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_OBJ);
		$foto_file = $data->photo;
		
		if($foto_file != '') {
			$uploaddir 		= 'app/photo_asset/';
			unlink($uploaddir . $foto_file); //remove file 
		}
        
		$sqlstr="delete from asset where ref='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
	
		return $sql;
	}
	
	//---hapus room
	function delete_room($ref){
        $dbpdo = DB::create();
        
        $sqlstr="delete from asset_detail where ref='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
	
		return $sql;
	}
	
	//---hapus room_registration
	function delete_room_registration($ref){
        $dbpdo = DB::create();
        
        $sqlstr="delete from room_registration_detail where ref='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		$sqlstr="delete from room_registration where ref='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
	
		return $sql;
	}
	
	
	//---hapus jadwal
	function delete_jadwal($ref){
        $dbpdo = DB::create();
        
        $sqlstr="delete from jadwal where replid='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
	
		return $sql;
	}
	
	//---guru absen
	function delete_guru_absen($ref){
        $dbpdo = DB::create();
        
        $sqlstr="delete from guru_absen where replid='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
	
		return $sql;
	}
	
	//---siswa terlambat
	function delete_siswa_terlambat($ref){
        $dbpdo = DB::create();
        
        $sqlstr="delete from siswa_terlambat where replid='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
	
		return $sql;
	}
	
	//---siswa izin
	function delete_siswa_izin($ref){
        $dbpdo = DB::create();
        
        $sqlstr="delete from siswa_izin where replid='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
	
		return $sql;
	}
	
	//---kejadian lain
	function delete_kejadian_lain($ref){
        $dbpdo = DB::create();
        
        $sqlstr="delete from kejadian_lain where replid='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
	
		return $sql;
	}
	
	//---guru bk
	function delete_guru_bk($ref){
        $dbpdo = DB::create();
        
        $sqlstr="delete from guru_bk where replid='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
	
		return $sql;
	}
	
	//---guru penugasan
	function delete_guru_penugasan($ref, $idtahunajaran){
        $dbpdo = DB::create();
        
        $sqlstr="delete from guru_penugasan where idguru='$ref' and idtahunajaran='$idtahunajaran'";
        $sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
	
		return $sql;
	}
	
	//---infonap
	function delete_infonap($ref){
        $dbpdo = DB::create();
        
        $sqlstr="delete from infonap where replid='$ref'";
        $sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
	
		return $sql;
	}
	
	
	//---hapus setu periode raport
	function delete_setup_periode_raport($ref){
       	
       	$dbpdo = DB::create();
       	
		$sql=$dbpdo->prepare("delete from setup_periode_raport where replid='$ref' ");
		$sql->execute();
	
		return $sql;
	}
	
	//---hapus setu periode raport pts
	function delete_setup_periode_raport_pts($ref){
       	
       	$dbpdo = DB::create();
       	
		$sql=$dbpdo->prepare("delete from setup_periode_raport_pts where replid='$ref' ");
		$sql->execute();
	
		return $sql;
	}


	//---hapus receipt
	function delete_receipt($ref){
		
		$dbpdo = DB::create();
		
		
		$sqlstr="delete from receipt where ref='$ref' ";
		$sql=$dbpdo->query($sqlstr);
		
		$sql2="delete from receipt_detail where ref='$ref' ";
		$sql=$dbpdo->query($sql2);
		
		$sql2="delete from ar where ref='$ref' and invoice_type='RCI' ";
		$sql=$dbpdo->query($sql2);
		
		//delete ARC
		$sqlstr="delete from arc where ref='$ref'";
		$sql=$dbpdo->query($sqlstr);	
		
		//delete journal
		// $sql2="delete from jrn where ivino='$ref' and ivitpe='receipt' ";
		// $sql=$dbpdo->query($sql2);
		
		//delete DPS
		$sqlstr="delete from dps where ref='$ref' and invoice_type='RCI' ";
		$sql=$dbpdo->query($sqlstr);	
		
		return $sql;
	}
	

	//---hapus general journal in
	function delete_general_journal_in($ref){
		
		$dbpdo = DB::create();
		
		## Delete Journal
		// $sqlstr="delete from jrn where ivino='$ref' and ivitpe='Gnr Journal' ";
		// $sql=$dbpdo->prepare($sqlstr);
		// $sql->execute();
		
		$sqlstr="delete from general_journal where ref='$ref' ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		$sqlstr="delete from general_journal_detail where ref='$ref' ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
	
		return $sql;
	}
	
	
	//---hapus general_journal_in_detail
	function delete_general_journal_in_detail($ref='', $line=''){
		
		$dbpdo = DB::create();
		
		$sqlstr="delete from general_journal_detail where ref='$ref' and line='$line'";
		$sql=$dbpdo->query($sqlstr);
						
		// $sqlstr="delete from jrn where ivino='$ref' and lne='$line'";
		// $sql=$dbpdo->query($sqlstr);
		
		//update total; dbtamt	crdamt
		$sqlstr = "select sum(debit_amount) dbtamt, sum(credit_amount) crdamt from general_journal_detail where ref='$ref' group by ref";				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_OBJ);
		$total_balance = $data->dbtamt - $data->crdamt;
		$total_debit = $data->dbtamt;
		$total_credit = $data->crdamt;
		
		$sqlstr = "update general_journal set total_balance='$total_balance', total_debit='$total_debit', total_credit='$total_credit' where ref='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---hapus delete_finance_type
	function delete_finance_type($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from finance_type where id='$ref' ");
	
		return $sql;
	}
	
	
	//---hapus general_journal_detail
	function delete_general_journal_detail($ref='', $line=''){
		
		$dbpdo = DB::create();
		
		$sqlstr="delete from general_journal_detail where ref='$ref' and line='$line'";
		$sql=$dbpdo->query($sqlstr);
						
		// $sqlstr="delete from jrn where ivino='$ref' and lne='$line'";
		// $sql=$dbpdo->query($sqlstr);
		
		//update total; dbtamt	crdamt
		$sqlstr = "select sum(debit_amount) dbtamt, sum(credit_amount) crdamt from general_journal_detail where ref='$ref' group by ref";				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_OBJ);
		$total_balance = $data->dbtamt - $data->crdamt;
		$total_debit = $data->dbtamt;
		$total_credit = $data->crdamt;
		
		$sqlstr = "update general_journal set total_balance='$total_balance', total_debit='$total_debit', total_credit='$total_credit' where ref='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---hapus general journal
	function delete_general_journal($ref){
		
		$dbpdo = DB::create();
		
		## Delete Journal
		// $sqlstr="delete from jrn where ivino='$ref' and ivitpe='Gnr Journal' ";
		// $sql=$dbpdo->prepare($sqlstr);
		// $sql->execute();
		
		$sqlstr="delete from general_journal where ref='$ref' ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		$sqlstr="delete from general_journal_detail where ref='$ref' ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
	
		return $sql;
	}


	//---hapus coa
	function delete_coa($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from coa where syscode='$ref' ");
	
		return $sql;
	}
	

	//---hapus purchase inv
	function delete_purchase_inv($ref){
		
		$dbpdo = DB::create();
		
		$sqlstr="delete from purchase_invoice where ref='$ref' ";
		$sql=$dbpdo->query($sqlstr);
		
		$sql2="delete from purchase_invoice_detail where ref='$ref' ";
		$sql=$dbpdo->query($sql2);
		
		//delete AP
		$sqlstr="delete from ap where ref='$ref' and invoice_type='POV'";
		$sql=$dbpdo->query($sqlstr);
		
		//delete journal
		// $sqlstr="delete from jrn where ivino='$ref' and ivitpe='purchase_inv' ";
		// $sql=$dbpdo->query($sqlstr);
		
		$sql2="delete from bincard where invoice_no='$ref' and invoice_type='purchase_inv' ";
		$sql=$dbpdo->query($sql2);
		
		return $sql;
	}


	function delete_good_receipt($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			##--------update qty sales order	
			$sql_do="select po_ref, item_code, uom_code, pi_line, ifnull(qty,0) qty from good_receipt_detail where ref='$ref'";
			$result=$dbpdo->query($sql_do);
			while($data = $result->fetch(PDO::FETCH_OBJ)) {
				$po_ref = $data->po_ref;
				$item_code = $data->item_code;
				$uom_code = $data->uom_code;
				$pi_line = $data->pi_line;
				$qty = $data->qty;
				
				$sql2="update purchase_invoice_detail set qty_good=ifnull(qty_good,0) - $qty where ref='$po_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$pi_line' ";	
				$sql=$dbpdo->query($sql2);	
				
				/*update status sales order : S=Shipped in Part (dikirim sebagian)
											  F=Shipped in Full (dikirm semua)
											  C=Closed (tidak dikirim sama sekali, tetapi transaksi di close)	
				*/
				##--------update qty purchase invoice
				$sql2 = "select sum(ifnull(qty,0)) qty, sum(ifnull(qty_good,0)) qty_good from purchase_invoice_detail group by ref having ref='$po_ref'";
				$result=$dbpdo->prepare($sql2);
				$result->execute();
				$data = $result->fetch(PDO::FETCH_OBJ);
				
				$qty_good = $data->qty_good;
				$qty = $data->qty;
				
				if($qty_good > 0) {
					if($qty_good < $qty ) {
						$sqlstr="update purchase_invoice set status='S' where ref='$po_ref' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();	
					}
					
					if($qty_good >= $qty ) {
						$sqlstr="update purchase_invoice set status='F' where ref='$po_ref' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
				}
				##*****************************************##
			}		
			
			$sqlstr="delete from bincard where invoice_no='$ref'";
			$sql=$dbpdo->query($sqlstr);
			
			$sqlstr="delete from good_receipt_detail where ref='$ref' ";
			$sql=$dbpdo->query($sqlstr);
			
			$sqlstr="delete from good_receipt where ref='$ref' ";
			$sql=$dbpdo->query($sqlstr);
			
			$dbpdo->commit();
			
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
				
		return $sql;
	}

	//---hapus payment
	function delete_payment($ref){
		
		$dbpdo = DB::create();
		
		
		$sqlstr="delete from payment where ref='$ref' ";
		$sql=$dbpdo->query($sqlstr);
		
		$sql2="delete from payment_detail where ref='$ref' ";
		$sql=$dbpdo->query($sql2);
		
		$sql2="delete from ap where ref='$ref' and invoice_type='PMT' ";
		$sql=$dbpdo->query($sql2);
		
		//delete APC
		$sqlstr="delete from apc where ref='$ref'";
		$sql=$dbpdo->query($sqlstr);	
		
		// $sql2="delete from jrn where ivino='$ref' and ivitpe='payment' ";
		// $sql=$dbpdo->query($sql2);
					
		return $sql;
	}

	
}

?>
