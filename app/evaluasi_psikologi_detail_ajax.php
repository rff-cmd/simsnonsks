<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];
switch ($pilih){
	
	case "get_jenisaspek_psikologi":
		$departemen = $_POST["departemen"];
		$nis = $_POST["nis"];
		$idsemester = $_POST["idsemester"];
		
?>		
		
		<br><br>		
		

<?php	
			if(!empty($departemen) && !empty($nis) && !empty($idsemester)) {
				$sql=$select->list_evaluasi_psikologi($ref, $departemen, $nis, $idsemester);
				$rows = $sql->rowCount();
				if($rows == 0) {
					include("evaluasi_psikologi_detail_new.php");
				} else {
					include("evaluasi_psikologi_detail_get.php");
				}
			}
			

		break;
		
        				
	default:
	
}
?>