<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$tanggal	=	date('Y-m-d', strtotime($_POST["tgldaftar"]));
	
	$ref=notran($tanggal, 'frmanggota', '', '', ''); //---get no ref
	
	$hs=$insert->insert_anggota($ref);
	
	if($hs){
		
		notran($tanggal, 'frmanggota', 1, '', '') ; //----eksekusi ref
?>
		<div class="alert alert-success">Save Anggota successfully</div>
				
<?php					
	}else{
?>
		<div class="alert alert-error">Anggota Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_anggota($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Anggota successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Anggota Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	
	$hs=$delete->delete_anggota($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Delete Anggota successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Anggota Error Delete</div>
<?php		

	}
}
?>
