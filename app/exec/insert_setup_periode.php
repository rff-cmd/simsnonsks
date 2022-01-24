<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_setup_periode();
		
	if($hs){
?>
		<div class="alert alert-success">Save Setup Periode successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Setup Periode Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_setup_periode($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Setup Periode successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Setup Periode Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_setup_periode($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Setup Periode successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Setup Periode Error Delete</div>
<?php		

	}
}
?>
