<?php

class insert{

	//------insert user
	function insert_usr($ref,$photo){
		$dbpdo = DB::create();
		
		try {
			
			$usrid		=	$_POST["usrid"];
			$old_usrid	=	$_POST["old_usrid"];				
			$pass_ori	=	$_POST["pwd"];
			$pwd		=	obraxabrix($pass_ori, $usrid);
			
			$adm		=	(empty($_POST["adm"])) ? 0 : $_POST["adm"];
			$departemen	=	$_POST["departemen"];
			$idpegawai	=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$tipe_user	=	$_POST["tipe_user"];
			
			//-----------upload file
		  	/*$photo2				= $_POST["photo2"];
			$uploaddir_photo 	= 'app/photo_usr/';
			$photo				= $_FILES['photo']['name']; 
			$tmpname_photo 		= $_FILES['photo']['tmp_name'];
			$filesize_photo 	= $_FILES['photo']['size'];
			$filetype_photo 	= $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} else {
				$photo = $photo;
			}
			
			if($photo != "") {
				$photo = $usrid . '_' . $photo;
				$uploaddir_photo = $uploaddir_photo . $photo;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}	*/
			//----------------
			
			$ganti_pwd_no	=  (empty($_POST["ganti_pwd_no"])) ? 0 : $_POST["ganti_pwd_no"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			$act			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			
			$sqlstr = "insert into usr(usrid, pwd, adm, departemen, idpegawai, tipe_user, ganti_pwd_no, act, uid, dlu) values('$usrid', '$pwd', '$adm', '$departemen', '$idpegawai', '$tipe_user', '$ganti_pwd_no', '$act', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
					
			//----------insert user detail
			$usr_jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($i=1; $i<=$usr_jmldata; $i++) {
				$usr_slc = (empty($_POST[usr_slc_.$i])) ? 0 : $_POST[usr_slc_.$i];
				
				if ($usr_slc==1) { 				
					$usr_frmcde = $_POST[usr_frmcde_.$i];
					$usr_add = (empty($_POST[usr_add_.$i])) ? 0 : $_POST[usr_add_.$i];
					$usr_edt = (empty($_POST[usr_edt_.$i])) ? 0 : $_POST[usr_edt_.$i];
					$usr_dlt = (empty($_POST[usr_dlt_.$i])) ? 0 : $_POST[usr_dlt_.$i];
					$usr_lvl = (empty($_POST[usr_lvl_.$i])) ? 0 : $_POST[usr_lvl_.$i];
									
					$sqlstr = "insert into usr_dtl
					(usrid, frmcde, madd, medt, mdel, lvl)
						values
						(
							'".$usrid."',
							'".$usr_frmcde."',
							".$usr_add.",
							".$usr_edt.",
							".$usr_dlt.",
							'".$usr_lvl."'
						)";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
				}
			}
			
			
			//----------insert user detail
			$usr_jmldata2 = (empty($_POST['jmldata2'])) ? 0 : $_POST['jmldata2'];
			
			for ($i=1; $i<=$usr_jmldata2; $i++) {
				$slc_rmd = (empty($_POST[slc_rmd_.$i])) ? 0 : $_POST[slc_rmd_.$i];
				
				if ($slc_rmd==1) { 				
					$reminder_id = $_POST[reminder_id_.$i];
					
					$line = maxline('usr_reminder', 'line', 'usrid', $usrid, '');
								
					$sqlstr = "insert into usr_reminder (usrid, reminder_id, line)
						values
						(
							'".$usrid."',
							'".$reminder_id."',
							'".$line."'
						)";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
				}
			}
			
			
			//--------insert table user backup
			$sqlstr = "insert into usr_bup(usrid,pwd) values('$usrid','$_POST[pwd]')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert registrasi
	function insert_registrasi($ref){
		$dbpdo = DB::create();
		
		try {
			
            $departemen         =   $_POST["departemen"];
			$idproses			=	$_POST["idproses"];
			$idkelompok			=	$_POST["idkelompok"];
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));
			$tahunmasuk			=	date("Y", strtotime($tanggal));
			$nopendaftaran		=	$_POST["nopendaftaran"];
			$idtingkat			=	(empty($_POST["idtingkat"])) ? 0 : $_POST["idtingkat"];
			$idjurusan			=	(empty($_POST["idjurusan"])) ? 0 : $_POST["idjurusan"];
			$nama				=	petikreplace($_POST["nama"]);
			$panggilan			=	$_POST["panggilan"];
			$kelamin			=	$_POST["kelamin"];
			$nisn				=	$_POST["nisn"];
			$nis				=	$_POST["nis"];			
			$noijazah			=	$_POST["noijazah"];
			$tahunijazah		=	(empty($_POST["tahunijazah"])) ? 0 : $_POST["tahunijazah"];
			$skhun				=	$_POST["skhun"];
			$tahunskhun			=	(empty($_POST["tahunskhun"])) ? 0 : $_POST["tahunskhun"];
			$noujian			=	$_POST["noujian"];
			$nik				=	$_POST["nik"];
			$tmplahir			=	$_POST["tmplahir"];
			$tgllahir			=	date("Y-m-d", strtotime($_POST["tgllahir"]));
			$agama				=	$_POST["agama"];
			$kebutuhan_khusus	=	petikreplace($_POST["kebutuhan_khusus"]);
			$kebutuhan_khusus_chk = $_POST["kebutuhan_khusus_chk"];
			if($kebutuhan_khusus_chk == 2) {
				$kebutuhan_khusus = "";
			}
			$alamatsiswa		=	$_POST["alamatsiswa"];
			$dusun				=	$_POST["dusun"];
			$rt					=	$_POST["rt"];
			$rw					=	$_POST["rw"];
			$kelurahan			=	$_POST["kelurahan"];
			$kodepossiswa		=	$_POST["kodepossiswa"];
			$kecamatan			=	$_POST["kecamatan"];
			$kabupaten			=	$_POST["kabupaten"];
			$provinsi			=	$_POST["provinsi"];
			$transportasi		=	$_POST["transportasi"];
			$transportasi_kode	=	$_POST["transportasi_kode"];
			$citacita			=	$_POST["citacita"];
			$citacita_lain		=	$_POST["citacita_lain"];
			$jenis_tinggal		=	$_POST["jenis_tinggal"];
			$telponsiswa		=	$_POST["telponsiswa"];
			$hpsiswa			=	$_POST["hpsiswa"];
			$emailsiswa			=	$_POST["emailsiswa"];
			$kps				=	(empty($_POST["kps"])) ? 0 : $_POST["kps"];
			$nokps				=	$_POST["nokps"];
			$nokip				=	$_POST["nokip"];
			$nokks				=	$_POST["nokks"];
			$namaayah			=	$_POST["namaayah"];
			$alamatortu			=	petikreplace($_POST["alamatortu"]);
			$kodeposortu		=	$_POST["kodeposortu"];
			$hportu				=	$_POST["hportu"];
			$tahunayah			=	(empty($_POST["tahunayah"])) ? 0 : $_POST["tahunayah"];
			$butuhkhususayah	=	(empty($_POST["butuhkhususayah"])) ? 0 : $_POST["butuhkhususayah"]; 
			$butuhkhususketayah	=	$_POST["butuhkhususketayah"];
			$pekerjaanayah		=	$_POST["pekerjaanayah"];
			$pekerjaanayah_lain	=	$_POST["pekerjaanayah_lain"];
			$pendidikanayah		=	$_POST["pendidikanayah"];
			$penghasilanayah	=	numberreplace($_POST["penghasilanayah"]);
			$penghasilanayah_kode	=	(empty($_POST["penghasilanayah_kode"])) ? 0 : $_POST["penghasilanayah_kode"]; 
			$namaibu			=	$_POST["namaibu"];
			$tahunibu			=	(empty($_POST["tahunibu"])) ? 0 : $_POST["tahunibu"];
			$butuhkhususibu		=	(empty($_POST["butuhkhususibu"])) ? 0 : $_POST["butuhkhususibu"];
			$butuhkhususketibu	=	$_POST["butuhkhususketibu"];
			$alamatibu			=	petikreplace($_POST["alamatibu"]);
			$kodeposibu			=	$_POST["kodeposibu"];
			$hpibu				=	$_POST["hpibu"];
			
			$pekerjaanibu		=	$_POST["pekerjaanibu"];
			$pekerjaanibu_lain	=	$_POST["pekerjaanibu_lain"];
			$pendidikanibu		=	$_POST["pendidikanibu"];
			$penghasilanibu		=	numberreplace($_POST["penghasilanibu"]);
			$penghasilanibu_kode	=	(empty($_POST["penghasilanibu_kode"])) ? 0 : $_POST["penghasilanibu_kode"]; 
			$wali				=	$_POST["wali"];
			$tahunwali			=	(empty($_POST["tahunwali"])) ? 0 : $_POST["tahunwali"];
			$pekerjaanwali		=	(empty($_POST["pekerjaanwali"])) ? 0 : $_POST["pekerjaanwali"];
			$pekerjaanwali_lain	=	petikreplace($_POST["pekerjaanwali_lain"]);
			$pendidikanwali		=	(empty($_POST["pendidikanwali"])) ? 0 : $_POST["pendidikanwali"];
			$penghasilanwali	=	numberreplace($_POST["penghasilanwali"]);
			$tinggi				=	numberreplace($_POST["tinggi"]);
			$berat				=	numberreplace($_POST["berat"]);
			$jaraksekolah		=	$_POST["jaraksekolah"];
			$jarak_km			=	numberreplace($_POST["jarak_km"]);
			$waktutempuh		=	$_POST["waktutempuh"];
			$waktutempuh_menit	=	numberreplace($_POST["waktutempuh_menit"]);
			$jsaudara			=	(empty($_POST["jsaudara"])) ? 0 : $_POST["jsaudara"];
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			$almayah			=	(empty($_POST["almayah"])) ? 0 : $_POST["almayah"];
			$almibu				=	(empty($_POST["almibu"])) ? 0 : $_POST["almibu"];
			$idjenis_tinggal	=	$_POST["idjenis_tinggal"];
			$idminat			=	$_POST['idminat'];
			$idminat1			=	$_POST['idminat1'];
			
			$ref=notran($tanggal, 'frmregistrasi', '', '', $idkelompok);
			$nopendaftaran = $ref;
			
			//-----------upload file foto
			$uploaddir = 'app/file_foto/';
			$foto_file = $_FILES['foto_file']['name']; 
			$tmpname  = $_FILES['foto_file']['tmp_name'];
			$filesize = $_FILES['foto_file']['size'];
			$filetype = $_FILES['foto_file']['type'];

			
			if($foto_file != "") {			
				$foto_file = $nopendaftaran . $idkelas . '_' . $foto_file;					
				$uploadfile = $uploaddir . $foto_file;		
				if (move_uploaded_file($_FILES['foto_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			//-----------upload file fotocopy golongan darah
			$darah			=	$_POST["darah"];
			$uploaddir = 'app/file_darah_calon/';
			$file_darah = $_FILES['file_darah']['name']; 
			$tmpname  = $_FILES['file_darah']['tmp_name'];
			$filesize = $_FILES['file_darah']['size'];
			$filetype = $_FILES['file_darah']['type'];

			
			if($file_darah != "") {			
				$file_darah = $nopendaftaran . '_' . $file_darah;					
				$uploadfile = $uploaddir . $file_darah;		
				if (move_uploaded_file($_FILES['file_darah']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			$sqlstr = "insert into calonsiswa (departemen, idproses, idkelompok, tanggal, nopendaftaran, idtingkat, idjurusan, idminat, idminat1, foto_file, darah, file_darah, nama, panggilan, kelamin, nisn, nis, noijazah, tahunijazah, skhun, noujian, nik, tmplahir, tgllahir, agama, kebutuhan_khusus_chk, kebutuhan_khusus, tahunmasuk, alamatsiswa, dusun, rt, rw, kelurahan, kodepossiswa, kecamatan, kabupaten, provinsi, transportasi, transportasi_kode, citacita, citacita_lain, idjenis_tinggal, jenis_tinggal, telponsiswa, hpsiswa, emailsiswa, kps, nokps, nokip, nokks, namaayah, tahunayah, alamatortu, kodeposortu, hportu, butuhkhususayah, butuhkhususketayah, pekerjaanayah, pekerjaanayah_lain, pendidikanayah, penghasilanayah, penghasilanayah_kode, namaibu, tahunibu, butuhkhususibu, butuhkhususketibu, pekerjaanibu, pekerjaanibu_lain, pendidikanibu, penghasilanibu, penghasilanibu_kode, wali, tahunwali, pekerjaanwali, pekerjaanwali_lain, pendidikanwali, penghasilanwali, tinggi, berat, jaraksekolah, jarak_km, waktutempuh, waktutempuh_menit, jsaudara, almayah, almibu, alamatibu, kodeposibu, hpibu, uid, dlu) values ('$departemen', '$idproses', '$idkelompok', '$tanggal', '$nopendaftaran', '$idtingkat', '$idjurusan', '$idminat', '$idminat1', '$foto_file', '$darah', '$file_darah', '$nama', '$panggilan', '$kelamin', '$nisn', '$nis', '$noijazah', '$tahunijazah', '$skhun', '$noujian', '$nik', '$tmplahir', '$tgllahir', '$agama', '$kebutuhan_khusus_chk', '$kebutuhan_khusus', '$tahunmasuk', '$alamatsiswa', '$dusun', '$rt', '$rw', '$kelurahan', '$kodepossiswa', '$kecamatan', '$kabupaten', '$provinsi', '$transportasi', '$transportasi_kode', '$citacita', '$citacita_lain', '$idjenis_tinggal', '$jenis_tinggal', '$telponsiswa', '$hpsiswa', '$emailsiswa', '$kps', '$nokps', '$nokip', '$nokks', '$namaayah', '$tahunayah', '$alamatortu', '$kodeposortu', '$hportu', '$butuhkhususayah', '$butuhkhususketayah', '$pekerjaanayah', '$pekerjaanayah_lain', '$pendidikanayah', '$penghasilanayah', '$penghasilanayah_kode', '$namaibu', '$tahunibu', '$butuhkhususibu', '$butuhkhususketibu', '$pekerjaanibu', '$pekerjaanibu_lain', '$pendidikanibu', '$penghasilanibu', '$penghasilanibu_kode', '$wali', '$tahunwali', '$pekerjaanwali', '$pekerjaanwali_lain', '$pendidikanwali', '$penghasilanwali', '$tinggi', '$berat', '$jaraksekolah', '$jarak_km', '$waktutempuh', '$waktutempuh_menit', '$jsaudara', '$almayah', '$almibu', '$alamatibu', '$kodeposibu', '$hpibu', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			notran($tanggal, 'frmregistrasi', 1, '', $idkelompok) ;
			
			$sqlstr 		= 	"select last_insert_id() last_id";
			$results		=	$dbpdo->query($sqlstr);
			$data 			=  	$results->fetch(PDO::FETCH_OBJ);
			$idcalonsiswa	=	$data->last_id;
			
			//----------insert prestasi detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];		
			for ($x=0; $x<=$jmldata; $x++) {
				$jenisprestasi_ 	=	$_POST[jenisprestasi_.$x];
				$tingkat_ 			=	$_POST[tingkat_.$x];
				$nama_			 	=	$_POST[nama_.$x];
				$tahun_			 	=	(empty($_POST[tahun_.$x])) ? 0 : $_POST[tahun_.$x];
				$penyelenggara_		=	$_POST[penyelenggara_.$x];
				
				$line = maxline('calonsiswa_prestasi', 'line', 'idcalonsiswa', $idcalonsiswa, '');
				
				if ( !empty($jenisprestasi_) ) {
					$sqlstr = "insert into calonsiswa_prestasi (idcalonsiswa, jenisprestasi, tingkat, nama, tahun, penyelenggara, line) values ('$idcalonsiswa', '$jenisprestasi_', '$tingkat_', '$nama_', '$tahun_', '$penyelenggara_', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			
			//----------insert beasiswa detail
			$jmldata2 = (empty($_POST['jmldata2'])) ? 0 : $_POST['jmldata2'];		
			for ($x=0; $x<=$jmldata2; $x++) {
				$jenis_ 			=	$_POST[jenis_.$x];
				$penyelenggara2_	=	$_POST[penyelenggara_.$x];
				$tahunmulai_	 	=	(empty($_POST[tahunmulai_.$x])) ? 0 : $_POST[tahunmulai_.$x];
				$tahunselesai_	 	=	(empty($_POST[tahunselesai_.$x])) ? 0 : $_POST[tahunselesai_.$x];
				
				$line = maxline('calonsiswa_beasiswa', 'line', 'idcalonsiswa', $idcalonsiswa, '');
				
				if ( !empty($jenis_) ) {
					$sqlstr = "insert into calonsiswa_beasiswa (idcalonsiswa, jenis, penyelenggara, tahunmulai, tahunselesai, line) values ('$idcalonsiswa', '$jenis_', '$penyelenggara2_', '$tahunmulai_', '$tahunselesai_', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert siswa
	function insert_siswa($ref){
		$dbpdo = DB::create();
		
		try {
			
			$idangkatan			=	(empty($_POST["idangkatan"])) ? 0 : $_POST["idangkatan"];
			$idangkatan1		=	(empty($_POST["idangkatan1"])) ? 0 : $_POST["idangkatan1"];
			
			/*--------Keterangan pribadi---------*/
			$nis				=	$_POST["nis"];
			$nisn				=	$_POST["nisn"];
			$nik				=	$_POST["nik"];
			$nama				=	petikreplace($_POST["nama"]);
			$panggilan			=	petikreplace($_POST['panggilan']);
			$idkelas			=	(empty($_POST["idkelas"])) ? 0 : $_POST["idkelas"];
			$tglmasuk			=	date("Y-m-d", strtotime($_POST["tglmasuk"]));
			$kelamin			=	$_POST["kelamin"];
			$tmplahir			=	$_POST["tmplahir"];
			$tgllahir			=	date("Y-m-d", strtotime($_POST["tgllahir"]));
			$agama				=	$_POST["agama"];
			$warga				=	$_POST["warga"];
			$anakke				=	(empty($_POST["anakke"])) ? 0 : $_POST["anakke"];
			$jsaudara			=	(empty($_POST["jsaudara"])) ? 0 : $_POST["jsaudara"];
			$jtiri				=	(empty($_POST["jtiri"])) ? 0 : $_POST["jtiri"];
			$jangkat			=	(empty($_POST["jangkat"])) ? 0 : $_POST["jangkat"];
			$yatim				=	(empty($_POST["yatim"])) ? 0 : $_POST["yatim"];
			$bahasa				=	$_POST["bahasa"];
			
			/*--------Keterangan tempat tinggal---------*/
            $desa_kode          =	$_POST["desa_kode"];
            $kecamatan_kode     =	$_POST["kecamatan_kode"];
            $kota_kode          =	$_POST["kota_kode"];
            $provinsi_kode      =	$_POST["provinsi_kode"];
            
			$alamatsiswa		=	$_POST["alamatsiswa"];
			$rt_siswa			=	$_POST["rt_siswa"];
			$rw_siswa			=	$_POST["rw_siswa"];
			$dusun				=	$_POST["dusun"];	
			$desa				=	$_POST["desa"];	
			$kecamatan			=	$_POST["kecamatan"];
			$alamatortu			=	$_POST["alamatortu"];
			$kodepossiswa		=	$_POST["kodepossiswa"];
			$telponsiswa		=	$_POST["telponsiswa"];
			$hpsiswa			=	$_POST["hpsiswa"];
			$emailsiswa			=	$_POST["emailsiswa"];
			$jenistinggal		=	$_POST["jenistinggal"];
			$kps				=	(empty($_POST["kps"])) ? 0 : $_POST["kps"];
			$nokps				=	$_POST["nokps"];
			$kip				=	(empty($_POST["kip"])) ? 0 : $_POST["kip"];
			$nokip				=	$_POST["nokip"];
			$namakip			=	$_POST["namakip"];
			$nokks				=	$_POST["nokks"];
			$no_akte_lahir		=	$_POST["no_akte_lahir"];
			$telponortu			=	$_POST["telponortu"];
			$hportu				=	$_POST["hportu"];
			$hpibu				=	$_POST["hpibu"];
			$transportasi_kode	=	$_POST["transportasi_kode"];
			$transportasi_lain	=	$_POST["transportasi_lain"];
			$jaraksekolah		=	numberreplace($_POST["jaraksekolah"]);
			$kesekolah			=	(empty($_POST["kesekolah"])) ? 0 : $_POST["kesekolah"];
			
			/*--------Keterangan kesehatan---------*/
			$berat				=	numberreplace($_POST["berat"]);
			$tinggi				=	numberreplace($_POST["tinggi"]);
			$kesehatan			=	$_POST["kesehatan"]; //riwayat penyakit
			$darah				=	$_POST["darah"];
			
			//-----------upload file fotocopy golongan darah
			$uploaddir = 'app/file_darah/';
			$file_darah = $_FILES['file_darah']['name']; 
			$tmpname  = $_FILES['file_darah']['tmp_name'];
			$filesize = $_FILES['file_darah']['size'];
			$filetype = $_FILES['file_darah']['type'];

			
			if($file_darah != "") {			
				$file_darah = $nis . $idkelas . '_' . $file_darah;					
				$uploadfile = $uploaddir . $file_darah;		
				if (move_uploaded_file($_FILES['file_darah']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			$kelainan			=	$_POST["kelainan"];
			
			
			/*--------Keterangan pendidikan sebelumnya---------*/
			$asalsekolah_id		=	petikreplace($_POST["asalsekolah_id"]); //(empty($_POST["asalsekolah_id"])) ? 0 : $_POST["asalsekolah_id"];
			$kota_asalsekolah	=	petikreplace($_POST["kota_asalsekolah"]);
			$tglijazah			=	date("Y-m-d", strtotime($_POST["tglijazah"]));
			$noijazah			=	$_POST["noijazah"];
			$tglskhun			=	date("Y-m-d", strtotime($_POST["tglskhun"]));
			$skhun				=	$_POST["skhun"];
			$noujian			=	$_POST["noujian"];
			$nisnasal			=	$_POST["nisnasal"];
			
			/*--------Keterangan orang tua---------*/
			$nik_ayah			=	$_POST["nik_ayah"];
			$namaayah			=	$_POST["namaayah"];
			$nik_ibu			=	$_POST["nik_ibu"];
			$namaibu			=	$_POST["namaibu"];
			$tmplahirayah		=	$_POST["tmplahirayah"];
			$tgllahirayah		=	date("Y-m-d", strtotime($_POST["tgllahirayah"]));
            $tempat_bekerja_ayah=   $_POST["tempat_bekerja_ayah"];
            
			$tmplahiribu		=	$_POST["tmplahiribu"];
			$tgllahiribu		=	date("Y-m-d", strtotime($_POST["tgllahiribu"]));
			$pekerjaanayah		=	$_POST["pekerjaanayah"];
			$pekerjaanayah_lain	=	$_POST["pekerjaanayah_lain"];
			$pekerjaanibu		=	$_POST["pekerjaanibu"];
			$pekerjaanibu_lain	=	$_POST["pekerjaanibu_lain"];
            $tempat_bekerja_ibu =   $_POST["tempat_bekerja_ibu"];
            
			$penghasilanayah_kode	=	(empty($_POST["penghasilanayah_kode"])) ? 0 : $_POST["penghasilanayah_kode"];
			$penghasilanayah	=	numberreplace($_POST["penghasilanayah"]);
			$penghasilanibu_kode	=	(empty($_POST["penghasilanibu_kode"])) ? 0 : $_POST["penghasilanibu_kode"];
			$penghasilanibu		=	numberreplace($_POST["penghasilanibu"]);
			
			/*--------pendidikan formal orang tua tertinggi---------*/
			$pendidikanayah		=	$_POST["pendidikanayah"];
			$pendidikanibu		=	$_POST["pendidikanibu"];
			$wnayah				=	$_POST["wnayah"];
			$wnibu				=	$_POST["wnibu"];
			
			/*--------Keterangan wali---------*/
			$nik_wali			=	$_POST["nik_wali"];
			$wali				=	$_POST["wali"];
			$tmplahirwali		=	$_POST["tmplahirwali"];
			$tgllahirwali		=	date("Y-m-d", strtotime($_POST["tgllahirwali"]));
			$pendidikanwali		=	(empty($_POST["pendidikanwali"])) ? 0 : $_POST["pendidikanwali"];
			$pekerjaanwali		=	(empty($_POST["pekerjaanwali"])) ? 0 : $_POST["pekerjaanwali"];
			$pekerjaanwali_lain	=	$_POST["pekerjaanwali_lain"];
			$penghasilanwali_kode	=	(empty($_POST["penghasilanwali_kode"])) ? 0 : $_POST["penghasilanwali_kode"];
			$penghasilanwali	=	numberreplace($_POST["penghasilanwali"]);
            $tempat_bekerja_wali=   $_POST["tempat_bekerja_wali"];
            
			$alamatwali			=	petikreplace($_POST["alamatwali"]);
			$hpwali				=	$_POST["hpwali"];
			$hubungansiswa		=	$_POST["hubungansiswa"];
			
			//new
	        $tahun_ijazah		=	(empty($_POST["tahun_ijazah"])) ? 0 : $_POST["tahun_ijazah"];
	        $tahunskhun			=	(empty($_POST["tahunskhun"])) ? 0 : $_POST["tahunskhun"];
	        $kebutuhan_khusus_chk=	(empty($_POST["kebutuhan_khusus_chk"])) ? 0 : $_POST["kebutuhan_khusus_chk"];
	        $jenis_tinggal		=	$_POST["jenis_tinggal"];
	        $kebutuhan_khusus_chk1=	(empty($_POST["kebutuhan_khusus_chk1"])) ? 0 : $_POST["kebutuhan_khusus_chk1"];
	        $kebutuhan_khusus	=	petikreplace($_POST["kebutuhan_khusus"]);
	        $citacita			=	$_POST["citacita"];
	        $citacita_lain		=	petikreplace($_POST["citacita_lain"]);
	        $tahunayah			=	(empty($_POST["tahunayah"])) ? 0 : $_POST["tahunayah"];
	        $kodeposortu		=	$_POST["kodeposortu"];
	        $butuhkhususketayah	=	petikreplace($_POST["butuhkhususketayah"]);
	        $tahunibu			=	(empty($_POST["tahunibu"])) ? 0 : $_POST["tahunibu"];
	        $kodeposibu			=	$_POST["kodeposibu"];
	        $butuhkhususibu		=	(empty($_POST["butuhkhususibu"])) ? 0 : $_POST["butuhkhususibu"];
	        $butuhkhususketibu	=	petikreplace($_POST["butuhkhususketibu"]);
	        $tahunwali			=	(empty($_POST["tahunwali"])) ? 0 : $_POST["tahunwali"];
	        $jarak_km			=	numberreplace($_POST["jarak_km"]);
	        $waktutempuh		=	numberreplace($_POST["waktutempuh"]);
	        $waktutempuh_menit	=	numberreplace($_POST["waktutempuh_menit"]);
	        
	        $almayah			=	(empty($_POST["almayah"])) ? 0 : $_POST["almayah"];
	        $butuhkhususayah	=	(empty($_POST["butuhkhususayah"])) ? 0 : $_POST["butuhkhususayah"];
	        $almibu				=	(empty($_POST["almibu"])) ? 0 : $_POST["almibu"];
	        $alamatibu			=	petikreplace($_POST["alamatibu"]);
	        //------end new
	        
			
			/*--------Lain lain ------*/
			$rombel_id			=	(empty($_POST["rombel_id"])) ? 0 : $_POST["rombel_id"];
			$nama_bank			=	$_POST["nama_bank"];
			$no_rekening_bank	=	$_POST["no_rekening_bank"];
			$nama_pemilik_bank	=	$_POST["nama_pemilik_bank"];
			$pip				=	(empty($_POST["pip"])) ? 0 : $_POST["pip"];
			$alasan_pip			=	petikreplace($_POST["alasan_pip"]);
			$virtualaccount		=	$_POST['virtualaccount'];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$idminat			=	$_POST["idminat"];	
			$jalurmasuk			=	$_POST["jalurmasuk"];
			$jalurmasuk_id		=	$_POST["jalurmasuk_id"];
			$jalurmasukprestasi_id = (empty($_POST["jalurmasukprestasi_id"])) ? 0 : $_POST["jalurmasukprestasi_id"];
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			//-----------upload file foto
			$uploaddir = 'app/file_foto_siswa/';
			$foto_file = $_FILES['foto_file']['name']; 
			$tmpname  = $_FILES['foto_file']['tmp_name'];
			$filesize = $_FILES['foto_file']['size'];
			$filetype = $_FILES['foto_file']['type'];

			
			if($foto_file != "") {			
				$foto_file = $nis . '_' . $foto_file;					
				$uploadfile = $uploaddir . $foto_file;		
				if (move_uploaded_file($_FILES['foto_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			//-----------upload file rekam BK
			$uploaddir = 'app/file_rekam_bk/';
			$file_rekam_bk = $_FILES['file_rekam_bk']['name']; 
			$tmpname  = $_FILES['file_rekam_bk']['tmp_name'];
			$filesize = $_FILES['file_rekam_bk']['size'];
			$filetype = $_FILES['file_rekam_bk']['type'];

			
			if($file_rekam_bk != "") {			
				$file_rekam_bk = $nis . '_' . $file_rekam_bk;					
				$uploadfile = $uploaddir . $file_rekam_bk;		
				if (move_uploaded_file($_FILES['file_rekam_bk']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			//-----------upload file memo ortu
			$uploaddir = 'app/file_memo_ortu/';
			$file_memo_ortu = $_FILES['file_memo_ortu']['name']; 
			$tmpname  = $_FILES['file_memo_ortu']['tmp_name'];
			$filesize = $_FILES['file_memo_ortu']['size'];
			$filetype = $_FILES['file_memo_ortu']['type'];

			
			if($file_memo_ortu != "") {			
				$file_memo_ortu = $nis . '_' . $file_memo_ortu;					
				$uploadfile = $uploaddir . $file_memo_ortu;		
				if (move_uploaded_file($_FILES['file_memo_ortu']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			//-----------upload file_nilai_un
			$uploaddir = 'app/file_nilai_un/';
			$file_nilai_un = $_FILES['file_nilai_un']['name']; 
			$tmpname  = $_FILES['file_nilai_un']['tmp_name'];
			$filesize = $_FILES['file_nilai_un']['size'];
			$filetype = $_FILES['file_nilai_un']['type'];

			
			if($file_nilai_un != "") {			
				$file_nilai_un = $nis . '_' . $file_nilai_un;					
				$uploadfile = $uploaddir . $file_nilai_un;		
				if (move_uploaded_file($_FILES['file_nilai_un']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			//-----------upload file_raport
			$uploaddir = 'app/file_raport/';
			$file_raport = $_FILES['file_raport']['name']; 
			$tmpname  = $_FILES['file_raport']['tmp_name'];
			$filesize = $_FILES['file_raport']['size'];
			$filetype = $_FILES['file_raport']['type'];

			
			if($file_raport != "") {			
				$file_raport = $nis . '_' . $file_raport;					
				$uploadfile = $uploaddir . $file_raport;		
				if (move_uploaded_file($_FILES['file_raport']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			
			//-----------upload file_kk
			$uploaddir = 'app/file_kk/';
			$file_kk = $_FILES['file_kk']['name']; 
			$tmpname  = $_FILES['file_kk']['tmp_name'];
			$filesize = $_FILES['file_kk']['size'];
			$filetype = $_FILES['file_kk']['type'];

			
			if($file_kk != "") {			
				$file_kk = $nis . '_' . $file_kk;					
				$uploadfile = $uploaddir . $file_kk;		
				if (move_uploaded_file($_FILES['file_kk']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			
			//-----------upload file_akte
			$uploaddir = 'app/file_akte/';
			$file_akte = $_FILES['file_akte']['name']; 
			$tmpname  = $_FILES['file_akte']['tmp_name'];
			$filesize = $_FILES['file_akte']['size'];
			$filetype = $_FILES['file_akte']['type'];

			
			if($file_akte != "") {			
				$file_akte = $nis . '_' . $file_akte;					
				$uploadfile = $uploaddir . $file_akte;		
				if (move_uploaded_file($_FILES['file_akte']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			
			//-----------upload file_ijazah
			$uploaddir = 'app/file_ijazah/';
			$file_ijazah = $_FILES['file_ijazah']['name']; 
			$tmpname  = $_FILES['file_ijazah']['tmp_name'];
			$filesize = $_FILES['file_ijazah']['size'];
			$filetype = $_FILES['file_ijazah']['type'];

			
			if($file_ijazah != "") {			
				$file_ijazah = $nis . '_' . $file_ijazah;					
				$uploadfile = $uploaddir . $file_ijazah;		
				if (move_uploaded_file($_FILES['file_ijazah']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			
			
			//-----------upload file_nhun
			$uploaddir = 'app/file_nhun/';
			$file_nhun = $_FILES['file_nhun']['name']; 
			$tmpname  = $_FILES['file_nhun']['tmp_name'];
			$filesize = $_FILES['file_nhun']['size'];
			$filetype = $_FILES['file_nhun']['type'];

			
			if($file_nhun != "") {			
				$file_nhun = $nis . '_' . $file_nhun;					
				$uploadfile = $uploaddir . $file_nhun;		
				if (move_uploaded_file($_FILES['file_nhun']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			 
			
			$sqlstr = "insert into siswa (nis, nisn, nik, idangkatan, idangkatan1, foto_file, nama, panggilan, idkelas, tglmasuk, kelamin, tmplahir, tgllahir, agama, warga, anakke, jsaudara, jtiri, jangkat, yatim, bahasa, desa_kode, kecamatan_kode, kota_kode, provinsi_kode, alamatsiswa, rt_siswa, rw_siswa, dusun, desa, kecamatan, kodepossiswa, jenistinggal, alamatortu, telponsiswa, hpsiswa, emailsiswa, telponortu, hportu, hpibu, transportasi_kode, kps, nokps, kip, nokip, namakip, nokks, no_akte_lahir, transportasi_lain, jaraksekolah, kesekolah, berat, tinggi, kesehatan, darah, file_darah, kelainan, asalsekolah_id, kota_asalsekolah, tglijazah, noijazah, tglskhun, skhun, noujian, nisnasal, nik_ayah, namaayah, nik_ibu, namaibu, tmplahirayah, tgllahirayah, tempat_bekerja_ayah, tmplahiribu, tgllahiribu, pekerjaanayah, pekerjaanibu, penghasilanayah_kode, penghasilanayah, penghasilanibu_kode, penghasilanibu, pendidikanayah, pendidikanibu, wnayah, wnibu, nik_wali, wali, tmplahirwali, tgllahirwali, pendidikanwali, pekerjaanwali, penghasilanwali_kode, penghasilanwali, tempat_bekerja_wali, alamatwali, hpwali, hubungansiswa, pekerjaanayah_lain, pekerjaanibu_lain, tempat_bekerja_ibu, pekerjaanwali_lain, rombel_id, nama_bank, no_rekening_bank, nama_pemilik_bank, pip, alasan_pip, idminat, jalurmasuk_id, jalurmasuk, jalurmasukprestasi_id, file_rekam_bk, file_memo_ortu, file_nilai_un, file_raport, file_kk, file_akte, file_ijazah, file_nhun, uid, aktif, ts, tahun_ijazah, tahunskhun, kebutuhan_khusus_chk, jenis_tinggal, kebutuhan_khusus_chk1, kebutuhan_khusus, citacita, citacita_lain, tahunayah, kodeposortu, butuhkhususketayah, tahunibu, kodeposibu, butuhkhususibu, butuhkhususketibu, tahunwali, jarak_km, waktutempuh, waktutempuh_menit, almayah, butuhkhususayah, almibu, alamatibu) values ('$nis', '$nisn', '$nik', '$idangkatan', '$idangkatan1', '$foto_file', '$nama', '$panggilan', '$idkelas', '$tglmasuk', '$kelamin', '$tmplahir', '$tgllahir', '$agama', '$warga', '$anakke', '$jsaudara', '$jtiri', '$jangkat', '$yatim', '$bahasa', '$desa_kode', '$kecamatan_kode', '$kota_kode', '$provinsi_kode', '$alamatsiswa', '$rt_siswa', '$rw_siswa', '$dusun', '$desa', '$kecamatan', '$kodepossiswa', '$jenistinggal', '$alamatortu', '$telponsiswa', '$hpsiswa', '$emailsiswa', '$telponortu', '$hportu', '$hpibu', '$transportasi_kode', '$kps', '$nokps', '$kip', '$nokip', '$namakip', '$nokks', '$no_akte_lahir', '$transportasi_lain', '$jaraksekolah', '$kesekolah', '$berat', '$tinggi', '$kesehatan', '$darah', '$file_darah', '$kelainan', '$asalsekolah_id', '$kota_asalsekolah', '$tglijazah', '$noijazah', '$tglskhun', '$skhun', '$noujian', '$nisnasal', '$nik_ayah', '$namaayah', '$nik_ibu', '$namaibu', '$tmplahirayah', '$tgllahirayah', '$tempat_bekerja_ayah', '$tmplahiribu', '$tgllahiribu', '$pekerjaanayah', '$pekerjaanibu', '$penghasilanayah_kode', '$penghasilanayah', '$penghasilanibu_kode', '$penghasilanibu', '$pendidikanayah', '$pendidikanibu', '$wnayah', '$wnibu', '$nik_wali', '$wali', '$tmplahirwali', '$tgllahirwali', '$pendidikanwali', '$pekerjaanwali', '$penghasilanwali_kode', '$penghasilanwali', '$tempat_bekerja_wali', '$alamatwali', '$hpwali', '$hubungansiswa', '$pekerjaanayah_lain', '$pekerjaanibu_lain', '$tempat_bekerja_ibu', '$pekerjaanwali_lain', '$rombel_id', '$nama_bank', '$no_rekening_bank', '$nama_pemilik_bank', '$pip', '$alasan_pip', '$idminat', '$jalurmasuk_id', '$jalurmasuk', '$jalurmasukprestasi_id', '$file_rekam_bk', '$file_memo_ortu', '$file_nilai_un', '$file_raport', '$file_kk', '$file_akte', '$file_ijazah', '$file_nhun', '$uid', '$aktif', '$dlu', '$tahun_ijazah', '$tahunskhun', '$kebutuhan_khusus_chk', '$jenis_tinggal', '$kebutuhan_khusus_chk1', '$kebutuhan_khusus', '$citacita', '$citacita_lain', '$tahunayah', '$kodeposortu', '$butuhkhususketayah', '$tahunibu', '$kodeposibu', '$butuhkhususibu', '$butuhkhususketibu', '$tahunwali', '$jarak_km', '$waktutempuh', '$waktutempuh_menit', '$almayah', '$butuhkhususayah', '$almibu', '$alamatibu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//virtual account
			$sqlstr = "select nis from siswa_virtualaccount where nis='$nis'";
			$results1 = $dbpdo->query($sqlstr);
			$rows = $results1->rowCount();
			if($rows == 0) {
				$sqlstr = "insert into siswa_virtualaccount(nis, virtualaccount) values ('$nis', '$virtualaccount')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
			//-------get last ID
			$sqlstr 		= 	"select last_insert_id() last_id";
			$results		=	$dbpdo->query($sqlstr);
			$data 			=  	$results->fetch(PDO::FETCH_OBJ);
			$idsiswa		=	$data->last_id;
			
			//----------insert prestasi detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];		
			for ($x=0; $x<=$jmldata; $x++) {
				$jenisprestasi_ 	=	$_POST[jenisprestasi_.$x];
				$tingkat_ 			=	$_POST[tingkat_.$x];
				$nama_			 	=	$_POST[nama_.$x];
				$tahun_			 	=	(empty($_POST[tahun_.$x])) ? 0 : $_POST[tahun_.$x];
				$penyelenggara_		=	$_POST[penyelenggara_.$x];
				
				$line = maxline('siswa_prestasi', 'line', 'idsiswa', $idsiswa, '');
				
				if ( !empty($jenisprestasi_) ) {
					$sqlstr = "insert into siswa_prestasi (idsiswa, jenisprestasi, tingkat, nama, tahun, penyelenggara, line) values ('$idsiswa', '$jenisprestasi_', '$tingkat_', '$nama_', '$tahun_', '$penyelenggara_', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			
			//----------insert beasiswa detail
			$jmldata2 = (empty($_POST['jmldata2'])) ? 0 : $_POST['jmldata2'];		
			for ($x=0; $x<=$jmldata2; $x++) {
				$jenis_ 			=	$_POST[jenis_.$x];
				$penyelenggara2_	=	$_POST[penyelenggara_.$x];
				$tahunmulai_	 	=	(empty($_POST[tahunmulai_.$x])) ? 0 : $_POST[tahunmulai_.$x];
				$tahunselesai_	 	=	(empty($_POST[tahunselesai_.$x])) ? 0 : $_POST[tahunselesai_.$x];
				
				$line = maxline('siswa_beasiswa', 'line', 'idsiswa', $idsiswa, '');
				
				if ( !empty($jenis_) ) {
					$sqlstr = "insert into siswa_beasiswa (idsiswa, jenis, penyelenggara, tahunmulai, tahunselesai, line) values ('$idsiswa', '$jenis_', '$penyelenggara2_', '$tahunmulai_', '$tahunselesai_', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			//----------insert nilai UN
			$jmldata_un = (empty($_POST['jmldata_un'])) ? 0 : $_POST['jmldata_un'];		
			for ($x=0; $x<=$jmldata_un; $x++) {
				$replid_un3u 		=	$_POST[replid_un3u_.$x];
				$pelajaran_id3u		=	$replid_un3u;
				$nilai3u				=	numberreplace($_POST[nilai3u_.$x]);
				
				$line = maxline('siswa_nilai_un', 'line', 'nis', $nis, '');
				
				if ( $nilai3u > 0 ) {
					$sqlstr = "insert into siswa_nilai_un (nis, pelajaran_id, nilai, line) values ('$nis', '$pelajaran_id3u', '$nilai3u', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			
			//----------insert raport semester-1
			$jmldata_raport = (empty($_POST['jmldata_raport'])) ? 0 : $_POST['jmldata_raport'];		
			for ($x=0; $x<=$jmldata_raport; $x++) {
				$replid_un 			=	$_POST[replid_un_.$x];
				$pelajaran_id		=	$replid_un;
				$nilai				=	numberreplace($_POST[nilai_.$x]);
				
				$line = maxline('siswa_nilai_raport', 'line', 'nis', $nis, '');
				
				if ( $nilai > 0 ) {
					$sqlstr = "insert into siswa_nilai_raport (nis, semester, pelajaran_id, nilai, line) values ('$nis', '1', '$pelajaran_id', '$nilai', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			//----------insert raport semester-2
			$jmldata_raport1 = (empty($_POST['jmldata_raport1'])) ? 0 : $_POST['jmldata_raport1'];		
			for ($x=0; $x<=$jmldata_raport1; $x++) {
				$replid_un1 		=	$_POST[replid_un1_.$x];
				$pelajaran_id1		=	$replid_un1;
				$nilai1				=	numberreplace($_POST[nilai1_.$x]);
				
				$line = maxline('siswa_nilai_raport', 'line', 'nis', $nis, '');
				
				if ( $nilai1 > 0 ) {
					$sqlstr = "insert into siswa_nilai_raport (nis, semester, pelajaran_id, nilai, line) values ('$nis', '2', '$pelajaran_id1', '$nilai1', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			//----------insert raport semester-3
			$jmldata_raport2 = (empty($_POST['jmldata_raport2'])) ? 0 : $_POST['jmldata_raport2'];		
			for ($x=0; $x<=$jmldata_raport2; $x++) {
				$replid_un2 			=	$_POST[replid_un2_.$x];
				$pelajaran_id2		=	$replid_un2;
				$nilai2				=	numberreplace($_POST[nilai2_.$x]);
				
				$line = maxline('siswa_nilai_raport', 'line', 'nis', $nis, '');
				
				if ( $nilai2 > 0 ) {
					$sqlstr = "insert into siswa_nilai_raport (nis, semester, pelajaran_id, nilai, line) values ('$nis', '3', '$pelajaran_id2', '$nilai2', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			//----------insert raport semester-4
			$jmldata_raport3 = (empty($_POST['jmldata_raport3'])) ? 0 : $_POST['jmldata_raport3'];		
			for ($x=0; $x<=$jmldata_raport1; $x++) {
				$replid_un3			=	$_POST[replid_un3_.$x];
				$pelajaran_id3		=	$replid_un3;
				$nilai3				=	numberreplace($_POST[nilai3_.$x]);
				
				$line = maxline('siswa_nilai_raport', 'line', 'nis', $nis, '');
				
				if ( $nilai3 > 0 ) {
					$sqlstr = "insert into siswa_nilai_raport (nis, semester, pelajaran_id, nilai, line) values ('$nis', '4', '$pelajaran_id3', '$nilai3', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			//----------insert raport semester-5
			$jmldata_raport4 = (empty($_POST['jmldata_raport4'])) ? 0 : $_POST['jmldata_raport4'];		
			for ($x=0; $x<=$jmldata_raport4; $x++) {
				$replid_un4			=	$_POST[replid_un4_.$x];
				$pelajaran_id4		=	$replid_un4;
				$nilai4				=	numberreplace($_POST[nilai4_.$x]);
				
				$line = maxline('siswa_nilai_raport', 'line', 'nis', $nis, '');
				
				if ( $nilai4 > 0 ) {
					$sqlstr = "insert into siswa_nilai_raport (nis, semester, pelajaran_id, nilai, line) values ('$nis', '5', '$pelajaran_id4', '$nilai4', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert prosespenerimaansiswa
	function insert_prosespenerimaansiswa(){
		$dbpdo = DB::create();
		
		try {
			
			$proses				=	$_POST["proses"];
			$kodeawalan			=	$_POST["kodeawalan"];
			$departemen			=	$_POST["departemen"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into prosespenerimaansiswa (proses, kodeawalan, departemen, keterangan, aktif, ts) values ('$proses', '$kodeawalan', '$departemen', '$keterangan', '$aktif', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert kelompokcalonsiswa
	function insert_kelompokcalonsiswa(){
		$dbpdo = DB::create();
		
		try {
			
			$idproses			=	$_POST["idproses"];
			$kapasitas			=	numberreplace($_POST["kapasitas"]);
			$kelompok			=	$_POST["kelompok"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into kelompokcalonsiswa (idproses, kapasitas, kelompok, keterangan, ts) values ('$idproses', '$kapasitas', '$kelompok', '$keterangan', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert departemen
	function insert_departemen(){
		$dbpdo = DB::create();
		
		try {
			
			$departemen			=	$_POST["departemen"];
			$nipkepsek			=	$_POST["nipkepsek"];
			$urutan				=	(empty($_POST["urutan"])) ? 0 : $_POST["urutan"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into departemen (departemen, nipkepsek, urutan, keterangan, aktif, info1, ts) values ('$departemen', '$nipkepsek', '$urutan', '$keterangan', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert tingkat
	function insert_tingkat(){
		$dbpdo = DB::create();
		
		try {
			
			$tingkat			=	$_POST["tingkat"];
			$departemen			=	$_POST["departemen"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$tanggal_ttd		=	date("Y-m-d", strtotime($_POST["tanggal_ttd"]));
			$urutan				=	(empty($_POST["urutan"])) ? 0 : $_POST["urutan"];			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into tingkat (tingkat, departemen, aktif, keterangan, urutan, tanggal_ttd, ts) values ('$tingkat', '$departemen', '$aktif', '$keterangan', '$urutan', '$tanggal_ttd', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert kelas
	function insert_kelas(){
		$dbpdo = DB::create();
		
		try {
			
			$idtahunajaran		=	$_POST["idtahunajaran"];
			$idtingkat			=	$_POST["idtingkat"];
			$kelas				=	$_POST["kelas"];
			$kapasitas			=	$_POST["kapasitas"];
			$nipwali			=	$_POST["nipwali"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);;			
			$dlu				=	date("Y-m-d H:i:s");
			
			include_once ("app/include/function_crop.php");
			//------------start upload ttd
	  		$ttd_file_hd		= 	$_POST['ttd_file_hd'];
	  		$ttd_file_hd1 		= 	resize_image('ttd_file_hd', 'file_ttd/', 'app/file_ttd/', 'file_ttd/', $ttd_file_hd);
	  		$ttd_file_hd_a 		= 	$ttd_file_hd1;
			
			$sqlstr = "insert into kelas (idtahunajaran, idtingkat, kelas, kapasitas, nipwali, aktif, keterangan, ttd_file_hd, ts) values ('$idtahunajaran', '$idtingkat', '$kelas', '$kapasitas', '$nipwali', '$aktif', '$keterangan', '$ttd_file_hd_a', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			##detail (PA)
			$sqlstr='select last_insert_id() replid';
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data=$sql->fetch(PDO::FETCH_OBJ);			
			$replid = $data->replid;
			
			$idtahunajaran_det		=	$_POST["idtahunajaran_det"];
			$nipwali_det			=	$_POST["nipwali_det"];
			
			if(!empty($idtahunajaran_det) && !empty($nipwali_det)) {
				
				//------------start upload ttd
		  		$line = maxline('kelas_detail', 'line', 'replid', $replid, '');
		  		
		  		$ttd_file			= 	$_POST['ttd_file'];
		  		$ttd_file1 			= 	resize_image('ttd_file', 'file_ttd/', 'app/file_ttd/', 'file_ttd/', $replid."_".$ttd_file.$line);
		  		$ttd_file_a 		= 	$ttd_file1;
		  		
				$sqlstr = "insert into kelas_detail (replid, idtahunajaran, nipwali, ttd_file, line) values ('$replid', '$idtahunajaran_det', '$nipwali_det', '$ttd_file_a', '$line')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();	
			}
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert tahun ajaran
	function insert_tahunajaran(){
		$dbpdo = DB::create();
		
		try {
			
			$tahunajaran		=	$_POST["tahunajaran"];
			$tglmulai			=	date("Y-m-d", strtotime($_POST["tglmulai"]));
			$tglakhir			=	date("Y-m-d", strtotime($_POST["tglakhir"]));
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$departemen			=	$_POST['departemen'];
			$info1				=	$_POST["info1"];			
			$dlu				=	date("Y-m-d H:i:s");
			
			include_once ("app/include/function_crop.php");
			//------------start upload ttd
	  		$ttd_file		= 	$_POST['ttd_file'];
	  		$ttd_file1 		= 	resize_image('ttd_file', 'file_ttd/', 'app/file_ttd/', 'file_ttd/', 'ta_'.$ttd_file);
	  		$ttd_file_a 	= 	$ttd_file1;
	  		
			/*non aktifkan tahunajaran yg sebelumnya*/
			/*$sqlstr = "update tahunajaran set aktif=0 where departemen='$departemen'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();*/
			
			$sqlstr = "insert into tahunajaran (tahunajaran, departemen, tglmulai, tglakhir, aktif, info1, info3, keterangan, ts) values ('$tahunajaran', '$departemen', '$tglmulai', '$tglakhir', '$aktif', '$info1', '$ttd_file_a', '$keterangan', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert agama
	function insert_agama(){
		$dbpdo = DB::create();
		
		try {
			
			$agama				=	$_POST["agama"];
			$urutan				=	(empty($_POST["urutan"])) ? 0 : $_POST["urutan"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into agama (agama, urutan, ts) values ('$agama', '$urutan', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert tahun buku
	function insert_tahunbuku(){
		$dbpdo = DB::create();
		
		try {
			
			$tahunbuku			=	$_POST["tahunbuku"];
			$awalan				=	$_POST["awalan"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$departemen		=	$_POST["departemen"];
			$tanggalmulai		=	date("Y-m-d", strtotime($_POST['tanggalmulai']));
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into tahunbuku (tahunbuku, awalan, aktif, keterangan, departemen, tanggalmulai, info1, info2, info3, ts) values ('$tahunbuku', '$awalan', '$aktif', '$keterangan', '$departemen', '$tanggalmulai', '', '', '', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert rekakun
	function insert_rekakun($kode){
		$dbpdo = DB::create();
		
		try {
			
			$kategori			=	$_POST["kategori"];
			$nama				=	$_POST["nama"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into rekakun (kode, kategori, nama, keterangan, ts) values ('$kode', '$kategori', '$nama', '$keterangan', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert datapenerimaan
	function insert_datapenerimaan(){
		$dbpdo = DB::create();
		
		try {
			
			$idkategori			=	$_POST["idkategori"];
			$departemen			=	$_POST["departemen"];
			$nama				=	$_POST["nama"];
			$rekkas				=	$_POST["rekkas"];
			$rekpendapatan		=	$_POST["rekpendapatan"];
			$rekpiutang			=	$_POST["rekpiutang"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$nourut				=	numberreplace($_POST["nourut"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$full				=	(empty($_POST["full"])) ? 0 : $_POST["full"];
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into datapenerimaan (idkategori, departemen, nama, rekkas, rekpendapatan, rekpiutang, keterangan, nourut, aktif, full, ts) values ('$idkategori', '$departemen', '$nama', '$rekkas', '$rekpendapatan', '$rekpiutang', '$keterangan', '$nourut', '$aktif', '$full', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert datapengeluaran
	function insert_datapengeluaran(){
		$dbpdo = DB::create();
		
		try {
			
			$departemen			=	$_POST["departemen"];
			$nama				=	$_POST["nama"];
			$rekdebet			=	$_POST["rekdebet"];
			$rekkredit			=	$_POST["rekkredit"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into datapengeluaran (departemen, nama, rekdebet, rekkredit, keterangan, aktif, ts) values ('$departemen', '$nama', '$rekdebet', '$rekkredit', '$keterangan', '$aktif', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert besarjtt
	function insert_besarjtt($semua=0){
		$dbpdo = DB::create();
		
		try {
			
			$departemen			=	$_POST["departemen"];
			$idangkatan			=	$_POST["idangkatan"];
			$idpenerimaan		=	$_POST["idpenerimaan"];
			$idtingkat			=	$_POST["idtingkat"];
			$idkelas			=	$_POST["idkelas"];
			$besar				=	numberreplace($_POST["besar"]);
			$cicilan			=	numberreplace($_POST["cicilan"]);
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			$uid				=	$_SESSION["loginname"];
			//$tahunbuku			=	$_SESSION["tahunbuku"];
			$potongan			=	numberreplace($_POST["potongan"]);
			
			$sqltb = "select replid from tahunbuku where departemen='$departemen' order by tanggalmulai desc limit 1";
			$query = $dbpdo->prepare($sqltb);
			$query->execute();
			$datatb = $query->fetch(PDO::FETCH_OBJ);
			$tahunbuku = $datatb->replid;
				
			if($semua == 1) {
				$sqlstr2 = "select a.replid, a.nis from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid where c.departemen='$departemen' and b.idtingkat='$idtingkat' and a.idkelas='$idkelas'"; //and a.idangkatan='$idangkatan' ";
				//echo $sqlstr2;
				//and a.idkelas='$idkelas' 
				$sql2=$dbpdo->query($sqlstr2);
				while ($data_view=$sql2->fetch(PDO::FETCH_OBJ)) {
					$nis	=	$data_view->nis;
					
					$strcek = "select nis from besarjtt where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku' ";
					$sqlcek=$dbpdo->query($strcek);
					$datacheck = $sqlcek->rowCount();
					if($datacheck == 0) {
						$sqlstr = "insert into besarjtt (nis, idpenerimaan, besar, cicilan, keterangan, pengguna, info2, ts, potongan) values ('$nis', '$idpenerimaan', '$besar', '$cicilan', '$keterangan', '$uid', '$tahunbuku', '$ts', '$potongan')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
				}
				
			} else {
				$nis	=	$_POST["nis"];				
				
				$sqlstr = "insert into besarjtt (nis, idpenerimaan, besar, cicilan, keterangan, pengguna, info2, ts, potongan) values ('$nis', '$idpenerimaan', '$besar', '$cicilan', '$keterangan', '$uid', '$tahunbuku', '$ts', '$potongan')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert perpustakaan
	function insert_perpustakaan(){
		$dbpdo = DB::create();
		
		try {
			
			$departemen			=	$_POST["departemen"];
			$nama				=	$_POST["nama"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into perpustakaan (nama, keterangan, ts) values ('$nama', '$keterangan', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//----update perpustakaan identitas
			$strcek = "select perpustakaan from identitas where departemen='$departemen' ";
			$sqlcek=$dbpdo->query($strcek);
			$datacheck = $sqlcek->rowCount();
			if($datacheck > 0) {
				$sqlstr = "update identitas set perpustakaan='$nama' where departemen='$departemen' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert format
	function insert_format(){
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	$_POST["kode"];
			$nama				=	$_POST["nama"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into format (kode, nama, keterangan, ts) values ('$kode', '$nama', '$keterangan', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert rak
	function insert_rak(){
		$dbpdo = DB::create();
		
		try {
			
			$rak				=	$_POST["rak"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into rak (rak, keterangan, ts) values ('$rak', '$keterangan', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert katalog
	function insert_katalog(){
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	$_POST["kode"];
			$nama				=	petikreplace($_POST["nama"]);
			$rak				=	(empty($_POST["rak"])) ? 0 : $_POST["rak"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into katalog (kode, nama, rak, keterangan, ts) values ('$kode', '$nama', '$rak', '$keterangan', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert penerbit
	function insert_penerbit(){
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	$_POST["kode"];
			$nama				=	petikreplace($_POST["nama"]);
			$alamat				=	petikreplace($_POST["alamat"]);
			$telpon				=	$_POST["telpon"];
			$email				=	$_POST["email"];
			$fax				=	$_POST["fax"];
			$website			=	$_POST["website"];
			$kontak				=	$_POST["kontak"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into penerbit (kode, nama, alamat, telpon, email, fax, website, kontak, keterangan, ts) values ('$kode', '$nama', '$alamat', '$telpon', '$email', '$fax', '$website', '$kontak', '$keterangan', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert penulis
	function insert_penulis(){
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	$_POST["kode"];
			$gelardepan			=	$_POST["gelardepan"];
			$nama				=	petikreplace($_POST["nama"]);
			$gelarbelakang		=	$_POST["gelarbelakang"];
			$kontak				=	$_POST["kontak"];
			$biografi			=	petikreplace($_POST["biografi"]);
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into penulis (kode, gelardepan, nama, gelarbelakang, kontak, biografi, keterangan, ts) values ('$kode', '$gelardepan', '$nama', '$gelarbelakang', '$kontak', '$biografi', '$keterangan', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pustaka
	function insert_pustaka(){
		$dbpdo = DB::create();
		
		try {
			
			$judul				=	petikreplace($_POST["judul"]);
			$abstraksi			=	petikreplace($_POST["abstraksi"]);
			$keyword			=	petikreplace($_POST["keyword_"]);
			$tahun				=	numberreplace($_POST["tahun"]);
			$keteranganfisik	=	petikreplace($_POST["keteranganfisik"]);
			$penulis			=	(empty($_POST["penulis"])) ? 0 : $_POST["penulis"];
			$penerbit			=	(empty($_POST["penerbit"])) ? 0 : $_POST["penerbit"];
			$format				=	(empty($_POST["format"])) ? 0 : $_POST["format"];
			$katalog			=	(empty($_POST["katalog"])) ? 0 : $_POST["katalog"];
			$kodepustaka_crt	=	$_POST["kodepustaka"];
			
			//-----------upload file foto
			$uploaddir = 'app/file_foto_pustaka/';
			$photo = $_FILES['photo']['name']; 
			$tmpname  = $_FILES['photo']['tmp_name'];
			$filesize = $_FILES['photo']['size'];
			$filetype = $_FILES['photo']['type'];

			
			if($photo != "") {			
				$photo = $format . '_' . $photo;					
				$uploadfile = $uploaddir . $photo;		
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$harga				=	numberreplace($_POST["harga"]);
			$jumlah				=	numberreplace($_POST["jumlah"]);
			$departemen			=	$_POST["departemen"];
			$tanggal_masuk		=	date("Y-m-d", strtotime($_POST["tanggal_masuk"]));
			$keterangan_pustaka	=	$_POST["keterangan_pustaka"];
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pustaka (judul, abstraksi, keyword, tahun, keteranganfisik, penulis, penerbit, format, katalog, photo, keterangan, harga, info1, info2, info3, departemen, tanggal_masuk, keterangan_pustaka, ts) values ('$judul', '$abstraksi', '$keyword', '$tahun', '$keteranganfisik', '$penulis', '$penerbit', '$format', '$katalog', '$photo', '$keterangan', '$harga', '', '', '', '$departemen', '$tanggal_masuk', '$keterangan_pustaka', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$sqlstr 	= "select last_insert_id() lastid";
			$sqllast	= $dbpdo->query($sqlstr);
			$datalast	= $sqllast->fetch(PDO::FETCH_OBJ);
			$lastid		= $datalast->lastid;
			
			/*--------insert jumlah--------*/
			$sqlstr 	= 	"select counter from katalog where replid='$katalog'";
			$sqlcek		=	$dbpdo->query($sqlstr);
			$data		=	$sqlcek->fetch(PDO::FETCH_OBJ);
			$counter 	= 	$data->counter;
		
			$replid		=	1;
			
			if($kodepustaka_crt == "" && $jumlah > 1) {
				
				for($n=1; $n<=$jumlah; $n++) {
					$counter++;
					$sqlstr = "update katalog set counter=$counter where replid='$katalog'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					$kodepustaka = GenKodePustaka($katalog,$penulis,$judul,$format,$counter);
					$sqlstr = "insert into daftarpustaka (pustaka, perpustakaan, kodepustaka) values ('$lastid', '$replid', '$kodepustaka')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
				
			} else {
				
				$sqlstr = "update katalog set counter=ifnull(counter,0) + $counter where replid='$katalog'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				$kodepustaka = $kodepustaka_crt; //GenKodePustaka($katalog,$penulis,$judul,$format,$counter);
				$sqlstr = "insert into daftarpustaka (pustaka, perpustakaan, kodepustaka) values ('$lastid', '$replid', '$kodepustaka')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
			
			//----------insert pustaka supplier
			$pustaka_id = $lastid;
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];		
			for ($x=0; $x<=$jmldata; $x++) {
				$supplier_id	=	$_POST[supplier_id_.$x];
				
				if ( !empty($supplier_id) ) {
					$sqlstr = "insert into pustaka_supplier (pustaka_id, supplier_id) values ('$pustaka_id', '$supplier_id')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert daftarpustaka
	function insert_daftarpustaka(){
		$dbpdo = DB::create();
		
		try {
			
			$pustaka			=	$_POST["pustaka"];
			$perpustakaan		=	1;
			$kodepustaka		=	$_POST["kodepustaka"];
			$status				=	(empty($_POST["status"])) ? 0 : $_POST["status"];
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into daftarpustaka (pustaka, perpustakaan, kodepustaka, status, ts) values ('$pustaka', '$perpustakaan', '$kodepustaka', '$status', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$sql=$dbpdo->query("select katalog from pustaka where replid='$pustaka' ");
			$data=$sql->fetch(PDO::FETCH_OBJ);
			$foto_file = $data->photo;
			$katalog = $data->katalog;
			
			$sqlstr = "select count(replid) mcount from daftarpustaka where pustaka='$pustaka'";
			$sqlcek = $dbpdo->prepare($sqlstr);
			$sqlcek->execute();
			$rowdata = $sqlcek->fetch(PDO::FETCH_OBJ);
			$jum = $rowdata->mcount;
			
			$sqlstr = "update katalog set counter=$jum where replid='$katalog'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pinjam
	function insert_pinjam(){
		$dbpdo = DB::create();
		
		try {
			
			$tglditerima	=	date("Y-m-d");
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];		
			for ($x=0; $x<=$jmldata; $x++) {
				
				$replid 	 = $_POST['replid_'.$x.''];
				$kodepustaka = $_POST['kodepustaka_'.$x.''];
				
				if ( !empty($kodepustaka) ) {
					$sqlstr = "update pinjam set status=1, tglditerima='$tglditerima', petugaspinjam='$uid', ts='$dlu' where replid='$replid'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					$sqlstr = "update daftarpustaka set status=0 where kodepustaka='$kodepustaka'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pinjam detail
	function insert_pinjam_detail($idanggota){
		$dbpdo = DB::create();
		
		try {
			
			$kodepustaka		=	$_POST["kodepustaka"];
			$tglpinjam			=	date("Y-m-d", strtotime($_POST["tglpinjam"]));
			$tglkembali			=	date("Y-m-d", strtotime($_POST["tglkembali"]));
			$keterangan			=	$_POST["keterangan"];
			$departemen			=	$_POST["departemen"];
			$jenis_anggota		=	$_POST["jenis_anggota"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pinjam (kodepustaka, tglpinjam, tglkembali, idanggota, keterangan, status, tglditerima, departemen, jenis_anggota, petugaspinjam, ts) values ('$kodepustaka', '$tglpinjam', '$tglkembali', '$idanggota', '$keterangan', 0, '0000-00-00', '$departemen', '$jenis_anggota', '$uid', '$dlu')";
            $sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert pinjam batal
	function insert_pinjam_batal(){
		$dbpdo = DB::create();
		
		try {
			
			$tglditerima	=	date("Y-m-d");
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];		
			for ($x=0; $x<=$jmldata; $x++) {
				
				$replid 	 = $_POST[replid_.$x];
				$kodepustaka = $_POST[kodepustaka_.$x];
				
				$sqlstr = "delete from pinjam where replid='$replid'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
					
			}
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert kembali
	function insert_kembali($ref){
		$dbpdo = DB::create();
		
		try {
			
			$kodepustaka	=	$_POST["kodepustaka"];
			$tglditerima	=	date("Y-m-d");
			$keterangan		=	$_POST["keterangan"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pinjam set status=2, tglditerima='$tglditerima', keterangan='$keterangan', petugaskembali='$uid', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$sqlstr = "update daftarpustaka set status=1 where kodepustaka='$kodepustaka'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$telat			=	$_POST["terlambat"];
			$denda			=	numberreplace($_POST["denda"]);
			$idpinjam		=	$ref;
			if($denda != 0){
				$sqlstr = "insert into denda(idpinjam, denda, telat, keterangan, ts) values('$idpinjam', '$denda', '$telat', '$keterangan', '$dlu')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert konfigurasi
	function insert_konfigurasi(){
		$dbpdo = DB::create();
		
		try {
			
			$siswa				=	numberreplace($_POST["siswa"]);
			$pegawai			=	numberreplace($_POST["pegawai"]);
			$other				=	numberreplace($_POST["other"]);
			$denda				=	numberreplace($_POST["denda"]);
			
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into konfigurasi (siswa, pegawai, other, denda, ts) values ('$siswa', '$pegawai', '$other', '$denda', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert kenaikan kelas
	function insert_kenaikan($idkelas, $idkelas2){
		$dbpdo = DB::create();
		
		try {
			
			$idangkatan2 = $_POST["idangkatan2"];
			$mulai	=	date("Y-m-d");
			$ts		=	date("Y-m-d H:i:s");
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];	
			
			for ($x=0; $x<=$jmldata; $x++) {
				$naik 	 	= $_POST[naik_.$x];
				$nis 	 	= $_POST[nis_.$x];
				$keterangan = $_POST[keterangan_.$x];
				
				if($naik > 0 && $nis != "") {
					
					//get kelas awal
					if($idkelas == "") {
						$strsql = "select a.idkelas from siswa a where a.nis='$nis'";
						$sqlkelas=$dbpdo->prepare($strsql);
						$sqlkelas->execute();
						$data_kelas = $sqlkelas->fetch(PDO::FETCH_OBJ);
						$idkelas = $data_kelas->idkelas;
					}
					//-----------/\--------------
					
					
					//----update siswa kelas baru
					$sql_naik="update siswa set idkelas='$idkelas2', idangkatan='$idangkatan2' where nis='$nis'";
					$sql=$dbpdo->prepare($sql_naik);
					$sql->execute();
					
					//-----insert riwayat sebelumnya siswa
					$sqlcek = "select nis from riwayatkelassiswa where nis='$nis' and idkelas='$idkelas'";
					$sql=$dbpdo->prepare($sqlcek);
					$sql->execute();
					$rows = $sql->rowCount();
					
					if($rows == 0) {
						$sqlstr = "insert into riwayatkelassiswa (nis, idkelas, mulai, aktif, status, keterangan, ts) values ('$nis', '$idkelas', '$mulai', 0, 0, '$keterangan', '$ts')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
					
					//-----non aktifkan riwayata siswa sebelumnya
					$sqlstr="update riwayatkelassiswa set aktif=0 where nis='$nis' and idkelas='$idkelas'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					//---------------------------------------------/\----------------------------------
					
					//-----insert riwayat siswa
					$sqlcek = "select nis from riwayatkelassiswa where nis='$nis' and aktif=1";
					$sql=$dbpdo->prepare($sqlcek);
					$sql->execute();
					$rows = $sql->rowCount();
					
					if($rows == 0) {
						$sqlstr = "insert into riwayatkelassiswa (nis, idkelas, mulai, aktif, status, keterangan, ts) values ('$nis', '$idkelas2', '$mulai', 1, 1, '$keterangan', '$ts')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
						
				}
					
			}
						
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert penempatan kelas
	function insert_penempatan(){
		$dbpdo = DB::create();
		
		try {
			
			$idkelas		=	$_POST["idkelas"];			
			$idangkatan1	=	$_POST["idangkatan1"];
			$idangkatan		=	$_POST["idangkatan"];
			$ts				=	date("Y-m-d H:i:s");
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];	
			
			/*for ($x=0; $x<=$jmldata; $x++) {
				
				$nopendaftaran 	= $_POST[nopendaftaran_.$x];
				$proses  	= $_POST[proses_.$x];
				$nis 	 	= $_POST[nis_.$x];
				$keterangan = $_POST[keterangan_.$x];
				
				if($proses > 0 ) {*/
					
					//162 / 10 kelas = 16
					//16 / 3-------->prestasi=3; laki2=9; perempuan=4					
					$sqlstr = "select replid, nama from penempatan_siswa_prioritas where aktif=1 order by urutan";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					while($dataprioritas = $sql->fetch(PDO::FETCH_OBJ)) {
						
						$sqlstr = "select replid from kelas where idtingkat=27 order by replid";
						$sql2=$dbpdo->prepare($sqlstr);
						$sql2->execute();
						while($data_kelas=$sql2->fetch(PDO::FETCH_OBJ)) {			
							
							//jalur prestasi			
							$sqlstr = "select replid from siswa where ifnull(idkelas,0)=0 and ifnull(alumni,0)=0 and jalurmasuk_id=1 order by replid limit 3 ";
							$sql1=$dbpdo->prepare($sqlstr);
							$sql1->execute();
							while($data_siswa=$sql1->fetch(PDO::FETCH_OBJ)) {
								//update siswa (pengkelasan)
								$sqlstr = "update siswa set idkelas='$data_kelas->replid' where replid='$data_siswa->replid'";
								$sql3=$dbpdo->prepare($sqlstr);
								$sql3->execute();
							}
							
							//jalur gender (laki-laki)		
							$sqlstr = "select replid from siswa where ifnull(idkelas,0)=0 and ifnull(alumni,0)=0 and kelamin='L' order by replid limit 9";
							$sql1=$dbpdo->prepare($sqlstr);
							$sql1->execute();
							while($data_siswa=$sql1->fetch(PDO::FETCH_OBJ)) {
								//update siswa (pengkelasan)
								$sqlstr = "update siswa set idkelas='$data_kelas->replid' where replid='$data_siswa->replid'";
								$sql3=$dbpdo->prepare($sqlstr);
								$sql3->execute();
							}
							
							//jalur gender (Perempuan)		
							$sqlstr = "select replid from siswa where ifnull(idkelas,0)=0 and ifnull(alumni,0)=0 and kelamin='P' order by replid limit 9";
							$sql1=$dbpdo->prepare($sqlstr);
							$sql1->execute();
							while($data_siswa=$sql1->fetch(PDO::FETCH_OBJ)) {
								//update siswa (pengkelasan)
								$sqlstr = "update siswa set idkelas='$data_kelas->replid' where replid='$data_siswa->replid'";
								$sql3=$dbpdo->prepare($sqlstr);
								$sql3->execute();
							}
							
						}
						
						
					}
					
					
					/*
					
					$sqlstr = "select replid from siswa where ifnull(idkelas,0)=0 and ifnull(alumni,0)=0 and kelamin='P'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rows1=$sql->rowCount();
					
					
					$sqlstr = "select replid from siswa where ifnull(idkelas,0)=0 and ifnull(alumni,0)=0 and kelamin='P'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rows1=$sql->rowCount();
					
					*/
					//$datacalon = $sql->fetch(PDO::FETCH_OBJ);
					
					/*$sqlstr	=	"select a.replid, a.idproses, a.idkelompok, a.tanggal, a.nopendaftaran, a.idtingkat, a.idjurusan, a.idminat, a.idminat1, a.foto_file, a.nama, a.panggilan, a.kelamin, a.nisn, a.nis, a.noijazah, a.tahunijazah, a.skhun, a.tahunskhun, a.noujian, a.nik, a.tmplahir, a.tgllahir, a.agama, a.kebutuhan_khusus, a.tahunmasuk, a.alamatsiswa, a.dusun, a.rt, a.rw, a.kelurahan, a.kodepossiswa, a.kecamatan, a.kabupaten, a.provinsi, a.transportasi, a.transportasi_kode, a.citacita, a.citacita_lain, a.idjenis_tinggal, a.jenis_tinggal, a.telponsiswa, a.hpsiswa, a.emailsiswa, a.kps, a.nokps, a.nokip, a.nokks, a.namaayah, a.tahunayah, a.alamatortu, a.kodeposortu, a.hportu, a.butuhkhususayah, a.butuhkhususketayah, a.pekerjaanayah, a.pekerjaanayah_lain, a.pendidikanayah, a.penghasilanayah, a.penghasilanayah_kode, a.namaibu, a.tahunibu, a.butuhkhususibu, a.butuhkhususketibu, a.pekerjaanibu, a.pekerjaanibu_lain, a.pendidikanibu, a.penghasilanibu, a.penghasilanibu_kode, a.wali, a.tahunwali, a.pekerjaanwali, a.pekerjaanwali_lain, a.pendidikanwali, a.penghasilanwali, a.tinggi, a.berat, a.jaraksekolah, a.jarak_km, a.waktutempuh, a.waktutempuh_menit, a.jsaudara, a.uid, a.dlu, a.darah, a.file_darah, a.almayah, a.almibu, a.alamatibu, a.kodeposibu, a.hpibu from calonsiswa a where a.nopendaftaran='$nopendaftaran' order by a.replid ";	
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$datacalon = $sql->fetch(PDO::FETCH_OBJ);
					
					$replid			=   $datacalon->replid;
					$nisn			=	$datacalon->nisn;
					//$idangkatan		=	$datacalon->idproses;
					$foto_file		=   $datacalon->foto_file;
					$nama			=   $datacalon->nama;
					$panggilan		=	$datacalon->panggilan;
					$kelamin		=   $datacalon->kelamin;
					$tmplahir		=   $datacalon->tmplahir;
					$tgllahir		=   $datacalon->tgllahir;
					$agama			=   $datacalon->agama;
					$jsaudara		=   $datacalon->jsaudara;
					$alamatsiswa	=   $datacalon->alamatsiswa;
					$emailsiswa		=	$datacalon->emailsiswa;
					$alamatortu		=   $datacalon->alamatortu;
					$telponsiswa	=   $datacalon->telponsiswa;
					$hpsiswa		=   $datacalon->hpsiswa;
					$hportu			=   $datacalon->hportu;
					$hpibu			=   $datacalon->hpibu;
					$jaraksekolah	=   $datacalon->jaraksekolah;
					$berat			=   $datacalon->berat;
					$tinggi			=   $datacalon->tinggi;
					$darah			=   $datacalon->darah;
					$file_darah		=   $datacalon->file_darah;
					$noijazah		=   $datacalon->noijazah;
					$skhun			=   $datacalon->skhun;
					$noujian		=   $datacalon->noujian;
					$namaayah		=   $datacalon->namaayah;
					$namaibu		=   $datacalon->namaibu;
					$pekerjaanayah	=   $datacalon->pekerjaanayah;
					$pekerjaanibu	=   $datacalon->pekerjaanibu;
					$penghasilanayah=   $datacalon->penghasilanayah;
					$penghasilanibu	=   $datacalon->penghasilanibu;
					$pendidikanayah	=   $datacalon->pendidikanayah;
					$pendidikanibu	=   $datacalon->pendidikanibu;
					$wali			=   $datacalon->wali;
					$pendidikanwali	=   $datacalon->pendidikanwali;
					$pekerjaanwali	=   $datacalon->pekerjaanwali;
					$penghasilanwali=   $datacalon->penghasilanwali;
					$pekerjaanayah_lain	=   $datacalon->pekerjaanayah_lain;
					$pekerjaanibu_lain	=   $datacalon->pekerjaanibu_lain;
					$pekerjaanwali_lain	=	$datacalon->pekerjaanwali_lain;
					
					$warga			=	0;
					$aktif			=	1;
					$tahunmasuk		=	date("Y");
					$status			=	"Reguler";*/
					
					/*$sqlstr = "insert into siswa (nis, nisn, idangkatan, idangkatan1, foto_file, nama, panggilan, tahunmasuk, idkelas, kelamin, tmplahir, tgllahir, agama, status, warga, anakke, jsaudara, jtiri, jangkat, yatim, bahasa, alamatsiswa, alamatortu, telponsiswa, hpsiswa, emailsiswa, telponortu, hportu, hpibu, jaraksekolah, kesekolah, berat, tinggi, kesehatan, darah, file_darah, kelainan, asalsekolah_id, tglijazah, noijazah, tglskhun, skhun, noujian, nisnasal, namaayah, namaibu, tmplahirayah, tgllahirayah, tmplahiribu, tgllahiribu, pekerjaanayah, pekerjaanibu, penghasilanayah, penghasilanibu, pendidikanayah, pendidikanibu, wnayah, wnibu, wali, tmplahirwali, tgllahirwali, pendidikanwali, pekerjaanwali, penghasilanwali, alamatwali, hpwali, hubungansiswa, pekerjaanayah_lain, pekerjaanibu_lain, pekerjaanwali_lain, keterangan, aktif, uid, ts) values ('$nis', '$nisn', '$idangkatan', '$idangkatan1', '$foto_file', '$nama', '$panggilan', '$tahunmasuk', '$idkelas', '$kelamin', '$tmplahir', '$tgllahir', '$agama', '$status', '$warga', '$anakke', '$jsaudara', '$jtiri', '$jangkat', '$yatim', '$bahasa', '$alamatsiswa', '$alamatortu', '$telponsiswa', '$hpsiswa', '$emailsiswa', '$telponortu', '$hportu', '$hpibu', '$jaraksekolah', '$kesekolah', '$berat', '$tinggi', '$kesehatan', '$darah', '$file_darah', '$kelainan', '$asalsekolah_id', '$tglijazah', '$noijazah', '$tglskhun', '$skhun', '$noujian', '$nisnasal', '$namaayah', '$namaibu', '$tmplahirayah', '$tgllahirayah', '$tmplahiribu', '$tgllahiribu', '$pekerjaanayah', '$pekerjaanibu', '$penghasilanayah', '$penghasilanibu', '$pendidikanayah', '$pendidikanibu', '$wnayah', '$wnibu', '$wali', '$tmplahirwali', '$tgllahirwali', '$pendidikanwali', '$pekerjaanwali', '$penghasilanwali', '$alamatwali', '$hpwali', '$hubungansiswa', '$pekerjaanayah_lain', '$pekerjaanibu_lain', '$pekerjaanwali_lain', '$keterangan', '$aktif', '$uid', '$ts')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//-------get last ID
					$sqlstr 		= 	"select last_insert_id() last_id";
					$results		=	$dbpdo->query($sqlstr);
					$data 			=  	$results->fetch(PDO::FETCH_OBJ);
					$idsiswa		=	$data->last_id;
			
					$sqlstr = "update calonsiswa set replidsiswa = '$idsiswa' where replid = '$replid'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//------insert riwayatkelas
					$mulai	=	date("Y-m-d");
					$sqlstr = "insert into riwayatkelassiswa(nis, idkelas, mulai, aktif, status) values('$nis', '$idkelas', '$mulai', 1, 0)"; 
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();*/
					
						
				/*}
					
			}*/
						
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pindah kelas
	function insert_pindah_kelas($idkelas, $idkelas2){
		$dbpdo = DB::create();
		
		try {
			
			$idangkatan2 = $_POST["idangkatan2"];
			$mulai	=	date("Y-m-d");
			$ts		=	date("Y-m-d H:i:s");
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];	
			for ($x=0; $x<=$jmldata; $x++) {
				
				$pindah	 	= $_POST[pindah_.$x];
				$nis 	 	= $_POST[nis_.$x];
				$keterangan = $_POST[keterangan_.$x];
				
				if($pindah > 0 && $nis != "") {
					
					//get kelas awal
					if($idkelas == "") {
						$strsql = "select a.idkelas from siswa a where a.nis='$nis'";
						$sqlkelas=$dbpdo->prepare($strsql);
						$sqlkelas->execute();
						$data_kelas = $sqlkelas->fetch(PDO::FETCH_OBJ);
						$idkelas = $data_kelas->idkelas;
					}
					//-----------/\--------------
					
					
					//----update siswa kelas baru
					$sql_naik="update siswa set idkelas='$idkelas2', idangkatan='$idangkatan2' where nis='$nis'";
					$sql=$dbpdo->prepare($sql_naik);
					$sql->execute();
					
					//-----non aktifkan riwayata siswa sebelumnya
					$sqlstr="update riwayatkelassiswa set aktif=0 where nis='$nis' and idkelas='$idkelas'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//-----insert riwayat siswa
					$sqlcek = "select nis from riwayatkelassiswa where nis='$nis' and aktif=1";
					$sql=$dbpdo->prepare($sqlcek);
					$sql->execute();
					$rows = $sql->rowCount();
					
					if($rows == 0) {
						$sqlstr = "insert into riwayatkelassiswa (nis, idkelas, mulai, aktif, status, keterangan, ts) values ('$nis', '$idkelas2', '$mulai', 1, 4, '$keterangan', '$ts')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
						
				}
					
			}
						
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pegawai
	function insert_pegawai(){
		$dbpdo = DB::create();
		
		try {
			
			$bagian				=	$_POST["bagian"];
			$bagian				= 	str_replace("|"," ",$bagian);
			$nip				=	$_POST["nip"];
			$nama				=	petikreplace($_POST["nama"]);
			$panggilan			=	petikreplace($_POST["panggilan"]);
			$kelamin			=	$_POST["kelamin"];
			$gelar				=	$_POST["gelar"];
			$tmplahir			=	$_POST["tmplahir"];
			$tgllahir			=	date("Y-m-d", strtotime($_POST["tgllahir"]));
			$agama				=	$_POST["agama"];
			$suku				=	$_POST["suku"];
			$nikah				=	$_POST["nikah"];
            $jenis_id           =   $_POST["jenis_id"];
			$noid				=	$_POST["noid"];
			$alamat				=	petikreplace($_POST["alamat"]);
			$telpon				=	$_POST["telpon"];
			$handphone			=	$_POST["handphone"];
			$email				=	$_POST["email"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			$karpeg				=	$_POST["karpeg"];
			$no_sertifikasi		=	$_POST["no_sertifikasi"];
			$idjenis_sertifikasi=	(empty($_POST["idjenis_sertifikasi"])) ? 0 : $_POST["idjenis_sertifikasi"];
			$npwp				=	$_POST["npwp"];
			$nuptk				=	$_POST["nuptk"];
			$tmt_cpns			=	date("Y-m-d", strtotime($_POST["tmt_cpns"]));
			$unit_cpns			=	date("Y-m-d", strtotime($_POST["unit_cpns"]));
			$no_sk_masuk		=	$_POST["no_sk_masuk"];			
			$idstatus_pegawai	=	(empty($_POST["idstatus_pegawai"])) ? 0 : $_POST["idstatus_pegawai"];
			$nik				=	$_POST["nik"];
			$nama_ibu			=	$_POST["nama_ibu"];
			$nama_pasangan		=	$_POST["nama_pasangan"];
			$tempat_lahir_pasangan	=	$_POST["tempat_lahir_pasangan"];
			$tanggal_lahir_pasangan	=	date("Y-m-d", strtotime($_POST["tanggal_lahir_pasangan"]));
			$tanggal_nikah		=	date("Y-m-d", strtotime($_POST["tanggal_nikah"]));
			$tempat_nikah		=	$_POST["tempat_nikah"];
			$pekerjaan_pasangan	=	$_POST["pekerjaan_pasangan"];
			$instansi_pasangan	=	$_POST["instansi_pasangan"];
			$nip_pasangan		=	$_POST["nip_pasangan"];
			$keluarga_tanggungan	=	(empty($_POST["keluarga_tanggungan"])) ? 0 : $_POST["keluarga_tanggungan"];
			$usia				=	petikreplace($_POST["usia"]);
			$ajar_lain			=	$_POST["ajar_lain"];
			$jumlah_jam_ajar_lain	=	(empty($_POST["jumlah_jam_ajar_lain"])) ? 0 : $_POST["jumlah_jam_ajar_lain"];
			$nama_bank			=	$_POST["nama_bank"];
			$unit_bank			=	petikreplace($_POST["unit_bank"]);
			$no_rek				=	$_POST["no_rek"];
			$nama_pemilik		=	petikreplace($_POST["nama_pemilik"]);
			$desa				=	$_POST["desa"];
			$kecamatan			=	$_POST["kecamatan"];
			$kode_pos			=	$_POST["kode_pos"];
			$tanggal_pensiun	=	date("Y-m-d", strtotime($_POST["tanggal_pensiun"]));
			
			$no_sk_tetap		=	$_POST["no_sk_tetap"];
			$tanggal_sk_tetap	=	date("Y-m-d", strtotime($_POST["tanggal_sk_tetap"]));

			//-----------upload file foto
			$uploaddir = 'app/file_foto_pegawai/';
			$foto_file = $_FILES['foto_file']['name']; 
			$tmpname  = $_FILES['foto_file']['tmp_name'];
			$filesize = $_FILES['foto_file']['size'];
			$filetype = $_FILES['foto_file']['type'];

			
			if($foto_file != "") {			
				$foto_file = $nip . '_' . $foto_file;					
				$uploadfile = $uploaddir . $foto_file;		
				if (move_uploaded_file($_FILES['foto_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pegawai (bagian, nip, nama, panggilan, kelamin, gelar, tmplahir, tgllahir, agama, suku, nikah, jenis_id, noid, alamat, telpon, handphone, email, karpeg, no_sertifikasi, idjenis_sertifikasi, npwp, nuptk, tmt_cpns, unit_cpns, no_sk_masuk, idstatus_pegawai, nik, nama_ibu, nama_pasangan, tempat_lahir_pasangan, tanggal_lahir_pasangan, tanggal_nikah, tempat_nikah, pekerjaan_pasangan, instansi_pasangan, nip_pasangan, keluarga_tanggungan, usia, ajar_lain, jumlah_jam_ajar_lain, nama_bank, unit_bank, no_rek, nama_pemilik, desa, kecamatan, kode_pos, tanggal_pensiun, foto_file, keterangan, no_sk_tetap, tanggal_sk_tetap, ts) values ('$bagian', '$nip', '$nama', '$panggilan', '$kelamin', '$gelar', '$tmplahir', '$tgllahir', '$agama', '$suku', '$nikah', '$jenis_id', '$noid', '$alamat', '$telpon', '$handphone', '$email', '$karpeg', '$no_sertifikasi', '$idjenis_sertifikasi', '$npwp', '$nuptk', '$tmt_cpns', '$unit_cpns', '$no_sk_masuk', '$idstatus_pegawai', '$nik', '$nama_ibu', '$nama_pasangan', '$tempat_lahir_pasangan', '$tanggal_lahir_pasangan', '$tanggal_nikah', '$tempat_nikah', '$pekerjaan_pasangan', '$instansi_pasangan', '$nip_pasangan', '$keluarga_tanggungan', '$usia', '$ajar_lain', '$jumlah_jam_ajar_lain', '$nama_bank', '$unit_bank', '$no_rek', '$nama_pemilik', '$desa', '$kecamatan', '$kode_pos', '$tanggal_pensiun', '$foto_file', '$keterangan', '$no_sk_tetap', '$tanggal_sk_tetap', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//-------get last ID
			$sqlstr 		= 	"select last_insert_id() last_id";
			$results		=	$dbpdo->query($sqlstr);
			$data 			=  	$results->fetch(PDO::FETCH_OBJ);
			$idsiswa		=	$data->last_id;
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert status guru
	function insert_statusguru(){
		$dbpdo = DB::create();
		
		try {
			
			$status				=	numberreplace($_POST["status2"]);
			$keterangan			=	numberreplace($_POST["keterangan"]);
			
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into statusguru (status, keterangan, ts) values ('$status', '$keterangan', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert jabatan
	function insert_jabatan(){
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];			
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into jabatan (nama, aktif, uid, dlu) values ('$nama', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert jenis pelanggaran
	function insert_jenis_pelanggaran(){
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];
			$poin		=	numberreplace($_POST["poin"]);
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into jenis_pelanggaran (nama, poin, aktif, uid, dlu) values ('$nama', '$poin', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert jenis prestasi
	function insert_jenis_prestasi(){
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];
			$poin		=	numberreplace($_POST["poin"]);
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into jenis_prestasi (nama, poin, aktif, uid, dlu) values ('$nama', '$poin', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pelanggaran_siswa
	function insert_pelanggaran_siswa($ref){
		$dbpdo = DB::create();
		
		try {
			
			$idsiswa			=	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));
			$idjenis_pelanggaran=	(empty($_POST["idjenis_pelanggaran"])) ? 0 : $_POST["idjenis_pelanggaran"];
			$kejadian			=	petikreplace($_POST["kejadian"]);
			$hukuman			=	petikreplace($_POST["hukuman"]);
			
			//-----------upload file foto
			$uploaddir = 'app/file_foto_pelanggaran/';
			$photo = $_FILES['photo']['name']; 
			$tmpname  = $_FILES['photo']['tmp_name'];
			$filesize = $_FILES['photo']['size'];
			$filetype = $_FILES['photo']['type'];

			
			if($photo != "") {			
				$photo = $ref . '_' . $photo;					
				$uploadfile = $uploaddir . $photo;		
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pelanggaran_siswa (ref, tanggal, idsiswa, idjenis_pelanggaran, kejadian, hukuman, photo, uid, dlu) values ('$ref', '$tanggal', '$idsiswa', '$idjenis_pelanggaran', '$kejadian', '$hukuman', '$photo', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert konseling_siswa
	function insert_konseling_siswa($ref){
		$dbpdo = DB::create();
		
		try {
			
			$idsiswa			=	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));
			$idjenis_konseling	=	(empty($_POST["idjenis_konseling"])) ? 0 : $_POST["idjenis_konseling"];
			$konseling			=	petikreplace($_POST["konseling"]);
			$solusi				=	petikreplace($_POST["solusi"]);
			$nip				=	$_POST["nip"];
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			##get nis siswa
			$sqlstr = "select nis from siswa where replid='$idsiswa'";
			$sql = $dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$nis = $data->nis;
			
			//-----------upload file data
			$uploaddir = 'app/file_konseling/';
			$data_file = $_FILES['data_file']['name']; 
			$tmpname  = $_FILES['data_file']['tmp_name'];
			$filesize = $_FILES['data_file']['size'];
			$filetype = $_FILES['data_file']['type'];

			
			if($data_file != "") {			
				$data_file = $ref . '_' . $nis . '_' . $data_file;					
				$uploadfile = $uploaddir . $data_file;		
				if (move_uploaded_file($_FILES['data_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			$sqlstr = "insert into konseling_siswa (ref, tanggal, idsiswa, idjenis_konseling, konseling, solusi, nip, data_file, uid, dlu) values ('$ref', '$tanggal', '$idsiswa', '$idjenis_konseling', '$konseling', '$solusi', '$nip', '$data_file', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert pegawai_jabatan
	function insert_pegawai_jabatan(){
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$idjabatan			=	(empty($_POST["idjabatan"])) ? 0 : $_POST["idjabatan"];
			$tanggal_efektif	=	date("Y-m-d", strtotime($_POST["tanggal_efektif"]));
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pegawai_jabatan (idpegawai, idjabatan, tanggal_efektif, keterangan, uid, dlu) values ('$idpegawai', '$idjabatan', '$tanggal_efektif', '$keterangan', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert jenis izin
	function insert_jenis_izin(){
		$dbpdo = DB::create();
		
		try {
			
			$nama		    =	$_POST["nama"];
			$keterangan	    =	petikreplace($_POST["keterangan"]);
            $format_surat	=	petikreplace($_POST["format_surat"]);
			$aktif		    =	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		    =	$_SESSION["loginname"];
			$dlu		    =	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into jenis_izin (nama, keterangan, format_surat, aktif, uid, dlu) values ('$nama', '$keterangan', '$format_surat', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
    
    
    //-----insert izin siswa
	function insert_izin_siswa($replid){
		$dbpdo = DB::create();
		
		try {
			
			$idsiswa	    =	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
            $jam            =   $_POST["jam"];
            $menit          =   $_POST["menit"];
            $jam            =   $jam . ":" . $menit;
            
            $tanggal        =   date("Y-m-d H:i", strtotime($_POST["tanggal"] . " " . $jam ));
            $idjenis_izin   =	(empty($_POST["idjenis_izin"])) ? 0 : $_POST["idjenis_izin"];            
            //$format_surat	=	petikreplace($_POST["format_surat"]);
			$keterangan	    =	petikreplace($_POST["keterangan"]);
            $idpegawai	    =	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$status		    =	$_POST["status"];
			$uid		    =	$_SESSION["loginname"];
			$dlu		    =	date("Y-m-d H:i:s");
			
            //---get siswa---
            $sqlsiswa     = "select a.nis, a.nama, b.kelas, c.tingkat from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid where a.replid='$idsiswa'";
            $sqlsiswa     = $dbpdo->prepare($sqlsiswa);
            $sqlsiswa->execute();
            $datasiswa    = $sqlsiswa->fetch(PDO::FETCH_OBJ); 
            $nis          = $datasiswa->nis;
            $nama         = $datasiswa->nama;
            $kelas        = $datasiswa->kelas;
            $tingkat      = $datasiswa->tingkat;
            //--------end-----------
            
            //---get data pegawai---
            $sqlpeg       = "select a.nip, a.nama from pegawai a where a.replid='$idpegawai'";
            $sqlpeg       = $dbpdo->prepare($sqlpeg);
            $sqlpeg->execute();
            $datapeg      = $sqlpeg->fetch(PDO::FETCH_OBJ); 
            $nip          = $datapeg->nip;
            $namapegawai  = $datapeg->nama;
            //--------end-----------
            
            //---get format surat---
            $sqljns     = "select format_surat from jenis_izin where replid='$idjenis_izin'";
            $sqljns     = $dbpdo->prepare($sqljns);
            $sqljns->execute();
            $datajns    = $sqljns->fetch(PDO::FETCH_OBJ); 
            
            $format_surat = petikreplace(str_replace("@nis", $nis ,$datajns->format_surat));
            $format_surat = petikreplace(str_replace("@nama", $nama ,$format_surat));
            $format_surat = petikreplace(str_replace("@tingkat", $tingkat ,$format_surat));
            $format_surat = petikreplace(str_replace("@kelas", $kelas ,$format_surat));
            
            $format_surat = petikreplace(str_replace("@nip", $nip ,$format_surat));
            $format_surat = petikreplace(str_replace("@pegawai", $namapegawai ,$format_surat));
            //--------end-----------
            
            
			$sqlstr = "insert into izin_siswa (idsiswa, tanggal, idjenis_izin, format_surat, keterangan, idpegawai, status, uid, dlu) values ('$idsiswa', '$tanggal', '$idjenis_izin', '$format_surat', '$keterangan', '$idpegawai', '$status', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
            
            //--get last_id
            $sqlstr 		= 	"select last_insert_id() last_id";
			$results		=	$dbpdo->query($sqlstr);
			$data 			=  	$results->fetch(PDO::FETCH_OBJ);
			$replid        	=	$data->last_id;
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		//return $sql;
        return $replid;
	}
    
	
	//-----insert pangkat
	function insert_pangkat(){
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pangkat (nama, aktif, uid, dlu) values ('$nama', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pegawai_pangkat
	function insert_pegawai_pangkat(){
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$idpangkat			=	(empty($_POST["idpangkat"])) ? 0 : $_POST["idpangkat"];
			$tanggal_efektif	=	date("Y-m-d", strtotime($_POST["tanggal_efektif"]));
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ruang				=	petikreplace($_POST["ruang"]);
			$sk					= 	$_POST["sk"];
			$no_sk				= 	$_POST["no_sk"];
			$gaji_pokok			= 	numberreplace($_POST["gaji_pokok"]);
			$tanggal_sk			=	date("Y-m-d", strtotime($_POST["tanggal_sk"]));
			$idjabatan			=	(empty($_POST["idjabatan"])) ? 0 : $_POST["idjabatan"];
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pegawai_pangkat (idpegawai, idpangkat, tanggal_efektif, sk, no_sk, gaji_pokok, tanggal_sk, idjabatan, keterangan, ruang, uid, dlu) values ('$idpegawai', '$idpangkat', '$tanggal_efektif', '$sk', '$no_sk', '$gaji_pokok', '$tanggal_sk', '$idjabatan', '$keterangan', '$ruang', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert jenis sertifikasi
	function insert_jenis_sertifikasi(){
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into jenis_sertifikasi (nama, aktif, uid, dlu) values ('$nama', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert status pegawai
	function insert_status_pegawai(){
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into status_pegawai (nama, aktif, uid, dlu) values ('$nama', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert kenaikan gaji berkala
	function insert_kenaikan_gaji(){
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$no_kgb				=	$_POST["no_kgb"];
			$gaji_pokok			=	numberreplace($_POST["gaji_pokok"]);			
			$tmt				=	date("Y-m-d", strtotime($_POST["tmt"]));
			$tanggal_kgb		=	date("Y-m-d", strtotime($_POST["tanggal_kgb"]));
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into kenaikan_gaji (idpegawai, no_kgb, tmt, tanggal_kgb, gaji_pokok, keterangan, uid, dlu) values ('$idpegawai', '$no_kgb', '$tmt', '$tanggal_kgb', '$gaji_pokok', '$keterangan', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pegawai pendidikan
	function insert_pegawai_pendidikan(){
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$nama_sekolah		=	petikreplace($_POST["nama_sekolah"]);
			$tahun				=	(empty($_POST["tahun"])) ? 0 : $_POST["tahun"];
			$jenjang			=	$_POST["jenjang"];
			$lulusan			=	$_POST["lulusan"];
			$jurusan			=	$_POST["jurusan"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pegawai_pendidikan (idpegawai, nama_sekolah, tahun, jenjang, lulusan, jurusan, keterangan, uid, dlu) values ('$idpegawai', '$nama_sekolah', '$tahun', '$jenjang', '$lulusan', '$jurusan', '$keterangan', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pegawai keluarga
	function insert_pegawai_keluarga(){
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$nama_anak			=	petikreplace($_POST["nama_anak"]);
			$tempat_lahir		=	petikreplace($_POST["tempat_lahir"]);
			$tanggal_lahir		=	date("Y-m-d", strtotime($_POST["tanggal_lahir"]));
			$pekerjaan			=	petikreplace($_POST["pekerjaan"]);
			$status				=	$_POST["status"];
			$anak_ke			=	(empty($_POST["anak_ke"])) ? 0 : $_POST["anak_ke"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pegawai_keluarga (idpegawai, nama_anak, tempat_lahir, tanggal_lahir, pekerjaan, status, anak_ke, keterangan, uid, dlu) values ('$idpegawai', '$nama_anak', '$tempat_lahir', '$tanggal_lahir', '$pekerjaan', '$status', '$anak_ke', '$keterangan', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert supplier
	function insert_supplier(){
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	random(9);
			$nama				=	petikreplace($_POST["nama"]);
			$alamat				=	petikreplace($_POST["alamat"]);
			$telepon			=	$_POST["telepon"];
			$hp					=	$_POST["hp"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into supplier (kode, nama, alamat, telepon, hp, aktif, uid, dlu) values ('$kode', '$nama', '$alamat', '$telepon', '$hp', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pegawai prestasi
	function insert_pegawai_prestasi(){
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$jenisprestasi		=	petikreplace($_POST["jenisprestasi"]);
			$tingkat			=	petikreplace($_POST["tingkat"]);
			$nama				=	petikreplace($_POST["nama"]);
			$tahun				=	(empty($_POST["tahun"])) ? 0 : $_POST["tahun"];
			$penyelenggara		=	petikreplace($_POST["penyelenggara"]);
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pegawai_prestasi (idpegawai, jenisprestasi, tingkat, nama, tahun, penyelenggara, uid, dlu) values ('$idpegawai', '$jenisprestasi', '$tingkat', '$nama', '$tahun', '$penyelenggara', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pegawai penghargaan
	function insert_pegawai_penghargaan(){
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$namapenghargaan	=	petikreplace($_POST["namapenghargaan"]);
			$tahun				=	(empty($_POST["tahun"])) ? 0 : $_POST["tahun"];
			$pemberipenghargaan	=	petikreplace($_POST["pemberipenghargaan"]);
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pegawai_penghargaan (idpegawai, namapenghargaan, tahun, pemberipenghargaan, uid, dlu) values ('$idpegawai', '$namapenghargaan', '$tahun', '$pemberipenghargaan', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pegawai skmengajar
	function insert_pegawai_skmengajar(){
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$no_sk				=	petikreplace($_POST["no_sk"]);
			$tahun				=	(empty($_POST["tahun"])) ? 0 : $_POST["tahun"];
			$fungsional			=	petikreplace($_POST["fungsional"]);
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pegawai_skmengajar (idpegawai, no_sk, tahun, fungsional, uid, dlu) values ('$idpegawai', '$no_sk', '$tahun', '$fungsional', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pelajaran
	function insert_pelajaran(){
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	$_POST["kode"];
			$nama				=	$_POST["nama"];
			$departemen			=	$_POST["departemen"];
			$sifat				=	(empty($_POST["sifat"])) ? 0 : $_POST["sifat"];
			$ekstra_sifat		=	(empty($_POST["ekstra_sifat"])) ? 0 : $_POST["ekstra_sifat"];
			$pegawai_id			=	(empty($_POST["pegawai_id"])) ? 0 : $_POST["pegawai_id"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$sks				=	(empty($_POST["sks"])) ? 0 : $_POST["sks"];
			$kkm_p				=	(empty($_POST["kkm_p"])) ? 0 : $_POST["kkm_p"];
			$kkm_k				=	(empty($_POST["kkm_k"])) ? 0 : $_POST["kkm_k"];
			$alias				=	(empty($_POST["alias"])) ? 0 : $_POST["alias"];
			$idpelajaran_alias	=	(empty($_POST["idpelajaran_alias"])) ? 0 : $_POST["idpelajaran_alias"];
			$minat				=	$_POST["minat"];
			$bentrok			=	(empty($_POST["bentrok"])) ? 0 : $_POST["bentrok"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pelajaran (kode, nama, departemen, sifat, ekstra_sifat, pegawai_id, aktif, keterangan, info1, info2, info3, alias, idpelajaran_alias, minat, bentrok, token, ts) values ('$kode', '$nama', '$departemen', '$sifat', '$ekstra_sifat', '$pegawai_id', '$aktif', '$keterangan', '$sks', '$kkm_p', '$uid', '$alias', '$idpelajaran_alias', '$minat', '$bentrok', '$kkm_k', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert siswa ekskul
	function insert_siswa_ekstrakurikuler(){
		$dbpdo = DB::create();
		
		try {
			
			$idtahunajaran	=	$_SESSION["idtahunajaran"];
			$idsemester		=	$_SESSION["semester_id"];
			
			$idsiswa		=	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			if($pelajaran_id != "") {
				
				$sqlstr = "select idsiswa from siswa_ekstrakurikuler where idsiswa='$idsiswa' and idtahunajaran='$idtahunajaran' and idpelajaran='$pelajaran_id' and idsemester='$idsemester' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$rows = $sql->rowCount();
				
				if($rows == 0) {
					##ekstrakurikuler wajib
					$wajib			=	$_POST["wajib"];
					$pelajaran_id	=	$wajib;
					$line = maxline('siswa_ekstrakurikuler', 'line', 'idsiswa', $idsiswa, '');			
					$sqlstr = "insert into siswa_ekstrakurikuler (idsiswa, idtahunajaran, idsemester, idpelajaran, tanggal, uid, dlu, line) values ('$idsiswa', '$idtahunajaran', '$idsemester', '$pelajaran_id', '$tanggal', '$uid', '$dlu', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			##ekstrakurikuler pilihan
			$jmldata		=	(empty($_POST["jmldata"])) ? 0 : $_POST["jmldata"];
			$k=0;
			for($k=0; $k<$jmldata; $k++) {
				$pelajaran_id	=	$_POST[pelajaran_id_.$k];
				$pilih			=	$_POST[pilih_.$k];
				if($pilih == 1) {
					$line = maxline('siswa_ekstrakurikuler', 'line', 'idsiswa', $idsiswa, '');
			
					$sqlstr = "select idsiswa from siswa_ekstrakurikuler where idsiswa='$idsiswa' and idtahunajaran='$idtahunajaran' and idpelajaran='$pelajaran_id' and idsemester='$idsemester'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rows = $sql->rowCount();
					
					if($rows == 0) {
						$sqlstr = "insert into siswa_ekstrakurikuler (idsiswa, idtahunajaran, idsemester, idpelajaran, tanggal, uid, dlu, line) values ('$idsiswa', '$idtahunajaran', '$idsemester', '$pelajaran_id', '$tanggal', '$uid', '$dlu', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
				}					
			}
			
			
			/*$jmldata_group		=	(empty($_POST["jmldata_group"])) ? 0 : $_POST["jmldata_group"];
			for($i=0; $i<1; $i++) {
				$kelompok_id	=	$_POST[kelompok_id_.$i];*/
				
				
				//if($kelompok_id == 1) {
					/*$jmldata_wajib		=	(empty($_POST["jmldata_wajib"])) ? 0 : $_POST["jmldata_wajib"];
					$k=0;
					for($k=0; $k<$jmldata_wajib; $k++) {*/
						
						//echo $wajib."<br>";	
					//}
				//}
				
											
			//}
			//$idpelajaran		=	(empty($_POST["idpelajaran"])) ? 0 : $_POST["idpelajaran"];
			
			
			
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert semester
	function insert_semester(){
		$dbpdo = DB::create();
		
		try {
			
			$semester			=	$_POST["semester"];
			$departemen			=	$_POST["departemen"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$tanggal_ttd		=	date("Y-m-d", strtotime($_POST["tanggal_ttd"]));
						
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into semester (semester, departemen, keterangan, tanggal_ttd, aktif, ts) values ('$semester', '$departemen', '$keterangan', '$tanggal_ttd', '$aktif', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert angkatan
	function insert_angkatan(){
		$dbpdo = DB::create();
		
		try {
			
			$angkatan			=	$_POST["angkatan"];
			$departemen			=	$_POST["departemen"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
						
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into angkatan (angkatan, departemen, aktif, ts) values ('$angkatan', '$departemen', '$aktif', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert rpp
	function insert_rpp(){
		$dbpdo = DB::create();
		
		try {
			
			$idtingkat			=	(empty($_POST["idtingkat"])) ? 0 : $_POST["idtingkat"];
			$idsemester			=	(empty($_POST["idsemester"])) ? 0 : $_POST["idsemester"];
			$idpelajaran		=	(empty($_POST["idpelajaran"])) ? 0 : $_POST["idpelajaran"];
			$idguru				=	(empty($_POST["idguru"])) ? 0 : $_POST["idguru"];
			$koderpp			=	$_POST["koderpp"];
			$rpp				=	petikreplace($_POST["rpp"]);
			$deskripsi			=	petikreplace($_POST["deskripsi"]);
			$jumlah_ukbm		=	(empty($_POST["jumlah_ukbm"])) ? 0 : $_POST["jumlah_ukbm"];
			$minimum_hadir		=	(empty($_POST["minimum_hadir"])) ? 0 : $_POST["minimum_hadir"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			//-----------upload file
			$uploaddir = 'app/file_rpp/';
			$info3 = $_FILES['info3']['name']; 
			$tmpname  = $_FILES['info3']['tmp_name'];
			$filesize = $_FILES['info3']['size'];
			$filetype = $_FILES['info3']['type'];

			
			if($info3 != "") {			
				$info3 = $idpelajaran . '_' . $info3;					
				$uploadfile = $uploaddir . $info3;		
				if (move_uploaded_file($_FILES['info3']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into rpp (idtingkat, idsemester, idpelajaran, idguru, koderpp, rpp, deskripsi, info3, jumlah_ukbm, minimum_hadir, aktif, ts) values ('$idtingkat', '$idsemester', '$idpelajaran', '$idguru', '$koderpp', '$rpp', '$deskripsi', '$info3', '$jumlah_ukbm', '$minimum_hadir', '$aktif', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert dasarpenilaian
	function insert_dasarpenilaian(){
		$dbpdo = DB::create();
		
		try {
			
			$dasarpenilaian		=	$_POST["dasarpenilaian"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into dasarpenilaian (dasarpenilaian, keterangan, ts) values ('$dasarpenilaian', '$keterangan', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	
	//-----insert kompetensi
	function insert_kompetensi(){
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	$_POST["kode"];
			$kompetensi			=	petikreplace($_POST["kompetensi"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into kompetensi (kode, kompetensi, aktif, dlu) values ('$kode', '$kompetensi', '$aktif', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert jeniskompetensi
	function insert_jeniskompetensi(){
		$dbpdo = DB::create();
		
		try {
			
			$jeniskompetensi	=	petikreplace($_POST["jeniskompetensi"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into jeniskompetensi (jeniskompetensi, aktif, dlu) values ('$jeniskompetensi', '$aktif', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert aspek_perkembangan
	function insert_aspek_perkembangan(){
		$dbpdo = DB::create();
		
		try {
			
			$aspek		=	petikreplace($_POST["aspek"]);
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into aspek_perkembangan (aspek, aktif, uid, dlu) values ('$aspek', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert aspek_psikologi
	function insert_aspek_psikologi(){
		$dbpdo = DB::create();
		
		try {
			
			$departemen	=	$_POST["departemen"];
			$aspek		=	petikreplace($_POST["aspek"]);
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into aspek_psikologi (departemen, aspek, aktif, uid, dlu) values ('$departemen', '$aspek', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert aspek_psikologi_detail
	function insert_aspek_psikologi_detail(){
		$dbpdo = DB::create();
		
		try {
			
			$jenis_aspek_id = $_POST["jenis_aspek_id"];
			$departemen	=	$_POST["departemen"];
			$aspek		=	petikreplace($_POST["aspek"]);
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into aspek_psikologi_detail (departemen, jenis_aspek_id, aspek, aktif, uid, dlu) values ('$departemen', '$jenis_aspek_id', '$aspek', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert assesmen_observasi
	function insert_assesmen_observasi($ref){
		$dbpdo = DB::create();
		
		try {
			
			$tanggal	=	date("Y-m-d", strtotime($_POST['tanggal']));
			$idsiswa	=	$_POST["idsiswa"];
			$idpegawai	=	(empty($_POST['idpegawai'])) ? 0 : $_POST['idpegawai'];
			$idpegawai1	=	(empty($_POST['idpegawai1'])) ? 0 : $_POST['idpegawai1'];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			##get nis siswa
			$sqlstr = "select nis from siswa where replid='$idsiswa'";
			$sql = $dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$nis = $data->nis;
			
			//-----------upload file data
			$uploaddir = 'app/file_assesment/';
			$data_file = $_FILES['data_file']['name']; 
			$tmpname  = $_FILES['data_file']['tmp_name'];
			$filesize = $_FILES['data_file']['size'];
			$filetype = $_FILES['data_file']['type'];

			
			if($data_file != "") {			
				$data_file = $ref . '_' . $nis . '_' . $data_file;					
				$uploadfile = $uploaddir . $data_file;		
				if (move_uploaded_file($_FILES['data_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			$sqlstr = "insert into assesmen_observasi (ref, tanggal, idsiswa, idpegawai, idpegawai1, data_file, uid, dlu) values ('$ref', '$tanggal', '$idsiswa', '$idpegawai', '$idpegawai1', '$data_file', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
						
			/*--------insert detail--------*/
			/*$jumlah		=	$_POST['jmldata'];
			
			for($x=0; $x<=$jumlah; $x++) {
				$idaspek_perkembangan	=	$_POST[idaspek_perkembangan_.$x];
				$hasil					=	petikreplace($_POST[hasil_.$x]);
				$saran					=	petikreplace($_POST[saran_.$x]);
				
				if($hasil != "") {
					$sqlstr = "insert into assesmen_observasi_detail (ref, idaspek_perkembangan, hasil, saran, line) values ('$ref', '$idaspek_perkembangan', '$hasil', '$saran', '$x')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
				
			}*/
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert anggota
	function insert_anggota($ref){
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	petikreplace($_POST["nama"]);
			$alamat		=	petikreplace($_POST["alamat"]);
			$kodepos	=	$_POST["kodepos"];
			$email		=	$_POST["email"];
			$telpon		=	$_POST["telpon"];
			$HP			=	$_POST["HP"];
			$pekerjaan	=	petikreplace($_POST["pekerjaan"]);
			$institusi	=	$_POST["institusi"];
			$keterangan	=	petikreplace($_POST["keterangan"]);
			$tgldaftar	=	date("Y-m-d", strtotime($_POST["tgldaftar"]));
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$telpon		=	$_POST["telpon"];
			$telpon		=	$_POST["telpon"];
			
			
			//-----------upload file foto
			$uploaddir = 'app/file_foto_anggota/';
			$foto = $_FILES['foto']['name']; 
			$tmpname  = $_FILES['foto']['tmp_name'];
			$filesize = $_FILES['foto']['size'];
			$filetype = $_FILES['foto']['type'];

			
			if($foto != "") {			
				$foto = $ref . '_' . $foto;					
				$uploadfile = $uploaddir . $foto;		
				if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into anggota (noregistrasi, nama, alamat, kodepos, email, telpon, HP, pekerjaan, institusi, keterangan, tgldaftar, aktif, foto, ts) values ('$ref', '$nama', '$alamat', '$kodepos', '$email', '$telpon', '$HP', '$pekerjaan', '$institusi', '$keterangan', '$tgldaftar', '$aktif', '$foto', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//------insert user reminder
	function insert_usr_reminder(){
		$dbpdo = DB::create();
		
		try {
			
			$uid		=	$_SESSION["loginname"];
			
			//----------insert user detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($i=1; $i<=$jmldata; $i++) {
				$mview = (empty($_POST[mview_.$i])) ? 0 : $_POST[mview_.$i];
				
				if ($mview==1) { 				
					$reminder_id = $_POST[reminder_id_.$i];
														
					$sqlstr = "insert into usr_reminder
					(usrid, reminder_id)
						values
						(
							'".$usrid."',
							'".$reminder_id."'
						)";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
				}
			}
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert evaluasi_psikologi
	function insert_evaluasi_psikologi($ref){
		$dbpdo = DB::create();
		
		try {
			
			$tanggal	=	date("Y-m-d", strtotime($_POST['tanggal']));
			$departemen	=	$_POST["departemen"];
			$idtingkat	= 	$_POST["idtingkat"];
			$idkelas	= 	$_POST["idkelas"];
			$nis		=	$_POST["nis"];
			$idpegawai	=	(empty($_POST['idpegawai'])) ? 0 : $_POST['idpegawai'];
			$idsemester = 	$_POST["idsemester"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
						
			$sqlstr = "insert into evaluasi_psikologi (ref, tanggal, departemen, idtingkat, idkelas, nis, idpegawai, idsemester, uid, dlu) values ('$ref', '$tanggal', '$departemen', '$idtingkat', '$idkelas', '$nis', '$idpegawai', '$idsemester', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
						
			/*--------insert detail--------*/
			$iq	=	$_POST['iq'];
			$jmldata_jenis_aspek = $_POST['jmldata_jenis_aspek'];
			for($y=0; $y<$jmldata_jenis_aspek; $y++) {
				$jenis_aspek_id	=	$_POST[jenis_aspek_id_.$y];
				
				
				$jml_aspek_detail = $_POST[jml_aspek_detail_.$y];
				for($z=0; $z<$jml_aspek_detail; $z++) {
					
					$aspek_psikologi_id	= 	$_POST[aspek_psikologi_detail_id_.$y.$z];
					$nilai				=	$_POST[nilai_.$y.$z];
					
					$line = maxline('evaluasi_psikologi_detail', 'line', 'ref', $ref, '');
					
					$sqlstr = "insert into evaluasi_psikologi_detail (ref, iq, nilai, jenis_aspek_id, aspek_psikologi_id, line) values ('$ref', '$iq', '$nilai', '$jenis_aspek_id', '$aspek_psikologi_id', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				
				}
				
			}
				
					
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	
	//-----insert kelulusan
	function insert_kelulusan($idkelas, $idkelas2, $tgllulus){
		$dbpdo = DB::create();
		
		try {
			
			$tgllulus	=	date("Y-m-d", strtotime($tgllulus));
			$idtingkat	=	$_POST["idtingkat"];
			$mulai		=	date("Y-m-d");
			$uid		=	$_SESSION["loginname"];
			$ts			=	date("Y-m-d H:i:s");
			
			//get data 
			//$strsql = "select b.departemen from kelas a left join tingkat b on a.idtingkat=b.replid where a.replid='$idkelas'";
			$strsql = "select a.departemen from tingkat a where a.replid='$idtingkat'";
			$sql_kelas=$dbpdo->prepare($strsql);
			$sql_kelas->execute();
			$data_kelas = $sql_kelas->fetch(PDO::FETCH_OBJ);
			$departemen = $data_kelas->departemen;
			//----------/\----------------
			
					
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];				
			for ($x=0; $x<=$jmldata; $x++) {
				
				$lulus 	 	= $_POST[lulus_.$x];
				$nis 	 	= $_POST[nis_.$x];
				$keterangan = $_POST[keterangan_.$x];
				
				if($lulus > 0 && $nis != "") {
					
					//----update siswa alumni
					$sql_lulus="update siswa set aktif=0, alumni=1 where nis='$nis'";
					$sql=$dbpdo->prepare($sql_lulus);
					$sql->execute();					
					
					//update riwayat kelas siswa
					$sql_lulus="update riwayatkelassiswa set aktif=0 where nis='$nis' and idkelas='$idkelas' and aktif = 1";
					$sql=$dbpdo->prepare($sql_lulus);
					$sql->execute();
					
					//update riwayat dept siswa
					$sql_lulus="update riwayatdeptsiswa set aktif=0 where nis='$nis' and departemen='$departemen' and aktif=1";
					$sql=$dbpdo->prepare($sql_lulus);
					$sql->execute();
										
					//insert alumni
					$sqlstr="insert into alumni set nis='$nis', tgllulus='$tgllulus', tktakhir='$idtingkat', klsakhir='$idkelas', departemen='$departemen', keterangan='$keterangan', info3='$uid'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
										
						
				}
					
			}
						
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pelajaran_un_minat
	function insert_pelajaran_un_minat(){
		$dbpdo = DB::create();
		
		try {
			
			$pelajaran_id		=	(empty($_POST["pelajaran_id"])) ? 0 : $_POST["pelajaran_id"];
			$departemen			=	$_POST["departemen"];
			$urutan				=	(empty($_POST["urutan"])) ? 0 : $_POST["urutan"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pelajaran_un_minat (pelajaran_id, departemen, urutan, uid, dlu) values ('$pelajaran_id', '$departemen', '$urutan', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert KRS
	function insert_kartu_rencana_studi(){
		$dbpdo = DB::create();
		
		try {
			$peminatan			=	$_POST["peminatan"];
			$tingkat_id			=	(empty($_POST["tingkat_id"])) ? 0 : $_POST["tingkat_id"];
			$kelompok_pelajaran_id	=	(empty($_POST["kelompok_pelajaran_id"])) ? 0 : $_POST["kelompok_pelajaran_id"];
			$pelajaran_kode		=	$_POST["pelajaran_kode"];
			$pelajaran_id		=	(empty($_POST["pelajaran_id"])) ? 0 : $_POST["pelajaran_id"];
			$semester_id		=	(empty($_POST["semester_id"])) ? 0 : $_POST["semester_id"];
			$sks				=	numberreplace($_POST["sks"]);
			$idtahunajaran		=	(empty($_POST["idtahunajaran"])) ? 0 : $_POST["idtahunajaran"];
			$urutan				=	numberreplace($_POST["urutan"]);
			$kode1				=	$_POST["kode1"];
			$kode2				=	$_POST["kode2"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into kartu_rencana_studi (peminatan, tingkat_id, kelompok_pelajaran_id, pelajaran_kode, pelajaran_id, semester_id, sks, idtahunajaran, urutan, kode1, kode2, uid, dlu) values ('$peminatan', '$tingkat_id', '$kelompok_pelajaran_id', '$pelajaran_kode', '$pelajaran_id', '$semester_id', '$sks', '$idtahunajaran', '$urutan', '$kode1', '$kode2', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert KRS
	function insert_siswa_krs($nis){
		$dbpdo = DB::create();
		
		try {
			$idtahunajaran		=	$_SESSION["idtahunajaran"];
			$semester_id		=	(empty($_POST["semester_id"])) ? 0 : $_POST["semester_id"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];	
			for ($x=0; $x<=$jmldata; $x++) {				
				$pilih 	 			= 	$_POST["pilih_".$x.""];
				$pelajaran_id		=	(empty($_POST["pelajaran_id_".$x.""])) ? 0 : $_POST["pelajaran_id_".$x.""];
				$kode 	 			= 	$_POST["kode_".$x.""];
				$pegawai_id			=	(empty($_POST["pegawai_id_".$x.""])) ? 0 : $_POST["pegawai_id_".$x.""];
				$kelompok_pelajaran_id = (empty($_POST["kelompok_pelajaran_id_".$x.""])) ? 0 : $_POST["kelompok_pelajaran_id_".$x.""];
				$sks_id				=	(empty($_POST["sks_id_".$x.""])) ? 0 : $_POST["sks_id_".$x.""];
				
				if($pilih == 1) {
					$sqlstr = "select replid from siswa_krs where nis='$nis' and semester_id='$semester_id' and pelajaran_id='$pelajaran_id' and idtahunajaran='$idtahunajaran'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rowcount=$sql->rowCount();
					
					//Cek status pengunjung   
					$ip_proxy=$_SERVER['REMOTE_ADDR']; 
					$ip_pc=$_SERVER['HTTP_X_FORWARDED_FOR']; 
					
					$mobile =  numberreplace(strpos($_SERVER["HTTP_USER_AGENT"], 'Mobile') ? true : false);	
					$browser_cek = $_SERVER["HTTP_USER_AGENT"];

					if($rowcount == 0) {						
						$sqlstr = "insert into siswa_krs (nis, idtahunajaran, semester_id, pelajaran_id, kode, pegawai_id, kelompok_pelajaran_id, sks_id, uid, dlu, ip_proxy, ip_pc, mobile, browser) values ('$nis', '$idtahunajaran', '$semester_id', '$pelajaran_id', '$kode', '$pegawai_id', '$kelompok_pelajaran_id', '$sks_id', '$uid', '$dlu', '$ip_proxy', '$ip_pc', '$mobile', '$browser_cek')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$sqlstr = "update siswa_krs set kode='$kode', ip_proxy='$ip_proxy', ip_pc='$ip_pc', mobile='$mobile', browser='$browser' where nis='$nis' and semester_id='$semester_id' and pelajaran_id='$pelajaran_id' and idtahunajaran='$idtahunajaran'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
					
				}
			}
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pelajaran_raport_minat
	function insert_pelajaran_raport_minat(){
		$dbpdo = DB::create();
		
		try {
			
			$pelajaran_id		=	(empty($_POST["pelajaran_id"])) ? 0 : $_POST["pelajaran_id"];
			$departemen			=	$_POST["departemen"];
			$urutan				=	(empty($_POST["urutan"])) ? 0 : $_POST["urutan"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pelajaran_raport_minat (pelajaran_id, departemen, urutan, uid, dlu) values ('$pelajaran_id', '$departemen', '$urutan', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert penempatan_siswa_prioritas
	function insert_penempatan_siswa_prioritas(){
		$dbpdo = DB::create();
		
		try {
			
			$nama				=	$_POST["nama"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$urutan				=	(empty($_POST["urutan"])) ? 0 : $_POST["urutan"];			
			
			$sqlstr = "insert into penempatan_siswa_prioritas (nama, aktif, urutan) values ('$nama', '$aktif', '$urutan')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert KRS
	function insert_guru(){
		$dbpdo = DB::create();
		
		try {
			$idpelajaran		=	(empty($_POST["idpelajaran"])) ? 0 : $_POST["idpelajaran"];
			$aktif				=	1;
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];				
			for ($x=0; $x<=$jmldata; $x++) {				
				$pilih 	 			= 	$_POST[pilih_.$x];
				$nip				=	(empty($_POST[nip_.$x])) ? 0 : $_POST[nip_.$x];
				$kode				=	$_POST[kode_.$x];
				$keterangan 		= 	petikreplace($_POST[keterangan_.$x]);
				$input_pas			=	$_POST[input_pas_.$k];
				
				if($pilih == 1) {
					$sqlstr = "insert into guru (kode, nip, idpelajaran, aktif, keterangan, info1, uid) values ('$kode', '$nip', '$idpelajaran', '$aktif', '$keterangan', '$input_pas', '$uid')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert KRS
	function insert_guru_ekskul(){
		$dbpdo = DB::create();
		
		try {
			$idpelajaran		=	(empty($_POST["idpelajaran"])) ? 0 : $_POST["idpelajaran"];
			$aktif				=	1;
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];				
			for ($x=0; $x<=$jmldata; $x++) {				
				$pilih 	 			= 	$_POST[pilih_.$x];
				$nip				=	(empty($_POST[nip_.$x])) ? 0 : $_POST[nip_.$x];
				$kode				=	$_POST[kode_.$x];
				$keterangan 		= 	petikreplace($_POST[keterangan_.$x]);
				
				if($pilih == 1) {
					$sqlstr = "insert into guru (kode, nip, idpelajaran, aktif, keterangan, uid) values ('$kode', '$nip', '$idpelajaran', '$aktif', '$keterangan', '$uid')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert jam
	function insert_jam(){
		$dbpdo = DB::create();
		
		try {
			
			$hari				=	(empty($_POST["hari"])) ? 0 : $_POST["hari"];
			$jamke				=	(empty($_POST["jamke"])) ? 0 : $_POST["jamke"];
			$departemen			=	$_POST["departemen"];
			$jam1				=	date("H:i", strtotime($_POST["jam1"]));
			$jam2				=	date("H:i", strtotime($_POST["jam2"]));
			$istirahat			=	(empty($_POST["istirahat"])) ? 0 : $_POST["istirahat"];
			$info1				=	petikreplace($_POST["info1"]);
			
			$sqlstr = "insert into jam (hari, jamke, departemen, jam1, jam2, istirahat, info1) values ('$hari', '$jamke', '$departemen', '$jam1', '$jam2', '$istirahat', '$info1')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	
	//-----insert jadwal
	function insert_jadwal(){
		$dbpdo = DB::create();
		
		try {
			
			
			$idkelas			=	(empty($_POST["idkelas"])) ? 0 : $_POST["idkelas"];
			$nipguru			=	(empty($_POST["idguru"])) ? 0 : $_POST["idguru"];
			$idpelajaran		=	(empty($_POST["idpelajaran"])) ? 0 : $_POST["idpelajaran"];
			$departemen			=	$_POST["departemen"];
			$infojadwal			=	petikreplace($_POST["infojadwal"]);
			$hari				=	(empty($_POST["hari"])) ? 0 : $_POST["hari"];
			$jamke				=	(empty($_POST["jamke"])) ? 0 : $_POST["jamke"];
			$njam				=	(empty($_POST["njam"])) ? 0 : $_POST["njam"];
			$sifat				=	(empty($_POST["sifat"])) ? 0 : $_POST["sifat"];
			$status				=	(empty($_POST["status"])) ? 0 : $_POST["status"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$jam1				=	date("H:i", strtotime($_POST["jam1"]));
			$jam2				=	date("H:i", strtotime($_POST["jam2"]));
			$idjam1				=	(empty($_POST["idjam1"])) ? 0 : $_POST["idjam1"];
			$idjam2				=	(empty($_POST["idjam2"])) ? 0 : $_POST["idjam2"];
			
			
			$sqlstrx = "select a.replid, b.kelas, c.tingkat, d.bentrok from jadwal a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid left join pelajaran d on a.idpelajaran=d.replid where a.nipguru='$nipguru' and a.idpelajaran='$idpelajaran' and a.hari='$hari' and a.idjam1='$idjam1' ";
			$sqlx=$dbpdo->prepare($sqlstrx);
			$sqlx->execute();
			$rows=$sqlx->rowCount();
			$datajwl=$sqlx->fetch(PDO::FETCH_OBJ);
			
			if($rows == 0) {						
				$sqlstr = "insert into jadwal (idkelas, nipguru, idpelajaran, departemen, infojadwal, hari, jamke, njam, sifat, status, keterangan, jam1, jam2, idjam1, idjam2) values ('$idkelas', '$nipguru', '$idpelajaran', '$departemen', '$infojadwal', '$hari', '$jamke', '$njam', '$sifat', '$status', '$keterangan', '$jam1', '$jam2', '$idjam1', '$idjam2')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			} else {
				if($datajwl->bentrok == 1) {
					$sqlstr = "insert into jadwal (idkelas, nipguru, idpelajaran, departemen, infojadwal, hari, jamke, njam, sifat, status, keterangan, jam1, jam2, idjam1, idjam2) values ('$idkelas', '$nipguru', '$idpelajaran', '$departemen', '$infojadwal', '$hari', '$jamke', '$njam', '$sifat', '$status', '$keterangan', '$jam1', '$jam2', '$idjam1', '$idjam2')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				} else {
					$kelas = 'Kelas : '.$datajwl->tingkat.' '.$datajwl->kelas;
					echo 'Guru sudah mengajar di '.$kelas.' pada jam yang sama';
					exit;
				}
				
			}
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert asset type
	function insert_asset_type(){	
		$dbpdo = DB::create();
		
		try {	
			$type			=	$_POST["type"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into asset_type (type, active, uid, dlu) values ('$type', '$active', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
	
		return $sql;
	}
    
    
    //-----insert asset
	function insert_asset($ref=''){		
		$dbpdo = DB::create();
		
		try {
			$ref_id			    =	petikreplace($_POST["ref_id"]);
			$asset_name		    =	petikreplace($_POST["asset_name"]);
			$alias		        =	petikreplace($_POST["alias"]);
			$lokasi			    =	petikreplace($_POST["lokasi"]);
			$provinsi	    	=	$_POST["provinsi"];
			$kota	    		=	$_POST["kota"];
			$kecamatan	    	=	$_POST["kecamatan"];
			$desa	    		=	$_POST["desa"];
			$asset_type_id	    =	(empty($_POST["asset_type_id"])) ? 0 : $_POST["asset_type_id"];
	        $status			    =	$_POST["status"];
			$luas		        =	numberreplace($_POST["luas"]);
	        $sertifikat		    =   $_POST["sertifikat"];
	        $imb			    =	$_POST["imb"];
	        $tanggal_perolehan	=	date("Y-m-d", strtotime($_POST["tanggal_perolehan"]));
	        $pemilik_sebelum	=	$_POST["pemilik_sebelum"];
	        $contact_name		=	$_POST["contact_name"];
	        $no_pbb             =   $_POST["no_pbb"];
	        $group_block        =   $_POST["group_block"];
	        $alamat             =   petikreplace($_POST["alamat"]);
	        $lintang            =   numberreplace($_POST["lintang"]);
	        $bujur              =   numberreplace($_POST["bujur"]);
	        $nilai_perolehan    =   numberreplace($_POST["nilai_perolehan"]);
	        $nilai_amnesti      =   numberreplace($_POST["nilai_amnesti"]);
	        $pemilik_sekarang   =   petikreplace($_POST["pemilik_sekarang"]);
	        $pemilik_sekarang1  =   petikreplace($_POST["pemilik_sekarang1"]);
	        $pemilik_sekarang2  =   petikreplace($_POST["pemilik_sekarang2"]);
	        $shm			    =	$_POST["shm"];
	        $shm_nama		    =	$_POST["shm_nama"];
	        $ajb			    =	$_POST["ajb"];
	        $pbb			    =	$_POST["pbb"];
	        $keterangan			=	petikreplace($_POST["keterangan"]);
	        $perolehan			=	petikreplace($_POST["perolehan"]);
	        $active			    =	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			    =	$_SESSION["loginname"];
			$dlu			    =	date("Y-m-d H:i:s");
			
			/*create folder*/
			/*$photo_asset = 'app/photo_asset/'.$ref;
			if (!file_exists($photo_asset) && !is_dir($photo_asset)) {
				@mkdir($photo_asset, 0777, true);
				@chmod('app/photo_asset', 0777);
				@chmod($photo_asset, 0777);
			}
			
			//-----------upload file
		  	$photo2				= $_POST["photo2"];
			$uploaddir_photo	= $photo_asset .'/';
			$photo				= $_FILES['photo']['name']; 
			$tmpname_photo 		= $_FILES['photo']['tmp_name'];
			$filesize_photo 	= $_FILES['photo']['size'];
			$filetype_photo 	= $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} else {
				$photo = $photo;
			}
			
			if($photo != "") {
				$photo = $ref . '_imb_' . $photo;
				$uploaddir_photo = $uploaddir_photo . $photo;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}	*/
			
			/*upload file-1*/
		  	/*$photo_12			= $_POST["photo_12"];
			$uploaddir_photo_1	= $photo_asset .'/';
			$photo_1			= $_FILES['photo_1']['name']; 
			$tmpname_photo_1 	= $_FILES['photo_1']['tmp_name'];
			$filesize_photo_1 	= $_FILES['photo_1']['size'];
			$filetype_photo_1 	= $_FILES['photo_1']['type'];
			
			if (empty($photo_1)) { 
				$photo_1 = $photo_12; 
			} else {
				$photo_1 = $photo_1;
			}
			
			if($photo_1 != "") {
				$photo_1 = $ref . '_shm_' . $photo_1;
				$uploaddir_photo_1 = $uploaddir_photo_1 . $photo_1;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['photo_1']['tmp_name'], $uploaddir_photo_1)) {
					echo "";											
				} 	
			}	*/
			
			
			
	        
			//----------------
			$sqlstr="insert into asset (ref, asset_name, alias, ref_id, lokasi, asset_type_id, status, luas, sertifikat, imb, perolehan, tanggal_perolehan, pemilik_sebelum, contact_name, no_pbb, group_block, alamat, lintang, bujur, nilai_perolehan, nilai_amnesti, photo, photo_1, photo_2, photo_3, photo_4, shm, shm_nama, ajb, pbb, keterangan, active, uid, dlu) values ('$ref', '$asset_name', '$alias', '$ref_id', '$lokasi', '$asset_type_id', '$status', '$luas', '$sertifikat', '$imb', '$perolehan', '$tanggal_perolehan', '$pemilik_sebelum', '$contact_name', '$no_pbb', '$group_block', '$alamat', '$lintang', '$bujur', '$nilai_perolehan', '$nilai_amnesti', '$photo', '$photo_1', '$photo_2', '$photo_3', '$photo_4', '$shm', '$shm_nama', '$ajb', '$pbb', '$keterangan', '$active', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
	
		return $sql;
	}
    
    
    //-----insert asset trans
	function insert_asset_trans($ref=''){	
		$dbpdo = DB::create();
		
		try {	
			$tanggal	        =	date("Y-m-d", strtotime($_POST["tanggal"]));        
	        $asset_id		    =	$_POST["asset_id"];        
			$penyewa	        =	petikreplace($_POST["penyewa"]);
			$lama_sewa    	    =	(empty($_POST["lama_sewa"])) ? 0 : $_POST["lama_sewa"];
	        $akhir_sewa	        =	date("Y-m-d", strtotime($_POST["akhir_sewa"]));
	        $harga_sewa		    =	numberreplace($_POST["harga_sewa"]);
	        $alamat             =   petikreplace($_POST["alamat"]);
			$hp        		    =   $_POST["hp"];
	        $uid			    =	$_SESSION["loginname"];
			$dlu			    =	date("Y-m-d H:i:s");
			
			$sqlstr="insert into asset_trans (ref, tanggal, asset_id, penyewa, lama_sewa, akhir_sewa, harga_sewa, alamat, hp, uid, dlu) values ('$ref', '$tanggal', '$asset_id', '$penyewa', '$lama_sewa', '$akhir_sewa', '$harga_sewa', '$alamat', '$hp', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
	
		return $sql;
	}
	
	
	//-----insert soal
	function insert_soal(){
		$dbpdo = DB::create();
		
		try {
			
			$code				= 	random(25);
			$idtahunajaran		=	(empty($_POST["idtahunajaran"])) ? 0 : $_POST["idtahunajaran"];
			$idtingkat			=	(empty($_POST["idtingkat"])) ? 0 : $_POST["idtingkat"];
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$idsemester			=	(empty($_POST["idsemester"])) ? 0 : $_POST["idsemester"];
			$idjurusan			=	(empty($_POST["idjurusan"])) ? 0 : $_POST["idjurusan"];
			$pertanyaan			=	petikreplace($_POST["pertanyaan"]);
			
			//------------start upload photo
	  		include_once ("app/include/function_crop.php");
	  		
	  		$pilihan1			=	petikreplace($_POST["pilihan1"]);
	  		$pilihan_photo1		= 	$_POST["pilihan_photo1"];
	  		$pilihan_photo1_1 	= 	resize_image('pilihan_photo1', 'soal_photo/', 'app/soal_photo/', 'soal_photo/', $code."_".$pilihan_photo1);
	  		$pilihan_photo1_a 	= 	$pilihan_photo1_1;
						
			$pilihan2			=	petikreplace($_POST["pilihan2"]);
	  		$pilihan_photo2		= 	$_POST["pilihan_photo2"];
	  		$pilihan_photo2_1 	= 	resize_image('pilihan_photo2', 'soal_photo/', 'app/soal_photo/', 'soal_photo/', $code."_".$pilihan_photo2);
	  		$pilihan_photo2_a	= 	$pilihan_photo2_1;
			
			$pilihan3			=	petikreplace($_POST["pilihan3"]);
	  		$pilihan_photo3		= 	$_POST["pilihan_photo3"];
	  		$pilihan_photo3_1 	= 	resize_image('pilihan_photo3', 'soal_photo/', 'app/soal_photo/', 'soal_photo/', $code."_".$pilihan_photo3);
	  		$pilihan_photo3_a	= 	$pilihan_photo3_1;
	  		
	  		$pilihan4			=	petikreplace($_POST["pilihan4"]);
	  		$pilihan_photo4		= 	$_POST["pilihan_photo4"];
	  		$pilihan_photo4_1 	= 	resize_image('pilihan_photo4', 'soal_photo/', 'app/soal_photo/', 'soal_photo/', $code."_".$pilihan_photo4);
	  		$pilihan_photo4_a	= 	$pilihan_photo4_1;
	  		
	  		$pilihan5			=	petikreplace($_POST["pilihan5"]);
	  		$pilihan_photo5		= 	$_POST["pilihan_photo5"];
	  		$pilihan_photo5_1 	= 	resize_image('pilihan_photo5', 'soal_photo/', 'app/soal_photo/', 'soal_photo/', $code."_".$pilihan_photo5);
	  		$pilihan_photo5_a	= 	$pilihan_photo5_1;
	  		
	  		$jawaban			=	(empty($_POST["jawaban"])) ? 0 : $_POST["jawaban"];
	  		$poin				=	(empty($_POST["poin"])) ? 0 : $_POST["poin"];
	  		$waktu				=	(empty($_POST["waktu"])) ? 0 : $_POST["waktu"];
	  		$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
	  		$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
						
			$sqlstr = "insert into soal (idtahunajaran, idtingkat, idpegawai, idsemester, idjurusan, pertanyaan, pilihan1, pilihan_photo1, pilihan2, pilihan_photo2, pilihan3, pilihan_photo3, pilihan4, pilihan_photo4, pilihan5, pilihan_photo5, jawaban, poin, waktu, aktif, uid, dlu) values ('$idtahunajaran', '$idtingkat', '$idpegawai', '$idsemester', '$idjurusan', '$pertanyaan', '$pilihan1', '$pilihan_photo1_a', '$pilihan2', '$pilihan_photo2_a', '$pilihan3', '$pilihan_photo3_a', '$pilihan4', '$pilihan_photo4_a', '$pilihan5', '$pilihan_photo5_a', '$jawaban', '$poin', '$waktu', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//soal seleksi
	function insert_soal_select(){
		
		$dbpdo = DB::create();
		
		try {
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$jmldata		=	(empty($_POST["jmldata"])) ? 0 : $_POST["jmldata"];
			$k=0;
			for($k=0; $k<$jmldata; $k++) {
				$replid			=	$_POST[replid_.$k];
				$pilih			=	$_POST[pilih_.$k];
				
				$sqlstr = "update soal set aktif='$pilih', uid_select='$uid', dlu_select='$dlu' where replid='$replid'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();	
			}
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//soal siswa
	function insert_soal_siswa(){
		
		$dbpdo = DB::create();
		
		try {
			
			$tanggal		=   date("Y-m-d", strtotime($_POST["tanggal"]));
			$idsiswa		=	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
			$idsemester		=	(empty($_POST["idsemester"])) ? 0 : $_POST["idsemester"];
			
			$jmldata		=	(empty($_POST["jmldata"])) ? 0 : $_POST["jmldata"];
			$k=0;
			for($k=0; $k<$jmldata; $k++) {
				$replid			=	$_POST[replid_.$k];
				$jawaban		=	$_POST[jawaban_.$k];
				
				$sqlstr = "insert into soal_siswa (tanggal, idsiswa, idsemester, idsoal, jawaban) values ('$tanggal', '$idsiswa', '$idsemester', '$replid', '$jawaban')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();	
			}
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//pemetaan_kd
	function insert_pemetaan_kd(){
		
		$dbpdo = DB::create();
		
		try {
			
			$permen_kd_id	=	(empty($_POST["permen_kd_id"])) ? 0 : $_POST["permen_kd_id"];
			$idtingkat		=	(empty($_POST["idtingkat"])) ? 0 : $_POST["idtingkat"];
			$idpelajaran	= 	(empty($_POST["idpelajaran"])) ? 0 : $_POST["idpelajaran"];
			$kode			=	$_POST["kode"];
			$kd				=	substr($kode,0,1); //$_POST["kd"];
			$uraian			=	petikreplace($_POST["uraian"]);
			$kkm_sekolah	=	petikreplace($_POST["kkm_sekolah"]);
			$kkm_pelajaran	=	petikreplace($_POST["kkm_pelajaran"]);
			$jumlah_ukbm	=	petikreplace($_POST["jumlah_ukbm"]);
			$urutan			= 	(empty($_POST["urutan"])) ? 0 : $_POST["urutan"];
			$aktif			= 	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pemetaan_kd (permen_kd_id, idtingkat, idpelajaran, kd, kode, uraian, kkm_sekolah, kkm_pelajaran, jumlah_ukbm, urutan, aktif, uid, dlu) values ('$permen_kd_id', '$idtingkat', '$idpelajaran', '$kd', '$kode', '$uraian', '$kkm_sekolah', '$kkm_pelajaran', '$jumlah_ukbm', '$urutan', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//pemetaan_kd_siswa
	function insert_pemetaan_kd_siswa(){
		
		$dbpdo = DB::create();
		
		try {
			
			$pemetaan_kd_id	=	(empty($_POST["pemetaan_kd_id"])) ? 0 : $_POST["pemetaan_kd_id"];
			$idsiswa		=	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
			$idguru			= 	(empty($_POST["idguru"])) ? 0 : $_POST["idguru"];
			$idpelajaran	= 	(empty($_POST["idpelajaran"])) ? 0 : $_POST["idpelajaran"];
			$nilai			=	numberreplace($_POST["nilai"]);
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pemetaan_kd_siswa (pemetaan_kd_id, idsiswa, idguru, idpelajaran, nilai, uid, dlu) values ('$pemetaan_kd_id', '$idsiswa', '$idguru', '$idpelajaran', '$nilai', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//-----insert ukbm
	function insert_ukbm(){
		$dbpdo = DB::create();
		
		try {
			
			$idtingkat			=	(empty($_POST["idtingkat"])) ? 0 : $_POST["idtingkat"];
			$idsemester			=	(empty($_POST["idsemester"])) ? 0 : $_POST["idsemester"];
			$idpelajaran		=	(empty($_POST["idpelajaran"])) ? 0 : $_POST["idpelajaran"];
			$idguru				=	(empty($_POST["idguru"])) ? 0 : $_POST["idguru"];
			$kode				=	$_POST["kode"];
			$ukbm				=	petikreplace($_POST["ukbm"]);
			$deskripsi			=	petikreplace($_POST["deskripsi"]);
			$idrpp				=	(empty($_POST["idrpp"])) ? 0 : $_POST["idrpp"];
			$minimum_hadir		=	numberreplace($_POST["minimum_hadir"]);
			$jumlah_ukbm		=	numberreplace($_POST["jumlah_ukbm"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			//-----------upload file
			$uploaddir = 'app/file_ukbm/';
			$file_ukbm = $_FILES['file_ukbm']['name']; 
			$tmpname  = $_FILES['file_ukbm']['tmp_name'];
			$filesize = $_FILES['file_ukbm']['size'];
			$filetype = $_FILES['file_ukbm']['type'];

			
			if($file_ukbm != "") {			
				$file_ukbm = $kode . '_' . $file_ukbm;					
				$uploadfile = $uploaddir . $file_ukbm;		
				if (move_uploaded_file($_FILES['file_ukbm']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into ukbm (idtingkat, idsemester, idpelajaran, idguru, kode, ukbm, deskripsi, file_ukbm, idrpp, minimum_hadir, jumlah_ukbm, aktif, uid, dlu) values ('$idtingkat', '$idsemester', '$idpelajaran', '$idguru', '$kode', '$ukbm', '$deskripsi', '$file_ukbm', '$idrpp', '$minimum_hadir', '$jumlah_ukbm', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert soal ukbm
	function insert_soal_ukbm(){
		$dbpdo = DB::create();
		
		try {
			
			$idtahunajaran		=	(empty($_POST["idtahunajaran"])) ? 0 : $_POST["idtahunajaran"];
			$idtingkat			=	(empty($_POST["idtingkat"])) ? 0 : $_POST["idtingkat"];
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$idsemester			=	(empty($_POST["idsemester"])) ? 0 : $_POST["idsemester"];
			$idjurusan			=	(empty($_POST["idjurusan"])) ? 0 : $_POST["idjurusan"];
			$idukbm				=	(empty($_POST["idukbm"])) ? 0 : $_POST["idukbm"];
			$pertanyaan			=	petikreplace($_POST["pertanyaan"]);
			$code				= 	$idpegawai; //random(25);
			
			//------------start upload photo
	  		include_once ("app/include/function_crop.php");
	  		
	  		$pilihan1			=	petikreplace($_POST["pilihan1"]);
	  		$pilihan_photo1		= 	$_POST["pilihan_photo1"];
	  		$pilihan_photo1_1 	= 	resize_image('pilihan_photo1', 'soal_ukbm_photo/', 'app/soal_ukbm_photo/', 'soal_ukbm_photo/', $code."_".$pilihan_photo1);
	  		$pilihan_photo1_a 	= 	$pilihan_photo1_1;
						
			$pilihan2			=	petikreplace($_POST["pilihan2"]);
	  		$pilihan_photo2		= 	$_POST["pilihan_photo2"];
	  		$pilihan_photo2_1 	= 	resize_image('pilihan_photo2', 'soal_ukbm_photo/', 'app/soal_ukbm_photo/', 'soal_ukbm_photo/', $code."_".$pilihan_photo2);
	  		$pilihan_photo2_a	= 	$pilihan_photo2_1;
			
			$pilihan3			=	petikreplace($_POST["pilihan3"]);
	  		$pilihan_photo3		= 	$_POST["pilihan_photo3"];
	  		$pilihan_photo3_1 	= 	resize_image('pilihan_photo3', 'soal_ukbm_photo/', 'app/soal_ukbm_photo/', 'soal_ukbm_photo/', $code."_".$pilihan_photo3);
	  		$pilihan_photo3_a	= 	$pilihan_photo3_1;
	  		
	  		$pilihan4			=	petikreplace($_POST["pilihan4"]);
	  		$pilihan_photo4		= 	$_POST["pilihan_photo4"];
	  		$pilihan_photo4_1 	= 	resize_image('pilihan_photo4', 'soal_ukbm_photo/', 'app/soal_ukbm_photo/', 'soal_ukbm_photo/', $code."_".$pilihan_photo4);
	  		$pilihan_photo4_a	= 	$pilihan_photo4_1;
	  		
	  		$pilihan5			=	petikreplace($_POST["pilihan5"]);
	  		$pilihan_photo5		= 	$_POST["pilihan_photo5"];
	  		$pilihan_photo5_1 	= 	resize_image('pilihan_photo5', 'soal_ukbm_photo/', 'app/soal_ukbm_photo/', 'soal_ukbm_photo/', $code."_".$pilihan_photo5);
	  		$pilihan_photo5_a	= 	$pilihan_photo5_1;
	  		
	  		//-----------upload file soal
			$uploaddir 	= 'app/soal_ukbm_photo/';
			$soal_file 	= $_FILES['soal_file']['name']; 
			$tmpname  	= $_FILES['soal_file']['tmp_name'];
			$filesize 	= $_FILES['soal_file']['size'];
			$filetype 	= $_FILES['soal_file']['type'];

			
			if($soal_file != "") {			
				$soal_file = $code . '_' . $soal_file;					
				$uploadfile = $uploaddir . $soal_file;		
				if (move_uploaded_file($_FILES['soal_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			$kelainan			=	$_POST["kelainan"];
			
	  		$jawaban			=	(empty($_POST["jawaban"])) ? 0 : $_POST["jawaban"];
	  		$poin				=	(empty($_POST["poin"])) ? 0 : $_POST["poin"];
	  		$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
	  		$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
						
			$sqlstr = "insert into soal_ukbm (idtahunajaran, idtingkat, idpegawai, idsemester, idjurusan, idukbm, pertanyaan, pilihan1, pilihan_photo1, pilihan2, pilihan_photo2, pilihan3, pilihan_photo3, pilihan4, pilihan_photo4, pilihan5, pilihan_photo5, jawaban, soal_file, poin, aktif, uid, dlu) values ('$idtahunajaran', '$idtingkat', '$idpegawai', '$idsemester', '$idjurusan', '$idukbm', '$pertanyaan', '$pilihan1', '$pilihan_photo1_a', '$pilihan2', '$pilihan_photo2_a', '$pilihan3', '$pilihan_photo3_a', '$pilihan4', '$pilihan_photo4_a', '$pilihan5', '$pilihan_photo5_a', '$jawaban', '$soal_file', '$poin', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//soal ukbm seleksi 
	function insert_soal_ukbm_select(){
		
		$dbpdo = DB::create();
		
		try {
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$jmldata		=	(empty($_POST["jmldata"])) ? 0 : $_POST["jmldata"];
			$k=0;
			for($k=0; $k<$jmldata; $k++) {
				$replid			=	$_POST[replid_.$k];
				$pilih			=	$_POST[pilih_.$k];
				
				$sqlstr = "update soal_ukbm set aktif='$pilih', uid_select='$uid', dlu_select='$dlu' where replid='$replid'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();	
			}
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//soal ukbm siswa
	function insert_soal_ukbm_siswa(){
		
		$dbpdo = DB::create();
		
		try {
			
			$tanggal		=   date("Y-m-d", strtotime($_POST["tanggal"]));
			$idsiswa		=	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
			$idsemester		=	(empty($_POST["idsemester"])) ? 0 : $_POST["idsemester"];
			$idukbm			=	(empty($_POST["idukbm"])) ? 0 : $_POST["idukbm"];
			
			$jmldata		=	(empty($_POST["jmldata"])) ? 0 : $_POST["jmldata"];
			$k=0;
			for($k=0; $k<$jmldata; $k++) {
				$replid			=	$_POST[replid_.$k];
				$jawaban		=	$_POST[jawaban_.$k];
				
				$sqlstr = "insert into soal_ukbm_siswa (tanggal, idsiswa, idsemester, idukbm, idsoal, jawaban) values ('$tanggal', '$idsiswa', '$idsemester', '$idukbm', '$replid', '$jawaban')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();	
			}
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//ukbm siswa
	function insert_ukbm_siswa(){
		
		$dbpdo = DB::create();
		
		try {
			
			$tanggal		=   date("Y-m-d", strtotime($_POST["tanggal"]));
			$idsiswa		=	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
			$idsemester		=	(empty($_POST["idsemester"])) ? 0 : $_POST["idsemester"];
			$idukbm			=	(empty($_POST["idukbm"])) ? 0 : $_POST["idukbm"];
			$ujian			=	(empty($_POST["ujian"])) ? 0 : $_POST["ujian"];
			$setuju			=	0;
			
			$sqlstr = "insert into ukbm_siswa (tanggal, idsiswa, idsemester, idukbm, ujian, setuju) values ('$tanggal', '$idsiswa', '$idsemester', '$idukbm', '$ujian', '$setuju')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//setup periode
	function insert_setup_periode(){
		
		$dbpdo = DB::create();
		
		try {
			
			$tanggal		=   date("Y-m-d", strtotime($_POST["tanggal"]));
			$tanggal1		=   date("Y-m-d", strtotime($_POST["tanggal1"]));
			$jenis			=	$_POST["jenis"];
			$tingkat_id		=	$_POST["tingkat_id"];
			$aktif			=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into setup_periode (tanggal, tanggal1, jenis, tingkat_id, aktif, uid, dlu) values ('$tanggal', '$tanggal1', '$jenis', '$tingkat_id', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//presensi ukbm
	function insert_presensi_ukbm($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$tanggal		=   date("Y-m-d", strtotime($_POST["tanggal"]));
			$tanggal		=   $tanggal . date("H:i:s");
			$tanggal		=   date("Y-m-d H:i:s", strtotime($tanggal));
			$idtingkat		=	(empty($_POST["idtingkat"])) ? 0 : $_POST["idtingkat"];
			$idkelas		=	(empty($_POST["idkelas"])) ? 0 : $_POST["idkelas"];
			$idsemester		=	(empty($_POST["idsemester"])) ? 0 : $_POST["idsemester"];
			$idpelajaran	=	(empty($_POST["idpelajaran"])) ? 0 : $_POST["idpelajaran"];
			$idguru			=	(empty($_POST["idguru"])) ? 0 : $_POST["idguru"];
			$idukbm			=	(empty($_POST["idukbm"])) ? 0 : $_POST["idukbm"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$idsiswa_id		=	array();
			$idsiswa_id		=	explode("|", $_POST["idsiswa"]);
			
			$hadir_id		=	array();
			$hadir_id		=	explode("|", $_POST["hadir"]);
			
			$dispensasi_id	=	array();
			$dispensasi_id	=	explode("|", $_POST["dispensasi"]);
			
			$sakit_id		=	array();
			$sakit_id		=	explode("|", $_POST["sakit"]);
			
			$izin_id		=	array();
			$izin_id		=	explode("|", $_POST["izin"]);
			
			$alpa_id		=	array();
			$alpa_id		=	explode("|", $_POST["alpa"]);
			
			$jmldata		=	count($idsiswa_id); //(empty($_POST["jmldata"])) ? 0 : $_POST["jmldata"];
			$k=0;
			for($k=0; $k<$jmldata; $k++) {
				$idsiswa		=	$idsiswa_id[$k]; //$_POST[idsiswa_.$k];
				$absen			=	0; //$_POST[absen_.$k];
				$hadir 			= 	0; //$hadir_id[$k];
				$dispensasi		=	$dispensasi_id[$k];
				$sakit			=	$sakit_id[$k];
				$izin			=	$izin_id[$k];
				$alpa			=	$alpa_id[$k];
				
				/*if($hadir == "hadir") {
					$hadir = 1;
				} else {
					$hadir = 0;
				}*/
				
				if($dispensasi == "dispensasi") {
					$dispensasi = 1;
				} else {
					$dispensasi = 0;
				}
				
				if($sakit == "sakit") {
					$sakit = 1;
				} else {
					$sakit = 0;
				}
				
				if($izin == "izin") {
					$izin = 1;
				} else {
					$izin = 0;
				}
				
				if($alpa == "alpa") {
					$alpa = 1;
				} else {
					$alpa = 0;
				}
				
				$tanggal2 = date("Y-m-d", strtotime($_POST["tanggal"]));
				$sqlstr = "select replid from presensi_ukbm where idsiswa='$idsiswa' and date_format(tanggal,'%Y-%m-%d')='$tanggal2' and idukbm='$idukbm' and idguru='$idguru' and ref='$ref'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$rows=$sql->rowCount();
				if($idsiswa != "") {
					if($rows == 0) {
						$sqlstr = "insert into presensi_ukbm (tanggal, idtingkat, idkelas, idsiswa, idpelajaran, idguru, idsemester, idukbm, hadir, dispensasi, sakit, izin, alpa, uid, dlu, ref) values ('$tanggal', '$idtingkat', '$idkelas', '$idsiswa', '$idpelajaran', '$idguru', '$idsemester', '$idukbm', '$hadir', '$dispensasi', '$sakit', '$izin', '$alpa', '$uid', '$dlu', '$ref')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();	
					} else {
						$sqlstr = "update presensi_ukbm set hadir='$hadir', dispensasi='$dispensasi', sakit='$sakit', izin='$izin', alpa='$alpa' where idsiswa='$idsiswa' and date_format(tanggal,'%Y-%m-%d')='$tanggal2' and idukbm='$idukbm' and idguru='$idguru' and ref='$ref'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
				}
			}
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//-----insert predikat raport
	function insert_predikat_raport(){
		$dbpdo = DB::create();
		
		try {
			
			$idangkatan			=	(empty($_POST["idangkatan"])) ? 0 : $_POST["idangkatan"];
			$idpelajaran		=	(empty($_POST["idpelajaran"])) ? 0 : $_POST["idpelajaran"];
			$kkm				=	numberreplace($_POST["kkm"]);
			$kkm_terampil		=	numberreplace($_POST["kkm_terampil"]);
			$nilai_angka_a		=	numberreplace($_POST["nilai_angka_a"]);
			$nilai_angka_a1		=	numberreplace($_POST["nilai_angka_a1"]);
			$nilai_angka_b		=	numberreplace($_POST["nilai_angka_b"]);
			$nilai_angka_b1		=	numberreplace($_POST["nilai_angka_b1"]);
			$nilai_angka_c		=	numberreplace($_POST["nilai_angka_c"]);
			$nilai_angka_c1		=	numberreplace($_POST["nilai_angka_c1"]);
			$nilai_angka_d		=	numberreplace($_POST["nilai_angka_d"]);
			$nilai_angka_d1		=	numberreplace($_POST["nilai_angka_d1"]);
			$nilai_huruf_a		=	$_POST["nilai_huruf_a"];
			$nilai_huruf_b		=	$_POST["nilai_huruf_b"];
			$nilai_huruf_c		=	$_POST["nilai_huruf_c"];
			$nilai_huruf_d		=	$_POST["nilai_huruf_d"];
			$deskripsi_p_a		=	petikreplace($_POST["deskripsi_p_a"]);
			$deskripsi_k_a		=	petikreplace($_POST["deskripsi_k_a"]);
			$deskripsi_p_b		=	petikreplace($_POST["deskripsi_p_b"]);
			$deskripsi_k_b		=	petikreplace($_POST["deskripsi_k_b"]);
			$deskripsi_p_c		=	petikreplace($_POST["deskripsi_p_c"]);
			$deskripsi_k_c		=	petikreplace($_POST["deskripsi_k_c"]);
			$deskripsi_p_d		=	petikreplace($_POST["deskripsi_p_d"]);
			$deskripsi_k_d		=	petikreplace($_POST["deskripsi_k_d"]);
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into predikat_raport (idangkatan, idpelajaran, kkm, kkm_terampil, nilai_angka_a, nilai_angka_a1, nilai_angka_b, nilai_angka_b1, nilai_angka_c, nilai_angka_c1, nilai_angka_d, nilai_angka_d1, nilai_huruf_a, nilai_huruf_b, nilai_huruf_c, nilai_huruf_d, deskripsi_p_a, deskripsi_k_a, deskripsi_p_b, deskripsi_k_b, deskripsi_p_c, deskripsi_k_c, deskripsi_p_d, deskripsi_k_d, uid, dlu) values ('$idangkatan', '$idpelajaran', '$kkm', '$kkm_terampil', '$nilai_angka_a', '$nilai_angka_a1', '$nilai_angka_b', '$nilai_angka_b1', '$nilai_angka_c', '$nilai_angka_c1', '$nilai_angka_d', '$nilai_angka_d1', '$nilai_huruf_a', '$nilai_huruf_b', '$nilai_huruf_c', '$nilai_huruf_d', '$deskripsi_p_a', '$deskripsi_k_a', '$deskripsi_p_b', '$deskripsi_k_b', '$deskripsi_p_c', '$deskripsi_k_c', '$deskripsi_p_d', '$deskripsi_k_d', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert deskripsi raport
	function insert_deskripsi_raport(){
		$dbpdo = DB::create();
		
		try {
			
			$idangkatan			=	(empty($_POST["idangkatan"])) ? 0 : $_POST["idangkatan"];
			$sikap				=	$_POST["sikap"];
			$sikap_a			=	petikreplace($_POST["sikap_a"]);
			$sikap_b			=	petikreplace($_POST["sikap_b"]);
			$sikap_c			=	petikreplace($_POST["sikap_c"]);
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into deskripsi_raport (idangkatan, sikap, sikap_a, sikap_b, sikap_c, uid, dlu) values ('$idangkatan', '$sikap', '$sikap_a', '$sikap_b', '$sikap_c', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert kelompok surat
	function insert_kelompok_surat(){
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	$_POST["kode"];
			$nama				=	petikreplace($_POST["nama"]);
			$uraian				=	petikreplace($_POST["uraian"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into kelompok_surat (kode, nama, uraian, aktif, uid, dlu) values ('$kode', '$nama', '$uraian', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	
	//-----insert surat keluar
	function insert_surat_keluar($ref){
		$dbpdo = DB::create();
		
		try {
			
			$no_surat			=	petikreplace($_POST["no_surat"]);
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));			
			$idkelompok_surat	=	(empty($_POST["idkelompok_surat"])) ? 0 : $_POST["idkelompok_surat"];
			$petugas			=	petikreplace($_POST["petugas"]);
			$tujuan				=	petikreplace($_POST["tujuan"]);
			
	  		//-----------upload file dokumen
			$uploaddir 	= 'app/surat_keluar/';
			$file_dokumen 	= $_FILES['file_dokumen']['name']; 
			$tmpname  	= $_FILES['file_dokumen']['tmp_name'];
			$filesize 	= $_FILES['file_dokumen']['size'];
			$filetype 	= $_FILES['file_dokumen']['type'];
			
			if($file_dokumen != "") {			
				$file_dokumen = $ref . '_' . $file_dokumen;					
				$uploadfile = $uploaddir . $file_dokumen;		
				if (move_uploaded_file($_FILES['file_dokumen']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
						
	  		$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
						
			$sqlstr = "insert into surat_keluar (ref, no_surat, tanggal, idkelompok_surat, petugas, tujuan, file_dokumen, uid, dlu) values ('$ref', '$no_surat', '$tanggal', '$idkelompok_surat', '$petugas', '$tujuan', '$file_dokumen', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert surat masuk
	function insert_surat_masuk($ref){
		$dbpdo = DB::create();
		
		try {
			
			$no_surat			=	petikreplace($_POST["no_surat"]);
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));			
			$idkelompok_surat	=	(empty($_POST["idkelompok_surat"])) ? 0 : $_POST["idkelompok_surat"];
			$petugas			=	petikreplace($_POST["petugas"]);
			$dari				=	petikreplace($_POST["dari"]);
			
	  		//-----------upload file dokumen
			$uploaddir 	= 'app/surat_masuk/';
			$file_dokumen 	= $_FILES['file_dokumen']['name']; 
			$tmpname  	= $_FILES['file_dokumen']['tmp_name'];
			$filesize 	= $_FILES['file_dokumen']['size'];
			$filetype 	= $_FILES['file_dokumen']['type'];
			
			if($file_dokumen != "") {			
				$file_dokumen = $ref . '_' . $file_dokumen;					
				$uploadfile = $uploaddir . $file_dokumen;		
				if (move_uploaded_file($_FILES['file_dokumen']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
						
	  		$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
						
			$sqlstr = "insert into surat_masuk (ref, no_surat, tanggal, idkelompok_surat, petugas, dari, file_dokumen, uid, dlu) values ('$ref', '$no_surat', '$tanggal', '$idkelompok_surat', '$petugas', '$dari', '$file_dokumen', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert buku kunjungan
	function insert_buku_kunjungan($ref){
		$dbpdo = DB::create();
		
		try {
			
			$nama				=	petikreplace($_POST["nama"]);
			$nohp				=	petikreplace($_POST["nohp"]);
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));			
			$ttd				=	(empty($_POST["ttd"])) ? 0 : $_POST["ttd"];
			$instansi			=	petikreplace($_POST["instansi"]);
			$keperluan			=	petikreplace($_POST["keperluan"]);
			$kesan_pesan		=	petikreplace($_POST["kesan_pesan"]);
			$keterangan			=	petikreplace($_POST["keterangan"]);
				
	  		$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
						
			$sqlstr = "insert into buku_kunjungan (ref, tanggal, nama, nohp, instansi, ttd, keperluan, kesan_pesan, keterangan, uid, dlu) values ('$ref', '$tanggal', '$nama', '$nohp', '$instansi', '$ttd', '$keperluan', '$kesan_pesan', '$keterangan', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//setup siswa khusus
	function insert_setup_siswa_khusus(){
		
		$dbpdo = DB::create();
		
		try {
			
			$tanggal		=   date("Y-m-d", strtotime($_POST["tanggal"]));
			$tanggal1		=   date("Y-m-d", strtotime($_POST["tanggal1"]));
			$jenis			=	$_POST["jenis"];
			$idsiswa		=	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into setup_siswa_khusus (tanggal, tanggal1, jenis, idsiswa, uid, dlu) values ('$tanggal', '$tanggal1', '$jenis', '$idsiswa', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//setup daftarnilai
	function insert_daftarnilai(){
		
		$dbpdo = DB::create();
		
		try {
			
			$idpelajaran 	= 	$_REQUEST['idpelajaran'];
			$departemen 	= 	$_REQUEST['departemen'];
			$idtingkat	 	= 	$_REQUEST['idtingkat'];
			$idkelas	 	= 	$_REQUEST['idkelas'];
			$nama		 	= 	$_REQUEST['nama'];
			$idkompetensi 	= 	(empty($_POST["idkompetensi"])) ? 0 : $_POST["idkompetensi"];
			$idjeniskompetensi 	= 	$_REQUEST['idjeniskompetensi'];
			$iddasarpenilaian	=	$_REQUEST['iddasarpenilaian'];
			$idtahunajaran	=	$_POST['idtahunajaran'];
			$idsemester		=	$_POST['semester_id'];
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$jmldata = $_POST['jmldata'];
			$x = 1;
			for ($x=1; $x<=$jmldata; $x++) {
				
				
				##header
				$nis		= $_POST["nis".$x.""];
				$uts 		= (empty($_POST["uts".$x.""])) ? 0 : $_POST["uts".$x.""]; //$_POST['uts.$x'];
				$jumlah		= (empty($_POST["jumlah".$x.""])) ? 0 : $_POST["jumlah".$x.""]; //$_POST['jumlah.$x'];
				$rata		= (empty($_POST["rata".$x.""])) ? 0 : $_POST["rata".$x.""]; //$_POST['rata.$x'];
				$persen		= (empty($_POST["persen".$x.""])) ? 0 : $_POST["persen".$x.""]; //$_POST['persen.$x'];
				if($_POST["uas".$x.""] != "") { 
					$uas		= numberreplace($_POST["uas".$x.""]);
				} else {
					$uas		= $_POST["uas".$x.""];
				}
				if($uas == "") {
					$uas = "NULL";
				}
				$persen1	= (empty($_POST["persen1".$x.""])) ? 0 : $_POST["persen1".$x.""];  //$_POST['persen1.$x'];
				$na			= (empty($_POST["na".$x.""])) ? 0 : $_POST["na".$x.""]; //$_POST['na.$x'];
				$a			= (empty($_POST["a".$x.""])) ? 0 : $_POST["a".$x.""]; //$_POST['a.$x'];

				$sakit		= (empty($_POST["sakit".$x.""])) ? 0 : $_POST["sakit".$x.""]; //$_POST['sakit.$x'];
				$izin		= (empty($_POST["izin".$x.""])) ? 0 : $_POST["izin".$x.""]; //$_POST['izin.$x'];
				$alpa		= (empty($_POST["alpa".$x.""])) ? 0 : $_POST["alpa".$x.""]; //$_POST['alpa.$x'];
				$dispensasi	=  (empty($_POST["dispensasi".$x.""])) ? 0 : $_POST["dispensasi".$x.""]; //$_POST['dispensasi.$x'];
				$sikap		= strtoupper($_POST["sikap".$x.""]);
				
				##cek data header
				$sqlstr = "select a.replid, a.departemen, a.idtingkat, a.idkelas, a.idtahunajaran, a.idsemester, a.nis, a.idkompetensi, a.idjeniskompetensi, a.iddasarpenilaian, a.idpelajaran, a.uts, a.jumlah, a.rata, a.persen, a.uas, a.persen1, a.na, a.a, a.line from daftarnilai a where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran' order by a.replid";				
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$rowsdata = $sql->rowCount();
				$datanilai = $sql->fetch(PDO::FETCH_OBJ);
				
				if($n1 == '') { $n1 = 0; }
				if($n2 == '') { $n2 = 0; }
				if($n3 == '') { $n3 = 0; }
				if($n4 == '') { $n4 = 0; }
				if($line == '') { $line = 0; }

				$id_daftarnilai = "";
				if($rowsdata == 0) {					
					$sqlstr = "insert into daftarnilai (departemen, idtingkat, idkelas, idtahunajaran, idsemester, nis, idkompetensi, idjeniskompetensi, iddasarpenilaian, idpelajaran, n1, n2, n3, n4, uts, jumlah, rata, persen, uas, persen1, na, a, sakit, izin, alpa, dispensasi, sikap, line) values ('$departemen', '$idtingkat', '$idkelas', '$idtahunajaran', '$idsemester', '$nis', '$idkompetensi', '$idjeniskompetensi', '$iddasarpenilaian', '$idpelajaran', '$n1', '$n2', '$n3', '$n4', '$uts', '$jumlah', '$rata', '$persen', $uas, '$persen1', '$na', '$a', '$sakit', '$izin', '$alpa', '$dispensasi', '$sikap', '$line')";
					$sql2=$dbpdo->prepare($sqlstr);
					$sql2->execute();
					
					$sqlstr 		= 	"select last_insert_id() last_id";
					$results		=	$dbpdo->query($sqlstr);
					$data 			=  	$results->fetch(PDO::FETCH_OBJ);
					$id_daftarnilai	=	$data->last_id;
				} else {
					$sqlstr = "update daftarnilai set uts='$uts', jumlah='$jumlah', rata='$rata', persen='$persen', uas=$uas, persen1='$persen1', na='$na', a='$a', sakit='$sakit', izin='$izin', alpa='$alpa', dispensasi='$dispensasi', sikap='$sikap' where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran'";
					$sql3=$dbpdo->prepare($sqlstr);
					$sql3->execute();
					
					$id_daftarnilai = $datanilai->replid;
				}
			
				##detail
				$jumlah_ukbm	=	$_POST["jumlah_ukbm"];
				for($y=1; $y<=$jumlah_ukbm; $y++) {
					
					##cek data
					$line_det 	= $y; //$_POST[line_det.$y.$x];
					$sqlstr = "select replid from daftarnilai_detail where replid='$id_daftarnilai' and line='$line_det'";
					$sql4=$dbpdo->prepare($sqlstr);
					$sql4->execute();
					$rowsdet = $sql4->rowCount();
					if($rowsdet == 0) {
						$line = maxline('daftarnilai_detail', 'line', 'replid', $id_daftarnilai, '');
						
						if($_POST["n".$y.$x.$nis.""] != "") { 
							$nilai	= numberreplace($_POST["n".$y.$x.$nis.""]);
						} else {
							$nilai 	= $_POST["n".$y.$x.$nis.""];
						}
						if($nilai == "") {
							$nilai = "NULL";
						}
						$sqlstr = "insert into daftarnilai_detail (replid, nilai, line) values ('$id_daftarnilai', $nilai, '$line')";
						$sql5=$dbpdo->prepare($sqlstr);
						$sql5->execute();	
					} else {
						if($_POST["n".$y.$x.$nis.""] != "") { 
							$nilai	= numberreplace($_POST["n".$y.$x.$nis.""]);
						} else {
							$nilai 	= $_POST["n".$y.$x.$nis.""];
						}
						if($nilai == "") {
							$nilai = "NULL";
						}
						
						$sqlstr = "update daftarnilai_detail set nilai=$nilai where replid='$id_daftarnilai' and line='$line_det'";
						$sql6=$dbpdo->prepare($sqlstr);
						$sql6->execute();
					}
					
				}
				
			}
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//insert_raport_siswa
	function insert_raport_siswa(){
		
		$dbpdo = DB::create();
		
		try {
			
			$departemen 	= 	$_REQUEST['departemen'];
			$idtingkat	 	= 	$_REQUEST['idtingkat'];
			$idkelas	 	= 	$_REQUEST['idkelas'];
			$idtahunajaran	=	$_POST['idtahunajaran'];
			$idsemester		=	$_POST['idsemester'];
			$idsiswa	 	= 	$_REQUEST['idsiswa'];
			$sikap_spiritual= 	$_REQUEST['sikap_spiritual'];
			$sikap_spiritual_deskripsi 	= 	petikreplace($_REQUEST['sikap_spiritual_deskripsi']);
			$sikap_sosial 	= 	$_REQUEST['sikap_sosial'];
			$sikap_sosial_deskripsi		=	petikreplace($_REQUEST['sikap_sosial_deskripsi']);
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into raport (departemen, idtingkat, idkelas, idtahunajaran, idsemester, idsiswa, sikap_spiritual, sikap_spiritual_deskripsi, sikap_sosial, sikap_sosial_deskripsi, uid, dlu) values ('$departemen', '$idtingkat', '$idkelas', '$idtahunajaran', '$idsemester', '$idsiswa', '$sikap_spiritual', '$sikap_spiritual_deskripsi', '$sikap_sosial', '$sikap_sosial_deskripsi', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$sqlstr 		= 	"select last_insert_id() last_id";
			$results		=	$dbpdo->query($sqlstr);
			$data 			=  	$results->fetch(PDO::FETCH_OBJ);
			$replid			=	$data->last_id;
			
			//detail
			$jmldata = $_POST['jmldata'];
			$x = 0;
			for ($x=0; $x<=$jmldata; $x++) {
				
				$idpelajaran		= $_POST[idpelajaran_.$x];
				$kkm_p	 			= $_POST[kkm_p_.$x];
				$kkm_k				= $_POST[kkm_k_.$x];
				$sks				= $_POST[sks_.$x];
				$nilai_p			= $_POST[nilai_p_.$x];
				$nilai_p_predikat	= $_POST[nilai_p_predikat_.$x];
				$nilai_k			= $_POST[nilai_k_.$x];
				$nilai_k_predikat	= $_POST[nilai_k_predikat_.$x];				
				$rata				= $_POST[rata_.$x];
				$rata_beban			= $_POST[rata_beban_.$x];
				$kelompok_pelajaran	= $_POST[kelompok_pelajaran_.$x];
				
				$line = maxline('raport_pelajaran', 'line', 'replid', $replid, '');
				$sqlstr = "insert into raport_pelajaran (replid, idpelajaran, kkm_p, kkm_k, sks, nilai_p, nilai_p_predikat, nilai_k, nilai_k_predikat, rata, rata_beban, kelompok_pelajaran, line) values ('$replid', '$idpelajaran', '$kkm_p', '$kkm_k', '$sks', '$nilai_p', '$nilai_p_predikat', '$nilai_k', '$nilai_k_predikat', '$rata', '$rata_beban', '$kelompok_pelajaran', '$line')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
								
			}
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//-----insert materail
	function insert_material($code){		
		$dbpdo = DB::create();
		
		try {
			
			//$code			=	$_POST["code"];
			$old_code		=	$_POST["old_code"];
			$name			=	petikreplace($_POST["name"]);
			$item_group_id	=	(empty($_POST["item_group_id"])) ? 0 : $_POST["item_group_id"];
			$item_subgroup_id	=	(empty($_POST["item_subgroup_id"])) ? 0 : $_POST["item_subgroup_id"];
			$item_type_code		=	$_POST["item_type_code"];
			$item_category_id	=	(empty($_POST["item_category_id"])) ? 0 : $_POST["item_category_id"];
			$brand_id			=	(empty($_POST["brand_id"])) ? 0 : $_POST["brand_id"];
			$size_id			= 	$_POST["size_id"];  //	(empty($_POST["size_id"])) ? 0 : $_POST["size_id"];
			
			$uom_code_sales		=	$_POST["uom_code_sales"];
			$uom_code_stock		=	$uom_code_sales; //$_POST["uom_code_stock"];			
			$uom_code_purchase	=	$uom_code_sales; //$_POST["uom_code_purchase"];
			
			$minimum_stock		=	numberreplace((empty($_POST["minimum_stock"])) ? 0 : $_POST["minimum_stock"]);
			$maximum_stock		=	numberreplace((empty($_POST["maximum_stock"])) ? 0 : $_POST["maximum_stock"]);
			
			$consigned		=	(empty($_POST["consigned"])) ? 0 : $_POST["consigned"];
			$client_code	=	$_POST["client_code"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			$syscode		= 	random(25);
			
			
			//------------start upload photo
	  		/*include_once ("app/include/function_crop.php");
	  		
	  		$photo		= 	$_POST["photo"];
	  		$photo1 	= 	resize_image('photo', 'photo_item/', 'app/photo_item/', 'photo_item/', $code."_".$photo);
	  		$photo_a 	= 	$photo1;*/
	  		
			/*//-----------upload file
		  	$photo2				= $_POST["photo2"];
			$uploaddir_photo 	= 'app/photo_item/';
			$photo				= $_FILES['photo']['name']; 
			$tmpname_photo 		= $_FILES['photo']['tmp_name'];
			$filesize_photo 	= $_FILES['photo']['size'];
			$filetype_photo 	= $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} else {
				$photo = $photo;
			}
			
			if($photo != "") {
				$photo = $syscode . '_' . $photo;
				$uploaddir_photo = $uploaddir_photo . $photo;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}	
			//----------------*/
			
			$sqlstr="insert into item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, consigned, active, uid, dlu, syscode) values ('$code', '$old_code', '$name', '$item_group_id', '$item_subgroup_id', '$item_type_code', '$item_category_id', '$brand_id', '$size_id', '$uom_code_stock', '$uom_code_sales', '$uom_code_purchase', '$minimum_stock', '$maximum_stock', '$photo_a', '$consigned', '$active', '$uid', '$dlu', '$syscode')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
						
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert item group
	function insert_item_group(){	
		$dbpdo = DB::create();
		
		try {
				
			$code					=	$_POST["code"];
			$name					=	$_POST["name"];
			$costing_type			=	$_POST["costing_type"];
			$nonstock				=	(empty($_POST["nonstock"])) ? 0 : $_POST["nonstock"];
			
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into item_group (code, name, nonstock, costing_type, inventory_acccode, purchase_discount_acccode, goodintransit_acccode, workinprocess_acccode, cogs_acccode, consignment_acccode, location_id, active, uid, dlu) values('$code', '$name', '$nonstock', '$costing_type', '$inventory_acccode', '$purchase_discount_acccode', '$goodintransit_acccode', '$workinprocess_acccode', '$cogs_acccode', '$consignment_acccode', '$location_id', '$active', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//----------insert detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<=$jmldata; $i++) {
				
				$inventory_acccode		=	$_POST[inventory_acccode_.$i];
				$purchase_discount_acccode	=	$_POST[purchase_discount_acccode_.$i];
				$goodintransit_acccode	=	$_POST[goodintransit_acccode_.$i];
				$workinprocess_acccode	=	$_POST[workinprocess_acccode_.$i];
				$cogs_acccode			=	$_POST[cogs_acccode_.$i];
				$consignment_acccode	=	$_POST[consignment_acccode_.$i];
				$location_id	=	(empty($_POST[location_id_.$i])) ? 0 : $_POST[location_id_.$i];
				
				
				if ( !empty($location_id) || ($location_id <> 0) ) {
					
					$syscode2	= 	random(9);
									
					$line = maxline('item_group_detail', 'line', 'id_header', $syscode, '');
					
					$sqlstr="insert into item_group_detail (id_header, inventory_acccode, purchase_discount_acccode, goodintransit_acccode, workinprocess_acccode, cogs_acccode, consignment_acccode, location_id, line) values ('$lastid', '$inventory_acccode', '$purchase_discount_acccode', '$goodintransit_acccode', '$workinprocess_acccode', '$cogs_acccode', '$consignment_acccode', '$location_id', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();							
					
				}
			}
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
	
		return $sql;
	}
	
	//-----insert brand
	function insert_brand(){
		$dbpdo = DB::create();
		
		try {
					
			$code			=	$_POST["code"];
			$name			=	$_POST["name"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into brand (code, name, active, uid, dlu) values ('$code', '$name', '$active', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert build
	function insert_build($ref=''){	
		$dbpdo = DB::create();
		
		try {	
			$ref_id			    =	petikreplace($_POST["ref_id"]);
			$asset_name		    =	petikreplace($_POST["asset_name"]);
			$alias		        =	petikreplace($_POST["alias"]);
			$lokasi			    =	petikreplace($_POST["lokasi"]);
			$provinsi	    	=	$_POST["provinsi"];
			$kota	    		=	$_POST["kota"];
			$kecamatan	    	=	$_POST["kecamatan"];
			$desa	    		=	$_POST["desa"];
			$asset_type_id	    =	(empty($_POST["asset_type_id"])) ? 0 : $_POST["asset_type_id"];
	        $status			    =	$_POST["status"];
			$luas		        =	numberreplace($_POST["luas"]);
	        $sertifikat		    =   $_POST["sertifikat"];
	        $imb			    =	$_POST["imb"];
	        $tanggal_perolehan	=	date("Y-m-d", strtotime($_POST["tanggal_perolehan"]));
	        $pemilik_sebelum	=	$_POST["pemilik_sebelum"];
	        $contact_name		=	$_POST["contact_name"];
	        $no_pbb             =   $_POST["no_pbb"];
	        $group_block        =   $_POST["group_block"];
	        $alamat             =   petikreplace($_POST["alamat"]);
	        $lintang            =   numberreplace($_POST["lintang"]);
	        $bujur              =   numberreplace($_POST["bujur"]);
	        $nilai_perolehan    =   numberreplace($_POST["nilai_perolehan"]);
	        $nilai_amnesti      =   numberreplace($_POST["nilai_amnesti"]);
	        $pemilik_sekarang   =   petikreplace($_POST["pemilik_sekarang"]);
	        $pemilik_sekarang1  =   petikreplace($_POST["pemilik_sekarang1"]);
	        $pemilik_sekarang2  =   petikreplace($_POST["pemilik_sekarang2"]);
	        $shm			    =	$_POST["shm"];
	        $shm_nama		    =	$_POST["shm_nama"];
	        $ajb			    =	$_POST["ajb"];
	        $pbb			    =	$_POST["pbb"];
	        $keterangan			=	petikreplace($_POST["keterangan"]);
	        $active			    =	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			    =	$_SESSION["loginname"];
			$dlu			    =	date("Y-m-d H:i:s");
			
			/*create folder*/
			$photo_asset = 'app/photo_asset'; //.$ref;
			/*if (!file_exists($photo_asset) && !is_dir($photo_asset)) {
				@mkdir($photo_asset, 0777, true);
				@chmod('app/photo_asset', 0777);
				@chmod($photo_asset, 0777);
			}*/
			
			//-----------upload file
		  	$photo2				= $_POST["photo2"];
			$uploaddir_photo	= $photo_asset .'/';
			$photo				= $_FILES['photo']['name']; 
			$tmpname_photo 		= $_FILES['photo']['tmp_name'];
			$filesize_photo 	= $_FILES['photo']['size'];
			$filetype_photo 	= $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} else {
				$photo = $photo;
			}
			
			if($photo != "") {
				$photo = $ref . '_imb_' . $photo;
				$uploaddir_photo = $uploaddir_photo . $photo;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}	
			
			
			//----------------
			$sqlstr="insert into asset (ref, asset_name, alias, ref_id, lokasi, provinsi, kota, kecamatan, desa, asset_type_id, status, luas, sertifikat, imb, tanggal_perolehan, pemilik_sebelum, contact_name, no_pbb, group_block, alamat, lintang, bujur, nilai_perolehan, nilai_amnesti, pemilik_sekarang, pemilik_sekarang1, pemilik_sekarang2, photo, photo_1, photo_2, photo_3, photo_4, shm, shm_nama, ajb, pbb, keterangan, active, uid, dlu) values ('$ref', '$asset_name', '$alias', '$ref_id', '$lokasi', '$provinsi', '$kota', '$kecamatan', '$desa', '$asset_type_id', '$status', '$luas', '$sertifikat', '$imb', '$tanggal_perolehan', '$pemilik_sebelum', '$contact_name', '$no_pbb', '$group_block', '$alamat', '$lintang', '$bujur', '$nilai_perolehan', '$nilai_amnesti', '$pemilik_sekarang', '$pemilik_sekarang1', '$pemilik_sekarang2', '$photo', '$photo_1', '$photo_2', '$photo_3', '$photo_4', '$shm', '$shm_nama', '$ajb', '$pbb', '$keterangan', '$active', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert room
	function insert_room($ref=''){	
		$dbpdo = DB::create();
		
		try {	
			
			$asset_ref			=	$_POST["asset_ref"];
			$code		        =	$_POST["code"];
			$name		    	=	petikreplace($_POST["name"]);
			$employee_id	    =	(empty($_POST["employee_id"])) ? 0 : $_POST["employee_id"];
			$active			    =	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$booking			=	(empty($_POST["booking"])) ? 0 : $_POST["booking"];
			$booking_chamber	=	(empty($_POST["booking_chamber"])) ? 0 : $_POST["booking_chamber"];
			$uid			    =	$_SESSION["loginname"];
			$dlu			    =	date("Y-m-d H:i:s");
			
			//----------------
			$sqlstr="insert into asset_detail (ref, asset_ref, code, name, employee_id, active, booking, booking_chamber, uid, dlu) values ('$ref', '$asset_ref', '$code', '$name', '$employee_id', '$active', '$booking', '$booking_chamber', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//------insert room registration
	function insert_room_registration($ref){
		$dbpdo = DB::create();
		
		try {
			
			$date			=	date("Y-m-d", strtotime($_POST["date"]));
			$name			=	petikreplace($_POST["name"]);				
			$identity_type_id	=	$_POST["identity_type_id"];
			$identity_no	=	$_POST["identity_no"];
			$email			=	$_POST["email"];
			$phone			=	$_POST["phone"];
			$address		=	petikreplace($_POST["address"]);
			$memo			=	petikreplace($_POST["memo"]);
			
			$from_time		=	$_POST["from_time"];
			$to_time		=	$_POST["to_time"];
			
			$booked			=	$_POST["booked"];
			$booked			=	$booked . " " . $from_time;
			$booked			=	date("Y-m-d H:i", strtotime($booked));
			
			$booked_finish	=	$_POST["booked_finish"];
			$booked_finish	=	$booked_finish . " " . $to_time;
			$booked_finish	=	date("Y-m-d H:i", strtotime($booked_finish));
			
			$total_days		=	$_POST["total_days"];
			
			/*include_once ("app/include/functions.php");
			$days			= 	datediff($booked, $booked_finish);
			$total_days		=	$days['days'];*/
					
			$arriving		=	date("Y-m-d", strtotime($_POST["arriving"]));
			$sex			=	$_POST["sex"];
			$checkout_date	=	date("Y-m-d", strtotime($_POST["checkout_date"]));
			$booking		=	1;
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into room_registration(ref, date, name, identity_type_id, identity_no, email, phone, address, booking, booked, booked_finish, arriving, sex, checkout_date, memo, uid, dlu) values('$ref', '$date', '$name', '$identity_type_id', '$identity_no', '$email', '$phone', '$address', '$booking', '$booked', '$booked_finish', '$arriving', '$sex', '$checkout_date', '$memo', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
			//----------insert user detail
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<=$jmldata; $i++) {
				
				$registration_slc = (empty($_POST[registration_slc_.$i])) ? 0 : $_POST[registration_slc_.$i];
				
				if ($registration_slc == 1) { 	
							
					$room_ref = $_POST[room_ref_.$i];
					
					$line = maxline('room_registration_detail', 'line', 'ref', $ref, '');
											
					$sqlstr="insert into room_registration_detail (ref, date, to_date, room_ref, line) values ('$ref', '$booked', '$booked_finish', '$room_ref', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
						
					/*$add_day = 0;
					$z = 0;
					for($z=0; $z<=$total_days; $z++) {
				
						$add_day		=	$z;
						$date_of		=	date("Y-m-d H:i", strtotime($booked . '+ '.$add_day. 'day'));
						
						$line = maxline('room_registration_detail', 'line', 'ref', $ref, '');
											
						$sqlstr="insert into room_registration_detail (ref, date, room_ref, line) values ('$ref', '$date_of', '$room_ref', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}*/
					
				}
			}
					
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert guru absen
	function insert_guru_absen(){
		$dbpdo = DB::create();
		
		try {
			
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));
			$idguru				=	(empty($_POST["idguru"])) ? 0 : $_POST["idguru"];
			$idtingkat			=	(empty($_POST["idtingkat"])) ? 0 : $_POST["idtingkat"];
			$idkelas			=	(empty($_POST["idkelas"])) ? 0 : $_POST["idkelas"];
			$alasan				=	petikreplace($_POST["alasan"]);
			$tugas				=	petikreplace($_POST["tugas"]);
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into guru_absen (tanggal, idguru, idtingkat, idkelas, alasan, tugas, uid, dlu) values ('$tanggal', '$idguru', '$idtingkat', '$idkelas', '$alasan', '$tugas', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert siswa terlambat
	function insert_siswa_terlambat(){
		$dbpdo = DB::create();
		
		try {
			
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));
			$idsiswa			=	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
			$idtingkat			=	(empty($_POST["idtingkat"])) ? 0 : $_POST["idtingkat"];
			$idkelas			=	(empty($_POST["idkelas"])) ? 0 : $_POST["idkelas"];
			$alasan				=	petikreplace($_POST["alasan"]);
			$penanganan			=	petikreplace($_POST["penanganan"]);
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into siswa_terlambat (tanggal, idsiswa, idtingkat, idkelas, alasan, penanganan, uid, dlu) values ('$tanggal', '$idsiswa', '$idtingkat', '$idkelas', '$alasan', '$penanganan', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert siswa izin
	function insert_siswa_izin(){
		$dbpdo = DB::create();
		
		try {
			
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));
			$idsiswa			=	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
			$idtingkat			=	(empty($_POST["idtingkat"])) ? 0 : $_POST["idtingkat"];
			$idkelas			=	(empty($_POST["idkelas"])) ? 0 : $_POST["idkelas"];
			$alasan				=	petikreplace($_POST["alasan"]);
			$penanganan			=	petikreplace($_POST["penanganan"]);
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into siswa_izin (tanggal, idsiswa, idtingkat, idkelas, alasan, penanganan, uid, dlu) values ('$tanggal', '$idsiswa', '$idtingkat', '$idkelas', '$alasan', '$penanganan', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert kejadian lain
	function insert_kejadian_lain(){
		$dbpdo = DB::create();
		
		try {
			
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));
			$jenis				=	petikreplace($_POST["jenis"]);
			$penanganan			=	petikreplace($_POST["penanganan"]);
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into kejadian_lain (tanggal, jenis, penanganan, uid, dlu) values ('$tanggal', '$jenis', '$penanganan', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert guru bk
	function insert_guru_bk(){
		$dbpdo = DB::create();
		
		try {
			
			$idguru				=	(empty($_POST["idguru"])) ? 0 : $_POST["idguru"];
			$idtahunajaran		=	(empty($_POST["idtahunajaran"])) ? 0 : $_POST["idtahunajaran"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into guru_bk (idtahunajaran, idguru, aktif, uid, dlu) values ('$idtahunajaran', '$idguru', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//------insert_guru_penugasan
	function insert_guru_penugasan(){
		$dbpdo = DB::create();
		
		try {
			
			$idtahunajaran	=	(empty($_POST["idtahunajaran"])) ? 0 : $_POST["idtahunajaran"];
			$idpegawai		=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$aktif			=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
					
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			//----------insert detail
			$datakelas = (empty($_POST['datakelas'])) ? 0 : $_POST['datakelas'];
			for ($x=0; $x<$datakelas; $x++) {
				
				$idtingkat = (empty($_POST[idtingkat_.$x])) ? 0 : $_POST[idtingkat_.$x];
				
				$jmldata = (empty($_POST[jmldata_.$x])) ? 0 : $_POST[jmldata_.$x];
				for ($i=0; $i<=$jmldata; $i++) {
					
					$idkelas = (empty($_POST[idkelas_.$x.$i])) ? 0 : $_POST[idkelas_.$x.$i];
					$pilihkelas = (empty($_POST[pilihkelas_.$x.$i])) ? 0 : $_POST[pilihkelas_.$x.$i];
					if ($pilihkelas == 1) { 	
								
						$sqlstr = "select replid from guru_penugasan where idguru='$idpegawai' and idtahunajaran='$idtahunajaran' and idtingkat='$idtingkat' and idkelas='$idkelas'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$rows=$sql->rowCount();
						
						if($rows == 0) {
							$sqlstr="insert into guru_penugasan (idtahunajaran, idguru, idtingkat, idkelas, aktif, uid, dlu) values ('$idtahunajaran', '$idpegawai', '$idtingkat', '$idkelas', '$aktif', '$uid', '$dlu')";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();	
						}
						
					}
				}
			}
					
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert siswa baru
	function insert_siswa_baru($ref){
		$dbpdo = DB::create();
		
		try {
			
			$idangkatan			=	(empty($_POST["idangkatan"])) ? 0 : $_POST["idangkatan"];
			$idangkatan1		=	(empty($_POST["idangkatan1"])) ? 0 : $_POST["idangkatan1"];
			
			/*--------Keterangan pribadi---------*/
			$nis				=	$_POST["nis"];
			$nisn				=	$_POST["nisn"];
			$nik				=	$_POST["nik"];
			$nama				=	petikreplace($_POST["nama"]);
			$panggilan			=	petikreplace($_POST['panggilan']);
			$idkelas			=	(empty($_POST["idkelas"])) ? 0 : $_POST["idkelas"];
			$tglmasuk			=	date("Y-m-d", strtotime($_POST["tglmasuk"]));
			$kelamin			=	$_POST["kelamin"];
			$tmplahir			=	$_POST["tmplahir"];
			$tgllahir			=	date("Y-m-d", strtotime($_POST["tgllahir"]));
			$agama				=	$_POST["agama"];
			$warga				=	$_POST["warga"];
			$anakke				=	(empty($_POST["anakke"])) ? 0 : $_POST["anakke"];
			$jsaudara			=	(empty($_POST["jsaudara"])) ? 0 : $_POST["jsaudara"];
			$jtiri				=	(empty($_POST["jtiri"])) ? 0 : $_POST["jtiri"];
			$jangkat			=	(empty($_POST["jangkat"])) ? 0 : $_POST["jangkat"];
			$yatim				=	(empty($_POST["yatim"])) ? 0 : $_POST["yatim"];
			$bahasa				=	$_POST["bahasa"];
			
			/*--------Keterangan tempat tinggal---------*/
            $desa_kode          =	$_POST["desa_kode"];
            $kecamatan_kode     =	$_POST["kecamatan_kode"];
            $kota_kode          =	$_POST["kota_kode"];
            $provinsi_kode      =	$_POST["provinsi_kode"];
            
			$alamatsiswa		=	$_POST["alamatsiswa"];
			$rt_siswa			=	$_POST["rt_siswa"];
			$rw_siswa			=	$_POST["rw_siswa"];
			$dusun				=	$_POST["dusun"];	
			$desa				=	$_POST["desa"];	
			$kecamatan			=	$_POST["kecamatan"];
			$alamatortu			=	$_POST["alamatortu"];
			$kodepossiswa		=	$_POST["kodepossiswa"];
			$telponsiswa		=	$_POST["telponsiswa"];
			$hpsiswa			=	$_POST["hpsiswa"];
			$emailsiswa			=	$_POST["emailsiswa"];
			$jenistinggal		=	$_POST["jenistinggal"];
			$kps				=	(empty($_POST["kps"])) ? 0 : $_POST["kps"];
			$nokps				=	$_POST["nokps"];
			$kip				=	(empty($_POST["kip"])) ? 0 : $_POST["kip"];
			$nokip				=	$_POST["nokip"];
			$namakip			=	$_POST["namakip"];
			$nokks				=	$_POST["nokks"];
			$no_akte_lahir		=	$_POST["no_akte_lahir"];
			$telponortu			=	$_POST["telponortu"];
			$hportu				=	$_POST["hportu"];
			$hpibu				=	$_POST["hpibu"];
			$transportasi_kode	=	$_POST["transportasi_kode"];
			$transportasi_lain	=	$_POST["transportasi_lain"];
			$jaraksekolah		=	numberreplace($_POST["jaraksekolah"]);
			$kesekolah			=	(empty($_POST["kesekolah"])) ? 0 : $_POST["kesekolah"];
			$alumni				=	$_POST["alumni"];
			
			/*--------Keterangan kesehatan---------*/
			$berat				=	numberreplace($_POST["berat"]);
			$tinggi				=	numberreplace($_POST["tinggi"]);
			$kesehatan			=	$_POST["kesehatan"]; //riwayat penyakit
			$darah				=	$_POST["darah"];
			
			//-----------upload file fotocopy golongan darah
			$uploaddir = 'app/file_darah/';
			$file_darah = $_FILES['file_darah']['name']; 
			$tmpname  = $_FILES['file_darah']['tmp_name'];
			$filesize = $_FILES['file_darah']['size'];
			$filetype = $_FILES['file_darah']['type'];

			
			if($file_darah != "") {			
				$file_darah = $nis . $idkelas . '_' . $file_darah;					
				$uploadfile = $uploaddir . $file_darah;		
				if (move_uploaded_file($_FILES['file_darah']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			$kelainan			=	$_POST["kelainan"];
			
			
			/*--------Keterangan pendidikan sebelumnya---------*/
			$asalsekolah_id		=	petikreplace($_POST["asalsekolah_id"]); //(empty($_POST["asalsekolah_id"])) ? 0 : $_POST["asalsekolah_id"];
			$kota_asalsekolah	=	petikreplace($_POST["kota_asalsekolah"]);
			$tglijazah			=	date("Y-m-d", strtotime($_POST["tglijazah"]));
			$noijazah			=	$_POST["noijazah"];
			$tglskhun			=	date("Y-m-d", strtotime($_POST["tglskhun"]));
			$skhun				=	$_POST["skhun"];
			$noujian			=	$_POST["noujian"];
			$nisnasal			=	$_POST["nisnasal"];
			
			/*--------Keterangan orang tua---------*/
			$nik_ayah			=	$_POST["nik_ayah"];
			$namaayah			=	$_POST["namaayah"];
			$nik_ibu			=	$_POST["nik_ibu"];
			$namaibu			=	$_POST["namaibu"];
			$tmplahirayah		=	$_POST["tmplahirayah"];
			$tgllahirayah		=	date("Y-m-d", strtotime($_POST["tgllahirayah"]));
            $tempat_bekerja_ayah=   $_POST["tempat_bekerja_ayah"];
            
			$tmplahiribu		=	$_POST["tmplahiribu"];
			$tgllahiribu		=	date("Y-m-d", strtotime($_POST["tgllahiribu"]));
			$pekerjaanayah		=	$_POST["pekerjaanayah"];
			$pekerjaanayah_lain	=	$_POST["pekerjaanayah_lain"];
			$pekerjaanibu		=	$_POST["pekerjaanibu"];
			$pekerjaanibu_lain	=	$_POST["pekerjaanibu_lain"];
            $tempat_bekerja_ibu =   $_POST["tempat_bekerja_ibu"];
            
			$penghasilanayah_kode	=	(empty($_POST["penghasilanayah_kode"])) ? 0 : $_POST["penghasilanayah_kode"];
			$penghasilanayah	=	numberreplace($_POST["penghasilanayah"]);
			$penghasilanibu_kode	=	(empty($_POST["penghasilanibu_kode"])) ? 0 : $_POST["penghasilanibu_kode"];
			$penghasilanibu		=	numberreplace($_POST["penghasilanibu"]);
			
			/*--------pendidikan formal orang tua tertinggi---------*/
			$pendidikanayah		=	$_POST["pendidikanayah"];
			$pendidikanibu		=	$_POST["pendidikanibu"];
			$wnayah				=	$_POST["wnayah"];
			$wnibu				=	$_POST["wnibu"];
			
			/*--------Keterangan wali---------*/
			$nik_wali			=	$_POST["nik_wali"];
			$wali				=	$_POST["wali"];
			$tmplahirwali		=	$_POST["tmplahirwali"];
			$tgllahirwali		=	date("Y-m-d", strtotime($_POST["tgllahirwali"]));
			$pendidikanwali		=	(empty($_POST["pendidikanwali"])) ? 0 : $_POST["pendidikanwali"];
			$pekerjaanwali		=	(empty($_POST["pekerjaanwali"])) ? 0 : $_POST["pekerjaanwali"];
			$pekerjaanwali_lain	=	$_POST["pekerjaanwali_lain"];
			$penghasilanwali_kode	=	(empty($_POST["penghasilanwali_kode"])) ? 0 : $_POST["penghasilanwali_kode"];
			$penghasilanwali	=	numberreplace($_POST["penghasilanwali"]);
            $tempat_bekerja_wali=   $_POST["tempat_bekerja_wali"];
            
			$alamatwali			=	petikreplace($_POST["alamatwali"]);
			$hpwali				=	$_POST["hpwali"];
			$hubungansiswa		=	$_POST["hubungansiswa"];
			
			//new
	        $tahun_ijazah		=	(empty($_POST["tahun_ijazah"])) ? 0 : $_POST["tahun_ijazah"];
	        $tahunskhun			=	(empty($_POST["tahunskhun"])) ? 0 : $_POST["tahunskhun"];
	        $kebutuhan_khusus_chk=	(empty($_POST["kebutuhan_khusus_chk"])) ? 0 : $_POST["kebutuhan_khusus_chk"];
	        $jenis_tinggal		=	$_POST["jenis_tinggal"];
	        $kebutuhan_khusus_chk1=	(empty($_POST["kebutuhan_khusus_chk1"])) ? 0 : $_POST["kebutuhan_khusus_chk1"];
	        $kebutuhan_khusus	=	petikreplace($_POST["kebutuhan_khusus"]);
	        $citacita			=	$_POST["citacita"];
	        $citacita_lain		=	petikreplace($_POST["citacita_lain"]);
	        $tahunayah			=	(empty($_POST["tahunayah"])) ? 0 : $_POST["tahunayah"];
	        $kodeposortu		=	$_POST["kodeposortu"];
	        $butuhkhususketayah	=	petikreplace($_POST["butuhkhususketayah"]);
	        $tahunibu			=	(empty($_POST["tahunibu"])) ? 0 : $_POST["tahunibu"];
	        $kodeposibu			=	$_POST["kodeposibu"];
	        $butuhkhususibu		=	(empty($_POST["butuhkhususibu"])) ? 0 : $_POST["butuhkhususibu"];
	        $butuhkhususketibu	=	petikreplace($_POST["butuhkhususketibu"]);
	        $tahunwali			=	(empty($_POST["tahunwali"])) ? 0 : $_POST["tahunwali"];
	        $jarak_km			=	numberreplace($_POST["jarak_km"]);
	        $waktutempuh		=	numberreplace($_POST["waktutempuh"]);
	        $waktutempuh_menit	=	numberreplace($_POST["waktutempuh_menit"]);
	        
	        $almayah			=	(empty($_POST["almayah"])) ? 0 : $_POST["almayah"];
	        $butuhkhususayah	=	(empty($_POST["butuhkhususayah"])) ? 0 : $_POST["butuhkhususayah"];
	        $almibu				=	(empty($_POST["almibu"])) ? 0 : $_POST["almibu"];
	        $alamatibu			=	petikreplace($_POST["alamatibu"]);
	        //------end new
	        
			
			/*--------Lain lain ------*/
			$rombel_id			=	(empty($_POST["rombel_id"])) ? 0 : $_POST["rombel_id"];
			$nama_bank			=	$_POST["nama_bank"];
			$no_rekening_bank	=	$_POST["no_rekening_bank"];
			$nama_pemilik_bank	=	$_POST["nama_pemilik_bank"];
			$pip				=	(empty($_POST["pip"])) ? 0 : $_POST["pip"];
			$alasan_pip			=	petikreplace($_POST["alasan_pip"]);
			$virtualaccount		=	$_POST['virtualaccount'];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$idminat			=	$_POST["idminat"];	
			$jalurmasuk			=	$_POST["jalurmasuk"];
			$jalurmasuk_id		=	$_POST["jalurmasuk_id"];
			$jalurmasukprestasi_id = (empty($_POST["jalurmasukprestasi_id"])) ? 0 : $_POST["jalurmasukprestasi_id"];
			$idgugus			=	$_POST["idgugus"];
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			//-----------upload file foto
			$uploaddir = 'app/file_foto_siswa/';
			$foto_file = $_FILES['foto_file']['name']; 
			$tmpname  = $_FILES['foto_file']['tmp_name'];
			$filesize = $_FILES['foto_file']['size'];
			$filetype = $_FILES['foto_file']['type'];

			
			if($foto_file != "") {			
				$foto_file = $nis . '_' . $foto_file;					
				$uploadfile = $uploaddir . $foto_file;		
				if (move_uploaded_file($_FILES['foto_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			//-----------upload file_jalurmasuk
			$uploaddir = 'app/file_jalurmasuk/';
			$file_jalurmasuk = $_FILES['file_jalurmasuk']['name']; 
			$tmpname  = $_FILES['file_jalurmasuk']['tmp_name'];
			$filesize = $_FILES['file_jalurmasuk']['size'];
			$filetype = $_FILES['file_jalurmasuk']['type'];

			
			if($file_jalurmasuk != "") {			
				$file_jalurmasuk = $nisn . '_' . $file_jalurmasuk;					
				$uploadfile = $uploaddir . $file_jalurmasuk;		
				if (move_uploaded_file($_FILES['file_jalurmasuk']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
						
			//-----------upload file rekam BK
			$uploaddir = 'app/file_rekam_bk/';
			$file_rekam_bk = $_FILES['file_rekam_bk']['name']; 
			$tmpname  = $_FILES['file_rekam_bk']['tmp_name'];
			$filesize = $_FILES['file_rekam_bk']['size'];
			$filetype = $_FILES['file_rekam_bk']['type'];

			
			if($file_rekam_bk != "") {			
				$file_rekam_bk = $nis . '_' . $file_rekam_bk;					
				$uploadfile = $uploaddir . $file_rekam_bk;		
				if (move_uploaded_file($_FILES['file_rekam_bk']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			//-----------upload file memo ortu
			$uploaddir = 'app/file_memo_ortu/';
			$file_memo_ortu = $_FILES['file_memo_ortu']['name']; 
			$tmpname  = $_FILES['file_memo_ortu']['tmp_name'];
			$filesize = $_FILES['file_memo_ortu']['size'];
			$filetype = $_FILES['file_memo_ortu']['type'];

			
			if($file_memo_ortu != "") {			
				$file_memo_ortu = $nis . '_' . $file_memo_ortu;					
				$uploadfile = $uploaddir . $file_memo_ortu;		
				if (move_uploaded_file($_FILES['file_memo_ortu']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			//-----------upload file_nilai_un
			$uploaddir = 'app/file_nilai_un/';
			$file_nilai_un = $_FILES['file_nilai_un']['name']; 
			$tmpname  = $_FILES['file_nilai_un']['tmp_name'];
			$filesize = $_FILES['file_nilai_un']['size'];
			$filetype = $_FILES['file_nilai_un']['type'];

			
			if($file_nilai_un != "") {			
				$file_nilai_un = $nis . '_' . $file_nilai_un;					
				$uploadfile = $uploaddir . $file_nilai_un;		
				if (move_uploaded_file($_FILES['file_nilai_un']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			//-----------upload file_raport
			$uploaddir = 'app/file_raport/';
			$file_raport = $_FILES['file_raport']['name']; 
			$tmpname  = $_FILES['file_raport']['tmp_name'];
			$filesize = $_FILES['file_raport']['size'];
			$filetype = $_FILES['file_raport']['type'];

			
			if($file_raport != "") {			
				$file_raport = $nis . '_' . $file_raport;					
				$uploadfile = $uploaddir . $file_raport;		
				if (move_uploaded_file($_FILES['file_raport']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			
			//-----------upload file_kk
			$uploaddir = 'app/file_kk/';
			$file_kk = $_FILES['file_kk']['name']; 
			$tmpname  = $_FILES['file_kk']['tmp_name'];
			$filesize = $_FILES['file_kk']['size'];
			$filetype = $_FILES['file_kk']['type'];

			
			if($file_kk != "") {			
				$file_kk = $nis . '_' . $file_kk;					
				$uploadfile = $uploaddir . $file_kk;		
				if (move_uploaded_file($_FILES['file_kk']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			
			//-----------upload file_akte
			$uploaddir = 'app/file_akte/';
			$file_akte = $_FILES['file_akte']['name']; 
			$tmpname  = $_FILES['file_akte']['tmp_name'];
			$filesize = $_FILES['file_akte']['size'];
			$filetype = $_FILES['file_akte']['type'];

			
			if($file_akte != "") {			
				$file_akte = $nis . '_' . $file_akte;					
				$uploadfile = $uploaddir . $file_akte;		
				if (move_uploaded_file($_FILES['file_akte']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			
			//-----------upload file_ijazah
			$uploaddir = 'app/file_ijazah/';
			$file_ijazah = $_FILES['file_ijazah']['name']; 
			$tmpname  = $_FILES['file_ijazah']['tmp_name'];
			$filesize = $_FILES['file_ijazah']['size'];
			$filetype = $_FILES['file_ijazah']['type'];

			
			if($file_ijazah != "") {			
				$file_ijazah = $nis . '_' . $file_ijazah;					
				$uploadfile = $uploaddir . $file_ijazah;		
				if (move_uploaded_file($_FILES['file_ijazah']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			
			
			//-----------upload file_nhun
			$uploaddir = 'app/file_nhun/';
			$file_nhun = $_FILES['file_nhun']['name']; 
			$tmpname  = $_FILES['file_nhun']['tmp_name'];
			$filesize = $_FILES['file_nhun']['size'];
			$filetype = $_FILES['file_nhun']['type'];

			
			if($file_nhun != "") {			
				$file_nhun = $nis . '_' . $file_nhun;					
				$uploadfile = $uploaddir . $file_nhun;		
				if (move_uploaded_file($_FILES['file_nhun']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			
			$sqlstr = "insert into siswa (nis, nisn, nik, idangkatan, idangkatan1, foto_file, nama, panggilan, idkelas, tglmasuk, kelamin, tmplahir, tgllahir, agama, warga, anakke, jsaudara, jtiri, jangkat, yatim, bahasa, desa_kode, kecamatan_kode, kota_kode, provinsi_kode, alamatsiswa, rt_siswa, rw_siswa, dusun, desa, kecamatan, kodepossiswa, jenistinggal, alamatortu, telponsiswa, hpsiswa, emailsiswa, telponortu, hportu, hpibu, transportasi_kode, kps, nokps, kip, nokip, namakip, nokks, no_akte_lahir, transportasi_lain, jaraksekolah, kesekolah, berat, tinggi, kesehatan, darah, file_darah, kelainan, asalsekolah_id, kota_asalsekolah, tglijazah, noijazah, tglskhun, skhun, noujian, nisnasal, nik_ayah, namaayah, nik_ibu, namaibu, tmplahirayah, tgllahirayah, tempat_bekerja_ayah, tmplahiribu, tgllahiribu, pekerjaanayah, pekerjaanibu, penghasilanayah_kode, penghasilanayah, penghasilanibu_kode, penghasilanibu, pendidikanayah, pendidikanibu, wnayah, wnibu, nik_wali, wali, tmplahirwali, tgllahirwali, pendidikanwali, pekerjaanwali, penghasilanwali_kode, penghasilanwali, tempat_bekerja_wali, alamatwali, hpwali, hubungansiswa, pekerjaanayah_lain, pekerjaanibu_lain, tempat_bekerja_ibu, pekerjaanwali_lain, rombel_id, nama_bank, no_rekening_bank, nama_pemilik_bank, pip, alasan_pip, idminat, jalurmasuk_id, jalurmasuk, jalurmasukprestasi_id, file_rekam_bk, file_memo_ortu, file_nilai_un, file_raport, file_kk, file_akte, file_ijazah, file_nhun, uid, aktif, ts, tahun_ijazah, tahunskhun, kebutuhan_khusus_chk, jenis_tinggal, kebutuhan_khusus_chk1, kebutuhan_khusus, citacita, citacita_lain, tahunayah, kodeposortu, butuhkhususketayah, tahunibu, kodeposibu, butuhkhususibu, butuhkhususketibu, tahunwali, jarak_km, waktutempuh, waktutempuh_menit, almayah, butuhkhususayah, almibu, alamatibu, alumni, idgugus, file_jalurmasuk) values ('$nis', '$nisn', '$nik', '$idangkatan', '$idangkatan1', '$foto_file', '$nama', '$panggilan', '$idkelas', '$tglmasuk', '$kelamin', '$tmplahir', '$tgllahir', '$agama', '$warga', '$anakke', '$jsaudara', '$jtiri', '$jangkat', '$yatim', '$bahasa', '$desa_kode', '$kecamatan_kode', '$kota_kode', '$provinsi_kode', '$alamatsiswa', '$rt_siswa', '$rw_siswa', '$dusun', '$desa', '$kecamatan', '$kodepossiswa', '$jenistinggal', '$alamatortu', '$telponsiswa', '$hpsiswa', '$emailsiswa', '$telponortu', '$hportu', '$hpibu', '$transportasi_kode', '$kps', '$nokps', '$kip', '$nokip', '$namakip', '$nokks', '$no_akte_lahir', '$transportasi_lain', '$jaraksekolah', '$kesekolah', '$berat', '$tinggi', '$kesehatan', '$darah', '$file_darah', '$kelainan', '$asalsekolah_id', '$kota_asalsekolah', '$tglijazah', '$noijazah', '$tglskhun', '$skhun', '$noujian', '$nisnasal', '$nik_ayah', '$namaayah', '$nik_ibu', '$namaibu', '$tmplahirayah', '$tgllahirayah', '$tempat_bekerja_ayah', '$tmplahiribu', '$tgllahiribu', '$pekerjaanayah', '$pekerjaanibu', '$penghasilanayah_kode', '$penghasilanayah', '$penghasilanibu_kode', '$penghasilanibu', '$pendidikanayah', '$pendidikanibu', '$wnayah', '$wnibu', '$nik_wali', '$wali', '$tmplahirwali', '$tgllahirwali', '$pendidikanwali', '$pekerjaanwali', '$penghasilanwali_kode', '$penghasilanwali', '$tempat_bekerja_wali', '$alamatwali', '$hpwali', '$hubungansiswa', '$pekerjaanayah_lain', '$pekerjaanibu_lain', '$tempat_bekerja_ibu', '$pekerjaanwali_lain', '$rombel_id', '$nama_bank', '$no_rekening_bank', '$nama_pemilik_bank', '$pip', '$alasan_pip', '$idminat', '$jalurmasuk_id', '$jalurmasuk', '$jalurmasukprestasi_id', '$file_rekam_bk', '$file_memo_ortu', '$file_nilai_un', '$file_raport', '$file_kk', '$file_akte', '$file_ijazah', '$file_nhun', '$uid', '$aktif', '$dlu', '$tahun_ijazah', '$tahunskhun', '$kebutuhan_khusus_chk', '$jenis_tinggal', '$kebutuhan_khusus_chk1', '$kebutuhan_khusus', '$citacita', '$citacita_lain', '$tahunayah', '$kodeposortu', '$butuhkhususketayah', '$tahunibu', '$kodeposibu', '$butuhkhususibu', '$butuhkhususketibu', '$tahunwali', '$jarak_km', '$waktutempuh', '$waktutempuh_menit', '$almayah', '$butuhkhususayah', '$almibu', '$alamatibu', '$alumni', '$idgugus', '$file_jalurmasuk')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//virtual account
			$sqlstr = "select nis from siswa_virtualaccount where nis='$nis'";
			$results1 = $dbpdo->query($sqlstr);
			$rows = $results1->rowCount();
			if($rows == 0) {
				$sqlstr = "insert into siswa_virtualaccount(nis, virtualaccount) values ('$nis', '$virtualaccount')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
			//-------get last ID
			$sqlstr 		= 	"select last_insert_id() last_id";
			$results		=	$dbpdo->query($sqlstr);
			$data 			=  	$results->fetch(PDO::FETCH_OBJ);
			$idsiswa		=	$data->last_id;
			
			//----------insert prestasi detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];		
			for ($x=0; $x<=$jmldata; $x++) {
				$jenisprestasi_ 	=	$_POST[jenisprestasi_.$x];
				$tingkat_ 			=	$_POST[tingkat_.$x];
				$nama_			 	=	$_POST[nama_.$x];
				$tahun_			 	=	(empty($_POST[tahun_.$x])) ? 0 : $_POST[tahun_.$x];
				$penyelenggara_		=	$_POST[penyelenggara_.$x];
				
				$line = maxline('siswa_prestasi', 'line', 'idsiswa', $idsiswa, '');
				
				if ( !empty($jenisprestasi_) ) {
					$sqlstr = "insert into siswa_prestasi (idsiswa, jenisprestasi, tingkat, nama, tahun, penyelenggara, line) values ('$idsiswa', '$jenisprestasi_', '$tingkat_', '$nama_', '$tahun_', '$penyelenggara_', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			
			//----------insert beasiswa detail
			$jmldata2 = (empty($_POST['jmldata2'])) ? 0 : $_POST['jmldata2'];		
			for ($x=0; $x<=$jmldata2; $x++) {
				$jenis_ 			=	$_POST[jenis_.$x];
				$penyelenggara2_	=	$_POST[penyelenggara_.$x];
				$tahunmulai_	 	=	(empty($_POST[tahunmulai_.$x])) ? 0 : $_POST[tahunmulai_.$x];
				$tahunselesai_	 	=	(empty($_POST[tahunselesai_.$x])) ? 0 : $_POST[tahunselesai_.$x];
				
				$line = maxline('siswa_beasiswa', 'line', 'idsiswa', $idsiswa, '');
				
				if ( !empty($jenis_) ) {
					$sqlstr = "insert into siswa_beasiswa (idsiswa, jenis, penyelenggara, tahunmulai, tahunselesai, line) values ('$idsiswa', '$jenis_', '$penyelenggara2_', '$tahunmulai_', '$tahunselesai_', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			//----------insert nilai UN
			$jmldata_un = (empty($_POST['jmldata_un'])) ? 0 : $_POST['jmldata_un'];		
			for ($x=0; $x<=$jmldata_un; $x++) {
				$replid_un3u 		=	$_POST[replid_un3u_.$x];
				$pelajaran_id3u		=	$replid_un3u;
				$nilai3u				=	numberreplace($_POST[nilai3u_.$x]);
				
				$line = maxline('siswa_nilai_un', 'line', 'nis', $nis, '');
				
				if ( $nilai3u > 0 ) {
					$sqlstr = "insert into siswa_nilai_un (nis, pelajaran_id, nilai, line) values ('$nis', '$pelajaran_id3u', '$nilai3u', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			
			//----------insert raport semester-1
			$jmldata_raport = (empty($_POST['jmldata_raport'])) ? 0 : $_POST['jmldata_raport'];		
			for ($x=0; $x<=$jmldata_raport; $x++) {
				$replid_un 			=	$_POST[replid_un_.$x];
				$pelajaran_id		=	$replid_un;
				$nilai				=	numberreplace($_POST[nilai_.$x]);
				
				$line = maxline('siswa_nilai_raport', 'line', 'nis', $nis, '');
				
				if ( $nilai > 0 ) {
					$sqlstr = "insert into siswa_nilai_raport (nis, semester, pelajaran_id, nilai, line) values ('$nis', '1', '$pelajaran_id', '$nilai', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			//----------insert raport semester-2
			$jmldata_raport1 = (empty($_POST['jmldata_raport1'])) ? 0 : $_POST['jmldata_raport1'];		
			for ($x=0; $x<=$jmldata_raport1; $x++) {
				$replid_un1 		=	$_POST[replid_un1_.$x];
				$pelajaran_id1		=	$replid_un1;
				$nilai1				=	numberreplace($_POST[nilai1_.$x]);
				
				$line = maxline('siswa_nilai_raport', 'line', 'nis', $nis, '');
				
				if ( $nilai1 > 0 ) {
					$sqlstr = "insert into siswa_nilai_raport (nis, semester, pelajaran_id, nilai, line) values ('$nis', '2', '$pelajaran_id1', '$nilai1', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			//----------insert raport semester-3
			$jmldata_raport2 = (empty($_POST['jmldata_raport2'])) ? 0 : $_POST['jmldata_raport2'];		
			for ($x=0; $x<=$jmldata_raport2; $x++) {
				$replid_un2 			=	$_POST[replid_un2_.$x];
				$pelajaran_id2		=	$replid_un2;
				$nilai2				=	numberreplace($_POST[nilai2_.$x]);
				
				$line = maxline('siswa_nilai_raport', 'line', 'nis', $nis, '');
				
				if ( $nilai2 > 0 ) {
					$sqlstr = "insert into siswa_nilai_raport (nis, semester, pelajaran_id, nilai, line) values ('$nis', '3', '$pelajaran_id2', '$nilai2', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			//----------insert raport semester-4
			$jmldata_raport3 = (empty($_POST['jmldata_raport3'])) ? 0 : $_POST['jmldata_raport3'];		
			for ($x=0; $x<=$jmldata_raport1; $x++) {
				$replid_un3			=	$_POST[replid_un3_.$x];
				$pelajaran_id3		=	$replid_un3;
				$nilai3				=	numberreplace($_POST[nilai3_.$x]);
				
				$line = maxline('siswa_nilai_raport', 'line', 'nis', $nis, '');
				
				if ( $nilai3 > 0 ) {
					$sqlstr = "insert into siswa_nilai_raport (nis, semester, pelajaran_id, nilai, line) values ('$nis', '4', '$pelajaran_id3', '$nilai3', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			//----------insert raport semester-5
			$jmldata_raport4 = (empty($_POST['jmldata_raport4'])) ? 0 : $_POST['jmldata_raport4'];		
			for ($x=0; $x<=$jmldata_raport4; $x++) {
				$replid_un4			=	$_POST[replid_un4_.$x];
				$pelajaran_id4		=	$replid_un4;
				$nilai4				=	numberreplace($_POST[nilai4_.$x]);
				
				$line = maxline('siswa_nilai_raport', 'line', 'nis', $nis, '');
				
				if ( $nilai4 > 0 ) {
					$sqlstr = "insert into siswa_nilai_raport (nis, semester, pelajaran_id, nilai, line) values ('$nis', '5', '$pelajaran_id4', '$nilai4', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			
			//generate user dan password serta hak akses menu : siswa baru			
			$ref		=	$idsiswa;
			$password	=	"123";
			$idpegawai	= 	$idsiswa;
			$usrid		= 	$idsiswa;
			//echo $insert + 1 . ") " . $usrid.">>".$datapeg->nama."<br>";
			//generate_user_siswa($usrid, $password, $idpegawai);	
			
			$pwd		=	obraxabrix($password, $usrid);
				
			$adm		=	0;
			$photo		=	"";
			$act		=	1;
			$uid		=	$idsiswa;
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlcek 	= 	"select usrid from usr where idpegawai='$idpegawai'"; // usrid='$usrid'";
			$sqlresult	=	$dbpdo->prepare($sqlcek);
			$sqlresult->execute();
			$rows		=	$sqlresult->rowCount();
			
			if($rows == 0) {
				$sqlstr="insert into usr (usrid,pwd,adm,idpegawai,tipe_user, photo,act,uid,dlu) values('$usrid','$pwd','$adm','$idpegawai', 'Siswa', '$photo','$act','$uid','$dlu')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				//--------insert table user backup
				$sqlstr="insert into usr_bup(usrid,pwd) values('$usrid','$password')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				//detail
				$strsql = "select frmcde from usr_frm where frmcde in ('frmsiswa_baru')";
				$sqldet=$dbpdo->prepare($strsql);
				$sqldet->execute();
				while($datadet=$sqldet->fetch(PDO::FETCH_OBJ)) {
					$usr_frmcde = $datadet->frmcde;
					
					$usr_add = 1;	
					$usr_edt = 1;			
					$usr_dlt = 0;
					$usr_lvl = 0;
									
					$sqlstr="insert into usr_dtl
					(usrid, frmcde, madd, medt, mdel, lvl)
						values
						(
							'".$usrid."',
							'".$usr_frmcde."',
							".$usr_add.",
							".$usr_edt.",
							".$usr_dlt.",
							'".$usr_lvl."'
						)";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
						
			}
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $ref;
	}
	
	
	//-----insert gugus
	function insert_gugus(){
		$dbpdo = DB::create();
		
		try {
			
			$gugus				=	$_POST["gugus"];
			$kapasitas			=	$_POST["kapasitas"];
			$kapasitas_l		=	$_POST["kapasitas_l"];
			$kapasitas_p		=	$_POST["kapasitas_p"];
			$dlu				=	date("Y-m-d H:i:s");
			$uid				=	$_SESSION["loginname"];
			
			$sqlstr = "insert into gugus (gugus, kapasitas, kapasitas_l, kapasitas_p, uid, dlu) values ('$gugus', '$kapasitas', '$kapasitas_l', '$kapasitas_p', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert infonap
	/*1. Jika siswa minat IPS, maka langsung ke IPS (meskipun nilai UN tinggi)
	2. Jika siswa minat IPA, maka dicek nilai UN (Matematika, Fisika) >= 80 (ada di setup nilai minat)
	3. Jika dicek nilai UN kurang dari yg ditentukan, maka masuk ke IPS*/
	function insert_infonap(){
		$dbpdo = DB::create();
		
		try {
			
			$idpelajaran		=	$_POST["idpelajaran"];
			$nilaimin			=	$_POST["nilaimin"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into infonap (idpelajaran, nilaimin, ts) values ('$idpelajaran', '$nilaimin', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert siswa ekskul
	function insert_siswa_input_ekskul(){
		$dbpdo = DB::create();
		
		try {
			
			$tanggal		=	date("Y-m-d", strtotime($_POST["tanggal"]));
			$idpelajaran	=	(empty($_POST["idpelajaran"])) ? 0 : $_POST["idpelajaran"];
			$idtahunajaran	=	(empty($_POST["idtahunajaran"])) ? 0 : $_POST["idtahunajaran"];
			$idsemester		=	(empty($_POST["idsemester"])) ? 0 : $_POST["idsemester"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			if($idpelajaran != "") {
				$jmldata	=	(empty($_POST["jmldata"])) ? 0 : $_POST["jmldata"];
				$k=0;
				for($k=0; $k<$jmldata; $k++) {
					$idsiswa	=	(empty($_POST[idsiswa_.$k])) ? 0 : $_POST[idsiswa_.$k];
					$pilih		=	(empty($_POST[pilih_.$k])) ? 0 : $_POST[pilih_.$k];
					
					if($pilih == 1) {
						$sqlstr = "select replid from siswa_ekstrakurikuler where idsiswa='$idsiswa' and idpelajaran='$idpelajaran' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$rows = $sql->rowCount();
						
						if($rows == 0) {
							$line = maxline('siswa_ekstrakurikuler', 'line', 'idsiswa', $idsiswa, '');			
							$sqlstr = "insert into siswa_ekstrakurikuler (idsiswa, idpelajaran, idtahunajaran, idsemester, tanggal, uid, dlu, line) values ('$idsiswa', '$idpelajaran', '$idtahunajaran', '$idsemester', '$tanggal', '$uid', '$dlu', '$line')";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						}
					}
					
				}
				
			}
					
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//setup periode raport
	function insert_setup_periode_raport(){
		
		$dbpdo = DB::create();
		
		try {
			
			$idtahunajaran	=	(empty($_POST["idtahunajaran"])) ? 0 : $_POST["idtahunajaran"];
			$semester_id	=	(empty($_POST["semester_id"])) ? 0 : $_POST["semester_id"];
			$tingkat_id		=	(empty($_POST["tingkat_id"])) ? 0 : $_POST["tingkat_id"];
			$tanggal_ttd	=   date("Y-m-d", strtotime($_POST["tanggal_ttd"]));
			$aktif			=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into setup_periode_raport (idtahunajaran, semester_id, tingkat_id, tanggal_ttd, aktif, uid, dlu) values ('$idtahunajaran', '$semester_id', '$tingkat_id', '$tanggal_ttd', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//setup periode raport pts
	function insert_setup_periode_raport_pts(){
		
		$dbpdo = DB::create();
		
		try {
			
			$idtahunajaran	=	(empty($_POST["idtahunajaran"])) ? 0 : $_POST["idtahunajaran"];
			$semester_id	=	(empty($_POST["semester_id"])) ? 0 : $_POST["semester_id"];
			$tingkat_id		=	(empty($_POST["tingkat_id"])) ? 0 : $_POST["tingkat_id"];
			$tanggal_ttd	=   date("Y-m-d", strtotime($_POST["tanggal_ttd"]));
			$aktif			=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into setup_periode_raport_pts (idtahunajaran, semester_id, tingkat_id, tanggal_ttd, aktif, uid, dlu) values ('$idtahunajaran', '$semester_id', '$tingkat_id', '$tanggal_ttd', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//-----insert penempatan kelas baru
	function insert_penempatan_siswa_baru(){
		$dbpdo = DB::create();
		
		try {
			
			$idkelas		=	$_POST["idkelas3"];			
			$idtingkat		=	$_POST["idtingkat3"];
			$idangkatan		=	$_POST["idangkatan"];
			$ts				=	date("Y-m-d H:i:s");
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($x=0; $x<$jmldata; $x++) {
				
				$replid			= $_POST[ref_.$x];
				$pilih  		= $_POST[pilih_.$x];
				$nis 	 		= $_POST[nis_.$x];
				
				if ($pilih == 1 && $nis != '') {
					/*$sqlstr = "select nis from siswa where nis='$nis'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rows=$sql->rowCount();
					
					if($rows == 0) {*/
						$sqlstr = "update siswa set nis='$nis', idkelas='$idkelas', alumni=0 where replid='$replid'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					/*} else {
						echo 'NIS : '.$nis.' sudah dipakai !!!<br>';
					}*/
						
				}
			}
						
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//setup daftarnilai pts
	function insert_daftarnilai_pts(){
		
		$dbpdo = DB::create();
		
		try {
			
			$idpelajaran 	= 	$_REQUEST['idpelajaran'];
			$departemen 	= 	$_REQUEST['departemen'];
			$idtingkat	 	= 	$_REQUEST['idtingkat'];
			$idkelas	 	= 	$_REQUEST['idkelas'];
			$nama		 	= 	$_REQUEST['nama'];
			$idkompetensi 	= 	(empty($_POST["idkompetensi"])) ? 0 : $_POST["idkompetensi"];
			$idjeniskompetensi 	= 	$_REQUEST['idjeniskompetensi'];
			$iddasarpenilaian	=	$_REQUEST['iddasarpenilaian'];
			$idtahunajaran	=	$_POST['idtahunajaran'];
			$idsemester		=	$_POST['semester_id'];
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$jmldata = $_POST['jmldata'];
			$x = 1;
			for ($x=1; $x<=$jmldata; $x++) {
				
				
				##header
				$nis		= $_POST[nis.$x];
				$uts 		= (empty($_POST[uts.$x])) ? 0 : $_POST[uts.$x]; //$_POST['uts.$x'];
				$jumlah		= (empty($_POST[jumlah.$x])) ? 0 : $_POST[jumlah.$x]; //$_POST['jumlah.$x'];
				$rata		= (empty($_POST[rata.$x])) ? 0 : $_POST[rata.$x]; //$_POST['rata.$x'];
				$persen		= (empty($_POST[persen.$x])) ? 0 : $_POST[persen.$x]; //$_POST['persen.$x'];
				if($_POST[uas.$x] != "") { 
					$uas		= numberreplace($_POST[uas.$x]);
				} else {
					$uas		= $_POST[uas.$x];
				}
				if($uas == "") {
					$uas = "NULL";
				}
				$hadir		= (empty($_POST[hadir.$x])) ? 0 : $_POST[hadir.$x];  //$_POST['persen1.$x'];
				
				##cek data header
				$sqlstr = "select a.replid, a.departemen, a.idtingkat, a.idkelas, a.idtahunajaran, a.idsemester, a.nis, a.idkompetensi, a.idjeniskompetensi, a.iddasarpenilaian, a.idpelajaran, a.hadir, a.line from daftarnilai_pts a where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran' order by a.replid";				
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$rowsdata = $sql->rowCount();
				$datanilai = $sql->fetch(PDO::FETCH_OBJ);
				
				if($line == '') { $line = 0; }

				$id_daftarnilai = "";
				if($rowsdata == 0) {					
					$sqlstr = "insert into daftarnilai_pts (departemen, idtingkat, idkelas, idtahunajaran, idsemester, nis, idkompetensi, idjeniskompetensi, iddasarpenilaian, idpelajaran, hadir, line) values ('$departemen', '$idtingkat', '$idkelas', '$idtahunajaran', '$idsemester', '$nis', '$idkompetensi', '$idjeniskompetensi', '$iddasarpenilaian', '$idpelajaran', '$hadir', '$line')";
					$sql2=$dbpdo->prepare($sqlstr);
					$sql2->execute();
					
					$sqlstr 		= 	"select last_insert_id() last_id";
					$results		=	$dbpdo->query($sqlstr);
					$data 			=  	$results->fetch(PDO::FETCH_OBJ);
					$id_daftarnilai	=	$data->last_id;
				} else {
					$sqlstr = "update daftarnilai_pts set hadir='$hadir' where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran'";
					$sql3=$dbpdo->prepare($sqlstr);
					$sql3->execute();
					
					$id_daftarnilai = $datanilai->replid;
				}
			
				##detail
				$jumlah_ukbm	=	$_POST["jumlah_ukbm"];
				for($y=1; $y<=$jumlah_ukbm; $y++) {
					
					##cek data
					$line_det 	= $y; //$_POST[line_det.$y.$x];
					$sqlstr = "select replid from daftarnilai_pts_detail where replid='$id_daftarnilai' and line='$line_det'";
					$sql4=$dbpdo->prepare($sqlstr);
					$sql4->execute();
					$rowsdet = $sql4->rowCount();
					if($rowsdet == 0) {
						$line = maxline('daftarnilai_pts_detail', 'line', 'replid', $id_daftarnilai, '');
						
						if($_POST[n.$y.$x.$nis] != "") { 
							$nilai	= numberreplace($_POST[n.$y.$x.$nis]);
						} else {
							$nilai 	= $_POST[n.$y.$x.$nis];
						}
						if($nilai == "") {
							$nilai = "NULL";
						}
						$sqlstr = "insert into daftarnilai_pts_detail (replid, nilai, line) values ('$id_daftarnilai', $nilai, '$line')";
						$sql5=$dbpdo->prepare($sqlstr);
						$sql5->execute();	
					} else {
						if($_POST[n.$y.$x.$nis] != "") { 
							$nilai	= numberreplace($_POST[n.$y.$x.$nis]);
						} else {
							$nilai 	= $_POST[n.$y.$x.$nis];
						}
						if($nilai == "") {
							$nilai = "NULL";
						}
						
						$sqlstr = "update daftarnilai_pts_detail set nilai=$nilai where replid='$id_daftarnilai' and line='$line_det'";
						$sql6=$dbpdo->prepare($sqlstr);
						$sql6->execute();
					}
					
				}
				
			}
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//-----insert receipt
	function insert_receipt($ref){	
		$dbpdo = DB::create();
		
		try {
			
			$date			=	date("Y-m-d", strtotime($_POST["date"]));
			$client_code	=	$_POST["client_code"];
			$memo			= 	$_POST["memo"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			
			//----------insert item packing detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			$sub_total = 0;
			for ($i=0; $i<$jmldata; $i++) {
				$select 		= $_POST["select_".$i.""];
				
				$invoice_no 	= $_POST["invoice_no_".$i.""];
				$amount_paid 	= numberreplace($_POST["amount_paid_".$i.""]);
							
				if ( !empty($invoice_no) && $amount_paid <> 0 && $select == 1 ) {
					
					$invoice_date		= date("Y-m-d", strtotime($_POST["invoice_date_".$i.""]));
					$invoice_due_date	= date("Y-m-d", strtotime($_POST["invoice_due_date_".$i.""]));
					$amount_due		= numberreplace($_POST["amount_due_".$i.""]);
					$discount 		= numberreplace($_POST["discount_".$i.""]);
					$currency_code 	= $_POST["currency_code_".$i.""];					
					$rate			= numberreplace($_POST["rate_".$i.""]);
					$ref_type		= $_POST["transaction_".$i.""];				
					$amount_due		= numberreplace($_POST["amount_due_".$i.""]);
					$amount 		= $amount_paid - $discount; //numberreplace($_POST[amount_.$i]);
					
					$line = maxline('receipt_detail', 'line', 'ref', $ref, '');
					
					$sqlstr="insert into receipt_detail (ref, invoice_no, invoice_date, invoice_due_date, discount, amount_paid, invoice_currency_code, invoice_rate, ref_type, amount_due, amount, line) values ('$ref', '$invoice_no', '$invoice_date', '$invoice_due_date', '$discount', '$amount_paid', '$currency_code', '$rate', '$ref_type', '$amount_due', '$amount', $line)";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//insert AR
					$sqlstr="insert into ar(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, discount_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu, line) values('$ref', '$invoice_no', '$date', '$invoice_due_date', 'C', '$client_code', '', 0, '$amount', '$discount', 'RCI', '$ref_type', '$currency_code', '$rate', '0', '00:00:00', 'C.O.D', '$memo', '$uid', '$dlu', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					
				}
			}
		
			
			$status				= 	$_POST["status"];			
			$receipt_type		=	$_POST["receipt_type"];
			$cheque_no			=	$_POST["cheque_no"];
			$cheque_date		=	date("Y-m-d", strtotime($_POST["cheque_date"]));
			$bank_name			=	$_POST["bank_name"];
			$credit_card_no		=	$_POST["credit_card_no"];
			$credit_card_code	=	(empty($_POST["credit_card_code"])) ? 0 : $_POST["credit_card_code"];
			$credit_card_holder	=	$_POST["credit_card_holder"];
			$credit_card_expired =	date("Y-m-d", strtotime($_POST["credit_card_expired"]));
			$account_code		= 	$_POST["account_code"];
			$currency_code		=	$_POST["currency_code"];
			$rate				=	numberreplace($_POST["rate"]);			
			$amount				=	numberreplace($_POST["amount"]);
			
			$round_amount		=	numberreplace($_POST["round_amount"]);
			$round_amount_account	=	$_POST["round_amount_account"];
			if($round_amount == 0) {
				$round_amount_account = "";	
			}
			
			$bank_charge		=	numberreplace($_POST["bank_charge"]);
			$bank_charge_account	= 	$_POST["bank_charge_account"];
			if($bank_charge == 0) {
				$bank_charge_account = "";
			}
			
			$sub_total			=	numberreplace($_POST["sub_total"]);
			$deposit			=	numberreplace($_POST["deposit"]);
			$type				=	$_POST["type"];
			
			$total				=	numberreplace($_POST["total"]);
			
			//------------start upload photo
	  		/*include_once ("app/include/function_crop.php");
	  		
	  		$file_transfer		= 	$_POST["file_transfer"];
	  		$file_transfer1 	= 	resize_image('file_transfer', 'file_transfer/', 'app/file_transfer/', 'file_transfer/', $ref."_".$file_transfer);
	  		$file_transfer_a 	= 	$file_transfer1;*/
			  	
			$sqlstr="insert into receipt (ref, date, status, client_code, receipt_type, cheque_no, cheque_date, bank_name, credit_card_no, credit_card_code, credit_card_holder, credit_card_expired, account_code, currency_code, rate, amount, deposit, sub_total, type, memo, round_amount, round_amount_account, bank_charge, bank_charge_account, opening_balance, total, uid, dlu) values('$ref', '$date', '$status', '$client_code', '$receipt_type', '$cheque_no', '$cheque_date', '$bank_name', '$credit_card_no', '$credit_card_code', '$credit_card_holder', '$credit_card_expired', '$account_code', '$currency_code', '$rate', '$amount', '$deposit', '$sub_total', '$type', '$memo', '$round_amount', '$round_amount_account', '$bank_charge', '$bank_charge_account', '0', '$total', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			if($receipt_type == "giro" || $receipt_type == "cheque") {
				
				//insert ARC
				$sqlstr="insert into arc (ref, date, client_code, cheque_no, bank_name, cheque_date, amount, currency_code, rate, account_code, type, memo, uid, dlu) values('$ref', '$date', '$client_code', '$cheque_no', '$bank_name', '$cheque_date', '$total', '$currency_code', '$rate', '$account_code', '$receipt_type', '$memo', '$uid', '$dlu')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();				
				
			}
			
			//insert DPS (Deposit)
			if($deposit < 0) {
				
				$debit = $deposit * -1;
				
				$sqlstr="insert into dps (ref, invoice_no, date, contact_code, contact_type, debit_amount, currency_code, rate, description, invoice_type, ref_type, uid, dlu) values ('$ref', '$ref', '$date', '$client_code', 'C', '$debit', '$currency_code', '$rate', '$memo', 'RCI', 'RCI', '$uid', '$dlu') ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
									
				
			}
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
		return $sql;
	}


	//------general journal in
	function insert_general_journal_in($ref){
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			$date			=	date('Y-m-d', strtotime($_POST["date"]));
			$status			= 	$_POST["status"];
			$currency_code	= 	$_POST["currency_code"];
			$rate			=	str_replace(",","",(empty($_POST["rate"])) ? 0 : $_POST["rate"]);
			$memo			= 	$_POST["memo"];
			$total_balance	=	str_replace(",","",(empty($_POST["total_balance"])) ? 0 : $_POST["total_balance"]);
			$total_debit	=	str_replace(",","",(empty($_POST["total_debit"])) ? 0 : $_POST["total_debit"]);
			$total_credit	=	str_replace(",","",(empty($_POST["total_credit"])) ? 0 : $_POST["total_credit"]);
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into general_journal(ref, date, status, currency_code, rate, memo, total_balance, total_debit, total_credit, uid, dlu) values('$ref', '$date', '$status', '$currency_code', '$rate', '$memo', '$total_balance', '$total_debit', '$total_credit', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<=$jmldata; $i++) {
				$account_code 		= $_POST["account_code_".$i.""];
				$memo2 				= $_POST["memo_".$i.""];
				$debit_amount		= str_replace(",","",(empty($_POST["debit_amount_".$i.""])) ? 0 : $_POST["debit_amount_".$i.""]);
				$credit_amount		= str_replace(",","",(empty($_POST["credit_amount_".$i.""])) ? 0 : $_POST["credit_amount_".$i.""]);
				
				if ($account_code != '') { 		
					
					$line = maxline('general_journal_detail', 'line', 'ref', $ref, '');
					
					$sqlstr = "insert into general_journal_detail(ref, account_code, memo, debit_amount, credit_amount, location_id, line) values('$ref', '$account_code', '$memo2', '$debit_amount', '$credit_amount', '0', '$line') ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
				}
				
			}
			
			$dbpdo->commit();
	
		}		
	
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	
	//------general journal
	function insert_general_journal($ref){
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			$date			=	date('Y-m-d', strtotime($_POST["date"]));
			$status			= 	$_POST["status"];
			$currency_code	= 	$_POST["currency_code"];
			$rate			=	str_replace(",","",(empty($_POST["rate"])) ? 0 : $_POST["rate"]);
			$memo			= 	$_POST["memo"];
			$total_balance	=	str_replace(",","",(empty($_POST["total_balance"])) ? 0 : $_POST["total_balance"]);
			$total_debit	=	str_replace(",","",(empty($_POST["total_debit"])) ? 0 : $_POST["total_debit"]);
			$total_credit	=	str_replace(",","",(empty($_POST["total_credit"])) ? 0 : $_POST["total_credit"]);
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into general_journal(ref, date, status, currency_code, rate, memo, total_balance, total_debit, total_credit, uid, dlu) values('$ref', '$date', '$status', '$currency_code', '$rate', '$memo', '$total_balance', '$total_debit', '$total_credit', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<=$jmldata; $i++) {
				$location_id 	= 0; //$_POST["location_id_".$i.""];
				$account_code 	= $_POST["account_code_".$i.""];
				$memo2 			= $_POST["memo_".$i.""];
				$debit_amount		= str_replace(",","",(empty($_POST["debit_amount_".$i.""])) ? 0 : $_POST["debit_amount_".$i.""]);
				$credit_amount		= str_replace(",","",(empty($_POST["credit_amount_".$i.""])) ? 0 : $_POST["credit_amount_".$i.""]);
				
				if ($account_code != '') { 		
					
					$line = maxline('general_journal_detail', 'line', 'ref', $ref, '');
					
					$sqlstr = "insert into general_journal_detail(ref, location_id, account_code, memo, debit_amount, credit_amount, line) values('$ref', '$location_id', '$account_code', '$memo2', '$debit_amount', '$credit_amount', '$line') ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
				}
				
			}
			
			$dbpdo->commit();
	
		}		
	
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert finance type
	function insert_finance_type($ref){
		$dbpdo = DB::create();
		
		try {
			
			$code			=	$ref; //$_POST["code"];
	        $name			=	petikreplace($_POST["name"]);
	        $location_id	=	(empty($_POST["location_id"])) ? 0 : $_POST["location_id"];
	        $type			=	$_POST["type"];
	        $account_code	=	$_POST["account_code"];
	        $active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
						
			$sqlstr="insert into finance_type (code, name, location_id, type, account_code, active, uid, dlu) values ('$code', '$name', '$location_id', '$type', '$account_code', '$active', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
	
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert coa
	function insert_coa(){
		$dbpdo = DB::create();
		
		try {
			
			$acc_code			=	$_POST["acc_code"];
			$name				=	$_POST["name"];
			$acc_type			=	(empty($_POST["acc_type"])) ? 0 : $_POST["acc_type"];
			$postable			=	(empty($_POST["postable"])) ? 0 : $_POST["postable"];
			$subacc_code		=	$_POST["subacc_code"];
			$opening_balance	=	(empty($_POST["opening_balance"])) ? 0 : $_POST["opening_balance"];
			$opening_balance_date	= date("Y-m-d", strtotime($_POST["opening_balance_date"]));
			$current_balance	=	$opening_balance; //(empty($_POST["current_balance"])) ? 0 : $_POST["current_balance"];
			
			$currency_code		=	(empty($_POST["currency_code"])) ? 0 : $_POST["currency_code"];
			$currency_rate		=	(empty($_POST["currency_rate"])) ? 0 : $_POST["currency_rate"];
			$currency_exchange_id		=	(empty($_POST["currency_exchange_id"])) ? 0 : $_POST["currency_exchange_id"];
			$level			=	(empty($_POST["level"])) ? 0 : $_POST["level"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			$syscode		= 	random(20);
		
			$sqlstr="insert into coa (acc_code, name, acc_type, postable, subacc_code, opening_balance, opening_balance_date, current_balance, currency_code, currency_rate, currency_exchange_id, level, active, uid, dlu, syscode) values('$acc_code', '$name', '$acc_type', '$postable', '$subacc_code', '$opening_balance', '$opening_balance_date', '$current_balance', '$currency_code', '$currency_rate', '$currency_exchange_id', '$level', '$active', '$uid', '$dlu', '$syscode')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
	
		return $sql;
	}
	
	
	//-----insert purchase_inv detail
	function insert_purchase_inv_detail($ref){	
		
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			$location_id	= $_POST['location_id'];		
			$item_code 		= $_POST['item_code'];
	        $item_code2		= $_POST['item_code2'];
			$uom_code 		= $_POST['uom_code'];
			$size 	    	= numberreplace($_POST['size']);
	        $qty 		    = numberreplace($_POST['qty']);
	        $unit_cost     	= numberreplace($_POST['unit_cost']);
	        $amount 	    = numberreplace($_POST['amount']);
	        $cash			=	(empty($_POST["cash"])) ? 0 : $_POST["cash"];
	        $stock_in		=	(empty($_POST["stock_in"])) ? 0 : $_POST["stock_in"];
	        $vendor_code	=	$_POST["vendor_code"];
			$payment_type	= $_POST["payment_type"];
					
					
	        //----------jika lookup gagal enter
	        $sqlstr 	= "select syscode, uom_code_purchase uom_code from item where (code='$item_code2' or old_code='$item_code2') limit 1";
	        $sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data 	= $sql->fetch(PDO::FETCH_OBJ); 
			
			if($item_code == '') {
				$item_code 	= $data->syscode;	
			}
			
			if($uom_code == '') {
				$uom_code	= $data->uom_code;	
			}
			
			
			$sqlprice = "select b.current_cost, a.name from item a left join set_item_cost b on a.syscode=b.item_code where a.syscode='$item_code' and a.uom_code_sales='$uom_code' order by b.date_of_record desc limit 1 ";
			$resultprice=$dbpdo->prepare($sqlprice);
			$resultprice->execute();
			$dataprice		= $resultprice->fetch(PDO::FETCH_OBJ);
			
			if($unit_cost == '' || $unit_cost == 0) {
				$unit_cost	= $dataprice->current_cost;	
			}
			
			if($qty == '' || $qty == 0) {
				$qty = 1;
			}
			
			if($amount == '' || $amount == 0) {
				$amount			= $dataprice->current_cost * 1;	
			}
			//---------------------------------/\
			
	       
	        if ( empty($item_code) && empty($uom_code) ) {
	            $sqlstr 	    = "select syscode, uom_code_purchase uom_code from item where (code='$item_code2' or code='$item_code2') limit 1";
	            $sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$data		= $sql->fetch(PDO::FETCH_OBJ);
				
				$item_code  = $data->syscode;
				if($uom_code == '') {
	            	$uom_code   = $data->uom_code; 
				}
	            
	            $sqlprice = "select b.current_cost, a.name from item a left join set_item_cost b on a.syscode=b.item_code where a.syscode='$item_code' and a.uom_code_purchase='$uom_code' and b.location_id='$location_id' order by b.date_of_record desc limit 1 ";
	            $resultprice=$dbpdo->prepare($sqlprice);
				$resultprice->execute();
				$dataprice		= $resultprice->fetch(PDO::FETCH_OBJ);
				
			    $unit_cost	    = $dataprice->current_cost;
	            $qty            = 1;
	            $amount         = $unit_price * $qty;
	            
	        }
						
			if ( !empty($item_code) && !empty($uom_code) ) {		
			
				$discount_det	= numberreplace($_POST['discount_det']);			
				$discount 		= $discount_det; //numberreplace($_POST['discount']);
	            $discount1 		= numberreplace($_POST['discount3_1_det']);
	            $discount2 		= numberreplace($_POST['discount3_2_det']);
	            $discount3 		= numberreplace($_POST['discount3_3_det']);
				$total	 		= numberreplace($_POST['total']);
				
				$uid			= $_SESSION["loginname"];
				
				//----------insert/update set_item_price (ditutup krn harga di seting di set item price aja)
				/*$sqlprice = "select item_code from set_item_price where item_code='$item_code' and uom_code='$uom_code' and current_price='$unit_price' and location_id='$location_id' order by date_of_record desc limit 1 ";
				$resultprice = mysql_query($sqlprice);
				$numprice = mysql_num_rows($resultprice);
				*/
				
				/*if($numprice == 0) {
					$sqlprice2 = "select current_price from set_item_price where item_code='$item_code' and uom_code='$uom_code' and location_id='$location_id' order by date_of_record desc limit 1 ";
					$resultprice2 = mysql_query($sqlprice2);
					$dataprice = mysql_fetch_object($resultprice2);
				
					$last_price			=	$dataprice->current_price;
					$date_of_record		=	date("Y-m-d H:i:s");
					
					$sqlstr="insert into set_item_price (date, efective_from, item_code, uom_code, current_price, last_price, date_of_record, location_id, uid, dlu) values ('$date', '$date', '$item_code', '$uom_code', '$unit_price', '$last_price', '$date_of_record', '$location_id', '$uid', '$dlu')";				
					QueryDbTrans($sql2, $success);
				}	*/
				//------------------------------------/\
				
				$sqlstr="select sum(qty) qty, item_code from purchase_invoice_tmp where ref='$ref' and vendor_code='$vendor_code' and item_code='$item_code' and	uom_code='$uom_code' group by ref, vendor_code, item_code, uom_code";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$rows=$sql->rowCount();
				$data=$sql->fetch(PDO::FETCH_OBJ);
				
				if($rows >0) {
					$qty = $data->qty + $qty;
					$amount = ($qty * ($unit_cost - $discount));
					//$amount = $qty * $unit_cost;
					$total = $amount;
					
					$sqlstr="update purchase_invoice_tmp set qty='$qty', size='$size', unit_cost='$unit_cost', discount1='$discount1', discount2='$discount2', discount3='$discount3', discount='$discount', amount='$amount', total='$total', payment_type='$payment_type', stock_in='$stock_in' where ref='$ref' and vendor_code='$vendor_code' and item_code='$item_code' and uom_code='$uom_code'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				} else {
				
					$line = maxline('purchase_invoice_tmp', 'line', 'ref', $ref, '');
					
					$sqlstr="insert into purchase_invoice_tmp (ref, vendor_code, item_code, uom_code, size, qty, discount1, discount2, discount3, discount, unit_cost, amount, total, location_id, payment_type, stock_in, uid, line) values ('$ref', '$vendor_code', '$item_code', '$uom_code', '$size', '$qty', '$discount1', '$discount2', '$discount3', '$discount_det', '$unit_cost', '$amount', '$total', '$location_id', '$payment_type', '$stock_in', '$uid', $line)";
		            $sql=$dbpdo->prepare($sqlstr);
					$sql->execute();	
				}
										
			}	
				
			$dbpdo->commit();
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert purchase inv
	function insert_purchase_inv($ref, $ref_tmp){	
				
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			$date				=	date("Y-m-d", strtotime($_POST["date"]));
			$location_id		=	(empty($_POST["location_id"])) ? 0 : $_POST["location_id"];
			$stock_in			= 	(empty($_POST["stock_in"])) ? 0 : $_POST["stock_in"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
				
			//----------insert item packing detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			$sub_total = 0;
			for ($i=0; $i<=$jmldata; $i++) {
				//$po_ref 		= $_POST[po_ref_.$i];
				$item_code 		= $_POST["item_code_".$i.""];
				$uom_code 		= $_POST["uom_code_".$i.""];
				
				if ( !empty($item_code) && !empty($uom_code) ) {							
					$qty = numberreplace($_POST["qty_".$i.""]);
					$unit_cost = numberreplace($_POST["unit_cost_".$i.""]);
					$size 		= numberreplace($_POST["size_".$i.""]);
					$discount = numberreplace($_POST["discount_".$i.""]);
	                $discount1 = numberreplace($_POST["discount3_1_".$i.""]);
	                $discount2 = numberreplace($_POST["discount3_2_".$i.""]);
	                $discount3 = numberreplace($_POST["discount3_3_".$i.""]);
					$amount = numberreplace($_POST["amount_".$i.""]); //$qty * $unit_cost; //numberreplace($_POST[amount_.$i]);
					$line_item_po = (empty($_POST["line_item_po_".$i.""])) ? 0 : $_POST["line_item_po_".$i.""];
					
					$line = maxline('purchase_invoice_detail', 'line', 'ref', $ref, '');
					
					$sqlstr="insert into purchase_invoice_detail (ref, po_ref, item_code, uom_code, size, qty, unit_cost, discount1, discount2, discount3, discount, amount, line_item_po, line) values ('$ref', '', '$item_code', '$uom_code', '$size', '$qty', '$unit_cost', '$discount1', '$discount2', '$discount3', '$discount', '$amount', '0', $line)";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//----------insert bincard (debit qty)
					if($stock_in == 1) {
						$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'purchase_inv', '', '$item_code', '$uom_code', '00:00:00', '$unit_cost', '$qty', 0, '$amount', '$line', '$uid', '$dlu')";				
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
					
					$sub_total = $sub_total + $amount;
					
					
					
				}
			}
			
			
				
			$invoice_no			=	$_POST["invoice_no"];
			$status				= 	"R"; //$_POST["status"];
			$bill_number		= 	$_POST["bill_number"];
			$vendor_code		= 	$_POST["vendor_code"];
			$top				= 	$_POST["top"];
			$tax_code			= 	$_POST["tax_code"];
			$tax_rate			=	numberreplace((empty($_POST["tax_rate"])) ? 0 : $_POST["tax_rate"]);
			$freight_cost		=	numberreplace((empty($_POST["freight_cost"])) ? 0 : $_POST["freight_cost"]);
			$freight_account	= 	petikreplace($_POST["freight_account"]);
			$discount 			= 	numberreplace($_POST["discount_det"]);
			$total				=	numberreplace($_POST["total"]); //$sub_total + $freight_cost;
			$memo				= 	petikreplace($_POST["memo"]);			
			$payment_type		=	$_POST["payment_type"];
			$cash				= 	(empty($_POST["cash"])) ? 0 : $_POST["cash"];
			$cash_amount		= 	numberreplace($_POST["cash_amount"]);
			$change_amount		=	numberreplace($_POST["change_amount"]);
			$due_date			=	date("Y-m-d", strtotime($_POST["due_date"]));
			
			$bank_id			=	(empty($_POST["bank_id"])) ? 0 : $_POST["bank_id"];
			$bank_amount		=	numberreplace($_POST["bank_amount"]);
			$credit_card_code	=	(empty($_POST["credit_card_code"])) ? 0 : $_POST["credit_card_code"];
			$card_amount		=	numberreplace($_POST["card_amount"]);
			$credit_card_no		=	$_POST["credit_card_no"];
			$credit_card_holder	=	petikreplace($_POST["credit_card_holder"]);
			
			$sqlstr="insert into purchase_invoice (ref, invoice_no, date, status, bill_number, vendor_code, top, due_date, tax_code, tax_rate, freight_cost, freight_account, memo, payment_type, location_id, cash, cash_amount, change_amount, discount, total, bank_id, bank_amount, credit_card_code, card_amount, credit_card_no, credit_card_holder, stock_in, uid, dlu) values('$ref', '$invoice_no', '$date', '$status', '$bill_number', '$vendor_code', '$top', '$due_date', '$tax_code', '$tax_rate', '$freight_cost', '$freight_account', '$memo', '$payment_type', '$location_id', '$cash', '$cash_amount', '$change_amount', '$discount', '$total', '$bank_id', '$bank_amount', '$credit_card_code', '$card_amount', '$credit_card_no', '$credit_card_holder', '$stock_in', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
			//insert AP
			if ($payment_type == "credit" || $payment_type == "consign") {
								
				$sqlstr="insert into ap(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu) values('$ref', '$ref', '$date', '$due_date', 'V', '$vendor_code', '', 0, '$total', 'POV', 'POV', '$currency_code', '0', '0', '00:00:00', '$top', '$memo', '$uid', '$dlu')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			
			}
			
			
			//-------delete invoice detail tmp
			$sqlstr="delete from purchase_invoice_tmp where ref='$ref_tmp' and uid='$uid' ";
		    $sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$dbpdo->commit();
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
			
		return $sql;
	}


	//-----insert good receipt
	function insert_good_receipt($ref){	
		
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			$date				=	date("Y-m-d", strtotime($_POST["date"]));	
			$vendor_code		= 	$_POST["vendor_code"];		
			$location_id		= 	$_POST["location_id"];
			$driver				= 	$_POST["driver"];
			$date_arrival		= 	date("Y-m-d", strtotime($_POST["date_arrival"]));
			$do_ref				= 	$_POST["do_ref"];
			$vehicle			=	$_POST["vehicle"];
			$status				= 	$_POST["status"];
			$memo				= 	petikreplace($_POST["memo"]);
			$receipt_type		=	$_POST["receipt_type"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			//----------insert item packing detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<=$jmldata; $i++) {
				$select 		= $_POST["select_".$i.""];
				
				$item_code 		= $_POST["item_code_".$i.""];
				$uom_code 		= $_POST["uom_code_".$i.""];
				$size 			= 0; //$_POST["size_".$i.""];
				$qty 			= numberreplace($_POST["qty_".$i.""]);
				$qty_po			= numberreplace($_POST["qty_po_".$i.""]);
							
				if ( !empty($item_code) && !empty($uom_code) && $qty > 0 ) {					
					$po_ref 		= $_POST["po_ref_".$i.""];
					$unit_cost		= numberreplace($_POST["unit_cost_".$i.""]);
					$pi_line		= $_POST["pi_line_".$i.""];
					
					$line = maxline('good_receipt_detail', 'line', 'ref', $ref, '');
					
					$sqlstr="insert into good_receipt_detail (ref, item_code, uom_code, size, po_ref, qty_po, qty, unit_cost, pi_line, line) values ('$ref', '$item_code', '$uom_code', '$size', '$po_ref', '$qty_po', '$qty', '$unit_cost', '$pi_line', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//insert bincard
					$amount = $unit_cost * $qty;
					$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'good_receipt', '$memo', '$item_code', '$uom_code', '00:00:00', '$unit_cost', '$qty', '0', '$amount', $line, '$uid', '$dlu')";		
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					if($receipt_type == "Pembelian") {
						##--------update qty sales order
						$sqlstr="update purchase_invoice_detail set qty_good=ifnull(qty_good,0) + $qty where ref='$po_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$pi_line' ";	
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
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
						
						if($qty_good <= 0) { //Released
							$sqlstr="update purchase_invoice set status='R' where ref='$po_ref' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						}
						##*****************************************##
					}
					
					
					if($receipt_type == "Jahit") {
						##--------update qty sewing
						$sqlstr="update sewing_detail set qty_good=ifnull(qty_good,0) + $qty where ref='$po_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$pi_line' ";	
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$sql2 = "select sum(ifnull(qty,0)) qty, sum(ifnull(qty_good,0)) qty_good from sewing_detail group by ref having ref='$po_ref'";
						$result=$dbpdo->prepare($sql2);
						$result->execute();
						$data = $result->fetch(PDO::FETCH_OBJ);
						
						$qty_good = $data->qty_good;
						$qty = $data->qty;
						
						if($qty_good > 0) {
							if($qty_good < $qty ) { //Kirim
								$sqlstr="update sewing set status='D' where ref='$po_ref' ";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();	
							}
							
							if($qty_good >= $qty ) { //Selesai
								$sqlstr="update sewing set status='F' where ref='$po_ref' ";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
							}
						}
						
						if($qty_good <= 0) { //Jahit
							$sqlstr="update sewing set status='S' where ref='$po_ref' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						}
						##*****************************************##
					}
					
					
					
				}
			}
			
			$sqlstr="insert into good_receipt (ref, date, status, vendor_code, date_arrival, driver, vehicle, location_id, do_ref, memo, receipt_type, uid, dlu) values('$ref', '$date', '$status', '$vendor_code', '$date_arrival', '$driver', '$vehicle', '$location_id', '$do_ref', '$memo', '$receipt_type', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$dbpdo->commit();	
		
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
			
		return $sql;
	}


	//-----insert payment
	function insert_payment($ref){	
		
		$dbpdo = DB::create();
		
		try {
			
	        $date			=	date("Y-m-d", strtotime($_POST["date"]));
			$vendor_code	=	$_POST["vendor_code"];
			$memo			= 	$_POST["memo"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
						
			//----------insert item packing detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			$sub_total = 0;
			for ($i=0; $i<=$jmldata; $i++) {
				$select 		= $_POST["select_".$i.""];
				
				$invoice_no 	= $_POST["invoice_no_".$i.""];
				$amount_paid 	= numberreplace($_POST["amount_paid_".$i.""]);
							
				if ( !empty($invoice_no) && $amount_paid <> 0 && $select == 1 ) {
					
					$invoice_date		= date("Y-m-d", strtotime($_POST["invoice_date_".$i.""]));
					$invoice_due_date	= date("Y-m-d", strtotime($_POST["invoice_due_date_".$i.""]));
					$amount_due		= numberreplace($_POST["amount_due_".$i.""]);
					$discount 		= numberreplace($_POST["discount_".$i.""]);
					$currency_code 	= $_POST["currency_code_".$i.""];					
					$rate			= numberreplace($_POST["rate_".$i.""]);
					$ref_type		= $_POST["transaction_".$i.""];				
					$amount_due		= numberreplace($_POST["amount_due_".$i.""]);
					$amount 		= $amount_paid - $discount; //numberreplace($_POST[amount_.$i]);
					
					$line = maxline('payment_detail', 'line', 'ref', $ref, '');
					
					$rate = 0;

					$sqlstr="insert into payment_detail (ref, invoice_no, invoice_date, invoice_due_date, discount, amount_paid, invoice_currency_code, invoice_rate, ref_type, amount_due, amount, line) values ('$ref', '$invoice_no', '$invoice_date', '$invoice_due_date', '$discount', '$amount_paid', '$currency_code', '$rate', '$ref_type', '$amount_due', '$amount', $line)";
	                $sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//insert AP
					$sqlstr="insert into ap(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, discount_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, line, uid, dlu) values('$ref', '$invoice_no', '$date', '$invoice_due_date', 'V', '$vendor_code', '', '$amount', 0, '$discount', 'PMT', '$ref_type', '$currency_code', '$rate', '0', '00:00:00', 'C.O.D', '$memo', $line, '$uid', '$dlu')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
				}
			}
			
							
			$status				= 	$_POST["status"];		
			$payment_type		=	$_POST["payment_type"];
			$cheque_no			=	$_POST["cheque_no"];
			$cheque_date		=	date("Y-m-d", strtotime($_POST["cheque_date"]));
			$bank_name			=	$_POST["bank_name"];
			$credit_card_no		=	$_POST["credit_card_no"];
			$credit_card_code	=	(empty($_POST["credit_card_code"])) ? 0 : $_POST["credit_card_code"];
			$credit_card_holder	=	$_POST["credit_card_holder"];
			$credit_card_expired =	date("Y-m-d", strtotime($_POST["credit_card_expired"]));
			$account_code		= 	$_POST["account_code"];
			$currency_code		=	$_POST["currency_code"];
			$rate				=	numberreplace($_POST["rate"]);			
			$amount				=	numberreplace($_POST["amount"]);
			
			$round_amount		=	numberreplace($_POST["round_amount"]);
			$round_amount_account	=	$_POST["round_amount_account"];
			if($round_amount == 0) {
				$round_amount_account = "";	
			}
			
			$bank_charge		=	numberreplace($_POST["bank_charge"]);
			$bank_charge_account	= 	$_POST["bank_charge_account"];
			if($bank_charge == 0) {
				$bank_charge_account = "";
			}
			
			$sub_total			=	numberreplace($_POST["sub_total"]);
			$deposit			=	numberreplace($_POST["deposit"]);
			$type				=	$_POST["type"];
			$no_ttfa			=	$_POST["no_ttfa"];
			
			$total				=	numberreplace($_POST["total"]);
			  	
			$sqlstr="insert into payment (ref, date, status, vendor_code, payment_type, cheque_no, cheque_date, bank_name, credit_card_no, credit_card_code, credit_card_holder, credit_card_expired, account_code, currency_code, rate, amount, deposit, sub_total, type, memo, round_amount, round_amount_account, bank_charge, bank_charge_account, opening_balance, total, no_ttfa, uid, dlu) values('$ref', '$date', '$status', '$vendor_code', '$payment_type', '$cheque_no', '$cheque_date', '$bank_name', '$credit_card_no', '$credit_card_code', '$credit_card_holder', '$credit_card_expired', '$account_code', '$currency_code', '$rate', '$amount', '$deposit', '$sub_total', '$type', '$memo', '$round_amount', '$round_amount_account', '$bank_charge', '$bank_charge_account', '0', '$total', '$no_ttfa', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			if($payment_type == "giro" || $payment_type == "cheque") {
				
				//insert APC
				//$sqlstr="insert into apc (ref, date, vendor_code, cheque_no, bank_name, cheque_date, amount, currency_code, rate, account_code, type, memo, uid, dlu) values('$ref', '$date', '$vendor_code', '$cheque_no', '$bank_name', '$cheque_date', '$total', '$currency_code', '$rate', '$account_code', '$receipt_type', '$memo', '$uid', '$dlu')";
				//QueryDbTrans($sql, $success);
                
                //--------detail giro
                $jmldatabg = (empty($_POST['jmldatabg'])) ? 0 : $_POST['jmldatabg'];
        		
                $i = 0;
        		for ($i=0; $i<=$jmldatabg; $i++) {
        			
        			$account_code    = $_POST[account_code_.$i];
                    $cheque_no       = $_POST[cheque_no_.$i];
                    $bank_name       = $_POST[bank_name_.$i];
                    $cheque_date     = date("Y-m-d", strtotime($_POST["cheque_date_.$i"]));
                    $amountbg      	 = numberreplace($_POST[amountbg_.$i]);
        						
        			if ( !empty($account_code) && !empty($cheque_no) && $amountbg <> 0 ) {
        				
                        //insert APC
        				$sqlstr="insert into payment_giro (ref, account_code, cheque_no, bank_name, cheque_date, amountbg, line) values('$ref', '$account_code', '$cheque_no', '$bank_name', '$cheque_date', '$amountbg', '$i')";
        				$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
                        
        				//insert APC
        				$sqlstr="insert into apc (ref, date, vendor_code, cheque_no, bank_name, cheque_date, amount, currency_code, rate, account_code, type, uid, dlu, line) values('$ref', '$date', '$vendor_code', '$cheque_no', '$bank_name', '$cheque_date', '$amountbg', '$currency_code', '$rate', '$account_code', '$receipt_type', '$uid', '$dlu', $i)";
                        $sql=$dbpdo->prepare($sqlstr);
						$sql->execute();	
        				
        			}
        		}				
				
			}
				
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
		return $sql;
	}


	
}

?>
