<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Save" ){
	
	$hs=$insert->insert_holiday("");
	
	if($hs){
?>
		<h4 class="alert_success">Save Hari Libur successfully</h4>
<?php					
	}else{
?>
		<h4 class="alert_error">Hari Libur Error Save</h4>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_holiday($_POST['Yar'], $_POST['HldDte']);
	
	if($hs){			
?>
		<h4 class="alert_success">Update Hari Libur successfully</h4>
<?php
	}else{
?>
		<h4 class="alert_error">Hari Libur Error Update</h4>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_holiday($_POST['Yar'], $_POST['HldDte']);
	if($hs){			
?>
		<h4 class="alert_success">Delete Hari Libur successfully</h4>
<?php
	}else{
?>
		<h4 class="alert_error">Hari Libur Error Delete</h4>
<?php		

	}
}
?>
