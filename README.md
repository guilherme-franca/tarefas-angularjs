# Gerenciador de tarefas

Gerenciador de tarefas simples. Está sendo desenvolvido em PHP e angularjs.

# Banco de dados

Utiliza o MYSQL como banco de dados e o PDO para realizar a conexão com o banco de dados.
Nome do banco: db_tarefa
Possui apenas uma tabela chamada de tarefas
Estrutura da tabela:
```
	CREATE TABLE `tarefas` (
	  `id` int(11) NOT NULL,
	  `nome` varchar(180) NOT NULL,
	  `descricao` text NOT NULL,
	  `prioridade` char(1) NOT NULL,
	  `concluida` char(1) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```
