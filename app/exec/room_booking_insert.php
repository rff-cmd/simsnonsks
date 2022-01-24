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
    $ref=notran($date, 'frmroom_booking', '', '', ''); //---get no ref
   
	$hs=$insert->insert_room_registration($ref);
	
	if($hs){
        
        notran($date, 'frmroom_booking', 1, '', '') ; //----eksekusi ref
        
?>
		<div class="alert alert-success">
			<strong>Save Booking successfully</strong>
		</div>
		
		<!--<meta http-equiv="Refresh" content="0;url=<?php echo obraxabrix(booking); ?>" />-->
		
		<!--<script>
			window.location = 'main.php?menu=app&act=<?php echo obraxabrix(registration) ?>&search=<?php echo $ref ?>';			
		</script>-->
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Booking Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_room_booking($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Booking successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Booking Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_room_registration($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Registration successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Registration Error Delete</strong>
		</div>
<?php		

	}
}
?>
