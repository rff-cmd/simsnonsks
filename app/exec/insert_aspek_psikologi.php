<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_aspek_psikologi();
    
	if($hs){
?>
		<div class="alert alert-success">Save Jenis Aspek Psikologi successfully</div>	
        
<?php					
	}else{
?>
		<div class="alert alert-error">Jenis Aspek Psikologi Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_aspek_psikologi($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Jenis Aspek Psikologi successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Aspek Jenis Psikologi Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_aspek_psikologi($_POST['replid']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Jenis Aspek Psikologi successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Jenis Aspek Psikologi Error Delete</div>
<?php		

	}
}
?>
