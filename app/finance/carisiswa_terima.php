<?php
include_once ("../include/queryfunctions.php");
include_once ("../include/functions.php");
//require_once('include/sessionchecker.php');
require_once('include/common.php');
require_once('include/rupiah.php');
require_once('include/config.php');
//require_once('include/db_functions.php');
require_once('include/theme.php');
//require_once('include/sessioninfo.php');


$idtingkat = "";
if (isset($_REQUEST['idtingkat']))
	$idtingkat = $_REQUEST['idtingkat'];
	
$idkelas = "";
if (isset($_REQUEST['idkelas']))
	$idkelas = $_REQUEST['idkelas'];
	
if (isset($_REQUEST['nama']))
	$nama = $_REQUEST['nama'];

$nis = "";
if (isset($_REQUEST['nis']))
	$nis = $_REQUEST['nis'];

$all = $_REQUEST['all'];
	
$varbaris=10;
if (isset($_REQUEST['varbaris']))
	$varbaris = $_REQUEST['varbaris'];

$page=0;
if (isset($_REQUEST['page']))
	$page = $_REQUEST['page'];
	
$hal=0;
if (isset($_REQUEST['hal']))
	$hal = $_REQUEST['hal'];

$urut = "a.nama";	
if (isset($_REQUEST['urut']))
	$urut = $_REQUEST['urut'];	
	$nis = $_REQUEST['nis'];
	$nama = $_REQUEST['nama'];

$urutan = "ASC";	
if (isset($_REQUEST['urutan']))
	$urutan = $_REQUEST['urutan'];	
	$nis = $_REQUEST['nis'];
	$nama = $_REQUEST['nama'];


if( $all == 1 ) {
	$all = "checked";
}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="style/style.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIAS - KEU [Cari Siswa]</title>
<script src="script/SpryValidationSelect.js" type="text/javascript"></script>
<link href="script/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="script/tables.js"></script>
<script language="javascript" src="script/tools.js"></script>
<script language="javascript">
function change_kategori() {
	var kate = document.getElementById('kategori').value;
	document.location.href = "carirek.php?kategori="+kate+"&flag=<?php echo $flag?>";
}

function pilih(nis, nama) {
	opener.accept_siswa(nis, nama);
	window.close();
}

function focusNext(elemName, evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode :
        ((evt.which) ? evt.which : evt.keyCode);
    if (charCode == 13) {
		document.getElementById(elemName).focus();
        return false;
    }
    return true;
}

function change_urut(urut,urutan,all) {		
	var nis = document.getElementById('nis').value;
	var nama=document.getElementById("nama").value;
	var all=document.getElementById("all").checked;
	if(all) {
		nis = "";
		nama = "";
	}
	
	if (urutan =="ASC"){
		urutan="DESC"
	} else {
		urutan="ASC"
	}
	
	document.location.href = "carisiswa_terima.php?nama="+nama+"&nis="+nis+"&urutan="+urutan+"&urut="+urut+"&all="+all+"&page=<?php echo $page?>&hal=<?php echo $hal?>&varbaris=<?php echo $varbaris?>";
	
}
</script>
</head>

<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" background="" style='background-color:#dfdec9' onLoad="document.getElementById('kategori').focus();">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr height="58">
	<td width="28" background="<?php echo GetThemeDir() ?>bgpop_01.jpg">&nbsp;</td>
    <td width="*" background="<?php echo GetThemeDir() ?>bgpop_02a.jpg">
	<div align="center" style="color:#FFFFFF; font-size:16px; font-weight:bold">
    .: Cari Siswa :.
    </div>
	</td>
    <td width="28" background="<?php echo GetThemeDir() ?>bgpop_03.jpg">&nbsp;</td>
</tr>
<tr height="150">
	<td width="28" background="<?php echo GetThemeDir() ?>bgpop_04a.jpg">&nbsp;</td>
    <td width="0" style="background-color:#FFFFFF" valign="top" height="350">
    <!-- CONTENT GOES HERE //--->
