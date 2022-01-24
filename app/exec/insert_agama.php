<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_agama();
		
	if($hs){
?>
		<div class="alert alert-success">Save Agama successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Agama Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_agama($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Agama successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Agama Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_agama($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Agama successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Agama Error Delete</div>
<?php		

	}
}
?>
