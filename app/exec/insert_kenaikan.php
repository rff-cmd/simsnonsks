<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Proses Naik" ){
	
	$idkelas	= $_POST['idkelas'];
	$idkelas2	= $_POST['idkelas2'];
	
	$hs = $insert->insert_kenaikan($idkelas, $idkelas2);
		
	if($hs){
?>
		<div class="alert alert-success">Save Kenaikan Kelas successfully</div>		
		
		<script>
			//document.location.reload(true);
		</script>	
		
<?php					
	}else{
?>
		<div class="alert alert-error">Tidak ada Kenaikan kelas</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_kenaikan($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Kenaikan Kelas successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Kenaikan Kelas Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_kenaikan($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Kenaikan Kelas successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Kenaikan Kelas Error Delete</div>
<?php		

	}
}
?>
