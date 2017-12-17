

var app = angular.module('my_app', []);


app.controller('tarefas_ctrl', function($scope) {

	$scope.titulo_painel = "Adicionar Tarefa";
	$scope.id = "0";
	$scope.prioridade = "b";
	$scope.concluida  = "n";

	$scope.tasks = [
		{
			"id": 1,
			"tarefa": "T1",
			"descricao": "Primeiro teste",
			"prioridade": "m",
			"concluida": "n"
		},
		{
			"id": 2,
			"tarefa": "T2",
			"descricao": "Segundo teste",
			"prioridade": "b",
			"concluida": "s"
		}
	];

	$scope.preemcherCampos = function(id) {
		
		var index  = pegarIndexSelecionado(id),
		    tarefa = $scope.tasks[index];
		   
		$scope.titulo_painel = "Editar Tarefa";
		$scope.id            = tarefa.id;
		$scope.tarefa        = tarefa.tarefa;
		$scope.descricao     = tarefa.descricao;
		$scope.prioridade    = tarefa.prioridade;
		$scope.concluida     = tarefa.concluida;

	}

	$scope.salvar = function() {
		var index  = pegarIndexSelecionado( $scope.id );
		if ( index == -1 ) {
			$scope.tasks.push({
				"id": $scope.tasks.length + 1,
				"tarefa": $scope.tarefa,
				"descricao": $scope.descricao,
				"prioridade": $scope.prioridade,
				"concluida": $scope.concluida
			});
		} else {
			$scope.tasks[index].tarefa     = $scope.tarefa;
			$scope.tasks[index].descricao  = $scope.descricao;
			$scope.tasks[index].prioridade = $scope.prioridade;
			$scope.tasks[index].concluida  = $scope.concluida;
		}

		// Limpa o formulário
		$scope.titulo_painel = "Adicionar Tarefa";
		$scope.id         	 = 0;
		$scope.tarefa     	 = "";
		$scope.descricao  	 = "";
		$scope.prioridade 	 = "";
		$scope.concluida  	 = "";
	}

	$scope.del = function(id) {
		var result = confirm('Tem certeza que deseja excluir?');
		if (result == true) {
			var index = pegarIndexSelecionado(id);
			$scope.tasks.splice(index, 1);
		}
	}

	function pegarIndexSelecionado(id) {
		for (var i=0; i<$scope.tasks.length; i++)
			if ($scope.tasks[i].id == id)
				return i;
		return -1;
	}


});