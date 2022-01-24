<?php
@session_start();
/*
function db_connect($HOST,$USER,$PASS,$DB,$PORT)
{
	$conn = mysql_connect($HOST . ":" . $PORT , $USER, $PASS);
	mysql_select_db($DB);
	return $conn;
}

function db_close($conn)
{
	mysql_close($conn);
}

//get data from table
function mkr_query($strsql,$conn)
{
	$rs = mysql_query($strsql,$conn);
	return $rs;
}

//get number of rows in results sets
function num_rows($rs)
{
	return @mysql_num_rows($rs); 
}

function fetch_array($rs)
{
	return mysql_fetch_array($rs);
}

//fetch object
function fetch_object($rs)
{
	return mysql_fetch_object($rs);
}

function free_result($rs)
{
	@mysql_free_result($rs);
}

function data_seek($rs,$cnt)
{
	@mysql_data_seek($rs, $cnt);
}

function error()
{
	return mysql_error();
}

function begin() 
{
	@mysql_query("BEGIN");
}

function commit()
{
	@mysql_query("COMMIT");
}

function rollback()
{
	@mysql_query("ROLLBACK");
} */
?>

<?php
	include('sambung.php');
	//local
	/*define("HOST", "localhost");
	define("PORT", 3306);
	define("USER", "root");
	define("PASS", "");
	define("DB", "accounting");
	*/
	
	//online
	/*define("HOST", "localhost");
	define("PORT", 3306);
	define("USER", "dianglo1_hotel");
	define("PASS", "1qaz2wsx");
	define("DB", "dianglo1_hotel");
	*/
	
	/*
	define("HOST", "localhost");
	define("PORT", 3306);
	define("USER", "amertha2_chandra");
	define("PASS", "WadJyH7EQ");
	define("DB", "amertha2_chandra");
	*/
	
	/*define("HOST", "mysql4-h");
	define("PORT", 3306);
	define("USER", "h172638rw");
	define("PASS", "hotelmis321");
	define("DB", "h172638_hotelmis");*/
?>
