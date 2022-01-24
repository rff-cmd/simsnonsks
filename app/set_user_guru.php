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
	
	$dbpdo = DB::create();
	
	$strsql = "select distinct c.nama, a.usrid, a.tipe_user from guru b left join pegawai c on b.nip=c.replid left join usr a on b.nip=a.idpegawai where (ifnull(b.kode,'')='' or ifnull(b.kode,'')='-')  and (a.tipe_user='Guru' or a.tipe_user='Pegawai') 
";
	$sqldet=$dbpdo->prepare($strsql);
	$sqldet->execute();
	while($datadet=$sqldet->fetch(PDO::FETCH_OBJ)) {
		
		$usrid = $datadet->usrid;
		//detail
		$strsql2 = "select frmcde from usr_frm where frmcde in ('frmsiswa_ekstrakurikuler')";
		$sqldet2=$dbpdo->prepare($strsql2);
		$sqldet2->execute();
		while($datadet2=$sqldet2->fetch(PDO::FETCH_OBJ)) {
			$usr_frmcde = $datadet2->frmcde;
			
			$sqlcek = "select frmcde from usr_dtl where usrid='$usrid' and frmcde='$usr_frmcde'";
			$sqldet3=$dbpdo->prepare($sqlcek);
			$sqldet3->execute();
			$rows = $sqldet3->rowCount();
			
			if($rows == 0) {
				//echo $datadet->usrid."<br>";
				
				$usr_edt = 1;
				$usr_add = 1;				
				$usr_dlt = 1;
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
				echo $sqlstr."<br>";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
		}
	}
				
?>





