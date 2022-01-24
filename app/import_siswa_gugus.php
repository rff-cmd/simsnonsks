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

    $fileName 	= $_FILES["file"]["tmp_name"];
    
    $departemen	= $_POST['departemen'];
	$idtingkat	= $_POST['idtingkat'];
	$idkelas	= $_POST['idkelas'];
	$idsemester= $_POST['semester_id'];
	$idpelajaran= $_POST['idpelajaran'];
	$idjeniskompetensi		= $_POST['idjeniskompetensi'];
	$iddasarpenilaian		= $_POST['iddasarpenilaian'];
	
	$sqlukbm 	 = $selectview->list_ukbm_pertemuan($idtingkat, $idpelajaran, $semester_id);
	$dataukbm 	 = $sqlukbm->fetch(PDO::FETCH_OBJ); 
	$jumlah_ukbm1= $dataukbm->jumlah_ukbm;
    
    if ($_FILES["file"]["size"] > 0) {
    	    	
    	$file = fopen($fileName, "r");
        
        $jmlnilai = 0;
        $x = 0;
        $insert = 0;
        $update = 0;
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
        	        	
        	if($x > 0) {
        		
				$permen_kd_id	=	1; //(empty($_POST["permen_kd_id"])) ? 0 : $_POST["permen_kd_id"];
				$idtingkat		=	$column[1]; //(empty($_POST["idtingkat"])) ? 0 : $_POST["idtingkat"];
				$idpelajaran	= 	$column[3]; //(empty($_POST["idpelajaran"])) ? 0 : $_POST["idpelajaran"];
				$kd				=	$column[5]; //$_POST["kd"];
				$kode			=	$column[4]; //$_POST["kode"];
				$uraian			=	petikreplace($column[6]);
				$kkm_sekolah	=	0;
				$kkm_pelajaran	=	0;
				$jumlah_ukbm	=	0;
				$urutan			= 	$x;
				$aktif			= 	1;
				$uid			=	"import";
				$dlu			=	date("Y-m-d H:i:s");
				
				if($kode != "") {
					
					$sqlstr = "select replid from pemetaan_kd where idtingkat='$idtingkat' and idpelajaran='$idpelajaran' and kd='$kd' and kode='$kode'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rowsdata = $sql->rowCount();
					
					if($rowsdata == 0) {
						$sqlstr = "insert into pemetaan_kd (permen_kd_id, idtingkat, idpelajaran, kd, kode, uraian, kkm_sekolah, kkm_pelajaran, jumlah_ukbm, urutan, aktif, uid, dlu) values ('$permen_kd_id', '$idtingkat', '$idpelajaran', '$kd', '$kode', '$uraian', '$kkm_sekolah', '$kkm_pelajaran', '$jumlah_ukbm', '$urutan', '$aktif', '$uid', '$dlu')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$insert++;
					} else {
						$sqlstr="update pemetaan_kd set permen_kd_id='$permen_kd_id', idtingkat='$idtingkat', idpelajaran='$idpelajaran', kd='$kd', kode='$kode', uraian='$uraian', kkm_sekolah='$kkm_sekolah', kkm_pelajaran='$kkm_pelajaran', jumlah_ukbm='$jumlah_ukbm', urutan='$urutan', aktif='$aktif', uid='$uid', dlu='$dlu' where idtingkat='$idtingkat' and idpelajaran='$idpelajaran' and kd='$kd' and kode='$kode'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$update++;
					}
					
				}				
							
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



