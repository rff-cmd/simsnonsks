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
	
	$ref=notran($tanggal, 'frmsurat_masuk', '', '', ''); //---get no ref
	
	$hs=$insert->insert_surat_masuk($ref);
	
	if($hs){
		
		notran($tanggal, 'frmsurat_masuk', 1, '', '') ; //----eksekusi ref
?>
		<div class="alert alert-success">Save Surat Masuk successfully</div>
		
		<script>
			//window.location = 'main.php?menu=app&act=surat_masuk&search=<?php echo $ref ?>';			
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">Surat Masuk Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_surat_masuk($_POST['ref']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Surat Masuk successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Surat Masuk Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_surat_masuk($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Surat Masuk successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Surat Masuk Error Delete</div>
<?php		

	}
}
?>
