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
    	    	
    	$file = fopen($fileName, "r");
        
        $jmlnilai = 0;
        $x = 0;
        $insert = 0;
        $update = 0;
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
        	        	
        	if($x > 0) {
        		
				/*--------Keterangan pribadi---------*/
				$nis				=	$column[2];
				$nisn				=	$column[4];
				$nik				=	$column[7];
				$nama				=	petikreplace($column[1]);
				$tglmasuk			=	date("Y-m-d", strtotime($column[43]));
				$kelamin			=	$column[3];;
				$tmplahir			=	$column[5];;
				$tgllahir			=	date("Y-m-d", strtotime($column[6]));
				$agama				=	$column[8];;
				$warga				=	1;
				$anakke				=	(empty($column[55])) ? 0 : $column[55];
				
				
				/*--------Keterangan tempat tinggal---------*/
				$sqlstr = "select kode from desa where nama='$column[13]'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$data=$sql->fetch(PDO::FETCH_OBJ);				
	            $desa_kode          =	$data->kode;
		        
		        $sqlstr = "select kode from kecamatan where nama='$column[14]'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$data=$sql->fetch(PDO::FETCH_OBJ);	
	            $kecamatan_kode     =	$data->kode;
	            	        
				$alamatsiswa		=	petikreplace($column[9]);
				$rt_siswa			=	$column[10];
				$rw_siswa			=	$column[11];	
				$dusun				=	$column[12];	
				$desa				=	petikreplace($column[13]);	
				$kecamatan			=	petikreplace($column[14]);	
				$kodepossiswa		=	$column[15];	
				
				$jenis_tinggal		=	$column[16];
				$jenistinggal		=	$column[16];	
				$sql="select a.cde, a.dcr from 
					(select 'A' cde, 'Bersama Orang Tua' dcr, 0 nmr union all 
					select 'B' cde, 'Bersama Wali' dcr, 1 nmr union all
					select 'C' cde, 'Kost' dcr, 3 nmr) a where a.dcr='$jenistinggal' order by a.nmr";
				$results=$dbpdo->query($sql);
				$row = $results->fetch(PDO::FETCH_OBJ);
				$jenistinggal = $row->cde;
	
				$kps				=	$column[22];
				if($kps == "Tidak") {
					$kps = 0;
				}
				if($kps == "Ya") {
					$kps = 1;
				}
				$nokps				=	$column[23];
				$kip				=	$column[46];
				if($kip == "Tidak") {
					$kip = 0;
				}
				if($kip == "Ya") {
					$kip = 1;
				}				
				$nokip				=	$column[47];
				$namakip			=	petikreplace($column[48]);
				$nokks				=	$column[49];
				$no_akte_lahir		=	$column[50];
				$telponsiswa		=	$column[18];
				$hpsiswa			=	$column[19];
				$emailsiswa			=	$column[20];
				$transportasi_kode	=	$column[17];
				$sql="select a.cde, a.dcr from 
					(select 'A' cde, 'JALAN KAKI' dcr, 0 nmr union all 
					select 'B' cde, 'SEPEDA' dcr, 1 nmr union all 
					select 'C' cde, 'MOTOR' dcr, 2 nmr union all 
					select 'D' cde, 'MOBIL PRIBADI' dcr, 3 nmr union all 
					select 'E' cde, 'ANTAR JEMPUT SEKOLAH' dcr, 4 nmr union all 
					select 'F' cde, 'ANGKUTAN UMUM' dcr, 5 nmr union all 
					select 'G' cde, 'LAINNYA' dcr, 7 nmr union all 
					select 'H' cde, 'OJEG' dcr, 6 nmr) a where a.dcr='$transportasi_kode' order by nmr";
				$results=$dbpdo->query($sql);
				$row = $results->fetch(PDO::FETCH_OBJ);
				$transportasi_kode = $row->cde;
					
				$transportasi_lain	=	$column[17];
				$asalsekolah_id		=	petikreplace($column[54]);
				$noijazah			=	$column[45];
				$skhun				=	$column[21];
				$noujian			=	$column[44];
				
				/*--------Keterangan orang tua---------*/
				$nik_ayah			=	$column[29];
				$namaayah			=	petikreplace($column[24]);
				$nik_ibu			=	$column[35];
				$namaibu			=	petikreplace($column[30]);
				$pekerjaanayah		=	$column[27];
				$sql="select replid, pekerjaan from jenispekerjaan where pekerjaan='$pekerjaanayah' order by replid";
				$results=$dbpdo->query($sql);
				$row = $results->fetch(PDO::FETCH_OBJ);
				$pekerjaanayah = $row->replid;
				$pekerjaanayah_lain	=	$column[27];
				
				$pekerjaanibu		=	$column[33];
				$sql="select replid, pekerjaan from jenispekerjaan where pekerjaan='$pekerjaanibu' order by replid";
				$results=$dbpdo->query($sql);
				$row = $results->fetch(PDO::FETCH_OBJ);
				$pekerjaanibu = $row->replid;
				$pekerjaanibu_lain	=	$column[33];
				
		        $kebutuhan_khusus_chk=	$column[53];
		        if($kebutuhan_khusus_chk == "Tidak Ada") {
					$kebutuhan_khusus_chk = 0;
				} else {
					$kebutuhan_khusus_chk = 1;
				}
				
		        $kebutuhan_khusus	=	$column[53];
		        if($kebutuhan_khusus == "Tidak Ada") {
					$kebutuhan_khusus = "";
				}
				
		        $tahunayah			=	$column[25];
		        $tahunibu			=	$column[31];
		        $tahunwali			=	$column[37];
		       
		        $almayah			=	$column[27];
		        if($almayah == "Sudah Meninggal") {
					$almayah = 1;
				} else {
					$almayah = 0;
				}
		        
		        $almibu				=	$column[33];
		        if($almibu == "Sudah Meninggal") {
					$almibu = 1;
				} else {
					$almibu = 0;
				}
				
		        //------end new
		        
		        
				$penghasilanayah_kode	=	$column[28];
				if($penghasilanayah_kode != "") {
					$sql="select replid, penghasilan from penghasilan where penghasilan='$penghasilanayah_kode' order by replid";
					$results=$dbpdo->query($sql);
					$rows=$results->rowCount();
					$row = $results->fetch(PDO::FETCH_OBJ);
					if($rows > 0) {
						$penghasilanayah_kode = $row->replid;
					} else {
						$sqlstr="insert into penghasilan(penghasilan) values('$penghasilanayah_kode')";
						$results=$dbpdo->query($sqlstr);
						
						$sqlstr 		= 	"select last_insert_id() last_id";
						$results		=	$dbpdo->query($sqlstr);
						$data 			=  	$results->fetch(PDO::FETCH_OBJ);
						$penghasilanayah_kode = $data->last_id;
					}
				} else {
					$penghasilanayah_kode = "";
				}
				
				$penghasilanibu_kode	=	$column[33];
				if($penghasilanibu_kode != "") {
					$sql="select replid, penghasilan from penghasilan where penghasilan='$penghasilanibu_kode' order by replid";
					$results=$dbpdo->query($sql);
					$rows=$results->rowCount();
					$row = $results->fetch(PDO::FETCH_OBJ);
					if($rows > 0) {
						$penghasilanibu_kode = $row->replid;
					} else {
						$sqlstr="insert into penghasilan(penghasilan) values('$penghasilanibu_kode')";
						$results=$dbpdo->query($sqlstr);
						
						$sqlstr 		= 	"select last_insert_id() last_id";
						$results		=	$dbpdo->query($sqlstr);
						$data 			=  	$results->fetch(PDO::FETCH_OBJ);
						$penghasilanibu_kode = $data->last_id;
					}
				} else {
					$penghasilanibu_kode = "";
				}
				
				/*--------Keterangan wali---------*/
				$nik_wali			=	$column[41];
				$wali				=	$column[36];				
				$pekerjaanwali		=	$column[39];
				$sql="select replid, pekerjaan from jenispekerjaan where pekerjaan='$pekerjaanwali' order by replid";
				$results=$dbpdo->query($sql);
				$row = $results->fetch(PDO::FETCH_OBJ);
				$pekerjaanwali = $row->replid;
				$pekerjaanwali_lain	=	$column[39];
				$penghasilanwali_kode	=	$column[40];
				if($penghasilanwali_kode != "") {
					$sql="select replid, penghasilan from penghasilan where penghasilan='$penghasilanwali_kode' order by replid";
					$results=$dbpdo->query($sql);
					$rows=$results->rowCount();
					$row = $results->fetch(PDO::FETCH_OBJ);
					if($rows > 0) {
						$penghasilanwali_kode = $row->replid;
					} else {
						$sqlstr="insert into penghasilan(penghasilan) values('$penghasilanwali_kode')";
						$results=$dbpdo->query($sqlstr);
						
						$sqlstr 		= 	"select last_insert_id() last_id";
						$results		=	$dbpdo->query($sqlstr);
						$data 			=  	$results->fetch(PDO::FETCH_OBJ);
						$penghasilanwali_kode = $data->last_id;
					}
				} else {
					$penghasilanwali_kode = "";
				}
				
		        $tempat_bekerja_wali=   $_POST["tempat_bekerja_wali"];
		        
				$pip				=	$column[46];
				if($pip == "Ya") {
					$pip = 1;
				} else {
					$pip = 0;
				}
				$alasan_pip			=	$column[52];
				
				$sqlstr = "update siswa set nisn='$nisn', nik='$nik', tglmasuk='$tglmasuk', kelamin='$kelamin', tmplahir='$tmplahir', tgllahir='$tgllahir', agama='$agama', warga='$warga', anakke='$anakke', desa_kode='$desa_kode', kecamatan_kode='$kecamatan_kode', alamatsiswa='$alamatsiswa', rt_siswa='$rt_siswa', rw_siswa='$rw_siswa', dusun='$dusun', desa='$desa', kecamatan='$kecamatan', kodepossiswa='$kodepossiswa', telponsiswa='$telponsiswa', hpsiswa='$hpsiswa', emailsiswa='$emailsiswa', jenistinggal='$jenistinggal', kps='$kps', nokps='$nokps', kip='$kip', nokip='$nokip', namakip='$namakip', nokks='$nokks', no_akte_lahir='$no_akte_lahir', transportasi_kode='$transportasi_kode', transportasi_lain='$transportasi_lain', asalsekolah_id='$asalsekolah_id', noijazah='$noijazah', skhun='$skhun', noujian='$noujian', nik_ayah='$nik_ayah', namaayah='$namaayah', nik_ibu='$nik_ibu', namaibu='$namaibu', pekerjaanayah='$pekerjaanayah', pekerjaanibu='$pekerjaanibu', penghasilanayah_kode='$penghasilanayah_kode', penghasilanibu_kode='$penghasilanibu_kode', nik_wali='$nik_wali', wali='$wali', pekerjaanwali='$pekerjaanwali', penghasilanwali_kode='$penghasilanwali_kode', tempat_bekerja_wali='$tempat_bekerja_wali', pekerjaanayah_lain='$pekerjaanayah_lain', pekerjaanibu_lain='$pekerjaanibu_lain', pekerjaanwali_lain='$pekerjaanwali_lain', pip='$pip', alasan_pip='$alasan_pip', kebutuhan_khusus_chk='$kebutuhan_khusus_chk', jenis_tinggal='$jenis_tinggal', kebutuhan_khusus='$kebutuhan_khusus', tahunayah='$tahunayah', tahunibu='$tahunibu', tahunwali='$tahunwali', almayah='$almayah', almibu='$almibu' where nis='$nis'";
				echo $nis.">>". $nama. ">>>". $sqlstr.'<br>';
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				$update++;
							
							
			}
			
			$x++;
			
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



