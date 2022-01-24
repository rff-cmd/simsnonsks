<table width="30%" border="0">
    <tr>
        <td>
			<select id="item_code" name="item_code" class="chosen-select form-control" style="width: auto; font-size: 11px" onKeyPress="return focusNext('item_code2',event)" onchange="loadHTMLPost3('<?php echo $nama_folder ?>/app/purchase_inv_detail_ajax.php','item_ajax','getdata2','item_code','location_id')" >
				<option value=""></option>
				<?php 
					select_item("")
				?>	

			</select>	
		</td>
		
		<!--<td>
            <a href="javascript:void(0);" name="Find" title="Find" onClick=window.open("app/purchase_inv_item_lup.php","Find","width=900,height=500,left=200,top=20,toolbar=0,status=0,scroll=1,scrollbars=no");><img src="<?php echo $nama_folder ?>/assets/img/plus.png" /></a>
            
        </td>-->
    </tr>
</table>

<table border="0">
    
	<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea">
		<td>Kode</td>
		<td>Nama Barang</td>
		<td>Satuan</td>
		<!--<td>Size</td>-->
		<td>Jumlah</td>
		<td>Harga</td>
		<td>Discount(%)</td>
        <!--<td>Discount-2(%)</td>
        <td>Discount-3(%)</td>-->
        <td>Discount(Rp)</td>
		<td>Amount</td>
		<td></td>
	</tr>
	<tr style="background-color:ffffff;" id="item_ajax" > 
        
        <input type="hidden" id="item_code" name="item_code" style="font-size: 11px; width: 60px" class="form-control" value="<?php echo $item_code ?>" />            
        <!--<input type="hidden" id="discount3_1_det" name="discount3_1_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount3_1_det'), detailvalue2('persen')" value="" />-->	
		<input type="hidden" id="discount3_2_det" name="discount3_2_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount3_2_det'), detailvalue2('persen')" value="" />	
		<input type="hidden" id="discount3_3_det" name="discount3_3_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount3_3_det'), detailvalue2('persen')" value="" />
		
		 		
		<td align="left" colspan="1">
            
            <input type="text" id="item_code2" name="item_code2" style="font-size: 11px; width: 100px" class="form-control" onchange="loadHTMLPost3('app/purchase_inv_detail_ajax.php','item_ajax','getdata','item_code2','location_id')" autofocus="" value="" />
            
            <!--
			<input type="text" id="item_code2" name="item_code2" style="font-size: 11px; width: 100px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onchange="loadHTMLPost2('app/purchase_inv_detail_ajax.php','item_ajax','getdata','item_code2')" value="" > -->
		</td>
		
		<td align="left">
			<input type="text" id="item_name" name="item_name" readonly="" style="font-size: 11px; width: auto; min-width: 200px" class="form-control" value="<?php echo $item_name ?>" >
		</td>

		<td>
			<select id="uom_code" name="uom_code" class="form-control" style="height: 35px; min-width: 70px; font-size: 11px">
				<option value=""></option>
				<?php 
					select_uom($uom_code) 
				?>
			</select>	
		</td>
		<!--<td align="center">-->
			<input type="hidden" id="size" name="size" style="text-align: right; font-size: 11px; width: 60px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('size')" value="" >
		<!--</td>-->
		<td align="center">
			<input type="text" id="qty" name="qty" style="text-align: right; font-size: 11px; width: 60px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('qty'), detailvalue2()" value="" >
		</td>
		<td align="center">
			<input type="text" id="unit_cost" name="unit_cost" style="text-align: right; font-size: 11px; width: 100px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('unit_cost'), detailvalue2()" value="" >
		</td>
		
		<?php /*
		
		
		<td align="center">
			<input type="text" id="discount3_2_det" name="discount3_2_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount3_2_det'), detailvalue2('persen')" value="" >
		</td>
		
		<td align="center">
			<input type="text" id="discount3_3_det" name="discount3_3_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount3_3_det'), detailvalue2('persen')" value="" >
		</td>
		*/ ?>
		
		
		
		<td align="center" id="discount3_det_id">
			<input type="text" id="discount3_1_det" name="discount3_1_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount3_1_det'), detailvalue2('persen')" value="" >
		</td>
		
		<td align="center" id="discount_det_id">
			<input type="text" id="discount_det" name="discount_det" style="text-align: right; font-size: 11px; width: 90px" class="form-control" onKeyPress="return focusNext('submit_det',event)" onkeyup="formatangka('discount_det'), detailvalue2('nominal')" value="" >
		</td>
        
		<td align="center" id="amount_det">
			<input type="text" id="amount" name="amount" readonly="" style="text-align: right; font-size: 11px; width: 100px" class="form-control" onkeyup="formatangka('amount')" value="" >
		</td>
		
		<td>
			&nbsp;<input type="submit" id="submit_det" name="submit" class="btn btn-metis-2 btn-sm" style="height: 34px" value="Save Detail">
		</td>
	</tr>
	
	<tr>
		<td colspan="11">&nbsp;</td>
	</tr>
</table>