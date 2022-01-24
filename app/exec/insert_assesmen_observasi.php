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
	
	$ref=notran($tanggal, 'frmassesmen_observasi', '', '', ''); //---get no ref
	
	$hs=$insert->insert_assesmen_observasi($ref);
	
	if($hs){
		
		notran($tanggal, 'frmassesmen_observasi', 1, '', '') ; //----eksekusi ref
?>
		<div class="alert alert-success">Save Assesmen dan Observasi successfully</div>
		
		<script>
			window.location = 'main.php?menu=app&act=<?php echo obraxabrix(assesmen_observasi) ?>&search=<?php echo $ref ?>';			
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">Assesmen dan Observasi Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_assesmen_observasi($_POST['ref']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Assesmen dan Observasi successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Assesmen dan Observasi Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	
	$hs=$delete->delete_assesmen_observasi($_POST['ref']);
	
	if($hs){			
?>
		<div class="alert alert-success">Delete Assesmen dan Observasi successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Assesmen dan Observasi Error Delete</div>
<?php		

	}
}
?>
