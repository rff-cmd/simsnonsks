<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];

switch ($pilih){
	case "getkelas":
		$idtingkat2	= $_POST["idtingkat2"];
		
?>		
			<select name="idkelas2" id="idkelas2" class="chosen-select form-control" >
				<option value=""></option>
				<?php select_kelas($idtingkat2, $idkelas2); ?>
			</select>

<?php		
		break;	
	
	default:
}
?>