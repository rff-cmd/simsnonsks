<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

//include '../app/class/class.select.php';
//$select=new select;

$pilih = $_POST["button"];
switch ($pilih){
	case "getkategori":
		$idkategori = $_POST["idkategori"];	
		$departemen = $_POST["departemen"];
			
?>		
		<select name="idpenerimaan" id="idpenerimaan" class="chosen-select form-control" />
			<option value=""></option>
			<?php select_datapenerimaan($idkategori, $departemen, ""); ?>
		</select>
		
<?php
		
		break;
		
	case "gettingkat":
		$idtingkat = $_POST["idtingkat2"];	
		$idangkatan = $_POST["idangkatan"];
			
?>		
		<option value=""></option>
		<?php select_kelas($idtingkat); ?>
		
<?php
		
		break;
		
	case "getlevel":
		$departemen = $_POST["departemen"];
			
?>		
		<select name="idtingkat2" id="idtingkat2" style="width:auto;  height:20px; font-size:12px; padding:0px; " onClick="loadHTMLPost2('app/besarjtt_ajax.php','idkelas2','gettingkat','idtingkat2', 'idangkatan')" >
			<option value=""></option>
			<?php select_tingkat_unit($departemen, ""); ?>
		</select>
		
<?php
		
		break;		
			
	default:
	
}
?>