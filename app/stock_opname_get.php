<script src="assets/js/appcustom.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='date') {
			alert('Date cannot empty!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='location_id') {
			alert('Location cannot empty!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='bin') {
			alert('Bin cannot empty!');				
		  }
		  
		  
		  return false
		} 
										
	  }		 
	}
		
</script>

      <div id="content">
        <div class="outer">
          <div class="inner bg-light lter">

            <!--BEGIN INPUT TEXT FIELDS-->
            <div class="row">
              <div class="col-lg-12">
                <div class="box dark">
                  <header>
                    <div class="icons">
                      <i class="glyphicon glyphicon-edit"></i>
                    </div>
                    <h5>Stock Opname</h5>

                    <!-- .toolbar -->
                    <div class="toolbar">
                      <nav style="padding: 8px;">
                        <a href="javascript:;" class="btn btn-default btn-xs collapse-box">
                          <i class="glyphicon glyphicon-minus"></i>
                        </a> 
                        <a href="javascript:;" class="btn btn-default btn-xs full-box">
                          <i class="glyphicon glyphicon-resize-full"></i>
                        </a> 
                        <a href="javascript:;" class="btn btn-danger btn-xs close-box">
                          <i class="glyphicon glyphicon-remove"></i>
                        </a> 
                      </nav>
                    </div><!-- /.toolbar -->
                  </header>
                  <div id="div-1" class="body">
                  	
                  	
                  		
                  	
                  	<?php 
						$ref = $_GET['search'];
						
						//jika saat add data, maka data setelah save kosong
						if ($_POST['submit'] == 'Save') { $ref = ''; }
						//-----------------------------------------------/\
							
						$ref2 = notran(date('y-m-d'), 'frmstock_opname', '', '', ''); 
							
						include("app/exec/stock_opname_insert.php"); 
						
						
						$date = date("d-m-Y");
						$date_need = date("d-m-Y");
						$beginning_balance = "";
						
						if ($ref != "") {
							$sql=$select->list_stock_opname($ref);
							$row_stock_opname=fetch_object($sql);	
							
							$ref2 = $row_stock_opname->ref;	
							$date = date("d-m-Y", strtotime($row_stock_opname->date));
							$date_need = date("d-m-Y", strtotime($row_stock_opname->date_need));
							$qty = number_format($row_stock_opname->qty, 2, '.', ',');
							
							if($row_stock_opname->beginning_balance == 1) {
								$beginning_balance = "checked";
							}
						}	
						
							
					?>
					
                    <form class="form-horizontal" action="" method="post" name="stock_opname" id="stock_opname" enctype="multipart/form-data" onSubmit="return cekinput('date,location_id,bin');" >
                    	
                    <table border="0" width="100%">
                    	
                    	<input type="hidden" id="ref" name="ref" value="<?php echo $row_stock_opname->syscode ; ?>" >
                    	
                    	<input type="hidden" id="old_date" name="old_date" value="<?php echo $row_stock_opname->date ; ?>" >
						<input type="hidden" id="old_location_id" name="old_location_id" value="<?php echo $row_stock_opname->location_id ; ?>" >
						<input type="hidden" id="old_bin" name="old_bin" value="<?php echo $row_stock_opname->bin ; ?>" >
						<input type="hidden" id="old_uid" name="old_uid" value="<?php echo $row_stock_opname->uid ; ?>" >
												
						
                    	<tr>
                    		<td>                    		
		                    	<div class="form-group">
									<label for="text2" class="control-label col-lg-4">Date *)</label>
									<div class="col-lg-4">
										<input type="text" id="date" name="date" class="form-control" value="<?php echo $date ?>">								
									</div>
								</div>
								
								<div class="form-group">
			                        <label class="control-label col-lg-4">Location *)</label>
			                        <div class="col-lg-8">
			                          <select id="location_id" name="location_id" data-placeholder="..." class="form-control chzn-select-deselect" tabindex="2" style="width: auto">
			                            <option value=""></option>
			                            <?php 
			                            	combo_select_active("warehouse","id","name","active","1",$row_stock_opname->location_id)
			                            ?>	                            
			                          </select>
									</div>
								</div>
								
								<div class="form-group">
									<label for="text2" class="control-label col-lg-4">Bin</label>
									<div class="col-lg-8">
										<input type="text" id="bin" name="bin" class="form-control" value="<?php echo $row_stock_opname->bin ?>">								
									</div>
								</div>
								
								<div class="form-group">
									<label for="text2" class="control-label col-lg-4">Beginning Balance</label>
									<div class="col-lg-2">
										<input type="checkbox" id="beginning_balance" name="beginning_balance" class="form-control" value="1" <?php echo $beginning_balance ?> >								
									</div>
								</div>
								
								
				             </td>
				             
				             <td>&nbsp;</td>
				             
				             <td>
				             	
				             	<div class="form-group">
									<label for="text2" class="control-label col-lg-4">Memo</label>
									<div class="col-lg-5">
										<textarea id="memo" name="memo" class="form-control"><?php echo $row_stock_opname->memo ?></textarea>
									</div>
								</div>
								
				             	<div class="form-group">
									<label class="control-label col-lg-4">Updated by</label>
									<div class="col-lg-5">
										<input type="text" id="uid" name="uid" readonly class="form-control" value="<?php echo $row_stock_opname->uid ?>">
									</div>
								</div><!-- /.form-group -->
					              
					            
								<div class="form-group">
									<label class="control-label col-lg-4">Date Last Update</label>
									<div class="col-lg-5">
										<input type="text" id="dlu" name="dlu" readonly class="form-control" value="<?php echo $row_stock_opname->dlu ?>" >
									</div>
								</div><!-- /.form-group -->
								
								<div class="form-group">
									<label class="control-label col-lg-4">&nbsp;</label>
									<div class="col-lg-5">&nbsp;</div>
								</div>
								
				             </td>
				          </tr> 
		              
		              	  
		              <!----------------start detail-------->
		              	<tr>
		              	  	 <td colspan="3">
		              	  	 
		              	  	 
						<?php
						if ($ref=='') {
										
						?>
						
						
						<table class="table table-bordered table-condensed table-hover table-striped" style="width: auto">
							<thead>
								<tr> 
									<th>Item Name</th> 
									<th>Unit</th> 									 
									<th>Qty</th>	
									<th>Unit Cost</th>								
								</tr>
							</thead>
							<tbody>
								
								<?php 
									$jmldata = 10;
							
									for($no=0; $no<=$jmldata; $no++) {		
								?>
								
								<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $jmldata; ?>" >
								
								<tr style="background-color:ffffff;"> 
									<td>
										<select id="item_code_<?php echo $no ?>" name="item_code_<?php echo $no ?>" data-placeholder="..." class="form-control chzn-select-deselect" tabindex="2" style="width: auto">
											<option value=""></option>
											<?php 
												select_item("")
											?>	

										</select>	
									</td>
									<td>
										<select id="uom_code_<?php echo $no ?>" name="uom_code_<?php echo $no ?>" class="form-control" style="height: 35px; width: auto;">
											<option value=""></option>
											<?php 
												select_uom("") 
											?>
										</select>	
									</td>
									<td align="center">
										<input type="text" id="qty_<?php echo $no; ?>" name="qty_<?php echo $no; ?>" style="text-align: right" class="form-control" onkeyup="formatangka('qty_<?php echo $no; ?>')" value="" >
									</td>
									
									<td align="center">
										<input type="text" id="unit_cost_<?php echo $no; ?>" name="unit_cost_<?php echo $no; ?>" style="text-align: right" class="form-control" onkeyup="formatangka('unit_cost_<?php echo $no; ?>')" value="" >
									</td>
								</tr>
								
								<?php } ?>
							</tbody>
						</table>
						
						
						<?php } 
						else { #**************UPDATE DETAIL**********************#
						
								$sql=$select->list_stock_opname_detail($ref);
								$jmldata = mysql_num_rows($sql);
						 ?>
						 
						 <table class="table table-bordered table-condensed table-hover table-striped" style="width: auto">
							<thead>
								<tr> 
									<th>Item Name</th> 
									<th>Unit</th> 
									<th>Qty</th>
									<th>Unit Cost</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								
									$no = 0;
									while($row_stock_opname_detail=fetch_object($sql)) { 
									
									$qty = number_format($row_stock_opname_detail->qty, 0, '.', ',');
									$unit_cost = number_format($row_stock_opname_detail->unit_cost, 0, '.', ',');
									
								?>
									<input type="hidden" id="old_item_code_<?php echo $no ?>" name="old_item_code_<?php echo $no ?>" value="<?php echo $row_stock_opname_detail->item_code; ?>" >
									<input type="hidden" id="old_uom_code_<?php echo $no ?>" name="old_uom_code_<?php echo $no ?>" value="<?php echo $row_stock_opname_detail->uom_code; ?>" >
									<input type="hidden" id="old_line_<?php echo $no ?>" name="old_line_<?php echo $no ?>" value="<?php echo $row_stock_opname_detail->line; ?>" >
									
									
									<tr style="background-color:ffffff;"> 
										<td>
											<select id="item_code_<?php echo $no ?>" name="item_code_<?php echo $no ?>" data-placeholder="..." class="form-control chzn-select-deselect" tabindex="2" style="width: auto">
												<option value=""></option>
												<?php 
													select_item($row_stock_opname_detail->item_code)
												?>	

											</select>	
										</td>
										<td>
											<select id="uom_code_<?php echo $no ?>" name="uom_code_<?php echo $no ?>" class="form-control" style="height: 35px; width: auto;">
												<option value=""></option>
												<?php 
													select_uom($row_stock_opname_detail->uom_code) 
												?>
											</select>	
										</td>
										<td align="center">
											<input type="text" id="qty_<?php echo $no; ?>" name="qty_<?php echo $no; ?>" style="text-align: right" class="form-control" onkeyup="formatangka('qty_<?php echo $no; ?>')" value="<?php echo $qty ?>" >
										</td>
										<td align="center">
											<input type="text" id="unit_cost_<?php echo $no; ?>" name="unit_cost_<?php echo $no; ?>" style="text-align: right" class="form-control" onkeyup="formatangka('unit_cost_<?php echo $no; ?>')" value="<?php echo $unit_cost ?>" >
										</td>
										<td align="center">
											<input type="checkbox" id="delete_<?php echo $no; ?>" name="delete_<?php echo $no; ?>" class="form-control" value="1" >
										</td>
										
									</tr>
									<?php 
										
										$no++; 
									} 
									
									?>
									
									<?php 
										$jmldata2 = 9 - $jmldata;
										$x = $no;
										$jmldata2 = $jmldata2 + $jmldata;
										for($no=$x; $no<=$jmldata2; $no++) {	
										
									?>
										
										
										<tr style="background-color:ffffff;"> 
											<td>
												<select id="item_code_<?php echo $no ?>" name="item_code_<?php echo $no ?>" data-placeholder="..." class="form-control chzn-select-deselect" tabindex="2" style="width: auto">
													<option value=""></option>
													<?php 
														select_item("")
													?>	

												</select>	
											</td>
											<td>
												<select id="uom_code_<?php echo $no ?>" name="uom_code_<?php echo $no ?>" class="form-control" style="height: 35px; width: auto;">
													<option value=""></option>
													<?php 
														select_uom("") 
													?>
												</select>	
											</td>
											<td align="center">
												<input type="text" id="qty_<?php echo $no; ?>" name="qty_<?php echo $no; ?>" style="text-align: right" class="form-control" onkeyup="formatangka('qty_<?php echo $no; ?>')" value="" >
											</td>
											<td align="center">
												<input type="text" id="unit_cost_<?php echo $no; ?>" name="unit_cost_<?php echo $no; ?>" style="text-align: right" class="form-control" onkeyup="formatangka('unit_cost_<?php echo $no; ?>')" value="" >
											</td>
											<td align="center">
												<input type="checkbox" id="delete_<?php echo $no; ?>" name="delete_<?php echo $no; ?>" class="form-control" value="1" >
											</td>
											
										</tr>
									
									<?php } ?>
									
									<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $no; ?>" >
										
							</tbody>
						</table>
						
						 <?php } ?>
						<!----------------end detail---------->
									
									
									
		              
		              <div class="form-group">
			              <div class="body collapse in">
							<?php if (allowadd('frmstock_opname')==1) { ?>
								<?php if($ref=='') { ?>
									<input type="submit" name="submit" class="btn btn-metis-2 btn-sm" value="Save">
								<?php } ?>
							<?php } ?>
							
							<?php if (allowupd('frmstock_opname')==1) { ?>
								<?php if($ref!='') { ?>													
									<input type="submit" name="submit" class="btn btn-warning btn-sm" value="Update">
								<?php } ?>
							<?php } ?>
							
							<?php if (allowdel('frmstock_opname')==1) { ?>
								<input type="submit" name="submit" class="btn btn-metis-1 btn-sm" value="Delete" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
							<?php } ?>
							
							<input type="button" name="submit" class="btn btn-info btn-sm" value="List" onClick="self.location='main.php?menu=app&act=<?php echo obraxabrix(stock_opname_view) ?> '">
						</div>
					</div>
			        				
                      
                      <!------space bottom------------->
                      <div class="form-group">
                        <label for="autosize" class="control-label col-lg-4">&nbsp;</label>
                        <div class="col-lg-8">
                          &nbsp;
                        </div>
                      </div><!-- /.form-group -->
                      
                      <div class="form-group">
                        <label for="tags" class="control-label col-lg-4">&nbsp;</label>
                        <div class="col-lg-8">
                          &nbsp;
                        </div>
                      </div><!-- /.form-group -->
                      
                    </form>
                    	
                    		</td>
                    	</tr>
                    	
                    </table>
                    
                    
                  </div>
                </div>
              </div>

              <!--END TEXT INPUT FIELD-->

            </div><!-- /.row -->

            <!--END GRID INPUTS-->
          </div><!-- /.inner -->
        </div><!-- /.outer -->
      </div><!-- /#content -->