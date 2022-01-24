<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';

$insert=new insert;
$update=new update;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_guru_ekskul();
		
	if($hs){
?>
		<div class="alert alert-success">Save Guru Ekstrakurikuler successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Guru Ekstrakurikuler Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_guru_ekskul($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Guru Ekstrakurikuler successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Guru Ekstrakurikuler Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	include 'app/class/class.delete.php'; 
	$delete=new delete;
	
	$hs=$delete->delete_guru_ekskul($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Guru Ekstrakurikuler successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Guru Ekstrakurikuler Error Delete</div>
<?php		

	}
}
?>
