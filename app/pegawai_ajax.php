<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

//include '../app/class/class.select.php';
//$select=new select;

$pilih = $_POST["button"];
switch ($pilih){
	case "ceknip":
		$dbpdo = DB::create();
		
		$old_nip	= $_POST["old_nip"];
		$nip 		= $_POST["nip"];	
		
		$sqlstr = "select nip from pegawai where nip<>'$old_nip' and nip='$nip' limit 1 ";		
		$sql 	= $dbpdo->prepare($sqlstr);
		$sql->execute();
		$data 	= $sql->fetch(PDO::FETCH_OBJ); 
		$nip2	= $data->nip;
				
		if($nip2 != '') {
?>		
			<input type="text" name="nip" id="nip" class="form-control" value="" onblur="loadHTMLPost3('<?php echo $__folder ?>app/pegawai_ajax.php','nip_id','ceknip','old_nip','nip')" >
			<font color="#FF0000" size="-1">NIP sudah digunakan !</font></td>	
<?php	
		} else {
?>
			<input type="text" name="nip" id="nip" class="form-control" value="<?php echo $nip; ?>" onblur="loadHTMLPost3('<?php echo $__folder ?>app/pegawai_ajax.php','nip_id','ceknip','old_nip','nip')" >
<?php
		}
		break;
		
	case "ceknip2":
		$dbpdo = DB::create();
		
		$old_nip	= $_POST["old_nip"];
		$nip 		= $_POST["nip"];	
		
		$__folder = "../";
		
		$sqlstr = "select nip from pegawai where nip<>'$old_nip' and nip='$nip' limit 1 ";		
		$sql 	= $dbpdo->prepare($sqlstr);
		$sql->execute();
		$data 	= $sql->fetch(PDO::FETCH_OBJ); 
		$nip2	= $data->nip;
				
		if($nip2 != '') {
?>		
			<input type="text" name="nip" id="nip" class="form-control" value="" onblur="loadHTMLPost3('<?php echo $__folder ?>app/pegawai_ajax.php','nip_id','ceknip2','old_nip','nip')" >
			<font color="#FF0000" size="-1">NIP sudah digunakan !</font></td>	
<?php	
		} else {
?>
			<input type="text" name="nip" id="nip" class="form-control" value="<?php echo $nip; ?>" onblur="loadHTMLPost3('<?php echo $__folder ?>app/pegawai_ajax.php','nip_id','ceknip2','old_nip','nip')" >
<?php
		}
		break;
			
	default:
	
}
?>