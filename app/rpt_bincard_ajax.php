<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
include '../app/class/class.selectview.php';
$select=new select;
$selectview=new selectview;

$pilih = $_POST["button"];

switch ($pilih){
	case "get_itemname":
	
		$item_code	= $_POST["item_code"];
		$sql = $selectview->get_item($item_code);
		$data = $sql->fetch(PDO::FETCH_OBJ);
		$item_name = $data->item_name;
		
		
?>		
			<input type="text" id="item_name" name="item_name" style="font-size: 12px" class="form-control" readonly="" value="<?php echo $item_name ?>">

<?php		
		break;	
	
	default:
}
?>