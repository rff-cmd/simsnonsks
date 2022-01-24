<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");
include '../app/class/class.selectview.php';

$select_view = new selectview;

//$dbpdo = DB::create();

$unit = $_SESSION["unit"];

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

<!--[if lte IE 9]>
    <link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
<![endif]-->

<!--[if lte IE 9]>
  <link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/ace-ie.min.css" />
<![endif]-->

<!-- inline styles related to this page -->

<!-- ace settings handler -->
<script src="../<?php echo $__folder ?>assets/js/ace-extra.min.js"></script>

<script language="javascript">
    function cekinput(fid) {  
      var arrf = fid.split(',');
      for(i=0; i < arrf.length; i++) {
        if(document.getElementById(arrf[i]).value=='') {       
          
          if (document.getElementById(arrf[i]).name=='location_id') {
            alert('Central tidak boleh kosong!');               
          }
          
          if (document.getElementById(arrf[i]).name=='file') {
            alert('File CSV masih kosong!');                
          }
          
          return false
        } 
                                        
      }     
      
       
    }
        
</script>


<form name="frm" id="frm" method="post" action="pinjam_buku_lup.php">

    <script langauge="javascript">
    	function post_value(j){
        	var aa= document.getElementById('frm');
            
        	var zz= "kodepustaka" + j;
            opener.document.pinjam.kodepustaka.value = aa.elements[zz].value;
        	
        	var xx= "judul" + j;
        	opener.document.pinjam.judul.value = aa.elements[xx].value;
            
        	self.close();
    	}
    </script>

         <div class="container-fluid">
    		<div class="content">
    			
    			<div class="row-fluid">
    				<div class="span12">
    					
    					
    					<div class="box">
    						<div class="box-head tabs">
    							<h3>DAFTAR PUSTAKA</h3>	
    							
    													
    						</div>
    						
    						<div class="box-content box-nomargin">
    						
    							<div class="tab-content">
    									<div class="tab-pane active" id="basic">
    										<div style="overflow:auto; ">
    										
    										<table id="dynamic-table" class="table table-striped table-bordered table-hover" style="font-size: 12px">
    											<thead>
    												<tr>												
                                                        <th style="font-weight:bold ">Kode Pustaka &nbsp;&nbsp;</th>	
    													<th style="font-weight:bold ">Judul &nbsp;&nbsp;</th>
    													<th style="font-weight:bold ">Keyword &nbsp;&nbsp;</th>
    													<th style="font-weight:bold ">Penulis &nbsp;&nbsp;</th>
    													<th style="font-weight:bold ">Penerbit &nbsp;&nbsp;</th>
    													<th style="font-weight:bold ">Pilih</th>										
    												</tr>
    											</thead>
    											
    											<tbody>
    											
    												<?php			
    													$sql=$select_view->list_pustaka("", $unit);			
    													
    													while ($pustaka_view=$sql->fetch(PDO::FETCH_OBJ)) {
    														
    														$j++;
    														    																												
    												?>
    													
    													<tr>
                                                            <td>
                                                                <input type="hidden" id="kodepustaka<?php echo $j; ?>" name="kodepustaka<?php echo $j; ?>" value="<?php echo $pustaka_view->kodepustaka ?>" >
                                                                <?php echo $pustaka_view->kodepustaka ?>
                                                            </td>														
    														<td>
                                                                
                                                                <input type="hidden" id="judul<?php echo $j; ?>" name="judul<?php echo $j; ?>" value="<?php echo $pustaka_view->judul ?>" >
                                                                <?php echo $pustaka_view->judul ?>
                                                                    
                                                            </td>
    														<td><?php echo $pustaka_view->keyword ?></td>
    														<td><?php echo $pustaka_view->namapenulis ?></td>
    														<td><?php echo $pustaka_view->namapenerbit ?></td>
    														<td align="center">
    															
    															<input type="image" style="width: 16px"  src="../img/icons/essen/16/check.png" value="" onClick="post_value(<?php echo $j; ?>);">

                                                                <span class="green" onClick="post_value(<?php echo $j; ?>);">
                                                                    <i class="ace-icon fa fa-check-square-o bigger-150"></i>
                                                                </span>
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
</form>


<script src="../<?php echo $__folder ?>assets/js/jquery.2.1.1.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="../<?php echo $__folder ?>assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

<!--[if !IE]> -->
<script type="text/javascript">
    window.jQuery || document.write("<script src='../<?php echo $__folder ?>assets/js/jquery.min.js'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
window.jQuery || document.write("<script src='../<?php echo $__folder ?>assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='../<?php echo $__folder ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="../<?php echo $__folder ?>assets/js/bootstrap.min.js"></script>

<script src="../<?php echo $__folder ?>assets/js/jquery-ui.custom.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/chosen.jquery.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/fuelux.spinner.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/bootstrap-timepicker.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/moment.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/daterangepicker.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/bootstrap-colorpicker.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/jquery.knob.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/jquery.autosize.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/jquery.maskedinput.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/bootstrap-tag.min.js"></script>

<!-- page specific plugin scripts -->
<script src="../<?php echo $__folder ?>assets/js/jquery.dataTables.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/dataTables.tableTools.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/dataTables.colVis.min.js"></script>

<!-- ace scripts -->
<script src="../<?php echo $__folder ?>assets/js/ace-elements.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/ace.min.js"></script>

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
              null, null, null, null,  //kalau nambah kolom, null ditambahkan
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
            "sSwfPath": "../<?php echo $__folder ?>assets/swf/copy_csv_xls_pdf.swf",
            
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

