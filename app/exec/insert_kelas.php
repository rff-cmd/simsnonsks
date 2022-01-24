<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_kelas();
		
	if($hs){
?>
		<div class="alert alert-success">Save Kelas successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Kelas Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_kelas($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Kelas successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Kelas Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_kelas($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Kelas successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Kelas Error Delete</div>
<?php		

	}
}
?>
