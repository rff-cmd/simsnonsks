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
							$sqlso=$selectview->item_view($ref);
	    					$row_item=$sqlso->fetch(PDO::FETCH_OBJ);
	    				?>
						<table class="table table-striped table-hover">
							
								<tr>
		                        	<td>
		                        		<?php if($row_item->photo != "") { ?>
	    	                    			
	    	                    			<?php 
	    	                    				$filename = 'photo_item/' . $row_item->photo;
	    	                    				if (file_exists($filename)) {  
	    	                    			?>
	    	                    				<img src="photo_item/<?php echo $row_item->photo ?>" height="300" width="300" />	
	    	                    			<?php } ?>
	    	                    		<?php } ?>
		                        	</td>
		                        </tr>
		                        
	                    </table>
	                    
						</div>
					</div>
				</div>

			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.page-content -->
