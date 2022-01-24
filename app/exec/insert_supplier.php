<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_supplier();
		
	if($hs){
?>
		<div class="alert alert-success">Save Toko/Supplier successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Toko/Supplier Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_supplier($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Toko/Supplier successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Toko/Supplier Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_supplier($_POST['replid']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Toko/Supplier successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Toko/Supplier Error Delete</div>
<?php		

	}
}
?>
