<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';

$insert=new insert;
$update=new update;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_guru();
		
	if($hs){
?>
		<div class="alert alert-success">Save Guru successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Guru Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_guru($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Guru successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Guru Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	include 'app/class/class.delete.php'; 
	$delete=new delete;
	
	$hs=$delete->delete_guru($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Guru successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Guru Error Delete</div>
<?php		

	}
}
?>
