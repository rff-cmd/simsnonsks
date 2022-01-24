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
    
    if ($_FILES["file"]["size"] > 0) {
    	    	
    	$file = fopen($fileName, "r");
        
        $no = 0;
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
        	        	
        	if($x > 0) {
        		$no++;
        		
				$kelas_excel	=	$column[0];
				$name_excel		= 	petikreplace(trim($column[1]));
				$nis_excel		=	$column[2];
				$idkelas_excel 	=	$column[3];
				
				//get pegawai
				$sqlcek 	= 	"select a.nis, a.nama, b.kelas from siswa a left join kelas b on a.idkelas=b.replid where a.nis='$nis_excel'";
				$sqlresult	=	$dbpdo->prepare($sqlcek);
				$sqlresult->execute();
				$datasiswa	=	$sqlresult->fetch(PDO::FETCH_OBJ);
				
				$kelas		=	$datasiswa->kelas;
				$name		= 	petikreplace(trim($datasiswa->nama));
				$nis		=	$datasiswa->nis;
				
				if($nis != "") {
					$strsql1 = "update siswa set nama='$name_excel', idkelas='$idkelas_excel' where nis='$nis_excel'";
					$sqlresult1	=	$dbpdo->prepare($strsql1);
					$sqlresult1->execute();
					
					echo $no . ".) Kelas Excel : " . $kelas_excel . ">>" . $kelas . "| Nama Excel : " . $name_excel . ">>" . $name . "| NIS Excel : " . $nis_excel . ">>" . $nis . "<br>";	
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



