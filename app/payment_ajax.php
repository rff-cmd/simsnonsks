<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];
switch ($pilih){
	case "getinvoice":
		$vendor_code = $_POST["vendor_code"];	
		
		$sql=$select->get_payment_detail($vendor_code);
		$jmldata = $sql->rowCount(); 
		
?>		
		 
		<table id="simple-table" class="table table-striped table-bordered table-hover" >
			<thead>
				<tr> 
					<th>Invoice No</th>
					<th>No. Nota</th>
					<th>Date</th>
					<th>Transaction</th> 
					<th>Due Date</th> 					
					<!--<th>Rate</th>-->
					<th>Discount</th>
					<th>Amount Due</th>
					<th>Amount Paid</th>
					<th>Select</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				
					$no = 0;
					while($row_payment_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
					
					$rate = number_format($row_payment_detail->rate, 0, '.', ',');
					$amount_due = number_format($row_payment_detail->amount_paid, 0, '.', ',');
					$discount = number_format($row_payment_detail->discount, 0, '.', ',');
					$amount_paid = number_format($row_payment_detail->amount_paid, 0, '.', ',');
										
					$invoice_date = date("d-m-Y", strtotime($row_payment_detail->date));
					$invoice_due_date = date("d-m-Y", strtotime($row_payment_detail->due_date));
					if($invoice_due_date == "01-01-1970") {
						$invoice_due_date = "";
					}
					
					$transaction = "";
					if($row_payment_detail->invoice_type == "PIN") {
						$transaction = "Purchase Invoice";
					}
					if($row_payment_detail->invoice_type == "DPM") {
						$transaction = "Direct Payment";
					}
					if($row_payment_detail->invoice_type == "OPEN") {
						$transaction = "Open. Balance";
					}
					if($row_payment_detail->invoice_type == "PIQ") {
						$transaction = "Purchase";
					}
					if($row_payment_detail->invoice_type == "PIR") {
						$transaction = "Purchase Return";
					}
					if($row_payment_detail->invoice_type == "POV") {
						$transaction = "Purchase";
					}
					
				?>
					<input type="hidden" id="invoice_no_<?php echo $no ?>" name="invoice_no_<?php echo $no ?>" value="<?php echo $row_payment_detail->invoice_no; ?>" >	
					<input type="hidden" id="invoice_date_<?php echo $no ?>" name="invoice_date_<?php echo $no ?>" value="<?php echo $invoice_date; ?>" >	
					<input type="hidden" id="invoice_due_date_<?php echo $no ?>" name="invoice_due_date_<?php echo $no ?>" value="<?php echo $invoice_due_date; ?>" >					
					<input type="hidden" id="transaction_<?php echo $no ?>" name="transaction_<?php echo $no ?>" value="<?php echo $row_payment_detail->invoice_type; ?>" >
					<input type="hidden" id="amount_due_<?php echo $no ?>" name="amount_due_<?php echo $no ?>" value="<?php echo $amount_due ?>" >
					<input type="hidden" id="currency_code_<?php echo $no ?>" name="currency_code_<?php echo $no ?>" value="<?php echo $row_payment_detail->currency ?>" >
					<input type="hidden" id="rate_<?php echo $no ?>" name="rate_<?php echo $no ?>" value="<?php echo $rate ?>" >
					
					<input type="hidden" id="old_discount_<?php echo $no ?>" name="old_discount_<?php echo $no ?>" value="<?php echo $discount ?>" >
					<input type="hidden" id="old_amount_paid_<?php echo $no ?>" name="old_amount_paid_<?php echo $no ?>" value="<?php echo $amount_paid ?>" >
					
					<tr style="background-color:ffffff;"> 
						<td>							
							<?php 
								echo $row_payment_detail->invoice_no;
							?>	

						</td>
						<td>							
							<?php 
								echo $row_payment_detail->no_nota;
							?>	

						</td>
						<td>							
							<?php 
								echo $invoice_date;
							?>	

						</td>
						<td>							
							<?php 
								echo $transaction;
							?>	

						</td>
						<td>							
							<?php 
								echo $invoice_due_date;
							?>	

						</td>
						<!--
						<td>							
							<?php 
								echo $rate;
							?>	

						</td>-->
						<td align="right" id="discount<?php echo $no ?>">
							<input type="text" id="discount_<?php echo $no; ?>" name="discount_<?php echo $no; ?>" style="text-align: right; width: 90px" class="form-control" onkeyup="formatangka('discount_<?php echo $no; ?>'), sub_totals('<?php echo $jmldata ?>')" readonly value="" >
						</td>
						
						<td align="right">							
							<?php 
								echo $amount_due;
							?>	

						</td>
						
						<td align="center" id="amount_paid<?php echo $no ?>">
							<input type="text" id="amount_paid_<?php echo $no; ?>" name="amount_paid_<?php echo $no; ?>" style="text-align: right; width: 110px" class="form-control" onkeyup="formatangka('amount_paid_<?php echo $no; ?>'), sub_totals('<?php echo $jmldata ?>')" readonly value="" >
						</td>
						
						<td align="center">
							<input type="checkbox" id="select_<?php echo $no; ?>" name="select_<?php echo $no; ?>" class="form-control" onchange="cek_one('<?php echo $no ?>', '<?php echo $jmldata; ?>')" value="1" >
						</td>
						
					</tr>
					<?php 
						
						$no++; 
					} 
					?>
					
					<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $no; ?>" >
					<!-----sub total--------->
					
					
					<tr>
						<td align="right" colspan="8">Sub Total :</td>						
						<td align="right" id="subtotal_2">							
							<input type="text" id="sub_total" name="sub_total" class="form-control" onkeyup="formatangka('sub_total')" style="text-align: right; width: 110px" readonly value="<?php echo $sub_total ?>">
						</td>
						<td>&nbsp;</td>
					</tr>
					
					<tr>
						<!--<td align="right">Round Amount Account :</td>
						<td colspan="6">
							<select id="round_amount_account" name="round_amount_account" data-placeholder="Choose a Account..." class="form-control chzn-select" tabindex="2">
								<option value=""></option>
								<?php 
									//select_coa($row_payment->round_amount_account) 
								?>	                            
							</select>
						</td>-->
                      
						<td align="right" colspan="8">Round Amount :</td>						
						<td align="right">							
							<input type="text" id="round_amount" name="round_amount" class="form-control" onkeyup="formatangka('round_amount'), sub_totals('<?php echo $jmldata; ?>')" style="text-align: right; width: 110px" value="<?php echo $round_amount ?>">
						</td>
						<td>&nbsp;</td>
					</tr>
					
					<tr>
						<!--<td align="right">Bank Charge Account :</td>
						<td colspan="6">
							<select id="bank_charge_account" name="bank_charge_account" data-placeholder="Choose a Account..." class="form-control chzn-select" tabindex="2">
								<option value=""></option>
								<?php 
									//select_coa($row_payment->bank_charge_account) 
								?>	                            
							</select>
						</td>-->
						
						<td align="right" colspan="8">Bank Charge :</td>						
						<td align="right">							
							<input type="text" id="bank_charge" name="bank_charge" class="form-control" onkeyup="formatangka('bank_charge'), sub_totals('<?php echo $jmldata; ?>')" style="text-align: right; width: 110px" value="<?php echo $bank_charge ?>">
						</td>
						<td>&nbsp;</td>
					</tr>
					
					<tr>
						<td align="right" colspan="4">Payment Amount :</td>
						<td id="amount2">
							<input type="text" id="amount" name="amount" class="form-control" onkeyup="formatangka('amount'), balance()" style="text-align: right" autocomplete="off" value="<?php echo $amount ?>">
						</td>
						
						<td align="right">Deposit :</td>
						<td align="right" id="deposit2">
							<input type="text" id="deposit" name="deposit" class="form-control" onkeyup="formatangka('deposit'), sub_totals('<?php echo $jmldata; ?>')" style="text-align: right" readonly value="<?php echo $deposit ?>">
						</td>
						
						<td align="right">Total :</td>						
						<td align="right" id="total2">							
							<input type="text" id="total" name="total" class="form-control" onkeyup="formatangka('total')" style="text-align: right; width: 110px" readonly value="<?php echo $total ?>">
						</td>
						<td>&nbsp;</td>
					</tr>
					<!-----end sub total--------->
			</tbody>	
		</table>
					
<?php
		break;
		
	default:
}
?>