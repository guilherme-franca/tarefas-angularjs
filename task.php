<?php

include 'classes/Task.class.php';

$data = json_decode( file_get_contents('php://input'), true );

$task = new Task();
$option = ( !isset ($data['params']['option']) ) ? 'invalid' : $data['params']['option'];

//print_r( $data );
// echo $_REQUEST['option'];

switch ( $option ) {
	case 'read':
		echo json_encode( $task->all() );
		break;
	case 'create':
		$data = array(
			$data['params']['name'],
			$data['params']['description'],
			$data['params']['priority'],
			$data['params']['completed']
		);

		$id = $task->insert( $data );

		if ( $id > 0 ) {
			echo json_encode(array(
				'id' => $id,
				'message' => 'Cadastrado com sucesso!',
				'error' => false
			));
		} else {
			echo json_encode(array(
				'id' => 0,
				'message' => 'Erro ao cadastrar a tarefa!',
				'error' => true
			));
		}
		break;

	case 'update':
		$task_data = array(
			$data['params']['name'],
			$data['params']['description'],
			$data['params']['priority'],
			$data['params']['completed'],
			$data['params']['id']
		);

		$linhas_afetados = $task->update( $task_data );

		if ( $linhas_afetados > 0 ) {
			echo json_encode(array(
				'lines' => $linhas_afetados, // Total of lines affected
				'message' => 'Atualizado com sucesso!',
				'error' => false
			));
		} else {
			echo json_encode(array(
				'lines' => 0,
				'message' => 'Erro ao atualizar a tarefa!',
				'error' => true
			));
		}
		break;

	case 'delete':
		$id = is_integer( $data['params']['id'] ) ? $data['params']['id'] : 0;
		if( ( $id > 0 ) && ( $task->delete($id) > 0 ) ) {
			echo json_encode( array(
				'message' => 'Deletado com sucesso!',
				'error' => false
			));
		} else {
			echo json_encode( array(
				'message' => 'Erro ao deletar!',
				'error' => true
			));
		}
		break;
	
	default:
		echo "Ação inválida";
		break;
}