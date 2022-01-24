<?php
		$sql=$select->list_stock_opname_detail($ref);
		$jmldata = $sql->rowCount();
		
 ?>
 
 <table class="table table-bordered table-condensed table-hover table-striped" style="width: auto; font-size: 11px">
	<thead>
		<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
			<th><?php if($lng==1) { echo 'Item Code'; } else { echo 'Kode Barang'; } ?></th>
			<th><?php if($lng==1) { echo 'Item Name'; } else { echo 'Nama Barang'; } ?></th> 
			<th>Satuan</th> 									 
			<th><?php if($lng==1) { echo 'Qty'; } else { echo 'Jml Barang'; } ?></th>
			<th><?php if($lng==1) { echo 'Unit Cost'; } else { echo 'Harga'; } ?></th>	
			<th><?php if($lng==1) { echo 'Delete'; } else { echo 'Hapus'; } ?></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		
			$totalx = 0;
			$total2 = 0;
			$no = 0;
			while($row_stock_opname_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
			
				$qty = number_format($row_stock_opname_detail->qty, 0, '.', ',');
				
				$totalx = $totalx + $row_stock_opname_detail->qty;
				$total2 = number_format($totalx, 0, '.', ',');
				
				$unit_cost = number_format($row_stock_opname_detail->unit_cost, 0, '.', ',');
				
				
		?>								
			<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $jmldata; ?>" >
			
			<input type="hidden" id="old_item_code_<?php echo $no ?>" name="old_item_code_<?php echo $no ?>" value="<?php echo $row_stock_opname_detail->item_code; ?>" >
			<input type="hidden" id="old_uom_code_<?php echo $no ?>" name="old_uom_code_<?php echo $no ?>" value="<?php echo $row_stock_opname_detail->uom_code; ?>" >
			<input type="hidden" id="old_line_<?php echo $no ?>" name="old_line_<?php echo $no ?>" value="<?php echo $row_stock_opname_detail->line; ?>" >
		
			<input type="hidden" id="item_code_<?php echo $no ?>" name="item_code_<?php echo $no ?>" value="<?php echo $row_stock_opname_detail->item_code; ?>" >	
			
			
			<input type="hidden" id="old_qty_<?php echo $no; ?>" name="old_qty_<?php echo $no; ?>" style="text-align: right; width: 70px" class="form-control" value="<?php echo $qty ?>" >
			
			<tr style="background-color:ffffff;" id="item_ajax2_<?php echo $no; ?>" > 
				<td>				
					<input type="text" id="item_code2_<?php echo $no ?>" name="item_code2_<?php echo $no ?>" class="form-control" readonly="" style="width: auto; min-width: 150px" value="<?php echo $row_stock_opname_detail->item_code2; ?>" >
				</td>
				<td>				
					<input type="text" id="item_name_<?php echo $no ?>" name="item_name_<?php echo $no ?>" class="form-control" readonly="" style="width: auto; min-width: 300px" value="<?php echo $row_stock_opname_detail->item_name; ?>" >
				</td>
				<td>
					<input type="text" id="uom_code_<?php echo $no ?>" name="uom_code_<?php echo $no ?>" class="form-control" readonly="" style="width: 50px" value="<?php echo $row_stock_opname_detail->uom_code; ?>" >		
				</td>
				<td align="center">
					<input type="text" id="qty_<?php echo $no; ?>" name="qty_<?php echo $no; ?>" style="text-align: right;" class="form-control" onkeyup="formatangka('qty_<?php echo $no; ?>')" autocomplete="off" value="<?php echo $qty ?>" >
				</td>
				
				<td align="center">
					<input type="text" id="unit_cost_<?php echo $no; ?>" name="unit_cost_<?php echo $no; ?>" style="text-align: right;" class="form-control" onkeyup="formatangka('unit_cost_<?php echo $no; ?>')" autocomplete="off" value="<?php echo $unit_cost ?>" >
				</td>
				
				<td align="center">
					<input type="checkbox" id="delete_<?php echo $no; ?>" name="delete_<?php echo $no; ?>" class="form-control" value="1" >
					
				</td>
				
			</tr>
			<?php 
										
				$no++; 
			} 
			
				$grand_total	=	$total2;
			
				$uom_code = "pcs";
			?>
			
			<tr style="border: 1px solid #cccccc;" id="item_ajax">
	          	<td style="border-right: 1px solid #cccccc;">
	          		
	          		<input type="hidden" id="item_code" name="item_code" class="form-control chzn-select-deselect" value="">
	          		
	          		<input type="text" id="item_code3" name="item_code3" class="form-control" onchange="loadHTMLPost2('app/stock_opname_ajax2.php','item_ajax','getdata_code','item_code3')" autofocus="" onKeyPress="return focusNext('qty',event)" value="">
	          	</td>
	          	
	          	<td style="border-right: 1px solid #cccccc;">
	          		<input type="text" id="item_name" name="item_name" readonly="" class="form-control chzn-select-deselect" value="">
	          	</td>
	          	
	          	<td style="border-right: 1px solid #cccccc;">
					<select id="uom_code" name="uom_code" class="form-control" style="height: 35px; width: auto;">
						<option value=""></option>
						<?php 
							select_uom("") 
						?>
					</select>	
				</td>
				<td align="left" style="border-right: 1px solid #cccccc;">
					<input type="text" id="qty" name="qty" style="text-align: right;" class="form-control" onkeyup="formatangka('qty')" autocomplete="off" value="" >
				</td>
				
				<td align="left">
					<input type="text" id="unit_cost" name="unit_cost" style="text-align: right" class="form-control" onkeyup="formatangka('unit_cost')" value="" >
				</td>
	        </tr>
			
			
			<tr>
				<td colspan="3" align="right" style="font-size: 14px; font-weight: bold;">Total Qty&nbsp;</td>
				<td align="right" id="total_id">
					<input type="text" id="total" name="total" readonly="" style="text-align: right; font-size: 14px; font-weight: bold;" onkeyup="formatangka('total')" value="<?php echo $grand_total ?>" >
				</td>
			</tr>
			
										
	</tbody>
</table>