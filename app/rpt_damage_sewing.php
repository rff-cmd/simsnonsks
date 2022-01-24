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
						
						<?php
							if( substr($ref,0,3) == "SEW") {
								$sqlso=$select->list_sewing($ref);
							}
							if( substr($ref,0,3) == "CNT") {
								$sqlso=$select->list_counting($ref);
							}
							
	    					$row_so=$sqlso->fetch(PDO::FETCH_OBJ);
	    				?>
						<table class="table table-striped table-hover">
							<body>
								<tr>
		                        	<td width="15%">Nama Brand</td>
		                        	<td width="2%">:</td>
		                        	<td><?php echo $row_so->client_name ?></td>
		                        </tr>
		                        <tr>
		                        	<td width="15%">Tanggal Press</td>
		                        	<td width="2%">:</td>
		                        	<td><?php echo date("d-m-Y", strtotime($row_so->date)) ?></td>
		                        </tr>
		                        <tr>
		                        	<td width="15%">No. PO</td>
		                        	<td width="2%">:</td>
		                        	<td><?php echo $row_so->so_ref ?></td>
		                        </tr>
		                        
	                       </body>
	                    </table>
	                    
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
		                        	<td align="center" rowspan="2">No.</td>
		                        	<td align="center" rowspan="2">Kode Artikel</td>
		                        	<td align="center" rowspan="2">Artikel</td>
		                        	<td align="center" rowspan="2">Ukuran</td>
		                        	<td align="center" rowspan="2">Jumlah Cacat</td>
		                        	<td align="center" rowspan="2">Status Cacat</td>
		                        </tr>
	                       </thead>
                      
	                      	<tbody>
	                      	<?php
	                            
	                            if( substr($ref,0,3) == "SEW") {
	    							$sql=$selectview->rpt_damage_detail($ref);
								}
								if( substr($ref,0,3) == "CNT") {
									$sql=$selectview->rpt_counting_detail($ref);
								}
								
	    						while($row_item=$sql->fetch(PDO::FETCH_OBJ)){
	    						
	        						$j++;
	    						
	    					?>
	    						   						
	    	                    <tr>
	                                <td valign="middle" align="center"><?php echo $j ?></td>
	                                <td><?php echo $row_item->code ?></td>
	                                <td><?php echo $row_item->item_name ?></td>
	    	                    	<td><?php echo $row_item->size ?></td>
	    	                    	<td align="center"><?php echo number_format($row_item->qty_damaged,0,'.',',') ?></td>
	    	                    	<td><?php echo $row_item->status_damaged ?></td>
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
