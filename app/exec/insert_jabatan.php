<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_jabatan();
		
	if($hs){
?>
		<div class="alert alert-success">Save Jabatan successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Jabatan Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_jabatan($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Jabatan successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Jabatan Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_jabatan($_POST['replid']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Jabatan successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Jabatan Error Delete</div>
<?php		

	}
}
?>
