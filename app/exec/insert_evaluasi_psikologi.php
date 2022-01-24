<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
	
	$old_ref	=	$_POST["old_ref"];	
	
	if($old_ref == "") {
		$tanggal	=	date('Y-m-d', strtotime($_POST["tanggal"]));
		
		$ref=notran($tanggal, 'frmevaluasi_psikologi', '', '', ''); //---get no ref
		
		$hs=$insert->insert_evaluasi_psikologi($ref);
	} else {
		$ref = $old_ref;
		
		$hs=$update->update_evaluasi_psikologi($ref);
	}
	
	if($hs){
		
		if($old_ref == "") {
			notran($tanggal, 'frmevaluasi_psikologi', 1, '', '') ; //----eksekusi ref
		}
?>
		<div class="alert alert-success">Save Evaluasi Psikologi successfully</div>
		
		<script>
			window.location = 'main.php?menu=app&act=<?php echo obraxabrix(evaluasi_psikologi) ?>&search=<?php echo $ref ?>';			
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">Evaluasi Psikologi Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_evaluasi_psikologi($_POST['ref']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Evaluasi Psikologi successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Evaluasi Psikologi Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	
	$hs=$delete->delete_evaluasi_psikologi($_POST['ref']);
	
	if($hs){			
?>
		<div class="alert alert-success">Delete Evaluasi Psikologi successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Evaluasi Psikologi Error Delete</div>
<?php		

	}
}
?>
