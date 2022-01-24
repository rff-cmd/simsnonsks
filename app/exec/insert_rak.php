<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_rak();
		
	if($hs){
?>
		<div class="alert alert-success">Save Rak successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Rak Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_rak($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Rak successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Rak Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_rak($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Rak successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Rak Error Delete</div>
<?php		

	}
}
?>
