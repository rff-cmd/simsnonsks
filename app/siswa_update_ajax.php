<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];

$__folder = "../";

switch ($pilih){
	case "getkelas":
		$idtingkat	= $_POST["idtingkat"];
		
?>		
			<select name="idkelas" id="idkelas" class="chosen-select form-control" >
				<option value=""></option>
				<?php select_kelas($idtingkat, ""); ?>
			</select>

<?php		
		break;
	
	case "getkota":
		$provinsi_kode	= $_POST["provinsi_kode"];
?>		
			<select name="kota_kode" id="kota_kode" class="chosen-select form-control" onChange="loadHTMLPost2('<?php echo $__folder ?>app/siswa_update_ajax.php','kecamatan','getkecamatan','kota_kode')" >										<option value=""></option>
				<?php select_kota($provinsi_kode, $row_siswa->kota_kode); ?>
			</select>

<?php		
		break;
		
	case "getkecamatan":
		$kota_kode	= $_POST["kota_kode"];
?>		
			<select name="kecamatan_kode" id="kecamatan_kode" class="chosen-select form-control" onChange="loadHTMLPost2('<?php echo $__folder ?>app/siswa_update_ajax.php','kelurahan','getdesa','kecamatan_kode')" >								<option value=""></option>
					<?php select_kecamatan($kota_kode, $row_siswa->kecamatan_kode); ?>
				</select>

<?php		
		break;
		
	case "getdesa":
		$kecamatan_kode	= $_POST["kecamatan_kode"];
?>		
			<select name="desa_kode" id="desa_kode" class="chosen-select form-control" >										<option value=""></option>
				<?php select_desa($kecamatan_kode, $row_siswa->desa_kode); ?>
			</select>

<?php		
		break;
			
	
	default:
}
?>