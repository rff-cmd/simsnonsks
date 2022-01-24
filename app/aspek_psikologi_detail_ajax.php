<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

$dbpdo = DB::create();

$pilih = $_POST["button"];

switch ($pilih){
	case "cekjenis":
		
		$departemen	= $_POST["departemen"];
		
?>		
		<select name="jenis_aspek_id" id="jenis_aspek_id" class='cho' style="min-width: 178px; height:27px; " >
			<option value="">...</option>
			<?php select_aspek_psikologi($departemen, $aspek_psikologi_detail_data->jenis_aspek_id); ?>
		</select>

<?php

		break;	
			
	default:
	
}
?>