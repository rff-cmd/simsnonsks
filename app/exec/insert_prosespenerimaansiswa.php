<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_prosespenerimaansiswa();
		
	if($hs){
?>
		<div class="alert alert-success">Save Proses Penerimaan Siswa successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Proses Penerimaan Siswa Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_prosespenerimaansiswa($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Proses Penerimaan Siswa successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Proses Penerimaan Siswa Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_prosespenerimaansiswa($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Proses Penerimaan Siswa successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Proses Penerimaan Siswa Error Delete</div>
<?php		

	}
}
?>