<table border="0" width="100%" align="center">
<!-- TABLE CENTER -->
<tr>	
	<td align="left" valign="top">
	
		<form action="" method="post" >
		    <table border="0" cellpadding="0" cellspacing="0" width="100%">
			    <!-- TABLE LINK -->
			    
			    <tr>
			    	<td align="left" width="10%"><strong>Level&nbsp;</strong></td>
			    	<td align="left" width="1%"><strong>:</strong></td>
			    	<td align="left" width="50%">
			        	<select name="idtingkat" id="idtingkat" style="width:min-width:10px; height:27px; "  >
							<option value="">...</option>
							<?php select_tingkat($idtingkat); ?>
						</select>
			        </td>
			    </tr>
			    
			    <?php /*
			    <tr>
			    	<td align="left" width="10%"><strong>Kelas&nbsp;</strong></td>
			    	<td align="left" width="1%"><strong>:</strong></td>
			    	<td align="left" width="50%">
			        	<select name="idkelas" id="idkelas" style="width:min-width:10px; height:27px; "  >
							<option value="">...</option>
							<?php select_kelasfilter($idkelas); ?>
						</select>
			        </td>
			    </tr> */ ?>
			    
			    <tr>
			    	<td align="left" width="10%"><strong>NIS&nbsp;</strong></td>
			    	<td align="left" width="1%"><strong>:</strong></td>
			    	<td align="left" width="50%">
			        	<input type="text" id="nis" name="nis" size="20" value="<?php echo $nis ?>" />
			        </td>
			    </tr>
			    
			    <tr>
			    	<td align="left" width="10%"><strong>Nama Siswa&nbsp;</strong>
			        </td>
			        <td align="left" width="1%"><strong>:</strong></td>
			        <td align="left" width="50%">
			        	<input type="text" id="nama" name="nama" size="50" value="<?php echo $nama ?>" />
			        </td>
			    </tr>
			    
			    <tr>
			    	<td align="left" width="10%"><strong>Semua&nbsp;</strong>
			        </td>
			        <td align="left" width="1%"><strong>:</strong></td>
			        <td align="left" width="50%">
			        	<input type="checkbox" id="all" name="all" size="50" value="1" <?php echo $all ?> />
			        </td>
			    </tr>
			    
			    <tr>
			    	<td></td>
			    	<td></td>
			    	<td align="left" width="50%">&nbsp;
			        </td>
			    </tr>
			    
			    <tr>
			    	<td></td>
			    	<td></td>
			    	<td align="left" width="50%">
			    		<input type="submit" id="submit" name="submit" value="Cari" style="width: 50px" />
			        </td>
			    </tr>
			</table>
		</form>
    </td>
</tr>
<tr>
	<td>
