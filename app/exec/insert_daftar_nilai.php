<?php
include '../app/class/class.insert.php';
include '../app/class/class.update.php';
include '../app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_daftarnilai();
		
	if($hs){
?>
		<div class="alert alert-success">Save Daftar Nilai successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Daftar Nilai Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_daftarnilai($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Daftar Nilai successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Daftar Nilai Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_daftarnilai($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Daftar Nilai successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Daftar Nilai Error Delete</div>
<?php		

	}
}
?>
