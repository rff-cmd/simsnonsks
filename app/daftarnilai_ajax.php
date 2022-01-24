<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];

switch ($pilih){
	case "getpelajaran":
		$idkelas	= $_POST["idkelas"];
		$idtingkat	= $_POST["idtingkat"];
		$semester_id= $_POST["semester_id"];
		
		include("jadwal_jam.php");
?>		
			

<?php		
		break;	
	
	default:
}
?>