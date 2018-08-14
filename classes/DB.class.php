<?php

/**
* Conectar com o banco de dados
* Connection with the database
*/
class DB
{
	private static $host   = 'localhost';
	private static $nameDB = 'manager_tasks';
	private static $user   = 'tarefas';
	private static $pass   = '123456';

	/**
	 * Construct
	 */
	public function __construct() {}

	/**
	 * Connect of database
	 * 
	 * return \PDO $pdo
	 */
	public static function connect()
	{
		$pdo = "";
		try {
			$opt = array(
	            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
	            PDO::ATTR_EMULATE_PREPARES => FALSE,
	        );
	        $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$nameDB;
	        $pdo = new PDO($dsn, self::$user, self::$pass, $opt);
		} catch (PDOException $e) {
			echo json_encode(array(
				'message' => $e->getMassege(),
				'error' => true
			));
		}
	    return $pdo;
	}
}