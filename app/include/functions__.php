<?php
@session_start();

error_reporting(E_ALL & ~E_NOTICE);

function populate_select($table,$fields_id,$fields_value,$selected){
	$dbpdo = DB::create();
	
	$sql="Select $fields_id,$fields_value From $table Order By $fields_value";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->$fields_id==$selected) ? " selected" : "";		
		echo "<option value=" . $row->$fields_id . $SelectedCountry . ">" . $row->$fields_value . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_where($table, $fields_id, $fields_value, $where_field, $where_data, $selected){
	$dbpdo = DB::create();
	
	$sql="Select $fields_id, $fields_value From $table where $where_field='$where_data' Order By $fields_value";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->$fields_id==$selected) ? " selected" : "";		
		echo "<option value=" . $row->$fields_id . $SelectedCountry . ">" . $row->$fields_value . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}


function combo_select_active($table,$fields_id,$fields_value,$where,$where2,$selected){		 
	$dbpdo = DB::create();
	$sqlstr="Select $fields_id,$fields_value From $table where $where='$where2' Order By $fields_value";
	$sql=$dbpdo->prepare($sqlstr);
	$sql->execute();
	while ($row = $sql->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->$fields_id==$selected) ? " selected" : "";		
		echo "<option value=" . $row->$fields_id . $SelectedCountry . ">" . $row->$fields_value . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	
}

function select_room_asset($asset_ref, $selected){
	$dbpdo = DB::create();
	
	if($asset_ref == "") {
		$sqlstr="select a.ref, a.code, a.name from asset_detail a left join asset b on a.asset_ref=b.ref where b.asset_type_id=1 order by a.name";
	} else {
		$sqlstr="select a.ref, a.code, a.name from asset_detail a left join asset b on a.asset_ref=b.ref where b.asset_type_id=1 and a.asset_ref='$asset_ref' order by a.name";
	}
	
	$sql=$dbpdo->prepare($sqlstr);
	$sql->execute();
	while ($rows = $sql->fetch(PDO::FETCH_OBJ)){
		$selectdata=(rtrim(ltrim($rows->ref)) == rtrim(ltrim($selected))) ? " selected" : "";	
		echo "<option value=" . $rows->ref . $selectdata . ">" . $rows->code . " " . $rows->name . "</option>";
	}
}

function select_asset_gedung($selected){
	$dbpdo = DB::create();
	$sqlstr="select ref, ref_id, asset_name from asset where asset_type_id=1 order by ref";
	$sql=$dbpdo->prepare($sqlstr);
	$sql->execute();
	while ($rows = $sql->fetch(PDO::FETCH_OBJ)){
		$selectdata=(rtrim(ltrim($rows->ref)) == rtrim(ltrim($selected))) ? " selected" : "";	
		echo "<option value=" . $rows->ref . $selectdata . ">" . $rows->ref_id . " " . $rows->asset_name . "</option>";
	}
}

function select_uom($selected){
	$dbpdo = DB::create();
	$sqlstr="select code, name from uom where active=1 order by code";
	$sql=$dbpdo->prepare($sqlstr);
	$sql->execute();
	while ($rows = $sql->fetch(PDO::FETCH_OBJ)){
		$selectdata=(rtrim(ltrim($rows->code)) == rtrim(ltrim($selected))) ? " selected" : "";	
		echo "<option value=" . $rows->code . $selectdata . ">" . $rows->code . "</option>";
	}
}

function select_asset($selected){
	$dbpdo = DB::create();
	$sqlstr="select ref, ref_id, asset_name from asset order by ref";
	$sql=$dbpdo->prepare($sqlstr);
	$sql->execute();
	while ($rows = $sql->fetch(PDO::FETCH_OBJ)){
		$selectdata=(rtrim(ltrim($rows->ref)) == rtrim(ltrim($selected))) ? " selected" : "";	
		echo "<option value=" . $rows->ref . $selectdata . ">" . $rows->ref_id . " " . $rows->asset_name . "</option>";
	}
}

