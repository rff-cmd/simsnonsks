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
    
    $ref=notran($date, 'frmbuild', '', '', ''); //---get no ref
    
	$hs=$insert->insert_build($ref);
	
	if($hs){
        
        notran($date, 'frmbuild', 1, '', '') ; //----eksekusi ref
        
?>
		<div class="alert alert-success">
			<strong>Save Master Gedung successfully</strong>
		</div>
		
		<meta http-equiv="Refresh" content="0;url=<?php echo obraxabrix(build); ?>" />
		
		<!--<script>
			window.location = 'main.php?menu=app&act=<?php echo obraxabrix(build) ?>&search=<?php echo $ref ?>';			
		</script>-->
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Master Gedung Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_build($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Master Gedung successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Master Gedung Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_build($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Master Gedung successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Master Gedung Error Delete</strong>
		</div>
<?php		

	}
}
?>
