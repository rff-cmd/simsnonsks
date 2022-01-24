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
			<select name="idkelas" id="idkelas" class="chosen-select form-control" >
				<option value=""></option>
				<?php select_kelas($idtingkat, ""); ?>
			</select>

<?php		
		break;
	
	case "getkota":
		$provinsi_kode	= $_POST["provinsi_kode"];
?>		
			<select name="kota_kode" id="kota_kode" class="chosen-select form-control" onChange="loadHTMLPost2('<?php echo $__folder ?>app/siswa_ajax.php','kecamatan','getkecamatan','kota_kode')" >										<option value=""></option>
				<?php select_kota($provinsi_kode, $row_siswa->kota_kode); ?>
			</select>

<?php		
		break;
	
	case "getkota_update":
		$provinsi_kode	= $_POST["provinsi_kode"];		
?>		
			<select name="kota_kode" id="kota_kode" class="chosen-select form-control" onChange="loadHTMLPost2('../../<?php echo $__folder ?>app/siswa_ajax.php','kecamatan','getkecamatan_update','kota_kode')" >										
			<option value=""></option>
				<?php select_kota($provinsi_kode, $row_siswa->kota_kode); ?>
			</select>

<?php		
		break;
		
	case "getkecamatan":
		$kota_kode	= $_POST["kota_kode"];
?>		
			<select name="kecamatan_kode" id="kecamatan_kode" class="chosen-select form-control" onChange="loadHTMLPost2('<?php echo $__folder ?>app/siswa_ajax.php','kelurahan','getdesa','kecamatan_kode')" >								<option value=""></option>
					<?php select_kecamatan($kota_kode, $row_siswa->kecamatan_kode); ?>
			</select>
				
				

<?php		
		break;
		
	case "getkecamatan_update":
		$kota_kode	= $_POST["kota_kode"];
?>		
			<select name="kecamatan_kode" id="kecamatan_kode" class="chosen-select form-control" onChange="loadHTMLPost2('../../<?php echo $__folder ?>app/siswa_ajax.php','kelurahan','getdesa','kecamatan_kode')" >								<option value=""></option>
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

	case "gettingkat":
		$departemen	= $_POST["departemen"];
		
?>		
			<select name="idtingkat" id="idtingkat" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/siswa_ajax.php','kelas_id','getkelas','idtingkat')" >
				<option value=""></option>
				<?php select_tingkat_unit($departemen, ""); ?>
			</select>
<?php
		break;		

	case "gettingkat_list":
		$departemen	= $_POST["departemen"];
		
?>		
			<select name="idtingkat2" id="idtingkat2" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/siswa_list_ajax.php','kelas_id','getkelas','idtingkat2')" >
				<option value=""></option>
				<?php select_tingkat_unit($departemen, $idtingkat2); ?>
			</select>	
<?php
		break;	

	
	default:
}
?>