<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Save" ){
	
	$date	=	date('Y-m-d');
	$ref=notran($date, 'frmmaterial', '', '', ''); //---get no ref
	
	$hs=$insert->insert_material($ref);
	
	if($hs){
		
		notran($date, 'frmmaterial', 1, '', '') ; //----eksekusi ref
?>
		<div class="alert alert-success">
			<strong>Save Barang successfully</strong>
		</div>
		
		<script>
			//window.location = '<?php echo $__folder ?><?php echo obraxabrix(material) ?>';			
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Barang Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_material($_POST['syscode']);
	
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Barang successfully</strong>
		</div>
		
		<script>
			//window.location = '<?php echo $__folder ?><?php echo obraxabrix(material) ?>/<?php echo $_POST[syscode] ?>';			
		</script>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Barang Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_material($_POST['syscode']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Barang successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Barang Error Delete</strong>
		</div>
<?php		

	}
}
?>
