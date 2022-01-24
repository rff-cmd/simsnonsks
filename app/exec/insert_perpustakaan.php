<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_perpustakaan();
		
	if($hs){
?>
		<div class="alert alert-success">Save Nama Perpustakaan successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Nama Perpustakaan Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_perpustakaan($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Nama Perpustakaan successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Nama Perpustakaan Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_perpustakaan($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Nama Perpustakaan successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Nama Perpustakaan Error Delete</div>
<?php		

	}
}
?>
