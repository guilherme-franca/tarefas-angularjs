<?php

include 'DB.class.php';

/**
* Operações de criar, ler, atualizar e deletar
*/
class Tarefa
{
	private $db;
	function __construct()
	{
		$this->db = DB::conectar();
	}

	/**
	 * Lista todos os regitros
	 * 
	 * return @json
	 */
	function buscar() {
		$query = $this->db->query('SELECT * FROM tarefas');
		return array(
			'dados' => $query->FetchAll(),
			'error' => false
		);
	}
}