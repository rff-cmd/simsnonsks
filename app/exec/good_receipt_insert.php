<?php
include_once ("app/include/queryfunctions.php");
include_once ("app/include/functions.php");

include 'app/class/class.insert.php';
include 'app/class/class.update.php';
//include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
//$delete=new delete;

$post = $_POST['submit'];

if ($post == "Save" ){
		
	$date	=	date('Y-m-d', strtotime($_POST["date"]));
	
	$ref=notran($date, 'frmgood_receipt', '', '', ''); //---get no ref
		
	$hs=$insert->insert_good_receipt($ref);
	
	if($hs){
		
		notran($date, 'frmgood_receipt', 1, '', '') ; //----eksekusi ref
		/*
		$dataref = $hs->fetch(PDO::FETCH_OBJ);
		$ref = $dataref->ref;*/
?>
		<div class="alert alert-success">
			<strong>Save Penerimaan Barang successfully</strong>
		</div>
		
		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix('good_receipt_view') ?>';
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Penerimaan Barang Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_good_receipt($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Penerimaan Barang successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Penerimaan Barang Error Update</strong>
		</div>
<?php		

	}
}
 
 
if ($post == "Delete" ){
	
	include 'app/class/class.delete.php'; 
	$delete=new delete;
	
	$hs=$delete->delete_good_receipt($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Penerimaan Barang successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Penerimaan Barang Error Delete</strong>
		</div>
<?php		

	}
}



if ($post == "Verification" ){
	$hs=$update->update_sales_order_verification($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Verification PO successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>PO Error Verification</strong>
		</div>
<?php		

	}
}


if ($post == "Reprinting" ){
	$hs=$update->update_reprinting($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Reprinting successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Error Reprinting</strong>
		</div>
<?php		

	}
}


if ($post == "PO Reorder" ){
	
	$ref	= $_POST['ref'];
	$hs=$insert->insert_sales_reorder($ref);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>PO Reorder successfully</strong>
		</div>
		
		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix('sales_reorder') ?>/<?php echo $ref ?>';
		</script>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Error PO Reorder</strong>
		</div>
<?php		

	}
}


if ($post == "Update PO Reorder" ){
	$hs=$update->update_sales_reorder($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update PO Reorder successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>PO Reorder Error Update</strong>
		</div>
<?php		

	}
}


 
if ($post == "Delete PO Reorder" ){
	
	include 'app/class/class.delete.php'; 
	$delete=new delete;
	
	$hs=$delete->delete_sales_reorder($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete PO Reorder successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>PO Reorder Error Delete</strong>
		</div>
<?php		

	}
}


if ($post == "Pesan" ){
	
	/*$date	=	date('Y-m-d', strtotime($_POST["date"]));
	$ref=notran($date, 'frmsales_order', '', '', ''); //---get no ref*/
		
	$hs=$insert->insert_sales_order();
	
	if($hs){
		
		//notran($date, 'frmsales_order', 1, '', '') ; //----eksekusi ref
		
?>
		<div class="alert alert-success">
			<strong>Save Order successfully</strong>
		</div>
		
		<script>
			//window.location = '<?php echo $__folder ?><?php echo obraxabrix('sales_order') ?>/<?php echo $ref ?>';
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Order Error Save</strong>
		</div>
<?php		
	}	
}


if ($post == "Panggil" ){
	
	$hs=$update->update_sales_order_panggil();
	
	if($hs){
		
?>
		<div class="alert alert-success">
			<strong>Panggil successfully</strong>
		</div>
		
		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix('capster_order_list') ?>';
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Panggil Error</strong>
		</div>
<?php		
	}	
}

if ($post == "Edit" ){
	
	$hs=$update->update_sales_order_cutting();
	
	if($hs){
		
?>
		<div class="alert alert-success">
			<strong>Edit successfully</strong>
		</div>
		
		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix('capster_order_list') ?>';
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Edit Error</strong>
		</div>
<?php		
	}	
}


?>
