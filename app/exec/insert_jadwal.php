<?php
include '../app/class/class.insert.php';
include '../app/class/class.update.php';
include '../app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_jadwal();
		
	if($hs){
?>
		<div class="alert alert-success">Save Jadwal successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Jadwal Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_jadwal($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Jadwal successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Jadwal Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_jadwal($_POST['idjadwal']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Jadwal successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Jadwal Error Delete</div>
<?php		

	}
}
?>
