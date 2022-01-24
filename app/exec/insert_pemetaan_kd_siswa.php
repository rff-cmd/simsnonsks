<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_pemetaan_kd_siswa();
		
	if($hs){
?>
		<div class="alert alert-success">Save Pemetaan KD Siswa successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Pemetaan KD Siswa Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_pemetaan_kd_siswa($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Pemetaan KD Siswa successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pemetaan KD Siswa Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_pemetaan_kd_siswa($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Pemetaan KD Siswa successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pemetaan KD Siswa Error Delete</div>
<?php		

	}
}
?>
