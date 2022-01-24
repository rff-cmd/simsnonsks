<script type="text/javascript" src="js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {  
		var arrf = fid.split(',');
		for(i=0; i < arrf.length; i++) {
			if(document.getElementById(arrf[i]).value=='') {       
			  
			  if (document.getElementById(arrf[i]).name=='idtingkat') {
				alert('Tingkat tidak boleh kosong!');				
			  }
			  
			  if (document.getElementById(arrf[i]).name=='idkelas') {
				alert('Kelas tidak boleh kosong!');				
			  }
			  
			  if (document.getElementById(arrf[i]).name=='semester_id') {
				alert('Semester tidak boleh kosong!');				
			  }
			  
			  if (document.getElementById(arrf[i]).name=='iddasarpenilaian') {
				alert('Aspek Penilaian tidak boleh kosong!');				
			  }
			  
			  return false
			} 
										
		}		 
	  
	  	/*var jmldata = document.getElementById('jmldata').value;	  
		for(j=0; j<jmldata; j++) {
			var pilih = document.getElementById('pilih_'+j).checked;
			if(pilih == true) {
				var kode = document.getElementById('kode_'+j).value;
				if(kode == "") {
					alert("Kode Guru tidak boleh kosong !!!");
					return false;
				}
			}
		}*/
		
	}
		
</script>

