<?php

class selectadt{	
	
	//---------get data sales order
	function list_sales_order($kode='', $from_date='', $to_date='', $client_code='', $status='', $all=''){
		global $dbpdo;  //= DB::create();
		$db_adt = DB_ADT::get_db_adt('');
		
		$where = " where a.type='po' ";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			
			$from_date	=	date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			
			$to_date	=	date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		if ( $status != "") {
			if ($where == "") {
				$where = " where a.status = '$status' ";
			} else {
				$where = $where . " and a.status = '$status' ";
			}								
		}
		
		if($kode=='' && $from_date=='' && $to_date=='' && $client_code=='' && $status=='' && $all=='') {
			$where = "where a.ref='NDFxx'";
		}		
		
		if($all == 1) {
			$where = " where a.type='po' ";
		}
		
		$sqlstr="select a.ref, a.date, a.status, a.top, a.client_code, b.code c_code, b.name client_name, a.qo_ref, a.tax_code, a.tax_rate, a.freight_cost, a.freight_account, a.currency_code, a.rate, a.employee_id, a.total, a.memo, a.deposit, a.transfer_date, a.due_date, a.order_number, a.barcode_cloth, a.uid, a.dlu, a.adt_status from $db_adt.sales_order_adt a left join client b on a.client_code=b.syscode " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}	
	
	
	
