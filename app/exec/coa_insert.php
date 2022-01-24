<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php';

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Save" ){

	$hs=$insert->insert_coa();
	
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Save Rekening Perkiraan successfully</strong>
		</div>

<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Rekening Perkiraan Error Save</strong>
		</div>
<?php
	}
}

if ($post == "Update" ){
	$hs=$update->update_coa($_POST['syscode']);
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Update Rekening Perkiraan successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Rekening Perkiraan Error Update</strong>
		</div>
<?php

	}
}

if ($post == "Delete" ){
	$hs=$delete->delete_coa($_POST['syscode']);
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Delete Rekening Perkiraan successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Rekening Perkiraan Error Delete</strong>
		</div>
<?php

	}
}
?>
