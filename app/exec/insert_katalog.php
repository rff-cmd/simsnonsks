<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_katalog();
		
	if($hs){
?>
		<div class="alert alert-success">Save Katalog successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Katalog Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_katalog($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Katalog successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Katalog Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_katalog($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Katalog successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Katalog Error Delete</div>
<?php		

	}
}
?>
