<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_jenis_pelanggaran();
		
	if($hs){
?>
		<div class="alert alert-success">Save Jenis Pelanggaran successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Jenis Pelanggaran Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_jenis_pelanggaran($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Jenis Pelanggaran successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Jenis Pelanggaran Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_jenis_pelanggaran($_POST['replid']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Jenis Pelanggaran successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Jenis Pelanggaran Error Delete</div>
<?php		

	}
}
?>
