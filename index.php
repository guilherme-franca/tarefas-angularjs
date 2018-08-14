<!DOCTYPE html>
<html lang="en" ng-app="my_app">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Gerenciar Tarefas</title>

	<link rel="stylesheet" href="assets/css/bootstrap.css">

	<script src="assets/js/angular.min.js"></script>
</head>
<body ng-controller="TasksController" ng-init="init()">
	<header class="jumbotron text-center">
		<h3>Gerenciar Tarefas</h3>
	</header>
	<main>
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4" >
					<form name="form_tasks" id="form_tasks" ng-submit="saveForm()">
						<div class="panel panel-info">
							<div class="panel-heading">
								<span class="panel-title"> {{ titleForm }} </span>
							</div>
							<div class="panel-body">
								Tarefa
								<input type="hidden" name="id" id="id" ng-model="id">
								<input type="text" name="name" id="name" ng-model="name" value="" class="form-control">
								
								<p>&nbsp;</p>
								Descrição
								<textarea name="description" id="description" rows="5" class="form-control" ng-model="description"></textarea>

								<p>&nbsp;</p>
								Prioridade
								<select name="priority" id="priority" class="form-control" ng-model="priority">
									<option value="1">Baixa</option>
									<option value="2">Média</option>
									<option value="3">Alta</option>
								</select>

								<p>&nbsp;</p>
								Tarefa concluida
								<select name="completed" id="completed" class="form-control" ng-model="completed">
									<option value="y">Sim</option>
									<option value="n">Não</option>
								</select>
							</div>
							<div class="panel-footer">
								<button type="submit" class="btn btn-success" ><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>
							</div>
						</div><!-- /.painel -->
					</form>
				</div><!-- /.col-md-4 -->

				<div class="col-md-8">
					<div class="panel panel-success">
						<div class="panel-heading">
							<span class="panel-title">Lista de Tarefas</span>
						</div>
						<div class="panel-body">
							<div class="alert alert-info" ng-if="tasks.length <= 0">
								<span class="glyphicon glyphicon-info-sign"></span>
								&nbsp;
								<strong>Nenhuma</strong> tarefa encontrada!
							</div>
							<table class="table table-striped" ng-if="tasks.length > 0">
								<thead>
									<tr>
										<th>ID</th>
										<th>Tarefa</th>
										<th>Descrição</th>
										<th>Prioridade</th>
										<th>Concluida</th>
										<th>Ações</th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="task in tasks track by $index">
										<td>{{ task.id }}</td>
										<td>{{ task.name }}</td>
										<td>{{ task.description }}</td>
										<td>{{ swithCase( task.priority ) }}</td>
										<td>{{ task.completed == "y" ? "Sim":"Não" }}</td>
										<td>
											<button ng-click="fillFields( task.id )" type="button" class="btn btn-success">
												<span class="glyphicon glyphicon-edit"></span>
											</button>
											<button ng-click="delete( task.id )" type="button" class="btn btn-danger">
												<span class="glyphicon glyphicon-trash"></span>
											</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="panel-footer" >
							<span class="text-muted">** FIM DA LISTA ** </span>
						</div>
					</div><!-- /.painel -->
				</div>
			</div><!-- /.row -->
		</div><!-- /.container -->

	</main>


	<script src="assets/js/main.js"></script>
</body>
</html>