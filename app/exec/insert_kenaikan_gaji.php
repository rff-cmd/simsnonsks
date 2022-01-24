<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
//include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
//$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_kenaikan_gaji();
		
	if($hs){
?>
		<div class="alert alert-success">Save Kenaikan Gaji successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Kenaikan Gaji Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_kenaikan_gaji($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Kenaikan Gaji successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Kenaikan Gaji Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_kenaikan_gaji($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Kenaikan Gaji successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Kenaikan Gaji Error Delete</div>
<?php		

	}
}
?>
