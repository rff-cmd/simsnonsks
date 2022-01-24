<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_konfigurasi();
		
	if($hs){
?>
		<div class="alert alert-success">Save Konfigurasi successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Konfigurasi Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_konfigurasi($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Konfigurasi successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Konfigurasi Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_konfigurasi($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Konfigurasi successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Konfigurasi Error Delete</div>
<?php		

	}
}
?>
