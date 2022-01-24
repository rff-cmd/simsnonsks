<script type="text/javascript" src="js/buttonajax.js"></script>

<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "<?php echo $__folder ?><?php echo obraxabrix(siswa_view) ?>/xm8r389xemx23xb2378e23/"+id+" ";
		}
	}
</script>

<script>
	//export raport
	function export_raport(idsiswa) {	
		//var idsiswa		=	document.getElementById('idsiswa').value;
		
		newWindow('app/raport_siswa_xls.php?idsiswa='+ idsiswa +' ','Import User Guru','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
	}
	
	function print_raport(idsiswa) {
		var semester_id		=	document.getElementById('semester_id').value;
		var idtingkat		=	document.getElementById('idtingkat2').value;
		var idkelas2		=	document.getElementById('idkelas2').value;
		var idtahunajaran	=	document.getElementById('idtahunajaran2').value;
		var alumni			=	document.getElementById('alumni').checked;
		if(alumni == true) {
			alumni = 1
		} else {
			alumni = 0;
		}
		
		window.open('<?php echo $__folder ?>app/raport_siswa_print.php?idsiswa='+idsiswa+'&semester_id='+semester_id+'&idkelas='+idkelas2+'&idtahunajaran='+idtahunajaran+'&alumni='+alumni+'&idtingkat='+idtingkat, 'Raport Print','825','450','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
	
	function print_raport_absensi(idsiswa) {
		var semester_id		=	document.getElementById('semester_id').value;
		var idtingkat		=	document.getElementById('idtingkat2').value;
		var idkelas2		=	document.getElementById('idkelas2').value;
		var idtahunajaran	=	document.getElementById('idtahunajaran2').value;
		var alumni			=	document.getElementById('alumni').checked;
		if(alumni == true) {
			alumni = 1
		} else {
			alumni = 0;
		}
		
		window.open('<?php echo $__folder ?>app/raport_siswa_absensi_print.php?idsiswa='+idsiswa+'&semester_id='+semester_id+'&idkelas='+idkelas2+'&idtahunajaran='+idtahunajaran+'&alumni='+alumni+'&idtingkat='+idtingkat, 'Absensi Raport Print','825','450','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
	
	function print_raport_aspek(idsiswa) {
		var semester_id		=	document.getElementById('semester_id').value;
		var idtingkat		=	document.getElementById('idtingkat2').value;
		var idkelas2		=	document.getElementById('idkelas2').value;
		var idtahunajaran	=	document.getElementById('idtahunajaran2').value;
		var alumni			=	document.getElementById('alumni').checked;
		if(alumni == true) {
			alumni = 1
		} else {
			alumni = 0;
		}
		
		window.open('<?php echo $__folder ?>app/raport_siswa_aspek_print.php?idsiswa='+idsiswa+'&semester_id='+semester_id+'&idkelas='+idkelas2+'&idtahunajaran='+idtahunajaran+'&alumni='+alumni+'&idtingkat='+idtingkat, 'Raport Aspek Print','825','450','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
	
	function print_raport_kelas(idtingkat,idkelas) {
		var idtingkat_old	=	document.getElementById('idtingkat').value;
		var semester_id		=	document.getElementById('semester_id').value;
		var idkelas_old		=	document.getElementById('idkelas').value;
		
		var idtingkat		=	document.getElementById('idtingkat2').value;
		var idkelas			=	document.getElementById('idkelas2').value;
		var idtahunajaran	=	document.getElementById('idtahunajaran2').value;
		
		window.open('<?php echo $__folder ?>app/raport_siswa_kelas_print.php?idtingkat='+idtingkat_old+'&idkelas='+idkelas_old+'&semester_id='+semester_id+'&idtingkat_new='+idtingkat+'&idkelas_new='+idkelas+'&idtahunajaran='+idtahunajaran, 'Raport Kelas Print','825','450','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
	
	function print_raport_absensi_kelas(idtingkat,idkelas) {
		var idtingkat_old	=	document.getElementById('idtingkat').value;
		var semester_id		=	document.getElementById('semester_id').value;
		var idkelas_old		=	document.getElementById('idkelas').value;
		
		var idtingkat		=	document.getElementById('idtingkat2').value;
		var idkelas			=	document.getElementById('idkelas2').value;
		var idtahunajaran	=	document.getElementById('idtahunajaran2').value;
		
		window.open('<?php echo $__folder ?>app/raport_siswa_absensi_kelas_print.php?idtingkat='+idtingkat_old+'&idkelas='+idkelas_old+'&semester_id='+semester_id+'&idtingkat_new='+idtingkat+'&idkelas_new='+idkelas+'&idtahunajaran='+idtahunajaran, 'Raport Absensi Print','825','450','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
	
	function print_raport_aspek_kelas(idtingkat,idkelas) {
		var idtingkat_old	=	document.getElementById('idtingkat').value;
		var semester_id		=	document.getElementById('semester_id').value;
		var idkelas_old		=	document.getElementById('idkelas').value;
		
		var idtingkat		=	document.getElementById('idtingkat2').value;
		var idkelas			=	document.getElementById('idkelas2').value;
		var idtahunajaran	=	document.getElementById('idtahunajaran2').value;
		
		window.open('<?php echo $__folder ?>app/raport_siswa_aspek_kelas_print.php?idtingkat='+idtingkat_old+'&idkelas='+idkelas_old+'&semester_id='+semester_id+'&idtingkat_new='+idtingkat+'&idkelas_new='+idkelas+'&idtahunajaran='+idtahunajaran, 'Invoice Print','825','450','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
	
	function print_raport_cover(idsiswa) {
		//var idsiswa		=	document.getElementById('idsiswa').value;
		var idtahunajaran	=	document.getElementById('idtahunajaran2').value;
		var idtingkat		=	document.getElementById('idtingkat2').value;
		var semester_id		=	document.getElementById('semester_id').value;
		var alumni			=	document.getElementById('alumni').checked;
		if(alumni == true) {
			alumni = 1
		} else {
			alumni = 0;
		}
		
		window.open('<?php echo $__folder ?>app/raport_siswa_cover_print.php?idsiswa='+idsiswa+'&semester_id='+semester_id+'&idtingkat='+idtingkat+'&idtahunajaran='+idtahunajaran, 'Invoice Print','825','450','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
	
	function print_raport_cover_kelas(idtingkat,idkelas) {
		var idtahunajaran	=	document.getElementById('idtahunajaran2').value;
		var idtingkat_old	=	document.getElementById('idtingkat').value;
		var semester_id		=	document.getElementById('semester_id').value;
		
		window.open('<?php echo $__folder ?>app/raport_siswa_cover_kelas_print.php?idtingkat='+idtingkat+'&idkelas='+idkelas+'&semester_id='+semester_id+'&idtingkat='+idtingkat_old+'&idtahunajaran='+idtahunajaran, 'Raport Print Cover','825','450','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
	
	
	function export_raport(idsiswa) {	
		//var idsiswa		=	document.getElementById('idsiswa').value;
		
		newWindow('app/raport_siswa_xls.php?idsiswa='+ idsiswa +' ','Import User Guru','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
	}
	
	function print_raport_pts(idsiswa) {
		var semester_id		=	document.getElementById('semester_id').value;
		var idtingkat		=	document.getElementById('idtingkat2').value;
		var idkelas2		=	document.getElementById('idkelas2').value;
		var idtahunajaran	=	document.getElementById('idtahunajaran2').value;
		var alumni			=	document.getElementById('alumni').checked;
		if(alumni == true) {
			alumni = 1
		} else {
			alumni = 0;
		}
		
		window.open('<?php echo $__folder ?>app/raport_siswa_pts_print.php?idsiswa='+idsiswa+'&semester_id='+semester_id+'&idkelas='+idkelas2+'&idtahunajaran='+idtahunajaran+'&alumni='+alumni+'&idtingkat='+idtingkat, 'Rapor PTS Print','825','450','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
	
</script>

<?php
$idangkatan1	= $_POST['idangkatan1'];
$idtahunajaran 	= $_POST['idtahunajaran2'];
$idtingkat2		= $_REQUEST['idtingkat2'];
$idkelas2		= $_REQUEST['idkelas2'];
$semester_id	= $_POST['semester_id'];
$nama2			= $_REQUEST['nama2'];
$alumni			= $_REQUEST['alumni'];
$all			= $_REQUEST['all'];

$all2 = "";
if($all == 1) {
	$all2 = "checked";
}

$alumni2 = "";
if($alumni == 1) {
	$alumni2 = "checked";
}

if($_SESSION["adm"] == 0) {
	if($_SESSION["tipe_user"] == "Siswa") {
		$idangkatan1	= $_POST['idangkatan1'];
		$idtahunajaran 	= $_SESSION['idtahunajaran'];
		$idkelas2		= $_SESSION["idkelas"];
		$idtingkat2 	= $_SESSION["idtingkat"];
		$semester_id	= $_SESSION["semester_id"];
		$nama2 			= $_SESSION["nama"];	
		$all			= "";
		$all2 			= "";
	}
	
	if($_SESSION["tipe_user"] == "Guru") {
		if(!empty($_SESSION["idpegawai"])) {
			$sqlpeg = $select->list_pegawai($_SESSION["idpegawai"]);
			$datapeg = $sqlpeg->fetch(PDO::FETCH_OBJ);
			
			$sqlpa=$select->list_kelas("", "", $datapeg->nip);
			$datapa=$sqlpa->fetch(PDO::FETCH_OBJ);
			
			$idtahunajaran 	= $_SESSION['idtahunajaran'];		
			$semester_id= $_SESSION["semester_id"];
			$idkelas2	= $datapa->replid;
			$idtingkat2 = $datapa->idtingkat;
			$nama2		= $_REQUEST['nama2'];
			//$nis		= $_REQUEST['nis'];
			$nik		= $_REQUEST['nik'];
			$all		= "";
			$all2 		= "";
		}
		
	}
}

/*if($idtahunajaran == "") {
	$idtahunajaran = $_SESSION["idtahunajaran"];
}*/

?>

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

<?php
//include 'class/class.protection.php';
$protection=new protection;
?>

<div class="page-content">						
	<div class="row">
		<div class="col-xs-12">
                
            <?php
				$delete = $segmen3; //$_REQUEST['mxKz'];
				if ($delete == "xm8r389xemx23xb2378e23") {
					include 'class/class.delete.php';
					$delete2=new delete;
					$delete2->delete_siswa($segmen4);
			?>
					<div class="alert alert-success">
						<strong>Delete Data successfully</strong>
					</div>
                    
                    <!--<meta http-equiv="Refresh" content="0;url=main.php?menu=app&act=<?php echo obraxabrix('siswa_view') ?>" />-->
			<?php
                    
                    
				}
			?>
                
			<!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-xs-12">
				
					<?php
						$date = date("d-m-Y");
						if($protection->setup_periode_tingkat("RAPORT_SISWA", $date, '', $_SESSION["idtingkat"]) == 1 || $_SESSION["adm"] == 1) {
								
					?>
				
							<form class="form-horizontal" role="form" action="" method="post" name="siswa_lis" id="siswa_list" enctype="multipart/form-data" >
							
								<input type="hidden" id="idtingkat" name="idtingkat" value="<?php echo $idtingkat2 ?>" />
								<input type="hidden" id="idkelas" name="idkelas" value="<?php echo $idkelas2 ?>" />
				            	<input type="hidden" id="idtahunajaran" name="idtahunajaran" value="<?php echo $idtahunajaran ?>" />
				            	
				            	<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Angkatan</label>
									<div class="col-sm-4">
										<select name="idangkatan1" id="idangkatan1" class="chosen-select form-control" >
											<option value=""></option>
											<?php select_angkatan($idangkatan1); ?>
										</select>
									</div>
								</div>
											
				            	<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tahun Ajaran</label>
									<div class="col-lg-2">
										<select name="idtahunajaran2" id="idtahunajaran2" class="chosen-select form-control" />
											<option value=""></option>
											<?php select_thnajaran($idtahunajaran); ?>
										</select>
									</div>
								</div>
								
								<?php 
									if($_SESSION["tipe_user"] == "Guru" && $_SESSION["adm"] == 0) { 
										include('raport_siswa_filter_guru.php');
									} else {
										include('raport_siswa_filter.php');
									}	
								?>
				            	
								<?php if($_SESSION["tipe_user"] != "Siswa" && $_SESSION["tipe_user"] != "Guru") { ?>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Cetak Raport per Tingkat/Kelas</label>
					                    <div class="col-sm-8">
					                      <a href="JavaScript:print_raport_kelas('<?php echo $idtingkat2 ?>','<?php echo $idkelas2 ?>')" class="tooltip-error" data-rel="tooltip" title="Print Raport">
				            					<i class="ace-icon fa fa-print bigger-250" ></i>
												Cetak Raport
										  </a>
										  &nbsp;&nbsp;&nbsp;
										  <a href="JavaScript:print_raport_absensi_kelas('<?php echo $idtingkat2 ?>','<?php echo $idkelas2 ?>')" class="tooltip-error" data-rel="tooltip" title="Print Raport">
				            					<i class="ace-icon fa fa-print bigger-250" ></i>
												Cetak Raport Absen
										  </a>
										  &nbsp;&nbsp;&nbsp;
										  <a href="JavaScript:print_raport_aspek_kelas('<?php echo $idtingkat2 ?>','<?php echo $idkelas2 ?>')" class="tooltip-error" data-rel="tooltip" title="Print Raport">
				            					<i class="ace-icon fa fa-print bigger-250" ></i>
												Cetak Raport Aspek
										  </a>							  
										  &nbsp;&nbsp;&nbsp;
										  <a href="JavaScript:print_raport_cover_kelas('<?php echo $idtingkat2 ?>','<?php echo $idkelas2 ?>')" class="tooltip-error" data-rel="tooltip" title="Print Raport Cover">
				            					<i class="ace-icon fa fa-print bigger-250" ></i>
												Cetak Raport Cover
										  </a>
					                    </div>  
									</div>
								<?php } ?>
								
							</form>
					<?php
						} else {
							$message = '<font color="#ff0000" style="font-size: 20px">' . "Lihat Rapor Siswa belum diizinkan !";
							$message = $message . "</font>";
							echo $message;
						}
					?>
				
				</div>
			</div>
			
			
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
                                    <th class="center" style="font-weight:bold ">No.</th>
                                    <th>NIS</th>
                                    <th>NISN</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tingkat</th>
                                    <th>Kelas</th>
                                    <th>PTS</th>
									<th>Raport</th>
									<th>Absen</th>
									<th>Aspek</th>
									<th>Cover</th>
								</tr>
							</thead>

							<tbody>
                                <?php			
									$sql=$selectview->list_siswa('', '', $idtingkat2, $idkelas2, $nama2, $all, 'SMA', '', '', '1', $alumni, '', $idangkatan1); //$idtahunajaran
									while($siswa_view=$sql->fetch(PDO::FETCH_OBJ)){
									
									$i++;
										if($siswa_view->kelamin == "P") {
											$kelamin = "Perempuan";
										} else {
											$kelamin = "Laki-laki";
										}
										
								?>
                                            
                                        <tr>
                                            <td align="center"><?php echo $i ?></td>
                                            <td><?php echo $siswa_view->nis ?></td>
											<td><?php echo $siswa_view->nisn ?></td>
											<td><?php echo $siswa_view->nama ?></td>
											<td><?php echo $kelamin ?></td>
											<td><?php echo $siswa_view->tingkat ?></td>
											<td <?php echo $bgcolor ?>><?php echo $siswa_view->kelas ?></td>
											<td align="center">
                                            	<a href="JavaScript:print_raport_pts('<?php echo $siswa_view->replid ?>')" class="tooltip-error" data-rel="tooltip" title="Print Rapor PTS">
                                            		<span class="red">
														<i class="ace-icon glyphicon glyphicon-print bigger-120"></i>
													</span>
												</a>
											</td>
											<td align="center">
                                            	<a href="JavaScript:print_raport('<?php echo $siswa_view->replid ?>')" class="tooltip-error" data-rel="tooltip" title="Print Raport">
                                            		<?php /*if($protection->print_raport_siswa($idtingkat2, $idkelas2, '', $siswa_view->replid, '4') < 75) { ?>
						            					<span class="red">
															<i class="ace-icon glyphicon glyphicon-print bigger-120"></i>
														</span>
													<?php } else {*/ ?>
														<span class="green">
															<i class="ace-icon glyphicon glyphicon-print bigger-120"></i>
														</span>
													<?php //} ?>
												</a>
											</td>
                                            
                                            <td align="center">    
                                                <a href="JavaScript:print_raport_absensi(<?php echo $siswa_view->replid ?>)" class="tooltip-error" data-rel="tooltip" title="Print Raport">
					            					<span class="green">
														<i class="ace-icon glyphicon glyphicon-print bigger-120"></i>
													</span>
												</a>
											</td>
											
											<td align="center">	
												<a href="JavaScript:print_raport_aspek(<?php echo $siswa_view->replid ?>)" class="tooltip-error" data-rel="tooltip" title="Print Raport Aspek">
					            					<span class="green">
														<i class="ace-icon glyphicon glyphicon-print bigger-120"></i>
													</span>
												</a>
                                            </td>
                                            
                                            <td align="center">	
												<a href="JavaScript:print_raport_cover(<?php echo $siswa_view->replid ?>)" class="tooltip-error" data-rel="tooltip" title="Print Cover">
					            					<span class="green">
														<i class="ace-icon glyphicon glyphicon-print bigger-120"></i>
													</span>
												</a>
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
			  null, null, null, null, null, null, null, null, null, null,  //kalau nambah kolom, null ditambahkan
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
