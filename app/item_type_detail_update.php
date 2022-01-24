<?php
	$sql=$select->list_item_type_detail($ref);
	$jmldata = $sql->rowCount();
?>

<table class="table table-bordered table-condensed table-hover table-striped" style="width: auto;">
	<thead>
		<tr> 
			<th><?php if($lng==1) { echo 'Unit'; } else { echo 'Unit'; } ?></th> 
			<th><?php if($lng==1) { echo 'Inventory Acc'; } else { echo 'Akun Inventori'; } ?></th>	
			<th><?php if($lng==1) { echo 'Product Cost Acc'; } else { echo 'Akun Biaya Produksi'; } ?></th>
			<th><?php if($lng==1) { echo 'Good in Transit Acc'; } else { echo 'Akun Barang dalam perjalanan'; } ?></th>	
			<th><?php if($lng==1) { echo 'Work in Process Acc'; } else { echo 'Akun Proses Produksi'; } ?></th>
			<th><?php if($lng==1) { echo 'COGS Acc'; } else { echo 'Akun HPP'; } ?></th>
			<th><?php if($lng==1) { echo 'Delete'; } else { echo 'Hapus'; } ?></th>					
		</tr>
	</thead>
	<tbody>
		
		<?php 
			$no = 0;
			while($row_item_type_detail=$sql->fetch(PDO::FETCH_OBJ)) { 		
		?>
				
				<input type="hidden" id="old_line_<?php echo $no ?>" name="old_line_<?php echo $no ?>" value="<?php echo $row_item_type_detail->line; ?>" >
				<input type="hidden" id="old_syscode_<?php echo $no ?>" name="old_syscode_<?php echo $no ?>" value="<?php echo $row_item_type_detail->syscode; ?>" >
				
				<tr style="background-color:ffffff;" > 	
					<td>
						<select id="location_id_<?php echo $no ?>" name="location_id_<?php echo $no ?>" class="chosen-select form-control" style="width: 200px; font-size: 11px" >
							<option value=""></option>
							<?php 
								combo_select_active("warehouse","id","name","active","1",$row_item_type_detail->location_id)
							?>	

						</select>	
					</td>
					
					<td>
						<select id="inventory_acccode_<?php echo $no ?>" name="inventory_acccode_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
							<option value=""></option>
							<?php 
								select_coa($row_item_type_detail->inventory_acccode);
							?>	

						</select>	
					</td>
					
					<td>
						<select id="productcost_acccode_<?php echo $no ?>" name="productcost_acccode_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
							<option value=""></option>
							<?php 
								select_coa($row_item_type_detail->productcost_acccode);
							?>	

						</select>	
					</td>
					
					<td>
						<select id="goodintransit_acccode_<?php echo $no ?>" name="goodintransit_acccode_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
							<option value=""></option>
							<?php 
								select_coa($row_item_type_detail->goodintransit_acccode);
							?>	

						</select>	
					</td>
					
					<td>
						<select id="workinprocess_acccode_<?php echo $no ?>" name="workinprocess_acccode_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
							<option value=""></option>
							<?php 
								select_coa($row_item_type_detail->workinprocess_acccode);
							?>	

						</select>	
					</td>
					
					<td>
						<select id="cogs_acccode_<?php echo $no ?>" name="cogs_acccode_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
							<option value=""></option>
							<?php 
								select_coa($row_item_type_detail->cogs_acccode);
							?>	

						</select>	
					</td>
					
					<td align="center">
						<input type="checkbox" id="delete_<?php echo $no; ?>" name="delete_<?php echo $no; ?>" class="form-control" value="1" >
					</td>
					
				</tr>
			<?php
			
				$no++; 
			}
			?>
			
			
		<?php 
			$sqlwhs 	= 	$select->list_warehouse();
			$jmldataw 	= 	$sqlwhs->rowCount();
			
			$x = $no;
			$jmldata2 = $jmldataw - $jmldata;
			$jmldata2 = $jmldata2 + $jmldata;
			for($no=$x; $no<=$jmldata2; $no++) {		
		?>
		
				
				<tr style="background-color:ffffff;" > 	
					<td>
						<select id="location_id_<?php echo $no ?>" name="location_id_<?php echo $no ?>" class="chosen-select form-control" style="width: 200px; font-size: 11px" >
							<option value=""></option>
							<?php 
								combo_select_active("warehouse","id","name","active","1","")
							?>	

						</select>	
					</td>
					
					<td>
						<select id="inventory_acccode_<?php echo $no ?>" name="inventory_acccode_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
							<option value=""></option>
							<?php 
								select_coa("");
							?>	

						</select>	
					</td>
					
					<td>
						<select id="productcost_acccode_<?php echo $no ?>" name="productcost_acccode_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
							<option value=""></option>
							<?php 
								select_coa("");
							?>	

						</select>	
					</td>
					
					<td>
						<select id="goodintransit_acccode_<?php echo $no ?>" name="goodintransit_acccode_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
							<option value=""></option>
							<?php 
								select_coa("");
							?>	

						</select>	
					</td>
					
					<td>
						<select id="workinprocess_acccode_<?php echo $no ?>" name="workinprocess_acccode_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
							<option value=""></option>
							<?php 
								select_coa("");
							?>	

						</select>	
					</td>
					
					<td>
						<select id="cogs_acccode_<?php echo $no ?>" name="cogs_acccode_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
							<option value=""></option>
							<?php 
								select_coa("");
							?>	

						</select>	
					</td>
					
				</tr>
			<?php
			}
			?>
			
			<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $no; ?>" >
								
	</tbody>
</table>
