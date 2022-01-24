<table border="0" style="border: 1px solid #ccc">
	<tr style="font-weight: bold">
		<td>Nama Toko/Supplier</td>		
	</tr>
	
	<?php 
		
		for($i=0; $i<=5; $i++) { 	
		
	?>
	

		<input type="hidden" id="jmldata" name="jmldata" value="6" >
				
		<tr>
			<td>
				<select name="supplier_id_<?php echo $i ?>" id="supplier_id_<?php echo $i ?>" style="width:auto; height:27px; " />
					<option value=""></option>
					<?php select_supplier($pustaka_supplier_det->supplier_id); ?>
				</select>
			</td>
			
		</tr>
		
				
	<?php } ?>
</table>
