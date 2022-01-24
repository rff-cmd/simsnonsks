<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

// $old_ref 		=	$_GET['old_ref'];
// $ref_parstock 	=	$_GET['ref'];
// $location_id 	=	$_GET['location_id_hd'];

include_once ("../import/excel_reader2.php");

function dateFormat($date)
{
    $m = preg_replace('/[^0-9]/', '', $date);
    if (preg_match_all('/\d{2}+/', $m, $r)) {
        $r = reset($r);
        if (count($r) == 4) {
            if ($r[2] <= 12 && $r[3] <= 31) return "$r[0]$r[1]-$r[2]-$r[3]"; // Y-m-d
            if ($r[0] <= 31 && $r[1] != 0 && $r[1] <= 12) return "$r[2]$r[3]-$r[1]-$r[0]"; // d-m-Y
            if ($r[0] <= 12 && $r[1] <= 31) return "$r[2]$r[3]-$r[0]-$r[1]"; // m-d-Y
            if ($r[2] <= 31 && $r[3] <= 12) return "$r[0]$r[1]-$r[3]-$r[2]"; //Y-m-d
        }

        $y = $r[2] >= 0 && $r[2] <= date('y') ? date('y') . $r[2] : (date('y') - 1) . $r[2];
        if ($r[0] <= 31 && $r[1] != 0 && $r[1] <= 12) return "$y-$r[1]-$r[0]"; // d-m-y
    }
}


?>

<?php
	@session_start();

	if (($_SESSION["logged"] == 0)) {
		echo 'Access denied';
		exit;
	}

	include_once ("../app/include/sambung.php");
	include_once ("../app/include/functions.php");
	include_once ("../app/include/inword.php");

	include_once ("../app/class/class.select.php");
	include_once ("../app/class/class.selectview.php");

	/*$location_id = $_SESSION["central_id"];
	$location_id1 = $_SESSION["unit_id"];*/
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
		  
		  if (document.getElementById(arrf[i]).name=='file') {
			alert('File Excel masih kosong!');				
		  }
		  
		  return false
		} 
										
	  }		
	  
	   
	}
		
</script>

<?php
	// membaca file excel yang diupload
	$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

	// membaca jumlah baris dari data excel
	$baris = $data->rowcount($sheet_index=0);

	// nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
	$sukses = 0;
	$gagal = 0;
?>

