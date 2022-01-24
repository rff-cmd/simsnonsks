<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];

switch ($pilih){
	case "getsoal_ukbm":
		$idtingkat		= $_POST["idtingkat"];
		$idsemester		= $_POST["idsemester"];
		$idjurusan		= $_POST["idjurusan"];
		$idukbm			= $_POST["idukbm"];
		
		include("soal_ukbm_select_detail.php");
?>		
			

<?php		
		break;	
	
	default:
}
?>