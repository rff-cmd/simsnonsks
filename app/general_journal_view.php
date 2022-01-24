<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "<?php echo obraxabrix('general_journal_view') ?>/xm8r389xemx23xb2378e23/"+id+" ";
		}
	}
</script>

<?php

$from_date		= $_POST['from_date'];
$to_date		= $_POST['to_date'];
$status			= $_POST['status'];
$location_id	= $_POST['location_id'];
$memo			= $_POST['memo'];
$all 			= $_POST['all'];


if($to_date == "") {
	$to_date = date("d-m-Y");	
} else {
	$to_date = date("d-m-Y", strtotime($to_date));	
}

if($from_date == "") {
	/*$from_date = date("d-m-Y", strtotime($to_date . '- 7 day'));	
} else {*/
	$from_date = date("d-m-Y"); //, strtotime($from_date));	
}


$checked = '';
if($all == 1) { $checked = 'checked'; }

?>

<div class="page-content">
	
	<?php
		$delete = $segmen3; //$_REQUEST['mxKz'];
        //$segmen4 = $_REQUEST['id'];
		if ($delete == "xm8r389xemx23xb2378e23") {
			include 'class/class.delete.php';
			$delete2=new delete;
			$delete2->delete_general_journal($segmen4);
	?>
			<div class="alert alert-success">
				<strong>Delete Data successfully</strong>
			</div>
            
            <meta http-equiv="Refresh" content="0;url=<?php echo $nama_folder . '/' . obraxabrix('general_journal_view'); ?>" />
	<?php
            
            
		}
	?>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="widget-box">
            
                <form class="form-horizontal" role="form" action="" method="post" name="delord_view" id="delord_view" class="form-horizontal" >
                    
                    
                    
    				<div class="widget-header">
    					<h4 class="widget-title">Filter</h4>

    					<div class="widget-toolbar">
    						<a href="#" data-action="collapse">
    							<i class="ace-icon fa fa-chevron-up"></i>
    						</a>

    						<a href="#" data-action="close">
    							<i class="ace-icon fa fa-times"></i>
    						</a>
    					</div>
    				</div>

    				<div class="widget-body">
    					<div class="widget-main">
                            
                            <div class="form-group"> 
            					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Dari Tanggal</label>
            					<div class="col-sm-3">
                                    <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" id="from_date" name="from_date" autocomplete="off" value="<?php echo $from_date; ?>">
                                </div>
            				</div>
            				
            				
                            
                            <div class="form-group"> 
            					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">s/d Tanggal</label>
            					<div class="col-sm-3">
                                    <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" id="to_date" name="to_date" autocomplete="off" value="<?php echo $to_date; ?>">
                                </div>
            				</div>
            				
							<?php /*
            				<div class="form-group"> 
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1" >Unit</label> 
								<div class="col-sm-3">
									<select name="location_id" id="location_id" class="chosen-select form-control" style="width:auto;" />
										<option value=""></option>
							              	<?php 
							                    combo_select_active('warehouse','id','name','active','1',$location_id);
							                ?> 
										</select>
								</div>
							</div>
							
							
							<div class="form-group"> 
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Memo</label>
								<div class="col-sm-5">
									<input type="text" id="memo" name="memo" size="35" value="<?php echo $memo ?>" >
			                    </div>
							</div>*/ ?>
                            
            				<div class="form-group"> 
            					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Semua</label>
            					<div class="col-sm-3">
                                    <input class="ace" type="checkbox" name="all" id="all" value="1" <?php echo $checked; ?> /><span class="lbl"></span>
                                </div>
            				</div>
            				
            				<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
            					
            					<input type="submit" name="submit" class='btn btn-primary' value="Preview" onclick="submitForm('find')" />
								
								</div>
            				</div>

    					</div>
    				</div>
                </form>
                
			</div>
		</div><!-- /.span -->
	</div><!-- /.row -->
	
	
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
					  	<th>No. <i class="fa fa-sort"></i></th>
					  	<th>Ref. <i class="fa fa-sort"></i></th>
						<th>Tanggal <i class="fa fa-sort"></i></th>
						<th>Detail Pengeluaran<i class="fa fa-sort"></i></th>
						<th>Jumlah <i class="fa fa-sort"></i></th>
						<th>Edit/Hapus</th>
					  </tr>
					</thead>
					<tbody>
					<?php
						$j = 0;
						$sql=$select->list_general_journal('', $from_date, $to_date, $status, $memo, $all);
						while($row_general_journal=$sql->fetch(PDO::FETCH_OBJ)){
						
						$j++;
						
					?>
					 <tr>
						<td align="center"><?php echo $j ?>.</td>
						<td><?php echo $row_general_journal->ref ?></td>
						<td><?php echo $row_general_journal->date ?></td>
						<td>
							<table width="100%" border="1" style="border: 1px solid #07a035">
								<tr style="background: #3cda25">
                        			<td align="center">No.</td>
                        			<td align="center">Nama Pengeluaran</td>
                        			<td align="center">Jumlah</td>
                        		</tr>
								<?php
									$xn = 0;
									$total_credit = 0;
									$sqldet = $select->list_general_journal_detail($row_general_journal->ref, '', $location_id);
									while($datadet = $sqldet->fetch(PDO::FETCH_OBJ)) {
										$xn++;
										
										$total_credit = $total_credit + $datadet->credit_amount;
								?>
									<tr>
										<td align="center"><?php echo $xn; ?>.</td>
										<td>&nbsp;<?php echo $datadet->name; ?></td>
										<td align="right"><?php echo number_format($datadet->credit_amount,0,'.',','); ?>&nbsp;</td>
									</tr>
								<?php
									}
								?>
							</table>
						</td>
						<td align="right"><?php echo number_format($total_credit,0,'.',',') ?></td>
						<td align="center">
							<?php if (allowupd('frmgeneral_journal')==1) { ?>
								<a href="<?php echo $nama_folder . '/' . obraxabrix('general_journal') ?>/<?php echo $row_general_journal->ref ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
									<span class="green">
										<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
									</span>
								</a>
							
                            <?php } ?>
                            
                            <?php if (allowdel('frmgeneral_journal')==1) { ?>    
                                &nbsp;
								<a href="JavaScript:hapus('<?php echo $row_general_journal->ref ?>')" class="tooltip-error" data-rel="tooltip" title="Delete">
									<span class="red">
										<i class="ace-icon fa fa-trash-o bigger-120"></i>
									</span>
								</a>
                            <?php } ?>
						
						</td>					
					  </tr>
					<?php
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


<!--[if !IE]> -->
<script src="assets/js/jquery.2.1.1.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

<!--[if !IE]> -->
<script type="text/javascript">
	window.jQuery || document.write("<script src='assets/js/jquery.min.js'>"+"<"+"/script>");
</script>


<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="assets/js/bootstrap.min.js"></script>

<script src="assets/js/jquery-ui.custom.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="assets/js/chosen.jquery.min.js"></script>
<script src="assets/js/fuelux.spinner.min.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/bootstrap-timepicker.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/daterangepicker.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/js/jquery.knob.min.js"></script>
<script src="assets/js/jquery.autosize.min.js"></script>
<script src="assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="assets/js/jquery.maskedinput.min.js"></script>
<script src="assets/js/bootstrap-tag.min.js"></script>

<!-- page specific plugin scripts -->
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="assets/js/dataTables.tableTools.min.js"></script>
<script src="assets/js/dataTables.colVis.min.js"></script>

<script src="assets/js/chosen.jquery.min.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/bootstrap-timepicker.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/bootstrap-colorpicker.min.js"></script>

<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>

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
			  null, null, null,   //kalau nambah kolom, null ditambahkan
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
			"sSwfPath": "assets/swf/copy_csv_xls_pdf.swf",
			
			"sRowSelector": "td:not(:last-child)",
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
		
		
		//lookup
		if(!ace.vars['touch']) {
			$('.chosen-select').chosen({allow_single_deselect:true}); 
			//resize the chosen on window resize
	
			$(window)
			.off('resize.chosen')
			.on('resize.chosen', function() {
				$('.chosen-select').each(function() {
					 var $this = $(this);
					 $this.next().css({'width': $this.parent().width()});
				})
			}).trigger('resize.chosen');
			//resize chosen on sidebar collapse/expand
			$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
				if(event_name != 'sidebar_collapsed') return;
				$('.chosen-select').each(function() {
					 var $this = $(this);
					 $this.next().css({'width': $this.parent().width()});
				})
			});
	
	
			$('#chosen-multiple-style .btn').on('click', function(e){
				var target = $(this).find('input[type=radio]');
				var which = parseInt(target.val());
				if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
				 else $('#form-field-select-4').removeClass('tag-input-style');
			});
		}
		//end lookup
		
		
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
    
    //date picker-------------------------------
    //datepicker plugin
