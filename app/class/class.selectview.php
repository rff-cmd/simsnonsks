<?php

class selectview{	

	//---------get data registrasi
	function list_registrasi($ref='', $replid='', $tahunmasuk='', $idtingkat='', $tanggal='', $idjurusan='', $nama='', $all='', $idproses='', $idkelompok=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($tahunmasuk != "") {
			if ($where == "") {
				$where = " where a.tahunmasuk = '$tahunmasuk' ";
			} else {
				$where = $where . " and a.tahunmasuk = '$tahunmasuk' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where a.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and a.idtingkat = '$idtingkat' ";
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
		
		if ($idjurusan != "") {
			if ($where == "") {
				$where = " where a.idjurusan = '$idjurusan' ";
			} else {
				$where = $where . " and a.idjurusan = '$idjurusan' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.nopendaftaran = '$ref' ";
			} else {
				$where = $where . " and a.nopendaftaran = '$ref' ";
			}
		}
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($idproses != "") {
			if ($where == "") {
				$where = " where a.idproses = '$idproses' ";
			} else {
				$where = $where . " and a.idproses = '$idproses' ";
			}
		}
		
		if ($idkelompok != "") {
			if ($where == "") {
				$where = " where a.idkelompok = '$idkelompok' ";
			} else {
				$where = $where . " and a.idkelompok = '$idkelompok' ";
			}
		}
		
		if ($all != "") {
			$where = "";
		}
		
		if($ref=='' && $replid=='' && $tahunmasuk=='' && $idtingkat=='' && $tanggal=='' && $idjurusan=='' && $nama=='' && $all=='' && $idproses=='' && $idkelompok=='') {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	=	"select a.replid, a.idproses, a.idkelompok, a.tanggal, a.nopendaftaran, a.idtingkat, a.idjurusan, a.idminat, a.idminat1, a.foto_file, a.nama, a.panggilan, a.kelamin, a.nisn, a.nis, a.noijazah, a.tahunijazah, a.skhun, a.tahunskhun, a.noujian, a.nik, a.tmplahir, a.tgllahir, a.agama, a.kebutuhan_khusus, a.tahunmasuk, a.alamatsiswa, a.dusun, a.rt, a.rw, a.kelurahan, a.kodepossiswa, a.kecamatan, a.kabupaten, a.provinsi, a.transportasi, a.transportasi_kode, a.citacita, a.citacita_lain, a.idjenis_tinggal, a.jenis_tinggal, a.telponsiswa, a.hpsiswa, a.emailsiswa, a.kps, a.nokps, a.nokip, a.nokks, a.namaayah, a.tahunayah, a.alamatortu, a.kodeposortu, a.hportu, a.butuhkhususayah, a.butuhkhususketayah, a.pekerjaanayah, a.pekerjaanayah_lain, a.pendidikanayah, a.penghasilanayah, a.penghasilanayah_kode, a.namaibu, a.tahunibu, a.butuhkhususibu, a.butuhkhususketibu, a.pekerjaanibu, a.pekerjaanibu_lain, a.pendidikanibu, a.penghasilanibu, a.penghasilanibu_kode, a.wali, a.tahunwali, a.pekerjaanwali, a.pekerjaanwali_lain, a.pendidikanwali, a.penghasilanwali, a.tinggi, a.berat, a.jaraksekolah, a.jarak_km, a.waktutempuh, a.waktutempuh_menit, a.jsaudara, a.uid, a.dlu, b.tingkat, c.kelas jurusan, a.darah, a.file_darah, a.almayah, a.almibu, a.alamatibu, a.kodeposibu, a.hpibu, d.dcr jalur_masuk, e.dcr jenis_pendaftaran from calonsiswa a left join tingkat b on a.idtingkat=b.replid left join kelas c on a.idjurusan=c.replid left join 
		(select '1' cde, 'Akademik' dcr, 0 nmr union all 
		select '2' cde, 'Non Akademik' dcr, 1 nmr union all
		select '3' cde, 'Mutasi' dcr, 2 nmr ) d on a.idkelompok=d.cde left join
		(select '1' cde, 'Siswa Baru' dcr, 0 nmr union all 
		select '2' cde, 'Mutasi' dcr, 1 nmr) e on a.idproses=e.cde" . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
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
	
	
	//---------get data siswa
	function list_siswa($ref='', $replid='', $idtingkat='', $kelas='', $nama='', $all='', $departemen='', $nik='', $kelamin='', $aktif='', $alumni='', $idangkatan='', $idangkatan1=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($alumni == 1) {
			if ($where == "") {
				$where = " where ifnull(a.alumni,0)=1 ";
			} else {
				$where = $where . " and ifnull(a.alumni,0)=1 ";
			}
		} else {
			if ($where == "") {
				$where = " where ifnull(a.alumni,0)=0 ";
			} else {
				$where = $where . " and ifnull(a.alumni,0)=0 ";
			}
		}
		
		if($_SESSION["adm"] == 0) {
			if($_SESSION["tipe_user"] == "Siswa") {
				$replid = $_SESSION["idpegawai"];	
			}			
		}
		
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
		
		if ($kelamin != "") {
			if ($where == "") {
				$where = " where a.kelamin = '$kelamin' ";
			} else {
				$where = $where . " and a.kelamin = '$kelamin' ";
			}
		}
		
		if ($nama != "") {
			$nama = petikreplace($nama);
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
		
		if ($nik != "") {
			if ($where == "") {
				$where = " where a.nik = '$nik' ";
			} else {
				$where = $where . " and a.nik = '$nik' ";
			}
		}
		
		if($idangkatan != "") {
			if ($where == "") {
				$where = " where a.idangkatan = '$idangkatan' ";
			} else {
				$where = $where . " and a.idangkatan = '$idangkatan' ";
			}
		}
		
		if($idangkatan1 != "") {
			if ($where == "") {
				$where = " where a.idangkatan1 = '$idangkatan1' ";
			} else {
				$where = $where . " and a.idangkatan1 = '$idangkatan1' ";
			}
		}
		
		if ($aktif != "") {
			if($alumni == 1) {
				if ($where == "") {
					$where = " where a.aktif = 0 ";
				} else {
					$where = $where . " and a.aktif = 0 ";
				}	
			} else {
				if ($where == "") {
					$where = " where a.aktif = '$aktif' ";
				} else {
					$where = $where . " and a.aktif = '$aktif' ";
				}
			}
		}

		
		if ($all == "1") {
			$where = " where ifnull(a.alumni,0)=0 ";
		}
		
		if($ref=='' && $replid=='' && $idtingkat=='' && $kelas=='' && $nama=='' && $all=='' && $departemen=='' && $nik=='' && $kelamin=='' && $aktif=='1' && $alumni=='' && $idangkatan=='' && $idangkatan1=='') {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nis, a.nik, a.nisn, a.idangkatan, a.idangkatan1, a.foto_file, a.nama, a.idkelas, a.idminat, a.kelamin, a.tmplahir, a.tgllahir, a.agama, a.warga, a.anakke, a.jsaudara, a.jtiri, a.jangkat, a.yatim, a.bahasa, a.alamatsiswa, a.alamatortu, a.telponsiswa, a.hpsiswa, a.telponortu, a.hportu, a.hpibu, a.jaraksekolah, a.kesekolah, a.berat, a.tinggi, a.kesehatan, a.darah, a.file_darah, a.kelainan, a.asalsekolah_id, a.tglijazah, a.noijazah, a.tglskhun, a.skhun, a.noujian, a.nisnasal, a.namaayah, a.namaibu, a.tmplahirayah, a.tgllahirayah, a.tmplahiribu, a.tgllahiribu, a.pekerjaanayah, a.pekerjaanibu, a.penghasilanayah, a.penghasilanibu, a.pendidikanayah, a.pendidikanibu, a.wnayah, a.wnibu, a.wali, a.tmplahirwali, a.tgllahirwali, a.pendidikanwali, a.pekerjaanwali, a.penghasilanwali, a.alamatwali, a.hpwali, a.hubungansiswa, a.pekerjaanayah_lain, a.pekerjaanibu_lain, a.pekerjaanwali_lain, a.jalurmasuk, a.uid, a.ts, b.idtingkat, b.kelas, c.tingkat, a.uid2, a.dlu2 from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid " . $where . " order by a.nama, a.idkelas, a.nis, a.replid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data siswa tingkat
	function list_siswa_tingkat($ref='', $replid='', $idtingkat='', $kelas='', $nama='', $all='', $departemen='', $nik=''){
		$dbpdo = DB::create();
		
		$where = " where ifnull(a.alumni,0)=0 ";
		
		if($_SESSION["adm"] == 0) {
			if($_SESSION["tipe_user"] == "Siswa") {
				$replid = $_SESSION["idpegawai"];	
			}			
		}
		
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
			$nama = petikreplace($nama);
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
		
		if ($nik != "") {
			if ($where == "") {
				$where = " where a.nik = '$nik' ";
			} else {
				$where = $where . " and a.nik = '$nik' ";
			}
		}
		
		
		if ($all != "") {
			$where = " where ifnull(a.alumni,0)=0 ";
		}
		
		if($ref=='' && $replid=='' && $idtingkat=='' && $kelas=='' && $nama=='' && $all=='' && $departemen=='' && $nik=='') {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nis, a.nisn, a.idangkatan, a.idangkatan1, a.foto_file, a.nama, a.idkelas, a.idminat, a.kelamin, a.tmplahir, a.tgllahir, a.agama, a.warga, a.anakke, a.jsaudara, a.jtiri, a.jangkat, a.yatim, a.bahasa, a.alamatsiswa, a.alamatortu, a.telponsiswa, a.hpsiswa, a.telponortu, a.hportu, a.hpibu, a.jaraksekolah, a.kesekolah, a.berat, a.tinggi, a.kesehatan, a.darah, a.file_darah, a.kelainan, a.asalsekolah_id, a.tglijazah, a.noijazah, a.tglskhun, a.skhun, a.noujian, a.nisnasal, a.namaayah, a.namaibu, a.tmplahirayah, a.tgllahirayah, a.tmplahiribu, a.tgllahiribu, a.pekerjaanayah, a.pekerjaanibu, a.penghasilanayah, a.penghasilanibu, a.pendidikanayah, a.pendidikanibu, a.wnayah, a.wnibu, a.wali, a.tmplahirwali, a.tgllahirwali, a.pendidikanwali, a.pekerjaanwali, a.penghasilanwali, a.alamatwali, a.hpwali, a.hubungansiswa, a.pekerjaanayah_lain, a.pekerjaanibu_lain, a.pekerjaanwali_lain, a.uid, a.ts, b.idtingkat, b.kelas, c.tingkat, a.uid2, a.dlu2 from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid " . $where . " order by a.idkelas, a.nama, a.nis, a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data penembatan siswa
	function list_penempatan_siswa($departemen=''){
		$dbpdo = DB::create();
		
		$where = " where ifnull(a.idkelas,0)=0 and ifnull(a.alumni,0)=0 ";
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where c.departemen = '$departemen' ";
			} else {
				$where = $where . " and c.departemen = '$departemen' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.nis, a.nisn, a.nama, a.kelamin, a.tmplahir, a.tgllahir, a.agama, a.warga, a.anakke, a.jsaudara, a.jtiri, a.jangkat, a.yatim, a.bahasa, a.alamatsiswa, a.alamatortu, a.telponsiswa, a.hpsiswa, a.telponortu, a.hportu, a.hpibu, a.jaraksekolah, a.kesekolah, a.berat, a.tinggi, a.kesehatan, a.darah, a.file_darah, a.kelainan, a.asalsekolah_id, a.tglijazah, a.noijazah, a.tglskhun, a.skhun, a.noujian, a.nisnasal, a.namaayah, a.namaibu, a.tmplahirayah, a.tgllahirayah, a.tmplahiribu, a.tgllahiribu, a.pekerjaanayah, a.pekerjaanibu, a.penghasilanayah, a.penghasilanibu, a.pendidikanayah, a.pendidikanibu, a.wnayah, a.wnibu, a.wali, a.tmplahirwali, a.tgllahirwali, a.pendidikanwali, a.pekerjaanwali, a.penghasilanwali, a.alamatwali, a.hpwali, a.hubungansiswa, a.pekerjaanayah_lain, a.pekerjaanibu_lain, a.pekerjaanwali_lain, a.uid, a.ts from siswa a " . $where . " order by a.replid ";
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
    
    //---------get data siswa besarjtt
	function list_siswabesarjtt($ref='', $replid='', $idtingkat='', $kelas='', $nama='', $all='', $idkategori='', $idpenerimaan='', $idangkatan='', $departemen=''){
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
		
		if ($idangkatan != "") {
			if ($where == "") {
				$where = " where a.idangkatan = '$idangkatan' ";
			} else {
				$where = $where . " and a.idangkatan = '$idangkatan' ";
			}
		}
		
		/*if ($idkategori != "") {
			if ($where == "") {
				$where = " where e.idkategori = '$idkategori' ";
			} else {
				$where = $where . " and e.idkategori = '$idkategori' ";
			}
		}
		
		if ($idpenerimaan != "") {
			if ($where == "") {
				$where = " where d.idpenerimaan = '$idpenerimaan' ";
			} else {
				$where = $where . " and d.idpenerimaan = '$idpenerimaan' ";
			}
		}*/
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where c.departemen = '$departemen' ";
			} else {
				$where = $where . " and c.departemen = '$departemen' ";
			}
		}
		
		/*if ($idpenerimaan == "") {
			$where = " where a.replid = '0' ";
		}*/
		
		if ($all != "") {
			$where = "";
		}
		
		if($ref=='' && $replid=='' && $idtingkat=='' && $kelas=='' && $nama=='' && $departemen=='' && $all=='' ) {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nis, a.idangkatan, a.nama, a.idkelas, a.kelamin, a.uid, a.ts, b.idtingkat, b.kelas, c.tingkat, '" .$idkategori . "' idkategori, '" .$idpenerimaan . "' idpenerimaan from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid " . $where . " order by a.replid ";
		
		//echo $sqlstr;
		//$sqlstr	=	"select a.replid, a.nis, a.idangkatan, a.nama, a.idkelas, a.kelamin, a.tmplahir, a.tgllahir, a.agama, a.warga, a.anakke, a.jsaudara, a.jtiri, a.jangkat, a.yatim, a.bahasa, a.alamatsiswa, a.alamatortu, a.telponsiswa, a.hpsiswa, a.telponortu, a.hportu, a.hpibu, a.jaraksekolah, a.kesekolah, a.berat, a.tinggi, a.kesehatan, a.darah, a.file_darah, a.kelainan, a.asalsekolah_id, a.tglijazah, a.noijazah, a.tglskhun, a.skhun, a.noujian, a.nisnasal, a.namaayah, a.namaibu, a.tmplahirayah, a.tgllahirayah, a.tmplahiribu, a.tgllahiribu, a.pekerjaanayah, a.pekerjaanibu, a.penghasilanayah, a.penghasilanibu, a.pendidikanayah, a.pendidikanibu, a.wnayah, a.wnibu, a.wali, a.tmplahirwali, a.tgllahirwali, a.pendidikanwali, a.pekerjaanwali, a.penghasilanwali, a.alamatwali, a.hpwali, a.hubungansiswa, a.pekerjaanayah_lain, a.pekerjaanibu_lain, a.pekerjaanwali_lain, a.uid, a.ts, b.idtingkat, b.kelas, c.tingkat, '" .$idkategori . "' idkategori, '" .$idpenerimaan . "' idpenerimaan from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid " . $where . " order by a.replid ";
		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data besarjtt
	function list_besarjtt($nis='', $idpenerimaan='', $departemen=''){
		$dbpdo = DB::create();
		
		$sqltb = "select replid from tahunbuku where departemen='$departemen' order by tanggalmulai desc limit 1";
		$query = $dbpdo->prepare($sqltb);
		$query->execute();
		$datatb = $query->fetch(PDO::FETCH_OBJ);
		$tahunbuku = $datatb->replid;
		
		//$where = " where a.info2='$_SESSION[tahunbuku]' ";
		$where = " where a.info2='$tahunbuku' ";
		
		if ($nis != "") {
			if ($where == "") {
				$where = " where a.nis = '$nis' ";
			} else {
				$where = $where . " and a.nis = '$nis' ";
			}
		}
		
		if ($idpenerimaan != "") {
			if ($where == "") {
				$where = " where a.idpenerimaan = '$idpenerimaan' ";
			} else {
				$where = $where . " and a.idpenerimaan = '$idpenerimaan' ";
			}
		}
				
		$sqlstr	=	"select a.replid, a.nis, a.idpenerimaan, ifnull(a.besar,0) besar, ifnull(a.cicilan,0) cicilan, a.lunas, a.keterangan, a.pengguna, a.info1, a.info2, a.info3, a.ts, a.potongan, b.idkategori, c.nama namasiswa, d.kelas, e.tingkat from besarjtt a left join datapenerimaan b on a.idpenerimaan=b.replid left join siswa c on a.nis=c.nis left join kelas d on c.idkelas=d.replid left join tingkat e on d.idtingkat=e.replid " . $where . " order by a.nis";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data penerimaan pembayaran
	function list_rpt_penerimaan($daritgl='', $ketgl='', $idtingkat='', $kelas='', $nama='', $departemen='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($daritgl != "") {
			$daritgl = date("Y-m-d", strtotime($daritgl));
			if ($where == "") {
				$where = " where a.tanggal >= '$daritgl' ";
			} else {
				$where = $where . " and a.tanggal >= '$daritgl' ";
			}
		}
		
		if ($ketgl != "") {
			$ketgl = date("Y-m-d", strtotime($ketgl));
			if ($where == "") {
				$where = " where a.tanggal <= '$ketgl' ";
			} else {
				$where = $where . " and a.tanggal <= '$ketgl' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where d.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and d.idtingkat = '$idtingkat' ";
			}
		}
		
		if ($kelas != "") {
			if ($where == "") {
				$where = " where c.idkelas = '$kelas' ";
			} else {
				$where = $where . " and c.idkelas = '$kelas' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where c.nama like '%$nama%' ";
			} else {
				$where = $where . " and c.nama like '%$nama%' ";
			}
		}
		
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where e.departemen = '$departemen' ";
			} else {
				$where = $where . " and e.departemen = '$departemen' ";
			}
		}
		
		if ($all != "") {
			$where = "";
		}
		
		if($daritgl=='' && $ketgl=='' && $idtingkat=='' && $kelas=='' && $nama=='' && $departemen=='' &&  $all=='') {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	=	"select a.replid, a.ref, a.tanggal, a.jumlah, ifnull(b.potongan,0) potongan, a.keterangan, a.petugas, c.nis, c.nama, d.kelas, e.tingkat, f.nama namapenerimaan, b.idpenerimaan, b.besar from penerimaanjtt a left join besarjtt b on a.idbesarjtt=b.replid left join siswa c on b.nis=c.nis left join kelas d on c.idkelas=d.replid left join tingkat e on d.idtingkat=e.replid left join datapenerimaan f on b.idpenerimaan=f.replid " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get kembali
	function list_kembali($replid='', $idanggota='', $tglpinjam='', $tglkembali='', $all=''){
		$dbpdo = DB::create();
		
		$where = " where a.status=2 ";
		
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
			$where = " where a.status=2 ";
		}
		
		if($replid=='' && $idanggota=='' && $tglpinjam=='' && $tglkembali=='' && $all=='') {
			$where = " where a.replid = 0 ";
		}
		
		
		$now	= date("Y-m-d");
		$sqlstr	= "select a.replid, a.kodepustaka, a.tglpinjam, a.tglkembali, a.idanggota, a.keterangan, a.status, a.tglditerima, a.petugaspinjam, a.ts, c.judul, d.nama from pinjam a left join daftarpustaka b on a.kodepustaka=b.kodepustaka left join pustaka c on b.pustaka=c.replid left join (select nis, nama from siswa union all select nip nis, nama from pegawai) d on a.idanggota=d.nis " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get pinjam terlambat
	function list_pinjam_telat($replid='', $idanggota='', $tglpinjam='', $tglkembali='', $all=''){
		$dbpdo = DB::create();
		
		$now	= date("Y-m-d");
		$where = " where a.status=1 and datediff('".$now."', a.tglkembali) > 0";
		
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
			$where = " where a.status=1 and datediff('".$now."', a.tglkembali) > 0";
		}
		
		if($replid=='' && $idanggota=='' && $tglpinjam=='' && $tglkembali=='' && $all=='') {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	= "select a.replid, a.kodepustaka, a.tglpinjam, a.tglkembali, a.idanggota, a.keterangan, a.status, a.tglditerima, a.petugaspinjam, a.ts, c.judul, d.nama, datediff('".$now."', a.tglkembali) terlambat from pinjam a left join daftarpustaka b on a.kodepustaka=b.kodepustaka left join pustaka c on b.pustaka=c.replid left join (select nis, nama from siswa union all select nip nis, nama from pegawai) d on a.idanggota=d.nis " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data siswa kenaikan
	function list_kenaikan($idangkatan='', $idtingkat='', $idkelas='', $nis='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = " where ifnull(a.alumni,0)=0 ";
		
		if ($idangkatan != "") {
			if ($where == "") {
				$where = " where a.idangkatan = '$idangkatan' ";
			} else {
				$where = $where . " and a.idangkatan = '$idangkatan' ";
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
				$where = " where a.idkelas = '$idkelas' ";
			} else {
				$where = $where . " and a.idkelas = '$idkelas' ";
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
		
		if ($all != "") {
			$where = " where ifnull(a.alumni,0)=0 ";
		}
		
		if($idangkatan=='' && $idtingkat=='' && $idkelas=='' && $nis=='' && $nama=='' && $all=='') {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nis, a.nisn, a.idangkatan, a.idangkatan1, a.foto_file, a.nama, a.idkelas, b.idtingkat, b.kelas, c.tingkat from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data siswa kenaikan tujuan
	function list_kenaikan_tujuan($idangkatan='', $idtingkat='', $idkelas=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idangkatan != "") {
			if ($where == "") {
				$where = " where a.idangkatan = '$idangkatan' ";
			} else {
				$where = $where . " and a.idangkatan = '$idangkatan' ";
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
				$where = " where a.idkelas = '$idkelas' ";
			} else {
				$where = $where . " and a.idkelas = '$idkelas' ";
			}
		}
		
				
		if($idangkatan=='' && $idtingkat=='' && $idkelas=='') {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nis, a.nisn, a.idangkatan, a.idangkatan1, a.foto_file, a.nama, a.idkelas, b.idtingkat, b.kelas, c.tingkat, d.keterangan from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid left join (select nis, idkelas, keterangan from riwayatkelassiswa where aktif=1) d on a.nis=d.nis and d.idkelas=a.idkelas " . $where . " order by a.replid ";
		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data calon siswa
	function list_penempatan($idproses='', $idkelompok='', $nopendaftaran='', $nama=''){
		$dbpdo = DB::create();
		
		$where = " where ifnull(replidsiswa,'') = '' ";
		
		if ($idproses != "") {
			if ($where == "") {
				$where = " where a.idproses = '$idproses' ";
			} else {
				$where = $where . " and a.idproses = '$idproses' ";
			}
		}
				
		
		if ($idkelompok != "") {
			if ($where == "") {
				$where = " where a.idkelompok = '$idkelompok' ";
			} else {
				$where = $where . " and a.idkelompok = '$idkelompok' ";
			}
		}
		
		if ($nopendaftaran != "") {
			if ($where == "") {
				$where = " where a.nopendaftaran = '$nopendaftaran' ";
			} else {
				$where = $where . " and a.nopendaftaran = '$nopendaftaran' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}
		
		if($idproses=='' && $idkelompok=='' && $nopendaftaran=='' && $nama=='') {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nopendaftaran, a.nama, a.nisn, a.nis from calonsiswa a " . $where . " order by a.nama ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data penempatan siswa 
	function list_penempatan_tujuan($idangkatan1='', $idangkatan='', $idtingkat='', $idkelas=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idangkatan1 != "") {
			if ($where == "") {
				$where = " where a.idangkatan1 = '$idangkatan1' ";
			} else {
				$where = $where . " and a.idangkatan1 = '$idangkatan1' ";
			}
		}
				
		if ($idangkatan != "") {
			if ($where == "") {
				$where = " where a.idangkatan = '$idangkatan' ";
			} else {
				$where = $where . " and a.idangkatan = '$idangkatan' ";
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
				$where = " where a.idkelas = '$idkelas' ";
			} else {
				$where = $where . " and a.idkelas = '$idkelas' ";
			}
		}
		
				
		if($idangkatan1=='' && $idangkatan=='' && $idtingkat=='' && $idkelas=='') {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nis, a.nisn, a.idangkatan, a.idangkatan1, a.nama, a.idkelas, b.idtingkat, b.kelas, c.tingkat, d.keterangan from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid left join (select nis, idkelas, keterangan from riwayatkelassiswa where aktif=1) d on a.nis=d.nis and d.idkelas=a.idkelas " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pindah kelas
	function list_pindah_kelas($idangkatan='', $idtingkat='', $idkelas='', $nis='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = " where ifnull(a.alumni,0)=0 ";
		
		if ($idangkatan != "") {
			if ($where == "") {
				$where = " where a.idangkatan = '$idangkatan' ";
			} else {
				$where = $where . " and a.idangkatan = '$idangkatan' ";
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
				$where = " where a.idkelas = '$idkelas' ";
			} else {
				$where = $where . " and a.idkelas = '$idkelas' ";
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
		
		if ($all != "") {
			$where = " where ifnull(a.alumni,0)=0 ";
		}
		
		if($idangkatan=='' && $idtingkat=='' && $idkelas=='' && $nis=='' && $nama=='' && $all=='') {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nis, a.nisn, a.idangkatan, a.idangkatan1, a.foto_file, a.nama, a.idkelas, b.idtingkat, b.kelas, c.tingkat from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai
	function list_pegawai($bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($bagian != "") {
			$bagian	 = 	str_replace("|"," ",$bagian);
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
			$where = "";
		}
		
		if($bagian=='' && $nip=='' && $nama=='' && $all=='') {
			$where = " where a.replid=0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts, b.bagian nama_bagian from pegawai a left join bagianpegawai b on a.bagian=b.replid " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai jabatan
	function list_pegawai_jabatan($bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($bagian != "") {
			$bagian	 = 	str_replace("|"," ",$bagian);
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
			$where = "";
		}
		
		if($bagian=='' && $nip=='' && $nama=='' && $all=='') {
			$where = " where a.replid=0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
    //---------get data pustaka
	function list_pustaka($replid='', $unit=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " and a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($unit != "") {
			if ($where == "") {
				$where = " and b.departemen = '$unit' ";
			} else {
				$where = $where . " and b.departemen = '$unit' ";
			}
		}
		
        $sqlstr	= "select a.kodepustaka, b.judul, b.abstraksi, b.penulis, b.penerbit, c.nama namapenulis, d.nama namapenerbit from daftarpustaka a left join pustaka b on a.pustaka=b.replid left join penulis c on b.penulis=c.replid left join penerbit d on b.penerbit=d.replid where a.status=1 and a.kodepustaka not in (select kodepustaka from pinjam where (status=0 or status=1)) " . $where . " order by a.kodepustaka, b.judul";
        
		//$sqlstr	=	"select a.replid, a.judul, a.abstraksi, a.keyword, a.tahun, a.keteranganfisik, a.penulis, a.penerbit, a.format, a.katalog, a.photo, a.keterangan, a.harga, a.info1, a.info2, a.info3, a.ts, b.nama namapenulis, c.nama namapenerbit from pustaka a left join penulis b on a.penulis=b.replid left join penerbit c on a.penerbit=c.replid " . $where . " order by a.replid ";	
        $sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
    
    
	//---------get data izin siswa
	function list_rpt_izin_siswa($daritgl='', $ketgl='', $idtingkat='', $kelas='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($daritgl != "") {
			$daritgl = date("Y-m-d", strtotime($daritgl));
			if ($where == "") {
				$where = " where a.tanggal >= '$daritgl' ";
			} else {
				$where = $where . " and a.tanggal >= '$daritgl' ";
			}
		}
		
		if ($ketgl != "") {
			$ketgl = date("Y-m-d", strtotime($ketgl));
			if ($where == "") {
				$where = " where a.tanggal <= '$ketgl' ";
			} else {
				$where = $where . " and a.tanggal <= '$ketgl' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where c.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and c.idtingkat = '$idtingkat' ";
			}
		}
		
		if ($kelas != "") {
			if ($where == "") {
				$where = " where b.idkelas = '$kelas' ";
			} else {
				$where = $where . " and b.idkelas = '$kelas' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where b.nama like '%$nama%' ";
			} else {
				$where = $where . " and b.nama like '%$nama%' ";
			}
		}
		
		if ($all != "") {
			$where = "";
		}
		
		if($daritgl=='' && $ketgl=='' && $idtingkat=='' && $kelas=='' && $nama=='' &&  $all=='') {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	=	"select a.replid, a.tanggal, a.idsiswa, a.idjenis_izin, a.format_surat, a.keterangan, a.idpegawai, a.status, a.uid, a.dlu, b.nis, b.nama nama_siswa, b.idkelas, c.kelas, c.idtingkat, d.tingkat, e.nama nama_pegawai, f.nama jenis_izin from izin_siswa a left join siswa b on a.idsiswa=b.replid left join kelas c on b.idkelas=c.replid left join tingkat d on c.idtingkat=d.replid left join pegawai e on a.idpegawai=e.replid left join jenis_izin f on a.idjenis_izin=f.replid " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
    
    
    //---------get data konseling siswa
	function list_rpt_konseling_siswa($daritgl='', $ketgl='', $idtingkat='', $kelas='', $nama='', $all='', $departemen=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($daritgl != "") {
			$daritgl = date("Y-m-d", strtotime($daritgl));
			if ($where == "") {
				$where = " where a.tanggal >= '$daritgl' ";
			} else {
				$where = $where . " and a.tanggal >= '$daritgl' ";
			}
		}
		
		if ($ketgl != "") {
			$ketgl = date("Y-m-d", strtotime($ketgl));
			if ($where == "") {
				$where = " where a.tanggal <= '$ketgl' ";
			} else {
				$where = $where . " and a.tanggal <= '$ketgl' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where c.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and c.idtingkat = '$idtingkat' ";
			}
		}
		
		if ($kelas != "") {
			if ($where == "") {
				$where = " where b.idkelas = '$kelas' ";
			} else {
				$where = $where . " and b.idkelas = '$kelas' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where b.nama like '%$nama%' ";
			} else {
				$where = $where . " and b.nama like '%$nama%' ";
			}
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where d.departemen = '$departemen' ";
			} else {
				$where = $where . " and d.departemen = '$departemen' ";
			}
		}
		
		if ($all != "") {
			$where = "";
		}
		
		if($daritgl=='' && $ketgl=='' && $idtingkat=='' && $kelas=='' && $nama=='' &&  $all=='' && $departemen=='') {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	=	"select a.ref, a.tanggal, a.idsiswa, a.idjenis_konseling, a.konseling, a.solusi, a.nip, a.data_file, a.uid, a.dlu, b.nis, b.nama nama_siswa, b.idkelas, c.kelas, c.idtingkat, d.tingkat, e.nama nama_pegawai from konseling_siswa a left join siswa b on a.idsiswa=b.replid left join kelas c on b.idkelas=c.replid left join tingkat d on c.idtingkat=d.replid left join pegawai e on a.nip=e.nip " . $where . " order by a.ref ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
    
    
    //---------get data pegawai pangkat
	function list_pegawai_pangkat($bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($bagian != "") {
			$bagian	 = 	str_replace("|"," ",$bagian);
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
			$where = "";
		}
		
		if($bagian=='' && $nip=='' && $nama=='' && $all=='') {
			$where = " where a.replid=0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai kenaikan gaji berkala
	function list_kenaikan_gaji($bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($bagian != "") {
			$bagian	 = 	str_replace("|"," ",$bagian);
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
			$where = "";
		}
		
		if($bagian=='' && $nip=='' && $nama=='' && $all=='') {
			$where = " where a.replid=0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	
	//---------get data pegawai pendidikan
	function list_pegawai_pendidikan($bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($bagian != "") {
			$bagian	 = 	str_replace("|"," ",$bagian);
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
			$where = "";
		}
		
		if($bagian=='' && $nip=='' && $nama=='' && $all=='') {
			$where = " where a.replid=0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai keluarga
	function list_pegawai_keluarga($bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($bagian != "") {
			$bagian	 = 	str_replace("|"," ",$bagian);
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
			$where = "";
		}
		
		if($bagian=='' && $nip=='' && $nama=='' && $all=='') {
			$where = " where a.replid=0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai prestasi
	function list_pegawai_prestasi($bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($bagian != "") {
			$bagian	 = 	str_replace("|"," ",$bagian);
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
			$where = "";
		}
		
		if($bagian=='' && $nip=='' && $nama=='' && $all=='') {
			$where = " where a.replid=0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai penghargaan
	function list_pegawai_penghargaan($bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($bagian != "") {
			$bagian	 = 	str_replace("|"," ",$bagian);
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
			$where = "";
		}
		
		if($bagian=='' && $nip=='' && $nama=='' && $all=='') {
			$where = " where a.replid=0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai skmengajar
	function list_pegawai_skmengajar($bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($bagian != "") {
			$bagian	 = 	str_replace("|"," ",$bagian);
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
			$where = "";
		}
		
		if($bagian=='' && $nip=='' && $nama=='' && $all=='') {
			$where = " where a.replid=0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data siswa ekstrakurikuler
	function list_siswa_ekstrakurikuler($unit='', $nis='', $idtingkat2='', $idkelas2='', $nama2='', $all='', $idpelajaran='', $semester_id='', $idtahunajaran=''){
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
			
			if($strextra != "") {
				$where = " where a.idpelajaran in (".$strextra.") ";	
			}
			
		} else {
			$where = "";
		}
		
		if ($unit != "") {
			
			if ($where == "") {
				$where = " where d.departemen = '$unit' ";
			} else {
				$where = $where . " and d.departemen = '$unit' ";
			}
		}
		
		if ($nis != "") {
			if ($where == "") {
				$where = " where b.nis = '$nis' ";
			} else {
				$where = $where . " and b.nis = '$nis' ";
			}
		}
		
		if ($idtingkat2 != "") {
			if ($where == "") {
				$where = " where c.idtingkat = '$idtingkat2' ";
			} else {
				$where = $where . " and c.idtingkat = '$idtingkat2' ";
			}
		}
		
		if ($idkelas2 != "") {
			if ($where == "") {
				$where = " where b.idkelas = '$idkelas2' ";
			} else {
				$where = $where . " and b.idkelas = '$idkelas2' ";
			}
		}
		
		if ($idpelajaran != "") {
			if ($where == "") {
				$where = " where a.idpelajaran = '$idpelajaran' ";
			} else {
				$where = $where . " and a.idpelajaran = '$idpelajaran' ";
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
			if($_SESSION["tipe_user"] == "Guru") {
				if($strextra != "") {
					$where = " where a.idpelajaran in (".$strextra.") ";	
				}
			} else {
				$where = ""; // where a.replid in (select idsiswa from siswa_ekstrakurikuler)
			}
		}
		
		
		if ($semester_id != "") {
			if ($where == "") {
				$where = " where a.idsemester = '$semester_id' ";
			} else {
				$where = $where . " and a.idsemester = '$semester_id' ";
			}
		}
		
		if ($idtahunajaran != "") {
			if ($where == "") {
				$where = " where a.idtahunajaran = '$idtahunajaran' ";
			} else {
				$where = $where . " and a.idtahunajaran = '$idtahunajaran' ";
			}
		}
		
		
		if($unit=='' && $nis=='' && $idtingkat2=='' && $idkelas2=='' && $nama2=='' && $all=='' && $idpelajaran=='' && $semester_id=='' && $idtahunajaran=='') {
			$where = " where a.replid=0 ";
		}
		
		/*$sqlstr	=	"select a.replid, a.nis, a.nama, b.kelas, c.tingkat, c.departemen, d.nama nama_pelajaran from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid left join pelajaran d on a.idpelajaran=d.replid " . $where . " order by a.replid ";*/
		
		$sqlstr = "select a.replid, a.idsiswa, a.idtahunajaran, a.idpelajaran, a.tanggal, a.line, a.uid, a.dlu, b.nis, b.nisn, b.nama, c.kelas, d.tingkat, e.nama nama_pelajaran, a.nilai, b.kelamin, '' nama_guru from siswa_ekstrakurikuler a left join siswa b on a.idsiswa=b.replid left join kelas c on b.idkelas=c.replid left join tingkat d on c.idtingkat=d.replid left join pelajaran e on a.idpelajaran=e.replid  " . $where . " order by b.nama ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data ekskul guru
	function list_siswa_ekstrakurikuler_guru($idpelajaran=''){
		$dbpdo = DB::create();
		
		$sqlstr	= " select c.nama nama_guru from pelajaran a left join guru b on a.replid=b.idpelajaran left join pegawai c on b.nip=c.replid where a.replid='$idpelajaran' limit 1";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get pinjam
	function list_pinjam($replid='', $idanggota='', $tglpinjam='', $tglkembali='', $all=''){
		$dbpdo = DB::create();
		
		$now	= date("Y-m-d");
		$where = " where a.status=1 "; //and datediff('".$now."', a.tglkembali) > 0";
		
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
			$where = " where a.status=1 "; //and datediff('".$now."', a.tglkembali) > 0";
		}
		
		if($replid=='' && $idanggota=='' && $tglpinjam=='' && $tglkembali=='' && $all=='') {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	= "select a.replid, a.kodepustaka, a.tglpinjam, a.tglkembali, a.idanggota, a.keterangan, a.status, a.tglditerima, a.petugaspinjam, a.ts, c.judul, d.nama, datediff('".$now."', a.tglkembali) terlambat from pinjam a left join daftarpustaka b on a.kodepustaka=b.kodepustaka left join pustaka c on b.pustaka=c.replid left join (select nis, nama from siswa union all select nip nis, nama from pegawai) d on a.idanggota=d.nis " . $where . " order by a.replid ";	
		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data daftarnilai
	function list_daftarnilai($departemen='', $idtingkat='', $idkelas='', $idtahunajaran='', $idsemester='', $nis='', $idkompetensi='', $idjeniskompetensi='', $iddasarpenilaian='', $idpelajaran=''){
		
		$dbpdo = DB::create();
				
		$sqlstr = "select a.replid, a.n1, a.n2, a.n3, a.n4, a.uts, a.jumlah, a.rata, a.persen, a.uas, a.persen1, a.na, a.a, a.line from daftarnilai a where a.departemen='$departemen' and a.idtingkat='$idtingkat' and a.idkelas='$idkelas' and a.idtahunajaran='$idtahunajaran' and a.idsemester='$idsemester' and a.nis='$nis' and a.idkompetensi='$idkompetensi' and a.idjeniskompetensi='$idjeniskompetensi' and a.iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran' ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data nilai
	function list_daftarnilai2($nis='', $idtingkat='', $idkelas='', $idtahunajaran='', $idsemester='', $idpelajaran='', $iddasarpenilaian='', $nis_siswa=''){	 
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
		
		if ( $idtahunajaran != "") {
			if( (substr($nis_siswa,0,4)== '1819' || substr($nis_siswa,0,4)== '1718') ) {
				$sqlstr2= "select a.replid from daftarnilai a where a.nis = '$nis' and a.idtingkat = '$idtingkat' and a.idkelas = '$idkelas' and a.idsemester = '$idsemester' and a.idpelajaran = '$idpelajaran' and a.iddasarpenilaian = '$iddasarpenilaian' and a.idtahunajaran = '$idtahunajaran' order by a.replid";
				$sql2=$dbpdo->prepare($sqlstr2);
				$sql2->execute();
				$rows = $sql2->rowCount();
				if($rows > 0) {
					if ($where == "") {
						$where = " where a.idtahunajaran = '$idtahunajaran' ";
					} else {
						$where = $where . " and a.idtahunajaran = '$idtahunajaran' ";
					}
				}
			} else {
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
	
	
	//---------get data view daftarnilai
	function list_daftarnilai_view($departemen='', $idtingkat='', $idkelas='', $idtahunajaran='', $idsemester='', $nis='', $idkompetensi='', $idjeniskompetensi='', $iddasarpenilaian='', $idpelajaran=''){
		
		$dbpdo = DB::create();
				
		$sqlstr = "select a.replid, a.n1, a.n2, a.n3, a.n4, a.uts, a.jumlah, a.rata, a.persen, a.uas, a.persen1, a.na, a.a, a.line from daftarnilai a left join daftarnilai b on a.departemen=b.departemen and a.idtingkat=b.idtingkat and a.idkelas=b.idkelas and a.idtahunajaran=b.idtahunajaran and a.idsemester=b.idsemester and a.nis=b.nis and a.idkompetensi=b.idkompetensi  where a.departemen='$departemen' and a.idtingkat='$idtingkat' and a.idkelas='$idkelas' and a.idtahunajaran='$idtahunajaran' and a.idsemester='$idsemester' and a.nis='$nis' and a.idkompetensi='$idkompetensi' and a.idjeniskompetensi='$idjeniskompetensi' and a.iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran' ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	
	//---------get data pelunasan pembayaran
	function list_rpt_lunas($daritgl='', $ketgl='', $idtingkat='', $kelas='', $nama='', $departemen='', $all='', $nis=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($daritgl != "") {
			$daritgl = date("Y-m-d", strtotime($daritgl));
			if ($where == "") {
				$where = " where p.tanggal >= '$daritgl' ";
			} else {
				$where = $where . " and p.tanggal >= '$daritgl' ";
			}
		}
		
		if ($ketgl != "") {
			$ketgl = date("Y-m-d", strtotime($ketgl));
			if ($where == "") {
				$where = " where p.tanggal <= '$ketgl' ";
			} else {
				$where = $where . " and p.tanggal <= '$ketgl' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where d.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and d.idtingkat = '$idtingkat' ";
			}
		}
		
		if ($kelas != "") {
			if ($where == "") {
				$where = " where c.idkelas = '$kelas' ";
			} else {
				$where = $where . " and c.idkelas = '$kelas' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where c.nama like '%$nama%' ";
			} else {
				$where = $where . " and c.nama like '%$nama%' ";
			}
		}
		
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where e.departemen = '$departemen' ";
			} else {
				$where = $where . " and e.departemen = '$departemen' ";
			}
		}
		
		if ($nis != "") {
			if ($where == "") {
				$where = " where c.nis = '$nis' ";
			} else {
				$where = $where . " and c.nis = '$nis' ";
			}
		}
		
		if ($all != "") {
			$where = "";
		}
		
		if($daritgl=='' && $ketgl=='' && $idtingkat=='' && $kelas=='' && $nama=='' && $departemen=='' &&  $all=='' && $nis=='') {
			$where = " where c.replid = 0 ";
		}
		
		/*-------get data belum lunas----------*/
		$sqlstr = "select b.nis, sum(b.besar) besar, SUM(p.jumlah) AS jumlah, (ifnull(b.besar,0) - SUM(ifnull(p.jumlah,0)) ) cicilan, c.nama, d.kelas, e.tingkat, f.nama namaterima, b.idpenerimaan, 0 id_pjtt, 0 nomor, g.virtualaccount from siswa c left join besarjtt b on b.nis=c.nis left join datapenerimaan f on f.replid=b.idpenerimaan left join penerimaanjtt p on b.replid = p.idbesarjtt left join kelas d on c.idkelas=d.replid left join tingkat e on d.idtingkat=e.replid left join siswa_virtualaccount g on c.nis=g.nis " . $where . " GROUP BY b.nis having (sum(ifnull(b.besar,0)) - sum(ifnull(b.potongan,0)) - SUM(ifnull(p.jumlah,0)) ) > 0 order by c.nama ";
		//$sqlstr = "select b.nis, sum(b.besar) besar, SUM(p.jumlah) AS jumlah, (ifnull(b.besar,0) - SUM(ifnull(p.jumlah,0)) ) cicilan, c.nama, d.kelas, e.tingkat, f.nama namaterima, b.idpenerimaan, 0 id_pjtt, 0 nomor from siswa c left join besarjtt b on b.nis=c.nis left join datapenerimaan f on f.replid=b.idpenerimaan left join penerimaanjtt p on b.replid = p.idbesarjtt left join kelas d on c.idkelas=d.replid left join tingkat e on d.idtingkat=e.replid " . $where . " GROUP BY b.nis having (sum(ifnull(b.besar,0)) - sum(ifnull(b.potongan,0)) - SUM(ifnull(p.jumlah,0)) ) > 0 order by c.nama ";
		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pelunasan pembayaran
	function list_rpt_lunas_detail($nis=''){
		$dbpdo = DB::create();
		
		$where = " where (ifnull(b.besar,0) - ifnull(b.potongan,0) - ifnull(p.jumlah,0)) > 0 and f.idkategori <> 'JTT' ";
		
		if ($nis != "") {
			if ($where == "") {
				$where = " where c.nis = '$nis' ";
			} else {
				$where = $where . " and c.nis = '$nis' ";
			}
		}
		
		
		/*-------get data belum lunas----------*/
		$sqlstr = "select b.nis, b.besar, p.jumlah, ifnull(b.besar,0) - ifnull(p.jumlah,0) cicilan, c.nama, d.kelas, e.tingkat, f.nama namaterima, b.idpenerimaan, f.idkategori, 0 id_pjtt, 0 nomor from siswa c left join besarjtt b on b.nis=c.nis left join datapenerimaan f on f.replid=b.idpenerimaan left join penerimaanjtt p on b.replid = p.idbesarjtt left join kelas d on c.idkelas=d.replid left join tingkat e on d.idtingkat=e.replid " . $where . " order by c.nama ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data pelunasan pembayaran
	function list_rpt_lunas_detail_jtt($nis='', $jtt=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($nis != "") {
			if ($where == "") {
				$where = " where c.nis = '$nis' ";
			} else {
				$where = $where . " and c.nis = '$nis' ";
			}
		}
		
		if ($jtt != "") {
			if ($where == "") {
				$where = " where f.idkategori = '$jtt' ";
			} else {
				$where = $where . " and f.idkategori = '$jtt' ";
			}
		}
		
		
		/*-------get data belum lunas----------*/
		$sqlstr = "select b.nis, sum(b.besar) besar, sum(p.jumlah) jumlah, sum(ifnull(b.besar,0)) - sum(ifnull(p.jumlah,0)) cicilan, c.nama, d.kelas, e.tingkat, f.nama namaterima, b.idpenerimaan, f.idkategori, 0 id_pjtt, 0 nomor from siswa c left join besarjtt b on b.nis=c.nis left join datapenerimaan f on f.replid=b.idpenerimaan left join penerimaanjtt p on b.replid = p.idbesarjtt left join kelas d on c.idkelas=d.replid left join tingkat e on d.idtingkat=e.replid " . $where . " group by c.nis, f.idkategori, f.nama having ( sum(ifnull(b.besar,0)) - sum(ifnull(b.potongan,0)) - sum(ifnull(p.jumlah,0)) ) > 0 order by c.nama ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	
	//---------get data siswa kelulusan
	function list_kelulusan($idangkatan='', $idtingkat='', $idkelas='', $nis='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = " where ifnull(a.alumni,0) = 0";
		
		if ($idangkatan != "") {
			if ($where == "") {
				$where = " where a.idangkatan = '$idangkatan' ";
			} else {
				$where = $where . " and a.idangkatan = '$idangkatan' ";
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
				$where = " where a.idkelas = '$idkelas' ";
			} else {
				$where = $where . " and a.idkelas = '$idkelas' ";
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
		
		if ($all != "") {
			$where = " where ifnull(a.alumni,0) = 0";
		}
		
		if($idangkatan=='' && $idtingkat=='' && $idkelas=='' && $nis=='' && $nama=='' && $all=='') {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nis, a.nisn, a.idangkatan, a.idangkatan1, a.foto_file, a.nama, a.idkelas, b.idtingkat, b.kelas, c.tingkat from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data alumni
	function list_alumni($ref='', $departemen='', $idangkatan1='', $tahunmasuk='', $tgllulus='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.nis = '$ref' ";
			} else {
				$where = $where . " and a.nis = '$ref' ";
			}
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where a.departemen = '$departemen' ";
			} else {
				$where = $where . " and a.departemen = '$departemen' ";
			}
		}
		
		if ($idangkatan1 != "") {
			if ($where == "") {
				$where = " where b.idangkatan1 = '$idangkatan1' ";
			} else {
				$where = $where . " and b.idangkatan1 = '$idangkatan1' ";
			}
		}
		
		if ($tahunmasuk != "") {
			if ($where == "") {
				$where = " where date_format(b.tglmasuk,'%Y') = '$tahunmasuk' ";
			} else {
				$where = $where . " and date_format(b.tglmasuk,'%Y') = '$tahunmasuk' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where b.nama like '%$nama%' ";
			} else {
				$where = $where . " and b.nama like '%$nama%' ";
			}
		}
		
		if ($tgllulus != "") {
			
			$tgllulus = date("Y-m-d", strtotime($tgllulus));
			
			if ($where == "") {
				$where = " where a.tgllulus = '$tgllulus' ";
			} else {
				$where = $where . " and a.tgllulus = '$tgllulus' ";
			}
		}
		
		
		if ($all != "") {
			$where = "";
		}
		
		if($ref=='' && $departemen=='' && $idangkatan1=='' && $tahunmasuk=='' && $tgllulus=='' && $nama=='' && $all=='') {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nis, a.klsakhir, a.tktakhir, a.tgllulus, a.keterangan, a.departemen, a.ts, b.replid idsiswa, b.nisn, b.nama, b.kelamin, b.tglmasuk, b.tahunmasuk, c.kelas, d.tingkat, e.angkatan from alumni a left join siswa b on a.nis=b.nis and b.alumni=1 left join kelas c on a.klsakhir=c.replid left join tingkat d on a.tktakhir=d.replid left join angkatan e on b.idangkatan1=e.replid " . $where . " order by a.replid ";
		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data rpt presensi harian siswa
	function rpt_presensi_harian_siswa($daritgl='', $ketgl='', $nis='', $kelas='', $idtingkat='', $nama='', $departemen=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($daritgl != "") {
			$daritgl = date("Y-m-d", strtotime($daritgl));
			if ($where == "") {
				$where = " where b.tanggal1 >= '$daritgl' ";
			} else {
				$where = $where . " and b.tanggal1 >= '$daritgl' ";
			}
		}
		
		if ($ketgl != "") {
			$ketgl = date("Y-m-d", strtotime($ketgl));
			if ($where == "") {
				$where = " where b.tanggal1 <= '$ketgl' ";
			} else {
				$where = $where . " and b.tanggal1 <= '$ketgl' ";
			}
		}
		
		if ($nis != "") {
			if ($where == "") {
				$where = " where a.nis = '$nis' ";
			} else {
				$where = $where . " and a.nis = '$nis' ";
			}
		}
		
		if ($kelas != "") {
			if ($where == "") {
				$where = " where c.idkelas = '$kelas' ";
			} else {
				$where = $where . " and c.idkelas = '$kelas' ";
			}
		}
		
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where d.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and d.idtingkat = '$idtingkat' ";
			}
		}
				
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where c.nama like '%$nama%' ";
			} else {
				$where = $where . " and c.nama like '%$nama%' ";
			}
		}
		
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where f.departemen = '$departemen' ";
			} else {
				$where = $where . " and f.departemen = '$departemen' ";
			}
		}
		
		$sqlstr = "select a.nis, b.tanggal1, c.nama, d.kelas, f.tingkat, e.semester, a.hadir, a.ijin, a.sakit, a.alpa, a.cuti, a.keterangan from phsiswa a left join presensiharian b on a.idpresensi=b.replid left join siswa c on a.nis=c.nis left join kelas d on c.idkelas=d.replid left join semester e on b.idsemester=e.replid left join tingkat f on d.idtingkat=f.replid " . $where . " order by b.tanggal1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data penerimaan pembayaran (outstanding)
	function list_dashboard_receipt_outstanding($departemen=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where e.departemen = '$departemen' ";
			} else {
				$where = $where . " and e.departemen = '$departemen' ";
			}
		}
				
		$sqlstr	=	"select a.replid, a.ref, a.tanggal, sum(ifnull(a.jumlah,0)) jumlah, sum(ifnull(b.potongan,0)) potongan, a.keterangan, a.petugas, c.nis, c.nama, d.kelas, e.tingkat, f.nama namapenerimaan, b.idpenerimaan, sum(ifnull(b.besar,0)) besar, sum(ifnull(b.besar,0)) - sum(ifnull(a.jumlah,0)) sisa from penerimaanjtt a left join besarjtt b on a.idbesarjtt=b.replid left join siswa c on b.nis=c.nis left join kelas d on c.idkelas=d.replid left join tingkat e on d.idtingkat=e.replid left join datapenerimaan f on b.idpenerimaan=f.replid " . $where . " group by c.nis order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data dashboard presensi harian siswa
	function list_dashboard_presensi_harian_siswa($departemen=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where f.departemen = '$departemen' ";
			} else {
				$where = $where . " and f.departemen = '$departemen' ";
			}
		}
		
		$sqlstr = "select count(a.nis) jumlah, a.nis, b.tanggal1, c.nama, d.kelas, f.tingkat, e.semester, a.hadir, a.ijin, a.sakit, a.alpa, a.cuti, a.keterangan from phsiswa a left join presensiharian b on a.idpresensi=b.replid left join siswa c on a.nis=c.nis left join kelas d on c.idkelas=d.replid left join semester e on b.idsemester=e.replid left join tingkat f on d.idtingkat=f.replid " . $where . " group by a.nis order by b.tanggal1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data dashboard presensi harian guru
	function list_dashboard_presensi_harian_guru($departemen=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		/*if ($departemen != "") {
			if ($where == "") {
				$where = " where f.departemen = '$departemen' ";
			} else {
				$where = $where . " and f.departemen = '$departemen' ";
			}
		}*/
		
		$sqlstr = "select count(a.nip) jumlah, a.nip, a.nama from pegawai a " . $where . " group by a.nip order by a.replid desc limit 4";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data rpt presensi harian siswa
	function rpt_presensi_pelajaran_siswa($daritgl='', $ketgl='', $nis='', $kelas='', $idtingkat='', $nama='', $departemen=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($daritgl != "") {
			$daritgl = date("Y-m-d", strtotime($daritgl));
			if ($where == "") {
				$where = " where a.tanggal >= '$daritgl' ";
			} else {
				$where = $where . " and a.tanggal >= '$daritgl' ";
			}
		}
		
		if ($ketgl != "") {
			$ketgl = date("Y-m-d", strtotime($ketgl));
			if ($where == "") {
				$where = " where a.tanggal <= '$ketgl' ";
			} else {
				$where = $where . " and a.tanggal <= '$ketgl' ";
			}
		}
		
		if ($nis != "") {
			if ($where == "") {
				$where = " where a.nis = '$nis' ";
			} else {
				$where = $where . " and a.nis = '$nis' ";
			}
		}
		
		if ($kelas != "") {
			if ($where == "") {
				$where = " where a.idkelas = '$kelas' ";
			} else {
				$where = $where . " and a.idkelas = '$kelas' ";
			}
		}
		
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where c.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and c.idtingkat = '$idtingkat' ";
			}
		}
				
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where b.nama like '%$nama%' ";
			} else {
				$where = $where . " and b.nama like '%$nama%' ";
			}
		}
		
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where e.departemen = '$departemen' ";
			} else {
				$where = $where . " and e.departemen = '$departemen' ";
			}
		}
		
		
		$sqlstr = "select a.replid, a.tanggal, a.jam, b.nis, a.idkelas, a.idsemester, a.idpelajaran, a.gurupelajaran, a.bulan, a.tahun, a.hadir, b.nama, c.kelas, d.semester, e.tingkat, f.nama pelajaran, g.nip, g.nama guru from ppsiswahadir a left join siswa b on a.nis=b.replid left join kelas c on a.idkelas=c.replid left join semester d on a.idsemester=d.replid left join tingkat e on c.idtingkat=e.replid left join pelajaran f on a.idpelajaran=f.replid left join pegawai g on a.gurupelajaran=g.replid " . $where . " order by a.tanggal, a.jam";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data rpt guru pelajaran
	function rpt_presensi_pelajaran_guru($daritgl='', $ketgl='', $nis='', $kelas='', $idtingkat='', $nama='', $departemen=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($daritgl != "") {
			$daritgl = date("Y-m-d", strtotime($daritgl));
			if ($where == "") {
				$where = " where a.tanggal >= '$daritgl' ";
			} else {
				$where = $where . " and a.tanggal >= '$daritgl' ";
			}
		}
		
		if ($ketgl != "") {
			$ketgl = date("Y-m-d", strtotime($ketgl));
			if ($where == "") {
				$where = " where a.tanggal <= '$ketgl' ";
			} else {
				$where = $where . " and a.tanggal <= '$ketgl' ";
			}
		}
				
		if ($kelas != "") {
			if ($where == "") {
				$where = " where a.idkelas = '$kelas' ";
			} else {
				$where = $where . " and a.idkelas = '$kelas' ";
			}
		}
		
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where c.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and c.idtingkat = '$idtingkat' ";
			}
		}
				
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where g.nama like '%$nama%' ";
			} else {
				$where = $where . " and g.nama like '%$nama%' ";
			}
		}
		
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where e.departemen = '$departemen' ";
			} else {
				$where = $where . " and e.departemen = '$departemen' ";
			}
		}
		
		
		$sqlstr = "select a.replid, a.tanggal, a.jam, a.idkelas, a.idsemester, a.idpelajaran, a.gurupelajaran, c.kelas, d.semester, e.tingkat, f.nama pelajaran, g.nip, g.nama guru from presensipelajaran a left join kelas c on a.idkelas=c.replid left join semester d on a.idsemester=d.replid left join tingkat e on c.idtingkat=e.replid left join pelajaran f on a.idpelajaran=f.replid left join pegawai g on a.gurupelajaran=g.replid " . $where . " order by a.tanggal, a.jam";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	
	//---------get data penerimaan pembayaran
	function protected_penerimaan($nis='', $nama=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($nis != "") {
			if ($where == "") {
				$where = " where c.nis = '$nis' ";
			} else {
				$where = $where . " and c.nis = '$nis' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where f.nama = '$nama' ";
			} else {
				$where = $where . " and f.nama = '$nama' ";
			}
		}
				
		$sqlstr	=	"select a.replid, a.ref, a.tanggal, a.jumlah, ifnull(b.potongan,0) potongan, a.keterangan, a.petugas, c.nis, c.nama, d.kelas, e.tingkat, f.nama namapenerimaan, b.idpenerimaan, b.besar from penerimaanjtt a left join besarjtt b on a.idbesarjtt=b.replid left join siswa c on b.nis=c.nis left join kelas d on c.idkelas=d.replid left join tingkat e on d.idtingkat=e.replid left join datapenerimaan f on b.idpenerimaan=f.replid " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data rpt presensi harian general
	function rpt_presensi_general($daritgl='', $ketgl='', $nis='', $nama=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($daritgl != "") {
			$daritgl = date("Y-m-d", strtotime($daritgl));
			if ($where == "") {
				$where = " where date_format(a.tanggal,'%Y-%m-%d') >= '$daritgl' ";
			} else {
				$where = $where . " and date_format(a.tanggal,'%Y-%m-%d') >= '$daritgl' ";
			}
		}
		
		if ($ketgl != "") {
			$ketgl = date("Y-m-d", strtotime($ketgl));
			if ($where == "") {
				$where = " where date_format(a.tanggal,'%Y-%m-%d') <= '$ketgl' ";
			} else {
				$where = $where . " and date_format(a.tanggal,'%Y-%m-%d') <= '$ketgl' ";
			}
		}
		
		if ($nis != "") {
			if ($where == "") {
				$where = " where a.nip = '$nis' ";
			} else {
				$where = $where . " and a.nip = '$nis' ";
			}
		}
				
		if ($nama != "") {
			if ($where == "") {
				$where = " where b.nama like '%$nama%' ";
			} else {
				$where = $where . " and b.nama like '%$nama%' ";
			}
		}
		
		
		$sqlstr = "select a.replid, a.tanggal, a.idpegawai, b.nip, b.nama, a.tanggal, a.hadir, a.ijin, a.sakit, a.alpa, a.cuti, a.keterangan from presensi_general a left join pegawai b on a.idpegawai=b.replid " . $where . " order by a.tanggal";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get PPK (Penguatan Pendidikan Karakter)
	function dashboard_presensi_general_ppk($daritgl='', $ketgl='', $nis='', $nama=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($daritgl != "") {
			$daritgl = date("Y-m-d H:i", strtotime($daritgl));
			if ($where == "") {
				$where = " where date_format(a.tanggal,'%Y-%m-%d %H:%i') >= '$daritgl' ";
			} else {
				$where = $where . " and date_format(a.tanggal,'%Y-%m-%d %H:%i') >= '$daritgl' ";
			}
		}
		
		if ($ketgl != "") {
			$ketgl = date("Y-m-d H:i", strtotime($ketgl));
			if ($where == "") {
				$where = " where date_format(a.tanggal,'%Y-%m-%d %H:%i') <= '$ketgl' ";
			} else {
				$where = $where . " and date_format(a.tanggal,'%Y-%m-%d %H:%i') <= '$ketgl' ";
			}
		}
		
		if ($nis != "") {
			if ($where == "") {
				$where = " where a.nip = '$nis' ";
			} else {
				$where = $where . " and a.nip = '$nis' ";
			}
		}
				
		if ($nama != "") {
			if ($where == "") {
				$where = " where b.nama like '%$nama%' ";
			} else {
				$where = $where . " and b.nama like '%$nama%' ";
			}
		}
		
		
		$sqlstr = "select a.replid, a.tanggal, a.idpegawai, b.nip, b.nama, a.tanggal, a.hadir, a.ijin, a.sakit, a.alpa, a.cuti, a.keterangan from presensi_general a left join pegawai b on a.idpegawai=b.replid " . $where . " order by a.tanggal";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data siswa krs
	function list_siswa_krs($replid='', $kelompok_pelajaran_id=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.nis = '$replid' ";
			} else {
				$where = $where . " and a.nis = '$replid' ";
			}
		}
		
		if ($kelompok_pelajaran_id != "") {
			if ($where == "") {
				$where = " where a.kelompok_pelajaran_id = '$kelompok_pelajaran_id' ";
			} else {
				$where = $where . " and a.kelompok_pelajaran_id = '$kelompok_pelajaran_id' ";
			}
		}
		
		$sqlstr	= "select a.replid, a.nis, a.semester_id, a.pelajaran_id, a.pegawai_id, a.kelompok_pelajaran_id, a.approved, a.uid, a.dlu, b.kode kode_pelajaran, b.nama nama_pelajaran, c.sks, e.kkm, e.kkm_terampil, d.replid idsiswa, d.idkelas, f.idtingkat from siswa_krs a left join pelajaran b on a.pelajaran_id=b.replid left join kartu_rencana_studi c on a.sks_id=c.replid left join siswa d on a.nis=d.nis left join predikat_raport e on a.pelajaran_id=e.idpelajaran left join kelas f on d.idkelas=f.replid  " . $where . " order by a.replid";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data ukbm
	function list_ukbm_pertemuan($idtingkat='', $idpelajaran='', $idsemester=''){
		$dbpdo = DB::create();
		
		$where = "";
		
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
		
		/*if ($idsemester != "") {
			if ($where == "") {
				$where = " where a.idsemester = '$idsemester' ";
			} else {
				$where = $where . " and a.idsemester = '$idsemester' ";
			}
		}*/
		//, a.idsemester
		$sqlstr	=	"select sum(a.jumlah_ukbm) jumlah_ukbm from pemetaan_kd a " . $where . " group by a.idtingkat, a.idpelajaran order by a.idpelajaran";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data predikat raport (tertinggi)
	function list_predikat_raport_1($idangkatan=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idangkatan != "") {
			if ($where == "") {
				$where = " where a.idangkatan = '$idangkatan' ";
			} else {
				$where = $where . " and a.idangkatan = '$idangkatan' ";
			}
		}
				
		$sqlstr	= "select a.replid, a.kkm, a.nilai_angka_a, a.nilai_angka_a1, a.nilai_angka_b, a.nilai_angka_b1, a.nilai_angka_c, a.nilai_angka_c1, a.nilai_angka_d, a.nilai_angka_d1, a.deskripsi_p_a, a.deskripsi_k_a, a.deskripsi_p_b, a.deskripsi_k_b, a.deskripsi_p_c, a.deskripsi_k_c, a.deskripsi_p_d, a.deskripsi_k_d from predikat_raport a where ifnull(a.deskripsi_p_a,'')<>'' order by a.nilai_angka_a1 desc limit 1";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data daftarnilai
	function list_daftarnilai_raport($departemen='', $idtingkat='', $idkelas='', $idsemester='', $nis='', $sifat='', $peminatan='', $idtahunajaran='', $nis_siswa=''){
		
		$dbpdo = DB::create();
		
		if($idtahunajaran != "") {
			if( (substr($nis_siswa,0,4)== '1819' || substr($nis_siswa,0,4)== '1718') ) {
				$sqlstr2 = "select distinct a.nis from daftarnilai a left join pelajaran b on a.idpelajaran=b.replid left join predikat_raport c on a.idpelajaran=c.idpelajaran left join kartu_rencana_studi d on a.idtingkat=d.tingkat_id and a.idpelajaran=d.pelajaran_id and a.idsemester=d.semester_id inner join siswa e on a.nis=e.replid where a.departemen='$departemen' and a.idsemester='$idsemester' and a.nis='$nis' and (a.iddasarpenilaian=3) and b.sifat='$sifat' and d.peminatan='$peminatan' and (b.minat='$peminatan' or ifnull(b.minat,'')='' ) " . " and d.idtahunajaran='$idtahunajaran' " . $where." order by d.urutan, a.nis";
				$sql2=$dbpdo->prepare($sqlstr2);
				$sql2->execute();
				$rows = $sql2->rowCount();
				if($rows > 0) {
					$where2 = " and a.idtahunajaran='$idtahunajaran' ";	
				}
			} else {
				$where2 = " and a.idtahunajaran='$idtahunajaran' ";
			}
		}
		
		$where = " where ifnull(a.jumlah,0)> 0 ";
		if($idkelas != "") {
			$where = " and a.idkelas='$idkelas' and ( (select replid from daftarnilai_detail where ifnull(nilai,0)>0 and replid=a.replid limit 1) > 0) ";
		}
		//ifnull(a.jumlah,0)> 0 or 

		$sqlstr = "select distinct a.idpelajaran pelajaran_id, a.nis idsiswa, a.idtingkat, a.idkelas, a.idsemester semester_id, a.sikap, a.line, case when ifnull(d.pelajaran_kode,'')<>'' then d.pelajaran_kode else b.kode end kode_pelajaran, b.nama nama_pelajaran, (case when ifnull(d.sks,0)=0 then b.info1 else d.sks end) sks, (case when ifnull(c.kkm,0)=0 then b.info2 else c.kkm end) kkm, (case when ifnull(c.kkm_terampil,0)=0 then b.token else c.kkm_terampil end) kkm_terampil, b.alias, b.idpelajaran_alias, d.kode1, d.kode2 from kartu_rencana_studi d left join daftarnilai a on a.idtingkat=d.tingkat_id and a.idpelajaran=d.pelajaran_id and a.idsemester=d.semester_id and a.idtahunajaran=d.idtahunajaran left join pelajaran b on a.idpelajaran=b.replid left join predikat_raport c on a.idpelajaran=c.idpelajaran inner join siswa e on a.nis=e.replid where a.departemen='$departemen' and a.idsemester='$idsemester' and a.nis='$nis' and (a.iddasarpenilaian=3) and b.sifat='$sifat' and d.peminatan='$peminatan' and (b.minat='$peminatan' or ifnull(b.minat,'')='' ) " . $where2 . $where." order by d.urutan, a.nis";
		
		//$sqlstr = "select distinct a.idpelajaran pelajaran_id, a.nis idsiswa, a.idtingkat, a.idkelas, a.idsemester semester_id, a.sikap, a.line, case when ifnull(d.pelajaran_kode,'')<>'' then d.pelajaran_kode else b.kode end kode_pelajaran, b.nama nama_pelajaran, (case when ifnull(d.sks,0)=0 then b.info1 else d.sks end) sks, (case when ifnull(c.kkm,0)=0 then b.info2 else c.kkm end) kkm, (case when ifnull(c.kkm_terampil,0)=0 then b.token else c.kkm_terampil end) kkm_terampil, b.alias, b.idpelajaran_alias from daftarnilai a left join pelajaran b on a.idpelajaran=b.replid left join predikat_raport c on a.idpelajaran=c.idpelajaran left join kartu_rencana_studi d on a.idtingkat=d.tingkat_id and a.idpelajaran=d.pelajaran_id and a.idsemester=d.semester_id and a.idtahunajaran=d.idtahunajaran inner join siswa e on a.nis=e.replid where a.departemen='$departemen' and a.idsemester='$idsemester' and a.nis='$nis' and (a.iddasarpenilaian=3) and b.sifat='$sifat' and d.peminatan='$peminatan' and (b.minat='$peminatan' or ifnull(b.minat,'')='' ) " . $where2 . $where." order by d.urutan, a.nis";
		//echo $sqlstr.'<br><br>';
		//and a.idkelas=e.idkelas //ifnull(a.sikap,'')<>'' and 
		
		//a.idtingkat='$idtingkat' and a.idkelas='$idkelas' and 		
		/*$sqlstr = "select distinct a.idpelajaran pelajaran_id, a.nis idsiswa, a.idtingkat, a.idkelas, a.idsemester semester_id, a.line, b.kode kode_pelajaran, b.nama nama_pelajaran, (case when ifnull(d.sks,0)=0 then b.info1 else d.sks end) sks, (case when ifnull(c.kkm,0)=0 then b.info2 else c.kkm end) kkm, (case when ifnull(c.kkm_terampil,0)=0 then b.token else c.kkm_terampil end) kkm_terampil from daftarnilai a left join pelajaran b on a.idpelajaran=b.replid left join predikat_raport c on a.idpelajaran=c.idpelajaran left join kartu_rencana_studi d on a.idtingkat=d.tingkat_id and a.idpelajaran=d.pelajaran_id and a.idsemester=d.semester_id where a.departemen='$departemen' and a.idsemester='$idsemester' and a.nis='$nis' and (a.iddasarpenilaian=3) and b.sifat='$sifat' order by a.nis, a.line";*/
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		//$sqlstr	= "select a.replid, a.nis, a.semester_id, a.pelajaran_id, a.pegawai_id, a.kelompok_pelajaran_id, a.approved, a.uid, a.dlu, b.kode kode_pelajaran, b.nama nama_pelajaran, c.sks, e.kkm, e.kkm_terampil, d.replid idsiswa, d.idkelas, f.idtingkat from siswa_krs a left join pelajaran b on a.pelajaran_id=b.replid left join kartu_rencana_studi c on a.sks_id=c.replid left join siswa d on a.nis=d.nis left join predikat_raport e on a.pelajaran_id=e.idpelajaran left join kelas f on d.idkelas=f.replid  " . $where . " order by a.replid";	
		
		return $sql;
	}
	
	
	//---------get data daftarnilai lintas minat
	function list_daftarnilai_raport_lintas_minat($departemen='', $idtingkat='', $idkelas='', $idsemester='', $nis='', $sifat='', $peminatan='', $idtahunajaran='', $nis_siswa=''){
		
		$dbpdo = DB::create();
		
		$where  = " and (case when ifnull(a.sikap,'')='' then 'A' else ifnull(a.sikap,'') end) <>'' "; //ifnull(a.sikap,'')<>'' ";
		
		if($idtahunajaran != "") {
			if( (substr($nis_siswa,0,4)== '1819' || substr($nis_siswa,0,4)== '1718') ) {
				$sqlstr2 = "select distinct a.nis from daftarnilai a left join pelajaran b on a.idpelajaran=b.replid left join predikat_raport c on a.idpelajaran=c.idpelajaran left join kartu_rencana_studi d on a.idtingkat=d.tingkat_id and a.idpelajaran=d.pelajaran_id and a.idsemester=d.semester_id left join siswa e on a.nis=e.replid and a.idkelas=e.idkelas where a.departemen='$departemen' and a.idsemester='$idsemester' and a.nis='$nis' and (a.iddasarpenilaian=3) and (b.sifat='$sifat') and d.peminatan='MIPA' and ifnull(a.sikap,'')<>'' and d.idtahunajaran='$idtahunajaran' and a.idtingkat='$idtingkat' order by d.urutan, a.nis";
				$sql2=$dbpdo->prepare($sqlstr2);
				$sql2->execute();
				$rows = $sql2->rowCount();
				if($rows > 0) {
					if($where == '') {
						$where  = " where d.idtahunajaran='$idtahunajaran' ";	
					} else {
						$where  = $where . " and d.idtahunajaran='$idtahunajaran' ";
					}
				}
			} else {
				if($where == '') {
					$where  = " where d.idtahunajaran='$idtahunajaran' ";	
				} else {
					$where  = $where . " and d.idtahunajaran='$idtahunajaran' ";
				}	
			}			
		}
		
		if($idtingkat != "") {
			if($where == '') {
				$where  = " where a.idtingkat='$idtingkat' ";	
			} else {
				$where  = $where . " and a.idtingkat='$idtingkat' ";
			}
		}
		
		if($idkelas != "") {
			if($where == '') {
				$where  = " where a.idkelas='$idkelas' ";	
			} else {
				$where  = $where . " and a.idkelas='$idkelas' ";
			}
		}
		
		$sqlstr = "select distinct a.idpelajaran pelajaran_id, a.nis idsiswa, a.idtingkat, a.idkelas, a.idsemester semester_id, a.sikap, a.line, case when ifnull(d.pelajaran_kode,'')<>'' then d.pelajaran_kode else b.kode end kode_pelajaran, b.nama nama_pelajaran, (case when ifnull(d.sks,0)=0 then b.info1 else d.sks end) sks, (case when ifnull(c.kkm,0)=0 then b.info2 else c.kkm end) kkm, (case when ifnull(c.kkm_terampil,0)=0 then b.token else c.kkm_terampil end) kkm_terampil, b.alias, b.idpelajaran_alias from kartu_rencana_studi d left join daftarnilai a on a.idtingkat=d.tingkat_id and a.idpelajaran=d.pelajaran_id and a.idsemester=d.semester_id and a.idtahunajaran=d.idtahunajaran left join pelajaran b on a.idpelajaran=b.replid left join predikat_raport c on a.idpelajaran=c.idpelajaran inner join siswa e on a.nis=e.replid where a.departemen='$departemen' and a.idsemester='$idsemester' and a.nis='$nis' and (a.iddasarpenilaian=3) and (b.sifat='$sifat') and d.peminatan='$peminatan' " . $where .  " order by d.urutan, a.nis";

		//$sqlstr = "select distinct a.idpelajaran pelajaran_id, a.nis idsiswa, a.idtingkat, a.idkelas, a.idsemester semester_id, a.sikap, a.line, case when ifnull(d.pelajaran_kode,'')<>'' then d.pelajaran_kode else b.kode end kode_pelajaran, b.nama nama_pelajaran, (case when ifnull(d.sks,0)=0 then b.info1 else d.sks end) sks, (case when ifnull(c.kkm,0)=0 then b.info2 else c.kkm end) kkm, (case when ifnull(c.kkm_terampil,0)=0 then b.token else c.kkm_terampil end) kkm_terampil, b.alias, b.idpelajaran_alias from daftarnilai a left join pelajaran b on a.idpelajaran=b.replid left join predikat_raport c on a.idpelajaran=c.idpelajaran left join kartu_rencana_studi d on a.idtingkat=d.tingkat_id and a.idpelajaran=d.pelajaran_id and a.idsemester=d.semester_id left join siswa e on a.nis=e.replid and a.idkelas=e.idkelas where a.departemen='$departemen' and a.idsemester='$idsemester' and a.nis='$nis' and (a.iddasarpenilaian=3) and (b.sifat='$sifat') and d.peminatan='$peminatan' " . $where .  " order by d.urutan, a.nis";
		
		// or b.minat<>'$peminatan'
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		return $sql;
	}
	
	//---------cek daftarnilai
	function cek_daftarnilai($departemen='', $idtingkat='', $idkelas='', $idtahunajaran='', $idsemester='', $nis='', $idkompetensi='', $idjeniskompetensi='', $iddasarpenilaian='', $idpelajaran=''){
		
		$dbpdo = DB::create();
		
		/*$sqlstr = "select b.replid from daftarnilai a inner join daftarnilai_detail b on a.replid=b.replid where a.departemen='$departemen' and a.idtingkat='$idtingkat' and a.idkelas='$idkelas' and a.idsemester='$idsemester' and idpelajaran='$idpelajaran' and ifnull(b.nilai,0)>0 ";*/
		$sqlstr = "select a.replid from daftarnilai a where a.departemen='$departemen' and a.idtingkat='$idtingkat' and a.idkelas='$idkelas' and a.idsemester='$idsemester' and idpelajaran='$idpelajaran' and ifnull(a.jumlah,0)>0 ";
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
	
	//---------get data list_daftarnilai detail
	function list_daftarnilai_detail($id=''){	 
		$dbpdo = DB::create();
			
		$sqlstr="select a.replid, a.nilai, a.line from daftarnilai_detail a where a.replid = '$id' order by a.line";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	
	//---------get data siswa
	function list_siswa2($ref='', $replid='', $idtingkat='', $idkelas='', $alumni='0', $aktif=''){
		$dbpdo = DB::create();
		
		$where = ""; //where a.replid in (1515, 270, 275) "; 
		
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
		
		if ($idkelas != "") {
			if ($where == "") {
				$where = " where a.idkelas = '$idkelas' ";
			} else {
				$where = $where . " and a.idkelas = '$idkelas' ";
			}
		}
		
		if ($alumni != "") {
			if ($where == "") {
				$where = " where a.alumni = '$alumni' ";
			} else {
				$where = $where . " and a.alumni = '$alumni' ";
			}
		}
		
		if ($aktif != "") {
			if ($where == "") {
				$where = " where a.aktif = '$aktif' ";
			} else {
				$where = $where . " and a.aktif = '$aktif' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.nis, a.nisn, a.nik, a.idangkatan, a.idangkatan1, a.foto_file, a.nama, a.panggilan, a.idkelas, a.kelamin, a.tmplahir, a.tgllahir, a.agama, a.warga, a.anakke, a.jsaudara, a.jtiri, a.jangkat, a.yatim, a.bahasa, a.desa_kode, a.kecamatan_kode, a.kota_kode, a.provinsi_kode, a.alamatsiswa, a.rt_siswa, a.rw_siswa, a.dusun, a.desa, a.kecamatan, a.kodepossiswa, a.jenistinggal, a.alamatortu, a.telponsiswa, a.hpsiswa, a.emailsiswa, a.kps, a.nokps, a.kip, a.nokip, a.namakip, a.nokks, a.no_akte_lahir, a.telponortu, a.hportu, a.hpibu, a.transportasi_kode, a.transportasi_lain, a.jaraksekolah, a.kesekolah, a.berat, a.tinggi, a.kesehatan, a.darah, a.file_darah, a.kelainan, a.asalsekolah_id, a.tglijazah, a.noijazah, a.tglskhun, a.skhun, a.noujian, a.nisnasal, a.nik_ayah, a.namaayah, a.nik_ibu, a.namaibu, a.alamatibu, a.tmplahirayah, a.tgllahirayah, a.tempat_bekerja_ayah, a.tmplahiribu, a.tgllahiribu, a.pekerjaanayah, a.pekerjaanibu, a.penghasilanayah_kode, a.penghasilanayah, a.penghasilanibu_kode, a.penghasilanibu, a.tempat_bekerja_ibu, a.pendidikanayah, a.pendidikanibu, a.wnayah, a.wnibu, a.nik_wali, a.wali, a.tmplahirwali, a.tgllahirwali, a.pendidikanwali, a.pekerjaanwali, a.penghasilanwali_kode, a.penghasilanwali, a.tempat_bekerja_wali, a.alamatwali, a.hpwali, a.hubungansiswa, a.pekerjaanayah_lain, a.pekerjaanibu_lain, a.pekerjaanwali_lain, a.rombel_id, a.nama_bank, a.no_rekening_bank, a.nama_pemilik_bank, a.pip, a.alasan_pip, f.virtualaccount, a.uid, a.aktif, a.ts, b.idtingkat, b.kelas, c.tingkat, c.departemen, d.pekerjaan pekerjaan_ayah, e.pekerjaan pekerjaan_ibu, a.idminat, a.jalurmasuk_id, a.jalurmasuk, a.jalurmasukprestasi_id, a.file_rekam_bk, a.file_memo_ortu, a.file_nilai_un, a.file_raport, a.file_kk, a.file_akte, a.file_ijazah, a.file_nhun, a.tahunskhun, a.kota_asalsekolah, g.pekerjaan pekerjaan_wali, a.tglmasuk, c.tanggal_ttd from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid left join jenispekerjaan d on a.pekerjaanayah=d.replid left join jenispekerjaan e on a.pekerjaanibu=e.replid left join siswa_virtualaccount f on a.nis=f.nis left join jenispekerjaan g on a.pekerjaanwali=g.replid " . $where . " order by a.idkelas, a.nama, a.nis, a.replid";
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
	
	
	//---------get data kelas
	function list_kelas($replid='', $idtingkat='', $departemen=''){
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


		if ($departemen != "") {
			if ($where == "") {
				$where = " where b.departemen = '$departemen' ";
			} else {
				$where = $where . " and b.departemen = '$departemen' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idtahunajaran, a.idtingkat, a.kelas, a.kapasitas, a.nipwali, a.aktif, a.keterangan, a.ts, b.tingkat, b.departemen, c.tahunajaran, d.nip nip_wali, d.nama walikelas from kelas a left join tingkat b on a.idtingkat=b.replid left join tahunajaran c on a.idtahunajaran=c.replid left join pegawai d on a.nipwali=d.nip " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data kelas detail
	function list_kelas_detail($replid='', $idtahunajaran=''){
		$dbpdo = DB::create();
		
		//cek detail
		$sqlstr	=	"select a.replid, a.idtahunajaran, a.nipwali, a.ttd_file from kelas_detail a where a.replid = '$replid' and a.idtahunajaran='$idtahunajaran' order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$rows=$sql->rowCount();
		if($rows > 0) {
			$sqlstr	=	"select a.replid, a.idtahunajaran, a.nipwali, b.nip nip_wali, b.nama walikelas, a.ttd_file from kelas_detail a left join pegawai b on a.nipwali=b.nip where a.replid = '$replid' and a.idtahunajaran='$idtahunajaran' order by a.replid ";	
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		} else {			
			$sqlstr	=	"select a.replid, a.idtahunajaran, a.idtingkat, a.kelas, a.kapasitas, a.nipwali, a.aktif, a.keterangan, a.ts, b.tingkat, b.departemen, c.tahunajaran, d.nip nip_wali, d.nama walikelas, a.ttd_file_hd ttd_file from kelas a left join tingkat b on a.idtingkat=b.replid left join tahunajaran c on a.idtahunajaran=c.replid left join pegawai d on a.nipwali=d.nip where a.replid = '$replid' order by a.replid ";	
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		
		return $sql;
	}
	
	
	//---------cek siswa ambil pelajaran
	function cek_siswa_ambil_pelajaran($departemen='', $idtingkat='', $idkelas='', $idtahunajaran='', $idsemester='', $nis='', $idkompetensi='', $idjeniskompetensi='', $iddasarpenilaian='', $idpelajaran=''){
		
		$dbpdo = DB::create();
		
		$sqlstr = "select b.replid from daftarnilai a inner join daftarnilai_detail b on a.replid=b.replid where a.departemen='$departemen' and a.idtingkat='$idtingkat' and a.idkelas='$idkelas' and a.idsemester='$idsemester' and idpelajaran='$idpelajaran' and ifnull(b.nilai,0)>0 ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data peminatan
	function list_peminatan($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.nama from peminatan a " . $where . " order by a.replid ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data ukbm
	function list_ukbm($ref='', $idtingkat='', $idpelajaran='', $all='', $idsemester=''){
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
		
		if ($idsemester != "") {
			if ($where == "") {
				$where = " where a.idsemester = '$idsemester' ";
			} else {
				$where = $where . " and a.idsemester = '$idsemester' ";
			}
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr	=	"select a.replid, a.idtingkat, a.idsemester, a.idpelajaran, a.idguru, a.kode, a.ukbm, a.deskripsi, a.file_ukbm, a.idrpp, a.minimum_hadir, sum(a.jumlah_ukbm) jumlah_ukbm, a.aktif, a.uid, a.dlu, b.tingkat, b.departemen, c.nama pelajaran, d.semester from ukbm a left join tingkat b on a.idtingkat=b.replid left join pelajaran c on a.idpelajaran=c.replid left join semester d on a.idsemester=d.replid " . $where . " group by a.idtingkat, a.idpelajaran order by b.departemen, c.nama ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data siswa ekstrakurikuler RAPORT
	function list_siswa_ekstrakurikuler_raport($unit='', $nis='', $idtingkat2='', $idkelas2='', $nama2='', $all='', $idsemester='', $idtahunajaran=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($unit != "") {
			
			if ($where == "") {
				$where = " where d.departemen = '$unit' ";
			} else {
				$where = $where . " and d.departemen = '$unit' ";
			}
		}
		
		if ($nis != "") {
			if ($where == "") {
				$where = " where a.idsiswa = '$nis' ";
			} else {
				$where = $where . " and a.idsiswa = '$nis' ";
			}
		}
		
		/*if ($idtingkat2 != "") {
			if ($where == "") {
				$where = " where c.idtingkat = '$idtingkat2' ";
			} else {
				$where = $where . " and c.idtingkat = '$idtingkat2' ";
			}
		}*/
		
		/*if ($idkelas2 != "") {
			if ($where == "") {
				$where = " where b.idkelas = '$idkelas2' ";
			} else {
				$where = $where . " and b.idkelas = '$idkelas2' ";
			}
		}*/
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where b.nama like '%$nama%' ";
			} else {
				$where = $where . " and b.nama like '%$nama%' ";
			}
		}
		
		if ($idsemester != "") {
			if ($where == "") {
				$where = " where a.idsemester = '$idsemester' ";
			} else {
				$where = $where . " and a.idsemester = '$idsemester' ";
			}
		}
		
		if($idtahunajaran != "") {
			if ($where == "") {
				$where = " where a.idtahunajaran = '$idtahunajaran' ";
			} else {
				$where = $where . " and a.idtahunajaran = '$idtahunajaran' ";
			}
		}
		
		if($all == 1) {
			$where = ""; 
		}
		
		if($unit=='' && $nis=='' && $idtingkat2=='' && $idkelas2=='' && $nama2=='' && $all=='' && $idsemester=='' && $idtahunajaran=='') {
			$where = " where a.replid=0 ";
		}
		
		$sqlstr = "select a.replid, a.idsiswa, a.idpelajaran, a.tanggal, a.line, a.uid, a.dlu, b.nis, b.nisn, b.nama, c.kelas, d.tingkat, e.nama nama_pelajaran, e.idpelajaran_alias, a.nilai from siswa_ekstrakurikuler a left join siswa b on a.idsiswa=b.replid left join kelas c on b.idkelas=c.replid left join tingkat d on c.idtingkat=d.replid left join pelajaran e on a.idpelajaran=e.replid " . $where . " order by ifnull(e.urutan,0) desc, b.nama desc, a.idpelajaran limit 3 ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get niali ekskul
	function get_nilai_ekskul($idtahunajaran='', $nis='', $idpelajaran=''){
		$dbpdo = DB::create();
		
		$where = " where a.idsiswa = '$nis' and a.idtahunajaran = '$idtahunajaran' and a.idpelajaran = '$idpelajaran' and ifnull(a.nilai,'')<>'' ";
				
		$sqlstr	=	"select a.nilai from siswa_ekstrakurikuler a " . $where . " limit 1 ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pelajaran alias
	function list_pelajaran_alias($ref='', $idpelajaran_alias=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		if ($idpelajaran_alias != "") {
			if ($where == "") {
				$where = " where a.idpelajaran_alias = '$idpelajaran_alias' ";
			} else {
				$where = $where . " and a.idpelajaran_alias = '$idpelajaran_alias' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.alias, b.nama nama_alias from pelajaran a left join pelajaran b on a.idpelajaran_alias=b.replid " . $where . " group by b.nama ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data KRS
	function list_kartu_rencana_studi($replid='', $kelompok_pelajaran_id='', $tingkat_id='', $semester_id='', $peminatan='', $idtahunajaran='', $idminat=''){
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
		
		$sqlstr	=	"select distinct a.tingkat_id, a.pelajaran_id, a.semester_id, a.sks, a.idtahunajaran, f.tahunajaran nama_tahunajaran, b.tingkat, c.nama nama_pelajaran, c.kode, d.semester kelompok_pelajaran from kartu_rencana_studi a left join tingkat b on a.tingkat_id=b.replid left join pelajaran c on a.pelajaran_id=c.replid left join semester d on a.semester_id=d.replid left join tahunajaran f on a.idtahunajaran=f.replid " . $where . " order by a.urutan, a.pelajaran_id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------cek mapel krs (sudah diambil/belum)
	function krs_pelajaran_cek($nis='', $idpelajaran='', $idsemester='', $old_idkelas=''){
		$dbpdo = DB::create();
		
		$sqlstr	= "select a.replid, a.jumlah from daftarnilai a where a.nis='$nis' and a.idpelajaran='$idpelajaran' and a.idsemester='$idsemester' and a.idkelas='$old_idkelas' and a.iddasarpenilaian=3 limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------list
	function list_riwayatkelassiswa($nis=''){
		$dbpdo = DB::create();
		
		$sqlstr	=	"select a.idkelas from riwayatkelassiswa a where a.nis='$nis' and a.aktif=0 limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data siswa baru
	function list_siswa_baru($ref='', $replid='', $idtingkat='', $kelas='', $nama='', $all='', $departemen='', $nik='', $kelamin='', $idgugus='', $idangkatan='', $idangkatan1=''){
		$dbpdo = DB::create();
		
		$where = " where ifnull(a.alumni,0)=2 ";
		
		if($_SESSION["adm"] == 0) {
			if($_SESSION["tipe_user"] == "Siswa") {
				$replid = $_SESSION["idpegawai"];	
			}			
		}
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.nis = '$ref' ";
			} else {
				$where = $where . " and a.nis = '$ref' ";
			}
		}
		
		if ($replid != "" && $replid != "0") {
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
		
		if ($kelamin != "") {
			if ($where == "") {
				$where = " where a.kelamin = '$kelamin' ";
			} else {
				$where = $where . " and a.kelamin = '$kelamin' ";
			}
		}
		
		if ($nama != "") {
			$nama = petikreplace($nama);
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
		
		if ($nik != "") {
			if ($where == "") {
				$where = " where a.nik = '$nik' ";
			} else {
				$where = $where . " and a.nik = '$nik' ";
			}
		}
		
		if ($idgugus != "") {
			if ($where == "") {
				$where = " where a.idgugus = '$idgugus' ";
			} else {
				$where = $where . " and a.idgugus = '$idgugus' ";
			}
		}
		
		if ($idangkatan != "") {
			if ($where == "") {
				$where = " where a.idangkatan = '$idangkatan' ";
			} else {
				$where = $where . " and a.idangkatan = '$idangkatan' ";
			}
		}
		
		if ($idangkatan1 != "") {
			if ($where == "") {
				$where = " where a.idangkatan1 = '$idangkatan1' ";
			} else {
				$where = $where . " and a.idangkatan1 = '$idangkatan1' ";
			}
		}
		
		if ($all == "1") {
			$where = " where ifnull(a.alumni,0)=2 ";
		}
		
		if($ref=='' && $replid=='' && $idtingkat=='' && $kelas=='' && $nama=='' && $all=='' && $departemen=='' && $nik=='' && $kelamin=='' && $idgugus=='' && $idangkatan=='' && $idangkatan1=='') {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nis, a.nik, a.nisn, a.idangkatan, a.idangkatan1, a.foto_file, a.nama, a.idkelas, a.idminat, a.kelamin, a.tmplahir, a.tgllahir, a.agama, a.warga, a.anakke, a.jsaudara, a.jtiri, a.jangkat, a.yatim, a.bahasa, a.alamatsiswa, a.alamatortu, a.telponsiswa, a.hpsiswa, a.telponortu, a.hportu, a.hpibu, a.jaraksekolah, a.kesekolah, a.berat, a.tinggi, a.kesehatan, a.darah, a.file_darah, a.kelainan, a.asalsekolah_id, a.tglijazah, a.noijazah, a.tglskhun, a.skhun, a.noujian, a.nisnasal, a.namaayah, a.namaibu, a.tmplahirayah, a.tgllahirayah, a.tmplahiribu, a.tgllahiribu, a.pekerjaanayah, a.pekerjaanibu, a.penghasilanayah, a.penghasilanibu, a.pendidikanayah, a.pendidikanibu, a.wnayah, a.wnibu, a.wali, a.tmplahirwali, a.tgllahirwali, a.pendidikanwali, a.pekerjaanwali, a.penghasilanwali, a.alamatwali, a.hpwali, a.hubungansiswa, a.pekerjaanayah_lain, a.pekerjaanibu_lain, a.pekerjaanwali_lain, a.uid, a.ts, a.file_jalurmasuk, b.idtingkat, b.kelas, c.tingkat, d.gugus, a.uid2, a.dlu2 from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid left join gugus d on a.idgugus=d.replid " . $where . " order by a.nis, a.nama, a.idkelas, a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data siswa baru
	function excel_siswa_baru($ref='', $replid='', $idtingkat='', $kelas='', $nama='', $all='', $departemen='', $nik='', $kelamin='', $idgugus='', $idangkatan='', $idangkatan1=''){
		$dbpdo = DB::create();
		
		$where = " where ifnull(a.alumni,0)=2 ";
		
		if($_SESSION["adm"] == 0) {
			if($_SESSION["tipe_user"] == "Siswa") {
				$replid = $_SESSION["idpegawai"];	
			}			
		}
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.nis = '$ref' ";
			} else {
				$where = $where . " and a.nis = '$ref' ";
			}
		}
		
		if ($replid != "" && $replid != "0") {
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
		
		if ($kelamin != "") {
			if ($where == "") {
				$where = " where a.kelamin = '$kelamin' ";
			} else {
				$where = $where . " and a.kelamin = '$kelamin' ";
			}
		}
		
		if ($nama != "") {
			$nama = petikreplace($nama);
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
		
		if ($nik != "") {
			if ($where == "") {
				$where = " where a.nik = '$nik' ";
			} else {
				$where = $where . " and a.nik = '$nik' ";
			}
		}
		
		if ($idgugus != "") {
			if ($where == "") {
				$where = " where a.idgugus = '$idgugus' ";
			} else {
				$where = $where . " and a.idgugus = '$idgugus' ";
			}
		}
		
		if ($idangkatan != "") {
			if ($where == "") {
				$where = " where a.idangkatan = '$idangkatan' ";
			} else {
				$where = $where . " and a.idangkatan = '$idangkatan' ";
			}
		}
		
		if ($idangkatan1 != "") {
			if ($where == "") {
				$where = " where a.idangkatan1 = '$idangkatan1' ";
			} else {
				$where = $where . " and a.idangkatan1 = '$idangkatan1' ";
			}
		}
		
		if ($all == "1") {
			$where = " where ifnull(a.alumni,0)=2 ";
		}
		
		if($ref=='' && $replid=='' && $idtingkat=='' && $kelas=='' && $nama=='' && $all=='' && $departemen=='' && $nik=='' && $kelamin=='' && $idgugus=='' && $idangkatan=='' && $idangkatan1=='') {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nis, a.nik, a.nisn, a.idangkatan, a.idangkatan1, a.foto_file, a.nama, a.idkelas, a.idminat, a.kelamin, a.tmplahir, a.tgllahir, a.agama, a.warga, a.anakke, a.jsaudara, a.jtiri, a.jangkat, a.yatim, a.bahasa, a.alamatsiswa, a.alamatortu, a.telponsiswa, a.hpsiswa, a.telponortu, a.hportu, a.hpibu, a.jaraksekolah, a.kesekolah, a.berat, a.tinggi, a.kesehatan, a.darah, a.file_darah, a.kelainan, a.asalsekolah_id, a.tglijazah, a.noijazah, a.tglskhun, a.skhun, a.noujian, a.nisnasal, a.namaayah, a.namaibu, a.tmplahirayah, a.tgllahirayah, a.tmplahiribu, a.tgllahiribu, a.pekerjaanayah, a.pekerjaanibu, a.penghasilanayah, a.penghasilanibu, a.pendidikanayah, a.pendidikanibu, a.wnayah, a.wnibu, a.wali, a.tmplahirwali, a.tgllahirwali, a.pendidikanwali, a.pekerjaanwali, a.penghasilanwali, a.alamatwali, a.hpwali, a.hubungansiswa, a.pekerjaanayah_lain, a.pekerjaanibu_lain, a.pekerjaanwali_lain, a.uid, a.ts, b.idtingkat, b.kelas, c.tingkat, d.gugus, a.uid2, a.dlu2 from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid left join gugus d on a.idgugus=d.replid " . $where . " order by a.idgugus, a.nama, a.idkelas, a.nis, a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data siswa krs approved view
	function list_siswa_krs_approved_view($nis='', $semester_id=''){
		$dbpdo = DB::create();
		
		$where = "";
		
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
		
		$sqlstr	= "select b.nama mapel, a.pelajaran_id, 0 sks, a.approved from siswa_krs a left join pelajaran b on a.pelajaran_id=b.replid  " . $where . " order by a.replid";	
		echo $sqlstr;	
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
		
		$sqlstr	=	"select a.sks, a.pelajaran_id from kartu_rencana_studi a where a.peminatan='$peminatan' and a.tingkat_id='$tingkat_id' and a.pelajaran_id='$pelajaran_id' and a.semester_id='$semester_id' "; 
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data siswa
	function list_data_siswa($ref='', $replid='', $idtingkat='', $kelas='', $nama='', $all='', $departemen='', $nik='', $kelamin='', $aktif=''){
		$dbpdo = DB::create();
		
		$where = " where ifnull(a.alumni,0)=0 ";
		
		if($_SESSION["adm"] == 0) {
			if($_SESSION["tipe_user"] == "Siswa") {
				$replid = $_SESSION["idpegawai"];	
			}			
		}
		
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
		
		if ($kelamin != "") {
			if ($where == "") {
				$where = " where a.kelamin = '$kelamin' ";
			} else {
				$where = $where . " and a.kelamin = '$kelamin' ";
			}
		}
		
		if ($nama != "") {
			$nama = petikreplace($nama);
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
		
		if ($nik != "") {
			if ($where == "") {
				$where = " where a.nik = '$nik' ";
			} else {
				$where = $where . " and a.nik = '$nik' ";
			}
		}
		
		if ($aktif != "") {
			if ($where == "") {
				$where = " where a.aktif = '$aktif' ";
			} else {
				$where = $where . " and a.aktif = '$aktif' ";
			}
		}
		
		
		if ($all == "1") {
			$where = " where ifnull(a.alumni,0)=0 ";
		}
		
		if($ref=='' && $replid=='' && $idtingkat=='' && $kelas=='' && $nama=='' && $all=='' && $departemen=='' && $nik=='' && $kelamin=='' && $aktif=='') {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nis, a.nisn, a.idangkatan, a.idangkatan1, a.foto_file, a.nama, a.idkelas, a.idminat, a.kelamin, a.tmplahir, a.tgllahir, a.agama, a.warga, a.anakke, a.jsaudara, a.jtiri, a.jangkat, a.yatim, a.bahasa, a.alamatsiswa, a.alamatortu, a.telponsiswa, a.hpsiswa, a.telponortu, a.hportu, a.hpibu, a.jaraksekolah, a.kesekolah, a.berat, a.tinggi, a.kesehatan, a.darah, a.file_darah, a.kelainan, a.asalsekolah_id, a.tglijazah, a.noijazah, a.tglskhun, a.skhun, a.noujian, a.nisnasal, a.namaayah, a.namaibu, a.tmplahirayah, a.tgllahirayah, a.tmplahiribu, a.tgllahiribu, a.pekerjaanayah, a.pekerjaanibu, a.penghasilanayah, a.penghasilanibu, a.pendidikanayah, a.pendidikanibu, a.wnayah, a.wnibu, a.wali, a.tmplahirwali, a.tgllahirwali, a.pendidikanwali, a.pekerjaanwali, a.penghasilanwali, a.alamatwali, a.hpwali, a.hubungansiswa, a.pekerjaanayah_lain, a.pekerjaanibu_lain, a.pekerjaanwali_lain, a.uid, a.ts, b.idtingkat, b.kelas, c.tingkat, a.uid2, a.dlu2 from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid " . $where . " order by a.nama, a.idkelas, a.nis, a.replid ";
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
	
	
	//---------get data kecamatan
	function list_kecamatan($id=''){	 
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($id != "") {
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
		
		if ($id != "") {
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
	
	
	//---------get data setup periode raport
	function list_setup_periode_raport($idtahunajaran='', $semester_id='', $tingkat_id=''){	 
		$dbpdo = DB::create();
			
		$where = " where a.idtahunajaran = '$idtahunajaran' and a.semester_id = '$semester_id' and a.tingkat_id = '$tingkat_id' ";
				
		$sqlstr="select a.replid, a.idtahunajaran, a.semester_id, a.tingkat_id, a.tanggal_ttd, a.aktif, a.uid, a.dlu from setup_periode_raport a " . $where . " order by a.replid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	//---------get data setup periode raport pts
	function list_setup_periode_raport_pts($idtahunajaran='', $semester_id='', $tingkat_id=''){	 
		$dbpdo = DB::create();
			
		$where = " where a.idtahunajaran = '$idtahunajaran' and a.semester_id = '$semester_id' and a.tingkat_id = '$tingkat_id' ";
				
		$sqlstr="select a.replid, a.idtahunajaran, a.semester_id, a.tingkat_id, a.tanggal_ttd, a.aktif, a.uid, a.dlu from setup_periode_raport_pts a " . $where . " order by a.replid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	//---------get data siswa absensi view
	function list_siswa_absensi_view($replid='', $idtingkat='', $idkelas2='', $semester_id='', $pelajaran_id='', $idtahunajaran=''){
		$dbpdo = DB::create();
		
		$where = " where a.approved=1 ";
		
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


	//---------get data siswa riwayat
	function list_siswa_riwayat($ref='', $replid='', $idtingkat='', $kelas='', $nama='', $all='', $departemen='', $nik='', $kelamin='', $aktif='', $alumni='', $idangkatan='', $idangkatan1=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($alumni == 1) {
			if ($where == "") {
				$where = " where ifnull(a.alumni,0)=1 ";
			} else {
				$where = $where . " and ifnull(a.alumni,0)=1 ";
			}
		} else {
			if ($where == "") {
				$where = " where ifnull(a.alumni,0)=0 ";
			} else {
				$where = $where . " and ifnull(a.alumni,0)=0 ";
			}
		}
		
		if($_SESSION["adm"] == 0) {
			if($_SESSION["tipe_user"] == "Siswa") {
				$replid = $_SESSION["idpegawai"];	
			}			
		}
		
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
				$where = " where d.idkelas = '$kelas' ";
			} else {
				$where = $where . " and d.idkelas = '$kelas' ";
			}
		}
		
		if ($kelamin != "") {
			if ($where == "") {
				$where = " where a.kelamin = '$kelamin' ";
			} else {
				$where = $where . " and a.kelamin = '$kelamin' ";
			}
		}
		
		if ($nama != "") {
			$nama = petikreplace($nama);
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
		
		if ($nik != "") {
			if ($where == "") {
				$where = " where a.nik = '$nik' ";
			} else {
				$where = $where . " and a.nik = '$nik' ";
			}
		}
		
		if($idangkatan != "") {
			if ($where == "") {
				$where = " where a.idangkatan = '$idangkatan' ";
			} else {
				$where = $where . " and a.idangkatan = '$idangkatan' ";
			}
		}
		
		if($idangkatan1 != "") {
			if ($where == "") {
				$where = " where a.idangkatan1 = '$idangkatan1' ";
			} else {
				$where = $where . " and a.idangkatan1 = '$idangkatan1' ";
			}
		}
		
		if ($aktif != "") {
			if($alumni == 1) {
				if ($where == "") {
					$where = " where d.aktif = 0 ";
				} else {
					$where = $where . " and d.aktif = 0 ";
				}	
			} else {
				if ($where == "") {
					$where = " where d.aktif = 0 ";
				} else {
					$where = $where . " and d.aktif = 0 ";
				}
			}
		}
		
		
		if ($all == "1") {
			$where = " where ifnull(a.alumni,0)=0 ";
		}
		
		if($ref=='' && $replid=='' && $idtingkat=='' && $kelas=='' && $nama=='' && $all=='' && $departemen=='' && $nik=='' && $kelamin=='' && $aktif=='1' && $alumni=='' && $idangkatan=='' && $idangkatan1=='') {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nis, a.nik, a.nisn, a.idangkatan, a.idangkatan1, a.foto_file, a.nama, a.idkelas, a.idminat, a.kelamin, a.tmplahir, a.tgllahir, a.agama, a.warga, a.anakke, a.jsaudara, a.jtiri, a.jangkat, a.yatim, a.bahasa, a.alamatsiswa, a.alamatortu, a.telponsiswa, a.hpsiswa, a.telponortu, a.hportu, a.hpibu, a.jaraksekolah, a.kesekolah, a.berat, a.tinggi, a.kesehatan, a.darah, a.file_darah, a.kelainan, a.asalsekolah_id, a.tglijazah, a.noijazah, a.tglskhun, a.skhun, a.noujian, a.nisnasal, a.namaayah, a.namaibu, a.tmplahirayah, a.tgllahirayah, a.tmplahiribu, a.tgllahiribu, a.pekerjaanayah, a.pekerjaanibu, a.penghasilanayah, a.penghasilanibu, a.pendidikanayah, a.pendidikanibu, a.wnayah, a.wnibu, a.wali, a.tmplahirwali, a.tgllahirwali, a.pendidikanwali, a.pekerjaanwali, a.penghasilanwali, a.alamatwali, a.hpwali, a.hubungansiswa, a.pekerjaanayah_lain, a.pekerjaanibu_lain, a.pekerjaanwali_lain, a.jalurmasuk, a.uid, a.ts, b.idtingkat, b.kelas, c.tingkat, a.uid2, a.dlu2 from riwayatkelassiswa d left join siswa a on d.nis=a.nis left join kelas b on d.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid " . $where . " order by a.nama, a.idkelas, a.nis, a.replid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}


	//---------get data daftarnilai pts
	function list_daftarnilai_raport_pts($departemen='', $idtingkat='', $idkelas='', $idsemester='', $nis='', $sifat='', $peminatan='', $idtahunajaran='', $nis_siswa='', $iddasarpenilaian=''){
		
		$dbpdo = DB::create();
		
		/*if($idtahunajaran != "") {
			if( (substr($nis_siswa,0,4)== '1819' || substr($nis_siswa,0,4)== '1718') ) {
				$sqlstr2 = "select distinct a.nis from daftarnilai_pts a left join pelajaran b on a.idpelajaran=b.replid left join predikat_raport c on a.idpelajaran=c.idpelajaran left join kartu_rencana_studi d on a.idtingkat=d.tingkat_id and a.idpelajaran=d.pelajaran_id and a.idsemester=d.semester_id inner join siswa e on a.nis=e.replid where a.departemen='$departemen' and a.idsemester='$idsemester' and a.nis='$nis' and (a.iddasarpenilaian=3) and b.sifat='$sifat' and d.peminatan='$peminatan' and (b.minat='$peminatan' or ifnull(b.minat,'')='' ) " . " and d.idtahunajaran='$idtahunajaran' " . $where." order by d.urutan, a.nis";
				$sql2=$dbpdo->prepare($sqlstr2);
				$sql2->execute();
				$rows = $sql2->rowCount();
				if($rows > 0) {
					$where2 = " and d.idtahunajaran='$idtahunajaran' ";	
				}
			} else {
				$where2 = " and d.idtahunajaran='$idtahunajaran' ";
			}
		}*/
		
		//$where = " and a.idkelas='$idkelas' and d.idtahunajaran='$idtahunajaran'";
		/*if($idkelas != "") {
			$where = " and a.idkelas='$idkelas' and ( (select replid from daftarnilai_pts_detail limit 1) > 0) ";
		}*/
		//ifnull(a.jumlah,0)> 0 or 
		
		/*$sqlstr = "select distinct a.idpelajaran pelajaran_id, a.nis idsiswa, a.idtingkat, a.idkelas, a.idsemester semester_id, a.hadir, a.line, case when ifnull(d.pelajaran_kode,'')<>'' then d.pelajaran_kode else b.kode end kode_pelajaran, b.nama nama_pelajaran, (case when ifnull(d.sks,0)=0 then b.info1 else d.sks end) sks, (case when ifnull(c.kkm,0)=0 then b.info2 else c.kkm end) kkm, (case when ifnull(c.kkm_terampil,0)=0 then b.token else c.kkm_terampil end) kkm_terampil, b.alias, b.idpelajaran_alias from daftarnilai_pts a left join pelajaran b on a.idpelajaran=b.replid left join predikat_raport c on a.idpelajaran=c.idpelajaran left join kartu_rencana_studi d on a.idtingkat=d.tingkat_id and a.idpelajaran=d.pelajaran_id and a.idsemester=d.semester_id inner join siswa e on a.nis=e.replid where a.departemen='$departemen' and a.idsemester='$idsemester' and a.nis='$nis' and (a.iddasarpenilaian=3) and b.sifat='$sifat' and d.peminatan='$peminatan' and (b.minat='$peminatan' or ifnull(b.minat,'')='' ) " . $where2 . $where." order by d.urutan, a.nis";
		echo $sqlstr.'<br><br>';*/
		
		$where = " and c.idkelas='$idkelas' and c.idtahunajaran='$idtahunajaran'";
		
		$sqlstr = "select distinct a.pelajaran_id, c.nis idsiswa, c.idtingkat, a.semester_id, b.kode kode_pelajaran, b.nama nama_pelajaran, a.sks, b.alias, b.idpelajaran_alias, (select a.hadir from daftarnilai_pts a where a.tingkat_id=c.idtingkat and a.pelajaran_id=c.idpelajaran and a.semester_id=c.idsemester and a.nis=c.nis and a.idpelajaran=c.idpelajaran and a.idtahunajaran=c.idtahunajaran and a.idkelas=c.idkelas order by a.hadir desc limit 1) hadir from kartu_rencana_studi a left join pelajaran b on a.pelajaran_id=b.replid left join daftarnilai_pts c on a.tingkat_id=c.idtingkat and a.pelajaran_id=c.idpelajaran and a.semester_id=c.idsemester left join siswa d on c.nis=d.replid where c.departemen='$departemen' and a.semester_id='$idsemester' and c.nis='$nis' and b.sifat='$sifat' and a.peminatan='$peminatan' and (b.minat='$peminatan' or ifnull(b.minat,'')='' ) " . $where." order by a.urutan, c.nis";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data nilai pts
	function list_daftarnilai_pts2($nis='', $idtingkat='', $idkelas='', $idtahunajaran='', $idsemester='', $idpelajaran='', $iddasarpenilaian='', $nis_siswa=''){	 
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
		
		if ( $idtahunajaran != "") {
			if( (substr($nis_siswa,0,4)== '1819' || substr($nis_siswa,0,4)== '1718') ) {
				$sqlstr2= "select a.replid from daftarnilai_pts a where a.nis = '$nis' and a.idtingkat = '$idtingkat' and a.idkelas = '$idkelas' and a.idsemester = '$idsemester' and a.idpelajaran = '$idpelajaran' and a.iddasarpenilaian = '$iddasarpenilaian' and a.idtahunajaran = '$idtahunajaran' order by a.replid";
				$sql2=$dbpdo->prepare($sqlstr2);
				$sql2->execute();
				$rows = $sql2->rowCount();
				if($rows > 0) {
					if ($where == "") {
						$where = " where a.idtahunajaran = '$idtahunajaran' ";
					} else {
						$where = $where . " and a.idtahunajaran = '$idtahunajaran' ";
					}
				}
			} else {
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
		
		
		$sqlstr="select a.replid, a.departemen, a.idtingkat, a.idkelas, a.idtahunajaran, a.idsemester, a.nis, a.idkompetensi, a.idjeniskompetensi, a.iddasarpenilaian, a.idpelajaran, a.hadir, a.line from daftarnilai_pts a " . $where . " order by a.replid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data list_daftarnilai pts detail
	function list_daftarnilai_pts_detail($id=''){	 
		$dbpdo = DB::create();
			
		$sqlstr="select a.replid, case when ifnull(a.nilai,'')=0 then '' else ifnull(a.nilai,'') end nilai, a.line from daftarnilai_pts_detail a where a.replid = '$id' order by a.line";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data daftarnilai lintas minat pts
	function list_daftarnilai_raport_lintas_minat_pts($departemen='', $idtingkat='', $idkelas='', $idsemester='', $nis='', $sifat='', $peminatan='', $idtahunajaran='', $nis_siswa=''){
		
		$dbpdo = DB::create();
		
		//$where = "";
		
		$where = " and c.idkelas='$idkelas' and c.idtahunajaran='$idtahunajaran'";
		
		$sqlstr = "select distinct a.pelajaran_id, c.nis idsiswa, c.idtingkat, a.semester_id, b.kode kode_pelajaran, b.nama nama_pelajaran, b.alias, b.idpelajaran_alias, c.hadir from kartu_rencana_studi a left join pelajaran b on a.pelajaran_id=b.replid left join daftarnilai_pts c on a.tingkat_id=c.idtingkat and a.pelajaran_id=c.idpelajaran and a.semester_id=c.idsemester left join siswa d on c.nis=d.replid where c.departemen='$departemen' and a.semester_id='$idsemester' and c.nis='$nis' and b.sifat='$sifat' and a.peminatan='$peminatan' and (b.minat='$peminatan' or ifnull(b.minat,'')='' ) " . $where." order by a.urutan, c.nis";
		
		/*if($idtahunajaran != "") {
			if( (substr($nis_siswa,0,4)== '1819' || substr($nis_siswa,0,4)== '1718') ) {
				$sqlstr2 = "select distinct a.nis from daftarnilai_pts a left join pelajaran b on a.idpelajaran=b.replid left join predikat_raport c on a.idpelajaran=c.idpelajaran left join kartu_rencana_studi d on a.idtingkat=d.tingkat_id and a.idpelajaran=d.pelajaran_id and a.idsemester=d.semester_id left join siswa e on a.nis=e.replid and a.idkelas=e.idkelas where a.departemen='SMA' and a.idsemester='$idsemester' and a.nis='$nis' and (a.iddasarpenilaian=3) and (b.sifat='$sifat') and d.peminatan='MIPA' and d.idtahunajaran='$idtahunajaran' and a.idtingkat='$idtingkat' order by d.urutan, a.nis";
				$sql2=$dbpdo->prepare($sqlstr2);
				$sql2->execute();
				$rows = $sql2->rowCount();
				if($rows > 0) {
					if($where == '') {
						$where  = " where d.idtahunajaran='$idtahunajaran' ";	
					} else {
						$where  = $where . " and d.idtahunajaran='$idtahunajaran' ";
					}
				}
			} else {
				if($where == '') {
					$where  = " where d.idtahunajaran='$idtahunajaran' ";	
				} else {
					$where  = $where . " and d.idtahunajaran='$idtahunajaran' ";
				}	
			}			
		}
		
		$where = " where a.departemen='$departemen' and a.idsemester='$idsemester' and a.nis='$nis' and (a.iddasarpenilaian=3) and (b.sifat='$sifat') and d.peminatan='$peminatan' ";
		
		if($idtingkat != "") {
			if($where == '') {
				$where  = " where a.idtingkat='$idtingkat' ";	
			} else {
				$where  = $where . " and a.idtingkat='$idtingkat' ";
			}
		}	
		
		
		$sqlstr = "select distinct a.idpelajaran pelajaran_id, a.nis idsiswa, a.idtingkat, a.idkelas, a.idsemester semester_id, a.hadir, a.line, case when ifnull(d.pelajaran_kode,'')<>'' then d.pelajaran_kode else b.kode end kode_pelajaran, b.nama nama_pelajaran, (case when ifnull(d.sks,0)=0 then b.info1 else d.sks end) sks, (case when ifnull(c.kkm,0)=0 then b.info2 else c.kkm end) kkm, (case when ifnull(c.kkm_terampil,0)=0 then b.token else c.kkm_terampil end) kkm_terampil, b.alias, b.idpelajaran_alias from daftarnilai_pts a left join pelajaran b on a.idpelajaran=b.replid left join predikat_raport c on a.idpelajaran=c.idpelajaran left join kartu_rencana_studi d on a.idtingkat=d.tingkat_id and a.idpelajaran=d.pelajaran_id and a.idsemester=d.semester_id left join siswa e on a.nis=e.replid and a.idkelas=e.idkelas " . $where .  " order by d.urutan, a.nis";*/
		// or b.minat<>'$peminatan'
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		return $sql;
	}
	

	//---------get data Receipt
	function list_receipt($kode ='', $all=0, $act=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		$sqlstr="select a.ref, a.date, a.status, a.client_code, a.receipt_type, a.cheque_no, a.cheque_date, a.bank_name, a.credit_card_no, a.credit_card_code, a.credit_card_holder, a.credit_card_expired, a.account_code, a.currency_code, a.rate, a.amount, a.deposit, a.sub_total, a.type, a.memo, a.round_amount, a.round_amount_account, a.bank_charge, a.bank_charge_account, a.opening_balance, a.total, a.uid, a.dlu, b.nama contact_name, b.alamatsiswa address, b.hpsiswa phone from receipt a left join siswa b on a.client_code=b.replid " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		return $sql;
	}
	
	
	//----------list_direct_receipt_detail
	function list_receipt_detail($id='', $posisi=0, $batas=0) {
		$dbpdo = DB::create();
		
		if($batas > 0) {
			$limit = " limit $posisi, $batas";
		}
				
		$sqlstr="select a.ref, a.invoice_no, a.invoice_date, a.invoice_due_date, a.invoice_currency_code, a.invoice_rate, a.amount_due, a.discount, a.amount_paid, a.ref_type invoice_type, a.amount, a.line, b.description from receipt_detail a left join ar b on a.invoice_no=b.ref where a.ref='$id' order by a.line " . $limit ;
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}


	//---------get data purchase invoice last unit cost
	function list_purchase_invoice_last_cost($item_code='', $uom_code=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $item_code != "") {
			if ($where == "") {
				$where = " where a.item_code = '$item_code' ";
			} else {
				$where = $where . " and a.item_code = '$item_code' ";
			}								
		}
		
		if ( $uom_code != "") {
			if ($where == "") {
				$where = " where a.uom_code = '$uom_code' ";
			} else {
				$where = $where . " and a.uom_code = '$uom_code' ";
			}								
		}
		
		$sqlstr="select a.ref, b.date, a.item_code, a.uom_code, a.qty, ifnull(a.unit_cost,0) unit_cost, a.amount, a.line_item_po, a.line, b.dlu from purchase_invoice_detail a left join purchase_invoice b on a.ref=b.ref " . $where . " order by b.dlu desc, a.line desc limit 1 ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();			
		$data = $sql->fetch(PDO::FETCH_OBJ);
		$current_cost = $data->unit_cost;
		
		if($current_cost == 0) {
			$sqlstr = "select ifnull(a.current_cost,0) current_cost from set_item_cost a " . $where . " order by a.date_of_record desc limit 1";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$current_cost = $data->current_cost;
		}
		
		
		return $current_cost;
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
		
		$sqlstr="select a.ref, a.invoice_no, a.date, a.status, a.bill_number, a.vendor_code, a.payment_type, b.name vendor_name, a.top, a.due_date, a.tax_code, a.tax_rate, a.freight_cost, a.freight_account, a.memo, a.discount, a.total, a.location_id, a.cash, a.cash_amount, a.change_amount, a.bank_id, a.bank_amount, a.credit_card_code, a.card_amount, a.credit_card_no, a.credit_card_holder, a.uid, a.dlu, (select sum(aa.amount) from purchase_invoice_detail aa group by aa.ref having aa.ref=a.ref) amount from purchase_invoice a left join vendor b on a.vendor_code=b.syscode " . $where . " order by a.ref";
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


	//-----------purchase invoice detail (saat update)
	function get_purchase_invoice_detail_outstanding($id='', $item_group_id='') {
		$dbpdo = DB::create();
		
		$where = " where ifnull(a.qty,0)-ifnull(a.qty_good,0) > 0";
		
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
		
		$sqlstr="select a.ref, a.po_ref, a.item_code, a.uom_code, a.size, a.qty, ifnull(a.qty,0)-ifnull(a.qty_good,0) qty_po, a.unit_cost, a.discount1, a.discount2, a.discount3, a.discount, a.amount, a.line_item_po, a.line, b.code, b.name item_name from purchase_invoice_detail a left join item b on a.item_code=b.syscode ".$where." order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}


	//-----------pch ivi detail (item group)
	function list_purchase_invoice_detail_itemgroup($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select distinct b.item_group_id, c.name item_group from purchase_invoice_detail a left join item b on a.item_code=b.syscode left join item_group c on b.item_group_id=c.id where a.ref='$id' order by c.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}			
	
	//-----------pch ivi detail (item group)
	function list_good_receipt_detail_itemgroup($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select distinct b.item_group_id, c.name item_group from good_receipt_detail a left join item b on a.item_code=b.syscode left join item_group c on b.item_group_id=c.id where a.ref='$id' order by c.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}


	//---------get data Payment
	function list_payment($kode ='', $all=0, $act=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		$sqlstr="select a.ref, a.date, a.status, a.vendor_code, a.payment_type, a.cheque_no, a.cheque_date, a.bank_name, a.credit_card_no, a.credit_card_code, a.credit_card_holder, a.credit_card_expired, a.account_code, a.currency_code, a.rate, a.amount, a.deposit, a.sub_total, a.type, a.memo, a.round_amount, a.round_amount_account, a.bank_charge, a.bank_charge_account, a.opening_balance, a.total, a.no_ttfa, a.uid, a.dlu, b.name contact_name, b.address, b.phone from payment a left join vendor b on a.vendor_code=b.syscode " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		return $sql;
	}
	
	
	//----------list_payment_detail
	function list_payment_detail($id='', $posisi=0, $batas=0) {
		$dbpdo = DB::create();
		
		if($batas > 0) {
			$limit = " limit $posisi, $batas";
		}
				
		$sqlstr="select a.ref, a.invoice_no, b.invoice_no no_nota, a.invoice_date, a.invoice_due_date, a.invoice_currency_code, a.invoice_rate, a.amount_due, a.discount, a.amount_paid, a.ref_type invoice_type, a.amount, a.line from payment_detail a left join purchase_invoice b on a.invoice_no=b.ref where a.ref='$id' order by a.line " . $limit ;
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	

	//---------get data tahunajaran tahun sebelumnya
	function get_tahunajaran_sebelumnya($replid=''){
		$dbpdo = DB::create();
		
		$where = " where a.aktif=1 ";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid <> '$replid' ";
			} else {
				$where = $where . " and a.replid <> '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.tahunajaran, a.departemen, a.tglmulai, a.tglakhir, a.aktif, a.info1, a.info3 ttd_file, a.keterangan, a.ts, b.nama nama_kepsek from tahunajaran a left join pegawai b on a.info1=b.nip " . $where . " order by a.replid desc limit 1 ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		return $sql;
	}


	//---------get data kelas tahun sebelumnya
	function get_kelas_sebelumnya($replid=''){
		$dbpdo = DB::create();
		
		$where = " where a.aktif=0 ";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.nis = '$replid' ";
			} else {
				$where = $where . " and a.nis = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.idkelas, b.idtingkat from riwayatkelassiswa a left join kelas b on a.idkelas=b.replid ".$where." order by a.replid desc limit 1 ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}


	//---------get data KRS
	function get_krs($kelompok_pelajaran_id='', $tingkat_id='', $semester_id='', $peminatan='', $idtahunajaran='', $idminat='', $pelajaran_id=''){
		$dbpdo = DB::create();
		
		$where = " where a.peminatan = '$peminatan' and a.tingkat_id = '$tingkat_id' and a.semester_id = '$semester_id' and a.idtahunajaran = '$idtahunajaran' and a.pelajaran_id = '$pelajaran_id' ";
		
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


	//---------get data daftarnilai
	function get_daftarnilai_raport($departemen='', $idtingkat='', $idkelas='', $idsemester='', $nis='', $sifat='', $peminatan='', $idtahunajaran='', $nis_siswa=''){
		
		$dbpdo = DB::create();
		
		if($idtahunajaran != "") {
			if( (substr($nis_siswa,0,4)== '1819' || substr($nis_siswa,0,4)== '1718') ) {
				$sqlstr2 = "select distinct a.nis from daftarnilai a left join pelajaran b on a.idpelajaran=b.replid left join predikat_raport c on a.idpelajaran=c.idpelajaran left join kartu_rencana_studi d on a.idtingkat=d.tingkat_id and a.idpelajaran=d.pelajaran_id and a.idsemester=d.semester_id inner join siswa e on a.nis=e.replid where a.departemen='$departemen' and a.idsemester='$idsemester' and a.nis='$nis' and (a.iddasarpenilaian=3) and d.peminatan='$peminatan' and (b.minat='$peminatan' or ifnull(b.minat,'')='' ) " . " and d.idtahunajaran='$idtahunajaran' " . $where." order by d.urutan, a.nis";
				$sql2=$dbpdo->prepare($sqlstr2);
				$sql2->execute();
				$rows = $sql2->rowCount();
				if($rows > 0) {
					$where2 = " and a.idtahunajaran='$idtahunajaran' ";	
				}
			} else {
				$where2 = " and a.idtahunajaran='$idtahunajaran' ";
			}
		}
		
		$where = " where ifnull(a.jumlah,0)> 0 ";
		if($idkelas != "") {
			$where = " and a.idkelas='$idkelas' and ( (select replid from daftarnilai_detail where ifnull(nilai,0)>0 and replid=a.replid limit 1) > 0) ";
		}
		//ifnull(a.jumlah,0)> 0 or 

		$sqlstr = "select distinct a.idpelajaran pelajaran_id, a.nis idsiswa, a.idtingkat, a.idkelas, a.idsemester semester_id, a.sikap, a.line, case when ifnull(d.pelajaran_kode,'')<>'' then d.pelajaran_kode else b.kode end kode_pelajaran, b.nama nama_pelajaran, (case when ifnull(d.sks,0)=0 then b.info1 else d.sks end) sks, (case when ifnull(c.kkm,0)=0 then b.info2 else c.kkm end) kkm, (case when ifnull(c.kkm_terampil,0)=0 then b.token else c.kkm_terampil end) kkm_terampil, b.alias, b.idpelajaran_alias, d.kode1, d.kode2 from kartu_rencana_studi d left join daftarnilai a on a.idtingkat=d.tingkat_id and a.idpelajaran=d.pelajaran_id and a.idsemester=d.semester_id and a.idtahunajaran=d.idtahunajaran left join pelajaran b on a.idpelajaran=b.replid left join predikat_raport c on a.idpelajaran=c.idpelajaran inner join siswa e on a.nis=e.replid where a.departemen='$departemen' and a.idsemester='$idsemester' and a.nis='$nis' and (a.iddasarpenilaian=3) and d.peminatan='$peminatan' and (b.minat='$peminatan' or ifnull(b.minat,'')='' ) " . $where2 . $where." order by d.urutan, a.nis";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}


	//----------Report AR Outstanding
	function rpt_ar_outstanding($date_from = '', $date_to = '', $contact_code = '', $all = 0, $so_no='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $date_from != "") {
			
			$date_from = date("Y-m-d", strtotime($date_from));
			
			if ($where == "") {
				$where = " where a.date >= '$date_from' ";
			} else {
				$where = $where . " and a.date >= '$date_from' ";
			}								
		}
		
		if ( $date_to != "") {
			
			$date_to = date("Y-m-d", strtotime($date_to));
			
			if ($where == "") {
				$where = " where a.date <= '$date_to' ";
			} else {
				$where = $where . " and a.date <= '$date_to' ";
			}								
		}
		
		if ( $contact_code != "") {
			
			if ($where == "") {
				$where = " where a.contact_code = '$contact_code' ";
			} else {
				$where = $where . " and a.contact_code = '$contact_code' ";
			}								
		}
		
		if ( $so_no != "") {
			
			if ($where == "") {
				$where = " where b.ref2 = '$so_no' ";
			} else {
				$where = $where . " and b.ref2 = '$so_no' ";
			}								
		}
		
		
		if($date_from == "" && $date_to == "" && $contact_code == "" && $all == "" && $so_no == "") {
			$where = " where c.ref = 'ndf' ";
		}
		
		if($all != 0) {
			$where = "";
		}
		
		//sum(a.debit_amount) - sum(a.credit_amount) <> 0 and
		$sqlstr="select aa.* from (select a.invoice_no, a.date, a.due_date, b.nama client_name, a.contact_code, sum(a.debit_amount) debit_amount, sum(a.credit_amount) credit_amount, sum(a.debit_amount) - sum(a.credit_amount) amount from ar a left join siswa b on a.contact_code=b.replid " . $where . " group by a.contact_code, a.invoice_no having ifnull(b.nama,'') <> '') aa " . $where2 . " order by aa.date, aa.client_name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	


		
}
?>