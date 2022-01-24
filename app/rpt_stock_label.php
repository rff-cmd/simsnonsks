<script type="text/javascript" src="js/buttonajax.js"></script>

<script>
	var item_code = ''; 
	var item_code3 = '';
	
	function checklist(lne) {
		
		var slc = document.getElementById('cetak_' + lne).checked;
		
		if (slc) {
			
			item_code3 = document.getElementById('item_code_' + lne).value;
			item_code = item_code.replace(item_code3,"");
			
			item_code = item_code + '|' + document.getElementById('item_code_' + lne).value;
			
			$('#item_code_id').html('<input type="hidden" size="100" id="item_code4" name="item_code4" value="'+ item_code +'" >');
			
		} else {
			
			item_code3 = document.getElementById('item_code_' + lne).value;
			item_code = item_code.replace(item_code3,"");
			
			$('#item_code_id').html('<input type="hidden" size="100" id="item_code4" name="item_code4" value="'+ item_code +'" >');
			
		}
		
	}
</script>


<script>
	var item_code = ''; 
	var item_code3 = '';
	
	function checklistall(rows) {
		
		var slc = false;
		//alert(rows);
		for(lne=0; lne<rows; lne++) {
			/*alert(lne);
			checklist(lne);*/
			
			/*slc = document.getElementById('cetak_' + lne).checked;
			
			if (slc) {*/
				
				/*item_code3 = document.getElementById('item_code_' + lne).value;
				item_code = item_code.replace(item_code3,"");
				
				item_code = item_code + '|' + document.getElementById('item_code_' + lne).value;
				
				$('#item_code_id').html('<input type="hidden" size="100" id="item_code4" name="item_code4" value="'+ item_code +'" >');*/
				
			/*} else {
				
				item_code3 = document.getElementById('item_code_' + lne).value;
				item_code = item_code.replace(item_code3,"");
				
				$('#item_code_id').html('<input type="hidden" size="100" id="item_code4" name="item_code4" value="'+ item_code +'" >');
				
			}*/
		}
		
	}
</script>


<script language="javascript">
	function submitForm(tipe)
    {
		
		if(tipe == 'label_view') {
			//document.getElementById("delord_view").action = "app/delord_print.php";
			$("#rpt_stock_label").attr('action', 'app/rpt_stock_harga.php')
			   .attr('target', '_BLANK');
			$("#rpt_stock_label").submit();
		}
		
		
		if(tipe == 'label_pdf') {
			//document.getElementById("delord_view").action = "app/delord_print.php";
			$("#rpt_stock_label").attr('action', 'app/rpt_stock_harga_pdf.php')
			   .attr('target', '_BLANK');
			$("#rpt_stock_label").submit();
		}
		
  		return false;	 
    }		
    
    if(tipe == 'preview') {
		//document.getElementById("delord_view").action = "app/delord_print.php";
		$("#rpt_stock_label").attr('action', '')
			.attr('target', '_self');
		$("#rpt_stock_label").submit();
	}
	
    function focusNext(elemName, evt) 
	{
	    evt = (evt) ? evt : event;
	    var charCode = (evt.charCode) ? evt.charCode :
	        ((evt.which) ? evt.which : evt.keyCode);
	    if (charCode == 13) 
		 {
			document.getElementById(elemName).focus();
	      return false;
	    }
	    return true;
	}
	
</script>

<script type="text/javascript">
	function excel_export() {
		item_code			=	document.getElementById('item_code').value;
		location_id			=	document.getElementById('location_id').value;
		uom_code			=	document.getElementById('uom_code').value;
		item_group_id		=	document.getElementById('item_group_id').value;
		//item_subgroup_id	=	document.getElementById('item_subgroup_id').value;
		date_from			=	document.getElementById('date_from').value;
		date_to				=	document.getElementById('date_to').value;
		all					=	document.getElementById('all').checked;
		
		if(all == true) { all = 1}
		if(all == false) { all = 0}
		
		document.location.href = "app/rpt_stock_xls.php?item_code="+item_code+"&location_id="+location_id+"&uom_code="+uom_code+"&date_from="+date_from+"&date_to="+date_to+"&all="+all+"&item_group_id="+item_group_id;	
	}
