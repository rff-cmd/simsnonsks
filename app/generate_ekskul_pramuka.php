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
$kelamin		= $_POST['kelamin'];
$idtahunajaran	= $_SESSION["idtahunajaran"]; //$_REQUEST["idtahunajaran"];
$idsemester		= 20; //semeter genap
$idpelajaran	= $_POST['idpelajaran'];
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
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jenis Kelamin</label>
		<div class="col-sm-3">
			<select name="kelamin" id="kelamin" class="chosen-select form-control" >
				<option value=""></option>
				<?php select_kelamin($kelamin); ?>
			</select>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Ekskul</label>
		<div class="col-sm-4">
			<select name="idpelajaran" id="idpelajaran" class="chosen-select form-control" >
				<option value=""></option>
				<?php 
					select_ekstrakurikuler($idpelajaran);
				?>
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
	$sqlsiswa = "select a.replid, a.idkelas, b.idtingkat from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid where b.idtingkat='$idtingkat2' and a.kelamin='$kelamin'";
	$resultssiswa=$dbpdo->query($sqlsiswa);
	while ($row_siswa = $resultssiswa->fetch(PDO::FETCH_OBJ)){
		
		$nis		= $row_siswa->replid;
		$idkelas 	= $row_siswa->idkelas;
		
		if($nis != "") {
			$tanggal	=	date("Y-m-d");
			$tahunajaran=	$idtahunajaran; //39; //208-2019
			
			//get semester
			$sqlcek 	= 	"select replid from semester where aktif='1' limit 1";
			$sqlresult	=	$dbpdo->prepare($sqlcek);
			$sqlresult->execute();
			$datasmt  	=	$sqlresult->fetch(PDO::FETCH_OBJ);
			$idsemester	=	$datasmt->replid;
			
			$idsiswa	=	$row_siswa->replid;
				
			$idekskul			=	$idpelajaran; 
			$uid				=	"import";
			$dlu				=	date("Y-m-d H:i:s");
			
			##ekstrakurikuler pilihan-1
			if($idekskul != "") {
				
				$sqlcek 	= 	"select replid from siswa_ekstrakurikuler where idsiswa='$idsiswa' and idpelajaran='$idekskul' and idtahunajaran='$tahunajaran' and idsemester='$idsemester'";
				$sqlresult	=	$dbpdo->prepare($sqlcek);
				$sqlresult->execute();
				$rows = $sqlresult->rowCount();
				
				if($rows == 0) {
					$line = maxline('siswa_ekstrakurikuler', 'line', 'idsiswa', $idsiswa, '');
				
					$sqlstr = "insert into siswa_ekstrakurikuler (idtahunajaran, idsemester, idsiswa, idpelajaran, tanggal, uid, dlu, line) values ('$tahunajaran', '$idsemester', '$idsiswa', '$idekskul', '$tanggal', '$uid', '$dlu', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					$ekskul++;
				} else {
					$ekskul2++;
				}
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