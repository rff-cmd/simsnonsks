<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_daftarpustaka();
		
	if($hs){
?>
		<div class="alert alert-success">Save Daftar Pustaka successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Daftar Pustaka Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_daftarpustaka($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Daftar Pustaka successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Daftar Pustaka Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_daftarpustaka($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Daftar Pustaka successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Daftar Pustaka Error Delete</div>
<?php		

	}
}
?>
