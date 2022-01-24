<?php
//include_once("include/sambung.php");

// Function penanda awal file (Begin Of File) Excel
function xlsBOF() {
	echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
	return;
}

// Function penanda akhir file (End Of File) Excel
function xlsEOF() {
	echo pack("ss", 0x0A, 0x00);
	return;
}

// Function untuk menulis data (angka) ke cell excel
function xlsWriteNumber($Row, $Col, $Value) {
	echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
	echo pack("d", $Value);
	return;
}

// Function untuk menulis data (text) ke cell excel
function xlsWriteLabel($Row, $Col, $Value ) {
	$L = strlen($Value);
	echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
	echo $Value;
	return;
}

?>