<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Save" ){
	
	$hs=$insert->insert_item_group();
	
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Save Item Group successfully</strong>
		</div>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Item Group Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_item_group($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Item Group successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Item Group Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_item_group($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Item Group successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Item Group Error Delete</strong>
		</div>
<?php		

	}
}
?>
