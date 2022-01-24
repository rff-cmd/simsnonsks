<?php

include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Simpan" ){
	
	//$dbpdo = DB::create();
		
	//--------user check---------
	$nama = $_POST['nama'];
	$departemen = $_POST['departemen'];
	$sql=$select->list_datapengeluaran("", $nama, $departemen);
	$data_check = $sql->rowCount();	
	if ($data_check > 0) {
?>
		<div class="alert alert-error">
			<strong>Nama Pengeluaran sudah dipakai</strong>
		</div>
<?php	
		
	} else {
				
		$hs=$insert->insert_datapengeluaran();
		
		if($hs){
?>
			<div class="alert alert-success">
				<strong>Save Nama Pengeluaran successfully</strong>
			</div>
<?php					
		}else{
?>
			<div class="alert alert-error">
				<strong>Nama Pengeluaran Error Save</strong>
			</div>		
<?php		
		}	
	}

}
	
	if ($post == "Update" ){
		
		//--------datapengeluaran check---------
		$nama = $_POST['nama'];
		$departemen = $_POST['departemen'];
		
		$oldnama = $_POST['oldnama'];
		$olddepartemen = $_POST['olddepartemen'];
		$sql=$select->list_datapengeluaran_check($nama, $departemen, $oldnama, $olddepartemen);
		$data_check = $sql->rowCount();	
		if ($data_check > 0) {
?>
		<div class="alert alert-error">
			<strong>Nama Pengeluaran sudah dipakai</strong>
		</div>
<?php	
		
		} else {
		
		$hs=$update->update_datapengeluaran($_POST[id]);
		if($hs){			
?>
			<div class="alert alert-success">
				<strong>Update Nama Pengeluaran successfully</strong>
			</div>	
<?php
		}else{
?>
			<div class="alert alert-error">
				<strong>Nama Pengeluaran Error Update</strong>
			</div>
<?php		

		}
	}
}

	if ($post == "Hapus" ){
		$hs=$delete->delete_datapengeluaran($_POST['id']);
		if($hs){			
?>
			<div class="alert alert-success">Delete Nama Pengeluaran successfully</div>
<?php
		}else{
?>
			<div class="alert alert-error">Nama Pengeluaran Error Delete</div>
<?php		

		}
	
}
?>
