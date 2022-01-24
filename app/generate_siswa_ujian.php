<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include_once ("../app/include/sambung.php");
include_once ("../app/include/functions.php");

include_once ("../app/class/class.select.php");
include_once ("../app/class/class.selectview.php");

$select 	= new select;
$selectview = new selectview;

$dbpdo 		= DB::create();
$dbpdo_uji 	= DB_UJI::create_uji();

$departemen		= "SMA";
$idtingkat2		= $_POST['idtingkat2']; 
?>

<!-- PAGE CONTENT BEGINS -->
<form class="form-horizontal" role="form" action="" method="post" name="daftarnilai_input" id="daftarnilai_input" enctype="multipart/form-data" >
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tingkat</label>
		<div class="col-sm-3">
			<select name="idtingkat2" id="idtingkat2" class="chosen-select form-control" onchange="loadHTMLPost2('app/siswa_list_ajax.php','kelas_id','getkelas','idtingkat2')">
				<option value=""></option>
				<?php select_tingkat_unit("SMA", $idtingkat2); ?>
			</select>								
		</div>
	</div>
		
	<div class="form-group">
		<div class="col-sm-3">
			<input type="submit" name="submit" class='btn btn-primary' value="Proses" >
		</div>
	</div>
</form>

<?php

if($_POST["submit"]) {
	$sqlsiswa = "select a.replid, a.nis, a.nama, b.kelas, a.idminat, c.tingkat from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid where b.idtingkat='$idtingkat2' and a.alumni=0 and a.aktif=1";
	
	$resultssiswa=$dbpdo->query($sqlsiswa);
	while ($row_siswa = $resultssiswa->fetch(PDO::FETCH_OBJ)){
		
		$nama		= petikreplace($row_siswa->nama);
		$nis		= $row_siswa->nis;
		$tingkat	= $row_siswa->tingkat;
		$kelas 		= $row_siswa->kelas;
		$idminat 	= $row_siswa->idminat;
		if($idminat == 1) {
			$idminat = "MIPA";
		}
		if($idminat == 2) {
			$idminat = "IPS";
		}
		if($idminat == 3) {
			$idminat = "BAHASA";
		}
		$jurusan = $tingkat.'/'.$kelas.'/'.$idminat;
		
		if($nis != "") {
			
			$sqlcek 	= 	"select nim from m_siswa where nim='$nis'";
			$sqlresult	=	$dbpdo_uji->prepare($sqlcek);
			$sqlresult->execute();
			$rows = $sqlresult->rowCount();
			
			if($rows == 0) {
				//$line = maxline('siswa_ekstrakurikuler', 'line', 'idsiswa', $idsiswa, '');
			
				$sqlstr = "insert into m_siswa (nim, nama, jurusan) values ('$nis', '$nama', '$jurusan')";
				$sql=$dbpdo_uji->prepare($sqlstr);
				$sql->execute();
				
				$ekskul++;
			} else {
				$sqlstr = "update m_siswa set nama='$nama', jurusan='$jurusan' where nim='$nis'";
				$sql=$dbpdo_uji->prepare($sqlstr);
				$sql->execute();
				
				$ekskul2++;
			}
			
		}
	}
	
	
	//generate master jurusan
	$sqljurusan = "select distinct jurusan from m_siswa order by jurusan";
	$resultsjurusan=$dbpdo_uji->query($sqljurusan);
	while ($row_jurusan = $resultsjurusan->fetch(PDO::FETCH_OBJ)){
		if($row_jurusan->jurusan != "") {
			$sqlcek 	= 	"select name_jurusan from tb_jurusan where name_jurusan='$row_jurusan->jurusan'";
			$sqlresult	=	$dbpdo_uji->prepare($sqlcek);
			$sqlresult->execute();
			$rows = $sqlresult->rowCount();
			
			if($rows == 0) {
				$sqlstr = "insert into tb_jurusan (name_jurusan) values ('$row_jurusan->jurusan')";
				$sql=$dbpdo_uji->prepare($sqlstr);
				$sql->execute();
			} 
		}
	}
	
}
	
?>


<table align="center" style="font-size: 36px; color: #07581c">
	<tr>
		<td><?php echo "Jumlah Tambah Data-1 : " . $ekskul; ?></td>
	</tr>
	<tr>
		<td><?php echo "Jumlah Update Data-2 : " . $ekskul2; ?></td>
	</tr>
</table>