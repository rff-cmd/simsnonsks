<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
	
	$semua = $_POST['semua'];	
	$hs=$insert->insert_besarjtt($semua);
		
	if($hs){
?>
		<div class="alert alert-success">Save Setup Pembayaran successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Setup Pembayaran Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_besarjtt($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Setup Pembayaran successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Setup Pembayaran Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_besarjtt($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Setup Pembayaran successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Setup Pembayaran Error Delete</div>
<?php		

	}
}
?>
