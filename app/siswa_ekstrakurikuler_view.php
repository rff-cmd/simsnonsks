<script type="text/javascript" src="<?php echo $__folder ?>js/buttonajax.js"></script>

<script type="text/javascript">
	function hapus(id, idsiswa) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "<?php echo $__folder ?><?php echo obraxabrix(siswa_ekstrakurikuler_view) ?>/xm8r389xemx23xb2378e23/"+id+"/"+idsiswa;
		}
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

<script>
	function ekskul_excel() {
		idtingkat	= document.getElementById('idtingkat').value;
		idkelas		= document.getElementById('idkelas').value;
		idpelajaran	= document.getElementById('idpelajaran').value;
		semester_id	= document.getElementById('semester_id').value;
		idtahunajaran		= document.getElementById('idtahunajaran_f').value;
		nama2				= document.getElementById('nama2').value;
		all		= document.getElementById('all').checked;
		
		if(all == true) {
			all = 1;
		}
		if(all == false) {
			all = 0;
		}
		
		window.open('<?php echo $__folder ?>app/siswa_ekstrakurikuler_xls.php?idtingkat='+idtingkat+'&idkelas='+idkelas+'&idpelajaran='+idpelajaran+'&semester_id='+semester_id+'&nama2='+nama2+'&idtahunajaran='+idtahunajaran+'&all='+all, 'Siswa Ekstrakurikuler','200','200','resizable=1,scrollbars=1,status=0,toolbar=0');								
	}
</script>

<script>
	var replid_id = '';
	var replid_id3 = '';
	
	var nilai_id = '';
	var nilai_id3 = '';
	
	var idsiswa_id = '';
	var idsiswa_id3 = '';
	
	var idpelajaran_id = '';
	var idpelajaran_id3 = '';
	
	function checklist(lne) {
		replid_id = replid_id + '|' + document.getElementById('replid_'  + lne).value;
		$('#replid_id_id').html('<input type="hidden" size="100" id="replid_id" name="replid_id" value="'+ replid_id +'" >');
		
		nilai_id = nilai_id + '|' + document.getElementById('nilai_'  + lne).value;
		$('#nilai_id_id').html('<input type="hidden" size="50" id="nilai_id" name="nilai_id" value="'+ nilai_id +'" >');
		idsiswa_id = idsiswa_id + '|' + document.getElementById('idsiswa_'  + lne).value;
		$('#idsiswa_id').html('<input type="hidden" size="50" id="idsiswa" name="idsiswa" value="'+ idsiswa_id +'" >');
		idpelajaran_id = idpelajaran_id + '|' + document.getElementById('idpelajaran_'  + lne).value;
		$('#idpelajaran_id').html('<input type="hidden" size="50" id="idpelajaran" name="idpelajaran" value="'+ idpelajaran_id +'" >');
	}
</script>

<style>
	.hide {
		opacity: 0;
	}
</style>

<?php

$idtingkat2	= $_REQUEST['idtingkat'];
$idkelas2	= $_REQUEST['idkelas'];
$idpelajaran= $_REQUEST['idpelajaran'];
$semester_id= $_POST['semester_id'];
$idtahunajaran = $_POST['idtahunajaran_f'];
$nama2		= $_REQUEST['nama2'];
$all		= $_REQUEST['all'];

if($semester_id == "") {
	$semester_id = $_SESSION["semester_id"];
}

if($idtahunajaran == "") {
	$idtahunajaran = $_SESSION["idtahunajaran"];
}

$all2 = "";
if($all == 1) {
	$all2 = "checked";
}

?>

