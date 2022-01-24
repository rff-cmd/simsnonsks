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
	$sqlcek 	= 	"select replid, nis, nama from siswa where alumni=2 order by ts"; //alumni=2 (siswa baru)
	$sqlresult	=	$dbpdo->prepare($sqlcek);
	$sqlresult->execute();
	$insert = 0;
	$no=0;
	while($datapeg	=	$sqlresult->fetch(PDO::FETCH_OBJ)) {
		
		$no++;
		//generate user dan password serta hak akses menu : siswa baru			
		$ref		=	$datapeg->replid;
		$password	=	"123";
		$idpegawai	= 	$datapeg->replid;
		$usrid		= 	$datapeg->replid;
		$nama		=	$datapeg->nama;
		
		echo 'No.'.$no.'.&nbsp;&nbsp;&nbsp;User ID: '.$usrid.'&nbsp;&nbsp;&nbsp;Password : '.$password.'&nbsp;&nbsp;&nbsp;Nama : '.$nama.'<br>';
		
		$pwd		=	obraxabrix($password, $usrid);
			
		$adm		=	0;
		$photo		=	"";
		$act		=	1;
		$uid		=	$idsiswa;
		$dlu		=	date("Y-m-d H:i:s");
		
		$sqlcekx 	= 	"select usrid from usr where idpegawai='$idpegawai'"; // usrid='$usrid'";
		$sqlresultx	=	$dbpdo->prepare($sqlcekx);
		$sqlresultx->execute();
		$rows		=	$sqlresultx->rowCount();
		
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
		
		
	}

?>    

	<table align="center" style="font-size: 36px; color: #07581c">
		<!--<tr>
			<td><?php echo "Jumlah Tambah Data : " . $insert; ?></td>
		</tr>-->
		<!--<tr>
			<td><?php echo "Jumlah Update Data : " . $insert; ?></td>
		</tr>-->
	</table>

<?php    
}
?>



