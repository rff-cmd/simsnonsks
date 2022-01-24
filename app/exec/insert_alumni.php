<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
	
	//--------user check---------
	$nis = $_POST['nis'];
	$idkelas = $_POST['idkelas'];
	$sql=$select->list_nissiswa_check($nis, $idkelas);
	$data_check = $sql->rowCount();	
	
	if ($data_check > 0) {
?>	
	
		<div class="alert alert-error">NIS sudah dipakai siswa lain</div>
<?php
	} else {		
		$tanggal	=	date('Y-m-d', strtotime($_POST["tanggal"]));
		
		$ref=notran($tanggal, 'frmsiswa', '', '', ''); //---get no ref
		
		$hs=$insert->insert_siswa($ref);
		
		//notran(date('y-m-d'), 'frmdelord', 1, '', '') ; //----eksekusi ref
		notran($tanggal, 'frmsiswa', 1, '', '') ; //----eksekusi ref

		
		if($hs){
	?>
			<div class="alert alert-success">Save Alumni successfully</div>
			
			<script>
				//window.location = 'main.php?menu=app&act=siswa&search=<?php echo $ref ?>';			
			</script>
			
	<?php					
		}else{
	?>
			<div class="alert alert-error">Alumni Error Save</div>
	<?php		
		}	
	
	}
}

if ($post == "Update" ){
	
	//--------nis siswa check---------
	$nis = $_POST['nis'];
	$idkelas = $_POST['idkelas'];
	$sql=$select->list_nissiswaupdate_check($nis, $_POST[old_nis], $idkelas);
	$data_check = $sql->rowCount();
	if ($data_check > 0) {
?>
		<div class="alert alert-error">NIS sudah dipakai siswa lain</div>
<?php	
	} else {	
		$hs=$update->update_alumni($_POST['replid']);
		
		if($hs){			
	?>
			<div class="alert alert-success">Update Alumni successfully</div>
	<?php
		}else{
	?>
			<div class="alert alert-error">Alumni Error Update</div>
	<?php		

		}
	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_siswa($_POST['replid']);
	if($hs){			
	
?>
		<div class="alert alert-success">Delete Alumni successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Alumni Error Delete</div>
<?php		

	}
}
?>