</script>


<script type="text/javascript">
	function cetak_label() {
		
		item_code_id		=	document.getElementById('item_code_id').value;
		
		document.location.href = "app/rpt_stock_harga.php?item_code_id="+item_code_id;	
	}
</script>

<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost2(URL, destination, button, getId){        
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;		
		//str ='pchordnbr2='+ document.getElementById('pchordnbr2').value;
		var str = str + '&button=' + button;
		
		if (window.XMLHttpRequest){
			request = new XMLHttpRequest();
			request.onreadystatechange = processStateChange;
			request.open("POST", URL, true);
			request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
			request.send(str);		
					
		} else if (window.ActiveXObject) {
			request = new ActiveXObject("Microsoft.XMLHTTP");
			if (request) {
				request.onreadystatechange = processStateChange;
				request.open("POST", URL, true);
				request.send();				
			}
		}
				
	}
	 
</script>

<?php

$item_code2		= $_REQUEST['item_code2'];
$item_code		= $_REQUEST['item_code'];
$location_id	= $_REQUEST['location_id'];
$uom_code		= $_REQUEST['uom_code'];
$date_from		= $_REQUEST['date_from'];
$date_to		= $_REQUEST['date_to'];
$item_group_id	= $_REQUEST['item_group_id'];
$item_subgroup_id		= $_REQUEST['item_subgroup_id'];
$all		= $_REQUEST['all'];


if($date_from == "") {
	$date_from = "";
}

if($date_to == "") {
	$date_to = "";
}

?>   
					
