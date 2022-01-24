<?php
include 'app/class/class.update.php';

$update=new update;

$post = $_POST[submit];

if ($post == "Save" ){
	$hs=$update->update_laborder_dl("");
	if($hs){					
?>
		<h4 class="alert_success" style="color: #0d1ef2">&nbsp;&nbsp; Lab. Order DL successfully</h4>
<?php
	}else{
		
?>
		<h4 class="alert_error">Lab. Order DL Error Update</h4>
<?php		

	}
}

?>
