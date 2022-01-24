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
		$semester_id	= $_POST["semester_id"];
		$nis			= $_POST["nis"];
		
		$date = date("d-m-Y");
		if($protection->setup_periode("KRS", $date) == 1) {
			if($nis != "" && ($semester_id != "" || $semester_id != "0")) {
				$sqlprotect = $select->protection_krs($nis);
				$data_protect = $sqlprotect->fetch(PDO::FETCH_OBJ);
				
				$message = "";
				
				//IPDB
				$sqlprotect1 = $selectview->protected_penerimaan($nis, "IPDB");
				$data_protect1 = $sqlprotect1->fetch(PDO::FETCH_OBJ);
				
				//IBPD				
				$sqlprotect2 = $selectview->protected_penerimaan($nis, "IBPD");
				$data_protect2 = $sqlprotect2->fetch(PDO::FETCH_OBJ);
				
				$besar = $data_protect2->besar;
				$jumlah = $data_protect2->jumlah;
				
				if($besar == 0) {
					$protect = 0;	
				} else {
					$protect = ($jumlah/$besar) * 100;
				}
							
				if( ($data_protect->jalurmasuk_id != "" && $data_protect->jalurmasuk_id != "0") || $data_protect1->jumlah > 0 || $protect >= 20 ) {
					include("siswa_krs_pelajaran.php");
				} else {
					
					$message = '<font color="#ff0000">' . "Siswa belum bisa mengisi KRS : " . "<br>";
					if($data_protect1->jumlah == 0 || $data_protect1->jumlah == "") {
						$message = $message . "- Siswa tidak mempunyai jalur masuk !" . "<br>";
					}
					
					if($protect < 20) {
						$message = $message . "- Pembayaran IBPD belum memenuhi 20% (dua puluh persen) !" . "<br>";
					}
					
					if( empty($data_protect1->jumlah) ) {
						$message = $message . "- Belum pernah membayar IPDB !" . "<br>";
					}
					
					$message = $message . "- Dimohon mengurus Administrasi Keuangan" . "<br>";
					
					$message = $message . "</font>";
					echo $message;
				}
			}
		} else {
			
			$message = '<font color="#ff0000">' . "Periode KRS sudah habis !";
			$message = $message . "</font>";
			echo $message;
			
		}
		
		
?>		
			

<?php		
		break;	
	
	default:
}
?>
