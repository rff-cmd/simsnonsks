<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_raport_siswa();
		
	if($hs){
?>
		<div class="alert alert-success">Save Raport Siswa successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Raport Siswa Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_raport_siswa($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Raport Siswa successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Raport Siswa Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_raport_siswa($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Raport Siswa successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Raport Siswa Error Delete</div>
<?php		

	}
}
?>
