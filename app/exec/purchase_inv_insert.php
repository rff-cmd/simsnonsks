<?php
include 'app/class/class.insert.php';
//include 'app/class/class.insert.journal.php';
include 'app/class/class.update.php';
//include 'app/class/class.update.journal.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

// $insert_journal	=	new insert_journal;
// $update_journal	=	new update_journal;

$post = $_POST['submit'];

?>

<script type="text/javascript">	
		/*if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('purchase_inv_view') ?>&mxKz=xm8r389xemx23xb2378e23&id="+id+" ";
		}*/
</script>

<?php
if ($post == "Save Detail" ){
	
	$ref	= $_POST['old_ref'];
	if($ref == "") {
		$ref	= random(20);
	}
	
	$hs=$insert->insert_purchase_inv_detail($ref);
	
	if($hs){
		
?>
		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix('purchase_inv') ?>/<?php echo $ref ?>';
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Pembelian Detail Error Save</strong>
		</div>
<?php		
	}	
}


if ($post == "Save" ){
	
	$ref_tmp = $_POST['old_ref'];
	$date	=	date('Y-m-d', strtotime($_POST["date"]));
	$xndf	=	$_POST['xndf'];
	
	$ref=notran($date, 'frmpurchase_inv', '', '', ''); //---get no ref
		
	$hs=$insert->insert_purchase_inv($ref, $xndf, $ref_tmp);
	
	if($hs){
		
		notran($date, 'frmpurchase_inv', 1, '', '') ; //----eksekusi ref
		//$insert_journal->journal_purchase_inv($ref); //-------journal
		
?>
		<div class="alert alert-success">
			<strong>Save Pembelian successfully</strong>
		</div>
		
		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix('purchase_inv') ?>/<?php echo $ref ?>';
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Pembelian Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" || trim($post) == trim("Add Detail") ){
	
	$hs=$update->update_purchase_inv($_POST['ref']);
	if($hs){			
	
		//$update_journal->journal_purchase_inv($_POST['ref']); //-------journal
?>
		<div class="alert alert-success">
			<strong>Update Pembelian successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Pembelian Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_purchase_inv($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Pembelian successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Pembelian Error Delete</strong>
		</div>
<?php		

	}
}
?>
