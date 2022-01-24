<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_kelompok_surat();
		
	if($hs){
?>
		<div class="alert alert-success">Save Kelompok Surat successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Kelompok Surat Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_kelompok_surat($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Kelompok Surat successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Kelompok Surat Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_kelompok_surat($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Kelompok Surat successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Kelompok Surat Error Delete</div>
<?php		

	}
}
?>
