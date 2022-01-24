<?php
require_once('../include/common.php');
require_once('../include/config.php');
require_once('../include/db_functions.php');
require_once('../include/sessioninfo.php');
require_once('departemen.php');

$flag = 0;
if (isset($_REQUEST['flag']))
	$flag = (int)$_REQUEST['flag'];
$nama = $_REQUEST['nama'];
$nis = $_REQUEST['nis'];
$departemen = $_REQUEST['departemen'];
$filter = "";
if ($departemen <> -1) 
	$filter = "AND t.departemen = '$departemen'";
	
$urut1 = "s.nama";	
if (isset($_REQUEST['urut1']))
	$urut1 = $_REQUEST['urut1'];	
$urutan1 = "ASC";	
if (isset($_REQUEST['urutan1']))
	$urutan1 = $_REQUEST['urutan1'];

OpenDb();
?>
<table border="0" width="100%" align="center">
<tr>
    <td width="20%"><font color="#000000"><strong>Departemen</strong></font></td>
    <td>
    <input type="text" name="departemen" id="departemen" value="<?php echo $_REQUEST['departemen']?>" readonly="readonly" style="background-color:#CCCC99;" size="23">
    <input type="hidden" name="depart1" id="depart1" value="<?php echo $_REQUEST['departemen']?>" />
    <!--<select name="depart1" id="depart1" onChange="change_departemen(1)" style="width:155px" onkeypress="return focusNext('nama', event)">
    	<option value=-1>(Semua Departemen)</option>
	<?php	$dep = getDepartemen(getAccess());    
        foreach($dep as $value) {
            if ($departemen == "")
                $departemen = $value; ?>
        <option value="<?php echo $value ?>" <?php echo StringIsSelected($value, $departemen) ?> >
        <?php echo $value ?>
        </option>
        <?php	} ?>
  	</select>-->
    </td>
   
</tr>
<tr>
    <td>
        <font color="#000000"><strong>NIS Siswa</strong></font></td>	
   	<td><input type="text" name="nis" id="nis" value="<?php echo $_REQUEST['nis'] ?>" size="23" onKeyPress="return focusNext('submit', event)"/>     
  	</td>   
</tr>	
<tr>
    <td><font color="#000000"><strong>Nama Siswa</strong></font></td>
    <td><input type="text" name="nama" id="nama" value="<?php echo $_REQUEST['nama'] ?>" size="23" onKeyPress="return focusNext('submit', event)"/></td>

<tr>
	<td colspan="2"width="15%" align="center">
    <input type="button" class="but" name="submit" id="submit" value="Cari" onclick="carilah();return focusNext1('siswa', event, 'cari',1,0)" style="width:80px"/>
    </td>
</tr>
<tr>
    <td align="center" colspan="3">
	<div id="caritabel">
    
<?php 
	
