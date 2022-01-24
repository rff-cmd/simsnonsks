<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 
// include 'app/class/class.insert.journal.php';
// include 'app/class/class.update.journal.php';

$insert=new insert;
$update=new update;
$delete=new delete;
// $insert_journal	=	new insert_journal;
// $update_journal	=	new update_journal;

$post = $_POST['submit'];

if ($post == "Save" ){
	
	$date	=	date('Y-m-d', strtotime($_POST["date"]));
	
	$ref=notran($date, 'frmpayment', '', '', ''); //---get no ref
		
	$hs=$insert->insert_payment($ref);
	
	notran($date, 'frmpayment', 1, '', '') ; //----eksekusi ref
	
	if($hs){
		
		//$insert_journal->journal_payment($ref); //-------journal
?>
		<div class="alert alert-success">
			<strong>Save Payment successfully</strong>            
		</div>
        
        <script>
            window.location = '<?php echo $__folder ?><?php echo obraxabrix('payment') ?>/<?php echo $ref ?>';
        </script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Payment Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_payment($_POST['ref']);
	if($hs){			
	
		//$update_journal->journal_payment($_POST['ref']); //-------journal
?>
		<div class="alert alert-success">
			<strong>Update Payment successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Payment Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_payment($_POST['ref']);
	if($hs){			
	
?>
		<div class="alert alert-success">
			<strong>Delete Payment successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Payment Error Delete</strong>
		</div>
<?php		

	}
}
?>
