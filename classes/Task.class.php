<?php

include 'DB.class.php';

/**
* Operações de criar, ler, atualizar e deletar
* Manager tasks into of the aplication
* 
* @public
*/
class Task
{
	/**
	 * var $db Using in the instance of database
	 */
	private $db;
	
	/**
	 * Construct
	 */
	public function __construct()
	{
		$this->db = DB::connect();
	}

	/**
	 * Lista todos os regitros
	 * List all the records
	 * 
	 * return array
	 */
	public function find()
	{
		$query = $this->db->query('SELECT * FROM tasks ORDER BY priority DESC');
		return $query->FetchAll();
		/*return array(
			'data' => $query->FetchAll(),
			'error' => false
		);*/
	}

	/**
	 * Inserir um novo registro
	 * Insert a new record
	 * 
	 * return integer
	 */
	public function insert( $data )
	{
		if ( !is_array($data) ) {
			return array(
				'message' => 'Variavel $data nao é um array',
				'error' => true
			);
		}

		$stmt = $this->db->prepare( 'INSERT INTO tasks (name, description, priority, completed) VALUES (?, ?, ?, ?)' );
		$stmt->execute( $data );
		return $this->db->lastInsertId();
	}

	/**
	 * Atualiza um registro
	 * Update a record
	 * 
	 * return @int
	 */
	public function update( $data )
	{
		if ( !is_array($data) ) {
			return array(
				'message' => 'Variavel $data nao é um array',
				'error' => true
			);
		}

		$stmt = $this->db->prepare( 'UPDATE tasks SET name = ?, description = ?, priority = ?, completed = ?  WHERE id = ?' );
		$stmt->execute( $data );
		return $stmt->rowCount();
	}

	/**
	 * Delete the record
	 */
	public function delete( $id )
	{
		//
	}
}