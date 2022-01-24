<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan Detail" ){
	
	$idanggota	=	$_POST["idanggota"];
	$unt 		= 	$_POST["jenis_anggota"];
	
	$hs=$insert->insert_pinjam_detail($idanggota);
	
	if($hs){
?>
		<script>
			<?php /* window.location = 'main.php?menu=app&act=<?php echo obraxabrix('pinjam') ?>&dtl=<?php echo $idanggota ?>&unt=<?php echo $unt ?>'; */ ?>			
			window.location = '<?php echo $__folder ?><?php echo obraxabrix('pinjam') ?>/<?php echo $unt ?>/<?php echo $idanggota ?>';
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">Peminjaman Buku Error Save</div>
<?php		
	}	
}


if ($post == "Simpan" ){
		
	$hs=$insert->insert_pinjam();
		
	if($hs){
?>
		<div class="alert alert-success">Save Peminjaman Buku successfully</div>
		
		<script>
			//window.location = 'main.php?menu=app&act=pinjam&search=<?php echo $ref ?>';			
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">Peminjaman Buku Error Save</div>
<?php		
	}	
}

if ($post == "Batal" ){
		
	$hs=$insert->insert_pinjam_batal();
		
	if($hs){
?>
		<div class="alert alert-success">Batal Peminjaman Buku successfully</div>
		
		<script>
			window.location = 'main.php?menu=app&act=<?php echo obraxabrix('pinjam') ?>';			
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">Batal Peminjaman Buku Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_pinjam($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Peminjaman Buku successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Peminjaman Buku Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_pinjam($_POST['replid']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Peminjaman Buku successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Peminjaman Buku Error Delete</div>
<?php		

	}
}
?>
