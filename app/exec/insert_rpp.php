<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_rpp();
		
	if($hs){
?>
		<div class="alert alert-success">Save RPP (Renacana Pelaksanaan Pembelajaran) successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">RPP (Renacana Pelaksanaan Pembelajaran) Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_rpp($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update RPP (Renacana Pelaksanaan Pembelajaran) successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">RPP (Renacana Pelaksanaan Pembelajaran) Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_rpp($_POST['replid']);
	if($hs){			
?>
		<div class="alert alert-success">Delete RPP (Renacana Pelaksanaan Pembelajaran) successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">RPP (Renacana Pelaksanaan Pembelajaran) Error Delete</div>
<?php		

	}
}
?>
