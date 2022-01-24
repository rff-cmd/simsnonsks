<?php
session_start();
if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include_once ("include/queryfunctions.php");
include_once ("include/functions.php");
?>


<script>
	
	function getpenerimaan() {
		var tnis = document.getElementById('tnis').value;
		var tbayar = ""; //document.getElementById('tbayar').value;
		
		//tbayar = tbayar.replace(/[^\d-.]/g,"");
		document.location.href = "penerimaanjtt_add.php?nis="+tnis+"&bayar="+tbayar;
	}
	
	function getpenerimaan_bayar() {
		var tnis = document.getElementById('tnis').value;
		var tbayar = document.getElementById('tbayar').value;
		var tcicilan = document.getElementById('tcicilan').value;
		var idjenis_bayar = document.getElementById('idjenis_bayar').value;
		
		//tbayar = tbayar.replace(/[^\d-.]/g,"");
		document.location.href = "penerimaanjtt_add.php?nis="+tnis+"&bayar="+tbayar+"&tcicilan="+tcicilan+"&idjenis_bayar="+idjenis_bayar;
	}
	
	function getpenerimaan_get(tnis) {
		//var tnis = document.getElementById('tnis').value;
		var tbayar = ""; //document.getElementById('tbayar').value;
		
		//tbayar = tbayar.replace(/[^\d-.]/g,"");
		document.location.href = "../penerimaanjtt_add.php?nis="+tnis+"&bayar="+tbayar;
	}
	
	function formbaru() {
		document.location.href = "../app/penerimaanjtt_add.php";
	}
	
	function getpenerimaan_update(tnis, tbayar, ref) {
		//document.location.href = "../app/penerimaanjtt_update_get.php?nis="+tnis+"&bayar="+tbayar+"&ref="+ref;
	}
	
	function formatangka(field) {
		
		 //a = rci.amt.value;	 
		 a = document.getElementById(field).value;
		 //alert(a);
		 b = a.replace(/[^\d-.]/g,""); //b = a.replace(/[^\d]/g,"");
		 c = "";
		 panjang = b.length;
		 j = 0;
		 for (i = panjang; i > 0; i--)
		 {
			 j = j + 1;
			 if (((j % 3) == 1) && (j != 1))
			 {
			 	c = b.substr(i-1,1) + "," + c;
			 } else {
			 	c = b.substr(i-1,1) + c;
			 }
		 }
		 //rci.amt.value = c;
		 c = c.replace(",.",".");
		 c = c.replace(".,",".");
		 document.getElementById(field).value = c;	
		 
	}
	
	function cetakkuitansi_multi(ref) 
	{
		newWindow('../app/kuitansijtt_multi.php?ref='+ref, 'CetakKuitansi','750','850','resizable=1,scrollbars=1,status=0,toolbar=0'		)
		
	}
	
	//-----------checked nilai detail
	function cek_one(id, jmldata){
		//alert(jmldata);
		//var bayar2=document.getElementById('bayar_'+id).value; 			
		//bayar2 = number_format(bayar,0,".",",");	
		
		//$('#bayar'+id).html('<input type="text" id="bayar_'+id+'" name="bayar_'+id+'" style="text-align: right" onkeyup="formatangka(\'bayar_'+id+'\'), totals('+jmldata+')" value="'+bayar2+'" >');	
		
		totals(jmldata);
		
		return false;
	 }
	 
	 function totals(jmldata){
	 	
	 	var i=0;
		var jumlah='0';
		var sub_total='0';
		
		for(i=0; i<jmldata; i++){
			
			if ( document.getElementById('bayar_'+i).value != isNaN || document.getElementById('bayar_'+i).value != 0) {	
					
				var bayar = 0;
				bayar = document.getElementById('bayar_'+i).value;
				bayar = bayar.replace(/[^\d-.]/g,"");
				jumlah = jumlah.replace(/[^\d-.]/g,"");
				
				if(bayar=='') { bayar = '0' }
				jumlah 	=  parseFloat(jumlah) + parseFloat(bayar);				
				jumlah = number_format(jumlah);
                													
			}
				
			//$('#total2').html('<input type="text" id="total" name="total" class="form-control" onchange="number_format('+'total'+')" style="text-align: right; height:40px; font-weight: bold; font-size: 16px; width:140px" readonly value="'+ jumlah +'" ">');
			
			
            $('#total2').html('' + jumlah + '');
			
			/*var tbayar=document.getElementById('tbayar').value;
            $('#bayar2').html('' + tbayar + '');*/
			
			/*tbayar = tbayar.replace(/[^\d-.]/g,"");
			if(tbayar=='') { tbayar = '0' }
			
			jumlah = jumlah.replace(/[^\d-.]/g,"");
			if(jumlah=='') { jumlah = '0' }
			kembali 	=  parseFloat(tbayar) - parseFloat(jumlah);	
			
			kembali = number_format(kembali);
            
			$('#kembali').html('' + kembali + '');
			
			$('#kembali2').html('<input type="hidden" id="kembalix" name="kembalix" value="'+ kembali +'" ">');*/
			
            	
		}
									
		return false;
	 }
	 
	 
	function cari_siswa(nama) {
		nama = "";
		newWindow('finance/carisiswa_terima.php', 'Cari Siswa','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
	
	function accept_siswa(nis, nama) {
		document.getElementById('tnis').value = nis;
		document.getElementById('tnama').value = nama;
		
		getpenerimaan_get(nis);
	}
</script>

<?php
//require_once('finance/include/errorhandler.php');
//require_once('finance/include/sessionchecker.php');
require_once('finance/include/common.php');
require_once('finance/include/rupiah.php');
//require_once('finance/include/config.php');
//require_once('finance/include/db_functions.php');
require_once('finance/include/theme.php');
//require_once('finance/include/sessioninfo.php');
require_once('finance/library/jurnal.php');
//require_once('finance/library/repairdatajtt.php');

//require_once('finance/include/functions.php');

$nis = $_REQUEST['nis'];
$idkategori = $_REQUEST['idkategori'];
$idpenerimaan = $_REQUEST['idpenerimaan'];
//$idtahunbuku = $_SESSION["tahunbuku"]; //$_REQUEST['idtahunbuku'];
$bayar = numberreplace($_REQUEST['bayar']);
$tbayar = $_REQUEST['bayar'];
$tcicilan = $_REQUEST['tcicilan'];
$idjenis_bayar = $_REQUEST['idjenis_bayar'];

$dbpdo = DB::create();

$sqlstr = "SELECT a.nama, a.alamatsiswa, b.tingkat, c.kelas, b.departemen FROM siswa a left join kelas c on a.idkelas=c.replid left join tingkat b on c.idtingkat = b.replid WHERE a.nis = '$nis'";
$sql=$dbpdo->prepare($sqlstr);
$sql->execute();
//$result = mysql_query($sql);
//$data = mysql_fetch_object($result);
$data=$sql->fetch(PDO::FETCH_OBJ);
$nama = $data->nama;
$talamat = $data->alamatsiswa;
$kelas = $data->tingkat . "-" . $data->kelas;
$departemen = $data->departemen;

$sqltb = "select replid from tahunbuku where departemen='$departemen' order by tanggalmulai desc limit 1";
$query = $dbpdo->prepare($sqltb);
$query->execute();
$datatb = $query->fetch(PDO::FETCH_OBJ);
$idtahunbuku = $datatb->replid;

$sqlstr = "SELECT nama FROM datapenerimaan WHERE replid = '$idpenerimaan'";
$sql=$dbpdo->prepare($sqlstr);
$sql->execute();
//$result2 = mysql_query($sql);
//$data2 = mysql_fetch_object($result2);
$data2=$sql->fetch(PDO::FETCH_OBJ);
$namapenerimaan = $data2->nama;

$tanggal = date('d-m-Y');
if (isset($_REQUEST['tcicilan']))
	$tanggal = $_REQUEST['tcicilan'];
	
if (isset($_REQUEST['jcicilan']))
	$jbayar = UnformatRupiah($_REQUEST['jcicilan']);


$ref	=	"";


//===========save start
if (1 == (int)$_REQUEST['issubmit'] || 2 == (int)$_REQUEST['issubmit']) 
{
	
	$jmldata = $_REQUEST['jmldata'];
	
	/*--cek jumlah bayar (SPP: jika bayar kurang dari jumlah SPP, maka tidak bisa save ) */
	$errmsg = "";
	for($j=0; $j<=$jmldata; $j++) {
		
		if($errmsg == "") {
			$terima_cek = str_replace(",","",(empty($_REQUEST[terima_.$j])) ? 0 : $_REQUEST[terima_.$j]);
			$bayar_cek = str_replace(",","",(empty($_REQUEST[bayar_.$j])) ? 0 : $_REQUEST[bayar_.$j]);
			$idpenerimaan_cek = $_REQUEST[idpenerimaan2_.$j];
			$namaterima_cek = $_REQUEST[namaterima_.$j];
			$full_cek = $_REQUEST[full_.$j];
			
			if($bayar_cek > 0) {
				if($full_cek == 1) {
					if($terima_cek > $bayar_cek) {
						$errmsg = "Maaf $namaterima_cek tidak boleh dicicil";
					}
				}
			}	
		}
		
	}	
	
	/*------------------------------------------------------------------------------------*/
	
	if($errmsg == "") {
		
		
		if((int)$_REQUEST['issubmit'] == 1) {
			$ref = notran(date('y-m-d'), 'frmrcp', '', '', '');		
					
		} else {
			$ref = $_POST['ref'];
		}
		
		
		
		$kembali = $_POST['kembalix'];
		
		$total_bayar = 0;
		for($v=0; $v<=$jmldata; $v++) {
			
			$bayar2 = str_replace(",","",(empty($_REQUEST[bayar_.$v])) ? 0 : $_REQUEST[bayar_.$v]);
			$id_pjtt = $_REQUEST[id_pjtt_.$v];
			
			if($bayar2 > 0) {
				$idpenerimaan = $_REQUEST[idpenerimaan2_.$v];
				
				
				$petugas = $_SESSION["loginname"]; //getUserName();
				$idbesarjtt = (int)$_REQUEST['idbesarjtt'];
				$tcicilan = $_REQUEST['tcicilan'];
				$tcicilan = date("Y-m-d", strtotime($tcicilan)); //$tcicilan);
				$jcicilan = $bayar2; //$_REQUEST['jcicilan'];
				$jcicilan = UnformatRupiah($jcicilan);
				$kcicilan = petikreplace($_REQUEST['kcicilan']); // CQ($_REQUEST['kcicilan']);
				$idjenis_bayar = $_POST['idjenis_bayar'];
				$total_bayar = $total_bayar + $bayar2;
				
				//// Ambil nama penerimaan
				$sqlstr = "SELECT nama, rekkas, rekpendapatan, rekpiutang FROM datapenerimaan WHERE replid = '$idpenerimaan'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			
				$row = $sql->fetch(PDO::FETCH_OBJ); //FetchSingleRow($sql);			
				$namapenerimaan = $row->nama; //[0];
				$rekkas = $row->rekkas; //[1];
				$rekpendapatan = $row->rekpendapatan; //[2];
				$rekpiutang = $row->rekpiutang; //[3];	
				
				//// Ambil nama siswa
				$sqlstr = "SELECT nama FROM siswa WHERE nis = '$nis'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$namasiswa2 = $sql->fetch(PDO::FETCH_OBJ); //FetchSingle($sql);	
				$namasiswa = $namasiswa2->nama;
				
				$idbesarjtt = 0;
				$besarjtt = 0;
				
				$sqlstr = "SELECT b.replid AS id, b.besar
			  		   	 FROM besarjtt b
			   	   	WHERE b.nis = '$nis' AND b.idpenerimaan = '$idpenerimaan' AND b.info2 = '$idtahunbuku'";
			   	$sql2=$dbpdo->prepare($sqlstr);
				$sql2->execute();
				
				//$res = QueryDb($sql);
				$row = $sql2->fetch(PDO::FETCH_OBJ); //mysql_fetch_row($res);
				$idbesarjtt = $row->id; //[0];
				$besarjtt = $row->besar; //[1];
				
				//// Cari tahu jumlah pembayaran cicilan yang sudah terjadi
				$cicilan = 1;
				$jml = 0;
				$sqlstr = "SELECT jumlah FROM penerimaanjtt WHERE idbesarjtt = '$idbesarjtt'";
				$sql3=$dbpdo->prepare($sqlstr);
				$sql3->execute();
				//$result = QueryDb($sql);
				//while ($row = mysql_fetch_row($result)) 
				while($row = $sql3->fetch(PDO::FETCH_OBJ)) 
				{
					$jml += $row->jumlah; //[0];  // jumlah pembayaran sebelumnya
					$cicilan++;
				}
				
				//// Cek jumlah cicilan dengan besar pembayaran yang mesti dilunasi
				$ketjurnal = "";
				if ($jml + $jcicilan > $besarjtt) 
				{		
					$errmsg = "Maaf, pembayaran tidak dapat dilakukan! Jumlah bayaran cicilan lebih besar daripada pembayaran yang harus dilunasi!";		
				} 
				else if ($jml + $jcicilan == $besarjtt) 
				{		
					$ketjurnal = "Pelunasan $namapenerimaan siswa $namasiswa ($nis)";
					$lunas = 1; //udah lunas
				} 
				else 
				{
					$ketjurnal = "Pembayaran cicilan ke-$cicilan $namapenerimaan siswa $namasiswa ($nis)";
					$lunas = 0; //blum lunas
				}
				
				
				//-----start syarat
				if ($jml + $jcicilan <= $besarjtt) {
						
						//// Ambil awalan dan cacah tahunbuku untuk bikin nokas;
						$sqlstr = "SELECT awalan, cacah FROM tahunbuku WHERE replid = '$idtahunbuku'";
						$sql4=$dbpdo->prepare($sqlstr);
						$sql4->execute();
						$row = $sql4->fetch(PDO::FETCH_OBJ);
						
						//$row = FetchSingleRow($sql);
						$awalan = $row->awalan; //[0];
						$cacah = $row->cacah; //[1];
						
						$cacah += 1; //increment cacah
						$nokas = $awalan . rpad($cacah, "0", 6); //form nokas
						
						//// Begin Database Transaction
						//BeginTrans();
						$success = true;

						//// Simpan ke jurnal
						$idjurnal = 0;
						$success = SimpanJurnal($idtahunbuku, $tcicilan, $ketjurnal, $nokas, "", $petugas, "penerimaanjtt", $idjurnal);
						
						//// Simpan ke jurnaldetail
						if ($success) {
							$success = SimpanDetailJurnal($idjurnal, "D", $rekkas, $jcicilan);
						}
							
						if ($success) {
							$success = SimpanDetailJurnal($idjurnal, "K", $rekpiutang, $jcicilan);
						}
							
						
						//// increment cacah di tahunbuku
						$sqlstr = "UPDATE tahunbuku SET cacah=cacah+1 WHERE replid='$idtahunbuku'";
						if ($success) {
							$success=$dbpdo->prepare($sqlstr);
							$success->execute();
							//QueryDbTrans($sql, $success);
						}
							
							
						//simpan data cicilan di penerimaanjtt
						$sqlcek = "select ref from penerimaanjtt where replid='$id_pjtt' ";
						$resultcek=$dbpdo->prepare($sqlcek);
						$resultcek->execute();
						$rowscek = $resultcek->rowCount();
						//$resultcek = mysql_query($sqlcek);
						//$rowscek = mysql_num_rows($resultcek);
						
						$dlu = date("Y-m-d H:i:s");
						
						if($rowscek == 0) {
							$sql = "INSERT INTO penerimaanjtt SET idbesarjtt='$idbesarjtt', idjurnal='$idjurnal', tanggal='$tcicilan', jumlah='$jcicilan', keterangan='$kcicilan', petugas='$petugas', idjenis_bayar='$idjenis_bayar', ref='$ref' ";
						} else {
							$sql = "update penerimaanjtt set idbesarjtt='$idbesarjtt', idjurnal='$idjurnal', tanggal='$tcicilan', jumlah='$jcicilan', keterangan='$kcicilan', petugas='$petugas', idjenis_bayar='$idjenis_bayar', where ref='$ref' and replid='$id_pjtt' ";
							echo $sql;
						}
						
						
						//echo $sql; exit;
						if ($success)  {
							$success=$dbpdo->prepare($sql);
							$success->execute();
							//QueryDbTrans($sql, $success);
						}
							
						
						//// jika lunas ubah statusnya di besarjtt
						if ($lunas) 
						{
							if ($success) 
							{
								//$sql = "SET @DISABLE_TRIGGERS = 1;";
								//QueryDb($sql);
								
								$sqlstr = "UPDATE besarjtt SET lunas=1 WHERE replid='$idbesarjtt'";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
								//QueryDbTrans($sql, $success);
								
								//$sql = "SET @DISABLE_TRIGGERS = NULL;";
								//QueryDb($sql);
							}
						}
						
						/*if (strlen($errmsg) == 0) 
						{
							if ($success) 
							{			
								CommitTrans();
								CloseDb();
								echo  "<script language='javascript'>";			
								echo  "opener.refresh();";
								echo  "window.close();";
								echo  "</script>";
								exit();
							} 
							else 
							{
								RollbackTrans();
								CloseDb();			
								echo  "<script language='javascript'>";
								echo  "alert('Gagal menyimpan data!);";
								echo  "</script>";
							}
						} */
				} //-------end memenuhi syarat
				
				
				//input bank list (jika bukan tunai)			
				if($idjenis_bayar != 1) {
					$qbayar = "select nama from jenis_bayar where replid='$idjenis_bayar'";
					$execbayar=$dbpdo->prepare($qbayar);
					$execbayar->execute();
					$databayar = $execbayar->fetch(PDO::FETCH_OBJ);
					$namabayar = $databayar->nama;
					
					$cekarc = "select ref from arc where ref='$ref'";
					$execarc=$dbpdo->prepare($cekarc);
					$execarc->execute();
					$jmlarc = $execarc->rowCount();
					
					if($jmlarc == 0) {
						$sqlins = "insert into arc (ref, date, client_code, cheque_no, bank_name, cheque_date, amount, currency_code, rate, account_code, type, memo, uid, dlu) values ('$ref', '$tcicilan', '$nis', '', '$namabayar', '$tcicilan', '$jcicilan', '', '0', '', 'transfer', '$kcicilan', '$petugas', '$dlu')";
						$execins=$dbpdo->prepare($sqlins);
						$execins->execute();
					} else {
						$sqlupd = "update arc set date='$tcicilan', bank_name='$namabayar', amount='$jcicilan', memo='$kcicilan', uid='$petugas', dlu='$dlu' where ref='$ref' and client_code='$nis'";
						$execupd=$dbpdo->prepare($sqlupd);
						$execupd->execute();
					}
				}
				//-----------end input bank list (jika bukan tunai)
				
			}
			
		}
		
		
		$date = date("Y-m-d", strtotime($tcicilan));
		
		notran($date, 'frmrcp', 1, '', '') ; //----eksekusi ref			
?>		
		
		<script language="javascript">
			getpenerimaan_update('<?php echo $nis ?>','<?php echo $tbayar ?>','<?php echo $ref ?>');
		</script>
		
<?php		
	} else {
?>		
		<script language="javascript">
			alert('<?php echo $errmsg ?>');			
		</script>
<?php		
	}
	
	
}
//CloseDb();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link rel="stylesheet" type="text/css" href="finance/style/style.css">
<link rel="stylesheet" type="text/css" href="finance/style/calendar-green.css">
<link rel="stylesheet" type="text/css" href="finance/style/tooltips.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIAS - KEU [Tambah Pembayaran Cicilan]</title>
<script src="finance/script/SpryValidationTextField.js" type="text/javascript"></script>
<link href="finance/script/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="finance/script/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="finance/script/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="finance/script/tooltips.js" language="javascript"></script>
<script language="javascript" src="finance/script/tables.js"></script>
<script language="javascript" src="finance/script/tools.js"></script>
<script language="javascript" src="finance/script/rupiah.js"></script>
<script language="javascript" src="finance/script/validasi.js"></script>
<script type="text/javascript" src="finance/script/calendar.js"></script>
<script type="text/javascript" src="finance/script/lang/calendar-en.js"></script>
<script type="text/javascript" src="finance/script/calendar-setup.js"></script>

<script type="text/javascript" src="finance/jsdynamic/jquery.min.js"></script>
<!--<script type="text/javascript" src="../../js/buttonajax.js"></script>-->
<script language="javascript">
function ValidateSubmit() 
{
	kembali = 0;
	kembali = document.getElementById('kembalix').value
	kembali = kembali.replace(/[^\d-.]/g,"");
	
	if(kembali < 0 ) {
		alert("Kembalian tidak boleh minus ")
		return false;
		
	}
	/*var isok = 	validateEmptyText('jcicilan', 'Besarnya Cicilan') &&
			 	validasiAngka() &&
			    validateEmptyText('tcicilan', 'Tanggal Cicilan') &&
			    validateMaxText('kcicilan', 255, 'Keterangan Cicilan') && 
				confirm('Data sudah benar?');
				
	document.getElementById('issubmit').value = isok ? 1 : 0;
	
	if (isok)
		document.main.submit();
	else
		document.getElementById('Simpan').disabled = false; */
	
	if(kembali >= 0) {
		document.getElementById('issubmit').value = 1;
		document.main.submit();	
	}
	
	
	
}

function ValidateSubmit1() 
{
	
	document.getElementById('issubmit').value = 2;
	document.main.submit();
}

function val2()
{
	if (confirm('Data sudah benar?'))
		return true;
	else 
		return false;
}

function validasiAngka() 
{
	angka = document.getElementById('angkacicilan').value;
	if(isNaN(angka)) 
	{
		alert ('Besarnya cicilan harus berupa bilangan!');
		document.getElementById('jcicilan').focus();
		return false;
	}
	else if(angka <= 0)
	{
		alert ('Besarnya cicilan harus positif!');
		document.getElementById('jcicilan').focus();
		return false;
	}
	return true;
}

function salinangka()
{	
	var angka = document.getElementById("jcicilan").value;
	document.getElementById("angkacicilan").value = angka;
}

function focusNext(elemName, evt) 
{
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode :
        ((evt.which) ? evt.which : evt.keyCode);
    if (charCode == 13) 
	 {
		document.getElementById(elemName).focus();
      return false;
    }
    return true;
}

</script>

<!-----------------script multi penerimaan--------------->
<script>
	function number_format(number, decimals, dec_point, thousands_sep) {
		number = (number + '')
		.replace(/[^0-9+\-Ee.]/g, '');
	  
	  var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function(n, prec) {
		  var k = Math.pow(10, prec);
		  return '' + (Math.round(n * k) / k)
			.toFixed(prec);
		};
	  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
	  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
		.split('.');
	  if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	  }
	  if ((s[1] || '')
		.length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1)
		  .join('0');
	  }
	  return s.join(dec);
	}
	
	/*function formatangka(field) {
		 //a = rci.amt.value;	 
		 a = document.getElementById(field).value;
		 //alert(a);
		 b = a.replace(/[^\d-.]/g,""); //b = a.replace(/[^\d]/g,"");
		 c = "";
		 panjang = b.length;
		 j = 0;
		 for (i = panjang; i > 0; i--)
		 {
			 j = j + 1;
			 if (((j % 3) == 1) && (j != 1))
			 {
			 	c = b.substr(i-1,1) + "," + c;
			 } else {
			 	c = b.substr(i-1,1) + c;
			 }
		 }
		 //rci.amt.value = c;
		 c = c.replace(",.",".");
		 c = c.replace(".,",".");
		 document.getElementById(field).value = c;	
		 
	}*/
	
	 
