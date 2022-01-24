<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
//include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
//$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_pegawai_prestasi();
		
	if($hs){
?>
		<div class="alert alert-success">Save Pegawai Prestasi successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Pegawai Prestasi Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_pegawai_prestasi($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Pegawai Prestasi successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pegawai Prestasi Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_pegawai_prestasi($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Pegawai Prestasi successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pegawai Prestasi Error Delete</div>
<?php		

	}
}
?>
