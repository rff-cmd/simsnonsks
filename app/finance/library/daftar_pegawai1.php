<?php
require_once('../include/common.php');
require_once('../include/config.php');
require_once('../include/db_functions.php');
require_once('../include/sessioninfo.php');

OpenDb();
$flag = 0;
if (isset($_REQUEST['flag']))
	$flag = (int)$_REQUEST['flag'];
	
$bagian = $_REQUEST['bagian'];	
?>

<table border="0" width="100%" cellpadding="2" cellspacing="2" align="center">
<tr>
    <td>
    <input type="hidden" name="flag" id="flag" value="<?php echo $flag ?>" />
    <font size="2"><strong>Daftar Pegawai</strong></font><br />
    </td>
</tr>
<tr>
	<td><font color="#000000"><strong>Bagian </strong></font>
    <select name="bag" id="bag" onChange="change_bagian()">
    <option value="-1" <?php if ($departemen=="-1") echo  "selected"; ?>>(Semua Bagian)</option>
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
    <?php if ($bagian == -1)  {        
        $sql_tambahbag = "";					
    } else	{        
        $sql_tambahbag = "AND p.bagian = '$bagian' "; 					
    } 
	?>
   </td>
</tr>
<tr>
	<td>
    <br />
    <?php
    OpenDb();
    //$sql = "SELECT p.nip, p.nama FROM pegawai p LEFT JOIN (guru g LEFT JOIN pelajaran l ON l.replid = g.idpelajaran AND l.departemen='SMP') ON p.nip = g.nip GROUP BY p.nip";
    $sql = "SELECT p.nip, p.nama, p.bagian FROM pegawai p WHERE p.aktif = 1 $sql_tambahbag GROUP BY p.nip ORDER BY p.nama";
   
    $result = QueryDb($sql);
	if (@mysql_num_rows($result)>0){

	?>
    <!--<div id="tab_daftar">-->
    <table width="100%" id="table" class="tab" border="1" align="center" cellpadding="2" cellspacing="0">
    <tr height="30">
        <td class="header" width="7%" align="center">No</td>
        <td class="header" width="15%" align="center">N I P</td>
        <td class="header" >Nama</td>
        <?php if ($sql_tambahbag == "") { ?>
            <td class="header" align="center" >Bagian</td>          
            <?php } ?>
        <td class="header" width="10%" align="center">&nbsp;</td>
    </tr>
    <?php
    
    $cnt = 0;
    while($row = mysql_fetch_row($result)) { ?>
    <tr height="25" onClick="pilih('<?php echo $row[0]?>', '<?php echo $row[1]?>')" style="cursor:pointer">
        <td align="center"><?php echo ++$cnt ?></td>
        <td align="center"><?php echo $row[0] ?></td>
        <td><?php echo $row[1] ?></td>
        <?php if ($sql_tambahbag == "") { ?>				
		<td align="center" ><?php echo $row[2]?></td> 
        <?php } ?>		
        <td align="center">
        <input type="button" name="pilih" class="but" id="pilih" value="Pilih" onClick="pilih('<?php echo $row[0]?>', '<?php echo $row[1]?>')" />
        </td>
    </tr>
    <?php 	} ?>
    </table>
<?php } else { ?>    		
	<table width="100%" align="center" cellpadding="2" cellspacing="0" border="0" id="table">
	<tr height="30" align="center">
		<td>
	<br /><br />	
	<font size = "2" color ="red"><b>Tidak ditemukan adanya data. <br /><br />
			Tambah data pegawai pada bagian <?php echo $bagian?> di menu Kepegawaian pada bagian Referensi. </b></font>	
	<br /><br />
		</td>
	</tr>
	</table>
<?php } ?>	
    </td>    
</tr>
<tr>
	<td align="center" >
	<input type="button" class="but" name="tutup" id="tutup" value="Tutup" onclick="window.close()" style="width:80px;"/>
	</td>
</tr>
</table>