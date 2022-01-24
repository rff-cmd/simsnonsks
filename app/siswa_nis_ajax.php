<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

$dbpdo = DB::create();

$pilih = $_POST["button"];

$readonly = "";
if($_SESSION["adm"] != 1) {
	$readonly = "readonly";
}

switch ($pilih){
	
	case "ceknis":
		$replid		= $_POST["replid"];
		$nis 		= $_POST["nis"];
		
		$sqlstr 	= 	"select nis from siswa where replid<>'$replid' and nis='$nis' limit 1";
		$sql		=	$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data 		= 	$sql->fetch(PDO::FETCH_OBJ); 
		$id_code	= 	$data->nis;
				
		if($id_code != '') {
?>		
			<input type="text" id="nis" name="nis" class="form-control" onblur="loadHTMLPost3('<?php echo $__folder ?>app/siswa_nis_ajax.php','nis_id','ceknis','replid','nis')" <?php echo $readonly ?> value=""><font color="#FF0000" size="-1">NIS sudah dipakai !</font>
<?php	
		} else {
?>
			<input type="text" id="nis" name="nis" class="form-control" onblur="loadHTMLPost3('<?php echo $__folder ?>app/siswa_nis_ajax.php','nis_id','ceknis','replid','nis')" <?php echo $readonly ?> value="<?php echo $nis; ?>">
            
<?php
		}
		
		break;
		
		
	case "ceknisn":
		$replid		= $_POST["replid"];
		$nisn 		= $_POST["nisn"];
		
		$sqlstr 	= 	"select nisn from siswa where replid<>'$replid' and nisn='$nisn' limit 1";
		$sql		=	$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data 		= 	$sql->fetch(PDO::FETCH_OBJ); 
		$id_code	= 	$data->nisn;
				
		if($id_code != '') {
?>		
			<input type="text" id="nisn" name="nisn" class="form-control" onblur="loadHTMLPost3('<?php echo $__folder ?>app/siswa_nis_ajax.php','nisn_id','ceknisn','replid','nisn')" <?php echo $readonly ?> value=""><font color="#FF0000" size="-1">NISN sudah dipakai !</font>
<?php	
		} else {
?>
			<input type="text" id="nisn" name="nisn" class="form-control" onblur="loadHTMLPost3('<?php echo $__folder ?>app/siswa_nis_ajax.php','nisn_id','ceknisn','replid','nisn')" <?php echo $readonly ?> value="<?php echo $nisn; ?>">
            
<?php
		}
		
		break;
		
			
	
	default:
}
?>