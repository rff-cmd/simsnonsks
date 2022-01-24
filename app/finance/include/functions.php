<?php

//-----untuk create notran otomatis
function notran($tanggal, $frmcode, $save, $ref, $vardms='') {
	$yy = date('y', strtotime($tanggal));
	$mm = date('m', strtotime($tanggal));
	$yymm = $yy.$mm;
	
	$ref_q = "Select nbr, alp From ref where frmcde='$frmcode' And yymm='$yymm' ";
	
	$ref_m = mysql_query($ref_q);
	$ref_d = mysql_fetch_array($ref_m);
	
	$nbr = $ref_d['nbr'];
	$alp = $ref_d['alp'];


	if ($alp=='') {
		
		if (trim($frmcode)=='frmrcp') { $ref = 'RCP-'.$mm.$yy.'-00001'; }
		
		if ($save == 1) {
			$sv = "insert into ref(frmcde, nbr, yymm, alp) values ('$frmcode', '1', '$yymm', 'A')";
			$sv_q = mysql_query($sv);
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
		
		if (trim($frmcode)=='frmrcp') { $ref = 'RCP-'.$mm.$yy.'-'.$alp_temp; }
		
		if ($save==1) {		
		
			$upd = "update ref set nbr='$ref_nbr', alp='$ref_alp' Where frmcde='$frmcode' and yymm='$yymm'";
			$upd_q = mysql_query($upd);
		}
	}
		
	return $ref;
}
?>