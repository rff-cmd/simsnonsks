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
	
	$dbpdo = DB::create();
	//get pegawai
	$sqlcek 	= 	"select usrid from usr where tipe_user='Siswa'";
	$sqlresult	=	$dbpdo->prepare($sqlcek);
	$sqlresult->execute();
	$insert = 0;
	while($datapeg	=	$sqlresult->fetch(PDO::FETCH_OBJ)) {
		$usrid		= 	$datapeg->usrid;
		
		//detail
		$strsql = "select usrid from usr_dtl where usrid='$usrid' and frmcde='raport_siswa'";
		$sqldet=$dbpdo->prepare($strsql);
		$sqldet->execute();
		$rows = $sqldet->rowCount();
		if($rows == 0) {
			$usr_frmcde = 'raport_siswa';
			
			$usr_add = 0;	
			$usr_edt = 0;			
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
			
			$insert++;
		}
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



