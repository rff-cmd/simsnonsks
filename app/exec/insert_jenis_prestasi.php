<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_jenis_prestasi();
		
	if($hs){
?>
		<div class="alert alert-success">Save Jenis Prestasi successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Jenis Prestasi Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_jenis_prestasi($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Jenis Prestasi successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Jenis Prestasi Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_jenis_prestasi($_POST['replid']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Jenis Prestasi successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Jenis Prestasi Error Delete</div>
<?php		

	}
}
?>
