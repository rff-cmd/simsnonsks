<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

$dbpdo = DB::create();

$pilih = $_POST["button"];

switch ($pilih){
	case "cekcode":
		$syscode	= $_POST["syscode"];
		$code 		= $_POST["code"];
		
		$sqlstr 	= 	"select code from item_group where id<>'$syscode' and code='$code' limit 1";
		$sql		=	$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data 		= 	$sql->fetch(PDO::FETCH_OBJ); 
		$id_code	= 	$data->code;
				
		if($id_code != '') {
?>		
			<input type="text" id="code" name="code" class="form-control" style="width: 300px" onblur="loadHTMLPost3('app/item_group_ajax_code.php','code_id','cekcode','syscode','code')" value="" /><font color="#FF0000" size="-1">Kode sudah dipakai !</font>	
			
<?php	
		} else {
?>
			<input type="text" id="code" name="code" class="form-control" style="width: 300px" onblur="loadHTMLPost3('app/item_group_ajax_code.php','code_id','cekcode','syscode','code')" value="<?php echo $code; ?>" />
            
<?php
		}
		
		break;	
	
	default:
}
?>