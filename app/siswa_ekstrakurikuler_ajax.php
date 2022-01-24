<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];

switch ($pilih){
	case "getekstra":
		$idsiswa	= $_POST["idsiswa"];
		
		include("siswa_ekstrakurikuler_pelajaran.php");
?>		
			

<?php		
		break;	
	
	default:
}
?>