//link
$('.date-picker').datepicker({
	autoclose: true,
	todayHighlight: true
})
//show datepicker when clicking on the icon
.next().on(ace.click_event, function(){
	$(this).prev().focus();
});

//or change it into a date range picker
$('.input-daterange').datepicker({autoclose:true});


//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
$('input[name=date-range-picker]').daterangepicker({
	'applyClass' : 'btn-sm btn-success',
	'cancelClass' : 'btn-sm btn-default',
	locale: {
		applyLabel: 'Apply',
		cancelLabel: 'Cancel',
	}
})
.prev().on(ace.click_event, function(){
	$(this).next().focus();
});


$('#timepicker1').timepicker({
	minuteStep: 1,
	showSeconds: true,
	showMeridian: false
}).next().on(ace.click_event, function(){
	$(this).prev().focus();
});

$('#date-timepicker1').datetimepicker().next().on(ace.click_event, function(){
	$(this).prev().focus();
});


$('#colorpicker1').colorpicker();

$('#simple-colorpicker-1').ace_colorpicker();
//$('#simple-colorpicker-1').ace_colorpicker('pick', 2);//select 2nd color
//$('#simple-colorpicker-1').ace_colorpicker('pick', '#fbe983');//select #fbe983 color
//var picker = $('#simple-colorpicker-1').data('ace_colorpicker')
//picker.pick('red', true);//insert the color if it doesn't exist
</script>

	