<div class="page-content">
      
	<div class="row">
		<div class="col-xs-12">
                 
			<!-- PAGE CONTENT BEGINS -->
			<form class="form-horizontal" role="form" action="" method="post" name="client_cheque" id="client_cheque" enctype="multipart/form-data">
            	
            	<input type="hidden" id="location_id" name="location_id" value="<?php echo $location_id ?>">

            	<!-- <div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Gudang Central *)</label>
					<div class="col-sm-4">
						<select id="location_idx" name="location_idx" disabled class="chosen-select form-control" >
							<option value=""></option>
							<?php //select_location_central($location_id); ?>
						</select>								
					</div>
				</div> -->
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Upload File</label>
					<div class="col-sm-3">
						<input type="file" name="userfile" id="userfile" accept=".xls">
					</div>
				</div>
									
				<div class="clearfix form-actions">
					<div class="col-md-offset-3 col-md-9">
                        <input type="submit" name="submit" id="submit" class='btn btn-primary' value="Upload" />
					</div>
				</div>
				

			</form>
			
			<?php
				if($_POST["submit"]) {

					date_default_timezone_set('Asia/Jakarta');
					
					$select 	= new select;
					$selectview = new selectview;

					$dbpdo = DB::create();
					
				    $x = 9;
					for ($i=2; $i<=$baris; $i++)
					{    
						$x++;
						$uid = "import";
						$dlu = date("Y-m-d H:i:s");
						$active = "1";
						
						$departemen 		=	"SMA";
						$idtingkat 			= 	$data->val(4, 2);
						$idkelas 			=	$data->val(4, 4);
						$idsemester 		=	$data->val(4, 6);
						$idtahunajaran  	=	$data->val(4, 8);
						$idkompetensi 		=	0;
						$idjeniskompetensi 	=	1;
						$n1 				=	0;
						$n2 				=	0;
						$n3 				=	0;
						$n4 				=	0;
						$uts 				=	0;
						$jumlah 			=	0;
						$rata 				=	0;
						$persen 			=	0;
						$uas 				=	0;
						$persen1 			=	0;
						$a 					=	0;
						$sakit 				=	0;
						$izin 				=	0;
						$alpa 				=	0;
						$dispensasi 		=	0;
						$sikap 				=	"";

						$nama 	= petikreplace($data->val($i, 2));
						$nis 	= $data->val($i, 3);

						$sqlstr = "select a.replid, a.idkelas, b.idtingkat from siswa a left join kelas b on a.idkelas=b.replid where a.nis='$nis'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$data_siswa = $sql->fetch(PDO::FETCH_OBJ);
						$nis = $data_siswa->replid;

						$mapel_agama 	= 7; //$data->val(7, 4);
						$mapel_pkn		= 123; //$data->val(7, 8);
						$mapel_bhs_indo	= 47; //$data->val(7, 12);
						$mapel_matematika = 46;
						$mapel_sejarah_indo = 62;
						$mapel_inggris = 48;
						$mapel_seni = 69;
						$mapel_jasmani = 70;
						$mapel_wirausaha = 66;
						$mapel_geografi = 68;
						$mapel_sejarah = 115;
						$mapel_sosiologi = 116;
						$mapel_ekonomi = 67;
						$mapel_sastra_inggris = 118;
						$mapel_jerman = 50;

						if($x>=10) {
							$t=0;
							for($y=4; $y<=63; $y++) {
								
								if($nis != '') {

									if($i >=10) {

										if( (7+$t) == 7) {
											$idpelajaran = $mapel_agama;
										}
										if( (7+$t) == 11) {
											$idpelajaran = $mapel_pkn;
										}
										if( (7+$t) == 15) {
											$idpelajaran = $mapel_bhs_indo;
										}
										if( (7+$t) == 19) {
											$idpelajaran = $mapel_matematika;
										}
										if( (7+$t) == 23) {
											$idpelajaran = $mapel_sejarah_indo;
										}
										if( (7+$t) == 27) {
											$idpelajaran = $mapel_inggris;
										}
										if( (7+$t) == 31) {
											$idpelajaran = $mapel_seni;
										}
										if( (7+$t) == 35) {
											$idpelajaran = $mapel_jasmani;
										}
										if( (7+$t) == 39) {
											$idpelajaran = $mapel_wirausaha;
										}
										if( (7+$t) == 43) {
											$idpelajaran = $mapel_geografi;
										}
										if( (7+$t) == 47) {
											$idpelajaran = $mapel_sejarah;
										}
										if( (7+$t) == 51) {
											$idpelajaran = $mapel_sosiologi;
										}
										if( (7+$t) == 55) {
											$idpelajaran = $mapel_ekonomi;
										}
										if( (7+$t) == 59) {
											$idpelajaran = $mapel_sastra_inggris;
										}
										if( (7+$t) == 63) {
											$idpelajaran = $mapel_jerman;
										}
										if( (7+$t) > 63) {
											$idpelajaran = "";
										}
										//echo (7+$t).'<br>';

										if($idpelajaran != "") {
											$iddasarpenilaian 	=	3; //pengetahuan
											$na = numberreplace($data->val($i, (4+$t)));
											$predikat = $data->val($i, (5+$t));	
											$line = ($t+1); 

											$sqlstr = "select nis from daftarnilai where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran'";
											$sql=$dbpdo->prepare($sqlstr);
											$sql->execute();
											$rows = $sql->rowCount();
											if($rows == 0) {
												$sqlstr = "insert into daftarnilai (departemen, idtingkat, idkelas, idtahunajaran, idsemester, nis, idkompetensi, idjeniskompetensi, iddasarpenilaian, idpelajaran, n1, n2, n3, n4, uts, jumlah, rata, persen, uas, persen1, na, a, sakit, izin, alpa, dispensasi, sikap, predikat, uid, dlu, line) values ('$departemen', '$idtingkat', '$idkelas', '$idtahunajaran', '$idsemester', '$nis', '$idkompetensi', '$idjeniskompetensi', '$iddasarpenilaian', '$idpelajaran', '$n1', '$n2', '$n3', '$n4', '$uts', '$jumlah', '$rata', '$persen', '$uas', '$persen1', '$na', '$a', '$sakit', '$izin', '$alpa', '$dispensasi', '$sikap', '$predikat', '$uid', '$dlu', '$line')";
												$sql=$dbpdo->prepare($sqlstr);
												$sql->execute();
											}
											//echo $line.'>>'.$nis.'>>'.$nama.'|'.$na.'/'.$iddasarpenilaian.'/'.$idpelajaran.'<br>';
											//----------------PENGETAHUAN--------------


											/*$predikat = $data->val($i, (5+$t));	
											$line = ($t+2);								
											echo $line.'>>'.$nis.'>>'.$nama.'|'.$predikat.'/'.$iddasarpenilaian.'/'.$idpelajaran.'<br>';*/

											//========================================
											$iddasarpenilaian 	=	4; //keterampilan
											$na = numberreplace($data->val($i, (6+$t)));
											$line = ($t+2);
											//echo $line.'>>'.$nis.'>>'.$nama.'|'.$na.'/'.$iddasarpenilaian.'/'.$idpelajaran.'<br>';
											$predikat = $data->val($i, (7+$t));
											/*$line = ($t+4);
											echo $line.'>>'.$nis.'>>'.$nama.'|'.$predikat.'/'.$iddasarpenilaian.'/'.$idpelajaran.'<br>';*/

											$sqlstr = "select nis from daftarnilai where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran'";
											$sql=$dbpdo->prepare($sqlstr);
											$sql->execute();
											$rows = $sql->rowCount();
											if($rows == 0) {
												$sqlstr = "insert into daftarnilai (departemen, idtingkat, idkelas, idtahunajaran, idsemester, nis, idkompetensi, idjeniskompetensi, iddasarpenilaian, idpelajaran, n1, n2, n3, n4, uts, jumlah, rata, persen, uas, persen1, na, a, sakit, izin, alpa, dispensasi, sikap, predikat, uid, dlu, line) values ('$departemen', '$idtingkat', '$idkelas', '$idtahunajaran', '$idsemester', '$nis', '$idkompetensi', '$idjeniskompetensi', '$iddasarpenilaian', '$idpelajaran', '$n1', '$n2', '$n3', '$n4', '$uts', '$jumlah', '$rata', '$persen', '$uas', '$persen1', '$na', '$a', '$sakit', '$izin', '$alpa', '$dispensasi', '$sikap', '$predikat', '$uid', '$dlu', '$line')";
												$sql=$dbpdo->prepare($sqlstr);
												$sql->execute();
											}
											//----------------KETERAMPILAN--------------
										}




										
									}
								}

								/*$pengetahuan_nilai = $data->val($i, 4);
								$pengetahuan_predikat = $data->val($i, 5);
								$keterampilan_nilai = $data->val($i, 6);
								$keterampilan_predikat = $data->val($i, 7);

								echo $nis.'>>'.$nama.'|'.$pengetahuan_nilai.'|'.$pengetahuan_predikat.'|'.$keterampilan_nilai.'|'.$keterampilan_predikat.'<br>';	

								$pengetahuan_nilai = $data->val($i, 8);
								$pengetahuan_predikat = $data->val($i, 9);
								$keterampilan_nilai = $data->val($i, 10);
								$keterampilan_predikat = $data->val($i, 11);

								echo $nis.'>>'.$nama.'|'.$pengetahuan_nilai.'|'.$pengetahuan_predikat.'|'.$keterampilan_nilai.'|'.$keterampilan_predikat.'<br>';*/	

								$t = $t + 4;		

							}
							

							$sukses++;

							/*for($y=8; $y<=11; $y++) {
								$pengetahuan_nilai = $data->val($i, 8);
								$pengetahuan_predikat = $data->val($i, 9);
								$keterampilan_nilai = $data->val($i, 10);
								$keterampilan_predikat = $data->val($i, 11);								
							}
							echo $nis.'>>'.$nama.'|'.$pengetahuan_nilai.'|'.$pengetahuan_predikat.'|'.$keterampilan_nilai.'|'.$keterampilan_predikat.'<br>';*/
						}

						/*echo 'mapel>>'.$mapel.'<br>';
						echo 'mapel1>>'.$mapel1.'<br>';
						echo 'mapel2>>'.$mapel2.'<br>';*/
						

					  
					 }
				?>    


					<table align="center" style="font-size: 36px; color: #07581c">
						<tr>
							<td><?php echo "Jumlah Proses Data : " . $sukses; ?></td>
						</tr>
						<tr>
							<td><?php echo "Jumlah Update Data : " . $gagal; ?></td>
						</tr>
					</table>

				<?php    
				}
				?>
            
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->



