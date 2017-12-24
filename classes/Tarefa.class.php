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

	function inserir( $dados ) {
		if ( !is_array($dados) ) {
			return array(
				'message' => 'Variavel $dados nao é um array',
				'error' => true
			);
		}

		$stmt = $this->db->prepare( 'INSERT INTO tarefas(nome, descricao, prioridade, concluida) VALUES (?, ?, ?, ?)' );
		$stmt->execute( $dados );
		return $this->db->lastInsertId();
	}

	function atualizar( $dados ) {
		# code...
	}
}