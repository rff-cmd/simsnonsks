<?php
	@session_start();

	if (($_SESSION["logged"] == 0)) {
		echo 'Access denied';
		exit;
	}

	include_once ("../app/include/sambung.php");
	include_once ("../app/include/functions.php");
	include_once ("../app/include/inword.php");

	include_once ("../app/class/class.select.php");
	include_once ("../app/class/class.selectview.php");
?>

<!-- PAGE CONTENT BEGINS -->
<form class="form-horizontal" role="form" action="" method="post" name="daftarnilai_input" id="daftarnilai_input" enctype="multipart/form-data" >
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Upload File</label>
		<div class="col-sm-3">
			<input type="file" name="file" id="file" accept=".csv">
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-3">
			<input type="submit" name="submit" class='btn btn-primary' value="Upload" >
		</div>
	</div>
</form>

<?php
if($_POST["submit"]) {
	$select 	= new select;
	$selectview = new selectview;

	$dbpdo = DB::create();
	
	//function tgl indonesia
	function bulan_indo_to_number($bulan) {
		if($bulan == "Januari") { $bulan_angka = 1; }
		if($bulan == "Februari") { $bulan_angka = 2; }
		if($bulan == "Pebruari") { $bulan_angka = 2; }
		if($bulan == "Maret") { $bulan_angka = 3; }
		if($bulan == "April") { $bulan_angka = 4; }
		if($bulan == "Mei") { $bulan_angka = 5; }
		if($bulan == "Juni") { $bulan_angka = 6; }
		if($bulan == "Juli") { $bulan_angka = 7; }
		if($bulan == "Agustus") { $bulan_angka = 8; }
		if($bulan == "September") { $bulan_angka = 9; }
		if($bulan == "Oktober") { $bulan_angka = 10; }
		if($bulan == "Nopember") { $bulan_angka = 11; }
		if($bulan == "November") { $bulan_angka = 11; }
		if($bulan == "Desember") { $bulan_angka = 12; }
		
		return $bulan_angka;
	}

    $fileName 	= $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
    	    	
    	//$file = fopen($fileName, "r");
    	
    	//cek delimiter (, or ;)
        $filecek = fopen($fileName, "r");        
        $cekcolumn1 = fgetcsv($filecek, 10000, ";");
        $datacol = $cekcolumn1[0];
        //----------------------
       	
       	if (preg_match("/,/",$datacol) == 0) {
       		$file = fopen($fileName, "r");
        	$column = fgetcsv($file, 10000, ";");
		} 
		//echo $datacol;
		if (preg_match("/,/",$datacol) == 1) {
			$file = fopen($fileName, "r");
			$column = fgetcsv($file, 10000, ",");
		}
        
        $jmlnilai = 0;
        $x = 0;
        $insert = 0;
        $update = 0;
        
        if (preg_match("/,/",$datacol) == 0) {
        	while (($column = fgetcsv($file, 20000, ";")) !== FALSE) {
        	        	
        	if($x > 0) {
        		
				$idangkatan			=	47; //
				$idangkatan1		=	6; //2020/2021
				
				$jalurmasuk			=	$column[6];
				$jalurmasuk_id		=	$column[6];
				/*--------Keterangan pribadi---------*/
				$nis				=	""; 
				$nisn				=	$column[1];
				
				$nik				=	$column[8];
				$nama				=	petikreplace($column[2]);
				//echo $nisn.'>>'.$nama. '<br>';
				$panggilan			=	"";
				$idkelas			=	0;
				$tglmasuk			=	""; //date("Y-m-d", strtotime($_POST["tglmasuk"]));
				$kelamin			=	""; //$column[10];
				/*if($kelamin == "Laki - Laki") {
					$kelamin = "L";
				}
				if($kelamin == "Perempuan") {
					$kelamin = "P";
				}*/
				
				$agama				=	""; 
				$warga				=	1;
				$anakke				=	0;
				$jsaudara			=	0;
				$jtiri				=	0;
				$jangkat			=	0;
				$yatim				=	0;
				$bahasa				=	0;
				
				$alamatsiswa		=	petikreplace($column[12]);
				$rtrw				=	""; //explode("/", $column[21]);
				$rt_siswa			=	""; //$rtrw[0];
				$rw_siswa			=	""; //$rtrw[1];
				$dusun				=	"";	
				$desa				=	"";	
				$kecamatan			=	"";
				$alamatortu			=	""; //petikreplace($column[22]);
				$kodepossiswa		=	"";
				$telponsiswa		=	"";
				$hpsiswa			=	"";
				$emailsiswa			=	"";
				$jenistinggal		=	"";
				$kps				=	0;
				$nokps				=	"";
				$kip				=	0;
				$nokip				=	"";
				$namakip			=	"";
				$nokks				=	"";
				$no_akte_lahir		=	"";
				$telponortu			=	"";
				$hportu				=	"";
				$hpibu				=	"";
				$transportasi_kode	=	"";
				$transportasi_lain	=	"";
				$jaraksekolah		=	numberreplace($column[10]);
				$kesekolah			=	0;
				$alumni				=	2;
				
				/*--------Keterangan kesehatan---------*/
				$berat				=	0;
				$tinggi				=	0;
				$kesehatan			=	""; //riwayat penyakit
				$darah				=	"";
				
				$kelainan			=	"";
				
				
				/*--------Keterangan pendidikan sebelumnya---------*/
				$asalsekolah_id		=	""; //petikreplace($column[13]);
				$kota_asalsekolah	=	"";
				$tglijazah			=	"";
				$noijazah			=	"";
				$tglskhun			=	"";
				$skhun				=	"";
				$noujian			=	""; //$column[6];
				$nisnasal			=	"";
				
				/*--------Keterangan orang tua---------*/
				$nik_ayah			=	"";
				$namaayah			=	"";
				$nik_ibu			=	"";
				$namaibu			=	"";
				$tmplahirayah		=	"";
				$tgllahirayah		=	"";
	            $tempat_bekerja_ayah=   "";
	            
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
				
				$jalurmasukprestasi_id = (empty($_POST["jalurmasukprestasi_id"])) ? 0 : $_POST["jalurmasukprestasi_id"];
				
				$uid				=	$_SESSION["loginname"];
				$dlu				=	date("Y-m-d H:i:s");
				
				if($nisn != "") {
					
					$sqlstr = "select replid from siswa where nisn='$nisn'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rowsdata = $sql->rowCount();
					
					if($rowsdata == 0) {
						
						$sqlstr = "insert into siswa (nis, nisn, nik, idangkatan, idangkatan1, foto_file, nama, panggilan, idkelas, tglmasuk, kelamin, tmplahir, tgllahir, agama, warga, anakke, jsaudara, jtiri, jangkat, yatim, bahasa, desa_kode, kecamatan_kode, kota_kode, provinsi_kode, alamatsiswa, rt_siswa, rw_siswa, dusun, desa, kecamatan, kodepossiswa, jenistinggal, alamatortu, telponsiswa, hpsiswa, emailsiswa, telponortu, hportu, hpibu, transportasi_kode, kps, nokps, kip, nokip, namakip, nokks, no_akte_lahir, transportasi_lain, jaraksekolah, kesekolah, berat, tinggi, kesehatan, darah, file_darah, kelainan, asalsekolah_id, kota_asalsekolah, tglijazah, noijazah, tglskhun, skhun, noujian, nisnasal, nik_ayah, namaayah, nik_ibu, namaibu, tmplahirayah, tgllahirayah, tempat_bekerja_ayah, tmplahiribu, tgllahiribu, pekerjaanayah, pekerjaanibu, penghasilanayah_kode, penghasilanayah, penghasilanibu_kode, penghasilanibu, pendidikanayah, pendidikanibu, wnayah, wnibu, nik_wali, wali, tmplahirwali, tgllahirwali, pendidikanwali, pekerjaanwali, penghasilanwali_kode, penghasilanwali, tempat_bekerja_wali, alamatwali, hpwali, hubungansiswa, pekerjaanayah_lain, pekerjaanibu_lain, tempat_bekerja_ibu, pekerjaanwali_lain, rombel_id, nama_bank, no_rekening_bank, nama_pemilik_bank, pip, alasan_pip, idminat, jalurmasuk_id, jalurmasuk, jalurmasukprestasi_id, file_rekam_bk, file_memo_ortu, file_nilai_un, file_raport, file_kk, file_akte, file_ijazah, file_nhun, uid, aktif, ts, tahun_ijazah, tahunskhun, kebutuhan_khusus_chk, jenis_tinggal, kebutuhan_khusus_chk1, kebutuhan_khusus, citacita, citacita_lain, tahunayah, kodeposortu, butuhkhususketayah, tahunibu, kodeposibu, butuhkhususibu, butuhkhususketibu, tahunwali, jarak_km, waktutempuh, waktutempuh_menit, almayah, butuhkhususayah, almibu, alamatibu, alumni, idgugus) values ('$nis', '$nisn', '$nik', '$idangkatan', '$idangkatan1', '$foto_file', '$nama', '$panggilan', '$idkelas', '$tglmasuk', '$kelamin', '$tmplahir', '$tgllahir', '$agama', '$warga', '$anakke', '$jsaudara', '$jtiri', '$jangkat', '$yatim', '$bahasa', '$desa_kode', '$kecamatan_kode', '$kota_kode', '$provinsi_kode', '$alamatsiswa', '$rt_siswa', '$rw_siswa', '$dusun', '$desa', '$kecamatan', '$kodepossiswa', '$jenistinggal', '$alamatortu', '$telponsiswa', '$hpsiswa', '$emailsiswa', '$telponortu', '$hportu', '$hpibu', '$transportasi_kode', '$kps', '$nokps', '$kip', '$nokip', '$namakip', '$nokks', '$no_akte_lahir', '$transportasi_lain', '$jaraksekolah', '$kesekolah', '$berat', '$tinggi', '$kesehatan', '$darah', '$file_darah', '$kelainan', '$asalsekolah_id', '$kota_asalsekolah', '$tglijazah', '$noijazah', '$tglskhun', '$skhun', '$noujian', '$nisnasal', '$nik_ayah', '$namaayah', '$nik_ibu', '$namaibu', '$tmplahirayah', '$tgllahirayah', '$tempat_bekerja_ayah', '$tmplahiribu', '$tgllahiribu', '$pekerjaanayah', '$pekerjaanibu', '$penghasilanayah_kode', '$penghasilanayah', '$penghasilanibu_kode', '$penghasilanibu', '$pendidikanayah', '$pendidikanibu', '$wnayah', '$wnibu', '$nik_wali', '$wali', '$tmplahirwali', '$tgllahirwali', '$pendidikanwali', '$pekerjaanwali', '$penghasilanwali_kode', '$penghasilanwali', '$tempat_bekerja_wali', '$alamatwali', '$hpwali', '$hubungansiswa', '$pekerjaanayah_lain', '$pekerjaanibu_lain', '$tempat_bekerja_ibu', '$pekerjaanwali_lain', '$rombel_id', '$nama_bank', '$no_rekening_bank', '$nama_pemilik_bank', '$pip', '$alasan_pip', '$idminat', '$jalurmasuk_id', '$jalurmasuk', '$jalurmasukprestasi_id', '$file_rekam_bk', '$file_memo_ortu', '$file_nilai_un', '$file_raport', '$file_kk', '$file_akte', '$file_ijazah', '$file_nhun', '$uid', '$aktif', '$dlu', '$tahun_ijazah', '$tahunskhun', '$kebutuhan_khusus_chk', '$jenis_tinggal', '$kebutuhan_khusus_chk1', '$kebutuhan_khusus', '$citacita', '$citacita_lain', '$tahunayah', '$kodeposortu', '$butuhkhususketayah', '$tahunibu', '$kodeposibu', '$butuhkhususibu', '$butuhkhususketibu', '$tahunwali', '$jarak_km', '$waktutempuh', '$waktutempuh_menit', '$almayah', '$butuhkhususayah', '$almibu', '$alamatibu', '$alumni', '$idgugus')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
									
						
						//generate user dan password serta hak akses menu : siswa baru		
						//-------get last ID
						$sqlstr 		= 	"select last_insert_id() last_id";
						$results		=	$dbpdo->query($sqlstr);
						$data 			=  	$results->fetch(PDO::FETCH_OBJ);
						$idsiswa		=	$data->last_id;
							
						$ref		=	$idsiswa;
						$password	=	$nisn;
						$idpegawai	= 	$idsiswa;
						$usrid		= 	$nisn;
						//echo $insert + 1 . ") " . $usrid.">>".$datapeg->nama."<br>";
						//generate_user_siswa($usrid, $password, $idpegawai);	
						
						$pwd		=	obraxabrix($password, $usrid);
							
						$adm		=	0;
						$photo		=	"";
						$act		=	1;
						$uid		=	"import";
						$dlu		=	date("Y-m-d H:i:s");
						
						$sqlcek 	= 	"select usrid from usr where usrid='$usrid'"; //idpegawai='$idpegawai'"; // usrid='$usrid'";
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
							
						$insert++;
					} else {
						echo $x.'. '.$nik.' '.$nama.'>>'.$tgllahir.'<br>';
						
						$sqlstr = "select replid from siswa where nisn='$nisn'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$datacsis = $sql->fetch(PDO::FETCH_OBJ);
						$idpegawai = $datacsis->replid;
						
						$sqlstr = "update siswa set nama='$nama' where nisn='$nisn'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						
						$sqlcek 	= 	"select usrid from usr where usrid='$nisn'";
						$sqlresult	=	$dbpdo->prepare($sqlcek);
						$sqlresult->execute();
						$rows		=	$sqlresult->rowCount();
						
						if($rows > 0) {
							$sqlstr="update usr set idpegawai='$idpegawai' where usrid='$nisn'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						}
						
						/*$sqlstr="update pemetaan_kd set permen_kd_id='$permen_kd_id', idtingkat='$idtingkat', idpelajaran='$idpelajaran', kd='$kd', kode='$kode', uraian='$uraian', kkm_sekolah='$kkm_sekolah', kkm_pelajaran='$kkm_pelajaran', jumlah_ukbm='$jumlah_ukbm', urutan='$urutan', aktif='$aktif', uid='$uid', dlu='$dlu' where idtingkat='$idtingkat' and idpelajaran='$idpelajaran' and kd='$kd' and kode='$kode'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();*/
						
						$update++;
					}
					
				}				
							
			}
			
			$x++;
			
        	}
		}
		
		//===========================KOMA=============================
		if (preg_match("/,/",$datacol) == 1) {
	        while (($column = fgetcsv($file, 20000, ",")) !== FALSE) {
	        	if($x > 0) {
        		
					$idangkatan			=	45; //
					$idangkatan1		=	5; //2020/2021
					
					$jalurmasuk			=	$column[5];
					$jalurmasuk_id		=	$column[5];
					/*--------Keterangan pribadi---------*/
					$nis				=	""; 
					$nisn				=	$column[1];
					
					$nik				=	"";
					$nama				=	petikreplace($column[2]);
					//echo $nisn.'>>'.$nama. '<br>';
					$panggilan			=	"";
					$idkelas			=	0;
					$tglmasuk			=	""; //date("Y-m-d", strtotime($_POST["tglmasuk"]));
					$kelamin			=	$column[10];
					if($kelamin == "Laki - Laki") {
						$kelamin = "L";
					}
					if($kelamin == "Perempuan") {
						$kelamin = "P";
					}
					
					$agama				=	""; 
					$warga				=	1;
					$anakke				=	0;
					$jsaudara			=	0;
					$jtiri				=	0;
					$jangkat			=	0;
					$yatim				=	0;
					$bahasa				=	0;
					
					$alamatsiswa		=	""; //$column[22];
					$rtrw				=	""; //explode("/", $column[21]);
					$rt_siswa			=	$rtrw[0];
					$rw_siswa			=	$rtrw[1];
					$dusun				=	"";	
					$desa				=	"";	
					$kecamatan			=	"";
					$alamatortu			=	""; //petikreplace($column[22]);
					$kodepossiswa		=	"";
					$telponsiswa		=	"";
					$hpsiswa			=	"";
					$emailsiswa			=	"";
					$jenistinggal		=	"";
					$kps				=	0;
					$nokps				=	"";
					$kip				=	0;
					$nokip				=	"";
					$namakip			=	"";
					$nokks				=	"";
					$no_akte_lahir		=	"";
					$telponortu			=	"";
					$hportu				=	"";
					$hpibu				=	"";
					$transportasi_kode	=	"";
					$transportasi_lain	=	"";
					$jaraksekolah		=	""; //numberreplace($column[24]);
					$kesekolah			=	0;
					$alumni				=	2;
					
					/*--------Keterangan kesehatan---------*/
					$berat				=	0;
					$tinggi				=	0;
					$kesehatan			=	""; //riwayat penyakit
					$darah				=	"";
					
					$kelainan			=	"";
					
					
					/*--------Keterangan pendidikan sebelumnya---------*/
					$asalsekolah_id		=	petikreplace($column[3]);
					$kota_asalsekolah	=	"";
					$tglijazah			=	"";
					$noijazah			=	"";
					$tglskhun			=	"";
					$skhun				=	"";
					$noujian			=	""; //$column[6];
					$nisnasal			=	"";
					
					/*--------Keterangan orang tua---------*/
					$nik_ayah			=	"";
					$namaayah			=	"";
					$nik_ibu			=	"";
					$namaibu			=	"";
					$tmplahirayah		=	"";
					$tgllahirayah		=	"";
		            $tempat_bekerja_ayah=   "";
		            
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
					
					$jalurmasukprestasi_id = petikreplace($column[6]);
					
					$uid				=	$_SESSION["loginname"];
					$dlu				=	date("Y-m-d H:i:s");
					
					if($nisn != "") {
						
						$sqlstr = "select replid from siswa where nisn='$nisn'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$rowsdata = $sql->rowCount();
						
						if($rowsdata == 0) {
							
							$sqlstr = "insert into siswa (nis, nisn, nik, idangkatan, idangkatan1, foto_file, nama, panggilan, idkelas, tglmasuk, kelamin, tmplahir, tgllahir, agama, warga, anakke, jsaudara, jtiri, jangkat, yatim, bahasa, desa_kode, kecamatan_kode, kota_kode, provinsi_kode, alamatsiswa, rt_siswa, rw_siswa, dusun, desa, kecamatan, kodepossiswa, jenistinggal, alamatortu, telponsiswa, hpsiswa, emailsiswa, telponortu, hportu, hpibu, transportasi_kode, kps, nokps, kip, nokip, namakip, nokks, no_akte_lahir, transportasi_lain, jaraksekolah, kesekolah, berat, tinggi, kesehatan, darah, file_darah, kelainan, asalsekolah_id, kota_asalsekolah, tglijazah, noijazah, tglskhun, skhun, noujian, nisnasal, nik_ayah, namaayah, nik_ibu, namaibu, tmplahirayah, tgllahirayah, tempat_bekerja_ayah, tmplahiribu, tgllahiribu, pekerjaanayah, pekerjaanibu, penghasilanayah_kode, penghasilanayah, penghasilanibu_kode, penghasilanibu, pendidikanayah, pendidikanibu, wnayah, wnibu, nik_wali, wali, tmplahirwali, tgllahirwali, pendidikanwali, pekerjaanwali, penghasilanwali_kode, penghasilanwali, tempat_bekerja_wali, alamatwali, hpwali, hubungansiswa, pekerjaanayah_lain, pekerjaanibu_lain, tempat_bekerja_ibu, pekerjaanwali_lain, rombel_id, nama_bank, no_rekening_bank, nama_pemilik_bank, pip, alasan_pip, idminat, jalurmasuk_id, jalurmasuk, jalurmasukprestasi_id, file_rekam_bk, file_memo_ortu, file_nilai_un, file_raport, file_kk, file_akte, file_ijazah, file_nhun, uid, aktif, ts, tahun_ijazah, tahunskhun, kebutuhan_khusus_chk, jenis_tinggal, kebutuhan_khusus_chk1, kebutuhan_khusus, citacita, citacita_lain, tahunayah, kodeposortu, butuhkhususketayah, tahunibu, kodeposibu, butuhkhususibu, butuhkhususketibu, tahunwali, jarak_km, waktutempuh, waktutempuh_menit, almayah, butuhkhususayah, almibu, alamatibu, alumni, idgugus) values ('$nis', '$nisn', '$nik', '$idangkatan', '$idangkatan1', '$foto_file', '$nama', '$panggilan', '$idkelas', '$tglmasuk', '$kelamin', '$tmplahir', '$tgllahir', '$agama', '$warga', '$anakke', '$jsaudara', '$jtiri', '$jangkat', '$yatim', '$bahasa', '$desa_kode', '$kecamatan_kode', '$kota_kode', '$provinsi_kode', '$alamatsiswa', '$rt_siswa', '$rw_siswa', '$dusun', '$desa', '$kecamatan', '$kodepossiswa', '$jenistinggal', '$alamatortu', '$telponsiswa', '$hpsiswa', '$emailsiswa', '$telponortu', '$hportu', '$hpibu', '$transportasi_kode', '$kps', '$nokps', '$kip', '$nokip', '$namakip', '$nokks', '$no_akte_lahir', '$transportasi_lain', '$jaraksekolah', '$kesekolah', '$berat', '$tinggi', '$kesehatan', '$darah', '$file_darah', '$kelainan', '$asalsekolah_id', '$kota_asalsekolah', '$tglijazah', '$noijazah', '$tglskhun', '$skhun', '$noujian', '$nisnasal', '$nik_ayah', '$namaayah', '$nik_ibu', '$namaibu', '$tmplahirayah', '$tgllahirayah', '$tempat_bekerja_ayah', '$tmplahiribu', '$tgllahiribu', '$pekerjaanayah', '$pekerjaanibu', '$penghasilanayah_kode', '$penghasilanayah', '$penghasilanibu_kode', '$penghasilanibu', '$pendidikanayah', '$pendidikanibu', '$wnayah', '$wnibu', '$nik_wali', '$wali', '$tmplahirwali', '$tgllahirwali', '$pendidikanwali', '$pekerjaanwali', '$penghasilanwali_kode', '$penghasilanwali', '$tempat_bekerja_wali', '$alamatwali', '$hpwali', '$hubungansiswa', '$pekerjaanayah_lain', '$pekerjaanibu_lain', '$tempat_bekerja_ibu', '$pekerjaanwali_lain', '$rombel_id', '$nama_bank', '$no_rekening_bank', '$nama_pemilik_bank', '$pip', '$alasan_pip', '$idminat', '$jalurmasuk_id', '$jalurmasuk', '$jalurmasukprestasi_id', '$file_rekam_bk', '$file_memo_ortu', '$file_nilai_un', '$file_raport', '$file_kk', '$file_akte', '$file_ijazah', '$file_nhun', '$uid', '$aktif', '$dlu', '$tahun_ijazah', '$tahunskhun', '$kebutuhan_khusus_chk', '$jenis_tinggal', '$kebutuhan_khusus_chk1', '$kebutuhan_khusus', '$citacita', '$citacita_lain', '$tahunayah', '$kodeposortu', '$butuhkhususketayah', '$tahunibu', '$kodeposibu', '$butuhkhususibu', '$butuhkhususketibu', '$tahunwali', '$jarak_km', '$waktutempuh', '$waktutempuh_menit', '$almayah', '$butuhkhususayah', '$almibu', '$alamatibu', '$alumni', '$idgugus')";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
										
							
							//generate user dan password serta hak akses menu : siswa baru		
							//-------get last ID
							$sqlstr 		= 	"select last_insert_id() last_id";
							$results		=	$dbpdo->query($sqlstr);
							$data 			=  	$results->fetch(PDO::FETCH_OBJ);
							$idsiswa		=	$data->last_id;
								
							$ref		=	$idsiswa;
							$password	=	$nisn;
							$idpegawai	= 	$idsiswa;
							$usrid		= 	$nisn;
							//echo $insert + 1 . ") " . $usrid.">>".$datapeg->nama."<br>";
							//generate_user_siswa($usrid, $password, $idpegawai);	
							
							$pwd		=	obraxabrix($password, $usrid);
								
							$adm		=	0;
							$photo		=	"";
							$act		=	1;
							$uid		=	"import";
							$dlu		=	date("Y-m-d H:i:s");
							
							$sqlcek 	= 	"select usrid from usr where usrid='$usrid'"; //idpegawai='$idpegawai'"; // usrid='$usrid'";
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
								
							$insert++;
						} else {
							echo $x.'. '.$nik.' '.$nama.'>>'.$tgllahir.'<br>';
							
							$sqlstr = "select replid from siswa where nisn='$nisn'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							$datacsis = $sql->fetch(PDO::FETCH_OBJ);
							$idpegawai = $datacsis->replid;
							
							$sqlstr = "update siswa set nama='$nama' where nisn='$nisn'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							
							$sqlcek 	= 	"select usrid from usr where usrid='$nisn'";
							$sqlresult	=	$dbpdo->prepare($sqlcek);
							$sqlresult->execute();
							$rows		=	$sqlresult->rowCount();
							
							if($rows > 0) {
								$sqlstr="update usr set idpegawai='$idpegawai' where usrid='$nisn'";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
							}
							
							/*$sqlstr="update pemetaan_kd set permen_kd_id='$permen_kd_id', idtingkat='$idtingkat', idpelajaran='$idpelajaran', kd='$kd', kode='$kode', uraian='$uraian', kkm_sekolah='$kkm_sekolah', kkm_pelajaran='$kkm_pelajaran', jumlah_ukbm='$jumlah_ukbm', urutan='$urutan', aktif='$aktif', uid='$uid', dlu='$dlu' where idtingkat='$idtingkat' and idpelajaran='$idpelajaran' and kd='$kd' and kode='$kode'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();*/
							
							$update++;
						}
						
					}				
								
				}
				
				$x++;
			}
		}
    }
?>    

<table align="center" style="font-size: 36px; color: #07581c">
	<tr>
		<td><?php echo "Jumlah Tambah Data : " . $insert; ?></td>
	</tr>
	<tr>
		<td><?php echo "Jumlah Update Data : " . $update; ?></td>
	</tr>
</table>

<?php    
}
?>



