<?php
session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

$namafile = "Lap_Stock_Nilai_Barang.xls";

header("Content-Type: application/xls");
header("Content-Disposition: attachment;filename=".$namafile." ");

include_once ("include/queryfunctions.php");
include_once ("include/functions.php");
include_once ("include/function_excel.php");

include 'class/class.selectview.php';
include 'class/class.select.php';

$selectview = new selectview;
$select = new select;

$item_code		= $_REQUEST['item_code'];
$location_id	= $_REQUEST['location_id'];
$uom_code		= $_REQUEST['uom_code'];
$date_from		= $_REQUEST['date_from'];
$date_to		= $_REQUEST['date_to'];
$item_group_id	= $_REQUEST['item_group_id'];
$item_subgroup_id		= $_REQUEST['item_subgroup_id'];
$all		    = $_REQUEST['all'];

$filter = "";

if($item_code != "") {
    $sqlitem = $select->list_item($item_code);
    $dataitem = $sqlitem->fetch(PDO::FETCH_OBJ);
	if($filter == "") {
		$filter = " Nama Barang : ".$dataitem->name;
	} else {
		$filter = $filter." , Nama Barang : ".$dataitem->name;
	}
}

if($location_id != "") {
    $sqlloc = $select->list_warehouse($location_id);
    $dataloc = $sqlloc->fetch(PDO::FETCH_OBJ);
	if($filter == "") {
		$filter = " Lokasi : ".$dataloc->name;
	} else {
		$filter = $filter." , Lokasi : ".$dataloc->name;
	}
}

if($uom_code != "") {
	if($filter == "") {
		$filter = " Satuan : ".$uom_code;
	} else {
		$filter = $filter." , Satuan : ".$uom_code;
	}
}

if($date_from != "") {
	if($filter == "") {
		$filter = " Tanggal : ".$date_from;
	} else {
		$filter = $filter." , Tanggal : ".$date_from;
	}
}

if($date_to != "") {
	if($filter == "") {
		$filter = " Tanggal : ".$date_to;
	} else {
		$filter = $filter." s/d Tanggal : ".$date_to;
	}
}

if($all != 0) {
	$filter = "Semua";
}

