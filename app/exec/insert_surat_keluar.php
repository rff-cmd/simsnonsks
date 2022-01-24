<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$tanggal	=	date('Y-m-d', strtotime($_POST["tanggal"]));
	
	$ref=notran($tanggal, 'frmsurat_keluar', '', '', ''); //---get no ref
	
	$hs=$insert->insert_surat_keluar($ref);
	
	if($hs){
		
		notran($tanggal, 'frmsurat_keluar', 1, '', '') ; //----eksekusi ref
?>
		<div class="alert alert-success">Save Surat Keluar successfully</div>
		
		<script>
			//window.location = 'main.php?menu=app&act=surat_keluar&search=<?php echo $ref ?>';			
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">Surat Keluar Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_surat_keluar($_POST['ref']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Surat Keluar successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Surat Keluar Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_surat_keluar($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Surat Keluar successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Surat Keluar Error Delete</div>
<?php		

	}
}
?>
