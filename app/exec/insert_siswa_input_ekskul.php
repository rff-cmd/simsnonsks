<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
//include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
//$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_siswa_input_ekskul();
		
	if($hs){
?>
		<div class="alert alert-success">Save Siswa Ekstrakurikuler successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Siswa Ekstrakurikuler Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_siswa_ekstrakurikuler($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Siswa Ekstrakurikuler successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Siswa Ekstrakurikuler Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_siswa_ekstrakurikuler($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Siswa Ekstrakurikuler successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Siswa Ekstrakurikuler Error Delete</div>
<?php		

	}
}
?>


<?php
if ($post == "Update Nilai" ){
		
	$hs=$update->update_siswa_ekstrakurikuler_nilai();
		
	if($hs){
?>
		<div class="alert alert-success">Update Nilai Ekstrakurikuler successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Update Nilai Ekstrakurikuler Error Save</div>
<?php		
	}	
}
