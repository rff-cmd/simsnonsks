<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_pelajaran();
		
	if($hs){
?>
		<div class="alert alert-success">Save Pelajaran successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Pelajaran Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_pelajaran($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Pelajaran successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pelajaran Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_pelajaran($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Pelajaran successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pelajaran Error Delete</div>
<?php		

	}
}
?>
