<?php

/**
* Conectar com o banco de dados
*/
class DB
{
	private static $host = 'localhost';
	private static $nome_banco = 'db_tarefa';
	private static $usuario = 'tarefas';
	private static $senha = '123456';

	function __construct() {}

	public static function conectar() {
		$pdo = "";
		try {
			$opt = array(
	            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
	            PDO::ATTR_EMULATE_PREPARES => FALSE,
	        );
	        $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$nome_banco;
	        $pdo = new PDO($dsn, self::$usuario, self::$senha, $opt);
		} catch (PDOException $e) {
			echo json_encode(array(
				'message' => $e->getMassege(),
				'error' => true
			));
		}
	    return $pdo;
	}
}