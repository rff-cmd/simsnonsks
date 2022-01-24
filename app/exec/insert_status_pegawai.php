<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_status_pegawai();
		
	if($hs){
?>
		<div class="alert alert-success">Save Status Pegawai successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Status Pegawai Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_status_pegawai($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Status Pegawai successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Status Pegawai Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	
	$ref = $_POST['replid'];
	$hs=$delete->delete_status_pegawai($_POST['replid']);
	if($hs){			
	
?>
		<div class="alert alert-success">Delete Status Pegawai successfully</div>
		
		
		
<?php
	}else{
?>
		<div class="alert alert-error">Status Pegawai Error Delete</div>
<?php		

	}
}
?>
