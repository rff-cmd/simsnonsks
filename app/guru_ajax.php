<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];

switch ($pilih){
	case "geteguru":
		$idpelajaran	= $_POST["idpelajaran"];
		
		include("guru_pelajaran.php");
?>		
			

<?php		
		break;	
	
	default:
}
?>