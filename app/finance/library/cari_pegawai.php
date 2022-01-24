<?php
require_once('../include/common.php');
require_once('../include/config.php');
require_once('../include/db_functions.php');

$flag = 0;
if (isset($_REQUEST['flag']))
	$flag = (int)$_REQUEST['flag'];
$nama = $_REQUEST['nama'];
$nip = $_REQUEST['nip'];
$bagian = $_REQUEST['bagian'];

$varbaris1=10;
if (isset($_REQUEST['varbaris1']))
	$varbaris1 = $_REQUEST['varbaris1'];
$page1=0;
if (isset($_REQUEST['page1']))
	$page1 = $_REQUEST['page1'];
$hal1=0;
if (isset($_REQUEST['hal1']))
	$hal1 = $_REQUEST['hal1'];
$urut1 = "nama";	
if (isset($_REQUEST['urut1']))
	$urut1 = $_REQUEST['urut1'];	
$urutan1 = "ASC";	
if (isset($_REQUEST['urutan1']))
	$urutan1 = $_REQUEST['urutan1'];

OpenDb();
?>
<table border="0" width="100%" cellspacing="2" align="center">
<tr>
	<td colspan="2">
	<input type="hidden" name="flag" id="flag" value="<?php echo $flag ?>" />
    <input type="hidden" name="urut1" id="urut1" value="<?php echo $urut1 ?>" />
    <input type="hidden" name="urutan1" id="urutan1" value="<?php echo $urutan1 ?>" />
	<font size="2" color="#000000"><strong>Cari Pegawai</strong></font>
 	</td>
</tr>
<tr>
	<td width="10%"><font color="#000000"><strong>Bagian  </strong></font></td>
    <td><select name="bag" id="bag" onChange="change_bagian()" style="width:135px" onKeyPress="return focusNext('nip', event)">
    	<option value="-1" <?php if ($bagian=="-1") echo  "selected"; ?>>(Semua Bagian)</option>
	<?php  $sql_bagian="SELECT bagian FROM bagianpegawai ORDER BY urutan ASC";
        $result_bagian=QueryDb($sql_bagian);
        while ($row_bagian=@mysql_fetch_array($result_bagian)){
    ?>
      	<option value="<?php echo $row_bagian['bagian']?>" <?php echo StringIsSelected($row_bagian['bagian'],$bagian)?>>
      	<?php echo $row_bagian['bagian']?>
        </option>
      <?php	}  ?>
    	</select>
    <!--<input type="text" name="bagian" id="bagian" value="<?php echo $departemen ?>" size="20" readonly style="background-color:#CCCCCC" /> </strong>&nbsp;&nbsp;-->
    
   </td>
   <td rowspan="2" width="15%" align="center">
   <input type="button" class="but" name="submit" id="submit" value="Cari" onclick="carilah();"  style="width:70px;height:40px"/>
   </td>
</tr>
<tr>
	<td width="10%"><font color="#000000"><b>N I P </b></font></td>
    <td><input type="text" name="nip" id="nip" value="<?php echo $_REQUEST['nip'] ?>" size="20" onKeyPress="return focusNext('submit', event);" />&nbsp;
		<font color="#000000"><b>Nama &nbsp;&nbsp;</b></font>
    	<input type="text" name="nama" id="nama" value="<?php echo $_REQUEST['nama'] ?>" size="20" onKeyPress="return focusNext('submit', event);" /></td>
</tr>

<tr>
	<td colspan="3">
	<hr />
    <div id = "caritabel">
