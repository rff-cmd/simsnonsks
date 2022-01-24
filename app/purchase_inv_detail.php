<?php
		$sql=$select->list_purchase_inv_detail($ref);
		$jmldata = $sql->rowCount();
 ?>
 
 <table class="table table-bordered table-condensed table-hover table-striped" style="width: auto; font-size: 11px">
	<thead>
		<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
			<th>No.</th>
			<th><?php if($lng==1) { echo 'Item Code'; } else { echo 'Kode Barang'; } ?></th>
			<th><?php if($lng==1) { echo 'Item Name'; } else { echo 'Nama Barang'; } ?></th> 
			<th>Satuan</th> 			
			<!--<th>Size</th>-->						 
			<th><?php if($lng==1) { echo 'Qty'; } else { echo 'Jml Barang'; } ?></th>	
			<th><?php if($lng==1) { echo 'Unit Cost'; } else { echo 'Harga Satuan'; } ?></th>
			<th><?php if($lng==1) { echo 'Discount(%)'; } else { echo 'Discount(%)'; } ?></th>
			<!--<th><?php if($lng==1) { echo 'Discount-2(%)'; } else { echo 'Discount-2(%)'; } ?></th>
			<th><?php if($lng==1) { echo 'Discount-3(%)'; } else { echo 'Discount-3(%)'; } ?></th>-->
			<th><?php if($lng==1) { echo 'Discount(Rp)'; } else { echo 'Discount(Rp)'; } ?></th>
			<th><?php if($lng==1) { echo 'Amount'; } else { echo 'Total'; } ?></th>
			<th><?php if($lng==1) { echo 'Delete'; } else { echo 'Hapus'; } ?></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		
			$totalx = 0;
			$total2 = 0;
			$no = 0;
			while($row_purchase_inv_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
			
				$size = $row_purchase_inv_detail->size;
				$qty = number_format($row_purchase_inv_detail->qty, 2, '.', ',');
				$unit_cost = number_format($row_purchase_inv_detail->unit_cost, 2, '.', ',');
				$discount_det = number_format($row_purchase_inv_detail->discount, 2, '.', ',');
                $discount3_1_det = number_format($row_purchase_inv_detail->discount1, 2, '.', ',');
                $discount3_2_det = number_format($row_purchase_inv_detail->discount2, 2, '.', ',');
                $discount3_3_det = number_format($row_purchase_inv_detail->discount3, 2, '.', ',');
				$amount = number_format($row_purchase_inv_detail->amount, 2, '.', ',');
				
				$totalx = $totalx + $row_purchase_inv_detail->amount;
				$total2 = number_format($totalx, 2, '.', ',');
				
				
		?>								
			<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $jmldata; ?>" >
			
			<input type="hidden" id="old_item_code_<?php echo $no ?>" name="old_item_code_<?php echo $no ?>" value="<?php echo $row_purchase_inv_detail->item_code; ?>" >
			<input type="hidden" id="old_uom_code_<?php echo $no ?>" name="old_uom_code_<?php echo $no ?>" value="<?php echo $row_purchase_inv_detail->uom_code; ?>" >
			<input type="hidden" id="old_line_<?php echo $no ?>" name="old_line_<?php echo $no ?>" value="<?php echo $row_purchase_inv_detail->line; ?>" >
		
			<input type="hidden" id="item_code_<?php echo $no ?>" name="item_code_<?php echo $no ?>" value="<?php echo $row_purchase_inv_detail->item_code; ?>" >	
			
			<!--<input type="hidden" id="discount3_1_<?php echo $no; ?>" name="discount3_1_<?php echo $no; ?>" style="text-align: right; font-size:11px" class="form-control" onkeyup="formatangka('discount3_1_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>', 'persen')" value="<?php echo $discount3_1_det ?>" />-->
			<input type="hidden" id="discount3_2_<?php echo $no; ?>" name="discount3_2_<?php echo $no; ?>" style="text-align: right; font-size:11px" class="form-control" onkeyup="formatangka('discount3_2_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>', 'persen')" value="<?php echo $discount3_2_det ?>" />
			<input type="hidden" id="discount3_3_<?php echo $no; ?>" name="discount3_3_<?php echo $no; ?>" style="text-align: right; font-size:11px" class="form-control" onkeyup="formatangka('discount3_3_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>', 'persen')" value="<?php echo $discount3_3_det ?>" />
			<input type="hidden" id="discount_<?php echo $no; ?>" name="discount_<?php echo $no; ?>" readonly="" style="text-align: right; font-size:11px" class="form-control" onkeyup="formatangka('discount_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>', 'nominal')" value="<?php echo $discount_det ?>" />
			
			
			
			
			<input type="hidden" id="old_qty_<?php echo $no; ?>" name="old_qty_<?php echo $no; ?>" style="text-align: right; width: 70px" class="form-control" value="<?php echo $qty ?>" >
			
			<tr style="background-color:ffffff;" id="item_ajax2_<?php echo $no; ?>" > 
				<td>				
					<?php echo $no+1; ?>
				</td>
				<td>				
					<?php echo $row_purchase_inv_detail->item_code2; ?>
					<input type="hidden" id="item_code2_<?php echo $no ?>" name="item_code2_<?php echo $no ?>" class="form-control" readonly="" style="width: 80px" value="<?php echo $row_purchase_inv_detail->item_code2; ?>" >
				</td>
				<td>				
					<?php echo $row_purchase_inv_detail->item_name; ?>
					<input type="hidden" id="item_name_<?php echo $no ?>" name="item_name_<?php echo $no ?>" class="form-control" readonly="" style="width: 290px" value="<?php echo $row_purchase_inv_detail->item_name; ?>" >
				</td>
				<td>
					<input type="text" id="uom_code_<?php echo $no ?>" name="uom_code_<?php echo $no ?>" class="form-control" readonly="" style="width: 60px" value="<?php echo $row_purchase_inv_detail->uom_code; ?>" >		
				</td>
				<!--<td>-->
					<input type="hidden" id="size_<?php echo $no ?>" name="size_<?php echo $no ?>" class="form-control" readonly="" style="width: 60px" value="<?php echo $size; ?>" >		
				<!--</td>-->
				<td align="center">
					<input type="text" id="qty_<?php echo $no; ?>" name="qty_<?php echo $no; ?>" style="text-align: right; width: 60px " class="form-control" onkeyup="formatangka('qty_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>', 'persen')" value="<?php echo $qty ?>" >
				</td>
				<td align="center">
					<input type="text" id="unit_cost_<?php echo $no; ?>" name="unit_cost_<?php echo $no; ?>" style="text-align: right; width: 100px" class="form-control" onkeyup="formatangka('unit_cost_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>', 'persen')" value="<?php echo $unit_cost ?>" >
				</td>
				
				<?php /*
                
				
				<td align="center" id="discount3_2_det_id<?php echo $no; ?>">
					<input type="text" id="discount3_2_<?php echo $no; ?>" name="discount3_2_<?php echo $no; ?>" style="text-align: right; font-size:11px" class="form-control" onkeyup="formatangka('discount3_2_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>', 'persen')" value="<?php echo $discount3_2_det ?>" >
				</td>
				
				<td align="center" id="discount3_3_det_id<?php echo $no; ?>">
					<input type="text" id="discount3_3_<?php echo $no; ?>" name="discount3_3_<?php echo $no; ?>" style="text-align: right; font-size:11px" class="form-control" onkeyup="formatangka('discount3_3_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>', 'persen')" value="<?php echo $discount3_3_det ?>" >
				</td>
				*/ ?>
				
				<td align="center" id="discount3_1_det_id<?php echo $no; ?>">
					<input type="text" id="discount3_1_<?php echo $no; ?>" name="discount3_1_<?php echo $no; ?>" style="text-align: right; width: 60px" class="form-control" onkeyup="formatangka('discount3_1_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>', 'persen')" value="<?php echo $discount3_1_det ?>" >
				</td>
				
				<td align="right" id="discount_det_id<?php echo $no; ?>">
					<input type="text" id="discount_<?php echo $no; ?>" name="discount_<?php echo $no; ?>" style="text-align: right; width: 100px" class="form-control" onkeyup="formatangka('discount_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>', 'nominal')" value="<?php echo $discount_det ?>" >
				</td>
				
				<td align="center" id="amount<?php echo $no; ?>">
					<input type="text" id="amount_<?php echo $no; ?>" name="amount_<?php echo $no; ?>" style="text-align: right; width: 150px" class="form-control" onkeyup="formatangka('amount_<?php echo $no; ?>')" readonly value="<?php echo $amount ?>" >
				</td>
				<td align="center">
					<label class="pos-rel">
						<input type="checkbox" id="delete_<?php echo $no; ?>" name="delete_<?php echo $no; ?>" class="ace" value="1" ><span class="lbl"></span>
					</label>
					
				</td>
				
			</tr>
			<?php 
										
				$no++; 
			} 
			
			$total_tax = ($totalx * $row_purchase_inv->tax_rate)/100;
			$grand_total = $totalx + $total_tax;
			$grand_total = number_format($grand_total,2,".",",");
			
			if( numberreplace($cash_amount) < numberreplace($grand_total) ) {
				$cash_amount =  numberreplace($grand_total);
				$cash_amount = number_format($cash_amount,2,".",",");
				
				$change_amount = numberreplace($cash_amount) - numberreplace($grand_total); 
			} else {
				$change_amount = $row_purchase_inv->change_amount;
			}
			
			
			?>
			
			<!--add item-->
			<?php /*----------------------------------
			<tr style="background-color:ffffff;" id="item_ajax_det" > 
				<td>				
					
				</td>
				<td>				
					<input type="text" id="item_code3_<?php echo $no ?>" name="item_code3_<?php echo $no ?>" class="form-control" onchange="loadHTMLPost3('app/purchase_inv_detail_ajax.php','item_ajax_det','getdata_det','item_code2','location_id')" style="width: 80px" autofocus="" value="" >
				</td>
				<td>				
					<input type="text" id="item_name_<?php echo $no ?>" name="item_name_<?php echo $no ?>" class="form-control" readonly="" style="width: 290px" value="" >
				</td>
				<td>
					<input type="text" id="uom_code_<?php echo $no ?>" name="uom_code_<?php echo $no ?>" class="form-control" readonly="" style="width: 60px" value="" >		
				</td>
				<td align="center">
					<input type="text" id="qty_<?php echo $no; ?>" name="qty_<?php echo $no; ?>" style="text-align: right; width: 60px " class="form-control" onkeyup="formatangka('qty_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>', 'persen')" value="" >
				</td>
				<td align="center">
					<input type="text" id="unit_cost_<?php echo $no; ?>" name="unit_cost_<?php echo $no; ?>" style="text-align: right; width: 100px" class="form-control" onkeyup="formatangka('unit_cost_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>', 'persen')" value="" >
				</td>----------------------------------*/ ?>
				
				<?php /*
                
				
				<td align="center" id="discount3_2_det_id<?php echo $no; ?>">
					<input type="text" id="discount3_2_<?php echo $no; ?>" name="discount3_2_<?php echo $no; ?>" style="text-align: right; font-size:11px" class="form-control" onkeyup="formatangka('discount3_2_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>', 'persen')" value="<?php echo $discount3_2_det ?>" >
				</td>
				
				<td align="center" id="discount3_3_det_id<?php echo $no; ?>">
					<input type="text" id="discount3_3_<?php echo $no; ?>" name="discount3_3_<?php echo $no; ?>" style="text-align: right; font-size:11px" class="form-control" onkeyup="formatangka('discount3_3_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>', 'persen')" value="<?php echo $discount3_3_det ?>" >
				</td>
				*/ ?>
			
			<?php /*----------------------------------	
				<td align="center" id="discount3_1_det_id<?php echo $no; ?>">
					<input type="text" id="discount3_1_<?php echo $no; ?>" name="discount3_1_<?php echo $no; ?>" style="text-align: right; width: 60px" class="form-control" onkeyup="formatangka('discount3_1_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>', 'persen')" value="" >
				</td>
				
				<td align="right" id="discount_det_id<?php echo $no; ?>">
					<input type="text" id="discount_<?php echo $no; ?>" name="discount_<?php echo $no; ?>" style="text-align: right; width: 100px" class="form-control" onkeyup="formatangka('discount_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>', 'nominal')" value="" >
				</td>
				
				<td align="center" id="amount<?php echo $no; ?>">
					<input type="text" id="amount_<?php echo $no; ?>" name="amount_<?php echo $no; ?>" style="text-align: right; width: 150px" class="form-control" onkeyup="formatangka('amount_<?php echo $no; ?>')" readonly value="" >
				</td>
				<td align="center">
					<input type="checkbox" id="delete_<?php echo $no; ?>" name="delete_<?php echo $no; ?>" class="form-control" value="1" >
					
				</td>
				
			</tr> ----------------------------------*/ ?>
			<!--end add item-->
			
			<tr>
				<td colspan="6" align="right" style="font-size: 14px; font-weight: bold;">Discount&nbsp;</td>
				<td align="center">
					<input type="text" id="discount" name="discount" style="text-align: right; font-size: 14px; font-weight: bold; width: 60px" class="form-control" onkeyup="formatangka('discount'), sub_total('<?php echo $jmldata ?>')" value="<?php echo $discount2 ?>" >
				</td>
				<td colspan="1" align="right" style="font-size: 14px; font-weight: bold;">Sub Total&nbsp;</td>
				<td align="right" id="sub_total_id">
					<input type="text" id="sub_totalx" name="sub_totalx" readonly="" style="text-align: right; font-size: 14px; font-weight: bold; width: 150px" class="form-control" onkeyup="formatangka('sub_totalx')" value="<?php echo $total2 ?>" >
				</td>
			</tr>
			
			<tr>
				<td colspan="8" align="right" style="font-size: 14px; font-weight: bold;">Total Pajak&nbsp;</td>
				<td align="right" id="total_tax_id">
					<input type="text" id="total_tax" name="total_tax" readonly="" style="text-align: right; font-size: 14px; font-weight: bold; width: 150px" class="form-control" onkeyup="formatangka('total_tax')" value="<?php echo number_format($total_tax, 2, '.', ',') ?>" >
				</td>
			</tr>
			
			<tr>
				<td colspan="8" align="right" style="font-size: 14px; font-weight: bold;">Grand Total&nbsp;</td>
				<td align="right" id="total_id">
					<input type="text" id="total" name="total" readonly="" style="text-align: right; font-size: 14px; font-weight: bold; width: 150px" onkeyup="formatangka('total')" value="<?php echo $grand_total ?>" >
				</td>
			</tr>
			
			<!-- <tr> -->
				<!--<td colspan="3" align="right" style="font-size: 14px; font-weight: bold;"><?php if($lng==1) { echo 'DP (Down Payment)'; } else { echo 'Uang Muka'; } ?>&nbsp;</td>
				<td align="right">-->
					<input type="hidden" id="deposit" name="deposit" style="text-align: right; font-size: 14px; font-weight: bold;" class="form-control" onkeyup="formatangka('deposit')" value="<?php echo $deposit ?>" >
				<!--</td>-->
				<!-- <td colspan="7">&nbsp;</td>
				<td align="right" style="font-size: 14px; font-weight: bold;">Bayar&nbsp;</td>
				<td align="right"> -->
					<input type="hidden" id="cash_amount" name="cash_amount" style="text-align: right; font-size: 14px; font-weight: bold; width: 150px" class="form-control" onkeyup="formatangka('cash_amount'), sub_total('<?php echo $jmldata ?>')" value="<?php echo $cash_amount ?>" >
				<!-- </td>
			</tr> -->
			
			<?php include("purchase_inv_bank.php"); ?>
			
			<!-- <tr>
				<td colspan="8" align="right" style="font-size: 14px; font-weight: bold;">Kembalian&nbsp;</td>
				<td align="right" id="change_amount_id"> -->
					<input type="hidden" id="change_amount" name="change_amount" readonly="" style="text-align: right; font-size: 14px; font-weight: bold; width: 150px" class="form-control" onkeyup="formatangka('change_amount')" value="<?php echo number_format($change_amount,2,".",",") ?>" >
				<!-- </td>
			</tr> -->
										
	</tbody>
</table>