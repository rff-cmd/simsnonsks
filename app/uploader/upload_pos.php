<?php
	@session_start();
	
	$location_id = $_SESSION["location_id2"];
	//$urlloc = 'http://localhost/tokosahabat/app/uploader/uploader_pos.php';
	$urlloc = 'http://possp.sahabatputra.com/app/uploader/uploader_pos.php'; //online
	
	/*===========start upload */
	//$ch = curl_init("http://localhost:8080/tokosahabat/app/uploader/create_pos.php?whs=$location_id"); //localhost only
	$ch = curl_init("http://localhost/tokosahabat/app/uploader/create_pos.php?whs=$location_id"); //localhost only
	curl_exec($ch);
	
	//--------------------------upload file data.txt
	$local_directory=dirname(__FILE__).'/data_upload/';
	
	ini_set('max_execution_time', 0);
	/*set time out menjadi unlimit agar upload tidak gagal di tengah jalan karena time out */	
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
    curl_setopt($ch, CURLOPT_POST, true);	
	curl_setopt($ch, CURLOPT_URL, $urlloc );
	
	//most importent curl assues @filed as file field
	$datacreate = "data_pos_".$location_id;
    $post_array = array(
        "my_file"=>"@".$local_directory.$datacreate.'.txt',
        "upload"=>"Upload"
    );
	
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_array); 
    $response = curl_exec($ch);
	/*----------------------/\-----------------------------*/
	
	
	//--------------------------upload file data_detail.txt
	$local_directory=dirname(__FILE__).'/data_upload/';
	
	ini_set('max_execution_time', 0);
	/*set time out menjadi unlimit agar upload tidak gagal di tengah jalan karena time out */	
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
    curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_URL, $urlloc );
	
	//most importent curl assues @filed as file field
	$datacreate = "data_pos_detail_".$location_id;
    $post_array = array(
        "my_file"=>"@".$local_directory.$datacreate.'.txt',
        "upload"=>"Upload"
    );
	
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_array); 
    $response = curl_exec($ch);
	/*----------------------/\-----------------------------*/
	
	
	//--------------------------upload file data_bincard.txt
	$local_directory=dirname(__FILE__).'/data_upload/';
	
	ini_set('max_execution_time', 0);
	/*set time out menjadi unlimit agar upload tidak gagal di tengah jalan karena time out */	
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
    curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_URL, $urlloc ); 
	
	//most importent curl assues @filed as file field
	$datacreate = "data_sales_bincard_".$location_id;
    $post_array = array(
        "my_file"=>"@".$local_directory.$datacreate.'.txt',
        "upload"=>"Upload"
    );
	
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_array); 
    $response = curl_exec($ch);
	/*----------------------/\-----------------------------*/
	
	
		
	
	
	/*process upload---------------*/
	//$ch = curl_init("http://localhost/tokosahabat/app/uploader/process_upload_sales.php?whs=$location_id"); //localhost
	$ch = curl_init("http://possp.sahabatputra.com/app/uploader/process_upload_pos.php?whs=$location_id"); //online
	curl_exec($ch);
	
	
	//$ch = curl_init("http://localhost/tokosahabat/app/uploader/process_upload_sales_detail.php?whs=$location_id"); //localhost
	$ch = curl_init("http://possp.sahabatputra.com/app/uploader/process_upload_pos_detail.php?whs=$location_id"); //online
	curl_exec($ch);
	
	
	//$ch = curl_init("http://localhost/tokosahabat/app/uploader/process_upload_sales_bincard.php?whs=$location_id"); //localhost
	/*$ch = curl_init("http://possp.sahabatputra.com/app/uploader/process_upload_sales_bincard.php?whs=$location_id"); //online
	curl_exec($ch);*/
	
	
	
?>

<div align="center" style="color: #f2f814; background-color: #2d0000; margin-top: 50px; height: auto; font-size: 24px; font-family: Arial">UPLOAD DATA KASIR POS SUKSES</div>