<div class="page-content">
	
	<div class="row">
		<div class="col-xs-12">
		
			<form class="form-horizontal" role="form" action="" method="post" name="rpt_stock" id="rpt_stock" class="form-horizontal" enctype="multipart/form-data" >
				
				<div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right">Code/Barcode Barang</label>
                    <div class="col-sm-4">
                      <input type="text" id="item_code2" name="item_code2" style="font-size: 18px; min-width: 100px" class="form-control" autofocus="" onKeyPress="return focusNext('submit',event)" value="" >
					</div>
				</div>
				
				
				
				<div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right">Nama Barang</label>
                    <div class="col-sm-4">
                      <select id="item_code" name="item_code" data-placeholder="..." class="chosen-select form-control" style="width: auto">
                      	<option value=""></option>
                        <?php select_item($item_code) ?>	                            
                      </select>
					</div>
				</div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right">Kelompok</label>
                    <div class="col-sm-4">
                      <select id="item_group_id" name="item_group_id" data-placeholder="..." class="chosen-select form-control" onchange="loadHTMLPost2('app/item_ajax.php','item_subgroup_id2','getsubgroup_id','item_group_id')" style="width: auto" >
                        <option value=""></option>
                        <?php 
                        	combo_select_active("item_group","id","name","active","1",$item_group_id) 
                        ?>	                            
                      </select>
					</div>
				</div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right">Satuan</label>
                    <div class="col-sm-4">
                      <select id="uom_code" name="uom_code" data-placeholder="..." class="chosen-select form-control" style="width: auto">
                      	<option value=""></option>
                        <?php select_uom($uom_code) ?>	                            
                      </select>
					</div>
				</div>
				
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'From Date'; } else { echo 'Dari Tanggal'; } ?></label>
					<div class="col-sm-3">
						<input type="text" id="date_from" name="date_from" style="font-size: 12px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $date_from ?>">								
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'To Date'; } else { echo 's/d Tanggal'; } ?></label>
					<div class="col-sm-3">
						<input type="text" id="date_to" name="date_to" style="font-size: 12px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $date_to ?>">								
					</div>
				</div>
				
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Semua</label>
					<div class="col-sm-4">
						<input type="checkbox" name="all" id="all" class="ace" value="1" /><span class="lbl"></span>								
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">&nbsp;</label>
	                <div class="col-sm-3">
	                  <input type="submit" name="submit" id="submit" class='btn btn-primary' value="Preview" onclick="submitForm('preview')" />
					</div>
			   </div>
				
              <!--<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">&nbsp;</label>
	                <div class="col-sm-3">
	                  <input type="submit" name="submit" id="submit" class='btn btn-primary' value="Cetak Label" onclick="submitForm('label_view')" />
					</div>
			  </div>-->
			  				  
					  								
				
			</form>
		
		</div>
	</div>
	
	
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-xs-12">
					
					<form role="form" action="" method="post" name="rpt_stock_label" id="rpt_stock_label" enctype="multipart/form-data" />
						
					<div class="form-group">
						<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Cetak Label" onclick="submitForm('label_view')" />
						
						<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Cetak Label PDF" onclick="submitForm('label_pdf')" />
					</div>
					
					<table id="simple-table" class="table table-striped table-bordered table-hover" style="font-size: 12px">
						<?php
							$sql = $selectview->list_item_label($item_code, $uom_code, $item_group_id, $item_subgroup_id, $all, $item_code2, $date_from, $date_to);	
							$jmldata = $sql->rowCount();
						?>
						
						<input type="hidden" id="jml" name="jml" value="<?php echo $jmldata ?>" />
						
						<thead>
							<tr>
								<th>No. <i class="fa fa-sort"></i></th>
                                <th class="center">
									<label class="pos-rel">
										<input type="checkbox" id="cetakall" name="cetakall" class="ace" value="1" onClick="checklistall(<?php echo $jmldata ?>)" /><span class="lbl"></span>
									</label>
								</th>
                                <th>Kode Barang <i class="fa fa-sort"></i></th>
								<th>Barcode <i class="fa fa-sort"></i></th>
								<th>Kelompok <i class="fa fa-sort"></i></th>
								<th>Nama Barang <i class="fa fa-sort"></i></th>
                                    
							</tr>
						</thead>

						<tbody>
							<?php			
								$j = 0;
								while ($rpt_item_view=$sql->fetch(PDO::FETCH_OBJ)) {
									
								$j++;
									
							?>
                                    
                                     <input type="hidden" name="item_code_<?php echo $j; ?>" id="item_code_<?php echo $j; ?>" value="<?php echo $rpt_item_view->syscode ?>" />
                                       
									 <tr>   
									 	<td><?php echo $j ?></td>
									 	<td align="center">
											<label class="pos-rel">
												<input type="checkbox" id="cetak_<?php echo $j; ?>" name="cetak_<?php echo $j; ?>" class="ace" value="1" onClick="checklist(<?php echo $j ?>)" /><span class="lbl"></span>
											</label>
											
										</td>
										  
									    <td><?php echo $rpt_item_view->code ?></td>
										<td><?php echo $rpt_item_view->old_code ?></td>
										<td><?php echo $rpt_item_view->item_group_name ?></td>
										<td><?php echo $rpt_item_view->name ?></td>
										
									</tr>	
									    
                                <?php
                                    }
                                ?>
                                
                                <tr style="font-size: 18px; font-weight: bold;">
                                	<td colspan="5" align="right">Total Data</td>
                                	<td><?php echo $jmldata ?></td>
                                </tr>
						</tbody>
						
						<div id="item_code_id"></div>
					</table>
					
					<br>
						
					<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Cetak Label" onclick="submitForm('label_view')" />
					
					</form>
						
				</div><!-- /.span -->
			</div><!-- /.row -->

			<div style="display: none;" >
			<table id="dynamic-table">
			</table>
			</div>
			
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->
				

		<!-- basic scripts -->

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

		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="assets/js/dataTables.tableTools.min.js"></script>
		<script src="assets/js/dataTables.colVis.min.js"></script>

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
					  null, null, null,  
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
				
				
				
				//ColVis extension
				var colvis = new $.fn.dataTable.ColVis( oTable1, {
					"buttonText": "<i class='fa fa-search'></i>",
					"aiExclude": [0, 16],
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
	</body>
</html>
