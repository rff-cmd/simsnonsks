<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Selesai" ){
		
	$hs=$insert->insert_soal_siswa();
		
	if($hs){
?>
		<div class="alert alert-success">Save Jawaban successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Jawaban Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_soal_siswa($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Jawaban successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Jawaban Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_soal_siswa($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Jawaban successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Jawaban Error Delete</div>
<?php		

	}
}
?>
