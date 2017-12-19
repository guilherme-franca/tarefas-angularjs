<?php

include 'classes/Tarefa.class.php';

$t = new Tarefa();

switch ( $_GET['opcao'] ) {
	case 'ler':
		echo json_encode( $t->buscar() );
		break;
	
	default:
		echo "Ação inválida";
		break;
}