<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
	
	$hs=$update->update_usr_reminder();
	
	if($hs){			
?>
		<div class="alert alert-success">Simpan Reminder successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Reminder Error Simpan</div>
<?php		

	}
}

