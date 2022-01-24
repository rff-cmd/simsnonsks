<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
	
	$nis = $_POST["nis"];	
	$hs=$insert->insert_siswa_krs($nis);
		
	if($hs){
?>
		<div class="alert alert-success">Save Approved KRS Siswa successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Approved KRS Siswa Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_siswa_krs_approved($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Approved KRS Siswa successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Approved KRS Siswa Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_siswa_krs($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Approved KRS Siswa successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Approved KRS Siswa Error Delete</div>
<?php		

	}
}
?>
