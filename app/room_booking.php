<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='name') {
			alert('Nama tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='memo') {
			alert('Kegiatan tidak boleh kosong!');				
		  }
		  
		  return false
		} 
										
	  }		 
	}
		
</script>

<style>
	.hide {
		opacity: 0;
	}
</style>

<?php
	$name			= 	$_POST['name'];
	$memo			=	$_POST['memo'];
	$booked			=	date("d-m-Y", strtotime($_POST['booked']));
	$booked_finish	=	date("d-m-Y", strtotime($_POST['booked_finish']));
	$date			= 	date("d-m-Y", strtotime($_POST['date']));
	$arriving		= 	date("d-m-Y", strtotime($_POST['arriving']));
	$checkout_date 	= "";
	
	$from_time		=	date("H:i", strtotime($_POST["from_time"]));
	$to_time		=	$_POST["to_time"];
						
	$days			= 	datediff($booked, $booked_finish);
	$total_days		=	$days['days'];
?>

<div class="page-content">
      
	<div class="row">
		<div class="col-xs-12">
            
            <?php 
				$ref = $segmen3; //$_GET['search'];
				
				//jika saat add data, maka data setelah save kosong
				if ($_POST['submit'] == 'Save') { $ref = ''; }
				//-----------------------------------------------/\
					
				$ref2 = notran(date('y-m-d'), 'frmroom_booking', '', '', ''); 
				
				include("app/exec/room_booking_insert.php"); 
				
				if($_POST['submit'] == "Preview") {
					
					$date			= date("d-m-Y");
					/*$booked			= date("d-m-Y");
					$booked_finish	= date("d-m-Y");
					$arriving		= date("d-m-Y");*/
					$checkout_date 	= "";
								
				} else {
										
					$date			= date("d-m-Y");
					/*$booked			= date("d-m-Y");
					$booked_finish	= date("d-m-Y");
					$arriving		= date("d-m-Y");
					$checkout_date 	= "";*/
					
				}
				
				
				if ($ref != "") {
					$sql=$select->list_room_booking($ref);
					$row_registration=$sql->fetch(PDO::FETCH_OBJ);
					
					$ref2			= $row_registration->ref;
					$name			= $row_registration->name;
					$memo			= $row_registration->memo;
					$date			= date("d-m-Y", strtotime($row_registration->date));
					$booked			= date("d-m-Y", strtotime($row_registration->booked));
					$booked_finish	= date("d-m-Y", strtotime($row_registration->booked_finish));
					$arriving		= date("d-m-Y", strtotime($row_registration->arriving));
					$checkout_date 	= date("d-m-Y", strtotime($row_registration->date));
					
					$from_time		= date("H:i", strtotime($row_registration->booked));
					$to_time		= date("H:i", strtotime($row_registration->booked_finish));
					
					$days			= 	datediff($booked, $booked_finish);
					$total_days		=	$days['days'];
					
				}		
				
			?>
            
			<!-- PAGE CONTENT BEGINS -->
			<!--<form class="form-horizontal" role="form" action="" method="post" name="registration2" id="registration2" enctype="multipart/form-data" onSubmit="return cekinput('registrationid');" >
            	
            	<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tanggal Kegiatan</label>
					<div class="col-sm-3">
						<input type="text" id="booked" name="booked" style="font-size: 12px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $booked ?>">					
					</div>
				</div>-->
				
            	<!--<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tanggal Kegiatan</label>
					<div class="col-sm-3">
						<div class="input-daterange input-group">
							<input type="text" id="booked" name="booked" style="font-size: 12px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $booked ?>">
							
							<span class="input-group-addon">
								s/d
							</span>
							
							<input type="text" id="booked_finish" name="booked_finish" style="font-size: 12px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $booked_finish ?>">	
						</div>							
					</div>
				</div>-->
				
				<!--<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jam Kegiatan</label>
					<div class="col-sm-3">
						<div class="input-timerange input-group">
							<input class="form-control input-mask-time" type="text" id="from_time" name="from_time" value="<?php echo $from_time ?>" />
							
							<span class="input-group-addon">
								s/d
							</span>
							<input class="form-control input-mask-time" type="text" id="to_time" name="to_time" value="<?php echo $to_time ?>" />		
						</div>							
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">&nbsp;</label>
                    <div class="col-sm-3">
                      <input type="submit" name="submit" id="submit" class='btn btn-primary' value="Preview"/>
					</div>
				</div>
				
			</form>
				
			</div>
		</div>-->
		
		
		<div class="row">
			<div class="col-xs-12">
				<!--<div class="clearfix">
					<div class="pull-right tableTools-container"></div>
				</div>-->
				
				<form class="form-horizontal" role="form" action="" method="post" name="registration" id="registration" enctype="multipart/form-data" onSubmit="return cekinput('name,memo');" >
					
					<div class="hide">
	            		<input type="text" id="total_days" name="total_days" value="<?php echo $total_days ?>" />
	            		
	            		<!--<input type="text" id="booked" name="booked" style="font-size: 12px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $booked ?>">
													
						<input type="text" id="booked_finish" name="booked_finish" style="font-size: 12px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $booked_finish ?>">-->	
						
						<!--<input class="form-control input-mask-time" type="text" id="from_time" name="from_time" value="<?php echo $from_time ?>" />
						<input class="form-control input-mask-time" type="text" id="to_time" name="to_time" value="<?php echo $to_time ?>" />-->
	            	</div>
	            	
	                <div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Reg. No *)</label>
						<div class="col-lg-3">
							<input type="text" id="ref" name="ref" class="form-control" readonly="" value="<?php echo $ref2 ?>">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Date'; } else { echo 'Tanggal Booking'; } ?> *)</label>
						<div class="col-sm-3">
							<input type="text" id="date" name="date" style="font-size: 12px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $date ?>">								
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama *)</label>
						<div class="col-sm-3">
							<input type="text" id="name" name="name" class="form-control" autocomplete="off" value="<?php echo $name ?>">
						</div>
					</div>				
					
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tanggal Kegiatan</label>
						<!--<div class="col-sm-3">
							<input type="text" id="booked" name="booked" style="font-size: 12px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $booked ?>">					
						</div>-->
						
						<div class="col-sm-3">
							<div class="input-daterange input-group">
								<input type="text" id="booked" name="booked" readonly="" style="font-size: 12px" class="form-control" data-date-format="dd-mm-yyyy" value="<?php echo $booked ?>">
								
								<span class="input-group-addon">
									s/d
								</span>
								
								<input type="text" id="booked_finish" name="booked_finish" readonly="" style="font-size: 12px" class="form-control" data-date-format="dd-mm-yyyy" value="<?php echo $booked_finish ?>">	
							</div>							
						</div>
					</div>
								
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jam Kegiatan</label>
					<div class="col-sm-3">
						<div class="input-timerange input-group">
							<input class="form-control input-mask-time" type="text" id="from_time" name="from_time" readonly="" value="<?php echo $from_time ?>" />
							
							<span class="input-group-addon">
								s/d
							</span>
							<input class="form-control input-mask-time" type="text" id="to_time" name="to_time" readonly="" value="<?php echo $to_time ?>" />		
						</div>							
					</div>
				</div>
				
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kegiatan *)</label>
						<div class="col-sm-6">
							<textarea name="memo" id="memo" class="autosize-transition form-control"><?php echo $memo ?></textarea>
						</div>
					</div>
						
	                <?php 
						if($ref == "") {
							include("room_booking_detail.php");
						} else {
							include("room_booking_detail_update.php");
	                        //include("registration_detail2_update.php");
						}
					?>
	                
					<div class="space-4"></div>

					<div class="clearfix form-actions">
						<div class="col-md-offset-3 col-md-9">
	                    
	                        <?php if (allowupd('frmroom_booking','')==1) { ?>
	                            <?php if($ref!='') { ?>
	    							<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
	    						<?php } ?>
	                        <?php } ?>
							
							<?php if (allowadd('frmroom_booking','')==1) { ?>
								<?php if($ref=='') { ?>
									<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Save" />
								<?php } ?>
			                <?php } ?>
	                  
	                        <?php if (allowdel('frmroom_booking','')==1) { ?>
	                            &nbsp;
	    						<input type="submit" name="submit" class="btn btn-danger" value="Delete" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
	                        <?php } ?>
	                        
							&nbsp;
							<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder ?>/<?php echo  obraxabrix(room_booking_view) ?>'" />
	                                                
	                                 
						</div>
					</div>

				</form>
            
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->


