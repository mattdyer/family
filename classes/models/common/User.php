<?php

    namespace classes\models\common;

	use classes\models\common\Record;
	
	class User extends Record{
		function __construct(){
			record::__construct('users','family','familydbphp','root','example');
		}
		

		function generatePassword(){

			$password = 'SuperSecret';

			$this->set('password', $password);
			$this->save();

			return $password;
		}


		function setPassword($plainPassword){
			
			
			
			$this->set('password', $plainPassword);
			$this->save();
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
				]
			];
			
			
			$this->createTable($tableName, $columns);
			
			
			
		}
		
		
	}
?>