<div class="page-content">						
	<div class="row">
		<div class="col-xs-12">
                
            <?php
				$delete = $segmen3; //$_REQUEST['mxKz'];
				if ($delete == "xm8r389xemx23xb2378e23") {
					include 'class/class.delete.php';
					$delete2=new delete;
					$delete2->delete_siswa_ekstrakurikuler($segmen4,$segmen5);
			?>
					<div class="alert alert-success">
						<strong>Delete Data successfully</strong>
					</div>
                    
                    <meta http-equiv="Refresh" content="0;url=<?php echo $__folder ?><?php echo obraxabrix('siswa_ekstrakurikuler_view') ?>" />
			<?php   
				}
				
				if ($_POST['submit'] == 'Update Nilai') {
					include("app/exec/insert_siswa_ekstrakurikuler.php");
				}
			?>
                
			<!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-xs-12">
				
					<form class="form-horizontal" role="form" action="" method="post" name="siswa_ekstrakurikuler_view" id="siswa_ekstrakurikuler_view" enctype="multipart/form-data" >
		            	
		            	<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tahun Ajaran</label>
							<div class="col-lg-2">
								<select name="idtahunajaran_f" id="idtahunajaran_f" class="chosen-select form-control" >
									<option value=""></option>
									<?php select_thnajaran($idtahunajaran); ?>
								</select>
							</div>
						</div>
						
		            	<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Semester</label>
							<div class="col-lg-2">
								<select name="semester_id" id="semester_id" class="chosen-select form-control" >
									<option value=""></option>
									<?php select_semester_all("SMA", $semester_id); ?>
								</select>
							</div>
						</div>
						
		            	<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tingkat</label>
							<div class="col-sm-3">
								<select name="idtingkat" id="idtingkat" class="chosen-select form-control" onchange="loadHTMLPost2('app/daftar_nilai_ajax.php','kelas_id','getkelas','idtingkat')" >
									<option value=""></option>
									<?php select_tingkat_unit("SMA", $idtingkat2); ?>
								</select>							
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kelas</label>
							<div class="col-sm-3" id="kelas_id">
								<select name="idkelas" id="idkelas" class="chosen-select form-control" >
									<option value=""></option>
									<?php select_kelas($idtingkat2, $idkelas2); ?>
								</select>								
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Ekskul</label>
							<div class="col-sm-4">
								<select name="idpelajaran" id="idpelajaran" class="chosen-select form-control" >
									<option value=""></option>
									<?php 
										select_ekstrakurikuler($idpelajaran);
									?>
								</select>
							</div>
						</div>
	
						<div class="form-group">
		                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Siswa</label>
		                    <div class="col-sm-3">
		                    	 <input type="text" name="nama2" id="nama2" class="form-control" value="<?php echo $nama2 ?>">
							</div>
		                    
						</div>
						
						<div class="form-group">
		                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Semua</label>
		                    
		                    <div class="col-sm-3">
		                    	 <input id="all" name="all" type="checkbox" class="ace" value="1" <?php echo $all2 ?> ><span class="lbl"></span>
							</div>
		                    
						</div>
						
						
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">&nbsp;</label>
		                    <div class="col-sm-6">
		                      <input type="submit" name="submit" id="submit" class='btn btn-primary' value="Preview"/>
		                      
		                      &nbsp;
								<input type="button" name="submit" id="submit" class="btn btn-success" value="Input Siswa Ekskul" onclick="self.location='<?php echo $nama_folder . '/' . obraxabrix(siswa_ekstrakurikuler) ?>'" />
							  &nbsp;&nbsp;
		                      <input type="submit" name="submit" class='btn btn-primary' value="Download" onclick="ekskul_excel()" >
		                    </div>  
						</div>
						
						
						
					</form>
				
				</div>
			</div>
			
			
			<form class="form-horizontal" role="form" action="" method="post" name="siswa_ekstrakurikuler" id="siswa_ekstrakurikuler" enctype="multipart/form-data" >
				<div class="row">
					<div class="col-xs-12">
						<div class="clearfix">
							<div class="pull-right tableTools-container"></div>
						</div>
						<!-- div.dataTables_borderWrap -->
						
						<div class="hide">
							<input type="text" id="idsemester" name="idsemester" value="<?php echo $semester_id ?>" />
							<input type="text" id="idtahunajaran" name="idtahunajaran" value="<?php echo $idtahunajaran ?>" />
						</div>
						
						<div>
							<table id="dynamic-table" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
	                                    <th class="center" style="font-weight:bold ">No.</th>
	                                    <th>NIS</th>
	                                    <th>NISN</th>
	                                    <th>Nama Lengkap</th>
	                                    <th>Jenis Kelamin</th>
	                                    <th>Tingkat</th>
	                                    <th>Kelas</th>
	                                    <th>Ekskul</th>
	                                    <th>Pembina</th>
	                                    <th>Nilai</th>
										<th>Edit/Hapus</th>
									</tr>
								</thead>

								<tbody>
	                                <?php			
	                                	$i = 0;
										$sql=$selectview->list_siswa_ekstrakurikuler('SMA', '', $idtingkat2, $idkelas2, $nama2, $all, $idpelajaran, $semester_id, $idtahunajaran);
										$jmldata = $sql->rowCount();
										while($siswa_view=$sql->fetch(PDO::FETCH_OBJ)){
										
											if($siswa_view->kelamin == "P") {
												$kelamin = "Perempuan";
											} else {
												$kelamin = "Laki-laki";
											}
											
											$bg_color = "";
											$nilai = $siswa_view->nilai;
											if($nilai == "") {
												$nilai = "A";
												$bg_color = 'style="background-color: #e30000"';
											}
											
											//get nama pembina
											//left join guru f on e.replid=f.idpelajaran left join pegawai g on f.nip=g.replid
											$sqlpel = $selectview->list_siswa_ekstrakurikuler_guru($siswa_view->idpelajaran);
											$pembina_view=$sqlpel->fetch(PDO::FETCH_OBJ);
											
											//get nilai ekskul
											/*$sqlnilai=$selectview->list_siswa_ekstrakurikuler('SMA', $siswa_view->nis, $idtingkat2, $idkelas2, $nama2, $all, $idpelajaran, $semester_id, $idtahunajaran);
											$nilai_view=$sqlnilai->fetch(PDO::FETCH_OBJ);*/
											
									?>
											<div class="hide">
												<input type="text" id="replid_<?php echo $i ?>" name="replid_<?php echo $i ?>" value="<?php echo $siswa_view->replid ?>">
												<input type="text" id="idsiswa_<?php echo $i ?>" name="idsiswa_<?php echo $i ?>" value="<?php echo $siswa_view->idsiswa ?>">
												<input type="text" id="idpelajaran_<?php echo $i ?>" name="idpelajaran_<?php echo $i ?>" value="<?php echo $siswa_view->idpelajaran ?>">
												<input type="text" id="jmldata" name="jmldata" value="<?php echo $jmldata ?>">
											</div>
												                                            
	                                        <tr>
	                                            <td align="center"><?php echo $i+1 ?></td>
	                                            <td><?php echo $siswa_view->nis ?></td>
												<td><?php echo $siswa_view->nisn ?></td>
												<td><?php echo $siswa_view->nama ?></td>
												<td><?php echo $kelamin ?></td>
												<td><?php echo $siswa_view->tingkat ?></td>
												<td <?php echo $bgcolor ?>><?php echo $siswa_view->kelas ?></td>
												<td><?php echo $siswa_view->nama_pelajaran ?></td>
												<td><?php echo $pembina_view->nama_guru ?></td>
												<td <?php echo $bg_color ?> >
													<input type="text" maxlength="1" size="5" id="nilai_<?php echo $i ?>" name="nilai_<?php echo $i ?>" autocomplete="off" class="form-control" onblur="checklist(<?php echo $i ?>)" onKeyup="this.value=this.value.toUpperCase()" style="text-align: center" value="<?php echo $nilai ?>" />
												</td>
												<td align="center">
	                                            
	                                                <?php if (allowupd('frmsiswa')==1 || allowupd('frmsiswa_ekstrakurikuler')==1) { ?>
	    												<a href="<?php echo $__folder ?><?php echo obraxabrix('siswa_ekstrakurikuler') ?>/<?php echo $siswa_view->replid ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
	    													<span class="green">
	    														<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
	    													</span>
	    												</a>
	                                                <?php } ?>
	                                                
	                                                <?php if (allowdel('frmsiswa')==1 || allowdel('frmsiswa_ekstrakurikuler')==1) { ?>    
	                                                    &nbsp;
	    												<a href="JavaScript:hapus('<?php echo $siswa_view->replid ?>','<?php echo $siswa_view->idsiswa ?>')" class="tooltip-error" data-rel="tooltip" title="Delete">
	    													<span class="red">
	    														<i class="ace-icon fa fa-trash-o bigger-120"></i>
	    													</span>
	    												</a>
	                                                <?php } ?>
	                                            </td>
	                                            
											</tr>
	                                    
	                                    <?php
	                                    		$i++;
	                                        }
	                                    ?>
	                                    
								</tbody>
							</table>
							
							<div id="replid_id_id"></div>
							<div id="nilai_id_id"></div>
							<div id="idsiswa_id"></div>
							<div id="idpelajaran_id"></div>
							
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
			                        
			                        <?php if (allowadd('frmsiswa_ekstrakurikuler')==1) { ?>
			    						<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update Nilai" />
			                        <?php } ?>
			                                 
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
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
			  null, null, null, null, null, null, null, null, null,  //kalau nambah kolom, null ditambahkan
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
