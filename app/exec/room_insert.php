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
    
    $ref=notran($date, 'frmroom', '', '', ''); //---get no ref
    
	$hs=$insert->insert_room($ref);
	
	if($hs){
        
        notran($date, 'frmroom', 1, '', '') ; //----eksekusi ref
        
?>
		<div class="alert alert-success">
			<strong>Save Master Ruang successfully</strong>
		</div>
		
		<meta http-equiv="Refresh" content="0;url=<?php echo obraxabrix(room); ?>" />
		
		<!--<script>
			window.location = 'main.php?menu=app&act=<?php echo obraxabrix(room) ?>&search=<?php echo $ref ?>';			
		</script>-->
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Master Ruang Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_room($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Master Ruang successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Master Ruang Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_room($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Master Ruang successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Master Ruang Error Delete</strong>
		</div>
<?php		

	}
}
?>
