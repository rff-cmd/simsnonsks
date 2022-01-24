<?php
require_once('../include/common.php');
require_once('../include/config.php');
require_once('../include/db_functions.php');
require_once('../include/sessioninfo.php');
require_once('departemen.php');

$flag = 0;
if (isset($_REQUEST['flag']))
	$flag = (int)$_REQUEST['flag'];

$departemen = $_REQUEST['departemen'];
$angkatan = $_REQUEST['angkatan'];
$tingkat = $_REQUEST['tingkat'];
$kelas = $_REQUEST['kelas'];
$urut = "s.nama";	
if (isset($_REQUEST['urut']))
	$urut = $_REQUEST['urut'];	
$urutan = "ASC";	
if (isset($_REQUEST['urutan']))
	$urutan = $_REQUEST['urutan'];

OpenDb();
?>
<table border="0" width="100%" align="center">
<tr>
    <td width="20%"><font color="#000000"><strong>Departemen</strong></font></td>
    <td>
    <input type="text" name="departemen" id="departemen" value="<?php echo $_REQUEST['departemen']?>" readonly="readonly" style="background-color:#CCCC99;width:150px">
    <input type="hidden" name="depart" id="depart" value="<?php echo $_REQUEST['departemen']?>" />
    <!--<select name="depart" id="depart" onChange="change_departemen(0)" style="width:155px" onkeypress="return focusNext('tingkat', event)">
   
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
    <td><font color="#000000"><strong>Angkatan </strong></font></td>
    <td><select name="angkatan" id="angkatan" onChange="change()" style="width:155px;" onkeypress="return focusNext('tingkat', event)">
   		 	<?php
			$sql = "SELECT replid,angkatan,aktif FROM angkatan where departemen='$departemen' AND aktif = 1 ORDER BY replid";
			$result = QueryDb($sql);
			while ($row = @mysql_fetch_array($result)) {
				if ($angkatan == "") 
					$angkatan = $row['replid'];
					 
			?>
            
    		<option value="<?php echo urlencode($row['replid'])?>" <?php echo IntIsSelected($row['replid'], $angkatan)?> ><?php echo $row['angkatan']?></option>
    		<?php
			}
    		?>
    	</select>        </td>
</tr>

<!--<tr>
    <td><font color="#000000"><strong>Th. Ajaran </strong></font></td>
    <td><select name="tahunajaran" id="tahunajaran" onChange="change()" style="width:155px;" onkeypress="return focusNext('tingkat', event)">
   		 	<?php
			$sql = "SELECT replid,tahunajaran,aktif FROM tahunajaran where departemen='$departemen' ORDER BY aktif DESC, replid DESC";
			$result = QueryDb($sql);
			while ($row = @mysql_fetch_array($result)) {
				if ($tahunajaran == "") 
					$tahunajaran = $row['replid'];
				if ($row['aktif']) 
					$ada = '(A)';
				else 
					$ada = '';			 
			?>
            
    		<option value="<?php echo urlencode($row['replid'])?>" <?php echo IntIsSelected($row['replid'], $tahunajaran)?> ><?php echo $row['tahunajaran'].' '.$ada?></option>
    		<?php
			}
    		?>
    	</select>        </td>
</tr>-->
<tr>
    <td><font color="#000000"><strong>Kelas</strong></font></td>
    <td><select name="tingkat" id="tingkat" onChange="change()" style="width:50px;" onkeypress="return focusNext('kelas', event)">
        <?php
			$sql="SELECT * FROM tingkat WHERE departemen='$departemen' AND aktif = 1 ORDER BY urutan";
            $result=QueryDb($sql);
            while ($row=@mysql_fetch_array($result)){
                if ($tingkat=="")
                    $tingkat=$row['replid'];
        ?> 
            <option value="<?php echo $row['replid']?>" <?php echo IntIsSelected($row['replid'], $tingkat)?>><?php echo $row['tingkat']?></option>
        <?php 	} ?> 
            </select>
            <!--</td>
</tr>
<tr>
    <td><font color="#000000"><strong>Kelas</strong></font></td>
    <td> -->
    
    <select name="kelas" id="kelas" onChange="change_kelas()" style="width:98px" onkeypress="return focusNext1('siswa', event, 'pilih', 1, 0)">