<?php	
	//OpenDb();
	$dbpdo = DB::create();
	
	$where = "";
	
	if($idtingkat != "") {
		if ($where == "") {
			$where = " where b.idtingkat = '$idtingkat' ";
		} else {
			$where = $where . " and b.idtingkat = '$idtingkat' ";
		}
	}
	
	if($idkelas != "") {
		if ($where == "") {
			$where = " where a.idkelas = '$idkelas' ";
		} else {
			$where = $where . " and a.idkelas = '$idkelas' ";
		}
	}
	
	if($nis != "") {
		if ($where == "") {
			$where = " where a.nis like '%$nis%' ";
		} else {
			$where = $where . " and a.nis like '%$nis%' ";
		}
	}
	
	if($nama != "") {
		if ($where == "") {
			$where = " where a.nama like '%$nama%' ";
		} else {
			$where = $where . " and a.nama like '%$nama%' ";
		}
	}
	
	if($all == "checked") {
		$where = "";
	}
	
	if($nis == "" && $nama == "" && $all == "" && $idtingkat == "") {
		$where = " where a.nis = '0' ";
	}
	
		
	$sql_tot = "select a.replid, a.nis, a.nama, a.idkelas from siswa a left join kelas b on a.idkelas=b.replid " . $where . " order by a.nama";
	$sql=$dbpdo->prepare($sql_tot);
	$sql->execute();
	$result_tot = $sql->rowCount();
	//$result_tot = QueryDb($sql_tot);
	//$total = ceil(mysql_num_rows($result_tot)/(int)$varbaris);
	$total = ceil($result_tot/(int)$varbaris);
	$jumlah = $result_tot; //mysql_num_rows($result_tot);
	$akhir = ceil($jumlah/5)*5;
	
	$sqlstr = "select a.replid, a.nis, a.nama, b.kelas, c.tingkat from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid " . $where . " order by $urut $urutan "; 
	$sql2=$dbpdo->prepare($sqlstr);
	$sql2->execute();
	$rows = $sql2->rowCount();
	//$result = QueryDb($sql);
	
	if ($rows > 0) {
		$tot = $rows; //mysql_num_rows($result);
		
?>
	<br />
    
	<table class="tab" id="table" border="1" style="border-collapse:collapse" width="100%" align="left" bordercolor="#000000">
	<tr height="30" align="center" class="header">
        <td width="8%" >No</td>
        <td width="15%" onMouseOver="background='style/formbg2agreen.gif';height=30;" onMouseOut="background='style/formbg2.gif';height=30;" background="style/formbg2.gif" onClick="change_urut('a.nis','<?php echo $urutan?>','<?php echo $all ?>')" style="cursor:pointer;">NIS <?php echo change_urut('nis',$urut,$urutan)?></td>
        <td width="30%"  onMouseOver="background='style/formbg2agreen.gif';height=30;" onMouseOut="background='style/formbg2.gif';height=30;" background="style/formbg2.gif" onClick="change_urut('a.nama','<?php echo $urutan?>','<?php echo $all ?>')" style="cursor:pointer;">Nama <?php echo change_urut('nama',$urut,$urutan)?></td>
        <td onMouseOver="background='style/formbg2agreen.gif';height=30;" onMouseOut="background='style/formbg2.gif';height=30;" background="style/formbg2.gif" onClick="change_urut('c.tingkat','<?php echo $urutan?>','<?php echo $all ?>')" style="cursor:pointer;">Tingkat <?php echo change_urut('tingkat',$urut,$urutan)?></td>
        <td onMouseOver="background='style/formbg2agreen.gif';height=30;" onMouseOut="background='style/formbg2.gif';height=30;" background="style/formbg2.gif" onClick="change_urut('b.kelas','<?php echo $urutan?>','<?php echo $all ?>')" style="cursor:pointer;">Kelas <?php echo change_urut('kelas',$urut,$urutan)?></td>
        <td width="6%">&nbsp;</td>
	</tr>
    <?php 
	if ($page==0)
		$no = 0;
	else 
		$no = (int)$page*(int)$varbaris;
		
	//while ($row = mysql_fetch_array($result)) {
	while ($row=$sql2->fetch(PDO::FETCH_OBJ)) {
	?>
    <tr>
    	<td align="center"><?php echo ++$no ?></td>
        <td align="left">&nbsp;<?php echo $row->nis ?></td>
        <td>&nbsp;<?php echo $row->nama ?></td>
        <td align="center"><?php echo $row->tingkat ?></td>
        <td align="center"><?php echo $row->kelas ?></td>
        <td align="center">
        <input type="button" class="but" value="pilih" name="pilih<?php echo $no ?>" id="pilih<?php echo $no ?>" onclick="pilih('<?php echo $row->nis ?>','<?php echo $row->nama ?>')"  />
        </td>
    </tr>
    <?php 
	}
	?>
    </table>
     <script language='JavaScript'>
	    Tables('table', 1, 0);
    </script>
     <?php	if ($page==0){ 
		$disback="style='visibility:hidden;'";
		$disnext="style='visibility:visible;'";
		}
		if ($page<$total && $page>0){
		$disback="style='visibility:visible;'";
		$disnext="style='visibility:visible;'";
		}
		if ($page==$total-1 && $page>0){
		$disback="style='visibility:visible;'";
		$disnext="style='visibility:hidden;'";
		}
		if ($page==$total-1 && $page==0){
		$disback="style='visibility:hidden;'";
		$disnext="style='visibility:hidden;'";
		}
	?>
     </td>
</tr> 
<tr>
    <td>
    
<?php	} else { ?>	
<table width="100%" border="0" align="center">
<tr><td><hr style="border-style:dotted" /></td></tr>          
<tr>
	<td align="center" valign="middle" height="200">    
    	<font size = "2" color ="red"></font>
	</td>
</tr>
</table>  
<?php } ?>    
    </td>
</tr>
<tr height="35">
	<td align="center">
       <input class="but" type="button" value="Tutup" onClick="window.close()">
   	</td>
</tr>  
</table>

	<!-- END OF CONTENT //--->
    </td>
    <td width="28" background="<?php echo GetThemeDir() ?>bgpop_06a.jpg">&nbsp;</td>
</tr>
<tr height="28">
	<td width="28" background="<?php echo GetThemeDir() ?>bgpop_07.jpg">&nbsp;</td>
    <td width="*" background="<?php echo GetThemeDir() ?>bgpop_08a.jpg">&nbsp;</td>
    <td width="28" background="<?php echo GetThemeDir() ?>bgpop_09.jpg">&nbsp;</td>
</tr>
</table>
</body>
</html>
<script language="javascript">
	var spryselect1 = new Spry.Widget.ValidationSelect("kategori");
</script>