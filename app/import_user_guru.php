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
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
        	        	
        	if($x > 0) {
        		
				$usrid			=	$column[0];
				$password		= 	"123";
				$namapegawai	=	petikreplace(trim($column[2]));
				
				//get pegawai
				$sqlcek 	= 	"select replid from pegawai where nama='$namapegawai'";
				echo $sqlcek."<br>";
				$sqlresult	=	$dbpdo->prepare($sqlcek);
				$sqlresult->execute();
				$datapeg	=	$sqlresult->fetch(PDO::FETCH_OBJ);
				
				$idpegawai	= 	$datapeg->replid;
				
				generate_user_guru($usrid, $password, $idpegawai);							
							
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



