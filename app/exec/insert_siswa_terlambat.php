<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_siswa_terlambat();
		
	if($hs){
?>
		<div class="alert alert-success">Simpan successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_siswa_terlambat($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_siswa_terlambat($_POST['replid']);
	if($hs){			
?>
		<div class="alert alert-success">Hapus successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Error Delete</div>
<?php		

	}
}
?>
