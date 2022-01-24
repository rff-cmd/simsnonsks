<div class="page-content">
	<div class="row">
		<div class="col-sm-6">
			<h3 class="row header smaller lighter blue">
				<span class="col-xs-6"> PO </span><!-- /.col -->

				<span class="col-xs-6">
					<span class="pull-right inline">
						<!--<span class="grey smaller-80 bolder">style:</span>

						<span class="btn-toolbar inline middle no-margin">
							<span id="accordion-style" data-toggle="buttons" class="btn-group no-margin">
								<label class="btn btn-xs btn-yellow active">
									<input type="radio" value="1" />
									1
								</label>

								<label class="btn btn-xs btn-yellow">
									<input type="radio" value="2" />
									2
								</label>
							</span>
						</span>-->
					</span>
				</span><!-- /.col -->
			</h3>

			<div id="accordion" class="accordion-style1 panel-group">
				
				<?php if( allow("dashboard_po_released")==1 || $_SESSION["adm"] == 1 ) { ?>
				
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									<i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
									&nbsp;PO Released
								</a>
							</h4>
						</div>

						<div class="panel-collapse collapse in" id="collapseOne">
							<div class="panel-body">
								
								<div class="row">
									<div class="col-xs-12">
										<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>
										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
					                                    <th><?php if($lng==1) { echo 'PO No'; } else { echo 'No. PO'; } ?></th>
					                                    <th><?php if($lng==1) { echo 'Date'; } else { echo 'Tanggal'; } ?></th>
														<th><?php if($lng==1) { echo 'Client'; } else { echo 'Brand'; } ?></th>    													<th><?php if($lng==1) { echo 'Qty'; } else { echo 'Total'; } ?></th>
													</tr>
												</thead>

												<tbody>
					                                <?php			
														$i = 0;
					            						$sql=$selectview->dashborad_so_released();
											            while($row_delivery_order=$sql->fetch(PDO::FETCH_OBJ)){
					            						
					            						$i++;
					            							
					            							$so_ref = $row_delivery_order->ref;
					            							/*//from counting
					            							$sql_so = $selectview->dashborad_get_so_released_cnt($row_delivery_order->ref);
					            							$row_so=$sql_so->fetch(PDO::FETCH_OBJ);
					            							$so_ref = $row_so->so_ref;
					            							//------------
					            							
					            							//from jahit
					            							$sql_so1 = $selectview->dashborad_get_so_released_sewing($row_delivery_order->ref);
					            							$row_so1=$sql_so1->fetch(PDO::FETCH_OBJ);
					            							if($so_ref == "") {
																$so_ref = $row_so1->so_ref;
															}
					            							//------------*/
					            							
					            							if($row_delivery_order->qty > 0) {
													?>
					                                            
							                                        <tr>
							                                            <td><?php echo $so_ref ?></td>
							                                            <td><?php echo $row_delivery_order->date ?></td>
																		<td><?php echo $row_delivery_order->client_name ?></td>
																		<td align="right"><?php echo number_format($row_delivery_order->qty,0,'.',',') ?></td>
																	</tr>
					                                    
					                                    <?php
																}
					                                        }
					                                    ?>
					                                    
												</tbody>
											</table>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
					
				<?php } ?>
				
				
				<?php if( allow("dashboard_po_outstanding")==1 || $_SESSION["adm"] == 1 ) { ?>
				
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
									<i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
									&nbsp;PO Outstanding
								</a>
							</h4>
						</div>

						<div class="panel-collapse collapse" id="collapseTwo">
							<div class="panel-body">
								
								<div class="row">
										<div class="col-xs-12">
											<div class="clearfix">
												<div class="pull-right tableTools-container"></div>
											</div>
											<!-- div.dataTables_borderWrap -->
											<div>
												<table id="dynamic-table" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
						                                    <th><?php if($lng==1) { echo 'PO No'; } else { echo 'No. PO'; } ?></th>
						                                    <th><?php if($lng==1) { echo 'Date'; } else { echo 'Tanggal'; } ?></th>
															<th><?php if($lng==1) { echo 'Client'; } else { echo 'Brand'; } ?></th>    													<th><?php if($lng==1) { echo 'Qty'; } else { echo 'Total'; } ?></th>
														</tr>
													</thead>

													<tbody>
						                                <?php			
															$i = 0;
						            						$sql_out=$selectview->dashborad_so_outstanding();
												            while($row_so=$sql_out->fetch(PDO::FETCH_OBJ)){
						            						
						            						$i++;
						            							
						            							//from counting
						            							$sql_sox = $selectview->dashborad_so_outstanding_cnt($row_so->so_ref);
						            							$row_sox=$sql_sox->fetch(PDO::FETCH_OBJ);
						            							$qty_do = $row_sox->qty_do;
						            							//------------
						            							
						            							//from jahit
						            							$sql_so1 = $selectview->dashborad_so_outstanding_sewing($row_so->so_ref);
						            							$row_so1=$sql_so1->fetch(PDO::FETCH_OBJ);
						            							if($qty_do == 0) {
																	$qty_do = $row_so1->qty_do;
																}
						            							//------------
						            							
						            							$qty_outstanding = $row_so->qty - $qty_do;
						            							
						            							if($qty_outstanding > 0) {
														?>
						                                            
								                                        <tr>
								                                            <td><?php echo $row_so->so_ref ?></td>
								                                            <td><?php echo $row_so->date ?></td>
																			<td><?php echo $row_so->client_name ?></td>
																			<td align="right">
																				<!--<?php echo number_format($row_so->qty,0,'.',',') ?>
																				<br>
																				<?php echo number_format($qty_do,0,'.',',') ?>
																				
																				<br>-->
																				<?php echo number_format($row_so->qty - $qty_do,0,'.',',') ?>
																					
																				</td>
																		</tr>
						                                    
						                                    <?php
																	}
						                                        }
						                                        
						                                    ?>
						                                    
													</tbody>
												</table>
											</div>
										</div>
									</div>
									
							</div>
						</div>
					</div>
				<?php } ?>

				<?php if( allow("dashboard_po_item_count")==1 || $_SESSION["adm"] == 1 ) { ?>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
								<i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
								&nbsp;Jumlah Kain per Order Kain
							</a>
						</h4>
					</div>

					<div class="panel-collapse collapse" id="collapseThree">
						<div class="panel-body">
							
							<div class="row">
								<div class="col-xs-12">
									<div class="clearfix">
										<div class="pull-right tableTools-container"></div>
									</div>
									<!-- div.dataTables_borderWrap -->
									<div>
										<table id="dynamic-table" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
				                                    <th><?php if($lng==1) { echo 'PO No'; } else { echo 'No. PO'; } ?></th>
				                                    <th><?php if($lng==1) { echo 'Date'; } else { echo 'Tanggal'; } ?></th>
													<th><?php if($lng==1) { echo 'Client'; } else { echo 'Brand'; } ?></th>    													<th><?php if($lng==1) { echo 'Qty'; } else { echo 'Total Kain'; } ?></th>
												</tr>
											</thead>

											<tbody>
				                                <?php			
													$i = 0;
				            						$sql_count=$selectview->dashborad_so_item_count();
										            while($row_count=$sql_count->fetch(PDO::FETCH_OBJ)){
				            						
				            						$i++;
				            							
				            							/*//from counting
				            							$sql_sox = $selectview->dashborad_so_outstanding_cnt($row_count->so_ref);
				            							$row_countx=$sql_sox->fetch(PDO::FETCH_OBJ);
				            							$qty_do = $row_countx->qty_do;
				            							//------------
				            							
				            							//from jahit
				            							$sql_so1 = $selectview->dashborad_so_outstanding_sewing($row_count->so_ref);
				            							$row_count1=$sql_so1->fetch(PDO::FETCH_OBJ);
				            							if($qty_do == 0) {
															$qty_do = $row_count1->qty_do;
														}
				            							//------------
				            							
				            							$qty_outstanding = $row_count->qty - $qty_do;
				            							
				            							if($qty_outstanding > 0) {*/
												?>
				                                            
						                                        <tr>
						                                            <td><?php echo $row_count->so_ref ?></td>
						                                            <td><?php echo $row_count->date ?></td>
																	<td><?php echo $row_count->client_name ?></td>
																	<td align="right">
																		<!--<?php echo number_format($row_count->qty,0,'.',',') ?>
																		<br>
																		<?php echo number_format($qty_do,0,'.',',') ?>
																		
																		<br>-->
																		<?php echo number_format($row_count->count_item,0,'.',',') ?>
																			
																		</td>
																</tr>
				                                    
				                                    <?php
															//}
				                                        }
				                                        
				                                    ?>
				                                    
											</tbody>
										</table>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				
				<?php } ?>
			</div>
		</div><!-- /.col -->

		<div class="col-sm-6">
			<h3 class="header smaller lighter green">Persentase per PO</h3>

			<div class="row">
				<div class="col-xs-8">
					<div class="progress pos-rel" data-percent="66%">
						<div class="progress-bar" style="width:66%;"></div>
					</div>

					<div class="progress progress-striped pos-rel">
						<div class="progress-bar progress-bar-success" style="width: 25%;"></div>
					</div>

					<div class="progress progress-small progress-striped active">
						<div class="progress-bar progress-bar-warning" style="width: 40%;"></div>
					</div>

					<div class="progress progress-mini">
						<div class="progress-bar progress-danger" style="width: 35%;"></div>
					</div>

					<div class="progress">
						<div class="progress-bar progress-bar-success" style="width: 35%;"></div>

						<div class="progress-bar progress-bar-warning" style="width: 20%;"></div>

						<div class="progress-bar progress-bar-danger" style="width: 10%;"></div>
					</div>

					<div class="progress progress-striped">
						<div class="progress-bar progress-bar-purple" style="width: 65%"></div>
					</div>

					<div class="progress progress-striped">
						<div class="progress-bar progress-bar-pink" style="width: 40%"></div>
					</div>

					<div class="progress progress-striped active">
						<div class="progress-bar progress-bar-yellow" style="width: 60%"></div>
					</div>

					<div class="progress progress-striped">
						<div class="progress-bar progress-bar-inverse" style="width: 80%"></div>
					</div>
				</div><!-- /.col -->

				<div class="col-xs-4 center">
					<div class="easy-pie-chart percentage" data-percent="20" data-color="#D15B47">
						<span class="percent">20</span>%
					</div>

					<hr />
					<div class="easy-pie-chart percentage" data-percent="55" data-color="#87CEEB">
						<span class="percent">55</span>%
					</div>

					<hr />
					<div class="easy-pie-chart percentage" data-percent="90" data-color="#87B87F">
						<span class="percent">90</span>%
					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</div>	

