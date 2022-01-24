<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_setup_siswa_khusus();
		
	if($hs){
?>
		<div class="alert alert-success">Save Setup Siswa Khusus successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Setup Siswa Khusus Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_setup_siswa_khusus($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Setup Siswa Khusus successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Setup Siswa Khusus Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_setup_siswa_khusus($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Setup Siswa Khusus successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Setup Siswa Khusus Error Delete</div>
<?php		

	}
}
?>
