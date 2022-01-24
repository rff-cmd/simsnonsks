<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Save" ){
	
    $date	=	date('Y-m-d');
    
    $ref=notran($date, 'frmasset_trans', '', '', ''); //---get no ref
    
	$hs=$insert->insert_asset_trans($ref);
	
	if($hs){
        
        notran($date, 'frmasset_trans', 1, '', '') ; //----eksekusi ref
?>
		<div class="alert alert-success">
			<strong>Save Asset Transaksi successfully</strong>
		</div>
		
        <script>
			window.location = 'main.php?menu=app&act=<?php echo obraxabrix(asset_trans) ?>&search=<?php echo $ref ?>';			
		</script>
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Asset Transaksi Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_asset_trans($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Asset Transaksi successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Asset Transaksi Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_asset_trans($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Asset Transaksi successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Asset Transaksi Error Delete</strong>
		</div>
<?php		

	}
}
?>
