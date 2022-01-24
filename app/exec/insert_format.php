<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_format();
		
	if($hs){
?>
		<div class="alert alert-success">Save Format successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Format Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_format($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Format successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Format Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_format($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Format successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Format Error Delete</div>
<?php		

	}
}
?>
