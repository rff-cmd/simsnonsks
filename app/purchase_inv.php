<script src="<?php echo $__folder ?>assets/js/appcustom.js"></script>
<script type="text/javascript" src="<?php echo $__folder ?>js/buttonajax.js"></script>


<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
	  	
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='ref') {
			alert('Ref. cannot empty!');
		  }
		  
		  if (document.getElementById(arrf[i]).name=='date') {
			alert('Date cannot empty!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='location_id') {
			alert('Gudang cannot empty!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='vendor_code') {
			alert('Supplier cannot empty!');				
		  }
		  		  
		  return false
		} 
										
	  }		
	  
	  var item_code = document.getElementById('item_code2').value;
	  
	//   if(item_code == "") {
	// 	  var change_amount = document.getElementById('change_amount').value;
	// 	  change_amount = change_amount.replace(/[^\d-.]/g,"");
	// 	  change_amount = change_amount.replace(",","");
		  
	// 	  if(change_amount < 0) {
	// 	  	alert('Kembalian harus lebih besar sama dengan nol !!!');
	// 	  	return false
	// 	  }
	//   } 
	   
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

<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost3(URL, destination, button, getId, getId2){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;	
			
		str2 = getId2 + '=' + document.getElementById(getId2).value;
		
		var str = str + '&button=' + button; // + button + '|' + getId2;
		str = str + '&' + str2;
		
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


<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost4(URL, destination, button, getId, getId2, getId3){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;		
		str2 = getId2 + '=' + document.getElementById(getId2).value;
		str3 = getId3 + '=' + document.getElementById(getId3).value;
		
		var str = str + '&button=' + button; // + button + '|' + getId2;
		str = str + '&' + str2;
		str = str + '&' + str3;
		
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
	function detailvalue(id, jmldata, ketik){
        ;
        var qty = 0;	
		qty=document.getElementById('qty_'+id).value; 
		//qty = number_format(qty,0,".",",");
		qty = qty.replace(/[^\d-.]/g,"");
		if(qty == "") {qty = 0};
				
		var unit_cost = 0;
		unit_cost=document.getElementById('unit_cost_'+id).value; 
		//unit_cost = number_format(unit_cost,0,".",",");
		unit_cost = unit_cost.replace(/[^\d-.]/g,"");
		if(unit_cost == "") {unit_cost = 0};
		
		var discount = 0;
		discount=document.getElementById('discount_'+id).value; 
		discount = discount.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
		if(discount == "") {discount = 0};
		
        //discoutn persen-1
        var discount3_1 = 0;
		discount3_1=document.getElementById('discount3_1_'+id).value; 
		discount3_1 = discount3_1.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
		if(discount3_1 == "") {discount3_1 = 0};
        
        if( ketik == 'persen' ) {
            discount3_1 = (unit_cost * discount3_1) / 100;
            if(discount3_1 == "") {discount3_1 = 0};
            
            discount = discount3_1;   
        } 
		
		
		//discoutn persen-2
        var discount3_2 = 0;
		discount3_2=document.getElementById('discount3_2_'+id).value; 
		discount3_2 = discount3_2.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
		if(discount3_2 == "") {discount3_2 = 0};
        
        if( ketik == 'persen' ) {
        	unit_cost2 = parseFloat(unit_cost) - parseFloat(discount);
        	discount3_2 = (unit_cost2 * discount3_2) / 100;
        	if(discount3_2 == "") {discount3_2 = 0};
            
            discount = parseFloat(discount) + parseFloat(discount3_2); 
        } 
        
        //discoutn persen-3
        var discount3_3 = 0;
		discount3_3=document.getElementById('discount3_3_'+id).value; 
		discount3_3 = discount3_3.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
		if(discount3_3 == "") {discount3_3 = 0};
               
        if( ketik == 'persen' ) {
        	unit_cost3 = parseFloat(unit_cost) - parseFloat(discount);
        	discount3_3 = (unit_cost3 * discount3_3) / 100;
            if(discount3_3 == "") {discount3_3 = 0};
             
            discount = parseFloat(discount) + parseFloat(discount3_3);   
        } 
        
		unit_cost = parseFloat(unit_cost) - parseFloat(discount);
		
		
        discount_value     = number_format(discount,2,".",",");
        
        if( ketik == 'persen' ) {
            $('#discount_det_id'+id).html('<input type="text" id="discount_'+id+'" name="discount_'+id+'" style="text-align: right; width: 100px" class="form-control" onkeyup="formatangka(\'discount_'+id+'\'), detailvalue(\''+id+'\', '+jmldata+', \'nominal\')" onKeyPress="return focusNext(\'submit_det\',event)" value="'+discount_value+'" >');
        } 
        
        
        //-------disc nominal
        var discount3 = 0;
        if( ketik == 'nominal' ) {
            
            var unit_cost_tmp = 0;
    		unit_cost_tmp=document.getElementById('unit_cost_'+id).value; 
    		unit_cost_tmp = unit_cost_tmp.replace(/[^\d-.]/g,"");
    		if(unit_cost_tmp == "") {unit_cost_tmp = 0};
            
            discount3 = ( discount / unit_cost_tmp) * 100; 
            
        }   
        
        discount3_value    = number_format(discount3,2,".",",");
        if( ketik == 'nominal' ) {
        	
           $('#discount3_det_id'+id).html('<input type="text" id="discount3_1_'+id+'" name="discount3_1_'+id+'" style="text-align: right; width: 60px" class="form-control" onkeyup="formatangka(\'discount3_1_'+id+'\'), detailvalue(\''+id+'\', '+jmldata+', \'persen\')" value="'+discount3_value+'" >');
           
        }
        //-------------------------
        
        
		var amount = 0;
		amount = parseFloat(qty) * parseFloat(unit_cost); // - parseFloat(discount); //document.getElementById('amount_'+id).value; 
		amount = number_format(amount,2,".",",");	
		
		
		$('#amount'+id).html('<input type="text" onkeyup="formatangka(\'amount_'+id+'\')" id="amount_'+id+'" name="amount_'+id+'" value="'+amount+'" readonly style="text-align:right; width: 150px" class="form-control" >');
		
		sub_total(jmldata);
		
		return false	
		
	 }	 
	 
	 function sub_total(jmldata){ 
	 	
		var i=0;
		var jumlah='0';
		var change_amount='0';
		var amount='0';
		
		for(i=0; i<=jmldata; i++){
			
			amount = document.getElementById('amount_'+i).value.replace(/[^\d.]/g,"");
			
			if(amount=='') { amount=0 }
			jumlah 	=  parseFloat(jumlah) + parseFloat(amount);
			
			subtotal2(jumlah);
		}
		
		return false;
	}
	
	function subtotal2(jumlah) {
		
		var discount = 0;
		discount=document.getElementById('discount').value; 
		discount = discount.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
		if(discount == "") {discount = 0};
		
		jumlah = parseFloat(jumlah) - parseFloat(discount);
		
		var pos_amount = 0;
		pos_amount=document.getElementById('cash_amount').value; 
		pos_amount = pos_amount.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
		if(pos_amount == "") {pos_amount = 0};
		
		var bank_amount = 0;
		bank_amount=document.getElementById('bank_amount').value; 
		bank_amount = bank_amount.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
		if(bank_amount == "") {bank_amount = 0};
		
		var card_amount = 0;
		card_amount=document.getElementById('card_amount').value; 
		card_amount = card_amount.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
		if(card_amount == "") {card_amount = 0};
		
		
		
		//tax
		var jumlah2 = 0;
		var grand_total = 0;
		jumlah2 = jumlah;
		
		var tax_rate = 0;
		tax_rate=document.getElementById('tax_rate').value; 
		tax_rate = tax_rate.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
		if(tax_rate == "") {tax_rate = 0};
		
		total_tax = (tax_rate * jumlah2)/100;
		jumlah2 = parseFloat(jumlah2) + parseFloat(total_tax);
		grand_total = jumlah2;
		
		total_tax = number_format(total_tax,2,".",",");
		jumlah2 = number_format(jumlah2,2,".",",");
		//-----------------/\--------
		
		jumlah = number_format(jumlah,2,".",",");	
		$('#sub_total_id').html('<input type="text" id="sub_totalx" name="sub_totalx" readonly style="text-align: right; font-size: 14px; font-weight: bold; width: 150px" class="form-control" onkeyup="formatangka('+sub_totalx+')" value="'+ jumlah +'"" >');
		
		$('#total_id').html('<input type="text" id="total" name="total" readonly style="text-align: right; font-size: 14px; font-weight: bold; width: 150px" class="form-control" onkeyup="formatangka('+total+')" value="'+ jumlah2 +'"" >');
		
		
		$('#total_id_top').html('TOTAL : '+ jumlah2 +'');
										
		//$('#total_id').html('<input type="text" id="total" name="total" readonly style="text-align: right; font-size: 14px; font-weight: bold; width: 150px" class="form-control" onkeyup="formatangka('+total+')" value="'+ jumlah2 +'"" >');
		
		//change
		change_amount = parseFloat(grand_total) - parseFloat(pos_amount) - parseFloat(bank_amount) - parseFloat(card_amount) ;
		change_amount = change_amount * -1;
		
		change_amount = number_format(change_amount,2,".",",");	
		$('#change_amount_id').html('<input type="text" id="change_amount" name="change_amount" readonly="" style="text-align: right; font-size: 14px; font-weight: bold; width: 150px" class="form-control" value="'+ change_amount +'"" >');
				
		
		$('#total_tax_id').html('<input type="text" id="total_atx" name="total_tax" readonly style="text-align: right; font-size: 14px; font-weight: bold; width: 150px" class="form-control" onkeyup="formatangka('+total_tax+')" value="'+ total_tax +'" >');
        //-----------------/\
        
        		
		return false;
	}
	
	
	function sub_total_member(total, jmldata){ 
		var i=0;
		var discmember='0';
		var discmember2='0';
		var memberlimit='0';
		var memberlimit2='0';
		var amount_member='0';
		var totalcek='0';
		var non_discount='0';
		
		amount_member = document.getElementById('amount_member').value;
		totalcek = parseFloat(total) + parseFloat(amount_member);
		
		for(i=0; i<=jmldata; i++){
			
			memberlimit = document.getElementById('memberlimit'+i).value.replace(/[^\d.]/g,"");
			if(memberlimit=='') { memberlimit=0 }
			memberlimit 	=  parseFloat(memberlimit);
			
			discmember = document.getElementById('discmember'+i).value.replace(/[^\d.]/g,"");
			if(discmember=='') { discmember=0 }
			discmember 	=  parseFloat(discmember);
			
			if(	memberlimit <= totalcek ) {
				discmember2 = discmember;
			}
			
			//alert(memberlimit);
			
		}
		
		
		
		memberlimit = (total * discmember2)/100;
		memberlimit2 = number_format(memberlimit,2,".",",");
		
		$('#total_discount_id').html('<input type="text" id="discount" name="discount" style="text-align: right; font-size: 16px" class="form-control" value="'+ memberlimit2 +'"" >');
		
	}
	
</script>

<script>
	
	function detailvalue2(ketik){		
		var qty = 0;	
		qty=document.getElementById('qty').value; 
		//qty = number_format(qty,2,".",",");
		qty = qty.replace(/[^\d-.]/g,"");
		if(qty == "") {qty = 0};
			
		var unit_cost = 0;
		unit_cost=document.getElementById('unit_cost').value; 
		//unit_cost = number_format(unit_cost,0,".",",");
		unit_cost = unit_cost.replace(/[^\d-.]/g,"");
		if(unit_cost == "") {unit_cost = 0};
		
		var discount = 0;
		discount=document.getElementById('discount_det').value; 
		discount = discount.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
		if(discount == "") {discount = 0};
        
        //discoutn persen-1
        var discount3_1 = 0;
		discount3_1=document.getElementById('discount3_1_det').value; 
		discount3_1 = discount3_1.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
		if(discount3_1 == "") {discount3_1 = 0};
        	
        if( ketik == 'persen' ) {
            discount3_1 = (unit_cost * discount3_1) / 100;
            if(discount3_1 == "") {discount3_1 = 0};
            
            discount = discount3_1;   
        } 
        
        
        //discoutn persen-2
        var discount3_2 = 0;
		discount3_2=document.getElementById('discount3_2_det').value; 
		discount3_2 = discount3_2.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
		if(discount3_2 == "") {discount3_2 = 0};
        
        
        if( ketik == 'persen' ) {
        	unit_cost2 = parseFloat(unit_cost) - parseFloat(discount);
        	discount3_2 = (unit_cost2 * discount3_2) / 100;
            if(discount3_2 == "") {discount3_2 = 0};
            
            discount = parseFloat(discount) + parseFloat(discount3_2);   
        } 
        
        //discoutn persen-3
        var discount3_3 = 0;
		discount3_3=document.getElementById('discount3_3_det').value; 
		discount3_3 = discount3_3.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
		if(discount3_3 == "") {discount3_3 = 0};
        
        
        if( ketik == 'persen' ) {
        	unit_cost3 = parseFloat(unit_cost) - parseFloat(discount);
        	discount3_3 = (unit_cost3 * discount3_3) / 100;
            if(discount3_3 == "") {discount3_3 = 0};
            
            discount = parseFloat(discount) + parseFloat(discount3_3);   
        } 
             
        //---------------/\
		unit_cost = parseFloat(unit_cost) - parseFloat(discount);
		
		var amount = 0;
		amount = parseFloat(qty) * parseFloat(unit_cost); // - parseFloat(discount); //document.getElementById('amount_'+id).value; 
		amount = number_format(amount,2,".",",");	
		
        discount_value     = number_format(discount,2,".",",");
        
        if( ketik == 'persen' ) {
        	$('#discount_det_id').html('<input type="text" onkeyup="formatangka(\'discount_det\'), detailvalue2(\'nominal\')" id="discount_det" name="discount_det" onKeyPress="return focusNext(\'submit_det\',event)" value="'+discount_value+'" style="text-align:right; width: 90px" >');
        }
        
        //-------disc nominal
        var discount3 = 0;
        if( ketik == 'nominal' ) {
            var unit_cost_tmp = 0;
    		unit_cost_tmp=document.getElementById('unit_cost').value; 
    		unit_cost_tmp = unit_cost_tmp.replace(/[^\d-.]/g,"");
    		if(unit_cost_tmp == "") {unit_cost_tmp = 0};
            
            discount3 = ( discount / unit_cost_tmp) * 100; 
        }   
        
        discount3_1_value    = number_format(discount3,2,".",",");
        if( ketik == 'nominal' ) {
            $('#discount3_1_det_id').html('<input type="text" onkeyup="formatangka(\'discount3_1_det\'), detailvalue2(\'persen\')" id="discount3_1_det" name="discount3_1_det" value="'+discount3_1_value+'" style="text-align:right; width: 90px" >');
        }
        //-------------------------
		
		$('#amount_det').html('<input type="text" onkeyup="formatangka(\'amount\')" id="amount" name="amount" value="'+amount+'" readonly style="text-align:right; width: 100px" >');
		
		
		return false	
		
	 }	 
</script>

<script language="javascript">

	function hapus(id,line) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('purchase_inv') ?>&mxKz=xm8r389xemx23xb2378e23&xndf="+id+"&line="+line+" ";
		}
	}
	
	function update(id, no) {	
	
		var line 		= document.getElementById('old_line_'+no).value;
		var qty 		= document.getElementById('qty_'+no).value;
		var unit_cost 	= document.getElementById('unit_cost_'+no).value;
		var discount3_1	= document.getElementById('discount3_1_'+no).value;
		var discount 	= document.getElementById('discount_'+no).value;
		var amount 		= document.getElementById('amount_'+no).value;
		
		document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('purchase_inv') ?>&mxKz=upd&xndf="+id+"&line="+line+"&qty="+qty+"&unit_cost="+unit_cost+"&discount_p="+discount3_1+"&discount="+discount+"&amount="+amount+" ";
		
	}
	
	function print() {
		var ref = document.getElementById('ref').value;
		
		window.open('<?php echo $__folder ?>app/purchase_inv_print.php?ref='+ref, 'Invoice Print','825','450','resizable=1,scrollbars=1,status=0,toolbar=0')
	}

	function submitForm(tipe)
    {
    	
    	if(tipe == 'print') {
			//document.getElementById("delord_view").action = "app/delord_print.php";
			$("#purchase_inv").attr('action', 'app/purchase_inv_print.php')
			   .attr('target', '_BLANK');
			$("#purchase_inv").submit();
			
		}
		
		return false;
  			 
    }		
    
    
    function focusNext(elemName, evt) 
	{
	    evt = (evt) ? evt : event;
	    var charCode = (evt.charCode) ? evt.charCode :
	        ((evt.which) ? evt.which : evt.keyCode);
	    if (charCode == 13) 
		 {
			document.getElementById(elemName).focus();
	      return false;
	    }
	    return true;
	}
    
    
    function testprint() {
		var ref = document.getElementById('ref').value;
		
		window.open('app/test_print4.php', 'Invoice Print','825','450','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
    
    function itemhistory() {
		var vendor_code = document.getElementById('vendor_code').value;
		
		window.open('app/purchase_inv_item_history.php?vendor_code='+vendor_code, 'Item History','825','950','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
	
	function chequehistory() {
		var vendor_code = document.getElementById('vendor_code').value;
		
		window.open('app/purchase_inv_cheque_history.php?vendor_code='+vendor_code, 'Cheque History','825','2000','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
</script>

<!--//shortcut-->
<script>
    document.onkeydown = function (e) {
    	switch (e.keyCode) {
            //F3 (Bayar)
            case 114:
                document.getElementById('cash_amount').focus();
                e.preventDefault();
                break;
            
            //F2 (Kolom Kode Barang)
            case 113:
                document.getElementById('item_code2').focus();
                e.preventDefault();
                break;
		}
		         
            //F4 (Ke Kolom Member)
            /*case 115:
                document.getElementById('client_member_code2').focus();
                e.preventDefault();
                break;
                
            //F1 (Form Baru)
            case 112:
                window.location = 'main.php?menu=app&act=<?php echo obraxabrix(pos) ?>';
                e.preventDefault();
                break;*/
            
        
    };
</script>
            
                        
<div class="page-content">
      
	<div class="row">
		<div class="col-xs-12">
            
            <?php 
          		$ref = $segmen3; //$_GET['search'];
          		$xndf = $segmen3; //$_GET['xndf'];
				
				if(!preg_match('/POV/i', $ref)) {
          			$ref = "";
				}
				
				//jika saat add data, maka data setelah save kosong
				if ($_POST['submit'] == 'Save') { $ref = ''; }
				//-----------------------------------------------/\
					
				$ref2 = notran(date('y-m-d'), 'frmpurchase_inv', '', '', ''); 
					
				include("app/exec/purchase_inv_insert.php"); 
				
				
				$date = date("d-m-Y");
				$date_need = date("d-m-Y");
				$due_date = date("d-m-Y");
				
				$location_id = $_SESSION['location_id2'];
				$location_id2 = $_SESSION['location_id2'];
                
                $stock_in = "";
                
                $admin = $_SESSION["adm"];
                $payment_type1 = "";
				$payment_type2 = "checked";
				$payment_type3 = "";
				                        
				if($xndf != "") {
					$delete = $_REQUEST['mxKz'];
					if ($delete == "xm8r389xemx23xb2378e23" && $post != "Save Detail") {
						//include 'class/class.delete.php';
						$delete2=new delete;
						$delete2->delete_purchase_inv_detail($_REQUEST['xndf'], $_REQUEST['line']);
					}
					if ($delete == "upd" && $post != "Save Detail") {
						$update2=new update;
						$update2->update_purchase_inv_detail($_REQUEST['xndf'], $_REQUEST['line'], $_REQUEST['qty'], $_REQUEST['unit_cost'], $_REQUEST['discount_p'], $_REQUEST['discount'], $_REQUEST['amount']);
					}
					
					$sql=$select->list_purchase_inv_get_detail($xndf);
					$row_purchase_inv=$sql->fetch(PDO::FETCH_OBJ);
					
					$vendor_code	=	$row_purchase_inv->vendor_code;
					$location_id 	= 	$row_purchase_inv->location_id;
                    
                    $stock_in = "";
                    if($row_purchase_inv->stock_in == 1) {
						$stock_in = " checked ";
					}
                    
                    if($row_purchase_inv->payment_type == "cash") { $payment_type1 = "checked"; }
					if($row_purchase_inv->payment_type == "credit") { $payment_type2 = "checked"; }
					if($row_purchase_inv->payment_type == "consign") { $payment_type3 = "checked"; }
					
					$deposit 		= 	number_format($row_purchase_inv->deposit, 2, '.', ',');
					$discount2 		= 	number_format($row_purchase_inv->discount,2,".",",");
					$total 			= 	number_format($row_purchase_inv->total, 2, '.', ',');
				}
				
										
				if ($ref != "") {
					$sql=$select->list_purchase_inv($ref);
					$row_purchase_inv=$sql->fetch(PDO::FETCH_OBJ);	
					
					$ref2 = $row_purchase_inv->ref;	
					$ref22 = $row_purchase_inv->ref2;
					$date = date("d-m-Y", strtotime($row_purchase_inv->date));
					$tax_rate = number_format($row_purchase_inv->tax_rate, 2, '.', ',');
					$freight_cost = number_format($row_purchase_inv->freight_cost, 2, '.', ',');
					
					$vendor_code  = $row_purchase_inv->vendor_code;	
					$client_name  = $row_purchase_inv->client_name;	
					$total = number_format($row_purchase_inv->total, 2, '.', ',');
					$cash_amount = number_format($row_purchase_inv->cash_amount,2,".",",");
					$bank_amount = number_format($row_purchase_inv->bank_amount,2,".",",");
					$card_amount = number_format($row_purchase_inv->card_amount,2,".",",");
					$discount2 = number_format($row_purchase_inv->discount,2,".",",");
					$grand_total = number_format($row_purchase_inv->total, 2, '.', ',');
					
					$due_date = date("d-m-Y", strtotime($row_purchase_inv->due_date));
					if($row_purchase_inv->pos == 1) {
						$pos = " checked ";
						$pos2 = "1";
					} else {
						$pos = "";
					}
					
					$deposit = number_format($row_purchase_inv->deposit, 2, '.', ',');
					
					$disabled = "disabled";
                    if($admin == 1) {
                        $disabled = "";
                    }
					
					if($row_purchase_inv->taxable == 1) {
						$taxable = "checked";
					}
					
					$location_id = $row_purchase_inv->location_id;
                    
                    $stock_in = "";
                    if($row_purchase_inv->stock_in == 1) {
						$stock_in = " checked ";
					}
					
					if($row_purchase_inv->payment_type == "cash") { $payment_type1 = "checked"; }
					if($row_purchase_inv->payment_type == "credit") { $payment_type2 = "checked"; }
					if($row_purchase_inv->payment_type == "consign") { $payment_type3 = "checked"; }
					
				}	
				
					
			?>
            
			<!-- PAGE CONTENT BEGINS -->
			<form class="form-horizontal" role="form" action="" method="post" name="purchase_inv" id="purchase_inv" enctype="multipart/form-data" onSubmit="return cekinput('ref,date,location_id,vendor_code');" >
            	
            	<input type="hidden" id="old_location_id" name="old_location_id" value="<?php echo $row_purchase_inv->location_id ; ?>" >
            	<input type="hidden" id="old_ref" name="old_ref" value="<?php echo $row_purchase_inv->ref ; ?>" >
				
				<input type="hidden" id="xndf" name="xndf" value="<?php echo $xndf ; ?>" >
				
				<div class="row">
					<div class="col-sm-6">
						<div class="row">
			            	<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Ref. No.'; } else { echo 'No. Nota'; } ?> *)</label>
								<div class="col-sm-4">
									<input type="text" id="ref" name="ref" readonly="" style="font-size: 12px" class="form-control" value="<?php echo $ref2 ?>"> 
									<!--&nbsp; <input type="text" id="ref2" name="ref2" style="font-size: 12px" class="form-control" value="<?php echo $ref22 ?>">-->
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Bill Number'; } else { echo 'No. Nota'; } ?></label>
								<div class="col-sm-4">
									<input type="text" id="bill_number" name="bill_number" class="form-control" value="<?php echo $row_purchase_inv->bill_number ?>">
								</div>
							</div>
			            	
			            	<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Date'; } else { echo 'Tanggal'; } ?> *)</label>
								<div class="col-sm-4">
									<input type="text" id="date" name="date" style="font-size: 12px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $date ?>">								
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Due Date'; } else { echo 'Tgl Jatuh Tempo'; } ?> *)</label>
								<div class="col-sm-4">
									<input type="text" id="due_date" name="due_date" style="font-size: 12px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $due_date ?>">								
								</div>
							</div>
							
							<div class="form-group">
		                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Supplier *)</label>
		                        <div class="col-sm-5">
		                          <select id="vendor_code" name="vendor_code" class="chosen-select form-control" style="width: auto" <?php echo $disabled ?> >
		                          	<option value=""></option>
		                            <?php 
		                            	combo_select_active("vendor","syscode","name","active","1",$row_purchase_inv->vendor_code) 
		                            ?>	
		                                                      
		                          </select>
		                          
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jenis Pembayaran</label>
								<div class="col-sm-5">
									<div class="radio">
										<label>
											<input type="radio" id="payment_type1" name="payment_type" class="ace" <?php echo $payment_type1 ?> value="cash" />
											<span class="lbl"> Tunai</span>
										</label>
										<label>
											<input type="radio" id="payment_type2" name="payment_type" class="ace" <?php echo $payment_type2 ?> value="credit" />
											<span class="lbl"> Kredit</span>
										</label>
										<!--<label>
											<input type="radio" id="payment_type3" name="payment_type" class="ace" <?php echo $payment_type3 ?> value="consign" />
											<span class="lbl"> Konsinyasi</span>
										</label>-->
									</div>

								</div>
							</div>
							
						</div>
					</div>		
					
					
					<div class="col-sm-6">
						<div class="row">
							<div class="form-group">
			                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Location'; } else { echo 'Ke Gudang'; } ?> *)</label>
			                    <div class="col-sm-5">
			                      <select id="location_id" name="location_id" class="chosen-select form-control" style="max-width: 250px; font-size: 12px">
			                        <option value=""></option>
			                        <?php 
			                        	combo_select_active("warehouse","id","name","active","1",$location_id)
			                        ?>	                            
			                      </select>
								</div>
							</div>
				
							<div class="form-group">
		                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Tax'; } else { echo 'Pajak'; } ?></label>
		                        <div class="col-sm-5">
		                          <select id="tax_code" name="tax_code" class="chosen-select form-control" style="width: auto">
		                            <option value=""></option>
		                            <?php 
		                            	combo_select_active("tax","syscode","name","active","1",$row_purchase_inv->tax_code)
		                            ?>	                            
		                          </select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Tax Rate (%)'; } else { echo 'Rate Pajak (%)'; } ?></label>
								<div class="col-sm-3">
									<input type="text" id="tax_rate" name="tax_rate" class="form-control" onkeyup="formatangka('tax_rate'), sub_total('20')" onKeyPress="return focusNext('memo',event)" style="text-align: right" value="<?php echo $tax_rate ?>">
								</div>
							</div>
												
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Memo</label>
								<div class="col-sm-5">
									<textarea id="memo" name="memo" style="font-size: 12px; width: 300px" class="autosize-transition form-control"><?php echo $row_purchase_inv->memo ?></textarea>
								</div>
							</div>
							
							<?php if($protection->protection_purchase_invoice($ref) != 1) { ?>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Input Stock'; } else { echo 'Masuk Stok'; } ?></label>
									<div class="col-sm-4">
										<input class="ace" type="checkbox" name="stock_in" id="stock_in" value="1" <?php echo $stock_in ?> /><span class="lbl"></span>									
									</div>
								</div>
							<?php } else { ?>
								<input type="hidden" name="stock_in" id="stock_in" value="0" />
							<?php } ?>
							
							<?php if($ref != "") { ?>
			                
			                    <?php if($admin == 0) { ?>
								    <input type="hidden" id="vendor_code" name="vendor_code" class="form-control" value="<?php echo $row_cash_invoice->vendor_code ?>">
			                    <?php } ?>
							<?php } ?>
							
							
							<input type="hidden" id="dlu" name="dlu" readonly="" style="font-size: 12px" class="form-control" value="<?php echo $row_purchase_inv->dlu ?>" >
						
						</div>
					</div>
				</div>
							
							<?php
			            	if ($ref=='') {		
											
								include_once("purchase_inv_detail_input.php");
								
								if($xndf != "") {
									include("purchase_inv_get_detail.php");
								} /*else {
									include("purchase_inv_detail.php");		
								}*/
									
							} else {
								
								include("purchase_inv_detail_input_update.php");
								
								include("purchase_inv_detail.php");		
							} 
							?>
							
							<div class="space-4"></div>
						

							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
			                        
			                        <?php if (allowupd('frmpurchase_inv')==1) { ?>
			                            <?php if($ref!='') { ?>
			    							<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" onClick="return confirm('Apakah data sudah betul?')" />
			    						<?php } ?>
			                        <?php } ?>
									
			                        <?php if (allowadd('frmpurchase_inv')==1) { ?>
			    						<?php if($ref=='') { ?>
			    							<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Save" onClick="return confirm('Apakah data sudah betul?')" />
			    						<?php } ?>
			                        <?php } ?>
			                        
			                        <?php if (allowdel('frmpurchase_inv')==1) { ?>
			                            &nbsp;
			    						<input type="submit" name="submit" class="btn btn-danger" value="Delete" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
			                        <?php } ?>
			                        
									&nbsp;
									<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . '/' . obraxabrix('purchase_inv_view') ?>'" />
									        				
									
									<?php if($ref!='') { ?>
										&nbsp;&nbsp;&nbsp;
										<input type="button" name="button" class="btn btn-success" value="Print" onclick="print()" >
									<?php } ?>
									
			                                 
								</div>
							</div>
						</td>
					</tr>
				</table>
				

			</form>
            
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->


<!--[if !IE]> -->
<script type="text/javascript">
	window.jQuery || document.write("<script src='<?php echo $__folder ?>assets/js/jquery.min.js'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo $__folder ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="<?php echo $__folder ?>assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
  <script src="<?php echo $__folder ?>assets/js/excanvas.min.js"></script>
<![endif]-->
<script src="<?php echo $__folder ?>assets/js/jquery-ui.custom.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/chosen.jquery.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/fuelux.spinner.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/moment.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/daterangepicker.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.knob.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.autosize.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.maskedinput.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-tag.min.js"></script>

<script src="<?php echo $__folder ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/dataTables.tableTools.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/dataTables.colVis.min.js"></script>

<!-- ace scripts -->
<script src="<?php echo $__folder ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/ace.min.js"></script>

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


				