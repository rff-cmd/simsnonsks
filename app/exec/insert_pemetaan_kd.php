<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_pemetaan_kd();
		
	if($hs){
?>
		<div class="alert alert-success">Save Pemetaan KD successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Pemetaan KD Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_pemetaan_kd($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Pemetaan KD successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pemetaan KD Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_pemetaan_kd($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Pemetaan KD successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pemetaan KD Error Delete</div>
<?php		

	}
}
?>
