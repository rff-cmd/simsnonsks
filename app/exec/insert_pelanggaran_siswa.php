<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
	
	$date	=	date('Y-m-d', strtotime($_POST["tanggal"]));
	
	$ref=notran($date, 'frmpelanggaran_siswa'); //---get no ref
		
	$hs=$insert->insert_pelanggaran_siswa($ref);
	
	notran($date, 'frmpelanggaran_siswa', 1) ; //----eksekusi ref
		
	if($hs){
?>
		<div class="alert alert-success">Save Pelanggaran Siswa successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Pelanggaran Siswa Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_pelanggaran_siswa($_POST['ref']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Pelanggaran Siswa successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pelanggaran Siswa Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_pelanggaran_siswa($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Pelanggaran Siswa successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pelanggaran Siswa Error Delete</div>
<?php		

	}
}
?>
