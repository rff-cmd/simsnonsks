<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_tahunbuku();
		
	if($hs){
?>
		<div class="alert alert-success">Save Tahun Buku successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Tahun Buku Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_tahunbuku($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Tahun Buku successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Tahun Buku Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_tahunbuku($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Tahun Buku successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Tahun Buku Error Delete</div>
<?php		

	}
}
?>
