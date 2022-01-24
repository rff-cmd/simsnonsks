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
	$kode = $_POST['kode'];
	$sql=$select->list_rekakun($kode);
	$data_check = $sql->rowCount();	
	if ($data_check > 0) {
?>
		<div class="alert alert-error">
			<strong>Rek Akun sudah ada yang pakai</strong>
		</div>
<?php	
		
	} else {
		
		$kode = $_POST['kode'];
		$hs=$insert->insert_rekakun($kode);
		
		if($hs){
?>
			<div class="alert alert-success">
				<strong>Save Rek Akun successfully</strong>
			</div>
<?php					
		}else{
?>
			<div class="alert alert-error">
				<strong>Rek Akun Error Save</strong>
			</div>		
<?php		
		}	
	}

}
	
	if ($post == "Update" ){
		
		//--------rekakun check---------
		$id = $_POST['id'];
		$kode = $_POST['kode'];
		$sql=$select->list_rekakun_check($kode, $id);
		$data_check = $sql->rowCount();	
		if ($data_check > 0) {
?>
		<div class="alert alert-error">
			<strong>Rek Akun sudah ada yang pakai</strong>
		</div>
<?php	
		
		} else {
		
		$hs=$update->update_rekakun($_POST[id]);
		if($hs){			
?>
			<div class="alert alert-success">
				<strong>Update Rek Akun successfully</strong>
			</div>	
<?php
		}else{
?>
			<div class="alert alert-error">
				<strong>Rek Akun Error Update</strong>
			</div>
<?php		

		}
	}
}

	if ($post == "Hapus" ){
		$hs=$delete->delete_rekakun($_POST['id']);
		if($hs){			
?>
			<div class="alert alert-success">Delete Rek Akun successfully</div>
<?php
		}else{
?>
			<div class="alert alert-error">Rek Akun Error Delete</div>
<?php		

		}
	
}
?>