<?php	if ($tingkat <> "") {
		$sql="SELECT k.replid,k.kelas FROM kelas k,tahunajaran ta,tingkat ti WHERE k.idtahunajaran=ta.replid AND k.idtingkat=ti.replid AND ti.departemen='$departemen' AND ti.replid = '$tingkat' AND k.aktif=1 AND ta.aktif = 1 ORDER BY k.kelas";
    	$result=QueryDb($sql);
    	while ($row=@mysql_fetch_array($result)){
            if ($kelas == "")
                $kelas = $row[replid];		
                ?>
    	<option value="<?php echo $row[replid] ?>" <?php echo StringIsSelected($row[replid], $kelas) ?> >
    	<?php echo $row[kelas] ?>
    	</option>
    <?php	} 
	} else {	?>
    	<option></option>
<?php } ?> 
  	</select>
   	</td>    
</tr>
<tr>
	<td colspan="4" align="center">
    <p>
<?php 
if ($kelas <> "" && $tingkat <> "" && $angkatan <> "") { 
	$sql = "SELECT s.nis, s.nama, k.kelas FROM siswa s,kelas k WHERE s.aktif=1 AND k.replid=s.idkelas AND s.alumni=0 AND k.replid='$kelas' AND s.idangkatan = '$angkatan' ORDER BY $urut $urutan"; 
	$result = QueryDb($sql);
	
	if (mysql_num_rows($result) > 0) {
?>
	<table width="100%" id="table" class="tab" align="center" border="1" bordercolor="#000000">
	<tr height="30" align="center" class="header">
        <td width="7%" >No</td>
        <td width="15%" onMouseOver="background='style/formbg2agreen.gif';height=30;" onMouseOut="background='style/formbg2.gif';height=30;" background="style/formbg2.gif" style="cursor:pointer;" onClick="change_urut('s.nis','<?php echo $urutan?>','daftar')">N I S <?php echo change_urut('s.nis',$urut,$urutan)?></td>
        <td onMouseOver="background='style/formbg2agreen.gif';height=30;" onMouseOut="background='style/formbg2.gif';height=30;" background="style/formbg2.gif" style="cursor:pointer;" onClick="change_urut('s.nama','<?php echo $urutan?>','daftar')">Nama <?php echo change_urut('s.nama',$urut,$urutan)?></td>
	</tr>
<?php
	$cnt = 1;
	while($row = mysql_fetch_row($result)) { 
?>
	<tr height="25" onClick="pilih('<?php echo $row[0]?>')" style="cursor:pointer" id="siswapilih<?php echo $cnt?>">
		<td align="center" ><?php echo $cnt ?></td>
		<td align="center">
		<input type="text" name="pilihsiswa<?php echo $cnt?>" id="pilihsiswa<?php echo $cnt?>" readonly="readonly" size="10" style="border:none; background:none; text-align:center;" value="<?php echo $row[0]?>" onkeypress="pilih('<?php echo $row[0]?>');return focusNext1('siswa', event, 'pilih', <?php echo $cnt?>, 1)" />
		
		<?php //$row[0] ?></td>
		<td align="left"><?php echo $row[1] ?></td>		
	</tr>
	<?php
	$cnt++;
	}	?>
    </table>
<?php } else { ?>
	<table width="100%" align="center" cellpadding="2" cellspacing="0" border="0" id="table">
	<tr height="20" align="center">
		<td>   
   
	<font size = "2" color ="red"><b>Tidak ditemukan adanya data.<br />Belum ada siswa yang menempati kelas ini.</font>	
	<br /><br />
   		</td>
    </tr>
    </table>
<?php }
} else {?>
    <table width="100%" align="center" cellpadding="2" cellspacing="0" border="0" id="table">
	<tr height="20" align="center">
		<td>   
   
	<font size = "2" color ="red"><b>Tidak ditemukan adanya data</b></font>	
	<br /><br />
   		</td>
    </tr>
    </table>
<?php } ?>
</td>    
</tr>
</table>
<?php
CloseDb();
?>