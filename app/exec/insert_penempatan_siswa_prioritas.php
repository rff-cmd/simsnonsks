<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_penempatan_siswa_prioritas();
		
	if($hs){
?>
		<div class="alert alert-success">Save Setup Penempatan Siswa Prioritas successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Setup Penempatan Siswa Prioritas Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_penempatan_siswa_prioritas($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Setup Penempatan Siswa Prioritas successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Setup Penempatan Siswa Prioritas Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_penempatan_siswa_prioritas($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Setup Penempatan Siswa Prioritas successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Setup Penempatan Siswa Prioritas Error Delete</div>
<?php		

	}
}
?>
