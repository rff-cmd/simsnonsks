
<table class="table table-bordered table-condensed table-hover table-striped" style="width: auto;">
	<thead>
		<tr> 
			<th><?php if($lng==1) { echo 'Unit'; } else { echo 'Unit'; } ?></th> 
			<th><?php if($lng==1) { echo 'Inventory Acc'; } else { echo 'Akun Inventori'; } ?></th>	
			<th><?php if($lng==1) { echo 'Product Cost Acc'; } else { echo 'Akun Biaya Produksi'; } ?></th>
			<th><?php if($lng==1) { echo 'Good in Transit Acc'; } else { echo 'Akun Barang dalam perjalanan'; } ?></th>	
			<th><?php if($lng==1) { echo 'Work in Process Acc'; } else { echo 'Akun Proses Produksi'; } ?></th>
			<th><?php if($lng==1) { echo 'COGS Acc'; } else { echo 'Akun HPP'; } ?></th>					
		</tr>
	</thead>
	<tbody>
		
		<?php 
			$sqlwhs 	= 	$select->list_warehouse();
			$jmldata 	= 	$sqlwhs->rowCount();
	
			for($no=0; $no<=$jmldata; $no++) {		
		?>
		
				<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $jmldata; ?>" >
				
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
								
	</tbody>
</table>
