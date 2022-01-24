<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tingkat</label>
	<div class="col-sm-3">
		<select name="idtingkat2" id="idtingkat2" class="chosen-select form-control" onchange="loadHTMLPost2('app/siswa_list_ajax.php','kelas_id','getkelas','idtingkat2')" >
			<option value=""></option>
			<?php select_tingkat_unit("SMA", $idtingkat2); ?>
		</select>								
	</div>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kelas</label>
	<div class="col-sm-3" id="kelas_id">
		<select name="idkelas2" id="idkelas2" class="chosen-select form-control" >
			<option value=""></option>
			<?php select_kelas($idtingkat2, $idkelas2); ?>
		</select>								
	</div>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Semester *)</label>
	<div class="col-lg-2">
		<select name="semester_id" id="semester_id" class="chosen-select form-control" >
			<option value=""></option>
			<?php select_semester_all("SMA", $semester_id); ?>
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
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Alumni</label>
    
    <div class="col-sm-3">
    	 <input id="alumni" name="alumni" type="checkbox" class="ace" value="1" <?php echo $alumni2 ?> ><span class="lbl"></span>
	</div>
    
</div>

<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Semua</label>
    
    <div class="col-sm-3">
    	 <input id="all" name="all" type="checkbox" class="ace" value="1" <?php echo $all2 ?> ><span class="lbl"></span>
	</div>
    
</div>

<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Catatan</label>
    
    <div class="col-sm-6" style="color: #ff0000">
    	<b>Setelah Preview</b><br>
    	Jika ingin menampilkan raport semester sebelumnya, pilih Tingkat, Kelas dan Semester sebelumnya (Tidak perlu tekan Preview, langsung Cetak saja).
	</div>
    
</div>

<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="form-field-1">&nbsp;</label>
    <div class="col-sm-3">
      <input type="submit" name="submit" id="submit" class='btn btn-primary' value="Preview"/>
    </div>  
</div>