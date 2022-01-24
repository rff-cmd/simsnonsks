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
	$idkategori = $_POST['idkategori'];
	$sql=$select->list_datapenerimaan("", $nama, $departemen, $idkategori);
	$data_check = $sql->rowCount();	
	if ($data_check > 0) {
?>
		<div class="alert alert-error">
			<strong>Nama Penerimaan sudah dipakai</strong>
		</div>
<?php	
		
	} else {
				
		$hs=$insert->insert_datapenerimaan();
		
		if($hs){
?>
			<div class="alert alert-success">
				<strong>Save Nama Penerimaan successfully</strong>
			</div>
<?php					
		}else{
?>
			<div class="alert alert-error">
				<strong>Nama Penerimaan Error Save</strong>
			</div>		
<?php		
		}	
	}

}
	
	if ($post == "Update" ){
		
		//--------datapenerimaan check---------
		$nama = $_POST['nama'];
		$departemen = $_POST['departemen'];
		$idkategori = $_POST['idkategori'];
		
		$oldnama = $_POST['oldnama'];
		$olddepartemen = $_POST['olddepartemen'];
		$oldidkategori = $_POST['oldidkategori'];
		$sql=$select->list_datapenerimaan_check($nama, $departemen, $idkategori, $oldnama, $olddepartemen, $oldidkategori);
		$data_check = $sql->rowCount();	
		if ($data_check > 0) {
?>
		<div class="alert alert-error">
			<strong>Nama Penerimaan sudah dipakai</strong>
		</div>
<?php	
		
		} else {
		
		$hs=$update->update_datapenerimaan($_POST[id]);
		if($hs){			
?>
			<div class="alert alert-success">
				<strong>Update Nama Penerimaan successfully</strong>
			</div>	
<?php
		}else{
?>
			<div class="alert alert-error">
				<strong>Nama Penerimaan Error Update</strong>
			</div>
<?php		

		}
	}
}

	if ($post == "Hapus" ){
		$hs=$delete->delete_datapenerimaan($_POST['id']);
		if($hs){			
?>
			<div class="alert alert-success">Delete Nama Penerimaan successfully</div>
<?php
		}else{
?>
			<div class="alert alert-error">Nama Penerimaan Error Delete</div>
<?php		

		}
	
}
?>
