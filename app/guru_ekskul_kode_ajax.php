<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

$dbpdo = DB::create();

$pilih = $_POST["button"];
$exp = array();
$exp = explode("|", $pilih);

switch ($exp[0]){
	
	case "cekkode":
		$no			= $exp[1];
		$kode		= $_POST[kode_.$no];
		$replid		= $_POST[nip_.$no];
		
		$sqlstr 	= 	"select kode from guru where replid<>'$replid' and kode='$kode' limit 1";
		$sql		=	$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data 		= 	$sql->fetch(PDO::FETCH_OBJ); 
		$id_code	= 	$data->kode;
				
		if($id_code != '') {
?>		
			<input type="text" id="kode_<?php echo $no ?>" name="kode_<?php echo $no ?>" class="form-control" style="width: 100px" onblur="loadHTMLPost3('<?php echo $__folder ?>app/guru_ekskul_kode_ajax.php','kode_id<?php echo $no ?>','cekkode','nip_<?php echo $no ?>','kode_<?php echo $no ?>','<?php echo $no ?>')" value="" /><font color="#FF0000" size="-1">KODE sudah dipakai !</font>
<?php	
		} else {
?>
			<input type="text" id="kode_<?php echo $no ?>" name="kode_<?php echo $no ?>" class="form-control" style="width: 100px" onblur="loadHTMLPost3('<?php echo $__folder ?>app/guru_ekskul_kode_ajax.php','kode_id<?php echo $no ?>','cekkode','nip_<?php echo $no ?>','kode_<?php echo $no ?>','<?php echo $no ?>')" value="<?php echo $kode; ?>" >
            
<?php
		}
		
		break;
		
		
	case "cekkode_update":
		$no			= $exp[1];
		$kode		= $_POST[kode_.$no];
		$replid		= $_POST[nip_.$no];
		
		$sqlstr 	= 	"select kode from guru where replid<>'$replid' and kode='$kode' limit 1";
		$sql		=	$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data 		= 	$sql->fetch(PDO::FETCH_OBJ); 
		$id_code	= 	$data->kode;
				
		if($id_code != '') {
?>		
			<input type="text" id="kode_<?php echo $no ?>" name="kode_<?php echo $no ?>" class="form-control" style="width: 100px" onblur="loadHTMLPost3('../app/guru_ekskul_kode_ajax.php','kode_id<?php echo $no ?>','cekkode_update','nip_<?php echo $no ?>','kode_<?php echo $no ?>','<?php echo $no ?>')" value="" /><font color="#FF0000" size="-1">KODE sudah dipakai !</font>
<?php	
		} else {
?>
			<input type="text" id="kode_<?php echo $no ?>" name="kode_<?php echo $no ?>" class="form-control" style="width: 100px" onblur="loadHTMLPost3('../app/guru_ekskul_kode_ajax.php','kode_id<?php echo $no ?>','cekkode_update','nip_<?php echo $no ?>','kode_<?php echo $no ?>','<?php echo $no ?>')" value="<?php echo $kode; ?>" >
            
<?php
		}
			
	
	default:
}
?>