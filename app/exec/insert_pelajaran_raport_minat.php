<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_pelajaran_raport_minat();
		
	if($hs){
?>
		<div class="alert alert-success">Save Setup Raport Peminatan successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Setup Raport Peminatan Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_pelajaran_raport_minat($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Setup Raport Peminatan successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Setup Raport Peminatan Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_pelajaran_raport_minat($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Setup Raport Peminatan successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Setup Raport Peminatan Error Delete</div>
<?php		

	}
}
?>
