<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include_once ("include/queryfunctions.php");
include_once ("include/functions.php");
include_once ("include/inword.php");

include 'class/class.selectview.php';

$selectview = new selectview;

$ref	= $_GET['ref'];

?>

<!-- bootstrap & fontawesome -->
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/font-awesome/4.2.0/css/font-awesome.min.css" />

<!-- page specific plugin styles -->
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/jquery-ui.custom.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/chosen.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/datepicker.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/bootstrap-timepicker.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/daterangepicker.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/colorpicker.min.css" />


<!-- text fonts -->
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/fonts/fonts.googleapis.com.css" />

<!-- ace styles -->
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />


<!-- ace settings handler -->
<script src="../<?php echo $__folder ?>assets/js/ace-extra.min.js"></script>


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
							$sqlso=$selectview->rpt_sales_order($ref);
	    					$row_so=$sqlso->fetch(PDO::FETCH_OBJ);
	    				?>
						<table class="table table-striped table-hover">
							<body>
								<tr>
		                        	<td width="15%">No. PO</td>
		                        	<td width="2%">:</td>
		                        	<td><?php echo $row_so->ref ?></td>
		                        </tr>
								<tr>
		                        	<td width="15%">Nama Brand</td>
		                        	<td width="2%">:</td>
		                        	<td><?php echo $row_so->client_name ?></td>
		                        </tr>
		                        <tr>
		                        	<td width="15%">Tanggal Transfer</td>
		                        	<td width="2%">:</td>
		                        	<td><?php echo date("d-m-Y", strtotime($row_so->transfer_date)) ?></td>
		                        </tr>
		                        <tr>
		                        	<td width="15%">Tanggal PO</td>
		                        	<td width="2%">:</td>
		                        	<td><?php echo date("d-m-Y", strtotime($row_so->date)) ?></td>
		                        </tr>
		                        <tr>
		                        	<td width="15%">Tanggal Deadline</td>
		                        	<td width="2%">:</td>
		                        	<td><?php echo date("d-m-Y", strtotime($row_so->due_date)) ?></td>
		                        </tr>
		                        
		                        
	                       </body>
	                    </table>
	                    
						<table class="table table-striped table-bordered table-hover">
							<thead>
								
								<?php
									$sql_mcn = $selectview->list_machine();
									$count_mcn = $sql_mcn->rowCount();
									
									$sql_mcn_press = $selectview->list_machine_press();
									$count_mcn_press = $sql_mcn_press->rowCount();
								?>
								<tr>
		                        	<td align="center" rowspan="2">No.</td>
		                        	<td align="center" rowspan="2">Artikel/Keterangan</td>
		                        	<td align="center" rowspan="2">Photo</td>
		                        	<td align="center" rowspan="2">Ukuran</td>
		                        	<td align="center" rowspan="2">JML</td>
		                        	<td align="center" colspan="<?php echo $count_mcn ?>">Print</td>
		                        	<td align="center" colspan="<?php echo $count_mcn_press ?>">Press/Cacat</td>
		                        	<td align="center" rowspan="2">Counting/<br>Cacat</td>
		                        	<td align="center" rowspan="2">Jahit/<br>Cacat</td>
		                        	<!--<td align="center" colspan="2">Koreksi</td>-->
		                        	<td valign="bottom" align="center" rowspan="2">Total<br>Kurang</td>
		                        </tr>
		                        
		                        <tr>
		                        	<?php
		                        		$machine_id = array();
		                        		while($data_machine = $sql_mcn->fetch(PDO::FETCH_OBJ)) {
											$machine_id[] = $data_machine->id;
		                        	?>
		                        			<td align="center"><?php echo $data_machine->code ?></td>
		                        	<?php
										}
		                        	?>
		                        	
		                        	<?php
		                        		$machine_press_id = array();
		                        		while($data_machine_press = $sql_mcn_press->fetch(PDO::FETCH_OBJ)) {
											$machine_press_id[] = $data_machine_press->id;
		                        	?>
		                        			<td align="center"><?php echo $data_machine_press->code ?></td>
		                        	<?php
										}
		                        	?>
		                        	
		                        	
		                        </tr>
	                       </thead>
                      
	                      	<tbody>
	                      	<?php
	                      		$item_code = array();
	                      		$total_so = 0;
	                      		$total_counting = 0;
	                      		
	                            $sql=$selectview->rpt_sales_order_detail($ref);
	                            $numrows = $sql->rowCount();
	    						while($row_item=$sql->fetch(PDO::FETCH_OBJ)){
	    						
	        						$j++;
	        						
	        						$qty_so = $row_item->qty;
	        						
	        						//set total
	        						$item_code[]=	$row_item->item_code;
	        						$total_so	=	$total_so + $row_item->qty;
	    						
	    					?>
	    						   						
	    	                    <tr>
	                                <td valign="middle" align="center"><?php echo $j ?></td>
	                                <td><?php echo $row_item->item_name ?></td>
	    	                    	<td align="center">
	    	                    		<?php if($row_item->photo != "") { ?>
	    	                    			
	    	                    			<?php 
	    	                    				$filename = 'photo_item/' . $row_item->photo;
	    	                    				if (file_exists($filename)) {  
	    	                    			?>
	    	                    				<img src="photo_item/<?php echo $row_item->photo ?>" height="100" width="100" />	
	    	                    			<?php } ?>
	    	                    		<?php } ?>
	    	                    	</td>
	    	                    	<td><?php echo $row_item->size ?></td>
	    	                    	<td align="center"><?php echo number_format($row_item->qty,0,'.',',') ?></td>
	    	                    	
	    	                    	<?php
	    	                    		$f=0;
	    	                    		for($f=0; $f<=count($machine_id)-1; $f++) {
	    	                    			
	    	                    			$sql_qty = $selectview->rpt_sales_order_print($ref, $row_item->item_code, $machine_id[$f]);
	    	                    			$data_qty = $sql_qty->fetch(PDO::FETCH_OBJ);
	    	                    			
	    	                    	?>
	    	                    				<td align="center"><?php echo number_format($data_qty->qty,0,'.',',') ?></td>
	    	                    	<?php
	    	                    		}
	    	                    	?>
	    	                    	
	    	                    	<?php
	    	                    		$f=0;
	    	                    		for($f=0; $f<=count($machine_press_id)-1; $f++) {
	    	                    			$sql_qty = $selectview->rpt_sales_order_press($ref, $row_item->item_code, $machine_press_id[$f]);
	    	                    			$data_qty = $sql_qty->fetch(PDO::FETCH_OBJ);
	    	                    			
	    	                    	?>
	    	                    				<td align="center">
	    	                    					<?php echo number_format($data_qty->qty,0,'.',',') ?>/
	    	                    					<?php echo number_format($data_qty->qty_damaged,0,'.',',') ?>	
	    	                    				</td>
	    	                    	<?php
	    	                    		}
	    	                    	?>
	    	                    	
	    	                    	<?php	
    	                    			$sql_qty = $selectview->rpt_sales_order_counting($ref, $row_item->item_code);
    	                    			$data_qty = $sql_qty->fetch(PDO::FETCH_OBJ);
    	                    			
    	                    			$qty_counting = $data_qty->qty;
    	                    			$qty_counting_damaged = $data_qty->qty_damaged;
    	                    			
    	                    			//set total
    	                    			$total_counting = $total_counting + $data_qty->qty;
    	                    			$total_counting_damaged = $total_counting_damaged + $data_qty->qty_damaged;
	    	                    	?>
	    	                    	<td align="center">
	    	                    		<?php echo number_format($data_qty->qty,0,'.',',') ?>/
	    	                    		<?php echo number_format($data_qty->qty_damaged,0,'.',',') ?>
	    	                    	</td>
	    	                    	
	    	                    	<?php	
    	                    			$sql_qty = $selectview->rpt_sales_order_sewing($ref, $row_item->item_code);
    	                    			$data_qty = $sql_qty->fetch(PDO::FETCH_OBJ);
    	                    			
    	                    			$total_sewing = $total_sewing + $data_qty->qty;
    	                    			$total_sewing_damaged = $total_sewing_damaged + $data_qty->qty_damaged;
    	                    			
	    	                    	?>
	    	                    	<td align="center">
	    	                    		<?php echo number_format($data_qty->qty,0,'.',',') ?>/
	    	                    		<?php echo number_format($data_qty->qty_damaged,0,'.',',') ?>
	    	                    	</td>
	    	                    			    	                    	
	    	                    	<td align="center">
	    	                    		<?php 
	    	                    			echo number_format($qty_so - $qty_counting - $qty_counting_damaged,0,'.',',');
	    	                    			$total_kurang = $total_kurang +  ($qty_so - $qty_counting - $qty_counting_damaged);
	    	                    		?>
	    	                    	</td>
	    	                    </tr>
	                        
	                        <?php } ?>
	                        
	                        
	                        	<tr>
		                        	<td align="center" colspan="4">TOTAL</td>
		                        	<td align="center"><?php echo number_format($total_so,0,'.',',') ?></td>
		                        	
		                        	<?php	
		                        		$f=0;
	    	                    		for($f=0; $f<=count($machine_id)-1; $f++) {
	    	                    			
	    	                    			$qty_machine = $selectview->rpt_sales_order_print_per_machine($ref, $machine_id[$f])
	    	                    	?>
	    	                    			<td align="center"><?php echo number_format($qty_machine,0,'.',',') ?></td>
	    	                    	<?php
										
	    	                    		}
	    	                    	?>
	    	                    	
	    	                    	
	    	                    	<?php
	    	                    		$f=0;
	    	                    		for($f=0; $f<=count($machine_press_id)-1; $f++) {
	    	                    			
	    	                    			$qty_exp = array();
	    	                    			$qty_machine_press1 = $selectview->rpt_sales_order_press_per_machine($ref, $machine_press_id[$f]);
	    	                    			
	    	                    			$qty_exp = explode("|", $qty_machine_press1);
	    	                    				
	    	                    	?>
	    	                    				<td align="center">
	    	                    					<?php //if(count($qty_exp)>0) { ?>
		    	                    					<?php echo number_format($qty_exp[0],0,'.',',') ?>/
		    	                    					<?php echo number_format($qty_exp[1],0,'.',',') ?>	
		    	                    				<?php //} ?>
	    	                    				</td>
	    	                    	<?php
	    	                    		}
	    	                    	?>
	    	                    	
	    	                    	<td align="center"><?php echo number_format($total_counting,0,'.',',') ?>/
		                        		<?php echo number_format($total_counting_damaged,0,'.',',') ?></td>
		                        	<td align="center"><?php echo number_format($total_sewing,0,'.',',') ?>/
		                        		<?php echo number_format($total_sewing_damaged,0,'.',',') ?></td>
		                        	<td align="center">
		                        		<?php echo number_format($total_kurang,0,'.',',') ?>
		                        	</td>
		                        </tr>
	                        
	                     		</tbody>
							</table>
						</div>
					</div>
				</div>

			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.page-content -->
