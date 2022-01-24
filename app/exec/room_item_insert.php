<?php
include '../app/class/class.insert.php';
//include '../app/class/class.insert.journal.php';
include '../app/class/class.update.php';
//include '../app/class/class.update.journal.php';
//include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;

$post = $_POST[submit];

if ($post == "Save" ){
	
	$ref	=	$_POST["ref"];
	$hs=$insert->insert_room_detail($ref);
	
	if($hs){
		
?>
		<div class="alert alert-success">
			<strong>Save Ruang successfully</strong>
		</div>
		
		<script>
			//window.location = 'main.php?menu=app&act=<?php echo obraxabrix(client_bank) ?>&search=<?php echo $ref ?>';		
			window.location = 'room_item.php?ref=<?php echo $ref ?>';	
			
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Ruang Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$ref			=	$_POST["ref"];
	$line			=	$_POST["old_line"];
	
	$hs=$update->update_room_detail($ref, $line);
	if($hs){			
	
?>
		<div class="alert alert-success">
			<strong>Update Ruang successfully</strong>
			
			<script>
				window.location = 'room_item.php?ref=<?php echo $ref ?>&line=<?php echo $line ?>';					
			</script>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Ruang Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$ref = $_POST['ref'];
	$hs=$delete->delete_room_detail($_POST['ref'], $line);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Ruang successfully</strong>
		</div>
		
		<script>
			//window.location = 'main.php?menu=app&act=<?php echo obraxabrix(client_bank) ?>&search=<?php echo $ref ?>';		
			window.location = 'room_item.php?ref=<?php echo $ref ?>';	
			
		</script>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Ruang Error Delete</strong>
		</div>
<?php		

	}
}
?>


<?php
	if ($post == "Batal" ){
		$ref	=	$_POST["ref"];
?>
		<script>
			window.location = 'room_item.php?ref=<?php echo $ref ?>';	
			
		</script>
<?php
	}
?>		
		