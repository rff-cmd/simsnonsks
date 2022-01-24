<script src="assets/js/appcustom.js"></script>
<script type="text/javascript" src="js/buttonajax.js"></script>

<script language="javascript">
	function print() {
		var ref = document.getElementById('ref').value;
		
		window.open('app/payment_print.php?ref='+ref, 'Pembayaran Print','825','450','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
	
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='date') {
			alert('Date cannot empty!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='vendor_code') {
			alert('Vendor cannot empty!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='payment_type') {
			alert('Payment Type cannot empty!');				
		  }
		  		  
		  return false
		} 
										
	  }		
	  
	  payment_type = document.getElementById('payment_type').value;
	  
	  if(payment_type == 'giro') {
	  	account_code = document.getElementById('account_code').value;
	  	if(account_code == '') {
			alert('Bank Account tidak boleh kosong');
		
			return false
		}
		
		cheque_no = document.getElementById('cheque_no').value;
	  	if(cheque_no == '') {
			alert('BG Number tidak boleh kosong');
		
			return false
		}
		
		bank_name = document.getElementById('bank_name').value;
	  	if(bank_name == '') {
			alert('Bank Name tidak boleh kosong');
		
			return false
		}
		
	  }
	  
	  
	  if(payment_type == 'cheque') {
	  	account_code = document.getElementById('account_code').value;
	  	if(account_code == '') {
			alert('Bank Account tidak boleh kosong');
		
			return false
		}
		
		cheque_no = document.getElementById('cheque_no').value;
	  	if(cheque_no == '') {
			alert('Cheque Number tidak boleh kosong');
		
			return false
		}
		
		bank_name = document.getElementById('bank_name').value;
	  	if(bank_name == '') {
			alert('Bank Name tidak boleh kosong');
		
			return false
		}
		
	  }
	  
	  if(payment_type == 'cash') {
	  	account_code = document.getElementById('account_code').value;
	  	if(account_code == '') {
			alert('Cash & Bank Account tidak boleh kosong');
		
			return false
		}
	  }
	  
	  if(payment_type == 'card') {
	  	credit_card_code = document.getElementById('credit_card_code').value;
	  	if(credit_card_code == '') {
			alert('Credit Card tidak boleh kosong');
		
			return false
		}
		
		credit_card_holder = document.getElementById('credit_card_holder').value;
	  	if(credit_card_holder == '') {
			alert('Credit Holder Name tidak boleh kosong');
		
			return false
		}
		
		credit_card_expired = document.getElementById('credit_card_expired').value;
	  	if(credit_card_expired == '') {
			alert('Credit Expired Date tidak boleh kosong');
		
			return false
		}
		
		
	  }
	  
	  round_amount = document.getElementById('round_amount').value.replace(/[^\d-.]/g,"");
	  if(round_amount > 0) {
	  	round_amount_account = document.getElementById('round_amount_account').value;
	  	if(round_amount_account == '') {
			alert('Round Amount Account tidak boleh kosong');
		
			return false
		}	
	  }
	  
	  bank_charge = document.getElementById('bank_charge').value.replace(/[^\d-.]/g,"");
	  if(bank_charge > 0) {
	  	bank_charge_account = document.getElementById('bank_charge_account').value;
	  	if(bank_charge_account == '') {
			alert('Bank Charge Account tidak boleh kosong');
		
			return false
		}	
	  }
	  	  
	  deposit = document.getElementById('deposit').value.replace(/[^\d-.]/g,"");
	  if(deposit > 0) {
		alert('Deposit tidak boleh > 0');
		
		return false
		
	 }
	 
	  
	}
		
</script>

<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost2(URL, destination, button, getId){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;		
		//str ='pchordnbr2='+ document.getElementById('pchordnbr2').value;
		
		var str = str + '&button=' + button;
        
		if (window.XMLHttpRequest){
			request = new XMLHttpRequest();
			request.onreadystatechange = processStateChange;
			request.open("POST", URL, true);
			request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
			request.send(str);		
					
		} else if (window.ActiveXObject) {
			request = new ActiveXObject("Microsoft.XMLHTTP");
			if (request) {
				request.onreadystatechange = processStateChange;
				request.open("POST", URL, true);
				request.send();				
			}
		}
				
	}
	 
</script>

