<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_jenis_sertifikasi();
		
	if($hs){
?>
		<div class="alert alert-success">Save Jenis Sertifikasi successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Jenis Sertifikasi Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_jenis_sertifikasi($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Jenis Sertifikasi successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Jenis Sertifikasi Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	
	$ref = $_POST['replid'];
	$hs=$delete->delete_jenis_sertifikasi($_POST['replid']);
	if($hs){			
	
?>
		<div class="alert alert-success">Delete Jenis Sertifikasi successfully</div>
		
		
		
<?php
	}else{
?>
		<div class="alert alert-error">Jenis Sertifikasi Error Delete</div>
<?php		

	}
}
?>