function select_ukbm($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, kode, deskripsi from ukbm where aktif=1 order by replid";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->kode . ' ' . $row->deskripsi . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_aspek_psikologi($departemen, $selected){
	$dbpdo = DB::create();
	
	$sql="select replid, aspek from aspek_psikologi where aktif=1 and departemen='$departemen' order by replid";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->aspek . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_room($selected){
	$dbpdo = DB::create();
	$sqlstr="select a.ref, a.code, a.name from asset_detail a left join asset b on a.asset_ref=b.ref where b.asset_type_id=1 order by a.name";
	$sql=$dbpdo->prepare($sqlstr);
	$sql->execute();
	while ($rows = $sql->fetch(PDO::FETCH_OBJ)){
		$selectdata=(rtrim(ltrim($rows->ref)) == rtrim(ltrim($selected))) ? " selected" : "";	
		echo "<option value=" . $rows->ref . $selectdata . ">" . $rows->code . " " . $rows->name . "</option>";
	}
}

function select_room_year($selected){
	$dbpdo = DB::create();
	$sqlstr="select distinct date_format(date, '%Y') year from room_registration order by date_format(date, '%Y')";
	$sql=$dbpdo->prepare($sqlstr);
	$sql->execute();
	while ($rows = $sql->fetch(PDO::FETCH_OBJ)){
		$selectdata=(rtrim(ltrim($rows->year)) == rtrim(ltrim($selected))) ? " selected" : "";	
		echo "<option value=" . $rows->year . $selectdata . ">" . $rows->year . "</option>";
	}
}

function select_room_registration_memo_filter($year='', $selected){
	$dbpdo = DB::create();
	$sqlstr="select ref, memo from room_registration where date_format(date, '%Y') order by ref";
	$sql=$dbpdo->prepare($sqlstr);
	$sql->execute();
	while ($rows = $sql->fetch(PDO::FETCH_OBJ)){
		$selectdata=(rtrim(ltrim($rows->ref)) == rtrim(ltrim($selected))) ? " selected" : "";	
		echo "<option value=" . $rows->ref . $selectdata . ">" . $rows->memo . "</option>";
	}
}

function select_sikap_raport($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select 'Spritual' cde, 'Sikap Spritual' dcr, 0 nmr union all 
		select 'Sosial' cde, 'Sikap Sosial' dcr, 1 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_jenis_absen($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select 'ijin' cde, 'Ijin' dcr, 0 nmr union all 
		select 'sakit' cde, 'Sakit' dcr, 1 nmr union all 
		select 'cuti' cde, 'Cuti' dcr, 2 nmr union all 
		select 'alpa' cde, 'Alpa' dcr, 1 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_jawaban_soal($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select '1' cde, 'A' dcr, 0 nmr union all 
		select '2' cde, 'B' dcr, 1 nmr union all 
		select '3' cde, 'C' dcr, 2 nmr union all 
		select '4' cde, 'D' dcr, 3 nmr union all 
		select '5' cde, 'E' dcr, 4 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}


function select_jawaban_soal_ukbm($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select '1' cde, 'A' dcr, 0 nmr union all 
		select '2' cde, 'B' dcr, 1 nmr union all 
		select '3' cde, 'C' dcr, 2 nmr union all 
		select '4' cde, 'D' dcr, 3 nmr union all 
		select '5' cde, 'E' dcr, 4 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_jenis_bayar($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, nama from jenis_bayar where aktif=1 order by replid";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->nama . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_provinsi($selected){
	$dbpdo = DB::create();
	
	$sql="select syscode, nama from provinsi order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->syscode==$selected) ? " selected" : "";		
		echo "<option value=" . $row->syscode . $SelectedCountry . ">" . $row->nama . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}


function select_kota($provincy, $selected){
	$dbpdo = DB::create();
	
	$sql="select syscode, nama from kota where kode_provinsi='$provincy' order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->syscode==$selected) ? " selected" : "";		
		echo "<option value=" . $row->syscode . $SelectedCountry . ">" . $row->nama . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_kecamatan($kota, $selected){
	$dbpdo = DB::create();
	
	$sql="select syscode, nama from kecamatan where kode_kota='$kota' order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->syscode==$selected) ? " selected" : "";		
		echo "<option value=" . $row->syscode . $SelectedCountry . ">" . $row->nama . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_desa($kecamatan, $selected){
	$dbpdo = DB::create();
	
	$sql="select syscode, nama from desa where kode_kecamatan='$kecamatan' order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->syscode==$selected) ? " selected" : "";		
		echo "<option value=" . $row->syscode . $SelectedCountry . ">" . $row->nama . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_semester_psikologi($departemen, $selected){
	$dbpdo = DB::create();
	
	$sql="select replid, semester, departemen from semester where departemen='$departemen' order by semester";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->departemen . '/' . $row->semester . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}


function select_semester($departemen, $selected){
	$dbpdo = DB::create();
	
	$sql="select replid, semester, departemen from semester where departemen='$departemen' and aktif=1 order by semester";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->semester . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_semester_all($departemen, $selected){
	$dbpdo = DB::create();
	
	$sql="select replid, semester, departemen from semester where departemen='$departemen' order by semester";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->semester . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_pelajaran($departemen, $selected){
	$dbpdo = DB::create();
	
	$sql="select replid, nama from pelajaran where departemen='$departemen' and aktif=1 order by nama"; //and sifat=1 
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->nama . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}


function select_pelajaran_general($departemen, $selected){
	$dbpdo = DB::create();
	
	$sql="select replid, nama from pelajaran where departemen='$departemen' and aktif=1 order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->nama . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_ekstrakurikuler($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, nama from pelajaran where aktif=1 and sifat=0 order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->nama . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_pelajaran_all($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, kode, nama from pelajaran where aktif=1 order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->nama . " " . $row->kode . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_pelajaran_guru($idguru='', $selected){
	$dbpdo = DB::create();
	
	if($idguru != "") {
		$sql="select a.idpelajaran replid, a.kode, b.nama from guru a left join pelajaran b on a.idpelajaran=b.replid where a.nip='$idguru' order by b.nama";
	} else {
		$sql="select a.idpelajaran replid, a.kode, b.nama from guru a left join pelajaran b on a.idpelajaran=b.replid order by b.nama";
	}
	
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->nama . " " . $row->kode . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}


function select_jalurmasuk($selected){
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select 'Akademik' cde, 'Akademik' dcr, 0 nmr union all 
		select 'NonAkademik' cde, 'Non Akademik' dcr, 1 nmr union all 
		select 'Mutasi' cde, 'Mutasi' dcr, 2 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
	}
}

function select_kelompok_pelajaran($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select '0' cde, 'Ekstrakurikuler' dcr, 4 nmr union all 
		select '1' cde, 'Kelompok A' dcr, 0 nmr union all 
		select '2' cde, 'Kelompok B' dcr, 1 nmr union all 
		select '3' cde, 'Kelompok Peminatan Matematika dan IPS' dcr, 2 nmr union all 
		select '4' cde, 'Lintas Peminatan' dcr, 3 nmr) a order by nmr";
		
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_sifat($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select '0' cde, 'Ekstrakurikuler' dcr, 0 nmr union all 
		select '1' cde, 'Wajib-A' dcr, 1 nmr union all
		select '2' cde, 'Wajib-B' dcr, 2 nmr union all
		select '3' cde, 'Peminatan' dcr, 3 nmr union all
		select '4' cde, 'Lintas Minat' dcr, 4 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}


function select_jenis_periode($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select 'KRS' cde, 'KRS' dcr, 0 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_menit($selected){
	$dbpdo = DB::create();
	
	$jam=59;
	$sqlthn = "";
    $i = 0;
	for($i==0; $i<=$jam; $i++) {
		if($i==0) {
			$sqlthn = "select '$i' kode, '$i' jam ";	
		} else {
			$sqlthn = $sqlthn . " union all select '$i' kode, '$i' jam ";
		}
		
	}
	
	$sql = " select a.* from (" . $sqlthn . " ) a order by cast(a.kode as signed integer) asc" ;
	
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->kode==$selected) ? " selected" : "";		
		echo "<option value=" . $row->kode . $SelectedCountry . ">" . $row->jam . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	
}

function select_jam($selected){
	$dbpdo = DB::create();
	
	$jam=23;
	$sqlthn = "";
    $i = 0;
	for($i==0; $i<=$jam; $i++) {
		if($i==0) {
			$sqlthn = "select '$i' kode, '$i' jam ";	
		} else {
			$sqlthn = $sqlthn . " union all select '$i' kode, '$i' jam ";
		}
		
	}
	
	$sql = " select a.* from (" . $sqlthn . " ) a order by cast(a.kode as signed integer) asc" ;
	
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->kode==$selected) ? " selected" : "";		
		echo "<option value=" . $row->kode . $SelectedCountry . ">" . $row->jam . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	
}

function select_supplier($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, nama from supplier where aktif=1 order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->nama . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}


function select_pangkat($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, nama from pangkat where aktif=1 order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->nama . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_status_pegawai($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select replid, nama from status_pegawai where aktif=1 order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->nama . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_jenis_sertifikasi($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, nama from jenis_sertifikasi where aktif=1 order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->nama . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_petugas($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, nip, nama from pegawai where aktif=1 order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->nama . " " . $row->nip . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}


function select_pegawai_siswa($selected){
	$dbpdo = DB::create();
	
	$sql="select aa.* from (
		  select replid, nip, nama from pegawai where aktif=1 
		  union all 
		  select replid, nis nip, nama from siswa where alumni=0 and aktif=1) aa order by aa.nip, aa.nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->nama . " " . $row->nip . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_status_izin($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select 'Setujui' cde, 'Setujui' dcr, 0 nmr union all 
		select 'Rencana' cde, 'Rencana' dcr, 1 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_jenis_izin($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, nama from jenis_izin where aktif=1 order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->nama . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_jabatan($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, nama from jabatan where aktif=1 order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->nama . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}


function select_jenis_konseling($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select '0' cde, 'Kasus' dcr, 0 nmr union all 
		select '1' cde, 'Prestasi' dcr, 1 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_status_daftarpustaka($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select '1' cde, 'Tersedia' dcr, 0 nmr union all 
		select '0' cde, 'Dipinjam' dcr, 1 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_jenis_pelanggaran($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, nama, poin from jenis_pelanggaran where aktif=1 order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->nama . " (" .$row->poin . ")" . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_siswa_all($selected){
	$dbpdo = DB::create();
	
	$sql="select nis, nama from siswa where ifnull(alumni,0)=0 order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->nis==$selected) ? " selected" : "";		
		echo "<option value=" . $row->nis . $SelectedCountry . ">" . $row->nama . " / " . $row->nis . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_siswa_id($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, nis, nama from siswa where ifnull(alumni,0)=0 order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->nama . " " . $row->nis . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_siswa($idkelas, $selected){
	$dbpdo = DB::create();
	
	$sql="select replid, nis, nama from siswa where idkelas='$idkelas' and ifnull(alumni,0)=0 order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->nama . " / " . $row->nis . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}


function select_siswa_departemen($departemen, $idtingkat, $idkelas, $selected){
	$dbpdo = DB::create();
	
	$sql="select a.nis, a.nama from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid where c.departemen='$departemen' and b.idtingkat='$idtingkat' and a.idkelas='$idkelas' order by a.nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->nis==$selected) ? " selected" : "";		
		echo "<option value=" . $row->nis . $SelectedCountry . ">" . $row->nama . " / " . $row->nis . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_pustaka($departemen='', $selected){
	$dbpdo = DB::create();
	
	$sql="select a.replid, a.judul from pustaka a where a.departemen='$departemen' order by a.judul";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->judul . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_daftarpustaka($selected){
	$dbpdo = DB::create();
	
	$sql="select a.kodepustaka, b.judul from daftarpustaka a left join pustaka b on a.pustaka=b.replid where a.status=1 and a.kodepustaka not in (select kodepustaka from pinjam where (status=0 or status=1)) order by a.kodepustaka";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->kodepustaka==$selected) ? " selected" : "";		
		echo "<option value=" . $row->kodepustaka . $SelectedCountry . ">" . $row->kodepustaka . " | " .$row->judul . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_lookup($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select '0' cde, 'Barcode Scanner' dcr, 0 nmr union all 
		select '1' cde, 'Pilihan' dcr, 1 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function maxline($table='', $field1='', $field2='', $value='', $output='') {
	$dbpdo = DB::create();
	
	$sql 		= 	"select $field1 from $table where $field2='$value' order by $field1 desc limit 1";
	$results	=	$dbpdo->query($sql);
	$data 		=  	$results->fetch(PDO::FETCH_OBJ);
	
	$output = $data->$field1;
	if($output != "") {
		$output = $output + 1;
	} else {
		$output = 1;
	}
	
	return $output;
		
}

function numberreplace($string="0") {

	$string = str_replace(",","",(empty($string)) ? 0 : $string);
	
	return $string;	
}

function random($number) 
{
	if ($number)
	{
    	for($i=1;$i<=$number;$i++)
		{
       		$nr=rand(0,9);
       		$total=$total.$nr;
       	}
    	return $total;
	}
}

function petikreplace($string="") {

	$string = str_replace("'","''",$string);
	
	return $string;	
}

function CountPustaka()
{
	$dbpdo = DB::create();
	
	$sql = "SELECT replid FROM perpustakaan ORDER BY nama";
	$result = $dbpdo->query($sql);
	$num = $result->rowCount();
	
	return $num;
}

function GenKodePustaka($katalog,$penulis,$judul,$format,$counter) {
	
	$dbpdo = DB::create();
	
	$sql = "SELECT kode FROM katalog WHERE replid='$katalog'";
	$result=$dbpdo->query($sql);
	$ktlg=$result->fetch(PDO::FETCH_OBJ);
	
	$sql = "SELECT kode FROM penulis WHERE replid='$penulis'";
	$result=$dbpdo->query($sql);
	$pnls = $result->fetch(PDO::FETCH_OBJ);

	$jdl = substr($judul,0,1);

	$sql = "SELECT kode FROM format WHERE replid='$format'";
	$result=$dbpdo->query($sql);
	$frmt = $result->fetch(PDO::FETCH_OBJ);


	$counter = (int)$counter;

	if (strlen($counter)==1)
		$cnt = "0000".$counter;
	if (strlen($counter)==2)
		$cnt = "000".$counter;
	if (strlen($counter)==3)
		$cnt = "00".$counter;
	if (strlen($counter)==4)
		$cnt = "0".$counter;
	if (strlen($counter)==5)
		$cnt = $counter;

	$kode = $ktlg->kode."/".$pnls->kode."/".$jdl."/".$cnt."/".$frmt->kode;


	return $kode;

}
	
function select_format($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, kode, nama from format order by kode";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->kode . " | " .$row->nama . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_penerbit($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, kode, nama from penerbit order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->nama . " | " .$row->kode . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_penulis($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, kode, nama from penulis order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->nama . " | " .$row->kode . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_katalog($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, kode, nama from katalog order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->nama . " | " .$row->kode . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}


function select_peminatan2($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select 'MIPA' cde, 'MIPA' dcr, 0 nmr union all 
		select 'IPS' cde, 'IPS' dcr, 1 nmr union all 
		select 'MATEMATIKA' cde, 'MATEMATIKA' dcr, 2 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_rak($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, rak, keterangan from rak order by rak";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->rak . ' (' . $row->keterangan . ")</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_datapenerimaan($idkategori='', $departemen='', $selected){
	$dbpdo = DB::create();
	
	/*if($idkategori == '' && $departemen == '') {
		$sql="select replid, nama from datapenerimaan order by nourut";
	} else {*/
		$sql="select replid, nama from datapenerimaan where idkategori='$idkategori' and departemen='$departemen' order by nourut";
	//}
	
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->nama . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_rekakun($kategori='', $selected){
	$dbpdo = DB::create();
	
	if($kategori == '') {
		$sql="select kode, nama from rekakun order by kode";
	} else {
		$sql="select kode, nama from rekakun where kategori='$kategori' order by kode";
	}
	
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->kode==$selected) ? " selected" : "";		
		echo "<option value=" . $row->kode . $SelectedCountry . ">" . $row->kode . ' ' . $row->nama . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_kategoripenerimaan($selected){
	$dbpdo = DB::create();
	
	$sql="select kode, kategori from kategoripenerimaan order by kode";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->kode==$selected) ? " selected" : "";		
		echo "<option value=" . $row->kode . $SelectedCountry . ">" . $row->kategori . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_ket_pustaka($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select 'Beli' cde, 'Beli' dcr, 0 nmr union all 
		select 'Hibah' cde, 'Hibah' dcr, 1 nmr union all 
		select 'Pengalihan' cde, 'Pengalihan' dcr, 2 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_kategoriakun($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select 'HARTA' cde, 'HARTA' dcr, 0 nmr union all 
		select 'PIUTANG' cde, 'PIUTANG' dcr, 1 nmr union all 
		select 'INVENTARIS' cde, 'INVENTARIS' dcr, 2 nmr union all 
		select 'HUTANG' cde, 'HUTANG' dcr, 3 nmr union all 
		select 'MODAL' cde, 'MODAL' dcr, 4 nmr union all 
		select 'PENDAPATAN' cde, 'PENDAPATAN' dcr, 5 nmr union all 
		select 'BIAYA' cde, 'BIAYA' dcr, 6 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}


function select_pemetaan_kd($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, kode, uraian from pemetaan_kd where aktif=1 order by replid";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->kode . " " . $row->uraian . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_pegawai($selected){
	$dbpdo = DB::create();
	
	$sql="select nip, nama from pegawai where aktif=1 order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->nip==$selected) ? " selected" : "";		
		echo "<option value=" . $row->nip . $SelectedCountry . ">" . $row->nama . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}


function select_angkatan_alumni($selected){
	$dbpdo = DB::create();
	$sql="select replid, angkatan, departemen from angkatan order by angkatan";
	
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->departemen . '-' . $row->angkatan . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_angkatan($selected, $departemen=''){
	$dbpdo = DB::create();
	
	if($departemen == '') {
		$sql="select replid, angkatan, departemen from angkatan where aktif=1 order by angkatan";
	} else {
		$sql="select replid, angkatan, departemen from angkatan where departemen='$departemen' and aktif=1 order by angkatan";	
	}
	
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->departemen . '-' . $row->angkatan . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}


function select_bagianpegawai($selected){
	$dbpdo = DB::create();
	
	$sql="select replid bagian, bagian nama from bagianpegawai order by urutan";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$bagian = str_replace(" ","|",$row->bagian);
		$SelectedCountry=(rtrim(ltrim($bagian))==rtrim(ltrim($selected))) ? " selected" : "";		
		echo "<option value=" . $bagian . $SelectedCountry . ">" . $row->nama . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
	
}

function select_suku($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, suku from suku order by urutan";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->suku . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_thnajaran_all($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, tahunajaran from tahunajaran order by tahunajaran";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->tahunajaran . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_thnajaran($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, tahunajaran from tahunajaran where aktif=1 order by tahunajaran";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->tahunajaran . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_kelompokpsb($idproses, $selected){
	$dbpdo = DB::create();
	
	if($idproses == '') { $idproses = 0; }
	$sql="select replid, kelompok from kelompokcalonsiswa where idproses=$idproses order by replid";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->kelompok . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_anggota_unit($unit, $selected){
	$dbpdo = DB::create();
	
	if($unit == "") {
		$sql="select nis, nama from siswa order by nama";
	} else {
		if($unit != "GURU" && $unit != "MEMBER") {
			$sql="select a.nis, a.nama from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid where c.departemen='$unit' order by a.nama";
		} else if ($unit == "GURU") {
			$sql="select a.nip nis, a.nama from pegawai a order by a.nama";
		} else if ($unit == "MEMBER") {
			$sql="select a.noregistrasi nis, a.nama from anggota a order by a.nama";
		}
		
	}
	
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->nis==$selected) ? " selected" : "";		
		echo "<option value=" . $row->nis . $SelectedCountry . ">" . $row->nama . " / " . $row->nis . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_anggota($selected){
	$dbpdo = DB::create();
	
	$sql="select nis, nama from siswa order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->nis==$selected) ? " selected" : "";		
		echo "<option value=" . $row->nis . $SelectedCountry . ">" . $row->nama . " / " . $row->nis . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_prosespsb($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, proses from prosespenerimaansiswa where aktif=1 order by replid";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->proses . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}


/*function select_jalurmasuk($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select '1' cde, 'Test' dcr, 0 nmr union all 
		select '2' cde, 'Prestasi' dcr, 1 nmr union all
		select '3' cde, 'RMP' dcr, 2 nmr union all
		select '4' cde, 'Jalur Khusus' dcr, 3 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}*/

function select_jenispendaftaran($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select '1' cde, 'Siswa Baru' dcr, 0 nmr union all 
		select '2' cde, 'Mutasi' dcr, 1 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_minatips($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select 'A' cde, 'B. Inggris' dcr, 0 nmr union all 
		select 'B' cde, 'B. Jepang' dcr, 1 nmr union all 
		select 'C' cde, 'Ekonomi' dcr, 2 nmr union all 
		select 'D' cde, 'Sosioliogi' dcr, 3 nmr union all 
		select 'E' cde, 'Geografi' dcr, 4 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_minatipa($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select 'A' cde, 'B. Inggris' dcr, 0 nmr union all 
		select 'B' cde, 'B. Jepang' dcr, 1 nmr union all 
		select 'C' cde, 'Biologi' dcr, 2 nmr union all 
		select 'D' cde, 'Fisika' dcr, 3 nmr union all 
		select 'E' cde, 'Kimia' dcr, 4 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_peminatan($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select '1' cde, 'MIPA' dcr, 0 nmr union all 
		select '2' cde, 'IPS' dcr, 1 nmr union all 
		select '3' cde, 'Bahasa' dcr, 2 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_jenistinggal($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select 'A' cde, 'Bersama Orang Tua' dcr, 0 nmr union all 
		select 'B' cde, 'Bersama Wali' dcr, 1 nmr union all
		select 'C' cde, 'Kost' dcr, 3 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function bulan_select($selected){		 
	$sql="select '1' kode, 'Januari' name union all
			  select '2' kode, 'Februari' name union all
			  select '3' kode, 'Maret' name union all
			  select '4' kode, 'April' name union all
			  select '5' kode, 'Mei' name union all
			  select '6' kode, 'Juni' name union all
			  select '7' kode, 'Juli' name union all
			  select '8' kode, 'Agustus' name union all
			  select '9' kode, 'September' name union all
			  select '10' kode, 'Oktober' name union all
			  select '11' kode, 'November' name union all
			  select '12' kode, 'Desember' name
			";
	$results = odbc_exec(condb,$sql);
	while ($row = odbc_fetch_object($results)){
		$SelectedResult=($row->kode==$selected) ? " selected" : "";		
		echo "<option value=" . $row->kode . $SelectedResult . ">" . $row->name . "</option>";		
	}
}


function select_citacita($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select 'A' cde, 'PNS' dcr, 0 nmr union all 
		select 'B' cde, 'TNI/POLRI' dcr, 1 nmr union all 
		select 'C' cde, 'GURU/DOSEN' dcr, 2 nmr union all 
		select 'D' cde, 'DOKTER' dcr, 3 nmr union all 
		select 'E' cde, 'POLITIKUS' dcr, 4 nmr union all 
		select 'F' cde, 'WIRASWASTA' dcr, 5 nmr union all 
		select 'G' cde, 'SENI/LUKIS/ARTIS/SEJENISNYA' dcr, 6 nmr union all 
		select 'H' cde, 'LAINNYA' dcr, 7 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_rombel($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select replid, nama from rombel where aktif=1 order by nama";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->nama . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_pendidikan($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select replid, pendidikan from tingkatpendidikan order by issync";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->pendidikan . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_penghasilan($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select '1' cde, 'KURANG DARI Rp. 500 RIBU' dcr, 0 nmr union all 
		select '2' cde, 'Rp. 500 RIBU - Rp. 1 JUTA' dcr, 1 nmr union all 
		select '3' cde, 'Rp. 1 JUTA - Rp. 3 JUTA' dcr, 2 nmr union all 
		select '4' cde, 'Rp. 3 JUTA - Rp. 5 JUTA' dcr, 3 nmr union all 
		select '5' cde, 'LEBIH DARI Rp. 5 JUTA' dcr, 4 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_jenismember($selected){
	$dbpdo = DB::create();
	
	$sql="select a.* from (select 'GURU' departemen, '7' urutan union all select 'MEMBER' departemen, '8' urutan union all select departemen, urutan from departemen where aktif=1) a order by a.urutan";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->departemen==$selected) ? " selected" : "";		
		echo "<option value=" . $row->departemen . $SelectedCountry . ">" . $row->departemen . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_departemen($selected){
	$dbpdo = DB::create();
	
	$sql="select departemen from departemen where aktif=1 order by urutan";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->departemen==$selected) ? " selected" : "";		
		echo "<option value=" . $row->departemen . $SelectedCountry . ">" . $row->departemen . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_jenispekerjaan_ayah($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select replid, pekerjaan from jenispekerjaan where replid<>27 order by replid";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->pekerjaan . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_jenispekerjaan($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select replid, pekerjaan from jenispekerjaan order by replid";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->pekerjaan . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function tahun_select($selected){
	$dbpdo = DB::create();
	
	$i=1920;
	$sqlthn = "";
	$tahun = date("Y") + 1;
	for($i==1920; $i<=$tahun; $i++) {
		if($i==1920) {
			$sqlthn = "select '$i' kode, '$i' tahun ";	
		} else {
			$sqlthn = $sqlthn . " union all select '$i' kode, '$i' tahun ";
		}
		
	}
	
	$sql = " select a.* from (" . $sqlthn . " ) a order by kode desc" ;
	
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->kode==$selected) ? " selected" : "";		
		echo "<option value=" . $row->kode . $SelectedCountry . ">" . $row->tahun . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	
}

function select_transportasi($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select 'A' cde, 'JALAN KAKI' dcr, 0 nmr union all 
		select 'B' cde, 'SEPEDA' dcr, 1 nmr union all 
		select 'C' cde, 'MOTOR' dcr, 2 nmr union all 
		select 'D' cde, 'MOBIL PRIBADI' dcr, 3 nmr union all 
		select 'E' cde, 'ANTAR JEMPUT SEKOLAH' dcr, 4 nmr union all 
		select 'F' cde, 'ANGKUTAN UMUM' dcr, 5 nmr union all 
		select 'G' cde, 'LAINNYA' dcr, 7 nmr union all 
		select 'H' cde, 'OJEG' dcr, 6 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_asalsekolah($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select replid, sekolah from asalsekolah order by urutan";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->sekolah . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_goldarah($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select 'A' cde, 'A' dcr, 0 nmr union all 
		select 'AB' cde, 'AB' dcr, 1 nmr union all 
		select 'B' cde, 'B' dcr, 2 nmr union all 
		select 'O' cde, 'O' dcr, 1 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->cde==$selected) ? " selected" : "";		
		echo "<option value=" . $row->cde . $SelectedCountry . ">" . $row->dcr . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_agama($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select agama from agama order by urutan";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->agama==$selected) ? " selected" : "";		
		echo "<option value=" . $row->agama . $SelectedCountry . ">" . $row->agama . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_jenis_id($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select 'ktp' cde, 'NO KTP' dcr, 0 nmr union all 
		select 'passpor' cde, 'PASSPOR' dcr, 1 nmr union all
        select 'sim' cde, 'SIM' dcr, 2 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($rows = $results->fetch(PDO::FETCH_OBJ)){
		$selectdata=(rtrim(ltrim($rows->cde)) == rtrim(ltrim($selected))) ? " selected" : "";	
		echo "<option value=" . $rows->cde . $selectdata . ">" . $rows->dcr . "</option>";
	}
}

function select_kelamin($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select 'P' cde, 'Perempuan' dcr, 0 nmr union all 
		select 'L' cde, 'Laki-laki' dcr, 1 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($rows = $results->fetch(PDO::FETCH_OBJ)){
		$selectdata=(rtrim(ltrim($rows->cde)) == rtrim(ltrim($selected))) ? " selected" : "";	
		echo "<option value=" . $rows->cde . $selectdata . ">" . $rows->dcr . "</option>";
	}
}

function select_user_bagian($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select 'Guru' cde, 'Guru' dcr, 0 nmr union all 
		select 'Pegawai' cde, 'Pegawai' dcr, 1 nmr union all
		select 'Siswa' cde, 'Siswa' dcr, 2 nmr union all
		select 'Umum' cde, 'Umum' dcr, 3 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($rows = $results->fetch(PDO::FETCH_OBJ)){
		$selectdata=(rtrim(ltrim($rows->cde)) == rtrim(ltrim($selected))) ? " selected" : "";	
		echo "<option value=" . $rows->cde . $selectdata . ">" . $rows->dcr . "</option>";
	}
}

function select_program($selected){
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select '1' cde, 'IPA' dcr, 0 nmr union all 
		select '2' cde, 'IPS' dcr, 1 nmr union all
		select '3' cde, 'BAHASA' dcr, 2 nmr) a order by nmr";
	$results=$dbpdo->query($sql);
	while ($rows = $results->fetch(PDO::FETCH_OBJ)){
		$selectdata=(rtrim(ltrim($rows->cde)) == rtrim(ltrim($selected))) ? " selected" : "";	
		echo "<option value=" . $rows->cde . $selectdata . ">" . $rows->dcr . "</option>";
	}
}

function select_jurusan($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, keterangan from kelas where idtingkat=35 order by replid";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->keterangan . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_jeniskompetensi($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, jeniskompetensi from jeniskompetensi where aktif=1 order by jeniskompetensi";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->jeniskompetensi . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_aspekpenilaian($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, keterangan from dasarpenilaian order by keterangan";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->keterangan . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_kompetensi($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, kode from kompetensi where aktif=1 order by kode";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->kode . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_kelasfilter($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, kelas from kelas where aktif=1 order by replid";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->kelas . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_kelas($idtingkat, $selected){
	$dbpdo = DB::create();
	
	if($idtingkat == '') { $idtingkat = 0; }
	$sql="select replid, kelas from kelas where idtingkat=$idtingkat order by replid";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->kelas . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_tingkat_unit($unit, $selected){
	$dbpdo = DB::create();
	
	$sql="select replid, tingkat from tingkat where departemen='$unit' and aktif=1 order by tingkat";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->tingkat . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_tingkat($selected){
	$dbpdo = DB::create();
	
	$sql="select replid, tingkat from tingkat where aktif=1 order by tingkat";
	$results=$dbpdo->query($sql);
	while ($row = $results->fetch(PDO::FETCH_OBJ)){
		$SelectedCountry=($row->replid==$selected) ? " selected" : "";		
		echo "<option value=" . $row->replid . $SelectedCountry . ">" . $row->tingkat . "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}

function select_level($selected){
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select '0' cde, '0' dcr union all 
		select '1' cde, '1' dcr union all 
		select '2' cde, '2' dcr union all 
		select '3' cde, '3' dcr union all 
		select '4' cde, '4' dcr union all 
		select '5' cde, '5' dcr) a order by cde";
	$results=$dbpdo->query($sql);
	while ($rows = $results->fetch(PDO::FETCH_OBJ)){
		$selectdata=(rtrim(ltrim($rows->cde)) == rtrim(ltrim($selected))) ? " selected" : "";	
		echo "<option value=" . $rows->cde . $selectdata . ">" . $rows->dcr . "</option>";
	}
}

function select_kd_pemetaan($selected){
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select '1' cde, 'KD 1' dcr union all 
		select '2' cde, 'KD 2' dcr union all 
		select '3' cde, 'KD 3' dcr union all 
		select '4' cde, 'KD 4' dcr) a order by cde";
	$results=$dbpdo->query($sql);
	while ($rows = $results->fetch(PDO::FETCH_OBJ)){
		$selectdata=(rtrim(ltrim($rows->cde)) == rtrim(ltrim($selected))) ? " selected" : "";	
		echo "<option value=" . $rows->cde . $selectdata . ">" . $rows->dcr . "</option>";
	}
}

function generate_user_siswa($usrid, $pass_ori, $idpegawai){
	$dbpdo = DB::create();
		
		$pwd		=	obraxabrix($pass_ori, $usrid);
				
		$adm		=	0;
		$photo		=	"";
		$act		=	1;
		$uid		=	$_SESSION["loginname"];
		$dlu		=	date("Y-m-d H:i:s");
		
		$sqlcek 	= 	"select usrid from usr where usrid='$usrid'";
		$sqlresult	=	$dbpdo->prepare($sqlcek);
		$sqlresult->execute();
		$rows		=	$sqlresult->rowCount();
		
		if($rows == 0) {
			$sqlstr="insert into usr (usrid,pwd,adm,idpegawai,tipe_user, photo,act,uid,dlu) values('$usrid','$pwd','$adm','$idpegawai', 'Siswa', '$photo','$act','$uid','$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//--------insert table user backup
			$sqlstr="insert into usr_bup(usrid,pwd) values('$usrid','$pass_ori')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//detail
			$strsql = "select frmcde from usr_frm where frmcde in ('frmsiswa_list','frmsiswa','frmsiswa_krs')";
			$sqldet=$dbpdo->prepare($strsql);
			$sqldet->execute();
			while($datadet=$sqldet->fetch(PDO::FETCH_OBJ)) {
				$usr_frmcde = $datadet->frmcde;
				
				$usr_add = 1;	
				$usr_edt = 1;			
				$usr_dlt = 0;
				$usr_lvl = 0;
								
				$sqlstr="insert into usr_dtl
				(usrid, frmcde, madd, medt, mdel, lvl)
					values
					(
						'".$usrid."',
						'".$usr_frmcde."',
						".$usr_add.",
						".$usr_edt.",
						".$usr_dlt.",
						'".$usr_lvl."'
					)";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
						
		}
			
	//}
}

function generate_user_guru($usrid, $pass_ori, $idpegawai){
	$dbpdo = DB::create();
		
		$pwd		=	obraxabrix($pass_ori, $usrid);
				
		$adm		=	0;
		$photo		=	"";
		$act		=	1;
		$uid		=	$_SESSION["loginname"];
		$dlu		=	date("Y-m-d H:i:s");
		
		$sqlcek 	= 	"select usrid from usr where usrid='$usrid'";
		$sqlresult	=	$dbpdo->prepare($sqlcek);
		$sqlresult->execute();
		$rows		=	$sqlresult->rowCount();
		
		if($rows == 0) {
			$sqlstr="insert into usr (usrid,pwd,adm,idpegawai,tipe_user, photo,act,uid,dlu) values('$usrid','$pwd','$adm','$idpegawai', 'Guru', '$photo','$act','$uid','$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//--------insert table user backup
			$sqlstr="insert into usr_bup(usrid,pwd) values('$usrid','$pass_ori')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//detail
			$strsql = "select frmcde from usr_frm where frmcde in ('frmdaftarnilai','frmpemetaan_kd')";
			$sqldet=$dbpdo->prepare($strsql);
			$sqldet->execute();
			while($datadet=$sqldet->fetch(PDO::FETCH_OBJ)) {
				$usr_frmcde = $datadet->frmcde;
				
				if($usr_frmcde == "frmclient") {
					$usr_edt = 0;
				} else {
					$usr_edt = 1;
				}
				$usr_add = 1;				
				$usr_dlt = 0;
				$usr_lvl = 0;
								
				$sqlstr="insert into usr_dtl
				(usrid, frmcde, madd, medt, mdel, lvl)
					values
					(
						'".$usrid."',
						'".$usr_frmcde."',
						".$usr_add.",
						".$usr_edt.",
						".$usr_dlt.",
						'".$usr_lvl."'
					)";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
						
		}
			
	//}
}

function select_hari($selected){
	$dbpdo = DB::create();
	
	$sql="select a.cde, a.dcr from 
		(select '1' cde, 'Senin' dcr union all 
		select '2' cde, 'Selasa' dcr union all 
		select '3' cde, 'Rabu' dcr union all 
		select '4' cde, 'Kamis' dcr union all 
		select '5' cde, 'Jumat' dcr union all 
		select '6' cde, 'Sabtu' dcr union all 
		select '7' cde, 'Minggu' dcr) a order by cde";
	$results=$dbpdo->query($sql);
	while ($rows = $results->fetch(PDO::FETCH_OBJ)){
		$selectdata=(rtrim(ltrim($rows->cde)) == rtrim(ltrim($selected))) ? " selected" : "";	
		echo "<option value=" . $rows->cde . $selectdata . ">" . $rows->dcr . "</option>";
	}
}

//---------------------------------------------------------------------------------------------------------\/
function signon(){
	//echo "<input type=\"submit\" value=\"Login\" tabindex=\"5\" id=\"login\" name=\"login\" class=\"button roundbutton\"";
	echo "<input type='image' id='login' name='login' value='Login' src='login/images/login.gif'/>";
	//echo "\"/></input><br>";
}

function signout(){
	echo "<input type=\"submit\" value=\"Logout\" tabindex=\"5\" id=\"login\" name=\"login\" class=\"button roundbutton\"";
	echo "\"/></input><br>";
}

function delete_copy() {
	/* makes connection */
	$conn=db_connect(HOST,USER,PASS,DB,PORT);
	/* Creates SQL statement to retrieve the copies using the releaseID */
	$sql = "DELETE FROM $file WHERE $recordid =" . $_POST['ID'];
	$results=mkr_query($sql,$conn);
	$msg[0]="Sorry ERROR in deletion";
	$msg[1]="Record successful DELETED";			
	AddSuccess($results,$conn,$msg);
	/* Closes connection */
	mysql_close ($conn);
	/* calls get_data */
	//get_data();
} 
		
class formValidator{
    private $errors=array();
    public function __construct(){}

    // validate empty field
    public function validateEmpty($field,$errorMessage,$min=1	,$max=32){
		if(!isset($_POST[$field])||trim($_POST[$field])==''||strlen($_POST[$field])<$min||strlen($_POST[$field])>$max){
            $this->errors[]=$errorMessage;
        }
    }

    // validate integer field
    public function validateInt($field,$errorMessage){
        if(!isset($_POST[$field])||!is_numeric($_POST[$field])||intval($_POST[$field])!=$_POST[$field]){
            $this->errors[]=$errorMessage;
        }
    }

    // validate numeric field
    public function validateNumber($field,$errorMessage){
        if(!isset($_POST[$field])||!is_numeric($_POST[$field])){
            $this->errors[]=$errorMessage;
        }
    }

    // validate if field is within a range
    public function validateRange($field,$errorMessage,$min=1,$max=99){
        if(!isset($_POST[$field])||$_POST[$field]<$min||$_POST[$field]>$max){
            $this->errors[]=$errorMessage;
        }
    }

    // validate alphabetic field
    public function validateAlphabetic($field,$errorMessage){
        if(!isset($_POST[$field])||!preg_match("/^[a-zA-Z]+$/",$_POST[$field])){
            $this->errors[]=$errorMessage;
        }
    }

    // validate alphanumeric field
    public function validateAlphanum($field,$errorMessage){
        if(!isset($_POST[$field])||!preg_match("/^[a-zA-Z0-9]+$/",$_POST[$field])){
            $this->errors[]=$errorMessage;
        }
    }

    // validate email - does not work on windows machine
    public function validateEmail($field,$errorMessage){
        if(!isset($_POST[$field])||!preg_match("/.+@.+\..+./",$_POST[$field])||!checkdnsrr(array_pop(explode("@",$_POST[$field])),"MX")){
            $this->errors[]=$errorMessage;
        }
    }

    // check for errors
    public function checkErrors(){
        if(count($this->errors)>0){
            return true;
        }
        return false;
    }
	
    // return errors
    public function displayErrors(){
        $errorOutput='<ul>';
        foreach($this->errors as $err){
            $errorOutput.='<li>'.'<font color="#FF0000">'.$err.'</font>'.'</li>';
        }
        $errorOutput.='</ul>';
        return $errorOutput;
    }
}

function AddSuccess($results,&$conn,$msg){
	if ((int) $results==0){
		//should log mysql errors to a file instead of displaying them to the user
		echo 'Invalid query: ' . mysql_errno($conn). "<br>" . ": " . mysql_error($conn). "<br>";
		echo "<div align=\"center\"><h1>$msg[0]</h1></div>";		
	}else{
		echo "<div align=\"center\"><h1>$msg[1]</h1></div>";
		//return(AddSuccess);
	}
}

function paginate($nRecords){
	 $strOffSet=$_SESSION["strOffSet"];
	 switch ($_POST["Navigate"]){
		case "<<":
			$strOffSet=0; //0;
			break;
		case "<":
			if ($strOffSet>$nRecords){
				$strOffSet=$strOffSet-1;				
			}else{
				if ($strOffSet==0) {
					$strOffSet=0;
				} else {
					$strOffSet=$strOffSet-1;
				}
			}
			//$strPage = $strPage==0 ? 1 : $strPage; //checks to see that page numbers don't go to neg
			break;
		case ">":
			if ($strOffSet<$nRecords) {
				if ($strOffSet==$nRecords-1) {
					$strOffSet=$nRecords-1;
				} else {
					$strOffSet=$strOffSet+1;
				}
			} else {
				$strOffSet=$nRecords-1;								
			}	
			break;
		case ">>":
			$strOffSet=$nRecords-1;
			break;
		default:
			$strOffSet = $strOffSet==0 ? 0 : $strOffSet;
	}	
	$_SESSION["strOffSet"]=$strOffSet; //counts offset values
}

//-----allow reminder
function allow_reminder($menu,$allow=0) {
	$dbpdo = DB::create();
	
	$lognme=$_SESSION["userid"];
	$sql = "Select usrid, adm from usr where usrid = '$lognme' ";
	$results=$dbpdo->query($sql);
	$userid = $results->fetch(PDO::FETCH_OBJ);
	$id = $userid->usrid;
	
	$sql2 = "Select usrid id from usr_reminder where usrid = '$id' and reminder_id='$menu' ";
	$results=$dbpdo->query($sql2);
	$frm = $results->fetch(PDO::FETCH_OBJ);
	
	if ($frm->id != "" || $userid->adm==1) {
		$allow = 1;
	} else {
		$allow = 0;
	}
	return $allow;
}

//-----get Provincy from users
function adm($admc) {
	$dbpdo = DB::create();
	
	$lognme=$_SESSION["loginname"];
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$sql = "Select adm from usr where usrid = '$lognme' ";
	$results=$dbpdo->query($sql);
	$admin = $results->fetch(PDO::FETCH_OBJ);
	$admc = $admin->adm;
	return $admc;
	
}

//----------------------------------------USER RIGHT
//-----allow users
function allow($menu,$allow=0) {
	$dbpdo = DB::create();
	
	$lognme=$_SESSION["userid"];
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$sql = "Select usrid from usr where usrid = '$lognme' ";
	$results=$dbpdo->query($sql);
	$userid = $results->fetch(PDO::FETCH_OBJ);
	$id = $userid->usrid;
	
	$sql2 = "Select id from usr_dtl where usrid = '$id' and frmcde='$menu' ";
	$results=$dbpdo->query($sql2);
	$frm = $results->fetch(PDO::FETCH_OBJ);
	
	if ($frm->id != 0) {
		$allow = 1;
	} else {
		$allow = 0;
	}
	return $allow;
}

//-----input users
function allowadd($menu,$add='') {
		
	$dbpdo = DB::create();
	
	$lognme=$_SESSION["userid"];
	//$conn=db_connect(HOST,USER,PASS,DB,PORT);
	$sql = "Select usrid, adm from usr where usrid = '$lognme' ";
	$results=$dbpdo->query($sql);
	$userid = $results->fetch(PDO::FETCH_OBJ);
	$id = $userid->usrid;
	$adm = $userid->adm;
	
	if ($adm == 1) {
		$add = 1;
	} else {
		$sql2 = "Select madd from usr_dtl where usrid = '$id' and frmcde='$menu' ";
		$results=$dbpdo->query($sql2);
		$frm = $results->fetch(PDO::FETCH_OBJ);
		$add = $frm->madd;
	}
	return $add;
}

//-----user administrator atau bukan
function user_admin($admin=0) {
	
	$dbpdo = DB::create();
	
	$lognme=$_SESSION["userid"];
	
	$sql = "Select adm from usr where usrid = '$lognme' ";
	$results=$dbpdo->query($sql);
	$userid = $results->fetch(PDO::FETCH_OBJ);
	$adm = $userid->adm;
	
	if ($adm == 1) {
		$admin = 1;
	} else {
		$admin = 0;
	}
	return $admin;
}

//-----hapus
function allowdel($menu,$del='') {
	
	$dbpdo = DB::create();
	
	$lognme=$_SESSION["userid"];
	
	$sql = "Select usrid, adm from usr where usrid = '$lognme' ";
	$results=$dbpdo->query($sql);
	$userid = $results->fetch(PDO::FETCH_OBJ);
	$id = $userid->usrid;
	$adm = $userid->adm;
	
	if ($adm == 1) {
		$del = 1;
	} else {
		$sql2 = "Select mdel from usr_dtl where usrid = '$id' and frmcde='$menu' ";
		$results=$dbpdo->query($sql2);
		$frm = $results->fetch(PDO::FETCH_OBJ);
		$del = $frm->mdel;
	}
	return $del;
}

//-----update
function allowupd($menu,$upd='') {
	
	$dbpdo = DB::create();
	
	$lognme=$_SESSION["userid"];
	
	$sql = "Select usrid, adm from usr where usrid = '$lognme' ";
	
	$results=$dbpdo->query($sql);
	$userid = $results->fetch(PDO::FETCH_OBJ);
	$id = $userid->usrid;
	$adm = $userid->adm;
	
	if ($adm == 1) {
		$upd = 1;
	} else {
		$sql2 = "Select medt from usr_dtl where usrid = '$id' and frmcde='$menu' ";
		$results=$dbpdo->query($sql2);
		$frm = $results->fetch(PDO::FETCH_OBJ);
		$upd = $frm->medt;
	}
	return $upd;
}

//-----AKSES users level
function allowlvl($menu) {
	
	$dbpdo = DB::create();
	
	$lvl = 0;
	$lognme=$_SESSION["userid"];
	
	$sql = "Select usrid, adm from usr where usrid = '$lognme' ";
	$results=$dbpdo->query($sql);
	$userid = $results->fetch(PDO::FETCH_OBJ);
	$id = $userid->usrid;
	$adm = $userid->adm;
	
	if ($adm == 1) {
		$lvl = 0;
	} else {
		$sql2 = "Select lvl from usr_dtl where usrid = '$id' and frmcde='$menu' ";
		$results=$dbpdo->query($sql2);
		$frm = $results->fetch(PDO::FETCH_OBJ);
		$lvl = $frm->lvl;
	}
	return $lvl;
}

function abjad_convert($n){
	$hasil = "";
	$abjad = array(1=>"A",2=>"B",3=>"C",4=>"D",5=>"E",6=>"F",7=>"G",
				8=>"H",9=>"I",10=>"J",11=>"K",12=>"L",13=>"M",
				14=>"N",15=>"O",16=>"Q",17=>"R",18=>"S",
				19=>"T",20=>"U",21=>"V",22=>"W",23=>"X",24=>"Y",25=>"Z");
	
	$hasil = $abjad[$n];
	
	return $hasil;
}


//--------function angka romawi
function romawi($n){
	$hasil = "";
	$iromawi =
				array("","I","II","III","IV","V","VI","VII","VIII","IX","X",
				20=>"XX",30=>"XXX",40=>"XL",50=>"L",60=>"LX",70=>"LXX",80=>"LXXX",
				90=>"XC",100=>"C",200=>"CC",300=>"CCC",400=>"CD",500=>"D",
				600=>"DC",700=>"DCC",800=>"DCCC",900=>"CM",1000=>"M",
				2000=>"MM",3000=>"MMM");
	
	if(array_key_exists($n,$iromawi)){
		$hasil = $iromawi[$n];
	}elseif($n >= 11 && $n <= 99){
		$i = $n % 10;
		$hasil = $iromawi[$n-$i] . Romawi($n % 10);
	}elseif($n >= 101 && $n <= 999){
		$i = $n % 100;
		$hasil = $iromawi[$n-$i] . Romawi($n % 100);
	}else{
		$i = $n % 1000;
		$hasil = $iromawi[$n-$i] . Romawi($n % 1000);
	}
	return $hasil;
}

//-----format tanggal Indonesia
function tglindonesia($tgl, $hasil) {
	//$array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
	//$hari = $array_hari[date('N')];
	$tanggal = date('j', strtotime($tgl));
	$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
	$bulan = $array_bulan[date('n')];
	$tahun = date('Y');
	$hasil = $tanggal.' '.$bulan.' '.$tahun;
	return $hasil;
}

//-----format bulan Indonesia
function bulan_indonesia($bulan, $hasil='') {
	$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
	$bulan2 = $array_bulan[$bulan];
	$hasil = $bulan2;
	return $hasil;
}

function datediff($tgl1, $tgl2){
	$tgl1 = strtotime($tgl1);
	$tgl2 = strtotime($tgl2);
	$diff_secs = abs($tgl1 - $tgl2);
	$base_year = min(date("Y", $tgl1), date("Y", $tgl2));
	$diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
	return array( "years" => date("Y", $diff) - $base_year, "months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1, "months" => date("n", $diff) - 1, "days_total" => floor($diff_secs / (3600 * 24)), "days" => date("j", $diff) - 1, "hours_total" => floor($diff_secs / 3600), "hours" => date("G", $diff), "minutes_total" => floor($diff_secs / 60), "minutes" => (int) date("i", $diff), "seconds_total" => $diff_secs, "seconds" => (int) date("s", $diff) );
}

//-------------encrypt pass
function obraxabrix($pwd='', $uid='', $hasil='') {
	$hasil = md5(md5(md5(md5(md5(md5(md5($pwd.$uid.strlen($pwd.$uid)*15)))))));
	
	return $hasil;
}

//-----untuk create notran otomatis
function notran($tanggal, $frmcode, $save='', $ref='', $vardms='') {
	$dbpdo = DB::create();
	
	$yy = date('y', strtotime($tanggal));
	$mm = date('m', strtotime($tanggal));
	$yymm = $yy.$mm;
	
	//$frmcode = $frmcode . $vardms;
	
	$ref_q = "Select nbr, alp From ref where frmcde='$frmcode' And yymm='$yymm' ";		
	$ref_m = $dbpdo->query($ref_q);
	$ref_d = $ref_m->fetch(PDO::FETCH_OBJ);
	
	$nbr = $ref_d->nbr;
	$alp = $ref_d->alp;
	
	if ($alp=='') {
		
		if (trim($frmcode)=='frmrcp') { $ref = 'RCP-'.$mm.$yy.'-00001'; }
		
		if (trim($frmcode)=='frmregistrasi') { $ref = 'REG-'.$vardms.'-'.$mm.$yy.'00001'; }
		if (trim($frmcode)=='frmpelanggaran_siswa') { $ref = 'PLG-'.$mm.$yy.'-00001'; }
		if (trim($frmcode)=='frmkonseling_siswa') { $ref = 'KON-'.$mm.$yy.'-00001'; }
		if (trim($frmcode)=='frmassesmen_observasi') { $ref = 'ASO-'.$mm.$yy.'-00001'; }
		if (trim($frmcode)=='frmanggota') { $ref = 'ANG-'.$mm.$yy.'-00001'; }
		if (trim($frmcode)=='frmevaluasi_psikologi') { $ref = 'EVP-'.$mm.$yy.'-00001'; }
		if (trim($frmcode)=='frmasset') { $ref = 'AST-'.$mm.$yy.'-00001'; }
		if (trim($frmcode)=='frmpresensi_ukbm') { $ref = 'PUK-'.$mm.$yy.'-00001'; }
		if (trim($frmcode)=='frmsurat_keluar') { $ref = 'SOT-'.$mm.$yy.'-00001'; }
		if (trim($frmcode)=='frmsurat_masuk') { $ref = 'SIN-'.$mm.$yy.'-00001'; }
		if (trim($frmcode)=='frmbuku_kunjungan') { $ref = 'BUT-'.$mm.$yy.'-00001'; }
		if (trim($frmcode)== $vardms.'frmmaterial') { $ref = $vardms.'ITM-'.$mm.$yy.'-00001'; }
		if (trim($frmcode)== $vardms.'frmbuild') { $ref = $vardms.'BLD-'.'00001'; }
		if (trim($frmcode)== $vardms.'frmroom') { $ref = $vardms.'ROM-'.'00001'; }
		if (trim($frmcode)== $vardms.'frmroom_booking') { $ref = $vardms.'RRG-'.$mm.$yy.'-00001'; }
		
		if (trim($frmcode)=='') {	$ref = $yy.$mm.'00001'; }
		
		if ($save == 1) {
			$sv = "insert into ref(frmcde, nbr, yymm, alp) values ('$frmcode', '1', '$yymm', 'A')";
			$sv_q = $dbpdo->prepare($sv);
			$sv_q->execute();
		}
	} else {
		$ref_alp = $alp;
		$ref_nbr = $nbr + 1;
		
		if ($ref_nbr > 99999) {
			$ref_nbr = 1;
			if ($alp=='A') { $ref_alp = 'B'; }
			if ($alp=='B') { $ref_alp = 'C'; }
			if ($alp=='C') { $ref_alp = 'D'; }
			if ($alp=='D') { $ref_alp = 'E'; }
			if ($alp=='E') { $ref_alp = 'F'; }
			if ($alp=='F') { $ref_alp = 'G'; }
			if ($alp=='G') { $ref_alp = 'H'; }
			if ($alp=='H') { $ref_alp = 'I'; }
			if ($alp=='I') { $ref_alp = 'J'; }
			if ($alp=='J') { $ref_alp = 'K'; }
			if ($alp=='K') { $ref_alp = 'L'; }
			if ($alp=='L') { $ref_alp = 'M'; }
			if ($alp=='N') { $ref_alp = 'O'; }
			if ($alp=='O') { $ref_alp = 'P'; }
			if ($alp=='P') { $ref_alp = 'Q'; }
			if ($alp=='Q') { $ref_alp = 'R'; }
			if ($alp=='R') { $ref_alp = 'S'; }
			if ($alp=='S') { $ref_alp = 'T'; }
			if ($alp=='T') { $ref_alp = 'U'; }
			if ($alp=='U') { $ref_alp = 'V'; }
			if ($alp=='V') { $ref_alp = 'W'; }
			if ($alp=='W') { $ref_alp = 'X'; }
			if ($alp=='X') { $ref_alp = 'Y'; }
			if ($alp=='Y') { $ref_alp = 'Z'; }
			if ($alp=='Z') { $ref_alp = 'A'; }
		}
		
		$alp_temp = $ref_nbr;
		
		if (strlen($alp_temp)==4) { $alp_temp = '0'.$alp_temp;}
		if (strlen($alp_temp)==3) { $alp_temp = '00'.$alp_temp;}
		if (strlen($alp_temp)==2) { $alp_temp = '000'.$alp_temp;}
		if (strlen($alp_temp)==1) { $alp_temp = '0000'.$alp_temp;}
		
		if (trim($frmcode)=='frmregistrasi') { $ref = 'REG-'.$vardms.'-'.$mm.$yy.substr($alp_temp,1,5);} 
		if (trim($frmcode)=='frmpelanggaran_siswa') { $ref = 'PLG-'.$mm.$yy.'-'.$alp_temp; }
		if (trim($frmcode)=='frmkonseling_siswa') { $ref = 'KON-'.$mm.$yy.'-'.$alp_temp; }
		if (trim($frmcode)=='frmrcp') { $ref = 'RCP-'.$mm.$yy.'-'.$alp_temp; }
		if (trim($frmcode)=='frmassesmen_observasi') { $ref = 'ASO-'.$mm.$yy.'-'.$alp_temp; }
		if (trim($frmcode)=='frmanggota') { $ref = 'ANG-'.$mm.$yy.'-'.$alp_temp; }
		if (trim($frmcode)=='frmevaluasi_psikologi') { $ref = 'EVP-'.$mm.$yy.'-'.$alp_temp; }
		if (trim($frmcode)=='frmasset') { $ref = 'AST-'.$mm.$yy.'-'.$alp_temp; }
		if (trim($frmcode)=='frmpresensi_ukbm') { $ref = 'PUK-'.$mm.$yy.'-'.$alp_temp; }
		if (trim($frmcode)=='frmsurat_keluar') { $ref = 'SOT-'.$mm.$yy.'-'.$alp_temp; }
		if (trim($frmcode)=='frmsurat_masuk') { $ref = 'SIN-'.$mm.$yy.'-'.$alp_temp; }
		if (trim($frmcode)=='frmbuku_kunjungan') { $ref = 'BUT-'.$mm.$yy.'-'.$alp_temp; }
		if (trim($frmcode)== $vardms.'frmmaterial') { $ref = $vardms.'ITM-'.$mm.$yy.'-'.$alp_temp; }
		if (trim($frmcode)== $vardms.'frmbuild') { $ref = $vardms.'BLD-'.$alp_temp; }
		if (trim($frmcode)== $vardms.'frmroom') { $ref = $vardms.'ROM-'.$alp_temp; }
		if (trim($frmcode)== $vardms.'frmroom_booking') { $ref = $vardms.'RRG-'.$mm.$yy.'-'.$alp_temp; }
				
		if (trim($frmcode)=='') { $ref = $yy.$mm.$ref_alp.$ref_temp; }
		
		if ($save==1) {
			$upd = "update ref set nbr='$ref_nbr', alp='$ref_alp' Where frmcde='$frmcode' and yymm='$yymm'";
			$upd_q = $dbpdo->prepare($upd);
			$upd_q->execute();
		}
	}
		
	return $ref;
}

?>