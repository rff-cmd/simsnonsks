<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Proses" ){
	
	$hs = $insert->insert_penempatan();
		
	if($hs){
?>
		<div class="alert alert-success">Save Penempatan Kelas successfully</div>		
		
		<script>
			//document.location.reload(true);
		</script>	
		
<?php					
	}else{
?>
		<div class="alert alert-error">Tidak ada penempatan kelas</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_penempatan($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Penempatan Kelas successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Penempatan Kelas Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_penempatan($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Penempatan Kelas successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Penempatan Kelas Error Delete</div>
<?php		

	}
}


if ($post == "Proses Penempatan" ){
	
	$hs = $insert->insert_penempatan_siswa_baru();
		
	if($hs){
?>
		<div class="alert alert-success">Save Penempatan Kelas successfully</div>		
		
		<script>
			//document.location.reload(true);
		</script>	
		
<?php					
	}else{
?>
		<div class="alert alert-error">Tidak ada penempatan kelas</div>
<?php		
	}	
}

?>
