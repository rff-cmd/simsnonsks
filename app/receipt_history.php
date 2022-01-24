<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include_once ("include/queryfunctions.php");
include_once ("include/functions.php");
include_once ("include/inword.php");

include 'class/class.selectview.php';

$selectview = new selectview;

$invoice_no	= $_REQUEST['invoice_no'];

$filter = "";

if($date_from != "") {
	if($filter == "") {
		$filter = " No. Penerimaan : ".$invoice_no;
	} else {
		$filter = $filter." s/d No. Penerimaan : ".$invoice_no;
	}
}


?>

<head>
<title>Receipt History</title>

</head>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family: Arial; font-size: 11px">
	<tr>
		<td align="left"><b>PENERIMAAN PIUTANG</b></td>
	</tr>
	
	<tr>
		<td align="left"><i><?php echo $filter ?></i></td>
	</tr>
	
</table>

<br>


<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border:#ccc; font-family: Arial; font-size: 11px">	
	<tr align="center" style="font-weight: bold">
		<td>No. Penerimaan</td>
		<td>No. Invoice</td>
		<td>Nama Member</td>
		<td>Tanggal</td>		
		<td>Total</td>
	</tr>
	
	<?php
		$sqltot = $selectview->rpt_receipt_total($invoice_no);
		$datatot = $sqltot->fetch(PDO::FETCH_OBJ);
		
		$totalar = $datatot->debit_amount;
		$totalar = number_format($totalar,0,".",",");
	?>
	<tr align="center" style="font-weight: bold">
		<td colspan="4" align="right">Jumlah Piutang&nbsp;</td>	
		<td align="right"><?php echo $totalar ?>&nbsp;</td>
	</tr>
	
	<?php
	
	$sub_total = 0;
	$grand_total = 0;
	$sql2 = $selectview->rpt_receipt_history($invoice_no);
	while($row_sales_invoice_detail=$sql2->fetch(PDO::FETCH_OBJ)) {
		
		$total = 0;
		$total = $row_sales_invoice_detail->credit_amount;
		
		$sub_total = $sub_total + $total;
	?>
	
	
		<tr>
			<td align="left">&nbsp;<?php echo $row_sales_invoice_detail->ref ?></td>
			<td align="left">&nbsp;<?php echo $row_sales_invoice_detail->invoice_no ?></td>
			<td>&nbsp;<?php echo $row_sales_invoice_detail->client_name ?></td>
			<td>&nbsp;<?php echo $row_sales_invoice_detail->date ?></td>
			<td align="right"><?php echo number_format($total,"0",",",".") ?>&nbsp;</td>
		</tr>
		
		
	<?php
	}
	
	$grand_total = $datatot->debit_amount - $sub_total;
	?>
	
	<tr style="font-weight: bold">
		<td align="right" colspan="4">Sub Total&nbsp;</td>
		<td align="right"><?php echo number_format($sub_total,"0",",",".") ?>&nbsp;</td>
	</tr>
	<tr style="font-weight: bold">
		<td align="right" colspan="4">Sisa Piutang&nbsp;</td>
		<td align="right"><?php echo number_format($grand_total,"0",",",".") ?>&nbsp;</td>
	</tr>
	
</table>

