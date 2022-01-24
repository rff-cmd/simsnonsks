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
$no = $_REQUEST['no'];
$departemen = $_REQUEST['departemen'];
$filter = "";
if ($departemen <> -1) 
	$filter = "AND p.departemen = '$departemen'";
	
$urut3 = "c.nama";	
if (isset($_REQUEST['urut3']))
	$urut3 = $_REQUEST['urut3'];	
$urutan3 = "ASC";	
if (isset($_REQUEST['urutan3']))
	$urutan3 = $_REQUEST['urutan3'];
OpenDb();
?>
<table border="0" width="100%" align="center">
<tr>
    <td width="45%"><font color="#000000"><strong>Departemen</strong></font></td>
    <td>
    <input type="text" name="departemen" id="departemen" value="<?php echo $_REQUEST['departemen']?>" readonly="readonly" style="background-color:#CCCC99;" size="20">
    <input type="hidden" name="depart3" id="depart3" value="<?php echo $_REQUEST['departemen']?>" />
    <!--<select name="depart3" id="depart3" onChange="change_departemen(3)" style="width:130px" onkeypress="return focusNext('nama', event)">
    	<option value=-1>(Semua Dept.)</option>
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
        <font color="#000000"><strong>No Pendaftaran</strong></font></td>	
   	<td><input type="text" name="no" id="no" value="<?php echo $_REQUEST['no'] ?>" size="20" onKeyPress="return focusNext('submit', event)"/>     
  	</td>   
</tr>	

<tr>
    <td><font color="#000000"><strong>Nama Calon</strong></font></td>
    <td><input type="text" name="nama" id="nama" value="<?php echo $_REQUEST['nama'] ?>" size="20" onKeyPress="return focusNext('submit', event)"/></td>
</tr>
<tr>
	<td colspan="2" align="center">
    <input type="button" class="but" name="submit" id="submit" value="Cari" onclick="carilah1();return focusNext1('calon', event, 'cari',1,0)" style="width:80px"/>
    </td>
</tr>
<tr>
    <td align="center" colspan="3">
	<div id="caritabel">
    
<?php 
	
if (isset($_REQUEST['submit']) || $_REQUEST['submit'] == 1) { 
	OpenDb();    
	if ((strlen($nama) > 0) && (strlen($no) > 0))
		$sql = "SELECT c.nopendaftaran, c.nama, k.kelompok, p.departemen, c.replid FROM calonsiswa c, kelompokcalonsiswa k, prosespenerimaansiswa p WHERE c.nama LIKE '%$nama%' AND c.nopendaftaran LIKE '%$no%' AND k.replid=c.idkelompok AND c.aktif=1 AND c.idproses = p.replid $filter ORDER BY $urut3 $urutan3"; 	
	else if (strlen($nama) > 0)
		$sql = "SELECT c.nopendaftaran, c.nama, k.kelompok, p.departemen, c.replid FROM calonsiswa c, kelompokcalonsiswa k, prosespenerimaansiswa p WHERE c.nama LIKE '%$nama%' AND k.replid=c.idkelompok AND c.aktif=1 AND c.idproses = p.replid $filter ORDER BY $urut3 $urutan3"; 
	else if (strlen($no) > 0)
		$sql = "SELECT c.nopendaftaran, c.nama, k.kelompok, p.departemen, c.replid FROM calonsiswa c, kelompokcalonsiswa k, prosespenerimaansiswa p WHERE k.replid=c.idkelompok AND c.nopendaftaran LIKE '%$no%' AND c.aktif=1 AND c.idproses = p.replid $filter ORDER BY $urut3 $urutan3"; 	
	$result = QueryDb($sql);
	
	if (@mysql_num_rows($result)>0){
?>   
	<br>
   	<table width="100%" id="table1" class="tab" align="center" border="1" bordercolor="#000000">
    <tr height="30" class="header" align="center">
        <td width="7%">No</td>
        <td width="15%" onMouseOver="background='style/formbg2agreen.gif';height=30;" onMouseOut="background='style/formbg2.gif';height=30;" background="style/formbg2.gif" style="cursor:pointer;" onClick="change_urut('c.nopendaftaran','<?php echo $urutan3?>','caricalon')">No Reg. <?php echo change_urut('c.nopendaftaran',$urut3,$urutan3)?></td>
        <td width="*" onMouseOver="background='style/formbg2agreen.gif';height=30;" onMouseOut="background='style/formbg2.gif';height=30;" background="style/formbg2.gif" style="cursor:pointer;" onClick="change_urut('c.nama','<?php echo $urutan3?>','caricalon')">Nama <?php echo change_urut('c.nama',$urut3,$urutan3)?></td>       
        <td width="20%" onMouseOver="background='style/formbg2agreen.gif';height=30;" onMouseOut="background='style/formbg2.gif';height=30;" background="style/formbg2.gif" style="cursor:pointer;" onClick="change_urut('k.kelompok','<?php echo $urutan3?>','caricalon')">Kel. <?php echo change_urut('k.kelompok',$urut3,$urutan3)?></td>       
    </tr>
<?php
	$cnt = 0;
		while($row = mysql_fetch_row($result)) { ?>
   	<tr height="25" onClick="pilih('<?php echo $row[4]?>')" style="cursor:pointer" id="caloncari<?php echo $cnt?>">
        <td align="center" ><?php echo ++$cnt ?></td>
        <td align="center">
		<input type="text" name="caricalon<?php echo $cnt?>" id="caricalon<?php echo $cnt?>" readonly="readonly" size="10" style="border:none; background:none; text-align:center;" value="<?php echo $row[0]?>" onkeypress="pilih('<?php echo $row[4]?>');return focusNext1('calon', event, 'cari', <?php echo $cnt?>, 1)" />
		<?php // $row[0] ?></td>
        <td align="left"><?php echo $row[1] ?></td>       
        <td align="center"><?php if ($departemen == -1) echo  $row[3].'<br>'.$row[2]; else echo  $row[2] ?></td>
	</tr>
<?php } CloseDb(); ?>
 	</table>
<?php } else { ?>    		
	<table width="100%" align="center" cellpadding="2" cellspacing="0" border="0" id="table1">
	<tr height="200" align="center">
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
<tr height="200" align="center">
    <td>   

<br /><br />	
<font size="2" color="#757575"><b>Klik pada tombol "Cari" di atas untuk melihat data calon siswa <br />sesuai dengan No Pendaftaran atau Nama Calon Siswa berdasarkan <i>keyword</i> yang dimasukkan</b></font>	
<br /><br />
    </td>
</tr>
</table>


<?php }?>	
    </div>
	 </td>    
</tr>
</table>