<script>
	 
	function number_format(number, decimals, dec_point, thousands_sep) {
		number = (number + '')
		.replace(/[^0-9+\-Ee.]/g, '');
	  
	  var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function(n, prec) {
		  var k = Math.pow(10, prec);
		  return '' + (Math.round(n * k) / k)
			.toFixed(prec);
		};
	  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
	  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
		.split('.');
	  if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	  }
	  if ((s[1] || '')
		.length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1)
		  .join('0');
	  }
	  return s.join(dec);
	}
	
	
	function formatangka(field) {
		 //a = rci.amt.value;	 
		 a = document.getElementById(field).value;
		 //alert(a);
		 b = a.replace(/[^\d-.]/g,""); //b = a.replace(/[^\d]/g,"");
		 c = "";
		 panjang = b.length;
		 j = 0;
		 for (i = panjang; i > 0; i--)
		 {
			 j = j + 1;
			 if (((j % 3) == 1) && (j != 1))
			 {
			 	c = b.substr(i-1,1) + "," + c;
			 } else {
			 	c = b.substr(i-1,1) + c;
			 }
		 }
		 //rci.amt.value = c;
		 c = c.replace(",.",".");
		 c = c.replace(".,",".");
		 document.getElementById(field).value = c;	
		 
	}

	//-----------change nilai
	function detailvalue(id, jmldata){		
		var qty = 0;	
		qty=document.getElementById('qty_'+id).value; 
		//qty = number_format(qty,0,".",",");
		qty = qty.replace(/[^\d-.]/g,"");
		if(qty == "") {qty = 0};
				
		var unit_price = 0;
		unit_price=document.getElementById('unit_price_'+id).value; 
		//unit_price = number_format(unit_price,0,".",",");
		unit_price = unit_price.replace(/[^\d-.]/g,"");
		if(unit_price == "") {unit_price = 0};
		
		var amount = 0;
		amount = parseFloat(qty) * parseFloat(unit_price); //document.getElementById('amount_'+id).value; 
		amount = number_format(amount,2,".",",");	
				
		//$('#amount'+id).html('<input type="text" onkeyup="formatangka(\'amount_'+id+'\')" id="amount_'+id+'" name="amount_'+id+'" value="'+amount+'" readonly style="text-align:right; width: 140px" class="form-control" >');	
		
	 }	
	 
	 
	 //-----------checked nilai detail
	function cek_one(id, jmldata){
		
		var cek=document.getElementById('select_'+id).checked;
		
		if(cek){
			var amount_due=document.getElementById('amount_due_'+id).value; 
			amount_due = number_format(amount_due,0,".",",");	
			$('#amount_paid'+id).html('<input type="text" id="amount_paid_'+id+'" name="amount_paid_'+id+'" style="text-align: right; width: 110px" class="form-control" onkeyup="formatangka(\'amount_paid_'+id+'\'), sub_totals('+jmldata+')" value="'+amount_due+'" >');
			
			var discount=document.getElementById('discount_'+id).value; 
			discount = number_format(discount,0,".",",");
			$('#discount'+id).html('<input type="text" id="discount_'+id+'" name="discount_'+id+'" style="text-align: right; width: 90px" class="form-control" onkeyup="formatangka(\'discount_'+id+'\'), sub_totals('+jmldata+')" value="'+discount+'" >');
				
		}else{
			$('#amount_paid'+id).html('<input type="text" id="amount_paid_'+id+'" name="amount_paid_'+id+'" style="text-align: right; width: 110px" class="form-control" onkeyup="formatangka(\'amount_paid_'+id+'\'), detailvalue(\''+id+'\', '+jmldata+'), sub_totals('+jmldata+')" readonly value="" >');
			
			$('#discount'+id).html('<input type="text" id="discount_'+id+'" name="discount_'+id+'" style="text-align: right; width: 90px" class="form-control" onkeyup="formatangka(\'discount_'+id+'\'), sub_totals('+jmldata+')" readonly value="" >');			
			
		}
				
		sub_totals(jmldata);
		
		
		return false;
	 }
	 
	 
	 //-----------checked delete nilai detail
	function cek_one_del(id, jmldata){
		
		var m_delete=document.getElementById('delete_'+id).checked;
		
		if(m_delete){
			
			$('#amount_paid'+id).html('<input type="text" id="amount_paid_'+id+'" name="amount_paid_'+id+'" style="text-align: right; width: 110px" class="form-control" onkeyup="formatangka(\'amount_paid_'+id+'\'), detailvalue(\''+id+'\', '+jmldata+'), sub_totals('+jmldata+')" readonly value="" >');
			
			$('#discount'+id).html('<input type="text" id="discount_'+id+'" name="discount_'+id+'" style="text-align: right; width: 90px" class="form-control" onkeyup="formatangka(\'discount_'+id+'\'), sub_totals('+jmldata+')" readonly value="" >');	
							
		}else{
			
			var amount_due=document.getElementById('old_amount_paid_'+id).value; 
			amount_due = number_format(amount_due,0,".",",");	
			$('#amount_paid'+id).html('<input type="text" id="amount_paid_'+id+'" name="amount_paid_'+id+'" style="text-align: right; width: 110px" class="form-control" onkeyup="formatangka(\'amount_paid_'+id+'\'), sub_totals('+jmldata+')" value="'+amount_due+'" >');
			
			var discount=document.getElementById('old_discount_'+id).value; 
			discount = number_format(discount,0,".",",");
			$('#discount'+id).html('<input type="text" id="discount_'+id+'" name="discount_'+id+'" style="text-align: right; width: 90px" class="form-control" onkeyup="formatangka(\'discount_'+id+'\'), sub_totals('+jmldata+')" value="'+discount+'" >');
			
		}
		
		
		sub_totals(jmldata);
		
		
		return false;
	 }
	 
	 
	 function sub_totals(jmldata){
	 	
	 	var i=0;
		var jumlah='0';
		var sub_total='0';
		
		for(i=0; i<=jmldata; i++){
			
			if ( document.getElementById('amount_paid_'+i).value != isNaN || document.getElementById('amount_paid_'+i).value != 0) {				
				
				amount_paid = document.getElementById('amount_paid_'+i).value.replace(/[^\d-.]/g,"");
				
				jumlah = jumlah.replace(/[^\d-.]/g,"");
				
				if(amount_paid=='') { amount_paid = '0' }
				jumlah 	=  parseFloat(jumlah) + parseFloat(amount_paid);				
				jumlah = number_format(jumlah);													
			}
			
			if ( document.getElementById('discount_'+i).value != isNaN || document.getElementById('discount_'+i).value != 0) {				
				
				discount = document.getElementById('discount_'+i).value.replace(/[^\d-.]/g,"");
				
				jumlah = jumlah.replace(/[^\d-.]/g,"");
				
				if(discount=='') { discount = 0 }
				jumlah 	=  parseFloat(jumlah) - parseFloat(discount);				
				jumlah = number_format(jumlah);													
			}
						
			$('#subtotal_2').html('<input type="text" id="sub_total" name="sub_total" class="form-control" onchange="number_format('+'sub_total'+')" style="text-align: right; width: 110px" readonly value="'+ jumlah +'" ">');
			
			$('#deposit2').html('<input type="text" id="deposit" name="deposit" class="form-control" onchange="number_format('+'deposit'+')" style="text-align: right; width: 110px" readonly value="'+ jumlah +'" ">');
			
			$('#total2').html('<input type="text" id="total" name="total" class="form-control" onchange="number_format('+'total'+')" style="text-align: right; width: 110px" readonly value="'+ jumlah +'" ">');
			
			grandtotal();
						
			
												
		}
									
		return false;
	 }
	 	 
	
	function grandtotal(){ 
		
		var sub_total = '0';
		var round_amount = '0';
		var bank_charge = '0';
		var amount = '0';
		var deposit ='0';
		
		sub_total=(document.getElementById('sub_total').value).replace(/[^\d-.]/g,"");		
		if(sub_total == '') {
			sub_total = '0';
		}		
		
		round_amount=(document.getElementById('round_amount').value).replace(/[^\d-.]/g,"");
		if(round_amount == '') {
			round_amount = '0';
		}
		
		bank_charge=(document.getElementById('bank_charge').value).replace(/[^\d-.]/g,"");
		if(bank_charge == '') {
			bank_charge = '0';
		}
		
		sub_total = parseFloat(sub_total) - parseFloat(round_amount) - parseFloat(bank_charge);
		deposit = sub_total;
		sub_total = number_format(sub_total);
		
		$('#total2').html('<input type="text" id="total" name="total" class="form-control" onchange="number_format('+'total'+')" style="text-align: right; width: 110px" readonly value="'+ sub_total +'" ">');
		
		amount=(document.getElementById('amount').value).replace(/[^\d-.]/g,"");
		if(amount == '') {
			amount = '0';
		}
		
		deposit = parseFloat(deposit) - parseFloat(amount);
		deposit = number_format(deposit);
		
		$('#deposit2').html('<input type="text" id="deposit" name="deposit" class="form-control" onchange="number_format('+'deposit'+')" style="text-align: right; width: 110px" readonly value="'+ deposit +'" ">');
		
		//$('#amount2').html('<input type="text" id="amount" name="amount" class="form-control" onkeyup="number_format('+'amount'+'), jajal(aa)" style="text-align: right; width: 110px" value="" ">');
		
		return false;
	}
	
	
	function balance(){ 
		
		var total = '0';
		var deposit = '0';
		var amount = '0';
		
		total=(document.getElementById('total').value).replace(/[^\d-.]/g,"");		
		if(total == '') {
			total = '0';
		}		
		
		/*deposit=(document.getElementById('deposit').value).replace(/[^\d-.]/g,"");
		if(deposit == '') {
			deposit = '0';
		}*/
		
		amount=(document.getElementById('amount').value).replace(/[^\d-.]/g,"");
		if(amount == '') {
			amount = '0';
		}
		
		amount = parseFloat(total) - parseFloat(amount);
		amount = number_format(amount);
		
		$('#deposit2').html('<input type="text" id="deposit" name="deposit" class="form-control" onchange="number_format('+'deposit'+')" style="text-align: right; width: 110px" readonly value="'+ amount +'" ">');
		
		return false;
	}
	
	 
