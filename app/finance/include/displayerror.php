<?php
require_once("../../include/mainconfig.php");

session_name("jbskeu");
session_start();

if ($_SESSION['errno'] != 0) 
{
	$rel = "./";
	if (file_exists("../style/style.css"))
		$rel = "../";
	elseif (file_exists("../../style/style.css"))
		$rel = "../../";
	
	date_default_timezone_set('Asia/Jakarta');
	
	$html1  = "<html><head><link rel='stylesheet' type='text/css' href='". $rel ."style/style.css'></head><body>\r\n";
	$html1 .= "<form name='main' method='post' action='http://support.dian-global.com/content/report/bugreport.php'>\r\n";
	$html1 .= "<input type='hidden' name='apptype' value='public'>\r\n";
	$html1 .= "<input type='hidden' name='appmodule' value='keuangan'>\r\n";
	$html1 .= "<input type='hidden' name='source' value='application'>\r\n";
	$html1 .= "<input type='hidden' name='appversion' value='$G_VERSION'>\r\n";
	$html1 .= "<input type='hidden' name='appbuilddate' value='$G_BUILDDATE'>\r\n";
	$html1 .= "<input type='hidden' name='errtime' value='" . date('Y-m-d H:i:s') ."'>\r\n";
	$html1 .= "<input type='hidden' name='errtype' value='" . $_SESSION['errtype'] ."'>\r\n";
	$html1 .= "<input type='hidden' name='errno' value='" . $_SESSION['errno'] ."'>\r\n";
	$html1 .= "<input type='hidden' name='errmsg' value='" . urlencode($_SESSION['errmsg']) ."'>\r\n";
	$html1 .= "<input type='hidden' name='errfile' value='" . urlencode($_SESSION['errfile']) ."'>\r\n";
	$html1 .= "<table border='0' width='100%' height='100%'>\r\n";
	$html1 .= "<tr height='400'><td align='center' valign='middle' background='". $rel ."images/ico/b_warning.png' style='margin:0;padding:0;background-repeat:no-repeat;'>\r\n";
	$html1 .= "<table width='457' border='0' cellpadding='0' cellspacing='0'><tr><td><img src='". $rel ."images/bk_message_01.jpg' width='457' height='17'></td></tr><tr><td style='background-image:url(". $rel ."images/bk_message_02.jpg); padding-left:20px; padding-right:20px;'>\r\n";
	
	$html2  = "</td></tr><tr><td><img src='". $rel ."images/bk_message_03.jpg' width='457' height='18'></td></tr></table>";
	$html2  .= "</td></tr></table></td></tr></table></form></body></html>";
	
	if ($_SESSION['errtype'] == 1 && $_SESSION['errno'] == 1451) 
	{
		$errstr  = "<center><br><br><br><br><br><br><font familiy='Verdana' color='#666666' size='2' style='text-decoration:none'><strong>Maaf, anda tidak dapat menghapus data ini, karena telah digunakan oleh data lainnya!</strong></font><br><br><br><br><br><br></center>";
	} 
	else 
	{
		$errstr  = "<center><h2>Maaf, telah terjadi kesalahan</h2></center>\r\n";
		
		if ($_SESSION['issend'])
	        $errstr .= "<p align='center'>Laporkan kesalahan berikut ke <a style='color:blue; text-decoration:underline;' target='_blank' href='http://support.dian-global.com'>http://support.dian-global.com</a></p>\n";

		$errstr .= "<table border='1' cellpadding='0' cellspacing='0' style='border-width: 1px; border-collapse: collapse' width='100%'>\r\n";
		$errstr .= "<tr>\r\n";
		$errstr .= "<td width='15%' style='background-color:#CCC;' align='left'><strong>Waktu</strong></td>\r\n";
		$errstr .= "<td align='left'>" . date('d-M-Y H:i:s') . "</td>\r\n";
		$errstr .= "</tr>\r\n";
		$errstr .= "<tr>\r\n";
		$errstr .= "<td style='background-color:#CCC;' align='left'><strong>Tipe</strong></td>\r\n";
		$errstr .= "<td align='left'>" . $_SESSION['errtype'] . "</td>\r\n";
		$errstr .= "</tr>\r\n";
		$errstr .= "<tr>\r\n";
		$errstr .= "<td style='background-color:#CCC;' align='left'><strong>Berkas</strong></td>\r\n";
		$errstr .= "<td align='left'>" . $_SESSION['errfile'] . "</td>\r\n";
		$errstr .= "</tr>\r\n";
		$errstr .= "<tr>\r\n";
		$errstr .= "<td style='background-color:#CCC;' align='left'><strong>Kode</strong></td>\r\n";
		$errstr .= "<td align='left'>" . $_SESSION['errno'] . "</td>\r\n";
		$errstr .= "</tr>\r\n";
		$errstr .= "<tr>\r\n";
		$errstr .= "<td colspan='2' align='left'><strong>Pesan:</strong><br>" . $_SESSION['errmsg'] . "</td>\r\n";
		$errstr .= "</tr>\r\n";
		$errstr .= "</table><br><br>\r\n";
		$errstr .= "<center><input type='button' class='but' value='Kembali' onclick=\"window.history.go(-1);\">\r\n";
		
		if ($_SESSION['issend'])
			$errstr .= "<input type='submit' class='but' value='Kirim' ></center>\r\n";
	}
	
	echo  $html1 . $errstr . $html2;
	
	// $_SESSION['errno'] = 0;
}
?>