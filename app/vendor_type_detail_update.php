<?php
	$sql=$select->list_vendor_type_detail($ref);
	$jmldata = $sql->rowCount();
?>

<div class="col-sm">
	<div class="widget-box">
		<div class="widget-header">
			<h4 class="widget-title">Kode Akun</h4>
		</div>
        
        <table id="simple-table" class="table table-striped table-bordered table-hover">

            <thead>
        		<tr>            
        			<th><?php if($lng==1) { echo 'Unit'; } else { echo 'Unit'; } ?></th> 
					<th><?php if($lng==1) { echo 'Purchase Acc'; } else { echo 'Akun Pembelian Hutang'; } ?></th>	
					<th><?php if($lng==1) { echo 'Purchase Cash Acc'; } else { echo 'Akun Pembelian Kontan'; } ?></th>
					<th><?php if($lng==1) { echo 'Purchase Return Acc'; } else { echo 'Akun Pengembalian Pembelian'; } ?></th>
					<th><?php if($lng==1) { echo 'Purchase Discount Acc'; } else { echo 'Akun Diskon Pembelian'; } ?></th>
					<th><?php if($lng==1) { echo 'Supplier Deposit Acc'; } else { echo 'Akun Uang Muka Pembelian'; } ?></th>
					<th><?php if($lng==1) { echo 'Currency Acc'; } else { echo 'Akun Mata Uang'; } ?></th>										<th><?php if($lng==1) { echo 'Cheque Payable Acc'; } else { echo 'Akun Hutang Cek'; } ?></th>								<th><?php if($lng==1) { echo 'Acc Hutang Belum Difakturkan'; } else { echo 'Akun Hutang Belum Difakturkan'; } ?></th>
					<th><?php if($lng==1) { echo 'Delete'; } else { echo 'Hapus'; } ?></th>
        		</tr>
        	</thead>
            

        	<tbody>
                
            <?php 
            	
            	$no = 0;
				while($row_vendor_type_detail=$sql->fetch(PDO::FETCH_OBJ)) {
                
            ?>
            
                    <input type="hidden" id="old_line_<?php echo $no ?>" name="old_line_<?php echo $no ?>" value="<?php echo $row_vendor_type_detail->line; ?>" >
					<input type="hidden" id="old_id_<?php echo $no ?>" name="old_id_<?php echo $no ?>" value="<?php echo $row_vendor_type_detail->id; ?>" >
					
					<tr style="background-color:ffffff;" > 	
						<td>
							<select id="location_id_<?php echo $no ?>" name="location_id_<?php echo $no ?>" class="chosen-select form-control" style="width: 200px; font-size: 11px" >
								<option value=""></option>
								<?php 
									combo_select_active("warehouse","id","name","active","1",$row_vendor_type_detail->location_id)
								?>	

							</select>	
						</td>
						
						<td>
							<select id="pch_account_<?php echo $no ?>" name="pch_account_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
								<option value=""></option>
								<?php 
									select_coa($row_vendor_type_detail->pch_account);
								?>	

							</select>	
						</td>
						
						<td>
							<select id="pch_cash_account_<?php echo $no ?>" name="pch_cash_account_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
								<option value=""></option>
								<?php 
									select_coa($row_vendor_type_detail->pch_cash_account);
								?>	

							</select>	
						</td>
						
						<td>
							<select id="pch_return_account_<?php echo $no ?>" name="pch_return_account_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
								<option value=""></option>
								<?php 
									select_coa($row_vendor_type_detail->pch_return_account);
								?>	

							</select>	
						</td>
						
						<td>
							<select id="pch_discount_account_<?php echo $no ?>" name="pch_discount_account_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
								<option value=""></option>
								<?php 
									select_coa($row_vendor_type_detail->pch_discount_account);
								?>	

							</select>	
						</td>
						
						<td>
							<select id="client_deposit_account_<?php echo $no ?>" name="client_deposit_account_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
								<option value=""></option>
								<?php 
									select_coa($row_vendor_type_detail->client_deposit_account);
								?>	

							</select>	
						</td>
						
						<td>
							<select id="currency_account_<?php echo $no ?>" name="currency_account_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
								<option value=""></option>
								<?php 
									select_coa($row_vendor_type_detail->currency_account);
								?>	

							</select>	
						</td>
						
						<td>
							<select id="cheque_receivable_account_<?php echo $no ?>" name="cheque_receivable_account_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
								<option value=""></option>
								<?php 
									select_coa($row_vendor_type_detail->cheque_receivable_account);
								?>	

							</select>	
						</td>
						
						<td>
							<select id="pch_account2_<?php echo $no ?>" name="pch_account2_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
								<option value=""></option>
								<?php 
									select_coa($row_vendor_type_detail->pch_account2);
								?>	

							</select>	
						</td>
						
						<td align="center">
							<input type="checkbox" id="delete_<?php echo $no; ?>" name="delete_<?php echo $no; ?>" value="1" ><span class="lbl"></span>
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
							<select id="pch_cash_account_<?php echo $no ?>" name="pch_cash_account_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
								<option value=""></option>
								<?php 
									select_coa("");
								?>	

							</select>	
						</td>
						
						<td>
							<select id="pch_cash_account_<?php echo $no ?>" name="pch_cash_account_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
								<option value=""></option>
								<?php 
									select_coa("");
								?>	

							</select>	
						</td>
						
						<td>
							<select id="pch_return_account_<?php echo $no ?>" name="pch_return_account_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
								<option value=""></option>
								<?php 
									select_coa("");
								?>	

							</select>	
						</td>
						
						<td>
							<select id="pch_discount_account_<?php echo $no ?>" name="pch_discount_account_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
								<option value=""></option>
								<?php 
									select_coa("");
								?>	

							</select>	
						</td>
						
						<td>
							<select id="client_deposit_account_<?php echo $no ?>" name="client_deposit_account_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
								<option value=""></option>
								<?php 
									select_coa("");
								?>	

							</select>	
						</td>
						
						<td>
							<select id="currency_account_<?php echo $no ?>" name="currency_account_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
								<option value=""></option>
								<?php 
									select_coa("");
								?>	

							</select>	
						</td>
						
						<td>
							<select id="cheque_receivable_account_<?php echo $no ?>" name="cheque_receivable_account_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
								<option value=""></option>
								<?php 
									select_coa("");
								?>	

							</select>	
						</td>
						
						<td>
							<select id="pch_account2_<?php echo $no ?>" name="pch_account2_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
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

    </div>
</div>