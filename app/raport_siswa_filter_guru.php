<input type="hidden" name="idtingkat2" id="idtingkat2" value="<?php echo $idtingkat2 ?>" />
<input type="hidden" name="idkelas2" id="idkelas2" value="<?php echo $idkelas2 ?>" />
<input type="hidden" name="semester_id" id="semester_id" value="<?php echo $semester_id ?>" />
<input type="hidden" name="nama2" id="nama2" value="<?php echo $nama2 ?>" />
<input type="hidden" id="alumni" name="alumni" class="ace" value="1" <?php echo $alumni2 ?> >
<input type="hidden" id="all" name="all" class="ace" value="1" <?php echo $all2 ?> ><span class="lbl"></span>


<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tingkat</label>
	<div class="col-sm-3">
		<select name="idtingkat2__" id="idtingkat2__" class="chosen-select form-control" onchange="loadHTMLPost2('app/siswa_list_ajax.php','kelas_id','getkelas','idtingkat2')" disabled="" >
			<option value=""></option>
			<?php select_tingkat_unit("SMA", $idtingkat2); ?>
		</select>								
	</div>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kelas</label>
	<div class="col-sm-3" id="kelas_id">
		<select name="idkelas2__" id="idkelas2__" class="chosen-select form-control" disabled="" >
			<option value=""></option>
			<?php select_kelas($idtingkat2, $idkelas2); ?>
		</select>								
	</div>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Semester *)</label>
	<div class="col-lg-2">
		<select name="semester_id__" id="semester_id__" class="chosen-select form-control" disabled="" >
			<option value=""></option>
			<?php select_semester_all("SMA", $semester_id); ?>
		</select>
	</div>
</div>


