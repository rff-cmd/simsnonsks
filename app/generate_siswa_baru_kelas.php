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
			&nbsp;
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
    
    /*$sqlukbm 	 = $selectview->list_ukbm_pertemuan($idtingkat, $idpelajaran, $semester_id);
	$dataukbm 	 = $sqlukbm->fetch(PDO::FETCH_OBJ); 
	$jumlah_ukbm1= $dataukbm->jumlah_ukbm;*/
    
    if ($_FILES["file"]["size"] > 0) {
    	    	
    	//$file = fopen($fileName, "r");
    	
    	//cek delimiter (, or ;)
        $filecek = fopen($fileName, "r");        
        $cekcolumn1 = fgetcsv($filecek, 10000, ";");
        $datacol = $cekcolumn1[0];
        //----------------------
       	
       	if (preg_match("/,/",$datacol) == 0) {
       		$file = fopen($fileName, "r");
        	$column1 = fgetcsv($file, 10000, ";");
		} 
		//echo $datacol;
		if (preg_match("/,/",$datacol) == 1) {
			$file = fopen($fileName, "r");
			$column1 = fgetcsv($file, 10000, ",");
		}
       
        $jmlnilai = 0;
        $x = 1;
        $insert = 0;
        $update = 0;
        
        if (preg_match("/,/",$datacol) == 0) {
	        while (($column = fgetcsv($file, 10000, ";")) !== FALSE) {
	        	      	
	        	if($x > 0) {
	        		
					$nisn			=	$column[1];
					$nama			=	petikreplace($column[2]);
					$idkelas		=	$column[4];
					$alumni			=	0;
					
					$uid			=	"import-".$_SESSION["loginname"];
					$dlu			=	date("Y-m-d H:i:s");
					$aktif			=	1;
					
					if($nisn != "") {
						
						$sqlstr="update siswa set alumni='$alumni', idkelas='$idkelas', aktif='$aktif' where nisn='$nisn'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						echo $nisn.'>>'.$nama.'<br>';
						
						//get pegawai
						$sqlcek 	= 	"select replid, nis, nisn, nama from siswa where nisn='$nisn' order by nisn";
						$sqlresult	=	$dbpdo->prepare($sqlcek);
						$sqlresult->execute();
						$insert = 0;
						while($datapeg	=	$sqlresult->fetch(PDO::FETCH_OBJ)) {
							$password	=	$datapeg->nisn; //random(6); //"123";
							$idpegawai	= 	$datapeg->replid;
							$usrid		= 	$datapeg->nisn;
							//echo $insert + 1 . ") " . $usrid.">>".$datapeg->nama."<br>";
							$insert = $insert + generate_user_siswa_new($usrid, $password, $idpegawai);	
							
						}
						
						$update++;
						
						
					}
							
				}
				
				$x++;
				
	        }
        
		}
		
		
		//------KOMA---------------
		if (preg_match("/,/",$datacol) == 1) {
			 
        	while (($column = fgetcsv($file, 20000, ",")) !== FALSE) {
	        	       	
	        	if($x > 0) {
	        		
					$nisn			=	$column[1];
					$nama			=	petikreplace($column[2]);
					$idkelas		=	$column[4];
					$alumni			=	0;
					
					$uid			=	"import-".$_SESSION["loginname"];
					$dlu			=	date("Y-m-d H:i:s");
					$aktif			=	1;
					
					if($nisn != "") {
						
						$sqlstr="update siswa set alumni='$alumni', idkelas='$idkelas', aktif='$aktif' where nisn='$nisn'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						echo $nisn.'>>'.$nama.'<br>';
						
						//get pegawai
						$sqlcek 	= 	"select replid, nis, nisn, nama from siswa where nisn='$nisn' order by nisn";
						$sqlresult	=	$dbpdo->prepare($sqlcek);
						$sqlresult->execute();
						$insert = 0;
						while($datapeg	=	$sqlresult->fetch(PDO::FETCH_OBJ)) {
							$password	=	$datapeg->nisn; //random(6); //"123";
							$idpegawai	= 	$datapeg->replid;
							$usrid		= 	$datapeg->nisn;
							//echo $insert + 1 . ") " . $usrid.">>".$datapeg->nama."<br>";
							$insert = $insert + generate_user_siswa_new($usrid, $password, $idpegawai);	
							
						}
						
						$update++;
						
						
					}
								
				}
				
				$x++;
				
	        }
        
		}
		
    }
?>    

<table align="center" style="font-size: 36px; color: #07581c">
	<tr>
		<td><?php echo "Jumlah Upload Data : " . $insert; ?></td>
	</tr>
	<tr>
		<td><?php echo "Jumlah Upload Data Terupdate : " . $update; ?></td>
	</tr>
</table>

<?php    
}
?>