<!-- basic scripts -->

<!--[if !IE]> -->
<script src="<?php echo $__folder ?>assets/js/jquery.2.1.1.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="<?php echo $__folder ?>assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

<!--[if !IE]> -->
<script type="text/javascript">
	window.jQuery || document.write("<script src='<?php echo $__folder ?>assets/js/jquery.min.js'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
window.jQuery || document.write("<script src='<?php echo $__folder ?>assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo $__folder ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="<?php echo $__folder ?>assets/js/bootstrap.min.js"></script>

<script src="<?php echo $__folder ?>assets/js/jquery-ui.custom.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/chosen.jquery.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/fuelux.spinner.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/moment.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/daterangepicker.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.knob.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.autosize.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.maskedinput.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-tag.min.js"></script>

<!--Editor wysiwyg-->
<!--<script src="<?php echo $__folder ?>assets/js/markdown.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-markdown.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.hotkeys.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-wysiwyg.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootbox.min.js"></script>-->

<!-- page specific plugin scripts -->
<script src="<?php echo $__folder ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/dataTables.tableTools.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/dataTables.colVis.min.js"></script>

<!-- ace scripts -->
<script src="<?php echo $__folder ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/ace.min.js"></script>

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
			  null, null,   //kalau nambah kolom, null ditambahkan
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
			"sSwfPath": "<?php echo $__folder ?>assets/swf/copy_csv_xls_pdf.swf",
			
			"sRowSelector": "td:not(:lasset-child)",
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
		/*$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
			var row = $(this).closest('tr').get(0);
			if(!this.checked) tableTools_obj.fnSelect(row);
			else tableTools_obj.fnDeselect($(this).closest('tr').get(0));
		});*/
		
	
		
		
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
		
		$.mask.definitions['~']='[+-]';
		$('.input-mask-date').mask('99/99/9999');
		$('.input-mask-time').mask('99:99');
		$('.input-mask-phone').mask('(999) 999-9999');
		$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
		$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
	
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


				