<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_penerbit();
		
	if($hs){
?>
		<div class="alert alert-success">Save Penerbit successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Penerbit Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_penerbit($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Penerbit successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Penerbit Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_penerbit($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Penerbit successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Penerbit Error Delete</div>
<?php		

	}
}
?>