<!--[if !IE]> -->
<script type="text/javascript">
	window.jQuery || document.write("<script src='../<?php echo $__folder ?>assets/js/jquery.min.js'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='../<?php echo $__folder ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="../<?php echo $__folder ?>assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
  <script src="../<?php echo $__folder ?>assets/js/excanvas.min.js"></script>
<![endif]-->
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
		$('#id-disable-check').on('click', function() {
			var inp = $('#form-input-readonly').get(0);
			if(inp.hasAttribute('disabled')) {
				inp.setAttribute('readonly' , 'true');
				inp.removeAttribute('disabled');
				inp.value="This text field is readonly!";
			}
			else {
				inp.setAttribute('disabled' , 'disabled');
				inp.removeAttribute('readonly');
				inp.value="This text field is disabled!";
			}
		});
	
	
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
	
	
		$('[data-rel=tooltip]').tooltip({container:'body'});
		$('[data-rel=popover]').popover({container:'body'});
		
		$('textarea[class*=autosize]').autosize({append: "\n"});
		$('textarea.limited').inputlimiter({
			remText: '%n character%s remaining...',
			limitText: 'max allowed : %n.'
		});
	
		$.mask.definitions['~']='[+-]';
		$('.input-mask-date').mask('99/99/9999');
		$('.input-mask-phone').mask('(999) 999-9999');
		$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
		$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
	
	
	
		$( "#input-size-slider" ).css('width','200px').slider({
			value:1,
			range: "min",
			min: 1,
			max: 8,
			step: 1,
			slide: function( event, ui ) {
				var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
				var val = parseInt(ui.value);
				$('#form-field-4').attr('class', sizing[val]).val('.'+sizing[val]);
			}
		});
	
		$( "#input-span-slider" ).slider({
			value:1,
			range: "min",
			min: 1,
			max: 12,
			step: 1,
			slide: function( event, ui ) {
				var val = parseInt(ui.value);
				$('#form-field-5').attr('class', 'col-xs-'+val).val('.col-xs-'+val);
			}
		});
	
	
		
		//"jQuery UI Slider"
		//range slider tooltip example
		$( "#slider-range" ).css('height','200px').slider({
			orientation: "vertical",
			range: true,
			min: 0,
			max: 100,
			values: [ 17, 67 ],
			slide: function( event, ui ) {
				var val = ui.values[$(ui.handle).index()-1] + "";
	
				if( !ui.handle.firstChild ) {
					$("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
					.prependTo(ui.handle);
				}
				$(ui.handle.firstChild).show().children().eq(1).text(val);
			}
		}).find('span.ui-slider-handle').on('blur', function(){
			$(this.firstChild).hide();
		});
		
		
		$( "#slider-range-max" ).slider({
			range: "max",
			min: 1,
			max: 10,
			value: 2
		});
		
		$( "#slider-eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
			// read initial values from markup and remove that
			var value = parseInt( $( this ).text(), 10 );
			$( this ).empty().slider({
				value: value,
				range: "min",
				animate: true
				
			});
		});
		
		$("#slider-eq > span.ui-slider-purple").slider('disable');//disable third item
	
		
		$('#photo , #photo_1, #photo_2, #photo_3, #photo_4').ace_file_input({
			no_file:'No File ...',
			btn_choose:'Choose',
			btn_change:'Change',
			droppable:false,
			onchange:null,
			thumbnail:false //| true | large
			//whitelist:'gif|png|jpg|jpeg'
			//blacklist:'exe|php'
			//onchange:''
			//
		});
		//pre-show a file name, for example a previously selected file
		//$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])
	
	
		$('#id-input-file-3').ace_file_input({
			style:'well',
			btn_choose:'Drop files here or click to choose',
			btn_change:null,
			no_icon:'ace-icon fa fa-cloud-upload',
			droppable:true,
			thumbnail:'small'//large | fit
			//,icon_remove:null//set null, to hide remove/reset button
			/**,before_change:function(files, dropped) {
				//Check an example below
				//or examples/file-upload.html
				return true;
			}*/
			/**,before_remove : function() {
				return true;
			}*/
			,
			preview_error : function(filename, error_code) {
				//name of the file that failed
				//error_code values
				//1 = 'FILE_LOAD_FAILED',
				//2 = 'IMAGE_LOAD_FAILED',
				//3 = 'THUMBNAIL_FAILED'
				//alert(error_code);
			}
	
		}).on('change', function(){
			//console.log($(this).data('ace_input_files'));
			//console.log($(this).data('ace_input_method'));
		});
		
		
		//$('#id-input-file-3')
		//.ace_file_input('show_file_list', [
			//{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
			//{type: 'file', name: 'hello.txt'}
		//]);
	
		
		
	
		//dynamically change allowed formats by changing allowExt && allowMime function
		$('#id-file-format').removeAttr('checked').on('change', function() {
			var whitelist_ext, whitelist_mime;
			var btn_choose
			var no_icon
			if(this.checked) {
				btn_choose = "Drop images here or click to choose";
				no_icon = "ace-icon fa fa-picture-o";
	
				whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
				whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
			}
			else {
				btn_choose = "Drop files here or click to choose";
				no_icon = "ace-icon fa fa-cloud-upload";
				
				whitelist_ext = null;//all extensions are acceptable
				whitelist_mime = null;//all mimes are acceptable
			}
			var file_input = $('#id-input-file-3');
			file_input
			.ace_file_input('update_settings',
			{
				'btn_choose': btn_choose,
				'no_icon': no_icon,
				'allowExt': whitelist_ext,
				'allowMime': whitelist_mime
			})
			file_input.ace_file_input('reset_input');
			
			file_input
			.off('file.error.ace')
			.on('file.error.ace', function(e, info) {
				//console.log(info.file_count);//number of selected files
				//console.log(info.invalid_count);//number of invalid files
				//console.log(info.error_list);//a list of errors in the following format
				
				//info.error_count['ext']
				//info.error_count['mime']
				//info.error_count['size']
				
				//info.error_list['ext']  = [list of file names with invalid extension]
				//info.error_list['mime'] = [list of file names with invalid mimetype]
				//info.error_list['size'] = [list of file names with invalid size]
				
				
				/**
				if( !info.dropped ) {
					//perhapse reset file field if files have been selected, and there are invalid files among them
					//when files are dropped, only valid files will be added to our file array
					e.preventDefault();//it will rest input
				}
				*/
				
				
				//if files have been selected (not dropped), you can choose to reset input
				//because browser keeps all selected files anyway and this cannot be changed
				//we can only reset file field to become empty again
				//on any case you still should check files with your server side script
				//because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
			});
		
		});
	
		$('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
		.closest('.ace-spinner')
		.on('changed.fu.spinbox', function(){
			//alert($('#spinner1').val())
		}); 
		$('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
		$('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
		$('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});
	
		//$('#spinner1').ace_spinner('disable').ace_spinner('value', 11);
		//or
		//$('#spinner1').closest('.ace-spinner').spinner('disable').spinner('enable').spinner('value', 11);//disable, enable or change value
		//$('#spinner1').closest('.ace-spinner').spinner('value', 0);//reset to 0
	
	
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
	
	
		$(".knob").knob();
		
		
		var tag_input = $('#form-field-tags');
		try{
			tag_input.tag(
			  {
				placeholder:tag_input.attr('placeholder'),
				//enable typeahead by specifying the source array
				source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
				/**
				//or fetch data from database, fetch those that match "query"
				source: function(query, process) {
				  $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
				  .done(function(result_items){
					process(result_items);
				  });
				}
				*/
			  }
			)
	
			//programmatically add a new
			var $tag_obj = $('#form-field-tags').data('tag');
			$tag_obj.add('Programmatically Added');
		}
		catch(e) {
			//display a textarea for old IE, because it doesn't support this plugin or another one I tried!
			tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
			//$('#form-field-tags').autosize({append: "\n"});
		}
		
		
		/////////
		$('#modal-form input[type=file]').ace_file_input({
			style:'well',
			btn_choose:'Drop files here or click to choose',
			btn_change:null,
			no_icon:'ace-icon fa fa-cloud-upload',
			droppable:true,
			thumbnail:'large'
		})
		
		//chosen plugin inside a modal will have a zero width because the select element is originally hidden
		//and its width cannot be determined.
		//so we set the width after modal is show
		$('#modal-form').on('shown.bs.modal', function () {
			if(!ace.vars['touch']) {
				$(this).find('.chosen-container').each(function(){
					$(this).find('a:first-child').css('width' , '210px');
					$(this).find('.chosen-drop').css('width' , '210px');
					$(this).find('.chosen-search input').css('width' , '200px');
				});
			}
		})
		/**
		//or you can activate the chosen plugin after modal is shown
		//this way select element becomes visible with dimensions and chosen works as expected
		$('#modal-form').on('shown', function () {
			$(this).find('.modal-chosen').chosen();
		})
		*/
	
		
		
		$(document).one('ajaxloadstart.page', function(e) {
			$('textarea[class*=autosize]').trigger('autosize.destroy');
			$('.limiterBox,.autosizejs').remove();
			$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
		});
	
	});
</script>
