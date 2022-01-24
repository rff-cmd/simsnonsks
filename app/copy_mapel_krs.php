<script type="text/javascript" src="../js/buttonajax.js"></script>

<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost2(URL, destination, button, getId){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;	
		var str = str + '&button=' + button;
		
		if (window.XMLHttpRequest){
			request = new XMLHttpRequest();
			request.onreadystatechange = processStateChange;
			request.open("POST", URL, true);
			request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
			request.send(str);		
					
		} else if (window.ActiveXObject) {
			request = new ActiveXObject("Microsoft.XMLHTTP");
			if (request) {
				request.onreadystatechange = processStateChange;
				request.open("POST", URL, true);
				request.send();				
			}
		}
				
	}
	 
</script>

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
$idtahunajaran	= $_POST['idtahunajaran'];
$idtahunajaran1	= $_POST["idtahunajaran1"];
$semester_id	= $_POST["semester_id"];
$semester_id1	= $_POST["semester_id1"];

?>

<form class="form-horizontal" role="form" action="" method="post" name="daftarnilai_input" id="daftarnilai_input" enctype="multipart/form-data" >
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tahun Ajaran Sumber *)</label>
		<div class="col-sm-3">
			<select name="idtahunajaran" id="idtahunajaran" class="chosen-select form-control" >
				<option value=""></option>
				<?php select_thnajaran($idtahunajaran); ?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Semester Sumber *)</label>
		<div class="col-lg-2">
			<select name="semester_id" id="semester_id" class="chosen-select form-control" >
				<option value=""></option>
				<?php select_semester_all("SMA", $semester_id); ?>
			</select>
		</div>
	</div>
	<hr>
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tahun Ajaran Tujuan *)</label>
		<div class="col-sm-3">
			<select name="idtahunajaran1" id="idtahunajaran1" class="chosen-select form-control" >
				<option value=""></option>
				<?php select_thnajaran($idtahunajaran1); ?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Semester Tujuan *)</label>
		<div class="col-lg-2">
			<select name="semester_id1" id="semester_id1" class="chosen-select form-control" >
				<option value=""></option>
				<?php select_semester_all("SMA", $semester_id1); ?>
			</select>
		</div>
	</div>
								
	<br>
	<div class="form-group">
		<div class="col-sm-3">
			<input type="submit" name="submit" class='btn btn-primary' value="Proses Copy" >
		</div>
	</div>
</form>

<?php
if($_POST["submit"]) {
	
	$persen 		= 0;
	$persen1		= 0;
	$na				= 0;

	if($idtahunajaran != "" && $semester_id != "") {
		$sqlkrs = "select a.replid, a.peminatan, a.tingkat_id, a.kelompok_pelajaran_id, a.pelajaran_kode, a.pelajaran_id, a.semester_id, a.sks, a.idtahunajaran, a.urutan, a.kode1, a.kode2, a.uid, a.dlu from kartu_rencana_studi a where a.idtahunajaran='$idtahunajaran' and a.semester_id='$semester_id' order by a.replid ";
		$resultskrs=$dbpdo->query($sqlkrs);	
	
		$no = 0;
		while ($row_krs = $resultskrs->fetch(PDO::FETCH_OBJ)){
			
			$nis		= $row_siswa->replid;
			$idkelas 	= $row_siswa->idkelas;
			
			if($idtahunajaran1 != "" && $semester_id1 != "") {
				
				$no++;
					
				$sqlcek = "select a.replid, a.pelajaran_id from kartu_rencana_studi a where a.idtahunajaran='$idtahunajaran1' and a.semester_id='$semester_id1' and a.peminatan='$row_krs->peminatan' and a.tingkat_id='$row_krs->tingkat_id' and a.kelompok_pelajaran_id='$row_krs->kelompok_pelajaran_id' and a.pelajaran_kode='$row_krs->pelajaran_kode' and a.pelajaran_id='$row_krs->pelajaran_id' order by a.replid ";
				$resultscek=$dbpdo->query($sqlcek);	
				$rowscek=$resultscek->rowCount();
				if($rowscek == 0) {
					$uid		=	$_SESSION["loginname"];
					$dlu		=	date("Y-m-d H:i:s");
					
					$sqlstr = "insert into kartu_rencana_studi (peminatan, tingkat_id, kelompok_pelajaran_id, pelajaran_kode, pelajaran_id, semester_id, sks, idtahunajaran, urutan, kode1, kode2, uid, dlu) values ('$row_krs->peminatan', '$row_krs->tingkat_id', '$row_krs->kelompok_pelajaran_id', '$row_krs->pelajaran_kode', '$row_krs->pelajaran_id', '$semester_id1', '$row_krs->sks', '$idtahunajaran1', '$row_krs->urutan', '$row_krs->kode1', '$row_krs->kode2', '$uid', '$dlu')";
					$sqlx=$dbpdo->prepare($sqlstr);
					$sqlx->execute();
				} else {
					$sqlstr = "update kartu_rencana_studi set kode1='$row_krs->kode1', kode2='$row_krs->kode2'  where idtahunajaran='$idtahunajaran1' and semester_id='$semester_id1' and peminatan='$row_krs->peminatan' and tingkat_id='$row_krs->tingkat_id' and kelompok_pelajaran_id='$row_krs->kelompok_pelajaran_id' and pelajaran_kode='$row_krs->pelajaran_kode' and pelajaran_id='$row_krs->pelajaran_id'";
					$sqlx=$dbpdo->prepare($sqlstr);
					$sqlx->execute();
				}
				

			}
		}
	}
	
	echo 'Copy Sukses';
}
	
?>