<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost2(URL, destination, button, getId){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;	
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


<script type="text/javascript">
	function daftarnilai_input_pts(idpelajaran, idtingkat, idkelas, semester_id, iddasarpenilaian, idtahunajaran) {
		var semester_id		= document.getElementById('semester_id').value;
		var idtahunajaran	= document.getElementById('idtahunajaran2').value;
		var idtingkat		= document.getElementById('idtingkat').value;
		var idkelas			= document.getElementById('idkelas').value;
		var old				= document.getElementById('old').checked;
		if(old == true) {
			old = 1;
		} else {
			old = 0;
		}
		
		window.open("app/daftarnilai_input_pts.php?idpelajaran="+idpelajaran+"&idtingkat="+idtingkat+"&idkelas="+idkelas+"&semester_id="+semester_id+"&iddasarpenilaian="+iddasarpenilaian+"&idtahunajaran="+idtahunajaran+"&old="+old,"Find","width=1000,height=600,left=50,top=10,toolbar=0,status=0,scroll=1,scrollbars=yes");
	}
	
</script>


<script type="text/javascript">
	function daftarnilai_input(idpelajaran, idtingkat, idkelas, semester_id, iddasarpenilaian, idtahunajaran) {
		var semester_id		= document.getElementById('semester_id').value;
		var idtahunajaran	= document.getElementById('idtahunajaran2').value;
		var idtingkat		= document.getElementById('idtingkat').value;
		var idkelas			= document.getElementById('idkelas').value;
		var old				= document.getElementById('old').checked;
		if(old == true) {
			old = 1;
		} else {
			old = 0;
		}
		
		var alumni			= document.getElementById('alumni').checked;
		if(alumni == true) {
			alumni = 1;
		} else {
			alumni = 0;
		}
		
		window.open("app/daftarnilai_input.php?idpelajaran="+idpelajaran+"&idtingkat="+idtingkat+"&idkelas="+idkelas+"&semester_id="+semester_id+"&iddasarpenilaian="+iddasarpenilaian+"&idtahunajaran="+idtahunajaran+"&old="+old+"&alumni="+alumni,"Find","width=1000,height=600,left=50,top=10,toolbar=0,status=0,scroll=1,scrollbars=yes");
	}
	
	function daftarnilai_update(hari, idtingkat, idkelas, idguru, idjam) {
		window.open("app/jadwal_update.php?hari="+hari+"&idtingkat="+idtingkat+"&idkelas="+idkelas+"&idguru="+idguru+"&idjam="+idjam,"Find","width=500,height=620,left=50,top=10,toolbar=0,status=0,scroll=1,scrollbars=no");
	}
	
	function daftarnilai_input_tingkat(idpelajaran, idtingkat, idkelas, semester_id, iddasarpenilaian, idtahunajaran) {
		window.open("app/daftarnilai_input_tingkat.php?idpelajaran="+idpelajaran+"&idtingkat="+idtingkat+"&idkelas="+idkelas+"&semester_id="+semester_id+"&iddasarpenilaian="+iddasarpenilaian+"&idtahunajaran="+idtahunajaran,"Find","width=1000,height=600,left=50,top=10,toolbar=0,status=0,scroll=1,scrollbars=yes");
	}
</script>            


<?php
$idtahunajaran 	= $_POST['idtahunajaran2'];
$idtingkat	=	$_POST["idtingkat"];
$idkelas	=	$_POST["idkelas"];
$semester_id=	$_POST["semester_id"];
$iddasarpenilaian	=	$_POST["iddasarpenilaian"];
$old		=	$_POST["old"];
$alumni		=	$_POST["alumni"];

if($old == true || $old == 1) {
	$old2 = "checked";
}

if($alumni == true || $alumni == 1) {
	$alumni2 = "checked";
}

if($idtahunajaran == "") {
	$idtahunajaran = $_SESSION["idtahunajaran"];
}
if($semester_id == "") {
	$semester_id = $_SESSION["semester_id"];
}

?>    
                    
<div class="page-content">
      
	<div class="row">
		<div class="col-xs-12">
            
            <?php 
				$ref = $segmen3; //$_GET['search'];
				
				//jika saat add data, maka data setelah save kosong
				if ($_POST['submit'] == 'Save') { $ref = ''; }
				//-----------------------------------------------/\
					
				//include("app/exec/insert_jadwal.php");
				
				//$tanggal = date("d-m-Y");
				/*if ($ref != "") {
					$sql=$select->list_jadwal($ref);
					$row_jadwal=$sql->fetch(PDO::FETCH_OBJ);	
					
				}*/		
				
				
			?>
            
			<!-- PAGE CONTENT BEGINS -->
			<form class="form-horizontal" role="form" action="" method="post" name="jadwal" id="jadwal" enctype="multipart/form-data" onSubmit="return cekinput('idtingkat,idkelas,semester_id,iddasarpenilaian');" >
            	
            	<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tahun Ajaran</label>
					<div class="col-lg-2">
						<select name="idtahunajaran2" id="idtahunajaran2" class="chosen-select form-control" />
							<option value=""></option>
							<?php select_thnajaran($idtahunajaran); ?>
						</select>
					</div>
				</div>
				
            	<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tingkat *)</label>
					<div class="col-sm-3">
						<select name="idtingkat" id="idtingkat" class="chosen-select form-control" onchange="loadHTMLPost2('app/daftar_nilai_ajax.php','kelas_id','getkelas','idtingkat')" >
							<option value=""></option>
							<?php select_tingkat_unit("SMA", $idtingkat); ?>
						</select>								
					</div>
				</div>
				   	
            	<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kelas *)</label>
					<div class="col-sm-3" id="kelas_id">
						<select name="idkelas" id="idkelas" class="chosen-select form-control" >
							<option value=""></option>
							<?php select_kelas($idtingkat, $idkelas); ?>
						</select>								
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Semester *)</label>
					<div class="col-lg-2">
						<select name="semester_id" id="semester_id" class="chosen-select form-control" >
							<option value=""></option>
							<?php //select_semester("SMA", $semester_id); ?>
							<?php 
								//if(allowlvl("frmdaftarnilai") == 2) {
									select_semester_all("SMA", $semester_id); 
								/*} else {
									select_semester("SMA", $semester_id);
								}*/
							?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Aspek Penilaian *)</label>
					<div class="col-lg-2">
						<select name="iddasarpenilaian" id="iddasarpenilaian" class="chosen-select form-control" >
							<option value=""></option>
							<?php select_aspekpenilaian($iddasarpenilaian); ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Alumni</label>
                    
                    <div class="col-sm-3">
                    	 <input id="alumni" name="alumni" type="checkbox" class="ace" value="1" <?php echo $alumni2 ?> ><span class="lbl"></span>
					</div>
                    
				</div>
				
            	<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">&nbsp;</label>
                    <div class="col-sm-3">
                      <input type="submit" name="submit" id="submit" class='btn btn-primary' value="Preview"/>
                    </div>  
				</div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Thn Ajaran Sebelumnya</label>
                    
                    <div class="col-sm-3">
                    	 <input id="old" name="old" type="checkbox" class="ace" value="1" <?php echo $old2 ?> ><span class="lbl"></span><font style="color: #ff0000">Checklist jika ingin Edit Nilai sebelumnya</font>   
					</div>      
				</div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Catatan</label>
                    
                    <div class="col-sm-6" style="color: #ff0000">
                    	<b>Setelah Preview</b><br>
                    	Jika ingin edit nilai semester sebelumnya, pilih Tahun Ajaran, Tingkat, Kelas dan Semester sebelumnya (Tidak perlu tekan Preview, langsung Input/Edit Nilai).
					</div>
                    
				</div>
				
			</form>
            
		</div><!-- /.col -->
	</div><!-- /.row -->
	
	
	<?php 
		if( $idtingkat !="" && $idkelas !="" && $semester_id != "" && $iddasarpenilaian != "") {
			include("daftarnilai_pelajaran.php");
		} else {
			include("daftarnilai_pelajaran_detail.php");
		}
		 
	?>
	
	
</div><!-- /.page-content -->


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
			  null, null, null, null, null, null,  //kalau nambah kolom, null ditambahkan
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


				