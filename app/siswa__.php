<script type="text/javascript" src="<?php echo $__folder ?>js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='nama') {
			alert('Nama Siswa tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='idangkatan') {
			alert('Tahun Ajaran tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='nis') {
			alert('NIS tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='nik') {
			alert('NIK (Siswa) tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='idangkatan1') {
			alert('Angkatan tidak boleh kosong!');				
		  }
		  		  
		  return false
		} 
										
	  }		 
	  
	  	  	
		//validasi nilai UN
		/*var jmldata_un = document.getElementById('jmldata_un').value;
		if(jmldata_un > 0) {
			r=0;
			for(r=0; r<jmldata_un; r++) {
				
				//nama pelajaran
				var nama_un3 = document.getElementById('nama_un3_'+r).value;
				
				//nilai UN
	  			var nilai3 = document.getElementById('nilai3_'+r).value.replace(/[^\d.]/g,"");
				if(nilai3=='') { nilai3=0 }
				if(nilai3 <= 0) {
					alert('Nilai UN Mata Pelajaran ' + nama_un3 + ' belum diisi !' );
					return false;
				}
			}
		}*/
		
		
		//validasi nilai Raport Semester-3
		/*var jmldata_raport = document.getElementById('jmldata_raport').value;
		if(jmldata_raport > 0) {
			r=0;
			for(r=0; r<jmldata_raport; r++) {
		
				//nama pelajaran
				var nama = document.getElementById('nama_'+r).value;
				
				//nilai raport
	  			var nilai = document.getElementById('nilai_'+r).value.replace(/[^\d.]/g,"");
				if(nilai=='') { nilai=0 }
				if(nilai <= 0) {
					alert('Nilai Raport Semester-3, Mata Pelajaran : ' + nama + ' belum diisi !' );
					return false
				}
			}
		}*/
		
		
		//validasi nilai Raport Semester-4
		/*var jmldata_raport1 = document.getElementById('jmldata_raport1').value;
		if(jmldata_raport1 > 0) {
			r=0;
			for(r=0; r<jmldata_raport1; r++) {
		
				//nama pelajaran
				var nama1 = document.getElementById('nama1_'+r).value;
				
				//nilai raport
	  			var nilai1 = document.getElementById('nilai1_'+r).value.replace(/[^\d.]/g,"");
				if(nilai1=='') { nilai1=0 }
				if(nilai1 <= 0) {
					alert('Nilai Raport Semester-4, Mata Pelajaran : ' + nama1 + ' belum diisi !' );
					return false
				}
			}
		}*/
		
		
		//validasi nilai Raport Semester-5
		/*var jmldata_raport2 = document.getElementById('jmldata_raport2').value;
		if(jmldata_raport2 > 0) {
			r=0;
			for(r=0; r<jmldata_raport2; r++) {
		
				//nama pelajaran
				var nama2 = document.getElementById('nama2_'+r).value;
				
				//nilai raport
	  			var nilai2 = document.getElementById('nilai2_'+r).value.replace(/[^\d.]/g,"");
				if(nilai2=='') { nilai2=0 }
				if(nilai2 <= 0) {
					alert('Nilai Raport Semester-5, Mata Pelajaran : ' + nama2 + ' belum diisi !' );
					return false
				}
			}
		}*/
		
	  
	}
		
</script>

