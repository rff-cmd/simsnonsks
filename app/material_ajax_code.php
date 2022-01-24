<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

$dbpdo = DB::create();

$pilih = $_POST["button"];

switch ($pilih){
	
	case "cekcode_item":
		$syscode	= $_POST["syscode"];
		$code 		= $_POST["code"];
		
		$sqlstr 	= 	"select code from item where syscode<>'$syscode' and code='$code' limit 1";
		$sql		=	$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data 		= 	$sql->fetch(PDO::FETCH_OBJ); 
		$id_code	= 	$data->code;
				
		if($id_code != '') {
?>		
			<input type="text" id="code" name="code" autocomplete="off" onblur="loadHTMLPost3('app/material_ajax_code.php','code_item','cekcode_item','syscode','code')" class="form-control" value=""><font color="#FF0000" size="-1">Kode Barang sudah dipakai !</font>	
<?php	
		} else {
?>
			<input type="text" id="code" name="code" autocomplete="off" onblur="loadHTMLPost3('app/material_ajax_code.php','code_item','cekcode_item','syscode','code')" class="form-control" value="<?php echo $code; ?>">
            
<?php
		}
		
		break;
		
		
	case "barcode_item":
		$syscode	= $_POST["syscode"];
		$old_code 		= $_POST["old_code"];
		
		$sqlstr 	= 	"select old_code from item where syscode<>'$syscode' and old_code='$old_code' limit 1";
		$sql		=	$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data 		= 	$sql->fetch(PDO::FETCH_OBJ); 
		$id_code	= 	$data->old_code;
				
		if($id_code != '') {
?>		
			<input type="text" id="old_code" name="old_code" autocomplete="off" onblur="loadHTMLPost3('app/material_ajax_code.php','barcode_id','barcode_item','syscode','old_code')" class="form-control" value=""><font color="#FF0000" size="-1">Barcode sudah dipakai !</font>	
<?php	
		} else {
?>
			<input type="text" id="old_code" name="old_code" autocomplete="off" onblur="loadHTMLPost3('app/material_ajax_code.php','barcode_id','barcode_item','syscode','old_code')" class="form-control" value="<?php echo $old_code; ?>">
            
<?php
		}
		
		break;
		
			
	
	default:
}
?>