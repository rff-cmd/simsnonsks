<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_tahunajaran();
		
	if($hs){
?>
		<div class="alert alert-success">Save Tahun Ajaran successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Tahun Ajaran Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_tahunajaran($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Tahun Ajaran successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Tahun Ajaran Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_tahunajaran($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Tahun Ajaran successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Tahun Ajaran Error Delete</div>
<?php		

	}
}
?>
