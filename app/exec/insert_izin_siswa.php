<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_izin_siswa("");
    
    $ref = $hs;
    
	if($hs){
?>
		<div class="alert alert-success">Save Izin Siswa successfully</div>	
        
        <script>
			window.location = 'main.php?menu=app&act=<?php echo obraxabrix(izin_siswa) ?>&search=<?php echo $ref ?>';		
		</script>		
		
<?php					
	}else{
?>
		<div class="alert alert-error">Izin Siswa Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_izin_siswa($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Izin Siswa successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Izin Siswa Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_izin_siswa($_POST['replid']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Izin Siswa successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Izin Siswa Error Delete</div>
<?php		

	}
}
?>
