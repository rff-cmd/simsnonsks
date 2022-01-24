<?php

class update{
	
	//------update user
	function update_usr($ref,$photo){
		$dbpdo = DB::create();
		
		try {
			
			$usrid		=	$_POST["usrid"];
			$old_usrid	=	$_POST["old_usrid"];				
			$pass_ori	=	$_POST["pwd"];
			$pwd		=	obraxabrix($pass_ori, $usrid);
			$adm		=	(empty($_POST["adm"])) ? 0 : $_POST["adm"];
			$idpegawai	=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$lvl		=	$_POST["lvl"];
			$tipe_user	=	$_POST["tipe_user"];
			//$image		=	$_POST["image"];
			$brncde		=	$_POST["brncde"];
			$image2		=	$_POST["image2"];
			$departemen	=	$_POST["departemen"];
			$ganti_pwd_no	=  (empty($_POST["ganti_pwd_no"])) ? 0 : $_POST["ganti_pwd_no"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			$act		=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			
			//-----------upload file
		  	/*$photo2	= $_POST["photo2"];
			$uploaddir_photo = 'app/photo_usr/';
			$photo		= $_FILES['photo']['name']; 
			$tmpname_photo 	= $_FILES['photo']['tmp_name'];
			$filesize_photo 	= $_FILES['photo']['size'];
			$filetype_photo 	= $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} else {
				$photo = $photo;
			}
			
			if($photo != "") {
					
				if($photo != $photo2) {
					
					if(!empty($photo2)) {
						unlink($uploaddir_photo . $photo2); //remove file 
					}
					
					$photo = $usrid . '_' . $photo;
				}
				$uploaddir_photo = $uploaddir_photo . $photo;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}	*/
			//----------------
			
			if ($_POST["pwd"]=='') {		
				
				$sqlstr = "update usr set usrid='$usrid',adm='$adm', departemen='$departemen', idpegawai='$idpegawai', tipe_user='$tipe_user', ganti_pwd_no='$ganti_pwd_no', act='$act',uid='$uid',dlu='$dlu' where id='$ref' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			
			} else {
				
				$sqlstr = "update usr set usrid='$usrid',pwd='$pwd',adm='$adm', departemen='$departemen', idpegawai='$idpegawai', tipe_user='$tipe_user', ganti_pwd_no='$ganti_pwd_no', act='$act',uid='$uid',dlu='$dlu' where id='$ref' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
			
			//----------insert user detail
			$usr_jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($i=1; $i<=$usr_jmldata; $i++) {
				$usr_slc = (empty($_POST['usr_slc_'.$i.''])) ? 0 : $_POST['usr_slc_'.$i.''];
				$usr_old = (empty($_POST['usr_old_'.$i.''])) ? 0 : $_POST['usr_old_'.$i.''];
				
				$usr_frmcde = $_POST['usr_frmcde_'.$i.''];
				$usr_add = (empty($_POST['usr_add_'.$i.''])) ? 0 : $_POST['usr_add_'.$i.''];
				$usr_edt = (empty($_POST['usr_edt_'.$i.''])) ? 0 : $_POST['usr_edt_'.$i.''];
				$usr_dlt = (empty($_POST['usr_dlt_'.$i.''])) ? 0 : $_POST['usr_dlt_'.$i.''];
				$usr_lvl = (empty($_POST['usr_lvl_'.$i.''])) ? 0 : $_POST['usr_lvl_'.$i.''];
				
				if ($usr_old==1) {
					if ($usr_slc==1) {
						$sqlstr = "update usr_dtl set usrid='$usrid', madd=$usr_add, medt=$usr_edt, mdel=$usr_dlt, lvl=$usr_lvl where usrid='$old_usrid' and frmcde='$usr_frmcde' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$sqlstr = "delete from usr_dtl where usrid='$old_usrid' and frmcde='$usr_frmcde' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}	
				} 
				
				
				if ($usr_old==0) {
				
					if ($usr_slc==1) {			
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
				
			}
			
			
			//----------insert user reminder
			$usr_jmldata2 = (empty($_POST['jmldata2'])) ? 0 : $_POST['jmldata2'];
			
			for ($i=1; $i<=$usr_jmldata2; $i++) {
				$slc_rmd 		= (empty($_POST['slc_rmd_'.$i.''])) ? 0 : $_POST['slc_rmd_'.$i.''];
				$old_slc_rmd 	= (empty($_POST['old_slc_rmd_'.$i.''])) ? 0 : $_POST['old_slc_rmd_'.$i.''];
				$reminder_id 	= $_POST['reminder_id_'.$i.''];
				$old_line		= $_POST['old_line_'.$i.''];
								
				if ($old_slc_rmd==1) {
					if ($slc_rmd==1) {
						$sqlstr = "update usr_reminder set usrid='$usrid', reminder_id=$reminder_id where usrid='$old_usrid' and line='$old_line' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$sqlstr = "delete from usr_reminder where usrid='$old_usrid' and line='$old_line'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}	
				} 
				
				
				if ($old_slc_rmd==0) {
				
					if ($slc_rmd==1) {			
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
				
			}
			
				
			//-------update user backup
			if ($_POST["pwd"]=='') {		
				$sqlstr = "update usr_bup set usrid='$usrid' where usrid='$old_usrid' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			} else {
				$sqlstr = "update usr_bup set usrid='$usrid',pwd='$_POST[pwd]' where usrid='$old_usrid' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//------update registrasi
	function update_registrasi($ref){
		
		$dbpdo = DB::create();
		
		try {
			
            $departemen         =   $_POST["departemen"];
			$replid				=	(empty($_POST["replid"])) ? 0 : $_POST["replid"];
			$idproses			=	$_POST["idproses"];
			$idkelompok			=	$_POST["idkelompok"];
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));
			$tahunmasuk			=	date("Y", strtotime($tanggal));
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
			$idjenis_tinggal	=	$_POST['idjenis_tinggal'];
			$idminat			=	$_POST['idminat'];
			$idminat1			=	$_POST['idminat1'];
			
			//-----------upload file photo
			$uploaddir 		= 'app/file_foto/';
			$foto_file2	= $_POST["foto_file2"];
			$foto_file 	= $_FILES['foto_file']['name']; 
			$tmpname  		= $_FILES['foto_file']['tmp_name'];
			$filesize 		= $_FILES['foto_file']['size'];
			$filetype 		= $_FILES['foto_file']['type'];
			
			if (empty($foto_file)) { 
				$foto_file = $foto_file2; 
			} 
			
			if($foto_file != "") {	
				
				if($foto_file != $foto_file2) {
				
					if(!empty($foto_file2)) {
						unlink($uploaddir . $foto_file2); //remove file 
					}
					
					$foto_file = $ref . '_' . $foto_file;
				}
							
				$uploadfile = $uploaddir . $foto_file;		
				if (move_uploaded_file($_FILES['foto_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			$darah			=	$_POST["darah"];
			//-----------upload file fotocopy golongan darah
			$uploaddir 		= 'app/file_darah_calon/';
			$file_darah2	= $_POST["file_darah2"];
			$file_darah 	= $_FILES['file_darah']['name']; 
			$tmpname  		= $_FILES['file_darah']['tmp_name'];
			$filesize 		= $_FILES['file_darah']['size'];
			$filetype 		= $_FILES['file_darah']['type'];
			
			if (empty($file_darah)) { 
				$file_darah = $file_darah2; 
			} 
			
			if($file_darah != "") {	
				
				if($file_darah != $file_darah2) {
				
					if(!empty($file_darah2)) {
						unlink($uploaddir . $file_darah2); //remove file 
					}
					
					$file_darah = $ref . '_' . $file_darah;
				}
							
				$uploadfile = $uploaddir . $file_darah;		
				if (move_uploaded_file($_FILES['file_darah']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			$sqlstr = "update calonsiswa set departemen='$departemen', idproses='$idproses', idkelompok='$idkelompok', tanggal='$tanggal', idtingkat='$idtingkat', idjurusan='$idjurusan', idminat='$idminat', idminat1='$idminat1', foto_file='$foto_file', nama='$nama', panggilan='$panggilan', kelamin='$kelamin', nisn='$nisn', nis='$nis', noijazah='$noijazah', tahunijazah='$tahunijazah', skhun='$skhun', tahunskhun='$tahunskhun', noujian='$noujian', nik='$nik', tmplahir='$tmplahir', tgllahir='$tgllahir', agama='$agama', kebutuhan_khusus_chk='$kebutuhan_khusus_chk', kebutuhan_khusus='$kebutuhan_khusus', tahunmasuk='$tahunmasuk', alamatsiswa='$alamatsiswa', dusun='$dusun', rt='$rt', rw='$rw', kelurahan='$kelurahan', kodepossiswa='$kodepossiswa', kecamatan='$kecamatan', kabupaten='$kabupaten', provinsi='$provinsi', transportasi='$transportasi', transportasi_kode='$transportasi_kode', citacita='$citacita', citacita_lain='$citacita_lain', idjenis_tinggal='$idjenis_tinggal', jenis_tinggal='$jenis_tinggal', telponsiswa='$telponsiswa', hpsiswa='$hpsiswa', emailsiswa='$emailsiswa', kps='$kps', nokps='$nokps', nokip='$nokip', nokks='$nokks', namaayah='$namaayah', tahunayah='$tahunayah', alamatortu='$alamatortu', kodeposortu='$kodeposortu', hportu='$hportu', butuhkhususayah='$butuhkhususayah', butuhkhususketayah='$butuhkhususketayah', pekerjaanayah='$pekerjaanayah', pekerjaanayah_lain='$pekerjaanayah_lain', pendidikanayah='$pendidikanayah', penghasilanayah='$penghasilanayah', penghasilanayah_kode='$penghasilanayah_kode', namaibu='$namaibu', tahunibu='$tahunibu', butuhkhususibu='$butuhkhususibu', butuhkhususketibu='$butuhkhususketibu', pekerjaanibu='$pekerjaanibu', pekerjaanibu_lain='$pekerjaanibu_lain', pendidikanibu='$pendidikanibu', penghasilanibu='$penghasilanibu', penghasilanibu_kode='$penghasilanibu_kode', wali='$wali', tahunwali='$tahunwali', pekerjaanwali='$pekerjaanwali', pekerjaanwali_lain='$pekerjaanwali_lain', pendidikanwali='$pendidikanwali', penghasilanwali='$penghasilanwali', tinggi='$tinggi', berat='$berat', jaraksekolah='$jaraksekolah', jarak_km='$jarak_km', waktutempuh='$waktutempuh', waktutempuh_menit='$waktutempuh_menit', jsaudara='$jsaudara', uid='$uid', dlu='$dlu', darah='$darah', file_darah='$file_darah', almayah='$almayah', almibu='$almibu', alamatibu='$alamatibu', kodeposibu='$kodeposibu', hpibu='$hpibu' where replid='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			/*------------registrasi prestasi-------------*/
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($x=0; $x<=$jmldata; $x++) {
				$delete 		= (empty($_POST[delete_.$x])) ? 0 : $_POST[delete_.$x];
				$old_line		 	= 	(empty($_POST[old_line_.$x])) ? 0 : $_POST[old_line_.$x];
				
				$jenisprestasi_ 	=	$_POST[jenisprestasi_.$x];
				$tingkat_ 			=	$_POST[tingkat_.$x];
				$nama_			 	=	$_POST[nama_.$x];
				$tahun_			 	=	(empty($_POST[tahun_.$x])) ? 0 : $_POST[tahun_.$x];
				$penyelenggara_		=	$_POST[penyelenggara_.$x];
				
				if ( $jenisprestasi_ != "" ) {
					
					$sqlcek = "select idcalonsiswa from calonsiswa_prestasi where idcalonsiswa='$replid' and line='$old_line' ";										
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							$sqlstr="update calonsiswa_prestasi set jenisprestasi='$jenisprestasi_', tingkat='$tingkat_', nama='$nama_', tahun='$tahun_', penyelenggara='$penyelenggara_' where idcalonsiswa='$replid' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
						} else {
							$sqlstr="delete from calonsiswa_prestasi where idcalonsiswa='$replid' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();							
						}
						
						
					} else {
						
						$line = maxline('calonsiswa_prestasi', 'line', 'idcalonsiswa', $replid, '');
				
						$sqlstr = "insert into calonsiswa_prestasi (idcalonsiswa, jenisprestasi, tingkat, nama, tahun, penyelenggara, line) values ('$replid', '$jenisprestasi_', '$tingkat_', '$nama_', '$tahun_', '$penyelenggara_', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
											
					}
					
				}
			}
			
			
			
			/*------------registrasi beasiswa-------------*/
			$jmldata2 = (empty($_POST['jmldata2'])) ? 0 : $_POST['jmldata2'];
			
			for ($x=0; $x<=$jmldata2; $x++) {
				$delete2 			= 	(empty($_POST[delete2_.$x])) ? 0 : $_POST[delete2_.$x];
				$old_line2		 	= 	(empty($_POST[old_line2_.$x])) ? 0 : $_POST[old_line2_.$x];
				
				$jenis_ 			=	$_POST[jenis_.$x];
				$penyelenggara2_	=	$_POST[penyelenggara2_.$x];
				$tahunmulai_	 	=	(empty($_POST[tahunmulai_.$x])) ? 0 : $_POST[tahunmulai_.$x];
				$tahunselesai_	 	=	(empty($_POST[tahunselesai_.$x])) ? 0 : $_POST[tahunselesai_.$x];
				
				if ( $jenis_ != "" ) {
					
					$sqlcek = "select idcalonsiswa from calonsiswa_beasiswa where idcalonsiswa='$replid' and line='$old_line2' ";					
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					
					if($num > 0) {
						if($delete2 == 0) {
							$sqlstr="update calonsiswa_beasiswa set jenis='$jenis_', penyelenggara='$penyelenggara2_', tahunmulai='$tahunmulai_', tahunselesai='$tahunselesai_' where idcalonsiswa='$replid' and line=$old_line2";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
						} else {
							$sqlstr="delete from calonsiswa_beasiswa where idcalonsiswa='$replid' and line=$old_line2";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();							
						}
						
						
					} else {
						
						$line = maxline('calonsiswa_beasiswa', 'line', 'idcalonsiswa', $replid, '');
				
						$sqlstr = "insert into calonsiswa_beasiswa (idcalonsiswa, jenis, penyelenggara, tahunmulai, tahunselesai, line) values ('$replid', '$jenis_', '$penyelenggara2_', '$tahunmulai_', '$tahunselesai_', '$line')";
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
	
	//------update siswa
	function update_siswa($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$replid				=	(empty($_POST["replid"])) ? 0 : $_POST["replid"];
			
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
			$kodepossiswa		=	$_POST["kodepossiswa"];	
			$jenistinggal		=	$_POST["jenistinggal"];	
			$kps				=	(empty($_POST["kps"])) ? 0 : $_POST["kps"];
			$nokps				=	$_POST["nokps"];
			$kip				=	(empty($_POST["kip"])) ? 0 : $_POST["kip"];
			$nokip				=	$_POST["nokip"];
			$namakip			=	$_POST["namakip"];
			$nokks				=	$_POST["nokks"];
			$no_akte_lahir		=	$_POST["no_akte_lahir"];
			$alamatortu			=	$_POST["alamatortu"];
			$telponsiswa		=	$_POST["telponsiswa"];
			$hpsiswa			=	$_POST["hpsiswa"];
			$emailsiswa			=	$_POST["emailsiswa"];
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
			$uploaddir 		= 'app/file_darah/';
			$file_darah2	= $_POST["file_darah2"];
			$file_darah 	= $_FILES['file_darah']['name']; 
			$tmpname  		= $_FILES['file_darah']['tmp_name'];
			$filesize 		= $_FILES['file_darah']['size'];
			$filetype 		= $_FILES['file_darah']['type'];
			
			if (empty($file_darah)) { 
				$file_darah = $file_darah2; 
			} 
			
			if($file_darah != "") {	
				
				if($file_darah != $file_darah2) {
				
					if(!empty($file_darah2)) {
						if (file_exists($uploaddir . '/' . $file_darah2)) {
							unlink($uploaddir . $file_darah2); //remove file 
						}
					}
					
					$file_darah = $nis . $idkelas . '_' . $file_darah;
				}
							
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
			
			/*--------Lain-lain---------*/
			$rombel_id			=	$_POST["rombel_id"];
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
			
			//-----------upload file photo
			$uploaddir 		= 'app/file_foto_siswa/';
			$foto_file2	= $_POST["foto_file2"];
			$foto_file 	= $_FILES['foto_file']['name']; 
			$tmpname  		= $_FILES['foto_file']['tmp_name'];
			$filesize 		= $_FILES['foto_file']['size'];
			$filetype 		= $_FILES['foto_file']['type'];
			
			if (empty($foto_file)) { 
				$foto_file = $foto_file2; 
			} 
			
			if($foto_file != "") {	
				
				if($foto_file != $foto_file2) {
				
					if(!empty($foto_file2)) {
						if (file_exists($uploaddir . '/' . $foto_file2)) {
							unlink($uploaddir . $foto_file2); //remove file
						} 
					}
					
					$foto_file = $nis . '_' . $foto_file;
				}
							
				$uploadfile = $uploaddir . $foto_file;		
				if (move_uploaded_file($_FILES['foto_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			//-----------upload file file_rekam_bk
			$uploaddir 		= 'app/file_rekam_bk/';
			$file_rekam_bk2	= $_POST["file_rekam_bk2"];
			$file_rekam_bk 	= $_FILES['file_rekam_bk']['name']; 
			$tmpname  		= $_FILES['file_rekam_bk']['tmp_name'];
			$filesize 		= $_FILES['file_rekam_bk']['size'];
			$filetype 		= $_FILES['file_rekam_bk']['type'];
			
			if (empty($file_rekam_bk)) { 
				$file_rekam_bk = $file_rekam_bk2; 
			} 
			
			if($file_rekam_bk != "") {	
				
				if($file_rekam_bk != $file_rekam_bk2) {
				
					if(!empty($file_rekam_bk2)) {
						if (file_exists($uploaddir . '/' . $file_rekam_bk2)) {
							unlink($uploaddir . $file_rekam_bk2); //remove file 
						}
					}
					
					$file_rekam_bk = $nis . '_' . $file_rekam_bk;
				}
							
				$uploadfile = $uploaddir . $file_rekam_bk;		
				if (move_uploaded_file($_FILES['file_rekam_bk']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			//-----------upload file file_memo_ortu
			$uploaddir 		= 'app/file_memo_ortu/';
			$file_memo_ortu2= $_POST["file_memo_ortu2"];
			$file_memo_ortu = $_FILES['file_memo_ortu']['name']; 
			$tmpname  		= $_FILES['file_memo_ortu']['tmp_name'];
			$filesize 		= $_FILES['file_memo_ortu']['size'];
			$filetype 		= $_FILES['file_memo_ortu']['type'];
			
			if (empty($file_memo_ortu)) { 
				$file_memo_ortu = $file_memo_ortu2; 
			} 
			
			if($file_memo_ortu != "") {	
				
				if($file_memo_ortu != $file_memo_ortu2) {
				
					if(!empty($file_memo_ortu2)) {
						if (file_exists($uploaddir . '/' . $file_memo_ortu2)) {
							unlink($uploaddir . $file_memo_ortu2); //remove file 
						}
					}
					
					$file_memo_ortu = $nis . '_' . $file_memo_ortu;
				}
							
				$uploadfile = $uploaddir . $file_memo_ortu;		
				if (move_uploaded_file($_FILES['file_memo_ortu']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------		
			
			
			//-----------upload file file_nilai_un
			$uploaddir 		= 'app/file_nilai_un/';
			$file_nilai_un2= $_POST["file_nilai_un2"];
			$file_nilai_un = $_FILES['file_nilai_un']['name']; 
			$tmpname  		= $_FILES['file_nilai_un']['tmp_name'];
			$filesize 		= $_FILES['file_nilai_un']['size'];
			$filetype 		= $_FILES['file_nilai_un']['type'];
			
			if (empty($file_nilai_un)) { 
				$file_nilai_un = $file_nilai_un2; 
			} 
			
			if($file_nilai_un != "") {	
				
				if($file_nilai_un != $file_nilai_un2) {
				
					if(!empty($file_nilai_un2)) {
						if (file_exists($uploaddir . '/' . $file_nilai_un2)) {	
							unlink($uploaddir . $file_nilai_un2); //remove file 
						}
					}
										
					$file_nilai_un = $nis . '_' . $file_nilai_un;
				}
							
				$uploadfile = $uploaddir . $file_nilai_un;		
				if (move_uploaded_file($_FILES['file_nilai_un']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------		
			
			//-----------upload file file_raport
			$uploaddir 		= 'app/file_raport/';
			$file_raport2= $_POST["file_raport2"];
			$file_raport = $_FILES['file_raport']['name']; 
			$tmpname  		= $_FILES['file_raport']['tmp_name'];
			$filesize 		= $_FILES['file_raport']['size'];
			$filetype 		= $_FILES['file_raport']['type'];
			
			if (empty($file_raport)) { 
				$file_raport = $file_raport2; 
			} 
			
			if($file_raport != "") {	
				
				if($file_raport != $file_raport2) {
				
					if(!empty($file_raport2)) {
						if (file_exists($uploaddir . '/' . $file_raport2)) {
							unlink($uploaddir . $file_raport2); //remove file 
						}
					}
					
					$file_raport = $nis . '_' . $file_raport;
				}
							
				$uploadfile = $uploaddir . $file_raport;		
				if (move_uploaded_file($_FILES['file_raport']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------		
			
			
			//-----------upload file file_raport
			$uploaddir 		= 'app/file_raport/';
			$file_raport2= $_POST["file_raport2"];
			$file_raport = $_FILES['file_raport']['name']; 
			$tmpname  		= $_FILES['file_raport']['tmp_name'];
			$filesize 		= $_FILES['file_raport']['size'];
			$filetype 		= $_FILES['file_raport']['type'];
			
			if (empty($file_raport)) { 
				$file_raport = $file_raport2; 
			} 
			
			if($file_raport != "") {	
				
				if($file_raport != $file_raport2) {
				
					if(!empty($file_raport2)) {
						if (file_exists($uploaddir . '/' . $file_raport2)) {
							unlink($uploaddir . $file_raport2); //remove file 
						}
					}
					
					$file_raport = $nis . '_' . $file_raport;
				}
							
				$uploadfile = $uploaddir . $file_raport;		
				if (move_uploaded_file($_FILES['file_raport']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			
			//-----------upload file file_raport
			$uploaddir 		= 'app/file_raport/';
			$file_raport2= $_POST["file_raport2"];
			$file_raport = $_FILES['file_raport']['name']; 
			$tmpname  		= $_FILES['file_raport']['tmp_name'];
			$filesize 		= $_FILES['file_raport']['size'];
			$filetype 		= $_FILES['file_raport']['type'];
			
			if (empty($file_raport)) { 
				$file_raport = $file_raport2; 
			} 
			
			if($file_raport != "") {	
				
				if($file_raport != $file_raport2) {
				
					if(!empty($file_raport2)) {
						if (file_exists($uploaddir . '/' . $file_raport2)) {
							unlink($uploaddir . $file_raport2); //remove file 
						}
					}
					
					$file_raport = $nis . '_' . $file_raport;
				}
							
				$uploadfile = $uploaddir . $file_raport;		
				if (move_uploaded_file($_FILES['file_raport']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			//-----------upload file file_kk
			$uploaddir 		= 'app/file_kk/';
			$file_kk2= $_POST["file_kk2"];
			$file_kk = $_FILES['file_kk']['name']; 
			$tmpname  		= $_FILES['file_kk']['tmp_name'];
			$filesize 		= $_FILES['file_kk']['size'];
			$filetype 		= $_FILES['file_kk']['type'];
			
			if (empty($file_kk)) { 
				$file_kk = $file_kk2; 
			} 
			
			if($file_kk != "") {	
				
				if($file_kk != $file_kk2) {
				
					if(!empty($file_kk2)) {
						if (file_exists($uploaddir . '/' . $file_kk2)) {
							unlink($uploaddir . $file_kk2); //remove file 
						}
					}
					
					$file_kk = $nis . '_' . $file_kk;
				}
							
				$uploadfile = $uploaddir . $file_kk;		
				if (move_uploaded_file($_FILES['file_kk']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			
			//-----------upload file file_akte
			$uploaddir 		= 'app/file_akte/';
			$file_akte2= $_POST["file_akte2"];
			$file_akte = $_FILES['file_akte']['name']; 
			$tmpname  		= $_FILES['file_akte']['tmp_name'];
			$filesize 		= $_FILES['file_akte']['size'];
			$filetype 		= $_FILES['file_akte']['type'];
			
			if (empty($file_akte)) { 
				$file_akte = $file_akte2; 
			} 
			
			if($file_akte != "") {	
				
				if($file_akte != $file_akte2) {
				
					if(!empty($file_akte2)) {
						if (file_exists($uploaddir . '/' . $file_akte2)) {
							unlink($uploaddir . $file_akte2); //remove file 
						}
					}
					
					$file_akte = $nis . '_' . $file_akte;
				}
							
				$uploadfile = $uploaddir . $file_akte;		
				if (move_uploaded_file($_FILES['file_akte']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			//-----------upload file file_ijazah
			$uploaddir 		= 'app/file_ijazah/';
			$file_ijazah2= $_POST["file_ijazah2"];
			$file_ijazah = $_FILES['file_ijazah']['name']; 
			$tmpname  		= $_FILES['file_ijazah']['tmp_name'];
			$filesize 		= $_FILES['file_ijazah']['size'];
			$filetype 		= $_FILES['file_ijazah']['type'];
			
			if (empty($file_ijazah)) { 
				$file_ijazah = $file_ijazah2; 
			} 
			
			if($file_ijazah != "") {	
				
				if($file_ijazah != $file_ijazah2) {
				
					if(!empty($file_ijazah2)) {
						if (file_exists($uploaddir . '/' . $file_ijazah2)) {
							unlink($uploaddir . $file_ijazah2); //remove file 
						}
					}
					
					$file_ijazah = $nis . '_' . $file_ijazah;
				}
							
				$uploadfile = $uploaddir . $file_ijazah;		
				if (move_uploaded_file($_FILES['file_ijazah']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			
			//-----------upload file file_nhun
			$uploaddir 		= 'app/file_nhun/';
			$file_nhun2= $_POST["file_nhun2"];
			$file_nhun = $_FILES['file_nhun']['name']; 
			$tmpname  		= $_FILES['file_nhun']['tmp_name'];
			$filesize 		= $_FILES['file_nhun']['size'];
			$filetype 		= $_FILES['file_nhun']['type'];
			
			if (empty($file_nhun)) { 
				$file_nhun = $file_nhun2; 
			} 
			
			if($file_nhun != "") {	
				
				if($file_nhun != $file_nhun2) {
				
					if(!empty($file_nhun2)) {
						if (file_exists($uploaddir . '/' . $file_nhun2)) {
							unlink($uploaddir . $file_nhun2); //remove file 
						}
					}
					
					$file_nhun = $nis . '_' . $file_nhun;
				}
							
				$uploadfile = $uploaddir . $file_nhun;		
				if (move_uploaded_file($_FILES['file_nhun']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			$sqlstr = "update siswa set nis='$nis', nisn='$nisn', nik='$nik', idangkatan='$idangkatan', idangkatan1='$idangkatan1', foto_file='$foto_file', nama='$nama', panggilan='$panggilan', idkelas='$idkelas', tglmasuk='$tglmasuk', kelamin='$kelamin', tmplahir='$tmplahir', tgllahir='$tgllahir', agama='$agama', warga='$warga', anakke='$anakke', jsaudara='$jsaudara', jtiri='$jtiri', jangkat='$jangkat', yatim='$yatim', bahasa='$bahasa', desa_kode='$desa_kode', kecamatan_kode='$kecamatan_kode', kota_kode='$kota_kode', provinsi_kode='$provinsi_kode', alamatsiswa='$alamatsiswa', rt_siswa='$rt_siswa', rw_siswa='$rw_siswa', dusun='$dusun', desa='$desa', kecamatan='$kecamatan', kodepossiswa='$kodepossiswa', alamatortu='$alamatortu', telponsiswa='$telponsiswa', hpsiswa='$hpsiswa', emailsiswa='$emailsiswa', jenistinggal='$jenistinggal', kps='$kps', nokps='$nokps', kip='$kip', nokip='$nokip', namakip='$namakip', nokks='$nokks', no_akte_lahir='$no_akte_lahir', telponortu='$telponortu', hportu='$hportu', hpibu='$hpibu', transportasi_kode='$transportasi_kode', transportasi_lain='$transportasi_lain', jaraksekolah='$jaraksekolah', kesekolah='$kesekolah', berat='$berat', tinggi='$tinggi', kesehatan='$kesehatan', darah='$darah', file_darah='$file_darah', kelainan='$kelainan', asalsekolah_id='$asalsekolah_id', kota_asalsekolah='$kota_asalsekolah', tglijazah='$tglijazah', noijazah='$noijazah', tglskhun='$tglskhun', skhun='$skhun', noujian='$noujian', nisnasal='$nisnasal', nik_ayah='$nik_ayah', namaayah='$namaayah', nik_ibu='$nik_ibu', namaibu='$namaibu', tmplahirayah='$tmplahirayah', tgllahirayah='$tgllahirayah', tempat_bekerja_ayah='$tempat_bekerja_ayah', tmplahiribu='$tmplahiribu', tgllahiribu='$tgllahiribu', pekerjaanayah='$pekerjaanayah', pekerjaanibu='$pekerjaanibu', penghasilanayah_kode='$penghasilanayah_kode', penghasilanayah='$penghasilanayah', penghasilanibu_kode='$penghasilanibu_kode', penghasilanibu='$penghasilanibu', pendidikanayah='$pendidikanayah', pendidikanibu='$pendidikanibu', tempat_bekerja_ibu='$tempat_bekerja_ibu', wnayah='$wnayah', wnibu='$wnibu', nik_wali='$nik_wali', wali='$wali', tmplahirwali='$tmplahirwali', tgllahirwali='$tgllahirwali', pendidikanwali='$pendidikanwali', pekerjaanwali='$pekerjaanwali', penghasilanwali_kode='$penghasilanwali_kode', penghasilanwali='$penghasilanwali', tempat_bekerja_wali='$tempat_bekerja_wali', alamatwali='$alamatwali', hpwali='$hpwali', hubungansiswa='$hubungansiswa', pekerjaanayah_lain='$pekerjaanayah_lain', pekerjaanibu_lain='$pekerjaanibu_lain', pekerjaanwali_lain='$pekerjaanwali_lain', rombel_id='$rombel_id', nama_bank='$nama_bank', no_rekening_bank='$no_rekening_bank', nama_pemilik_bank='$nama_pemilik_bank', pip='$pip', alasan_pip='$alasan_pip', idminat='$idminat', jalurmasuk='$jalurmasuk', jalurmasuk_id='$jalurmasuk_id', jalurmasukprestasi_id='$jalurmasukprestasi_id', file_rekam_bk='$file_rekam_bk', file_memo_ortu='$file_memo_ortu', file_nilai_un = '$file_nilai_un', file_raport='$file_raport', file_kk='$file_kk', file_akte='$file_akte', file_ijazah='$file_ijazah', file_nhun='$file_nhun', uid2='$uid', aktif='$aktif', ts='$dlu', tahun_ijazah='$tahun_ijazah', tahunskhun='$tahunskhun', kebutuhan_khusus_chk='$kebutuhan_khusus_chk', jenis_tinggal='$jenis_tinggal', kebutuhan_khusus_chk1='$kebutuhan_khusus_chk1', kebutuhan_khusus='$kebutuhan_khusus', citacita='$citacita', citacita_lain='$citacita_lain', tahunayah='$tahunayah', kodeposortu='$kodeposortu', butuhkhususketayah='$butuhkhususketayah', tahunibu='$tahunibu', kodeposibu='$kodeposibu', butuhkhususibu='$butuhkhususibu', butuhkhususketibu='$butuhkhususketibu', tahunwali='$tahunwali', jarak_km='$jarak_km', waktutempuh='$waktutempuh', waktutempuh_menit='$waktutempuh_menit', almayah='$almayah', butuhkhususayah='$butuhkhususayah', almibu='$almibu', alamatibu='$alamatibu', dlu2='$dlu' where replid='$ref'";
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
			} else {
				$sqlstr = "update siswa_virtualaccount set virtualaccount='$virtualaccount' where nis='$nis'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
			
			/*------------siswa prestasi-------------*/
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($x=0; $x<=$jmldata; $x++) {
				$delete 			= (empty($_POST[delete_.$x])) ? 0 : $_POST[delete_.$x];
				$old_line		 	= 	(empty($_POST[old_line_.$x])) ? 0 : $_POST[old_line_.$x];
				
				$jenisprestasi_ 	=	$_POST[jenisprestasi_.$x];
				$tingkat_ 			=	$_POST[tingkat_.$x];
				$nama_			 	=	$_POST[nama_.$x];
				$tahun_			 	=	(empty($_POST[tahun_.$x])) ? 0 : $_POST[tahun_.$x];
				$penyelenggara_		=	$_POST[penyelenggara_.$x];
				
				if ( $jenisprestasi_ != "" ) {
					
					$sqlcek = "select idsiswa from siswa_prestasi where idsiswa='$replid' and line='$old_line' ";										
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							$sqlstr="update siswa_prestasi set jenisprestasi='$jenisprestasi_', tingkat='$tingkat_', nama='$nama_', tahun='$tahun_', penyelenggara='$penyelenggara_' where idsiswa='$replid' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
						} else {
							$sqlstr="delete from siswa_prestasi where idsiswa='$replid' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();							
						}
						
						
					} else {
						
						$line = maxline('siswa_prestasi', 'line', 'idsiswa', $replid, '');
				
						$sqlstr = "insert into siswa_prestasi (idsiswa, jenisprestasi, tingkat, nama, tahun, penyelenggara, line) values ('$replid', '$jenisprestasi_', '$tingkat_', '$nama_', '$tahun_', '$penyelenggara_', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
											
					}
					
				}
			}
			
			
			
			/*------------siswa beasiswa-------------*/
			$jmldata2 = (empty($_POST['jmldata2'])) ? 0 : $_POST['jmldata2'];
			
			for ($x=0; $x<=$jmldata2; $x++) {
				$delete2 			= 	(empty($_POST[delete2_.$x])) ? 0 : $_POST[delete2_.$x];
				$old_line2		 	= 	(empty($_POST[old_line2_.$x])) ? 0 : $_POST[old_line2_.$x];
				
				$jenis_ 			=	$_POST[jenis_.$x];
				$penyelenggara2_	=	$_POST[penyelenggara2_.$x];
				$tahunmulai_	 	=	(empty($_POST[tahunmulai_.$x])) ? 0 : $_POST[tahunmulai_.$x];
				$tahunselesai_	 	=	(empty($_POST[tahunselesai_.$x])) ? 0 : $_POST[tahunselesai_.$x];
				
				if ( $jenis_ != "" ) {
					
					$sqlcek = "select idsiswa from siswa_beasiswa where idsiswa='$replid' and line='$old_line2' ";					
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					
					if($num > 0) {
						if($delete2 == 0) {
							$sqlstr="update siswa_beasiswa set jenis='$jenis_', penyelenggara='$penyelenggara2_', tahunmulai='$tahunmulai_', tahunselesai='$tahunselesai_' where idsiswa='$replid' and line=$old_line2";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
						} else {
							$sqlstr="delete from siswa_beasiswa where idsiswa='$replid' and line=$old_line2";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();							
						}
						
						
					} else {
						
						$line = maxline('siswa_beasiswa', 'line', 'idsiswa', $replid, '');
				
						$sqlstr = "insert into siswa_beasiswa (idsiswa, jenis, penyelenggara, tahunmulai, tahunselesai, line) values ('$replid', '$jenis_', '$penyelenggara2_', '$tahunmulai_', '$tahunselesai_', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
											
					}
					
				}
			}
			
			
			/*------------siswa nilai UN-------------*/
			$jmldata_un = (empty($_POST['jmldata_un'])) ? 0 : $_POST['jmldata_un'];		
			for ($x=0; $x<=$jmldata_un; $x++) {
				$replid_un3u 		=	$_POST[replid_un3u_.$x];
				$pelajaran_id3u		=	$replid_un3u;
				$nilai3u				=	numberreplace($_POST[nilai3u_.$x]);
				
				if ( !empty($replid_un3u) ) {
					$sqlcek = "select nis from siswa_nilai_un where nis='$nis' and pelajaran_id='$pelajaran_id3u'";
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					if($num > 0) {
						$sqlstr="update siswa_nilai_un set nilai='$nilai3u' where nis='$nis' and pelajaran_id='$pelajaran_id3u'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$line = maxline('siswa_nilai_un', 'line', 'nis', $nis, '');				
						$sqlstr = "insert into siswa_nilai_un (nis, pelajaran_id, nilai, line) values ('$nis', '$pelajaran_id3u', '$nilai3u', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();						
					}
				}
			}
			
			
			//----------update raport semester-1
			$jmldata_raport = (empty($_POST['jmldata_raport'])) ? 0 : $_POST['jmldata_raport'];		
			for ($x=0; $x<=$jmldata_raport; $x++) {
				$replid_un 			=	$_POST[replid_un_.$x];
				$pelajaran_id		=	$replid_un;
				$nilai				=	numberreplace($_POST[nilai_.$x]);
				
				if ( !empty($replid_un) ) {
					$sqlcek = "select nis from siswa_nilai_raport where nis='$nis' and pelajaran_id='$pelajaran_id' and semester=1";
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					if($num > 0) {
						$sqlstr="update siswa_nilai_raport set nilai='$nilai' where nis='$nis' and pelajaran_id='$pelajaran_id' and semester=1";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {					
						$line = maxline('siswa_nilai_raport', 'line', 'nis', $nis, '');
						$sqlstr = "insert into siswa_nilai_raport (nis, semester, pelajaran_id, nilai, line) values ('$nis', '1', '$pelajaran_id', '$nilai', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
				}
			}
			
			
			//----------update raport semester-2
			$jmldata_raport1 = (empty($_POST['jmldata_raport1'])) ? 0 : $_POST['jmldata_raport1'];		
			for ($x=0; $x<=$jmldata_raport1; $x++) {
				$replid_un1 			=	$_POST[replid_un1_.$x];
				$pelajaran_id1		=	$replid_un1;
				$nilai1				=	numberreplace($_POST[nilai1_.$x]);
				
				if ( !empty($replid_un1) ) {
					$sqlcek = "select nis from siswa_nilai_raport where nis='$nis' and pelajaran_id='$pelajaran_id1' and semester=2";
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					if($num > 0) {
						$sqlstr="update siswa_nilai_raport set nilai='$nilai1' where nis='$nis' and pelajaran_id='$pelajaran_id1' and semester=2";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {					
						$line = maxline('siswa_nilai_raport', 'line', 'nis', $nis, '');
						$sqlstr = "insert into siswa_nilai_raport (nis, semester, pelajaran_id, nilai, line) values ('$nis', '2', '$pelajaran_id1', '$nilai1', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
				}
			}
			
			
			//----------update raport semester-3
			$jmldata_raport2 = (empty($_POST['jmldata_raport2'])) ? 0 : $_POST['jmldata_raport2'];		
			for ($x=0; $x<=$jmldata_raport2; $x++) {
				$replid_un2 			=	$_POST[replid_un2_.$x];
				$pelajaran_id2		=	$replid_un2;
				$nilai2				=	numberreplace($_POST[nilai2_.$x]);
				
				if ( !empty($replid_un2) ) {
					$sqlcek = "select nis from siswa_nilai_raport where nis='$nis' and pelajaran_id='$pelajaran_id2' and semester=3";
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					if($num > 0) {
						$sqlstr="update siswa_nilai_raport set nilai='$nilai2' where nis='$nis' and pelajaran_id='$pelajaran_id2' and semester=3";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {					
						$line = maxline('siswa_nilai_raport', 'line', 'nis', $nis, '');
						$sqlstr = "insert into siswa_nilai_raport (nis, semester, pelajaran_id, nilai, line) values ('$nis', '3', '$pelajaran_id2', '$nilai2', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
				}
			}
			
			
			//----------update raport semester-4
			$jmldata_raport3 = (empty($_POST['jmldata_raport3'])) ? 0 : $_POST['jmldata_raport3'];		
			for ($x=0; $x<=$jmldata_raport3; $x++) {
				$replid_un3			=	$_POST[replid_un3_.$x];
				$pelajaran_id3		=	$replid_un3;
				$nilai3				=	numberreplace($_POST[nilai3_.$x]);
				
				if ( !empty($replid_un3) ) {
					$sqlcek = "select nis from siswa_nilai_raport where nis='$nis' and pelajaran_id='$pelajaran_id3' and semester=4";
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					if($num > 0) {
						$sqlstr="update siswa_nilai_raport set nilai='$nilai3' where nis='$nis' and pelajaran_id='$pelajaran_id3' and semester=4";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$line = maxline('siswa_nilai_raport', 'line', 'nis', $nis, '');
						$sqlstr = "insert into siswa_nilai_raport (nis, semester, pelajaran_id, nilai, line) values ('$nis', '4', '$pelajaran_id3', '$nilai3', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
				}
			}
			
			
			//----------update raport semester-5
			$jmldata_raport4 = (empty($_POST['jmldata_raport4'])) ? 0 : $_POST['jmldata_raport4'];		
			for ($x=0; $x<=$jmldata_raport4; $x++) {
				$replid_un4			=	$_POST[replid_un4_.$x];
				$pelajaran_id4		=	$replid_un4;
				$nilai4				=	numberreplace($_POST[nilai4_.$x]);
				
				if ( !empty($replid_un4) ) {
					$sqlcek = "select nis from siswa_nilai_raport where nis='$nis' and pelajaran_id='$pelajaran_id4' and semester=5";
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					if($num > 0) {
						$sqlstr="update siswa_nilai_raport set nilai='$nilai4' where nis='$nis' and pelajaran_id='$pelajaran_id4' and semester=5";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$line = maxline('siswa_nilai_raport', 'line', 'nis', $nis, '');
						$sqlstr = "insert into siswa_nilai_raport (nis, semester, pelajaran_id, nilai, line) values ('$nis', '5', '$pelajaran_id4', '$nilai4', '$line')";
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
	
	
	//------update prosespenerimaansiswa
	function update_prosespenerimaansiswa($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$replid				=	(empty($_POST["replid"])) ? 0 : $_POST["replid"];
			$proses				=	$_POST["proses"];
			$kodeawalan			=	$_POST["kodeawalan"];
			$departemen			=	$_POST["departemen"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update prosespenerimaansiswa set departemen='$departemen', proses='$proses', keterangan='$keterangan', aktif='$aktif', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update kelompokcalonsiswa
	function update_kelompokcalonsiswa($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$replid				=	(empty($_POST["replid"])) ? 0 : $_POST["replid"];
			$idproses			=	$_POST["idproses"];
			$kapasitas			=	numberreplace($_POST["kapasitas"]);
			$kelompok			=	$_POST["kelompok"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update kelompokcalonsiswa set idproses='$idproses', kapasitas='$kapasitas', kelompok='$kelompok', keterangan='$keterangan', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update departemen
	function update_departemen($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$replid				=	(empty($_POST["replid"])) ? 0 : $_POST["replid"];
			$departemen			=	$_POST["departemen"];
			$nipkepsek			=	$_POST["nipkepsek"];
			$urutan				=	(empty($_POST["urutan"])) ? 0 : $_POST["urutan"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update departemen set departemen='$departemen', nipkepsek='$nipkepsek', urutan='$urutan', keterangan='$keterangan', aktif='$aktif', info1='$uid', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update tingkat
	function update_tingkat($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$replid				=	(empty($_POST["replid"])) ? 0 : $_POST["replid"];
			$tingkat			=	$_POST["tingkat"];
			$departemen			=	$_POST["departemen"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$tanggal_ttd		=	date("Y-m-d", strtotime($_POST["tanggal_ttd"]));
			$urutan				=	(empty($_POST["urutan"])) ? 0 : $_POST["urutan"];			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update tingkat set tingkat='$tingkat', departemen='$departemen', aktif='$aktif', keterangan='$keterangan', urutan='$urutan', tanggal_ttd='$tanggal_ttd', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update kelas
	function update_kelas($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$replid				=	(empty($_POST["replid"])) ? 0 : $_POST["replid"];
			$idtahunajaran		=	$_POST["idtahunajaran"];
			$idtingkat			=	$_POST["idtingkat"];
			$kelas				=	$_POST["kelas"];
			$kapasitas			=	$_POST["kapasitas"];
			$nipwali			=	$_POST["nipwali"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);;			
			$dlu				=	date("Y-m-d H:i:s");
			
			include_once ($__folder."app/include/function_crop.php");
			//------------start upload ttd
	  		$ttd_file_hd_trf	= 	$_POST['ttd_file_hd'];
			$ttd_hd_trf			=	$_FILES['ttd_file_hd']['name'];
			$ttd2_hd_trf		=	$_POST['ttd_file_hd2'];
			if($ttd_hd_trf != "") {
				if(!empty($ttd2_hd_trf)) {
					$filename_hd_trf = $__folder.'app/file_ttd/' . $ttd2_hd_trf;
					
					if (file_exists($filename_hd_trf)) { 
						unlink($__folder.'app/file_ttd/' . $ttd2_hd_trf); 
					} //remove file
				}
				
				$file_ttd1_hd_trf = resize_image('ttd_file_hd', '', $__folder.'app/file_ttd/', '', $ref, $ttd_file_hd_trf);
				$ttd_file_hd_trf 	= 	$file_ttd1_hd_trf;
			} else {
				$ttd_file_hd_trf	=	$ttd2_hd_trf;
			}
			//-----------------------
			
			
			$sqlstr = "update kelas set idtahunajaran='$idtahunajaran', idtingkat='$idtingkat', kelas='$kelas', kapasitas='$kapasitas', nipwali='$nipwali', aktif='$aktif', keterangan='$keterangan', ttd_file_hd='$ttd_file_hd_trf', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			##detail
			$jmldata = $_POST['jmldata'];
			for($i=0; $i<$jmldata; $i++) {
				$delete 				= 	(empty($_POST[delete_.$i])) ? 0 : $_POST[delete_.$i];
				
				$old_line				=	$_POST[old_line_.$i];
				$idtahunajaran_det		=	$_POST[idtahunajaran_.$i];
				$nipwali_det			=	$_POST[nipwali_.$i];
				
				$sqlstr = "select replid from kelas_detail where replid='$ref' and line='$old_line' and idtahunajaran='$idtahunajaran_det' and nipwali='$nipwali_det'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$rows = $sql->rowCount();
				
				if($rows > 0 ) {
					if($delete == 0) {
						
						//-----------upload file ttd
						$ttd_file_trf	= 	$_POST[ttd_file_.$i];
						$ttd_trf		=	$_FILES[ttd_file_.$i]['name'];
						$ttd2_trf		=	$_POST[ttd_file2_.$i];
						if($ttd_trf != "") {
							if(!empty($ttd2_trf)) {
								$filename_trf = $__folder.'app/file_ttd/' . $ttd2_trf;
								
								if (file_exists($filename_trf)) { 
									unlink($__folder.'app/file_ttd/' . $ttd2_trf); 
								} //remove file
							}
							
							$file_ttd1_trf = resize_image('ttd_file_'.$i, '', $__folder.'app/file_ttd/', '', $ref, $ttd_file_trf.$i);
							$ttd_file_trf 	= 	$file_ttd1_trf;
						} else {
							$ttd_file_trf	=	$ttd2_trf;
						}
						//-----------------------
						
						$sqlstr = "update kelas_detail set idtahunajaran='$idtahunajaran_det', nipwali='$nipwali_det', ttd_file='$ttd_file_trf' where replid='$ref' and line='$old_line'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();	
					} else {
						$sqlstr = "delete from kelas_detail where replid='$ref' and line='$old_line'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();	
					}
				}
			}	
			
			##jika add walikelas
			$idtahunajaran_det		=	$_POST["idtahunajaran_det"];
			$nipwali_det			=	$_POST["nipwali_det"];
			
			if(!empty($idtahunajaran_det) && !empty($nipwali_det)) {
				$line = maxline('kelas_detail', 'line', 'replid', $ref, '');
				
				//------------start upload ttd
		  		$ttd_file			= 	$_POST['ttd_file'];
		  		$ttd_file1 			= 	resize_image('ttd_file', 'file_ttd/', $__folder.'app/file_ttd/', 'file_ttd/', $ref."_".$ttd_file.$line);
		  		$ttd_file_a 		= 	$ttd_file1;
		  		//----------------
		  		
				$sqlstr = "insert into kelas_detail (replid, idtahunajaran, nipwali, ttd_file, line) values ('$ref', '$idtahunajaran_det', '$nipwali_det', '$ttd_file_a', '$line')";
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
	
	
	//------update tahunajaran
	function update_tahunajaran($ref){
		
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
			
			include_once ($__folder."app/include/function_crop.php");
			//------------start upload ttd
	  		$ttd_file_trf	= 	$_POST['ttd_file'];
			$ttd_trf		=	$_FILES['ttd_file']['name'];
			$ttd2_trf		=	$_POST['ttd_file2'];
			if($ttd_trf != "") {
				if(!empty($ttd2_trf)) {
					$filename_trf = $__folder.'app/file_ttd/' . $ttd2_trf;
					
					if (file_exists($filename_trf)) { 
						unlink($__folder.'app/file_ttd/' . $ttd2_trf); 
					} //remove file
				}
				
				$file_ttd1_trf = resize_image('ttd_file', '', $__folder.'app/file_ttd/', '', $ref, $ttd_file_trf);
				$ttd_file_trf 	= 	$file_ttd1_trf;
			} else {
				$ttd_file_trf	=	$ttd2_trf;
			}
			//-----------------------
			
			$sqlstr = "update tahunajaran set departemen='$departemen', tahunajaran='$tahunajaran', tglmulai='$tglmulai', tglakhir='$tglakhir', aktif='$aktif', info1='$info1', info3='$ttd_file_trf', keterangan='$keterangan', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update agama
	function update_agama($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$replid				=	(empty($_POST["replid"])) ? 0 : $_POST["replid"];
			$urutan				=	(empty($_POST["urutan"])) ? 0 : $_POST["urutan"];
			$agama			=	$_POST["agama"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update agama set agama='$agama', urutan='$urutan', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update tahun buku
	function update_tahunbuku($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$tahunbuku			=	$_POST["tahunbuku"];
			$awalan				=	$_POST["awalan"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$departemen		=	$_POST["departemen"];
			$tanggalmulai		=	date("Y-m-d", strtotime($_POST['tanggalmulai']));
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update tahunbuku set tahunbuku='$tahunbuku', awalan='$awalan', aktif='$aktif', keterangan='$keterangan', departemen='$departemen', tanggalmulai='$tanggalmulai', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update rekakun
	function update_rekakun($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	$_POST["kode"];
			$kategori			=	$_POST["kategori"];
			$nama				=	$_POST["nama"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update rekakun set kode='$kode', kategori='$kategori', nama='$nama', keterangan='$keterangan', ts='$ts' where kode='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update datapenerimaan
	function update_datapenerimaan($ref){
		
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
			
			$sqlstr = "update datapenerimaan set idkategori='$idkategori', departemen='$departemen', nama='$nama', rekkas='$rekkas', rekpendapatan='$rekpendapatan', rekpiutang='$rekpiutang', keterangan='$keterangan', nourut='$nourut', aktif='$aktif', full='$full', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update datapengeluaran
	function update_datapengeluaran($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$departemen			=	$_POST["departemen"];
			$nama				=	$_POST["nama"];
			$rekdebet			=	$_POST["rekdebet"];
			$rekkredit			=	$_POST["rekkredit"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update datapengeluaran set departemen='$departemen', nama='$nama', rekdebet='$rekdebet', rekkredit='$rekkredit', keterangan='$keterangan', aktif='$aktif', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update besarjtt
	function update_besarjtt($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$semua 				= 	$_POST['semua'];
			$departemen			=	$_POST['departemen'];
			$idtingkat			=	$_POST['idtingkat'];
			$idangkatan			=	$_POST['idangkatan'];
			$nis				=	$_POST["nis"];
			$idpenerimaan		=	$_POST["idpenerimaan"];
			$besar				=	numberreplace($_POST["besar"]);
			$cicilan			=	numberreplace($_POST["cicilan"]);
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$potongan			=	numberreplace($_POST["potongan"]);
			$ts					=	date("Y-m-d H:i:s");
			$uid				=	$_SESSION["loginname"];
			//$tahunbuku			=	$_SESSION["tahunbuku"];
			$old_tahunbuku		=	$_POST["old_tahunbuku"];
			
			$sqltb = "select replid from tahunbuku where departemen='$departemen' order by tanggalmulai desc limit 1";
			$query = $dbpdo->prepare($sqltb);
			$query->execute();
			$datatb = $query->fetch(PDO::FETCH_OBJ);
			$tahunbuku = $datatb->replid;
			
			if($semua == 1) {
				$sqlstr2 = "select a.replid, a.nis from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid where c.departemen='$departemen' and b.idtingkat='$idtingkat' and a.idangkatan='$idangkatan' ";
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
					} else {
						$sqlstr = "update besarjtt set idpenerimaan='$idpenerimaan', besar='$besar', cicilan='$cicilan', keterangan='$keterangan', pengguna='$uid', info2='$tahunbuku', ts='$ts', potongan='$potongan' where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
				}
				
			} else {
				
				$sqlstr = "update besarjtt set nis='$nis', idpenerimaan='$idpenerimaan', besar='$besar', cicilan='$cicilan', keterangan='$keterangan', pengguna='$uid', info2='$tahunbuku', ts='$ts', potongan='$potongan' where replid='$ref'";
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
	
	
	//------update penerimaanjtt
	function update_penerimaanjtt($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$nis				=	$_POST["nis"];
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));
			$idpenerimaan		=	$_POST["idpenerimaan"];
			$tahunbuku			=	$_POST["tahunbuku"];
			$nama				=	petikreplace($_POST["nama"]);
			$besar				=	numberreplace($_POST["besar"]);
			$jumlah				=	numberreplace($_POST["jumlah"]);
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$idjurnal			=	$_POST["idjurnal"];
			$idjenis_bayar		=	$_POST["idjenis_bayar"];
			
			$ts					=	date("Y-m-d H:i:s");
			$uid				=	$_SESSION["loginname"];
							
			$sqlstr = "update penerimaanjtt set idjenis_bayar='$idjenis_bayar', jumlah='$jumlah', keterangan='$keterangan', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//cek lunas
			$sqlstr = "select sum(b.besar) - sum(a.jumlah) sisa from penerimaanjtt a left join besarjtt b on a.idbesarjtt=b.replid group by b.nis, b.idpenerimaan having b.nis='$nis' and b.idpenerimaan='$idpenerimaan'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$sisa = $data->sisa;
			
			if($sisa <= 0) {
				$sqlstr = "update besarjtt set lunas=1 where nis='$nis' and idpenerimaan='$idpenerimaan'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			} else {
				$sqlstr = "update besarjtt set lunas=0 where nis='$nis' and idpenerimaan='$idpenerimaan'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
			//jurnal
			$sqlstr = "update jurnal set tanggal='$tanggal', keterangan='$keterangan', petugas='$uid' where replid='$idjurnal'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
				
			//update ke jurnaldetail
			##DEBIT
			$cek = "select replid from jurnaldetail where idjurnal='$idjurnal' order by replid asc limit 1";
			$xcek=$dbpdo->prepare($cek);
			$xcek->execute();
			$datacek=$xcek->fetch(PDO::FETCH_OBJ);
			$replid=$datacek->replid;
			
			$sqlstr = "update jurnaldetail set debet=$jumlah where idjurnal='$idjurnal' and replid='$replid'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
			##KREDIT
			$cek = "select replid from jurnaldetail where idjurnal='$idjurnal' order by replid desc limit 1";
			$xcek=$dbpdo->prepare($cek);
			$xcek->execute();
			$datacek=$xcek->fetch(PDO::FETCH_OBJ);
			$replid=$datacek->replid;
			
			$sqlstr = "update jurnaldetail set kredit=$jumlah where idjurnal='$idjurnal' and replid='$replid'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
					
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update perpustakaan
	function update_perpustakaan($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$departemen			=	$_POST["departemen"];
			$nama				=	$_POST["nama"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update perpustakaan set nama='$nama', keterangan='$keterangan', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			//----update perpustakaan identitas
			$sqlstr = "update identitas set perpustakaan='$nama' where departemen='$departemen' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update format
	function update_format($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	$_POST["kode"];
			$nama				=	$_POST["nama"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update format set kode='$kode', nama='$nama', keterangan='$keterangan', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update rak
	function update_rak($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$rak				=	$_POST["rak"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update rak set rak='$rak', keterangan='$keterangan', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update katalog
	function update_katalog($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	$_POST["kode"];
			$nama				=	petikreplace($_POST["nama"]);
			$rak				=	(empty($_POST["rak"])) ? 0 : $_POST["rak"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update katalog set kode='$kode', nama='$nama', rak='$rak', keterangan='$keterangan', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update penerbit
	function update_penerbit($ref){
		
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
			
			$sqlstr = "update penerbit set kode='$kode', nama='$nama', alamat='$alamat', telpon='$telpon', email='$email', fax='$fax', website='$website', kontak='$kontak', keterangan='$keterangan', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update penulis
	function update_penulis($ref){
		
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
			
			$sqlstr = "update penulis set kode='$kode', gelardepan='$gelardepan', nama='$nama', gelarbelakang='$gelarbelakang', kontak='$kontak', biografi='$biografi', keterangan='$keterangan', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update pustaka
	function update_pustaka($ref){
		
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
			$old_katalog		=	(empty($_POST["old_katalog"])) ? 0 : $_POST["old_katalog"];
			
			//-----------upload file photo
			$uploaddir 		= 'app/file_foto_pustaka/';
			$photo2	= $_POST["photo2"];
			$photo 	= $_FILES['photo']['name']; 
			$tmpname  		= $_FILES['photo']['tmp_name'];
			$filesize 		= $_FILES['photo']['size'];
			$filetype 		= $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} 
			
			if($photo != "") {	
				
				if($photo != $photo2) {
				
					if(!empty($photo2)) {
						unlink($uploaddir . $photo2); //remove file 
					}
					
					$photo = $format . '_' . $photo;
				}
							
				$uploadfile = $uploaddir . $photo;		
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$harga				=	numberreplace($_POST["harga"]);
			$jumlah				=	numberreplace($_POST["jumlah"]);
			$jumlah2			=	numberreplace($_POST["jumlah2"]);
			$departemen			=	$_POST["departemen"];
			$tanggal_masuk		=	date("Y-m-d", strtotime($_POST["tanggal_masuk"]));
			$keterangan_pustaka	=	$_POST["keterangan_pustaka"];
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pustaka set judul='$judul', abstraksi='$abstraksi', keyword='$keyword', tahun='$tahun', keteranganfisik='$keteranganfisik', penulis='$penulis', penerbit='$penerbit', format='$format', katalog='$katalog', photo='$photo', keterangan='$keterangan', harga='$harga', departemen='$departemen', tanggal_masuk='$tanggal_masuk', keterangan_pustaka='$keterangan_pustaka', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			/*--------insert jumlah--------*/
			if($old_katalog == $katalog) {
				$sqlstr = "select count(replid) mcount from daftarpustaka where pustaka='$ref'";
				$sqlcek = $dbpdo->prepare($sqlstr);
				$sqlcek->execute();
				$rowdata = $sqlcek->fetch(PDO::FETCH_OBJ);
				$jum = $rowdata->mcount;
				
				$sqlstr = "delete from daftarpustaka where pustaka='$ref'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				$sqlstr 	= 	"select counter from katalog where replid='$old_katalog'";
				$sqlcek		=	$dbpdo->query($sqlstr);
				$data		=	$sqlcek->fetch(PDO::FETCH_OBJ);
				$counter 	= 	$data->counter;
				
				$newcounter = (int)$counter - (int)$jum;
								
				$sqlstr = "update katalog set counter=$newcounter where replid='$old_katalog'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				$sqlstr 	= 	"select counter from katalog where replid='$old_katalog'";
				$sqlcek		=	$dbpdo->query($sqlstr);
				$data		=	$sqlcek->fetch(PDO::FETCH_OBJ);
				$counter 	= 	$data->counter;
				
				$replid		=	1;
				for($n=1; $n<=$jumlah; $n++) {
					$counter++;
					$sqlstr = "update katalog set counter=$counter where replid='$katalog'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					if($kodepustaka_crt == "" && $jumlah > 1) {
						$kodepustaka = GenKodePustaka($katalog,$penulis,$judul,$format,$counter);	
					} else {
						$kodepustaka = $kodepustaka_crt;
					}
					
					$sqlstr = "insert into daftarpustaka (pustaka, perpustakaan, kodepustaka) values ('$ref', '$replid', '$kodepustaka')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
				
			} else {
				
				$sqlstr = "select count(replid) mcount from daftarpustaka where pustaka='$ref'";
				$sqlcek = $dbpdo->prepare($sqlstr);
				$sqlcek->execute();
				$rowdata = $sqlcek->fetch(PDO::FETCH_OBJ);
				$jum = $rowdata->mcount;
				
				$sqlstr = "delete from daftarpustaka where pustaka='$ref'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				$sqlstr 	= 	"select counter from katalog where replid='$old_katalog'";
				$sqlcek		=	$dbpdo->query($sqlstr);
				$data		=	$sqlcek->fetch(PDO::FETCH_OBJ);
				$counter 	= 	$data->counter;
				
				$newcounter = (int)$counter - (int)$jum;
								
				$sqlstr = "update katalog set counter=$newcounter where replid='$old_katalog'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				$sqlstr 	= 	"select counter from katalog where replid='$katalog'"; //katalog yg baru
				$sqlcek		=	$dbpdo->query($sqlstr);
				$data		=	$sqlcek->fetch(PDO::FETCH_OBJ);
				$counter 	= 	$data->counter;
				
				$replid		=	1;
				for($n=1; $n<=$jumlah; $n++) {
					$counter++;
					$sqlstr = "update katalog set counter=$counter where replid='$katalog'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					if($kodepustaka_crt == "" && $jumlah > 1) {
						$kodepustaka = GenKodePustaka($katalog,$penulis,$judul,$format,$counter);	
					} else {
						$kodepustaka = $kodepustaka_crt;
					}
					$sqlstr = "insert into daftarpustaka (pustaka, perpustakaan, kodepustaka) values ('$ref', '$replid', '$kodepustaka')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
					
			}
			
			if($jumlah2 > 0) {
				$replid		=	1;
				for($n=1; $n<=$jumlah2; $n++) {
					$counter++;
					
					if($old_katalog == $katalog) {
						$sqlstr = "update katalog set counter=$counter where replid='$old_katalog'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$sqlstr = "update katalog set counter=$counter where replid='$katalog'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
					
					//$kodepustaka = GenKodePustaka($katalog,$penulis,$judul,$format,$counter);
					if($kodepustaka_crt == "" && $jumlah > 1) {
						$kodepustaka = GenKodePustaka($katalog,$penulis,$judul,$format,$counter);	
					} else {
						$kodepustaka = $kodepustaka_crt;
					}
					$sqlstr = "insert into daftarpustaka (pustaka, perpustakaan, kodepustaka) values ('$ref', '$replid', '$kodepustaka')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			
			/*------------pustaka supplier-------------*/
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($x=0; $x<=$jmldata; $x++) {
				$delete 			= 	(empty($_POST[delete_.$x])) ? 0 : $_POST[delete_.$x];
				$old_supplier_id 	= 	(empty($_POST[old_supplier_id_.$x])) ? 0 : $_POST[old_supplier_id_.$x];
				
				$supplier_id	=	$_POST[supplier_id_.$x];
				
				if ( $supplier_id != "" ) {
					
					$sqlcek = "select pustaka_id from pustaka_supplier where pustaka_id='$ref' and supplier_id='$old_supplier_id' ";									
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							$sqlstr="update pustaka_supplier set supplier_id='$supplier_id' where supplier_id='$ref' and supplier_id='$old_supplier_id'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
						} else {
							$sqlstr="delete from pustaka_supplier where pustaka_id='$ref' and supplier_id='$old_supplier_id'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();							
						}
						
						
					} else {
						
						$sqlstr = "insert into pustaka_supplier (pustaka_id, supplier_id) values ('$ref', '$supplier_id')";
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
	
	
	//------update daftarpustaka
	function update_daftarpustaka($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$pustaka			=	$_POST["pustaka"];
			$perpustakaan		=	1;
			$kodepustaka		=	$_POST["kodepustaka"];
			$status				=	(empty($_POST["status"])) ? 0 : $_POST["status"];
			$ts					=	date("Y-m-d H:i:s");
			
			
			$sqlstr = "update daftarpustaka set pustaka='$pustaka', kodepustaka='$kodepustaka', status='$status', ts='$ts' where replid='$ref'";
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
		//--------------------------/\
		
	}
	
	
	//------update konfigurasi
	function update_konfigurasi($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$siswa				=	numberreplace($_POST["siswa"]);
			$pegawai			=	numberreplace($_POST["pegawai"]);
			$other				=	numberreplace($_POST["other"]);
			$denda				=	numberreplace($_POST["denda"]);
			
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update konfigurasi set siswa='$siswa', pegawai='$pegawai', other='$other', denda='$denda', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update pegawai
	function update_pegawai($ref){
		
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
			$tanggal_pensiun	=	date("Y-m-d", strtotime($_POST["instansi_pasangan"]));
			
			$no_sk_tetap		=	$_POST["no_sk_tetap"];
			$tanggal_sk_tetap	=	date("Y-m-d", strtotime($_POST["tanggal_sk_tetap"]));
			
			//-----------upload file photo
			$uploaddir 		= 'app/file_foto_pegawai/';
			$foto_file2	= $_POST["foto_file2"];
			$foto_file 	= $_FILES['foto_file']['name']; 
			$tmpname  		= $_FILES['foto_file']['tmp_name'];
			$filesize 		= $_FILES['foto_file']['size'];
			$filetype 		= $_FILES['foto_file']['type'];
			
			if (empty($foto_file)) { 
				$foto_file = $foto_file2; 
			} 
			
			if($foto_file != "") {	
				
				if($foto_file != $foto_file2) {
				
					if(!empty($foto_file2)) {
						unlink($uploaddir . $foto_file2); //remove file 
					}
					
					$foto_file = $nip . '_' . $foto_file;
				}
							
				$uploadfile = $uploaddir . $foto_file;		
				if (move_uploaded_file($_FILES['foto_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pegawai set bagian='$bagian', nip='$nip', nama='$nama', panggilan='$panggilan', kelamin='$kelamin', gelar='$gelar', tmplahir='$tmplahir', tgllahir='$tgllahir', agama='$agama', suku='$suku', nikah='$nikah', jenis_id='$jenis_id', noid='$noid', alamat='$alamat', telpon='$telpon', handphone='$handphone', email='$email', karpeg='$karpeg', no_sertifikasi='$no_sertifikasi', idjenis_sertifikasi='$idjenis_sertifikasi', npwp='$npwp',	nuptk='$nuptk', tmt_cpns='$tmt_cpns', unit_cpns='$unit_cpns', no_sk_masuk='$no_sk_masuk', idstatus_pegawai='$idstatus_pegawai', nik='$nik', nama_ibu='$nama_ibu', nama_pasangan='$nama_pasangan', tempat_lahir_pasangan='$tempat_lahir_pasangan', tanggal_lahir_pasangan='$tanggal_lahir_pasangan', tanggal_nikah='$tanggal_nikah', tempat_nikah='$tempat_nikah', pekerjaan_pasangan='$pekerjaan_pasangan', instansi_pasangan='$instansi_pasangan', nip_pasangan='$nip_pasangan', keluarga_tanggungan='$keluarga_tanggungan', usia='$usia', ajar_lain='$ajar_lain', jumlah_jam_ajar_lain='$jumlah_jam_ajar_lain', nama_bank='$nama_bank', unit_bank='$unit_bank', no_rek='$no_rek', nama_pemilik='$nama_pemilik', desa='$desa', kecamatan='$kecamatan', kode_pos='$kode_pos', tanggal_pensiun='$tanggal_pensiun', foto_file='$foto_file', keterangan='$keterangan', no_sk_tetap='$no_sk_tetap', tanggal_sk_tetap='$tanggal_sk_tetap', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
		
	}
	
	//------update statusguru
	function update_statusguru($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$status				=	numberreplace($_POST["status2"]);
			$keterangan			=	numberreplace($_POST["keterangan"]);
			
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update statusguru set status='$status', keterangan='$keterangan', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update jabatan
	function update_jabatan($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "update jabatan set nama='$nama', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update jenis pelanggaran
	function update_jenis_pelanggaran($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];
			$poin		=	numberreplace($_POST["poin"]);
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "update jenis_pelanggaran set nama='$nama', poin='$poin', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update jenis prestasi
	function update_jenis_prestasi($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];
			$poin		=	numberreplace($_POST["poin"]);
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "update jenis_prestasi set nama='$nama', poin='$poin', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update pelanggaran_siswa
	function update_pelanggaran_siswa($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idsiswa			=	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));
			$idjenis_pelanggaran=	(empty($_POST["idjenis_pelanggaran"])) ? 0 : $_POST["idjenis_pelanggaran"];
			$kejadian			=	petikreplace($_POST["kejadian"]);
			$hukuman			=	petikreplace($_POST["hukuman"]);
			
			//-----------upload file photo
			$uploaddir 		= 'app/file_foto_pelanggaran/';
			$photo2			= $_POST["photo2"];
			$photo 			= $_FILES['photo']['name']; 
			$tmpname  		= $_FILES['photo']['tmp_name'];
			$filesize 		= $_FILES['photo']['size'];
			$filetype 		= $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} 
			
			if($photo != "") {	
				
				if($photo != $photo2) {
				
					if(!empty($photo2)) {
						unlink($uploaddir . $photo2); //remove file 
					}
					
					$photo = $ref . '_' . $photo;
				}
							
				$uploadfile = $uploaddir . $photo;		
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pelanggaran_siswa set tanggal='$tanggal', idsiswa='$idsiswa', idjenis_pelanggaran='$idjenis_pelanggaran', kejadian='$kejadian', hukuman='$hukuman', photo='$photo', uid='$uid', dlu='$dlu' where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update konseling_siswa
	function update_konseling_siswa($ref){
		
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
			
			//-----------upload file data
			$uploaddir 		= 'app/file_konseling/';
			$data_file2		= $_POST["data_file2"];
			$data_file 		= $_FILES['data_file']['name']; 
			$tmpname  		= $_FILES['data_file']['tmp_name'];
			$filesize 		= $_FILES['data_file']['size'];
			$filetype 		= $_FILES['data_file']['type'];
			
			if (empty($data_file)) { 
				$data_file = $data_file2; 
			} 
			
			if($data_file != "") {	
				
				if($data_file != $data_file2) {
				
					if(!empty($data_file2)) {
						unlink($uploaddir . $data_file2); //remove file 
					}
					
					$data_file = $ref . '_' . $nis . '_' . $data_file;
				}
							
				$uploadfile = $uploaddir . $data_file;		
				if (move_uploaded_file($_FILES['data_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			$sqlstr = "update konseling_siswa set tanggal='$tanggal', idsiswa='$idsiswa', idjenis_konseling='$idjenis_konseling', konseling='$konseling', solusi='$solusi', nip='$nip', data_file='$data_file', uid='$uid', dlu='$dlu' where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update pegawai_jabatan
	function update_pegawai_jabatan($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$idjabatan			=	(empty($_POST["idjabatan"])) ? 0 : $_POST["idjabatan"];
			$tanggal_efektif	=	date("Y-m-d", strtotime($_POST["tanggal_efektif"]));
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pegawai_jabatan set idjabatan='$idjabatan', tanggal_efektif='$tanggal_efektif', keterangan='$keterangan', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
    //------update jenis izin
	function update_jenis_izin($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$nama		    =	$_POST["nama"];
			$keterangan	    =	petikreplace($_POST["keterangan"]);
            $format_surat	=	petikreplace($_POST["format_surat"]);
			$aktif		    =	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		    =	$_SESSION["loginname"];
			$dlu		    =	date("Y-m-d H:i:s");
			
			$sqlstr = "update jenis_izin set nama='$nama', keterangan='$keterangan', format_surat='$format_surat', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
    
	
    //------update izin siswa
	function update_izin_siswa($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idsiswa	    =	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
            $jam            =   $_POST["jam"];
            $menit          =   $_POST["menit"];
            $jam            =   $jam . ":" . $menit;
            echo $jam;
            $tanggal        =   date("Y-m-d H:i", strtotime($_POST["tanggal"] . " " . $jam ));
            $idjenis_izin   =	(empty($_POST["idjenis_izin"])) ? 0 : $_POST["idjenis_izin"];            
            //$format_surat	=	petikreplace($_POST["format_surat"]);
			$keterangan	    =	petikreplace($_POST["keterangan"]);
            $idpegawai	    =	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$status		    =	$_POST["status"];
			$uid		    =	$_SESSION["loginname"];
			$dlu		    =	date("Y-m-d H:i:s");
			
            //---get data siswa---
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
            
            //$valuesurat    = 'NIS<span class="Apple-tab-span" style="white-space: pre;">	        </span>: ' . $nis . '</b></div><div><b>Nama<span class="Apple-tab-span" style="white-space:pre">	</span>: ' . $nama . '</b></div><div><b>Tingkat<span class="Apple-tab-span" style="white-space:pre">	</span>: '. $tingkat . '</b></div><div><b>Kelas<span class="Apple-tab-span" style="white-space: pre;">	</span>: ' . $kelas;
            
            //---get format surat---
            $sqljns     = "select format_surat from jenis_izin where replid='$idjenis_izin'";
            $sqljns     = $dbpdo->prepare($sqljns);
            $sqljns->execute();
            $datajns    = $sqljns->fetch(PDO::FETCH_OBJ); 
            //--------end-----------
            
            $format_surat = petikreplace(str_replace("@nis", $nis ,$datajns->format_surat));
            $format_surat = petikreplace(str_replace("@nama", $nama ,$format_surat));
            $format_surat = petikreplace(str_replace("@tingkat", $tingkat ,$format_surat));
            $format_surat = petikreplace(str_replace("@kelas", $kelas ,$format_surat));
            
            $format_surat = petikreplace(str_replace("@nip", $nip ,$format_surat));
            $format_surat = petikreplace(str_replace("@pegawai", $namapegawai ,$format_surat));
            
            
			$sqlstr = "update izin_siswa set tanggal='$tanggal', idsiswa='$idsiswa', idjenis_izin='$idjenis_izin', format_surat='$format_surat', keterangan='$keterangan', idpegawai='$idpegawai', status='$status', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
    
    
    //------update pangkat
	function update_pangkat($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pangkat set nama='$nama', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update pegawai_pangkat
	function update_pegawai_pangkat($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$idpangkat			=	(empty($_POST["idpangkat"])) ? 0 : $_POST["idpangkat"];
			$tanggal_efektif	=	date("Y-m-d", strtotime($_POST["tanggal_efektif"]));
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pegawai_pangkat set idpangkat='$idpangkat', tanggal_efektif='$tanggal_efektif', keterangan='$keterangan', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update jenis sertifikasi
	function update_jenis_sertifikasi($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "update jenis_sertifikasi set nama='$nama', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update status_pegawai
	function update_status_pegawai($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "update status_pegawai set nama='$nama', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update pegawai_kenaikan gaji berkala
	function update_kenaikan_gaji($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$no_kgb				=	$_POST["no_kgb"];
			$gaji_pokok			=	numberreplace($_POST["gaji_pokok"]);			
			$tmt				=	date("Y-m-d", strtotime($_POST["tmt"]));
			$tanggal_kgb		=	date("Y-m-d", strtotime($_POST["tanggal_kgb"]));
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "update kenaikan_gaji set no_kgb='$no_kgb', tmt='$tmt', tanggal_kgb='$tanggal_kgb', gaji_pokok='$gaji_pokok', keterangan='$keterangan', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update pegawai_pendidikan
	function update_pegawai_pendidikan($ref){
		
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
			
			$sqlstr = "update pegawai_pendidikan set nama_sekolah='$nama_sekolah', tahun='$tahun', jenjang='$jenjang', lulusan='$lulusan', jurusan='$jurusan', keterangan='$keterangan', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update pegawai_keluarga
	function update_pegawai_keluarga($ref){
		
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
			
			$sqlstr = "update pegawai_keluarga set nama_anak='$nama_anak', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', pekerjaan='$pekerjaan', status='$status', anak_ke='$anak_ke', keterangan='$keterangan', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update supplier
	function update_supplier($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$nama				=	petikreplace($_POST["nama"]);
			$alamat				=	petikreplace($_POST["alamat"]);
			$telepon			=	$_POST["telepon"];
			$hp					=	$_POST["hp"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update supplier set nama='$nama', alamat='$alamat', telepon='$telepon', hp='$hp', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update pegawai_prestasi
	function update_pegawai_prestasi($ref){
		
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
			
			$sqlstr = "update pegawai_prestasi set jenisprestasi='$jenisprestasi', tingkat='$tingkat', nama='$nama', tahun='$tahun', penyelenggara='$penyelenggara', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update pegawai_penghargaan
	function update_pegawai_penghargaan($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$namapenghargaan	=	petikreplace($_POST["namapenghargaan"]);
			$tahun				=	(empty($_POST["tahun"])) ? 0 : $_POST["tahun"];
			$pemberipenghargaan	=	petikreplace($_POST["pemberipenghargaan"]);
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pegawai_penghargaan set namapenghargaan='$namapenghargaan', tahun='$tahun', pemberipenghargaan='$pemberipenghargaan', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	
	//------update pegawai_skmengajar
	function update_pegawai_skmengajar($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$no_sk				=	petikreplace($_POST["no_sk"]);
			$tahun				=	(empty($_POST["tahun"])) ? 0 : $_POST["tahun"];
			$fungsional			=	petikreplace($_POST["fungsional"]);
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pegawai_skmengajar set no_sk='$no_sk', tahun='$tahun', fungsional='$fungsional', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update pelajaran
	function update_pelajaran($ref){
		
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
			
			$sqlstr = "update pelajaran set kode='$kode', nama='$nama', departemen='$departemen', sifat='$sifat', ekstra_sifat='$ekstra_sifat', pegawai_id='$pegawai_id', aktif='$aktif', keterangan='$keterangan', info1='$sks', info2='$kkm_p', info3='$uid', alias='$alias', idpelajaran_alias='$idpelajaran_alias', minat='$minat', bentrok='$bentrok', token='$kkm_k', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update siswa ekstrakurikuler
	function update_siswa_ekstrakurikuler($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idtahunajaran	=	$_SESSION["idtahunajaran"];
			$idsemester		=	$_SESSION["semester_id"];
			
			$idsiswa		=	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			##ekstrakurikuler wajib
			$sqlstr = "select replid from pelajaran where ifnull(sifat,0)=0 and ifnull(ekstra_sifat,0)=1";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			while($data=$sql->fetch(PDO::FETCH_OBJ)) {
				$sqlstr = "delete from siswa_ekstrakurikuler where  idsiswa='$idsiswa' and idpelajaran='$data->replid' and idtahunajaran='$idtahunajaran' and idpelajaran='$pelajaran_id' and idsemester='$idsemester' ";
				$sql1=$dbpdo->prepare($sqlstr);
				$sql1->execute(); 
			}
			$wajib			=	$_POST["wajib"];
			$pelajaran_id	=	$wajib;
			
			if($pelajaran_id != "") {
				$line = maxline('siswa_ekstrakurikuler', 'line', 'idsiswa', $idsiswa, '');	
				
				$sqlstr = "select idsiswa from siswa_ekstrakurikuler where idsiswa='$idsiswa' and idtahunajaran='$idtahunajaran' and idpelajaran='$pelajaran_id' and idsemester='$idsemester' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$rows = $sql->rowCount();
				
				if($rows == 0) {		
					$sqlstr = "insert into siswa_ekstrakurikuler (idsiswa, idtahunajaran, idsemester, idpelajaran, tanggal, uid, dlu, line) values ('$idsiswa', '$idtahunajaran', '$idsemester', '$pelajaran_id', '$tanggal', '$uid', '$dlu', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			##ekstrakurikuler pilihan
			$jmldata		=	(empty($_POST["jmldata"])) ? 0 : $_POST["jmldata"];
			$k=0;
			for($k=0; $k<$jmldata; $k++) {
				$urutan			=	$_POST[urutan_.$k];
				$pelajaran_id	=	$_POST[pelajaran_id_.$k];
				$pilih			=	$_POST[pilih_.$k];
				if($urutan == 1) {
					if($pilih == 0) {						
						$sqlstr = "delete from siswa_ekstrakurikuler where idsiswa='$idsiswa' and idpelajaran='$pelajaran_id' and idtahunajaran='$idtahunajaran' and idpelajaran='$pelajaran_id' and idsemester='$idsemester' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();						
					} 
				}			
				
				if($urutan == 0) {
					if($pilih == 1) {
						$line = maxline('siswa_ekstrakurikuler', 'line', 'idsiswa', $idsiswa, '');
				
						$sqlstr = "select idsiswa from siswa_ekstrakurikuler where idsiswa='$idsiswa' and idtahunajaran='$idtahunajaran' and idpelajaran='$pelajaran_id' and idsemester='$idsemester' ";
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
			}
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update semester
	function update_semester($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$semester			=	$_POST["semester"];
			$departemen			=	$_POST["departemen"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$tanggal_ttd		=	date("Y-m-d", strtotime($_POST["tanggal_ttd"]));
			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update semester set semester='$semester', departemen='$departemen', keterangan='$keterangan', tanggal_ttd='$tanggal_ttd', aktif='$aktif', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update angkatan
	function update_angkatan($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$angkatan			=	$_POST["angkatan"];
			$departemen			=	$_POST["departemen"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update angkatan set angkatan='$angkatan', departemen='$departemen', aktif='$aktif', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update rpp
	function update_rpp($ref){
		
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
			$uploaddir 		= 'app/file_rpp/';
			$info32			= $_POST["info32"];
			$info3 			= $_FILES['info3']['name']; 
			$tmpname  		= $_FILES['info3']['tmp_name'];
			$filesize 		= $_FILES['info3']['size'];
			$filetype 		= $_FILES['info3']['type'];
			
			if (empty($info3)) { 
				$info3 = $info32; 
			} 
			
			if($info3 != "") {	
				
				if($info3 != $info32) {
				
					if(!empty($info32)) {
						unlink($uploaddir . $info32); //remove file 
					}
					
					$info3 = $idpelajaran . '_' . $info3;
				}
							
				$uploadfile = $uploaddir . $info3;		
				if (move_uploaded_file($_FILES['info3']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update rpp set idtingkat='$idtingkat', idsemester='$idsemester', idpelajaran='$idpelajaran', idguru='$idguru', koderpp='$koderpp', rpp='$rpp', deskripsi='$deskripsi', info3='$info3', jumlah_ukbm='$jumlah_ukbm', minimum_hadir='$minimum_hadir', aktif='$aktif', ts='$dlu' where replid='$ref'";
			
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update dasarpenilaian
	function update_dasarpenilaian($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$dasarpenilaian		=	$_POST["dasarpenilaian"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update dasarpenilaian set dasarpenilaian='$dasarpenilaian', keterangan='$keterangan', ts='$dlu' where replid='$ref'";
			
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update kompetensi
	function update_kompetensi($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	$_POST["kode"];
			$kompetensi			=	petikreplace($_POST["kompetensi"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update kompetensi set kode='$kode', kompetensi='$kompetensi', aktif='$aktif', dlu='$dlu' where replid='$ref'";
			
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update jenis kompetensi
	function update_jeniskompetensi($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$jeniskompetensi	=	petikreplace($_POST["jeniskompetensi"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update jeniskompetensi set jeniskompetensi='$jeniskompetensi', aktif='$aktif', dlu='$dlu' where replid='$ref'";
			
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update aspek_perkembangan
	function update_aspek_perkembangan($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$aspek		=	petikreplace($_POST["aspek"]);
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "update aspek_perkembangan set aspek='$aspek', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update aspek_psikologi
	function update_aspek_psikologi($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$departemen	=	$_POST["departemen"];
			$aspek		=	petikreplace($_POST["aspek"]);
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "update aspek_psikologi set departemen='$departemen', aspek='$aspek', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update aspek_psikologi_detail
	function update_aspek_psikologi_detail($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$jenis_aspek_id = $_POST["jenis_aspek_id"];
			$departemen	=	$_POST["departemen"];
			$aspek		=	petikreplace($_POST["aspek"]);
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "update aspek_psikologi_detail set departemen='$departemen', jenis_aspek_id='$jenis_aspek_id', aspek='$aspek', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update assesmen_observasi
	function update_assesmen_observasi($ref){
		
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
			$uploaddir 		= 'app/file_assesment/';
			$data_file2	= $_POST["data_file2"];
			$data_file 	= $_FILES['data_file']['name']; 
			$tmpname  		= $_FILES['data_file']['tmp_name'];
			$filesize 		= $_FILES['data_file']['size'];
			$filetype 		= $_FILES['data_file']['type'];
			
			if (empty($data_file)) { 
				$data_file = $data_file2; 
			} 
			
			if($data_file != "") {	
				
				if($data_file != $data_file2) {
				
					if(!empty($data_file2)) {
						unlink($uploaddir . $data_file2); //remove file 
					}
					
					$data_file = $ref . '_' . $nis . '_' . $data_file;
				}
							
				$uploadfile = $uploaddir . $data_file;		
				if (move_uploaded_file($_FILES['data_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			$sqlstr = "update assesmen_observasi set tanggal='$tanggal', idsiswa='$idsiswa', idpegawai='$idpegawai', idpegawai1='$idpegawai1', data_file='$data_file', uid='$uid', dlu='$dlu' where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
		
		
			/*------------siswa prestasi-------------*/
			/*$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($x=0; $x<=$jmldata; $x++) {
				//$delete 			= 	(empty($_POST[delete_.$x])) ? 0 : $_POST[delete_.$x];
				$old_line		 	= 	(empty($_POST[old_line_.$x])) ? 0 : $_POST[old_line_.$x];
				
				$idaspek_perkembangan	=	$_POST[idaspek_perkembangan_.$x];
				$hasil					=	petikreplace($_POST[hasil_.$x]);
				$saran					=	petikreplace($_POST[saran_.$x]);
				
				if ( $hasil != "" ) {
					
					$sqlcek = "select ref from assesmen_observasi_detail where ref='$ref' and line='$old_line' ";										
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					
					if($num > 0) {
						//if($delete == 0) {
							$sqlstr="update assesmen_observasi_detail set idaspek_perkembangan='$idaspek_perkembangan', hasil='$hasil', saran='$saran' where ref='$ref' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();*/
							
						/*} else {
							$sqlstr="delete from assesmen_observasi_detail where ref='$ref' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();							
						}*/
						
						/*
					} else {
						
						$line = maxline('assesmen_observasi_detail', 'line', 'ref', $ref, '');
				
						$sqlstr = "insert into assesmen_observasi_detail (ref, idaspek_perkembangan, hasil, saran, line) values ('$ref', '$idaspek_perkembangan', '$hasil', '$saran', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
											
					}
					
				}
			}*/
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update anggota
	function update_anggota($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$noregistrasi = $_POST["noregistrasi"];
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
			
			
			//-----------upload file photo
			$uploaddir 		= 'app/file_foto_anggota/';
			$foto2			= $_POST["foto2"];
			$foto 			= $_FILES['foto']['name']; 
			$tmpname  		= $_FILES['foto']['tmp_name'];
			$filesize 		= $_FILES['foto']['size'];
			$filetype 		= $_FILES['foto']['type'];
			
			if (empty($foto)) { 
				$foto = $foto2; 
			} 
			
			if($foto != "") {	
				
				if($foto != $foto2) {
				
					if(!empty($foto2)) {
						unlink($uploaddir . $foto2); //remove file 
					}
					
					$foto = $noregistrasi . '_' . $foto;
				}
							
				$uploadfile = $uploaddir . $foto;		
				if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "update anggota set nama='$nama', alamat='$alamat', kodepos='$kodepos', email='$email', telpon='$telpon', HP='$HP', pekerjaan='$pekerjaan', institusi='$institusi', keterangan='$keterangan', tgldaftar='$tgldaftar', aktif='$aktif', foto='$foto', ts='$dlu' where replid='$ref'";
			
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update user reminder
	function update_usr_reminder(){
		$dbpdo = DB::create();
		
		try {
			
			$usrid		=	$_SESSION["loginname"];
			
			
			//----------insert user detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($i=1; $i<=$jmldata; $i++) {
				$mview 			= (empty($_POST[mview_.$i])) ? 0 : $_POST[mview_.$i];
				$old_reminder_id= $_POST[old_reminder_id_.$i];
				$rmd_old 		= (empty($_POST[rmd_old_.$i])) ? 0 : $_POST[rmd_old_.$i];
				
				$reminder_id 	= $_POST[reminder_id_.$i];
				
				if ($rmd_old==1) {
					if ($mview==1) {
						$sqlstr = "update usr_reminder set reminder_id='$reminder_id' where usrid='$usrid' and reminder_id='$old_reminder_id' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$sqlstr = "delete from usr_reminder where usrid='$usrid' and reminder_id='$old_reminder_id' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}	
				} 
				
				
				if ($rmd_old==0) {
				
					if ($mview==1) {			
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
				
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	
	//------update evaluasi_psikologi
	function update_evaluasi_psikologi($ref){
		$dbpdo = DB::create();
		
		try {
			
			$old_ref	=	$_POST["old_ref"];
			if($old_ref != "") {
				$ref = $old_ref;
			}
			
			$tanggal	=	date("Y-m-d", strtotime($_POST['tanggal']));
			$departemen	=	$_POST["departemen"];
			$idtingkat	= 	$_POST["idtingkat"];
			$idkelas	= 	$_POST["idkelas"];
			$nis		=	$_POST["nis"];
			$idpegawai	=	(empty($_POST['idpegawai'])) ? 0 : $_POST['idpegawai'];
			$idsemester = 	$_POST["idsemester"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			
			$sqlstr = "update evaluasi_psikologi set tanggal='$tanggal', uid='$uid', dlu='$dlu' where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
						
			/*--------update detail--------*/
			$iq	=	$_POST['iq'];
			$jmldata_jenis_aspek = $_POST['jmldata_jenis_aspek'];
			for($y=0; $y<$jmldata_jenis_aspek; $y++) {
				$jenis_aspek_id	=	$_POST[jenis_aspek_id_.$y];
				
				
				$jml_aspek_detail = $_POST[jml_aspek_detail_.$y];
				for($z=0; $z<$jml_aspek_detail; $z++) {
					
					$aspek_psikologi_id	= 	$_POST[aspek_psikologi_detail_id_.$y.$z];
					$nilai				=	$_POST[nilai_.$y.$z];
					$old_line			=	$_POST[old_line_.$y.$z];
					
					##cek detail
					$sqlstr = "select ref from evaluasi_psikologi_detail where ref='$ref' and jenis_aspek_id='$jenis_aspek_id' and aspek_psikologi_id='$aspek_psikologi_id'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rowsdet = $sql->rowCount();
					
					if($rowsdet > 0) {
						$sqlstr = "update evaluasi_psikologi_detail set iq='$iq', nilai='$nilai' where ref='$ref' and jenis_aspek_id='$jenis_aspek_id' and aspek_psikologi_id='$aspek_psikologi_id'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$line = maxline('evaluasi_psikologi_detail', 'line', 'ref', $ref, '');
					
						$sqlstr = "insert into evaluasi_psikologi_detail (ref, iq, nilai, jenis_aspek_id, aspek_psikologi_id, line) values ('$ref', '$iq', '$nilai', '$jenis_aspek_id', '$aspek_psikologi_id', '$line')";
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
	
	
	//------update pelajaran_un_minat
	function update_pelajaran_un_minat($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$pelajaran_id		=	(empty($_POST["pelajaran_id"])) ? 0 : $_POST["pelajaran_id"];
			$departemen			=	$_POST["departemen"];
			$urutan				=	(empty($_POST["urutan"])) ? 0 : $_POST["urutan"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pelajaran_un_minat set departemen='$departemen', pelajaran_id='$pelajaran_id', urutan='$urutan', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update KRS
	function update_kartu_rencana_studi($ref){
		
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
			
			$sqlstr = "update kartu_rencana_studi set peminatan='$peminatan', tingkat_id='$tingkat_id', kelompok_pelajaran_id='$kelompok_pelajaran_id', pelajaran_kode='$pelajaran_kode', pelajaran_id='$pelajaran_id', semester_id='$semester_id', sks='$sks', idtahunajaran='$idtahunajaran', urutan='$urutan', kode1='$kode1', kode2='$kode2', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update siswa krs
	function update_siswa_krs($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$nis				= 	$_POST["nis"];
			$idtahunajaran		=	$_SESSION["idtahunajaran"];
			$semester_id		=	(empty($_POST["semester_id"])) ? 0 : $_POST["semester_id"];
			$pegawai_id			=	(empty($_POST["pegawai_id"])) ? 0 : $_POST["pegawai_id"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];	
			for ($x=0; $x<=$jmldata; $x++) {	
				$pilih				= 	$_POST[pilih_.$x];
				$replid		 		= 	$_POST[replid_.$x];
				$approved	 		= 	$_POST[approved_.$x];
				$pelajaran_id		=	(empty($_POST[pelajaran_id_.$x])) ? 0 : $_POST[pelajaran_id_.$x];
				$kelompok_pelajaran_id = (empty($_POST[kelompok_pelajaran_id_.$x])) ? 0 : $_POST[kelompok_pelajaran_id_.$x];
				$sks_id				=	(empty($_POST[sks_id_.$x])) ? 0 : $_POST[sks_id_.$x];
				
				/*if($pilih == 0) {
					$sqlstr = "delete from siswa_krs where replid='$replid' and nis='$nis'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}*/
				
				if($pilih == 1) {
					$sqlstr = "select replid from siswa_krs where nis='$nis' and semester_id='$semester_id' and pelajaran_id='$pelajaran_id' and idtahunajaran='$idtahunajaran'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rowcount=$sql->rowCount();
					
					if($rowcount == 0) {
						
						//Cek status pengunjung   
						$ip_proxy=$_SERVER['REMOTE_ADDR']; 
						$ip_pc=$_SERVER['HTTP_X_FORWARDED_FOR']; 
						
						$mobile = strpos($_SERVER["HTTP_USER_AGENT"], 'Mobile') ? true : false;	
						$browser_cek = $_SERVER["HTTP_USER_AGENT"];

						$sqlstr = "insert into siswa_krs (nis, idtahunajaran, semester_id, pelajaran_id, pegawai_id, kelompok_pelajaran_id, sks_id, uid, dlu, ip_proxy, ip_pc, mobile, browser) values ('$nis', '$idtahunajaran', '$semester_id', '$pelajaran_id', '', '$kelompok_pelajaran_id', '$sks_id', '$uid', '$dlu', '$ip_proxy', '$ip_pc', '$mobile', '$browser_cek')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} 
					
				} else {
					$sqlstr = "delete from siswa_krs where replid='$replid' and nis='$nis'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
				
				if($approved == 1) {
					$sqlstr = "update siswa_krs set pegawai_id='$pegawai_id', approved=1 where replid='$replid'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}	
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update siswa krs approved
	function update_siswa_krs_approved($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$semester_id		=	(empty($_POST["semester_id"])) ? 0 : $_POST["semester_id"];
			$pegawai_id			=	(empty($_POST["pegawai_id"])) ? 0 : $_POST["pegawai_id"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];	
			for ($x=0; $x<=$jmldata; $x++) {	
				$replid		 		= 	$_POST[replid_.$x];
				$approved	 		= 	$_POST[approved_.$x];
				$pelajaran_id		=	(empty($_POST[pelajaran_id_.$x])) ? 0 : $_POST[pelajaran_id_.$x];
				$kelompok_pelajaran_id = (empty($_POST[kelompok_pelajaran_id_.$x])) ? 0 : $_POST[kelompok_pelajaran_id_.$x];
				$sks_id				=	(empty($_POST[sks_id_.$x])) ? 0 : $_POST[sks_id_.$x];
				
				if($approved == 1) {
					$sqlstr = "update siswa_krs set pegawai_id='$pegawai_id', approved=1 where replid='$replid'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				} else {
					$sqlstr = "update siswa_krs set pegawai_id='$pegawai_id', approved=0 where replid='$replid'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
				
			}	
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update pelajaran_raport_minat
	function update_pelajaran_raport_minat($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$pelajaran_id		=	(empty($_POST["pelajaran_id"])) ? 0 : $_POST["pelajaran_id"];
			$departemen			=	$_POST["departemen"];
			$urutan				=	(empty($_POST["urutan"])) ? 0 : $_POST["urutan"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pelajaran_raport_minat set departemen='$departemen', pelajaran_id='$pelajaran_id', urutan='$urutan', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update penempatan_siswa_prioritas
	function update_penempatan_siswa_prioritas($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$nama				=	$_POST["nama"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$urutan				=	(empty($_POST["urutan"])) ? 0 : $_POST["urutan"];		
			
			$sqlstr = "update penempatan_siswa_prioritas set nama='$nama', aktif='$aktif', urutan='$urutan' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	function update_guru($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idpelajaran		=	(empty($_POST["idpelajaran"])) ? 0 : $_POST["idpelajaran"];
			$aktif				=	1;
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$jmldata		=	(empty($_POST["jmldata"])) ? 0 : $_POST["jmldata"];
			$k=0;
			for($k=0; $k<$jmldata; $k++) {
				$urutan			=	$_POST[urutan_.$k];
				$replid			=	$_POST[replid_.$k];
				$nip			=	(empty($_POST[nip_.$k])) ? 0 : $_POST[nip_.$k];
				$kode			=	$_POST[kode_.$k];
				$keterangan 	= 	petikreplace($_POST[keterangan_.$k]);
				$input_pas		=	$_POST[input_pas_.$k];
				$pilih			=	$_POST[pilih_.$k];
				if($urutan == 1) {
					if($pilih == 0) {						
						$sqlstr = "delete from guru where replid='$replid' and idpelajaran='$idpelajaran'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();						
					} else {
						$sqlstr = "update guru set kode='$kode', idpelajaran='$idpelajaran', keterangan='$keterangan', info1='$input_pas', uid='$uid' where replid='$replid' and idpelajaran='$idpelajaran'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
				}			
				
				if($urutan == 0) {
					if($pilih == 1) {
						$sqlstr = "insert into guru (kode, nip, idpelajaran, aktif, keterangan, uid) values ('$kode', '$nip', '$idpelajaran', '$aktif', '$keterangan', '$uid')";
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
	
	
	function update_guru_ekskul($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idpelajaran		=	(empty($_POST["idpelajaran"])) ? 0 : $_POST["idpelajaran"];
			$aktif				=	1;
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$jmldata		=	(empty($_POST["jmldata"])) ? 0 : $_POST["jmldata"];
			$k=0;
			for($k=0; $k<$jmldata; $k++) {
				$urutan			=	$_POST[urutan_.$k];
				$replid			=	$_POST[replid_.$k];
				$nip			=	(empty($_POST[nip_.$k])) ? 0 : $_POST[nip_.$k];
				$kode			=	$_POST[kode_.$k];
				$keterangan 	= 	petikreplace($_POST[keterangan_.$k]);
				$pilih			=	$_POST[pilih_.$k];
				if($urutan == 1) {
					if($pilih == 0) {						
						$sqlstr = "delete from guru where replid='$replid' and idpelajaran='$idpelajaran'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();						
					} else {
						$sqlstr = "update guru set kode='$kode', idpelajaran='$idpelajaran', keterangan='$keterangan', uid='$uid' where replid='$replid' and idpelajaran='$idpelajaran'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
				}			
				
				if($urutan == 0) {
					if($pilih == 1) {
						$sqlstr = "insert into guru (kode, nip, idpelajaran, aktif, keterangan, uid) values ('$kode', '$nip', '$idpelajaran', '$aktif', '$keterangan', '$uid')";
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
	
	
	//-----update jam
	function update_jam($id){
		$dbpdo = DB::create();
		
		try {
			
			$hari				=	(empty($_POST["hari"])) ? 0 : $_POST["hari"];
			$jamke				=	(empty($_POST["jamke"])) ? 0 : $_POST["jamke"];
			$departemen			=	$_POST["departemen"];
			$jam1				=	date("H:i", strtotime($_POST["jam1"]));
			$jam2				=	date("H:i", strtotime($_POST["jam2"]));
			$istirahat			=	(empty($_POST["istirahat"])) ? 0 : $_POST["istirahat"];
			$info1				=	petikreplace($_POST["info1"]);
			
			$sqlstr = "update jam set hari='$hari', jamke='$jamke', departemen='$departemen', jam1='$jam1', jam2='$jam2', istirahat='$istirahat', info1='$info1' where replid='$id'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update asset_type
	function update_asset_type($ref){
		$dbpdo = DB::create();
		
		try {
			$type			=	$_POST["type"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="update asset_type set type='$type', active='$active', uid='$uid', dlu='$dlu' where id='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}

		return $sql;
	}
    
    
    //-----update asset
	function update_asset($ref){
		$dbpdo = DB::create();
		
		try {
			$ref_id			    =	petikreplace($_POST["ref_id"]);
			$asset_name		    =	petikreplace($_POST["asset_name"]);
			$alias		        =	petikreplace($_POST["alias"]);
			$lokasi			    =	petikreplace($_POST["lokasi"]);
			$provinsi		    =	$_POST["provinsi"];
			$kota		    	=	$_POST["kota"];
			$kecamatan		    =	$_POST["kecamatan"];
			$desa		    	=	$_POST["desa"];
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
	        $active			    =	(empty($_POST["active"])) ? 0 : $_POST["active"];
	        $shm			    =	$_POST["shm"];
	        $shm_nama		    =	$_POST["shm_nama"];
	        $ajb			    =	$_POST["ajb"];
	        $pbb			    =	$_POST["pbb"];
	        $keterangan			=	petikreplace($_POST["keterangan"]);
	        $perolehan			=	petikreplace($_POST["perolehan"]);
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
		  	$photo2			= $_POST["photo2"];
			$uploaddir_photo= $photo_asset .'/';
			$photo			= $_FILES['photo']['name']; 
			$tmpname_photo 	= $_FILES['photo']['tmp_name'];
			$filesize_photo = $_FILES['photo']['size'];
			$filetype_photo = $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} else {
				$photo = $photo;
			}
			
			if($photo != "") {
					
				if($photo != $photo2) {
					
					if(!empty($photo2)) {
						if (file_exists($photo_asset . '/' . $photo2)) {
							unlink($uploaddir_photo . $photo2); //remove file 
						}					
					}
					
					$photo = $ref . '_' . $photo;
				}
				$uploaddir_photo = $uploaddir_photo . $photo;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}	*/
			
			

			//----------------
			$sqlstr="update asset set asset_name='$asset_name', alias='$alias', ref_id='$ref_id', lokasi='$lokasi', asset_type_id='$asset_type_id', status='$status', luas='$luas', sertifikat='$sertifikat', imb='$imb', perolehan='$perolehan', tanggal_perolehan='$tanggal_perolehan', pemilik_sebelum='$pemilik_sebelum', contact_name='$contact_name', no_pbb='$no_pbb', group_block='$group_block', alamat='$alamat', lintang='$lintang', bujur='$bujur', nilai_perolehan='$nilai_perolehan', nilai_amnesti='$nilai_amnesti', photo='$photo', photo_1='$photo_1', photo_2='$photo_2', photo_3='$photo_3', photo_4='$photo_4', shm='$shm', shm_nama='$shm_nama', ajb='$ajb', pbb='$pbb', keterangan='$keterangan', active='$active', uid='$uid', dlu='$dlu' where ref='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}

		return $sql;
	}
    
    
    //-----update asset trans
	function update_asset_trans($ref){
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
	        
			//----------------
			$sqlstr="update asset_trans set tanggal='$tanggal', asset_id='$asset_id', penyewa='$penyewa', lama_sewa='$lama_sewa', akhir_sewa='$akhir_sewa', harga_sewa='$harga_sewa', alamat='$alamat', hp='$hp', uid='$uid', dlu='$dlu' where ref='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}

		return $sql;
	}
	
	//-----update soal
	function update_soal($ref){
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
	  		
	  		##pilihan-1
	  		$pilihan1					=	petikreplace($_POST["pilihan1"]);
	  		$pilihan_photo1_file		= 	$_POST["pilihan_photo1"];
			$pilihan_photo1				=	$_FILES['pilihan_photo1']['name'];
			$pilihan_photo12			=	$_POST["pilihan_photo12"];
			if($pilihan_photo1 != "") {
				if(!empty($pilihan_photo12)) {
					$filename = 'app/soal_photo/' . $pilihan_photo12;
					
					if (file_exists($filename)) { unlink('app/soal_photo/' . $pilihan_photo12); } //remove file
				}
					
				$pilihan_photo11 = resize_image('pilihan_photo1', '', 'app/soal_photo/', '', $code, $pilihan_photo1_file);
	  			$pilihan_photo1_a = $pilihan_photo11;
			} else {
				$pilihan_photo1_a	=	$pilihan_photo12;
			}
			
			##pilihan-2			
			$pilihan2					=	petikreplace($_POST["pilihan2"]);
	  		$pilihan_photo2_file		= 	$_POST["pilihan_photo2"];
			$pilihan_photo2				=	$_FILES['pilihan_photo2']['name'];
			$pilihan_photo22			=	$_POST["pilihan_photo22"];
			if($pilihan_photo2 != "") {
				if(!empty($pilihan_photo22)) {
					$filename = 'app/soal_photo/' . $pilihan_photo22;
					
					if (file_exists($filename)) { unlink('app/soal_photo/' . $pilihan_photo22); } //remove file
				}
					
				$pilihan_photo21 = resize_image('pilihan_photo2', '', 'app/soal_photo/', '', $code, $pilihan_photo2_file);
	  			$pilihan_photo2_a = $pilihan_photo21;
			} else {
				$pilihan_photo2_a	=	$pilihan_photo22;
			}
			
			
			##pilihan-3
			$pilihan3					=	petikreplace($_POST["pilihan3"]);
	  		$pilihan_photo3_file		= 	$_POST["pilihan_photo3"];
			$pilihan_photo3				=	$_FILES['pilihan_photo3']['name'];
			$pilihan_photo32			=	$_POST["pilihan_photo32"];
			if($pilihan_photo3 != "") {
				if(!empty($pilihan_photo32)) {
					$filename = 'app/soal_photo/' . $pilihan_photo32;
					
					if (file_exists($filename)) { unlink('app/soal_photo/' . $pilihan_photo32); } //remove file
				}
					
				$pilihan_photo31 = resize_image('pilihan_photo3', '', 'app/soal_photo/', '', $code, $pilihan_photo3_file);
	  			$pilihan_photo3_a = $pilihan_photo31;
			} else {
				$pilihan_photo3_a	=	$pilihan_photo32;
			}
						
			##pilihan-4	  		
	  		$pilihan4					=	petikreplace($_POST["pilihan4"]);
	  		$pilihan_photo4_file		= 	$_POST["pilihan_photo4"];
			$pilihan_photo4				=	$_FILES['pilihan_photo4']['name'];
			$pilihan_photo42			=	$_POST["pilihan_photo42"];
			if($pilihan_photo4 != "") {
				if(!empty($pilihan_photo42)) {
					$filename = 'app/soal_photo/' . $pilihan_photo42;
					
					if (file_exists($filename)) { unlink('app/soal_photo/' . $pilihan_photo42); } //remove file
				}
					
				$pilihan_photo41 = resize_image('pilihan_photo4', '', 'app/soal_photo/', '', $code, $pilihan_photo4_file);
	  			$pilihan_photo4_a = $pilihan_photo41;
			} else {
				$pilihan_photo4_a	=	$pilihan_photo42;
			}
						
			##pilihan-5
	  		$pilihan5					=	petikreplace($_POST["pilihan5"]);
	  		$pilihan_photo5_file		= 	$_POST["pilihan_photo5"];
			$pilihan_photo5				=	$_FILES['pilihan_photo5']['name'];
			$pilihan_photo52			=	$_POST["pilihan_photo52"];
			if($pilihan_photo5 != "") {
				if(!empty($pilihan_photo52)) {
					$filename = 'app/soal_photo/' . $pilihan_photo52;
					
					if (file_exists($filename)) { unlink('app/soal_photo/' . $pilihan_photo52); } //remove file
				}
					
				$pilihan_photo51 = resize_image('pilihan_photo5', '', 'app/soal_photo/', '', $code, $pilihan_photo5_file);
	  			$pilihan_photo5_a = $pilihan_photo51;
			} else {
				$pilihan_photo5_a	=	$pilihan_photo52;
			}
	  		
	  		$jawaban			=	(empty($_POST["jawaban"])) ? 0 : $_POST["jawaban"];
	  		$poin				=	(empty($_POST["poin"])) ? 0 : $_POST["poin"];
	  		$waktu				=	(empty($_POST["waktu"])) ? 0 : $_POST["waktu"];
	  		$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
	  		$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
						
			$sqlstr = "update soal set idtahunajaran='$idtahunajaran', idtingkat='$idtingkat', idpegawai='$idpegawai', idsemester='$idsemester', idjurusan='$idjurusan', pertanyaan='$pertanyaan', pilihan1='$pilihan1', pilihan_photo1='$pilihan_photo1_a', pilihan2='$pilihan2', pilihan_photo2='$pilihan_photo2_a', pilihan3='$pilihan3', pilihan_photo3='$pilihan_photo3_a', pilihan4='$pilihan4', pilihan_photo4='$pilihan_photo4_a', pilihan5='$pilihan5', pilihan_photo5='$pilihan_photo5_a', jawaban='$jawaban', poin='$poin', waktu='$waktu', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}

		return $sql;
	}
	
	
	//-----update pemetaan kd
	function update_pemetaan_kd($ref){
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
	        
			//----------------
			$sqlstr="update pemetaan_kd set permen_kd_id='$permen_kd_id', idtingkat='$idtingkat', idpelajaran='$idpelajaran', kd='$kd', kode='$kode', uraian='$uraian', kkm_sekolah='$kkm_sekolah', kkm_pelajaran='$kkm_pelajaran', jumlah_ukbm='$jumlah_ukbm', urutan='$urutan', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}

		return $sql;
	}
	
	
	//-----update pemetaan kd siswa
	function update_pemetaan_kd_siswa($ref){
		$dbpdo = DB::create();
		
		try {
			$pemetaan_kd_id	=	(empty($_POST["pemetaan_kd_id"])) ? 0 : $_POST["pemetaan_kd_id"];
			$idsiswa		=	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
			$idguru			= 	(empty($_POST["idguru"])) ? 0 : $_POST["idguru"];
			$idpelajaran	= 	(empty($_POST["idpelajaran"])) ? 0 : $_POST["idpelajaran"];
			$nilai			=	numberreplace($_POST["nilai"]);
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
	        
			//----------------
			$sqlstr="update pemetaan_kd_siswa set pemetaan_kd_id='$pemetaan_kd_id', idsiswa='$idsiswa', idguru='$idguru', idpelajaran='$idpelajaran', nilai='$nilai', uid='$uid', dlu='$dlu' where replid='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}

		return $sql;
	}
	
	
	//------update ukbm
	function update_ukbm($ref){
		
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
			$uploaddir 		= 'app/file_ukbm/';
			$file_ukbm2		= $_POST["file_ukbm2"];
			$file_ukbm 		= $_FILES['file_ukbm']['name']; 
			$tmpname  		= $_FILES['file_ukbm']['tmp_name'];
			$filesize 		= $_FILES['file_ukbm']['size'];
			$filetype 		= $_FILES['file_ukbm']['type'];
			
			if (empty($file_ukbm)) { 
				$file_ukbm = $file_ukbm2; 
			} 
			
			if($file_ukbm != "") {	
				
				if($file_ukbm != $file_ukbm2) {
				
					if(!empty($file_ukbm2)) {
						unlink($uploaddir . $file_ukbm2); //remove file 
					}
					
					$file_ukbm = $kode . '_' . $file_ukbm;
				}
							
				$uploadfile = $uploaddir . $file_ukbm;		
				if (move_uploaded_file($_FILES['file_ukbm']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "update ukbm set idtingkat='$idtingkat', idsemester='$idsemester', idpelajaran='$idpelajaran', idguru='$idguru', kode='$kode', ukbm='$ukbm', deskripsi='$deskripsi', file_ukbm='$file_ukbm', idrpp='$idrpp', minimum_hadir='$minimum_hadir', jumlah_ukbm='$jumlah_ukbm', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//-----update soal ukbm
	function update_soal_ukbm($ref){
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
	  		include_once ($__folder."app/include/function_crop.php");
	  		
	  		##pilihan-1
	  		$pilihan1					=	petikreplace($_POST["pilihan1"]);
	  		$pilihan_photo1_file		= 	$_POST["pilihan_photo1"];
			$pilihan_photo1				=	$_FILES['pilihan_photo1']['name'];
			$pilihan_photo12			=	$_POST["pilihan_photo12"];
			if($pilihan_photo1 != "") {
				if(!empty($pilihan_photo12)) {
					$filename = $__folder.'app/soal_ukbm_photo/' . $pilihan_photo12;
					
					if (file_exists($filename)) { unlink($__folder.'app/soal_ukbm_photo/' . $pilihan_photo12); } //remove file
				}
					
				$pilihan_photo11 = resize_image($__folder.'pilihan_photo1', '', $__folder.'app/soal_ukbm_photo/', '', $code, $pilihan_photo1_file);
	  			$pilihan_photo1_a = $pilihan_photo11;
			} else {
				$pilihan_photo1_a	=	$pilihan_photo12;
			}
			
			##pilihan-2			
			$pilihan2					=	petikreplace($_POST["pilihan2"]);
	  		$pilihan_photo2_file		= 	$_POST["pilihan_photo2"];
			$pilihan_photo2				=	$_FILES['pilihan_photo2']['name'];
			$pilihan_photo22			=	$_POST["pilihan_photo22"];
			if($pilihan_photo2 != "") {
				if(!empty($pilihan_photo22)) {
					$filename = 'app/soal_ukbm_photo/' . $pilihan_photo22;
					
					if (file_exists($filename)) { unlink('app/soal_ukbm_photo/' . $pilihan_photo22); } //remove file
				}
					
				$pilihan_photo21 = resize_image('pilihan_photo2', '', 'app/soal_ukbm_photo/', '', $code, $pilihan_photo2_file);
	  			$pilihan_photo2_a = $pilihan_photo21;
			} else {
				$pilihan_photo2_a	=	$pilihan_photo22;
			}
			
			
			##pilihan-3
			$pilihan3					=	petikreplace($_POST["pilihan3"]);
	  		$pilihan_photo3_file		= 	$_POST["pilihan_photo3"];
			$pilihan_photo3				=	$_FILES['pilihan_photo3']['name'];
			$pilihan_photo32			=	$_POST["pilihan_photo32"];
			if($pilihan_photo3 != "") {
				if(!empty($pilihan_photo32)) {
					$filename = 'app/soal_ukbm_photo/' . $pilihan_photo32;
					
					if (file_exists($filename)) { unlink('app/soal_ukbm_photo/' . $pilihan_photo32); } //remove file
				}
					
				$pilihan_photo31 = resize_image('pilihan_photo3', '', 'app/soal_ukbm_photo/', '', $code, $pilihan_photo3_file);
	  			$pilihan_photo3_a = $pilihan_photo31;
			} else {
				$pilihan_photo3_a	=	$pilihan_photo32;
			}
						
			##pilihan-4	  		
	  		$pilihan4					=	petikreplace($_POST["pilihan4"]);
	  		$pilihan_photo4_file		= 	$_POST["pilihan_photo4"];
			$pilihan_photo4				=	$_FILES['pilihan_photo4']['name'];
			$pilihan_photo42			=	$_POST["pilihan_photo42"];
			if($pilihan_photo4 != "") {
				if(!empty($pilihan_photo42)) {
					$filename = 'app/soal_ukbm_photo/' . $pilihan_photo42;
					
					if (file_exists($filename)) { unlink('app/soal_ukbm_photo/' . $pilihan_photo42); } //remove file
				}
					
				$pilihan_photo41 = resize_image('pilihan_photo4', '', 'app/soal_ukbm_photo/', '', $code, $pilihan_photo4_file);
	  			$pilihan_photo4_a = $pilihan_photo41;
			} else {
				$pilihan_photo4_a	=	$pilihan_photo42;
			}
						
			##pilihan-5
	  		$pilihan5					=	petikreplace($_POST["pilihan5"]);
	  		$pilihan_photo5_file		= 	$_POST["pilihan_photo5"];
			$pilihan_photo5				=	$_FILES['pilihan_photo5']['name'];
			$pilihan_photo52			=	$_POST["pilihan_photo52"];
			if($pilihan_photo5 != "") {
				if(!empty($pilihan_photo52)) {
					$filename = 'app/soal_ukbm_photo/' . $pilihan_photo52;
					
					if (file_exists($filename)) { unlink('app/soal_ukbm_photo/' . $pilihan_photo52); } //remove file
				}
					
				$pilihan_photo51 = resize_image('pilihan_photo5', '', 'app/soal_ukbm_photo/', '', $code, $pilihan_photo5_file);
	  			$pilihan_photo5_a = $pilihan_photo51;
			} else {
				$pilihan_photo5_a	=	$pilihan_photo52;
			}
	  		
	  		
	  		//-----------upload file fotocopy golongan darah
			$uploaddir 		= 'app/soal_ukbm_photo/';
			$soal_file2		= $_POST["soal_file2"];
			$soal_file 		= $_FILES['soal_file']['name']; 
			$tmpname  		= $_FILES['soal_file']['tmp_name'];
			$filesize 		= $_FILES['soal_file']['size'];
			$filetype 		= $_FILES['soal_file']['type'];
			
			if (empty($soal_file)) { 
				$soal_file = $soal_file2; 
			} 
			
			if($soal_file != "") {	
				
				if($soal_file != $soal_file2) {
				
					if(!empty($soal_file2)) {
						unlink($uploaddir . $soal_file2); //remove file 
					}
					
					$soal_file = $code . '_' . $soal_file;
				}
							
				$uploadfile = $uploaddir . $soal_file;		
				if (move_uploaded_file($_FILES['soal_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
	  		$jawaban			=	(empty($_POST["jawaban"])) ? 0 : $_POST["jawaban"];
	  		$poin				=	(empty($_POST["poin"])) ? 0 : $_POST["poin"];
	  		$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
	  		$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
						
			$sqlstr = "update soal_ukbm set idtahunajaran='$idtahunajaran', idtingkat='$idtingkat', idpegawai='$idpegawai', idsemester='$idsemester', idjurusan='$idjurusan', idukbm='$idukbm', pertanyaan='$pertanyaan', pilihan1='$pilihan1', pilihan_photo1='$pilihan_photo1_a', pilihan2='$pilihan2', pilihan_photo2='$pilihan_photo2_a', pilihan3='$pilihan3', pilihan_photo3='$pilihan_photo3_a', pilihan4='$pilihan4', pilihan_photo4='$pilihan_photo4_a', pilihan5='$pilihan5', pilihan_photo5='$pilihan_photo5_a', jawaban='$jawaban', soal_file='$soal_file', poin='$poin', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}

		return $sql;
	}
	
	
	//-----update ukbm_siswa
	function update_ukbm_siswa($ref){
		$dbpdo = DB::create();
		
		try {
			$tanggal		=   date("Y-m-d", strtotime($_POST["tanggal"]));
			$idsiswa		=	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
			$idsemester		=	(empty($_POST["idsemester"])) ? 0 : $_POST["idsemester"];
			$idukbm			=	(empty($_POST["idukbm"])) ? 0 : $_POST["idukbm"];
			$ujian			=	(empty($_POST["ujian"])) ? 0 : $_POST["ujian"];
			$setuju			=	0;
			
			$sqlstr = "update ukbm_siswa set tanggal='$tanggal', idukbm='$idukbm', ujian='$ujian' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}

		return $sql;
	}
	
	
	//-----update ukbm_siswa approved
	function update_ukbm_siswa_approved($ref){
		$dbpdo = DB::create();
		
		try {
			
			$setuju		=	1;
			
			$sqlstr = "update ukbm_siswa set setuju='$setuju' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}

		return $sql;
	}
	
	
	//-----update ukbm_siswa approved
	function update_ukbm_siswa_unapproved($ref){
		$dbpdo = DB::create();
		
		try {
			
			$setuju		=	0;
			
			$sqlstr = "update ukbm_siswa set setuju='$setuju' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}

		return $sql;
	}
	
	
	//-----update setup periode
	function update_setup_periode($ref){
		$dbpdo = DB::create();
		
		try {
			
			$tanggal		=   date("Y-m-d", strtotime($_POST["tanggal"]));
			$tanggal1		=   date("Y-m-d", strtotime($_POST["tanggal1"]));
			$jenis			=	$_POST["jenis"];
			$tingkat_id		=	$_POST["tingkat_id"];
			$aktif			=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "update setup_periode set tanggal='$tanggal', tanggal1='$tanggal1', jenis='$jenis', tingkat_id='$tingkat_id', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}

		return $sql;
	}
	
	
	//-----update setup periode
	function update_predikat_raport($ref){
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
			
			$sqlstr = "update predikat_raport set idangkatan='$idangkatan', idpelajaran='$idpelajaran', kkm='$kkm', kkm_terampil='$kkm_terampil', nilai_angka_a='$nilai_angka_a', nilai_angka_a1='$nilai_angka_a1', nilai_angka_b='$nilai_angka_b', nilai_angka_b1='$nilai_angka_b1', nilai_angka_c='$nilai_angka_c', nilai_angka_c1='$nilai_angka_c1', nilai_angka_d='$nilai_angka_d', nilai_angka_d1='$nilai_angka_d1', nilai_huruf_a='$nilai_huruf_a', nilai_huruf_b='$nilai_huruf_b', nilai_huruf_c='$nilai_huruf_c', nilai_huruf_d='$nilai_huruf_d', deskripsi_p_a='$deskripsi_p_a', deskripsi_k_a='$deskripsi_k_a', deskripsi_p_b='$deskripsi_p_b', deskripsi_k_b='$deskripsi_k_b', deskripsi_p_c='$deskripsi_p_c', deskripsi_k_c='$deskripsi_k_c', deskripsi_p_d='$deskripsi_p_d', deskripsi_k_d='$deskripsi_k_d', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}

		return $sql;
	}
	
	
	//-----update setup periode
	function update_deskripsi_raport($ref){
		$dbpdo = DB::create();
		
		try {
			
			$idangkatan			=	(empty($_POST["idangkatan"])) ? 0 : $_POST["idangkatan"];
			$sikap				=	$_POST["sikap"];
			$sikap_a			=	petikreplace($_POST["sikap_a"]);
			$sikap_b			=	petikreplace($_POST["sikap_b"]);
			$sikap_c			=	petikreplace($_POST["sikap_c"]);
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update deskripsi_raport set idangkatan='$idangkatan', sikap='$sikap', sikap_a='$sikap_a', sikap_b='$sikap_b', sikap_c='$sikap_c', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}

		return $sql;
	}
	
	
	//-----update kelompok surat
	function update_kelompok_surat($ref){
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	$_POST["kode"];
			$nama				=	petikreplace($_POST["nama"]);
			$uraian				=	petikreplace($_POST["uraian"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update kelompok_surat set kode='$kode', nama='$nama', uraian='$uraian', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}

		return $sql;
	}
	
	
	//-----update surat keluar
	function update_surat_keluar($ref){
		$dbpdo = DB::create();
		
		try {
			
			$no_surat			=	petikreplace($_POST["no_surat"]);
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));			
			$idkelompok_surat	=	(empty($_POST["idkelompok_surat"])) ? 0 : $_POST["idkelompok_surat"];
			$petugas			=	petikreplace($_POST["petugas"]);
			$tujuan				=	petikreplace($_POST["tujuan"]);
	  		
	  		
	  		//-----------upload file fotocopy golongan darah
			$uploaddir 		= 'app/surat_keluar/';
			$file_dokumen2		= $_POST["file_dokumen2"];
			$file_dokumen 		= $_FILES['file_dokumen']['name']; 
			$tmpname  		= $_FILES['file_dokumen']['tmp_name'];
			$filesize 		= $_FILES['file_dokumen']['size'];
			$filetype 		= $_FILES['file_dokumen']['type'];
			
			if (empty($file_dokumen)) { 
				$file_dokumen = $file_dokumen2; 
			} 
			
			if($file_dokumen != "") {	
				
				if($file_dokumen != $file_dokumen2) {
				
					if(!empty($file_dokumen2)) {
						unlink($uploaddir . $file_dokumen2); //remove file 
					}
					
					$file_dokumen = $ref . '_' . $file_dokumen;
				}
							
				$uploadfile = $uploaddir . $file_dokumen;		
				if (move_uploaded_file($_FILES['file_dokumen']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
	  		$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
						
			$sqlstr = "update surat_keluar set no_surat='$no_surat', tanggal='$tanggal', idkelompok_surat='$idkelompok_surat', petugas='$petugas', tujuan='$tujuan', file_dokumen='$file_dokumen', uid='$uid', dlu='$dlu' where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}

		return $sql;
	}
	
	
	//-----update surat masuk
	function update_surat_masuk($ref){
		$dbpdo = DB::create();
		
		try {
			
			$no_surat			=	petikreplace($_POST["no_surat"]);
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));			
			$idkelompok_surat	=	(empty($_POST["idkelompok_surat"])) ? 0 : $_POST["idkelompok_surat"];
			$petugas			=	petikreplace($_POST["petugas"]);
			$dari				=	petikreplace($_POST["dari"]);
	  		
	  		
	  		//-----------upload file fotocopy golongan darah
			$uploaddir 		= 'app/surat_masuk/';
			$file_dokumen2		= $_POST["file_dokumen2"];
			$file_dokumen 		= $_FILES['file_dokumen']['name']; 
			$tmpname  		= $_FILES['file_dokumen']['tmp_name'];
			$filesize 		= $_FILES['file_dokumen']['size'];
			$filetype 		= $_FILES['file_dokumen']['type'];
			
			if (empty($file_dokumen)) { 
				$file_dokumen = $file_dokumen2; 
			} 
			
			if($file_dokumen != "") {	
				
				if($file_dokumen != $file_dokumen2) {
				
					if(!empty($file_dokumen2)) {
						unlink($uploaddir . $file_dokumen2); //remove file 
					}
					
					$file_dokumen = $ref . '_' . $file_dokumen;
				}
							
				$uploadfile = $uploaddir . $file_dokumen;		
				if (move_uploaded_file($_FILES['file_dokumen']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
	  		$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
						
			$sqlstr = "update surat_masuk set no_surat='$no_surat', tanggal='$tanggal', idkelompok_surat='$idkelompok_surat', petugas='$petugas', dari='$dari', file_dokumen='$file_dokumen', uid='$uid', dlu='$dlu' where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}

		return $sql;
	}
	
	
	//-----update buku kunjungan
	function update_buku_kunjungan($ref){
		$dbpdo = DB::create();
		
		try {
			
			$nama				=	petikreplace($_POST["nama"]);
			$nohp				=   petikreplace($_POST["nohp"]);
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));			
			$ttd				=	(empty($_POST["ttd"])) ? 0 : $_POST["ttd"];
			$instansi			=	petikreplace($_POST["instansi"]);
			$keperluan			=	petikreplace($_POST["keperluan"]);
			$kesan_pesan		=	petikreplace($_POST["kesan_pesan"]);
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
	  		$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
						
			$sqlstr = "update buku_kunjungan set tanggal='$tanggal', nama='$nama', nohp='$nohp', instansi='$instansi', ttd='$ttd', keperluan='$keperluan', kesan_pesan='$kesan_pesan', keterangan='$keterangan', uid='$uid', dlu='$dlu' where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}

		return $sql;
	}
	
	
	//-----update setup siswa khusus
	function update_setup_siswa_khusus($ref){
		$dbpdo = DB::create();
		
		try {
			
			$tanggal		=   date("Y-m-d", strtotime($_POST["tanggal"]));
			$tanggal1		=   date("Y-m-d", strtotime($_POST["tanggal1"]));
			$jenis			=	$_POST["jenis"];
			$idsiswa		=	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "update setup_siswa_khusus set tanggal='$tanggal', tanggal1='$tanggal1', jenis='$jenis', idsiswa='$idsiswa', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}

		return $sql;
	}
	
	
	//-----update material
	function update_material($ref){
		$dbpdo = DB::create();
		
		try {
			
			$code			=	$_POST["code"];
			$old_code		=	$_POST["old_code"];
			$name			=	petikreplace($_POST["name"]);
			$item_group_id	=	(empty($_POST["item_group_id"])) ? 0 : $_POST["item_group_id"];
			$item_subgroup_id	=	(empty($_POST["item_subgroup_id"])) ? 0 : $_POST["item_subgroup_id"];
			$item_type_code		=	$_POST["item_type_code"];
			$item_category_id	=	(empty($_POST["item_category_id"])) ? 0 : $_POST["item_category_id"];
			$brand_id			=	(empty($_POST["brand_id"])) ? 0 : $_POST["brand_id"];
			$size_id			= $_POST["size_id"];  //	(empty($_POST["size_id"])) ? 0 : $_POST["size_id"];
			
			$uom_code_sales		=	$_POST["uom_code_sales"];
			$uom_code_stock		=	$uom_code_sales; //$_POST["uom_code_stock"];			
			$uom_code_purchase	=	$uom_code_sales; //$_POST["uom_code_purchase"];
			
			$minimum_stock		=	numberreplace((empty($_POST["minimum_stock"])) ? 0 : $_POST["minimum_stock"]);
			$maximum_stock		=	numberreplace((empty($_POST["maximum_stock"])) ? 0 : $_POST["maximum_stock"]);
			$client_code		=	$_POST["client_code"];
			
			//------------start upload photo
			/*include_once ("app/include/function_crop.php");
			
			$photo_file		= 	$_POST["photo"];
			$photo			=	$_FILES['photo']['name'];
			$photo2			=	$_POST["photo2"];
			if($photo != "") {
				if(!empty($photo2)) {
					$filename = 'app/photo_item/' . $photo2;
					
					if (file_exists($filename)) { unlink('app/photo_item/' . $photo2); } //remove file
				}
					
				$photo1 = resize_image('photo', '', 'app/photo_item/', '', $code, $photo_file);
	  			$photo_a = $photo1;
			} else {
				$photo_a	=	$photo2;
			}*/
			
			
			/*//-----------upload file
		  	$photo2			= $_POST["photo2"];
			$uploaddir_photo= 'app/photo_item/';
			$photo			= $_FILES['photo']['name']; 
			$tmpname_photo 	= $_FILES['photo']['tmp_name'];
			$filesize_photo = $_FILES['photo']['size'];
			$filetype_photo = $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} else {
				$photo = $photo;
			}
			
			if($photo != "") {
					
				if($photo != $photo2) {
					
					if(!empty($photo2)) {
						unlink($uploaddir_photo . $photo2); //remove file 					
					}
					
					$photo = $ref . '_' . $photo;
				}
				$uploaddir_photo = $uploaddir_photo . $photo;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}	
			//----------------*/
			$consigned		=	(empty($_POST["consigned"])) ? 0 : $_POST["consigned"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");	
			
			
			$sqlstr="update item set code='$code', old_code='$old_code', name='$name', item_group_id='$item_group_id', item_subgroup_id='$item_subgroup_id', item_type_code='$item_type_code', item_category_id='$item_category_id', brand_id='$brand_id', size_id='$size_id', uom_code_stock='$uom_code_stock', uom_code_sales='$uom_code_sales', uom_code_purchase='$uom_code_purchase', minimum_stock='$minimum_stock', maximum_stock='$maximum_stock', photo='$photo_a', consigned='$consigned', active='$active', uid='$uid', dlu='$dlu' where syscode='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update item group
	function update_item_group($ref){
		$dbpdo = DB::create();
		
		try {
			
			$code					=	$_POST["code"];
			$name					=	$_POST["name"];
			$costing_type			=	$_POST["costing_type"];
			$nonstock				=	(empty($_POST["nonstock"])) ? 0 : $_POST["nonstock"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");	
			
			
			//----------update  detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($i=0; $i<=$jmldata; $i++) {
				$delete 		= (empty($_POST[delete_.$i])) ? 0 : $_POST[delete_.$i];
				
				$old_id		 	= (empty($_POST[old_id_.$i])) ? 0 : $_POST[old_id_.$i];
				$old_line	 	= (empty($_POST[old_line_.$i])) ? 0 : $_POST[old_line_.$i];
				
				$inventory_acccode		=	$_POST[inventory_acccode_.$i];
				$purchase_discount_acccode	=	$_POST[purchase_discount_acccode_.$i];
				$goodintransit_acccode	=	$_POST[goodintransit_acccode_.$i];
				$workinprocess_acccode	=	$_POST[workinprocess_acccode_.$i];
				$cogs_acccode			=	$_POST[cogs_acccode_.$i];
				$consignment_acccode	=	$_POST[consignment_acccode_.$i];
				$location_id	=	(empty($_POST[location_id_.$i])) ? 0 : $_POST[location_id_.$i];
				
				if ( $location_id > 0 ) {
					
					$sqlstr = "select id from item_group_detail where id_header='$ref' and id='$old_id' and line='$old_line' ";			
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							$sqlstr="update item_group_detail set inventory_acccode='$inventory_acccode', purchase_discount_acccode='$purchase_discount_acccode', goodintransit_acccode='$goodintransit_acccode', workinprocess_acccode='$workinprocess_acccode', cogs_acccode='$cogs_acccode', consignment_acccode='$consignment_acccode', location_id='$location_id' where id_header='$ref' and id='$old_id' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
						} else {
							$sqlstr="delete from item_group_detail where id_header='$ref' and id='$old_id' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
						}
						
						
					} else {
						
						$line = maxline('item_group_detail', 'line', 'id_header', $ref, '');
					
						$sqlstr="insert into item_group_detail (id_header, inventory_acccode, purchase_discount_acccode, goodintransit_acccode, workinprocess_acccode, cogs_acccode, consignment_acccode, location_id, line) values ('$ref', '$inventory_acccode', '$purchase_discount_acccode', '$goodintransit_acccode', '$workinprocess_acccode', '$cogs_acccode', '$consignment_acccode', '$location_id', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
											
					}
					
				}
			}
			
			
			$sqlstr="update item_group set code='$code', name='$name', nonstock='$nonstock', costing_type='$costing_type', inventory_acccode='$inventory_acccode', purchase_discount_acccode='$purchase_discount_acccode', goodintransit_acccode='$goodintransit_acccode', workinprocess_acccode='$workinprocess_acccode', cogs_acccode='$cogs_acccode', consignment_acccode='$consignment_acccode', location_id='$location_id', active='$active', uid='$uid', dlu='$dlu' where id='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update brand
	function update_brand($ref){
		$dbpdo = DB::create();
		
		try {
			
			$code			=	$_POST["code"];
			$name			=	$_POST["name"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");	
			
			$sqlstr="update brand set code='$code', name='$name', uid='$uid', dlu='$dlu', active='$active' where id='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----update asset (gedung)
	function update_build($ref){
		$dbpdo = DB::create();
		
		try {
			$ref_id			    =	petikreplace($_POST["ref_id"]);
			$asset_name		    =	petikreplace($_POST["asset_name"]);
			$alias		        =	petikreplace($_POST["alias"]);
			$lokasi			    =	petikreplace($_POST["lokasi"]);
			$provinsi		    =	$_POST["provinsi"];
			$kota		    	=	$_POST["kota"];
			$kecamatan		    =	$_POST["kecamatan"];
			$desa		    	=	$_POST["desa"];
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
	        $active			    =	(empty($_POST["active"])) ? 0 : $_POST["active"];
	        $shm			    =	$_POST["shm"];
	        $shm_nama		    =	$_POST["shm_nama"];
	        $ajb			    =	$_POST["ajb"];
	        $pbb			    =	$_POST["pbb"];
	        $keterangan			=	petikreplace($_POST["keterangan"]);
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
		  	$photo2			= $_POST["photo2"];
			$uploaddir_photo= $photo_asset .'/';
			$photo			= $_FILES['photo']['name']; 
			$tmpname_photo 	= $_FILES['photo']['tmp_name'];
			$filesize_photo = $_FILES['photo']['size'];
			$filetype_photo = $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} else {
				$photo = $photo;
			}
			
			if($photo != "") {
					
				if($photo != $photo2) {
					
					if(!empty($photo2)) {
						if (file_exists($photo_asset . '/' . $photo2)) {
							unlink($uploaddir_photo . $photo2); //remove file 
						}					
					}
					
					$photo = $ref . '_' . $photo;
				}
				$uploaddir_photo = $uploaddir_photo . $photo;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}	
			
			
			//----------------
			$sqlstr="update asset set asset_name='$asset_name', alias='$alias', ref_id='$ref_id', lokasi='$lokasi', provinsi='$provinsi', kota='$kota', kecamatan='$kecamatan', desa_kode='$desa_kode', asset_type_id='$asset_type_id', status='$status', luas='$luas', sertifikat='$sertifikat', imb='$imb', tanggal_perolehan='$tanggal_perolehan', pemilik_sebelum='$pemilik_sebelum', contact_name='$contact_name', no_pbb='$no_pbb', group_block='$group_block', alamat='$alamat', lintang='$lintang', bujur='$bujur', nilai_perolehan='$nilai_perolehan', nilai_amnesti='$nilai_amnesti', pemilik_sekarang='$pemilik_sekarang', pemilik_sekarang1='$pemilik_sekarang1', pemilik_sekarang2='$pemilik_sekarang2', photo='$photo', photo_1='$photo_1', photo_2='$photo_2', photo_3='$photo_3', photo_4='$photo_4', shm='$shm', shm_nama='$shm_nama', ajb='$ajb', pbb='$pbb', keterangan='$keterangan', active='$active', uid='$uid', dlu='$dlu' where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}

		return $sql;
	}
	
	//-----update room
	function update_room($ref){
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
			$sqlstr="update asset_detail set asset_ref='$asset_ref', code='$code', name='$name', employee_id='$employee_id', active='$active', booking='$booking', booking_chamber='$booking_chamber', uid='$uid', dlu='$dlu' where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}

		return $sql;
	}
	
	//------update room booking
	function update_room_booking($ref){
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
			
			$arriving		=	date("Y-m-d", strtotime($_POST["arriving"]));
			$sex			=	$_POST["sex"];
			$checkout_date	=	date("Y-m-d", strtotime($_POST["checkout_date"]));
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			$act		=	(empty($_POST["act"])) ? 0 : $_POST["act"];
			
			$sqlstr="update room_registration set date='$date', name='$name', identity_type_id='$identity_type_id', identity_no='$identity_no', email='$email', phone='$phone', address='$address', booked='$booked', booked_finish='$booked_finish', arriving='$arriving', sex='$sex', memo='$memo', checkout_date='$checkout_date', uid='$uid', dlu='$dlu' where ref='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
			//----------insert user detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];			
			for ($i=0; $i<=$jmldata; $i++) {
				$registration_slc = (empty($_POST[registration_slc_.$i])) ? 0 : $_POST[registration_slc_.$i];
				$delete 		  = (empty($_POST[delete_.$i])) ? 0 : $_POST[delete_.$i];
				$old 	 		  = (empty($_POST[old_.$i])) ? 0 : $_POST[old_.$i];
				
				$room_ref = $_POST[room_ref_.$i];
				
				if ($old==1) {
					if ($registration_slc==0 || $delete==1) {
						$sqlstr="delete from room_registration_detail where ref='$ref' and room_ref='$room_ref' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
				} 
				
				
				if ($old==0) {
				
					if ($registration_slc == 1) { 	
						
						$room_ref = $_POST[room_ref_.$i];
					
						$line = maxline('room_registration_detail', 'line', 'ref', $ref, '');
												
						$sqlstr="insert into room_registration_detail (ref, date, to_date, room_ref, line) values ('$ref', '$booked', '$booked_finish', '$room_ref', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
							
						/*$room_ref = $_POST[room_ref_.$i];
						
						$add_day = 0;
						$z = 0;
						for($z=0; $z<=$total_days; $z++) {
					
							$add_day		=	$z;
							$date_of		=	date("Y-m-d", strtotime($booked . '+ '.$add_day. 'day'));
							
							$line = maxline('room_registration_detail', 'line', 'ref', $ref, '');
												
							$sqlstr="insert into room_registration_detail (ref, date, room_ref, line) values ('$ref', '$date_of', '$room_ref', '$line')";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						}*/
						
					}
				}
				
			}
						
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//------update guru absen
	function update_guru_absen($ref){
		
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
			
			$sqlstr = "update guru_absen set tanggal='$tanggal', idguru='$idguru', idtingkat='$idtingkat', idkelas='$idkelas', alasan='$alasan', tugas='$tugas', uid='$uid', dlu='$dlu' where replid='$ref'";
			
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update siswa terlambat
	function update_siswa_terlambat($ref){
		
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
			
			$sqlstr = "update siswa_terlambat set tanggal='$tanggal', idsiswa='$idsiswa', idtingkat='$idtingkat', idkelas='$idkelas', alasan='$alasan', penanganan='$penanganan', uid='$uid', dlu='$dlu' where replid='$ref'";
			
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update siswa izin
	function update_siswa_izin($ref){
		
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
			
			$sqlstr = "update siswa_izin set tanggal='$tanggal', idsiswa='$idsiswa', idtingkat='$idtingkat', idkelas='$idkelas', alasan='$alasan', penanganan='$penanganan', uid='$uid', dlu='$dlu' where replid='$ref'";
			
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update kejadian lain
	function update_kejadian_lain($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));
			$jenis				=	petikreplace($_POST["jenis"]);
			$penanganan			=	petikreplace($_POST["penanganan"]);
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update kejadian_lain set tanggal='$tanggal', jenis='$jenis', penanganan='$penanganan', uid='$uid', dlu='$dlu' where replid='$ref'";
			
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update guru bk
	function update_guru_bk($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idguru				=	(empty($_POST["idguru"])) ? 0 : $_POST["idguru"];
			$idtahunajaran		=	(empty($_POST["idtahunajaran"])) ? 0 : $_POST["idtahunajaran"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update guru_bk set idtahunajaran='$idtahunajaran', idguru='$idguru', aktif='$aktid', uid='$uid', dlu='$dlu' where replid='$ref'";
			
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update guru_penugasan
	function update_guru_penugasan(){
		
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
						} else {
							$sqlstr = "update guru_penugasan set aktif='$aktif' where idguru='$idpegawai' and idtahunajaran='$idtahunajaran' and idtingkat='$idtingkat' and idkelas='$idkelas'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						}						
					} else {
						$sqlstr="delete from guru_penugasan where idguru='$idpegawai' and idtahunajaran='$idtahunajaran' and idtingkat='$idtingkat' and idkelas='$idkelas'";
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
	
	
	//-----insert siswa ekskul
	function update_siswa_ekstrakurikuler_nilai(){
		$dbpdo = DB::create();
		
		try {
			
			$idtahunajaran	=	$_POST['idtahunajaran'];
			$idsemester		=	$_POST['idsemester'];
			
			$replid = $_POST["replid_id"];
			$exp = explode("|", $replid);
			
			$nilai = $_POST["nilai_id"];
			$expnilai = explode("|", $nilai);
			
			$idsiswa = $_POST["idsiswa"];
			$expidsiswa = explode("|", $idsiswa);
			
			$idpelajaran = $_POST["idpelajaran"];
			$expidpelajaran = explode("|", $idpelajaran);
			
			$jmldata = count($exp);
			if($replid != "") {
				for($k=0; $k<$jmldata; $k++) {
					$replid= $exp[$k];
					$nilai= $expnilai[$k];
					$idsiswa= $expidsiswa[$k];
					$idpelajaran= $expidpelajaran[$k];
					
					if($nilai != "") {
						$sqlstr = "select replid from siswa_ekstrakurikuler where idsiswa='$idsiswa' and idpelajaran='$idpelajaran' and idsemester='$idsemester' and idtahunajaran='$idtahunajaran' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$rows=$sql->rowCount();
						
						if($rows > 0) {
							$sqlstr = "update siswa_ekstrakurikuler set nilai='$nilai' where replid='$replid'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						} else {
							$tanggal 	= 	date("Y-m-d");
							$uid		=	$_SESSION["loginname"];
							$dlu		=	date("Y-m-d H:i:s");
				
							$line = maxline('siswa_ekstrakurikuler', 'line', 'idsiswa', $idsiswa, '');
				
							$sqlstr = "insert into siswa_ekstrakurikuler (idsiswa, idpelajaran, idtahunajaran, idsemester, nilai, tanggal, uid, dlu, line) values ('$idsiswa', '$idpelajaran', '$idtahunajaran', '$idsemester', '$nilai', '$tanggal', '$uid', '$dlu', '$line')";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						}
					}					
				}
			} else {
				$jmldata = (empty($_POST["jmldata"])) ? 0 : $_POST["jmldata"];
				
				for($k=0; $k<$jmldata; $k++) {
					$replid= $_POST[replid_.$k];
					$nilai= $_POST[nilai_.$k];
					$idsiswa= $_POST[idsiswa_.$k];
					$idpelajaran= $_POST[idpelajaran_.$k];
					
					if($nilai != "") {
						$sqlstr = "select replid from siswa_ekstrakurikuler where idsiswa='$idsiswa' and idpelajaran='$idpelajaran' and idsemester='$idsemester' and idtahunajaran='$idtahunajaran' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$rows=$sql->rowCount();
						
						if($rows > 0) {
							$sqlstr = "update siswa_ekstrakurikuler set nilai='$nilai' where replid='$replid'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						} else {
							$tanggal 	= 	date("Y-m-d");
							$uid		=	$_SESSION["loginname"];
							$dlu		=	date("Y-m-d H:i:s");
				
							$line = maxline('siswa_ekstrakurikuler', 'line', 'idsiswa', $idsiswa, '');
				
							$sqlstr = "insert into siswa_ekstrakurikuler (idsiswa, idpelajaran, idtahunajaran, idsemester, nilai, tanggal, uid, dlu, line) values ('$idsiswa', '$idpelajaran', '$idtahunajaran', '$idsemester', '$nilai', '$tanggal', '$uid', '$dlu', '$line')";
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
	
	
	//------update siswa baru
	function update_siswa_baru($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$replid				=	(empty($_POST["replid"])) ? 0 : $_POST["replid"];
			
			$idangkatan			=	(empty($_POST["idangkatan"])) ? 0 : $_POST["idangkatan"];
			$idangkatan1		=	(empty($_POST["idangkatan1"])) ? 0 : $_POST["idangkatan1"];
			
			/*--------Keterangan pribadi---------*/
			$nis				=	$_POST["nis"];
			$nisn				=	$_POST["nisn"];
			$nik				=	$_POST["nik"];
			$alumni				=	$_POST["alumni"];
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
			$kodepossiswa		=	$_POST["kodepossiswa"];	
			$jenistinggal		=	$_POST["jenistinggal"];	
			$kps				=	(empty($_POST["kps"])) ? 0 : $_POST["kps"];
			$nokps				=	$_POST["nokps"];
			$kip				=	(empty($_POST["kip"])) ? 0 : $_POST["kip"];
			$nokip				=	$_POST["nokip"];
			$namakip			=	$_POST["namakip"];
			$nokks				=	$_POST["nokks"];
			$no_akte_lahir		=	$_POST["no_akte_lahir"];
			$alamatortu			=	$_POST["alamatortu"];
			$telponsiswa		=	$_POST["telponsiswa"];
			$hpsiswa			=	$_POST["hpsiswa"];
			$emailsiswa			=	$_POST["emailsiswa"];
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
			$uploaddir 		= 'app/file_darah/';
			$file_darah2	= $_POST["file_darah2"];
			$file_darah 	= $_FILES['file_darah']['name']; 
			$tmpname  		= $_FILES['file_darah']['tmp_name'];
			$filesize 		= $_FILES['file_darah']['size'];
			$filetype 		= $_FILES['file_darah']['type'];
			
			if (empty($file_darah)) { 
				$file_darah = $file_darah2; 
			} 
			
			if($file_darah != "") {	
				
				if($file_darah != $file_darah2) {
				
					if(!empty($file_darah2)) {
						if (file_exists($uploaddir . '/' . $file_darah2)) {
							unlink($uploaddir . $file_darah2); //remove file 
						}
					}
					
					$file_darah = $nisn . $idkelas . '_' . $file_darah;
				}
							
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
			
			/*--------Lain-lain---------*/
			$rombel_id			=	$_POST["rombel_id"];
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
			
			//-----------upload file photo
			$uploaddir 		= 'app/file_foto_siswa/';
			$foto_file2	= $_POST["foto_file2"];
			$foto_file 	= $_FILES['foto_file']['name']; 
			$tmpname  		= $_FILES['foto_file']['tmp_name'];
			$filesize 		= $_FILES['foto_file']['size'];
			$filetype 		= $_FILES['foto_file']['type'];
			
			if (empty($foto_file)) { 
				$foto_file = $foto_file2; 
			} 
			
			if($foto_file != "") {	
				
				if($foto_file != $foto_file2) {
				
					if(!empty($foto_file2)) {
						if (file_exists($uploaddir . '/' . $foto_file2)) {
							unlink($uploaddir . $foto_file2); //remove file
						} 
					}
					
					$foto_file = $nisn . '_' . $foto_file;
				}
							
				$uploadfile = $uploaddir . $foto_file;		
				if (move_uploaded_file($_FILES['foto_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			
			//-----------upload file_jalurmasuk
			$uploaddir 		= 'app/file_jalurmasuk/';
			$file_jalurmasuk2	= $_POST["file_jalurmasuk2"];
			$file_jalurmasuk 	= $_FILES['file_jalurmasuk']['name']; 
			$tmpname  		= $_FILES['file_jalurmasuk']['tmp_name'];
			$filesize 		= $_FILES['file_jalurmasuk']['size'];
			$filetype 		= $_FILES['file_jalurmasuk']['type'];
			
			if (empty($file_jalurmasuk)) { 
				$file_jalurmasuk = $file_jalurmasuk2; 
			} 
			
			if($file_jalurmasuk != "") {	
				
				if($file_jalurmasuk != $file_jalurmasuk2) {
				
					if(!empty($file_jalurmasuk2)) {
						if (file_exists($uploaddir . '/' . $file_jalurmasuk2)) {
							unlink($uploaddir . $file_jalurmasuk2); //remove file
						} 
					}
					
					$file_jalurmasuk = $nisn . '_' . $file_jalurmasuk;
				}
							
				$uploadfile = $uploaddir . $file_jalurmasuk;		
				if (move_uploaded_file($_FILES['file_jalurmasuk']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			//-----------upload file file_rekam_bk
			$uploaddir 		= 'app/file_rekam_bk/';
			$file_rekam_bk2	= $_POST["file_rekam_bk2"];
			$file_rekam_bk 	= $_FILES['file_rekam_bk']['name']; 
			$tmpname  		= $_FILES['file_rekam_bk']['tmp_name'];
			$filesize 		= $_FILES['file_rekam_bk']['size'];
			$filetype 		= $_FILES['file_rekam_bk']['type'];
			
			if (empty($file_rekam_bk)) { 
				$file_rekam_bk = $file_rekam_bk2; 
			} 
			
			if($file_rekam_bk != "") {	
				
				if($file_rekam_bk != $file_rekam_bk2) {
				
					if(!empty($file_rekam_bk2)) {
						if (file_exists($uploaddir . '/' . $file_rekam_bk2)) {
							unlink($uploaddir . $file_rekam_bk2); //remove file 
						}
					}
					
					$file_rekam_bk = $nisn . '_' . $file_rekam_bk;
				}
							
				$uploadfile = $uploaddir . $file_rekam_bk;		
				if (move_uploaded_file($_FILES['file_rekam_bk']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			//-----------upload file file_memo_ortu
			$uploaddir 		= 'app/file_memo_ortu/';
			$file_memo_ortu2= $_POST["file_memo_ortu2"];
			$file_memo_ortu = $_FILES['file_memo_ortu']['name']; 
			$tmpname  		= $_FILES['file_memo_ortu']['tmp_name'];
			$filesize 		= $_FILES['file_memo_ortu']['size'];
			$filetype 		= $_FILES['file_memo_ortu']['type'];
			
			if (empty($file_memo_ortu)) { 
				$file_memo_ortu = $file_memo_ortu2; 
			} 
			
			if($file_memo_ortu != "") {	
				
				if($file_memo_ortu != $file_memo_ortu2) {
				
					if(!empty($file_memo_ortu2)) {
						if (file_exists($uploaddir . '/' . $file_memo_ortu2)) {
							unlink($uploaddir . $file_memo_ortu2); //remove file 
						}
					}
					
					$file_memo_ortu = $nisn . '_' . $file_memo_ortu;
				}
							
				$uploadfile = $uploaddir . $file_memo_ortu;		
				if (move_uploaded_file($_FILES['file_memo_ortu']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------		
			
			
			//-----------upload file file_nilai_un
			$uploaddir 		= 'app/file_nilai_un/';
			$file_nilai_un2= $_POST["file_nilai_un2"];
			$file_nilai_un = $_FILES['file_nilai_un']['name']; 
			$tmpname  		= $_FILES['file_nilai_un']['tmp_name'];
			$filesize 		= $_FILES['file_nilai_un']['size'];
			$filetype 		= $_FILES['file_nilai_un']['type'];
			
			if (empty($file_nilai_un)) { 
				$file_nilai_un = $file_nilai_un2; 
			} 
			
			if($file_nilai_un != "") {	
				
				if($file_nilai_un != $file_nilai_un2) {
				
					if(!empty($file_nilai_un2)) {
						if (file_exists($uploaddir . '/' . $file_nilai_un2)) {	
							unlink($uploaddir . $file_nilai_un2); //remove file 
						}
					}
										
					$file_nilai_un = $nisn . '_' . $file_nilai_un;
				}
							
				$uploadfile = $uploaddir . $file_nilai_un;		
				if (move_uploaded_file($_FILES['file_nilai_un']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------		
			
			//-----------upload file file_raport
			$uploaddir 		= 'app/file_raport/';
			$file_raport2= $_POST["file_raport2"];
			$file_raport = $_FILES['file_raport']['name']; 
			$tmpname  		= $_FILES['file_raport']['tmp_name'];
			$filesize 		= $_FILES['file_raport']['size'];
			$filetype 		= $_FILES['file_raport']['type'];
			
			if (empty($file_raport)) { 
				$file_raport = $file_raport2; 
			} 
			
			if($file_raport != "") {	
				
				if($file_raport != $file_raport2) {
				
					if(!empty($file_raport2)) {
						if (file_exists($uploaddir . '/' . $file_raport2)) {
							unlink($uploaddir . $file_raport2); //remove file 
						}
					}
					
					$file_raport = $nisn . '_' . $file_raport;
				}
							
				$uploadfile = $uploaddir . $file_raport;		
				if (move_uploaded_file($_FILES['file_raport']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------		
			
			
			//-----------upload file file_raport
			$uploaddir 		= 'app/file_raport/';
			$file_raport2= $_POST["file_raport2"];
			$file_raport = $_FILES['file_raport']['name']; 
			$tmpname  		= $_FILES['file_raport']['tmp_name'];
			$filesize 		= $_FILES['file_raport']['size'];
			$filetype 		= $_FILES['file_raport']['type'];
			
			if (empty($file_raport)) { 
				$file_raport = $file_raport2; 
			} 
			
			if($file_raport != "") {	
				
				if($file_raport != $file_raport2) {
				
					if(!empty($file_raport2)) {
						if (file_exists($uploaddir . '/' . $file_raport2)) {
							unlink($uploaddir . $file_raport2); //remove file 
						}
					}
					
					$file_raport = $nisn . '_' . $file_raport;
				}
							
				$uploadfile = $uploaddir . $file_raport;		
				if (move_uploaded_file($_FILES['file_raport']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			
			//-----------upload file file_raport
			$uploaddir 		= 'app/file_raport/';
			$file_raport2= $_POST["file_raport2"];
			$file_raport = $_FILES['file_raport']['name']; 
			$tmpname  		= $_FILES['file_raport']['tmp_name'];
			$filesize 		= $_FILES['file_raport']['size'];
			$filetype 		= $_FILES['file_raport']['type'];
			
			if (empty($file_raport)) { 
				$file_raport = $file_raport2; 
			} 
			
			if($file_raport != "") {	
				
				if($file_raport != $file_raport2) {
				
					if(!empty($file_raport2)) {
						if (file_exists($uploaddir . '/' . $file_raport2)) {
							unlink($uploaddir . $file_raport2); //remove file 
						}
					}
					
					$file_raport = $nisn . '_' . $file_raport;
				}
							
				$uploadfile = $uploaddir . $file_raport;		
				if (move_uploaded_file($_FILES['file_raport']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			//-----------upload file file_kk
			$uploaddir 		= 'app/file_kk/';
			$file_kk2= $_POST["file_kk2"];
			$file_kk = $_FILES['file_kk']['name']; 
			$tmpname  		= $_FILES['file_kk']['tmp_name'];
			$filesize 		= $_FILES['file_kk']['size'];
			$filetype 		= $_FILES['file_kk']['type'];
			
			if (empty($file_kk)) { 
				$file_kk = $file_kk2; 
			} 
			
			if($file_kk != "") {	
				
				if($file_kk != $file_kk2) {
				
					if(!empty($file_kk2)) {
						if (file_exists($uploaddir . '/' . $file_kk2)) {
							unlink($uploaddir . $file_kk2); //remove file 
						}
					}
					
					$file_kk = $nisn . '_' . $file_kk;
				}
							
				$uploadfile = $uploaddir . $file_kk;		
				if (move_uploaded_file($_FILES['file_kk']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			
			//-----------upload file file_akte
			$uploaddir 		= 'app/file_akte/';
			$file_akte2= $_POST["file_akte2"];
			$file_akte = $_FILES['file_akte']['name']; 
			$tmpname  		= $_FILES['file_akte']['tmp_name'];
			$filesize 		= $_FILES['file_akte']['size'];
			$filetype 		= $_FILES['file_akte']['type'];
			
			if (empty($file_akte)) { 
				$file_akte = $file_akte2; 
			} 
			
			if($file_akte != "") {	
				
				if($file_akte != $file_akte2) {
				
					if(!empty($file_akte2)) {
						if (file_exists($uploaddir . '/' . $file_akte2)) {
							unlink($uploaddir . $file_akte2); //remove file 
						}
					}
					
					$file_akte = $nisn . '_' . $file_akte;
				}
							
				$uploadfile = $uploaddir . $file_akte;		
				if (move_uploaded_file($_FILES['file_akte']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			//-----------upload file file_ijazah
			$uploaddir 		= 'app/file_ijazah/';
			$file_ijazah2= $_POST["file_ijazah2"];
			$file_ijazah = $_FILES['file_ijazah']['name']; 
			$tmpname  		= $_FILES['file_ijazah']['tmp_name'];
			$filesize 		= $_FILES['file_ijazah']['size'];
			$filetype 		= $_FILES['file_ijazah']['type'];
			
			if (empty($file_ijazah)) { 
				$file_ijazah = $file_ijazah2; 
			} 
			
			if($file_ijazah != "") {	
				
				if($file_ijazah != $file_ijazah2) {
				
					if(!empty($file_ijazah2)) {
						if (file_exists($uploaddir . '/' . $file_ijazah2)) {
							unlink($uploaddir . $file_ijazah2); //remove file 
						}
					}
					
					$file_ijazah = $nisn . '_' . $file_ijazah;
				}
							
				$uploadfile = $uploaddir . $file_ijazah;		
				if (move_uploaded_file($_FILES['file_ijazah']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			
			//-----------upload file file_nhun
			$uploaddir 		= '../app/file_nhun/';
			$file_nhun2= $_POST["file_nhun2"];
			$file_nhun = $_FILES['file_nhun']['name']; 
			$tmpname  		= $_FILES['file_nhun']['tmp_name'];
			$filesize 		= $_FILES['file_nhun']['size'];
			$filetype 		= $_FILES['file_nhun']['type'];
			
			if (empty($file_nhun)) { 
				$file_nhun = $file_nhun2; 
			} 
			
			if($file_nhun != "") {	
				
				if($file_nhun != $file_nhun2) {
				
					if(!empty($file_nhun2)) {
						if (file_exists($uploaddir . '/' . $file_nhun2)) {
							unlink($uploaddir . $file_nhun2); //remove file 
						}
					}
					
					$file_nhun = $nisn . '_' . $file_nhun;
				}
							
				$uploadfile = $uploaddir . $file_nhun;		
				if (move_uploaded_file($_FILES['file_nhun']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			$sqlstr = "update siswa set nis='$nis', nisn='$nisn', nik='$nik', idangkatan='$idangkatan', idangkatan1='$idangkatan1', foto_file='$foto_file', nama='$nama', panggilan='$panggilan', idkelas='$idkelas', tglmasuk='$tglmasuk', kelamin='$kelamin', tmplahir='$tmplahir', tgllahir='$tgllahir', agama='$agama', warga='$warga', anakke='$anakke', jsaudara='$jsaudara', jtiri='$jtiri', jangkat='$jangkat', yatim='$yatim', bahasa='$bahasa', desa_kode='$desa_kode', kecamatan_kode='$kecamatan_kode', kota_kode='$kota_kode', provinsi_kode='$provinsi_kode', alamatsiswa='$alamatsiswa', rt_siswa='$rt_siswa', rw_siswa='$rw_siswa', dusun='$dusun', desa='$desa', kecamatan='$kecamatan', kodepossiswa='$kodepossiswa', alamatortu='$alamatortu', telponsiswa='$telponsiswa', hpsiswa='$hpsiswa', emailsiswa='$emailsiswa', jenistinggal='$jenistinggal', kps='$kps', nokps='$nokps', kip='$kip', nokip='$nokip', namakip='$namakip', nokks='$nokks', no_akte_lahir='$no_akte_lahir', telponortu='$telponortu', hportu='$hportu', hpibu='$hpibu', transportasi_kode='$transportasi_kode', transportasi_lain='$transportasi_lain', jaraksekolah='$jaraksekolah', kesekolah='$kesekolah', berat='$berat', tinggi='$tinggi', kesehatan='$kesehatan', darah='$darah', file_darah='$file_darah', kelainan='$kelainan', asalsekolah_id='$asalsekolah_id', kota_asalsekolah='$kota_asalsekolah', tglijazah='$tglijazah', noijazah='$noijazah', tglskhun='$tglskhun', skhun='$skhun', noujian='$noujian', nisnasal='$nisnasal', nik_ayah='$nik_ayah', namaayah='$namaayah', nik_ibu='$nik_ibu', namaibu='$namaibu', tmplahirayah='$tmplahirayah', tgllahirayah='$tgllahirayah', tempat_bekerja_ayah='$tempat_bekerja_ayah', tmplahiribu='$tmplahiribu', tgllahiribu='$tgllahiribu', pekerjaanayah='$pekerjaanayah', pekerjaanibu='$pekerjaanibu', penghasilanayah_kode='$penghasilanayah_kode', penghasilanayah='$penghasilanayah', penghasilanibu_kode='$penghasilanibu_kode', penghasilanibu='$penghasilanibu', pendidikanayah='$pendidikanayah', pendidikanibu='$pendidikanibu', tempat_bekerja_ibu='$tempat_bekerja_ibu', wnayah='$wnayah', wnibu='$wnibu', nik_wali='$nik_wali', wali='$wali', tmplahirwali='$tmplahirwali', tgllahirwali='$tgllahirwali', pendidikanwali='$pendidikanwali', pekerjaanwali='$pekerjaanwali', penghasilanwali_kode='$penghasilanwali_kode', penghasilanwali='$penghasilanwali', tempat_bekerja_wali='$tempat_bekerja_wali', alamatwali='$alamatwali', hpwali='$hpwali', hubungansiswa='$hubungansiswa', pekerjaanayah_lain='$pekerjaanayah_lain', pekerjaanibu_lain='$pekerjaanibu_lain', pekerjaanwali_lain='$pekerjaanwali_lain', rombel_id='$rombel_id', nama_bank='$nama_bank', no_rekening_bank='$no_rekening_bank', nama_pemilik_bank='$nama_pemilik_bank', pip='$pip', alasan_pip='$alasan_pip', idminat='$idminat', jalurmasuk='$jalurmasuk', jalurmasuk_id='$jalurmasuk_id', jalurmasukprestasi_id='$jalurmasukprestasi_id', file_rekam_bk='$file_rekam_bk', file_memo_ortu='$file_memo_ortu', file_nilai_un = '$file_nilai_un', file_raport='$file_raport', file_kk='$file_kk', file_akte='$file_akte', file_ijazah='$file_ijazah', file_nhun='$file_nhun', uid2='$uid', aktif='$aktif', ts='$dlu', tahun_ijazah='$tahun_ijazah', tahunskhun='$tahunskhun', kebutuhan_khusus_chk='$kebutuhan_khusus_chk', jenis_tinggal='$jenis_tinggal', kebutuhan_khusus_chk1='$kebutuhan_khusus_chk1', kebutuhan_khusus='$kebutuhan_khusus', citacita='$citacita', citacita_lain='$citacita_lain', tahunayah='$tahunayah', kodeposortu='$kodeposortu', butuhkhususketayah='$butuhkhususketayah', tahunibu='$tahunibu', kodeposibu='$kodeposibu', butuhkhususibu='$butuhkhususibu', butuhkhususketibu='$butuhkhususketibu', tahunwali='$tahunwali', jarak_km='$jarak_km', waktutempuh='$waktutempuh', waktutempuh_menit='$waktutempuh_menit', almayah='$almayah', butuhkhususayah='$butuhkhususayah', almibu='$almibu', alamatibu='$alamatibu', alumni='$alumni', idgugus='$idgugus', file_jalurmasuk='$file_jalurmasuk', dlu2='$dlu' where replid='$ref'";
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
			} else {
				$sqlstr = "update siswa_virtualaccount set virtualaccount='$virtualaccount' where nis='$nis'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
			
			/*------------siswa prestasi-------------*/
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($x=0; $x<=$jmldata; $x++) {
				$delete 			= (empty($_POST[delete_.$x])) ? 0 : $_POST[delete_.$x];
				$old_line		 	= 	(empty($_POST[old_line_.$x])) ? 0 : $_POST[old_line_.$x];
				
				$jenisprestasi_ 	=	$_POST[jenisprestasi_.$x];
				$tingkat_ 			=	$_POST[tingkat_.$x];
				$nama_			 	=	$_POST[nama_.$x];
				$tahun_			 	=	(empty($_POST[tahun_.$x])) ? 0 : $_POST[tahun_.$x];
				$penyelenggara_		=	$_POST[penyelenggara_.$x];
				
				if ( $jenisprestasi_ != "" ) {
					
					$sqlcek = "select idsiswa from siswa_prestasi where idsiswa='$replid' and line='$old_line' ";										
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							$sqlstr="update siswa_prestasi set jenisprestasi='$jenisprestasi_', tingkat='$tingkat_', nama='$nama_', tahun='$tahun_', penyelenggara='$penyelenggara_' where idsiswa='$replid' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
						} else {
							$sqlstr="delete from siswa_prestasi where idsiswa='$replid' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();							
						}
						
						
					} else {
						
						$line = maxline('siswa_prestasi', 'line', 'idsiswa', $replid, '');
				
						$sqlstr = "insert into siswa_prestasi (idsiswa, jenisprestasi, tingkat, nama, tahun, penyelenggara, line) values ('$replid', '$jenisprestasi_', '$tingkat_', '$nama_', '$tahun_', '$penyelenggara_', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
											
					}
					
				}
			}
			
			
			
			/*------------siswa beasiswa-------------*/
			$jmldata2 = (empty($_POST['jmldata2'])) ? 0 : $_POST['jmldata2'];
			
			for ($x=0; $x<=$jmldata2; $x++) {
				$delete2 			= 	(empty($_POST[delete2_.$x])) ? 0 : $_POST[delete2_.$x];
				$old_line2		 	= 	(empty($_POST[old_line2_.$x])) ? 0 : $_POST[old_line2_.$x];
				
				$jenis_ 			=	$_POST[jenis_.$x];
				$penyelenggara2_	=	$_POST[penyelenggara2_.$x];
				$tahunmulai_	 	=	(empty($_POST[tahunmulai_.$x])) ? 0 : $_POST[tahunmulai_.$x];
				$tahunselesai_	 	=	(empty($_POST[tahunselesai_.$x])) ? 0 : $_POST[tahunselesai_.$x];
				
				if ( $jenis_ != "" ) {
					
					$sqlcek = "select idsiswa from siswa_beasiswa where idsiswa='$replid' and line='$old_line2' ";					
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					
					if($num > 0) {
						if($delete2 == 0) {
							$sqlstr="update siswa_beasiswa set jenis='$jenis_', penyelenggara='$penyelenggara2_', tahunmulai='$tahunmulai_', tahunselesai='$tahunselesai_' where idsiswa='$replid' and line=$old_line2";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
						} else {
							$sqlstr="delete from siswa_beasiswa where idsiswa='$replid' and line=$old_line2";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();							
						}
						
						
					} else {
						
						$line = maxline('siswa_beasiswa', 'line', 'idsiswa', $replid, '');
				
						$sqlstr = "insert into siswa_beasiswa (idsiswa, jenis, penyelenggara, tahunmulai, tahunselesai, line) values ('$replid', '$jenis_', '$penyelenggara2_', '$tahunmulai_', '$tahunselesai_', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
											
					}
					
				}
			}
			
			
			/*------------siswa nilai UN-------------*/
			$jmldata_un = (empty($_POST['jmldata_un'])) ? 0 : $_POST['jmldata_un'];		
			for ($x=0; $x<=$jmldata_un; $x++) {
				$replid_un3u 		=	$_POST[replid_un3u_.$x];
				$pelajaran_id3u		=	$replid_un3u;
				$nilai3u				=	numberreplace($_POST[nilai3u_.$x]);
				
				if ( !empty($replid_un3u) ) {
					$sqlcek = "select nis from siswa_nilai_un where nis='$nis' and pelajaran_id='$pelajaran_id3u'";
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					if($num > 0) {
						$sqlstr="update siswa_nilai_un set nilai='$nilai3u' where nis='$nis' and pelajaran_id='$pelajaran_id3u'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$line = maxline('siswa_nilai_un', 'line', 'nis', $nis, '');				
						$sqlstr = "insert into siswa_nilai_un (nis, pelajaran_id, nilai, line) values ('$nis', '$pelajaran_id3u', '$nilai3u', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();						
					}
				}
			}
			
			
			//----------update raport semester-1
			$nis = $replid;
			$jmldata_raport = (empty($_POST['jmldata_raport'])) ? 0 : $_POST['jmldata_raport'];		
			for ($x=0; $x<=$jmldata_raport; $x++) {
				$replid_un 			=	$_POST[replid_un_.$x];
				$pelajaran_id		=	$replid_un;
				$nilai				=	numberreplace($_POST[nilai_.$x]);
				
				if ( !empty($replid_un) ) {
					$sqlcek = "select nis from siswa_nilai_raport where nis='$nis' and pelajaran_id='$pelajaran_id' and semester=1";
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					if($num > 0) {
						$sqlstr="update siswa_nilai_raport set nilai='$nilai' where nis='$nis' and pelajaran_id='$pelajaran_id' and semester=1";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {					
						$line = maxline('siswa_nilai_raport', 'line', 'nis', $nis, '');
						$sqlstr = "insert into siswa_nilai_raport (nis, semester, pelajaran_id, nilai, line) values ('$nis', '1', '$pelajaran_id', '$nilai', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
				}
			}
			
			
			//----------update raport semester-2
			$jmldata_raport1 = (empty($_POST['jmldata_raport1'])) ? 0 : $_POST['jmldata_raport1'];		
			for ($x=0; $x<=$jmldata_raport1; $x++) {
				$replid_un1 			=	$_POST[replid_un1_.$x];
				$pelajaran_id1		=	$replid_un1;
				$nilai1				=	numberreplace($_POST[nilai1_.$x]);
				
				if ( !empty($replid_un1) ) {
					$sqlcek = "select nis from siswa_nilai_raport where nis='$nis' and pelajaran_id='$pelajaran_id1' and semester=2";
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					if($num > 0) {
						$sqlstr="update siswa_nilai_raport set nilai='$nilai1' where nis='$nis' and pelajaran_id='$pelajaran_id1' and semester=2";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {					
						$line = maxline('siswa_nilai_raport', 'line', 'nis', $nis, '');
						$sqlstr = "insert into siswa_nilai_raport (nis, semester, pelajaran_id, nilai, line) values ('$nis', '2', '$pelajaran_id1', '$nilai1', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
				}
			}
			
			
			//----------update raport semester-3
			$jmldata_raport2 = (empty($_POST['jmldata_raport2'])) ? 0 : $_POST['jmldata_raport2'];		
			for ($x=0; $x<=$jmldata_raport2; $x++) {
				$replid_un2 			=	$_POST[replid_un2_.$x];
				$pelajaran_id2		=	$replid_un2;
				$nilai2				=	numberreplace($_POST[nilai2_.$x]);
				
				if ( !empty($replid_un2) ) {
					$sqlcek = "select nis from siswa_nilai_raport where nis='$nis' and pelajaran_id='$pelajaran_id2' and semester=3";
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					if($num > 0) {
						$sqlstr="update siswa_nilai_raport set nilai='$nilai2' where nis='$nis' and pelajaran_id='$pelajaran_id2' and semester=3";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {					
						$line = maxline('siswa_nilai_raport', 'line', 'nis', $nis, '');
						$sqlstr = "insert into siswa_nilai_raport (nis, semester, pelajaran_id, nilai, line) values ('$nis', '3', '$pelajaran_id2', '$nilai2', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
				}
			}
			
			
			//----------update raport semester-4
			$jmldata_raport3 = (empty($_POST['jmldata_raport3'])) ? 0 : $_POST['jmldata_raport3'];		
			for ($x=0; $x<=$jmldata_raport3; $x++) {
				$replid_un3			=	$_POST[replid_un3_.$x];
				$pelajaran_id3		=	$replid_un3;
				$nilai3				=	numberreplace($_POST[nilai3_.$x]);
				
				if ( !empty($replid_un3) ) {
					$sqlcek = "select nis from siswa_nilai_raport where nis='$nis' and pelajaran_id='$pelajaran_id3' and semester=4";
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					if($num > 0) {
						$sqlstr="update siswa_nilai_raport set nilai='$nilai3' where nis='$nis' and pelajaran_id='$pelajaran_id3' and semester=4";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$line = maxline('siswa_nilai_raport', 'line', 'nis', $nis, '');
						$sqlstr = "insert into siswa_nilai_raport (nis, semester, pelajaran_id, nilai, line) values ('$nis', '4', '$pelajaran_id3', '$nilai3', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
				}
			}
			
			
			//----------update raport semester-5
			$jmldata_raport4 = (empty($_POST['jmldata_raport4'])) ? 0 : $_POST['jmldata_raport4'];		
			for ($x=0; $x<=$jmldata_raport4; $x++) {
				$replid_un4			=	$_POST[replid_un4_.$x];
				$pelajaran_id4		=	$replid_un4;
				$nilai4				=	numberreplace($_POST[nilai4_.$x]);
				
				if ( !empty($replid_un4) ) {
					$sqlcek = "select nis from siswa_nilai_raport where nis='$nis' and pelajaran_id='$pelajaran_id4' and semester=5";
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					if($num > 0) {
						$sqlstr="update siswa_nilai_raport set nilai='$nilai4' where nis='$nis' and pelajaran_id='$pelajaran_id4' and semester=5";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$line = maxline('siswa_nilai_raport', 'line', 'nis', $nis, '');
						$sqlstr = "insert into siswa_nilai_raport (nis, semester, pelajaran_id, nilai, line) values ('$nis', '5', '$pelajaran_id4', '$nilai4', '$line')";
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
	
	
	//------update gugus
	function update_gugus($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$replid				=	(empty($_POST["replid"])) ? 0 : $_POST["replid"];
			$gugus				=	$_POST["gugus"];
			$kapasitas			=	$_POST["kapasitas"];
			$kapasitas_l		=	$_POST["kapasitas_l"];
			$kapasitas_p		=	$_POST["kapasitas_p"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update gugus set gugus='$gugus', kapasitas='$kapasitas', kapasitas_l='$kapasitas_l', kapasitas_p='$kapasitas_p', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update setup nilai mapel UN siswa baru (pembagian minat)
	/*1. Jika siswa minat IPS, maka langsung ke IPS (meskipun nilai UN tinggi)
	2. Jika siswa minat IPA, maka dicek nilai UN (Matematika, Fisika) >= 80 (ada di setup nilai minat)
	3. Jika dicek nilai UN kurang dari yg ditentukan, maka masuk ke IPS*/
	function update_infonap($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idpelajaran		=	$_POST["idpelajaran"];
			$nilaimin			=	$_POST["nilaimin"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update infonap set idpelajaran='$idpelajaran', nilaimin='$nilaimin', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//-----update setup periode raport
	function update_setup_periode_raport($ref){
		$dbpdo = DB::create();
		
		try {
			
			$idtahunajaran	=	(empty($_POST["idtahunajaran"])) ? 0 : $_POST["idtahunajaran"];
			$semester_id	=	(empty($_POST["semester_id"])) ? 0 : $_POST["semester_id"];
			$tingkat_id		=	(empty($_POST["tingkat_id"])) ? 0 : $_POST["tingkat_id"];
			$tanggal_ttd	=   date("Y-m-d", strtotime($_POST["tanggal_ttd"]));
			$aktif			=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "update setup_periode_raport set idtahunajaran='$idtahunajaran', semester_id='$semester_id', tingkat_id='$tingkat_id', tanggal_ttd='$tanggal_ttd', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}

		return $sql;
	}
	
	//-----update setup periode raport pts
	function update_setup_periode_raport_pts($ref){
		$dbpdo = DB::create();
		
		try {
			
			$idtahunajaran	=	(empty($_POST["idtahunajaran"])) ? 0 : $_POST["idtahunajaran"];
			$semester_id	=	(empty($_POST["semester_id"])) ? 0 : $_POST["semester_id"];
			$tingkat_id		=	(empty($_POST["tingkat_id"])) ? 0 : $_POST["tingkat_id"];
			$tanggal_ttd	=   date("Y-m-d", strtotime($_POST["tanggal_ttd"]));
			$aktif			=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "update setup_periode_raport_pts set idtahunajaran='$idtahunajaran', semester_id='$semester_id', tingkat_id='$tingkat_id', tanggal_ttd='$tanggal_ttd', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}

		return $sql;
	}
	
	//------update alumni
	function update_alumni($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$replid				=	(empty($_POST["replid"])) ? 0 : $_POST["replid"];
			
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
			$kodepossiswa		=	$_POST["kodepossiswa"];	
			$jenistinggal		=	$_POST["jenistinggal"];	
			$kps				=	(empty($_POST["kps"])) ? 0 : $_POST["kps"];
			$nokps				=	$_POST["nokps"];
			$kip				=	(empty($_POST["kip"])) ? 0 : $_POST["kip"];
			$nokip				=	$_POST["nokip"];
			$namakip			=	$_POST["namakip"];
			$nokks				=	$_POST["nokks"];
			$no_akte_lahir		=	$_POST["no_akte_lahir"];
			$alamatortu			=	$_POST["alamatortu"];
			$telponsiswa		=	$_POST["telponsiswa"];
			$hpsiswa			=	$_POST["hpsiswa"];
			$emailsiswa			=	$_POST["emailsiswa"];
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
			$uploaddir 		= 'app/file_darah/';
			$file_darah2	= $_POST["file_darah2"];
			$file_darah 	= $_FILES['file_darah']['name']; 
			$tmpname  		= $_FILES['file_darah']['tmp_name'];
			$filesize 		= $_FILES['file_darah']['size'];
			$filetype 		= $_FILES['file_darah']['type'];
			
			if (empty($file_darah)) { 
				$file_darah = $file_darah2; 
			} 
			
			if($file_darah != "") {	
				
				if($file_darah != $file_darah2) {
				
					if(!empty($file_darah2)) {
						if (file_exists($uploaddir . '/' . $file_darah2)) {
							unlink($uploaddir . $file_darah2); //remove file 
						}
					}
					
					$file_darah = $nis . $idkelas . '_' . $file_darah;
				}
							
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
			
			/*--------Lain-lain---------*/
			$rombel_id			=	$_POST["rombel_id"];
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
			
			//-----------upload file photo
			$uploaddir 		= 'app/file_foto_siswa/';
			$foto_file2	= $_POST["foto_file2"];
			$foto_file 	= $_FILES['foto_file']['name']; 
			$tmpname  		= $_FILES['foto_file']['tmp_name'];
			$filesize 		= $_FILES['foto_file']['size'];
			$filetype 		= $_FILES['foto_file']['type'];
			
			if (empty($foto_file)) { 
				$foto_file = $foto_file2; 
			} 
			
			if($foto_file != "") {	
				
				if($foto_file != $foto_file2) {
				
					if(!empty($foto_file2)) {
						if (file_exists($uploaddir . '/' . $foto_file2)) {
							unlink($uploaddir . $foto_file2); //remove file
						} 
					}
					
					$foto_file = $nis . '_' . $foto_file;
				}
							
				$uploadfile = $uploaddir . $foto_file;		
				if (move_uploaded_file($_FILES['foto_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			//-----------upload file file_rekam_bk
			$uploaddir 		= 'app/file_rekam_bk/';
			$file_rekam_bk2	= $_POST["file_rekam_bk2"];
			$file_rekam_bk 	= $_FILES['file_rekam_bk']['name']; 
			$tmpname  		= $_FILES['file_rekam_bk']['tmp_name'];
			$filesize 		= $_FILES['file_rekam_bk']['size'];
			$filetype 		= $_FILES['file_rekam_bk']['type'];
			
			if (empty($file_rekam_bk)) { 
				$file_rekam_bk = $file_rekam_bk2; 
			} 
			
			if($file_rekam_bk != "") {	
				
				if($file_rekam_bk != $file_rekam_bk2) {
				
					if(!empty($file_rekam_bk2)) {
						if (file_exists($uploaddir . '/' . $file_rekam_bk2)) {
							unlink($uploaddir . $file_rekam_bk2); //remove file 
						}
					}
					
					$file_rekam_bk = $nis . '_' . $file_rekam_bk;
				}
							
				$uploadfile = $uploaddir . $file_rekam_bk;		
				if (move_uploaded_file($_FILES['file_rekam_bk']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			//-----------upload file file_memo_ortu
			$uploaddir 		= 'app/file_memo_ortu/';
			$file_memo_ortu2= $_POST["file_memo_ortu2"];
			$file_memo_ortu = $_FILES['file_memo_ortu']['name']; 
			$tmpname  		= $_FILES['file_memo_ortu']['tmp_name'];
			$filesize 		= $_FILES['file_memo_ortu']['size'];
			$filetype 		= $_FILES['file_memo_ortu']['type'];
			
			if (empty($file_memo_ortu)) { 
				$file_memo_ortu = $file_memo_ortu2; 
			} 
			
			if($file_memo_ortu != "") {	
				
				if($file_memo_ortu != $file_memo_ortu2) {
				
					if(!empty($file_memo_ortu2)) {
						if (file_exists($uploaddir . '/' . $file_memo_ortu2)) {
							unlink($uploaddir . $file_memo_ortu2); //remove file 
						}
					}
					
					$file_memo_ortu = $nis . '_' . $file_memo_ortu;
				}
							
				$uploadfile = $uploaddir . $file_memo_ortu;		
				if (move_uploaded_file($_FILES['file_memo_ortu']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------		
			
			
			//-----------upload file file_nilai_un
			$uploaddir 		= 'app/file_nilai_un/';
			$file_nilai_un2= $_POST["file_nilai_un2"];
			$file_nilai_un = $_FILES['file_nilai_un']['name']; 
			$tmpname  		= $_FILES['file_nilai_un']['tmp_name'];
			$filesize 		= $_FILES['file_nilai_un']['size'];
			$filetype 		= $_FILES['file_nilai_un']['type'];
			
			if (empty($file_nilai_un)) { 
				$file_nilai_un = $file_nilai_un2; 
			} 
			
			if($file_nilai_un != "") {	
				
				if($file_nilai_un != $file_nilai_un2) {
				
					if(!empty($file_nilai_un2)) {
						if (file_exists($uploaddir . '/' . $file_nilai_un2)) {	
							unlink($uploaddir . $file_nilai_un2); //remove file 
						}
					}
										
					$file_nilai_un = $nis . '_' . $file_nilai_un;
				}
							
				$uploadfile = $uploaddir . $file_nilai_un;		
				if (move_uploaded_file($_FILES['file_nilai_un']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------		
			
			//-----------upload file file_raport
			$uploaddir 		= 'app/file_raport/';
			$file_raport2= $_POST["file_raport2"];
			$file_raport = $_FILES['file_raport']['name']; 
			$tmpname  		= $_FILES['file_raport']['tmp_name'];
			$filesize 		= $_FILES['file_raport']['size'];
			$filetype 		= $_FILES['file_raport']['type'];
			
			if (empty($file_raport)) { 
				$file_raport = $file_raport2; 
			} 
			
			if($file_raport != "") {	
				
				if($file_raport != $file_raport2) {
				
					if(!empty($file_raport2)) {
						if (file_exists($uploaddir . '/' . $file_raport2)) {
							unlink($uploaddir . $file_raport2); //remove file 
						}
					}
					
					$file_raport = $nis . '_' . $file_raport;
				}
							
				$uploadfile = $uploaddir . $file_raport;		
				if (move_uploaded_file($_FILES['file_raport']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------		
			
			
			//-----------upload file file_raport
			$uploaddir 		= 'app/file_raport/';
			$file_raport2= $_POST["file_raport2"];
			$file_raport = $_FILES['file_raport']['name']; 
			$tmpname  		= $_FILES['file_raport']['tmp_name'];
			$filesize 		= $_FILES['file_raport']['size'];
			$filetype 		= $_FILES['file_raport']['type'];
			
			if (empty($file_raport)) { 
				$file_raport = $file_raport2; 
			} 
			
			if($file_raport != "") {	
				
				if($file_raport != $file_raport2) {
				
					if(!empty($file_raport2)) {
						if (file_exists($uploaddir . '/' . $file_raport2)) {
							unlink($uploaddir . $file_raport2); //remove file 
						}
					}
					
					$file_raport = $nis . '_' . $file_raport;
				}
							
				$uploadfile = $uploaddir . $file_raport;		
				if (move_uploaded_file($_FILES['file_raport']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			
			//-----------upload file file_raport
			$uploaddir 		= 'app/file_raport/';
			$file_raport2= $_POST["file_raport2"];
			$file_raport = $_FILES['file_raport']['name']; 
			$tmpname  		= $_FILES['file_raport']['tmp_name'];
			$filesize 		= $_FILES['file_raport']['size'];
			$filetype 		= $_FILES['file_raport']['type'];
			
			if (empty($file_raport)) { 
				$file_raport = $file_raport2; 
			} 
			
			if($file_raport != "") {	
				
				if($file_raport != $file_raport2) {
				
					if(!empty($file_raport2)) {
						if (file_exists($uploaddir . '/' . $file_raport2)) {
							unlink($uploaddir . $file_raport2); //remove file 
						}
					}
					
					$file_raport = $nis . '_' . $file_raport;
				}
							
				$uploadfile = $uploaddir . $file_raport;		
				if (move_uploaded_file($_FILES['file_raport']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			//-----------upload file file_kk
			$uploaddir 		= 'app/file_kk/';
			$file_kk2= $_POST["file_kk2"];
			$file_kk = $_FILES['file_kk']['name']; 
			$tmpname  		= $_FILES['file_kk']['tmp_name'];
			$filesize 		= $_FILES['file_kk']['size'];
			$filetype 		= $_FILES['file_kk']['type'];
			
			if (empty($file_kk)) { 
				$file_kk = $file_kk2; 
			} 
			
			if($file_kk != "") {	
				
				if($file_kk != $file_kk2) {
				
					if(!empty($file_kk2)) {
						if (file_exists($uploaddir . '/' . $file_kk2)) {
							unlink($uploaddir . $file_kk2); //remove file 
						}
					}
					
					$file_kk = $nis . '_' . $file_kk;
				}
							
				$uploadfile = $uploaddir . $file_kk;		
				if (move_uploaded_file($_FILES['file_kk']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			
			//-----------upload file file_akte
			$uploaddir 		= 'app/file_akte/';
			$file_akte2= $_POST["file_akte2"];
			$file_akte = $_FILES['file_akte']['name']; 
			$tmpname  		= $_FILES['file_akte']['tmp_name'];
			$filesize 		= $_FILES['file_akte']['size'];
			$filetype 		= $_FILES['file_akte']['type'];
			
			if (empty($file_akte)) { 
				$file_akte = $file_akte2; 
			} 
			
			if($file_akte != "") {	
				
				if($file_akte != $file_akte2) {
				
					if(!empty($file_akte2)) {
						if (file_exists($uploaddir . '/' . $file_akte2)) {
							unlink($uploaddir . $file_akte2); //remove file 
						}
					}
					
					$file_akte = $nis . '_' . $file_akte;
				}
							
				$uploadfile = $uploaddir . $file_akte;		
				if (move_uploaded_file($_FILES['file_akte']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			//-----------upload file file_ijazah
			$uploaddir 		= 'app/file_ijazah/';
			$file_ijazah2= $_POST["file_ijazah2"];
			$file_ijazah = $_FILES['file_ijazah']['name']; 
			$tmpname  		= $_FILES['file_ijazah']['tmp_name'];
			$filesize 		= $_FILES['file_ijazah']['size'];
			$filetype 		= $_FILES['file_ijazah']['type'];
			
			if (empty($file_ijazah)) { 
				$file_ijazah = $file_ijazah2; 
			} 
			
			if($file_ijazah != "") {	
				
				if($file_ijazah != $file_ijazah2) {
				
					if(!empty($file_ijazah2)) {
						if (file_exists($uploaddir . '/' . $file_ijazah2)) {
							unlink($uploaddir . $file_ijazah2); //remove file 
						}
					}
					
					$file_ijazah = $nis . '_' . $file_ijazah;
				}
							
				$uploadfile = $uploaddir . $file_ijazah;		
				if (move_uploaded_file($_FILES['file_ijazah']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			
			//-----------upload file file_nhun
			$uploaddir 		= 'app/file_nhun/';
			$file_nhun2= $_POST["file_nhun2"];
			$file_nhun = $_FILES['file_nhun']['name']; 
			$tmpname  		= $_FILES['file_nhun']['tmp_name'];
			$filesize 		= $_FILES['file_nhun']['size'];
			$filetype 		= $_FILES['file_nhun']['type'];
			
			if (empty($file_nhun)) { 
				$file_nhun = $file_nhun2; 
			} 
			
			if($file_nhun != "") {	
				
				if($file_nhun != $file_nhun2) {
				
					if(!empty($file_nhun2)) {
						if (file_exists($uploaddir . '/' . $file_nhun2)) {
							unlink($uploaddir . $file_nhun2); //remove file 
						}
					}
					
					$file_nhun = $nis . '_' . $file_nhun;
				}
							
				$uploadfile = $uploaddir . $file_nhun;		
				if (move_uploaded_file($_FILES['file_nhun']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			$sqlstr = "update siswa set nis='$nis', nisn='$nisn', nik='$nik', idangkatan='$idangkatan', idangkatan1='$idangkatan1', foto_file='$foto_file', nama='$nama', panggilan='$panggilan', idkelas='$idkelas', tglmasuk='$tglmasuk', kelamin='$kelamin', tmplahir='$tmplahir', tgllahir='$tgllahir', agama='$agama', warga='$warga', anakke='$anakke', jsaudara='$jsaudara', jtiri='$jtiri', jangkat='$jangkat', yatim='$yatim', bahasa='$bahasa', desa_kode='$desa_kode', kecamatan_kode='$kecamatan_kode', kota_kode='$kota_kode', provinsi_kode='$provinsi_kode', alamatsiswa='$alamatsiswa', rt_siswa='$rt_siswa', rw_siswa='$rw_siswa', dusun='$dusun', desa='$desa', kecamatan='$kecamatan', kodepossiswa='$kodepossiswa', alamatortu='$alamatortu', telponsiswa='$telponsiswa', hpsiswa='$hpsiswa', emailsiswa='$emailsiswa', jenistinggal='$jenistinggal', kps='$kps', nokps='$nokps', kip='$kip', nokip='$nokip', namakip='$namakip', nokks='$nokks', no_akte_lahir='$no_akte_lahir', telponortu='$telponortu', hportu='$hportu', hpibu='$hpibu', transportasi_kode='$transportasi_kode', transportasi_lain='$transportasi_lain', jaraksekolah='$jaraksekolah', kesekolah='$kesekolah', berat='$berat', tinggi='$tinggi', kesehatan='$kesehatan', darah='$darah', file_darah='$file_darah', kelainan='$kelainan', asalsekolah_id='$asalsekolah_id', kota_asalsekolah='$kota_asalsekolah', tglijazah='$tglijazah', noijazah='$noijazah', tglskhun='$tglskhun', skhun='$skhun', noujian='$noujian', nisnasal='$nisnasal', nik_ayah='$nik_ayah', namaayah='$namaayah', nik_ibu='$nik_ibu', namaibu='$namaibu', tmplahirayah='$tmplahirayah', tgllahirayah='$tgllahirayah', tempat_bekerja_ayah='$tempat_bekerja_ayah', tmplahiribu='$tmplahiribu', tgllahiribu='$tgllahiribu', pekerjaanayah='$pekerjaanayah', pekerjaanibu='$pekerjaanibu', penghasilanayah_kode='$penghasilanayah_kode', penghasilanayah='$penghasilanayah', penghasilanibu_kode='$penghasilanibu_kode', penghasilanibu='$penghasilanibu', pendidikanayah='$pendidikanayah', pendidikanibu='$pendidikanibu', tempat_bekerja_ibu='$tempat_bekerja_ibu', wnayah='$wnayah', wnibu='$wnibu', nik_wali='$nik_wali', wali='$wali', tmplahirwali='$tmplahirwali', tgllahirwali='$tgllahirwali', pendidikanwali='$pendidikanwali', pekerjaanwali='$pekerjaanwali', penghasilanwali_kode='$penghasilanwali_kode', penghasilanwali='$penghasilanwali', tempat_bekerja_wali='$tempat_bekerja_wali', alamatwali='$alamatwali', hpwali='$hpwali', hubungansiswa='$hubungansiswa', pekerjaanayah_lain='$pekerjaanayah_lain', pekerjaanibu_lain='$pekerjaanibu_lain', pekerjaanwali_lain='$pekerjaanwali_lain', rombel_id='$rombel_id', nama_bank='$nama_bank', no_rekening_bank='$no_rekening_bank', nama_pemilik_bank='$nama_pemilik_bank', pip='$pip', alasan_pip='$alasan_pip', idminat='$idminat', jalurmasuk='$jalurmasuk', jalurmasuk_id='$jalurmasuk_id', jalurmasukprestasi_id='$jalurmasukprestasi_id', file_rekam_bk='$file_rekam_bk', file_memo_ortu='$file_memo_ortu', file_nilai_un = '$file_nilai_un', file_raport='$file_raport', file_kk='$file_kk', file_akte='$file_akte', file_ijazah='$file_ijazah', file_nhun='$file_nhun', uid2='$uid', aktif='$aktif', ts='$dlu', tahun_ijazah='$tahun_ijazah', tahunskhun='$tahunskhun', kebutuhan_khusus_chk='$kebutuhan_khusus_chk', jenis_tinggal='$jenis_tinggal', kebutuhan_khusus_chk1='$kebutuhan_khusus_chk1', kebutuhan_khusus='$kebutuhan_khusus', citacita='$citacita', citacita_lain='$citacita_lain', tahunayah='$tahunayah', kodeposortu='$kodeposortu', butuhkhususketayah='$butuhkhususketayah', tahunibu='$tahunibu', kodeposibu='$kodeposibu', butuhkhususibu='$butuhkhususibu', butuhkhususketibu='$butuhkhususketibu', tahunwali='$tahunwali', jarak_km='$jarak_km', waktutempuh='$waktutempuh', waktutempuh_menit='$waktutempuh_menit', almayah='$almayah', butuhkhususayah='$butuhkhususayah', almibu='$almibu', alamatibu='$alamatibu', dlu2='$dlu' where replid='$ref'";
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
			} else {
				$sqlstr = "update siswa_virtualaccount set virtualaccount='$virtualaccount' where nis='$nis'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
			
			/*------------siswa prestasi-------------*/
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($x=0; $x<=$jmldata; $x++) {
				$delete 			= (empty($_POST[delete_.$x])) ? 0 : $_POST[delete_.$x];
				$old_line		 	= 	(empty($_POST[old_line_.$x])) ? 0 : $_POST[old_line_.$x];
				
				$jenisprestasi_ 	=	$_POST[jenisprestasi_.$x];
				$tingkat_ 			=	$_POST[tingkat_.$x];
				$nama_			 	=	$_POST[nama_.$x];
				$tahun_			 	=	(empty($_POST[tahun_.$x])) ? 0 : $_POST[tahun_.$x];
				$penyelenggara_		=	$_POST[penyelenggara_.$x];
				
				if ( $jenisprestasi_ != "" ) {
					
					$sqlcek = "select idsiswa from siswa_prestasi where idsiswa='$replid' and line='$old_line' ";										
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							$sqlstr="update siswa_prestasi set jenisprestasi='$jenisprestasi_', tingkat='$tingkat_', nama='$nama_', tahun='$tahun_', penyelenggara='$penyelenggara_' where idsiswa='$replid' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
						} else {
							$sqlstr="delete from siswa_prestasi where idsiswa='$replid' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();							
						}
						
						
					} else {
						
						$line = maxline('siswa_prestasi', 'line', 'idsiswa', $replid, '');
				
						$sqlstr = "insert into siswa_prestasi (idsiswa, jenisprestasi, tingkat, nama, tahun, penyelenggara, line) values ('$replid', '$jenisprestasi_', '$tingkat_', '$nama_', '$tahun_', '$penyelenggara_', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
											
					}
					
				}
			}
			
			
			
			/*------------siswa beasiswa-------------*/
			$jmldata2 = (empty($_POST['jmldata2'])) ? 0 : $_POST['jmldata2'];
			
			for ($x=0; $x<=$jmldata2; $x++) {
				$delete2 			= 	(empty($_POST[delete2_.$x])) ? 0 : $_POST[delete2_.$x];
				$old_line2		 	= 	(empty($_POST[old_line2_.$x])) ? 0 : $_POST[old_line2_.$x];
				
				$jenis_ 			=	$_POST[jenis_.$x];
				$penyelenggara2_	=	$_POST[penyelenggara2_.$x];
				$tahunmulai_	 	=	(empty($_POST[tahunmulai_.$x])) ? 0 : $_POST[tahunmulai_.$x];
				$tahunselesai_	 	=	(empty($_POST[tahunselesai_.$x])) ? 0 : $_POST[tahunselesai_.$x];
				
				if ( $jenis_ != "" ) {
					
					$sqlcek = "select idsiswa from siswa_beasiswa where idsiswa='$replid' and line='$old_line2' ";					
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					
					if($num > 0) {
						if($delete2 == 0) {
							$sqlstr="update siswa_beasiswa set jenis='$jenis_', penyelenggara='$penyelenggara2_', tahunmulai='$tahunmulai_', tahunselesai='$tahunselesai_' where idsiswa='$replid' and line=$old_line2";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
						} else {
							$sqlstr="delete from siswa_beasiswa where idsiswa='$replid' and line=$old_line2";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();							
						}
						
						
					} else {
						
						$line = maxline('siswa_beasiswa', 'line', 'idsiswa', $replid, '');
				
						$sqlstr = "insert into siswa_beasiswa (idsiswa, jenis, penyelenggara, tahunmulai, tahunselesai, line) values ('$replid', '$jenis_', '$penyelenggara2_', '$tahunmulai_', '$tahunselesai_', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
											
					}
					
				}
			}
			
			
			/*------------siswa nilai UN-------------*/
			$jmldata_un = (empty($_POST['jmldata_un'])) ? 0 : $_POST['jmldata_un'];		
			for ($x=0; $x<=$jmldata_un; $x++) {
				$replid_un3 		=	$_POST[replid_un3_.$x];
				$pelajaran_id3		=	$replid_un3;
				$nilai3				=	numberreplace($_POST[nilai3_.$x]);
				
				if ( !empty($replid_un3) ) {
					$sqlcek = "select nis from siswa_nilai_un where nis='$nis' and pelajaran_id='$pelajaran_id3'";
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					if($num > 0) {
						$sqlstr="update siswa_nilai_un set nilai='$nilai3' where nis='$nis' and pelajaran_id='$pelajaran_id3'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$line = maxline('siswa_nilai_un', 'line', 'nis', $nis, '');				
						$sqlstr = "insert into siswa_nilai_un (nis, pelajaran_id, nilai, line) values ('$nis', '$pelajaran_id3', '$nilai3', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();						
					}
				}
			}
			
			
			//----------update raport semester-3
			$jmldata_raport = (empty($_POST['jmldata_raport'])) ? 0 : $_POST['jmldata_raport'];		
			for ($x=0; $x<=$jmldata_raport; $x++) {
				$replid_un 			=	$_POST[replid_un_.$x];
				$pelajaran_id		=	$replid_un;
				$nilai				=	numberreplace($_POST[nilai_.$x]);
				
				if ( !empty($replid_un) ) {
					$sqlcek = "select nis from siswa_nilai_raport where nis='$nis' and pelajaran_id='$pelajaran_id' and semester=3";
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					if($num > 0) {
						$sqlstr="update siswa_nilai_raport set nilai='$nilai' where nis='$nis' and pelajaran_id='$pelajaran_id' and semester=3";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {					
						$line = maxline('siswa_nilai_raport', 'line', 'nis', $nis, '');
						$sqlstr = "insert into siswa_nilai_raport (nis, semester, pelajaran_id, nilai, line) values ('$nis', '3', '$pelajaran_id', '$nilai', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
				}
			}
			
			
			//----------update raport semester-4
			$jmldata_raport1 = (empty($_POST['jmldata_raport1'])) ? 0 : $_POST['jmldata_raport1'];		
			for ($x=0; $x<=$jmldata_raport1; $x++) {
				$replid_un1			=	$_POST[replid_un1_.$x];
				$pelajaran_id1		=	$replid_un1;
				$nilai1				=	numberreplace($_POST[nilai1_.$x]);
				
				if ( !empty($replid_un1) ) {
					$sqlcek = "select nis from siswa_nilai_raport where nis='$nis' and pelajaran_id='$pelajaran_id1' and semester=4";
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					if($num > 0) {
						$sqlstr="update siswa_nilai_raport set nilai='$nilai1' where nis='$nis' and pelajaran_id='$pelajaran_id1' and semester=4";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$line = maxline('siswa_nilai_raport', 'line', 'nis', $nis, '');
						$sqlstr = "insert into siswa_nilai_raport (nis, semester, pelajaran_id, nilai, line) values ('$nis', '4', '$pelajaran_id1', '$nilai1', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
				}
			}
			
			
			//----------update raport semester-5
			$jmldata_raport2 = (empty($_POST['jmldata_raport2'])) ? 0 : $_POST['jmldata_raport2'];		
			for ($x=0; $x<=$jmldata_raport2; $x++) {
				$replid_un2			=	$_POST[replid_un2_.$x];
				$pelajaran_id2		=	$replid_un2;
				$nilai2				=	numberreplace($_POST[nilai2_.$x]);
				
				if ( !empty($replid_un2) ) {
					$sqlcek = "select nis from siswa_nilai_raport where nis='$nis' and pelajaran_id='$pelajaran_id2' and semester=5";
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					if($num > 0) {
						$sqlstr="update siswa_nilai_raport set nilai='$nilai2' where nis='$nis' and pelajaran_id='$pelajaran_id2' and semester=5";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$line = maxline('siswa_nilai_raport', 'line', 'nis', $nis, '');
						$sqlstr = "insert into siswa_nilai_raport (nis, semester, pelajaran_id, nilai, line) values ('$nis', '5', '$pelajaran_id2', '$nilai2', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
				}
			}
			
			//update tgl alumni
			$tgllulus	=	date("Y-m-d", strtotime($_POST["tgllulus"]));
			$sqlstr = "update alumni set tgllulus='$tgllulus' where nis='$nis'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}


	//-----update receipt
	function update_receipt($ref){
		$dbpdo = DB::create();
		
		try {
		
			$date			=	date("Y-m-d", strtotime($_POST["date"]));
			$client_code	=	$_POST["client_code"];
			$memo			= 	$_POST["memo"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			//----------update sales_order detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($i=0; $i<=$jmldata; $i++) {
				$delete 		= (empty($_POST[delete_.$i])) ? 0 : $_POST[delete_.$i];
				
				$old_invoice_no	 	= $_POST[old_invoice_no_.$i];
				$old_line		 	= (empty($_POST[old_line_.$i])) ? 0 : $_POST[old_line_.$i];
				
				$invoice_no 	= $_POST[invoice_no_.$i];
				$amount_paid 	= numberreplace($_POST[amount_paid_.$i]);
				
				if ( !empty($invoice_no) ) {	
					$invoice_date		= date("Y-m-d", strtotime($_POST[invoice_date_.$i]));
					$invoice_due_date	= date("Y-m-d", strtotime($_POST[invoice_due_date_.$i]));
					$amount_due		= numberreplace($_POST[amount_due_.$i]);
					$discount 		= numberreplace($_POST[discount_.$i]);
					$currency_code 	= $_POST[currency_code_.$i];					
					$rate			= numberreplace($_POST[rate_.$i]);
					$ref_type		= $_POST[transaction_.$i];				
					$amount_due		= numberreplace($_POST[amount_due_.$i]);
					$amount 		= $amount_paid - $discount;
					
					$sqlstr = "select ref from receipt_detail where ref='$ref' and invoice_no='$old_invoice_no' and line='$old_line' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							$sqlstr="update receipt_detail set invoice_no='$invoice_no', invoice_date='$invoice_date', invoice_due_date='$invoice_due_date', discount='$discount', amount_paid='$amount_paid', invoice_currency_code='$invoice_currency_code', invoice_rate='$rate', amount_due='$amount_due', amount='$amount' where ref='$ref' and invoice_no='$old_invoice_no' and line='$old_line'";						
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							//update AR
							$sqlstr="update ar set invoice_no='$invoice_no', date='$date', due_date='$invoice_due_date', contact_code='$client_code', credit_amount='$amount', discount_amount='$discount', currency_code='$currency_code', rate='$rate', description='$memo', uid='$uid', dlu='$dlu' where ref='$ref' and invoice_no='$old_invoice_no' and invoice_type='RCI' and ref_type='$ref_type' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							//update DPS (Deposit)
							if($amount < 0) {
								$credit = $amount * -1;
								
								$dpscek = "select ref from dps where ref='$ref' and invoice_no='$old_invoice_no' and invoice_type='RCI' and ref_type='RCI' ";
								$sql=$dbpdo->prepare($dpscek);
								$sql->execute();
								$rowsdps = $sql->rowCount();
							
								if($rowsdps > 0 ) {
									$sqlstr="update dps set invoice_no='$invoice_no', date='$date', contact_code='$client_code', credit_amount='$credit', currency_code='$currency_code', rate='$rate', description='$memo', uid='$uid', dlu='$dlu' where ref='$ref' and invoice_no='$old_invoice_no' and invoice_type='RCI' and ref_type='RCI' ";
									$sql=$dbpdo->prepare($sqlstr);
									$sql->execute();
								}
								
							}
							
							
						} else {
							$sqlstr="delete from receipt_detail where ref='$ref' and invoice_no='$old_invoice_no' and line='$old_line' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							//delete AR
							$sqlstr="delete from ar where ref='$ref' and invoice_no='$old_invoice_no' and invoice_type='RCI' and ref_type='$ref_type' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							//delete DPS
							$sqlstr="delete from dps where ref='$ref' and invoice_no='$old_invoice_no' and invoice_type='RCI' and ref_type='$ref_type' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();	
												
						}
						
						
					} else {
						$line = maxline('receipt_detail', 'line', 'ref', $ref, '');
						
						$sqlstr="insert into receipt_detail (ref, invoice_no, invoice_date, invoice_due_date, discount, amount_paid, invoice_currency_code, invoice_rate, ref_type, amount_due, amount, line) values ('$ref', '$invoice_no', '$invoice_date', '$invoice_due_date', '$discount', '$amount_paid', '$currency_code', '$rate', '$ref_type', '$amount_due', '$amount', $line)";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						if($ref_type != "DPS") {
							//insert AR
							$sqlstr="insert into ar(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, discount_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu) values('$ref', '$invoice_no', '$date', '$invoice_due_date', 'C', '$client_code', '', 0, '$amount', '$discount', 'RCI', '$ref_type', '$currency_code', '$rate', '', '', 'C.O.D', '$memo', '$uid', '$dlu')";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						}
						
						
						//insert DPS
						if($ref_type == "DPS") {
							if($amount < 0) {
								
								$credit = $amount * -1;
								
								$sqlstr="insert into dps(ref, invoice_no, date, contact_type, contact_code, contact_other, debit_amount, credit_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu) values('$ref', '$invoice_no', '$date', 'C', '$client_code', '', 0, '$credit', 'RCI', 'RCI', '$currency_code', '$rate', '', '', 'C.O.D', '$memo', '$uid', '$dlu')";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();	
							}
						}
						
						
					}
					
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
			/*include_once ($__folder."app/include/function_crop.php");
			//include_once ("app/include/function_crop.php");
			
			$file_transfer	= 	$_POST["file_transfer"];
			$photo			=	$_FILES['file_transfer']['name'];
			$photo2			=	$_POST["file_transfer2"];
			if($photo != "") {
				if(!empty($photo2)) {
					$filename = $__folder.'app/file_transfer/' . $photo2;
					
					if (file_exists($filename)) { unlink($__folder.'app/file_transfer/' . $photo2); } //remove file
				}
					
				$photo1 = resize_image('file_transfer', '', $__folder.'app/file_transfer/', '', $ref, $photo_file);
	  			$photo_file = $photo1;
			} else {
				$photo_file	=	$photo2;
			}*/
			
			$sqlstr="update receipt set date='$date', status='$status', client_code='$client_code', receipt_type='$receipt_type', cheque_no='$cheque_no', cheque_date='$cheque_date', bank_name='$bank_name', credit_card_no='$credit_card_no', credit_card_code='$credit_card_code', credit_card_holder='$credit_card_holder', credit_card_expired='$credit_card_expired', account_code='$account_code', currency_code='$currency_code', rate='$rate', amount='$amount', deposit='$deposit', sub_total='$sub_total', type='$type', memo='$memo', round_amount='$round_amount', round_amount_account='$round_amount_account', bank_charge='$bank_charge', bank_charge_account='$bank_charge_account', total='$total', uid='$uid', dlu='$dlu' where ref='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			if($receipt_type == "giro" || $receipt_type == "cheque") {
				
				//insert ARC
				$sqlstr="update arc date='$date', client_code='$client_code', cheque_no='$cheque_no', bank_name='$bank_name', cheque_date='$cheque_date', amount='$total', currency_code='$currency_code', rate='$rate', account_code='$account_code', memo='$memo', uid='$uid', dlu='$dlu' where type='$receipt_type' and ref='$ref'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();				
				
			}
			
			
			//update DPS (Deposit)
			if($deposit < 0) {
				
				$debit = $deposit * -1;
				
				$dpscek = "select ref from dps where ref='$ref' and invoice_no='$ref' and invoice_type='RCI' and ref_type='RCI' ";
				$sql=$dbpdo->prepare($dpscek);
				$sql->execute();
				$rowsdps = $sql->rowCount();
				
				if($rowsdps > 0) {
					$sqlstr="update dps set invoice_no='$ref', date='$date', contact_code='$client_code', debit_amount='$debit', currency_code='$currency_code', rate='$rate', description='$memo', uid='$uid', dlu='$dlu' where ref='$ref' and invoice_no='$ref' and invoice_type='RCI' and ref_type='RCI' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				} else {
					$sqlstr="insert into dps (ref, invoice_no, date, contact_code, contact_type, debit_amount, currency_code, rate, description, invoice_type, ref_type, uid, dlu) values ('$ref', '$ref', '$date', '$client_code', 'C', '$debit', '$currency_code', '$rate', '$memo', 'RCI', 'RCI', '$uid', '$dlu') ";
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
	

	//------update general journal in
	function update_general_journal_in($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
						
			$date		=	date('Y-m-d', strtotime($_POST["date"]));
			$status		= 	$_POST["status"];
			$currency_code		= 	$_POST["currency_code"];
			$rate		=	str_replace(",","",(empty($_POST["rate"])) ? 0 : $_POST["rate"]);
			$memo		= 	$_POST["memo"];
			$total_balance		=	str_replace(",","",(empty($_POST["total_balance"])) ? 0 : $_POST["total_balance"]);
			$total_debit		=	str_replace(",","",(empty($_POST["total_debit"])) ? 0 : $_POST["total_debit"]);
			$total_credit		=	str_replace(",","",(empty($_POST["total_credit"])) ? 0 : $_POST["total_credit"]);
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<=$jmldata; $i++) {
				
				$old_account_code	= $_POST["old_account_code_".$i.""];
				$old_line			= (empty($_POST["old_line_".$i.""])) ? 0 : $_POST["old_line_".$i.""];
				
				$account_code 		= $_POST["account_code_".$i.""];
				$memo2 				= $_POST["memo_".$i.""];
				$debit_amount		= str_replace(",","",(empty($_POST["debit_amount_".$i.""])) ? 0 : $_POST["debit_amount_".$i.""]);
				$credit_amount		= str_replace(",","",(empty($_POST["credit_amount_".$i.""])) ? 0 : $_POST["credit_amount_".$i.""]);
				if ($account_code != '') { 		
					
					$sqlstr = "select ref from general_journal_detail where ref='$ref' and account_code='$old_account_code' and line='$old_line' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						$sqlstr = "update general_journal_detail set account_code='$account_code', memo='$memo2', debit_amount='$debit_amount', credit_amount='$credit_amount' where ref='$ref' and account_code='$old_account_code' and line='$old_line' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$line = maxline('general_journal_detail', 'line', 'ref', $ref, '');
					
						$sqlstr = "insert into general_journal_detail(ref, account_code, memo, debit_amount, credit_amount, location_id, line) values('$ref', '$account_code', '$memo2', '$debit_amount', '$credit_amount', '0', '$line') ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
					}
					
				}
				
			}
			
			$sqlstr = "update general_journal set date='$date', status='$status', currency_code='$currency_code', rate='$rate', memo='$memo', total_balance='$total_balance', total_debit='$total_debit', total_credit='$total_credit', uid='$uid', dlu='$dlu' where  ref='$ref'";
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
	
	
	//-----update fiannce type
	function update_finance_type($id){
		$dbpdo = DB::create();
		
		try {
			
			$code			=	$_POST["code"];
	        $name			=	petikreplace($_POST["name"]);
	        $location_id	=	(empty($_POST["location_id"])) ? 0 : $_POST["location_id"];
	        $type			=	$_POST["type"];
	        $account_code	=	$_POST["account_code"];
	        $active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="update finance_type set name='$name', location_id='$location_id', type='$type', account_code='$account_code', active='$active', uid='$uid', dlu='$dlu' where id='$id'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//------update general journal
	function update_general_journal($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
						
			$date		=	date('Y-m-d', strtotime($_POST["date"]));
			$status		= 	$_POST["status"];
			$currency_code		= 	$_POST["currency_code"];
			$rate		=	str_replace(",","",(empty($_POST["rate"])) ? 0 : $_POST["rate"]);
			$memo		= 	$_POST["memo"];
			$total_balance		=	str_replace(",","",(empty($_POST["total_balance"])) ? 0 : $_POST["total_balance"]);
			$total_debit		=	str_replace(",","",(empty($_POST["total_debit"])) ? 0 : $_POST["total_debit"]);
			$total_credit		=	str_replace(",","",(empty($_POST["total_credit"])) ? 0 : $_POST["total_credit"]);
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<=$jmldata; $i++) {
				
				$old_account_code	= $_POST["old_account_code_".$i.""];
				$old_line			= (empty($_POST["old_line_".$i.""])) ? 0 : $_POST["old_line_".$i.""];
				
				$location_id 		= 0; //$_POST["location_id_".$i.""];
				$account_code 		= $_POST["account_code_".$i.""];
				$memo2 				= $_POST["memo_".$i.""];
				$debit_amount		= str_replace(",","",(empty($_POST["debit_amount_".$i.""])) ? 0 : $_POST["debit_amount_".$i.""]);
				$credit_amount		= str_replace(",","",(empty($_POST["credit_amount_".$i.""])) ? 0 : $_POST["credit_amount_".$i.""]);
				if ($account_code != '') { 		
					
					$sqlstr = "select ref from general_journal_detail where ref='$ref' and account_code='$old_account_code' and line='$old_line' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						$sqlstr = "update general_journal_detail set account_code='$account_code', memo='$memo2', debit_amount='$debit_amount', credit_amount='$credit_amount' where ref='$ref' and account_code='$old_account_code' and line='$old_line' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$line = maxline('general_journal_detail', 'line', 'ref', $ref, '');
					
						$sqlstr = "insert into general_journal_detail(ref, location_id, account_code, memo, debit_amount, credit_amount, line) values('$ref', '$location_id', '$account_code', '$memo2', '$debit_amount', '$credit_amount', '$line') ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
					}
					
				}
				
			}
			
			$sqlstr = "update general_journal set date='$date', status='$status', currency_code='$currency_code', rate='$rate', memo='$memo', total_balance='$total_balance', total_debit='$total_debit', total_credit='$total_credit', uid='$uid', dlu='$dlu' where  ref='$ref'";
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
	

	//-----update coa
	function update_coa($ref){
		$dbpdo = DB::create();
		
		try {
			
			$acc_code			=	$_POST["acc_code"];
			$name				=	$_POST["name"];
			$acc_type			=	(empty($_POST["acc_type"])) ? 0 : $_POST["acc_type"];
			$postable			=	(empty($_POST["postable"])) ? 0 : $_POST["postable"];
			$subacc_code		=	$_POST["subacc_code"];
			
			$opening_balance_old=	numberreplace((empty($_POST["opening_balance_old"])) ? 0 : $_POST["opening_balance_old"]);
			$opening_balance	=	numberreplace((empty($_POST["opening_balance"])) ? 0 : $_POST["opening_balance"]);
			$opening_balance_date	= date("Y-m-d", strtotime($_POST["opening_balance_date"]));
			//$current_balance	=	(empty($_POST["current_balance"])) ? 0 : $_POST["current_balance"];
			//$current_balance	= 	$current_balance - $opening_balance_old + $opening_balance;
			
			$currency_code		=	(empty($_POST["currency_code"])) ? 0 : $_POST["currency_code"];
			$currency_rate		=	(empty($_POST["currency_rate"])) ? 0 : $_POST["currency_rate"];
			$currency_exchange_id		=	(empty($_POST["currency_exchange_id"])) ? 0 : $_POST["currency_exchange_id"];
			$level			=	(empty($_POST["level"])) ? 0 : $_POST["level"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");	
			
			$sqlstr="update coa set acc_code='$acc_code', name='$name', acc_type='$acc_type', postable='$postable', subacc_code='$subacc_code', opening_balance='$opening_balance', opening_balance_date='$opening_balance_date', current_balance=ifnull(current_balance,0) - $opening_balance_old + $opening_balance, currency_code='$currency_code', currency_rate='$currency_rate', currency_exchange_id='$currency_exchange_id', level='$level', uid='$uid', dlu='$dlu', active='$active' where syscode='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}


	//-----update purchase inv
	function update_purchase_inv($ref){
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			$old_location_id	=	(empty($_POST["old_location_id"])) ? 0 : $_POST["old_location_id"];
			
			$date				=	date("Y-m-d", strtotime($_POST["date"]));
			$location_id		=	(empty($_POST["location_id"])) ? 0 : $_POST["location_id"];
			$stock_in			= 	(empty($_POST["stock_in"])) ? 0 : $_POST["stock_in"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			//----------update item return detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($i=0; $i<=$jmldata; $i++) {
				$delete 		= (empty($_POST["delete_".$i.""])) ? 0 : $_POST["delete_".$i.""];
				
				$old_item_code	 	= $_POST["old_item_code_".$i.""];
				$old_uom_code 		= $_POST["old_uom_code_".$i.""];
				$old_qty 			= numberreplace($_POST["old_qty_".$i.""]);
				$old_line		 	= (empty($_POST["old_line_".$i.""])) ? 0 : $_POST["old_line_".$i.""];
				
				$item_code3	 	= $_POST["item_code3_".$i.""];
				$item_code	 	= $_POST["item_code_".$i.""];
				$uom_code 		= $_POST["uom_code_".$i.""];
				$qty 			= numberreplace($_POST["qty_".$i.""]);
				$unit_cost 		= numberreplace($_POST["unit_cost_".$i.""]);
				$amount 		= numberreplace($_POST["amount_".$i.""]); 
				
				//jika add item baru
				if($item_code3 != "") {
					$sqlstr = "select syscode, uom_code_purchase uom_code from item where (code='$item_code3' or old_code='$item_code3') limit 1 ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$data = $sql->fetch(PDO::FETCH_OBJ);
					
					$item_code	= $data->syscode;
					$uom_code	= $data->uom_code;
					if($qty == "" || $qty == 0) {
						$qty = 1;
					}
					
					$selectview = new selectview;
					if($unit_cost == "" || $unit_cost == 0) {
						$unit_cost = $selectview->list_purchase_invoice_last_cost($item_code, $uom_code);
					}
					
					if($amount == "" || $amount == 0) {
						$amount = $qty * $unit_cost;
					}
										
				}
				
				if ( !empty($item_code) && !empty($uom_code) ) {
					
					$discount = numberreplace($_POST["discount_".$i.""]);
                	$discount1 = numberreplace($_POST["discount3_1_".$i.""]);
					$discount2 = numberreplace($_POST["discount3_2_".$i.""]);
	                $discount3 = numberreplace($_POST["discount3_3_".$i.""]);
					
					$line_item_po = (empty($_POST["line_item_po_".$i.""])) ? 0 : $_POST["line_item_po_".$i.""];
					
					$sqlstr = "select ref from purchase_invoice_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							
							//jika tidak ada item baru
							$sqlstr="update purchase_invoice_detail set item_code='$item_code', uom_code='$uom_code', qty='$qty', unit_cost='$unit_cost', discount1='$discount1', discount2='$discount2', discount3='$discount3', discount='$discount', amount='$amount' where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							//----------update bincard (debit qty)
							if($stock_in == 1) {
								$sqlstr="select invoice_no from bincard where invoice_no='$ref' and location_code='$old_location_id' and item_code='$old_item_code' and uom_code='$old_uom_code' and line=$old_line and invoice_type='purchase_inv' ";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
								$rows=$sql->rowCount();
								
								if($rows > 0) {
									$sqlstr="update bincard set location_code='$location_id', date='$date', item_code='$item_code', uom_code='$uom_code', unit_price='$unit_cost', debit_qty='$qty', amount='$amount', uid='$uid', dlu='$dlu' where invoice_no='$ref' and location_code='$old_location_id' and item_code='$old_item_code' and uom_code='$old_uom_code' and line=$old_line and invoice_type='purchase_inv' ";
									$sql=$dbpdo->prepare($sqlstr);
									$sql->execute();	
								} else {
									$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'purchase_inv', '', '$item_code', '$uom_code', '00:00:00', '$unit_cost', '$qty', 0, '$amount', '$old_line', '$uid', '$dlu')";						
									$sql=$dbpdo->prepare($sqlstr);
									$sql->execute();
								}
							}
												
								
						} else {
							$sqlstr="delete from purchase_invoice_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();	
							
							//----------delete bincard (debit qty)
							$sqlstr="delete from bincard where invoice_no='$ref' and location_code='$old_location_id' and item_code='$old_item_code' and uom_code='$old_uom_code' and line=$old_line and invoice_type='purchase_inv' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
																		
						}
						
						
					} else {
						$line = maxline('purchase_invoice_detail', 'line', 'ref', $ref, '');
						
						$sqlstr="insert into purchase_invoice_detail (ref, po_ref, item_code, uom_code, qty, unit_cost, amount, line_item_po, line) values ('$ref', '', '$item_code', '$uom_code', '$qty', '$unit_cost', '$amount', '0', $line)";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						//----------insert bincard (debit qty)
						if($stock_in == 1) {
							$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'purchase_inv', '', '$item_code', '$uom_code', '00:00:00', '$unit_cost', '$qty', 0, '$amount', '$line', '$uid', '$dlu')";
							
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						}					
					}
					
					
					
				}
			}
			
			
			//insert new item-------------------\/
			$item_code3		= $_POST['item_code2'];
			$uom_code 		= $_POST['uom_code'];
			$size 			= numberreplace($_POST['size']);
			$qty 			= numberreplace($_POST['qty']);
			$unit_cost 		= numberreplace($_POST['unit_cost']);
			$amount 		= numberreplace($_POST['amount']); 
			
			//jika add item baru
			if($item_code3 != "") {
				
				$sqlstr = "select syscode, uom_code_purchase uom_code from item where (code='$item_code3' or old_code='$item_code3') limit 1 ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$data = $sql->fetch(PDO::FETCH_OBJ);
				
				$item_code	= $data->syscode;
				if($uom_code == "") {
					$uom_code	= $data->uom_code;
				}
				if($qty == "" || $qty == 0) {
					$qty = 1;
				}
				
				$selectview = new selectview;
				if($unit_cost == "" || $unit_cost == 0) {
					$unit_cost = $selectview->list_purchase_invoice_last_cost($item_code, $uom_code);
				}
				
				if($amount == "" || $amount == 0) {
					$amount = $qty * $unit_cost;
				}
									
			}
			
			if ( !empty($item_code) && !empty($uom_code) ) {
				
				$discount		= numberreplace($_POST['discount_det']); //discount nominal
				$discount1		= numberreplace($_POST['discount3_1_det']); //discount %
				
                
                $discount2 = 0;
                $discount3 = 0;
				
				$line_item_po = maxline('purchase_invoice_detail', 'line', 'ref', $ref, '');
				
				$sqlstr = "select ref from purchase_invoice_detail where ref='$ref' and item_code='$item_code' and uom_code='$uom_code' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$num = $sql->rowCount();
				
				if($num > 0) {
					
					$sqlstr = "select sum(qty) qty_old from purchase_invoice_detail where ref='$ref' and item_code='$item_code' and uom_code='$uom_code' group by ref, item_code, uom_code ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$data_qty = $sql->fetch(PDO::FETCH_OBJ);
					$qty_upd = $data_qty->qty_old + $qty;
					$amount_upd = $unit_cost - (($unit_cost * $discount1)/100);
					$amount = $amount_upd * $qty_upd;
					
					$sqlstr="update purchase_invoice_detail set size='$size', qty=ifnull(qty,0) + $qty, unit_cost='$unit_cost', discount1='$discount1', discount2='$discount2', discount3='$discount3', discount='$discount', amount='$amount' where ref='$ref' and item_code='$item_code' and uom_code='$uom_code' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//----------update bincard (debit qty)
					if($stock_in == 1) {
						$sqlstr="update bincard set location_code='$location_id', date='$date', unit_price='$unit_cost', debit_qty=ifnull(debit_qty,0) + $qty, amount='$amount', uid='$uid', dlu='$dlu' where invoice_no='$ref' and location_code='$old_location_id' and item_code='$item_code' and uom_code='$uom_code' and invoice_type='purchase_inv' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}	
					
				} else {
					$line = maxline('purchase_invoice_detail', 'line', 'ref', $ref, '');
					
					$sqlstr="insert into purchase_invoice_detail (ref, po_ref, item_code, uom_code, size, qty, unit_cost, amount, line_item_po, line) values ('$ref', '', '$item_code', '$uom_code', '$size', '$qty', '$unit_cost', '$amount', '0', $line)";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//----------insert bincard (debit qty)
					if($stock_in == 1) {
						$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'purchase_inv', '', '$item_code', '$uom_code', '00:00:00', '$unit_cost', '$qty', 0, '$amount', '$line', '$uid', '$dlu')";
						
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}					
				}	
			}		
			//---------------end item new--------/\
			
			
			
			//-get amount
			$sqlstr = "select sum(amount) amount from purchase_invoice_detail where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			
			$sub_total = $data->amount;
			
			$invoice_no			=	$_POST["invoice_no"];
			$status				= 	$_POST["status"];
			$bill_number		= 	$_POST["bill_number"];
			$vendor_code		= 	$_POST["vendor_code"];
			$top				= 	$_POST["top"];
			$tax_code			= 	$_POST["tax_code"];
			$payment_type		=	$_POST["payment_type"];
			$tax_rate			=	numberreplace((empty($_POST["tax_rate"])) ? 0 : $_POST["tax_rate"]);
			$freight_cost		=	numberreplace((empty($_POST["freight_cost"])) ? 0 : $_POST["freight_cost"]);
			$freight_account	= 	petikreplace($_POST["freight_account"]);
			$memo				= 	petikreplace($_POST["memo"]);		
			$cash				=	(empty($_POST["cash"])) ? 0 : $_POST["cash"];
			$cash_amount		= 	numberreplace($_POST["cash_amount"]);
			$change_amount		=	numberreplace($_POST["change_amount"]);
			$discount 			= 	numberreplace($_POST["discount_det"]);
			$due_date			=	date("Y-m-d", strtotime($_POST["due_date"]));
			$total				=	numberreplace($_POST["total"]); //$sub_total + $freight_cost;
			
			$bank_id			=	(empty($_POST["bank_id"])) ? 0 : $_POST["bank_id"];
			$bank_amount		=	numberreplace($_POST["bank_amount"]);
			$credit_card_code	=	(empty($_POST["credit_card_code"])) ? 0 : $_POST["credit_card_code"];
			$card_amount		=	numberreplace($_POST["card_amount"]);
			$credit_card_no		=	$_POST["credit_card_no"];
			$credit_card_holder	=	petikreplace($_POST["credit_card_holder"]);
			
			//status='$status', 
			$sqlstr="update purchase_invoice set invoice_no='$invoice_no', date='$date', bill_number='$bill_number', vendor_code='$vendor_code', payment_type='$payment_type', top='$top', due_date='$due_date', tax_code='$tax_code', tax_rate='$tax_rate', freight_cost='$freight_cost', freight_account='$freight_account', memo='$memo', discount='$discount', total='$total', cash_amount='$cash_amount', change_amount='$change_amount', bank_id='$bank_id', bank_amount='$bank_amount', credit_card_code='$credit_card_code', card_amount='$card_amount', credit_card_no='$credit_card_no', credit_card_holder='$credit_card_holder', location_id='$location_id', stock_in='$stock_in', uid='$uid', dlu='$dlu' where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
			if($payment_type == "credit" || $payment_type == "consign") {
				//insert AP
				$sqlstr="delete from ap where ref='$ref' and invoice_type='POV' and ref_type='POV' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				$sqlstr="insert into ap(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu) values('$ref', '$ref', '$date', '$due_date', 'V', '$vendor_code', '', 0, '$total', 'POV', 'POV', '$currency_code', '0', '0', '00:00:00', '$top', '$memo', '$uid', '$dlu')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			} else {
				//insert AP
				$sqlstr="delete from ap where ref='$ref' and invoice_type='POV' and ref_type='POV' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
		
			$dbpdo->commit();
		
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
		
		return $sql;
	}
	

	//-----update good receipt
	function update_good_receipt($ref){
		$dbpdo = DB::create();
		
		try {
			
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
			
			//----------update store request detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];			
			for ($i=0; $i<=$jmldata; $i++) {
				$delete 		= (empty($_POST["delete_".$i.""])) ? 0 : $_POST["delete_".$i.""];
				
				$old_item_code	 	= $_POST["old_item_code_".$i.""];
				$old_uom_code 		= $_POST["old_uom_code_".$i.""];
				$old_line		 	= (empty($_POST["old_line_".$i.""])) ? 0 : $_POST["old_line_".$i.""];
				$old_qty			= numberreplace($_POST["old_qty_".$i.""]);
				
				$po_ref 		= $_POST["po_ref_".$i.""];
				$item_code	 	= $_POST["item_code_".$i.""];
				$uom_code 		= $_POST["uom_code_".$i.""];
				$qty 			= numberreplace($_POST["qty_".$i.""]);
				
				if ( !empty($item_code) && !empty($uom_code) ) {
					
					$unit_cost		= numberreplace($_POST["unit_cost_".$i.""]);
					$pi_line		= $_POST["pi_line_".$i.""];
					
					$sqlstr = "select ref from good_receipt_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							$sqlstr="update good_receipt_detail set qty='$qty' where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							$sqlstr="update purchase_invoice_detail set qty_good=ifnull(qty_good,0) - $old_qty + $qty where ref='$po_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$pi_line' ";	
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							##bincard update
							$amount = $unit_cost * $qty;
							$sqlstr="update bincard set unit_price='$unit_cost', debit_qty='$qty', amount='$amount', location_code='$location_id' where invoice_no='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line'";		
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
								
						} else {
							$sqlstr="delete from good_receipt_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();	
							
							##delete update
							$sqlstr = "delete from bincard where invoice_no='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							##--------update qty purchase invoice
							$sqlstr="update purchase_invoice_detail set qty_good=ifnull(qty_good,0) - $old_qty where ref='$po_ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$pi_line' ";	
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
							##*****************************************##							
												
						}
					} 
				}
			}
			
			
			$sqlstr="update good_receipt set date='$date', status='$status', vendor_code='$vendor_code', date_arrival='$date_arrival', driver='$driver', vehicle='$vehicle', location_id='$location_id', do_ref='$do_ref', memo='$memo', receipt_type='$receipt_type', uid2='$uid', dlu2='$dlu' where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	

	//-----update payment
	function update_payment($ref){
		$dbpdo = DB::create();
		
		try {
		
			$date			=	date("Y-m-d", strtotime($_POST["date"]));
			$vendor_code	=	$_POST["vendor_code"];
			$memo			= 	$_POST["memo"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
						
			//----------update sales_order detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($i=0; $i<=$jmldata; $i++) {
				$delete 		= (empty($_POST["delete_".$i.""])) ? 0 : $_POST["delete_".$i.""];
				
				$old_invoice_no	 	= $_POST["old_invoice_no_".$i.""];
				$old_line		 	= (empty($_POST["old_line_".$i.""])) ? 0 : $_POST["old_line_".$i.""];
				
				$invoice_no 	= $_POST["invoice_no_".$i.""];
				$amount_paid 	= numberreplace($_POST["amount_paid_".$i.""]);
				
				if ( !empty($invoice_no) ) {	
					$invoice_date		= date("Y-m-d", strtotime($_POST["invoice_date_".$i.""]));
					$invoice_due_date	= date("Y-m-d", strtotime($_POST["invoice_due_date_".$i.""]));
					$amount_due		= numberreplace($_POST["amount_due_".$i.""]);
					$discount 		= numberreplace($_POST["discount_".$i.""]);
					$currency_code 	= $_POST["currency_code_".$i.""];					
					$rate			= numberreplace($_POST["rate_".$i.""]);
					$ref_type		= $_POST["transaction_".$i.""];				
					$amount_due		= numberreplace($_POST["amount_due_".$i.""]);
					$amount 		= $amount_paid - $discount;
					
					$sqlstr = "select ref from payment_detail where ref='$ref' and invoice_no='$old_invoice_no' and line='$old_line' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							$sqlstr="update payment_detail set invoice_no='$invoice_no', invoice_date='$invoice_date', invoice_due_date='$invoice_due_date', discount='$discount', amount_paid='$amount_paid', invoice_currency_code='$invoice_currency_code', invoice_rate='$rate', amount_due='$amount_due', amount='$amount' where ref='$ref' and invoice_no='$old_invoice_no' and line='$old_line'";			
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							//update AP
							if($ref_type == 'PIR') {
								##credit
								if($amount < 0) {
									$amount_credit = $amount * -1;
								}
								$sqlstr="update ap set invoice_no='$invoice_no', date='$date', due_date='$invoice_due_date', contact_code='$vendor_code', credit_amount='$amount_credit', discount_amount='$discount', currency_code='$currency_code', rate='$rate', description='$memo', uid='$uid', dlu='$dlu' where ref='$ref' and invoice_no='$old_invoice_no' and invoice_type='PMT' and ref_type='$ref_type' and line='$old_line' ";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();	
							} else {
								##debit
								$sqlstr="update ap set invoice_no='$invoice_no', date='$date', due_date='$invoice_due_date', contact_code='$vendor_code', debit_amount='$amount', discount_amount='$discount', currency_code='$currency_code', rate='$rate', description='$memo', uid='$uid', dlu='$dlu' where ref='$ref' and invoice_no='$old_invoice_no' and invoice_type='PMT' and ref_type='$ref_type' and line='$old_line' ";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();	
							}
							
						
						} else {
							$sqlstr="delete from payment_detail where ref='$ref' and invoice_no='$old_invoice_no' and line='$old_line' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							//delete AP
							$sqlstr="delete from ap where ref='$ref' and invoice_no='$old_invoice_no' and invoice_type='PMT' and ref_type='$ref_type' and line='$old_line' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();	
												
						}
						
						
					} else {
						$line = maxline('payment_detail', 'line', 'ref', $ref, '');
						
						$sqlstr="insert into payment_detail (ref, invoice_no, invoice_date, invoice_due_date, discount, amount_paid, invoice_currency_code, invoice_rate, ref_type, amount_due, amount, line) values ('$ref', '$invoice_no', '$invoice_date', '$invoice_due_date', '$discount', '$amount_paid', '$currency_code', '$rate', '$ref_type', '$amount_due', '$amount', $line)";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						//insert AP
						$sqlv = "select a.* from (select syscode code, name, 'V' type from vendor where active=1 union all
			  select syscode code, concat(name,' (',phone,')') name, 'C' type from client where active=1 and ifnull(name,'') <> '' ) a where a.code='$vendor_code'";
			  			$sql=$dbpdo->prepare($sqlv);
						$sql->execute();
						$datav = $sql->fetch(PDO::FETCH_OBJ);
						
				  		$typev = $datav->type;
				  		
				  		if($ref_type == 'PIR') {
				  			##credit
				  			if($amount < 0) {
								$amount_credit = $amount * -1;
							}
							$sqlstr="insert into ap(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, discount_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, line, uid, dlu) values('$ref', '$invoice_no', '$date', '$invoice_due_date', '$typev', '$vendor_code', '', 0, '$amount_credit', '$discount', 'PMT', '$ref_type', '$currency_code', '$rate', '', '', 'C.O.D', '$memo', $line, '$uid', '$dlu')";
		                	$sql=$dbpdo->prepare($sqlstr);
		                	$sql->execute();
						} else {
							##debit
							$sqlstr="insert into ap(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, discount_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu) values('$ref', '$invoice_no', '$date', '$invoice_due_date', '$typev', '$vendor_code', '', '$amount', 0, '$discount', 'PMT', '$ref_type', '$currency_code', '$rate', '', '', 'C.O.D', '$memo', '$uid', '$dlu')";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();	
						}
						
					}
					
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
			
			$sqlstr="update payment set date='$date', status='$status', vendor_code='$vendor_code', payment_type='$payment_type', cheque_no='$cheque_no', cheque_date='$cheque_date', bank_name='$bank_name', credit_card_no='$credit_card_no', credit_card_code='$credit_card_code', credit_card_holder='$credit_card_holder', credit_card_expired='$credit_card_expired', account_code='$account_code', currency_code='$currency_code', rate='$rate', amount='$amount', deposit='$deposit', sub_total='$sub_total', type='$type', memo='$memo', round_amount='$round_amount', round_amount_account='$round_amount_account', bank_charge='$bank_charge', bank_charge_account='$bank_charge_account', total='$total', no_ttfa='$no_ttfa', uid='$uid', dlu='$dlu' where ref='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			if($payment_type == "giro" || $payment_type == "cheque") {
				
				//insert APC
				$sqlstr="update apc date='$date', vendor_code='$vendor_code', cheque_no='$cheque_no', bank_name='$bank_name', cheque_date='$cheque_date', amount='$total', currency_code='$currency_code', rate='$rate', account_code='$account_code', memo='$memo', uid='$uid', dlu='$dlu' where type='$payment_type' and ref='$ref'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();				
				
			}
					
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	

	
	
}

?>
