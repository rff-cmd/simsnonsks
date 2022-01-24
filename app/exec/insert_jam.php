<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_jam();
		
	if($hs){
?>
		<div class="alert alert-success">Save Jam Master successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Jam Master Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_jam($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Jam Master successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Jam Master Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_jam($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Jam Master successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Jam Master Error Delete</div>
<?php		

	}
}
?>
