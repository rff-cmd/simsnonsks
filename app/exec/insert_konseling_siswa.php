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
	
	$ref=notran($date, 'frmkonseling_siswa'); //---get no ref
		
	$hs=$insert->insert_konseling_siswa($ref);
		
	if($hs){
		
		notran($date, 'frmkonseling_siswa', 1) ; //----eksekusi ref
?>
		<div class="alert alert-success">Save Konseling Siswa successfully</div>	
		
		<script>
			window.location = 'main.php?menu=app&act=<?php echo obraxabrix(konseling_siswa) ?>&search=<?php echo $ref ?>';	
		</script>		
		
<?php					
	}else{
?>
		<div class="alert alert-error">Konseling Siswa Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_konseling_siswa($_POST['ref']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Konseling Siswa successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Konseling Siswa Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_konseling_siswa($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Konseling Siswa successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Konseling Siswa Error Delete</div>
<?php		

	}
}
?>
