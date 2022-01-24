<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Save" ){
	
	$hs=$insert->insert_departemen();
	
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Save Unit successfully</strong>
		</div>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Unit Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_departemen($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Unit successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Unit Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_departemen($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Unit successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Unit Error Delete</strong>
		</div>
<?php		

	}
}
?>
