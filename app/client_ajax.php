<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
include '../app/class/class.selectview.php';
$select=new select;
$selectview=new selectview;

$pilih = $_POST["button"];

switch ($pilih){
	case "cek_name":
		$name	= $_POST["name"];
		$name	= strtoupper(substr($name, 0, 3));
		$ref2 = notran(date('Y-m-d'), 'frmclient', '', '', $name);
		
?>		
			<input type="text" id="code" name="code" class="form-control" readonly="" value="<?php echo $ref2 ?>">
<?php		
		break;	
	
	default:
}
?>