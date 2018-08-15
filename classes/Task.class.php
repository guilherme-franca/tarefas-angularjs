<?php

include 'DB.class.php';

/**
* Operation basics for the tasks into of the aplication | CRUD
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
	 * List all the records
	 * 
	 * return array
	 */
	public function all()
	{
		$query = $this->db->query('SELECT * FROM tasks ORDER BY priority DESC');
		return $query->FetchAll();
	}

	/**
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
	 * Update a record
	 * 
	 * return integer
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
	 * Delete a record
	 */
	public function delete( $id )
	{
		$stmt = $this->db->prepare( 'DELETE FROM tasks  WHERE id = :id' );
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->rowCount();
	}
}