<script>
	function formatangka(field) {
		 //a = rci.amt.value;	 
		 a = document.getElementById(field).value;
		 //alert(a);
		 b = a.replace(/[^\d-.]/g,""); //b = a.replace(/[^\d]/g,"");
		 c = "";
		 panjang = b.length;
		 j = 0;
		 for (i = panjang; i > 0; i--)
		 {
			 j = j + 1;
			 if (((j % 3) == 1) && (j != 1))
			 {
			 	c = b.substr(i-1,1) + "," + c;
			 } else {
			 	c = b.substr(i-1,1) + c;
			 }
		 }
		 //rci.amt.value = c;
		 c = c.replace(",.",".");
		 c = c.replace(".,",".");
		 document.getElementById(field).value = c;		
		 
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

<script type="text/javascript">
	<!--
	var request;
	var dest;
	
	function loadHTMLPost3(URL, destination, button, getId, getId2){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;
		str2 = getId2 + '=' + document.getElementById(getId2).value;
		
		var str = str + '&button=' + button;
		var str2 = str2 + '&button=' + button;
		var str = str + '&' + str2;
				
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
			
	//-->	 
	
</script>
            
                        
<div class="page-content">
      
	<div class="row">
		<div class="col-xs-12">
            
            <?php 
				$ref = $segmen3; //$_GET['search'];
				
				//jika saat add data, maka data setelah save kosong
				if ($_POST['submit'] == 'Save') { $ref = ''; }
				//-----------------------------------------------/\
				
				$ref2 = notran(date('y-m-d'), 'frmsiswa', '', '', ''); //---get no ref
						
				include("app/exec/insert_siswa.php");
				
				$warga = "checked";
				$warga1 = "";
				$yatim = "";
				$yatim1 = "";
				$yatim2 = "";
				$yatim3 = "checked";
				$kesekolah = "";
				$kesekolah1 = "";
				
				$wnayah = "checked";
				$wnayah1 = "";
				$wnibu = "checked";
				$wnibu1 = "";
				$aktif = "checked";
				
				if ($ref != "") {
					$sql=$select->list_siswa('', $ref);
					$row_siswa=$sql->fetch(PDO::FETCH_OBJ);	
					
					$replid 		= $row_siswa->replid;
					$nis			= $row_siswa->nis;
					$tgllahir		= date("d-m-Y", strtotime($row_siswa->tgllahir));
					$tglijazah		= date("d-m-Y", strtotime($row_siswa->tglijazah));
					$tglskhun		= date("d-m-Y", strtotime($row_siswa->tglskhun));
					$tgllahirayah	= date("d-m-Y", strtotime($row_siswa->tgllahirayah));
					$tgllahiribu	= date("d-m-Y", strtotime($row_siswa->tgllahiribu));
					$tgllahirwali	= date("d-m-Y", strtotime($row_siswa->tgllahirwali));
					
					if($tgllahir=='01-01-1970') { $tgllahir = ''; }
					if($tglijazah=='01-01-1970') { $tglijazah = ''; }
					if($tglskhun=='01-01-1970') { $tglskhun = ''; }
					if($tgllahirayah=='01-01-1970') { $tgllahirayah = ''; }
					if($tgllahiribu=='01-01-1970') { $tgllahiribu = ''; }
					if($tgllahirwali=='01-01-1970') { $tgllahirwali = ''; }
					
					if($row_siswa->warga == 1) { $warga = "checked"; }
					if($row_siswa->warga == 2) { $warga1 = "checked"; }
					
					if($row_siswa->yatim == 1) { $yatim = "checked"; }
					if($row_siswa->yatim == 2) { $yatim1 = "checked"; }
					if($row_siswa->yatim == 3) { $yatim2 = "checked"; }
					if($row_siswa->yatim == 4) { $yatim3 = "checked"; }
					
					if($row_siswa->kesekolah == 1) { $kesekolah = "checked"; }
					if($row_siswa->kesekolah == 2) { $kesekolah1 = "checked"; }
					
					if($row_siswa->kps == 1) { $kps = "checked"; }
					if($row_siswa->kip == 1) { $kip = "checked"; }
					if($row_siswa->pip == 1) { $pip = "checked"; }
					
					if($row_siswa->wnayah == 1) { $wnayah = "checked"; }
					if($row_siswa->wnayah == 2) { $wnayah1 = "checked"; }
					
					if($row_siswa->wnibu == 1) { $wnibu = "checked"; }
					if($row_siswa->wnibu == 2) { $wnibu1 = "checked"; }
					
					$aktif = "";
					if($row_siswa->aktif == 1) {
						$aktif = "checked";
					}
				}		
			?>
            
			<!-- PAGE CONTENT BEGINS -->
			<form class="form-horizontal" role="form" action="" method="post" name="siswa" id="siswa" class="form-horizontal" enctype="multipart/form-data" onSubmit="return cekinput('idangkatan,idangkatan1,nis,nik,nama');" >
            	
            	<input type="hidden" id="replid" name="replid" value="<?php echo $row_siswa->replid ?>" >
				<input type="hidden" id="old_nis" name="old_nis" value="<?php echo $row_siswa->nis ?>" >
            	<input type="hidden" id="departemen" name="departemen" value="SMA" >
				
				<div class="row">
					<div class="col-sm-6">
						<div class="row">
						
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tahun Ajaran</label>
								<div class="col-sm-6">
									<select name="idangkatan" id="idangkatan" class="chosen-select form-control" >
										<option value=""></option>
										<?php select_thnajaran($row_siswa->idangkatan); ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Angkatan</label>
								<div class="col-sm-6">
									<select name="idangkatan1" id="idangkatan1" class="chosen-select form-control" >
										<option value=""></option>
										<?php select_angkatan($row_siswa->idangkatan1); ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Photo</label>
								<div class="col-sm-6">
									<input type="file" id="foto_file" name="foto_file" />
			                        <br />
			        				<?php if (!empty($row_siswa->foto_file)) { ?>
			        					<img src="app/photo_siswa/<?php echo $row_siswa->foto_file; ?>" width="150" height="150" />
			        				<?php } ?>
			                        <input size="25" type="hidden" id="photo2" name="photo2" value="<?php echo $row_siswa->foto_file; ?>">  
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">NIS *)</label>
								<div class="col-sm-6" id="nis_id">
									<?php if($ref == '') { ?>
										<input type="text" id="nis" name="nis" class="form-control" onblur="loadHTMLPost3('<?php echo $__folder ?>app/siswa_nis_ajax.php','nis_id','ceknis','replid','nis')" value="<?php echo $row_siswa->nis ?>">
									<?php } else { ?>
										<input type="text" id="nis" name="nis" class="form-control" onblur="loadHTMLPost3('<?php echo $__folder ?>app/siswa_nis_ajax_update.php','nis_id','ceknis','replid','nis')" value="<?php echo $row_siswa->nis ?>">
									<?php } ?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">NISN </label>
								<div class="col-sm-6" id="nisn_id">
									<?php if($ref == '') { ?>
										<input type="text" id="nisn" name="nisn" class="form-control" onblur="loadHTMLPost3('<?php echo $__folder ?>app/siswa_nis_ajax.php','nisn_id','ceknisn','replid','nisn')" value="<?php echo $row_siswa->nisn ?>">
									<?php } else { ?>
										<input type="text" id="nisn" name="nisn" class="form-control" onblur="loadHTMLPost3('<?php echo $__folder ?>app/siswa_nis_ajax_update.php','nisn_id','ceknisn','replid','nisn')" value="<?php echo $row_siswa->nisn ?>">
									<?php } ?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">NIK (Siswa) *)</label>
								<div class="col-sm-6">
									<input type="text" id="nik" name="nik" class="form-control" value="<?php echo $row_siswa->nik ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama *)</label>
								<div class="col-sm-6">
									<input type="text" id="nama" name="nama" class="form-control" value="<?php echo $row_siswa->nama ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Panggilan</label>
								<div class="col-sm-6">
									<input type="text" id="panggilan" name="panggilan" class="form-control" value="<?php echo $row_siswa->panggilan ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tingkat</label>
								<div class="col-sm-6">
									<select name="idtingkat" id="idtingkat" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/siswa_ajax.php','kelas_id','getkelas','idtingkat')" >
										<option value=""></option>
										<?php select_tingkat($row_siswa->idtingkat); ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kelas</label>
								<div class="col-sm-6" id="kelas_id">
									<select name="idkelas" id="idkelas" class="chosen-select form-control" >
										<option value=""></option>
										<?php select_kelasfilter($row_siswa->idkelas); ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jenis Kelamin</label>
								<div class="col-sm-6">
									<select name="kelamin" id="kelamin" class="chosen-select form-control" >
										<option value=""></option>
										<?php select_kelamin($row_siswa->kelamin); ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tempat Lahir</label>
								<div class="col-sm-6">
									<input type="text" id="tmplahir" name="tmplahir" class="form-control" value="<?php echo $row_siswa->tmplahir ?>">
								</div>
							</div>
														
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tanggal Lahir</label>
								<div class="col-sm-6">
									<input type="text" id="tgllahir" name="tgllahir" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $tgllahir ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Agama</label>
								<div class="col-sm-6">
									<select name="agama" id="agama" class="chosen-select form-control" >
										<option value=""></option>
										<?php select_agama($row_siswa->agama); ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kewarganegaraan</label>
								<div class="col-sm-6">
									<input type="radio" id="warga" name="warga" class="ace" value="1" <?php echo $warga ?> ><span class="lbl">WNI&nbsp;&nbsp;</span>
									<input type="radio" id="warga1" name="warga" class="ace" value="2" <?php echo $warga1 ?> ><span class="lbl">WNA</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Anak ke-</label>
								<div class="col-sm-6">
									<input type="text" name="anakke" id="anakke" class="form-control" onkeyup="formatangka('anakke')" value="<?php echo $row_siswa->anakke; ?>" >&nbsp;&nbsp;Dari&nbsp;&nbsp;<input type="text" name="jsaudara" id="jsaudara" class="form-control" onkeyup="formatangka('jsaudara')" value="<?php echo $row_siswa->jsaudara; ?>" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jumlah Saudara Tiri</label>
								<div class="col-sm-6">
									<input type="text" name="jtiri" id="jtiri" class="form-control" onkeyup="formatangka('jtiri')" value="<?php echo $row_siswa->jtiri; ?>" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jumlah Saudara Angkat</label>
								<div class="col-sm-6">
									<input type="text" name="jangkat" id="jangkat" class="form-control" onkeyup="formatangka('jangkat')" value="<?php echo $row_siswa->jangkat; ?>" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Status Keberadaan Orang Tua</label>
								<div class="col-sm-6">
									<input type="radio" id="yatim3" name="yatim" class="ace" value="4" <?php echo $yatim3 ?> ><span class="lbl">Orangtua Lengkap&nbsp;&nbsp;</span><br>
									<input type="radio" id="yatim" name="yatim" class="ace" value="1" <?php echo $yatim ?> ><span class="lbl">Yatim&nbsp;&nbsp;</span><br>
									<input type="radio" id="yatim1" name="yatim" class="ace" value="2" <?php echo $yatim1 ?> ><span class="lbl">Piatu&nbsp;&nbsp;</span><br>
									<input type="radio" id="yatim2" name="yatim" class="ace" value="3" <?php echo $yatim2 ?> ><span class="lbl">Yatim Piatu</span>										
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Bahasa Sehari-hari</label>
								<div class="col-sm-6">
									<input type="text" name="bahasa" id="bahasa" class="form-control" value="<?php echo $row_siswa->bahasa; ?>" >	
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">No. Registrasi Akta Lahir</label>
								<div class="col-sm-6">
									<input type="text" name="no_akte_lahir" id="no_akte_lahir" class="form-control" value="<?php echo $row_siswa->no_akte_lahir; ?>" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Provinsi</label>
								<div class="col-sm-6">
									<select name="provinsi_kode" id="provinsi_kode" class="chosen-select form-control" onChange="loadHTMLPost2('app/siswa_alamat_ajax.php','kota','getkota','provinsi_kode')" />
			                        	<option value=""></option>
										<?php select_provinsi($row_siswa->provinsi_kode); ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kab./Kota</label>
								<div class="col-sm-6" id="kota">
										<select name="kota_kode" id="kota_kode" class="chosen-select form-control"  >										<option value=""></option>
											<?php select_kota($row_siswa->provinsi_kode, $row_siswa->kota_kode); ?>
										</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kecamatan</label>
								<div class="col-sm-6" id="kecamatan">
									<select name="kecamatan_kode" id="kecamatan_kode" class="chosen-select form-control" onChange="loadHTMLPost2('app/siswa_alamat_ajax.php','kecamatan','getkecamatan','kecamatan_kode')" >												<option value=""></option>
										<?php select_kecamatan($row_siswa->kota_kode, $row_siswa->kecamatan_kode); ?>
									</select>
								</div>
							</div>				
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Desa/Kelurahan</label>
								<div class="col-sm-6" id="kelurahan">
									<select name="desa_kode" id="desa_kode" class="chosen-select form-control" >										<option value=""></option>
										<?php select_desa($row_siswa->kecamatan_kode, $row_siswa->desa_kode); ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Alamat Lengkap Siswa</label>
								<div class="col-sm-6">
									<input type="text" name="alamatsiswa" id="alamatsiswa" class="form-control" value="<?php echo $row_siswa->alamatsiswa; ?>" >
									 /
									RT : <input type="text" name="rt_siswa" id="rt_siswa" class="form-control" value="<?php echo $row_siswa->rt_siswa; ?>" >
									RW : <input type="text" name="rw_siswa" id="rw_siswa" class="form-control" value="<?php echo $row_siswa->rw_siswa; ?>" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kode Pos Siswa</label>
								<div class="col-sm-6">
									<input type="text" name="kodepossiswa" id="kodepossiswa" class="form-control" value="<?php echo $row_siswa->kodepossiswa; ?>" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jenis Tinggal</label>
								<div class="col-sm-6">
									<select name="jenistinggal" id="jenistinggal" class="chosen-select form-control" >
										<option value=""></option>
										<?php select_jenistinggal($row_siswa->jenistinggal); ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Alamat Orang Tua</label>
								<div class="col-sm-6">
									<input type="text" name="alamatortu" id="alamatortu" class="form-control" value="<?php echo $row_siswa->alamatortu; ?>" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">No. Telp. Rumah/HP Siswa</label>
								<div class="col-sm-6">
									<input type="text" name="telponsiswa" id="telponsiswa" class="form-control" value="<?php echo $row_siswa->telponsiswa; ?>" >/
									<input type="text" name="hpsiswa" id="hpsiswa" class="form-control" value="<?php echo $row_siswa->hpsiswa; ?>" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">E-mail Siswa</label>
								<div class="col-sm-6">
									<input type="text" name="emailsiswa" id="emailsiswa" class="form-control" value="<?php echo $row_siswa->emailsiswa; ?>" >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Active'; } else { echo 'Aktif'; } ?></label>
								<div class="col-sm-6">
									<input class="ace" type="checkbox" name="aktif" id="aktif" value="1" <?php echo $aktif ?> />
									<span class="lbl"></span>
									
								</div>
							</div>
						</div>
					</div>
				
				
					<!--SETUP UJIAN NEGARA-->
					<div class="col-sm-6">
						<div class="row">
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Peminatan</label>
								<div class="col-sm-4">
									<select name="idminat" id="idminat" class="chosen-select form-control" >
										<option value=""></option>
										<?php select_peminatan($row_siswa->idminat); ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jalur Masuk</label>
								<div class="col-sm-4">
									<select name="jalurmasuk" id="jalurmasuk" class="chosen-select form-control" >
										<option value=""></option>
										<?php select_jalurmasuk($row_siswa->jalurmasuk); ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jalur Masuk Non Akademik</label>
								<div class="col-sm-4">
									<select name="jalurmasuk_id" id="jalurmasuk_id" class="chosen-select form-control" >
										<option value=""></option>
										<?php populate_select("jalurmasuk", "replid", "nama", $row_siswa->jalurmasuk_id); ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jalur Masuk Prestasi</label>
								<div class="col-sm-4">
									<select name="jalurmasukprestasi_id" id="jalurmasukprestasi_id" class="chosen-select form-control" >
										<option value=""></option>
										<?php populate_select("jalurmasuk_prestasi", "replid", "nama", $row_siswa->jalurmasukprestasi_id); ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<?php 
									if(empty($ref)) {
										include("siswa_nilai_un.php");
									} else {
										include("siswa_nilai_un_update.php");
									} 
								?>
							</div>
							
							<div class="form-group">
								<?php 
									if(empty($ref)) {
										include("siswa_raport.php");
									} else {
										include("siswa_raport_update.php");
									}									 
								?>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">File Rekam BK</label>
								<div class="col-sm-6">
									<input type="file" id="file_rekam_bk" name="file_rekam_bk" />
			                        <br />
			        				<?php if (!empty($row_siswa->file_rekam_bk)) { ?>
			        					<img src="<?php echo $__folder ?>app/file_rekam_bk/<?php echo $row_siswa->file_rekam_bk; ?>" width="50" height="50" />
			        				<?php } ?>
			                        <input size="25" type="hidden" id="file_rekam_bk2" name="file_rekam_bk2" value="<?php echo $row_siswa->file_rekam_bk; ?>">  
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">File Pernyataan Orang Tua</label>
								<div class="col-sm-6">
									<input type="file" id="file_memo_ortu" name="file_memo_ortu" />
			                        <br />
			        				<?php if (!empty($row_siswa->file_memo_ortu)) { ?>
			        					<img src="<?php echo $__folder ?>app/file_memo_ortu/<?php echo $row_siswa->file_memo_ortu; ?>" width="50" height="50" />
			        				<?php } ?>
			                        <input size="25" type="hidden" id="file_memo_ortu2" name="file_memo_ortu2" value="<?php echo $row_siswa->file_memo_ortu; ?>">  
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">File Nilai UN</label>
								<div class="col-sm-6">
									<input type="file" id="file_nilai_un" name="file_nilai_un" />
			                        <br />
			        				<?php if (!empty($row_siswa->file_nilai_un)) { ?>
			        					<img src="<?php echo $__folder ?>app/file_nilai_un/<?php echo $row_siswa->file_nilai_un; ?>" width="50" height="50" />
			        				<?php } ?>
			                        <input size="25" type="hidden" id="file_nilai_un2" name="file_nilai_un2" value="<?php echo $row_siswa->file_nilai_un; ?>">  
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">File Raport</label>
								<div class="col-sm-6">
									<input type="file" id="file_raport" name="file_raport" />
			                        <br />
			        				<?php if (!empty($row_siswa->file_raport)) { ?>
			        					<img src="<?php echo $__folder ?>app/file_raport/<?php echo $row_siswa->file_raport; ?>" width="50" height="50" />
			        				<?php } ?>
			                        <input size="25" type="hidden" id="file_raport2" name="file_raport2" value="<?php echo $row_siswa->file_raport; ?>">  
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">File KK *)</label>
								<div class="col-sm-6">
									<input type="file" id="file_kk" name="file_kk" />
			                        <br />
			        				<?php if (!empty($row_siswa->file_kk)) { ?>
			        					<img src="<?php echo $__folder ?>app/file_kk/<?php echo $row_siswa->file_kk; ?>" width="50" height="50" />
			        				<?php } ?>
			                        <input size="25" type="hidden" id="file_kk2" name="file_kk2" value="<?php echo $row_siswa->file_kk; ?>">  
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">File Akte Kelahiran *)</label>
								<div class="col-sm-6">
									<input type="file" id="file_akte" name="file_akte" />
			                        <br />
			        				<?php if (!empty($row_siswa->file_akte)) { ?>
			        					<img src="<?php echo $__folder ?>app/file_akte/<?php echo $row_siswa->file_akte; ?>" width="50" height="50" />
			        				<?php } ?>
			                        <input size="25" type="hidden" id="file_akte2" name="file_akte2" value="<?php echo $row_siswa->file_akte; ?>">  
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">File Ijazah *)</label>
								<div class="col-sm-6">
									<input type="file" id="file_ijazah" name="file_ijazah" />
			                        <br />
			        				<?php if (!empty($row_siswa->file_ijazah)) { ?>
			        					<img src="<?php echo $__folder ?>app/file_ijazah/<?php echo $row_siswa->file_ijazah; ?>" width="50" height="50" />
			        				<?php } ?>
			                        <input size="25" type="hidden" id="file_ijazah2" name="file_ijazah2" value="<?php echo $row_siswa->file_ijazah; ?>">  
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">File NHUN *)</label>
								<div class="col-sm-6">
									<input type="file" id="file_nhun" name="file_nhun" />
			                        <br />
			        				<?php if (!empty($row_siswa->file_nhun)) { ?>
			        					<img src="<?php echo $__folder ?>app/file_nhun/<?php echo $row_siswa->file_nhun; ?>" width="50" height="50" />
			        				<?php } ?>
			                        <input size="25" type="hidden" id="file_nhun2" name="file_nhun2" value="<?php echo $row_siswa->file_nhun; ?>">  
								</div>
							</div>
							
							
						</div>
					</div>
				</div>
				
				<!--
				
				
				
				
				                    	
            	
				
                
                
            	<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kelas *)</label>
					<div class="col-sm-3">
						<input type="text" id="siswa" name="siswa" class="form-control" value="<?php echo $row_siswa->siswa ?>">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kapasitas</label>
					<div class="col-sm-3">
						<input type="text" id="kapasitas" name="kapasitas" class="form-control" value="<?php echo $row_siswa->kapasitas ?>">
					</div>
				</div>
				
                <div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Wali Kelas</label>
					<div class="col-sm-3">
						<select name="nipwali" id="nipwali" class="chosen-select form-control" >
							<option value=""></option>
							<?php select_pegawai($row_siswa->nipwali); ?>
						</select>
					</div>
				</div>
                
                <div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Keterangan</label>
					<div class="col-sm-3">
						<textarea id="keterangan" name="keterangan" class="form-control"><?php echo $row_siswa->keterangan ?></textarea>
					</div>
				</div>-->
				
				<!-- /.row -->
	              
				<div class="space-4"></div>

				<div class="clearfix form-actions">
					<div class="col-md-offset-3 col-md-9">
                        
                        <?php if (allowupd('frmsiswa')==1) { ?>
                            <?php if($ref!='') { ?>
    							<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
    						<?php } ?>
                        <?php } ?>
						
                        <?php if (allowadd('frmsiswa')==1) { ?>
    						<?php if($ref=='') { ?>
    							<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
    						<?php } ?>
                        <?php } ?>
                        
                        <?php if (allowdel('frmsiswa')==1) { ?>
                            &nbsp;
    						<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
                        <?php } ?>
                        
						&nbsp;
						<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . '/' . obraxabrix(siswa_view) ?>'" />
                                                
                                 
					</div>
				</div>

			</form>
            
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->


<!--[if !IE]> -->
<script type="text/javascript">
	window.jQuery || document.write("<script src='<?php echo $__folder ?>assets/js/jquery.min.js'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo $__folder ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="<?php echo $__folder ?>assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
  <script src="<?php echo $__folder ?>assets/js/excanvas.min.js"></script>
<![endif]-->
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


				