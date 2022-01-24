<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Save" ){
	
	$date	=	date('Y-m-d');
	$ref=notran($date, 'frmfinance_type', '', '', ''); //---get no ref
	
	$hs=$insert->insert_finance_type($ref);
	
	if($hs){
		
		//generate_user_member($ref); //generate user dan password
		
		notran($date, 'frmfinance_type', 1, '', '') ; //----eksekusi ref
?>
		<div class="alert alert-success">
			<strong>Save Jenis Keuangan successfully</strong>
		</div>
		
		<meta http-equiv="Refresh" content="0;url=<?php echo obraxabrix('finance_type'); ?>" />
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Jenis Keuangan Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_finance_type($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Jenis Keuangan successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Jenis Keuangan Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_finance_type($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Jenis Keuangan successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Jenis Keuangan Error Delete</strong>
		</div>
<?php		

	}
}
?>
