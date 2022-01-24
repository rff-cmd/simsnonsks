<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

//include '../app/class/class.select.php';
//$select=new select;

$pilih = $_POST["button"];
switch ($pilih){
	
	case "gettingkat":
		$departemen = $_POST["departemen"];	
			
?>		
		<option value=""></option>
		<?php select_tingkat_unit($departemen, ""); ?>

<?php
		
		break;
				
	case "getkelas":
		$idtingkat = $_POST["idtingkat"];	
			
?>		
		<option value=""></option>
		<?php select_kelas($idtingkat, ""); ?>
				
<?php
		
		break;
			
	default:
	
}
?>