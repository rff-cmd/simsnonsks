<?php 	
function getHeader($dep)
{
	global $full_url;
	
	OpenDb();
	$sql = "SELECT * FROM identitas WHERE departemen='$dep'";
	$result = QueryDb($sql); 
	$num = @mysql_num_rows($result);
	$row = @mysql_fetch_array($result);
	$replid = $row[replid];
	$nama = $row[nama];
	$alamat1 = $row[alamat1];
	$alamat2 = $row[alamat2];
	$te1p1 = $row[telp1];
	$telp2 = $row[telp2];
	$te1p3 = $row[telp3];
	$telp4 = $row[telp4];
	$fax1 = $row[fax1];
	$fax2 = $row[fax2];
	$situs = $row[situs];
	$email = $row[email];
	$full_url = base64_decode($row[foto]);
	
	$te1p1_head = $te1p1;
	$te1p1_head = ", Bandung Telp.: " . $te1p1_head;
	//CloseDb();
		
	$head =	"<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">";
	$head .="	<tr>";
	$head .="		<td width=\"10%\" align=\"center\">";
	$head .="		<img width=\"70px\" height=\"50px\" src=\"".$full_url."library/gambar.php?replid=".$replid."&table=identitas\" />";
	$head .="		</td>";
	$head .="		<td valign=\"top\">";
						if ($num >  0) {	
	$head .="				<font size=\"2\"><strong>".$nama."</strong></font><br />".
			"				<strong>";
						if ($alamat2 <> "" && $alamat1 <> "")
	$head .="				Lokasi 1: ";
						if ($alamat1 != "") 
	$head .=				$alamat1;
									
						if ($telp1 != "" || $telp2 != "") 
	$head .="				<br>Telp. ";	
						if ($te1p1_head != "" ) 
	$head .=				$te1p1_head;	
						if ($telp1 != "" && $telp2 != "") 
	$head .="				, ";
						if ($telp2 != "" ) 
	$head .=				$telp2;			
						if ($fax1 != "" ) 
	$head .="				&nbsp;&nbsp;Fax. ".$fax1."&nbsp;&nbsp;";
						if ($alamat2 <> "" && $alamat1 <> "") {
	$head .="				<br>";
	$head .="				Lokasi 2: ";
	$head .=				$alamat2;
											
						if ($telp3 != "" || $telp4 != "") 
	$head .="				<br>Telp. ";	
						if ($telp3 != "" ) 					
	$head .=				$telp3;
						if ($telp3 != "" && $telp4 != "") 
	$head .="				, ";
						if ($telp4 != "" ) 
	$head .=				$telp4;				
						if ($fax2 != "" ) 
	$head .="				&nbsp;&nbsp;Fax. ".$fax2;	
						}
						if ($situs != "" || $email != "")
	$head .="				<br>";
						if ($situs != "" ) 
	$head .="				Website: ".$situs."&nbsp;&nbsp;";
						if ($email != "" ) 
	$head .="				Email: ".$email;
						
	$head .="			</strong>";
						}  
	$head .="			</td>";
	$head .="		</tr>";
	$head .="		<tr>";
	$head .="			<td colspan=\"2\"><hr width=\"100%\" /></td>";
	$head .="		</tr>";
	$head .="		</table>";
	$head .="	<br />";

	echo  $head;
	
}


function getHeader_nonlogo($dep)
{
	global $full_url;
	
	OpenDb();
	$sql = "SELECT * FROM identitas WHERE departemen='$dep'";
	$result = QueryDb($sql); 
	$num = @mysql_num_rows($result);
	$row = @mysql_fetch_array($result);
	$replid = $row[replid];
	$nama = $row[nama];
	$alamat1 = $row[alamat1];
	$alamat2 = $row[alamat2];
	$te1p1 = $row[telp1];
	$telp2 = $row[telp2];
	$te1p3 = $row[telp3];
	$telp4 = $row[telp4];
	$fax1 = $row[fax1];
	$fax2 = $row[fax2];
	$situs = $row[situs];
	$email = $row[email];
	$full_url = base64_decode($row[foto]);
	
	$te1p1_head = $te1p1;
	$te1p1_head = ", Bandung Telp.: " . $te1p1_head;
	//CloseDb();
		
	$head =	"<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">";
	$head .="	<tr>";
	$head .="		<td width=\"10%\" align=\"center\">";
	/*$head .="		<img width=\"70px\" height=\"50px\" src=\"".$full_url."library/gambar.php?replid=".$replid."&table=identitas\" />";
	$head .="		</td>"; */
	$head .="		<td valign=\"top\">";
						if ($num >  0) {	
	$head .="				<font size=\"2\">".$nama."</font><br />".
			"				";
						if ($alamat2 <> "" && $alamat1 <> "")
	$head .="				Lokasi 1: ";
						if ($alamat1 != "") 
	$head .=				$alamat1;
									
						if ($telp1 != "" || $telp2 != "") 
	$head .="				<br>Telp. ";	
						if ($te1p1_head != "" ) 
	$head .=				$te1p1_head;	
						if ($telp1 != "" && $telp2 != "") 
	$head .="				, ";
						if ($telp2 != "" ) 
	$head .=				$telp2;			
						if ($fax1 != "" ) 
	$head .="				&nbsp;&nbsp;Fax. ".$fax1."&nbsp;&nbsp;";
						if ($alamat2 <> "" && $alamat1 <> "") {
	$head .="				<br>";
	$head .="				Lokasi 2: ";
	$head .=				$alamat2;
											
						if ($telp3 != "" || $telp4 != "") 
	$head .="				<br>Telp. ";	
						if ($telp3 != "" ) 					
	$head .=				$telp3;
						if ($telp3 != "" && $telp4 != "") 
	$head .="				, ";
						if ($telp4 != "" ) 
	$head .=				$telp4;				
						if ($fax2 != "" ) 
	$head .="				&nbsp;&nbsp;Fax. ".$fax2;	
						}
						if ($situs != "" || $email != "")
	$head .="				<br>";
						if ($situs != "" ) 
	$head .="				Website: ".$situs."&nbsp;&nbsp;";
						if ($email != "" ) 
	$head .="				Email: ".$email;
						
	$head .="			";
						}  
	$head .="			</td>";
	$head .="		</tr>";
	$head .="		<tr>";
	$head .="			<td colspan=\"2\"><hr width=\"100%\" /></td>";
	$head .="		</tr>";
	$head .="		</table>";
	$head .="	";

	echo  $head;
	
}

?>