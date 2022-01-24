<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			/*document.location.href = "main.php?menu=app&act=<php echo obraxabrix('pinjam') ?>&mxKz=xm8r389xemx23xb2378e23&id="+id+" ";*/
			document.location.href = "<?php echo $__folder ?><?php echo obraxabrix('pinjam_view') ?>/xm8r389xemx23xb2378e23/"+id+" ";
		}
	}
</script>

<script>
    function submitForm(tipe)
    {
		/*if(tipe == 'print') {
			//document.getElementById("delord_view").action = "app/delord_print.php";
			$("#delord_view").attr('action', 'app/delord_print.php')
			   .attr('target', '_BLANK');
			$("#delord_view").submit();
		}*/
		
		if(tipe == 'find') {
			$("#pinjam_view").attr('action', '')
				.attr('target', '_self');
			$("#pinjam_view").submit();
		}
		
		if(tipe == 'excel') {
			$("#pinjam_view").attr('action', 'app/pinjam_xls.php')
			   .attr('target', '_BLANK');
			$("#pinjam_view").submit();
		}
		
  		return false;	 
    }
		
</script>

<?php

$idanggota	= $_REQUEST['idanggota'];
$tglpinjam	= $_REQUEST['tglpinjam'];
$tglkembali	= $_REQUEST['tglkembali'];
$all		= $_REQUEST['all'];

$tglpinjam	= date("d-m-Y", strtotime($tglpinjam));	
$tglkembali	= date("d-m-Y", strtotime($tglkembali));

if($tglpinjam == '01-01-1970') {
	$tglpinjam = "";
}

if($tglpinjam == '') {
	$tglpinjam = date("d-m-Y");
}



if($tglkembali == '01-01-1970') {
	$tglkembali = "";
}

$all2 = "";
if($all == 1) {
	$all2 = "checked";
}
		
?>


<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Filter</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="pinjam_view" id="pinjam_view" class="form-horizontal">
								<div>
									
									<table border="0">
										<tr>
											<td>Member</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<div class="col-sm-6">
													<select name="idanggota" id="idanggota" class="chosen-select form-control" style="width: auto;" >
														<option value=""></option>
														<?php select_anggota($idanggota); ?>
													</select>
												</div>
											</td>
											
											<td>&nbsp;&nbsp;</td>
											
											<td>Tanggal Pinjam</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<!-- <input type="text" name="tglpinjam" id="tglpinjam" class='datepick' style="width:auto; height:20px; font-size: 12px" value="<php echo $tglpinjam ?>" > -->
												<input type="text" id="tglpinjam" name="tglpinjam" class="form-control date-picker" style="width:100px;"  data-date-format="dd-mm-yyyy" value="<?php echo $tglpinjam ?>">	
											</td>
											
										</tr>
										<tr>
											<td>Tanggal Kembali</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<div class="col-sm-6">
													<!-- <input type="text" name="tglkembali" id="tglkembali" class='datepick' style="width:auto; height:20px; font-size: 12px" value="<php echo $tglkembali ?>" > -->
													<input type="text" id="tglkembali" name="tglkembali" class="form-control date-picker" style="width:100px;"  data-date-format="dd-mm-yyyy" value="<?php echo $tglkembali ?>">
												</div>
											</td>
											
											<td>&nbsp;&nbsp;</td>
											<td>Semua</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="checkbox" id="all" name="all" value="1" <?php echo $all2 ?> />
											</td>
											
											
										</tr>
										
										<tr>
											<td>
												<input type="submit" name="submit" class='btn btn-primary' value="Find" onclick="submitForm('find')" >
											</td>
											<td>
												<input type="submit" name="submit" class='btn btn-primary' value="Ekspor Excel" onclick="submitForm('excel')" >
											</td>											
										</tr>
									</table>
									
								</div>								
							</form>
						</div>	
					</div>
					
					<div class="box">
						<div class="box-head tabs">
							<h3>DAFTAR PEMINJAMAN</h3>	
							
													
						</div>
						
						<div class="box-content box-nomargin">
							
							<?php
								$delete = $segmen3; //$_REQUEST['mxKz'];
								if ($delete == "xm8r389xemx23xb2378e23") {
									include 'class/class.delete.php';
									$delete2=new delete;
									$delete2->delete_pinjam_detail($segmen4); // $_REQUEST['id']
							?>
									<div class="alert alert-success">
										<strong>Delete Data successfully</strong>
									</div>

									<meta http-equiv="Refresh" content="0;url=<?php echo $__folder ?><?php echo obraxabrix('pinjam_view') ?>" />
							<?php
								}
							?>

							<div class="tab-content">
									<div class="tab-pane active" id="basic">
										<div style="overflow:auto; ">
										<!--<table class='table table-striped dataTable table-bordered' style="font-size:11px; width:4000px ">-->
										
										<table id="dynamic-table" class="table table-striped table-bordered table-hover" style="font-size: 12px">
											<thead>
												<tr>
													<th style="font-weight:bold ">Anggota &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Kode Pustaka &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Judul &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Tanggal Pinjam &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Jadwal Kembali &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Keterangan &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Terlambat(hari) &nbsp;&nbsp;</th>
													<th style="font-weight:bold "></th>										
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													$sql=$select->list_pinjam($replid, $idanggota, $tglpinjam, $tglkembali, $all);			
													
													while ($pinjam_view=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
														
														$member	= $pinjam_view->idanggota . " | " . $pinjam_view->nama;
														
														$tglpinjam = date("d-m-Y", strtotime($pinjam_view->tglpinjam));
														$tglkembali = date("d-m-Y", strtotime($pinjam_view->tglkembali));	
														$now	= date("d-m-Y");
														$terlambat = "";
														$background = "";
														if($tglkembali < $now) {
															$terlambat	= $pinjam_view->terlambat;
															$background = 'style="background-color: #ff0000; color: #fff"';
														} 
														
												?>
													
													<tr>
														<td <?php echo $background ?>><?php echo $member ?></td>
														<td <?php echo $background ?>><?php echo $pinjam_view->kodepustaka ?></td>
														<td <?php echo $background ?>><?php echo $pinjam_view->judul ?></td>
														<td <?php echo $background ?>><?php echo $tglpinjam ?></td>
														<td <?php echo $background ?>><?php echo $tglkembali ?></td>
														<td <?php echo $background ?>><?php echo $pinjam_view->keterangan ?></td>
														<td style="text-align: center"><?php echo $terlambat ?></td>
														<td>
															
															<!-- <a class="label label-success" href="main.php?menu=app&act=<php echo obraxabrix('kembali') ?>&search=<php echo $pinjam_view->replid ?>" style="background-color: #46e916" >kembali</a> -->

															<a href="<?php echo $__folder ?><?php echo obraxabrix('kembali') ?>/<?php echo $pinjam_view->replid ?>" class="tooltip-success" style="background-color: #46e916" data-rel="tooltip" title="Kembali">
		    													Kembali
		    												</a>
															
															
															<?php if (allowdel('frmpinjam')==1) { ?>
																&nbsp;&nbsp;
																<a class="label label-success" href="JavaScript:hapus('<?php echo $pinjam_view->replid ?>')" style="background-color: #ff0000">hapus</i> 
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
										
										
										<br>
									</div>
							</div>
						</div>
						
				</div>
			</div>

		</div>
	</div>
</div>

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
			  null, null, null, null, null, null,   //kalau nambah kolom, null ditambahkan
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
