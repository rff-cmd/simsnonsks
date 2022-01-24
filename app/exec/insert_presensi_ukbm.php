<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Save" ){
	
	$ref = notran(date('y-m-d'), 'frmpresensi_ukbm', '', '', ''); 
		
	$hs=$insert->insert_presensi_ukbm($ref);
		
	if($hs){
		
		notran(date('y-m-d'), 'frmpresensi_ukbm', '1', '', ''); 
?>
		<div class="alert alert-success">Save Presensi UKBM successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Presensi UKBM Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	//$hs=$update->update_presensi_ukbm($_POST['ref']);
	$hs=$insert->insert_presensi_ukbm($_POST['ref']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Presensi UKBM successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Presensi UKBM Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_presensi_ukbm($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Presensi UKBM successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Presensi UKBM Error Delete</div>
<?php		

	}
}
?>
