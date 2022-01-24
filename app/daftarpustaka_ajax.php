<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

$dbpdo = DB::create();

$pilih = $_POST["button"];
switch ($pilih){
	case "getpustaka":
		
		$departemen	= $_POST["departemen"];
		
?>		
		<select name="pustaka" id="pustaka" class='cho' style="width:min-width:10px; height:27px; " >
			<option value="">...</option>
			<?php select_pustaka($departemen, $daftarpustaka_data->pustaka); ?>
		</select>
<?php
		
		break;
		
	case "cekkodepustaka":
		$id			= $_POST["id"];
		$kodepustaka= $_POST["kodepustaka"];
		
		$sqlstr = "select kodepustaka from daftarpustaka where replid<>'$id' and kodepustaka='$kodepustaka' limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_OBJ);
		$n_kodepustaka = $data->kodepustaka;
			
		
		if($n_kodepustaka != '') {
?>		
			<input type="text" name="kodepustaka" id="kodepustaka" style="width:250px; height:16px; " onblur="loadHTMLPost3('app/daftarpustaka_ajax.php','kodepustaka_id','cekkodepustaka','id','kodepustaka')" value="">
			<font color="#FF0000" size="-1">Kode Pustaka sudah ada !</font>	
<?php	
		} else {
?>
			<input type="text" name="kodepustaka" id="kodepustaka" style="width:250px; height:16px; " onblur="loadHTMLPost3('app/daftarpustaka_ajax.php','kodepustaka_id','cekkodepustaka','id','kodepustaka')" value="<?php echo $kodepustaka ?>">
<?php
		}
		
		break;	
			
	default:
	
}
?>