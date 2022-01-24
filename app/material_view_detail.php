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

$select = new select;

$ref	= $_GET['ref'];

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
						
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
		                        	<td align="center">No.</td>
		                        	<td align="center">Barcode</td>
		                        	<td align="center">Jenis Kain</td>
		                        	<td align="center">Jumlah (Yard)</td>
		                        </tr>
		                        
	                       </thead>
                      
	                      	<tbody>
	                      	<?php
	                      		$total_yard = 0;
	                            $sql2 = $select->list_purchase_inv_detail($ref);
	    						while($row_purchase_inv_det=$sql2->fetch(PDO::FETCH_OBJ)) {
	    						
	        						$j++;
	    						
	    							$total_yard = $total_yard + $row_purchase_inv_det->qty;
	    							
	    							$uom_name = $row_purchase_inv_det->uom_name;
	    					?>
	    						   						
	    	                    <tr>
	                                <td align="center"><?php echo $j; ?>.</td>
                        			<td>&nbsp;<?php echo $row_purchase_inv_det->old_code ?></td>
                        			<td>&nbsp;<?php echo $row_purchase_inv_det->item_name ?></td>
                        			<td align="center"><?php echo number_format($row_purchase_inv_det->qty,3,".",",") . ' ' . $row_purchase_inv_det->uom_code_stock . ' ' . $row_purchase_inv_det->uom_name ?> </td>
	    	                    </tr>
	                        
	                        <?php } ?>
	                        
	                        	<tr>
	                                <td align="right" colspan="3">TOTAL&nbsp;</td>
                        			<td align="center"><?php echo number_format($total_yard,3,".",",") . ' ' . $row_purchase_inv_det->uom_code_stock . ' ' . $uom_name ?> </td>
	    	                    </tr>
	                        
	                     		</tbody>
							</table>
						</div>
					</div>
				</div>

			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.page-content -->
