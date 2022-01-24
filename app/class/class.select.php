<?php

class select{	

	//---------get data user
	function list_usr($ref='', $tipe_user='', $usrid='', $all='', $idtingkat=''){	
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.id = '$ref' ";
			} else {
				$where = $where . " and a.id = '$ref' ";
			}
		}
		
		if ($tipe_user != "") {
			if ($where == "") {
				$where = " where a.tipe_user = '$tipe_user' ";
			} else {
				$where = $where . " and a.tipe_user = '$tipe_user' ";
			}
		}
		
		if ($usrid != "") {
			if ($where == "") {
				$where = " where a.usrid = '$usrid' ";
			} else {
				$where = $where . " and a.usrid = '$usrid' ";
			}
		}
		
		if($all == "1") {
			$where = "";
		}
		
		if($ref=='' && $tipe_user=='' && $usrid=='' && $all=='') {
			$where = " where a.id=0";
		}
		
		if (user_admin()==0) {
			$uid = $_SESSION["loginname"];
			$where = " where (a.usrid = '$uid' or a.uid = '$uid') ";
		} 
		
		if($tipe_user == "Siswa" && $idtingkat != "") {
			
			if ($idtingkat != "") {
				if ($where == "") {
					$where = " where d.idtingkat = '$idtingkat' ";
				} else {
					$where = $where . " and d.idtingkat = '$idtingkat' ";
				}
			}
		
			$sqlstr = "select a.id, a.usrid, a.pwd, a.adm, b.pwd pwdori, a.photo, a.departemen, a.idpegawai, a.tipe_user, a.ganti_pwd_no, a.act, a.uid, a.dlu, c.nis, c.nama, d.kelas, e.tingkat from usr a left join usr_bup b on a.usrid=b.usrid left join siswa c on a.usrid=c.nis left join kelas d on c.idkelas=d.replid left join tingkat e on d.idtingkat=e.replid " . $where . " order by a.usrid";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		} else {
			$sqlstr = "select a.id, a.usrid, a.pwd, a.adm, b.pwd pwdori, a.photo, a.departemen, a.idpegawai, a.tipe_user, a.ganti_pwd_no, a.act, a.uid, a.dlu from usr a left join usr_bup b on a.usrid=b.usrid " . $where . " order by a.usrid";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}	
		
	 	/*if ($ref == "") {
			$where = "";
			if (user_admin()==0) {
				$uid = $_SESSION["loginname"];
				$where = " where a.uid = '$uid' ";
			} 
			
			$sqlstr = "select a.id, a.usrid, a.pwd, a.adm, b.pwd pwdori, a.photo, a.departemen, a.idpegawai, a.tipe_user, a.act, a.uid, a.dlu from usr a left join usr_bup b on a.usrid=b.usrid " . $where . " order by a.usrid";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		} else {
			$sqlstr = "select a.id, a.usrid, a.pwd, b.pwd pwdori, a.adm, a.photo, a.departemen, a.idpegawai, a.tipe_user, a.act, a.uid, a.dlu from usr a left join usr_bup b on a.usrid=b.usrid where a.id='$ref' order by a.usrid";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}*/
		
		
		return $sql;
	}
	
	//-----------user detail akses(saat update)
	function list_usrdtl($id) {
		$dbpdo = DB::create();
		
		$sqlstr = "select usrid from usr where id=$id";
		$hasil_cek = $dbpdo->query($sqlstr);
		$data = $hasil_cek->fetch(PDO::FETCH_OBJ);
				
		$sqlstr = "select usrid from usr where usrid='$data->usrid' ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//-----------user form akses(saat add)
	function list_usrfrm() {
		$dbpdo = DB::create();
		
		$sqlstr = "select frmcde, frmnme from usr_frm order by frmnme";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------check user
	function list_usr_check($ref=''){	 
		$dbpdo = DB::create();
			
		$sqlstr = "select usrid from usr where usrid='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------check user update
	function list_usrupdate_check($ref='', $old_usrid=''){	 
		$dbpdo = DB::create();
			
		$sqlstr = "select usrid from usr where usrid='$ref' and usrid<>'$old_usrid'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//-----------user form akses(saat update)
	function list_usrrgh($id) {
		$dbpdo = DB::create();
		
		$sqlstr = "select usrid from usr where id=$id";
		$hasil_cek = $dbpdo->query($sqlstr);
		$data = $hasil_cek->fetch(PDO::FETCH_OBJ);
		
		$sqlstr = "select aa.* from (select a.id, a.frmcde, b.frmnme, 1 mslc, a.madd, a.medt, a.mdel, a.lvl, 1 old from usr_dtl a left join usr_frm b on a.frmcde=b.frmcde where a.usrid='$data->usrid' union all
		select 0 id, frmcde, frmnme, 0 mslc, 0 madd, 0 medt, 0 mdel, 0 lvl, 0 old from usr_frm where frmcde not in (select frmcde from usr_dtl where usrid='$data->usrid' )) aa order by aa.id desc, aa.frmnme ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data registrasi
	function list_registrasi($ref='', $replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.departemen, a.idproses, a.idkelompok, a.tanggal, a.nopendaftaran, a.idtingkat, a.idjurusan, a.idminat, a.idminat1, a.foto_file, a.nama, a.panggilan, a.kelamin, a.nisn, a.nis, a.noijazah, a.tahunijazah, a.skhun, a.tahunskhun, a.noujian, a.nik, a.tmplahir, a.tgllahir, a.agama, a.kebutuhan_khusus_chk, a.kebutuhan_khusus, a.tahunmasuk, a.alamatsiswa, a.dusun, a.rt, a.rw, a.kelurahan, a.kodepossiswa, a.kecamatan, a.kabupaten, a.provinsi, a.transportasi, a.transportasi_kode, a.citacita, a.citacita_lain, a.idjenis_tinggal, a.jenis_tinggal, a.telponsiswa, a.hpsiswa, a.emailsiswa, a.kps, a.nokps, a.nokip, a.nokks, a.namaayah, a.tahunayah, a.alamatortu, a.kodeposortu, a.hportu, a.butuhkhususayah, a.butuhkhususketayah, a.pekerjaanayah, a.pekerjaanayah_lain, a.pendidikanayah, a.penghasilanayah, a.penghasilanayah_kode, a.namaibu, a.tahunibu, a.butuhkhususibu, a.butuhkhususketibu, a.pekerjaanibu, a.pekerjaanibu_lain, a.pendidikanibu, a.penghasilanibu, a.penghasilanibu_kode, a.wali, a.tahunwali, a.pekerjaanwali, a.pekerjaanwali_lain, a.pendidikanwali, a.penghasilanwali, a.tinggi, a.berat, a.jaraksekolah, a.jarak_km, a.waktutempuh, a.waktutempuh_menit, a.jsaudara, a.uid, a.dlu, a.darah, a.file_darah, a.almayah, a.almibu, a.alamatibu, a.kodeposibu, a.hpibu, b.dcr jalur_masuk from calonsiswa a left join 
		(select '1' cde, 'Akademik' dcr, 0 nmr union all 
		select '2' cde, 'Non Akademik' dcr, 1 nmr union all
		select '3' cde, 'Mutasi' dcr, 2 nmr ) b on a.idkelompok=b.cde " . $where . " order by a.replid ";			$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------get data registrasi prestasi
	function list_registrasi_prestasi($idcalonsiswa=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idcalonsiswa != "") {
			if ($where == "") {
				$where = " where a.idcalonsiswa = '$idcalonsiswa' ";
			} else {
				$where = $where . " and a.idcalonsiswa = '$idcalonsiswa' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idcalonsiswa, a.jenisprestasi, a.tingkat, a.nama, a.tahun, a.penyelenggara, a.line from calonsiswa_prestasi a " . $where . " order by a.line ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data registrasi beasiswa
	function list_registrasi_beasiswa($idcalonsiswa=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idcalonsiswa != "") {
			if ($where == "") {
				$where = " where a.idcalonsiswa = '$idcalonsiswa' ";
			} else {
				$where = $where . " and a.idcalonsiswa = '$idcalonsiswa' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idcalonsiswa, a.jenis, a.penyelenggara, a.tahunmulai, a.tahunselesai, a.line from calonsiswa_beasiswa a " . $where . " order by a.line ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	
	//---------check nis siswa
	function list_nissiswa_check($ref='', $idkelas=''){	 
		$dbpdo = DB::create();
		
		if($idkelas == '') { $idkelas = 0; }	
		$sqlstr = "select nis from siswa where nis='$ref' and idkelas=$idkelas ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------check nis siswa update
	function list_nissiswaupdate_check($ref='', $old_nis='', $idkelas=''){	 
		$dbpdo = DB::create();
		
		if($idkelas == '') { $idkelas = 0; }	
		$sqlstr = "select nis from siswa where nis='$ref' and nis<>'$old_nis' and idkelas=$idkelas ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data siswa
	function list_siswa($ref='', $replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.nis = '$ref' ";
			} else {
				$where = $where . " and a.nis = '$ref' ";
			}
		}
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.nis, a.nisn, a.nik, a.idangkatan, a.idangkatan1, a.foto_file, a.nama, a.panggilan, a.idkelas, a.kelamin, a.tmplahir, a.tgllahir, a.agama, a.warga, a.anakke, a.jsaudara, a.jtiri, a.jangkat, a.yatim, a.bahasa, a.desa_kode, a.kecamatan_kode, a.kota_kode, a.provinsi_kode, a.alamatsiswa, a.rt_siswa, a.rw_siswa, a.dusun, a.desa, a.kecamatan, a.kodepossiswa, a.jenistinggal, a.alamatortu, a.telponsiswa, a.hpsiswa, a.emailsiswa, a.kps, a.nokps, a.kip, a.nokip, a.namakip, a.nokks, a.no_akte_lahir, a.telponortu, a.hportu, a.hpibu, a.transportasi_kode, a.transportasi_lain, a.jaraksekolah, a.kesekolah, a.berat, a.tinggi, a.kesehatan, a.darah, a.file_darah, a.kelainan, a.asalsekolah_id, a.kota_asalsekolah, a.tglijazah, a.noijazah, a.tglskhun, a.skhun, a.noujian, a.nisnasal, a.nik_ayah, a.namaayah, a.nik_ibu, a.namaibu, a.tmplahirayah, a.tgllahirayah, a.tempat_bekerja_ayah, a.tmplahiribu, a.tgllahiribu, a.pekerjaanayah, a.pekerjaanibu, a.penghasilanayah_kode, a.penghasilanayah, a.penghasilanibu_kode, a.penghasilanibu, a.tempat_bekerja_ibu, a.pendidikanayah, a.pendidikanibu, a.wnayah, a.wnibu, a.nik_wali, a.wali, a.tmplahirwali, a.tgllahirwali, a.pendidikanwali, a.pekerjaanwali, a.penghasilanwali_kode, a.penghasilanwali, a.tempat_bekerja_wali, a.alamatwali, a.hpwali, a.hubungansiswa, a.pekerjaanayah_lain, a.pekerjaanibu_lain, a.pekerjaanwali_lain, a.rombel_id, a.nama_bank, a.no_rekening_bank, a.nama_pemilik_bank, a.pip, a.alasan_pip, f.virtualaccount, a.uid, a.aktif, a.ts, b.idtingkat, b.kelas, c.tingkat, c.departemen, d.pekerjaan pekerjaan_ayah, e.pekerjaan pekerjaan_ibu, a.idminat, a.file_jalurmasuk, a.jalurmasuk_id, a.jalurmasuk, a.jalurmasukprestasi_id, a.file_rekam_bk, a.file_memo_ortu, a.file_nilai_un, a.file_raport, a.file_kk, a.file_akte, a.file_ijazah, a.file_nhun, a.tahun_ijazah, a.tahunskhun, a.kebutuhan_khusus_chk, a.jenis_tinggal, a.kebutuhan_khusus_chk1, a.kebutuhan_khusus, a.citacita, a.citacita_lain, a.tahunayah, a.kodeposortu, a.butuhkhususketayah, a.tahunibu, a.kodeposibu, a.butuhkhususibu, a.butuhkhususketibu, a.tahunwali, a.jarak_km, a.waktutempuh, a.waktutempuh_menit, a.almayah, a.butuhkhususayah, a.almibu, a.alamatibu, a.tglmasuk, a.idgugus, a.uid2, a.dlu2 from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid left join jenispekerjaan d on a.pekerjaanayah=d.replid left join jenispekerjaan e on a.pekerjaanibu=e.replid left join siswa_virtualaccount f on a.nis=f.nis " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data siswa prestasi
	function list_siswa_prestasi($idsiswa=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idsiswa != "") {
			if ($where == "") {
				$where = " where a.idsiswa = '$idsiswa' ";
			} else {
				$where = $where . " and a.idsiswa = '$idsiswa' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idsiswa, a.jenisprestasi, a.tingkat, a.nama, a.tahun, a.penyelenggara, a.line from siswa_prestasi a " . $where . " order by a.line ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data siswa beasiswa
	function list_siswa_beasiswa($idsiswa=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idsiswa != "") {
			if ($where == "") {
				$where = " where a.idsiswa = '$idsiswa' ";
			} else {
				$where = $where . " and a.idsiswa = '$idsiswa' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idsiswa, a.jenis, a.penyelenggara, a.tahunmulai, a.tahunselesai, a.line from siswa_beasiswa a " . $where . " order by a.line ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data prosespenerimaansiswa
	function list_prosespenerimaansiswa($replid='', $departemen=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}

		if ($departemen != "") {
			if ($where == "") {
				$where = " where a.departemen = '$departemen' ";
			} else {
				$where = $where . " and a.departemen = '$departemen' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.proses, a.kodeawalan, a.departemen, a.aktif, a.keterangan, a.ts from prosespenerimaansiswa a " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data kelompokcalonsiswa
	function list_kelompokcalonsiswa($replid='', $departemen){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}

		if ($departemen != "") {
			if ($where == "") {
				$where = " where b.departemen = '$departemen' ";
			} else {
				$where = $where . " and b.departemen = '$departemen' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.kelompok, a.idproses, a.kapasitas, a.keterangan, a.ts, b.proses nama_proses from kelompokcalonsiswa a left join prosespenerimaansiswa b on a.idproses=b.replid " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data departemen
	function list_departemen($replid=''){
		$dbpdo = DB::create();
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.departemen, a.nipkepsek, a.urutan, a.keterangan, a.aktif, a.info1, a.info2, a.info3, a.ts, b.nama kepalasekolah from departemen a left join pegawai b on a.nipkepsek=b.nip " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data tingkat
	function list_tingkat($replid='', $departemen=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		

		if ($departemen != "") {
			if ($where == "") {
				$where = " where a.departemen = '$departemen' ";
			} else {
				$where = $where . " and a.departemen = '$departemen' ";
			}
		}

		$sqlstr	=	"select a.replid, a.tingkat, a.departemen, a.aktif, a.keterangan, a.urutan, a.tanggal_ttd, a.ts from tingkat a " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data kelas
	function list_kelas($replid='', $idtingkat='', $nipwali='', $departemen=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where a.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and a.idtingkat = '$idtingkat' ";
			}
		}
		
		if ($nipwali != "") {
			if ($where == "") {
				$where = " where a.nipwali = '$nipwali' ";
			} else {
				$where = $where . " and a.nipwali = '$nipwali' ";
			}
		}

		if ($departemen != "") {
			if ($where == "") {
				$where = " where b.departemen = '$departemen' ";
			} else {
				$where = $where . " and b.departemen = '$departemen' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idtahunajaran, a.idtingkat, a.kelas, a.kapasitas, a.nipwali, a.aktif, a.keterangan, a.ttd_file_hd, a.ts, b.tingkat, b.departemen, c.tahunajaran, d.replid idwali, d.nama walikelas from kelas a left join tingkat b on a.idtingkat=b.replid left join tahunajaran c on a.idtahunajaran=c.replid left join pegawai d on a.nipwali=d.nip " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data kelas detail
	function list_kelas_detail($replid=''){
		$dbpdo = DB::create();
		
		$sqlstr	=	"select a.replid, a.idtahunajaran, a.nipwali, a.ttd_file, a.line from kelas_detail a where a.replid='$replid' order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
    
    //---------get data tahunajaran
	function list_tahunajaran($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.tahunajaran, a.departemen, a.tglmulai, a.tglakhir, a.aktif, a.info1, a.info3 ttd_file, a.keterangan, a.ts, b.nama nama_kepsek from tahunajaran a left join pegawai b on a.info1=b.nip " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data agama
	function list_agama($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.agama, a.urutan, a.ts from agama a " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	              
	
	//---------get data tahun buku
	function list_tahunbuku($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.tahunbuku, a.awalan, a.aktif, a.keterangan, a.departemen, a.tanggalmulai, a.ts from tahunbuku a " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data rekakun
	function list_rekakun($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.kode = '$replid' ";
			} else {
				$where = $where . " and a.kode = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.kode, a.kategori, a.nama, a.keterangan, a.ts from rekakun a " . $where . " order by a.kode, a.kategori ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------check rekakun update
	function list_rekakun_check($ref='', $old_kode=''){	 
		$dbpdo = DB::create();
			
		$sqlstr = "select kode from rekakun where kode='$ref' and kode<>'$old_kode'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data datapenerimaan
	function list_datapenerimaan($replid='', $nama='', $departemen='', $idkategori=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama = '$nama' ";
			} else {
				$where = $where . " and a.nama = '$nama' ";
			}
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where a.departemen = '$departemen' ";
			} else {
				$where = $where . " and a.departemen = '$departemen' ";
			}
		}
		
		if ($idkategori != "") {
			if ($where == "") {
				$where = " where a.idkategori = '$idkategori' ";
			} else {
				$where = $where . " and a.idkategori = '$idkategori' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idkategori, a.departemen, a.nama, a.rekkas, a.rekpendapatan, a.rekpiutang, a.keterangan, a.nourut, a.aktif, a.full, a.ts, b.nama namakas, c.nama namapendapatan, d.nama namapiutang, e.kategori from datapenerimaan a left join rekakun b on a.rekkas=b.kode left join rekakun c on a.rekpendapatan=c.kode left join rekakun d on a.rekpiutang=d.kode left join kategoripenerimaan e on a.idkategori=e.kode " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------check nama datapenerimaan update
	function list_datapenerimaan_check($nama='', $departemen='', $idkategori='', $oldnama='', $olddepartemen='', $oldidkategori=''){	 
		$dbpdo = DB::create();
		
		$sqlstr = "select nama from datapenerimaan 
			where nama='$nama' and departemen='$departemen' and idkategori='$idkategori' 
			and nama<>'$oldnama' and departemen<>'$olddepartemen' and idkategori<>'$oldidkategori' ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data datapengeluaran
	function list_datapengeluaran($replid='', $nama='', $departemen=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama = '$nama' ";
			} else {
				$where = $where . " and a.nama = '$nama' ";
			}
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where a.departemen = '$departemen' ";
			} else {
				$where = $where . " and a.departemen = '$departemen' ";
			}
		}
				
		$sqlstr	="select a.replid, a.departemen, a.nama, a.rekdebet, a.rekkredit, a.keterangan, a.aktif, a.ts, b.nama namadebet, c.nama namakredit from datapengeluaran a left join rekakun b on a.rekdebet=b.kode left join rekakun c on a.rekkredit=c.kode " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------check nama datapengeluaran update
	function list_datapengeluaran_check($nama='', $departemen='', $oldnama='', $olddepartemen=''){	 
		$dbpdo = DB::create();
		
		$sqlstr = "select nama from datapengeluaran 
			where nama='$nama' and departemen='$departemen' 
			and nama<>'$oldnama' and departemen<>'$olddepartemen' ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data besarjtt
	function list_besarjtt($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$nis = explode("|", $replid);
											
		if ($nis[1] != "") {
			$where = " where c.nis = '$nis[1]' ";
		}
		
		if($nis[0] == 'NIS') {
			$sqlstr	=	"select '' replid, a.nis, a.idpenerimaan, 0 besar, 0 cicilan, a.lunas, a.keterangan, a.pengguna, a.info1, a.info2, a.info3, a.ts, a.potongan, c.idkelas, c.idangkatan, d.idtingkat, b.idkategori, c.nama namasiswa, d.kelas, e.tingkat from siswa c left join besarjtt a on a.nis=c.nis left join datapenerimaan b on a.idpenerimaan=b.replid left join kelas d on c.idkelas=d.replid left join tingkat e on d.idtingkat=e.replid " . $where . " order by a.nis ";				
		} else {
			$sqlstr	=	"select a.replid, a.nis, a.idpenerimaan, a.besar, a.cicilan, a.lunas, a.keterangan, a.pengguna, a.info1, a.info2, a.info3, a.ts, a.potongan, b.idkategori, c.idkelas, c.idangkatan, d.idtingkat, c.nama namasiswa, d.kelas, e.tingkat, b.departemen from besarjtt a left join datapenerimaan b on a.idpenerimaan=b.replid left join siswa c on a.nis=c.nis left join kelas d on c.idkelas=d.replid left join tingkat e on d.idtingkat=e.replid " . $where . " order by a.nis ";
		}
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data penerimaanjtt
	function list_penerimaanjtt($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr = "select a.replid, a.idbesarjtt, a.tanggal, a.jumlah, c.nis, c.nama namasiswa, d.kelas, e.tingkat, a.keterangan, a.petugas, a.ref, a.idjurnal, a.idjenis_bayar, b.besar, b.idpenerimaan, e.departemen, f.idkategori, ifnull(b.besar,0) - ifnull(a.jumlah,0) sisa, b.info2 tahunbuku from penerimaanjtt a left join besarjtt b on a.idbesarjtt=b.replid left join siswa c on b.nis=c.nis left join kelas d on c.idkelas=d.replid left join tingkat e on d.idtingkat=e.replid left join datapenerimaan f on b.idpenerimaan=f.replid " .$where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data perpustakaan
	function list_perpustakaan($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, b.departemen, a.nama, a.keterangan, a.ts from perpustakaan a left join identitas b on a.nama=b.perpustakaan " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data format
	function list_format($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.kode, a.nama, a.keterangan, a.ts from format a " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data rak
	function list_rak($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.rak, a.keterangan, a.ts from rak a " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data katalog
	function list_katalog($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.kode, a.nama, a.rak, a.keterangan, a.ts, b.rak namarak from katalog a left join rak b on a.rak=b.replid " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data penerbit
	function list_penerbit($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.kode, a.nama, a.alamat, a.telpon, a.email, a.fax, a.website, a.kontak, a.keterangan, a.ts from penerbit a " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data penulis
	function list_penulis($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.kode, a.nama, a.kontak, a.biografi, a.keterangan, a.gelardepan, a.gelarbelakang, a.ts from penulis a " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data pustaka
	function list_pustaka($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.judul, a.abstraksi, a.keyword, a.tahun, a.keteranganfisik, a.penulis, a.penerbit, a.format, a.katalog, a.photo, a.keterangan, a.harga, a.info1, a.info2, a.info3, a.departemen, a.tanggal_masuk, a.keterangan_pustaka, a.ts, b.nama namapenulis, c.nama namapenerbit from pustaka a left join penulis b on a.penulis=b.replid left join penerbit c on a.penerbit=c.replid " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data daftarpustaka
	function list_daftarpustaka($replid='', $departemen=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where b.departemen = '$departemen' ";
			} else {
				$where = $where . " and b.departemen = '$departemen' ";
			}
		}
		
		if($replid=='' && $departemen=='') {
			$where = " where a.replid = 0";
		}
		
		$sqlstr	=	"select a.replid, a.pustaka, a.perpustakaan, a.kodepustaka, a.status, a.ts, b.departemen, b.judul, c.nama namapenulis, d.nama namapenerbit from daftarpustaka a left join pustaka b on a.pustaka=b.replid left join penulis c on b.penulis=c.replid left join penerbit d on b.penerbit=d.replid " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get jumlah alokasi pustaka
	function list_pustaka_alokasi($pustaka_id='', $jml=0){
		$dbpdo = DB::create();
		
		$sqlstr	=	"select count(replid) jumlah from daftarpustaka where pustaka='$pustaka_id' and perpustakaan='1' ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_OBJ);
		$jml = $data->jumlah;
		
		return $jml;
	}
	
	//---------get kodepustaka
	function list_pustaka_kodepustaka($pustaka_id='', $kodepustaka=''){
		$dbpdo = DB::create();
		
		$sqlstr	=	"select replid, kodepustaka from daftarpustaka where pustaka='$pustaka_id' and perpustakaan='1' limit 1 ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_OBJ);
		$kodepustaka = $data->kodepustaka . "~" . $data->replid;
		
		return $kodepustaka;
	}
	
	//---------get data pustaka supplier
	function list_pustaka_supplier($pustaka_id=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($pustaka_id != "") {
			if ($where == "") {
				$where = " where a.pustaka_id = '$pustaka_id' ";
			} else {
				$where = $where . " and a.pustaka_id = '$pustaka_id' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.pustaka_id, a.supplier_id from pustaka_supplier a " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get pinjam pre save
	function list_pinjam_detail_presave($idanggota){
		$dbpdo = DB::create();
		
		$sqlstr	= "select a.replid, a.kodepustaka, a.tglpinjam, a.tglkembali, a.idanggota, a.keterangan, a.status, a.tglditerima, a.petugaspinjam, a.departemen, a.jenis_anggota, a.jenis_anggota, a.ts, c.judul from pinjam a left join daftarpustaka b on a.kodepustaka=b.kodepustaka left join pustaka c on b.pustaka=c.replid where a.idanggota='$idanggota' and a.status=0 order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get daftarpustaka
	function list_getpustaka($kodepustaka){
		$dbpdo = DB::create();
		
		$sqlstr	= "select a.kodepustaka, b.judul from daftarpustaka a left join pustaka b on a.pustaka=b.replid where a.kodepustaka='$kodepustaka' and a.status=1 and a.kodepustaka not in (select kodepustaka from pinjam where (status=0 or status=1)) limit 1";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get pinjam
	function list_pinjam($replid='', $idanggota='', $tglpinjam='', $tglkembali='', $all=''){
		$dbpdo = DB::create();
		
		$where = " where a.status=1 ";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($idanggota != "") {
			if ($where == "") {
				$where = " where a.idanggota = '$idanggota' ";
			} else {
				$where = $where . " and a.idanggota = '$idanggota' ";
			}
		}
		
		if ($tglpinjam != "") {
			$tglpinjam = date("Y-m-d", strtotime($tglpinjam));
			if ($where == "") {
				$where = " where a.tglpinjam = '$tglpinjam' ";
			} else {
				$where = $where . " and a.tglpinjam = '$tglpinjam' ";
			}
		}
		
		if ($tglkembali != "") {
			$tglkembali = date("Y-m-d", strtotime($tglkembali));
			if ($where == "") {
				$where = " where a.tglkembali = '$tglkembali' ";
			} else {
				$where = $where . " and a.tglkembali = '$tglkembali' ";
			}
		}
		
		if ($all != "") {
			$where = " where a.status=1 ";
		}
		
		if($replid=='' && $idanggota=='' && $tglpinjam=='' && $tglkembali=='' && $all=='') {
			$where = " where a.replid = 0 ";
		}
		
		
		$now	= date("Y-m-d");
		$sqlstr	= "select a.replid, a.kodepustaka, a.tglpinjam, a.tglkembali, a.idanggota, a.keterangan, a.status, a.tglditerima, a.petugaspinjam, a.departemen, a.jenis_anggota, a.ts, c.judul, d.nama, datediff('".$now."', a.tglkembali) terlambat from pinjam a left join daftarpustaka b on a.kodepustaka=b.kodepustaka left join pustaka c on b.pustaka=c.replid left join (select nis, nama from siswa union all select nip nis, nama from pegawai) d on a.idanggota=d.nis " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get kembali
	function list_kembali($replid, $kodepustaka){
		$dbpdo = DB::create();
		
		$where = " where a.status=1 ";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($kodepustaka != "") {
			if ($where == "") {
				$where = " where a.kodepustaka = '$kodepustaka' ";
			} else {
				$where = $where . " and a.kodepustaka = '$kodepustaka' ";
			}
		}
		
		if($replid == "" && $kodepustaka == "") {
			$where = " where a.status=5 ";
		}
		
		$now	= date("Y-m-d");
		$sqlstr	= "select a.replid, a.kodepustaka, a.tglpinjam, a.tglkembali, a.idanggota, a.keterangan, a.status, a.tglditerima, a.petugaspinjam, a.departemen, a.jenis_anggota, a.ts, c.judul, d.nama, datediff('".$now."', a.tglkembali) terlambat from pinjam a left join daftarpustaka b on a.kodepustaka=b.kodepustaka left join pustaka c on b.pustaka=c.replid left join (select nis, nama from siswa union all select nip nis, nama from pegawai) d on a.idanggota=d.nis " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	function get_denda() {
		$dbpdo = DB::create();
		
		$sqlstr = "select * from konfigurasi order by ts desc limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_OBJ);
		$denda = $data->denda;
		
		return $denda;
	}
	
	//---------get data konfigurasi
	function list_konfigurasi($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.siswa, a.pegawai, a.other, a.denda, a.ts from konfigurasi a " . $where . " order by a.replid ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data pegawai
	function list_pegawai($replid='', $bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($bagian != "") {
			if ($where == "") {
				$where = " where a.bagian = '$bagian' ";
			} else {
				$where = $where . " and a.bagian = '$bagian' ";
			}
		}
		
		if ($nip != "") {
			if ($where == "") {
				$where = " where a.nip = '$nip' ";
			} else {
				$where = $where . " and a.nip = '$nip' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}
		
		if($all == 1) {
			$where = " where a.replid=0";
		}
		
		$sqlstr	= "select a.replid, a.nip, a.nama, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.jenis_id, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.karpeg, a.no_sertifikasi, a.idjenis_sertifikasi, a.npwp, a.nuptk, a.tmt_cpns, a.unit_cpns, a.no_sk_masuk, a.idstatus_pegawai, a.nik, a.nama_ibu, a.nama_pasangan, a.tempat_lahir_pasangan, a.tanggal_lahir_pasangan, a.tanggal_nikah, a.tempat_nikah, a.pekerjaan_pasangan, a.instansi_pasangan, a.nip_pasangan, a.keluarga_tanggungan, a.usia, a.ajar_lain, a.jumlah_jam_ajar_lain, a.nama_bank, a.unit_bank, a.no_rek, a.nama_pemilik, a.desa, a.kecamatan, a.kode_pos, a.tanggal_pensiun, a.foto_file, a.bagian, b.bagian nama_bagian, a.keterangan, a.no_sk_tetap, a.tanggal_sk_tetap, a.ts from pegawai a left join bagianpegawai b on a.bagian=b.replid " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data statusguru
	function list_statusguru($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.status, a.keterangan, a.ts from statusguru a " . $where . " order by a.replid ";		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data jabatan
	function list_jabatan($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.nama, a.aktif, a.uid, a.dlu from jabatan a " . $where . " order by a.replid ";		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data jenis pelanggaran
	function list_jenis_pelanggaran($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.nama, a.poin, a.aktif, a.uid, a.dlu from jenis_pelanggaran a " . $where . " order by a.replid ";		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data jenis prestasi
	function list_jenis_prestasi($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.nama, a.poin, a.aktif, a.uid, a.dlu from jenis_prestasi a " . $where . " order by a.replid ";		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pelanggaran_siswa
	function list_pelanggaran_siswa($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.ref = '$ref' ";
			} else {
				$where = $where . " and a.ref = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.ref, a.tanggal, a.idsiswa, a.idjenis_pelanggaran, a.kejadian, a.hukuman, a.photo, a.uid, a.dlu, b.nis, b.nama, b.idkelas, c.kelas, c.idtingkat, d.tingkat from pelanggaran_siswa a left join siswa b on a.idsiswa=b.replid left join kelas c on b.idkelas=c.replid left join tingkat d on c.idtingkat=d.replid " . $where . " order by a.ref ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data konseling_siswa
	function list_konseling_siswa($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.ref = '$ref' ";
			} else {
				$where = $where . " and a.ref = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.ref, a.tanggal, a.idsiswa, a.idjenis_konseling, a.konseling, a.solusi, a.nip, a.data_file, a.uid, a.dlu, b.nis, b.nama, b.idkelas, c.kelas, c.idtingkat, d.tingkat, d.departemen from konseling_siswa a left join siswa b on a.idsiswa=b.replid left join kelas c on b.idkelas=c.replid left join tingkat d on c.idtingkat=d.replid " . $where . " order by a.ref ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai jabatan
	function list_pegawai_jabatan($replid='', $bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($bagian != "") {
			if ($where == "") {
				$where = " where a.bagian = '$bagian' ";
			} else {
				$where = $where . " and a.bagian = '$bagian' ";
			}
		}
		
		if ($nip != "") {
			if ($where == "") {
				$where = " where a.nip = '$nip' ";
			} else {
				$where = $where . " and a.nip = '$nip' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}
		
		if($all == 1) {
			$where = " where b.replid=0";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai jabatan 
	function list_get_pegawai_jabatan($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.idjabatan, a.tanggal_efektif, a.keterangan, a.uid, a.dlu from pegawai_jabatan a " . $where . " order by a.tanggal_efektif desc limit 1 ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai jabatan detail
	function list_get_pegawai_jabatan_detail($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.idjabatan, a.tanggal_efektif, a.keterangan, a.uid, a.dlu, b.nama jabatan from pegawai_jabatan a left join jabatan b on a.idjabatan=b.replid " . $where . " order by a.tanggal_efektif desc ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
    
    //---------get data jenis izin
	function list_jenis_izin($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.nama, a.keterangan, a.format_surat, a.aktif, a.uid, a.dlu from jenis_izin a " . $where . " order by a.replid ";		
        $sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
    
    //---------get data izin siswa
	function list_izin_siswa($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.tanggal, a.idsiswa, a.idjenis_izin, a.format_surat, a.keterangan, a.idpegawai, a.status, a.uid, a.dlu, b.nis, b.nama nama_siswa, b.idkelas, c.kelas, c.idtingkat, d.tingkat, e.nama nama_pegawai from izin_siswa a left join siswa b on a.idsiswa=b.replid left join kelas c on b.idkelas=c.replid left join tingkat d on c.idtingkat=d.replid left join pegawai e on a.idpegawai=e.replid " . $where . " order by a.replid ";		
        $sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
    
	
	//---------get data pangkat
	function list_pangkat($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.nama, a.aktif, a.uid, a.dlu from pangkat a " . $where . " order by a.replid ";		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai pangkat
	function list_pegawai_pangkat($replid='', $bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($bagian != "") {
			if ($where == "") {
				$where = " where a.bagian = '$bagian' ";
			} else {
				$where = $where . " and a.bagian = '$bagian' ";
			}
		}
		
		if ($nip != "") {
			if ($where == "") {
				$where = " where a.nip = '$nip' ";
			} else {
				$where = $where . " and a.nip = '$nip' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}
		
		if($all == 1) {
			$where = " where b.replid=0";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai pangkat 
	function list_get_pegawai_pangkat($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.idpangkat, a.tanggal_efektif, a.ruang, a.sk, a.no_sk, a.gaji_pokok, a.tanggal_sk, a.idjabatan, a.keterangan, a.uid, a.dlu from pegawai_pangkat a " . $where . " order by a.tanggal_efektif desc limit 1 ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai pangkat detail
	function list_get_pegawai_pangkat_detail($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.idpangkat, a.tanggal_efektif, a.ruang, a.sk, a.no_sk, a.gaji_pokok, a.tanggal_sk, a.idjabatan, a.keterangan, a.uid, a.dlu, b.nama pangkat, c.nama jabatan from pegawai_pangkat a left join pangkat b on a.idpangkat=b.replid left join jabatan c on a.idjabatan=c.replid " . $where . " order by a.tanggal_efektif desc ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data jenis sertifikasi
	function list_jenis_sertifikasi($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.nama, a.aktif, a.uid, a.dlu from jenis_sertifikasi a " . $where . " order by a.replid ";		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data status pegawai
	function list_status_pegawai($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.nama, a.aktif, a.uid, a.dlu from status_pegawai a " . $where . " order by a.replid ";		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai kenaikan gaji berkala
	function list_kenaikan_gaji($replid='', $bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($bagian != "") {
			if ($where == "") {
				$where = " where a.bagian = '$bagian' ";
			} else {
				$where = $where . " and a.bagian = '$bagian' ";
			}
		}
		
		if ($nip != "") {
			if ($where == "") {
				$where = " where a.nip = '$nip' ";
			} else {
				$where = $where . " and a.nip = '$nip' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}
		
		if($all == 1) {
			$where = " where b.replid=0";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai kenaikan gaji berkala 
	function list_get_kenaikan_gaji($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.no_kgb, a.tmt, a.tanggal_kgb, a.gaji_pokok, a.keterangan, a.uid, a.dlu from kenaikan_gaji a " . $where . " order by a.tanggal_kgb desc limit 1 ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai kenaikan gaji detail
	function list_get_kenaikan_gaji_detail($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.no_kgb, a.gaji_pokok, a.tmt, a.tanggal_kgb, a.keterangan, a.uid, a.dlu from kenaikan_gaji a  " . $where . " order by a.tmt desc ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai pendidikan
	function list_pegawai_pendidikan($replid='', $bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($bagian != "") {
			if ($where == "") {
				$where = " where a.bagian = '$bagian' ";
			} else {
				$where = $where . " and a.bagian = '$bagian' ";
			}
		}
		
		if ($nip != "") {
			if ($where == "") {
				$where = " where a.nip = '$nip' ";
			} else {
				$where = $where . " and a.nip = '$nip' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}
		
		if($all == 1) {
			$where = " where b.replid=0";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai pendidikan get
	function list_get_pegawai_pendidikan($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.nama_sekolah, a.tahun, a.jenjang, a.lulusan, a.jurusan, a.keterangan, a.uid, a.dlu from pegawai_pendidikan a " . $where . " order by a.replid desc limit 1 ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai pendidikan detail
	function list_get_pegawai_pendidikan_detail($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.nama_sekolah, a.tahun, a.jenjang, a.lulusan, a.jurusan, a.keterangan, a.uid, a.dlu from pegawai_pendidikan a  " . $where . " order by a.replid desc ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//===============
	//---------get data pegawai keluarga
	function list_pegawai_keluarga($replid='', $bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($bagian != "") {
			if ($where == "") {
				$where = " where a.bagian = '$bagian' ";
			} else {
				$where = $where . " and a.bagian = '$bagian' ";
			}
		}
		
		if ($nip != "") {
			if ($where == "") {
				$where = " where a.nip = '$nip' ";
			} else {
				$where = $where . " and a.nip = '$nip' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}
		
		if($all == 1) {
			$where = " where b.replid=0";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai keluarga get
	function list_get_pegawai_keluarga($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.nama_anak, a.tempat_lahir, a.tanggal_lahir, a.pekerjaan, a.status, a.anak_ke, a.keterangan, a.uid, a.dlu from pegawai_keluarga a " . $where . " order by a.replid desc limit 1 ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai keluarga detail
	function list_get_pegawai_keluarga_detail($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.nama_anak, a.tempat_lahir, a.tanggal_lahir, a.pekerjaan, a.status, a.anak_ke, a.keterangan, a.uid, a.dlu from pegawai_keluarga a  " . $where . " order by a.anak_ke ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data supplier
	function list_supplier($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.kode, a.nama, a.alamat, a.telepon, a.hp, a.aktif, a.uid, a.dlu from supplier a  " . $where . " order by a.replid ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai prestasi
	function list_pegawai_prestasi($replid='', $bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($bagian != "") {
			if ($where == "") {
				$where = " where a.bagian = '$bagian' ";
			} else {
				$where = $where . " and a.bagian = '$bagian' ";
			}
		}
		
		if ($nip != "") {
			if ($where == "") {
				$where = " where a.nip = '$nip' ";
			} else {
				$where = $where . " and a.nip = '$nip' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}
		
		if($all == 1) {
			$where = " where b.replid=0";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama namapeg, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai prestasi get
	function list_get_pegawai_prestasi($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.jenisprestasi, a.tingkat, a.nama, a.tahun, a.penyelenggara, a.uid, a.dlu from pegawai_prestasi a " . $where . " order by a.replid desc limit 1 ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai prestasi detail
	function list_get_pegawai_prestasi_detail($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.jenisprestasi, a.tingkat, a.nama, a.tahun, a.penyelenggara, a.uid, a.dlu from pegawai_prestasi a  " . $where . " order by a.nama ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai penghargaan
	function list_pegawai_penghargaan($replid='', $bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($bagian != "") {
			if ($where == "") {
				$where = " where a.bagian = '$bagian' ";
			} else {
				$where = $where . " and a.bagian = '$bagian' ";
			}
		}
		
		if ($nip != "") {
			if ($where == "") {
				$where = " where a.nip = '$nip' ";
			} else {
				$where = $where . " and a.nip = '$nip' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}
		
		if($all == 1) {
			$where = " where b.replid=0";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama namapeg, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai penghargaan get
	function list_get_pegawai_penghargaan($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.namapenghargaan, a.tahun, a.pemberipenghargaan, a.uid, a.dlu from pegawai_penghargaan a " . $where . " order by a.replid desc limit 1 ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai penghargaan detail
	function list_get_pegawai_penghargaan_detail($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.namapenghargaan, a.tahun, a.pemberipenghargaan, a.uid, a.dlu from pegawai_penghargaan a  " . $where . " order by a.namapenghargaan ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai sk mengajar
	function list_pegawai_skmengajar($replid='', $bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($bagian != "") {
			if ($where == "") {
				$where = " where a.bagian = '$bagian' ";
			} else {
				$where = $where . " and a.bagian = '$bagian' ";
			}
		}
		
		if ($nip != "") {
			if ($where == "") {
				$where = " where a.nip = '$nip' ";
			} else {
				$where = $where . " and a.nip = '$nip' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}
		
		if($all == 1) {
			$where = " where b.replid=0";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama namapeg, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai skmengajar get
	function list_get_pegawai_skmengajar($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.no_sk, a.tahun, a.fungsional, a.uid, a.dlu from pegawai_skmengajar a " . $where . " order by a.replid desc limit 1 ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai skmengajar detail
	function list_get_pegawai_skmengajar_detail($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.no_sk, a.tahun, a.fungsional, a.uid, a.dlu from pegawai_skmengajar a  " . $where . " order by a.no_sk ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pelajaran
	function list_pelajaran($replid='', $sifat='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($sifat != "") {
			if ($where == "") {
				$where = " where a.sifat = '$sifat' ";
			} else {
				$where = $where . " and a.sifat = '$sifat' ";
			}
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr	=	"select a.replid, a.kode, a.nama, a.departemen, a.sifat, a.ekstra_sifat, a.pegawai_id, a.aktif, a.keterangan, a.info1, a.info2, a.info3, a.alias, a.idpelajaran_alias, a.minat, a.bentrok, b.nama nama_alias, a.token, a.ts from pelajaran a left join pelajaran b on a.idpelajaran_alias=b.replid  " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data siswa ekstrakurikuler
	function list_siswa_ekstrakurikuler($replid='', $unit='', $nis='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where d.replid = '$replid' ";
			} else {
				$where = $where . " and d.replid = '$replid' ";
			}
		}
		
		if ($unit != "") {
			if ($where == "") {
				$where = " where c.departemen = '$unit' ";
			} else {
				$where = $where . " and c.departemen = '$unit' ";
			}
		}
		
		if ($nis != "") {
			if ($where == "") {
				$where = " where a.nis = '$nis' ";
			} else {
				$where = $where . " and a.nis = '$nis' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}
		
		if($all == 1) {
			$where = " where b.replid=0";
		}
		
		$sqlstr	=	"select a.replid, d.idsiswa, a.nama, b.kelas, c.tingkat, c.departemen from siswa_ekstrakurikuler d left join siswa a on d.idsiswa=a.replid left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid " . $where . " order by d.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data siswa ekstrakurikuler get
	function list_get_siswa_ekstrakurikuler($idsiswa='', $ekstra_sifat=''){
		$dbpdo = DB::create();
		
		if($_SESSION["tipe_user"] == "Guru") {
			
			$sqleks="select idpelajaran from guru where nip='$_SESSION[idpegawai]'";
			$sql=$dbpdo->prepare($sqleks);
			$sql->execute();
			$strextra = "";
			while($dataeks=$sql->fetch(PDO::FETCH_OBJ)) {
				if($strextra == "") {
					$strextra = $dataeks->idpelajaran;
				} else {
					$strextra = $strextra.",".$dataeks->idpelajaran;
				}
			}
			//$strextra = "(".$strextra.")";
			//--------------
			
			if($strextra != "") {
				$where = " where aa.pelajaran_id in (".$strextra.")";
			}
			
			if($_SESSION['adm'] == 1) {
				$where = "";
			}
			
			if ($ekstra_sifat != "") {
				if ($where == "") {
					$where = " where ifnull(aa.ekstra_sifat,0) = '$ekstra_sifat' ";
				} else {
					$where = $where . " and ifnull(aa.ekstra_sifat,0) = '$ekstra_sifat' ";
				}
			}
			
			$sqlstr	=	"select aa.* from (select a.replid, a.idsiswa, a.idpelajaran pelajaran_id, b.nama, b.ekstra_sifat, 1 urutan from siswa_ekstrakurikuler a left join pelajaran b on a.idpelajaran=b.replid where a.idsiswa='$idsiswa'
			union all
			select '' replid, 0 idsiswa, a.replid pelajaran_id, a.nama, a.ekstra_sifat, 0 urutan from pelajaran a where a.replid not in (select x.idpelajaran from siswa_ekstrakurikuler x where x.idsiswa='$idsiswa') and ifnull(a.sifat,0)=0 ) aa ".$where."order by aa.ekstra_sifat, aa.pelajaran_id ";	
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		} else {
		
			$where = "";
			
			if ($ekstra_sifat != "") {
				if ($where == "") {
					$where = " where ifnull(aa.ekstra_sifat,0) = '$ekstra_sifat' ";
				} else {
					$where = $where . " and ifnull(aa.ekstra_sifat,0) = '$ekstra_sifat' ";
				}
			}
			
			$sqlstr	=	"select aa.* from (select a.replid, a.idsiswa, a.idpelajaran pelajaran_id, b.nama, b.ekstra_sifat, 1 urutan from siswa_ekstrakurikuler a left join pelajaran b on a.idpelajaran=b.replid where a.idsiswa='$idsiswa'
			union all
			select '' replid, 0 idsiswa, a.replid pelajaran_id, a.nama, a.ekstra_sifat, 0 urutan from pelajaran a where a.replid not in (select x.idpelajaran from siswa_ekstrakurikuler x where x.idsiswa='$idsiswa') and ifnull(a.sifat,0)=0 ) aa ".$where."order by aa.ekstra_sifat, aa.pelajaran_id ";		
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		return $sql;
	}
	
	
	//---------get data siswa ekstrakurikuler detail
	function list_get_siswa_ekstrakurikuler_detail($idsiswa=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idsiswa != "") {
			if ($where == "") {
				$where = " where a.idsiswa = '$idsiswa' ";
			} else {
				$where = $where . " and a.idsiswa = '$idsiswa' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idsiswa, a.idpelajaran, a.tanggal, a.uid, a.dlu, b.nama nama_ekskul from siswa_ekstrakurikuler a left join pelajaran b on a.idpelajaran=b.replid  " . $where . " order by a.idpelajaran ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data semester
	function list_semester($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.semester, a.departemen, a.keterangan, a.tanggal_ttd, a.aktif, a.ts from semester a " . $where . " order by a.departemen, a.semester ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data angkatan
	function list_angkatan($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.angkatan, a.departemen, a.aktif, a.ts from angkatan a " . $where . " order by a.departemen, a.angkatan ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data rpp
	function list_rpp($ref='', $idtingkat='', $idpelajaran='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where a.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and a.idtingkat = '$idtingkat' ";
			}
		}
		
		if ($idpelajaran != "") {
			if ($where == "") {
				$where = " where a.idpelajaran = '$idpelajaran' ";
			} else {
				$where = $where . " and a.idpelajaran = '$idpelajaran' ";
			}
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr	=	"select a.replid, a.idtingkat, a.idsemester, a.idpelajaran, a.idguru, a.koderpp, a.rpp, a.deskripsi, a.info3, a.jumlah_ukbm, a.minimum_hadir, a.aktif, a.ts, b.tingkat, b.departemen, c.nama pelajaran, d.semester from rpp a left join tingkat b on a.idtingkat=b.replid left join pelajaran c on a.idpelajaran=c.replid left join semester d on a.idsemester=d.replid " . $where . " order by b.departemen, c.nama ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data dasarpenilaian
	function list_dasarpenilaian($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.dasarpenilaian, a.keterangan, a.ts from dasarpenilaian a " . $where . " order by a.replid ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data kompetensi
	function list_kompetensi($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.kode, a.kompetensi, a.aktif, a.dlu from kompetensi a " . $where . " order by a.replid ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data jenis kompetensi
	function list_jeniskompetensi($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.jeniskompetensi, a.aktif, a.dlu from jeniskompetensi a " . $where . " order by a.replid ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data daftar nilai (pelajaran)
	function list_daftarnilai_pelajaran($replid='', $departemen='', $all=0){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where a.departemen = '$departemen' ";
			} else {
				$where = $where . " and a.departemen = '$departemen' ";
			}
		}
		
		if($all == 1) {
			$where = "";
		}
		
		if($replid == "" && $departemen == "" && $all == 0) {
			$where = " where a.departemen = 'xxx' ";
		}
		
		$sqlstr	=	"select a.replid, a.kode, a.nama, a.departemen, a.sifat, a.aktif, a.keterangan, a.info3, a.ts from pelajaran a " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data aspek_perkembangan
	function list_aspek_perkembangan($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.aspek, a.aktif, a.uid, a.dlu from aspek_perkembangan a " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data aspek_psikologi
	function list_aspek_psikologi($ref='', $departemen=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where a.departemen = '$departemen' ";
			} else {
				$where = $where . " and a.departemen = '$departemen' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.departemen, a.aspek, a.aktif, a.uid, a.dlu from aspek_psikologi a " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data aspek_psikologi_detail
	function list_aspek_psikologi_detail($ref='', $jenis_aspek_id=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		if ($jenis_aspek_id != "") {
			if ($where == "") {
				$where = " where a.jenis_aspek_id = '$jenis_aspek_id' ";
			} else {
				$where = $where . " and a.jenis_aspek_id = '$jenis_aspek_id' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.departemen, a.jenis_aspek_id, a.aspek, a.aktif, a.uid, a.dlu, b.aspek jenis_aspek from aspek_psikologi_detail a left join aspek_psikologi b on a.jenis_aspek_id=b.replid " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data assesmen_observasi
	function list_assesmen_observasi($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.ref = '$ref' ";
			} else {
				$where = $where . " and a.ref = '$ref' ";
			}
		}
				
		$sqlstr	=	"select a.ref, a.tanggal, a.idsiswa, a.idpegawai, a.idpegawai1, a.data_file, b.nis, b.nama nama_siswa, b.panggilan, b.tmplahir, b.tgllahir, b.alamatsiswa, b.anakke, b.namaayah, b.pekerjaanayah, b.namaibu, b.pekerjaanibu, a.uid, a.dlu, c.nip, c.nama pegawai, d.nip nip1, d.nama pegawai1, f.departemen, e.idtingkat, b.idkelas, g.pekerjaan pekerjaan_ayah, h.pekerjaan pekerjaan_ibu, e.kelas, f.tingkat from assesmen_observasi a left join siswa b on a.idsiswa=b.replid left join pegawai c on a.idpegawai=c.replid left join pegawai d on a.idpegawai1=d.replid left join kelas e on b.idkelas=e.replid left join tingkat f on e.idtingkat=f.replid left join jenispekerjaan g on b.pekerjaanayah=g.replid left join jenispekerjaan h on b.pekerjaanibu=h.replid " . $where . " order by a.ref ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data list_assesmen_observasi_detail
	function list_assesmen_observasi_detail($ref='', $idaspek_perkembangan=''){
		$dbpdo = DB::create();
		
		$sqlstr	=	"select a.ref, a.idaspek_perkembangan, a.hasil, a.saran, a.line from assesmen_observasi_detail a where a.ref='$ref' and idaspek_perkembangan='$idaspek_perkembangan' order by a.line ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data anggota
	function list_anggota($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
				
		$sqlstr	=	"select a.replid, a.noregistrasi, a.nama, a.alamat, a.kodepos, a.email, a.telpon, a.HP, a.pekerjaan, a.institusi, a.keterangan, a.tgldaftar, a.aktif, a.foto, a.ts from anggota a " . $where . " order by a.nama ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//-----------user reminder
	function list_usr_reminder($usrid='') {
		$dbpdo = DB::create();
		
		$sqlstr = "select aa.* from (select a.reminder_id, b.nama, 1 rmd_old, a.line from usr_reminder a left join usr_list_reminder b on a.reminder_id=b.replid where a.usrid='$usrid' union all
		select a.replid reminder_id, a.nama, 0 rmd_old, 0 line from usr_list_reminder a where a.replid not in (select reminder_id from usr_reminder where usrid='$usrid' )) aa order by aa.rmd_old desc, aa.reminder_id ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data evaluasi_psikologi
	function list_evaluasi_psikologi($ref='', $departemen='', $nis='', $idsemester=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.ref = '$ref' ";
			} else {
				$where = $where . " and a.ref = '$ref' ";
			}
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where a.departemen = '$departemen' ";
			} else {
				$where = $where . " and a.departemen = '$departemen' ";
			}
		}
		
		if ($nis != "") {
			if ($where == "") {
				$where = " where a.nis = '$nis' ";
			} else {
				$where = $where . " and a.nis = '$nis' ";
			}
		}
		
		if ($idsemester != "") {
			if ($where == "") {
				$where = " where a.idsemester = '$idsemester' ";
			} else {
				$where = $where . " and a.idsemester = '$idsemester' ";
			}
		}
				
		$sqlstr	=	"select a.ref, a.tanggal, a.departemen, a.idtingkat, a.idkelas, a.nis, a.idpegawai, a.idsemester, a.uid, a.dlu, b.nama nama_siswa, c.kelas, d.tingkat, e.semester nama_semester from evaluasi_psikologi a left join siswa b on a.nis=b.nis left join kelas c on b.idkelas=c.replid left join tingkat d on c.idtingkat=d.replid left join semester e on a.idsemester=e.replid " . $where . " order by a.ref ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data evaluasi_psikologi_level
	/*function list_evaluasi_psikologi_level($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.ref = '$ref' ";
			} else {
				$where = $where . " and a.ref = '$ref' ";
			}
		}
				
		$sqlstr	=	"select distinct a.level from evaluasi_psikologi_detail a " . $where . " order by a.level ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}*/
	
	
	//---------get data evaluasi_psikologi_IQ
	function list_evaluasi_psikologi_iq($ref='', $departemen='', $idtingkat='', $idkelas='', $nis='', $idsemester=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.ref = '$ref' ";
			} else {
				$where = $where . " and a.ref = '$ref' ";
			}
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where b.departemen = '$departemen' ";
			} else {
				$where = $where . " and b.departemen = '$departemen' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where b.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and b.idtingkat = '$idtingkat' ";
			}
		}
		
		if ($idkelas != "") {
			if ($where == "") {
				$where = " where b.idkelas = '$idkelas' ";
			} else {
				$where = $where . " and b.idkelas = '$idkelas' ";
			}
		}
		
		if ($nis != "") {
			if ($where == "") {
				$where = " where b.nis = '$nis' ";
			} else {
				$where = $where . " and b.nis = '$nis' ";
			}
		}
		
		if ($idsemester != "") {
			if ($where == "") {
				$where = " where b.idsemester = '$idsemester' ";
			} else {
				$where = $where . " and b.idsemester = '$idsemester' ";
			}
		}
				
		$sqlstr	=	"select a.ref, a.iq, b.tanggal, a.jenis_aspek_id, a.aspek_psikologi_id from evaluasi_psikologi_detail a left join evaluasi_psikologi b on a.ref=b.ref " . $where . " order by a.ref ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data evaluasi_psikologi_nilai
	function list_evaluasi_psikologi_nilai($ref='', $jenis_aspek_id='', $aspek_psikologi_id='', $departemen='', $idtingkat='', $idkelas='',  $nis='', $idsemester=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.ref = '$ref' ";
			} else {
				$where = $where . " and a.ref = '$ref' ";
			}
		}
		
		
		if ($jenis_aspek_id != "") {
			if ($where == "") {
				$where = " where a.jenis_aspek_id = '$jenis_aspek_id' ";
			} else {
				$where = $where . " and a.jenis_aspek_id = '$jenis_aspek_id' ";
			}
		}
		
		if ($aspek_psikologi_id != "") {
			if ($where == "") {
				$where = " where a.aspek_psikologi_id = '$aspek_psikologi_id' ";
			} else {
				$where = $where . " and a.aspek_psikologi_id = '$aspek_psikologi_id' ";
			}
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where b.departemen = '$departemen' ";
			} else {
				$where = $where . " and b.departemen = '$departemen' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where b.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and b.idtingkat = '$idtingkat' ";
			}
		}
		
		if ($idkelas != "") {
			if ($where == "") {
				$where = " where b.idkelas = '$idkelas' ";
			} else {
				$where = $where . " and b.idkelas = '$idkelas' ";
			}
		}
		
		if ($nis != "") {
			if ($where == "") {
				$where = " where b.nis = '$nis' ";
			} else {
				$where = $where . " and b.nis = '$nis' ";
			}
		}
		
		if ($idsemester != "") {
			if ($where == "") {
				$where = " where b.idsemester = '$idsemester' ";
			} else {
				$where = $where . " and b.idsemester = '$idsemester' ";
			}
		}
				
		$sqlstr	=	"select a.nilai, a.line from evaluasi_psikologi_detail a left join evaluasi_psikologi b on a.ref=b.ref " . $where . " order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data evaluasi_psikologi_total_nilai
	function list_evaluasi_psikologi_totalnilai($jenis_aspek_id='', $aspek_psikologi_id='', $departemen='', $idtingkat='', $idkelas='',  $idsemester=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($jenis_aspek_id != "") {
			if ($where == "") {
				$where = " having a.jenis_aspek_id = '$jenis_aspek_id' ";
			} else {
				$where = $where . " and a.jenis_aspek_id = '$jenis_aspek_id' ";
			}
		}
		
		if ($aspek_psikologi_id != "") {
			if ($where == "") {
				$where = " having a.aspek_psikologi_id = '$aspek_psikologi_id' ";
			} else {
				$where = $where . " and a.aspek_psikologi_id = '$aspek_psikologi_id' ";
			}
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " having b.departemen = '$departemen' ";
			} else {
				$where = $where . " and b.departemen = '$departemen' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " having b.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and b.idtingkat = '$idtingkat' ";
			}
		}
		
		if ($idkelas != "") {
			if ($where == "") {
				$where = " having b.idkelas = '$idkelas' ";
			} else {
				$where = $where . " and b.idkelas = '$idkelas' ";
			}
		}
		
		
		if ($idsemester != "") {
			if ($where == "") {
				$where = " where b.idsemester = '$idsemester' ";
			} else {
				$where = $where . " and b.idsemester = '$idsemester' ";
			}
		}
				
		$sqlstr	=	"select sum(a.nilai) totalnilai, a.jenis_aspek_id, a.aspek_psikologi_id, b.departemen, b.idtingkat, b.idkelas, b.idsemester from evaluasi_psikologi_detail a left join evaluasi_psikologi b on a.ref=b.ref group by a.jenis_aspek_id, a.aspek_psikologi_id, b.departemen, b.idtingkat, b.idkelas, b.idsemester  " . $where ;
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	
	//---------get data evaluasi_psikologi_per siswa
	function list_evaluasi_psikologi_persiswa($nis='', $departemen='', $idtingkat='', $idkelas='',  $idsemester=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($nis != "") {
			if ($where == "") {
				$where = " having a.nis = '$nis' ";
			} else {
				$where = $where . " and a.nis = '$nis' ";
			}
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " having a.departemen = '$departemen' ";
			} else {
				$where = $where . " and a.departemen = '$departemen' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " having a.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and a.idtingkat = '$idtingkat' ";
			}
		}
		
		if ($idkelas != "") {
			if ($where == "") {
				$where = " having a.idkelas = '$idkelas' ";
			} else {
				$where = $where . " and a.idkelas = '$idkelas' ";
			}
		}
		
		
		if ($idsemester != "") {
			if ($where == "") {
				$where = " where a.idsemester = '$idsemester' ";
			} else {
				$where = $where . " and a.idsemester = '$idsemester' ";
			}
		}
				
		$sqlstr	=	"select a.nis, b.nama nama_siswa, a.departemen, c.kelas, d.tingkat from evaluasi_psikologi a left join siswa b on a.nis=b.nis left join kelas c on a.idkelas=c.replid left join tingkat d on a.idtingkat=d.replid " . $where ;
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pelajaran_un_minat
	function list_pelajaran_un_minat($replid='', $departemen=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}

		if ($departemen != "") {
			if ($where == "") {
				$where = " where a.departemen = '$departemen' ";
			} else {
				$where = $where . " and a.departemen = '$departemen' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.pelajaran_id, a.departemen, a.urutan, a.uid, a.dlu, b.nama from pelajaran_un_minat a left join pelajaran b on a.pelajaran_id=b.replid " . $where . " order by a.urutan ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data siswa nilai un
	function list_siswa_nilai_un($nis='', $id=''){
		$dbpdo = DB::create();
		
		/*$where = "";
		
		if ($nis != "") {
			if ($where == "") {
				$where = " where a.nis = '$nis' ";
			} else {
				$where = $where . " and a.nis = '$nis' ";
			}
		}*/
		
		if($nis != "") {
			$sqlstr	=	"select aa.* from (select a.nis, a.pelajaran_id replid, c.nama, a.nilai, 0 urutan from siswa_nilai_un a left join pelajaran_un_minat b on a.pelajaran_id=b.replid left join pelajaran c on b.pelajaran_id=c.replid where a.nis='$nis'
			union all
			select a.replid nis, a.replid, b.nama, '' nilai, 1 urutan from pelajaran_un_minat a left join pelajaran b on a.pelajaran_id=b.replid where a.replid not in (select x.pelajaran_id from siswa_nilai_un x where x.nis='$nis')) aa order by aa.urutan";	
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		} else {
			$sqlstr	=	"select aa.* from (select a.nis, a.pelajaran_id replid, c.nama, a.nilai, 0 urutan from siswa_nilai_un a left join pelajaran_un_minat b on a.pelajaran_id=b.replid left join pelajaran c on b.pelajaran_id=c.replid where a.nis='$id'
			union all
			select a.replid nis, a.replid, b.nama, '' nilai, 1 urutan from pelajaran_un_minat a left join pelajaran b on a.pelajaran_id=b.replid where a.replid not in (select x.pelajaran_id from siswa_nilai_un x where x.nis='$id')) aa order by aa.urutan";	
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		
		
		return $sql;
	}
	
	//---------get data siswa raport
	function list_siswa_raprt($nis='', $semester='', $id='', $mapel_id=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($mapel_id != "") {
			if ($where == "") {
				$where = " where aa.replid = '$mapel_id' ";
			} else {
				$where = $where . " and aa.replid = '$mapel_id' ";
			}
		}
		
		/*if ($semester != "") {
			if ($where == "") {
				$where = " where a.semester = '$semester' ";
			} else {
				$where = $where . " and a.semester = '$semester' ";
			}
		}*/
		
		if($nis != "") {
			$sqlstr	=	"select aa.* from (select a.nis, a.pelajaran_id replid, c.nama, ifnull(a.nilai,0) nilai, 0 urutan from siswa_nilai_raport a left join pelajaran_raport_minat b on a.pelajaran_id=b.replid left join pelajaran c on b.pelajaran_id=c.replid where a.nis='$nis' and a.semester='$semester'
			union all
			select a.replid nis, a.replid,  b.nama, '' nilai, 1 urutan from pelajaran_raport_minat a left join pelajaran b on a.pelajaran_id=b.replid where a.replid not in (select x.pelajaran_id from siswa_nilai_raport x where x.nis='$nis' and x.semester='$semester')) aa ".$where." order by aa.urutan ";	
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();			
		} else {
			$sqlstr	=	"select aa.* from (select a.nis, a.pelajaran_id replid, c.nama, ifnull(a.nilai,0) nilai, 0 urutan from siswa_nilai_raport a left join pelajaran_raport_minat b on a.pelajaran_id=b.replid left join pelajaran c on b.pelajaran_id=c.replid where a.nis='$id' and a.semester='$semester'
			union all
			select a.replid nis, a.replid,  b.nama, '0' nilai, 1 urutan from pelajaran_raport_minat a left join pelajaran b on a.pelajaran_id=b.replid where a.replid not in (select x.pelajaran_id from siswa_nilai_raport x where x.nis='$id' and x.semester='$semester')) aa ".$where." order by aa.urutan ";	
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		} 
		
		//$sqlstr	=	"select a.replid, a.pelajaran_id, a.departemen, a.urutan, a.uid, a.dlu, b.nama from pelajaran_raport_minat a left join pelajaran b on a.pelajaran_id=b.replid " . $where . " order by a.urutan ";	
		
		//$sqlstr	=	"select aa.* from (select a.nis, a.pelajaran_id replid, c.nama, a.nilai, 0 urutan from siswa_nilai_un a left join pelajaran_un_minat b on a.pelajaran_id=b.replid left join pelajaran c on b.pelajaran_id=c.replid where a.nis='$nis'
		//union all
		//select a.replid nis, a.replid, b.nama, '' nilai, 1 urutan from pelajaran_un_minat a left join pelajaran b on a.pelajaran_id=b.replid where a.replid not in (select x.pelajaran_id from siswa_nilai_un x where x.nis='$nis')) aa order by aa.urutan";	
		
		
		
		return $sql;
	}
	
	
	//---------get data KRS
	function list_kartu_rencana_studi($replid='', $kelompok_pelajaran_id='', $tingkat_id='', $semester_id='', $peminatan='', $idtahunajaran='', $idminat='', $pelajaran_id=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($peminatan != "") {
			if ($where == "") {
				$where = " where a.peminatan = '$peminatan' ";
			} else {
				$where = $where . " and a.peminatan = '$peminatan' ";
			}
		}
		
		if ($kelompok_pelajaran_id != "") {
			if ($where == "") {
				$where = " where a.kelompok_pelajaran_id = '$kelompok_pelajaran_id' ";
			} else {
				$where = $where . " and a.kelompok_pelajaran_id = '$kelompok_pelajaran_id' ";
			}
		}
		
		if ($tingkat_id != "") {
			if ($where == "") {
				$where = " where a.tingkat_id = '$tingkat_id' ";
			} else {
				$where = $where . " and a.tingkat_id = '$tingkat_id' ";
			}
		}
		
		if ($semester_id != "") {
			if ($where == "") {
				$where = " where a.semester_id = '$semester_id' ";
			} else {
				$where = $where . " and a.semester_id = '$semester_id' ";
			}
		}
		
		if ($idtahunajaran != "") {
			if ($where == "") {
				$where = " where a.idtahunajaran = '$idtahunajaran' ";
			} else {
				$where = $where . " and a.idtahunajaran = '$idtahunajaran' ";
			}
		}

		if ($pelajaran_id != "") {
			if ($where == "") {
				$where = " where a.pelajaran_id = '$pelajaran_id' ";
			} else {
				$where = $where . " and a.pelajaran_id = '$pelajaran_id' ";
			}
		}
		
		if($idminat == 1) { //MIPA
			$sqlstr	=	"select a.replid, a.peminatan, a.tingkat_id, a.kelompok_pelajaran_id, a.pelajaran_kode, a.pelajaran_id, a.semester_id, a.sks, a.idtahunajaran, a.urutan, a.kode1, a.kode2, a.uid, a.dlu, f.tahunajaran nama_tahunajaran, b.tingkat, c.nama nama_pelajaran, c.kode, d.semester, e.dcr kelompok_pelajaran from kartu_rencana_studi a left join tingkat b on a.tingkat_id=b.replid left join pelajaran c on a.pelajaran_id=c.replid left join semester d on a.semester_id=d.replid left join (select '1' cde, 'Kelompok A' dcr, 0 nmr union all 
		select '2' cde, 'Kelompok B' dcr, 1 nmr union all 
		select '3' cde, 'Kelompok Peminatan MIPA' dcr, 2 nmr union all 
		select '4' cde, 'Lintas Peminatan' dcr, 3 nmr) e on a.kelompok_pelajaran_id=e.cde left join tahunajaran f on a.idtahunajaran=f.replid " . $where . " order by a.kelompok_pelajaran_id, a.urutan, a.replid";
		
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		} else if($idminat == 2) { //IPS
			$sqlstr	=	"select a.replid, a.peminatan, a.tingkat_id, a.kelompok_pelajaran_id, a.pelajaran_kode, a.pelajaran_id, a.semester_id, a.sks, a.idtahunajaran, a.urutan, a.kode1, a.kode2, a.uid, a.dlu, f.tahunajaran nama_tahunajaran, b.tingkat, c.nama nama_pelajaran, c.kode, d.semester, e.dcr kelompok_pelajaran from kartu_rencana_studi a left join tingkat b on a.tingkat_id=b.replid left join pelajaran c on a.pelajaran_id=c.replid left join semester d on a.semester_id=d.replid left join (select '1' cde, 'Kelompok A' dcr, 0 nmr union all 
		select '2' cde, 'Kelompok B' dcr, 1 nmr union all 
		select '3' cde, 'Kelompok Peminatan IPS' dcr, 2 nmr union all 
		select '4' cde, 'Lintas Peminatan' dcr, 3 nmr) e on a.kelompok_pelajaran_id=e.cde left join tahunajaran f on a.idtahunajaran=f.replid " . $where . " order by a.kelompok_pelajaran_id, a.urutan, a.replid";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		} else {			
			$sqlstr	=	"select a.replid, a.peminatan, a.tingkat_id, a.kelompok_pelajaran_id, a.pelajaran_kode, a.pelajaran_id, a.semester_id, a.sks, a.idtahunajaran, a.urutan, a.kode1, a.kode2, a.uid, a.dlu, f.tahunajaran nama_tahunajaran, b.tingkat, c.nama nama_pelajaran, c.kode, d.semester, e.dcr kelompok_pelajaran from kartu_rencana_studi a left join tingkat b on a.tingkat_id=b.replid left join pelajaran c on a.pelajaran_id=c.replid left join semester d on a.semester_id=d.replid left join (select '1' cde, 'Kelompok A' dcr, 0 nmr union all 
		select '2' cde, 'Kelompok B' dcr, 1 nmr union all 
		select '3' cde, 'Kelompok Peminatan MIPA dan IPS' dcr, 2 nmr union all 
		select '4' cde, 'Lintas Peminatan' dcr, 3 nmr) e on a.kelompok_pelajaran_id=e.cde left join tahunajaran f on a.idtahunajaran=f.replid " . $where . " order by a.kelompok_pelajaran_id, a.urutan, a.replid";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();			
		}
		
		return $sql;		
	}
	
	
	//---------get data kelompok KRS
	function list_kelompok_krs($idminat=''){
		$dbpdo = DB::create();
		
		if($idminat == 1) { //MIPA
			$sqlstr	= "select a.* from (select '1' cde, 'Kelompok A' dcr, 0 nmr union all 
				select '2' cde, 'Kelompok B' dcr, 1 nmr union all 
				select '3' cde, 'Kelompok Peminatan MIPA' dcr, 2 nmr union all 
				select '4' cde, 'Lintas Peminatan' dcr, 3 nmr) a order by a.cde";	
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		} else if($idminat == 2) { //IPS
			$sqlstr	= "select a.* from (select '1' cde, 'Kelompok A' dcr, 0 nmr union all 
				select '2' cde, 'Kelompok B' dcr, 1 nmr union all 
				select '3' cde, 'Kelompok Peminatan IPS' dcr, 2 nmr union all 
				select '4' cde, 'Lintas Peminatan' dcr, 3 nmr) a order by a.cde";	
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		} else {
			$sqlstr	= "select a.* from (select '1' cde, 'Kelompok A' dcr, 0 nmr union all 
				select '2' cde, 'Kelompok B' dcr, 1 nmr union all 
				select '3' cde, 'Kelompok Peminatan Matematika dan IPS' dcr, 2 nmr union all 
				select '4' cde, 'Lintas Peminatan' dcr, 3 nmr) a order by a.cde";	
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		return $sql;
	}
	
	
	//---------get data siswa krs
	function list_siswa_krs($replid='', $kelompok_pelajaran_id='', $idtahunajaran='', $peminatan='', $tingkat_id='', $semester_id=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if($peminatan == 1) {
			$peminatan = "MIPA";
		}
		if($peminatan == 2) {
			$peminatan = "IPS";
		}
		if($peminatan == 3) {
			$peminatan = "MATEMATIKA";
		}
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.nis = '$replid' ";
			} else {
				$where = $where . " and a.nis = '$replid' ";
			}
		}
		
		if ($semester_id != "") {
			if ($where == "") {
				$where = " where a.semester_id = '$semester_id' ";
			} else {
				$where = $where . " and a.semester_id = '$semester_id' ";
			}
		}
		
		
		if ($kelompok_pelajaran_id != "") {
			if ($where == "") {
				$where = " where a.kelompok_pelajaran_id = '$kelompok_pelajaran_id' ";
			} else {
				$where = $where . " and a.kelompok_pelajaran_id = '$kelompok_pelajaran_id' ";
			}
		}
		
		if ($idtahunajaran != "") {
			if ($where == "") {
				$where = " where a.idtahunajaran = '$idtahunajaran' ";
			} else {
				$where = $where . " and a.idtahunajaran = '$idtahunajaran' ";
			}
		}
		
		//$sqlstr	=	"select a.replid, a.nis, a.semester_id, a.pelajaran_id, a.pegawai_id, a.kelompok_pelajaran_id, a.approved, a.uid, a.dlu, b.kode kode_pelajaran, b.nama nama_pelajaran, c.sks, d.idkelas from siswa_krs a left join pelajaran b on a.pelajaran_id=b.replid left join kartu_rencana_studi c on a.sks_id=c.replid left join siswa d on a.nis=d.nis " . $where . " order by a.replid";
		
		//$sqlstr = "select a.replid, a.nis, a.semester_id, a.pelajaran_id, a.pegawai_id, a.kelompok_pelajaran_id, a.approved, a.uid, a.dlu, b.kode kode_pelajaran, b.nama nama_pelajaran, c.sks, d.idkelas from siswa_krs a left join pelajaran b on a.pelajaran_id=b.replid left join siswa d on a.nis=d.nis left join kelas e on d.idkelas=e.replid left join tingkat f on e.idtingkat=f.replid left join kartu_rencana_studi c on a.pelajaran_id=c.pelajaran_id and a.semester_id=c.semester_id and c.tingkat_id=f.replid " . $where . " order by a.replid";
		
		//$sqlstr	=	"select a.replid, a.nis, a.semester_id, a.pelajaran_id, a.pegawai_id, a.kelompok_pelajaran_id, a.approved, a.uid, a.dlu, b.kode kode_pelajaran, b.nama nama_pelajaran, 0 sks, d.idkelas from siswa_krs a left join pelajaran b on a.pelajaran_id=b.replid left join siswa d on a.nis=d.nis " . $where . " order by a.replid";
		
		$sqlstr	="select aa.* from (select a.replid, a.nis, a.semester_id, a.pelajaran_id, a.pegawai_id, a.kelompok_pelajaran_id, a.approved, a.uid, a.dlu, b.kode kode_pelajaran, b.nama nama_pelajaran, 0 sks, d.idkelas, 1 pilih, 0 line from siswa_krs a left join pelajaran b on a.pelajaran_id=b.replid left join siswa d on a.nis=d.nis " . $where; //. " order by a.replid
		$sqlstr	=	$sqlstr. " union all select a.replid, '' nis, a.semester_id, a.pelajaran_id, 0 pegawai_id, a.kelompok_pelajaran_id, 0 approved, '' uid, '' dlu, b.kode kode_pelajaran, b.nama nama_pelajaran, a.sks, 0 idkelas, 0 pilih, 1 line from kartu_rencana_studi a left join pelajaran b on a.pelajaran_id=b.replid where a.peminatan='$peminatan' and a.tingkat_id='$tingkat_id' and a.kelompok_pelajaran_id='$kelompok_pelajaran_id' and a.semester_id='$semester_id' and idtahunajaran='$idtahunajaran' and a.pelajaran_id not in (select a.pelajaran_id from siswa_krs a where a.kelompok_pelajaran_id = '$kelompok_pelajaran_id' and a.idtahunajaran = '$idtahunajaran' and a.semester_id='$semester_id' and a.peminatan='$peminatan' ) ) aa order by aa.line, aa.replid, aa.dlu desc ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data siswa krs
	function get_kartu_rencana_studi($peminatan='', $tingkat_id='', $kelompok_pelajaran_id='', $pelajaran_id='', $semester_id='', $idtahunajaran=''){
		$dbpdo = DB::create();
		
		if($peminatan == 1) {
			$peminatan = "MIPA";
		}
		if($peminatan == 2) {
			$peminatan = "IPS";
		}
		if($peminatan == 3) {
			$peminatan = "MATEMATIKA";
		}
		
		$sqlstr	=	"select a.sks, a.pelajaran_id from kartu_rencana_studi a where a.peminatan='$peminatan' and a.tingkat_id='$tingkat_id' and a.kelompok_pelajaran_id='$kelompok_pelajaran_id' and a.pelajaran_id='$pelajaran_id' and a.semester_id='$semester_id' and idtahunajaran='$idtahunajaran' ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data siswa krs view
	function list_siswa_krs_view($replid='', $tingkat='', $idkelas='', $nis='', $semester_id=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($tingkat != "") {
			if ($where == "") {
				$where = " where c.idtingkat = '$tingkat' ";
			} else {
				$where = $where . " and c.idtingkat = '$tingkat' ";
			}
		}
		
		if ($idkelas != "") {
			if ($where == "") {
				$where = " where b.idkelas = '$idkelas' ";
			} else {
				$where = $where . " and b.idkelas = '$idkelas' ";
			}
		}
		
		if ($nis != "") {
			if ($where == "") {
				$where = " where a.nis = '$nis' ";
			} else {
				$where = $where . " and a.nis = '$nis' ";
			}
		}
		
		if ($semester_id != "") {
			if ($where == "") {
				$where = " where a.semester_id = '$semester_id' ";
			} else {
				$where = $where . " and a.semester_id = '$semester_id' ";
			}
		}
		
		$sqlstr	=	"select distinct a.nis, a.semester_id, b.nama nama_siswa, c.kelas, d.tingkat, e.semester from siswa_krs a left join siswa b on a.nis=b.nis left join kelas c on b.idkelas=c.replid left join tingkat d on c.idtingkat=d.replid left join semester e on a.semester_id=e.replid " . $where . " order by a.replid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data siswa krs approved view
	function list_siswa_krs_approved_view($replid='', $idtingkat='', $idkelas2='', $semester_id='', $pelajaran_id='', $idtahunajaran=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idtahunajaran != "") {
			if ($where == "") {
				$where = " where a.idtahunajaran = '$idtahunajaran' ";
			} else {
				$where = $where . " and a.idtahunajaran = '$idtahunajaran' ";
			}
		}
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where c.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and c.idtingkat = '$idtingkat' ";
			}
		}
		
		if ($idkelas2 != "") {
			if ($where == "") {
				$where = " where b.idkelas = '$idkelas2' ";
			} else {
				$where = $where . " and b.idkelas = '$idkelas2' ";
			}
		}
		
		if ($semester_id != "") {
			if ($where == "") {
				$where = " where a.semester_id = '$semester_id' ";
			} else {
				$where = $where . " and a.semester_id = '$semester_id' ";
			}
		}
		
		if ($pelajaran_id != "") {
			if ($where == "") {
				$where = " where a.pelajaran_id = '$pelajaran_id' ";
			} else {
				$where = $where . " and a.pelajaran_id = '$pelajaran_id' ";
			}
		}
		
		if($_SESSION["tipe_user"] != "Guru") {
			if($replid=='' && $idtingkat=='' && $idkelas2=='' && $semester_id=='' && $pelajaran_id=='') {
				$where = " where a.nis = 'ndf' ";
			}
		}
		
		$sqlstr	=	"select distinct a.nis, a.semester_id, b.idkelas, b.nama nama_siswa, c.kelas, c.idtingkat, d.tingkat, e.semester from siswa_krs a left join siswa b on a.nis=b.nis left join kelas c on b.idkelas=c.replid left join tingkat d on c.idtingkat=d.replid left join semester e on a.semester_id=e.replid " . $where . " order by a.replid";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data pelajaran_raport_minat
	function list_pelajaran_raport_minat($replid='', $departemen=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}

		if ($departemen != "") {
			if ($where == "") {
				$where = " where a.departemen = '$departemen' ";
			} else {
				$where = $where . " and a.departemen = '$departemen' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.pelajaran_id, a.departemen, a.urutan, a.uid, a.dlu, b.nama from pelajaran_raport_minat a left join pelajaran b on a.pelajaran_id=b.replid " . $where . " order by a.urutan ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data penempatan_siswa_prioritas
	function list_penempatan_siswa_prioritas($replid=''){
		$dbpdo = DB::create();
		
		//$where = " where a.departemen='SMA' ";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.nama, a.aktif, a.urutan from penempatan_siswa_prioritas a " . $where . " order by a.urutan ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data kelompok Ekstra
	function list_kelompok_ekstraurikuler($pilihan='0'){
		$dbpdo = DB::create();
		
		if($pilihan == 0) {
			$sqlstr	= "select a.* from (select '1' cde, 'Wajib' dcr, 0 nmr union all 
				select '0' cde, 'Pilihan' dcr, 1 nmr) a order by a.nmr";	
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		} else {
			$sqlstr	= "select a.* from (select '0' cde, 'Pilihan' dcr, 1 nmr) a order by a.nmr";	
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		return $sql;
	}
	
	
	//---------get data Esktra
	function list_ekstrakurikuler_pelajaran($replid='', $kelompok_pelajaran_id=''){
		$dbpdo = DB::create();
		
		if($_SESSION["tipe_user"] == "Guru") {
			
			$sqleks="select idpelajaran from guru where nip='$_SESSION[idpegawai]'";
			$sql=$dbpdo->prepare($sqleks);
			$sql->execute();
			$strextra = "";
			while($dataeks=$sql->fetch(PDO::FETCH_OBJ)) {
				if($strextra == "") {
					$strextra = $dataeks->idpelajaran;
				} else {
					$strextra = $strextra.",".$dataeks->idpelajaran;
				}
			}
			//$strextra = "(".$strextra.")";
			//--------------
			
			if($strextra != "") {
				$where = " where ifnull(a.sifat,0)=0 and a.replid in (".$strextra.")";	
			}
			
			if ($replid != "") {
				if ($where == "") {
					$where = " where a.replid = '$replid' ";
				} else {
					$where = $where . " and a.replid = '$replid' ";
				}
			}
			
			/*if ($kelompok_pelajaran_id != "") {
				if ($where == "") {
					$where = " where ifnull(a.ekstra_sifat,0) = '$kelompok_pelajaran_id' ";
				} else {
					$where = $where . " and ifnull(a.ekstra_sifat,0) = '$kelompok_pelajaran_id' ";
				}
			}*/
			
			$sqlstr	=	"select a.replid pelajaran_id, a.nama from pelajaran a " . $where . " order by ifnull(a.ekstra_sifat,0) desc, a.replid";	
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		} else {
			$where = " where ifnull(a.sifat,0)=0 ";
			
			if ($replid != "") {
				if ($where == "") {
					$where = " where a.replid = '$replid' ";
				} else {
					$where = $where . " and a.replid = '$replid' ";
				}
			}
			
			if ($kelompok_pelajaran_id != "") {
				if ($where == "") {
					$where = " where ifnull(a.ekstra_sifat,0) = '$kelompok_pelajaran_id' ";
				} else {
					$where = $where . " and ifnull(a.ekstra_sifat,0) = '$kelompok_pelajaran_id' ";
				}
			}
			
			$sqlstr	=	"select a.replid pelajaran_id, a.nama from pelajaran a " . $where . " order by ifnull(a.ekstra_sifat,0) desc, a.replid";	
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		return $sql;
	}
	
	//---------get data guru
	function list_guru($idpelajaran='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = " where c.sifat<>0 ";
		
		if ($idpelajaran != "") {
			if ($where == "") {
				$where = " where a.idpelajaran = '$idpelajaran' ";
			} else {
				$where = $where . " and a.idpelajaran = '$idpelajaran' ";
			}
		}
		
		if ($nip != "") {
			if ($where == "") {
				$where = " where a.nip = '$nip' ";
			} else {
				$where = $where . " and a.nip = '$nip' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where b.nama like '%$nama%' ";
			} else {
				$where = $where . " and b.nama like '%$nama%' ";
			}
		}
		
		if($all == 1) {
			$where = " where c.sifat<>0 ";
		}
		
		$sqlstr	=	"select a.replid, a.kode, b.nip, b.nama, b.kelamin, a.idpelajaran, c.nama nama_pelajaran from guru a left join pegawai b on a.nip=b.replid left join pelajaran c on a.idpelajaran=c.replid " . $where . " order by c.nama, a.replid";	
		//echo $sqlstr."<br>";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data guru ekskul
	function list_guru_ekskul($idpelajaran='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = " where c.sifat=0 ";
		
		if ($idpelajaran != "") {
			if ($where == "") {
				$where = " where a.idpelajaran = '$idpelajaran' ";
			} else {
				$where = $where . " and a.idpelajaran = '$idpelajaran' ";
			}
		}
		
		if ($nip != "") {
			if ($where == "") {
				$where = " where a.nip = '$nip' ";
			} else {
				$where = $where . " and a.nip = '$nip' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where b.nama like '%$nama%' ";
			} else {
				$where = $where . " and b.nama like '%$nama%' ";
			}
		}
		
		if($all == 1) {
			$where = " where c.sifat=0 ";
		}
		
		$sqlstr	=	"select a.replid, a.kode, b.nip, b.nama, b.kelamin, a.idpelajaran, c.nama nama_pelajaran from guru a left join pegawai b on a.nip=b.replid left join pelajaran c on a.idpelajaran=c.replid " . $where . " order by c.nama, a.replid";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data guru
	function list_guru_pelajaran(){
		$dbpdo = DB::create();
		
		$where = " where ifnull(a.aktif,0)=1 ";
				
		$sqlstr	=	"select a.replid, a.nip, a.nama from pegawai a " . $where . " order by a.nama, a.nip";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data guru ekskul
	function list_guru_ekskul_pelajaran(){
		$dbpdo = DB::create();
		
		$where = " where ifnull(a.aktif,0)=1 ";
				
		$sqlstr	=	"select a.replid, a.nip, a.nama from pegawai a " . $where . " order by a.nama, a.nip";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data guru update
	function list_guru_pelajaran_update($idpelajaran){
		$dbpdo = DB::create();
		
		$where = " where ifnull(a.aktif,0)=1 ";
		
		$sqlstr	=	"select aa.* from (select a.replid, a.kode, b.nip, b.nama, a.keterangan, 1 urutan, a.info1 input_pas from guru a left join pegawai b on a.nip=b.replid where a.idpelajaran='$idpelajaran'
		union all
		select a.replid, '' kode, a.nip,  a.nama, '' keterangan, 0 urutan, '' input_pas from pegawai a where a.replid not in (select x.nip from guru x where x.idpelajaran='$idpelajaran')) aa order by aa.urutan desc, aa.kode, aa.nama, aa.nip ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data guru ekskul update
	function list_guru_ekskul_pelajaran_update($idpelajaran){
		$dbpdo = DB::create();
		
		$where = " where ifnull(a.aktif,0)=1 ";
		
		$sqlstr	=	"select aa.* from (select a.replid, case when a.kode='' then '-' else a.kode end kode, b.nip, b.nama, a.keterangan, 1 urutan from guru a left join pegawai b on a.nip=b.replid where a.idpelajaran='$idpelajaran'
		union all
		select a.replid, '' kode, a.nip,  a.nama, '' keterangan, 0 urutan from pegawai a where a.replid not in (select x.nip from guru x where x.idpelajaran='$idpelajaran')) aa order by aa.urutan desc, aa.kode, aa.nama, aa.nip ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data jam
	function list_jam($id='', $hari='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($id != "") {
			if ($where == "") {
				$where = " where a.replid = '$id' ";
			} else {
				$where = $where . " and a.replid = '$id' ";
			}
		}
		
		if ($hari != "") {
			if ($where == "") {
				$where = " where a.hari = '$hari' ";
			} else {
				$where = $where . " and a.hari = '$hari' ";
			}
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr	=	"select a.replid, a.hari, a.jamke, a.departemen, a.jam1, a.jam2, a.info1, a.istirahat, a.ts from jam a " . $where . " order by a.hari, a.jamke";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data jadwal
	function list_jadwal($idkelas='', $nipguru='', $idpelajaran='', $hari='', $idjam1=''){
		$dbpdo = DB::create();
		
		$where = " where a.idpelajaran<>0 ";
		
		if ($idkelas != "") {
			if ($where == "") {
				$where = " where a.idkelas = '$idkelas' ";
			} else {
				$where = $where . " and a.idkelas = '$idkelas' ";
			}
		}
		
		if ($nipguru != "") {
			if ($where == "") {
				$where = " where a.nipguru = '$nipguru' ";
			} else {
				$where = $where . " and a.nipguru = '$nipguru' ";
			}
		}
		
		if ($idpelajaran != "") {
			if ($where == "") {
				$where = " where a.idpelajaran = '$idpelajaran' ";
			} else {
				$where = $where . " and a.idpelajaran = '$idpelajaran' ";
			}
		}
		
		if ($hari != "") {
			if ($where == "") {
				$where = " where a.hari = '$hari' ";
			} else {
				$where = $where . " and a.hari = '$hari' ";
			}
		}
		
		if ($idjam1 != "") {
			if ($where == "") {
				$where = " where a.idjam1 = '$idjam1' ";
			} else {
				$where = $where . " and a.idjam1 = '$idjam1' ";
			}
		}
		
		$sqlstr	= "select a.replid, a.idkelas, a.nipguru, a.idpelajaran, a.departemen, a.infojadwal, a.hari, a.jamke, a.njam, a.sifat, a.status, a.keterangan, a.jam1, a.jam2, a.idjam1, a.idjam2, b.kode kode_guru from jadwal a left join guru b on a.nipguru=b.nip and a.idpelajaran=b.idpelajaran " . $where;
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data asset type
	function list_asset_type($kode ='', $all=0, $act=''){	
		$dbpdo = DB::create();
		 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.id = '$kode' ";
			} else {
				$where = $where . " and a.id = '$kode' ";
			}								
		}
		
		$sqlstr="select a.id, a.type, a.active, a.uid, a.dlu from asset_type a " . $where . " order by a.id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
    
    
    //---------get data asset
	function list_asset($kode ='', $asset_name='', $alias='', $tanggal_perolehan='', $group_block='', $all=0){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $asset_name != "") {
			if ($where == "") {
				$where = " where a.asset_name like '%$asset_name%' ";
			} else {
				$where = $where . " and a.asset_name like '%$asset_name%' ";
			}								
		}
		
		if ( $alias != "") {
			if ($where == "") {
				$where = " where a.alias like '%$alias%' ";
			} else {
				$where = $where . " and a.alias like '%$alias%' ";
			}								
		}
		
		if ( $tanggal_perolehan != "") {
			
			$tanggal_perolehan = date("Y-m-d", strtotime($tanggal_perolehan));
			
			if ($where == "") {
				$where = " where a.tanggal_perolehan = '$tanggal_perolehan' ";
			} else {
				$where = $where . " and a.tanggal_perolehan = '$tanggal_perolehan' ";
			}								
		}
				
		if ( $group_block != "") {
			if ($where == "") {
				$where = " where a.group_block like '%$group_block%' ";
			} else {
				$where = $where . " and a.group_block like '%$group_block%' ";
			}								
		}
		
		if($kode == '' && $asset_name == '' && $alias == '' && $tanggal_perolehan == '' && $group_block == '' && $all == 0) {
			$where = " where a.ref = 'ndf' ";
		}
		
		if($all == 1) {
			$where = "";
		}		
		
		$sqlstr="select a.ref, a.asset_name, a.alias, a.ref_id, a.lokasi, a.asset_type_id, b.type asset_type, a.status, a.luas, a.sertifikat, a.imb, a.perolehan, a.tanggal_perolehan, a.pemilik_sebelum, a.contact_name, a.no_pbb, a.group_block, a.alamat, a.lintang, a.bujur, a.nilai_perolehan, a.nilai_amnesti, a.photo, a.photo_1, a.photo_2, a.photo_3, a.photo_4, a.shm, a.shm_nama, a.ajb, a.pbb, a.keterangan, a.active, a.uid, a.dlu from asset a left join asset_type b on a.asset_type_id=b.id " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
    
    
    //---------get data asset
	function list_data_asset($kode ='', $asset_name='', $alias='', $tanggal_perolehan='', $group_block='', $all=0, $pemilik_sekarang='', $pemilik_sekarang1='', $pemilik_sekarang2=''){	 	
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $asset_name != "") {
			if ($where == "") {
				$where = " where a.asset_name like '%$asset_name%' ";
			} else {
				$where = $where . " and a.asset_name like '%$asset_name%' ";
			}								
		}
		
		if ( $alias != "") {
			if ($where == "") {
				$where = " where a.alias like '%$alias%' ";
			} else {
				$where = $where . " and a.alias like '%$alias%' ";
			}								
		}
		
		if ( $tanggal_perolehan != "") {
			
			$tanggal_perolehan = date("Y-m-d", strtotime($tanggal_perolehan));
			
			if ($where == "") {
				$where = " where a.tanggal_perolehan = '$tanggal_perolehan' ";
			} else {
				$where = $where . " and a.tanggal_perolehan = '$tanggal_perolehan' ";
			}								
		}
				
		if ( $group_block != "") {
			if ($where == "") {
				$where = " where a.group_block like '%$group_block%' ";
			} else {
				$where = $where . " and a.group_block like '%$group_block%' ";
			}								
		}
		
		if ( $pemilik_sekarang != "") {
			if ($where == "") {
				$where = " where a.pemilik_sekarang like '%$pemilik_sekarang%' ";
			} else {
				$where = $where . " and a.pemilik_sekarang like '%$pemilik_sekarang%' ";
			}								
		}
		
		if ( $pemilik_sekarang1 != "") {
			if ($where == "") {
				$where = " where a.pemilik_sekarang1 like '%$pemilik_sekarang1%' ";
			} else {
				$where = $where . " and a.pemilik_sekarang1 like '%$pemilik_sekarang1%' ";
			}								
		}
		
		if ( $pemilik_sekarang2 != "") {
			if ($where == "") {
				$where = " where a.pemilik_sekarang2 like '%$pemilik_sekarang2%' ";
			} else {
				$where = $where . " and a.pemilik_sekarang2 like '%$pemilik_sekarang2%' ";
			}								
		}
		
		
		if($kode == '' && $asset_name == '' && $alias == '' && $tanggal_perolehan == '' && $group_block == '' && $all == 0 && $pemilik_sekarang=='' && $pemilik_sekarang1=='' && $pemilik_sekarang2=='') {
			$where = " where a.ref = 'ndf' ";
		}
		
		if($all == 1) {
			$where = "";
		}		
		
		$sqlstr="select a.ref, a.asset_name, a.alias, a.ref_id, a.lokasi, a.provinsi_kode, a.kota_kode, a.kecamatan_kode, a.desa_kode, a.asset_type_id, b.type asset_type, a.status, a.luas, a.sertifikat, a.imb, a.tanggal_perolehan, a.pemilik_sebelum, a.contact_name, a.no_pbb, a.group_block, a.alamat, a.lintang, a.bujur, a.nilai_perolehan, a.nilai_amnesti, a.pemilik_sekarang, a.pemilik_sekarang1, a.pemilik_sekarang2, a.photo, a.photo_1, a.photo_2, a.photo_3, a.photo_4, a.shm, a.shm_nama, a.ajb, a.pbb, a.keterangan, a.provinsi, a.kota, a.kecamatan, a.desa, a.active, a.uid, a.dlu from asset a left join asset_type b on a.asset_type_id=b.id " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
    //---------get data asset trans
	function list_asset_trans($kode =''){	 
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		$sqlstr="select a.ref, a.tanggal, a.asset_id, b.asset_name, a.penyewa, a.lama_sewa, a.akhir_sewa, a.harga_sewa, a.alamat, a.hp, a.uid, a.dlu from asset_trans a left join asset b on a.asset_id=b.ref " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get data soal
	function list_soal($kode ='', $idtingkat='', $idsemester='', $idjurusan='', $aktif=''){	 
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.replid = '$kode' ";
			} else {
				$where = $where . " and a.replid = '$kode' ";
			}								
		}
		
		if ( $idtingkat != "") {
			if ($where == "") {
				$where = " where a.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and a.idtingkat = '$idtingkat' ";
			}								
		}
		
		if ( $idsemester != "") {
			if ($where == "") {
				$where = " where a.idsemester = '$idsemester' ";
			} else {
				$where = $where . " and a.idsemester = '$idsemester' ";
			}								
		}
		
		if ( $idjurusan != "") {
			if ($where == "") {
				$where = " where a.idjurusan = '$idjurusan' ";
			} else {
				$where = $where . " and a.idjurusan = '$idjurusan' ";
			}								
		}
		
		if ( $aktif != "") {
			if ($where == "") {
				$where = " where a.aktif = '$aktif' ";
			} else {
				$where = $where . " and a.aktif = '$aktif' ";
			}								
		}
		
		$sqlstr="select a.replid, a.idtahunajaran, a.idtingkat, a.idpegawai, a.idsemester, a.idjurusan, a.pertanyaan, a.pilihan1, a.pilihan_photo1, a.pilihan2, a.pilihan_photo2, a.pilihan3, a.pilihan_photo3, a.pilihan4, a.pilihan_photo4, a.pilihan5, a.pilihan_photo5, a.jawaban, a.poin, a.waktu, a.aktif, a.uid, a.dlu, b.tahunajaran, c.tingkat, d.nama guru, e.semester from soal a left join tahunajaran b on a.idtahunajaran=b.replid left join tingkat c on a.idtingkat=c.replid left join pegawai d on a.idpegawai=d.replid left join semester e on a.idsemester=e.replid " . $where . " order by a.replid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get data soal Ujian
	function list_soal_ujian($kode ='', $idtingkat='', $idsemester='', $idjurusan='', $aktif=''){	 
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.replid = '$kode' ";
			} else {
				$where = $where . " and a.replid = '$kode' ";
			}								
		}
		
		if ( $idtingkat != "") {
			if ($where == "") {
				$where = " where a.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and a.idtingkat = '$idtingkat' ";
			}								
		}
		
		if ( $idsemester != "") {
			if ($where == "") {
				$where = " where a.idsemester = '$idsemester' ";
			} else {
				$where = $where . " and a.idsemester = '$idsemester' ";
			}								
		}
		
		if ( $idjurusan != "") {
			if ($where == "") {
				$where = " where a.idjurusan = '$idjurusan' ";
			} else {
				$where = $where . " and a.idjurusan = '$idjurusan' ";
			}								
		}
		
		if ( $aktif != "") {
			if ($where == "") {
				$where = " where a.aktif = '$aktif' ";
			} else {
				$where = $where . " and a.aktif = '$aktif' ";
			}								
		}
		
		$sqlstr="select a.replid, a.idtahunajaran, a.idtingkat, a.idpegawai, a.idsemester, a.idjurusan, a.pertanyaan, a.pilihan1, a.pilihan_photo1, a.pilihan2, a.pilihan_photo2, a.pilihan3, a.pilihan_photo3, a.pilihan4, a.pilihan_photo4, a.pilihan5, a.pilihan_photo5, a.jawaban, a.aktif, a.uid, a.dlu, b.tahunajaran, c.tingkat, d.nama guru, e.semester from soal a left join tahunajaran b on a.idtahunajaran=b.replid left join tingkat c on a.idtingkat=c.replid left join pegawai d on a.idpegawai=d.replid left join semester e on a.idsemester=e.replid " . $where . " order by rand()";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	//---------get data soal siswa
	function list_soal_siswa($idsiswa =''){	 
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $idsiswa != "") {
			if ($where == "") {
				$where = " where a.idsiswa = '$idsiswa' ";
			} else {
				$where = $where . " and a.idsiswa = '$idsiswa' ";
			}								
		}
		
		$sqlstr="select a.replid, a.tanggal, a.idsiswa, a.idsemester, a.idsoal, a.jawaban, b.pertanyaan, b.jawaban kunci_jawab, b.poin from soal_siswa a left join soal b on a.idsoal=b.replid " . $where . " order by a.replid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get data pemetaan kd
	function list_pemetaan_kd($ref ='', $idtingkat='', $idpelajaran='', $kd='', $all=''){	 
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}								
		}
		
		if ( $idtingkat != "") {
			if ($where == "") {
				$where = " where a.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and a.idtingkat = '$idtingkat' ";
			}								
		}
		
		if ( $idpelajaran != "") {
			if ($where == "") {
				$where = " where a.idpelajaran = '$idpelajaran' ";
			} else {
				$where = $where . " and a.idpelajaran = '$idpelajaran' ";
			}								
		}
		
		if ( $kd != "") {
			if ($where == "") {
				$where = " where a.kd = '$kd' ";
			} else {
				$where = $where . " and a.kd = '$kd' ";
			}								
		}
		
		$sqlstr="select a.replid, a.permen_kd_id, a.idtingkat, a.idpelajaran, a.kd, a.kode, a.uraian, a.kkm_sekolah, a.kkm_pelajaran, a.jumlah_ukbm, a.urutan, a.aktif, a.uid, a.dlu, b.permen, c.tingkat, d.kode kode_mapel, d.nama mata_pelajaran from pemetaan_kd a left join permen_kd b on a.permen_kd_id=b.replid left join tingkat c on a.idtingkat=c.replid left join pelajaran d on a.idpelajaran=d.replid " . $where . " order by a.replid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get data pemetaan kd siswa
	function list_pemetaan_kd_siswa($ref ='', $idsiswa='', $idpelajaran='', $all=''){	 
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}								
		}
		
		if ( $idsiswa != "") {
			if ($where == "") {
				$where = " where a.idsiswa = '$idsiswa' ";
			} else {
				$where = $where . " and a.idsiswa = '$idsiswa' ";
			}								
		}
		
		if ( $idpelajaran != "") {
			if ($where == "") {
				$where = " where a.idpelajaran = '$idpelajaran' ";
			} else {
				$where = $where . " and a.idpelajaran = '$idpelajaran' ";
			}								
		}
		
		
		$sqlstr="select a.replid, a.pemetaan_kd_id, a.idsiswa, a.idguru, a.idpelajaran, a.nilai, a.uid, a.dlu, b.nama nama_siswa, c.nama nama_guru, d.uraian pemetaan_kd, d.kkm_sekolah, d.kkm_pelajaran, e.nama mata_pelajaran from pemetaan_kd_siswa a left join siswa b on a.idsiswa=b.replid left join pegawai c on a.idguru=c.replid left join pemetaan_kd d on a.pemetaan_kd_id=d.replid left join pelajaran e on a.idpelajaran=e.replid " . $where . " order by a.replid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get data ukbm
	function list_ukbm($ref='', $idtingkat='', $idpelajaran='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where a.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and a.idtingkat = '$idtingkat' ";
			}
		}
		
		if ($idpelajaran != "") {
			if ($where == "") {
				$where = " where a.idpelajaran = '$idpelajaran' ";
			} else {
				$where = $where . " and a.idpelajaran = '$idpelajaran' ";
			}
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr	=	"select a.replid, a.idtingkat, a.idsemester, a.idpelajaran, a.idguru, a.kode, a.ukbm, a.deskripsi, a.file_ukbm, a.idrpp, a.minimum_hadir, a.jumlah_ukbm, a.aktif, a.uid, a.dlu, b.tingkat, b.departemen, c.nama pelajaran, d.semester from ukbm a left join tingkat b on a.idtingkat=b.replid left join pelajaran c on a.idpelajaran=c.replid left join semester d on a.idsemester=d.replid " . $where . " order by b.departemen, c.nama ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data soal ukbm
	function list_soal_ukbm($kode ='', $idtingkat='', $idsemester='', $idjurusan='', $idukbm='', $aktif=''){	 
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.replid = '$kode' ";
			} else {
				$where = $where . " and a.replid = '$kode' ";
			}								
		}
		
		if ( $idtingkat != "") {
			if ($where == "") {
				$where = " where a.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and a.idtingkat = '$idtingkat' ";
			}								
		}
		
		if ( $idsemester != "") {
			if ($where == "") {
				$where = " where a.idsemester = '$idsemester' ";
			} else {
				$where = $where . " and a.idsemester = '$idsemester' ";
			}								
		}
		
		if ( $idjurusan != "") {
			if ($where == "") {
				$where = " where a.idjurusan = '$idjurusan' ";
			} else {
				$where = $where . " and a.idjurusan = '$idjurusan' ";
			}								
		}
		
		if ( $idukbm != "") {
			if ($where == "") {
				$where = " where a.idukbm = '$idukbm' ";
			} else {
				$where = $where . " and a.idukbm = '$idukbm' ";
			}								
		}
		
		
		if ( $aktif != "") {
			if ($where == "") {
				$where = " where a.aktif = '$aktif' ";
			} else {
				$where = $where . " and a.aktif = '$aktif' ";
			}								
		}
		
		$sqlstr="select a.replid, a.idtahunajaran, a.idtingkat, a.idpegawai, a.idsemester, a.idjurusan, a.idukbm, a.pertanyaan, a.pilihan1, a.pilihan_photo1, a.pilihan2, a.pilihan_photo2, a.pilihan3, a.pilihan_photo3, a.pilihan4, a.pilihan_photo4, a.pilihan5, a.pilihan_photo5, a.jawaban, a.soal_file, a.poin, a.aktif, a.uid, a.dlu, b.tahunajaran, c.tingkat, d.nama guru, e.semester, f.kode kode_ukbm from soal_ukbm a left join tahunajaran b on a.idtahunajaran=b.replid left join tingkat c on a.idtingkat=c.replid left join pegawai d on a.idpegawai=d.replid left join semester e on a.idsemester=e.replid left join ukbm f on a.idukbm=f.replid " . $where . " order by a.replid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get data soal ukbm siswa
	function list_soal_ukbm_siswa($idsiswa =''){	 
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $idsiswa != "") {
			if ($where == "") {
				$where = " where a.idsiswa = '$idsiswa' ";
			} else {
				$where = $where . " and a.idsiswa = '$idsiswa' ";
			}								
		}
		
		$sqlstr="select a.replid, a.tanggal, a.idsiswa, a.idsemester, a.idukbm, a.idsoal, a.jawaban, b.pertanyaan, b.jawaban kunci_jawab, b.poin from soal_ukbm_siswa a left join soal_ukbm b on a.idsoal=b.replid " . $where . " order by a.replid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get data soal ukbm Ujian
	function list_soal_ukbm_ujian($kode ='', $idtingkat='', $idsemester='', $idjurusan='', $aktif='', $file_ukbm='', $limit='', $idukbm=''){	 
		$dbpdo = DB::create();
			
		$where = " where a.idukbm = '$idukbm' ";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.replid = '$kode' ";
			} else {
				$where = $where . " and a.replid = '$kode' ";
			}								
		}
		
		if ( $idtingkat != "") {
			if ($where == "") {
				$where = " where a.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and a.idtingkat = '$idtingkat' ";
			}								
		}
		
		if ( $idsemester != "") {
			if ($where == "") {
				$where = " where a.idsemester = '$idsemester' ";
			} else {
				$where = $where . " and a.idsemester = '$idsemester' ";
			}								
		}
		
		if ( $idjurusan != "") {
			if ($where == "") {
				$where = " where a.idjurusan = '$idjurusan' ";
			} else {
				$where = $where . " and a.idjurusan = '$idjurusan' ";
			}								
		}
		
		if ( $aktif != "") {
			if ($where == "") {
				$where = " where a.aktif = '$aktif' ";
			} else {
				$where = $where . " and a.aktif = '$aktif' ";
			}								
		}
		
		if ( $file_ukbm != "") {
			if ($where == "") {
				$where = " where f.file_ukbm <> '' ";
			} else {
				$where = $where . " and f.file_ukbm <> '' ";
			}								
		}
				
		if($limit != "") {
			$limit = " limit " . $limit;
		}
		
		$sqlstr="select a.replid, a.idtahunajaran, a.idtingkat, a.idpegawai, a.idsemester, a.idjurusan, a.pertanyaan, a.pilihan1, a.pilihan_photo1, a.pilihan2, a.pilihan_photo2, a.pilihan3, a.pilihan_photo3, a.pilihan4, a.pilihan_photo4, a.pilihan5, a.pilihan_photo5, a.jawaban, a.aktif, a.uid, a.dlu, b.tahunajaran, c.tingkat, d.nama guru, e.semester, a.idukbm, f.file_ukbm from soal_ukbm a left join tahunajaran b on a.idtahunajaran=b.replid left join tingkat c on a.idtingkat=c.replid left join pegawai d on a.idpegawai=d.replid left join semester e on a.idsemester=e.replid left join ukbm f on a.idukbm=f.replid " . $where . " order by rand() " . $limit;
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	function protection_krs($idsiswa) {
		
		$dbpdo = DB::create();
		
		$sqlstr="select a.jalurmasuk_id from siswa a where a.nis='$idsiswa'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
		
	}
	
	
	//---------get data ukbm siswa
	function list_ukbm_siswa($id='', $idsiswa='', $idpelajaran='', $all='', $departemen=''){	 
		$dbpdo = DB::create();
			
		$where = " where e.departemen='$departemen' ";
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where a.replid = '$id' ";
			} else {
				$where = $where . " and a.replid = '$id' ";
			}								
		}
		
		if ( $idsiswa != "") {
			if ($where == "") {
				$where = " where a.idsiswa = '$idsiswa' ";
			} else {
				$where = $where . " and a.idsiswa = '$idsiswa' ";
			}								
		}
		
		if ( $idpelajaran != "") {
			if ($where == "") {
				$where = " where b.idpelajaran = '$idpelajaran' ";
			} else {
				$where = $where . " and b.idpelajaran = '$idpelajaran' ";
			}								
		}

				
		if($all == 1) {
			if($_SESSION["adm"] == 1 || $_SESSION["tipe_user"] == "Pegawai" || $_SESSION["tipe_user"] == "Guru") {
				$where = " where e.departemen='$departemen' ";
			} else {
				if($_SESSION["tipe_user"] == "Siswa") {
					if ($where == "") {
						$where = " where a.idsiswa = '$idsiswa' ";
					} else {
						$where = $where . " and a.idsiswa = '$idsiswa' ";
					}
				}
			}			
		}
		
		$sqlstr="select a.replid, a.tanggal, a.idsiswa, a.idsemester, a.idukbm, a.ujian, a.setuju, b.deskripsi, b.file_ukbm, c.nis, c.nama nama_siswa, d.semester, e.nama pelajaran from ukbm_siswa a left join ukbm b on a.idukbm=b.replid left join siswa c on a.idsiswa=c.replid left join semester d on a.idsemester=d.replid left join pelajaran e on b.idpelajaran=e.replid " . $where . " order by a.replid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get data setup periode
	function list_setup_periode($id='', $jenis='', $all=''){	 
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where a.replid = '$id' ";
			} else {
				$where = $where . " and a.replid = '$id' ";
			}								
		}
		
		if ( $jenis != "") {
			if ($where == "") {
				$where = " where a.jenis = '$jenis' ";
			} else {
				$where = $where . " and a.jenis = '$jenis' ";
			}								
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.replid, a.tanggal, a.tanggal1, a.jenis, a.tingkat_id, a.aktif, a.uid, a.dlu, b.tingkat from setup_periode a left join tingkat b on a.tingkat_id=b.replid " . $where . " order by a.replid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get data siswa
	function list_presensi_ukbm_siswa($ref='', $replid='', $idtingkat='', $kelas='', $nama='', $all='', $departemen=''){
		$dbpdo = DB::create();
		
		$where = " where ifnull(a.alumni,0)=0 ";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.nis = '$ref' ";
			} else {
				$where = $where . " and a.nis = '$ref' ";
			}
		}
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where b.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and b.idtingkat = '$idtingkat' ";
			}
		}
		
		if ($kelas != "") {
			if ($where == "") {
				$where = " where a.idkelas = '$kelas' ";
			} else {
				$where = $where . " and a.idkelas = '$kelas' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where c.departemen = '$departemen' ";
			} else {
				$where = $where . " and c.departemen = '$departemen' ";
			}
		}
		
		
		if ($all != "") {
			$where = " where ifnull(a.alumni,0)=0 ";
		}
		
		if($ref=='' && $replid=='' && $idtingkat=='' && $kelas=='' && $nama=='' && $all=='' && $departemen=='') {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nis, a.nisn, a.idangkatan, a.idangkatan1, a.foto_file, a.nama, a.idkelas, a.kelamin, a.tmplahir, a.tgllahir, a.agama, a.warga, a.anakke, a.jsaudara, a.jtiri, a.jangkat, a.yatim, a.bahasa, a.alamatsiswa, a.alamatortu, a.telponsiswa, a.hpsiswa, a.telponortu, a.hportu, a.hpibu, a.jaraksekolah, a.kesekolah, a.berat, a.tinggi, a.kesehatan, a.darah, a.file_darah, a.kelainan, a.asalsekolah_id, a.tglijazah, a.noijazah, a.tglskhun, a.skhun, a.noujian, a.nisnasal, a.namaayah, a.namaibu, a.tmplahirayah, a.tgllahirayah, a.tmplahiribu, a.tgllahiribu, a.pekerjaanayah, a.pekerjaanibu, a.penghasilanayah, a.penghasilanibu, a.pendidikanayah, a.pendidikanibu, a.wnayah, a.wnibu, a.wali, a.tmplahirwali, a.tgllahirwali, a.pendidikanwali, a.pekerjaanwali, a.penghasilanwali, a.alamatwali, a.hpwali, a.hubungansiswa, a.pekerjaanayah_lain, a.pekerjaanibu_lain, a.pekerjaanwali_lain, a.uid, a.ts, b.idtingkat, b.kelas, c.tingkat from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data presensi ukbm
	function list_presensi_ukbm($id='', $all=''){	 
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where a.ref = '$id' ";
			} else {
				$where = $where . " and a.ref = '$id' ";
			}								
		}
		
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.replid, a.tanggal, a.idtingkat, a.idkelas, a.idsiswa, a.idpelajaran, a.idguru, a.idsemester, a.idukbm, a.hadir, a.dispensasi, a.sakit, a.izin, a.alpa, a.uid, a.dlu, a.ref from presensi_ukbm a " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	//---------get data presensi ukbm
	function list_presensi_ukbm_view($id='', $all='', $tingkat='', $kelas='', $tanggal='', $idguru=''){	 
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where a.replid = '$id' ";
			} else {
				$where = $where . " and a.replid = '$id' ";
			}								
		}
		
		if ( $tingkat != "") {
			if ($where == "") {
				$where = " where a.idtingkat = '$tingkat' ";
			} else {
				$where = $where . " and a.idtingkat = '$tingkat' ";
			}								
		}
		
		if ( $kelas != "") {
			if ($where == "") {
				$where = " where a.idkelas = '$kelas' ";
			} else {
				$where = $where . " and a.idkelas = '$kelas' ";
			}								
		}
		
		if ( $tanggal != "") {
			
			$tanggal = date("Y-m-d", strtotime($tanggal));
			
			if ($where == "") {
				$where = " where date_format(a.tanggal,'%Y-%m-%d') = '$tanggal' ";
			} else {
				$where = $where . " and date_format(a.tanggal,'%Y-%m-%d') = '$tanggal' ";
			}								
		}
		
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select distinct a.ref, a.tanggal, a.idpelajaran, a.idguru, a.idsemester, a.idukbm, b.kelas, c.tingkat, d.semester, e.nama nama_guru, f.nama pelajaran, g.kode, g.deskripsi ukbm from presensi_ukbm a left join kelas b on a.idkelas=b.replid left join tingkat c on a.idtingkat=c.replid left join semester d on a.idsemester=d.replid left join pegawai e on a.idguru=e.replid left join pelajaran f on a.idpelajaran=f.replid left join ukbm g on a.idukbm=g.replid " . $where . " order by a.tanggal";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get data siswa
	function list_presensi_ukbm_detail($ref='', $replid='', $idtingkat='', $kelas=''){
		$dbpdo = DB::create();
		
		$where = " where ifnull(a.alumni,0)=0 ";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where d.ref = '$ref' ";
			} else {
				$where = $where . " and d.ref = '$ref' ";
			}
		}
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where b.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and b.idtingkat = '$idtingkat' ";
			}
		}
		
		if ($kelas != "") {
			if ($where == "") {
				$where = " where a.idkelas = '$kelas' ";
			} else {
				$where = $where . " and a.idkelas = '$kelas' ";
			}
		}
		
						
		if($ref=='' && $replid=='' && $idtingkat=='' && $kelas=='') {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	= "select a.replid, d.tanggal, a.nis, a.nama, a.idkelas, b.idtingkat, b.kelas, c.tingkat, d.ref, ifnull(d.hadir,0) hadir, ifnull(d.dispensasi,0) dispensasi, ifnull(d.sakit,0) sakit, ifnull(d.izin,0) izin, ifnull(d.alpa,0) alpa from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid left join presensi_ukbm d on a.replid=d.idsiswa and a.idkelas=d.idkelas and b.idtingkat=d.idtingkat " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get datapredikat_raport
	function list_predikat_raport($id='', $idangkatan='', $idpelajaran='', $all=''){	 
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where a.replid = '$id' ";
			} else {
				$where = $where . " and a.replid = '$id' ";
			}								
		}
		
		if ( $idangkatan != "") {
			if ($where == "") {
				$where = " where a.idangkatan = '$idangkatan' ";
			} else {
				$where = $where . " and a.idangkatan = '$idangkatan' ";
			}								
		}
		
		if ( $idpelajaran != "") {
			if ($where == "") {
				$where = " where a.idpelajaran = '$idpelajaran' ";
			} else {
				$where = $where . " and a.idpelajaran = '$idpelajaran' ";
			}								
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.replid, a.idangkatan, a.idpelajaran, a.kkm, a.kkm_terampil, a.nilai_angka_a, a.nilai_angka_a1, a.nilai_angka_b, a.nilai_angka_b1, a.nilai_angka_c, a.nilai_angka_c1, a.nilai_angka_d, a.nilai_angka_d1, a.nilai_huruf_a, a.nilai_huruf_b, a.nilai_huruf_c, a.nilai_huruf_d, a.deskripsi_p_a, a.deskripsi_k_a, a.deskripsi_p_b, a.deskripsi_k_b, a.deskripsi_p_c, a.deskripsi_k_c, a.deskripsi_p_d, a.deskripsi_k_d, a.uid, a.dlu, b.angkatan, c.nama pelajaran from predikat_raport a left join angkatan b on a.idangkatan=b.replid left join pelajaran c on a.idpelajaran=c.replid " . $where . " order by a.replid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get deskripsi_raport
	function list_deskripsi_raport($id='', $idangkatan='', $sikap='', $all=''){	 
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where a.replid = '$id' ";
			} else {
				$where = $where . " and a.replid = '$id' ";
			}								
		}
		
		if ( $idangkatan != "") {
			if ($where == "") {
				$where = " where a.idangkatan = '$idangkatan' ";
			} else {
				$where = $where . " and a.idangkatan = '$idangkatan' ";
			}								
		}
		
		if ( $sikap != "") {
			if ($where == "") {
				$where = " where a.sikap = '$sikap' ";
			} else {
				$where = $where . " and a.sikap = '$sikap' ";
			}								
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.replid, a.idangkatan, a.sikap, a.sikap_a, a.sikap_b, a.sikap_c, a.uid, a.dlu, b.angkatan from deskripsi_raport a left join angkatan b on a.idangkatan=b.replid " . $where . " order by a.replid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get kelompok surat
	function list_kelompok_surat($id='', $all=''){	 
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where a.replid = '$id' ";
			} else {
				$where = $where . " and a.replid = '$id' ";
			}								
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.replid, a.kode, a.nama, a.uraian, a.aktif, a.uid, a.dlu from kelompok_surat a " . $where . " order by a.replid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get surat keluar
	function list_surat_keluar($kode ='', $from_date='', $to_date='', $idkelompok='', $all=''){	 
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.tanggal >= '$from_date' ";
			} else {
				$where = $where . " and a.tanggal >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.tanggal <= '$to_date' ";
			} else {
				$where = $where . " and a.tanggal <= '$to_date' ";
			}								
		}
		
		if ( $idkelompok != "") {
			if ($where == "") {
				$where = " where a.idkelompok_surat = '$idkelompok' ";
			} else {
				$where = $where . " and a.idkelompok_surat = '$idkelompok' ";
			}								
		}
		
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.no_surat, a.tanggal, a.idkelompok_surat, a.petugas, a.tujuan, a.file_dokumen, a.uid, a.dlu, b.nama kelompok_surat from surat_keluar a left join kelompok_surat b on a.idkelompok_surat=b.replid " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get surat masuk
	function list_surat_masuk($kode ='', $from_date='', $to_date='', $idkelompok='', $all=''){	 
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.tanggal >= '$from_date' ";
			} else {
				$where = $where . " and a.tanggal >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.tanggal <= '$to_date' ";
			} else {
				$where = $where . " and a.tanggal <= '$to_date' ";
			}								
		}
		
		if ( $idkelompok != "") {
			if ($where == "") {
				$where = " where a.idkelompok_surat = '$idkelompok' ";
			} else {
				$where = $where . " and a.idkelompok_surat = '$idkelompok' ";
			}								
		}
		
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.no_surat, a.tanggal, a.idkelompok_surat, a.petugas, a.dari, a.file_dokumen, a.uid, a.dlu, b.nama kelompok_surat from surat_masuk a left join kelompok_surat b on a.idkelompok_surat=b.replid " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get buku kunjungan
	function list_buku_kunjungan($kode ='', $from_date='', $to_date='', $all=''){	 
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.tanggal >= '$from_date' ";
			} else {
				$where = $where . " and a.tanggal >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.tanggal <= '$to_date' ";
			} else {
				$where = $where . " and a.tanggal <= '$to_date' ";
			}								
		}
		
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.tanggal, a.nama, a.nohp, a.instansi, a.ttd, a.keperluan, a.kesan_pesan, a.keterangan, a.uid, a.dlu from buku_kunjungan a " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get pegawai dan siswa
	function list_pegawai_siswa($id='', $jenis=''){	 
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where aa.replid = '$id' ";
			} else {
				$where = $where . " and aa.replid = '$id' ";
			}								
		}
		
		if ( $jenis != "") {
			
			if($jenis == "Guru") {
				$jenis = "Pegawai";
			}
			
			if ($where == "") {
				$where = " where aa.jenis = '$jenis' ";
			} else {
				$where = $where . " and aa.jenis = '$jenis' ";
			}								
		}
		
		if($id == "" && $jenis == "") {
			$where = " where aa.jenis = 'ndf'";
		}
		
		$sqlstr="select aa.* from (
		  select replid, nip, nama, 'Pegawai' jenis, '' kelas, '' tingkat from pegawai where aktif=1 
		  union all 
		  select a.replid, a.nis nip, a.nama, 'siswa' jenis, b.kelas, c.tingkat from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid where (a.alumni=0 or a.alumni=2)) aa " . $where;
		  // and aktif=1
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get data setup siswa khusus
	function list_setup_siswa_khusus($id='', $jenis='', $all=''){	 
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where a.replid = '$id' ";
			} else {
				$where = $where . " and a.replid = '$id' ";
			}								
		}
		
		if ( $jenis != "") {
			if ($where == "") {
				$where = " where a.jenis = '$jenis' ";
			} else {
				$where = $where . " and a.jenis = '$jenis' ";
			}								
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.replid, a.tanggal, a.tanggal1, a.jenis, a.idsiswa, a.uid, a.dlu from setup_siswa_khusus a " . $where . " order by a.replid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get data identitas
	function list_identitas($id=''){	 
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where a.replid = '$id' ";
			} else {
				$where = $where . " and a.replid = '$id' ";
			}								
		}
		
		$sqlstr="select a.replid, a.nama, a.situs, a.email, a.alamat1, a.alamat2, a.alamat3, a.alamat4, a.telp1, a.telp2, a.telp3, a.telp4, a.fax1, a.fax2, a.keterangan, a.foto, a.departemen, a.status, a.perpustakaan, a.info1, a.info2, a.info3, a.ts from identitas a " . $where . " order by a.replid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get data nilai
	function list_daftarnilai($nis='', $idtingkat='', $idkelas='', $idtahunajaran='', $idsemester='', $idpelajaran='', $iddasarpenilaian='', $nis2=''){	 
		$dbpdo = DB::create();
						
		$where = "";
		
		if ( $nis != "") {
			if ($where == "") {
				$where = " where a.nis = '$nis' ";
			} else {
				$where = $where . " and a.nis = '$nis' ";
			}								
		}
		
		if ( $idtingkat != "") {
			if ($where == "") {
				$where = " where a.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and a.idtingkat = '$idtingkat' ";
			}								
		}
		
		if ( $idkelas != "") {
			if ($where == "") {
				$where = " where a.idkelas = '$idkelas' ";
			} else {
				$where = $where . " and a.idkelas = '$idkelas' ";
			}								
		}
		
		
		if( (substr($nis2,0,4)== '1819' || substr($nis2,0,4)== '1718') && $idtahunajaran == 44 ) {
			
			//khusus angkatan : 1819 (tidak adath ajaran), jika setelah update ada thn ajaran makan hrs difilter thn ajaran
			$strsql2 = "select a.replid from daftarnilai a where a.nis = '$nis' and a.idtingkat = '$idtingkat' and a.idkelas = '$idkelas' and a.idsemester = '$idsemester' and a.idpelajaran = '$idpelajaran' and a.iddasarpenilaian = '$iddasarpenilaian' and a.idtahunajaran = '$idtahunajaran' order by a.replid";
			$sql2=$dbpdo->prepare($strsql2);
			$sql2->execute();
			$rows = $sql2->rowCount();
			if($rows > 0) {
				if ( $idtahunajaran != "") {
					if ($where == "") {
						$where = " where a.idtahunajaran = '$idtahunajaran' ";
					} else {
						$where = $where . " and a.idtahunajaran = '$idtahunajaran' ";
					}								
				}
			} 
		} else {
			if ( $idtahunajaran != "") {
				if ($where == "") {
					$where = " where a.idtahunajaran = '$idtahunajaran' ";
				} else {
					$where = $where . " and a.idtahunajaran = '$idtahunajaran' ";
				}								
			}
		}
		
		
		if ( $idsemester != "") {
			if ($where == "") {
				$where = " where a.idsemester = '$idsemester' ";
			} else {
				$where = $where . " and a.idsemester = '$idsemester' ";
			}								
		}
		
		if ( $idpelajaran != "") {
			if ($where == "") {
				$where = " where a.idpelajaran = '$idpelajaran' ";
			} else {
				$where = $where . " and a.idpelajaran = '$idpelajaran' ";
			}								
		}
		
		if ( $iddasarpenilaian != "") {
			if ($where == "") {
				$where = " where a.iddasarpenilaian = '$iddasarpenilaian' ";
			} else {
				$where = $where . " and a.iddasarpenilaian = '$iddasarpenilaian' ";
			}								
		}
		
		
		$sqlstr="select a.replid, a.departemen, a.idtingkat, a.idkelas, a.idtahunajaran, a.idsemester, a.nis, a.idkompetensi, a.idjeniskompetensi, a.iddasarpenilaian, a.idpelajaran, a.uts, a.jumlah, a.rata, a.persen, a.uas, a.persen1, a.na, a.a, a.sakit, a.izin, a.alpa, a.dispensasi, a.sikap, a.line from daftarnilai a " . $where . " order by a.replid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data list_daftarnilai detail
	function list_daftarnilai_detail($id=''){	 
		$dbpdo = DB::create();
			
		$sqlstr="select a.replid, a.nilai, a.line from daftarnilai_detail a where a.replid = '$id' order by a.line";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data list_daftarnilai detail2
	function list_daftarnilai_detail_dasarpenilaian($departemen='', $idtingkat='', $idkelas='', $idtahunajaran='', $idsemester='', $nis='', $idkompetensi='', $idjeniskompetensi='', $iddasarpenilaian='', $idpelajaran='', $line=''){	 
		$dbpdo = DB::create();
				
		$sqlstr="select a.replid, a.nilai, a.line, b.uas from daftarnilai_detail a left join daftarnilai b on a.replid=b.replid where b.departemen='$departemen' and b.idtingkat='$idtingkat' and	b.idkelas='$idkelas' and b.idtahunajaran='$idtahunajaran' and b.idsemester='$idsemester' and	b.nis='$nis' and b.idkompetensi='$idkompetensi' and	b.idjeniskompetensi='$idjeniskompetensi' and b.iddasarpenilaian='$iddasarpenilaian' and b.idpelajaran='$idpelajaran' and a.line='$line' order by a.line";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data material
	function list_material($kode ='', $active='', $code='', $old_code='', $name='', $client_code='', $invoice_no=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.syscode = '$kode' ";
			} else {
				$where = $where . " and a.syscode = '$kode' ";
			}								
		}
		
		if ( $active != "") {
			if ($where == "") {
				$where = " where a.active = '$active' ";
			} else {
				$where = $where . " and a.active = '$active' ";
			}								
		}
		
		if ( $code != "") {
			if ($where == "") {
				$where = " where a.code = '$code' ";
			} else {
				$where = $where . " and a.code = '$code' ";
			}								
		}
		
		if ( $old_code != "") {
			if ($where == "") {
				$where = " where a.old_code = '$old_code' ";
			} else {
				$where = $where . " and a.old_code = '$old_code' ";
			}								
		}
		
		if ( $name != "") {
			$name = petikreplace($name);
			if ($where == "") {
				$where = " where a.syscode = '$name' ";
			} else {
				$where = $where . " and a.syscode = '$name' ";
			}								
		}
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		
		if ( $invoice_no != "") {
			if ($where == "") {
				$where = " where d.ref = '$invoice_no' ";
			} else {
				$where = $where . " and d.ref = '$invoice_no' ";
			}								
		}
		
		if($kode=='' && $all==0 && $act=='' && $code=='' && $old_code=='' && $name=='' && $client_code=='' && $invoice_no=='') {
			$where = " where a.syscode = 'NDF' ";
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.code, a.old_code, a.name, a.item_group_id, a.item_subgroup_id, a.item_type_code, a.item_category_id, a.brand_id, a.size_id, a.uom_code_stock, a.uom_code_sales, a.uom_code_purchase, a.minimum_stock, a.maximum_stock, a.photo, a.consigned, a.active, a.uid, a.dlu, a.syscode from item a " . $where . " order by a.code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data item
	function list_item($kode ='', $all=0, $active='', $code='', $old_code='', $name='', $item_group_id='', $from_date='', $to_date=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.syscode = '$kode' ";
			} else {
				$where = $where . " and a.syscode = '$kode' ";
			}								
		}
		
		if ( $active != "") {
			if ($where == "") {
				$where = " where a.active = '$active' ";
			} else {
				$where = $where . " and a.active = '$active' ";
			}								
		}
		
		if ( $code != "") {
			if ($where == "") {
				$where = " where a.code = '$code' ";
			} else {
				$where = $where . " and a.code = '$code' ";
			}								
		}
		
		if ( $old_code != "") {
			if ($where == "") {
				$where = " where a.old_code = '$old_code' ";
			} else {
				$where = $where . " and a.old_code = '$old_code' ";
			}								
		}
		
		if ( $name != "") {
			$name = petikreplace($name);
			if ($where == "") {
				$where = " where a.syscode = '$name' ";
			} else {
				$where = $where . " and a.syscode = '$name' ";
			}								
		}
		
		if ( $item_group_id != "") {
			if ($where == "") {
				$where = " where a.item_group_id = '$item_group_id' ";
			} else {
				$where = $where . " and a.item_group_id = '$item_group_id' ";
			}								
		}
		
		if ( $from_date != "") {
			
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where date_format(a.dlu, '%Y-%m-%d') >= '$from_date' ";
			} else {
				$where = $where . " and date_format(a.dlu, '%Y-%m-%d') >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where date_format(a.dlu, '%Y-%m-%d') <= '$to_date' ";
			} else {
				$where = $where . " and date_format(a.dlu, '%Y-%m-%d') <= '$to_date' ";
			}								
		}
		
		/*if($kode=='' && $all==0 && $act=='' && $code=='' && $old_code=='' && $name=='' && $item_group_id=='' && $from_date=='' && $to_date=='') {
			$where = " where a.syscode = 'NDF' ";
		}*/
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.code, a.old_code, a.name, a.item_group_id, b.name item_group_name, a.item_subgroup_id, a.item_type_code, a.item_category_id, a.brand_id, a.size_id, a.uom_code_stock, a.uom_code_sales, a.uom_code_purchase, a.minimum_stock, a.maximum_stock, a.photo, a.consigned, a.balance, a.active, a.uid, a.dlu, a.syscode from item a left join item_group b on a.item_group_id=b.id " . $where . " order by a.code";
		//echo $sqlstr;
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data item group
	function list_item_group($kode ='', $all=0, $act=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.id = '$kode' ";
			} else {
				$where = $where . " and a.id = '$kode' ";
			}								
		}
		
		$sqlstr="select a.id, a.code, a.name, a.nonstock, a.costing_type, a.inventory_acccode, a.purchase_discount_acccode, a.goodintransit_acccode, a.workinprocess_acccode, a.cogs_acccode, a.consignment_acccode, a.location_id, a.active, a.uid, a.dlu from item_group a " . $where . " order by a.id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data brand
	function list_brand($kode ='', $all=0, $act=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.id = '$kode' ";
			} else {
				$where = $where . " and a.id = '$kode' ";
			}								
		}
		
		$sqlstr="select a.id, a.code, a.name, a.active, a.uid, a.dlu from brand a " . $where . " order by a.id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data asset (gedung)
	function list_build($kode ='', $asset_name='', $alias='', $tanggal_perolehan='', $group_block='', $asset_type_id='', $all=0){	 
		
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $asset_name != "") {
			if ($where == "") {
				$where = " where a.asset_name like '%$asset_name%' ";
			} else {
				$where = $where . " and a.asset_name like '%$asset_name%' ";
			}								
		}
		
		if ( $alias != "") {
			if ($where == "") {
				$where = " where a.alias like '%$alias%' ";
			} else {
				$where = $where . " and a.alias like '%$alias%' ";
			}								
		}
		
		if ( $tanggal_perolehan != "") {
			
			$tanggal_perolehan = date("Y-m-d", strtotime($tanggal_perolehan));
			
			if ($where == "") {
				$where = " where a.tanggal_perolehan = '$tanggal_perolehan' ";
			} else {
				$where = $where . " and a.tanggal_perolehan = '$tanggal_perolehan' ";
			}								
		}
				
		if ( $group_block != "") {
			if ($where == "") {
				$where = " where a.group_block like '%$group_block%' ";
			} else {
				$where = $where . " and a.group_block like '%$group_block%' ";
			}								
		}
		
		if ( $asset_type_id != "") {
			if ($where == "") {
				$where = " where a.asset_type_id = '$asset_type_id' ";
			} else {
				$where = $where . " and a.asset_type_id = '$asset_type_id' ";
			}								
		}
		
		
		if($kode == '' && $asset_name == '' && $alias == '' && $tanggal_perolehan == '' && $group_block == '' && $asset_type_id=="" && $all == 0) {
			$where = " where a.ref = 'ndf' ";
		}
		
		if($all == 1) {
			$where = "";
		}		
		
		$sqlstr="select a.ref, a.asset_name, a.alias, a.ref_id, a.lokasi, a.provinsi_kode, a.kota_kode, a.kecamatan_kode, a.desa_kode, a.asset_type_id, b.type asset_type, a.status, a.luas, a.sertifikat, a.imb, a.tanggal_perolehan, a.pemilik_sebelum, a.contact_name, a.no_pbb, a.group_block, a.alamat, a.lintang, a.bujur, a.nilai_perolehan, a.nilai_amnesti, a.pemilik_sekarang, a.pemilik_sekarang1, a.pemilik_sekarang2, a.photo, a.photo_1, a.photo_2, a.photo_3, a.photo_4, a.shm, a.shm_nama, a.ajb, a.pbb, a.keterangan, a.provinsi, a.kota, a.kecamatan, a.desa, a.active, a.uid, a.dlu from asset a left join asset_type b on a.asset_type_id=b.id " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get data room
	function list_room($ref ='', $code='', $name='', $all=0, $asset_ref=''){	 
		
		$dbpdo = DB::create();
			
		$where = " where b.asset_type_id=1 ";
		
		if ( $ref != "") {
			if ($where == "") {
				$where = " where a.ref = '$ref' ";
			} else {
				$where = $where . " and a.ref = '$ref' ";
			}								
		}
		
		if ( $code != "") {
			if ($where == "") {
				$where = " where a.code = '$code' ";
			} else {
				$where = $where . " and a.code = '$code' ";
			}								
		}
		
		if ( $name != "") {
			if ($where == "") {
				$where = " where a.name like '%$name%' ";
			} else {
				$where = $where . " and a.name like '%$name%' ";
			}								
		}
		
		if ( $asset_ref != "") {
			if ($where == "") {
				$where = " where a.asset_ref = '$asset_ref' ";
			} else {
				$where = $where . " and a.asset_ref = '$asset_ref' ";
			}								
		}
		
		
		if($ref == '' && $code == '' && $name == '' && $all == 0 && $asset_ref == "") {
			$where = " where a.ref = 'ndf' ";
		}
		
		if($all == 1) {
			$where = " where b.asset_type_id=1 ";
		}		
		
		$sqlstr="select a.ref, a.asset_ref, a.code, a.name, a.employee_id, a.active, a.booking, a.booking_chamber, a.uid, a.dlu, c.nama employee_name from asset_detail a left join asset b on a.asset_ref=b.ref left join pegawai c on a.employee_id=c.replid " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	//-----------room booking detail
	function get_room_booking_detail($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select distinct a.ref, a.room_ref, b.name, b.asset_type, c.asset_name build_name, 1 slc, 1 old from room_registration_detail a left join asset_detail b on a.room_ref=b.ref left join asset c on b.asset_ref=c.ref where a.ref='$id'";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//-----------get ruang 
	function get_room_booking($submit='') {
		$dbpdo = DB::create();
		
		/*$where = " where a.active=1 and (name like '%Theater%' or name like '%Kelas%' or name like '%Rapat%' or name like '%Gedung Serba Guna%') ";*/
		
		$where = " where a.active=1 and a.booking=1";
				
		$sqlstr="select a.ref, a.asset_ref, a.code, a.name, a.asset_type, a.active, a.uid, a.dlu, b.asset_name build_name from asset_detail a left join asset b on a.asset_ref=b.ref ". $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//-----------room booking cek ready
	function get_room_booking_ready($room_ref, $submit='', $booked='', $book_finish='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $room_ref != "") {
			if ($where == "") {
				$where = " where a.room_ref = '$room_ref' ";
			} else {
				$where = $where . " and a.room_ref = '$room_ref' ";
			}								
		}
		
		if ( $booked != "" && $book_finish != "") {
			
			$booked = date("Y-m-d H:i", strtotime($booked));
			$book_finish = date("Y-m-d H:i", strtotime($book_finish));
			
			if ($where == "") {
				$where = " where a.to_date >= '$booked' and a.date <= '$booked' ";
			} else {
				$where = $where . " and a.to_date >= '$booked' and a.date <= '$booked' ";
			}								
		}
		
		if($submit == "") {
			$where = "";
		}
		
		$sqlstr="select a.room_ref from room_registration_detail a left join room_registration b on a.ref=b.ref " . $where . " order by a.room_ref limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get room_booking
	function list_room_booking($ref ='', $from_date='', $to_date='', $all=0, $year=''){	 
		
		$dbpdo = DB::create();
			
		$where = ""; // where a.booking = 1
		
		if ( $ref != "") {
			if ($where == "") {
				$where = " where a.ref = '$ref' ";
			} else {
				$where = $where . " and a.ref = '$ref' ";
			}								
		}
		
		if ( $from_date != "") {
			
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		if ( $year != "") {
			if ($where == "") {
				$where = " where date_format(a.booked, '%Y') = '$year' ";
			} else {
				$where = $where . " and date_format(a.booked, '%Y') = '$year' ";
			}								
		}
		
		
		
		if($ref == '' && $from_date == '' && $to_date == '' && $all == 0 && $year == '') {
			$where = ""; // where a.ref = 'ndf' 
		}
		
		if($all == 1) {
			$where = ""; //where a.booking = 1
		}		
		
		$sqlstr="select a.ref, a.date, a.name, a.identity_type_id, a.identity_no, a.email, a.phone, a.address, a.booking, a.booked_finish, a.booked, a.arriving, a.sex, a.checkout, a.checkout_date, a.memo, a.uid, a.dlu from room_registration a " . $where . " order by a.date desc, a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//-----------room booking detail
	function list_room_booking_detail($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select aa.* from (select distinct a.ref, a.room_ref, b.name, b.asset_type, c.asset_name build_name, 1 slc, 1 old from room_registration_detail a left join asset_detail b on a.room_ref=b.ref left join asset c on b.asset_ref=c.ref where a.ref='$id' union all
		select 0 ref, a.ref room_ref, a.name, a.asset_type, b.asset_name build_name, 0 slc, 0 old from asset_detail a left join asset b on a.asset_ref=b.ref where a.booking=1 and a.ref not in (select room_ref from room_registration_detail where ref='$id' )) aa order by aa.ref desc, aa.name ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data guru_absen
	function list_guru_absen($ref='', $tanggal='', $idguru='', $idtingkat='', $idkelas='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		if ($tanggal != "") {
			
			$tanggal = date("Y-m-d", strtotime($tanggal));
			
			if ($where == "") {
				$where = " where a.tanggal = '$tanggal' ";
			} else {
				$where = $where . " and a.tanggal = '$tanggal' ";
			}
		}
		
		if ($idguru != "") {
			if ($where == "") {
				$where = " where a.idguru = '$idguru' ";
			} else {
				$where = $where . " and a.idguru = '$idguru' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where a.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and a.idtingkat = '$idtingkat' ";
			}
		}
		
		if ($idkelas != "") {
			if ($where == "") {
				$where = " where a.idkelas = '$idkelas' ";
			} else {
				$where = $where . " and a.idkelas = '$idkelas' ";
			}
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr	=	"select a.replid, a.tanggal, a.idguru, a.idtingkat, a.idkelas, a.alasan, a.tugas, a.uid, a.dlu, b.nip, b.nama nama_guru, c.tingkat, d.kelas from guru_absen a left join pegawai b on a.idguru=b.replid left join tingkat c on a.idtingkat=c.replid left join kelas d on a.idkelas=d.replid " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data siswa terlambat
	function list_siswa_terlambat($ref='', $tanggal='', $idsiswa='', $idtingkat='', $idkelas='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		if ($tanggal != "") {
			
			$tanggal = date("Y-m-d", strtotime($tanggal));
			
			if ($where == "") {
				$where = " where a.tanggal = '$tanggal' ";
			} else {
				$where = $where . " and a.tanggal = '$tanggal' ";
			}
		}
		
		if ($idsiswa != "") {
			if ($where == "") {
				$where = " where a.idsiswa = '$idsiswa' ";
			} else {
				$where = $where . " and a.idsiswa = '$idsiswa' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where a.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and a.idtingkat = '$idtingkat' ";
			}
		}
		
		if ($idkelas != "") {
			if ($where == "") {
				$where = " where a.idkelas = '$idkelas' ";
			} else {
				$where = $where . " and a.idkelas = '$idkelas' ";
			}
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr	=	"select a.replid, a.tanggal, a.idsiswa, a.idtingkat, a.idkelas, a.alasan, a.penanganan, a.uid, a.dlu, b.nis, b.nama nama_siswa, c.tingkat, d.kelas from siswa_terlambat a left join siswa b on a.idsiswa=b.replid left join tingkat c on a.idtingkat=c.replid left join kelas d on a.idkelas=d.replid " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data siswa izin
	function list_siswa_izin($ref='', $tanggal='', $idsiswa='', $idtingkat='', $idkelas='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		if ($tanggal != "") {
			
			$tanggal = date("Y-m-d", strtotime($tanggal));
			
			if ($where == "") {
				$where = " where a.tanggal = '$tanggal' ";
			} else {
				$where = $where . " and a.tanggal = '$tanggal' ";
			}
		}
		
		if ($idsiswa != "") {
			if ($where == "") {
				$where = " where a.idsiswa = '$idsiswa' ";
			} else {
				$where = $where . " and a.idsiswa = '$idsiswa' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where a.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and a.idtingkat = '$idtingkat' ";
			}
		}
		
		if ($idkelas != "") {
			if ($where == "") {
				$where = " where a.idkelas = '$idkelas' ";
			} else {
				$where = $where . " and a.idkelas = '$idkelas' ";
			}
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr	=	"select a.replid, a.tanggal, a.idsiswa, a.idtingkat, a.idkelas, a.alasan, a.penanganan, a.uid, a.dlu, b.nis, b.nama nama_siswa, c.tingkat, d.kelas from siswa_izin a left join siswa b on a.idsiswa=b.replid left join tingkat c on a.idtingkat=c.replid left join kelas d on a.idkelas=d.replid " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data kejadian_lain
	function list_kejadian_lain($ref='', $tanggal='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		if ($tanggal != "") {
			
			$tanggal = date("Y-m-d", strtotime($tanggal));
			
			if ($where == "") {
				$where = " where a.tanggal = '$tanggal' ";
			} else {
				$where = $where . " and a.tanggal = '$tanggal' ";
			}
		}
		
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr	=	"select a.replid, a.tanggal, a.jenis, a.penanganan, a.uid, a.dlu from kejadian_lain a " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data guru_bk
	function list_guru_bk($ref='', $idtahunajaran='', $idguru='', $aktif='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		if ($idguru != "") {
			if ($where == "") {
				$where = " where a.idguru = '$idguru' ";
			} else {
				$where = $where . " and a.idguru = '$idguru' ";
			}
		}
		
		if ($idtahunajaran != "") {
			if ($where == "") {
				$where = " where a.idtahunajaran = '$idtahunajaran' ";
			} else {
				$where = $where . " and a.idtahunajaran = '$idtahunajaran' ";
			}
		}
		
		if ($aktif != "") {
			if ($where == "") {
				$where = " where a.aktif = '$aktif' ";
			} else {
				$where = $where . " and a.aktif = '$aktif' ";
			}
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr	=	"select a.replid, a.idtahunajaran, a.idguru, a.aktif, a.uid, a.dlu, b.nip, b.nama nama_guru, c.tahunajaran from guru_bk a left join pegawai b on a.idguru=b.replid left join tahunajaran c on a.idtahunajaran=c.replid " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data guru_penugasan
	function list_guru_penugasan($ref='', $idtahunajaran='', $idguru='', $idtingkat='', $idkelas='', $aktif='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		if ($idguru != "") {
			if ($where == "") {
				$where = " where a.idguru = '$idguru' ";
			} else {
				$where = $where . " and a.idguru = '$idguru' ";
			}
		}
		
		if ($idtahunajaran != "") {
			if ($where == "") {
				$where = " where a.idtahunajaran = '$idtahunajaran' ";
			} else {
				$where = $where . " and a.idtahunajaran = '$idtahunajaran' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where a.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and a.idtingkat = '$idtingkat' ";
			}
		}
		
		if ($idkelas != "") {
			if ($where == "") {
				$where = " where a.idkelas = '$idkelas' ";
			} else {
				$where = $where . " and a.idkelas = '$idkelas' ";
			}
		}
		
		if ($aktif != "") {
			if ($where == "") {
				$where = " where a.aktif = '$aktif' ";
			} else {
				$where = $where . " and a.aktif = '$aktif' ";
			}
		}
		
		if($all == 1) {
			$where = "";
		}
		
		/*$sqlstr	=	"select a.replid, a.idtahunajaran, a.idguru, a.idkelas, a.idtingkat, a.aktif, a.uid, a.dlu, c.nip, c.nama nama_guru, d.tahunajaran from guru_penugasan a left join guru b on a.idguru=b.replid left join pegawai c on b.nip=c.replid left join tahunajaran d on a.idtahunajaran=d.replid " . $where . " order by a.replid ";*/
		$sqlstr	=	"select distinct a.idtahunajaran, a.idguru, a.aktif, c.nip, c.nama nama_guru, d.tahunajaran from guru_penugasan a left join guru b on a.idguru=b.replid left join pegawai c on b.nip=c.replid left join tahunajaran d on a.idtahunajaran=d.replid " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//-----------get kelas guru penugasan
	function get_guru_kelas($idtingkat='') {
		$dbpdo = DB::create();
		
		$sqlstr = "select replid, kelas from kelas where idtingkat='$idtingkat' order by replid, kelas";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//-----------get guru penugasan kelas
	function get_guru_penugasan_kelas($idtahunajaran='', $idguru='', $idtingkat='', $idkelas='') {
		$dbpdo = DB::create();
		
		$sqlstr = "select idkelas from guru_penugasan where idtahunajaran='$idtahunajaran' and idguru='$idguru' and idtingkat='$idtingkat' and idkelas='$idkelas' order by replid";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//-----------get guru penugasan kelas
	function get_penugasan_kelas($idtahunajaran='', $idguru='') {
		$dbpdo = DB::create();
		
		$sqlstr = "select a.idtahunajaran, a.idguru, a.idkelas, b.kelas, c.tingkat from guru_penugasan a left join kelas b on a.idkelas=b.replid left join tingkat c on a.idtingkat=c.replid where a.idtahunajaran='$idtahunajaran' and a.idguru='$idguru' order by a.replid";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data user
	function list_usr_siswa_baru($usrid=''){	
		$dbpdo = DB::create();
		
		
		$sqlstr = "select a.id, a.usrid, a.pwd, a.adm, b.pwd pwdori, a.photo, a.departemen, a.idpegawai, a.tipe_user, a.ganti_pwd_no, a.act, a.uid, a.dlu from usr a left join usr_bup b on a.usrid=b.usrid where a.usrid = '$usrid' order by a.usrid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		return $sql;
	}
	
	//---------get data gugus
	function list_gugus($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.gugus, a.kapasitas, a.kapasitas_l, a.kapasitas_p, a.uid, a.dlu from gugus a " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data infonap
	function list_infonap($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpelajaran, a.nilaimin, a.ts, b.nama nama_mapel from infonap a left join pelajaran b on a.idpelajaran=b.replid " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data kecamatan
	function list_kecamatan($id=''){	 
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.syscode = '$id' ";
			} else {
				$where = $where . " and a.syscode = '$id' ";
			}
		}
			
		$sqlstr="select a.syscode, a.nama from kecamatan a ". $where . " order by a.kode";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data desa
	function list_desa($id=''){	 
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.syscode = '$id' ";
			} else {
				$where = $where . " and a.syscode = '$id' ";
			}
		}
			
		$sqlstr="select a.syscode, a.nama from desa a ". $where . " order by a.kode";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data siswa krs approved view
	function list_absensi_siswa_krs($replid='', $idtingkat='', $idkelas2='', $semester_id='', $pelajaran_id='', $idtahunajaran='', $approved=1){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idtahunajaran != "") {
			if ($where == "") {
				$where = " where a.idtahunajaran = '$idtahunajaran' ";
			} else {
				$where = $where . " and a.idtahunajaran = '$idtahunajaran' ";
			}
		}
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where c.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and c.idtingkat = '$idtingkat' ";
			}
		}
		
		if ($idkelas2 != "") {
			if ($where == "") {
				$where = " where b.idkelas = '$idkelas2' ";
			} else {
				$where = $where . " and b.idkelas = '$idkelas2' ";
			}
		}
		
		if ($semester_id != "") {
			if ($where == "") {
				$where = " where a.semester_id = '$semester_id' ";
			} else {
				$where = $where . " and a.semester_id = '$semester_id' ";
			}
		}
		
		if ($pelajaran_id != "") {
			if ($where == "") {
				$where = " where a.pelajaran_id = '$pelajaran_id' ";
			} else {
				$where = $where . " and a.pelajaran_id = '$pelajaran_id' ";
			}
		}
		
		if($approved == 1) {
			if ($where == "") {
				$where = " where a.approved = 1 ";
			} else {
				$where = $where . " and a.approved = 1 ";
			}
		}
		
		if($approved == 0) {
			if ($where == "") {
				$where = " where ifnull(a.approved,0) = 0 ";
			} else {
				$where = $where . " and ifnull(a.approved,0) = 0 ";
			}
		}
		
		if($_SESSION["tipe_user"] != "Guru") {
			if($replid=='' && $idtingkat=='' && $idkelas2=='' && $semester_id=='' && $pelajaran_id=='') {
				$where = " where a.nis = 'ndf' ";
			}
		} else {
			if($replid=='' && $idtingkat=='' && $idkelas2=='' && $semester_id=='' && $pelajaran_id=='') {
				$where = " where a.nis = 'ndf' ";
			}
		}
		
		$sqlstr	=	"select distinct a.nis, a.semester_id, b.idkelas, b.nama nama_siswa, b.kelamin, c.kelas, c.idtingkat, d.tingkat, e.semester, f.tahunajaran from siswa_krs a left join siswa b on a.nis=b.nis left join kelas c on b.idkelas=c.replid left join tingkat d on c.idtingkat=d.replid left join semester e on a.semester_id=e.replid left join tahunajaran f on a.idtahunajaran=f.replid " . $where . " order by b.nama";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data setup periode raport
	function list_setup_periode_raport($id='', $idtahunajaran='', $semester_id='', $tingkat_id='', $all=''){	 
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where a.replid = '$id' ";
			} else {
				$where = $where . " and a.replid = '$id' ";
			}								
		}
		
		if ( $idtahunajaran != "") {
			if ($where == "") {
				$where = " where a.idtahunajaran = '$idtahunajaran' ";
			} else {
				$where = $where . " and a.idtahunajaran = '$idtahunajaran' ";
			}								
		}
		
		if ( $semester_id != "") {
			if ($where == "") {
				$where = " where a.semester_id = '$semester_id' ";
			} else {
				$where = $where . " and a.semester_id = '$semester_id' ";
			}								
		}
		
		if ( $tingkat_id != "") {
			if ($where == "") {
				$where = " where a.tingkat_id = '$tingkat_id' ";
			} else {
				$where = $where . " and a.tingkat_id = '$tingkat_id' ";
			}								
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.replid, a.idtahunajaran, a.semester_id, a.tingkat_id, a.tanggal_ttd, a.aktif, a.uid, a.dlu, b.tahunajaran, c.semester, d.tingkat from setup_periode_raport a left join tahunajaran b on a.idtahunajaran=b.replid left join semester c on a.semester_id=c.replid left join tingkat d on a.tingkat_id=d.replid " . $where . " order by a.replid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get data setup periode raport pts
	function list_setup_periode_raport_pts($id='', $idtahunajaran='', $semester_id='', $tingkat_id='', $all=''){	 
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where a.replid = '$id' ";
			} else {
				$where = $where . " and a.replid = '$id' ";
			}								
		}
		
		if ( $idtahunajaran != "") {
			if ($where == "") {
				$where = " where a.idtahunajaran = '$idtahunajaran' ";
			} else {
				$where = $where . " and a.idtahunajaran = '$idtahunajaran' ";
			}								
		}
		
		if ( $semester_id != "") {
			if ($where == "") {
				$where = " where a.semester_id = '$semester_id' ";
			} else {
				$where = $where . " and a.semester_id = '$semester_id' ";
			}								
		}
		
		if ( $tingkat_id != "") {
			if ($where == "") {
				$where = " where a.tingkat_id = '$tingkat_id' ";
			} else {
				$where = $where . " and a.tingkat_id = '$tingkat_id' ";
			}								
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.replid, a.idtahunajaran, a.semester_id, a.tingkat_id, a.tanggal_ttd, a.aktif, a.uid, a.dlu, b.tahunajaran, c.semester, d.tingkat from setup_periode_raport_pts a left join tahunajaran b on a.idtahunajaran=b.replid left join semester c on a.semester_id=c.replid left join tingkat d on a.tingkat_id=d.replid " . $where . " order by a.replid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get data KRS
	function get_kartu_rencana_studi_absensi($replid='', $kelompok_pelajaran_id='', $tingkat_id='', $semester_id='', $peminatan='', $idtahunajaran='', $idminat=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($peminatan != "") {
			if ($where == "") {
				$where = " where a.peminatan = '$peminatan' ";
			} else {
				$where = $where . " and a.peminatan = '$peminatan' ";
			}
		}
		
		if ($kelompok_pelajaran_id != "") {
			if ($where == "") {
				$where = " where a.kelompok_pelajaran_id = '$kelompok_pelajaran_id' ";
			} else {
				$where = $where . " and a.kelompok_pelajaran_id = '$kelompok_pelajaran_id' ";
			}
		}
		
		if ($tingkat_id != "") {
			if ($where == "") {
				$where = " where a.tingkat_id = '$tingkat_id' ";
			} else {
				$where = $where . " and a.tingkat_id = '$tingkat_id' ";
			}
		}
		
		if ($semester_id != "") {
			if ($where == "") {
				$where = " where a.semester_id = '$semester_id' ";
			} else {
				$where = $where . " and a.semester_id = '$semester_id' ";
			}
		}
		
		if ($idtahunajaran != "") {
			if ($where == "") {
				$where = " where a.idtahunajaran = '$idtahunajaran' ";
			} else {
				$where = $where . " and a.idtahunajaran = '$idtahunajaran' ";
			}
		}
		
		if($idminat == 1) { //MIPA
			$sqlstr	=	"select a.replid, a.peminatan, a.tingkat_id, a.kelompok_pelajaran_id, a.pelajaran_kode, a.pelajaran_id, a.semester_id, a.sks, a.idtahunajaran, a.urutan, a.uid, a.dlu, f.tahunajaran nama_tahunajaran, b.tingkat, c.nama nama_pelajaran, c.kode, d.semester, e.dcr kelompok_pelajaran from kartu_rencana_studi a left join tingkat b on a.tingkat_id=b.replid left join pelajaran c on a.pelajaran_id=c.replid left join semester d on a.semester_id=d.replid left join (select '1' cde, 'Kelompok A' dcr, 0 nmr union all 
		select '2' cde, 'Kelompok B' dcr, 1 nmr union all 
		select '3' cde, 'Kelompok Peminatan MIPA' dcr, 2 nmr union all 
		select '4' cde, 'Lintas Peminatan' dcr, 3 nmr) e on a.kelompok_pelajaran_id=e.cde left join tahunajaran f on a.idtahunajaran=f.replid " . $where . " order by a.kelompok_pelajaran_id, a.urutan, a.replid";
			
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		} else if($idminat == 2) { //IPS
			$sqlstr	=	"select a.replid, a.peminatan, a.tingkat_id, a.kelompok_pelajaran_id, a.pelajaran_kode, a.pelajaran_id, a.semester_id, a.sks, a.idtahunajaran, a.urutan, a.uid, a.dlu, f.tahunajaran nama_tahunajaran, b.tingkat, c.nama nama_pelajaran, c.kode, d.semester, e.dcr kelompok_pelajaran from kartu_rencana_studi a left join tingkat b on a.tingkat_id=b.replid left join pelajaran c on a.pelajaran_id=c.replid left join semester d on a.semester_id=d.replid left join (select '1' cde, 'Kelompok A' dcr, 0 nmr union all 
		select '2' cde, 'Kelompok B' dcr, 1 nmr union all 
		select '3' cde, 'Kelompok Peminatan IPS' dcr, 2 nmr union all 
		select '4' cde, 'Lintas Peminatan' dcr, 3 nmr) e on a.kelompok_pelajaran_id=e.cde left join tahunajaran f on a.idtahunajaran=f.replid " . $where . " order by a.kelompok_pelajaran_id, a.urutan, a.replid";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		} else {			
			$sqlstr	=	"select a.replid, a.peminatan, a.tingkat_id, a.kelompok_pelajaran_id, a.pelajaran_kode, a.pelajaran_id, a.semester_id, a.sks, a.idtahunajaran, a.urutan, a.uid, a.dlu, f.tahunajaran nama_tahunajaran, b.tingkat, c.nama nama_pelajaran, c.kode, d.semester, e.dcr kelompok_pelajaran from kartu_rencana_studi a left join tingkat b on a.tingkat_id=b.replid left join pelajaran c on a.pelajaran_id=c.replid left join semester d on a.semester_id=d.replid left join (select '1' cde, 'Kelompok A' dcr, 0 nmr union all 
		select '2' cde, 'Kelompok B' dcr, 1 nmr union all 
		select '3' cde, 'Kelompok Peminatan MIPA dan IPS' dcr, 2 nmr union all 
		select '4' cde, 'Lintas Peminatan' dcr, 3 nmr) e on a.kelompok_pelajaran_id=e.cde left join tahunajaran f on a.idtahunajaran=f.replid " . $where . " order by a.kelompok_pelajaran_id, a.urutan, a.replid";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();			
		}
		
		return $sql;		
	}
	
	
	//---------get data nilai pts
	function list_daftarnilai_pts($nis='', $idtingkat='', $idkelas='', $idtahunajaran='', $idsemester='', $idpelajaran='', $iddasarpenilaian='', $nis2=''){	 
		$dbpdo = DB::create();
						
		$where = "";
		
		if ( $nis != "") {
			if ($where == "") {
				$where = " where a.nis = '$nis' ";
			} else {
				$where = $where . " and a.nis = '$nis' ";
			}								
		}
		
		if ( $idtingkat != "") {
			if ($where == "") {
				$where = " where a.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and a.idtingkat = '$idtingkat' ";
			}								
		}
		
		if ( $idkelas != "") {
			if ($where == "") {
				$where = " where a.idkelas = '$idkelas' ";
			} else {
				$where = $where . " and a.idkelas = '$idkelas' ";
			}								
		}
		
		
		if( (substr($nis2,0,4)== '1819' || substr($nis2,0,4)== '1718') && $idtahunajaran == 44 ) {
			
			$strsql2 = "select a.replid from daftarnilai_pts a where a.nis = '$nis' and a.idtingkat = '$idtingkat' and a.idkelas = '$idkelas' and a.idsemester = '$idsemester' and a.idpelajaran = '$idpelajaran' and a.iddasarpenilaian = '$iddasarpenilaian' and a.idtahunajaran = '$idtahunajaran' order by a.replid";
			$sql2=$dbpdo->prepare($strsql2);
			$sql2->execute();
			$rows = $sql2->rowCount();
			if($rows > 0) {
				if ( $idtahunajaran != "") {
					if ($where == "") {
						$where = " where a.idtahunajaran = '$idtahunajaran' ";
					} else {
						$where = $where . " and a.idtahunajaran = '$idtahunajaran' ";
					}								
				}
			} 
		} else {
			if ( $idtahunajaran != "") {
				if ($where == "") {
					$where = " where a.idtahunajaran = '$idtahunajaran' ";
				} else {
					$where = $where . " and a.idtahunajaran = '$idtahunajaran' ";
				}								
			}
		}
		
		
		if ( $idsemester != "") {
			if ($where == "") {
				$where = " where a.idsemester = '$idsemester' ";
			} else {
				$where = $where . " and a.idsemester = '$idsemester' ";
			}								
		}
		
		if ( $idpelajaran != "") {
			if ($where == "") {
				$where = " where a.idpelajaran = '$idpelajaran' ";
			} else {
				$where = $where . " and a.idpelajaran = '$idpelajaran' ";
			}								
		}
		
		if ( $iddasarpenilaian != "") {
			if ($where == "") {
				$where = " where a.iddasarpenilaian = '$iddasarpenilaian' ";
			} else {
				$where = $where . " and a.iddasarpenilaian = '$iddasarpenilaian' ";
			}								
		}
		
		
		$sqlstr="select a.replid, a.departemen, a.idtingkat, a.idkelas, a.idtahunajaran, a.idsemester, a.nis, a.idkompetensi, a.idjeniskompetensi, a.iddasarpenilaian, a.idpelajaran, a.hadir, a.line from daftarnilai_pts a " . $where . " order by a.iddasarpenilaian";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data list_daftarnilai pts detail
	function list_daftarnilai_pts_detail($id=''){	 
		$dbpdo = DB::create();
			
		$sqlstr="select a.replid, a.nilai, a.line from daftarnilai_pts_detail a where a.replid = '$id' order by a.line";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data list_daftarnilai detail2 pts
	function list_daftarnilai_detail_dasarpenilaian_pts($departemen='', $idtingkat='', $idkelas='', $idtahunajaran='', $idsemester='', $nis='', $idkompetensi='', $idjeniskompetensi='', $iddasarpenilaian='', $idpelajaran='', $line=''){	 
		$dbpdo = DB::create();
				
		$sqlstr="select a.replid, a.nilai, a.line, b.hadir from daftarnilai_pts_detail a left join daftarnilai_pts b on a.replid=b.replid where b.departemen='$departemen' and b.idtingkat='$idtingkat' and	b.idkelas='$idkelas' and b.idtahunajaran='$idtahunajaran' and b.idsemester='$idsemester' and	b.nis='$nis' and b.idkompetensi='$idkompetensi' and	b.idjeniskompetensi='$idjeniskompetensi' and b.iddasarpenilaian='$iddasarpenilaian' and b.idpelajaran='$idpelajaran' and a.line='$line' order by a.line";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}


	//---------get data receipt
	function list_receipt($kode ='', $from_date='', $to_date='', $client_code='', $all=0){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.date, a.status, a.client_code, a.receipt_type, a.cheque_no, a.cheque_date, a.bank_name, a.credit_card_no, a.credit_card_code, a.credit_card_holder, a.credit_card_expired, a.account_code, a.currency_code, a.rate, a.amount, a.deposit, a.sub_total, a.type, a.memo, a.round_amount, a.round_amount_account, a.bank_charge, a.bank_charge_account, a.opening_balance, a.total, a.uid, a.dlu, b.nama client_name from receipt a left join siswa b on a.client_code=b.replid " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//-----------receipt detail (saat update)
	function list_receipt_detail($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select a.ref, a.invoice_no, a.invoice_date, a.invoice_due_date, a.invoice_currency_code, a.invoice_rate, a.amount_due, a.discount, a.amount_paid, a.ref_type invoice_type, a.amount, a.line, b.description from receipt_detail a left join ar b on a.invoice_no=b.ref where a.ref='$id' order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}


	function get_invoice_detail($clien_code='') {
		$dbpdo = DB::create();
		
		$querystring = "select aa.*, bb.installment, bb.loan from 
			(select a.invoice_no, a.date, a.due_date, a.contact_type, a.contact_code, a.contact_other, a.ref_type invoice_type, sum(ifnull(a.debit_amount,0)) - sum(ifnull(a.credit_amount,0)) - sum(ifnull(a.discount_amount,0)) amount_paid, a.ref_type, a.currency_code, a.rate, a.exchange_type, a.exchange_date, a.top, a.description, a.uid, a.dlu from ar a group by a.contact_code, a.contact_type, a.invoice_no, a.ref_type having (sum(ifnull(a.debit_amount,0)) - sum(ifnull(a.credit_amount,0)) - sum(ifnull(a.discount_amount,0))) <> 0 and left(a.invoice_no,3) <> 'CSR'
			union all
			select a.invoice_no, a.date, '1900-01-01' due_date, a.contact_type, a.contact_code, a.contact_other, 'DPS' invoice_type, (sum(ifnull(a.debit_amount,0)) - sum(ifnull(a.credit_amount,0))) * -1 amount_paid, a.ref_type, a.currency_code, a.rate, a.exchange_type, a.exchange_date, a.top, a.description, a.uid, a.dlu from dps a group by a.contact_code, a.contact_type, a.invoice_no, a.invoice_type having (sum(ifnull(a.debit_amount,0)) - sum(ifnull(a.credit_amount,0))) > 0 and left(a.invoice_no,3) <> 'CSR' )  aa left join direct_receipt bb on aa.invoice_no=bb.ref where aa.contact_code = '$clien_code' order by aa.invoice_no, aa.date";
		$sql=$dbpdo->prepare($querystring);
		$sql->execute();
		
		return $sql;
	}


	//---------General Journal detail
	function list_general_journal_detail($ref='', $kode='', $location_id=''){	 
		$dbpdo = DB::create();
		
		$where = "";
		
		if($ref != "") {
			if($where == "") {
				$where = "where a.ref='$ref'";
			} else {
				$where = $where . " and a.ref='$ref'";
			}
		}
		
		if($kode != "") {
			if($where == "") {
				$where = "where a.account_code='$kode'";
			} else {
				$where = $where . " and a.account_code='$kode'";
			}
		}	
		
		if($location_id != "") {
			if($where == "") {
				$where = "where a.location_id='$location_id'";
			} else {
				$where = $where . " and a.location_id='$location_id'";
			}
		}	
		
		if($ref=='' && $kode=='' && $location_id=='') {
			$where = "where a.ref='ndfxxx'";
		}
		
		$sqlstr = "select a.ref, b.code, a.location_id, c.name location_name, a.account_code, a.memo, a.debit_amount, a.credit_amount, a.line, b.name from general_journal_detail a left join finance_type b on a.account_code=b.id left join warehouse c on a.location_id=c.id " . $where . " order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------General Journal in
	function list_general_journal_in($ref='', $frmdate='', $todate='', $status='', $memo='', $all=0){	
		$dbpdo = DB::create();
		
		$where = "  where left(a.ref,3)='CIT' ";
		if ($ref != '') {
			if($where == '') { $where = " where a.ref = '$ref' "; } else { $where = $where . " and a.ref = '$ref' "; } 
		}
		
		if ($frmdate != '') {
			$frmdate = date('Y-m-d', strtotime($frmdate));
			if($where == '') { $where = " where a.date >= '$frmdate' "; } else { $where = $where . " and a.date >= '$frmdate' "; } 
		}
		
		if ($todate != '') {
			$todate = date('Y-m-d', strtotime($todate));
			if($where == '') { $where = " where a.date <= '$todate' "; } else { $where = $where . " and a.date <= '$todate' "; } 
		}
		
		/*if ($frmdate != '' && $todate == '') {
			$frmdate = date('Y-m-d', strtotime($frmdate));
			if($where == '') { $where = " where a.date = '$frmdate' "; } else { $where = $where . " and a.date = '$frmdate' "; } 
		}
		if ($frmdate == '' && $todate != '') {
			$todate = date('Y-m-d', strtotime($todate));
			if($where == '') { $where = " where a.date = '$todate' "; } else { $where = $where . " and a.date = '$todate' "; } 
		}
		if ($frmdate != '' && $todate != '') {
			$frmdate = date('Y-m-d', strtotime($frmdate));
			$todate = date('Y-m-d', strtotime($todate));
			if($where == '') { $where = " where a.date >= '$frmdate' and a.date <= '$todate' "; } else { $where = $where . " and a.date >= '$frmdate' and a.date <= '$todate' "; } 
		}*/
		if ($status != '') {
			if($where == '') { $where = " where a.status = '$status' "; } else { $where = $where . " and a.status = '$status' "; } 
		}
		if ($memo != '') {
			if($where == '') { $where = " where a.memo like '%$memo%' "; } else { $where = $where . " and a.memo like '%$memo%' "; } 
		}
		if ($all == 1) {			
			$where = "  where left(a.ref,3)='CIT' ";
		}
		
		/*if ($all == 0) {			
			$frmdate = date('d-m-Y', strtotime('-7 day'));
			$frmdate = date('Y-m-d', strtotime($frmdate));
			$todate 	= date("Y-m-d");			
			if($where == '') { $where = " where a.date >= '$frmdate' and a.date <= '$todate' "; }
		}
		if (user_admin()==0) {
			$uid = $_SESSION["loginname"];
			
			if($where == '') {
				$where = " where b.brncde in (select ifnull(brncde,'') brncde from usr_dtl2 where usrid='$uid') ";
			} else {
				$where = $where . " and b.brncde in (select ifnull(brncde,'') brncde from usr_dtl2 where usrid='$uid') ";
			}
		}*/
		
		$sqlstr = "select distinct a.ref, a.status, a.date, a.memo, a.currency_code, a.rate, a.total_balance, a.total_debit, a.total_credit, a.uid, a.dlu from general_journal a " . $where . " order by a.ref desc ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		
/*		if ($ref == "") {
			$where = "";
			if (user_admin()==0) {
				$uid = $_SESSION["loginname"];
				
				$where = " where b.brncde in (select ifnull(brncde,'') brncde from usr_dtl2 where usrid='$uid') ";
			} 
			$sql=mysql_query("select distinct a.ref, a.status, a.date, a.memo, a.curcde, a.excrte, a.ttlblc, a.ttldbt, a.ttlcrd, a.uid, a.dlu from gnrjrn a left join usr_dtl2 b on a.uid=b.usrid " . $where . " order by a.ref desc ");			
		} else {
			$sql=mysql_query("select a.ref, a.status, a.date, a.memo, a.curcde, a.excrte, a.ttlblc, a.ttldbt, a.ttlcrd, a.uid, a.dlu from gnrjrn a left join usr_dtl2 b on a.uid=b.usrid where a.ref='$ref' order by a.ref desc ");
		}
*/				
		return $sql;
	}
	
	//---------General Journal detail in
	function list_general_journal_in_detail($ref='', $kode=''){	 
		$dbpdo = DB::create();
		
		$where = "";
		
		if($ref != "") {
			if($where == "") {
				$where = "where a.ref='$ref'";
			} else {
				$where = $where . " and a.ref='$ref'";
			}
		}
		
		if($kode != "") {
			if($where == "") {
				$where = "where a.account_code='$kode'";
			} else {
				$where = $where . " and a.account_code='$kode'";
			}
		}	
		
		if($ref=='' && $kode=='') {
			$where = "where a.ref='ndfxxx'";
		}
		
		$sqlstr = "select a.ref, b.code, a.account_code, a.memo, a.debit_amount, a.credit_amount, a.line, b.name from general_journal_detail a left join finance_type b on a.account_code=b.id " . $where . " order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data finance type
	function list_finance_type($kode ='', $type='', $act='', $location_id='', $all=''){	 	
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.id = '$kode' ";
			} else {
				$where = $where . " and a.id = '$kode' ";
			}								
		}
		
		if ( $type != "") {
			if ($where == "") {
				$where = " where a.type = '$type' ";
			} else {
				$where = $where . " and a.type = '$type' ";
			}								
		}
		
		if ( $act != "") {
			if ($where == "") {
				$where = " where a.active = '$act' ";
			} else {
				$where = $where . " and a.active = '$act' ";
			}								
		}
		
		if ( $location_id != "") {
			if ($where == "") {
				$where = " where a.location_id = '$location_id' ";
			} else {
				$where = $where . " and a.location_id = '$location_id' ";
			}								
		}
		
		if($all != "") {
			$where = "";
		}
		
		$sqlstr="select a.id, a.code, a.name, a.location_id, a.type, a.account_code, c.acc_code, c.name acc_name, a.active, a.uid, a.dlu, b.name warehouse_name from finance_type a left join warehouse b on a.location_id=b.id left join coa c on a.account_code=c.syscode " . $where . " order by a.id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------General Journal
	function list_general_journal($ref='', $frmdate='', $todate='', $status='', $memo='', $all=0){	
		$dbpdo = DB::create();
		
		$where = "  where left(a.ref,3)='COT' ";
		if ($ref != '') {
			if($where == '') { $where = " where a.ref = '$ref' "; } else { $where = $where . " and a.ref = '$ref' "; } 
		}
		
		if ($frmdate != '') {
			$frmdate = date('Y-m-d', strtotime($frmdate));
			if($where == '') { $where = " where a.date >= '$frmdate' "; } else { $where = $where . " and a.date >= '$frmdate' "; } 
		}
		
		if ($todate != '') {
			$todate = date('Y-m-d', strtotime($todate));
			if($where == '') { $where = " where a.date <= '$todate' "; } else { $where = $where . " and a.date <= '$todate' "; } 
		}
		
		/*if ($frmdate != '' && $todate == '') {
			$frmdate = date('Y-m-d', strtotime($frmdate));
			if($where == '') { $where = " where a.date = '$frmdate' "; } else { $where = $where . " and a.date = '$frmdate' "; } 
		}
		if ($frmdate == '' && $todate != '') {
			$todate = date('Y-m-d', strtotime($todate));
			if($where == '') { $where = " where a.date = '$todate' "; } else { $where = $where . " and a.date = '$todate' "; } 
		}
		if ($frmdate != '' && $todate != '') {
			$frmdate = date('Y-m-d', strtotime($frmdate));
			$todate = date('Y-m-d', strtotime($todate));
			if($where == '') { $where = " where a.date >= '$frmdate' and a.date <= '$todate' "; } else { $where = $where . " and a.date >= '$frmdate' and a.date <= '$todate' "; } 
		}*/
		if ($status != '') {
			if($where == '') { $where = " where a.status = '$status' "; } else { $where = $where . " and a.status = '$status' "; } 
		}
		if ($memo != '') {
			if($where == '') { $where = " where a.memo like '%$memo%' "; } else { $where = $where . " and a.memo like '%$memo%' "; } 
		}
		if ($all == 1) {			
			$where = "  where left(a.ref,3)='COT' ";
		}
		
		/*if ($all == 0) {			
			$frmdate = date('d-m-Y', strtotime('-7 day'));
			$frmdate = date('Y-m-d', strtotime($frmdate));
			$todate 	= date("Y-m-d");			
			if($where == '') { $where = " where a.date >= '$frmdate' and a.date <= '$todate' "; }
		}
		if (user_admin()==0) {
			$uid = $_SESSION["loginname"];
			
			if($where == '') {
				$where = " where b.brncde in (select ifnull(brncde,'') brncde from usr_dtl2 where usrid='$uid') ";
			} else {
				$where = $where . " and b.brncde in (select ifnull(brncde,'') brncde from usr_dtl2 where usrid='$uid') ";
			}
		}*/
		
		$sqlstr = "select distinct a.ref, a.status, a.date, a.memo, a.currency_code, a.rate, a.total_balance, a.total_debit, a.total_credit, a.uid, a.dlu from general_journal a " . $where . " order by a.ref desc ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		
/*		if ($ref == "") {
			$where = "";
			if (user_admin()==0) {
				$uid = $_SESSION["loginname"];
				
				$where = " where b.brncde in (select ifnull(brncde,'') brncde from usr_dtl2 where usrid='$uid') ";
			} 
			$sql=mysql_query("select distinct a.ref, a.status, a.date, a.memo, a.curcde, a.excrte, a.ttlblc, a.ttldbt, a.ttlcrd, a.uid, a.dlu from gnrjrn a left join usr_dtl2 b on a.uid=b.usrid " . $where . " order by a.ref desc ");			
		} else {
			$sql=mysql_query("select a.ref, a.status, a.date, a.memo, a.curcde, a.excrte, a.ttlblc, a.ttldbt, a.ttlcrd, a.uid, a.dlu from gnrjrn a left join usr_dtl2 b on a.uid=b.usrid where a.ref='$ref' order by a.ref desc ");
		}
*/				
		return $sql;
	}


	//---------get data warehouse
	function list_warehouse($kode ='', $all=0, $act=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.id = '$kode' ";
			} else {
				$where = $where . " and a.id = '$kode' ";
			}								
		}
		
		$sqlstr="select a.id, a.code, a.name, a.address, a.email, a.phone, a.active, a.uid, a.dlu from warehouse a " . $where . " order by a.id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}


	//---------get data coa
	function list_coa($kode ='', $all=0, $act='', $acc_type=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.syscode = '$kode' ";
			} else {
				$where = $where . " and a.syscode = '$kode' ";
			}								
		}

		if ( $acc_type != "") {
			if ($where == "") {
				$where = " where a.acc_type = '$acc_type' ";
			} else {
				$where = $where . " and a.acc_type = '$acc_type' ";
			}								
		}

		if ( $act == 1) {
			if ($where == "") {
				$where = " where a.active = 1 ";
			} else {
				$where = $where . " and a.active = 1 ";
			}								
		}

		if ( $all == 1) {
			$where = "";							
		}


		
		$sqlstr="select a.acc_code, a.name, a.acc_type, a.postable, a.subacc_code, a.opening_balance, a.opening_balance_date, a.current_balance, a.currency_code, a.currency_rate, a.currency_exchange_id, a.level, a.active, a.uid, a.dlu, a.syscode, b.name acc_type_name, c.acc_code sub_of_acc_code, c.name sub_of_acc_name from coa a left join coa_type b on a.acc_type=b.id left join coa c on a.subacc_code=c.syscode " . $where . " order by b.name, a.acc_code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	

	//-----------total purchase inv detail
	function list_purchase_inv_total_tmp($id) {
		$dbpdo = DB::create();
				
		$sqlstr="select sum(a.amount) total from purchase_invoice_tmp a where a.ref='$id' group by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$total=$data->total;
		
		return $total;
	}
	
	
	//-----------total purchase inv detail
	function list_purchase_inv_total($id) {
		$dbpdo = DB::create();
				
		$sqlstr="select sum(a.total) total from purchase_invoice a where a.ref='$id' group by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$total=$data->total;
		
		return $total;
	}
	
	//---------get data purchase inv
	function list_purchase_inv($kode ='', $from_date='', $to_date='', $vendor_code='', $all=0){
		$dbpdo = DB::create();
			 	
		$where = " where ifnull(a.opening_balance,0) = 0 and a.ref like '%POV%' ";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		
		if ( $vendor_code != "") {
			if ($where == "") {
				$where = " where a.vendor_code = '$vendor_code' ";
			} else {
				$where = $where . " and a.vendor_code = '$vendor_code' ";
			}								
		}
		
		if($all == 1) {
			$where = " where ifnull(a.opening_balance,0) = 0 and a.ref like '%POV%' ";
		}
		
		$sqlstr="select a.ref, a.invoice_no, a.date, a.status, a.bill_number, a.vendor_code, a.payment_type, b.name vendor_name, a.top, a.due_date, a.tax_code, a.tax_rate, a.freight_cost, a.freight_account, a.memo, a.discount, a.total, a.location_id, a.cash, a.cash_amount, a.change_amount, a.bank_id, a.bank_amount, a.credit_card_code, a.card_amount, a.credit_card_no, a.credit_card_holder, a.stock_in, a.uid, a.dlu, (select sum(aa.amount) from purchase_invoice_detail aa group by aa.ref having aa.ref=a.ref) amount from purchase_invoice a left join vendor b on a.vendor_code=b.syscode " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//-----------purchase_inv detail (saat update)
	function list_purchase_inv_detail($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select a.ref, a.po_ref, a.item_code, b.code item_code2, b.name item_name, a.uom_code, a.size, a.qty, ifnull(a.qty_good,0) qty_good, a.unit_cost, a.discount1, a.discount2, a.discount3, a.discount4, a.discount, a.amount, a.line_item_po, a.line from purchase_invoice_detail a left join item b on a.item_code=b.syscode where a.ref='$id' order by a.line desc ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//-----------pos purchase inv detail
	function list_purchase_inv_get_detail($id) {
		$dbpdo = DB::create();
				
		$sqlstr="select a.ref, a.vendor_code, a.item_code, b.code, b.name item_name, a.uom_code, a.size, a.qty, a.discount1, a.discount2, a.discount3, a.discount4, a.discount, a.unit_cost, a.amount, a.total, a.location_id, a.payment_type, a.stock_in, a.line from purchase_invoice_tmp a left join item b on a.item_code=b.syscode where a.ref='$id' order by a.line desc";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	

	//---------get data good receipt
	function list_good_receipt($kode ='', $from_date='', $to_date='', $all=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <='$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.date, a.status, a.vendor_code, a.date_arrival, a.driver, a.vehicle, a.location_id, a.do_ref, a.memo, a.receipt_type, a.uid, a.dlu, b.name vendor_name, c.name location_name, (select sum(aa.qty) from good_receipt_detail aa where aa.ref=a.ref group by ref) qty from good_receipt a left join vendor b on a.vendor_code=b.syscode left join warehouse c on a.location_id=c.id  " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//-----------good_receipt detail (saat update)
	function list_good_receipt_detail($id='', $item_group_id='') {
		$dbpdo = DB::create();
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where a.ref = '$id' ";
			} else {
				$where = $where . " and a.ref = '$id' ";
			}								
		}
		
		if ( $item_group_id != "") {
			if ($where == "") {
				$where = " where b.item_group_id = '$item_group_id' ";
			} else {
				$where = $where . " and b.item_group_id = '$item_group_id' ";
			}								
		}
		
		$sqlstr="select a.ref, a.item_code, a.uom_code, a.size, a.po_ref, a.qty, a.unit_cost, a.pi_line, a.line, b.code, b.name item_name from good_receipt_detail a left join item b on a.item_code=b.syscode ".$where." order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	

	//---------get data purchase inv
	function get_purchase_inv_outstanding($kode ='', $from_date='', $to_date='', $vendor_code='', $all=0){
		$dbpdo = DB::create();
			 	
		$where = " where ifnull(a.opening_balance,0) = 0 and a.ref like '%POV%' ";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		
		if ( $vendor_code != "") {
			if ($where == "") {
				$where = " where a.vendor_code = '$vendor_code' ";
			} else {
				$where = $where . " and a.vendor_code = '$vendor_code' ";
			}								
		}
		
		if($all == 1) {
			$where = " where ifnull(a.opening_balance,0) = 0 and a.ref like '%POV%' ";
		}
		
		$sqlstr="select a.ref, a.invoice_no, a.date, a.status, a.bill_number, a.vendor_code, a.payment_type, b.name vendor_name, a.top, a.due_date, a.tax_code, a.tax_rate, a.freight_cost, a.freight_account, a.memo, a.discount, a.total, a.location_id, a.cash, a.cash_amount, a.change_amount, a.bank_id, a.bank_amount, a.credit_card_code, a.card_amount, a.credit_card_no, a.credit_card_holder, a.uid, a.dlu, (select sum(aa.amount) from purchase_invoice_detail aa group by aa.ref having aa.ref=a.ref) amount from purchase_invoice a left join vendor b on a.vendor_code=b.syscode " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	

	//---------get data payment
	function list_payment($kode ='', $from_date='', $to_date='', $vendor_code='', $all=0){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		if ( $vendor_code != "") {
			if ($where == "") {
				$where = " where a.vendor_code = '$vendor_code' ";
			} else {
				$where = $where . " and a.vendor_code = '$vendor_code' ";
			}								
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.date, a.status, a.vendor_code, a.payment_type, a.cheque_no, a.cheque_date, a.bank_name, a.credit_card_no, a.credit_card_code, a.credit_card_holder, a.credit_card_expired, a.account_code, a.currency_code, a.rate, a.amount, a.deposit, a.sub_total, a.type, a.memo, a.round_amount, a.round_amount_account, a.bank_charge, a.bank_charge_account, a.opening_balance, a.total, a.no_ttfa, a.uid, a.dlu, b.name vendor_name from payment a left join vendor b on a.vendor_code=b.syscode " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//-----------payment detail (saat update)
	function list_payment_detail($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select a.ref, a.invoice_no, b.invoice_no no_nota, a.invoice_date, a.invoice_due_date, a.invoice_currency_code, a.invoice_rate, a.amount_due, a.discount, a.amount_paid, a.ref_type invoice_type, a.amount, a.line from payment_detail a left join purchase_invoice b on a.invoice_no=b.ref where a.ref='$id' order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//-----------payment giro
	function list_payment_giro($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select a.ref, a.account_code, a.cheque_no, a.bank_name, a.cheque_date, a.amountbg, a.line from payment_giro a where a.ref='$id' order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	

	function get_payment_detail($vendor_code='') {
		$dbpdo = DB::create();
		
		$sqlstr="select aa.* from (select a.invoice_no, b.bill_number no_nota, a.date, a.due_date, a.contact_type, a.contact_code, a.contact_other, a.ref_type invoice_type, sum(ifnull(a.credit_amount,0)) - sum(ifnull(a.debit_amount,0)) - sum(ifnull(a.discount_amount,0)) amount_paid, a.ref_type, a.currency_code, a.rate, a.exchange_type, a.exchange_date, a.top, a.description, a.uid, a.dlu from ap a left join purchase_invoice b on a.ref=b.ref group by a.contact_code, a.contact_type, a.invoice_no, a.ref_type having (sum(ifnull(a.credit_amount,0)) - sum(ifnull(a.debit_amount,0)) - sum(ifnull(a.discount_amount,0))) <> 0) aa where aa.contact_code = '$vendor_code' order by aa.invoice_no, aa.date";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
}
?>
			