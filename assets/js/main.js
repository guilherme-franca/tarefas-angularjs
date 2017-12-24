

var app = angular.module('my_app', []);


app.controller('tarefas_ctrl', function($scope,$http) {

	// Seta alguns valores padrões
	$scope.titulo_painel = "Adicionar Tarefa";
	$scope.id         = "0";
	$scope.prioridade = "b";
	$scope.concluida  = "n";
	$scope.tarefas    = [];

	$scope.pegarDados = function(){
        $http.post('tarefa.php', {
            params:{
                'opcao':'ler'
            }
        }).then( function(response){
        	console.log('RESPONSE: ', response);
            if( response.data.error === false ){
                $scope.tarefas = response.data.dados;
            } else {
            	console.error('Ocorreu um erro inesperado!');
            }
        });
    };

	$scope.preemcherCampos = function(id) {
		
		var index  = pegarIndexSelecionado(id),
		    tarefa = $scope.tarefas[index];
		   
		$scope.titulo_painel = "Editar Tarefa";
		$scope.id            = tarefa.id;
		$scope.nome          = tarefa.nome;
		$scope.descricao     = tarefa.descricao;
		$scope.prioridade    = tarefa.prioridade;
		$scope.concluida     = tarefa.concluida;

	}

	$scope.salvar = function() {
		var index  = pegarIndexSelecionado( $scope.id );
		console.log('FORM DATA: ', $scope.formData);
		$http.defaults.headers.post["Content-Type"] = "application/form-data";
		if ( index == -1 ) {
			// Iinserir dados
			$http.post('tarefa.php', {
	            params:{
	                'opcao':'novo',
					'nome': $scope.nome,
					'descricao': $scope.descricao,
					'prioridade': $scope.prioridade,
					'concluida': $scope.concluida
	            }
	        }).then(function(response) {
				console.log('SALVAR: ', response);
				$scope.tarefas.push({
					'id': response.data.id,
					'nome': $scope.nome,
					'descricao': $scope.descricao,
					'prioridade': $scope.prioridade,
					'concluida': $scope.concluida
				});
			});
		} else {
			// Atualiza os dados 
			$http.post('tarefa.php', {
	            params:{
	                'opcao':'editar',
					'id': index,
					'nome': $scope.nome,
					'descricao': $scope.descricao,
					'prioridade': $scope.prioridade,
					'concluida': $scope.concluida
	            }
	        }).then(function(response) {
				console.log('EDITAR: ', response);
				$scope.tarefas[index].nome       = $scope.nome;
				$scope.tarefas[index].descricao  = $scope.descricao;
				$scope.tarefas[index].prioridade = $scope.prioridade;
				$scope.tarefas[index].concluida  = $scope.concluida;
			});
		}

		// Limpa o formulário
		$scope.titulo_painel = "Adicionar Tarefa";
		$scope.id         	 = 0;
		$scope.nome     	 = "";
		$scope.descricao  	 = "";
		$scope.prioridade 	 = "";
		$scope.concluida  	 = "";
	}

	$scope.swithCase = function(valor) {
		var retorno = "";
		switch(valor) {
			case "b":
				retorno = "Baixa";
				break;
			case "m":
				retorno = "Média";
				break;
			case "a":
				retorno = "Alta";
				break;
			default:
				retorno = "";
				break;
		}
		return retorno;
	}

	$scope.del = function(id) {
		var result = confirm('Tem certeza que deseja excluir?');
		if (result == true) {
			var index = pegarIndexSelecionado(id);
			$scope.tarefas.splice(index, 1);
		}
	}

	// Pega uma posição no JSON
	function pegarIndexSelecionado(id) {
		for (var i=0; i<$scope.tarefas.length; i++)
			if ($scope.tarefas[i].id == id)
				return i;
		return -1;
	}


});