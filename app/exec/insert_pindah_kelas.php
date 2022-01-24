<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Proses Pindah Kelas" ){
	
	$idkelas	= $_POST['idkelas'];
	$idkelas2	= $_POST['idkelas2'];
			
	$hs = $insert->insert_pindah_kelas($idkelas, $idkelas2);
		
	if($hs){
?>
		<div class="alert alert-success">Save Pindah Kelas successfully</div>		
		
		<script>
			//document.location.reload(true);
		</script>	
		
<?php					
	}else{
?>
		<div class="alert alert-error">Tidak ada Pindah kelas</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_pindah_kelas($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Pindah Kelas successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pindah Kelas Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_pindah_kelas($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Pindah Kelas successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pindah Kelas Error Delete</div>
<?php		

	}
}
?>
