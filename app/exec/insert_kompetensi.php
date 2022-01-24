<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_kompetensi();
		
	if($hs){
?>
		<div class="alert alert-success">Save Kompetensi successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Kompetensi Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_kompetensi($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Kompetensi successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Kompetensi Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_kompetensi($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Kompetensi successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Kompetensi Error Delete</div>
<?php		

	}
}
?>
