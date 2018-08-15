

var app = angular.module('my_app', []);


app.controller('TasksController', function($scope,$http) {

	// Set default value
	clearForm();
	$scope.tasks = [];

	// After load the page
	$scope.init = function() {
        $http
	        .post('task.php', {
	            params: {
	                'option':'read'
	            }
	        })
	        .then( function( response ) {
	        	console.log('kk', response);
	            $scope.tasks = response.data;
	        });
    };

    // Fiil fields into form
	$scope.fillFields = function( id ) {
		
		var index = getIndexSelected(id),
		    task  = $scope.tasks[index];
		   
		$scope.titleForm   = "Editar Tarefa";
		$scope.id          = task.id;
		$scope.name        = task.name;
		$scope.description = task.description;
		$scope.priority    = "" + task.priority;
		$scope.completed   = task.completed;

	}

	// Get the event submit of the form
	$scope.saveForm = function() {
		let index  = getIndexSelected( $scope.id );
		$http.defaults.headers.post["Content-Type"] = "application/form-data";
		if ( ckeckFields() ) {
			alert('Preeencha todos os campos');
			return false;
		}
		if ( index == -1 ) {
			// Insert
			save( index );
		} else {
			// Update
			update( index );
		}
	}

	// Request for delete a record
	$scope.delete = function( id ) {
		//Ask if want delete the record
		let result = confirm('Tem certeza que deseja excluir?');
		if (result == true) {
			$http
				.post('task.php', {
		            params: {
		                'option':'delete',
						'id': id
		            }
		        })
		        .then(function(response) {
					let index = getIndexSelected(id);
					$scope.tasks.splice(index, 1);
					alert(response.data.message);
				});
		}
	}

	// Label for priority of the task
	$scope.swithCase = function( str ) {
		let text = "";
		switch( str ) {
			case 1:
				// Low
				text = "Baixa";
				break;
			case 2:
				// Medium
				text = "Média";
				break;
			case 3:
				// High
				text = "Alta";
				break;
			default:
				text = "";
				break;
		}
		return text;
	}

	// Save the datas of the form
	function save( index ) {
		$http
			.post('task.php', {
	            params: {
	                'option':'create',
					'name': $scope.name,
					'description': $scope.description,
					'priority': parseInt( $scope.priority ),
					'completed': $scope.completed
	            }
	        })
	        .then(function(response) {
				alert(response.data.message);
				// Update index
				index = response.data.id;
				$scope.tasks.push({
					'id': index,
					'name': $scope.name,
					'description': $scope.description,
					'priority': parseInt( $scope.priority ),
					'completed': $scope.completed
				});
				clearForm();
			});
	}

	// Update the datas
	function update( index ) {
		$http
			.post('task.php', {
	            params: {
	                'option':'update',
					'id': $scope.id,
					'name': $scope.name,
					'description': $scope.description,
					'priority': parseInt( $scope.priority ),
					'completed': $scope.completed
	            }
	        })
	        .then(function(response) {
	        	alert(response.data.message + ' Linhas afetadas: ' + response.data.lines);
				$scope.tasks[index].name = $scope.name;
				$scope.tasks[index].description = $scope.description;
				$scope.tasks[index].priority = parseInt( $scope.priority );
				$scope.tasks[index].completed = $scope.completed;
				clearForm();
			});
	}

	//Check if have any field without fill.
	function ckeckFields() {
		if ( isEmpty($scope.name) || 
			 isEmpty($scope.description) ) {
			return true;
		}
		return false;
	}

	//If empty string return false
	function isEmpty(str) {
	    return ( !str || 0 === str.length || /^\s*$/.test(str) );
	}

	// Clear form
	function clearForm () {
		$scope.titleForm    = "Adicionar Tarefa";
		$scope.id         	= 0;
		$scope.name     	= "";
		$scope.description  = "";
		$scope.priority 	= "1";
		$scope.completed  	= "n";
	}

	// Get position in the JSON
	function getIndexSelected( id ) {
		for (var i=0; i<$scope.tasks.length; i++)
			if ($scope.tasks[i].id == id)
				return i;
		return -1;
	}


});