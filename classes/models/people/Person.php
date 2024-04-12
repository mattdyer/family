<?php
	require_once(SiteRoot . '/classes/models/common/Record.php');
	class Person extends Record{
		function __construct(){
			record::__construct('people','family','familydbphp','root','example');
		}
		
		function beforeSave(){
			if (strlen($this->fields[$this->IDColumn]) == 0){
				$this->set('dateEntered', date("Y-m-d H:i:s", time()));
				
				$birthDate = $this->get('birthDate');
				$this->set('identifier', "{$this->get('firstName')}{$this->get('lastName')}{$birthDate}");
				
			}
		}
		
		function setupTable($records){
			
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
					"name" => "identifier",
					"type" => "varchar(255)",
					"primaryKey" => false,
					"allowNull" => false,
					"extra" => ""
				],
				[
					"name" => "firstName",
					"type" => "varchar(100)",
					"primaryKey" => false,
					"allowNull" => true,
					"extra" => ""
				],
				[
					"name" => "lastName",
					"type" => "varchar(100)",
					"primaryKey" => false,
					"allowNull" => true,
					"extra" => ""
				],
				[
					"name" => "birthDate",
					"type" => "date",
					"primaryKey" => false,
					"allowNull" => true,
					"extra" => ""
				],
				[
					"name" => "birthDateDisplay",
					"type" => "varchar(100)",
					"primaryKey" => false,
					"allowNull" => true,
					"extra" => ""
				],
				[
					"name" => "deathDate",
					"type" => "date",
					"primaryKey" => false,
					"allowNull" => true,
					"extra" => ""
				],
				[
					"name" => "deathDateDisplay",
					"type" => "varchar(100)",
					"primaryKey" => false,
					"allowNull" => true,
					"extra" => ""
				],
				[
					"name" => "dateEntered",
					"type" => "datetime",
					"primaryKey" => false,
					"allowNull" => false,
					"extra" => ""
				]
			];
			
			
			$this->createTable($tableName, $columns);
			
			$this->addRecords($records);
			
		}
		
		
	}
?>