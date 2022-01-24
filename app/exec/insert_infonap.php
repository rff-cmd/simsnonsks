<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_infonap();
		
	if($hs){
?>
		<div class="alert alert-success">Save Setup Minat Nilai UN successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Setup Minat Nilai UN Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_infonap($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Setup Minat Nilai UN successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Setup Minat Nilai UN Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_infonap($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Setup Minat Nilai UN successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Setup Minat Nilai UN Error Delete</div>
<?php		

	}
}
?>
