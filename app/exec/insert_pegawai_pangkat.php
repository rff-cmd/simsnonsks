<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_pegawai_pangkat();
		
	if($hs){
?>
		<div class="alert alert-success">Save Pegawai Pangkat successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Pegawai Pangkat Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_pegawai_pangkat($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Pegawai Pangkat successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pegawai Pangkat Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_pegawai_pangkat($_POST['replid']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Pegawai Pangkat successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pegawai Pangkat Error Delete</div>
<?php		

	}
}
?>
