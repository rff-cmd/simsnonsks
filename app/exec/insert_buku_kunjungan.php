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
	
	$ref=notran($tanggal, 'frmbuku_kunjungan', '', '', ''); //---get no ref
	
	$hs=$insert->insert_buku_kunjungan($ref);
	
	if($hs){
		
		notran($tanggal, 'frmbuku_kunjungan', 1, '', '') ; //----eksekusi ref
?>
		<div class="alert alert-success">Save Buku Kunjungan successfully</div>
		
		<script>
			//window.location = 'main.php?menu=app&act=buku_kunjungan&search=<?php echo $ref ?>';			
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">Buku Kunjungan Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_buku_kunjungan($_POST['ref']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Buku Kunjungan successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Buku Kunjungan Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_buku_kunjungan($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Buku Kunjungan successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Buku Kunjungan Error Delete</div>
<?php		

	}
}
?>
