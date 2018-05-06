<?php

include 'classes/Tarefa.class.php';

$dados = json_decode(file_get_contents('php://input'),true);

$t = new Tarefa();
$opcao = ( !isset ($dados['params']['opcao']) ) ? 'errado' : $dados['params']['opcao'];

//print_r( $dados );
// echo $_REQUEST['opcao'];

switch ( $opcao ) {
	case 'ler':
		echo json_encode( $t->buscar() );
		break;
	case 'novo':
		$dados = array(
			$dados['params']['nome'],
			$dados['params']['descricao'],
			$dados['params']['prioridade'],
			$dados['params']['concluida']
		);

		$id = $t->inserir( $dados );

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

	case 'editar':
		$dados1 = array(
			$dados['params']['nome'],
			$dados['params']['descricao'],
			$dados['params']['prioridade'],
			$dados['params']['concluida'],
			$dados['params']['id']
		);

		$linhas_afetados = $t->atualizar( $dados1 );

		if ( $linhas_afetados > 0 ) {
			echo json_encode(array(
				'linhas' => $linhas_afetados,
				'message' => 'Atualizado com sucesso!',
				'error' => false
			));
		} else {
			echo json_encode(array(
				'id' => 0,
				'message' => 'Erro ao atualizar a tarefa!',
				'error' => true
			));
		}
		break;
	
	default:
		echo "Ação inválida";
		break;
}