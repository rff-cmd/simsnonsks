<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_gugus();
		
	if($hs){
?>
		<div class="alert alert-success">Save Gugus successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Gugus Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_gugus($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Gugus successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Gugus Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_gugus($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Gugus successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Gugus Error Delete</div>
<?php		

	}
}
?>
