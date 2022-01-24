<?php

class select_print{	
	
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
		
		$sqlstr	=	"select a.replid, a.idproses, a.idkelompok, a.tanggal, a.nopendaftaran, a.idtingkat, a.idjurusan, a.idminat, a.idminat1, a.foto_file, a.nama, a.panggilan, a.kelamin, a.nisn, a.nis, a.noijazah, a.tahunijazah, a.skhun, a.tahunskhun, a.noujian, a.nik, a.tmplahir, a.tgllahir, a.agama, a.kebutuhan_khusus, a.tahunmasuk, a.alamatsiswa, a.dusun, a.rt, a.rw, a.kelurahan, a.kodepossiswa, a.kecamatan, a.kabupaten, a.provinsi, a.transportasi, a.transportasi_kode, a.citacita, a.citacita_lain, a.idjenis_tinggal, a.jenis_tinggal, a.telponsiswa, a.hpsiswa, a.emailsiswa, a.kps, a.nokps, a.nokip, a.nokks, a.namaayah, a.tahunayah, a.alamatortu, a.kodeposortu, a.hportu, a.butuhkhususayah, a.butuhkhususketayah, a.pekerjaanayah, a.pekerjaanayah_lain, a.pendidikanayah, a.penghasilanayah, a.penghasilanayah_kode, a.namaibu, a.tahunibu, a.butuhkhususibu, a.butuhkhususketibu, a.pekerjaanibu, a.pekerjaanibu_lain, a.pendidikanibu, a.penghasilanibu, a.penghasilanibu_kode, a.wali, a.tahunwali, a.pekerjaanwali, a.pekerjaanwali_lain, a.pendidikanwali, a.penghasilanwali, a.tinggi, a.berat, a.jaraksekolah, a.jarak_km, a.waktutempuh, a.waktutempuh_menit, a.jsaudara, a.uid, a.dlu, b.tingkat, c.kelas jurusan, a.darah, a.file_darah, a.almayah, a.almibu, a.alamatibu, a.kodeposibu, a.hpibu, a.idminat, a.idminat1 from calonsiswa a left join tingkat b on a.idtingkat=b.replid left join kelas c on a.idjurusan=c.replid " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data registrasi raport
	function list_registrasi_raport($idcalonsiswa=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idcalonsiswa != "") {
			if ($where == "") {
				$where = " where a.idcalonsiswa = '$idcalonsiswa' ";
			} else {
				$where = $where . " and a.idcalonsiswa = '$idcalonsiswa' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idcalonsiswa, a.idpelajaran_raport, a.nsemester3, a.nsemester4, a.nsemester5, a.nskhun, a.line from calonsiswa_raport a " . $where . " order by a.line ";	
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
	
	//---------get data pekerjaan
	function list_pekerjaan($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		/*if ($replid != "0") {
			if ($where == "") { */
				$where = " where a.replid = '$replid' ";
			/*} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}*/
		
		$sqlstr	=	"select a.replid, a.pekerjaan from jenispekerjaan a " . $where . " order by a.replid ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data pendidikan
	function list_pendidikan($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		/*if ($replid != "0") {
			if ($where == "") { */
				$where = " where a.replid = '$replid' ";
			/*} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}*/
		
		$sqlstr	=	"select a.replid, a.pendidikan from tingkatpendidikan a " . $where . " order by a.replid ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data nilai raport
	function list_nilairaport($replid=''){
		$dbpdo = DB::create();
		
		$where = " where a.id = '$replid' ";
		
		$sqlstr	=	"select a.id, a.nama from pelajaran_raport a " . $where . " order by a.id ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data minatips
	function list_minatips($replid=''){
		$dbpdo = DB::create();
		
		$where = " where a.cde = '$replid' ";
		
		$sqlstr="select a.cde, a.dcr from 
			(select 'A' cde, 'B. Inggris' dcr, 0 nmr union all 
			select 'B' cde, 'B. Jepang' dcr, 1 nmr union all 
			select 'C' cde, 'Ekonomi' dcr, 2 nmr union all 
			select 'D' cde, 'Sosioliogi' dcr, 3 nmr union all 
			select 'E' cde, 'Geografi' dcr, 4 nmr) a " . $where . " order by nmr";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data minatipa
	function list_minatipa($replid=''){
		$dbpdo = DB::create();
		
		$where = " where a.cde = '$replid' ";
		
		$sqlstr="select a.cde, a.dcr from 
			(select 'A' cde, 'B. Inggris' dcr, 0 nmr union all 
			select 'B' cde, 'B. Jepang' dcr, 1 nmr union all 
			select 'C' cde, 'Biologi' dcr, 2 nmr union all 
			select 'D' cde, 'Fisika' dcr, 3 nmr union all 
			select 'E' cde, 'Kimia' dcr, 4 nmr) a " . $where . " order by nmr";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
		
	//---------get data penerimaan pembayaran
	function list_rpt_penerimaan($daritgl='', $ketgl='', $idtingkat='', $kelas='', $nama='', $all='', $departemen=''){
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
		
		if($daritgl=='' && $ketgl=='' && $idtingkat=='' && $kelas=='' && $nama=='' &&  $all=='' && $departemen=='') {
			$where = " where a.replid = 0 ";
		}
		
		$sqlstr	=	"select a.replid, a.jumlah, ifnull(b.potongan,0) potongan, a.keterangan, c.nis, c.nama, d.kelas, e.tingkat, f.nama namapenerimaan, b.besar from penerimaanjtt a left join besarjtt b on a.idbesarjtt=b.replid left join siswa c on b.nis=c.nis left join kelas d on c.idkelas=d.replid left join tingkat e on d.idtingkat=e.replid left join datapenerimaan f on b.idpenerimaan=f.replid " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data penerimaan jenis
	function list_rpt_penerimaanjtt($id='', $idjenis_bayar=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		
		if ($id != "") {
			if ($where == "") {
				$where = " where a.replid = '$id' ";
			} else {
				$where = $where . " and a.replid = '$id' ";
			}
		}
				
		if ($idjenis_bayar != "") {
			if ($where == "") {
				$where = " where a.idjenis_bayar = '$idjenis_bayar' ";
			} else {
				$where = $where . " and a.idjenis_bayar = '$idjenis_bayar' ";
			}
		}
		
		
		$sqlstr	=	"select a.jumlah from penerimaanjtt a " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$jumlah=$data->jumlah;
		
		return $jumlah;
	}
	
	
	//---------get data sum penerimaan jenis
	function list_rpt_penerimaanjtt_sum($idjenis_bayar='', $daritgl, $ketgl, $idtingkat, $kelas, $nama, $departemen, $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		$groupby = " group by a.idjenis_bayar ";
						
		if ($idjenis_bayar != "") {
			if ($where == "") {
				$where = " having a.idjenis_bayar = '$idjenis_bayar' ";
			} else {
				$where = $where . " and a.idjenis_bayar = '$idjenis_bayar' ";
			}
			
		}
		
		
		if ($daritgl != "") {
			$daritgl = date("Y-m-d", strtotime($daritgl));
			if ($where == "") {
				$where = " where a.tanggal >= '$daritgl' ";
			} else {
				$where = $where . " and a.tanggal >= '$daritgl' ";
			}
			
			$groupby = $groupby . ", a.tanggal";
		}
		
		if ($ketgl != "") {
			$ketgl = date("Y-m-d", strtotime($ketgl));
			if ($where == "") {
				$where = " where a.tanggal <= '$ketgl' ";
			} else {
				$where = $where . " and a.tanggal <= '$ketgl' ";
			}
			
			$groupby = $groupby . ", a.tanggal";
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where d.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and d.idtingkat = '$idtingkat' ";
			}
			
			$groupby = $groupby . ", d.idtingkat";
		}
		
		if ($kelas != "") {
			if ($where == "") {
				$where = " where c.idkelas = '$kelas' ";
			} else {
				$where = $where . " and c.idkelas = '$kelas' ";
			}
			
			$groupby = $groupby . ", c.idkelas";
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where c.nama like '%$nama%' ";
			} else {
				$where = $where . " and c.nama like '%$nama%' ";
			}
			
			$groupby = $groupby . ", c.nama";
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where e.departemen = '$departemen' ";
			} else {
				$where = $where . " and e.departemen = '$departemen' ";
			}
			
			$groupby = $groupby . ", e.departemen";
		}
		
		if($all == "checked" || $all == "true" || $all == "1") {
			$where = " having a.idjenis_bayar = '$idjenis_bayar' ";
			$groupby = " group by a.idjenis_bayar ";
		}
		
		$sqlstr = "select sum(aa.jumlah) jumlah, aa.idjenis_bayar from (";
		$sqlstr	= $sqlstr . "select a.tanggal, a.idjenis_bayar, d.idtingkat, c.idkelas, c.nama, e.departemen, sum(a.jumlah) jumlah from penerimaanjtt a left join besarjtt b on a.idbesarjtt=b.replid left join siswa c on b.nis=c.nis left join kelas d on c.idkelas=d.replid left join tingkat e on d.idtingkat=e.replid left join datapenerimaan f on b.idpenerimaan=f.replid " . $groupby . $where ;
		$sqlstr = $sqlstr . ") aa group by aa.idjenis_bayar";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$jumlah=$data->jumlah;
		
		return $jumlah;
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
	function list_rpt_konseling_siswa($daritgl='', $ketgl='', $idtingkat='', $kelas='', $nama='', $all=''){
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
		
		$sqlstr	=	"select a.ref, a.tanggal, a.idsiswa, a.idjenis_konseling, a.konseling, a.solusi, a.nip, a.uid, a.dlu, b.nis, b.nama nama_siswa, b.idkelas, c.kelas, c.idtingkat, d.tingkat, e.nama nama_pegawai from konseling_siswa a left join siswa b on a.idsiswa=b.replid left join kelas c on b.idkelas=c.replid left join tingkat d on c.idtingkat=d.replid left join pegawai e on a.nip=e.nip " . $where . " order by a.ref ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data jenis_bayar
	function list_jenis_bayar($id=''){
		$dbpdo = DB::create();
		
		$where = " where a.aktif=1 ";
		
		if ($id != "") {
			if ($where == "") {
				$where = " where a.replid = '$id' ";
			} else {
				$where = $where . " and a.replid = '$id' ";
			}
		}
				
		$sqlstr	= "select a.replid, a.nama from jenis_bayar a " . $where . " order by a.replid";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
    
	
}
?>