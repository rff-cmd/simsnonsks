
	<div class="row">
		<div class="col-xs-12">
            
            <?php 
            	$sqlu=$select->list_item($kode, $all, $active, $code, $old_code, $name, $item_group_id);
            	$dataf = $sqlu->fetch(PDO::FETCH_OBJ);
            	
				$ref = $dataf->syscode; //$_GET['search'];
							
				include("app/exec/set_item_price_insert.php"); 
				
				if ($ref != "") {
					$sql=$select->list_item($ref);
					$row_set_item_price=$sql->fetch(PDO::FETCH_OBJ);	
					
					$minimum_stock = $row_set_item_price->minimum_stock; 
					$maximum_stock = $row_set_item_price->maximum_stock; 
				}			
			?>
            
			<!-- PAGE CONTENT BEGINS -->
			<form class="form-horizontal" action="" method="post" name="set_item_price" id="set_item_price" enctype="multipart/form-data" onSubmit="return cekinput('code,name');" >
            	
            	<input type="hidden" id="syscode" name="syscode" value="<?php echo $ref ?>" >
                
                
                <table border="0" width="100%">
                    <tr>
                    	<td>
                    		<div class="form-group">
			                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kelompok Barang *)</label>
			                    <div class="col-sm-5">
			                      <select id="item_group_id" name="item_group_id" class="chosen-select form-control"  style="width: auto">
			                        <option value=""></option>
			                        <?php 
			                        	combo_select_active("item_group","id","name","active","1",$row_set_item_price->item_group_id) 
			                        ?>	                            
			                      </select>
								</div>
							</div>
							
			            	<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kode Barang *)</label>
								<div class="col-sm-5">
									<input type="text" id="code" name="code" class="form-control" value="<?php echo $row_set_item_price->code ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kode Barcode </label>
								<div class="col-sm-5">
									<input type="text" id="old_code" name="old_code" class="form-control" value="<?php echo $row_set_item_price->old_code ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Barang *)</label>
								<div class="col-sm-5">
									<input type="text" id="name" name="name" class="form-control" value="<?php echo $row_set_item_price->name ?>">
								</div>
							</div>
							
							
							<?php /*
							<div class="form-group">
			                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Item Sub Group</label>
			                    <div class="col-sm-5">
			                      <select id="item_subgroup_id" name="item_subgroup_id" class="chosen-select form-control"  style="width: auto">
			                        <option value=""></option>
			                        <?php 
			                        	combo_select_active("item_subgroup","id","name","active","1",$row_set_item_price->item_subgroup_id) 
			                        ?>	                            
			                      </select>
								</div>
							</div>*/ ?>
							
							<?php /*
							<div class="form-group">
			                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Item Type</label>
			                    <div class="col-sm-5">
			                      <select id="item_type_code" name="item_type_code" class="chosen-select form-control"  style="width: auto">
			                        <option value=""></option>
			                        <?php 
			                        	combo_select_active("item_type","syscode","name","active","1",$row_set_item_price->item_type_code) 
			                        ?>	
			                                                  
			                      </select>
								</div>
							</div>
							
							<div class="form-group">
			                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Item Category</label>
			                    <div class="col-sm-5">
			                      <select id="item_category_id" name="item_category_id" class="chosen-select form-control"  style="width: auto">
			                        <option value=""></option>
			                        <?php 
			                        	combo_select_active("item_category","id","name","active","1",$row_set_item_price->item_category_id) 
			                        ?>	
			                                                  
			                      </select>
								</div>
							</div>
							
							<div class="form-group">
			                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Brand</label>
			                    <div class="col-sm-5">
			                      <select id="brand_id" name="brand_id" class="chosen-select form-control"  style="width: auto">
			                        <option value=""></option>
			                        <?php 
			                        	combo_select_active("brand","id","name","active","1",$row_set_item_price->brand_id) 
			                        ?>	
			                                                  
			                      </select>
								</div>
							</div>
							
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Size</label>
								<div class="col-sm-5">
									<input type="text" id="size_id" name="size_id" class="form-control" value="<?php echo $row_set_item_price->size_id ?>">
								</div>
							</div>*/ ?>
							
							<!--<div class="form-group">
			                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Satuan Stok</label>
			                    <div class="col-sm-5">
			                      <select id="uom_code_stock" name="uom_code_stock" class="chosen-select form-control"  style="width: auto">
			                        <option value=""></option>
			                        <?php 
			                        	select_uom($row_set_item_price->uom_code_stock) 
			                        ?>	
			                                                  
			                      </select>
								</div>
							</div>-->
							
							<input type="hidden" id="uom_code_stock" name="uom_code_stock" value="pcs" />
							<input type="hidden" id="uom_code_purchase" name="uom_code_purchase" value="pcs" />
							
							<div class="form-group">
			                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Satuan</label>
			                    <div class="col-sm-5">
			                      <select id="uom_code_sales" name="uom_code_sales" class="chosen-select form-control"  style="width: auto">
			                        <option value=""></option>
			                        <?php 
			                        	select_uom($row_set_item_price->uom_code_sales) 
			                        ?>	
			                                                  
			                      </select>
								</div>
							</div>
							
							<!--<div class="form-group">
			                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Satuan Beli</label>
			                    <div class="col-sm-5">
			                      <select id="uom_code_purchase" name="uom_code_purchase" class="chosen-select form-control"  style="width: auto">
			                        <option value=""></option>
			                        <?php 
			                        	select_uom($row_set_item_price->uom_code_purchase) 
			                        ?>	
			                                                  
			                      </select>
								</div>
							</div>-->
							
							
							
						</td>
					
						<td>
							
							
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Aktif</label>
								<div class="col-sm-5">
									<?php if($ref=='') { ?>
										<input class="ace" type="checkbox" name="active" id="active" value="1" checked />
									<?php } else { ?>
										<input class="ace" type="checkbox" name="active" id="active" value="1" <?php if($row_set_item_price->active==1) echo "checked";?>/>
									<?php } ?>
									<span class="lbl"></span>
								</div>
							</div>
							
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Minimum Stock</label>
								<div class="col-sm-5">
									<input type="text" id="minimum_stock" name="minimum_stock" class="form-control" onkeyup="formatangka('minimum_stock')" style="text-align: right" value="<?php echo $minimum_stock ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Maximum Stock</label>
								<div class="col-sm-5">
									<input type="text" id="maximum_stock" name="maximum_stock" class="form-control" onkeyup="formatangka('maximum_stock')" style="text-align: right" value="<?php echo $maximum_stock ?>">
								</div>
							</div>
							
							<div class="form-group"> 
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Photo</label>
			                        
			                    <div class="col-xs-3">
									<input type="file" id="photo" name="photo" />
			                        <br />
			        				<?php if (!empty($row_set_item_price->photo)) { ?>
			        					<img src="<?php echo 'app/photo_item/'. $row_set_item_price->photo ?>" width="110" height="100" />
			        				<?php } ?>
			                        <input size="25" type="hidden" id="photo2" name="photo2" value="<?php echo $row_set_item_price->photo; ?>">  
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Konsinyasi</label>
								<div class="col-sm-5">
									<?php if($ref=='') { ?>
										<input class="ace" type="checkbox" name="consigned" id="consigned" value="1" />
									<?php } else { ?>
										<input class="ace" type="checkbox" name="consigned" id="consigned" value="1" <?php if($row_set_item_price->consigned==1) echo "checked";?>/>
									<?php } ?>
									<span class="lbl"></span>
								</div>
							</div>
												
						</td>
					</tr>	
					
					<!--Start Set Item Price-->
					<?php
						
						$sql=$select->list_set_item_price_last($location_id, $ref);
						$row_item_price=$sql->fetch(PDO::FETCH_OBJ);
						
						$location_id	=	$row_item_price->location_id;
						$date			=	date("d-m-Y", strtotime($row_item_price->date));
						if($date == "01-01-1970") {
							$date	=	"";
						}
						$efective_from	=	date("d-m-Y"); //, strtotime($row_item_price->efective_from));
						if($efective_from == "01-01-1970") {
							$efective_from	=	"";
						}
						$qty1			=	number_format($row_item_price->qty1,2,".",",");
						$qty2			=	number_format($row_item_price->qty2,2,".",",");
						$qty3			=	number_format($row_item_price->qty3,2,".",",");
						$qty4			=	number_format($row_item_price->qty4,2,".",",");
						$current_price	=	number_format($row_item_price->current_price,2,".",",");
						$current_price1	=	number_format($row_item_price->current_price1,2,".",",");
						$current_price2	=	number_format($row_item_price->current_price2,2,".",",");
						$current_price3	=	number_format($row_item_price->current_price3,2,".",",");
						
					?>
					
					<input type="hidden" id="old_date" name="old_date" value="<?php echo $row_item_price->date_of_record ?>">
					
					<tr>
						<td colspan="2">
							<hr />
						</td>
					</tr>
					
					<tr>
						<td colspan="2">
						
							
							<?php include("set_item_cost_update.php"); ?>
							
							<br>
							
							<table border="0" width="100%">
								<tr>
									<td colspan="3" style="color: #1626e9; font-weight: bold; font-size: 14px">Setup Harga Penjualan</td>
								</tr>
								<tr>
									<td width="20%">
										<label for="form-field-1" style="margin-left: 50px"><?php if($lng==1) { echo 'Location'; } else { echo 'Cabang/Lokasi'; } ?></label>
									</td>
									<td>:</td>
									<td>
										<div class="col-sm-3">
											<select id="location_id" name="location_id" class="chosen-select form-control"  style="width: 200px">
						                        <option value=""></option>
						                        <?php 
						                        	combo_select_active("warehouse","id","name","active","1",$location_id);
						                        ?>	
					                                                  
					                     	</select>
					                    </div>
									</td>
								</tr>
								
								<tr>
									<td width="20%">
										<label for="form-field-1" style="margin-left: 50px"><?php if($lng==1) { echo 'Date'; } else { echo 'Tanggal'; } ?> *)</label>
									</td>
									<td>:</td>
									<td>
										<div class="col-sm-3">
											<input type="text" id="date" name="date" style="font-size: 12px; width: 100px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $date ?>">
										</div>
									</td>
								</tr>
								
								<tr>
									<td width="20%">
										<label for="form-field-1" style="margin-left: 50px"><?php if($lng==1) { echo 'Efective Date'; } else { echo 'Tanggal Efektif'; } ?> *)</label>
									</td>
									<td>:</td>
									<td>
										<div class="col-sm-3">
											<input type="text" id="efective_from" name="efective_from" style="font-size: 12px; width: 100px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $efective_from ?>">
										</div>
									</td>
								</tr>
								
								<tr>
									<td>
										<label for="form-field-1" style="margin-left: 50px">Kelompok Qty</label>
									</td>
									<td>:</td>
									<td>
										<div class="col-sm-2">										
											<input type="text" id="qty1" name="qty1" onkeyup="formatangka('qty1')" style="text-align: right; width: 90px" value="<?php echo $qty1 ?>">
											>=
										</div>
										
										<div class="col-sm-2">
											<input type="text" id="qty2" name="qty2" onkeyup="formatangka('qty2')" style="text-align: right; width: 90px" value="<?php echo $qty2 ?>">
											>=
										</div>
										
										<div class="col-sm-2">											
											<input type="text" id="qty3" name="qty3" onkeyup="formatangka('qty2')" style="text-align: right; width: 90px" value="<?php echo $qty3 ?>">
											
										</div>
										
										<?php /*
										<div class="col-sm-2">
											<input type="text" id="qty4" name="qty4" onkeyup="formatangka('qty2')" style="text-align: right; width: 90px" value="<?php echo $qty4 ?>">
										</div>*/ ?>
									</td>
									
								</tr>
								
								<tr>
									<td>
										<label for="form-field-1" style="margin-left: 50px">Harga Satuan</label>
									</td>
									<td>:</td>
									<td>		
										<div class="col-sm-2">								
											<input type="text" id="current_price" name="current_price" onkeyup="formatangka('current_price')" style="text-align: right; width: 90px" value="<?php echo $current_price ?>">
										</div>
										
										<div class="col-sm-2">
											<input type="text" id="current_price1" name="current_price1" onkeyup="formatangka('current_price1')" style="text-align: right; width: 90px" value="<?php echo $current_price1 ?>">
										</div>
										
										<div class="col-sm-2">
											<input type="text" id="current_price2" name="current_price2" onkeyup="formatangka('current_price2')" style="text-align: right; width: 90px" value="<?php echo $current_price2 ?>">
										</div>
										
										<?php /*
										<div class="col-sm-2">
											<input type="text" id="current_price3" name="current_price3" onkeyup="formatangka('current_price3')" style="text-align: right; width: 90px" value="<?php echo $current_price3 ?>">
										</div>*/ ?>
									</td>
									
								</tr>
							</table>
						</td>
					</tr>
								<!--End Set Item Price-->
								
					<tr>
						<td colspan="2">
							<div class="space-4"></div>

							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
			                        
			                        <?php if (allowadd('frmset_item_price')==1) { ?>
			    						<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Save" />
			                        <?php } ?>
			                        
			                        &nbsp;
									<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . obraxabrix(set_item_price_view) ?>'" />
			                                                
			                                 
								</div>
							</div>
						</td>
					</tr>
							
									
									
				</table>
				

			</form>
            
		</div>
	</div>
	
	
	