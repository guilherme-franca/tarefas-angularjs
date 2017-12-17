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
<body ng-controller="tarefas_ctrl">
	<header class="jumbotron text-center">
		<h3>Gerenciar Tarefas</h3>
	</header>
	<main>
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4" >
					<form name="form_tarefas" action="" class="">
						<div class="panel panel-info">
							<div class="panel-heading">
								<span class="panel-title"> {{ titulo_painel }} </span>
							</div>
							<div class="panel-body">
								Tarefa
								<input type="hidden" name="id" id="id" ng-model="id">
								<input type="text" name="tarefa" id="tarefa" ng-model="tarefa" value="" class="form-control">
								
								<p>&nbsp;</p>
								Descrição
								<textarea name="descricao" id="descricao" rows="5" class="form-control" ng-model="descricao"></textarea>

								<p>&nbsp;</p>
								Prioridade
								<select name="prioridade" id="prioridade" class="form-control" ng-model="prioridade">
									<option value="b">Baixa</option>
									<option value="m">Média</option>
									<option value="a">Alta</option>
								</select>

								<p>&nbsp;</p>
								Tarefa concluida
								<select name="concluida" id="concluida" class="form-control" ng-model="concluida">
									<option value="s">Sim</option>
									<option value="n">Não</option>
								</select>
							</div>
							<div class="panel-footer">
								<button type="button" class="btn btn-success" ng-click="salvar()"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>
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
							<table class="table table-striped">
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
									<tr ng-repeat="lista in tasks track by $index">
										<td>{{ lista.id }}</td>
										<td>{{ lista.tarefa }}</td>
										<td>{{ lista.descricao }}</td>
										<td>{{ lista.prioridade }}</td>
										<td>{{ lista.concluida }}</td>
										<td>
											<button ng-click="preemcherCampos( lista.id )" type="button" class="btn btn-success">
												<span class="glyphicon glyphicon-edit"></span>
											</button>
											<button ng-click="del( lista.id )" type="button" class="btn btn-danger">
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