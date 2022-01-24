<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_predikat_raport();
		
	if($hs){
?>
		<div class="alert alert-success">Save Setup Predikat Raport successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Setup Predikat Raport Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_predikat_raport($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Setup Predikat Raport successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Setup Predikat Raport Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_predikat_raport($_POST['replid']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Setup Predikat Raport successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Setup Predikat Raport Error Delete</div>
<?php		

	}
}
?>
