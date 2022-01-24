<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_soal();
		
	if($hs){
?>
		<div class="alert alert-success">Save Soal successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Soal Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_soal($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Soal successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Soal Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_soal($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Soal successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Soal Error Delete</div>
<?php		

	}
}
?>
