<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_statusguru();
		
	if($hs){
?>
		<div class="alert alert-success">Save Status Guru successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Status Guru Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_statusguru($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Status Guru successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Status Guru Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_statusguru($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Status Guru successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Status Guru Error Delete</div>
<?php		

	}
}
?>
