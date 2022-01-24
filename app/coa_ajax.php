<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

$pilih = $_POST["button"];
switch ($pilih){
	case "getacctpe":
		$acc_type = $_POST["acc_type"];	
		
?>		
		<select name="subacc_code" id="subacc_code" class="chosen-select form-control" style="width:400px;" >
			<option value="" selected>Pilih Sub Akun</option>
			<?php combo_select_active2("coa", "syscode", "name", "acc_type", $acc_type, ""); ?>							
		</select>
		
<?php
		break;
		
	default:
}
?>