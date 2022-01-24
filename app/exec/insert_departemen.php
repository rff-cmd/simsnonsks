<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_departemen();
		
	if($hs){
?>
		<div class="alert alert-success">Save Unit successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Unit Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_departemen($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Unit successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Unit Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_departemen($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Unit successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Unit Error Delete</div>
<?php		

	}
}
?>
