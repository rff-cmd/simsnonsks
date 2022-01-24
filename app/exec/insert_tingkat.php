<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_tingkat();
		
	if($hs){
?>
		<div class="alert alert-success">Save Tingkat successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Tingkat Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_tingkat($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Tingkat successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Tingkat Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_tingkat($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Tingkat successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Tingkat Error Delete</div>
<?php		

	}
}
?>
