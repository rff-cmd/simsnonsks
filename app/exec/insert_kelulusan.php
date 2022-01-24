<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Proses Lulus" ){
	
	$idkelas	= $_POST['idkelas'];
	$idkelas2	= $_POST['idkelas2'];
	$tgllulus	= $_POST['tgllulus'];
			
	$hs = $insert->insert_kelulusan($idkelas, $idkelas2, $tgllulus);
		
	if($hs){
?>
		<div class="alert alert-success">Save Kelulusan successfully</div>		
		
		<script>
			//document.location.reload(true);
		</script>	
		
<?php					
	}else{
?>
		<div class="alert alert-error">Tidak ada kelulusan kelas</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_kelulusan($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Kelulusan successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Kelulusan Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_kelulusan($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Kelulusan successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Kelulusan Error Delete</div>
<?php		

	}
}
?>
