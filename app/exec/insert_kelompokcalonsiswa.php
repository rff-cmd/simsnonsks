<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_kelompokcalonsiswa();
		
	if($hs){
?>
		<div class="alert alert-success">Save Kelompok Calon Siswa successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Kelompok Calon Siswa Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_kelompokcalonsiswa($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Kelompok Calon Siswa successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Kelompok Calon Siswa Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_kelompokcalonsiswa($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Kelompok Calon Siswa successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Kelompok Calon Siswa Error Delete</div>
<?php		

	}
}
?>
