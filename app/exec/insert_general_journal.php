<?php
include 'app/class/class.insert.php';
//include 'app/class/class.insert.journal.php';
include 'app/class/class.update.php';
//include 'app/class/class.update.journal.php';
 

$insert=new insert;
//$insert_journal	=	new insert_journal;
$update=new update;
//$update_journal	=	new update_journal;


$post = $_POST['submit'];

if ( $post == "Save Detail" ){
	if ($ref != "") {
		$post = "Update";
	}
}

if ( $post == "Update Detail" ){
	$post = "Update";	
}

if ($post == "Save Detail" ){
	
	$date	=	date('Y-m-d', strtotime($_POST["date"]));
	
	$ref=notran($date, 'frmgeneral_journal', '', '', ''); //---get no ref
		
	$hs=$insert->insert_general_journal($ref);
	
	//$hs=$insert_journal->journal_general_journal($ref);
	
	if($hs){
		
		notran($date, 'frmgeneral_journal', 1, '', '') ; //----eksekusi ref
?>
		<div class="alert alert-success">Save Kas Keluar successfully</div>	

		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix('general_journal') ?>/<?php echo $ref ?>';
		</script>
				
<?php					
	}else{
?>
		<div class="alert alert-error">Kas Keluar Error Save</div>
<?php		
	}	
}



if ($post == "Save" ){
	
	$dte		=	date('Y-m-d', strtotime($_POST["date"]));
	
	$ref=notran($dte, 'frmgeneral_journal', '', '', ''); //---get no ref
	
	$hs=$insert->insert_general_journal($ref);
	
	//$hs=$insert_journal->journal_general_journal($ref);
	
	if($hs){
		
		notran($dte, 'frmgeneral_journal', 1, '', '') ; //----eksekusi ref
?>
		<div class="alert alert-success">Save Kas Keluar successfully</div>	

		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix('general_journal') ?>/<?php echo $ref ?>';
		</script>
<?php					
	}else{
?>
		<div class="alert alert-error">Kas Keluar Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$ref = $_POST['ref'];
	$hs=$update->update_general_journal($_POST['ref']);
	
	//$hs=$update_journal->journal_general_journal($_POST['general_journalcde']);
		
	if($hs){			
?>
		<div class="alert alert-success">Update Kas Keluar successfully</div>	
		
<?php
	}else{
?>
		<div class="alert alert-error">Kas Keluar Error Update</div>
<?php		

	}
}

if ($post == "Delete" ){
	
	include 'app/class/class.delete.php';
	$delete=new delete;
	
	$hs=$delete->delete_general_journal($_POST['ref']);
	
	if($hs){			
?>
		<div class="alert alert-success">Delete Kas Keluar successfully</div>		
<?php
	}else{
?>
		<div class="alert alert-error">Kas Keluar Error Delete</div>
<?php		

	}
}
?>
