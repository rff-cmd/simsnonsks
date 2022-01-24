<?php
require_once('../include/common.php');
require_once('../include/config.php');
require_once('../include/db_functions.php');

$flag = 0;
if (isset($_REQUEST['flag']))
	$flag = (int)$_REQUEST['flag'];
$nama = $_REQUEST['nama'];
$nip = $_REQUEST['nip'];

?>
<table border="0" width="100%" cellpadding="2" cellspacing="2" align="center">
<tr>
	<td>
	<input type="hidden" name="flag" id="flag" value="<?php echo $flag ?>" />
	<font size="2" color="#000000"><strong>Cari Pegawai</strong></font>
 	</td>
</tr>
<tr>
	<td>
    	<form name="main">
        <font color="#000000"><b>Nama</b></font>
    	<input type="text" name="nama" id="nama" value="<?php echo $_REQUEST['nama'] ?>" size="20" onKeyPress="return focusNext('submit', event)" />&nbsp;&nbsp;
		<font color="#000000"><b>NIP</b></font>
    	<input type="text" name="nip" id="nip" value="<?php echo $_REQUEST['nip'] ?>" size="20" onKeyPress="return focusNext('submit', event)" />&nbsp;
		<input type="button" class="but" name="submit" id="submit" value="Cari" onclick="carilah()" style="width:80px;"/>&nbsp;	
	</form>
    </td>
</tr>
<tr>
	<td align="center">
    <div id = "caritabel">
<?php
if (isset($_REQUEST['submit']) || $_REQUEST['submit'] == 1) { 
	OpenDb();
	if ((strlen($nama) > 0) && (strlen($nip) > 0))
		$sql = "SELECT nip, nama, bagian FROM pegawai WHERE nama LIKE '%$nama%' AND nip LIKE '%$nip%' ORDER BY nama"; 
	else if (strlen($nama) > 0)
		$sql = "SELECT nip, nama, bagian FROM pegawai WHERE nama LIKE '%$nama%' ORDER BY nama"; 
	else if (strlen($nip) > 0)
		$sql = "SELECT nip, nama, bagian FROM pegawai WHERE nip LIKE '%$nip%' ORDER BY nama"; 
	//else if ((strlen($nama) == 0) || (strlen($nip) == 0))
	//	$sql = "SELECT nip, nama FROM pegawai ORDER BY nama"; 
	$result = QueryDb($sql);
	if (@mysql_num_rows($result)>0){ ?>
<br />
    <table width="100%" class="tab" align="center" cellpadding="2" cellspacing="0" id="table1" border="1">
    <tr height="30">
        <td class="header" width="7%" align="center">No</td>
        <td class="header" width="15%" align="center">N I P</td>
        <td class="header" align="center" >Nama</td>
        <td class="header" align="center" >Bagian</td>       
        <td class="header" width="10%">&nbsp;</td>
    </tr>
<?php	$cnt = 0;
	while($row = mysql_fetch_row($result)) { ?>
    <tr height="25"  onclick="pilih('<?php echo $row[0]?>', '<?php echo $row[1]?>')" style="cursor:pointer"> 
        <td align="center"><?php echo ++$cnt ?></td>
        <td align="center"><?php echo $row[0] ?></td>
        <td><?php echo $row[1] ?></td>
        <td><?php echo $row[2] ?></td>
        <td align="center">
        <input type="button" name="pilih" class="but" id="pilih" value="Pilih" onclick="pilih('<?php echo $row[0]?>', '<?php echo $row[1]?>')" />
        </td>
    </tr>
<?php } CloseDb(); ?>
 	</table>
<?php } else { ?>    		
	<table width="100%" align="center" cellpadding="2" cellspacing="0" border="0" id="table1">
	<tr height="30" align="center">
		<td>   
   
	<br /><br />	
	<font size = "2" color ="red"><b>Tidak ditemukan adanya data. <br /><br />            
		Tambah data pegawai di menu Kepegawaian pada bagian Referensi. </b></font>	
	<br /><br />
   		</td>
    </tr>
    </table>
<?php 	} 
}?>	
	</div>
    </td>    
</tr>
<tr>
	<td align="center" >
	<input type="button" class="but" name="tutup" id="tutup" value="Tutup" onclick="window.close()" style="width:80px;"/>
	</td>
</tr>
</table></table>

</body>
</html>