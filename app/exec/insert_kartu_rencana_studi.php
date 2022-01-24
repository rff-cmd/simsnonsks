<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_kartu_rencana_studi();
		
	if($hs){
?>
		<div class="alert alert-success">Save KRS successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">KRS Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_kartu_rencana_studi($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update KRS successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">KRS Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_kartu_rencana_studi($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete KRS successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">KRS Error Delete</div>
<?php		

	}
}
?>
