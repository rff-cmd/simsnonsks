<div class="col-sm">
	<div class="widget-box">
		<div class="widget-header">
			<h4 class="widget-title">Kode Akun</h4>
		</div>
        
        <table id="simple-table" class="table table-striped table-bordered table-hover">

            <thead>
        		<tr>            
        			<th><?php if($lng==1) { echo 'Unit'; } else { echo 'Unit'; } ?></th> 
					<th><?php if($lng==1) { echo 'AR Sales Acc'; } else { echo 'Akun Penjualan Piutang'; } ?></th>	
					<th><?php if($lng==1) { echo 'Sales Cash Acc'; } else { echo 'Akun Penjualan Kontan'; } ?></th>
					<th><?php if($lng==1) { echo 'Sales Return Acc'; } else { echo 'Akun Pengembalian Penjualan'; } ?></th>
					<th><?php if($lng==1) { echo 'Sales Discount Acc'; } else { echo 'Akun Diskon Penjualan'; } ?></th>
					<th><?php if($lng==1) { echo 'Client Deposit Acc'; } else { echo 'Akun Uang Muka Penjualan'; } ?></th>
					<th><?php if($lng==1) { echo 'Currency Acc'; } else { echo 'Akun Mata Uang'; } ?></th>								<th><?php if($lng==1) { echo 'Cheque Receivable Acc'; } else { echo 'Akun Piutang Cek'; } ?></th>
					<th><?php if($lng==1) { echo 'Sales Acc'; } else { echo 'Akun Penjualan'; } ?></th>
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
							<select id="sls_account_<?php echo $no ?>" name="sls_account_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
								<option value=""></option>
								<?php 
									select_coa("");
								?>	

							</select>	
						</td>
						
						<td>
							<select id="sls_cash_account_<?php echo $no ?>" name="sls_cash_account_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
								<option value=""></option>
								<?php 
									select_coa("");
								?>	

							</select>	
						</td>
						
						<td>
							<select id="sls_return_account_<?php echo $no ?>" name="sls_return_account_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
								<option value=""></option>
								<?php 
									select_coa("");
								?>	

							</select>	
						</td>
						
						<td>
							<select id="sls_discount_account_<?php echo $no ?>" name="sls_discount_account_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
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
							<select id="sls_account2_<?php echo $no ?>" name="sls_account2_<?php echo $no ?>" class="chosen-select form-control" style="width: auto; font-size: 11px" >
								<option value=""></option>
								<?php 
									select_coa("");
								?>	

							</select>	
						</td>
						
						
					</tr>
        				
        	<?php } ?>
            
        	</tbody>
        </table>

    </div>
</div>