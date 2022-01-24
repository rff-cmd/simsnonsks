<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Proses" ){
	
	$ref	= $_POST["ref"];
		
	$hs=$insert->insert_kembali($ref);
		
	if($hs){
?>
		<div class="alert alert-success">Save Pengembalian Buku successfully</div>
		
		<script>
			//window.location = 'main.php?menu=app&act=kembali&search=<?php echo $ref ?>';		
			window.location = '<?php echo $__folder ?><?php echo obraxabrix('kembali') ?>/<?php echo $ref ?>';	
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">Pengembalian Buku Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_kembali($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Pengembalian Buku successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pengembalian Buku Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_kembali($_POST['replid']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Pengembalian Buku successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Pengembalian Buku Error Delete</div>
<?php		

	}
}
?>
