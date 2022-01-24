<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
	
	$ref = $_POST['ref'];	
	$hs=$insert->insert_penerimaanjtt($ref);
		
	if($hs){
?>
		<div class="alert alert-success">Save Penerimaan Pembayaran successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Penerimaan Pembayaran Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_penerimaanjtt($_POST['ref']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Penerimaan Pembayaran successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Penerimaan Pembayaran Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_rpt_penerimaan($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Penerimaan Pembayaran successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Penerimaan Pembayaran Error Delete</div>
<?php		

	}
}
?>
