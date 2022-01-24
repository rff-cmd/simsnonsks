<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];

switch ($pilih){
	case "getdata":
        $peminatan  = $_POST["peminatan"];
		$tingkat_id	= $_POST["tingkat_id"];
        $kelompok_pelajaran_id = $_POST["kelompok_pelajaran_id"];
        $urutan = $_POST["urutan"];
		
        if($peminatan == "MATEMATIKA") {
            $peminatan = "1";
        }
        if($peminatan == "MIPA") {
            $peminatan = "2";
        }
        if($peminatan == "IPS") {
            $peminatan = "3";
        }
        
        $semester = "";
        $semester1 = "";
        if($tingkat_id == 27) {
            $semester = "1";
            $semester1 = "2";
        }
        if($tingkat_id == 28) {
            $semester = "3";
            $semester1 = "4";
        }
        if($tingkat_id == 46) {
            $semester = "5";
            $semester1 = "6";
        }

        if($kelompok_pelajaran_id == 1) { //Kelompok A (Umum)
            $kode1 = "MPW".$peminatan."0".$urutan.$semester;
            $kode2 = "MPW".$peminatan."0".$urutan.$semester1;
        }
        if($kelompok_pelajaran_id == 2) { //Kelompok B (Umum)
            $kode1 = "MPW".$peminatan."0".$urutan.$semester;
            $kode2 = "MPW".$peminatan."0".$urutan.$semester1;
        }
        if($kelompok_pelajaran_id == 3) { //Kelompok C (Peminatan)
            $kode1 = "MPM".$peminatan."0".$urutan.$semester;
            $kode2 = "MPM".$peminatan."0".$urutan.$semester1;
        }
        if($kelompok_pelajaran_id == 4) { //Kelompok C (Pilihan Lintas Peminatan)
            $kode1 = "MPP".$peminatan."0".$urutan.$semester;
            $kode2 = "MPP".$peminatan."0".$urutan.$semester1;
        }

        
?>		
			<input type="text" id="kode1" name="kode1" class="form-control" value="<?php echo $kode1 ?>">							
            <span class="input-group-addon">
            Smt Genap
            </span>							
            <input type="text" id="kode2" name="kode2" class="form-control" value="<?php echo $kode2 ?>">

<?php		
		break;
	
	default:
}
?>