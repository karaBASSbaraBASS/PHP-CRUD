<?php
class Database
{
	private static $dbName = 'crud';
	private static $dbHost = 'localhost';
	private static $dbUsername = 'root';
    private static $dbUserPassword = 'vertrigo';

    private static $cont = null;

    public function __construct() {
    	die('Init function is not allowed');
    }

    public static function connect()
   	{
   		// One connectoin for all
   		if ( null == self::$cont )
   		{
   			try
   			{
   				self::$cont = new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
   			}
   			catch(PDOException $e)
   			{
   				die($e->getMessage());
   			}
   		}
   		return self::$cont;
   	}
   	public static function disconnect()
   	{
   		self::$cont = null;
   	}
}
?>