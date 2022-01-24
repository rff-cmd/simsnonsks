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

?>

<!-- bootstrap & fontawesome -->
<link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="../assets/font-awesome/4.2.0/css/font-awesome.min.css" />

<!-- page specific plugin styles -->
<link rel="stylesheet" href="../assets/css/jquery-ui.custom.min.css" />
<link rel="stylesheet" href="../assets/css/chosen.min.css" />
<link rel="stylesheet" href="../assets/css/datepicker.min.css" />
<link rel="stylesheet" href="../assets/css/bootstrap-timepicker.min.css" />
<link rel="stylesheet" href="../assets/css/daterangepicker.min.css" />
<link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet" href="../assets/css/colorpicker.min.css" />


<!-- text fonts -->
<link rel="stylesheet" href="../assets/fonts/fonts.googleapis.com.css" />

<!-- ace styles -->
<link rel="stylesheet" href="../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

<!--[if lte IE 9]>
	<link rel="stylesheet" href="../assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
<![endif]-->

<!--[if lte IE 9]>
  <link rel="stylesheet" href="../assets/css/ace-ie.min.css" />
<![endif]-->

<!-- inline styles related to this page -->

<!-- ace settings handler -->
<script src="../assets/js/ace-extra.min.js"></script>


<form name="frm" id="frm" method="post" action="purchase_inv_item_lup.php">

    <script langauge="javascript">
    	function post_value(j){
        	var aa= document.getElementById('frm');
            
        	var zz= "item_code2" + j
            opener.document.purchase_inv.item_code2.value = aa.elements[zz].value;
        	
        	var xx= "item_name" + j
        	opener.document.purchase_inv.item_name.value = aa.elements[xx].value;
            
            var yy= "uom_code" + j
            opener.document.purchase_inv.uom_code.value = aa.elements[yy].value;
            
            var vv= "unit_cost" + j
            opener.document.purchase_inv.unit_cost.value = aa.elements[vv].value;
            
            var ww= "amount" + j
            opener.document.purchase_inv.amount.value = aa.elements[ww].value;
            
            var uu= "item_code" + j
            opener.document.purchase_inv.item_code.value = aa.elements[uu].value;
            
            opener.document.purchase_inv.qty.value = "1";
            
        	self.close();
    	}
    </script>

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
						<table id="dynamic-table" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
		                        	<th>Code</th>
		                        	<th>Code 2</th>
		                        	<th>Item Name</th>
		                        	<th>Sales Unit</th>
		                            <th>Unit Price</th>
		                        	<th>Select</th>
		                        </tr>
	                       </thead>
                      
                      	<tbody>
                      	<?php
                            
    						$sql=$selectview->list_purchase_inv_item_get_cost();
    						while($row_item=$sql->fetch(PDO::FETCH_OBJ)){
    						
                                $current_cost    =    number_format($row_item->current_cost,"2",".",",");                                     		$amount          =    number_format($row_item->current_cost,"2",".",",");
                                
        						$j++;
    						
    					?>
    						   						
    	                    <tr>
                                <td>
                                    <input type="hidden" id="item_code<?php echo $j; ?>" name="item_code<?php echo $j; ?>" value="<?php echo $row_item->syscode ?>" >
                                    <input type="hidden" id="item_code2<?php echo $j; ?>" name="item_code2<?php echo $j; ?>" value="<?php echo $row_item->code ?>" >
                                    <?php echo $row_item->code ?>
                                        
                                </td>
    	                    	<td><?php echo $row_item->old_code ?></td>
    	                    	<td><input type="hidden" id="item_name<?php echo $j; ?>" name="item_name<?php echo $j; ?>" value="<?php echo $row_item->name ?>" ><font style="font-size: auto"><?php echo $row_item->name ?></font></td>
    	                    	<td><input type="hidden" id="uom_code<?php echo $j; ?>" name="uom_code<?php echo $j; ?>" value="<?php echo $row_item->uom_code_sales ?>" ><?php echo $row_item->uom_code_sales ?></td>
                                <td align="right">
                                    <input type="hidden" id="unit_cost<?php echo $j; ?>" name="unit_cost<?php echo $j; ?>" value="<?php echo $current_cost ?>" >
                                    <input type="hidden" id="amount<?php echo $j; ?>" name="amount<?php echo $j; ?>" value="<?php echo $amount ?>" >
                                
                                   <?php echo $current_cost ?>&nbsp;</td>
                                
                                
    	                    	<td align="center"><input type="image" src="../assets/img/icn_edit.png" value="" onClick="post_value(<?php echo $j; ?>);"></td>
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
</form>

<script src="../assets/js/jquery.2.1.1.min.js"></script>

<!--[if !IE]> -->
<script type="text/javascript">
	window.jQuery || document.write("<script src='../assets/js/jquery.min.js'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
window.jQuery || document.write("<script src='../assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="../assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script src="../assets/js/jquery.dataTables.min.js"></script>
<script src="../assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="../assets/js/dataTables.tableTools.min.js"></script>
<script src="../assets/js/dataTables.colVis.min.js"></script>

<!-- ace scripts -->
<script src="../assets/js/ace-elements.min.js"></script>
<script src="../assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
	jQuery(function($) {
		//initiate dataTables plugin
		var oTable1 = 
		$('#dynamic-table')
		//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
		.dataTable( {
			bAutoWidth: false,
			"aoColumns": [
			  { "bSortable": false },
			  null, null, null, null, //kalau nambah kolom, null ditambahkan
			  { "bSortable": false }
			],
			"aaSorting": [],
	
			//,
			//"sScrollY": "200px",
			//"bPaginate": false,
	
			//"sScrollX": "100%",
			//"sScrollXInner": "120%",
			//"bScrollCollapse": true,
			//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
			//you may want to wrap the table inside a "div.dataTables_borderWrap" element
	
			//"iDisplayLength": 50
	    } );
		//oTable1.fnAdjustColumnSizing();
	
	
		//TableTools settings
		TableTools.classes.container = "btn-group btn-overlap";
		TableTools.classes.print = {
			"body": "DTTT_Print",
			"info": "tableTools-alert gritter-item-wrapper gritter-info gritter-center white",
			"message": "tableTools-print-navbar"
		}
	
		//initiate TableTools extension
		var tableTools_obj = new $.fn.dataTable.TableTools( oTable1, {
			"sSwfPath": "../assets/swf/copy_csv_xls_pdf.swf",
			
			"sRowSelector": "td:not(:lasset_type-child)",
			"sRowSelect": "multi",
			"fnRowSelected": function(row) {
				//check checkbox when row is selected
				try { $(row).find('input[type=checkbox]').get(0).checked = true }
				catch(e) {}
			},
			"fnRowDeselected": function(row) {
				//uncheck checkbox
				try { $(row).find('input[type=checkbox]').get(0).checked = false }
				catch(e) {}
			},
	
			"sSelectedClass": "success",
	        "aButtons": [
				{
					"sExtends": "copy",
					"sToolTip": "Copy to clipboard",
					"sButtonClass": "btn btn-white btn-primary btn-bold",
					"sButtonText": "<i class='fa fa-copy bigger-110 pink'></i>",
					"fnComplete": function() {
						this.fnInfo( '<h3 class="no-margin-top smaller">Table copied</h3>\
							<p>Copied '+(oTable1.fnSettings().fnRecordsTotal())+' row(s) to the clipboard.</p>',
							1500
						);
					}
				},
				
				{
					"sExtends": "csv",
					"sToolTip": "Export to CSV",
					"sButtonClass": "btn btn-white btn-primary  btn-bold",
					"sButtonText": "<i class='fa fa-file-excel-o bigger-110 green'></i>"
				},
				
				{
					"sExtends": "pdf",
					"sToolTip": "Export to PDF",
					"sButtonClass": "btn btn-white btn-primary  btn-bold",
					"sButtonText": "<i class='fa fa-file-pdf-o bigger-110 red'></i>"
				},
				
				{
					"sExtends": "print",
					"sToolTip": "Print view",
					"sButtonClass": "btn btn-white btn-primary  btn-bold",
					"sButtonText": "<i class='fa fa-print bigger-110 grey'></i>",
					
					"sMessage": "<div class='navbar navbar-default'><div class='navbar-header pull-left'><a class='navbar-brand' href='#'><small>Optional Navbar &amp; Text</small></a></div></div>",
					
					"sInfo": "<h3 class='no-margin-top'>Print view</h3>\
							  <p>Please use your browser's print function to\
							  print this table.\
							  <br />Press <b>escape</b> when finished.</p>",
				}
	        ]
	    } );
		//we put a container before our table and append TableTools element to it
	    $(tableTools_obj.fnContainer()).appendTo($('.tableTools-container'));
		
		//also add tooltips to table tools buttons
		//addding tooltips directly to "A" buttons results in buttons disappearing (weired! don't know why!)
		//so we add tooltips to the "DIV" child after it becomes inserted
		//flash objects inside table tools buttons are inserted with some delay (100ms) (for some reason)
		setTimeout(function() {
			$(tableTools_obj.fnContainer()).find('a.DTTT_button').each(function() {
				var div = $(this).find('> div');
				if(div.length > 0) div.tooltip({container: 'body'});
				else $(this).tooltip({container: 'body'});
			});
		}, 200);
		
		
		
		//ColVis extension
		var colvis = new $.fn.dataTable.ColVis( oTable1, {
			"buttonText": "<i class='fa fa-search'></i>",
			"aiExclude": [0, 20],
			"bShowAll": true,
			//"bRestore": true,
			"sAlign": "right",
			"fnLabel": function(i, title, th) {
				return $(th).text();//remove icons, etc
			}
			
		}); 
		
		//style it
		$(colvis.button()).addClass('btn-group').find('button').addClass('btn btn-white btn-info btn-bold')
		
		//and append it to our table tools btn-group, also add tooltip
		$(colvis.button())
		.prependTo('.tableTools-container .btn-group')
		.attr('title', 'Show/hide columns').tooltip({container: 'body'});
		
		//and make the list, buttons and checkboxed Ace-like
		$(colvis.dom.collection)
		.addClass('dropdown-menu dropdown-light dropdown-caret dropdown-caret-right')
		.find('li').wrapInner('<a href="javascript:void(0)" />') //'A' tag is required for better styling
		.find('input[type=checkbox]').addClass('ace').next().addClass('lbl padding-8');
	
	
		
		/////////////////////////////////
		//table checkboxes
		$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
		
		//select/deselect all rows according to table header checkbox
		$('#dynamic-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
			var th_checked = this.checked;//checkbox inside "TH" table header
			
			$(this).closest('table').find('tbody > tr').each(function(){
				var row = this;
				if(th_checked) tableTools_obj.fnSelect(row);
				else tableTools_obj.fnDeselect(row);
			});
		});
		
		//select/deselect a row when the checkbox is checked/unchecked
		$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
			var row = $(this).closest('tr').get(0);
			if(!this.checked) tableTools_obj.fnSelect(row);
			else tableTools_obj.fnDeselect($(this).closest('tr').get(0));
		});
		
	
		
		
			$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
			e.stopImmediatePropagation();
			e.stopPropagation();
			e.preventDefault();
		});
		
		
		//And for the first simple table, which doesn't have TableTools or dataTables
		//select/deselect all rows according to table header checkbox
		var active_class = 'active';
		$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
			var th_checked = this.checked;//checkbox inside "TH" table header
			
			$(this).closest('table').find('tbody > tr').each(function(){
				var row = this;
				if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
				else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
			});
		});
		
		//select/deselect a row when the checkbox is checked/unchecked
		$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
			var $row = $(this).closest('tr');
			if(this.checked) $row.addClass(active_class);
			else $row.removeClass(active_class);
		});
	
		
	
		/********************************/
		//add tooltip for small view action buttons in dropdown menu
		$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
		
		//tooltip placement on right or left
		function tooltip_placement(context, source) {
			var $source = $(source);
			var $parent = $source.closest('table')
			var off1 = $parent.offset();
			var w1 = $parent.width();
	
			var off2 = $source.offset();
			//var w2 = $source.width();
	
			if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
			return 'left';
		}
	
	})
</script>
