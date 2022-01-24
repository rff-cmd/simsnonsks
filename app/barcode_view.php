<?php
    ini_set('display_errors',1);
    error_reporting(E_ALL|E_STRICT);
    include '../barcode/Code39.php';    
    //header("Content-type: image/svg+xml");
    
    
    include_once ("../app/include/sambung.php");
    include_once ("../app/include/functions.php");
	
	//---------get data siswa
	$nis		=	$_GET['nis'];
	 	
	$dbpdo = DB::create();
	
	$where = "";
	
	if ( $nis != "") {
		if ($where == "") {
			$where = " where a.nis like '%$nis%' ";
		} else {
			$where = $where . " and a.nis like '%$nis%' ";
		}								
	}
		
	$sql=$dbpdo->query("select a.nisn, a.nis, a.nama, a.tmplahir, a.tgllahir, a.kelamin, a.agama, a.darah, a.alamatsiswa, c.tingkat, b.kelas, a.foto_file from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid " . $where . " order by a.nama");
		
    $row_problem=$sql->fetch(PDO::FETCH_OBJ);
	$code = isset($_GET['code']) ? $_GET['code'] :$row_problem->nis;
	$nisn = $row_problem->nisn;
	$nis = $row_problem->nis;
	$nama = $row_problem->nama;
	$tmplahir = $row_problem->tmplahir;
	$tgllahir = $row_problem->tgllahir;
	
	$date = date("d", strtotime($tgllahir));
	$month = date("m", strtotime($tgllahir));
	$month = bulan_indonesia($month);
	$year = date("Y", strtotime($tgllahir));
	$tgllahir = $date . " " . $month . " " . $year;
	
	$kelamin = $row_problem->kelamin;
	if($row_problem->kelamin == 'L') {
		$kelamin = 'Laki-Laki';
	}
	if($row_problem->kelamin == 'P') {
		$kelamin = 'Perempuan';
	}
	$agama = $row_problem->agama;
	$darah = $row_problem->darah;
	$alamatsiswa = $row_problem->alamatsiswa;
	$tingkat = $row_problem->tingkat;
	$kelas = $row_problem->kelas;
	$foto_file = "file_foto_siswa/" . $row_problem->foto_file;
	
	//-------------get kepsek
	$sqldep = $dbpdo->query("select a.nipkepsek, b.nama from departemen a left join pegawai b on a.nipkepsek=b.nip where a.departemen='SMA' limit 1");
	$datadep = $sqldep->fetch(PDO::FETCH_OBJ);
	$nipkepsek = $datadep->nipkepsek;
	$namakepsek = $datadep->nama;
	
	//-------------get identitas sekolah
	$sqlid = $dbpdo->query("select a.nama, a.situs, a.alamat1, a.telp1 from identitas a where a.departemen='SMA' limit 1");
	$dataid = $sqlid->fetch(PDO::FETCH_OBJ);
	$namasekolah = $dataid->nama;
	$situssekolah = $dataid->situs;
	$alamatsekolah = $dataid->alamat1;
	$telpsekolah = $dataid->telp1;
?>	

<table border="0" width="20%" cellspacing="0" style="font-family: arial; font-size: 8px; border: 1px solid #ccc">
	
	
	<tr>
		<td align="center" rowspan="3">
			<img src="../assets/img/jawabarat.jpg" height="70" width="80" >
		</td>
		
		<td colspan="3" align="center" style="font-size: 16px"><?php echo $namasekolah ?></td>
		
		<td align="center" rowspan="3">
			<img src="../assets/img/bandung.jpg" height="80" width="80" >
		</td>		
	</tr>
	
	<tr>
		<td colspan="3" align="center" style="font-size: 11px"><?php echo $alamatsekolah ?></td>
	</tr>
	
	<tr>
		<td colspan="3" align="center" style="font-size: 11px">Telp. <?php echo $telpsekolah ?> | <?php echo $situssekolah ?></td>
	</tr>
	
	<tr>
		<td colspan="5" align="center" style="font-size: 12px"><hr></td>
	</tr>
	
	
	<tr>
		<td align="center" colspan="5">
			<?php		    
				echo draw($code);				
			?>
		</td>
	</tr>
	
	<tr style="font-size: 12px">
		<td align="center" rowspan="2">
			<?php if($row_problem->foto_file != "") { ?>
				<img src="<?php echo $foto_file ?>" height="130" width="110" >
			<?php } ?>
		</td>
	</tr>
	
	<tr valign="top" style="font-size: 11px">
		<td colspan="5">
			<table border="0" width="100%">
				<tr valign="top" style="font-size: 11px">
					<td width="30%">Nama</td>
					<td>:</td>
					<td colspan="2"><?php echo $nama ?></td>
				</tr>
					
				<tr valign="top" style="font-size: 11px">
					<td width="50">NISN/NIS</td>
					<td width="2">:</td>
					<td colspan="2"><?php echo $nisn ?>/<?php echo $nis ?></td>
				</tr>
				
				<tr valign="top" style="font-size: 11px">
					<td>TTL</td>
					<td>:</td>
					<td colspan="2"><?php echo $tmplahir ?>, <?php echo $tgllahir ?></td>
				</tr>
				
				<tr valign="top" style="font-size: 11px">
					<td>J. Kelamin</td>
					<td>:</td>
					<td colspan="2"><?php echo $kelamin ?></td>
				</tr>
				
				<tr valign="top" style="font-size: 11px">
					<td>Gol. Darah</td>
					<td>:</td>
					<td colspan="2"><?php echo $darah ?></td>
				</tr>
				
				<tr valign="top" style="font-size: 11px">
					<td>Agama</td>
					<td>:</td>
					<td colspan="2"><?php echo $agama ?></td>
				</tr>
				
				<tr valign="top" style="font-size: 11px">
					<td>Alamat</td>
					<td>:</td>
					<td colspan="2"><?php echo $alamatsiswa ?></td>
				</tr>
			</table>
		</td>
	</tr>
	
	
	
	<tr>
		<td align="center" colspan="5">&nbsp;</td>
	</tr>
	
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="center" colspan="3">Kepala Sekolah</td>
	</tr>
	
	<tr>
		<td align="center" colspan="5">&nbsp;</td>
	</tr>
	
	<tr>
		<td align="center" colspan="5">&nbsp;</td>
	</tr>
	
	<tr>
		<td align="left" rowspan="3">
			<img src="../assets/img/tutwuri.jpg" height="40" width="40" >
			<img src="../assets/img/osis.jpg" height="40" width="40" >
		</td>
		<td align="center" colspan="4">&nbsp;</td>
	</tr>
	
	<tr>
		<td>
			&nbsp;	
		</td>
		<td align="center" colspan="3">
			<u>
			<?php		    
				echo $namakepsek;				
			?>
			</u>
		</td>
	</tr>
	
	<tr>
		<td>&nbsp;</td>
		<td align="center" colspan="3">
			<?php		    
				echo $nipkepsek;				
			?>
		</td>
	</tr>
	
</table>