if (isset($_REQUEST['submit']) || $_REQUEST['submit'] == 1) { 
	OpenDb();    
  
	if ((strlen($nama) > 0) && (strlen($nis) > 0))
		//$sql = "SELECT s.nis, s.nama, k.kelas, t.departemen, t.tingkat FROM siswa s,kelas k,tingkat t, WHERE s.nama LIKE '%$nama%' AND s.nis LIKE '%$nis%' AND k.replid=s.idkelas AND s.alumni=0 AND s.aktif=1 AND k.idtingkat = t.replid $filter ORDER BY k.kelas, s.nama"; 
		$sql = "SELECT s.nis, s.nama, k.kelas, t.departemen, t.tingkat FROM siswa s,kelas k,tingkat t, departemen d WHERE s.nama LIKE '%$nama%' AND s.nis LIKE '%$nis%' AND k.replid=s.idkelas AND s.alumni=0 AND s.aktif=1 AND k.idtingkat = t.replid $filter GROUP BY s.nis ORDER BY $urut1 $urutan1";	
	else if (strlen($nama) > 0)
		$sql = "SELECT s.nis, s.nama, k.kelas, t.departemen, t.tingkat FROM siswa s,kelas k,tingkat t WHERE s.nama LIKE '%$nama%' AND k.replid=s.idkelas AND s.alumni=0 AND s.aktif=1 AND k.idtingkat = t.replid $filter ORDER BY $urut1 $urutan1"; 
	else if (strlen($nis) > 0)
		$sql = "SELECT s.nis, s.nama, k.kelas, t.departemen, t.tingkat FROM siswa s,kelas k ,tingkat t WHERE k.replid=s.idkelas AND s.nis LIKE '%$nis%' AND s.alumni = 0 AND s.aktif=1 AND k.idtingkat = t.replid $filter ORDER BY $urut1 $urutan1"; 	
	$result = QueryDb($sql);
	
	if (@mysql_num_rows($result)>0){
?>   
	<br>
   	<table width="100%" id="table1" class="tab" align="center" border="1" bordercolor="#000000">
    <tr height="30" class="header" align="center">
        <td width="7%">No</td>
        <td width="10%" onMouseOver="background='style/formbg2agreen.gif';height=30;" onMouseOut="background='style/formbg2.gif';height=30;" background="style/formbg2.gif" style="cursor:pointer;" onClick="change_urut('s.nis','<?php echo $urutan1?>','cari')">N I S <?php echo change_urut('s.nis',$urut1,$urutan1)?></td>
        <td width="*" onMouseOver="background='style/formbg2agreen.gif';height=30;" onMouseOut="background='style/formbg2.gif';height=30;" background="style/formbg2.gif" style="cursor:pointer;" onClick="change_urut('s.nama','<?php echo $urutan1?>','cari')">Nama <?php echo change_urut('s.nama',$urut1,$urutan1)?></td>       
        <td width="20%" onMouseOver="background='style/formbg2agreen.gif';height=30;" onMouseOut="background='style/formbg2.gif';height=30;" background="style/formbg2.gif" style="cursor:pointer;" onClick="change_urut('t.tingkat','<?php echo $urutan1?>','cari')">Kls <?php echo change_urut('t.tingkat',$urut1,$urutan1)?></td>       
    </tr>
<?php
	$cnt = 0;
		while($row = mysql_fetch_row($result)) { ?>
   	<tr height="25" onClick="pilih('<?php echo $row[0]?>')" style="cursor:pointer" id="siswacari<?php echo $cnt?>">
        <td align="center" ><?php echo ++$cnt ?></td>
        <td align="center">
		<input type="text" name="carisiswa<?php echo $cnt?>" id="carisiswa<?php echo $cnt?>" readonly="readonly" size="10" style="border:none; background:none; text-align:center;" value="<?php echo $row[0]?>" onkeypress="pilih('<?php echo $row[0]?>');return focusNext1('siswa', event, 'cari', <?php echo $cnt?>, 1)" />
		<?php //$row[0] ?></td>
        <td align="left"><?php echo $row[1] ?></td>       
        <td align="center"><?php if ($departemen == -1) echo  $row[3].'<br>'.$row[4].' - '.$row[2]; else echo  $row[4].' - '.$row[2] ?></td>
	</tr>
<?php } CloseDb(); ?>
 	</table>
<?php } else { ?>    		
	<table width="100%" align="center" cellpadding="2" cellspacing="0" border="0" id="table1">
	<tr height="30" align="center">
		<td>   
   
	<br />
	<font size = "2" color ="red"><b>Tidak ditemukan adanya data</b></font>	
	<br /><br />
   		</td>
    </tr>
    </table>
<?php 	} 
} else { ?>

<table width="100%" align="center" cellpadding="2" cellspacing="0" border="0" id="table1">
<tr height="30" align="center">
    <td>   

<br /><br />	
<font size="2" color="#757575"><b>Klik pada tombol "Cari" di atas untuk melihat data calon siswa <br />sesuai dengan NIS atau Nama Siswa berdasarkan <i>keyword</i> yang dimasukkan</b></font>	
<br /><br />
    </td>
</tr>
</table>


<?php }?>	
    </div>
	 </td>    
</tr>
</table>