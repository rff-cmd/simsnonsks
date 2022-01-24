<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include_once ("include/queryfunctions.php");
include_once ("include/functions.php");
include_once ("include/inword.php");
include 'class/class.select.php';
include 'class/class.selectview.php';

$select = new select;
$selectview = new selectview;

$from_date	            =    $_GET['from_date'];
$to_date		    	=    $_GET['to_date'];
$client_code          	=    $_GET['client_code'];
$status					=	 $_GET["status"];
$all			       	=    $_GET['all'];

?>

<!-- bootstrap & fontawesome -->
<link rel="stylesheet" href="../../<?php echo $__folder ?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="../../<?php echo $__folder ?>assets/font-awesome/4.2.0/css/font-awesome.min.css" />

<!-- page specific plugin styles -->
<link rel="stylesheet" href="../../<?php echo $__folder ?>assets/css/jquery-ui.custom.min.css" />
<link rel="stylesheet" href="../../<?php echo $__folder ?>assets/css/chosen.min.css" />
<link rel="stylesheet" href="../../<?php echo $__folder ?>assets/css/datepicker.min.css" />
<link rel="stylesheet" href="../../<?php echo $__folder ?>assets/css/bootstrap-timepicker.min.css" />
<link rel="stylesheet" href="../../<?php echo $__folder ?>assets/css/daterangepicker.min.css" />
<link rel="stylesheet" href="../../<?php echo $__folder ?>assets/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet" href="../../<?php echo $__folder ?>assets/css/colorpicker.min.css" />


<!-- text fonts -->
<link rel="stylesheet" href="../../<?php echo $__folder ?>assets/fonts/fonts.googleapis.com.css" />

<!-- ace styles -->
<link rel="stylesheet" href="../../<?php echo $__folder ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />


<!-- ace settings handler -->
<script src="../../<?php echo $__folder ?>assets/js/ace-extra.min.js"></script>


<div class="page-content">						
	<div class="row">
		<div class="col-xs-12">
      <!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-xs-12">
					<div class="clearfix">
						<div class="pull-right tableTools-container"></div>
					</div>
					<!-- div.dataTables_borderWrap -->
					<div>
						<?php
							$sqlso=$select->list_client($client_code);
	    					$row_client=$sqlso->fetch(PDO::FETCH_OBJ);
	    				?>
	    				
						<table class="table table-striped table-hover">
							<body>
								<tr>
		                        	<td><?php echo $row_client->name ?></td>
		                        </tr>
	                       </body>
	                    </table>
	                    
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
		                        	<th class="center" style="font-weight:bold ">No.</th>
                                    <th><?php if($lng==1) { echo 'Date'; } else { echo 'Tanggal'; } ?></th>
									<th><?php if($lng==1) { echo 'Item Name'; } else { echo 'Nama Artikel'; } ?></th>
									<th><?php if($lng==1) { echo 'Press Date'; } else { echo 'Batch'; } ?></th>
									<th><?php if($lng==1) { echo 'Qty Counting'; } else { echo 'Counting'; } ?></th>
									<th><?php if($lng==1) { echo 'Qty Sewing'; } else { echo 'Jahit'; } ?></th>
									<th><?php if($lng==1) { echo 'Qty Plus Minus'; } else { echo 'Kurang/Lebih'; } ?></th>
									<th><?php if($lng==1) { echo 'DO Date'; } else { echo 'Tgl Kirim'; } ?></th>
		                        </tr>
	                       </thead>
                      
	                      	<tbody>
	                      	<?php
	                            
	    						$sql=$selectview->rpt_sales_order_customer($kode, $from_date, $to_date, $client_code, $status, $all);
	    						while($row_sales_order=$sql->fetch(PDO::FETCH_OBJ)){
						            	
					            	$press_date = date("d-m-Y", strtotime($row_sales_order->press_date));
					            	if($press_date == "01-01-1970") {
										$press_date = "";
									}
									
									$do_date = date("d-m-Y", strtotime($row_sales_order->do_date));
					            	if($do_date == "01-01-1970") {
										$do_date = "";
									}
        						
            						$i++;
	    						
	    					?>
	    						   						
	    	                    <tr>
	                                <td><?php echo $i ?></td> 
                                    <td><?php echo date("d-m-Y", strtotime($row_sales_order->date)) ?></td>
									<td><?php echo $row_sales_order->item_name ?></td>
									<td><?php echo $row_sales_order->ref ?></td>
									<td align="center"><?php echo number_format($row_sales_order->qty_counting,0,'.',',') ?></td>
									<td align="center"><?php echo number_format($row_sales_order->qty_sewing,0,'.',',') ?></td>            						
									<td></td>
            						<td><?php echo $do_date ?></td>
	    	                    </tr>
	                        
	                        <?php } ?>
	                        
	                     		</tbody>
							</table>
						</div>
					</div>
				</div>

			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.page-content -->
