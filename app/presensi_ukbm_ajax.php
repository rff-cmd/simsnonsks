<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];

switch ($pilih){
	case "getkelas":
		$idtingkat	= $_POST["idtingkat"];
		
?>		
			<select name="idkelas" id="idkelas" class="chosen-select form-control" onchange="loadHTMLPost4('<?php echo $__folder ?>app/presensi_ukbm_ajax.php','siswa_id','getsiswa','idtingkat','idkelas')" >
				<option value=""></option>
				<?php select_kelas($idtingkat, $idkelas); ?>
			</select>

<?php		
		break;	
		
	case "getsiswa":
		$idtingkat	= $_POST["idtingkat"];
		$idkelas	= $_POST["idkelas"];
		
		if(!empty($idtingkat) && !empty($idkelas)) {
			include("presensi_ukbm_detail.php");	
		}
		
?>		
			<!--<script>
				window.location = '<?php echo $__folder ?><?php echo obraxabrix(presensi_ukbm) ?>/<?php echo $idtingkat ?>/<?php echo $idkelas ?>';		
			</script>-->

<?php		
		break;
	
	default:
}
?>