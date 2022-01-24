<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Save" ){
		
	$hs=$insert->insert_ukbm_siswa();
		
	if($hs){
?>
		<div class="alert alert-success">Save Mengajukan Ujian UKBM successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Mengajukan Ujian UKBM Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_ukbm_siswa($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Mengajukan Ujian UKBM successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Mengajukan Ujian UKBM Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_ukbm_siswa($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Mengajukan Ujian UKBM successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Mengajukan Ujian UKBM Error Delete</div>
<?php		

	}
}
?>
