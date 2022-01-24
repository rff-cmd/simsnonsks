<?php
	if($_SESSION["adm"] == 0) { 
 		$semester_id	= $_SESSION["semester_id"];
		$nis			= $_SESSION["nis"];
		
		$date = date("d-m-Y");
		if($protection->setup_periode("KRS", $date) == 1 || $protection->setup_siswa_khusus($nis, "KRS", $date) == 1) {
			if($nis != "" && ($semester_id != "" || $semester_id != "0")) {
				include("siswa_krs_pelajaran_detail.php");
			}
		} else {
			
			$message = '<font color="#ff0000">' . "Periode KRS sudah habis !";
			$message = $message . "</font>";
			echo $message;
			
		}
	}
	
	
	if($_SESSION["adm"] == 1) {	
		include("siswa_krs_pelajaran_detail.php");
	}
?>
 
