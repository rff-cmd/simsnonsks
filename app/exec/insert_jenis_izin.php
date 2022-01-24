<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_jenis_izin();
		
	if($hs){
?>
		<div class="alert alert-success">Save Jenis Izin Siswa successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Jenis Izin Siswa Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_jenis_izin($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Jenis Izin Siswa successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Jenis Izin Siswa Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_jenis_izin($_POST['replid']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Jenis Izin Siswa successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Jenis Izin Siswa Error Delete</div>
<?php		

	}
}
?>
