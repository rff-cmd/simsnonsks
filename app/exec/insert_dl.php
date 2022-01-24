<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Save" ){
	//----cek double data
	/*$delordcde_rwk = $_POST["delordcde_rwk"];
	$rows	=	0;
	
	if ($delordcde_rwk == '') {
		$dono	=	$_POST["dono"];
		$sql=mysql_query("select dono from delord where dono='$dono'");
		$rows=mysql_num_rows($sql);
	}*/
	
	
	$Dte	=	date('Y-m-d', strtotime($_POST["Dte"]));
	
	$ref=notran($Dte, 'frmOutBld', '', '', ''); //---get no ref
	
	$hs=$insert->insert_dl($ref);
	
	//notran(date('y-m-d'), 'frmdelord', 1, '', '') ; //----eksekusi ref
	notran($Dte, 'frmOutBld', 1, '', '') ; //----eksekusi ref

	
	if($hs){
?>
		<h4 class="alert_success">Save Dinas Luar (DL) successfully</h4>
<?php					
	}else{
?>
		<h4 class="alert_error">Dinas Luar (DL) Error Save</h4>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_dl($_POST['OutBldCde']);
	
	if($hs){			
?>
		<h4 class="alert_success">Update Dinas Luar (DL) successfully</h4>
<?php
	}else{
?>
		<h4 class="alert_error">Dinas Luar (DL) Error Update</h4>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_dl($_POST['OutBldCde']);
	if($hs){			
?>
		<h4 class="alert_success">Delete Dinas Luar (DL) successfully</h4>
<?php
	}else{
?>
		<h4 class="alert_error">Dinas Luar (DL) Error Delete</h4>
<?php		

	}
}
?>
