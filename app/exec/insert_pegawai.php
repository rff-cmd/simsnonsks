<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_pegawai();
		
	if($hs){
?>
		<div class="alert alert-success">Save Pegawai successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Pegawai Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_pegawai($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Pegawai successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pegawai Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_pegawai($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Pegawai successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pegawai Error Delete</div>
<?php		

	}
}
?>
