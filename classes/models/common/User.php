<?php

    namespace classes\models\common;

	use classes\models\common\Record;
	
	class User extends Record{
		function __construct(){
			record::__construct('users','family','familydbphp','root','example');
		}
		
		
		function setupTable(){
			
			$tableName = $this->TableName;
			
			$columns = [
				[
					"name" => "id",
					"type" => "int",
					"primaryKey" => true,
					"allowNull" => false,
					"extra" => "auto_increment"
				],
				[
					"name" => "username",
					"type" => "varchar(255)",
					"primaryKey" => false,
					"allowNull" => false,
					"extra" => ""
				],
				[
					"name" => "password",
					"type" => "varchar(255)",
					"primaryKey" => false,
					"allowNull" => false,
					"extra" => ""
				],
				[
					"name" => "salt",
					"type" => "varchar(255)",
					"primaryKey" => false,
					"allowNull" => false,
					"extra" => ""
				]
			];
			
			
			$this->createTable($tableName, $columns);
			
			
			
		}
		
		
	}
?>