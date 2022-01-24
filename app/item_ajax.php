<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
include '../app/class/class.selectview.php';
$select=new select;
$selectview=new selectview;

$pilih = $_POST["button"];

switch ($pilih){
	case "getbarcode":
		$item_group_id	= $_POST["item_group_id"];
		$sql = $select->list_item_group($item_group_id);
		$data = $sql->fetch(PDO::FETCH_OBJ);
		
		//$date = date("Y-m-d");
		//$barcode = notran($date, 'frmitembarcode', '', '', $data->code);
		
		//get code item terakhir;
		$last_code = $selectview->list_item_last_code($item_group_id);
		$barcode = $last_code;
		
?>		
			<input type="text" id="code" name="code" maxlength="6" onblur="loadHTMLPost3('app/item_ajax_code.php','code_item','cekcode_item','syscode','code')" class="form-control" value="<?php echo $barcode ?>" />
			<!--<input type="text" id="old_code" name="old_code" class="form-control" value="<?php echo $barcode ?>">-->

<?php		
		break;	
	
	default:
}
?>