	//---------get data sales order verification
	function list_sales_order_verification($kode='', $from_date='', $to_date='', $client_code='', $status='', $all=''){
		global $dbpdo;  //= DB::create();
		$db_adt = DB_ADT::get_db_adt('');
		
		$where = " where a.type='verification' ";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			
			$from_date	=	date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			
			$to_date	=	date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		if ( $status != "") {
			if ($where == "") {
				$where = " where a.status = '$status' ";
			} else {
				$where = $where . " and a.status = '$status' ";
			}								
		}
		
		if($kode=='' && $from_date=='' && $to_date=='' && $client_code=='' && $status=='' && $all=='') {
			$where = "where a.ref='NDFxx'";
		}		
		
		if($all == 1) {
			$where = " where a.type='verification' ";
		}
		
		$sqlstr="select a.ref, a.date, a.status, a.top, a.client_code, b.code c_code, b.name client_name, a.qo_ref, a.tax_code, a.tax_rate, a.freight_cost, a.freight_account, a.currency_code, a.rate, a.employee_id, a.total, a.memo, a.deposit, a.transfer_date, a.due_date, a.order_number, a.barcode_cloth, a.uid, a.dlu, a.adt_status from $db_adt.sales_order_adt a left join client b on a.client_code=b.syscode " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get data printing
	function list_printing($kode='', $from_date='', $to_date='', $client_code='', $status='', $all=''){
		global $dbpdo;
		$db_adt = DB_ADT::get_db_adt('');
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			
			$from_date	=	date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			
			$to_date	=	date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		if ( $status != "") {
			if ($where == "") {
				$where = " where a.status = '$status' ";
			} else {
				$where = $where . " and a.status = '$status' ";
			}								
		}
		
		if($kode=='' && $from_date=='' && $to_date=='' && $client_code=='' && $status=='' && $all=='') {
			$where = "where a.ref='NDFxx'";
		}		
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.date, a.status, a.client_code, a.memo, a.qc_date, a.qc_uid, a.verification_date, a.verification_uid, a.uid, a.dlu, b.name client_name, (select aa.so_ref from $db_adt.printing_detail_adt aa where aa.ref=a.ref limit 1) so_ref, a.adt_status from $db_adt.printing_adt a left join client b on a.client_code=b.syscode " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get data press
	function list_press($kode='', $from_date='', $to_date='', $client_code='', $status='', $all=''){
		global $dbpdo;
		$db_adt = DB_ADT::get_db_adt('');
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			
			$from_date	=	date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			
			$to_date	=	date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		if ( $status != "") {
			if ($where == "") {
				$where = " where a.status = '$status' ";
			} else {
				$where = $where . " and a.status = '$status' ";
			}								
		}
		
		if($kode=='' && $from_date=='' && $to_date=='' && $client_code=='' && $status=='' && $all=='') {
			$where = "where a.ref='NDFxx'";
		}		
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.date, a.date_time, a.status, a.client_code, a.memo, a.uid, a.dlu, b.name client_name, (select bb.so_ref from $db_adt.press_detail_adt aa left join printing_detail bb on aa.print_ref=bb.ref where aa.ref=a.ref limit 1) so_ref, (select bb.machine_id from $db_adt.press_detail_adt aa left join printing_detail bb on aa.print_ref=bb.ref where aa.ref=a.ref limit 1) machine_id, (select aa.operator from $db_adt.press_detail_adt aa where aa.ref=a.ref limit 1) operator, (select aa.machine_id from $db_adt.press_detail_adt aa where aa.ref=a.ref limit 1) machine_id_press, (select aa.print_ref from $db_adt.press_detail_adt aa where aa.ref=a.ref limit 1) print_ref, a.adt_status from $db_adt.press_adt a left join client b on a.client_code=b.syscode " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get data counting
	function list_counting($kode='', $from_date='', $to_date='', $client_code='', $status='', $all=''){
		global $dbpdo;
		$db_adt = DB_ADT::get_db_adt('');
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			
			$from_date	=	date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			
			$to_date	=	date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		if ( $status != "") {
			if ($where == "") {
				$where = " where a.status = '$status' ";
			} else {
				$where = $where . " and a.status = '$status' ";
			}								
		}
		
		if($kode=='' && $from_date=='' && $to_date=='' && $client_code=='' && $status=='' && $all=='') {
			$where = "where a.ref='NDFxx'";
		}		
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.date, a.status, a.client_code, a.memo, a.qc_date, a.qc_uid, a.uid, a.dlu, b.name client_name, (select cc.so_ref from $db_adt.counting_detail_adt aa left join press_detail bb on aa.press_ref=bb.ref left join printing_detail cc on bb.print_ref=cc.ref where aa.ref=a.ref limit 1) so_ref, (select aa.press_ref from $db_adt.counting_detail_adt aa where aa.ref=a.ref limit 1) press_ref, (select bb.print_ref from $db_adt.counting_detail_adt aa left join press_detail bb on aa.press_ref=bb.ref where aa.ref=a.ref limit 1) print_ref, a.adt_status from $db_adt.counting_adt a left join client b on a.client_code=b.syscode " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		 
		return $sql;
	}
	
	
	//---------get data sewing
	function list_sewing($kode='', $from_date='', $to_date='', $client_code='', $status='', $all=''){
		global $dbpdo;
		$db_adt = DB_ADT::get_db_adt('');
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			
			$from_date	=	date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			
			$to_date	=	date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		if ( $status != "") {
			if ($where == "") {
				$where = " where a.status = '$status' ";
			} else {
				$where = $where . " and a.status = '$status' ";
			}								
		}
		
		if($kode=='' && $from_date=='' && $to_date=='' && $client_code=='' && $status=='' && $all=='') {
			$where = "where a.ref='NDFxx'";
		}		
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.date, a.status, a.client_code, a.memo, a.uid, a.dlu, b.name client_name, (select cc.so_ref from $db_adt.sewing_detail_adt dd left join counting_detail aa on dd.counting_ref=aa.ref left join press_detail bb on aa.press_ref=bb.ref left join printing_detail cc on bb.print_ref=cc.ref where dd.ref=a.ref limit 1) so_ref, (select aa.counting_ref from $db_adt.sewing_detail_adt aa where aa.ref=a.ref limit 1) counting_ref, a.adt_status from $db_adt.sewing_adt a left join client b on a.client_code=b.syscode " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get data delivery orser
	function list_delivery_order($kode ='', $all=0, $act=''){
		global $dbpdo;
		$db_adt = DB_ADT::get_db_adt('');
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			
			$from_date	=	date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			
			$to_date	=	date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		if ( $status != "") {
			if ($where == "") {
				$where = " where a.status = '$status' ";
			} else {
				$where = $where . " and a.status = '$status' ";
			}								
		}
		
		if($kode=='' && $from_date=='' && $to_date=='' && $client_code=='' && $status=='' && $all=='') {
			$where = "where a.ref='NDFxx'";
		}		
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.date, a.status, a.client_code, a.memo, a.uid, a.dlu, b.name client_name, a.adt_status from $db_adt.delivery_order_adt a left join client b on a.client_code=b.syscode " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	
	
}
?>