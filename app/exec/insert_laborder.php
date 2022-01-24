<?php
include 'app/class/class.update.php';

$update=new update;

$post = $_POST[submit];

if ($post == "Save" ){
	$hs=$update->update_laborder("");
	if($hs){					
?>
		<h4 class="alert_success" style="color: #0d1ef2">&nbsp;&nbsp; Lab. Order successfully</h4>
<?php
	}else{
		
?>
		<h4 class="alert_error">Lab. Order Error Update</h4>
<?php		

	}
}

?>
