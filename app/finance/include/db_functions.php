<?php
require_once("config.php");
require_once("errorhandler.php");

$mysqlconnection = NULL;

//Buka koneksi ke Database
function OpenDb() 
{
	global $db_host, $db_user, $db_pass, $db_name, $mysqlconnection;

	$mysqlconnection = @mysql_connect($db_host, $db_user, $db_pass);
	if (!$mysqlconnection)
	{
		HandleQueryError("Tidak dapat terhubung dengan server database di $db_host", 
						 mysql_errno(), mysql_error(), false);
		exit();
	} 
	else 
	{
		$select = @mysql_select_db($db_name, $mysqlconnection);
		if (!$select)
		{
			HandleQueryError("Tidak dapat membuka database $db_name", 
							 mysql_errno(), mysql_error(), false);
			exit();
		}
				  
		mysql_query("SET lc_time_names = 'id_ID';");
		
		return $mysqlconnection;
	}
}	

function OpenDbi() 
{
	global $db_host, $db_user, $db_pass, $db_name, $conni;

	$conni = @mysqli_connect($db_host, $db_user, $db_pass) or trigger_error("Can not connect to database server", E_USER_ERROR);
	$select = @mysqli_select_db($conni, $db_name) or trigger_error("Can not open the database", E_USER_ERROR);
	
	return $conni;
}
	
//Buat query
function QueryDbi($sql) 
{
	$result = mysqli_query($sql) or trigger_error("Failed to execute sql query: $sql", E_USER_ERROR);
	
	return $result;
}

//Tutup koneksi
function CloseDb() 
{
	global $mysqlconnection;
	
	@mysql_close($mysqlconnection);
}

function HandleQueryError($sql, $errno, $errmsg, $issend)
{
	// Log Error
	LogError($sql, $errno, $errmsg);
	
	// Error Handler
	session_name("jbskeu");
	session_start();	  	 
	
	$_SESSION['errtype'] = 1; //mysql
	$_SESSION['errfile'] = $_SERVER['SCRIPT_NAME'];			
	$_SESSION['errno'] = $errno;
	$_SESSION['errmsg'] = "Query: $sql<br>ErrNo: $errno<br>Error: $errmsg";
	$_SESSION['issend'] = $issend;
	
	trigger_error("exception", E_USER_ERROR);
}

// Buat query
function QueryDb($sql) 
{
	global $mysqlconnection;
	
	$result = @mysql_query($sql, $mysqlconnection);  
	
	if (mysql_errno() > 0)
	{
		// Save Error Information
		$errmsg = mysql_error();
		$errno = mysql_errno();
		
		// Force Closing Database Connection
		CloseDb();
		
		// Handle Error
		HandleQueryError($sql, $errno, $errmsg, true);
		exit();
	}

	return $result;
}

function QueryDbTrans($sql, &$success) 
{
	global $mysqlconnection;
	
	$result = @mysql_query($sql, $mysqlconnection);
	$success = ($result && 1); 
	
	if (!$success)
	{
		// Save Error Information
		$errmsg = mysql_error();
		$errno = mysql_errno();
		
		// Force Rolling Back and Closing Database Connection
		RollbackTrans();
		CloseDb();
		
		// Handle Error
		HandleQueryError($sql, $errno, $errmsg, true);
		exit();
	}
	
	return $result;
}

function LogError($sql, $errno, $error)
{
	global $G_ENABLE_QUERY_ERROR_LOG;
	
	if (!$G_ENABLE_QUERY_ERROR_LOG)
		return;
		
	$logPath = @realpath(@dirname(__FILE__)) . "/../../log";
	$logExists = @file_exists($logPath) && @is_dir($logPath);
	if (!$logExists)
		@mkdir($logPath, 0755);
	
	$logFile = @realpath(@dirname(__FILE__)) . "/../../log/keuangan-error.log";
	$modeFile = (@file_exists($logFile) && @filesize($logFile) > 1024 * 1024) ? "w" : "a";
	
	$fp = @fopen($logFile, $modeFile);
	@fwrite($fp, "-- Query Error on " . date('d-M-Y H:i:s') . " --------\r\n");
	@fwrite($fp, " SCRIPT > " . $_SERVER['SCRIPT_NAME'] . "\r\n");
	@fwrite($fp, " QUERY  > $sql\r\n");
	@fwrite($fp, " ERRNO  > $errno\r\n");
	@fwrite($fp, " ERROR  > $error\r\n");
	@fwrite($fp, "\r\n");
	@fclose($fp);
}

function BeginTrans() 
{
	global $mysqlconnection;
	
	@mysql_query("SET AUTOCOMMIT=0", $mysqlconnection);
	@mysql_query("BEGIN", $mysqlconnection);
}

function CommitTrans() 
{
	global $mysqlconnection;
	
	@mysql_query("COMMIT", $mysqlconnection);
	@mysql_query("SET AUTOCOMMIT=1", $mysqlconnection);
}

function RollbackTrans() 
{
	global $mysqlconnection;
	
	@mysql_query("ROLLBACK", $mysqlconnection);
	@mysql_query("SET AUTOCOMMIT=1", $mysqlconnection);
}

function GetValue($tablename, $column, $where) 
{
	$sql = "SELECT $column FROM $tablename WHERE $where";
	$result_get_value = QueryDb($sql);
	$row_get_value = mysql_fetch_row($result_get_value);
	return $row_get_value[0];
}

function FetchSingleRow($sql)
{
	$result = QueryDb($sql);
	if (mysql_num_rows($result) == 0) 
	{
		HandleQueryError($sql, 3477, "Data cannot be found", true);
		exit();
	} 
	else 
	{
		$row = mysql_fetch_row($result);
		return $row;
	}
}

function FetchSingleArray($sql)
{
	$result = QueryDb($sql);
	if (mysql_num_rows($result) == 0) 
	{
		HandleQueryError($sql, 3477, "Data cannot be found", true);
		exit();
	} 
	else 
	{
		$row = mysql_fetch_array($result);
		return $row;
	}
}

function FetchSingle($sql)
{
	$result = QueryDb($sql);
	if (mysql_num_rows($result) == 0) 
	{
		HandleQueryError($sql, 3477, "Data cannot be found", true);
		exit();
	} 
	else 
	{
		$row = mysql_fetch_row($result);
		return $row[0];
	}
}	
?>