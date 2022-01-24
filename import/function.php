<?php

function kript($str) {
    $str = md5(md5($str));
	return $str;
  }
  
//untuk mencegah si jahil
function cegah($str) {
    $str = trim(htmlentities($str));
	$str = ereg_replace("%", "persen", $str);
	$str = ereg_replace("1=1", "1smdgan1", $str);
	$str = ereg_replace("-", "stri", $str);
	$str = ereg_replace("_", "stripbwh", $str);
	$str = ereg_replace("/", "gmring", $str);
	$str = ereg_replace("!", "pentung", $str);
	$str = ereg_replace("'", "psiji", $str);
	$str = ereg_replace("select", "NOSQL", $str);
	$str = ereg_replace("delete", "NOSQL", $str);
	$str = ereg_replace("update", "NOSQL", $str);
	$str = ereg_replace("alter", "NOSQL", $str);
	$str = ereg_replace("insert", "NOSQL", $str);
	$str = ereg_replace("from", "NOSQL", $str);
	return $str;
  }

//untuk anti-sql
function nosql($str) {
    $str = trim(mysql_real_escape_string(htmlentities(addslashes(htmlspecialchars($str)))));
	$str = ereg_replace("%", "persen", $str);
	$str = ereg_replace("1=1", "1smdgan1", $str);
	$str = ereg_replace("-", "stri", $str);
	$str = ereg_replace("_", "stripbwh", $str);
	$str = ereg_replace("/", "gmring", $str);
	$str = ereg_replace("!", "pentung", $str);
	$str = ereg_replace("'", "psiji", $str);
	$str = ereg_replace("select", "NOSQL", $str);
	$str = ereg_replace("delete", "NOSQL", $str);
	$str = ereg_replace("update", "NOSQL", $str);
	$str = ereg_replace("alter", "NOSQL", $str);
	$str = ereg_replace("insert", "NOSQL", $str);
	$str = ereg_replace("grant", "NOSQL", $str);
	return $str;
  }
 
//balikino. . o . . .. o. . .. . balikin
function balikin($str) {
	$str = ereg_replace("persen", "%", $str);
	$str = ereg_replace("1smdgan1", "1=1", $str);
	$str = ereg_replace("stri", "-", $str);
	$str = ereg_replace("stripbwh", "_", $str);
	$str = ereg_replace("gmring", "/", $str);
	$str = ereg_replace("pentung", "!", $str);
	$str = ereg_replace("&amp;", "&", $str);
	$str = ereg_replace("-pbwh", "_", $str);
	$str = ereg_replace("psiji", "'", $str);
	return $str;
  }


//penghapus, dayo!
function delete($file) {
 if (file_exists($file)) {
   chmod($file,0777);
   if (is_dir($file)) {
     $handle = opendir($file); 
     while($filename = readdir($handle)) {
       if ($filename != "." && $filename != "..") {
         delete($file."/".$filename);
       }
     }
     closedir($handle);
     rmdir($file);
   } else {
     unlink($file);
   }
 }
}

//pengatur random session
$hajirobe = md5(md5(rand(1,1000000000000)));

//ambil saat ini
$today = date("Ymd H:i:s");

//atur random untuk kode
$x = md5(md5(rand(1,1000000000000)));

//atur random password baru dari lupa
$lpx = rand(1,1000000);

//kosongkan cache
$nocache = "header('cache-control:private') \n ".
			"header('pragma:no-cache') \n ".
			"header('cache-control:no-cache') \n ".
			"flush()";
			
//pengatur array
$ngaray = array(
	//array bulan
   'bln' => array(
       '01' => 'Januari',
       '02' => 'Pebruari',
	   '03' => 'Maret',
	   '04' => 'April',
	   '05' => 'Mei',
	   '06' => 'Juni',
	   '07' => 'Juli',
	   '08' => 'Agustus',
	   '09' => 'September',
	   '10' => 'Oktober',
	   '11' => 'Nopember',
	   '12' => 'Desember'
     )
 );
 
function populate_select($table,$fields_id,$fields_value,$fields_nama,$selected){
	$sql="Select $fields_id,$fields_value,$fields_nama From $table Order By $fields_value";
	$results= mysql_query($sql);	
	while ($row = mysql_fetch_array($results)){
		$SelectedCountry=($row[$fields_id]==$selected) ? " selected" : "";		
		echo "<option value=" . $row[$fields_id] . $SelectedCountry . ">" . $row[$fields_value] . " / ". $row[$fields_nama]. "</option>";
		//($row->$fields_id==$selected) ? 'selected' : '';
	}
	//free_result($results);
}




//-----untuk create notran otomatis
function notran($tanggal, $frmcode, $save, $ref) {
	$yy = date('y', strtotime($tanggal));
	$mm = date('m', strtotime($tanggal));
	$yymm = $yy.$mm;
	
	$ref_q = "Select nbr, alp From ref where frmcde='$frmcode' And yymm='$yymm' ";
	$ref_m = mysql_query($ref_q);
	$ref_d = mysql_fetch_array($ref_m);
	
	$nbr = $ref_d['nbr'];
	$alp = $ref_d['alp'];

	if ($alp=='') {
		if (trim($frmcode)=='frmkj') { $ref = 'K-'.$mm.$yy.'-0001'; }
		if (trim($frmcode)=='frmpinjam') { $ref = 'P-'.$mm.$yy.'-0001'; }
		if (trim($frmcode)=='frmanggota') { $ref = 'AP'.'-0001'; }
		if (trim($frmcode)=='') {	$ref = $yy.$mm.'A00001'; }
		
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
		
		if (trim($frmcode)=='frmkj') { $ref = 'K-'.$mm.$yy.'-'.substr($alp_temp,1,4);}
		if (trim($frmcode)=='frmpinjam') { $ref = 'P-'.$mm.$yy.'-'.substr($alp_temp,1,4);}
		if (trim($frmcode)=='frmanggota') { $ref = 'AP'.'-'.substr($alp_temp,1,4);}
		if (trim($frmcode)=='') { $ref = $yy.$mm.$ref_alp.$ref_temp; }
		
		if ($save==1) {
			$upd = "update ref set nbr='$ref_nbr', alp='$ref_alp' Where frmcde='$frmcode' and yymm='$yymm'";
			$upd_q = mysql_query($upd);
		}
	}
		
	return $ref;
}

?>