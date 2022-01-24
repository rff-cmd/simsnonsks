<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
//include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
//$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_pegawai_pendidikan();
		
	if($hs){
?>
		<div class="alert alert-success">Save Pegawai Pendidikan successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Pegawai Pendidikan Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_pegawai_pendidikan($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Pegawai Pendidikan successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pegawai Pendidikan Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_pegawai_pendidikan($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Pegawai Pendidikan successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pegawai Pendidikan Error Delete</div>
<?php		

	}
}
?>
