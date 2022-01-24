<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_pangkat();
		
	if($hs){
?>
		<div class="alert alert-success">Save Pangkat successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Pangkat Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_pangkat($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Pangkat successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pangkat Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	
	$ref = $_POST['replid'];
	$hs=$delete->delete_pangkat($_POST['replid']);
	if($hs){			
	
?>
		<div class="alert alert-success">Delete Pangkat successfully</div>
		
		
		
<?php
	}else{
?>
		<div class="alert alert-error">Pangkat Error Delete</div>
<?php		

	}
}
?>
