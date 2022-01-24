<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];

switch ($pilih){
	case "getsoal":
		$idtingkat		= $_POST["idtingkat"];
		$idsemester		= $_POST["idsemester"];
		$idjurusan		= $_POST["idjurusan"];
		
		include("soal_select_detail.php");
?>		
			

<?php		
		break;	
	
	default:
}
?>