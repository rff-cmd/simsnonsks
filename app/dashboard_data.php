<div class="page-content">
	<div class="row">
		
		<div class="col-sm-6">
			<h3 class="row header smaller lighter blue">
				<span class="col-xs-3"> Informasi</span><!-- /.col -->

				<span class="col-xs-6">
					<span class="pull-right inline">
						<?php 
							if($_SESSION["tipe_user"] == "Siswa") {
						?>		
						
							<span class="col-xs-6"> Informasi</span><!-- /.col -->
						<?php		
							}
						?>
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
				
				<?php if(allow_reminder("1", "") == 1) { ?>				
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseppk">
									<i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
									<?php $tanggal_ppk = date("d-m-Y") ?>
									&nbsp;Daftar Guru PPK Tanggal <?php echo $tanggal_ppk ?>
								</a>
							</h4>
						</div>

						<div class="panel-collapse collapse in" id="collapseppk">
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
					                                    <th><?php if($_SESSION['bahasa']==1) { echo 'NIP'; } else { echo 'NIP'; } ?></th>
					                                    <th><?php if($_SESSION['bahasa']==1) { echo 'Nama'; } else { echo 'Nama'; } ?></th>
														<th><?php if($_SESSION['bahasa']==1) { echo 'Amount'; } else { echo 'Sisa Bayar'; } ?></th>    												
													</tr>
												</thead>

												<tbody>
					                                <?php			
														$i = 0;
														$dari_jam = "05:00";
														$tanggal_jam = date("Y-m-d") . $dari_jam;  //"2018-10-24 06:00";
														$tanggal_jam = date("Y-m-d H:i", strtotime($tanggal_jam));
														
														$smp_jam = "07:00";
														$smp_tanggal_jam = date("Y-m-d") . $smp_jam; //"2018-10-24 07:00";
														$smp_tanggal_jam = date("Y-m-d H:i", strtotime($smp_tanggal_jam));
														
					            						$sql=$selectview->dashboard_presensi_general_ppk($tanggal_jam, $smp_tanggal_jam);
											            while($row_delivery_order=$sql->fetch(PDO::FETCH_OBJ)){
					            						
					            						$i++;
					            							
					            							//if($row_delivery_order->qty > 0) {
													?>
					                                            
					                                        <tr>
					                                            <td><?php echo $row_delivery_order->nip ?></td>
					                                            <td><?php echo $row_delivery_order->nama ?></td>
																<td><?php echo date("d-m-Y H:i", strtotime($row_delivery_order->tanggal)) ?></td>
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
				
				
				<?php if(allow_reminder("2", "") == 1) { ?>
				
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									<i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
									&nbsp;Siswa Belum Bayar
								</a>
							</h4>
						</div>

						<div class="panel-collapse collapse" id="collapseOne">
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
					                                    <th><?php if($_SESSION['bahasa']==1) { echo 'NIS'; } else { echo 'NIS'; } ?></th>
					                                    <th><?php if($_SESSION['bahasa']==1) { echo 'Nama'; } else { echo 'Nama'; } ?></th>
														<th><?php if($_SESSION['bahasa']==1) { echo 'Amount'; } else { echo 'Sisa Bayar'; } ?></th>    												
													</tr>
												</thead>

												<tbody>
					                                <?php			
														$i = 0;
					            						$sql=$selectview->list_dashboard_receipt_outstanding("SMA");
											            while($row_delivery_order=$sql->fetch(PDO::FETCH_OBJ)){
					            						
					            						$i++;
					            							
					            							//if($row_delivery_order->qty > 0) {
													?>
					                                            
					                                        <tr>
					                                            <td><?php echo $row_delivery_order->nis ?></td>
					                                            <td><?php echo $row_delivery_order->nama ?></td>
																<td align="right"><?php echo number_format($row_delivery_order->sisa,0,'.',',') ?></td>
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
				
				
				<?php if(allow_reminder("3", "") == 1) { ?>
				
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
									<i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
									&nbsp;Siswa Absen
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
						                                    <th><?php if($_SESSION['bahasa']==1) { echo 'NIS'; } else { echo 'NIS'; } ?></th>
						                                    <th><?php if($_SESSION['bahasa']==1) { echo 'Nama'; } else { echo 'Nama'; } ?></th>
															<th><?php if($_SESSION['bahasa']==1) { echo 'Jml Absen'; } else { echo 'Jumlah Absen'; } ?></th>
														</tr>
													</thead>

													<tbody>
						                                <?php			
															$i = 0;
						            						$sql=$selectview->list_dashboard_presensi_harian_siswa("");
												            while($row_delivery_order=$sql->fetch(PDO::FETCH_OBJ)){
						            						
						            						$i++;
						            							
						            							//if($row_delivery_order->qty > 0) {
														?>
						                                            
						                                        <tr>
						                                            <td><?php echo $row_delivery_order->nis ?></td>
						                                            <td><?php echo $row_delivery_order->nama ?></td>
																	<td align="center"><?php echo number_format($row_delivery_order->jumlah,0,'.',',') ?></td>
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

				<?php if(allow_reminder("4", "") == 1) { ?>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
								<i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
								&nbsp;Guru Terlambat
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
				                                    <th><?php if($_SESSION['bahasa']==1) { echo 'NIP'; } else { echo 'NIP'; } ?></th>
				                                    <th><?php if($_SESSION['bahasa']==1) { echo 'Nama'; } else { echo 'Nama'; } ?></th>
													<th><?php if($_SESSION['bahasa']==1) { echo 'Jumlah'; } else { echo 'Jumlah Absen'; } ?></th>
												</tr>
											</thead>

											<tbody>
				                                <?php			
													$i = 0;
				            						$sql=$selectview->list_dashboard_presensi_harian_guru("");
										            while($row_delivery_order=$sql->fetch(PDO::FETCH_OBJ)){
				            						
				            						$i++;
				            							
				            							//if($row_delivery_order->qty > 0) {
												?>
				                                            
				                                        <tr>
				                                            <td><?php echo $row_delivery_order->nip ?></td>
				                                            <td><?php echo $row_delivery_order->nama ?></td>
															<td align="right"><?php echo number_format($row_delivery_order->jumlah,0,'.',',') ?></td>
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
		
		<?php if(allow_reminder("6", "") == 1) { ?>
			<div class="col-sm-6">
				<h3 class="header smaller lighter green">Persentase Kehadiran Siswa</h3>

				<div class="row">
					<div class="col-xs-8">
						<div class="progress pos-rel" data-percent="66%">
							<div class="progress-bar" style="width:66%;"></div>
						</div>

						<div class="progress progress-striped pos-rel">
							<div class="progress-bar progress-bar-success" style="width: 90%;"></div>
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
		<?php } ?>
		
	</div><!-- /.row -->
</div>	