echo '
<?xml version="1.0" encoding="iso-8859-1"?>
<?mso-application progid="Excel.Sheet"?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:html="http://www.w3.org/TR/REC-html40">
 

 <Styles>
  <Style ss:ID="judul">
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
	<Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
  </Style>
  <Style ss:ID="kepala">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
   <Interior ss:Color="#ffffff" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="badan">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>  
  
  <Style ss:ID="numberkanan">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>    
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="0"/>
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
  </Style>
  
  <Style ss:ID="badankanan">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>    
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
  </Style>
  
 </Styles>
 <Worksheet ss:Name="Stock">

  <Table>
   <Column ss:Index="1" ss:Width="100"/>
   <Column ss:Index="2" ss:Width="150"/>
   <Column ss:Index="3" ss:Width="250"/>
   <Column ss:Index="4" ss:Width="200"/>
   
   <Row>
    <Cell ss:MergeAcross="6" ss:StyleID="judul"><Data ss:Type="String">LAPORAN STOK NILAI BARANG</Data></Cell>
    <Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
   </Row>
   <Row>
    <Cell ss:MergeAcross="6" ss:StyleID="badan"><Data ss:Type="String">'.$filter.'</Data></Cell>
    <Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
   </Row>';

	echo '<Row>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Lokasi</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Kode Barang</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama Barang</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Satuan</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Qty Akhir</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nilai</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Jumlah</Data></Cell>';
	echo '</Row>';
	
	$grand_total_qty = 0;
	$grand_total_value = 0;
		
	$sql = $selectview->rpt_stock($item_code, $location_id, $uom_code, $all, $item_group_id, $item_subgroup_id, $date_from, $date_to);
	while($row_bincard2=$sql->fetch(PDO::FETCH_OBJ)) {
		
		$qty = $row_bincard2->qty;
		
        $sql3 = $selectview->rpt_bincard_openblc_item($row_bincard2->item_code, $row_bincard2->uom_code, $row_bincard2->location_code, $date_from, $all);
		$data_opnblc = $sql3->fetch(PDO::FETCH_OBJ);
		$opnblc = $data_opnblc->opnblc;
		
		$total_qty = 0;
        $total_qty = $opnblc + $qty;
        
        ##cek stok opname (jika ada maka query yg dipakai query ini)
		$sql1=$selectview->rpt_stock_stock_opname_limit1($row_bincard2->item_code, $row_bincard2->location_code, $row_bincard2->uom_code, $all, $row_bincard2->item_group_id, $row_bincard2->item_subgroup_id, $date_from, $date_to, "stockopname");
		$data1=$sql1->fetch(PDO::FETCH_OBJ);
		$invoice_type=$data1->invoice_type;
		if($invoice_type == "stockopname") {
			$sql2=$selectview->rpt_check_stock_opname($row_bincard2->item_code, $row_bincard2->location_code, $row_bincard2->uom_code, $all, $row_bincard2->item_group_id, $row_bincard2->item_subgroup_id, $date_from, $date_to);
			$data2=$sql2->fetch(PDO::FETCH_OBJ);
			$debit_qty = $data2->debit_qty;
			$credit_qty = 0;
			$total_qty = $data2->qty;
			
			$date_stok_opname = $data2->date;
			
			//cek qty setelah stock opname
			$sql_so = $selectview->rpt_stock_non_so($row_bincard2->item_code, $row_bincard2->location_code, $row_bincard2->uom_code, $all, $row_bincard2->item_group_id, $row_bincard2->item_subgroup_id, $date_stok_opname, $date_to);	
			$row_bincard_so=$sql_so->fetch(PDO::FETCH_OBJ);
			$total_qty = $total_qty + $row_bincard_so->qty;
			
			//non SO
			/*$sql1=$selectview->rpt_stock_stock_opname_limit1($row_bincard2->item_code, $row_bincard2->location_code, $row_bincard2->uom_code, $all, $row_bincard2->item_group_id, $row_bincard2->item_subgroup_id, $date_from, $date_to, "");
			$data1=$sql1->fetch(PDO::FETCH_OBJ);
			$invoice_type=$data1->invoice_type;
			
			if($invoice_type != "stockopname") {
				$sql2=$selectview->rpt_non_stock_opname($row_bincard2->item_code, $row_bincard2->location_code, $row_bincard2->uom_code, $all, $row_bincard2->item_group_id, $row_bincard2->item_subgroup_id, $date_stok_opname, $date_to);
				$data2=$sql2->fetch(PDO::FETCH_OBJ);
				$debit_qty = $data2->debit_qty;
				$credit_qty = 0;
				$total_qty = $total_qty + $data2->qty;
			}*/
		} 
		##----------------/\--------------------
		
		##harga beli terakhir
		$sql_cost = $selectview->list_purchase_invoice_last_discount($row_bincard2->item_code, $row_bincard2->uom_code);
		$data_cost = $sql_cost->fetch(PDO::FETCH_OBJ);
		$unit_cost = $data_cost->unit_cost;
		$discount1 = $data_cost->discount1; //%
		$discount = ($unit_cost * $discount1)/100;
		$current_cost = $unit_cost - $discount;
		$total_cost = $current_cost * $total_qty;
		
		$grand_total_qty = $grand_total_qty + $total_qty;
		$grand_total_value = $grand_total_value + $total_cost;	
        
		echo "<Row>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_bincard2->location_name."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_bincard2->code."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_bincard2->name."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_bincard2->uom_code."</Data></Cell>";
		echo "<Cell ss:StyleID=\"numberkanan\"><Data ss:Type=\"String\">".$total_qty."</Data></Cell>";
		echo "<Cell ss:StyleID=\"numberkanan\"><Data ss:Type=\"String\">".$current_cost."</Data></Cell>";
		echo "<Cell ss:StyleID=\"numberkanan\"><Data ss:Type=\"String\">".$total_cost."</Data></Cell>";
		echo '</Row>';
				
	}

		echo "<Row>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\"></Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\"></Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\"></Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">Grand Total</Data></Cell>";
		echo "<Cell ss:StyleID=\"numberkanan\"><Data ss:Type=\"String\">".$grand_total_qty."</Data></Cell>";
		echo "<Cell ss:StyleID=\"numberkanan\"><Data ss:Type=\"String\"></Data></Cell>";
		echo "<Cell ss:StyleID=\"numberkanan\"><Data ss:Type=\"String\">".$grand_total_value."</Data></Cell>";
		echo '</Row>';

echo '
  </Table>

 </Worksheet>
</Workbook>';
?>

