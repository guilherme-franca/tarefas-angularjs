# Gerenciador de tarefas

Gerenciador de tarefas simples. Está sendo desenvolvido em PHP e Angularjs.

## Banco de dados

Utiliza o MYSQL como banco de dados e o PDO para realizar a conexão com o banco de dados.
- Nome do banco: `manager_tasks`.
- Possui apenas uma tabela chamada de `tasks`. Estrutura da tabela:
```
	CREATE TABLE `tasks` (
	  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	  `name` varchar(180) NOT NULL,
	  `description` text NOT NULL,
	  `priority` int(1) NOT NULL COMMENT '1 - Low | 2 - Medium | 3 - Higth',
	  `completed` enum('y', 'n') NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```
