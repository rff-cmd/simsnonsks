<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Save" ){
	
	$date	=	date('Y-m-d', strtotime($_POST["date"]));
	
	$ref=notran($date, 'frmreceipt', '', '', ''); //---get no ref
		
	$hs=$insert->insert_receipt($ref);
	
	if($hs){
				
		notran($date, 'frmreceipt', 1, '', '') ; //----eksekusi ref
?>
		<div class="alert alert-success">
			<strong>Save Penerimaan Iuran Siswa successfully</strong>
		</div>
		
		<script>
			//window.location = '<?php echo $__folder ?><?php echo obraxabrix('receipt') ?>/<?php echo $ref ?>';		
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Penerimaan Iuran Siswa Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_receipt($_POST['ref']);
	if($hs){			
	
		//$update_journal->journal_receipt($_POST['ref']); //-------journal
?>
		<div class="alert alert-success">
			<strong>Update Penerimaan Iuran Siswa successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Penerimaan Iuran Siswa Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_receipt($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Penerimaan Iuran Siswa successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Penerimaan Iuran Siswa Error Delete</strong>
		</div>
<?php		

	}
}
?>