</script>
            
                        
<div class="page-content">
      
	<div class="row">
		<div class="col-xs-12">
            
            <?php 
            	$vendor_code = $_REQUEST['vendor_code'];
            	            	
				$ref = $_GET['search'];
				
				//jika saat add data, maka data setelah save kosong
				if ($_POST['submit'] == 'Save') { $ref = ''; }
				//-----------------------------------------------/\
					
				$ref2 = notran(date('y-m-d'), 'frmpayment', '', '', ''); 
					
				include("app/exec/payment_insert.php"); 
				
				
				$date = date("d-m-Y");
				$credit_card_expired = date("d-m-Y");
				
				if ($ref != "") {
					$sql=$select->list_payment($ref);
					$row_payment=$sql->fetch(PDO::FETCH_OBJ);	
					
					$ref2 = $row_payment->ref;	
					$date = date("d-m-Y", strtotime($row_payment->date));
					$vendor_code = $row_payment->vendor_code;
					$payment_type = $row_payment->payment_type;
					
					$credit_card_expired = date("d-m-Y", strtotime($row_payment->credit_card_expired));
					if($credit_card_expired == "01-01-1970" ) {
						$credit_card_expired = "";
					}
					
					$cheque_date = date("d-m-Y", strtotime($row_payment->cheque_date));
					if($cheque_date == "01-01-1970" ) {
						$cheque_date = "";
					}
					
					$sub_total = number_format($row_payment->sub_total, 0, '.', ',');
					$rate = number_format($row_payment->rate, 0, '.', ',');
					$deposit = number_format($row_payment->deposit, 0, '.', ',');
					$round_amount = number_format($row_payment->round_amount, 0, '.', ',');
					$bank_charge = number_format($row_payment->bank_charge, 0, '.', ',');
					$amount = number_format($row_payment->amount, 0, '.', ',');
					$total = number_format($row_payment->total, 0, '.', ',');
					
					
				}	
				
					
			?>
            
			<!-- PAGE CONTENT BEGINS -->
			<form class="form-horizontal" action="" method="post" name="payment" id="payment" enctype="multipart/form-data" onSubmit="return cekinput('ref,date,payment_type');" >	
            	
            	<table border="0" width="100%" >
            		
            		<tr>
                    	<td width="55%">
                    		<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">Ref. No. *)</label>
								<div class="col-sm-3">
									<input type="text" id="ref" name="ref" readonly class="form-control" value="<?php echo $ref2 ?>">
								</div>
							</div>
	                    	
	                    	<div class="form-group">
								<label for="text2" class="col-sm-3 control-label no-padding-right">Date *)</label>
								<div class="col-sm-3">
									<input type="text" id="date" name="date" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $date ?>">								
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">Nota Manual</label>
								<div class="col-sm-5">
									<input type="text" id="no_ttfa" name="no_ttfa" class="form-control" value="<?php echo $row_payment->no_ttfa ?>">
								</div>
							</div>
							
							<div class="form-group">
		                        <label class="col-sm-3 control-label no-padding-right">Status *)</label>
		                        <div class="col-sm-3">
		                          <select id="status" name="status" data-placeholder="..." class="chosen-select form-control" style="width: auto">
		                            <?php 
		                            	select_status($row_payment->status) 
		                            ?>	                            
		                          </select>
								</div>
							</div>
							
							<div class="form-group">
		                        <label class="col-sm-3 control-label no-padding-right">Payment Type *)</label>
		                        <div class="col-sm-3">
		                        
			                        <?php if ($ref=='') { ?>
			                          <select id="payment_type" name="payment_type" data-placeholder="..." class="chosen-select form-control" style="width: auto" onChange="loadHTMLPost2('app/payment_type_ajax.php','paymenttype','getdata','payment_type')">
			                            <!--<option value=""></option>-->
			                            <?php 
			                            	select_payment_type($row_payment->payment_type)
			                            ?>	                            
			                          </select>
			                        <?php } else { ?>
			                        	<input type="hidden" id="payment_type" name="payment_type" class="form-control" readonly value="<?php echo $row_payment->payment_type ?>">
			                        	
										<select id="payment_type2" name="payment_type2" data-placeholder="..." class="chosen-select form-control" style="width: auto" disabled >
											<option value=""></option>
												<?php 
													select_payment_type($row_payment->payment_type)
												?>	                            
										</select>
			                        <?php } ?>
								</div>
							</div>
							
							<?php if ($ref=='') { ?>
								<div class="form-group" id="paymenttype">
									<label for="text2" class="col-sm-3 control-label no-padding-right">Cash & Bank Account</label>
									<div class="col-sm-5">
										<select id="account_code" name="account_code" data-placeholder="..." class="chosen-select form-control" style="width: auto">
											<option value=""></option>
											<?php 
												select_coa($row_payment->account_code) 
											?>	                            
										</select>
									</div>
								</div>
							<?php } else { 
							
								include("payment_type.php");
							} ?>
							
							
							<div class="form-group">
		                        <label class="col-sm-3 control-label no-padding-right">Supplier *)</label>
		                        <div class="col-sm-5">
		                        
		                        <?php if ($ref=='') { ?>
		                          <select id="vendor_code" name="vendor_code" data-placeholder="..." class="chosen-select form-control" style="width: auto" onChange="loadHTMLPost2('app/payment_ajax.php','invoicedetail','getinvoice','vendor_code')">
		                          	<option value=""></option>
		                            <?php 
		                            	//combo_select_active("vendor","syscode","name","active","1",$row_payment->vendor_code) 
		                            	select_contact2($vendor_code);
		                            ?>                   
		                          </select>
		                        <?php } else { ?>
		                        	<input type="hidden" id="vendor_code" name="vendor_code" class="form-control" readonly value="<?php echo $row_payment->vendor_code ?>">
		                        	
		                        	<select id="vendor_code2" name="vendor_code2" data-placeholder="..." class="chosen-select form-control" style="width: auto" disabled >
		                          	<option value=""></option>
		                            <?php 
		                            	//combo_select_active("vendor","syscode","name","active","1",$row_payment->vendor_code) 	
		                            	select_contact2($row_payment->vendor_code);
		                            ?>                   
		                          </select>
		                          
		                        <?php } ?>
								</div>
							</div>
								
            			</td>
            			
            			
            			<td>&nbsp;</td>
				             
			             <td>
			             	
			             	<div class="form-group">
		                        <label class="col-sm-3 control-label no-padding-right">Currency</label>
		                        <div class="col-sm-3">
		                          <select id="currency_code" name="currency_code" data-placeholder="..." class="chosen-select form-control" style="width: auto">
		                            <option value=""></option>
		                            <?php 
		                            	combo_select_active("currency","syscode","name","active","1",$row_payment->currency_code)
		                            ?>	                            
		                          </select>
								</div>
							</div>
							
			             	<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">Currency Rate</label>
								<div class="col-sm-3">
									<input type="text" id="rate" name="rate" class="form-control" onkeyup="formatangka('rate')" style="text-align: right" value="<?php echo $rate ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label for="text2" class="col-sm-3 control-label no-padding-right">Memo</label>
								<div class="col-sm-5">
									<textarea id="memo" name="memo" class="form-control"><?php echo $row_payment->memo ?></textarea>
								</div>
							</div>
							
			             	<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">Updated by</label>
								<div class="col-sm-5">
									<input type="text" id="uid" name="uid" readonly class="form-control" value="<?php echo $row_payment->uid ?>">
								</div>
							</div><!-- /.form-group -->
				              
				            
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">Date Last Update</label>
								<div class="col-sm-5">
									<input type="text" id="dlu" name="dlu" readonly class="form-control" value="<?php echo $row_payment->dlu ?>" >
								</div>
							</div><!-- /.form-group -->
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">&nbsp;</label>
								<div class="col-sm-5">&nbsp;</div>
							</div>
							
			             </td>
			             
            		</tr>
            		
            		
            		<?php 
            			include("payment_get_detail.php");
            		?>
            		
            	</table>
            	
            	
				<div class="space-4"></div>

				<div class="clearfix form-actions">
					<div class="col-md-offset-3 col-md-9">
                        
                        <?php if (allowadd('frmpayment')==1) { ?>
							<?php if($ref=='') { ?>
								<input type="submit" name="submit" class="btn btn-primary" value="Save">
							<?php } ?>
						<?php } ?>
						
						<?php if (allowupd('frmpayment')==1) { ?>
							<?php if($ref!='') { ?>													
								<input type="submit" name="submit" class="btn btn-primary" value="Update">
							<?php } ?>
						<?php } ?>
						
						<?php if (allowdel('frmpayment')==1) { ?>
							<input type="submit" name="submit" class="btn btn-danger" value="Delete" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
						<?php } ?>
						
						<input type="button" name="submit" class="btn btn-success" value="List" onClick="self.location='main.php?menu=app&act=<?php echo obraxabrix(payment_view) ?> '">
						
						<?php if($ref!='') { ?>													
							<input type="button" name="button" class="btn btn-success" value="Print" onclick="print()" >
						<?php } ?>
						         
					</div>
				</div>

			</form>
            
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->


