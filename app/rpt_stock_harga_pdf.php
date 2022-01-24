<?php

include("rpt_stock_harga_data.php");

/*$alldata = $getdata.$getdata2.$getdata3.$getdata4.$getdata5.$getdata6;

echo  $alldata;*/

//star PDF
include('pdf2/html_table.php');

$alldata='
<table width="100%" border="1" cellspacing="5" style="font-family: sans-serif; ">
		
		
				<tbody><tr><td valign="top" style="border: 1px solid #000000">
					<table width="100%" border="0" style="font-family: sans-serif; font-size: 16px">
						<tbody><tr style="font-weight: bold;">
							<td align="left" colspan="3">ABON CABE 21G LVL 15</td>
						</tr>
						
												<tr>
							<td align="left" colspan="3">&nbsp;</td>	
						</tr>
												<tr style="height: 40px">
							<td align="left" width="25%" style="font-weight: bold; font-size: 12px">8995899250440</td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px">3,700/ 1</td>		
						</tr>	
						<tr style="font-weight: bold">
							<td align="left" width="25%" style="font-weight: bold; font-size: 12px">22-01-2018</td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px">3,650/ 3</td>		
						</tr>
						<tr style="font-weight: bold">
							<td align="left" width="25%"></td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px">3,600/ 6</td>		
						</tr>
						
						
					</tbody></table>
				</td>
	
							
				<td valign="top" style="border: 1px solid #000000">
					<table width="100%" border="0" style="font-family: sans-serif; font-size: 16px">
						<tbody><tr style="font-weight: bold;">
							<td align="left" colspan="3">ABON CABE 45G LVL 15</td>
						</tr>
						
												<tr>
							<td align="left" colspan="3">&nbsp;</td>	
						</tr>
												<tr style="height: 40px">
							<td align="left" width="25%" style="font-weight: bold; font-size: 12px">8995899250341</td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px">8,750/ 1</td>		
						</tr>	
						<tr style="font-weight: bold">
							<td align="left" width="25%" style="font-weight: bold; font-size: 12px">22-01-2018</td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px">8,650/ 3</td>		
						</tr>
						<tr style="font-weight: bold">
							<td align="left" width="25%"></td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px">8,550/ 6</td>		
						</tr>
						
						
					</tbody></table>
				</td>
	
							
				<td valign="top" style="border: 1px solid #000000">
					<table width="100%" border="0" style="font-family: sans-serif; font-size: 16px">
						<tbody><tr style="font-weight: bold;">
							<td align="left" colspan="3">BON CABE 22.5G PEDAS</td>
						</tr>
						
												<tr>
							<td align="left" colspan="3">&nbsp;</td>	
						</tr>
												<tr style="height: 40px">
							<td align="left" width="25%" style="font-weight: bold; font-size: 12px">8995899250211</td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px">3,900/ 1</td>		
						</tr>	
						<tr style="font-weight: bold">
							<td align="left" width="25%" style="font-weight: bold; font-size: 12px">22-01-2018</td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px">3,800/ 3</td>		
						</tr>
						<tr style="font-weight: bold">
							<td align="left" width="25%"></td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px">3,750/ 6</td>		
						</tr>
						
						
					</tbody></table>
				</td>
	
						</tr><tr align="left">	
				<td valign="top" style="border: 1px solid #000000">
					<table width="100%" border="0" style="font-family: sans-serif; font-size: 16px">
						<tbody><tr style="font-weight: bold;">
							<td align="left" colspan="3">BON CABE 3X7.5G EBI</td>
						</tr>
						
												<tr>
							<td align="left" colspan="3">&nbsp;</td>	
						</tr>
												<tr style="height: 40px">
							<td align="left" width="25%" style="font-weight: bold; font-size: 12px">8995899250235</td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px">3,700/ 1</td>		
						</tr>	
						<tr style="font-weight: bold">
							<td align="left" width="25%" style="font-weight: bold; font-size: 12px">22-01-2018</td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px">3,650/ 3</td>		
						</tr>
						<tr style="font-weight: bold">
							<td align="left" width="25%"></td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px">3,600/ 6</td>		
						</tr>
						
						
					</tbody></table>
				</td>
	
							
				<td valign="top" style="border: 1px solid #000000">
					<table width="100%" border="0" style="font-family: sans-serif; font-size: 16px">
						<tbody><tr style="font-weight: bold;">
							<td align="left" colspan="3">BON CABE 3X7.5G TERI</td>
						</tr>
						
												<tr>
							<td align="left" colspan="3">&nbsp;</td>	
						</tr>
												<tr style="height: 40px">
							<td align="left" width="25%" style="font-weight: bold; font-size: 12px">8995899250228</td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px">5,500/ 1</td>		
						</tr>	
						<tr style="font-weight: bold">
							<td align="left" width="25%" style="font-weight: bold; font-size: 12px">22-01-2018</td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px">5,450/ 3</td>		
						</tr>
						<tr style="font-weight: bold">
							<td align="left" width="25%"></td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px">5,400/ 6</td>		
						</tr>
						
						
					</tbody></table>
				</td>
	
							
				<td valign="top" style="border: 1px solid #000000">
					<table width="100%" border="0" style="font-family: sans-serif; font-size: 16px">
						<tbody><tr style="font-weight: bold;">
							<td align="left" colspan="3">BON CABE 50G TERI</td>
						</tr>
						
												<tr>
							<td align="left" colspan="3">&nbsp;</td>	
						</tr>
												<tr style="height: 40px">
							<td align="left" width="25%" style="font-weight: bold; font-size: 12px">8995899250327</td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px">11,000/ 1</td>		
						</tr>	
						<tr style="font-weight: bold">
							<td align="left" width="25%" style="font-weight: bold; font-size: 12px">22-01-2018</td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px">10,900/ 3</td>		
						</tr>
						<tr style="font-weight: bold">
							<td align="left" width="25%"></td>
							<td align="left" width="2%" style="font-weight: bold; font-size: 18px">Rp.</td>		
							<td align="left" width="40%" style="font-weight: bold; font-size: 18px">10,800/ 6</td>		
						</tr>
						
						
					</tbody></table>
				</td>
	
						</tr><tr align="left">	
			
</tr></tbody></table>';

$htmlTable=$alldata;

$pdf=new PDF_HTML_Table();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->WriteHTML("$htmlTable");
$pdf->Output();
?>
