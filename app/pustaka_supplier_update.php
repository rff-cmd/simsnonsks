<table border="0" style="border: 1px solid #ccc">
	<tr style="font-weight: bold">
		<td>Nama Toko/Supplier</td>
		<td>Hapus</td>
	</tr>
	
	<?php 
		
		$sql=$select->list_pustaka_supplier($ref);
		$rows = $sql->rowCount();
		$i = 0;
		
		while ($pustaka_supplier_det = $sql->fetch(PDO::FETCH_OBJ)) {	
		
	?>
	

		<input type="hidden" id="old_supplier_id_<?php echo $i ?>" name="old_supplier_id_<?php echo $i ?>" value="<?php echo $pustaka_supplier_det->supplier_id ?>" >
				
		<tr>
			<td>
				<select name="supplier_id_<?php echo $i ?>" id="supplier_id_<?php echo $i ?>" style="width:auto; height:27px; " />
					<option value=""></option>
					<?php select_supplier($pustaka_supplier_det->supplier_id); ?>
				</select>
			</td>
			
			<td align="center">
				<input type="checkbox" id="delete_<?php echo $i; ?>" name="delete_<?php echo $i; ?>" class="form-control" value="1" >
			</td>
		</tr>
		
				
	<?php 	
			$i++;
		} 
	?>
	
	<?php	
		$rows2 = 5 - $rows;
		$x = $i;
		$rows = $rows2 + $rows;
		for($i=$x; $i<=$rows; $i++) { 
			
	?>
			
			<tr>
				<td>
					<select name="supplier_id_<?php echo $i ?>" id="supplier_id_<?php echo $i ?>" style="width:auto; height:27px; " />
					<option value=""></option>
					<?php select_supplier(""); ?>
				</select>
				</td>
				
			</tr>
	
	<?php
			
		}
		
	?>
	
	<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $i ?>" >
	
</table>
