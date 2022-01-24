<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_penulis();
		
	if($hs){
?>
		<div class="alert alert-success">Save Penulis successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Penulis Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_penulis($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Penulis successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Penulis Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_penulis($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Penulis successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Penulis Error Delete</div>
<?php		

	}
}
?>
