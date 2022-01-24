<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];

switch ($pilih){
	case "getjadwal":
		$hari		= $_POST["hari"];
		$idtingkat	= $_POST["idtingkat"];
		$idguru		= $_POST["idguru"];
		
		include("jadwal_jam.php");
?>		
			

<?php		
		break;	
	
	default:
}
?>