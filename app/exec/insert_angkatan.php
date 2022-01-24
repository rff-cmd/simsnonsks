<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_angkatan();
		
	if($hs){
?>
		<div class="alert alert-success">Save Angkatan successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Angkatan Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_angkatan($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Angkatan successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Angkatan Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_angkatan($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Angkatan successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Angkatan Error Delete</div>
<?php		

	}
}
?>
