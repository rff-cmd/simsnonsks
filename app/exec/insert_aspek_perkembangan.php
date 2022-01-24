<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_aspek_perkembangan();
    
	if($hs){
?>
		<div class="alert alert-success">Save Aspek Perkembangan successfully</div>	
        
<?php					
	}else{
?>
		<div class="alert alert-error">Aspek Perkembangan Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_aspek_perkembangan($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Aspek Perkembangan successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Aspek Perkembangan Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_aspek_perkembangan($_POST['replid']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Aspek Perkembangan successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Aspek Perkembangan Error Delete</div>
<?php		

	}
}
?>
