<?php 	
function cari_gambar(){
 	if(file_exists("../library/gambar.php")) {
	   $addr = "../library/gambar.php";
	} else {
		if(file_exists("../../library/gambar.php")) {
	          $addr = "../../library/gambar.php";
		} else	{
			   $addr = "../../../library/gambar.php";
		}
	}
		return $addr ; 
}

OpenDb();
$sql_identitas = "SELECT * FROM identitas";
$result_identitas = QueryDb($sql_identitas); 
$row_iden = mysql_fetch_array($result_identitas);
$replid_logo = $row_iden['replid'];

?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td width="20%" align="center">
    <img src="library/gambar.php?replid=<?php echo $replid_logo?>&table=identitas" />
	<!--<img src="../images/logokecil.gif" border="0" />-->
	</td>
    <td valign="top">
  
       	<?php 
			$result_identitas = QueryDb($sql_identitas); 
			if (mysql_num_rows($result_identitas) >  0) {	
			$row_identitas = mysql_fetch_array($result_identitas);?>
            <font size="5"><strong><?php echo $row_identitas['nama']?></strong></font><br />
            <strong>
		<?php 	if ($row_identitas['alamat2'] <> "" && $row_identitas['alamat1'] <> "")
            	echo  "Lokasi 1: ";
		  	if ($row_identitas['alamat1'] != "") 
				echo  $row_identitas['alamat1'];
						
			if ($row_identitas['telp1'] != "" || $row_identitas['telp2'] != "") 
				echo  "<br>Telp. ";	
			if ($row_identitas['telp1'] != "" ) 
				echo  $row_identitas['telp1'];	
			if ($row_identitas['telp1'] != "" && $row_identitas['telp2'] != "") 
					echo  ", ";
			if ($row_identitas['telp2'] != "" ) 
				echo  $row_identitas['telp2'];			
			if ($row_identitas['fax1'] != "" ) 
				echo  "&nbsp;&nbsp;Fax. ".$row_identitas['fax1']."&nbsp;&nbsp;";
			if ($row_identitas['alamat2'] <> "" && $row_identitas['alamat1'] <> "") {
				echo  "<br>";
            	echo  "Lokasi 2: ";
				echo  $row_identitas['alamat2'];
								
				if ($row_identitas['telp3'] != "" || $row_identitas['telp4'] != "") 
					echo  "<br>Telp. ";	
				if ($row_identitas['telp3'] != "" ) 					
					echo  $row_identitas['telp3'];
				if ($row_identitas['telp3'] != "" && $row_identitas['telp4'] != "") 
					echo  ", ";
				if ($row_identitas['telp4'] != "" ) 
					echo  $row_identitas['telp4'];				
				if ($row_identitas['fax2'] != "" ) 
					echo  "&nbsp;&nbsp;Fax. ".$row_identitas['fax2'];	
			}
			if ($row_identitas['situs'] != "" || $row_identitas['email'] != "")
				echo  "<br>";
			if ($row_identitas['situs'] != "" ) 
				echo  "Website: ".$row_identitas['situs']."&nbsp;&nbsp;";
			if ($row_identitas['email'] != "" ) 
				echo  "Email: ".$row_identitas['email'];
			
		?>
            </strong>
   		<?php }  ?>
    </td>
</tr>
<tr>
	<td colspan="2"><hr width="100%" /></td>
</tr>
</table>
<br />