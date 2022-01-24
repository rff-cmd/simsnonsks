<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Save" ){
	
	$hs=$insert->insert_asset_type();
	
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Save Jenis Sarana & Prasarana successfully</strong>
		</div>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Jenis Sarana & Prasarana Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_asset_type($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Jenis Sarana & Prasarana successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Jenis Sarana & Prasarana Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_asset_type($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Jenis Sarana & Prasarana successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Jenis Sarana & Prasarana Error Delete</strong>
		</div>
<?php		

	}
}
?>