<!--[if !IE]> -->
<script type="text/javascript">
	window.jQuery || document.write("<script src='assets/js/jquery.min.js'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
  <script src="assets/js/excanvas.min.js"></script>
<![endif]-->
<script src="assets/js/jquery-ui.custom.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="assets/js/chosen.jquery.min.js"></script>
<script src="assets/js/fuelux.spinner.min.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/bootstrap-timepicker.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/daterangepicker.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/js/jquery.knob.min.js"></script>
<script src="assets/js/jquery.autosize.min.js"></script>
<script src="assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="assets/js/jquery.maskedinput.min.js"></script>
<script src="assets/js/bootstrap-tag.min.js"></script>

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="assets/js/dataTables.tableTools.min.js"></script>
<script src="assets/js/dataTables.colVis.min.js"></script>

<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
	jQuery(function($) {
		$('#id-disable-check').on('click', function() {
			var inp = $('#form-input-readonly').get(0);
			if(inp.hasAttribute('disabled')) {
				inp.setAttribute('readonly' , 'true');
				inp.removeAttribute('disabled');
				inp.value="This text field is readonly!";
			}
			else {
				inp.setAttribute('disabled' , 'disabled');
				inp.removeAttribute('readonly');
				inp.value="This text field is disabled!";
			}
		});
	
	
		if(!ace.vars['touch']) {
			$('.chosen-select').chosen({allow_single_deselect:true}); 
			//resize the chosen on window resize
	
			$(window)
			.off('resize.chosen')
			.on('resize.chosen', function() {
				$('.chosen-select').each(function() {
					 var $this = $(this);
					 $this.next().css({'width': $this.parent().width()});
				})
			}).trigger('resize.chosen');
			//resize chosen on sidebar collapse/expand
			$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
				if(event_name != 'sidebar_collapsed') return;
				$('.chosen-select').each(function() {
					 var $this = $(this);
					 $this.next().css({'width': $this.parent().width()});
				})
			});
	
	
			$('#chosen-multiple-style .btn').on('click', function(e){
				var target = $(this).find('input[type=radio]');
				var which = parseInt(target.val());
				if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
				 else $('#form-field-select-4').removeClass('tag-input-style');
			});
		}
	
	
		$('[data-rel=tooltip]').tooltip({container:'body'});
		$('[data-rel=popover]').popover({container:'body'});
		
		$('textarea[class*=autosize]').autosize({append: "\n"});
		$('textarea.limited').inputlimiter({
			remText: '%n character%s remaining...',
			limitText: 'max allowed : %n.'
		});
	
		$.mask.definitions['~']='[+-]';
		$('.input-mask-date').mask('99/99/9999');
		$('.input-mask-phone').mask('(999) 999-9999');
		$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
		$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
	
	
	
		$( "#input-size-slider" ).css('width','200px').slider({
			value:1,
			range: "min",
			min: 1,
			max: 8,
			step: 1,
			slide: function( event, ui ) {
				var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
				var val = parseInt(ui.value);
				$('#form-field-4').attr('class', sizing[val]).val('.'+sizing[val]);
			}
		});
	
		$( "#input-span-slider" ).slider({
			value:1,
			range: "min",
			min: 1,
			max: 12,
			step: 1,
			slide: function( event, ui ) {
				var val = parseInt(ui.value);
				$('#form-field-5').attr('class', 'col-xs-'+val).val('.col-xs-'+val);
			}
		});
	
	
		
		//"jQuery UI Slider"
		//range slider tooltip example
		$( "#slider-range" ).css('height','200px').slider({
			orientation: "vertical",
			range: true,
			min: 0,
			max: 100,
			values: [ 17, 67 ],
			slide: function( event, ui ) {
				var val = ui.values[$(ui.handle).index()-1] + "";
	
				if( !ui.handle.firstChild ) {
					$("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
					.prependTo(ui.handle);
				}
				$(ui.handle.firstChild).show().children().eq(1).text(val);
			}
		}).find('span.ui-slider-handle').on('blur', function(){
			$(this.firstChild).hide();
		});
		
		
		$( "#slider-range-max" ).slider({
			range: "max",
			min: 1,
			max: 10,
			value: 2
		});
		
		$( "#slider-eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
			// read initial values from markup and remove that
			var value = parseInt( $( this ).text(), 10 );
			$( this ).empty().slider({
				value: value,
				range: "min",
				animate: true
				
			});
		});
		
		$("#slider-eq > span.ui-slider-purple").slider('disable');//disable third item
	
		
		$('#photo , #photo_1, #photo_2, #photo_3, #photo_4').ace_file_input({
			no_file:'No File ...',
			btn_choose:'Choose',
			btn_change:'Change',
			droppable:false,
			onchange:null,
			thumbnail:false //| true | large
			//whitelist:'gif|png|jpg|jpeg'
			//blacklist:'exe|php'
			//onchange:''
			//
		});
		//pre-show a file name, for example a previously selected file
		//$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])
	
	
		$('#id-input-file-3').ace_file_input({
			style:'well',
			btn_choose:'Drop files here or click to choose',
			btn_change:null,
			no_icon:'ace-icon fa fa-cloud-upload',
			droppable:true,
			thumbnail:'small'//large | fit
			//,icon_remove:null//set null, to hide remove/reset button
			/**,before_change:function(files, dropped) {
				//Check an example below
				//or examples/file-upload.html
				return true;
			}*/
			/**,before_remove : function() {
				return true;
			}*/
			,
			preview_error : function(filename, error_code) {
				//name of the file that failed
				//error_code values
				//1 = 'FILE_LOAD_FAILED',
				//2 = 'IMAGE_LOAD_FAILED',
				//3 = 'THUMBNAIL_FAILED'
				//alert(error_code);
			}
	
		}).on('change', function(){
			//console.log($(this).data('ace_input_files'));
			//console.log($(this).data('ace_input_method'));
		});
		
		
		//$('#id-input-file-3')
		//.ace_file_input('show_file_list', [
			//{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
			//{type: 'file', name: 'hello.txt'}
		//]);
	
		
		
	
		//dynamically change allowed formats by changing allowExt && allowMime function
		$('#id-file-format').removeAttr('checked').on('change', function() {
			var whitelist_ext, whitelist_mime;
			var btn_choose
			var no_icon
			if(this.checked) {
				btn_choose = "Drop images here or click to choose";
				no_icon = "ace-icon fa fa-picture-o";
	
				whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
				whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
			}
			else {
				btn_choose = "Drop files here or click to choose";
				no_icon = "ace-icon fa fa-cloud-upload";
				
				whitelist_ext = null;//all extensions are acceptable
				whitelist_mime = null;//all mimes are acceptable
			}
			var file_input = $('#id-input-file-3');
			file_input
			.ace_file_input('update_settings',
			{
				'btn_choose': btn_choose,
				'no_icon': no_icon,
				'allowExt': whitelist_ext,
				'allowMime': whitelist_mime
			})
			file_input.ace_file_input('reset_input');
			
			file_input
			.off('file.error.ace')
			.on('file.error.ace', function(e, info) {
				//console.log(info.file_count);//number of selected files
				//console.log(info.invalid_count);//number of invalid files
				//console.log(info.error_list);//a list of errors in the following format
				
				//info.error_count['ext']
				//info.error_count['mime']
				//info.error_count['size']
				
				//info.error_list['ext']  = [list of file names with invalid extension]
				//info.error_list['mime'] = [list of file names with invalid mimetype]
				//info.error_list['size'] = [list of file names with invalid size]
				
				
				/**
				if( !info.dropped ) {
					//perhapse reset file field if files have been selected, and there are invalid files among them
					//when files are dropped, only valid files will be added to our file array
					e.preventDefault();//it will rest input
				}
				*/
				
				
				//if files have been selected (not dropped), you can choose to reset input
				//because browser keeps all selected files anyway and this cannot be changed
				//we can only reset file field to become empty again
				//on any case you still should check files with your server side script
				//because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
			});
		
		});
	
		$('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
		.closest('.ace-spinner')
		.on('changed.fu.spinbox', function(){
			//alert($('#spinner1').val())
		}); 
		$('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
		$('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
		$('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});
	
		//$('#spinner1').ace_spinner('disable').ace_spinner('value', 11);
		//or
		//$('#spinner1').closest('.ace-spinner').spinner('disable').spinner('enable').spinner('value', 11);//disable, enable or change value
		//$('#spinner1').closest('.ace-spinner').spinner('value', 0);//reset to 0
	
	
		//datepicker plugin
		//link
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		})
		//show datepicker when clicking on the icon
		.next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
	
		//or change it into a date range picker
		$('.input-daterange').datepicker({autoclose:true});
	
	
		//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
		$('input[name=date-range-picker]').daterangepicker({
			'applyClass' : 'btn-sm btn-success',
			'cancelClass' : 'btn-sm btn-default',
			locale: {
				applyLabel: 'Apply',
				cancelLabel: 'Cancel',
			}
		})
		.prev().on(ace.click_event, function(){
			$(this).next().focus();
		});
	
	
		$('#timepicker1').timepicker({
			minuteStep: 1,
			showSeconds: true,
			showMeridian: false
		}).next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
		
		$('#date-timepicker1').datetimepicker().next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
		
	
		$('#colorpicker1').colorpicker();
	
		$('#simple-colorpicker-1').ace_colorpicker();
		//$('#simple-colorpicker-1').ace_colorpicker('pick', 2);//select 2nd color
		//$('#simple-colorpicker-1').ace_colorpicker('pick', '#fbe983');//select #fbe983 color
		//var picker = $('#simple-colorpicker-1').data('ace_colorpicker')
		//picker.pick('red', true);//insert the color if it doesn't exist
	
	
		$(".knob").knob();
		
		
		var tag_input = $('#form-field-tags');
		try{
			tag_input.tag(
			  {
				placeholder:tag_input.attr('placeholder'),
				//enable typeahead by specifying the source array
				source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
				/**
				//or fetch data from database, fetch those that match "query"
				source: function(query, process) {
				  $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
				  .done(function(result_items){
					process(result_items);
				  });
				}
				*/
			  }
			)
	
			//programmatically add a new
			var $tag_obj = $('#form-field-tags').data('tag');
			$tag_obj.add('Programmatically Added');
		}
		catch(e) {
			//display a textarea for old IE, because it doesn't support this plugin or another one I tried!
			tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
			//$('#form-field-tags').autosize({append: "\n"});
		}
		
		
		/////////
		$('#modal-form input[type=file]').ace_file_input({
			style:'well',
			btn_choose:'Drop files here or click to choose',
			btn_change:null,
			no_icon:'ace-icon fa fa-cloud-upload',
			droppable:true,
			thumbnail:'large'
		})
		
		//chosen plugin inside a modal will have a zero width because the select element is originally hidden
		//and its width cannot be determined.
		//so we set the width after modal is show
		$('#modal-form').on('shown.bs.modal', function () {
			if(!ace.vars['touch']) {
				$(this).find('.chosen-container').each(function(){
					$(this).find('a:first-child').css('width' , '210px');
					$(this).find('.chosen-drop').css('width' , '210px');
					$(this).find('.chosen-search input').css('width' , '200px');
				});
			}
		})
		/**
		//or you can activate the chosen plugin after modal is shown
		//this way select element becomes visible with dimensions and chosen works as expected
		$('#modal-form').on('shown', function () {
			$(this).find('.modal-chosen').chosen();
		})
		*/
	
		
		
		$(document).one('ajaxloadstart.page', function(e) {
			$('textarea[class*=autosize]').trigger('autosize.destroy');
			$('.limiterBox,.autosizejs').remove();
			$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
		});
	
	});
</script>


				