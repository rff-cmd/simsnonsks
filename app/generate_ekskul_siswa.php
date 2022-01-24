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
        		
        		$tanggal	=	date("Y-m-d");
        		$tahunajaran=	39; //208-2019
        		
        		//get semester
        		$sqlcek 	= 	"select replid from semester where aktif='1' limit 1";
				$sqlresult	=	$dbpdo->prepare($sqlcek);
				$sqlresult->execute();
				$datasmt  	=	$sqlresult->fetch(PDO::FETCH_OBJ);
				$idsemester	=	$datasmt->replid;
				
        		
        		$nis		=	trim($column[0]);
        		$sqlcek 	= 	"select replid from siswa where nis='$nis'";
        		$sqlresult	=	$dbpdo->prepare($sqlcek);
				$sqlresult->execute();
				$datasiswa  =	$sqlresult->fetch(PDO::FETCH_OBJ);
				$idsiswa	=	$datasiswa->replid;
				
        		$name				=	trim($column[1]);
        		
        		//get ekskul
        		$idekskul			=	trim($column[4]);
        		$idekskul2			=	trim($column[7]);
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
					}
				}
				
				##ekstrakurikuler pilihan-2
				if($idekskul2 != "") {
					
					$sqlcek 	= 	"select replid from siswa_ekstrakurikuler where idsiswa='$idsiswa' and idpelajaran='$idekskul2' and idtahunajaran='$tahunajaran' and idsemester='$idsemester'";
					$sqlresult	=	$dbpdo->prepare($sqlcek);
					$sqlresult->execute();
					$rows2 = $sqlresult->rowCount();
					
					if($rows2 == 0) {
						$line = maxline('siswa_ekstrakurikuler', 'line', 'idsiswa', $idsiswa, '');
					
						$sqlstr = "insert into siswa_ekstrakurikuler (idtahunajaran, idsemester, idsiswa, idpelajaran, tanggal, uid, dlu, line) values ('$tahunajaran', '$idsemester', '$idsiswa', '$idekskul2', '$tanggal', '$uid', '$dlu', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$ekskul2++;
					}
				}
				
													
							
			}
			
			$x++;
			
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

<?php    
}
?>



