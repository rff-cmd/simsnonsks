<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];

switch ($pilih){
	case "getitem":
		$code		= $_POST["code"];
		$old_code	= $_POST["old_code"];
		$sql = $select->list_item("", "", "", $code, $old_code);
		$data = $sql->fetch(PDO::FETCH_OBJ);
		
?>		
			<input type="text" id="name" name="name" class="form-control" value="<?php echo $data->name ?>" />

<?php		
		break;	
	
	default:
}
?>