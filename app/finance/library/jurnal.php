<?php
function SimpanJurnal($idtahunbuku, $tanggal, $transaksi, $nokas, $keterangan, $petugas, $sumber, &$idjurnal) 
{
	$dbpdo = DB::create();
	
	//Simpan ke jurnal
	$success = 0;
	
	$sqlstr = "INSERT INTO jurnal SET idtahunbuku=$idtahunbuku,tanggal='$tanggal',transaksi='$transaksi',nokas='$nokas',keterangan='$keterangan',petugas='$petugas', sumber='$sumber'";
	//echo  "$sql<br>";
	$success=$dbpdo->prepare($sqlstr);
	$success->execute();
	//$besarjtt_view=$sql->fetch(PDO::FETCH_OBJ)
	//$result = QueryDbTrans($sql, $success);
	
	$idjurnal = 0;
	if ($success) {
		$sqlstr = "SELECT last_insert_id() lastid";
		$success=$dbpdo->prepare($sqlstr);
		$success->execute();
		//$result = QueryDbTrans($sql, $success);
		if ($success) {
			$row = $success->fetch(PDO::FETCH_OBJ); //@mysql_fetch_row($result);	
			$idjurnal = $row->lastid; //[0];
		}	
	}

	return $success;
}


function UpdateJurnal($idtahunbuku, $tanggal, $transaksi, $nokas, $keterangan, $petugas, $sumber, $idjurnal) 
{
	$dbpdo = DB::create();
	
	//Simpan ke jurnal
	$success = 0;
	
	$sqlstr = "update jurnal SET idtahunbuku=$idtahunbuku,tanggal='$tanggal',transaksi='$transaksi',nokas='$nokas',keterangan='$keterangan',petugas='$petugas', sumber='$sumber' where replid='$idjurnal'";
	//echo  "$sql<br>";
	$success=$dbpdo->prepare($sqlstr);
	$success->execute();
	//$besarjtt_view=$success->fetch(PDO::FETCH_OBJ);
	//$result = QueryDbTrans($sql, $success);
	
	/*$idjurnal = 0;
	if ($success) {
		$sqlstr = "SELECT last_insert_id() lastid";
		$success=$dbpdo->prepare($sqlstr);
		$success->execute();
		//$result = QueryDbTrans($sql, $success);
		if ($success) {
			$row = $success->fetch(PDO::FETCH_OBJ); //@mysql_fetch_row($result);	
			$idjurnal = $row->lastid; //[0];
		}	
	}*/

	return $success;
}


function SimpanDetailJurnal($idjurnal, $align, $koderek, $jumlah) 
{
	$dbpdo = DB::create();
	
	$success = 0;
	
	if ($align == "D")
		$sqlstr = "INSERT INTO jurnaldetail SET idjurnal=$idjurnal,koderek='$koderek',debet=$jumlah";
	else
		$sqlstr = "INSERT INTO jurnaldetail SET idjurnal=$idjurnal,koderek='$koderek',kredit=$jumlah";
	//echo  "$sql<br>";		
	//QueryDbTrans($sql, $success);
	$success=$dbpdo->prepare($sqlstr);
	$success->execute();
	
	return $success;
}

function UpdateDetailJurnal($idjurnal, $align, $koderek, $jumlah) 
{
	$dbpdo = DB::create();
	
	$success = 0;
	
	if ($align == "D") {
		$cek = "select replid from jurnaldetail where idjurnal='$idjurnal' order by replid asc limit 1";
		$xcek=$dbpdo->prepare($cek);
		$xcek->execute();
		$datacek=$xcek->fetch(PDO::FETCH_OBJ);
		$replid=$datacek->replid;
		
		$sqlstr = "update jurnaldetail SET koderek='$koderek',debet=$jumlah where idjurnal='$idjurnal' and replid='$replid'";
		$success=$dbpdo->prepare($sqlstr);
		$success->execute();
	} else {
		$cek = "select replid from jurnaldetail where idjurnal='$idjurnal' order by replid desc limit 1";
		$xcek=$dbpdo->prepare($cek);
		$xcek->execute();
		$datacek=$xcek->fetch(PDO::FETCH_OBJ);
		$replid=$datacek->replid;
		
		$sqlstr = "update jurnaldetail SET koderek='$koderek',kredit=$jumlah where idjurnal='$idjurnal' and replid='$replid'";
		$success=$dbpdo->prepare($sqlstr);
		$success->execute();
	}
	
	
	
	return $success;
}

?>