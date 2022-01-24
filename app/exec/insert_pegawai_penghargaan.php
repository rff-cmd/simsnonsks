<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
//include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
//$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_pegawai_penghargaan();
		
	if($hs){
?>
		<div class="alert alert-success">Save Pegawai Pengahargaan successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Pegawai Pengahargaan Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_pegawai_penghargaan($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Pegawai Pengahargaan successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pegawai Pengahargaan Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_pegawai_penghargaan($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Pegawai Pengahargaan successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pegawai Pengahargaan Error Delete</div>
<?php		

	}
}
?>
