<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$tanggal	=	date('Y-m-d', strtotime($_POST["tanggal"]));
	
	//$ref=notran($tanggal, 'frmregistrasi', '', '', ''); //---get no ref
	
	$hs=$insert->insert_registrasi($ref);
	
	//notran(date('y-m-d'), 'frmdelord', 1, '', '') ; //----eksekusi ref
	//notran($tanggal, 'frmregistrasi', 1, '', '') ; //----eksekusi ref

	
	if($hs){
?>
		<div class="alert alert-success">Save Registrasi successfully</div>
		
		<script>
			//window.location = 'main.php?menu=app&act=registrasi&search=<?php echo $ref ?>';			
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">Registrasi Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_registrasi($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Registrasi successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Registrasi Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_registrasi($_POST['replid']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Registrasi successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Registrasi Error Delete</div>
<?php		

	}
}
?>
