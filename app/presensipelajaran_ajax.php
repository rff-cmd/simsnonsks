<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];

switch ($pilih){
	case "getkrs":
		$semester_id	= $_POST["semester_id"];
		$nis			= $_POST["nis"];
		
		include("siswa_krs_pelajaran.php");
?>		
			

<?php		
		break;	
	
	default:
}
?>