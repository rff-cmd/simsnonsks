<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_semester();
		
	if($hs){
?>
		<div class="alert alert-success">Save Semester successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Semester Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_semester($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Semester successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Semester Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_semester($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Semester successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Semester Error Delete</div>
<?php		

	}
}
?>
