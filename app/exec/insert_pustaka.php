<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_pustaka();
		
	if($hs){
?>
		<div class="alert alert-success">Save Pustaka successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Pustaka Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_pustaka($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Pustaka successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pustaka Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_pustaka($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Pustaka successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pustaka Error Delete</div>
<?php		

	}
}
?>
