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
		<div class="col-sm-3">
			<input type="submit" name="submit" class='btn btn-primary' value="Generate" >
		</div>
	</div>
</form>

<?php
if($_POST["submit"]) {
	$select 	= new select;
	$selectview = new selectview;

	$dbpdo = DB::create();
	//get pegawai
	$sqlcek 	= 	"select replid, nis, nisn, nama from siswa order by nis";
	$sqlresult	=	$dbpdo->prepare($sqlcek);
	$sqlresult->execute();
	$insert = 0;
	while($datapeg	=	$sqlresult->fetch(PDO::FETCH_OBJ)) {
		$password	=	$datapeg->nisn; //random(6); //"123";
		$idpegawai	= 	$datapeg->replid;
		$usrid		= 	$datapeg->nis;
		//echo $insert + 1 . ") " . $usrid.">>".$datapeg->nama."<br>";
		$insert = $insert + generate_user_siswa_new($usrid, $password, $idpegawai);	
		
	}
	
?>    

	<table align="center" style="font-size: 36px; color: #07581c">
		<!--<tr>
			<td><?php echo "Jumlah Tambah Data : " . $insert; ?></td>
		</tr>-->
		<tr>
			<td><?php echo "Jumlah Update Data : " . $insert; ?></td>
		</tr>
	</table>

<?php    
}
?>