</script>

</head>

<!--
<?php if($nis == "") { ?>
	<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" style='background-color:#dfdec9' background="" onLoad="document.getElementById('tnis').focus();">
<?php } else { ?>

	<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" style='background-color:#dfdec9' background="" onLoad="document.getElementById('tcicilan').focus();">

<?php } ?>-->

<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" style='background-color:#dfdec9' background="" >

<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr height="58">
	<td width="28" background="<?php echo GetThemeDir() ?>bgpop_01.jpg">&nbsp;</td>
    <td width="*" background="<?php echo GetThemeDir() ?>bgpop_02a.jpg">
	<div align="center" style="color:#FFFFFF; font-size:16px; font-weight:bold">
    .: Pembayaran Cicilan :.
    </div>
	</td>
    <td width="28" background="<?php echo GetThemeDir() ?>bgpop_03.jpg">&nbsp;</td>
</tr>
<tr height="150">
	<td width="28" background="<?php echo GetThemeDir() ?>bgpop_04a.jpg">&nbsp;</td>
    <td width="0" style="background-color:#FFFFFF">
    
    <form name="main" method="post" action="" >
    <input type="hidden" name="issubmit" id="issubmit" value="0" />
    <input type="hidden" name="idkategori" id="idkategori" value="<?php echo $idkategori ?>" />
	<input type="hidden" name="idpenerimaan" id="idpenerimaan" value="<?php echo $idpenerimaan ?>" />
	<input type="hidden" name="nis" id="nis" value="<?php echo $nis ?>" />
	<input type="hidden" name="idtahunbuku" id="idtahunbuku" value="<?php echo $idtahunbuku ?>" />
    
    
    <!---------multi penerimaan----------->
	<table border="0" align="center" cellspacing="0" cellpadding="5">
		
		<input type="hidden" name="ref" id="ref" size="25" value="<?php echo $ref ?>" >
		
		<tr>
			<td><strong>NIS</strong></td>
	        <td>
	        
	        <?php //if($nis != "") { ?>
	        	<!--<input type="text" name="tnis" id="tnis" size="25" value="<?php echo $nis ?>" onKeyPress="return focusNext('tbayar',event)"  style="font-weight: bold; height: 30px; font-size: 14px" >-->
	        	
	        	<!--
	        	<input type="text" name="tnis" id="tnis" size="25" value="<?php echo $nis ?>" onKeyPress="return focusNext('tbayar',event)" onblur="getpenerimaan()" style="font-weight: bold; height: 30px; font-size: 14px" >-->
	        	
	        	<?php if($ref == "") { ?>
	        		<input type="text" name="tnis" id="tnis" size="25" value="<?php echo $nis ?>" onKeyPress="return focusNext('tcicilan',event)" onblur="getpenerimaan()" style="font-weight: bold; height: 30px; font-size: 14px" >
	        	<?php } else { ?>
	        		<input type="text" name="tnis" id="tnis" size="25" value="<?php echo $nis ?>" onKeyPress="return focusNext('tcicilan',event)" style="font-weight: bold; height: 30px; font-size: 14px" >
	        	<?php } ?>
	        	
	        <?php /*} else { ?>
	        	<input type="text" name="tnis" id="tnis" size="25" value="<?php echo $nis ?>" onKeyPress="return focusNext('tbayar',event)" style="font-weight: bold; height: 30px; font-size: 14px" >
	        <?php } */?>
	        
	        &nbsp;
	        <a href="#" onClick="JavaScript:cari_siswa('<?php echo $nama ?>')"><img src="finance/images/ico/lihat.png" /></a>
	        
	        <?php if($ref != "") { ?>	
	        	&nbsp;&nbsp;
	        	<strong>No. Invoice : </strong><?php echo $ref ?>
	        <?php } ?>	
	        </td>
	        	
		</tr>
		
		<tr>
			<td><strong>Nama</strong></td>
	        <td>
	        <input type="text" name="tnama" id="tnama" size="50" readonly="" value="<?php echo $nama ?>" style="background-color: #99ff00; font-weight: bold;" ></td>
	        <td>
	        	<strong>Kelas : <?php echo $kelas ?></strong>
	        </td>
	        	
		</tr>
		<!--<tr>
			<td><strong>Alamat</strong></td>
	        <td>
	        <input type="text" name="talamat" id="talamat" size="50" readonly value="<?php echo $talamat ?>" style="background-color: #99ff00; font-weight: bold;" ></td>
	        	
		</tr>-->
		<tr>
	        <td><strong>Tanggal</strong></td>
	        <td colspan="2">
	        <input type="text" name="tcicilan" id="tcicilan" readonly size="15" value="<?php echo $tanggal ?>"  onClick="Calendar.setup()" style="background-color:#CCCC99">
	        <img src="finance/images/calendar.jpg" name="tabel" border="0" id="btntanggal" onMouseOver="showhint('Buka kalendar!', this, event, '100px')" />
		    </td>        
	    </tr>
	    
	    <tr>
	    	<td><strong>Jenis Pembayaran</strong></td>
	    	<td colspan="2">
		    	<select name="idjenis_bayar" id="idjenis_bayar" style="width:auto; height:27px; " >
					<?php select_jenis_bayar($idjenis_bayar) ?>
				</select>
			</td>
	    </tr>
	    
	    <?php /*
	    <tr>
			<td><strong>Jumlah Bayar</strong></td>
	        <td id="tbayar2">
	        
		        <?php if($ref == "") { ?>
			        
			        <?php if($_REQUEST['bayar'] == "" || $_REQUEST['bayar'] == 0) { ?>
				        <input type="text" name="tbayar" id="tbayar" size="25" value="<?php echo $tbayar ?>" onblur="getpenerimaan_bayar()" onKeyPress="return focusNext('kcicilan',event)" onkeyup="formatangka('tbayar')" style="font-weight: bold; text-align: right; height: 30px; font-size: 14px" >
				    <?php } else { ?>
				    	<input type="text" name="tbayar" id="tbayar" size="25" value="<?php echo $tbayar ?>" onKeyPress="return focusNext('kcicilan',event)" onkeyup="formatangka('tbayar')" style="font-weight: bold; text-align: right; height: 30px; font-size: 14px" >
				    <?php } ?>
			        
		        <?php } else { ?>
		        	
		        	<input type="text" name="tbayar" id="tbayar" size="25" value="<?php echo $tbayar ?>" style="font-weight: bold; text-align: right; height: 30px; font-size: 14px" >
		        
		        <?php } ?>
	        
	        </td>
	        	
		</tr> */ ?>
		
		<tr>
			<td style="border: 1px solid #000"><b>Jenis Penerimaan</b></td>
			<td style="border: 1px solid #000"><b>Jumlah Cicilan</b></td>
			<td width="100" style="border: 1px solid #000"><b>Bayar</b></td>
			<!--<td style="border: 1px solid #000"><b>Pilih</b></td>-->
		</tr>
		
		<?php
			//OpenDb();
			
			/*$sqlsiswa = "select distinct c.departemen from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid where a.nis='$nis'";
			$result = mysql_query($sqlsiswa);
			$datasiswa = mysql_fetch_object($result);
			$departemen = $datasiswa->departemen;
			
			$sqlterima = "select nama from datapenerimaan where departemen='$departemen'";
			$resultterima = mysql_query($sqlterima);
			$dataterima = mysql_fetch_object($resultterima);
			$namaterima = $dataterima->nama;
			
			
			$sql = "SELECT b.nis, b.besar, SUM(p.jumlah) AS jumlah, b.cicilan, c.nama, d.kelas, e.tingkat
			          FROM besarjtt b left join penerimaanjtt p on b.replid = p.idbesarjtt 
			          left join siswa c on b.nis=c.nis
			          left join kelas d on c.idkelas=d.replid
			          left join tingkat e on d.idtingkat=e.replid
			          left join datapenerimaan f on e.departemen=f.departemen
					 WHERE b.idpenerimaan = '$idpenerimaan' and b.nis='$nis' AND b.info2 = '$idtahunbuku'
					 and f.idkategori='JTT'
				  GROUP BY b.nis"; */
			
			if($ref != "") {
				
				/*$sqlunion = " union all select '$nis' nis, b.besar, 0 jumlah, b.cicilan, '' nama, '' kelas, '' tingkat, c.nama namaterima, b.idpenerimaan, a.replid id_pjtt, 1 nomor from penerimaanjtt a left join besarjtt b on a.idbesarjtt=b.replid left join datapenerimaan c on b.idpenerimaan=c.replid where b.nis='$nis' and a.ref='$ref' ";
				
				$sql = $sql . $sqlunion;
				
				$sql = " select aa.* from ( " . $sql . ") aa order by aa.nomor desc, aa.besar desc"; */
				
				$sqlstr = " select '$nis' nis, b.besar, 0 jumlah, b.cicilan, '' nama, '' kelas, '' tingkat, c.nama namaterima, b.idpenerimaan, a.replid id_pjtt, 1 nomor, ifnull(c.full,0) full from penerimaanjtt a left join besarjtt b on a.idbesarjtt=b.replid left join datapenerimaan c on b.idpenerimaan=c.replid where b.nis='$nis' and a.ref='$ref' order by c.nourut ";
                
			} else {
				$sqlstr = "select b.nis, b.besar, SUM(p.jumlah) AS jumlah, b.cicilan, c.nama, d.kelas, e.tingkat, f.nama namaterima, b.idpenerimaan, 0 id_pjtt, 0 nomor, ifnull(f.full,0) full from datapenerimaan f left join besarjtt b on f.replid=b.idpenerimaan left join penerimaanjtt p on b.replid = p.idbesarjtt left join siswa c on b.nis=c.nis left join kelas d on c.idkelas=d.replid left join tingkat e on d.idtingkat=e.replid where b.nis='$nis' AND b.info2 = '$idtahunbuku' GROUP BY b.nis, f.nama, b.idpenerimaan having (ifnull(b.besar,0) - SUM(ifnull(p.jumlah,0)) ) > 0 order by f.nourut "; 
				//and f.idkategori='JTT' 				
			}
						
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$jmldata = $sql->rowCount();					  
			//$res2 = QueryDb($sql);
			//$jmldata = mysql_num_rows($res2);
			
			$z = 0;
			$cicilan = numberreplace($bayar);
			$total = 0;
			//while($row2 = mysql_fetch_row($res2)) {
			while ($row2=$sql->fetch(PDO::FETCH_OBJ)) {
				
			$nama = $row2->nama; //$row2[4];
			$tingkat = $row2->tingkat; //[6];
			$kelas = $row2->kelas; //[5];
			$namaterima = $row2->namaterima; //[7];
			$idpenerimaan2 = $row2->idpenerimaan; //[8];
			$full = $row2->full; //[11];
			$id_pjtt = $row2->id_pjtt; //[9];
			$besar = $row2->besar; //[1];
			$jumlah = $row2->jumlah; //[2];
			$bcicilan = $row2->cicilan; //[3];
			$sisa = $besar - $jumlah;
			
				if($sisa > 0) {
					
					if($bayar < 0) {
						$bayar = "0";
						$cicilan = $bayar;
					} else {						
						if($bayar >= $sisa) {
							$cicilan = $sisa;	
						} else {
							$cicilan = $bayar;
						}	
						
						$bayar = $bayar - $sisa;					
					}
					
					$total = $total + $cicilan;
					
					
		?>
		
					<input type="hidden" id="terima_<?php echo $z ?>" name="terima_<?php echo $z ?>" value="<?php echo $sisa ?>" >
					<input type="hidden" id="id_pjtt_<?php echo $z ?>" name="id_pjtt_<?php echo $z ?>" value="<?php echo $id_pjtt ?>" >
					<input type="hidden" id="idpenerimaan2_<?php echo $z ?>" name="idpenerimaan2_<?php echo $z ?>" value="<?php echo $idpenerimaan2 ?>" >
					<input type="hidden" id="namaterima_<?php echo $z ?>" name="namaterima_<?php echo $z ?>" value="<?php echo $namaterima ?>" >
					<input type="hidden" id="full_<?php echo $z ?>" name="full_<?php echo $z ?>" value="<?php echo $full ?>" >
					
					<tr>
						<td style="border: 1px solid #000"><?php echo $namaterima ?></td>
						<td style="border: 1px solid #000" align="right"><?php echo formatnumericview($sisa) ?></td>
						<td style="border: 1px solid #000" id="terima_<?php echo $z ?>"><input type="text" id="bayar_<?php echo $z ?>" name="bayar_<?php echo $z ?>" value="" style="text-align: right" onkeyup="cek_one('<?php echo $z ?>', '<?php echo $jmldata; ?>'), formatangka('bayar_<?php echo $z ?>')" ></td>
						<!--<td style="border: 1px solid #000"><input type="checkbox" id="pilih_<?php echo $z ?>" name="pilih_<?php echo $z ?>" onchange="cek_one('<?php echo $z ?>', '<?php echo $jmldata; ?>')" value="1" /></td>-->
					</tr>
		
		<?php 
					$z++;
				}
				
			}
		?>
		
		<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $jmldata ?>" >
				
		<tr>
			<td colspan="2" align="right" style="text-align: right; height:40px; font-weight: bold; font-size: 16px; width:140px">
				<b>TOTAL :</b>
			</td>
			<td id="total2" colspan="2" align="right" style="text-align: right; height:40px; font-weight: bold; font-size: 16px; width:140px">
				<?php echo formatnumericview($total); ?>
			</td>
		</tr>
		
		<?php /*
		<tr>
			<td colspan="2" align="right" style="text-align: right; height:40px; font-weight: bold; font-size: 16px; width:140px">
				<b>BAYAR :</b>
			</td>
			<td id="bayar2" colspan="2" align="right" style="text-align: right; height:40px; font-weight: bold; font-size: 16px; width:140px">
				<?php echo ($tbayar); ?>
			</td>
		</tr>
		
		
		<tr>
			<td>
				&nbsp;
			</td>
			
			<td colspan="1" align="right" style="text-align: right; height:40px; font-weight: bold; font-size: 16px; width:140px">
				<b>KEMBALI :</b>
			</td>
			<td id="kembali" colspan="2" align="right" style="text-align: right; height:40px; font-weight: bold; font-size: 16px; width:140px">
				<?php 
					$mbayar = numberreplace($tbayar);
					$mtotal = numberreplace($total);
					$mkembali = $mbayar - $mtotal;
					echo formatnumericview($mkembali); 
				?>
			</td>
		</tr> */ ?>
		
		<div id="kembali2"><input type="hidden" id="kembalix" name="kembalix" value=""></div>
		
		<tr>
	        <td valign="top"><b>Keterangan</b></td>
	        <td colspan="3"><textarea id="kcicilan" name="kcicilan" rows="3" cols="30" onKeyPress="return focusNext('Simpan', event)"><?php echo $_REQUEST['kcicilan'] ?></textarea>	        
			</td>
	    </tr>
	    
	    <tr>
	        <td colspan="3" align="center">
	        
	        <?php if($ref == "") { ?>
		        <!--<input type="button" name="Simpan" id="Simpan" class="but" value="Simpan" onclick="this.disabled = true; ValidateSubmit();" />-->
		        <input type="button" name="Simpan" id="Simpan" class="but" value="Simpan" onclick="ValidateSubmit();" />
	        <?php } else { ?>
	        	<input type="button" name="Update" id="Update" class="but" value="Update" onclick="this.disabled = true; ValidateSubmit1();" />	        
	        <?php } ?>
	        
	        &nbsp;&nbsp;
	        <a href="#" onclick="cetakkuitansi_multi('<?php echo $ref ?>')"><img src="finance/images/ico/print_multi.png" width="20" height="20" border="0" onMouseOver="showhint('Cetak Kuitansi Pembayaran!', this, event, '100px')"/></a>
	        &nbsp;&nbsp;
	        <input type="button" name="tutup" id="tutup" class="but" value="Tutup" onclick="window.close()" />
	        
	        &nbsp;&nbsp;&nbsp;&nbsp;
	        <input type="button" name="baru" id="baru" class="but" value="Kasir Baru" onclick="formbaru()" />
	        
	        </td>
	    </tr>
	</table>
	<!----end multi penerimaan----------->

    <?php /*
   	<table border="0" width="95%" cellpadding="2" cellspacing="2" align="center">
	<!-- TABLE CONTENT -->
    <tr>
        <td width="50%"><strong>Pembayaran</strong></td>
        <td colspan="2"><input type="text" readonly="readonly" size="30" value="<?php echo $namapenerimaan?>" style="background-color:#CCCC99"/></td>
    </tr>
    <tr>
        <td><strong>Nama</strong></td>
        <td colspan="2"><input type="text" size="30" value="<?php echo $nis . " - " . $nama ?>" readonly style="background-color:#CCCC99"/></td>
    </tr>
    <tr>
        <td><strong>Jumlah Cicilan</strong></td>
        <td colspan="2"><input type="text" name="jcicilan" id="jcicilan" value="<?php echo FormatRupiah($jbayar) ?>" onblur="formatRupiah('jcicilan')" onfocus="unformatRupiah('jcicilan')" onKeyPress="return focusNext('kcicilan', event)" onkeyup="salinangka()"/>
        <input type="hidden" name="angkacicilan" id="angkacicilan" value="<?php echo $jcicilan?>" />
        
        </td>
    </tr>
    <tr>
        <td><strong>Tanggal</strong></td>
        <td>
        <input type="text" name="tcicilan" id="tcicilan" readonly size="15" value="<?php echo $tanggal ?>" onKeyPress="return focusNext('kcicilan', event)" onClick="Calendar.setup()" style="background-color:#CCCC99"> </td>
        <td width="45%">
        <img src="images/calendar.jpg" name="tabel" border="0" id="btntanggal" onMouseOver="showhint('Buka kalendar!', this, event, '100px')" />
	    </td>        
    </tr>
    <tr>
        <td valign="top">Keterangan</td>
        <td colspan="2"><textarea id="kcicilan" name="kcicilan" rows="3" cols="30" onKeyPress="return focusNext('Simpan', event)"><?php echo $_REQUEST['kcicilan'] ?></textarea>
        </td>
    </tr>
    <tr>
        <td colspan="3" align="center">
        <input type="button" name="Simpan" id="Simpan" class="but" value="Simpan" onclick="this.disabled = true; ValidateSubmit();" />
        <input type="button" name="tutup" id="tutup" class="but" value="Tutup" onclick="window.close()" />
        </td>
    </tr>
    </table> */ ?>
    
    </form>
   
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


<?php if (strlen($errmsg) > 0) { ?>
<script language="javascript">
	//alert('<?php echo $errmsg?>');		
</script>
<?php } ?>


</body>
</html>
<script language="javascript">
 Calendar.setup(
    {
      //inputField  : "tanggalshow","tanggal"
	  inputField  : "tcicilan",         // ID of the input field
      ifFormat    : "%d-%m-%Y",    // the date format
      button      : "btntanggal"       // ID of the button
    }
   );

Calendar.setup(
    {
      inputField  : "tcicilan",        // ID of the input field
      ifFormat    : "%d-%m-%Y",    // the date format	  
	  button      : "tcicilan"       // ID of the button
    }
	
  );
 
var sprytextfield1 = new Spry.Widget.ValidationTextField("tcicilan");
var sprytextfield1 = new Spry.Widget.ValidationTextField("jcicilan");
var sprytextarea1 = new Spry.Widget.ValidationTextarea("kcicilan");
</script>