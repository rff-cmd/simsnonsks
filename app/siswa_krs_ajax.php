<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

include '../app/class/class.selectview.php';
$selectview=new selectview;

include '../app/class/class.protection.php';
$protection=new protection;

$pilih = $_POST["button"];

switch ($pilih){
	case "getkrs":
		if($_SESSION["adm"] == 0) {
			$semester_id	= $_POST["semester_id"];
			$nis			= $_POST["nis"];
			
			$sqlsiswa = $select->list_siswa($nis);
			$datasiswa = $sqlsiswa->fetch(PDO::FETCH_OBJ);
			$idminat = $datasiswa->idminat;
			
			$date = date("d-m-Y");
			if($protection->setup_periode("KRS", $date) == 1) {
				if($nis != "" && ($semester_id != "" || $semester_id != "0")) {
					include("siswa_krs_pelajaran.php");
				}
			} else {
				
				$message = '<font color="#ff0000">' . "Periode KRS sudah habis !";
				$message = $message . "</font>";
				echo $message;
				
			}
		}
		
		if($_SESSION["adm"] == 1 || $_SESSION["tipe_user"] == "Guru") {		
			$semester_id	= $_POST["semester_id"];
			$nis			= $_POST["nis"];
			
			$sqlsiswa = $select->list_siswa($nis);
			$datasiswa = $sqlsiswa->fetch(PDO::FETCH_OBJ);
			$idminat = $datasiswa->idminat;
			
			include("siswa_krs_pelajaran.php");
		}
		
		
?>		
			

<?php		
		break;	
	
	default:
}
?>
