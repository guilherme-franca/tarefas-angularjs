<?php

/**
* Connection to Database
*/
class DB
{
	private $host = 'localhost';
	private $nome_banco = 'db_tarefa';
	private $usuario = 'tarefas';
	private $senha = '123456';

	function __construct() {}

	public static function conectar() {
		return 'teste';
	}

}