<?php
if (isset($_REQUEST['submit']) || $_REQUEST['submit'] == 1) { 
	  	
	if ($bagian == -1)  {        
        $sql_tambahbag = "";					
    } else	{        
        $sql_tambahbag = "AND bagian = '$bagian' "; 					
    } 
	
	OpenDb();
	
	if ((strlen($nama) > 0) && (strlen($nip) > 0)) {
		$sql_tot = "SELECT nip, nama, bagian FROM pegawai WHERE aktif = 1 AND nama LIKE '%$nama%' AND nip LIKE '%$nip%' $sql_tambahbag ORDER BY nama"; 
		$sql_pegawai = "SELECT nip, nama, bagian FROM pegawai WHERE aktif = 1 AND nama LIKE '%$nama%' AND nip LIKE '%$nip%' $sql_tambahbag ORDER BY $urut1 $urutan1 LIMIT ".(int)$page1*(int)$varbaris1.",$varbaris1";
		//$sql = "SELECT nip, nama, bagian FROM pegawai WHERE nama LIKE '%$nama%' AND nip LIKE '%$nip%' $sql_tambahbag ORDER BY nama"; 
	} else if (strlen($nama) > 0) {
		$sql_tot = "SELECT nip, nama, bagian FROM pegawai WHERE aktif = 1 AND nama LIKE '%$nama%' $sql_tambahbag ORDER BY nama"; 
		$sql_pegawai = "SELECT nip, nama, bagian FROM pegawai WHERE aktif = 1 AND nama LIKE '%$nama%' $sql_tambahbag ORDER BY $urut1 $urutan1 LIMIT ".(int)$page1*(int)$varbaris1.",$varbaris1";
	} else if (strlen($nip) > 0) {
		$sql_tot = "SELECT nip, nama, bagian FROM pegawai WHERE aktif = 1 AND nip LIKE '%$nip%' $sql_tambahbag ORDER BY nama"; 		$sql_pegawai = "SELECT nip, nama, bagian FROM pegawai WHERE aktif = 1 AND nip LIKE '%$nip%' $sql_tambahbag ORDER BY $urut1 $urutan1 LIMIT ".(int)$page1*(int)$varbaris1.",$varbaris1";
	} 
	
	$result_tot = QueryDb($sql_tot);
	$total = ceil(mysql_num_rows($result_tot)/(int)$varbaris1);
	$jumlah = mysql_num_rows($result_tot);
	$akhir = ceil($jumlah/5)*5;
	$result = QueryDb($sql_pegawai);
	if (@mysql_num_rows($result)>0){ ?>

    <table width="100%" class="tab" cellpadding="2" cellspacing="0" id="table1" border="1" align="center">
    <tr height="30" class="header" align="center">
        <td width="7%">No</td>
        <td width="15%" onMouseOver="background='../style/formbg2agreen.gif';height=30;" onMouseOut="background='../style/formbg2.gif';height=30;" background="../style/formbg2.gif" style="cursor:pointer;" onClick="change_urut('nip','<?php echo $urutan1?>','cari')">N I P <?php echo change_urut('nip',$urut1,$urutan1)?></td>
        <td onMouseOver="background='../style/formbg2agreen.gif';height=30;" onMouseOut="background='../style/formbg2.gif';height=30;" background="../style/formbg2.gif" style="cursor:pointer;" onClick="change_urut('nama','<?php echo $urutan1?>','cari')">Nama <?php echo change_urut('nama',$urut1,$urutan1)?></td>
        <?php if ($sql_tambahbag == "") { ?>
        <td width="25%" onMouseOver="background='../style/formbg2agreen.gif';height=30;" onMouseOut="background='../style/formbg2.gif';height=30;" background="../style/formbg2.gif" style="cursor:pointer;" onClick="change_urut('bagian','<?php echo $urutan1?>','cari')">Bagian <?php echo change_urut('bagian',$urut1,$urutan1)?></td>
        <?php } ?>       
        <td width="10%">&nbsp;</td>
    </tr>
<?php	if ($page1==0)
		$cnt = 0;
	else 
		$cnt = (int)$page1*(int)$varbaris1;
		
	while($row = mysql_fetch_row($result)) { ?>
    <tr height="25"  onclick="pilih('<?php echo $row[0]?>', '<?php echo $row[1]?>')" style="cursor:pointer"> 
        <td align="center"><?php echo ++$cnt ?></td>
        <td align="center"><?php echo $row[0] ?></td>
        <td><?php echo $row[1] ?></td>
        <?php if ($sql_tambahbag == "") { ?>	
        <td align="center"><?php echo $row[2] ?></td>
        <?php } ?>
        <td align="center">
        <input type="button" name="pilih" class="but" id="pilih" value="Pilih" onclick="pilih('<?php echo $row[0]?>', '<?php echo $row[1]?>')" />
        </td>
    </tr>
<?php } CloseDb(); ?>
 	</table>
    <?php  if ($page1==0){ 
		$disback="style='visibility:hidden;'";
		$disnext="style='visibility:visible;'";
	}
	if ($page1<$total && $page1>0){
		$disback="style='visibility:visible;'";
		$disnext="style='visibility:visible;'";
	}
	if ($page1==$total-1 && $page1>0){
		$disback="style='visibility:visible;'";
		$disnext="style='visibility:hidden;'";
	}
	if ($page1==$total-1 && $page1==0){
		$disback="style='visibility:hidden;'";
		$disnext="style='visibility:hidden;'";
	}
	?>
   
    <table border="0"width="100%" align="center"cellpadding="2" cellspacing="2">
    <tr>
       	<td width="30%" align="left"><font color="#000000">Hal
        <select name="hal1" id="hal1" onChange="change_hal('cari')">
        <?php	for ($m=0; $m<$total; $m++) {?>
             <option value="<?php echo $m ?>" <?php echo IntIsSelected($hal1,$m) ?>><?php echo $m+1 ?></option>
        <?php } ?>
     	</select>
	  	dari <?php echo $total?> hal
		
		<?php 
     	// Navigasi halaman berikutnya dan sebelumnya
        ?>
        </font></td>
    	<!--td align="center">
    	<input <?php echo $disback?> type="button" class="but" name="back" value=" << " onClick="change_page('<?php echo (int)$page1-1?>','cari')" >
		<?php
		for($a=0;$a<$total;$a++){
			if ($page1==$a){
				echo  "<font face='verdana' color='red'><strong>".($a+1)."</strong></font> "; 
			} else { 
				echo  "<a href='#' onClick=\"change_page('".$a."','cari')\">".($a+1)."</a> "; 
			}
				 
	    }
		?>
	     <input <?php echo $disnext?> type="button" class="but" name="next" value=" >> " onClick="change_page('<?php echo (int)$page1+1?>','cari')" >
 		</td-->
        <td width="30%" align="right"><font color="#000000">Jml baris per hal
      	<select name="varbaris1" id="varbaris1" onChange="change_baris('cari')">
        <?php 	for ($m=5; $m <= $akhir; $m=$m+5) { ?>
        	<option value="<?php echo $m ?>" <?php echo IntIsSelected($varbaris1,$m) ?>><?php echo $m ?></option>
        <?php 	} ?>
       
      	</select></font></td>
    </tr>
    </table>
<?php } else { ?>    		
	<table width="100%" align="center" cellpadding="2" cellspacing="0" border="0" id="table1">
	<tr height="30" align="center">
		<td>   
   
	<br /><br />	
	<font size = "2" color ="red"><b>Tidak ditemukan adanya data. <br />          
		Tambah data pegawai di menu Kepegawaian pada bagian Referensi. </b></font>	
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
<font size="2" color="#757575"><b>Klik pada tombol "Cari" di atas untuk melihat data pegawai <br />sesuai dengan NIP atau Nama Pegawai berdasarkan <i>keyword</i> yang dimasukkan</b></font>	
<br /><br />
    </td>
</tr>
</table>


<?php }?>	
    </div>
    </td>    
</tr>
<tr>
	<td align="center" colspan="3" height="30">
	<input type="button" class="but" name="tutup" id="tutup" value="Tutup" onclick="window.close();opener.tutup();" style="width:80px;"/>
	</td>
</tr>
</table></table>

</body>
</html>