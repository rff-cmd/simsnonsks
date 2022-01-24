<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_ukbm();
		
	if($hs){
?>
		<div class="alert alert-success">Save UKBM (Unit Kegiatan Belajar Mandiri) successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">UKBM (Unit Kegiatan Belajar Mandiri) Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_ukbm($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update UKBM (Unit Kegiatan Belajar Mandiri) successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">UKBM (Unit Kegiatan Belajar Mandiri) Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_ukbm($_POST['replid']);
	if($hs){			
?>
		<div class="alert alert-success">Delete UKBM (Unit Kegiatan Belajar Mandiri) successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">UKBM (Unit Kegiatan Belajar Mandiri) Error Delete</div>
<?php		

	}
}
?>
