<?php //localhost

class DB{

	private static $db_server 	= 'localhost';
	private static $db_port 	= '3306';
	private static $db_database = 'sims';
	private static $db_user 	= 'root';
	private static $db_password	= '';
	
	private static $dbpdo = null;

	public static function create(){
		if(self::$dbpdo == null){
			try{
				//self::$dbpdo = new PDO("mysql:server=".$db_server.";port=".$db_port.";dbname=".self::$db_database.";", self::$db_user, self::$db_password);
				
				//$dbh = new PDO('mysql:host=hotsname;port=3309;dbname=dbname', 'root', 'root');
				
				self::$dbpdo = new PDO("mysql:server=".self::$db_server.";dbname=".self::$db_database.";", self::$db_user, self::$db_password);
				
				self::$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		return self::$dbpdo;
	}
		
}



class DB_ADT{

	##audit trail
	private static $db_server_adt 	= 'localhost';
	private static $db_port_adt 	= '3306';
	private static $db_database_adt = 'sekolahsma3_adt';
	private static $db_user_adt 	= 'root';
	private static $db_password_adt	= '';
	
	private static $dbpdo_adt = null;

	public static function create_adt(){
		if(self::$dbpdo_adt == null){
			try{
				self::$dbpdo_adt = new PDO("mysql:server=".self::$db_server_adt.";dbname=".self::$db_database_adt.";", self::$db_user_adt, self::$db_password_adt);
				
				self::$dbpdo_adt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		return self::$dbpdo_adt;
	}
	
	
	
	public static $db_adt = null;
	public static function get_db_adt(){
		
		self::$db_adt = "sekolahsma3_adt";
		
		return self::$db_adt;
	}	
}



class DB_UJI{

	##ujian
	private static $db_server_uji 	= 'localhost';
	private static $db_port_uji 	= '3306';
	private static $db_database_uji = 'ujian_online3';	 //'ujiansma3';
	private static $db_user_uji 	= 'root';
	private static $db_password_uji	= '';
	
	private static $dbpdo_uji = null;

	public static function create_uji(){
		if(self::$dbpdo_uji == null){
			try{
				self::$dbpdo_uji = new PDO("mysql:server=".self::$db_server_uji.";dbname=".self::$db_database_uji.";", self::$db_user_uji, self::$db_password_uji);
				
				self::$dbpdo_uji->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		return self::$dbpdo_uji;
	}
	
	
	
	public static $db_uji = null;
	public static function get_db_uji(){
		
		self::$db_uji = "ujiansma3";
		
		return self::$db_uji;
	}	
}

?>