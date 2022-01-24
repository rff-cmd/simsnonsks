<?php
@session_start();

//include("include/sambung.php");

$db_server 	= 'localhost';
$db_database = 'sekolahsma3';
$db_user 	= 'root';
$db_password	= '';

backup_tables($db_server,$db_user,$db_password,$db_database);

/* backup the db OR just a table */	
function backup_tables($db_server,$db_user,$db_password,$name,$tablesx = '*')
{
	
	$dbpdo = DB::create();
	
	/*$link = @mysql_connect($db_server,$db_user,$db_password);
	@mysql_select_db($name,$link);*/
	
	//get all of the tables
	$tables = array();
	
	if($tablesx == '*')
	{
		
		$result = $dbpdo->query('SHOW TABLES');
		while($row = $result->fetch(PDO::FETCH_NUM)) 
		{
			
			##cek tipe table
			$sqlsch = "SELECT TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$name' and TABLE_NAME = '$row[0]'";
			$querysch = $dbpdo->query($sqlsch);
			$datasch = $querysch->fetch(PDO::FETCH_OBJ);
			
			if($datasch->TABLE_TYPE == "BASE TABLE") {
				$tables[] = $row[0];
			}
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	
	##VIEW
	if($tablesx == '*')
	{
		
		$result = $dbpdo->query('SHOW TABLES');
		while($row = $result->fetch(PDO::FETCH_NUM))
		{
			
			##cek tipe table
			$sqlsch = "SELECT TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$name' and TABLE_NAME = '$row[0]'";
			$querysch = $dbpdo->query($sqlsch);
			$datasch = $querysch->fetch(PDO::FETCH_OBJ);
			
			if($datasch->TABLE_TYPE == "VIEW") {
				$tables[] = $row[0];
			}
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	
	//cycle through
	foreach($tables as $table)
	{
		$result = $dbpdo->query('SELECT * FROM '.$table);
		$num_fields = $result->rowCount();
		
		$return.= 'DROP TABLE IF EXISTS '.$table.';';
		
		$result1 = $dbpdo->query('SHOW CREATE TABLE '.$table);
		$row2 = $result1->fetch(PDO::FETCH_NUM);
		
		$return.= "\n\n". $row2[1] . ";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = $result->fetch(PDO::FETCH_NUM))
			{
				
				##cek tipe table
				$sqlsch = "SELECT TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$name' and TABLE_NAME = '$table'";
				$querysch = $dbpdo->query($sqlsch);
				$datasch = $querysch->fetch(PDO::FETCH_OBJ);
				
				if($datasch->TABLE_TYPE == "BASE TABLE") {
					$return.= 'INSERT INTO '.$table.' VALUES(';
					for($j=0; $j<$num_fields; $j++) 
					{
						$row[$j] = @addslashes($row[$j]);
						$row[$j] = str_ireplace("\n","\\n",$row[$j]);  //@ereg_replace("\n","\\n",$row[$j]);
						if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
						if ($j<($num_fields-1)) { $return.= ','; }
					}
					$return.= ");\n";
				}
			}
		}
		$return.="\n\n\n";
	}
	
	
	
	//======trigger--------
	$triggers = array();
	$result2 = $dbpdo->query('SHOW TRIGGERS');
	while($row2 = $result2->fetch(PDO::FETCH_NUM))
	{
		$triggers[] = $row2[0];
	}
	
	foreach($triggers as $trigger)
	{
		
		$return2.= 'DROP TRIGGER IF EXISTS '.$trigger.'; 
		DELIMITER // ';
		
		$result3 = $dbpdo->query('SHOW CREATE TRIGGER '.$trigger);
		$row3 = $result3->fetch(PDO::FETCH_NUM);
		$return2.= "\n\n". $row3[2] . " 
		//
		DELIMITER ;\n\n";
		
		$return2.="\n\n\n"; 
		
		/*
		$return2.= 'DROP TRIGGER IF EXISTS '.$trigger.'; 
		';
		//$row3 = mysql_fetch_row(mysql_query('SHOW CREATE TRIGGER '.$trigger));
		$return2.= "\n\n"; 
		
		$return2.="\n\n\n"; */
	}
	
	$return = $return . $return2;
	//---------end trigger-----
	
	
	
	
	//save file
	//$handle = fopen('../../database_backup\db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
	
	$date = date("Y-m-d");
	$filedb = $name . '-' . $date . '-' . time();
	
	$handle = fopen('app/database_backup/' . $filedb . '.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
	
	if($handle) {
		echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Backup Database sukses....";
		
	} else {
		echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Backup Database gagal....";
	}
	
	$_SESSION['filedownload'] = $filedb . ".sql";
}

?>

<script>
	location="app/backup_download_db.php";	
</script>
