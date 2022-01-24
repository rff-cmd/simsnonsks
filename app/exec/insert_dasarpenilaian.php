<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_dasarpenilaian();
		
	if($hs){
?>
		<div class="alert alert-success">Save Aspek Penilaian successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Aspek Penilaian Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_dasarpenilaian($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Aspek Penilaian successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Aspek Penilaian Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_dasarpenilaian($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Aspek Penilaian successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Aspek Penilaian Error Delete</div>
<?php		

	}
}
?>
