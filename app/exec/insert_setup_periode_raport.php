<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_setup_periode_raport();
		
	if($hs){
?>
		<div class="alert alert-success">Save Setup Periode Rapot successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Setup Periode Rapot Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_setup_periode_raport($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Setup Periode Rapot successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Setup Periode Rapot Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_setup_periode_raport($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Setup Periode Rapot successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Setup Periode Rapot Error Delete</div>
<?php		

	}
}
?>
