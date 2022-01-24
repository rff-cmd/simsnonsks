<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_jeniskompetensi();
		
	if($hs){
?>
		<div class="alert alert-success">Save Jenis Kompetensi successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Jenis Kompetensi Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_jeniskompetensi($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Jenis Kompetensi successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Jenis Kompetensi Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_jeniskompetensi($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Jenis Kompetensi successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Jenis Kompetensi Error Delete</div>
<?php		

	}
}
?>
