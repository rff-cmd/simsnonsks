<?php

class select_view{	

	//---------get data registrasi
	function list_registrasi($ref='', $replid='', $tahunmasuk='', $idtingkat='', $tanggal='', $idjurusan='', $nama='', $all ){
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
		
		if ($all != "") {
			$where = "";
		}
		
		if($ref=='' && $replid=='' && $tahunmasuk=='' && $idtingkat=='' && $tanggal=='' && $idjurusan=='' && $nama=='' && $all=='') {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	=	"select a.replid, a.idproses, a.idkelompok, a.tanggal, a.nopendaftaran, a.idtingkat, a.idjurusan, a.idminat, a.idminat1, a.foto_file, a.nama, a.panggilan, a.kelamin, a.nisn, a.nis, a.noijazah, a.tahunijazah, a.skhun, a.tahunskhun, a.noujian, a.nik, a.tmplahir, a.tgllahir, a.agama, a.kebutuhan_khusus, a.tahunmasuk, a.alamatsiswa, a.dusun, a.rt, a.rw, a.kelurahan, a.kodepossiswa, a.kecamatan, a.kabupaten, a.provinsi, a.transportasi, a.transportasi_kode, a.citacita, a.citacita_lain, a.idjenis_tinggal, a.jenis_tinggal, a.telponsiswa, a.hpsiswa, a.emailsiswa, a.kps, a.nokps, a.nokip, a.nokks, a.namaayah, a.tahunayah, a.alamatortu, a.kodeposortu, a.hportu, a.butuhkhususayah, a.butuhkhususketayah, a.pekerjaanayah, a.pekerjaanayah_lain, a.pendidikanayah, a.penghasilanayah, a.penghasilanayah_kode, a.namaibu, a.tahunibu, a.butuhkhususibu, a.butuhkhususketibu, a.pekerjaanibu, a.pekerjaanibu_lain, a.pendidikanibu, a.penghasilanibu, a.penghasilanibu_kode, a.wali, a.tahunwali, a.pekerjaanwali, a.pekerjaanwali_lain, a.pendidikanwali, a.penghasilanwali, a.tinggi, a.berat, a.jaraksekolah, a.jarak_km, a.waktutempuh, a.waktutempuh_menit, a.jsaudara, a.uid, a.dlu, b.tingkat, c.kelas jurusan, a.darah, a.file_darah, a.almayah, a.almibu, a.alamatibu, a.kodeposibu, a.hpibu from calonsiswa a left join tingkat b on a.idtingkat=b.replid left join kelas c on a.idjurusan=c.replid " . $where . " order by a.replid ";
		
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
	function list_siswa($ref='', $replid='', $idtingkat='', $kelas='', $nama='', $all, $departemen=''){
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
	function list_siswabesarjtt($ref='', $replid='', $idtingkat, $kelas, $nama, $all, $idkategori, $idpenerimaan, $idangkatan, $departemen=''){
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
		
		if ($idpenerimaan == "") {
			$where = " where a.replid = '0' ";
		}
		
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
	function list_kembali($replid='', $idanggota='', $tglpinjam='', $tglkembali='', $all){
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
	function list_pinjam_telat($replid='', $idanggota='', $tglpinjam='', $tglkembali='', $all){
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
	function list_kenaikan($idangkatan='', $idtingkat='', $idkelas='', $nis='', $nama='', $all){
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
	function list_pindah_kelas($idangkatan='', $idtingkat='', $idkelas='', $nis='', $nama='', $all){
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
		
		$sqlstr	=	"select a.replid, a.nip, a.nama, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";	
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
	function list_siswa_ekstrakurikuler($unit='', $nis='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
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
			$where = "";
		}
		
		if($bagian=='' && $nip=='' && $nama=='' && $all=='') {
			$where = " where a.replid=0 ";
		}
		
		$sqlstr	=	"select a.replid, a.nis, a.nama, b.kelas, c.tingkat, c.departemen from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	
	//---------get pinjam
	function list_pinjam($replid='', $idanggota='', $tglpinjam='', $tglkembali='', $all){
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
	function list_kelulusan($idangkatan='', $idtingkat='', $idkelas='', $nis='', $nama='', $all){
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
				$where = " where b.tahunmasuk = '$tahunmasuk' ";
			} else {
				$where = $where . " and b.tahunmasuk = '$tahunmasuk' ";
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
		
		$sqlstr	=	"select a.replid, a.nis, a.klsakhir, a.tktakhir, a.tgllulus, a.keterangan, a.departemen, a.ts, b.nisn, b.nama, b.kelamin, b.tahunmasuk, c.kelas, d.tingkat, e.angkatan from alumni a left join siswa b on a.nis=b.nis and b.alumni=1 left join kelas c on a.klsakhir=c.replid left join tingkat d on a.tktakhir=d.replid left join angkatan e on b.idangkatan1=e.replid " . $where . " order by a.replid ";
		
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
	
		
}
?>