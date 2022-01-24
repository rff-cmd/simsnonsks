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

$dbpdo = DB::create();

$departemen		= "SMA";
$idtingkat2		= $_POST['idtingkat2'];  //27; //27-->X    28-->XI
$idkelas		= $_POST['idkelas'];
$idtahunajaran	= $_SESSION["idtahunajaran"]; //$_REQUEST["idtahunajaran"];
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
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kelas</label>
		<div class="col-sm-3">
			<select name="idkelas" id="idkelas" class="chosen-select form-control" >
				<option value=""></option>
				<?php select_kelasfilter($idkelas); ?>
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
	
	if($idkelas != "") {
		$sqlsiswa = "select a.replid, a.nama, a.idkelas, b.idtingkat from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid where b.idtingkat='$idtingkat2' and a.idkelas='$idkelas'";
		$resultssiswa=$dbpdo->query($sqlsiswa);
	} else {
		$sqlsiswa = "select a.replid, a.nama, a.idkelas, b.idtingkat from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid where b.idtingkat='$idtingkat2'";
		$resultssiswa=$dbpdo->query($sqlsiswa);
	}
	
	while ($row_siswa = $resultssiswa->fetch(PDO::FETCH_OBJ)){
		
		$nis		= $row_siswa->replid;
		$idkelas 	= $row_siswa->idkelas;
		$nama		= strtoupper(petikreplace($row_siswa->nama));
		
		if($nis != "") {
			
			$sqlstr = "update siswa set nama='$nama' where replid='$nis'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$ekskul++;
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